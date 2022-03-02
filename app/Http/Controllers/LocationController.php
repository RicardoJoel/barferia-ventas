<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Response;
use DB;

class LocationController extends Controller
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
            'loc_address' => 'required|string|max:100',
            'loc_ubigeo' => 'required|string|max:300',
            'loc_ref' => 'nullable|string|max:100',
            'loc_lat' => 'nullable|numeric',
            'loc_lng' => 'nullable|numeric',
        ], self::validationErrorMessages());

        $locations = session('locations', []);
        $locations[] = [
            'id' => '',
            'address' => $request->loc_address,
            'ubigeo' => $request->loc_ubigeo,
            'ref' => $request->loc_ref,
            'lat' => $request->loc_lat,
            'lng' => $request->loc_lng,
        ];
        session(['locations' => $locations]);
        return json_encode($locations);
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
        $locations = session('locations', []);

        if ($id < 0 || count($locations) <= $id)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);
        
        $item = $locations[$id];
        $location = [
            'id' => $item['id'],
            'address' => $item['address'],
            'ubigeo' => $item['ubigeo'],
            'ref' => $item['ref'],
            'lat' => $item['lat'],
            'lng' => $item['lng'],
        ];
        return json_encode($location);
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
            'loc_address' => 'required|string|max:100',
            'loc_ubigeo' => 'required|string|max:300',
            'loc_ref' => 'nullable|string|max:100',
            'loc_lat' => 'nullable|numeric',
            'loc_lng' => 'nullable|numeric',
        ], self::validationErrorMessages());

        $locations = session('locations', []);
        
        if ($id < 0 || count($locations) <= $id)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);
        
        $locations[$id] = [
            'id' => $request->id,
            'address' => $request->loc_address,
            'ubigeo' => $request->loc_ubigeo,
            'ref' => $request->loc_ref,
            'lat' => $request->loc_lat,
            'lng' => $request->loc_lng,
        ];
        session(['locations' => $locations]);
        return json_encode($locations);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locations = session('locations', []);

        if ($id < 0 || count($locations) <= $id)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);
        
        unset($locations[$id]);
        $locations = array_values($locations);
        session(['locations' => $locations]);
        return json_encode($locations);
    }
    
    public function searchByFilter(Request $request) {
        $customer_id = $request->ubic_cust_id;
        $address = $request->ubic_address;
        $ubigeo = $request->ubic_ubigeo;

        $locations = Location::select([
            'locations.id', 'locations.address', 'locations.ref', 'locations.lat', 'locations.lng',
            DB::raw('if(isnull(locations.ubigeo_id),locations.other_ubigeo,concat(ubigeos.department," / ",ubigeos.province," / ",ubigeos.district)) as ubigeo')
        ])
        ->leftJoin('customers','customers.id','locations.customer_id')
        ->leftJoin('ubigeos','ubigeos.id','locations.ubigeo_id')
        ->where('locations.customer_id',$customer_id)
        ->where('locations.address','like',"%$address%")
        ->where(DB::raw('concat(ubigeos.department," / ",ubigeos.province," / ",ubigeos.district)'),'like',"%$ubigeo%")
        ->get();

        return json_encode($locations);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'loc_address.required' => 'Debes ingresar obligatoriamente una dirección.',
            'loc_address.max' => 'La dirección no debe superar los cien (100) caracteres.',
            
            'loc_ubigeo.required' => 'Debes ingresar obligatoriamente una ubicación.',
            'loc_ubigeo.max' => 'La ubicación no debe superar los trescientos (300) caracteres.',

            'loc_ref.max' => 'La referencia no debe superar los cien (100) caracteres.',
            'loc_lat.numeric' => 'La latitud ingresada no tiene un formato válido.',
            'loc_lng.numeric' => 'La longitud ingresada no tiene un formato válido.',
        ];
    }
}
