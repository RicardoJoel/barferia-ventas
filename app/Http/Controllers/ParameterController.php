<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parameter;
use Redirect;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parameters = Parameter::orderBy('name','ASC')->paginate(1000000);
        return view('parameters.index', compact('parameters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parameter = Parameter::find($id);
        return view('parameters.edit', compact('parameter'));
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
        $this->validate($request, [
            'value' => 'required|integer|min:1',
        ], $this->validationErrorMessages());
        Parameter::find($id)->update($request->all());
        return Redirect::route('parameters.index')->with('success','Parámetro actualizado satisfactoriamente.');
    }
        
    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'name.required' => 'Debe ingresar obligatoriamente un nombre.',
            'name.unique' => 'El nombre ingresado ya existe en el sistema.',
            'name.max' => 'El nombre debe tener un máximo de cincuenta (50) caracteres.',
            'value.required' => 'Debe ingresar obligatoriamente un valor.',
            'value.integer' => 'El valor debe ser un número entero positivo.',
            'value.min' => 'El valor debe ser un número entero positivo.',
        ];
    }
}