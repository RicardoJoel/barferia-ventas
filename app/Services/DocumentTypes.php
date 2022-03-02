<?php

namespace App\Services;

use App\DocumentType;

class DocumentTypes
{
    public function get()
    {
        $documentTypes = DocumentType::orderBy('code')->get();
        $array = [];
        foreach ($documentTypes as $documentType) {
            $array[$documentType->id] = [
                'name' => $documentType->name,
                'code' => $documentType->code,
            ];
        }
        return $array;
    }
}