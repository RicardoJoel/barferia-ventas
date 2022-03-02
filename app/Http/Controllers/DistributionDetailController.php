<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Response;

class DistributionDetailController extends Controller
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
            'det_quantity' => 'required|regex:/[0-9]+/',
            //'det_received' => 'nullable|regex:/[0-9]+/',
            //'det_returned' => 'nullable|regex:/[0-9]+/',
        ], self::validationErrorMessages());

        $details = session('distdetails', []);

        if (count($details) <= (int)($request->det_idx))
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_INVIDX]], 400);

        $openstock = $details[$request->det_idx]['openstock'];
        $opendestiny = $details[$request->det_idx]['opendestiny'];
        $quantity = (int)($request->det_quantity);
        //$received = (int)($request->det_received);
        //$returned = (int)($request->det_returned);
        $finalstock = $openstock - $quantity/* + $returned*/;
        $finaldestiny = $opendestiny + $quantity/* - $returned*/;

        if (0 > $finalstock || 0 > $finaldestiny)
            return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_NEGRSL]], 400);

        $details[$request->det_idx]['quantity'] = $quantity;
        //$details[$request->det_idx]['received'] = $received;
        //$details[$request->det_idx]['returned'] = $returned;
        $details[$request->det_idx]['finalstock'] = $finalstock;
        $details[$request->det_idx]['finaldestiny'] = $finaldestiny;

        session(['distdetails' => $details]);
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
    
    public function change(Request $request, $org, $dst)
    {
        $products = Product::orderBy('name')->get();
        $origins = session('distorigins', []);
        $destinies = session('distdestinies', []);
        $details = [];
        foreach ($products as $product) {
            $details[] = [
                'id' => '',
                'product' => $product->name,
                'openstock' => $origins[$org][$product->id]['stock'] ?? 0,
                'opendestiny' => $destinies[$dst][$product->id]['stock'] ?? 0,
                'quantity' => 0,
                'received' => 0,
                'returned' => 0,
                'finalstock' => $origins[$org][$product->id]['stock'] ?? 0,
                'finaldestiny' => $destinies[$dst][$product->id]['stock'] ?? 0,
                'observation' => ''
            ];
        }
        session(['distdetails' => $details]);
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

            'det_quantity.required' => 'Debes ingresar obligatoriamente una cantidad de productos enviados.',
            'det_quantity.regex' => 'La cantidad de productos enviados no tiene un formato válido.',

            //'det_received.regex' => 'La cantidad de productos recibidos no tiene un formato válido.',
            //'det_returned.regex' => 'La cantidad de productos devueltos no tiene un formato válido.',
        ];
    }
}