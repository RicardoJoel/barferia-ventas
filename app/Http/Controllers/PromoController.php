<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PromoDetail;
use App\Product;
use App\Promo;
use Redirect;

class PromoController extends Controller
{
    protected const MSG_SCS_CRTPRM = 'Promoción con código value registrada de manera exitosa.';
    protected const MSG_ERR_CRTPRM = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar la promoción.';
    protected const MSG_SCS_UPDPRM = 'Promoción con código value actualizada de manera exitosa.';
    protected const MSG_ERR_UPDPRM = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar la promoción.';
    protected const MSG_SCS_DELPRM = 'Promoción con código value eliminada de manera exitosa.';
    protected const MSG_ERR_DELPRM = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar la promoción.';
    protected const MSG_NOT_FNDPRM = 'La promoción solicitada no ha sido encontrada.';
    
    protected const MSG_SCS_CRTDET = 'Detalle con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTDET = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar un detalle.';
    protected const MSG_SCS_UPDDET = 'Detalle con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDDET = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar un detalle.';
    protected const MSG_SCS_DELDET = 'Detalle con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELDET = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar un detalle.';
    protected const MSG_NOT_FNDDET = 'El detalle solicitado no ha sido encontrado.';
    
    protected const MSG_ERR_NODTLS = 'La promoción debe contar con, al menos, un producto relacionado.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promos = Promo::orderBy('code')->paginate(1000000);
        return view('promos.index', compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (session()->has('errors')) {
            $details = session('promdetails', []);
        }
        else {
            $details = [];
            session(['promdetails' => $details]);
        }
        return view('promos.create', compact('details'));
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
            'name' => 'required|max:100',
            'start_at' => 'required|date_format:Y-m-d',
            'end_at' => 'required|date_format:Y-m-d|after_or_equal:start_at',
            'type' => 'required|in:M,P',
            'amount' => 'required|numeric|min:0',
        ], self::validationErrorMessages());

        $details = session('promdetails', []);
        
        if (!count($details))
            return Redirect::back()->with('error', self::MSG_ERR_NODTLS)->withInput();

        $promo = Promo::create($request->all());

        if (!$promo)
            return Redirect::back()->with('error', self::MSG_ERR_CRTPRM)->withInput();

        // Registro de productos asociados
        foreach ($details as $det) {
            if (!PromoDetail::create([
                'product_id' => Product::where('code',$det['code'])->get()->first()->id ?? null,
                'quantity' => $det['quantity'],
                'promo_id' => $promo->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
        }
        session()->forget('promdetails');

        //Retorno exitoso
        return Redirect::route('promos.index')->with('success', str_replace('value', $promo->code, self::MSG_SCS_CRTPRM));
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
        $promo = Promo::find($id);
        
        if (!$promo) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRM);

        if (session()->has('errors')) {
            $details = session('promdetails', []);
        }
        else {
            $details = [];
            foreach ($promo->details as $det)
                $details[] = [
                    'id' => $det->id,
                    'code' => $det->product->code ?? 'TODOS',
                    'product' => $det->product->nameCode ?? 'Cualquier producto',
                    'quantity' => $det->quantity,
                    'price' => $det->product->price ?? 0,
                    'subtotal' => $det->subtotal
                ];
            session(['promdetails' => $details]);
        }
        return view('promos.edit', compact('promo','details'));
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
            'name' => 'required|max:100',
            'start_at' => 'required|date_format:Y-m-d',
            'end_at' => 'required|date_format:Y-m-d|after_or_equal:start_at',
            'type' => 'required|in:M,P',
            'amount' => 'required|numeric|min:0',
        ], self::validationErrorMessages());

        $details = session('promdetails', []);
        
        if (!count($details))
            return Redirect::back()->with('error', self::MSG_ERR_NODTLS)->withInput();

        $promo = Promo::find($id);

        if (!$promo)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRM)->withInput();
        
        if (!$promo->update($request->all()))
            return Redirect::back()->with('error', self::MSG_ERR_UPDPRM)->withInput();

        // Registro de productos asociados
        foreach ($promo->details as $det)
            if (!self::inArray($det->id, $details))
                $det->delete();
                
        foreach ($details as $det) {
            if ($det['id']) { //Detalle actualmente registrado
                if (!PromoDetail::find($det['id'])->update([
                    'product_id' => Product::where('code',$det['code'])->get()->first()->id ?? null,
                    'quantity' => $det['quantity'],
                    'promo_id' => $promo->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDDET)->withInput();
            }
            else { //Detalle sin registrar
                if (!PromoDetail::create([
                    'product_id' => Product::where('code',$det['code'])->get()->first()->id ?? null,
                    'quantity' => $det['quantity'],
                    'promo_id' => $promo->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
            }
        }
        session()->forget('promdetails');
                
        //Retorno exitoso
        return Redirect::route('promos.index')->with('success', str_replace('value', $promo->code, self::MSG_SCS_UPDPRM));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promo = Promo::find($id);
        
        if (!$promo) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRM);
        
        foreach ($promo->details as $det)
            if (!$det->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DELDET);

        if (!$promo->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELPRM);
        
        return Redirect::route('promos.index')->with('success',str_replace('value',$promo->code,self::MSG_SCS_DELPRM));
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'name.required' => 'Debes ingresar obligatoriamente un nombre.',
            'name.max' => 'El nombre no debe superar los cien (100) caracteres.',

            'start_at.required' => 'Debes ingresar obligatoriamente una fecha inicio.',
            'start_at.date_format' => 'La fecha inicio ingresada no tiene un formato válido.',

            'end_at.required' => 'Debes ingresar obligatoriamente una fecha fin.',
            'end_at.date_format' => 'La fecha fin ingresada no tiene un formato válido.',
            'end_at.after_or_equal' => 'La fecha fin no puede ser anterior a la fecha inicio.',
            
            'type.required' => 'Debes ingresar obligatoriamente un tipo de descuento.',
            'type.in' => 'El tipo de descuento ingresado no es válido.',

            'amount.required' => 'Debes ingresar obligatoriamente un monto o porcentaje de descuento.',
            'amount.numeric' => 'El monto o porcentaje de descuento ingresado no tiene un formato válido.',
            'amount.min' => 'El monto o porcentaje de descuento ingresado no es válido.',
        ];
    }
}