<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Ubigeo;
use Redirect;
use DB;

class SupplierController extends Controller
{
    protected const MSG_SCS_CRTSPL = 'Proveedor con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTSPL = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el proveedor.';
    protected const MSG_SCS_UPDSPL = 'Proveedor con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDSPL = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el proveedor.';
    protected const MSG_SCS_DELSPL = 'Proveedor con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELSPL = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar el proveedor.';
    protected const MSG_NOT_FNDSPL = 'El proveedor solicitado no ha sido encontrado.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('code')->paginate(1000000);
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
            'name' => 'required|string|max:100',
            'profile_id' => 'required|integer|min:1',
            'document_type_id' => 'required|integer|min:1',
            'document' => 'required|string|unique:suppliers,document,NULL,id,deleted_at,NULL|regex:/'.$request->doc_pattern.'/',
            'other_profile' => 'nullable|string|max:100',
            'address' => 'required|string|max:100',
            'ubigeo' => 'required|string|max:300',
            'country_id' => 'required|integer|min:1',
            'mobile' => 'required|string|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            'annex' => 'nullable|string|regex:/[0-9]{4,6}/',
            'email' => 'nullable|email:rfc|max:50',
            'bank_id' => 'nullable|integer|min:1',
            'account' => 'nullable|string|max:20',
            'cci' => 'nullable|string|max:23',
        ], $this->validationErrorMessages());

        $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->ubigeo)->get()->first()->id ?? null;
        $other = $ubigeo ? null : $request->ubigeo;

        $supplier = Supplier::create($request->all() + ['ubigeo_id' => $ubigeo, 'other_ubigeo' => $other]);
        
        if (!$supplier)
            return Redirect::back()->with('error', self::MSG_ERR_CRTSPL)->withInput();

        return Redirect::route('suppliers.index')->with('success', str_replace('value', $supplier->code, self::MSG_SCS_CRTSPL));
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
        $supplier = Supplier::find($id);
        
        if (!$supplier) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDSPL);

        return view('suppliers.edit', compact('supplier'));
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
            'name' => 'required|string|max:100',
            'profile_id' => 'required|integer|min:1',
            'document_type_id' => 'required|integer|min:1',
            'document' => 'required|string|unique:suppliers,document,'.$id.',id,deleted_at,NULL|regex:/'.$request->doc_pattern.'/',
            'other_profile' => 'nullable|string|max:100',
            'address' => 'required|string|max:100',
            'ubigeo' => 'required|string|max:300',
            'country_id' => 'required|integer|min:1',
            'mobile' => 'required|string|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            'annex' => 'nullable|string|regex:/[0-9]{4,6}/',
            'email' => 'nullable|email:rfc|max:50',
            'bank_id' => 'nullable|integer|min:1',
            'account' => 'nullable|string|max:20',
            'cci' => 'nullable|string|max:23',
        ], $this->validationErrorMessages());

        $supplier = Supplier::find($id);
        
        if (!$supplier)
            return Redirect::back()->with('error', self::MSG_NOT_FNDSPL)->withInput();
        
        $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->ubigeo)->get()->first()->id ?? null;
        $other = $ubigeo ? null : $request->ubigeo;

        if (!$supplier->update($request->all() + ['ubigeo_id' => $ubigeo, 'other_ubigeo' => $other]))
            return Redirect::back()->with('error', self::MSG_ERR_UPDSPL)->withInput();

        return Redirect::route('suppliers.index')->with('success',str_replace('value', $supplier->code, self::MSG_SCS_UPDSPL));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        
        if (!$supplier) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDSPL);

        if (!$supplier->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELSPL);
        
        return Redirect::route('suppliers.index')->with('success',str_replace('value',$supplier->code,self::MSG_SCS_DELSPL));
    }

    public function getByDocument($ruc) {
        $suppliers = Supplier::where('ruc',$ruc)->get(['id','code','ruc','name']);
        if (!count($suppliers)) return null;
        return $suppliers->first();
    }

    public function searchByFilter(Request $request) {
        $ruc = $request->cust_ruc;
        $code = $request->cust_code;
        $name = $request->cust_name;
        $alias = $request->cust_alias;
        $business_id = $request->cust_business_id;

        $suppliers = Supplier::select([
            DB::raw('suppliers.id as id'),
            DB::raw('suppliers.ruc as ruc'),
            DB::raw('suppliers.code as code'),
            DB::raw('suppliers.name as name'),
            DB::raw('suppliers.alias as alias'),
            DB::raw('bussiness.name as business')
        ])
        ->leftJoin('bussiness','bussiness.id','suppliers.business_id')
        ->where(DB::raw('ifnull(suppliers.ruc,"")'),'like','%'.$ruc.'%')
        ->where(DB::raw('ifnull(suppliers.code,"")'),'like','%'.$code.'%')
        ->where(DB::raw('ifnull(suppliers.name,"")'),'like','%'.$name.'%')
        ->where(DB::raw('ifnull(suppliers.alias,"")'),'like','%'.$alias.'%')
        ->where(function ($query) use ($business_id) {
            if ($business_id)
                $query->where('suppliers.business_id',$business_id);
            return $query;
        })
        ->get();

        return json_encode($suppliers);
    }

    protected function validationErrorMessages()
    {
        return [
            'name.required' => 'Debes ingresar obligatoriamente un nombre o razón social.',
            'name.max' => 'El nombre o razón social debe tener un máximo de cien (100) caracteres.',
            
            'profile_id.required' => 'Debes ingresar obligatoriamente un servicio.',
            'profile_id.integer' => 'El ID del servicio ingresado no tiene un formato válido.',
            'profile_id.min' => 'El ID del servicio ingresado es inválido.',

            'document_type_id.required' => 'Debes ingresar obligatoriamente un tipo de documento.',
            'document_type_id.integer' => 'El ID del tipo de documento ingresado no tiene un formato válido.',
            'document_type_id.min' => 'El ID del tipo de documento ingresado es inválido.',

            'document.required' => 'Debes ingresar obligatoriamente un N° Documento.',
            'document.unique' => 'El N° Documento ingresado ya existe en el sistema.',
            'document.regex' => 'El N° Documento ingresado no corresponde al tipo de documento ingresado.',

            'other_profile.max' => 'Para especificar otro servicio debes ingresar como máximo cien (100) caracteres.',

            'address.required' => 'Debes ingresar obligatoriamente una dirección de facturación.',
            'address.max' => 'La dirección de facturación debe tener un máximo de cien (100) caracteres.',

            'ubigeo.required' => 'Debes ingresar obligatoriamente un departamento / provincia / distrito de facturación.',
            'ubigeo.max' => 'El departamento / provincia / distrito de facturación no debe superar los trescientos (300) caracteres.',

            'country_id.required' => 'Debes ingresar obligatoriamente un código de país.',
            'country_id.integer' => 'El ID del código de país ingresado no tiene un formato válido.',
            'country_id.min' => 'El ID del código de país ingresado es inválido.',

            'mobile.required' => 'Debes ingresar obligatoriamente un celular.',
            'mobile.regex' => 'El celular debe estar compuesto por nueve (9) dígitos.',            
            'phone.regex' => 'El teléfono fijo debe estar compuesto por el código de ciudad seguido de seis (6) o siete (7) dígitos.',
            'annex.regex' => 'El anexo debe tener entre cuatro (4) y seis (6) dígitos.',
            
            'email.email' => 'El correo electrónico ingresado no tiene un formato válido.',
            'email.max' => 'El correo electrónico debe tener un máximo de cincuenta (50) caracteres.',

            'bank_id.integer' => 'El ID de la entidad bancaria no tiene un formato válido.',
            'bank_id.min' => 'El ID de la entidad bancaria ingresada es inválido.',
            'account.max' => 'El N° Cuenta debe tener veinte (20) caracteres.',
            'cci.max' => 'El Código de Cuenta Interbancario debe tener veintitrés (23) caracteres.',
        ];
    }
}