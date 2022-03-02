<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Response;

class InventoryDetailController extends Controller
{
    protected const MSG_ERR_INVIDX = 'El índice ingresado es inválido.';
    protected const MSG_ERR_NEGRSL = 'El stock final no puede ser negativo.';
    
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        self::validate($request, [
            'det_idx' => 'required|integer|min:0',
            'det_openstock' => 'required|regex:/[0-9]+/',
            'det_entry' => 'required|regex:/[0-9]+/',
            'det_exit' => 'required|regex:/[0-9]+/',
            'det_returned' => 'required|regex:/[0-9]+/',
            'det_removed' => 'required|regex:/[0-9]+/',
        ], self::validationErrorMessages());

        $details = session('invdetails', []);
        
        if (count($details) <= (int)($request->det_idx))
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);

        $openstock = (int)($request->det_openstock);
        $entry = (int)($request->det_entry);
        $exit = (int)($request->det_exit);
        $returned = (int)($request->det_returned);
        $removed = (int)($request->det_removed);
        $finalstock = $openstock + $entry - $exit + $returned - $removed;
        
        if (0 > $finalstock)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_NEGRSL]], 400);

        $details[$request->det_idx]['openstock'] = $openstock;
        $details[$request->det_idx]['entry'] = $entry;
        $details[$request->det_idx]['exit'] = $exit;
        $details[$request->det_idx]['returned'] = $returned;
        $details[$request->det_idx]['removed'] = $removed;
        $details[$request->det_idx]['finalstock'] = $finalstock;
        
        session(['invdetails' => $details]);
        return json_encode($details);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function change(Request $request, $id)
    {
        $products = Product::orderBy('name')->get();
        $centers = session('invcenters', []);
        $details = [];
        foreach ($products as $product) {
            $open = $centers[$id][$product->id]['stock'] ?? 0;
            $entr = $centers[$id][$product->id]['entry'] ?? 0;
            $exit = $centers[$id][$product->id]['exit'] ?? 0;
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
        session(['invdetails' => $details]);
        return json_encode($details);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'det_idx.required' => 'Debes ingresar obligatoriamente un índice.',
            'det_idx.integer' => 'El índice ingresado no tiene un formato válido.',
            'det_idx.min' => 'El índice ingresado no es válido.',

            'det_openstock.required' => 'Debes ingresar obligatoriamente un stock inicial.',
            'det_openstock.regex' => 'El stock inicial ingresado no tiene un formato válido.',

            'det_entry.required' => 'Debes ingresar obligatoriamente una entrada.',
            'det_entry.regex' => 'La entrada ingresada no tiene un formato válido.',

            'det_exit.required' => 'Debes ingresar obligatoriamente una salida.',
            'det_exit.regex' => 'La salida ingresada no tiene un formato válido.',

            'det_returned.required' => 'Debes ingresar obligatoriamente una devolución.',
            'det_returned.regex' => 'La devolución ingresada no tiene un formato válido.',

            'det_removed.required' => 'Debes ingresar obligatoriamente un descarte.',
            'det_removed.regex' => 'El descarte ingresado no tiene un formato válido.',
        ];
    }
}