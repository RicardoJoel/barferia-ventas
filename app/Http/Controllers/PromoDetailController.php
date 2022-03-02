<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Response;

class PromoDetailController extends Controller
{
    protected const MSG_ERR_NOTFND = 'El producto solicitado no ha sido encontrado.';
    protected const MSG_ERR_RPTDTL = 'El producto solicitado ya figura en la promoción. Para modificar la cantidad, elimina su detalle e ingrésalo nuevamente.';
    protected const MSG_ERR_INVIDX = 'El índice ingresado es inválido.';
    
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
        self::validate($request, [
            'det_product_id' => 'nullable|integer|min:1',
            'det_quantity' => 'required|integer|min:1',
        ], self::validationErrorMessages());

        if ($request->det_product_id) {
            $product = Product::find($request->det_product_id);
    
            if (!$product)
                return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_NOTFND]], 400);
        
            $details = session('promdetails', []);
            foreach ($details as $detail)
                if (!strcasecmp($detail['code'], $product->code))
                    return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_RPTDTL]], 400);

            $details[] = [
                'id' => '',
                'code' => $product->code,
                'product' => $product->nameCode,
                'quantity' => $request->det_quantity,
                'price' => $product->price,
                'subtotal' => $product->price * $request->det_quantity
            ];
        }
        else {
            $details = session('promdetails', []);
            foreach ($details as $detail)
                if (!strcasecmp($detail['code'], 'TODOS'))
                    return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_RPTDTL]], 400);

            $details[] = [
                'id' => '',
                'code' => 'TODOS',
                'product' => 'Cualquier producto',
                'quantity' => $request->det_quantity,
                'price' => 0,
                'subtotal' => 0
            ];
        }
        session(['promdetails' => $details]);
        return json_encode($details);
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
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $details = session('promdetails', []);

        if ($id < 0 || count($details) <= $id)
            return Response::json(['success' => 'false', 'message' => self::MSG_ERR_INVIDX], 400);
        
        unset($details[$id]);
        $details = array_values($details);
        session(['promdetails' => $details]);
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
            'det_product_id.required' => 'Debes ingresar obligatoriamente un producto.',
            'det_product_id.integer' => 'El ID de producto ingresado no tiene un formato válido.',
            'det_product_id.min' => 'El ID de producto ingresado no es válido.',

            'det_quantity.required' => 'Debes ingresar obligatoriamente una cantidad.',
            'det_quantity.integer' => 'La cantidad ingresada no tiene un formato válido.',
            'det_quantity.min' => 'La cantidad ingresada no es válida.',
        ];
    }
}