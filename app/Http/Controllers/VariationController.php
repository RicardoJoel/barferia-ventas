<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Parameter;
use Response;

class VariationController extends Controller
{
    protected const MSG_NOT_UNIQUE = 'Solo puedes agregar una variación salarial a la vez.';
    protected const MSG_BTW_MONTHS = 'Solo puedes agregar variaciones salariales cuya fecha efectiva sea posterior a la última ingresada más value mes(es).';
    protected const MSG_NOT_SALRNG = 'El sueldo resultante no puede ser una cantidad negativa.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maxsal = Parameter::where('name','MAXSAL')->get()->first()->value;
        $months = Parameter::where('name','MONTHS')->get()->first()->value;

        self::validate($request, [
            'variation_type' => 'required|string|in:Aumento,Disminución',
            'variation_amount' => 'required|numeric|between:1,'.$maxsal,
            'variation_start_at' => 'required|date_format:Y-m-d',
            'variation_observation' => 'nullable|string|max:100'
        ], self::validationErrorMessages());

        $variations = session('variations', []);
        $ultimo = [
            'start_at' => '1900-01-01',
            'after' => $request->cur_salary ?? 0
        ];
        foreach ($variations as $variat)
            /* Ini: registro unico */
            if ($variat['id'] === '')
                return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_NOT_UNIQUE]], 400);
            /* Fin: registro unico */
            else {
                $var = Carbon::parse($variat['start_at']);
                $ult = Carbon::parse($ultimo['start_at']);
                if ($var->gt($ult)) $ultimo = $variat;
            }
        /* Ini: dentro de meses */
        $var = Carbon::parse($request->variation_start_at);
        $ult = Carbon::parse($ultimo['start_at']);
        if ($var->lt($ult->addMonths($months)))
            return Response::json(['success' => 'false', 'errors' => ['message' => str_replace('value',$months,self::MSG_BTW_MONTHS)]], 400);
        /* Fin: dentro de meses */
        
        if ($request->variation_type === 'Aumento')
            $new_salary = $ultimo['after'] + $request->variation_amount;
        else
            $new_salary = $ultimo['after'] - $request->variation_amount;

        if ($new_salary < 0 || $new_salary > $maxsal)
            return Response::json(['success' => 'false', 'errors' => ['message' => str_replace('value',number_format($maxsal),self::MSG_NOT_SALRNG)]], 400);
        
        $variations[] = [
            'id' => '',
            'type' => $request->variation_type,
            'amount' => $request->variation_amount,
            'start_at' => $request->variation_start_at,
            'observation' => $request->variation_observation,
            'created_at' => Carbon::today(),
            'before' => $ultimo['after'],
            'after' => $new_salary,
        ];
        session(['variations' => $variations]);
        return json_encode($variations);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        $maxsal = Parameter::where('name','MAXSAL')->get()->first()->value;
        return [
            'variation_type.required' => 'Debes ingresar obligatoriamente un tipo de variación.',
            'variation_type.in' => 'El tipo de variación ingresado es inválido.',

            'variation_amount.required' => 'Debes ingresar obligatoriamente un monto de variación.',
            'variation_amount.numeric' => 'El monto de variación ingresado no tiene un formato válido.',
            'variation_amount.between' => 'El monto de variación no puede ser negativo ni mayor a '.number_format($maxsal).' soles.',

            'variation_start_at.required' => 'Debes ingresar obligatoriamente una fecha efectiva de variación.',
            'variation_start_at.date_format' => 'La fecha efectiva de variación ingresada no tiene un formato válido.',

            'variation_observation.max' => 'La observación debe tener un máximo de cien (100) caracteres.'
        ];
    }
}