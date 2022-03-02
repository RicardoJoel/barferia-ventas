<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventoryDetail;
use App\Inventory;
use App\Reception;
use App\Product;
use App\Center;
use App\Sale;
use Redirect;
use Auth;

class InventoryController extends Controller
{
    protected const MSG_SCS_CRTINV = 'Inventario con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTINV = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el inventario.';
    protected const MSG_SCS_UPDINV = 'Inventario con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDINV = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el inventario.';
    protected const MSG_SCS_DELINV = 'Inventario con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELINV = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar el inventario.';
    protected const MSG_NOT_FNDINV = 'El inventario solicitado no ha sido encontrado.';

    protected const MSG_SCS_CRTDET = 'Detalle con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTDET = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar un detalle.';
    protected const MSG_SCS_UPDDET = 'Detalle con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDDET = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar un detalle.';
    protected const MSG_SCS_DELDET = 'Detalle con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELDET = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar un detalle.';
    protected const MSG_NOT_FNDDET = 'El detalle solicitado no ha sido encontrado.';
    
    protected const MSG_DIF_SHOPID = 'La tienda ingresada no corresponde a tu tienda actualmente asociada.';
    protected const MSG_OPN_INVENT = 'La tienda ingresada tiene inventarios en estado SIN CONFIRMAR. Para crear uno nuevo, antes debes cerrarlos.';
    protected const MSG_NOT_EDITAB = 'El inventario solicitado se encuentra CONFIRMADO y no puede ser editado.';
    protected const MSG_NOT_DELETE = 'El inventario solicitado se encuentra CONFIRMADO y no puede ser eliminado.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_admin)
            $inventories = Inventory::orderBy('date')->paginate(1000000);
        else
            $inventories = Inventory::where('center_id',Auth::user()->center_id)
                                    ->orderBy('date')->paginate(1000000);
        return view('inventories.index', compact('inventories'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('errors')) {
            $details = session('invdetails', []);
            $centers = session('invcenters', []);
        }
        else {
            $details = $centers = [];
            $products = Product::orderBy('name')->get();
            $listCtr = Center::orderBy('name')->get();
            //stock de productos en cada local
            foreach ($listCtr as $center) {
                $lastInv = Inventory::where('inventories.status','CONFIRMADA')
                                    ->where('inventories.center_id',$center->id)
                                    ->latest('date')
                                    ->first();
                $lastRec = Reception::select('receptions.*')
                                    ->leftJoin('distributions','distributions.id','receptions.distribution_id')
                                    ->where('receptions.status','CONFIRMADA')
                                    ->where('distributions.destiny_id',$center->id)
                                    ->where(function ($query) use ($lastInv) {
                                        if ($lastInv)
                                            $query->where('receptions.date','>',$lastInv->date);
                                        return $query;
                                    })
                                    ->latest('date')
                                    ->first();
                $lastSal = Sale::/*where('sales.status','PAGADA')
                                ->*/where('sales.center_id',$center->id)
                                ->where(function ($query) use ($lastInv) {
                                    if ($lastInv)
                                        $query->where('sales.happened_at','>',$lastInv->date);
                                    return $query;
                                })
                                ->get();
                //lleno inventario de productos
                $centers[$center->id] = self::inventory2($products, $lastInv->details ?? null, $lastRec->distribution->details ?? null, $lastSal);
            }
            //detalle de inventarios por llenar
            $fstCtr = $listCtr->first()->id;
            foreach ($products as $product) {
                $open = $centers[$fstCtr][$product->id]['stock'] ?? 0;
                $entr = $centers[$fstCtr][$product->id]['entry'] ?? 0;
                $exit = $centers[$fstCtr][$product->id]['exit'] ?? 0;
                $details[] = [
                    'id' => '',
                    'product' => $product->name,
                    'openstock' => $open,
                    'entry' => $entr,
                    'exit' => $exit,
                    'returned' => 0,
                    'removed' => 0,
                    'finalstock' => $open + $entr - $exit
                ];
            }
            session([
                'invdetails' => $details,
                'invcenters' => $centers,
            ]);
        }
        return view('inventories.create', compact('details'));
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
        
        if (Inventory::where('center_id',$request->center_id)->where('status','SIN CONFIRMAR')->count())
            return Redirect::back()->with('error', self::MSG_OPN_INVENT)->withInput();

        $inventory = Inventory::create($request->all() + ['user_id' => Auth::user()->id]);
        
        if (!$inventory)
            return Redirect::back()->with('error', self::MSG_ERR_CRTINV)->withInput();

        // Registro de detalles
        $details = session('invdetails', []);
        foreach ($details as $det) {
            if (!InventoryDetail::create([
                'openstock' => $det['openstock'],
                'entry' => $det['entry'],
                'exit' => $det['exit'],
                'returned' => $det['returned'],
                'removed' => $det['removed'],
                'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                'inventory_id' => $inventory->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
        }
        session()->forget('invdetails');

        //Retorno exitoso
        return Redirect::route('inventories.index')->with('success', str_replace('value', $inventory->code, self::MSG_SCS_CRTINV));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::find($id);
        
        if (!$inventory)
            return Redirect::back()->with('error', self::MSG_NOT_FNDINV);
        
        $details = [];
        foreach ($inventory->details as $det)
            $details[] = [
                'id' => $det->id,
                'product' => $det->product->name,
                'openstock' => $det->openstock,
                'entry' => $det->entry,
                'exit' => $det->exit,
                'returned' => $det->returned,
                'removed' => $det->removed,
                'finalstock' => $det->finalstock,
            ];
        self::sort($details,'product');
        return view('inventories.show', compact('inventory','details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        
        if (!$inventory)
            return Redirect::back()->with('error', self::MSG_NOT_FNDINV);

        if ($inventory->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_EDITAB);
        
        if (session()->has('errors')) {
            $details = session('invdetails', []);
        }
        else {
            $details = [];
            $products = Product::orderBy('name')->get();
            foreach ($products as $product) {
                $prod_id = $product->id;
                $det = $inventory->details->filter(function($item) use ($prod_id) {
                    return $item->product_id == $prod_id;
                })->first();
                if ($det)
                    $details[] = [
                        'id' => $det->id,
                        'product' => $det->product->name,
                        'openstock' => $det->openstock,
                        'entry' => $det->entry,
                        'exit' => $det->exit,
                        'returned' => $det->returned,
                        'removed' => $det->removed,
                        'finalstock' => $det->finalstock,
                    ];
                else
                    $details[] = [
                        'id' => '',
                        'product' => $product->name,
                        'openstock' => 0,
                        'entry' => 0,
                        'exit' => 0,
                        'returned' => 0,
                        'removed' => 0,
                        'finalstock' => 0,
                    ];
            }
            session(['invdetails' => $details]);
        }
        return view('inventories.edit', compact('inventory','details'));
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

        $inventory = Inventory::find($id);
        
        if (!$inventory)
            return Redirect::back()->with('error', self::MSG_NOT_FNDINV)->withInput();
        
        if ($inventory->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_EDITAB)->withInput();

        if (!Auth::user()->is_admin && Auth::user()->center_id != $request->center_id)
            return Redirect::back()->with('error', self::MSG_DIF_SHOPID)->withInput();

        if (Inventory::where('center_id',$request->center_id)->where('id','!=',$id)->where('status','SIN CONFIRMAR')->count())
            return Redirect::back()->with('error', self::MSG_OPN_INVENT)->withInput();

        if (!$inventory->update($request->all() + ['user_id' => Auth::user()->id]))
            return Redirect::back()->with('error', self::MSG_ERR_UPDINV)->withInput();

        // Registro de detalles
        $details = session('invdetails', []);
        foreach ($inventory->details as $det)
            if (!self::inArray($det->id, $details))
                $det->delete();
                
        foreach ($details as $det) {
            if ($det['id']) { //Detalle actualmente registrado
                if (!InventoryDetail::find($det['id'])->update([
                    'openstock' => $det['openstock'],
                    'entry' => $det['entry'],
                    'exit' => $det['exit'],
                    'returned' => $det['returned'],
                    'removed' => $det['removed'],
                    'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                    'inventory_id' => $inventory->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDDET)->withInput();
            }
            else { //Detalle sin registrar
                if (!InventoryDetail::create([
                    'openstock' => $det['openstock'],
                    'entry' => $det['entry'],
                    'exit' => $det['exit'],
                    'returned' => $det['returned'],
                    'removed' => $det['removed'],
                    'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                    'inventory_id' => $inventory->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
            }
        }
        session()->forget('invdetails');

        //Retorno exitoso
        return Redirect::route('inventories.index')->with('success',str_replace('value', $inventory->code, self::MSG_SCS_UPDINV));        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        
        if (!$inventory) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDINV);
        
        if ($inventory->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_DELETE);

        foreach ($inventory->details as $det)
            if (!$det->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DELDET);

        if (!$inventory->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELINV);
        
        return Redirect::route('inventories.index')->with('success',str_replace('value',$inventory->code,self::MSG_SCS_DELINV));
    }

    protected function inventory2($products, $invdetails, $recdetails, $sales) {
        $inventory = [];
        foreach ($products as $product) {
            $prod_id = $product->id;
            $exit = 0;
            if ($invdetails) {
                $inv = $invdetails->filter(function($item) use ($prod_id) {
                    return $item->product_id == $prod_id;
                })->first();
            }
            if ($recdetails) {
                $rec = $recdetails->filter(function($item) use ($prod_id) {
                    return $item->product_id == $prod_id;
                })->first();
            }
            foreach ($sales as $sale) {
                foreach ($sale->details as $detail) {
                    //En caso sea producto
                    if ($detail->product && $detail->product_id == $prod_id) {
                        $exit += $detail->quantity;
                    }
                    //En caso sea promoción
                    else if ($detail->promo) {
                        $cho = $detail->choices->filter(function($item) use ($prod_id) {
                            return $item->product_id == $prod_id;
                        })->first();
                        $exit += $detail->quantity * ($cho->quantity ?? 0);
                    }
                }
            }
            $inventory[$product->id] = [
                'product' => $product->name,
                'stock' => $inv->finalstock ?? 0,
                'entry' => $rec->received ?? 0,
                'exit' => $exit,
            ];
        }
        return $inventory;
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

            'center_id.required' => 'Debes ingresar obligatoriamente una tienda.',
            'center_id.integer' => 'El ID de tienda ingresado no tiene un formato válido.',
            'center_id.min' => 'El ID de tienda ingresado no es válido.',

            'status.required' => 'Debes ingresar obligatoriamente un estado.',
            'status.in' => 'El estado ingresado no es válido.',
        ];
    }
}
