<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Location;
use App\Ubigeo;
use App\Race;
use App\Pet;
use Redirect;
use Response;
use DB;

class CustomerController extends Controller
{
    protected const MSG_SCS_CRTCST = 'Cliente con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTCST = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el cliente.';
    protected const MSG_SCS_UPDCST = 'Cliente con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDCST = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el cliente.';
    protected const MSG_SCS_DELCST = 'Cliente con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELCST = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar el cliente.';
    protected const MSG_NOT_FNDCST = 'El cliente solicitado no ha sido encontrado.';

    protected const MSG_SCS_CRTPET = 'Mascota con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTPET = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar la mascota.';
    protected const MSG_SCS_UPDPET = 'Mascota con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDPET = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar la mascota.';
    protected const MSG_SCS_DELPET = 'Mascota con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELPET = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar la mascota.';
    protected const MSG_NOT_FNDPET = 'El mascota solicitado no ha sido encontrado.';

    protected const MSG_SCS_CRTLOC = 'Lugar de entrega con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTLOC = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el lugar de entrega.';
    protected const MSG_SCS_UPDLOC = 'Lugar de entrega con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDLOC = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el lugar de entrega.';
    protected const MSG_SCS_DELLOC = 'Lugar de entrega con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELLOC = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar el lugar de entrega.';
    protected const MSG_NOT_FNDLOC = 'El lugar de entrega solicitado no ha sido encontrado.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderByDesc('code')->paginate(1000000);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('errors')) {
            $locations = session('locations', []);
            $pets = session('pets', []);
        }
        else {
            $locations = $pets = [];
            session([
                'locations' => $locations,
                'pets' => $pets,
            ]);
        }
        return view('customers.create', compact('locations','pets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:-18 years',
            'document_type_id' => 'required|integer|min:1',
            'document' => 'required|string|unique:customers,document,NULL,id,deleted_at,NULL|regex:/'.$request->doc_pattern.'/',
            'email' => 'nullable|email:rfc|unique:customers,email,NULL,id,deleted_at,NULL|max:50',
            'country_id' => 'required|integer|min:1',
            'mobile' => 'required|string|unique:customers,mobile,NULL,id,deleted_at,NULL|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
        ], $this->validationErrorMessages());
        
        // Registro del cliente
        $customer = Customer::create($request->all());
        if (!$customer)
            return Redirect::back()->with('error', self::MSG_ERR_CRTCST)->withInput();

        // Registro de lugares de entrega
        $locations = session('locations', []);
        foreach ($locations as $loc) {
            $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$loc['ubigeo'])->get()->first()->id ?? null;
            $other = $ubigeo ? null : $loc['ubigeo'];
            if (!Location::create([
                'address' => $loc['address'],
                'ubigeo_id' => $ubigeo,
                'other_ubigeo' => $other,
                'ref' => $loc['ref'],
                'lat' => $loc['lat'],
                'lng' => $loc['lng'],
                'customer_id' => $customer->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTLOC)->withInput();
        }
        session()->forget('locations');

        // Registro de mascotas
        $pets = session('pets', []);
        foreach ($pets as $pet) {
            $race = Race::where('name',$pet['race'])->get()->first()->id ?? null;
            $other = $race ? null : $pet['race'];
            if (!Pet::create([
                'name' => $pet['name'],
                'species' => $pet['species'],
                'gender' => $pet['gender'],
                'race_id' => $race,
                'other_race' => $other,
                'birthdate' => $pet['birthdate'],
                'observation' => $pet['observation'],
                'customer_id' => $customer->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTPET)->withInput();
        }
        session()->forget('pets');

        // Retorno exitoso
        return Redirect::route('customers.index')->with('success', str_replace('value', $customer->code, self::MSG_SCS_CRTCST));
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
        $customer = Customer::find($id);
        
        if (!$customer) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDCST);

        if (session()->has('errors')) {
            $locations = session('locations', []);
            $pets = session('pets', []);
        }
        else {
            $locations = $pets = [];
            foreach ($customer->locations as $loc)
                $locations[] = [
                    'id' => $loc->id,
                    'address' => $loc->address,
                    'ubigeo' => Ubigeo::find($loc->ubigeo_id)->name ?? $loc->other_ubigeo,
                    'ref' => $loc->ref,
                    'lat' => $loc->lat,
                    'lng' => $loc->lng
                ];
            foreach ($customer->pets as $pet)
                $pets[] = [
                    'id' => $pet->id,
                    'name' => $pet->name,
                    'species' => $pet->species,
                    'gender' => $pet->gender,
                    'race' => Race::find($pet->race_id)->name ?? $pet->other_race,
                    'birthdate' => $pet->birthdate,
                    'observation' => $pet->observation
                ];
            session([
                'locations' => $locations,
                'pets' => $pets,
            ]);
        }
        return view('customers.edit', compact('customer','locations','pets'));
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
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:-18 years',
            'document_type_id' => 'required|integer|min:1',
            'document' => 'required|string|unique:customers,document,'.$id.',id,deleted_at,NULL|regex:/'.$request->doc_pattern.'/',
            'email' => 'nullable|email:rfc|unique:customers,email,'.$id.',id,deleted_at,NULL|max:50',
            'country_id' => 'required|integer|min:1',
            'mobile' => 'required|string|unique:customers,mobile,'.$id.',id,deleted_at,NULL|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
        ], $this->validationErrorMessages());

        // Registro del cliente
        $customer = Customer::find($id);

        if (!$customer)
            return Redirect::back()->with('error', self::MSG_NOT_FNDCST)->withInput();
        
        if (!$customer->update($request->all()))
            return Redirect::back()->with('error', self::MSG_ERR_UPDCST)->withInput();

        // Registro de lugares de entrega
        $locations = session('locations', []);
        foreach ($customer->locations as $loc)
            if (!self::inArray($loc->id, $locations))
                $loc->delete();

        foreach ($locations as $loc) {
            $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$loc['ubigeo'])->get()->first()->id ?? null;
            $other = $ubigeo ? null : $loc['ubigeo'];
            if ($loc['id']) { //Mascota actualmente registrado
                if (!Location::find($loc['id'])->update([
                    'address' => $loc['address'],
                    'ubigeo_id' => $ubigeo,
                    'other_ubigeo' => $other,
                    'ref' => $loc['ref'],
                    'lat' => $loc['lat'],
                    'lng' => $loc['lng'],
                    'customer_id' => $customer->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDLOC)->withInput();
            }
            else { //Mascota sin registrar
                if (!Location::create([
                    'address' => $loc['address'],
                    'ubigeo_id' => $ubigeo,
                    'other_ubigeo' => $other,
                    'ref' => $loc['ref'],
                    'lat' => $loc['lat'],
                    'lng' => $loc['lng'],
                    'customer_id' => $customer->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTLOC)->withInput();
            }
        }
        session()->forget('locations');

        // Registro de mascotas
        $pets = session('pets', []);
        foreach ($customer->pets as $pet)
            if (!self::inArray($pet->id, $pets))
                $pet->delete();

        foreach ($pets as $pet) {
            $race = Race::where('name',$pet['race'])->get()->first()->id ?? null;
            $other = $race ? null : $pet['race'];
            if ($pet['id']) { //Mascota actualmente registrado
                if (!Pet::find($pet['id'])->update([
                    'name' => $pet['name'],
                    'species' => $pet['species'],
                    'gender' => $pet['gender'],
                    'race_id' => $race,
                    'other_race' => $other,
                    'birthdate' => $pet['birthdate'],
                    'observation' => $pet['observation'],
                    'customer_id' => $customer->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDPET)->withInput();
            }
            else { //Mascota sin registrar
                if (!Pet::create([
                    'name' => $pet['name'],
                    'species' => $pet['species'],
                    'gender' => $pet['gender'],
                    'race_id' => $race,
                    'other_race' => $other,
                    'birthdate' => $pet['birthdate'],
                    'observation' => $pet['observation'],
                    'customer_id' => $customer->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTPET)->withInput();
            }
        }
        session()->forget('pets');

        // Retorno exitoso
        return Redirect::route('customers.index')->with('success',str_replace('value', $customer->code, self::MSG_SCS_UPDCST));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        
        if (!$customer) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDCST);

        foreach ($customer->locations as $loc)
            if (!$loc->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DELLOC);
                
        foreach ($customer->pets as $pet)
            if (!$pet->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DELPET);

        if (!$customer->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELCST);
        
        return Redirect::route('customers.index')->with('success',str_replace('value',$customer->code,self::MSG_SCS_DELCST));
    }

    public function getByDocument($doc)
    {
        $customers = Customer::select([
            'id', 'code', 'document', 'mobile', 'phone', 'email', 'name', 'lastname',
            DB::raw('concat(lastname,", ",name) as fullname')
        ])
        ->where('document',$doc)
        ->get();

        if (!count($customers)) return null;
        return $customers->first();
    }

    public function getByMobile($mob)
    {
        $customers = Customer::select([
            'id', 'code', 'document', 'mobile', 'phone', 'email', 'name', 'lastname',
            DB::raw('concat(lastname,", ",name) as fullname')
        ])
        ->where('mobile',$mob)
        ->get();

        if (!count($customers)) return null;
        return $customers->first();
    }

    public function searchByFilter(Request $request)
    {
        $code = $request->cust_code;
        $name = $request->cust_name;
        $document = $request->cust_doc;
        $mobile = $request->cust_mob;

        $customers = Customer::select([
            'customers.id', 'customers.code', 'customers.document',
            'customers.phone', 'customers.email', 'customers.name', 'customers.lastname',
            //DB::raw('document_types.name as documentType'),
            DB::raw('concat(customers.lastname,", ",customers.name) as fullname'),
            DB::raw('concat(countries.code," ",customers.mobile) as mobile')
        ])
        //->leftJoin('document_types','document_types.id','customers.document_type_id')
        ->leftJoin('countries','countries.id','customers.country_id')
        ->where(DB::raw('concat(ifnull(customers.name,"")," ",ifnull(customers.lastname,""))'),'like',"%$name%")
        ->where(DB::raw('ifnull(customers.code,"")'),'like',"%$code%")
        ->where(DB::raw('ifnull(customers.document,"")'),'like',"%$document%")
        ->where(DB::raw('ifnull(customers.mobile,"")'),'like',"%$mobile%")
        ->get();

        return json_encode($customers);
    }

    public function addLocation(Request $request) {
        $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$loc['ubigeo'])->get()->first()->id ?? null;
        $other = $ubigeo ? null : $loc['ubigeo'];
        if (!Location::create([
            'address' => $loc['address'],
            'ubigeo_id' => $ubigeo,
            'other_ubigeo' => $other,
            'ref' => $loc['ref'],
            'lat' => $loc['lat'],
            'lng' => $loc['lng'],
            'customer_id' => $customer->id
        ]))
            return Redirect::back()->with('error', self::MSG_ERR_CRTLOC)->withInput();
        
        return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFromSale(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:-18 years',
            'document_type_id' => 'required|integer|min:1',
            'document' => 'required|string|unique:customers,document,NULL,id,deleted_at,NULL|regex:/'.$request->doc_pattern.'/',
            'email' => 'nullable|email:rfc|unique:customers,email,NULL,id,deleted_at,NULL|max:50',
            'country_id' => 'required|integer|min:1',
            'mobile' => 'required|string|unique:customers,mobile,NULL,id,deleted_at,NULL|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
        ], $this->validationErrorMessages());
        
        // Registro del cliente
        $customer = Customer::create($request->all());
        if (!$customer)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_CRTCST]], 400);

        // Registro de lugares de entrega
        $locations = session('locations', []);
        foreach ($locations as $loc) {
            $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$loc['ubigeo'])->get()->first()->id ?? null;
            $other = $ubigeo ? null : $loc['ubigeo'];
            if (!Location::create([
                'address' => $loc['address'],
                'ubigeo_id' => $ubigeo,
                'other_ubigeo' => $other,
                'ref' => $loc['ref'],
                'lat' => $loc['lat'],
                'lng' => $loc['lng'],
                'customer_id' => $customer->id
            ]))
                return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_CRTLOC]], 400);
        }
        session()->forget('locations');

        // Registro de mascotas
        $pets = session('pets', []);
        foreach ($pets as $pet) {
            $race = Race::where('name',$pet['race'])->get()->first()->id ?? null;
            $other = $race ? null : $pet['race'];
            if (!Pet::create([
                'name' => $pet['name'],
                'species' => $pet['species'],
                'gender' => $pet['gender'],
                'race_id' => $race,
                'other_race' => $other,
                'birthdate' => $pet['birthdate'],
                'observation' => $pet['observation'],
                'customer_id' => $customer->id
            ]))
                return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_CRTPET]], 400);
        }
        session()->forget('pets');
        
        // Retorno exitoso
        $object = [
            'id' => $customer->id,
            'code' => $customer->code, 
            'name' => $customer->fullname,
            'document' => $customer->document,
            'phone' => $customer->phone,
            'email' => $customer->email, 
            'mobile' => $customer->codeMobile
        ];
        return Response::json(['success' => 'true', 'message' => str_replace('value', $customer->code, self::MSG_SCS_CRTCST), 'object' => $object], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getFromSale($id)
    {
        $customer = Customer::find($id);
        
        if (!$customer)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_NOT_FNDCST]], 400);

        $locations = $pets = [];
        foreach ($customer->locations as $loc)
            $locations[] = [
                'id' => $loc->id,
                'address' => $loc->address,
                'ubigeo' => Ubigeo::find($loc->ubigeo_id)->name ?? $loc->other_ubigeo,
                'ref' => $loc->ref,
                'lat' => $loc->lat,
                'lng' => $loc->lng
            ];
        foreach ($customer->pets as $pet)
            $pets[] = [
                'id' => $pet->id,
                'name' => $pet->name,
                'species' => $pet->species,
                'gender' => $pet->gender,
                'race' => Race::find($pet->race_id)->name ?? $pet->other_race,
                'birthdate' => $pet->birthdate,
                'observation' => $pet->observation
            ];
        $customer = [
            'id' => $customer->id,
            'code' => $customer->code,
            'name' => $customer->name,
            'lastname' => $customer->lastname,
            'birthdate' => $customer->birthdate,
            'document_type_id' => $customer->document_type_id,
            'document' => $customer->document,
            'email' => $customer->email,
            'country_id' => $customer->country_id,
            'mobile' => $customer->mobile,
            'phone' => $customer->phone,
            'locations' => $locations,
            'pets' => $pets
        ];
        session([
            'locations' => $locations,
            'pets' => $pets,
        ]);
        return json_encode($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFromSale(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|min:1',
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:-18 years',
            'document_type_id' => 'required|integer|min:1',
            'document' => 'required|string|unique:customers,document,'.$request->id.',id,deleted_at,NULL|regex:/'.$request->doc_pattern.'/',
            'email' => 'nullable|email:rfc|unique:customers,email,'.$request->id.',id,deleted_at,NULL|max:50',
            'country_id' => 'required|integer|min:1',
            'mobile' => 'required|string|unique:customers,mobile,'.$request->id.',id,deleted_at,NULL|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
        ], $this->validationErrorMessages());

        // Registro del cliente
        $customer = Customer::find($request->id);

        if (!$customer)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_NOT_FNDCST]], 400);
        
        if (!$customer->update($request->all()))
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_UPDCST]], 400);

        // Registro de lugares de entrega
        $locations = session('locations', []);
        foreach ($customer->locations as $loc)
            if (!self::inArray($loc->id, $locations))
                $loc->delete();

        foreach ($locations as $loc) {
            $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$loc['ubigeo'])->get()->first()->id ?? null;
            $other = $ubigeo ? null : $loc['ubigeo'];
            if ($loc['id']) { //Mascota actualmente registrado
                if (!Location::find($loc['id'])->update([
                    'address' => $loc['address'],
                    'ubigeo_id' => $ubigeo,
                    'other_ubigeo' => $other,
                    'ref' => $loc['ref'],
                    'lat' => $loc['lat'],
                    'lng' => $loc['lng'],
                    'customer_id' => $customer->id
                ]))
                    return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_UPDLOC]], 400);
            }
            else { //Mascota sin registrar
                if (!Location::create([
                    'address' => $loc['address'],
                    'ubigeo_id' => $ubigeo,
                    'other_ubigeo' => $other,
                    'ref' => $loc['ref'],
                    'lat' => $loc['lat'],
                    'lng' => $loc['lng'],
                    'customer_id' => $customer->id
                ]))
                    return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_CRTLOC]], 400);
            }
        }
        session()->forget('locations');

        // Registro de mascotas
        $pets = session('pets', []);
        foreach ($customer->pets as $pet)
            if (!self::inArray($pet->id, $pets))
                $pet->delete();

        foreach ($pets as $pet) {
            $race = Race::where('name',$pet['race'])->get()->first()->id ?? null;
            $other = $race ? null : $pet['race'];
            if ($pet['id']) { //Mascota actualmente registrado
                if (!Pet::find($pet['id'])->update([
                    'name' => $pet['name'],
                    'species' => $pet['species'],
                    'gender' => $pet['gender'],
                    'race_id' => $race,
                    'other_race' => $other,
                    'birthdate' => $pet['birthdate'],
                    'observation' => $pet['observation'],
                    'customer_id' => $customer->id
                ]))
                    return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_UPDPET]], 400);
            }
            else { //Mascota sin registrar
                if (!Pet::create([
                    'name' => $pet['name'],
                    'species' => $pet['species'],
                    'gender' => $pet['gender'],
                    'race_id' => $race,
                    'other_race' => $other,
                    'birthdate' => $pet['birthdate'],
                    'observation' => $pet['observation'],
                    'customer_id' => $customer->id
                ]))
                    return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_CRTPET]], 400);
            }
        }
        session()->forget('pets');

        // Retorno exitoso
        $object = [
            'id' => $customer->id,
            'code' => $customer->code, 
            'name' => $customer->fullname,
            'document' => $customer->document,
            'phone' => $customer->phone,
            'email' => $customer->email, 
            'mobile' => $customer->codeMobile
        ];
        return Response::json(['success' => 'true', 'message' => str_replace('value', $customer->code, self::MSG_SCS_UPDCST), 'object' => $object], 200);
    }

    protected function validationErrorMessages()
    {
        return [
            'id.required' => 'Debes ingresar obligatoriamente un ID de cliente.',
            'id.integer' => 'El ID de cliente ingresado no tiene un formato válido.',
            'id.min' => 'El ID de cliente ingresado no es válido.',

            'name.required' => 'Debes ingresar obligatoriamente un nombre.',
            'name.max' => 'El nombre no debe superar los cincuenta (50) caracteres.',

            'lastname.required' => 'Debes ingresar obligatoriamente un apellido.',
            'lastname.max' => 'El apellido no debe superar los cincuenta (50) caracteres.',
            
            'birthdate.date_format' => 'La fecha de nacimiento ingresada no tiene un formato válido.',
            'birthdate.before_or_equal' => 'La fecha de nacimiento ingresada no corresponde a una persona con mayoría de edad.',

            'document_type_id.required' => 'Debes ingresar obligatoriamente un tipo de documento.',
            'document_type_id.integer' => 'El ID del tipo de documento ingresado no tiene un formato válido.',
            'document_type_id.min' => 'El ID del tipo de documento ingresado no es válido.',

            'document.required' => 'Debes ingresar obligatoriamente un N° Documento.',
            'document.unique' => 'El N° Documento ingresado ya existe en el sistema.',
            'document.regex' => 'El N° Documento ingresado no corresponde al tipo de documento ingresado.',
         
            'email.unique' => 'El correo electrónico ingresado ya existe en el sistema.',
            'email.email' => 'El correo electrónico ingresado no tiene un formato válido.',
            'email.max' => 'El correo electrónico no debe superar los cincuenta (50) caracteres.',
        
            'country_id.required' => 'Debes ingresar obligatoriamente un código de país.',
            'country_id.integer' => 'El ID del código de país ingresado no tiene un formato válido.',
            'country_id.min' => 'El ID del código de país ingresado no es válido.',

            'mobile.required' => 'Debes ingresar obligatoriamente un celular.',
            'mobile.unique' => 'El celular ingresado ya existe en el sistema.',
            'mobile.regex' => 'El celular debe estar compuesto por nueve (9) dígitos.',
            
            'phone.regex' => 'El teléfono fijo debe estar compuesto por el código de ciudad seguido de seis (6) o siete (7) dígitos.',
        ];
    }
}
