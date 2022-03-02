<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SendingDetail;
use App\Sending;
use App\Product;
use Redirect;
use Auth;

class SendingController extends Controller
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
    protected const MSG_OPN_INVENT = 'La tienda ingresada tiene inventarios en estado ABIERTO. Para crear uno nuevo, antes debes cerrarlos.';
    protected const MSG_NOT_EDITAB = 'El inventario solicitado se encuentra CERRADO y no puede ser editado.';
    protected const MSG_NOT_DELETE = 'El inventario solicitado se encuentra CERRADO y no puede ser eliminado.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_admin)
            $sendings = Sending::orderBy('date')->paginate(1000000);
        else
            $sendings = Sending::where('center_id',Auth::user()->center_id)
                                    ->orderBy('date')->paginate(1000000);
        return view('sendings.index', compact('sendings'));
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
        }
        else {
            $details = [];
            foreach (Product::orderBy('name')->get() as $product)
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
            session(['invdetails' => $details]);
        }
        return view('sendings.create', compact('details'));
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
            'status' => 'required|string|in:ABIERTO,CERRADO',
        ], self::validationErrorMessages());

        if (!Auth::user()->is_admin && Auth::user()->center_id != $request->center_id)
            return Redirect::back()->with('error', self::MSG_DIF_SHOPID)->withInput();
        
        if (Sending::where('center_id',$request->center_id)->where('status','ABIERTO')->count())
            return Redirect::back()->with('error', self::MSG_OPN_INVENT)->withInput();

        $sending = Sending::create($request->all() + ['user_id' => Auth::user()->id]);
        
        if (!$sending)
            return Redirect::back()->with('error', self::MSG_ERR_CRTINV)->withInput();

        // Registro de detalles
        $details = session('invdetails', []);
        foreach ($details as $det) {
            if (!SendingDetail::create([
                'openstock' => $det['openstock'],
                'entry' => $det['entry'],
                'exit' => $det['exit'],
                'returned' => $det['returned'],
                'removed' => $det['removed'],
                'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                'sending_id' => $sending->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
        }
        session()->forget('invdetails');

        //Retorno exitoso
        return Redirect::route('sendings.index')->with('success', str_replace('value', $sending->code, self::MSG_SCS_CRTINV));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sending = Sending::find($id);
        
        if (!$sending)
            return Redirect::back()->with('error', self::MSG_NOT_FNDINV);
        
        $details = [];
        foreach ($sending->details as $det)
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
        return view('sendings.show', compact('sending','details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sending = Sending::find($id);
        
        if (!$sending)
            return Redirect::back()->with('error', self::MSG_NOT_FNDINV);

        if ($sending->status == 'CERRADO' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_EDITAB);
        
        if (session()->has('errors')) {
            $details = session('invdetails', []);
        }
        else {
            $details = [];
            foreach (Product::orderBy('name')->get() as $product) {
                $prod_id = $product->id;
                $det = $sending->details->filter(function($item) use ($prod_id) {
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
        return view('sendings.edit', compact('sending','details'));
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
            'status' => 'required|string|in:ABIERTO,CERRADO',
        ], self::validationErrorMessages());

        $sending = Sending::find($id);
        
        if (!$sending)
            return Redirect::back()->with('error', self::MSG_NOT_FNDINV)->withInput();
        
        if ($sending->status == 'CERRADO' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_EDITAB)->withInput();

        if (!Auth::user()->is_admin && Auth::user()->center_id != $request->center_id)
            return Redirect::back()->with('error', self::MSG_DIF_SHOPID)->withInput();

        if (Sending::where('center_id',$request->center_id)->where('id','!=',$id)->where('status','ABIERTO')->count())
            return Redirect::back()->with('error', self::MSG_OPN_INVENT)->withInput();

        if (!$sending->update($request->all() + ['user_id' => Auth::user()->id]))
            return Redirect::back()->with('error', self::MSG_ERR_UPDINV)->withInput();

        // Registro de detalles
        $details = session('invdetails', []);
        foreach ($sending->details as $det)
            if (!self::inArray($det->id, $details))
                $det->delete();
                
        foreach ($details as $det) {
            if ($det['id']) { //Detalle actualmente registrado
                if (!SendingDetail::find($det['id'])->update([
                    'openstock' => $det['openstock'],
                    'entry' => $det['entry'],
                    'exit' => $det['exit'],
                    'returned' => $det['returned'],
                    'removed' => $det['removed'],
                    'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                    'sending_id' => $sending->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDDET)->withInput();
            }
            else { //Detalle sin registrar
                if (!SendingDetail::create([
                    'openstock' => $det['openstock'],
                    'entry' => $det['entry'],
                    'exit' => $det['exit'],
                    'returned' => $det['returned'],
                    'removed' => $det['removed'],
                    'product_id' => Product::where('name',$det['product'])->get()->first()->id,
                    'sending_id' => $sending->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
            }
        }
        session()->forget('invdetails');

        //Retorno exitoso
        return Redirect::route('sendings.index')->with('success',str_replace('value', $sending->code, self::MSG_SCS_UPDINV));        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sending = Sending::find($id);
        
        if (!$sending) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDINV);
        
        if ($sending->status == 'CERRADO' && !Auth::user()->is_admin)
            return Redirect::back()->with('error', self::MSG_NOT_DELETE);

        foreach ($sending->details as $det)
            if (!$det->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DELDET);

        if (!$sending->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELINV);
        
        return Redirect::route('sendings.index')->with('success',str_replace('value',$sending->code,self::MSG_SCS_DELINV));
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
