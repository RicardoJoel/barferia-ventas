<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductionDetail;
use App\Distribution;
use App\Production;
use App\Product;
use App\Center;
use Redirect;
use Auth;

class ProductionController extends Controller
{
    protected const MSG_SCS_CRTPRD = 'Producción con código value registrada de manera exitosa.';
    protected const MSG_ERR_CRTPRD = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar la producción.';
    protected const MSG_SCS_UPDPRD = 'Producción con código value actualizada de manera exitosa.';
    protected const MSG_ERR_UPDPRD = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar la producción.';
    protected const MSG_SCS_DELPRD = 'Producción con código value eliminada de manera exitosa.';
    protected const MSG_ERR_DELPRD = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar la producción.';
    protected const MSG_NOT_FNDPRD = 'La producción solicitada no ha sido encontrada.';

    protected const MSG_SCS_CRTDET = 'Detalle con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTDET = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar un detalle.';
    protected const MSG_SCS_UPDDET = 'Detalle con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDDET = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar un detalle.';
    protected const MSG_SCS_DELDET = 'Detalle con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELDET = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar un detalle.';
    protected const MSG_NOT_FNDDET = 'El detalle solicitado no ha sido encontrado.';
    
    protected const MSG_DIF_SHOPID = 'El centro de producción ingresado no corresponde a tu local actualmente asignado.';
    protected const MSG_OPN_INVENT = 'El local ingresado tiene producciones en estado SIN CONFIRMAR, las cuales deben ser cerradas antes de ingresar una nueva.';
    protected const MSG_NOT_EDITAB = 'La producción solicitada se encuentra CONFIRMADA y no puede ser editada.';
    protected const MSG_NOT_DELETE = 'La producción solicitada se encuentra CONFIRMADA y no puede ser eliminada.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_admin)
            $productions = Production::orderBy('date')->paginate(1000000);
        else
            $productions = Production::where('center_id',Auth::user()->center_id)
                                     ->orderBy('date')->paginate(1000000);
        return view('productions.index', compact('productions'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('errors')) {
            $details = session('proddetails', []);
            $centers = session('prodcenters', []);
        }
        else {
            $details = $centers = [];
            $products = Product::orderBy('name')->get();
            $listCtr = Center::where('type','F')->orderBy('name')->get();
            //stock de productos en cada planta
            foreach ($listCtr as $center) {
                $lastProd = Production::select('productions.*')
                                    ->leftJoin('centers','centers.id','productions.center_id')
                                    ->where('productions.status','CONFIRMADA')
                                    ->where('centers.id',$center->id)
                                    ->latest('date')
                                    ->first();
                if ($lastProd)
                    $lastDist = Distribution::select('distributions.*')
                                            ->leftJoin('centers','centers.id','distributions.origin_id')
                                            ->where('distributions.status','CONFIRMADA')
                                            ->where('centers.id',$center->id)
                                            ->where('distributions.date','>',$lastProd->date)
                                            ->latest('date')
                                            ->first();
                else $lastDist = null;
                //lleno inventario de productos
                $centers[$center->id] = self::inventory($products, $lastDist->details ?? ($lastProd->details ?? null));
            }
            //detalle de producción por llenar
            $fstCtr = $listCtr->first()->id;
            foreach ($products as $product) {
                $details[] = [
                    'id' => '',
                    'batch' => '',
                    'product' => $product->name,
                    'openstock' => $centers[$fstCtr][$product->id]['stock'] ?? 0,
                    'quantity' => 0,
                    'removed' => 0,
                    'finalstock' => $centers[$fstCtr][$product->id]['stock'] ?? 0,
                ];
            }
            session([
                'proddetails' => $details,
                'prodcenters' => $centers
            ]);
        }
        return view('productions.create', compact('details'));
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
            'date' => 'required|date',
            'center_id' => 'required|integer|min:1',
            'status' => 'required|string|in:SIN CONFIRMAR,CONFIRMADA',
        ], self::validationErrorMessages());

        if (!Auth::user()->is_admin && Auth::user()->center_id != $request->center_id)
            return Redirect::back()->with('error', self::MSG_DIF_SHOPID)->withInput();
        
        if (Production::where('center_id',$request->center_id)->where('status','SIN CONFIRMAR')->count())
            return Redirect::back()->with('error', self::MSG_OPN_INVENT)->withInput();

        $production = Production::create($request->all() + ['user_id' => Auth::user()->id]);
        
        if (!$production)
            return Redirect::back()->with('error', self::MSG_ERR_CRTPRD)->withInput();

        // Registro de detalles
        $details = session('proddetails', []);
        foreach ($details as $det) {
            if (!ProductionDetail::create([
                'batch' => $det['batch'],
                'openstock' => $det['openstock'],
                'quantity' => $det['quantity'],
                'removed' => $det['removed'],
                'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                'production_id' => $production->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
        }
        session()->forget('proddetails');
        session()->forget('prodcenters');

        //Retorno exitoso
        return Redirect::route('productions.index')->with('success', str_replace('value', $production->code, self::MSG_SCS_CRTPRD));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $production = Production::find($id);
        
        if (!$production)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRD);
        
        $details = [];
        foreach ($production->details as $det)
            $details[] = [
                'id' => $det->id,
                'batch' => $det->batch,
                'product' => $det->product->name,
                'openstock' => $det->openstock,
                'quantity' => $det->quantity,
                'removed' => $det->removed,
                'finalstock' => $det->finalstock,
            ];
        self::sort($details,'product');
        return view('productions.show', compact('production','details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $production = Production::find($id);
        
        if (!$production)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRD);

        if ($production->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_EDITAB);
        
        if (session()->has('errors')) {
            $details = session('proddetails', []);
        }
        else {
            $details = $centers = [];
            $products = Product::orderBy('name')->get();
            $listCtr = Center::where('type','F')->orderBy('name')->get();
            //stock de productos en cada planta
            foreach ($listCtr as $center) {
                $lastProd = Production::select('productions.*')
                                    ->leftJoin('centers','centers.id','productions.center_id')
                                    ->where('productions.status','CONFIRMADA')
                                    ->where('centers.id',$center->id)
                                    ->latest('date')
                                    ->first();
                if ($lastProd)
                    $lastDist = Distribution::select('distributions.*')
                                            ->leftJoin('centers','centers.id','distributions.origin_id')
                                            ->where('distributions.status','CONFIRMADA')
                                            ->where('centers.id',$center->id)
                                            ->where('distributions.date','>',$lastProd->date)
                                            ->latest('date')
                                            ->first();
                else $lastDist = null;
                //lleno inventario de productos
                $centers[$center->id] = self::inventory($products, $lastDist->details ?? ($lastProd->details ?? null));
            }
            //detalle de producción por llenar
            foreach ($products as $product) {
                $prod_id = $product->id;
                $det = $production->details->filter(function($item) use ($prod_id) {
                    return $item->product_id == $prod_id;
                })->first();
                $details[] = [
                    'id' => $det->id ?? '',
                    'batch' => $det->batch ?? '',
                    'product' => $det->product->name ?? $product->name,
                    'openstock' => $det->openstock ?? 0,
                    'quantity' => $det->quantity ?? 0,
                    'removed' => $det->removed ?? 0,
                    'finalstock' => $det->finalstock ?? 0,
                ];
            }
            session([
                'proddetails' => $details,
                'prodcenters' => $centers
            ]);
        }
        return view('productions.edit', compact('production','details'));
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
            'date' => 'required|date',
            'center_id' => 'required|integer|min:1',
            'status' => 'required|string|in:SIN CONFIRMAR,CONFIRMADA',
        ], self::validationErrorMessages());

        $production = Production::find($id);
        
        if (!$production)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRD)->withInput();
        
        if ($production->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_EDITAB)->withInput();

        if (!Auth::user()->is_admin && Auth::user()->center_id != $request->center_id)
            return Redirect::back()->with('error', self::MSG_DIF_SHOPID)->withInput();

        if (Production::where('center_id',$request->center_id)->where('id','!=',$id)->where('status','SIN CONFIRMAR')->count())
            return Redirect::back()->with('error', self::MSG_OPN_INVENT)->withInput();

        if (!$production->update($request->all() + ['user_id' => Auth::user()->id]))
            return Redirect::back()->with('error', self::MSG_ERR_UPDPRD)->withInput();

        // Registro de detalles
        $details = session('proddetails', []);
        foreach ($production->details as $det)
            if (!self::inArray($det->id, $details))
                $det->delete();
                
        foreach ($details as $det) {
            if ($det['id']) { //Detalle actualmente registrado
                if (!ProductionDetail::find($det['id'])->update([
                    'batch' => $det['batch'],
                    'openstock' => $det['openstock'],
                    'quantity' => $det['quantity'],
                    'removed' => $det['removed'],
                    'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                    'production_id' => $production->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDDET)->withInput();
            }
            else { //Detalle sin registrar
                if (!ProductionDetail::create([
                    'batch' => $det['batch'],
                    'openstock' => $det['openstock'],
                    'quantity' => $det['quantity'],
                    'removed' => $det['removed'],
                    'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                    'production_id' => $production->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
            }
        }
        session()->forget('proddetails');
        session()->forget('prodcenters');

        //Retorno exitoso
        return Redirect::route('productions.index')->with('success',str_replace('value', $production->code, self::MSG_SCS_UPDPRD));        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $production = Production::find($id);
        
        if (!$production) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRD);
        
        if ($production->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_DELETE);

        foreach ($production->details as $det)
            if (!$det->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DELDET);

        if (!$production->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELPRD);
        
        return Redirect::route('productions.index')->with('success',str_replace('value',$production->code,self::MSG_SCS_DELPRD));
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'date.required' => 'Debes ingresar obligatoriamente una fecha y hora de cierre.',
            'date.date' => 'La fecha y hora de cierre ingresada no tiene un formato válido.',

            'center_id.required' => 'Debes ingresar obligatoriamente un centro de producción.',
            'center_id.integer' => 'El ID del centro de producción ingresado no tiene un formato válido.',
            'center_id.min' => 'El ID del centro de producción ingresado no es válido.',

            'status.required' => 'Debes ingresar obligatoriamente un estado.',
            'status.in' => 'El estado ingresado no es válido.',
        ];
    }
}
