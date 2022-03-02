<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DependentType;
use App\DocumentType;
use App\Gender;
use Response;

class DependentController extends Controller
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
        self::validate($request, [
            'dependent_name' => 'required|string|max:50',
            'dependent_lastname' => 'required|string|max:50',
            'dependent_type_id' => 'required|integer|min:1',
            'dependent_document_type_id' => 'required|integer|min:1',
            'dependent_document' => 'required|string|regex:/'.$request->dependent_doc_pattern.'/',
            'dependent_gender_id' => 'required|integer|min:1',
            'dependent_birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:today',
        ], self::validationErrorMessages());

        $dependents = session('dependents', []);
        $dependents[] = [
            'id' => '',
            'name' => $request->dependent_name,
            'lastname' => $request->dependent_lastname,
            'type' => DependentType::find($request->dependent_type_id)->name,
            'document_type' => DocumentType::find($request->dependent_document_type_id)->name,
            'document' => $request->dependent_document,
            'gender' => Gender::find($request->dependent_gender_id)->name,
            'birthdate' => $request->dependent_birthdate
        ];
        session(['dependents' => $dependents]);
        return json_encode($dependents);
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
        $dependents = session('dependents', []);

        if ($id < 0 || count($dependents) <= $id)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);
        
        $item = $dependents[$id];
        $dependent = [
            'id' => $item['id'],
            'name' => $item['name'],
            'lastname' => $item['lastname'],
            'type_id' => DependentType::where('name',$item['type'])->get()->first()->id,
            'document_type_id' => DocumentType::where('name',$item['document_type'])->get()->first()->id,
            'document' => $item['document'],
            'gender_id' => Gender::where('name',$item['gender'])->get()->first()->id,
            'birthdate' => $item['birthdate']
        ];
        return json_encode($dependent);
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
        self::validate($request, [
            'dependent_name' => 'required|string|max:50',
            'dependent_lastname' => 'required|string|max:50',
            'dependent_type_id' => 'required|integer|min:1',
            'dependent_document_type_id' => 'required|integer|min:1',
            'dependent_document' => 'required|string|regex:/'.$request->dependent_doc_pattern.'/',
            'dependent_gender_id' => 'required|integer|min:1',
            'dependent_birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:today',
        ], self::validationErrorMessages());

        $dependents = session('dependents', []);
        
        if ($id < 0 || count($dependents) <= $id)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);
        
        $dependents[$id] = [
            'id' => $request->id,
            'name' => $request->dependent_name,
            'lastname' => $request->dependent_lastname,
            'type' => DependentType::find($request->dependent_type_id)->name,
            'document_type' => DocumentType::find($request->dependent_document_type_id)->name,
            'document' => $request->dependent_document,
            'gender' => Gender::find($request->dependent_gender_id)->name,
            'birthdate' => $request->dependent_birthdate
        ];
        session(['dependents' => $dependents]);
        return json_encode($dependents);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dependents = session('dependents', []);

        if ($id < 0 || count($dependents) <= $id)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);
        
        unset($dependents[$id]);
        $dependents = array_values($dependents);
        session(['dependents' => $dependents]);
        return json_encode($dependents);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'dependent_name.required' => 'Debes ingresar obligatoriamente un nombre.',
            'dependent_name.max' => 'El nombre debe tener un máximo de cincuenta (50) caracteres.',
            'dependent_name.regex' => 'El nombre ingresado no tiene un formato válido.',
            
            'dependent_lastname.required' => 'Debes ingresar obligatoriamente un apellido.',
            'dependent_lastname.max' => 'El apellido debe tener un máximo de cincuenta (50) caracteres.',
            'dependent_lastname.regex' => 'El apellido ingresado no tiene un formato válido.',

            'dependent_type_id.required' => 'Debes ingresar obligatoriamente un vínculo familiar.',
            'dependent_type_id.integer' => 'El ID del vínculo familiar ingresado no tiene un formato válido.',
            'dependent_type_id.min' => 'El ID del vínculo familiar ingresado es inválido.',

            'dependent_document_type_id.required' => 'Debes ingresar obligatoriamente un tipo de documento.',
            'dependent_document_type_id.integer' => 'El ID del tipo de documento ingresado no tiene un formato válido.',
            'dependent_document_type_id.min' => 'El ID del tipo de documento ingresado es inválido.',

            'dependent_document.required' => 'Debes ingresar obligatoriamente un N° Documento.',
            'dependent_document.regex' => 'El N° Documento ingresado no corresponde al tipo de documento ingresado.',

            'dependent_gender_id.required' => 'Debes ingresar obligatoriamente un género.',
            'dependent_gender_id.integer' => 'El ID del género ingresado no tiene un formato válido.',
            'dependent_gender_id.min' => 'El ID del género ingresado es inválido.',
                        
            'dependent_birthdate.date_format' => 'La fecha de nacimiento ingresada no tiene un formato válido.',
            'dependent_birthdate.before_or_equal' => 'La fecha de nacimiento no puede ser posterior a la fecha actual.',
        ];
    }
}
