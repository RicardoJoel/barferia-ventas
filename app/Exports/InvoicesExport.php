<?php

namespace App\Exports;

use Carbon\Carbon;
/* From array */
use Maatwebsite\Excel\Concerns\FromArray;
/* Heading */
use Maatwebsite\Excel\Concerns\WithHeadings;
/* Value binders */
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
/* Auto size column */
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
/* Styling */
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvoicesExport extends DefaultValueBinder implements FromArray, WithHeadings, WithCustomValueBinder, ShouldAutoSize, WithStyles
{
    protected $invoices, $customer, $project, $user, $status, $start_at, $end_at;

    public function __construct(array $invoices, $customer, $project, $user, $status, $start_at, $end_at)
    {
        $this->invoices = $invoices;
        $this->customer = $customer;
        $this->project = $project;
        $this->user = $user;
        $this->status = $status;
        $this->start_at = $start_at;
        $this->end_at = $end_at;
    }

    public function array(): array
    {
        return $this->invoices;
    }

    public function headings(): array
    {
        return [
            ['Reporte de actividades realizadas '.($this->start_at == $this->end_at ? 'el '.$this->start_at : 'entre el '.$this->start_at.' y el '.$this->end_at)],
            [],
            ['Cliente:', 'Proyecto:', 'Usuario:', 'Estado:'],
            [$this->customer, $this->project, $this->user, $this->status],
            [],
            ['Cliente', 'Proyecto', 'Usuario', 'Estado', 'Inicio', 'Término', 'Minutos', 'Descripción', 'Comentario']
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);
            return true;
        }
        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:D1');
        return [
            // Style the first row as bold text
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            6 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            3 => ['font' => ['bold' => true]],
        ];
    }
}