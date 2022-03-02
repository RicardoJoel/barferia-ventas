<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReceptionDetail;
use App\StockDetail;
use App\Reception;
use App\Distribution;
use App\Production;
use App\Inventory;
use App\Product;
use App\Center;
use App\Stock;
use Redirect;
use Auth;

class ReceptionController extends Controller
{
    protected const MSG_SCS_CRTRCP = 'Recepción con código value registrada de manera exitosa.';
    protected const MSG_ERR_CRTRCP = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar la recepción.';
    protected const MSG_SCS_UPDRCP = 'Recepción con código value actualizada de manera exitosa.';
    protected const MSG_ERR_UPDRCP = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar la recepción.';
    protected const MSG_SCS_DELRCP = 'Recepción con código value eliminada de manera exitosa.';
    protected const MSG_ERR_DELRCP = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar la recepción.';
    protected const MSG_NOT_FNDRCP = 'La recepción solicitada no ha sido encontrada.';
    protected const MSG_NOT_FNDDST = 'Código de distribución erróneo o ya verificado.';

    protected const MSG_SCS_CRTDET = 'Detalle con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTDET = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar un detalle.';
    protected const MSG_SCS_UPDDET = 'Detalle con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDDET = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar un detalle.';
    protected const MSG_SCS_DELDET = 'Detalle con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELDET = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar un detalle.';
    protected const MSG_NOT_FNDDET = 'El detalle solicitado no ha sido encontrado.';
    
    protected const MSG_ERR_CRTSTK = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el stock.';
    protected const MSG_ERR_UPDSTK = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el stock.';
    protected const MSG_ERR_DELSTK = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar el stock.';

    protected const MSG_DIF_SHOPID = 'El destino de la distribución ingresada no corresponde a tu local actualmente asignado.';
    protected const MSG_NOT_EDITAB = 'La recepción solicitada se encuentra VERIFICADA y no puede ser editada.';
    protected const MSG_NOT_DELETE = 'La recepción solicitada se encuentra VERIFICADA y no puede ser eliminada.';
    protected const MSG_ERR_UPDDST = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar la distribución asociada.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_admin) {
            $distributions = Distribution::where('status','CONFIRMADA')
                                         ->whereNull('verified_at') 
                                         ->orderBy('date')
                                         ->paginate(1000000);
            $receptions = Reception::orderBy('date')->paginate(1000000);
        }
        else {
            $distributions = Distribution::where('destiny_id',Auth::user()->center_id)
                                         ->where('status','CONFIRMADA')
                                         ->whereNull('verified_at')
                                         ->orderBy('date')
                                         ->paginate(1000000);
            $receptions = Reception::leftJoin('distributions','distributions.id','receptions.distribution_id')
                                    ->where('distributions.destiny_id',Auth::user()->center_id)
                                    ->orderBy('receptions.date')
                                    ->paginate(1000000);
        }
            
        return view('receptions.index', compact('distributions','receptions'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify($code)
    {
        $distribution = Distribution::whereNull('verified_at')->where('code',$code)->get()->first();
        
        if (!$distribution)
            return Redirect::back()->with('error', self::MSG_NOT_FNDDST);

        if (session()->has('errors')) {
            $details = session('recdetails', []);
        }
        else {
            $details = [];
            $products = Product::orderBy('name')->get();
            //detalle de productos por recibir
            foreach ($products as $product) {
                $prod_id = $product->id;
                $det = $distribution->details->filter(function($item) use ($prod_id) {
                    return $item->product_id == $prod_id;
                })->first();
                $details[] = [
                    'id' => '',
                    'product' => $det->product->name ?? $product->name,
                    'quantity' => $det->quantity ?? 0,
                    'received' => $det->quantity ?? 0,
                    'returned' => 0,
                    'observation' => null,
                    'checked' => 1,
                ];
            }
            session(['recdetails' => $details]);
        }
        return view('receptions.create', compact('distribution','details'));
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
            'code' => 'required|regex:/[A-Z0-9]{12}/',
            'date' => 'required|date',
            'status' => 'required|in:SIN CONFIRMAR,CONFIRMADA',
        ], self::validationErrorMessages());

        $distribution = Distribution::whereNull('verified_at')->where('code',$request->code)->get()->first();
        
        if (!$distribution)
            return Redirect::back()->with('error', self::MSG_NOT_FNDDST);

        if (!Auth::user()->is_admin && Auth::user()->center_id != $distribution->destiny_id)
            return Redirect::back()->with('error', self::MSG_DIF_SHOPID)->withInput();

        $reception = Reception::create($request->all() + ['distribution_id' => $distribution->id, 'user_id' => Auth::user()->id]);
        
        if (!$reception)
            return Redirect::back()->with('error', self::MSG_ERR_CRTRCP)->withInput();
        
        if (!$distribution->update(['verified_at' => now(), 'status' => 'VERIFICADA']))
            return Redirect::back()->with('error', self::MSG_ERR_UPDDST)->withInput();
        
        $stock = Stock::create(['center_id' => $distribution->destiny_id, 'date' => $request->date]);
        
        if (!$stock)
            return Redirect::back()->with('error', self::MSG_ERR_CRTSTK)->withInput();

        // Registro de detalles
        $details = session('recdetails', []);
        foreach ($details as $det) {
            $product = $det['product'];
            $detail = $distribution->details->filter(function($item) use ($product) {
                return $item->product->name == $product;
            })->first();
        
            if (!$detail)
                return Redirect::back()->with('error', self::MSG_NOT_FNDDET)->withInput();

            if (!$detail->update([
                'received' => $det['received'],
                'returned' => $det['returned'],
                'observation' => $det['observation'],
                'checked' => $det['checked'],
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_UPDDET)->withInput();
            
            if (!StockDetail::create([
                'quantity' => $detail->finaldestiny,
                'product_id' => $detail->product_id,
                'stock_id' => $stock->id,
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
        }
        session()->forget('recdetails');
        
        //Retorno exitoso
        return Redirect::route('receptions.index')->with('success', str_replace('value', $reception->code, self::MSG_SCS_CRTRCP));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reception = Reception::find($id);
        
        if (!$reception)
            return Redirect::back()->with('error', self::MSG_NOT_FNDRCP);
        
        $details = [];
        foreach ($reception->distribution->details as $det)
            $details[] = [
                'id' => $det->id,
                'product' => $det->product->name,
                'quantity' => $det->quantity,
                'received' => $det->received,
                'returned' => $det->returned,
                'observation' => $det->observation,
                'checked' => $det->checked,
            ];
        self::sort($details,'product');
        return view('receptions.show', compact('reception','details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reception = Reception::find($id);
        
        if (!$reception)
            return Redirect::back()->with('error', self::MSG_NOT_FNDRCP);

        if ($reception->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_EDITAB);
        
        if (session()->has('errors')) {
            $details = session('recdetails', []);
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
                    $lastDist = Reception::select('receptions.*')
                                            ->leftJoin('centers','centers.id','receptions.origin_id')
                                            //->where('receptions.status','CONFIRMADA')
                                            ->where('centers.id',$origin->id)
                                            ->where('receptions.date','>',$lastProd->date)
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
                $det = $reception->details->filter(function($item) use ($prod_id) {
                    return $item->product_id == $prod_id;
                })->first();
                $details[] = [
                    'id' => $det->id ?? '',
                    'product' => $det->product->name ?? $product->name,
                    'openstock' => $det->openstock ?? 0,
                    'opendestiny' => $det->opendestiny ?? 0,
                    'quantity' => $det->quantity ?? 0,
                    'returned' => $det->returned ?? 0,
                    'finalstock' => $det->finalstock ?? 0,
                    'finaldestiny' => $det->finaldestiny ?? 0
                ];
            }
            session([
                'recdetails' => $details,
                'distorigins' => $origins,
                'distdestinies' => $destinies,
            ]);
        }
        return view('receptions.edit', compact('reception','details'));
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

        $reception = Reception::find($id);
        
        if (!$reception)
            return Redirect::back()->with('error', self::MSG_NOT_FNDRCP)->withInput();
        
        if ($reception->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_EDITAB)->withInput();

        if (!Auth::user()->is_admin && Auth::user()->center_id != $request->origin_id)
            return Redirect::back()->with('error', self::MSG_DIF_SHOPID)->withInput();

        if (!$reception->update($request->all() + ['user_id' => Auth::user()->id]))
            return Redirect::back()->with('error', self::MSG_ERR_UPDRCP)->withInput();

        // Registro de detalles
        $details = session('recdetails', []);
        foreach ($reception->details as $det)
            if (!self::inArray($det->id, $details))
                $det->delete();
                
        foreach ($details as $det) {
            if ($det['id']) { //Detalle actualmente registrado
                if (!ReceptionDetail::find($det['id'])->update([
                    'openstock' => $det['openstock'],
                    'opendestiny' => $det['opendestiny'],
                    'quantity' => $det['quantity'],
                    //'returned' => $det['returned'],
                    'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                    'reception_id' => $reception->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDDET)->withInput();
            }
            else { //Detalle sin registrar
                if (!ReceptionDetail::create([
                    'openstock' => $det['openstock'],
                    'opendestiny' => $det['opendestiny'],
                    'quantity' => $det['quantity'],
                    //'returned' => $det['returned'],
                    'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                    'reception_id' => $reception->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
            }
        }
        session()->forget('recdetails');
        session()->forget('distorigins');
        session()->forget('distdestinies');

        //Retorno exitoso
        return Redirect::route('receptions.index')->with('success',str_replace('value', $reception->code, self::MSG_SCS_UPDRCP));        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reception = Reception::find($id);
        
        if (!$reception) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDRCP);
        
        if ($reception->status == 'CONFIRMADA' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_DELETE);

        foreach ($reception->details as $det)
            if (!$det->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DELDET);

        if (!$reception->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELRCP);
        
        return Redirect::route('receptions.index')->with('success',str_replace('value',$reception->code,self::MSG_SCS_DELRCP));
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'code.required' => 'Debes ingresar obligatoriamente un código de distribución.',
            'code.regex' => 'El código de distribución debe estar compuesto por doce (12) letras o dígitos.',
            
            'date.required' => 'Debes ingresar obligatoriamente una fecha y hora de envío.',
            'date.date' => 'La fecha y hora de envío ingresada no tiene un formato válido.',

            'status.required' => 'Debes ingresar obligatoriamente un estado.',
            'status.in' => 'El estado ingresado no es válido.',
        ];
    }
}
