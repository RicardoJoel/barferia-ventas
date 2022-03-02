<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class PetController extends Controller
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
            'pet_name' => 'required|string|max:50',
            'pet_species' => 'required|string|in:Perro,Gato',
            'pet_gender' => 'required|string|in:Macho,Hembra',
            'pet_race' => 'required|string|max:50',
            'pet_birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:today',
            'pet_observation' => 'nullable|string|max:500',
        ], self::validationErrorMessages());

        $pets = session('pets', []);
        $pets[] = [
            'id' => '',
            'name' => $request->pet_name,
            'species' => $request->pet_species,
            'gender' => $request->pet_gender,
            'race' => $request->pet_race,
            'birthdate' => $request->pet_birthdate,
            'observation' => $request->pet_observation
        ];
        session(['pets' => $pets]);
        return json_encode($pets);
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
        $pets = session('pets', []);

        if ($id < 0 || count($pets) <= $id)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);
        
        $item = $pets[$id];
        $pet = [
            'id' => $item['id'],
            'name' => $item['name'],
            'species' => $item['species'],
            'gender' => $item['gender'],
            'race' => $item['race'],
            'birthdate' => $item['birthdate'],
            'observation' => $item['observation'],
        ];
        return json_encode($pet);
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
            'pet_name' => 'required|string|max:50',
            'pet_species' => 'required|string|in:Perro,Gato',
            'pet_gender' => 'required|string|in:Macho,Hembra',
            'pet_race' => 'required|string|max:50',
            'pet_birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:today',
            'pet_observation' => 'nullable|string|max:500',
        ], self::validationErrorMessages());

        $pets = session('pets', []);
        
        if ($id < 0 || count($pets) <= $id)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);
        
        $pets[$id] = [
            'id' => $request->id,
            'name' => $request->pet_name,
            'species' => $request->pet_species,
            'gender' => $request->pet_gender,
            'race' => $request->pet_race,
            'birthdate' => $request->pet_birthdate,
            'observation' => $request->pet_observation
        ];
        session(['pets' => $pets]);
        return json_encode($pets);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pets = session('pets', []);

        if ($id < 0 || count($pets) <= $id)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);
        
        unset($pets[$id]);
        $pets = array_values($pets);
        session(['pets' => $pets]);
        return json_encode($pets);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'pet_name.required' => 'Debes ingresar obligatoriamente un nombre.',
            'pet_name.max' => 'El nombre no debe superar los cincuenta (50) caracteres.',
            
            'pet_species.required' => 'Debes ingresar obligatoriamente una especie.',
            'pet_species.in' => 'La especie ingresada no es válida.',

            'pet_gender.required' => 'Debes ingresar obligatoriamente un género.',
            'pet_gender.in' => 'El género ingresado no es válido.',

            'pet_race.required' => 'Debes ingresar obligatoriamente una raza.',
            'pet_race.max' => 'La raza no debe superar los cincuenta (50) caracteres.',

            'pet_birthdate.date_format' => 'La fecha de nacimiento ingresada no tiene un formato válido.',
            'pet_birthdate.before_or_equal' => 'La fecha de nacimiento no puede ser posterior a la fecha actual.',
            
            'pet_observation.max' => 'Las observaciones no deben superar los quinientos (500) caracteres.',
        ];
    }
}
