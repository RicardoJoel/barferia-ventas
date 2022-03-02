<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Response;

class ProductionDetailController extends Controller
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
            'det_batch' => 'nullable|string|max:20',
            'det_quantity' => 'required|regex:/[0-9]+/',
            'det_removed' => 'required|regex:/[0-9]+/',
        ], self::validationErrorMessages());

        $details = session('proddetails', []);
        
        if (count($details) <= (int)($request->det_idx))
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);

        $openstock = $details[$request->det_idx]['openstock'];
        $quantity = (int)($request->det_quantity);
        $removed = (int)($request->det_removed);
        $finalstock = $openstock + $quantity - $removed;
        
        if (0 > $finalstock)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_NEGRSL]], 400);

        $details[$request->det_idx]['batch'] = $request->det_batch;
        $details[$request->det_idx]['quantity'] = $quantity;
        $details[$request->det_idx]['removed'] = $removed;
        $details[$request->det_idx]['finalstock'] = $finalstock;
        
        session(['proddetails' => $details]);
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
        $centers = session('prodcenters', []);
        $details = [];
        foreach ($products as $product) {
            $details[] = [
                'id' => '',
                'batch' => '',
                'product' => $product->name,
                'openstock' => $centers[$id][$product->id]['stock'] ?? 0,
                'quantity' => 0,
                'removed' => 0,
                'finalstock' => $centers[$id][$product->id]['stock'] ?? 0,
            ];
        }
        session(['proddetails' => $details]);
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

            'det_batch.required' => 'Debes ingresar obligatoriamente un lote.',
            'det_batch.max' => 'El lote no debe superar los veinte (20) caracteres.',

            'det_quantity.required' => 'Debes ingresar obligatoriamente un volumen de producción.',
            'det_quantity.regex' => 'El volumen de producción ingresado no tiene un formato válido.',

            'det_removed.required' => 'Debes ingresar obligatoriamente un volumen de merma.',
            'det_removed.regex' => 'El volumen de merma ingresado no tiene un formato válido.',
        ];
    }
}