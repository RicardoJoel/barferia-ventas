<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class ReceptionDetailController extends Controller
{
    protected const MSG_ERR_INVIDX = 'El índice ingresado es inválido.';
    
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
    public function update(Request $request)
    {
        self::validate($request, [
            'idx' => 'required|integer|min:0',
            'checked' => 'required|integer|in:0,1',
            'received' => 'nullable|regex:/[0-9]+/',
            'returned' => 'nullable|regex:/[0-9]+/',
            'observation' => 'nullable|string|max:100',
        ], self::validationErrorMessages());

        $details = session('recdetails', []);

        if (count($details) <= (int)($request->det_idx))
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);

        $details[$request->idx]['checked'] = (int)$request->checked;
        $details[$request->idx]['received'] = (int)$request->received;
        $details[$request->idx]['returned'] = (int)$request->returned;
        $details[$request->idx]['observation'] = $request->observation;

        session(['recdetails' => $details]);
        return json_encode($details);
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
        return [
            'idx.required' => 'Debes ingresar obligatoriamente un índice.',
            'idx.integer' => 'El índice ingresado no tiene un formato válido.',
            'idx.min' => 'El índice ingresado no es válido.',

            'received.regex' => 'La cantidad de productos recibidos no tiene un formato válido.',
            'returned.regex' => 'La cantidad de productos devueltos no tiene un formato válido.',
            'observation.max' => 'La observación no puede superar los cien (100) caracteres.',
        ];
    }
}