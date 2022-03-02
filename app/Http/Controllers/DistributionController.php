<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DistributionDetail;
use App\Distribution;
use App\Production;
use App\Inventory;
use App\Product;
use App\Center;
use Redirect;
use Auth;

class DistributionController extends Controller
{
    protected const MSG_SCS_CRTDST = 'Distribución con código value registrada de manera exitosa.';
    protected const MSG_ERR_CRTDST = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar la distribución.';
    protected const MSG_SCS_UPDDST = 'Distribución con código value actualizada de manera exitosa.';
    protected const MSG_ERR_UPDDST = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar la distribución.';
    protected const MSG_SCS_DELDST = 'Distribución con código value eliminada de manera exitosa.';
    protected const MSG_ERR_DELDST = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar la distribución.';
    protected const MSG_NOT_FNDDST = 'La distribución solicitada no ha sido encontrada.';

    protected const MSG_SCS_CRTDET = 'Detalle con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTDET = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar un detalle.';
    protected const MSG_SCS_UPDDET = 'Detalle con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDDET = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar un detalle.';
    protected const MSG_SCS_DELDET = 'Detalle con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELDET = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar un detalle.';
    protected const MSG_NOT_FNDDET = 'El detalle solicitado no ha sido encontrado.';
    
    protected const MSG_DIF_SHOPID = 'El centro de producción ingresado no corresponde a tu local actualmente asignado.';
    protected const MSG_NOT_EDITAB = 'La distribución solicitada se encuentra CONFIRMADA y no puede ser editada.';
    protected const MSG_NOT_DELETE = 'La distribución solicitada se encuentra CONFIRMADA y no puede ser eliminada.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_admin)
            $distributions = Distribution::orderBy('date')->paginate(1000000);
        else
            $distributions = Distribution::where('origin_id',Auth::user()->center_id)
                                         ->orderBy('date')->paginate(1000000);
        return view('distributions.index', compact('distributions'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('errors')) {
            $details = session('distdetails', []);
            $origins = session('distorigins', []);
            $destinies = session('distdestinies', []);
        }
        else {
            $details = $origins = $destinies = [];
            $products = Product::orderBy('name')->get();
            $listOrg = Center::where('type','F')->orderBy('name')->get();
            $listDst = Center::where('type','T')->orderBy('name')->get();
            //stock de productos en el origin
            foreach ($listOrg as $origin) {
                $lastProd = Production::select('productions.*')
                                    ->leftJoin('centers','centers.id','productions.center_id')
                                    ->where('productions.status','CONFIRMADA')
                                    ->where('centers.id',$origin->id)
                                    ->latest('date')
                                    ->first();
                if ($lastProd)
                    $lastDist = Distribution::select('distributions.*')
                                            ->leftJoin('centers','centers.id','distributions.origin_id')
                                            //->where('distributions.status','CONFIRMADA')
                                            ->where('centers.id',$origin->id)
                                            ->where('distributions.date','>',$lastProd->date)
                                            ->latest('date')
                                            ->first();
                else $lastDist = null;
                //lleno inventario de productos
                $origins[$origin->id] = self::inventory($products, $lastDist->details ?? ($lastProd->details ?? null));
            }
            //stock de productos en el destino
            foreach ($listDst as $destiny) {
                $lastInv = Inventory::select('inventories.*')
                                    ->leftJoin('centers','centers.id','inventories.center_id')
                                    ->where('inventories.status','CONFIRMADA')
                                    ->where('centers.id',$destiny->id)
                                    ->latest('date')
                                    ->first();
                //lleno inventario de productos
                $destinies[$destiny->id] = self::inventory($products, $lastInv->details ?? null);
            }
            //detalle de envíos por llenar
            $fstOrg = $listOrg->first()->id;
            $fstDst = $listDst->first()->id;
            foreach ($products as $product) {
                $details[] = [
                    'id' => '',
                    'product' => $product->name,
                    'openstock' => $origins[$fstOrg][$product->id]['stock'] ?? 0,
                    'opendestiny' => $destinies[$fstDst][$product->id]['stock'] ?? 0,
                    'quantity' => 0,
                    'received' => 0,
                    'returned' => 0,
                    'finalstock' => $origins[$fstOrg][$product->id]['stock'] ?? 0,
                    'finaldestiny' => $destinies[$fstDst][$product->id]['stock'] ?? 0,
                    'observation' => ''
                ];
            }
            session([
                'distdetails' => $details,
                'distorigins' => $origins,
                'distdestinies' => $destinies,
            ]);
        }
        return view('distributions.create', compact('details'));
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
            'origin_id' => 'required|integer|min:1',
            'destiny_id' => 'required|integer|min:1',
            'status' => 'required|string|in:SIN CONFIRMAR,CONFIRMADA',
        ], self::validationErrorMessages());

        if (!Auth::user()->is_admin && Auth::user()->center_id != $request->origin_id)
            return Redirect::back()->with('error', self::MSG_DIF_SHOPID)->withInput();

        $distribution = Distribution::create($request->all() + ['user_id' => Auth::user()->id]);
        
        if (!$distribution)
            return Redirect::back()->with('error', self::MSG_ERR_CRTDST)->withInput();

        // Registro de detalles
        $details = session('distdetails', []);
        foreach ($details as $det) {
            if (!DistributionDetail::create([
                'openstock' => $det['openstock'],
                'opendestiny' => $det['opendestiny'],
                'quantity' => $det['quantity'],
                //'received' => $det['received'],
                //'returned' => $det['returned'],
                'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                'distribution_id' => $distribution->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
        }
        session()->forget('distdetails');
        session()->forget('distorigins');
        session()->forget('distdestinies');
        
        //Retorno exitoso
        return Redirect::route('distributions.index')->with('success', str_replace('value', $distribution->code, self::MSG_SCS_CRTDST));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distribution = Distribution::find($id);
        
        if (!$distribution)
            return Redirect::back()->with('error', self::MSG_NOT_FNDDST);
        
        $details = [];
        foreach ($distribution->details as $det)
            $details[] = [
                'id' => $det->id,
                'product' => $det->product->name,
                'openstock' => $det->openstock,
                'opendestiny' => $det->opendestiny,
                'quantity' => $det->quantity,
                'received' => $det->received,
                'returned' => $det->returned,
                'finalstock' => $det->finalstock,
                'finaldestiny' => $det->finaldestiny,
                'observation' => $det->observation,
            ];
        self::sort($details,'product');
        return view('distributions.show', compact('distribution','details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $distribution = Distribution::find($id);
        
        if (!$distribution)
            return Redirect::back()->with('error', self::MSG_NOT_FNDDST);

        if ($distribution->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_EDITAB);
        
        if (session()->has('errors')) {
            $details = session('distdetails', []);
        }
        else {
            $details = $origins = $destinies = [];
            $products = Product::orderBy('name')->get();
            $listOrg = Center::where('type','F')->orderBy('name')->get();
            $listDst = Center::where('type','T')->orderBy('name')->get();
            //stock de productos en el origin
            foreach ($listOrg as $origin) {
                $lastProd = Production::select('productions.*')
                                    ->leftJoin('centers','centers.id','productions.center_id')
                                    ->where('productions.status','CONFIRMADA')
                                    ->where('centers.id',$origin->id)
                                    ->latest('date')
                                    ->first();
                if ($lastProd)
                    $lastDist = Distribution::select('distributions.*')
                                            ->leftJoin('centers','centers.id','distributions.origin_id')
                                            //->where('distributions.status','CONFIRMADA')
                                            ->where('centers.id',$origin->id)
                                            ->where('distributions.date','>',$lastProd->date)
                                            ->latest('date')
                                            ->first();
                else $lastDist = null;
                //lleno inventario de productos
                $origins[$origin->id] = self::inventory($products, $lastDist->details ?? ($lastProd->details ?? null));
            }
            //stock de productos en el destino
            foreach ($listDst as $destiny) {
                $lastInv = Inventory::select('inventories.*')
                                    ->leftJoin('centers','centers.id','inventories.center_id')
                                    ->where('inventories.status','CONFIRMADA')
                                    ->where('centers.id',$destiny->id)
                                    ->latest('date')
                                    ->first();
                //lleno inventario de productos
                $destinies[$destiny->id] = self::inventory($products, $lastInv->details ?? null);
            }
            //detalle de envíos por llenar
            foreach ($products as $product) {
                $prod_id = $product->id;
                $det = $distribution->details->filter(function($item) use ($prod_id) {
                    return $item->product_id == $prod_id;
                })->first();
                $details[] = [
                    'id' => $det->id ?? '',
                    'product' => $det->product->name ?? $product->name,
                    'openstock' => $det->openstock ?? 0,
                    'opendestiny' => $det->opendestiny ?? 0,
                    'quantity' => $det->quantity ?? 0,
                    'received' => $det->received ?? 0,
                    'returned' => $det->returned ?? 0,
                    'finalstock' => $det->finalstock ?? 0,
                    'finaldestiny' => $det->finaldestiny ?? 0,
                    'observation' => ''
                ];
            }
            session([
                'distdetails' => $details,
                'distorigins' => $origins,
                'distdestinies' => $destinies,
            ]);
        }
        return view('distributions.edit', compact('distribution','details'));
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
            'origin_id' => 'required|integer|min:1',
            'destiny_id' => 'required|integer|min:1',
            'status' => 'required|string|in:SIN CONFIRMAR,CONFIRMADA',
        ], self::validationErrorMessages());

        $distribution = Distribution::find($id);
        
        if (!$distribution)
            return Redirect::back()->with('error', self::MSG_NOT_FNDDST)->withInput();
        
        if ($distribution->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_EDITAB)->withInput();

        if (!Auth::user()->is_admin && Auth::user()->center_id != $request->origin_id)
            return Redirect::back()->with('error', self::MSG_DIF_SHOPID)->withInput();

        if (!$distribution->update($request->all() + ['user_id' => Auth::user()->id]))
            return Redirect::back()->with('error', self::MSG_ERR_UPDDST)->withInput();

        // Registro de detalles
        $details = session('distdetails', []);
        foreach ($distribution->details as $det)
            if (!self::inArray($det->id, $details))
                $det->delete();
                
        foreach ($details as $det) {
            if ($det['id']) { //Detalle actualmente registrado
                if (!DistributionDetail::find($det['id'])->update([
                    'openstock' => $det['openstock'],
                    'opendestiny' => $det['opendestiny'],
                    'quantity' => $det['quantity'],
                    //'received' => $det['received'],
                    //'returned' => $det['returned'],
                    'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                    'distribution_id' => $distribution->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDDET)->withInput();
            }
            else { //Detalle sin registrar
                if (!DistributionDetail::create([
                    'openstock' => $det['openstock'],
                    'opendestiny' => $det['opendestiny'],
                    'quantity' => $det['quantity'],
                    //'received' => $det['received'],
                    //'returned' => $det['returned'],
                    'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                    'distribution_id' => $distribution->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
            }
        }
        session()->forget('distdetails');
        session()->forget('distorigins');
        session()->forget('distdestinies');

        //Retorno exitoso
        return Redirect::route('distributions.index')->with('success',str_replace('value', $distribution->code, self::MSG_SCS_UPDDST));        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $distribution = Distribution::find($id);
        
        if (!$distribution) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDDST);
        
        if ($distribution->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_DELETE);

        foreach ($distribution->details as $det)
            if (!$det->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DELDET);

        if (!$distribution->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELDST);
        
        return Redirect::route('distributions.index')->with('success',str_replace('value',$distribution->code,self::MSG_SCS_DELDST));
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'date.required' => 'Debes ingresar obligatoriamente una fecha y hora de envío.',
            'date.date' => 'La fecha y hora de envío ingresada no tiene un formato válido.',

            'origin_id.required' => 'Debes ingresar obligatoriamente un origin.',
            'origin_id.integer' => 'El ID del origin ingresado no tiene un formato válido.',
            'origin_id.min' => 'El ID del origin ingresado no es válido.',

            'destiny_id.required' => 'Debes ingresar obligatoriamente un destino.',
            'destiny_id.integer' => 'El ID del destino ingresado no tiene un formato válido.',
            'destiny_id.min' => 'El ID del destino ingresado no es válido.',

            'status.required' => 'Debes ingresar obligatoriamente un estado.',
            'status.in' => 'El estado ingresado no es válido.',
        ];
    }
}
