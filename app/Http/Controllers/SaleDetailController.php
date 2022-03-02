<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Center;
use App\Product;
use App\Promo;
use App\Stock;
use Response;

class SaleDetailController extends Controller
{
    protected const MSG_ERR_NOTFND = 'El producto solicitado no ha sido encontrado.';
    protected const MSG_ERR_RPTDTL = 'El producto solicitado ya figura en la venta. Para modificar la cantidad, elimina su detalle e ingrésalo nuevamente.';
    protected const MSG_ERR_INVIDX = 'El índice ingresado es inválido.';    
    protected const MSG_ERR_NOTSTK = 'El local seleccionado no ha declarado stock de productos.';
    protected const MSG_ERR_INSPRD = 'El producto value no tiene stock suficiente en el local seleccionado.';
    protected const MSG_ERR_INSPRM = 'La promoción value no tiene stock suficiente en el local seleccionado.';
    protected const MSG_ERR_DIFQTY = 'La cantidad de productos ingresados difiere de la contemplada en la promoción.';

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
        //Validamos los campos ingresados
        self::validate($request, [
            'det_center_id' => 'required|integer|min:1',
            'det_product_code' => 'required|string|size:8',
            'det_quantity' => 'required|integer|min:1',
            'lat_destiny' => 'nullable|numeric',
            'lng_destiny' => 'nullable|numeric',
            'choices' => 'nullable|array',
        ], self::validationErrorMessages());

        //Validamos la selección de campos para cada producto
        if ($request->choices)
            foreach ($request->choices as $choice)
                Validator::make($choice, [
                    'code' => 'required|string|regex:/[A-Z0-9]{8}/',
                    'quantity' => 'required|integer|min:0',
                ], self::validationErrorMessages());
        
        //Inicializamos variables
        $code = $request->det_product_code; $choices = [];
        $details = session('saledetails', []);

        //Es producto
        if ($code[0] == 'P') {
            //Verificamos que el local seleccionado haya declarado stock
            $stock = Stock::where('center_id',$request->det_center_id)->latest('date')->first();

            //No se declaró stock en el local seleccionado
            if (!$stock)
                return Response::json([
                    'success' => 'true', 
                    'message' => self::MSG_ERR_NOTSTK, 
                    'centers' => self::centersWithStockProd($code, $request->det_quantity, $request->lat_destiny, $request->lng_destiny)
                ], 200);

            //Tratamos de obtener el producto
            $product = Product::where('code',$code)->get()->first();

            //Verificamos la existencia del producto
            if (!$product)
                return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_NOTFND]], 400);
        
            //Verificamos si hay stock suficiente
            if (self::insufStock($stock->details, $details, $code, $request->det_quantity))
                return Response::json([
                    'success' => 'true', 
                    'message' => str_replace('value', $product->nameCode, self::MSG_ERR_INSPRD), 
                    'centers' => self::centersWithStockProd($code, $request->det_quantity, $request->lat_destiny, $request->lng_destiny)
                ], 200);
            
            //Verificamos si el producto ya figura en la venta
            foreach ($details as $det)
                if (!strcasecmp($det['code'], $code))
                    return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_RPTDTL]], 400);
        }
        //Es promoción
        else {
            //Tratamos de obtener la promoción
            $promo = Promo::where('code',$code)->get()->first();

            //Verificamos la existencia de la promo
            if (!$promo)
                return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_NOTFND]], 400);

            //Verificamos que el local seleccionado haya declarado stock
            $stock = Stock::where('center_id',$request->det_center_id)->latest('date')->first();
            
            if ($request->choices) { //promoción sin productos definidos
                //No se declaró stock en el local seleccionado
                if (!$stock)
                    return Response::json([
                        'success' => 'true', 
                        'message' => self::MSG_ERR_NOTSTK, 
                        'centers' => self::centersWithStockProm($request->choices, $request->det_quantity, $request->lat_destiny, $request->lng_destiny)
                    ], 200);

                $totsel = 0; // Cantidad de items seleccionados
                foreach ($request->choices as $choice) {
                    //Verificamos si hay stock suficiente
                    if (self::insufStock($stock->details, $details, $choice['code'], $request->det_quantity * $choice['quantity']))
                        return Response::json([
                            'success' => 'true', 
                            'message' => str_replace('value', $promo->nameCode, self::MSG_ERR_INSPRM), 
                            'centers' => self::centersWithStockProm($request->choices, $request->det_quantity, $request->lat_destiny, $request->lng_destiny)
                        ], 200);

                    $choices[] = [
                        'product' => $choice['product'],
                        'code' => $choice['code'],
                        'quantity' => $choice['quantity']
                    ];
                    $totsel += $choice['quantity'];
                }
                //Verificamos que la cantidad de items seleccionados sea igual a los contemplados en la promo
                if ($totsel != $promo->totalItems)
                    return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_DIFQTY]], 400);
            }
            else { //promoción con productos definidos
                //No se declaró stock en el local seleccionado
                if (!$stock)
                    return Response::json([
                        'success' => 'true', 
                        'message' => self::MSG_ERR_NOTSTK, 
                        'centers' => self::centersWithStockProm($promo->details, $request->det_quantity, $request->lat_destiny, $request->lng_destiny)
                    ], 200);

                foreach ($promo->details as $detail) {
                    //Verificamos si hay stock suficiente
                    if (self::insufStock($stock->details, $details, $detail->product->code, $request->det_quantity * $detail->quantity))
                        return Response::json([
                            'success' => 'true', 
                            'message' => str_replace('value', $promo->nameCode, self::MSG_ERR_INSPRM), 
                            'centers' => self::centersWithStockProm($promo->details, $request->det_quantity, $request->lat_destiny, $request->lng_destiny)
                        ], 200);
                    
                    $choices[] = [
                        'product' => $detail->product->name,
                        'code' => $detail->product->code,
                        'quantity' => $detail->quantity
                    ];
                }
            }
            $product = $promo; //Para facilitar el manejo del detalle
        }
        
        //Preparamos arreglo de retorno
        $details[] = [
            'id' => '',
            'code' => $product->code,
            'product' => $product->nameCode,
            'quantity' => $request->det_quantity,
            'price' => $product->price,
            'subtotal' => $product->price * $request->det_quantity,
            'choices' => $choices
        ];
        session(['saledetails' => $details]);

        //Retorno exitoso
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
        $details = session('saledetails', []);

        if ($id < 0 || count($details) <= $id)
            return Response::json(['success' => 'false', 'message' => self::MSG_ERR_INVIDX], 400);
        
        unset($details[$id]);
        $details = array_values($details);
        session(['saledetails' => $details]);
        return json_encode($details);
    }

    public function getByCode($code)
    {
        $details = session('saledetails', []);
        foreach ($details as $detail)
            if (!strcasecmp($detail['code'], $code)) {
                if ($detail['code'][0] === 'P') {
                    $items = 1;
                }
                else {
                    $items = 0;
                    foreach ($detail['choices'] as $det)
                        $items += $det['quantity'];
                }
                return array_merge($detail, ['items' => $items]);
            }
        
        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeDetails(Request $request)
    {
        self::validate($request, [
            'indexes' => 'required|array'
        ], self::validationErrorMessages());

        $details = session('saledetails', []);

        foreach ($request->indexes as $idx)
            unset($details[$idx]);

        $details = array_values($details);
        session(['saledetails' => $details]);
        return json_encode($details);
    }

    protected function insufStock($stockdetails, $saledetails, $code, $quantity)
    {
        //productos en el stock
        $stock = $stockdetails->filter(function ($item) use ($code) {
            return !strcasecmp($item->product->code, $code);
        })->first()['quantity'] ?? 0;

        //productos en la venta
        $count = 0;
        foreach ($saledetails as $det) {
            //Es producto
            if ($det['code'][0] === 'P' && !strcasecmp($det['code'], $code))
                $count += $det['quantity'];
            //Es promoción
            else
                $count += $det['quantity'] * (collect($det['choices'])->filter(function ($item) use ($code) {
                    return !strcasecmp($item['code'], $code);
                })->first()['quantity'] ?? 0);
        }
        //comparo cantidades
        return $quantity + $count > $stock;
    }

    protected function centersWithStockProd($code, $quantity, $latDst, $lngDst)
    {
        $array = [];
        $centers = Center::where('type','T')->orderBy('name')->get();
        foreach ($centers as $center) {
            $stock = Stock::where('center_id',$center->id)->latest('date')->first();
            if ($stock) {
                foreach ($stock->details as $det) {
                    if (!strcasecmp($det->product->code, $code) && $det->quantity >= $quantity) {
                        $array[] = [
                            'id' => $center->id,
                            'center' => $center->name,
                            'distance' => self::getDistance($center->lat, $center->lng, $latDst, $lngDst),
                            'stock' => $det->quantity
                        ];
                        break;
                    }
                }
            }
        }
        return self::sortByDistance($array);
    }

    protected function centersWithStockProm($details, $quantity, $latDst, $lngDst)
    {
        $array = [];
        $centers = Center::where('type','T')->orderBy('name')->get();
        foreach ($centers as $center) {
            $stock = Stock::where('center_id',$center->id)->latest('date')->first();
            if ($stock) {
                $enough = true;
                $available = [];
                foreach ($details as $prmdet) {
                    $code = $prmdet->product->code ?? $prmdet['code'];
                    $cant = $prmdet->quantity ?? $prmdet['quantity'];
                    if ($cant > 0) {
                        foreach ($stock->details as $stkdet) {
                            if (!strcasecmp($stkdet->product->code, $code)) {
                                $disp = floor($stkdet->quantity / ($quantity * $cant));
                                if ($disp > 0) {
                                    $available[] = $disp;
                                }
                                else {
                                    $enough = false;
                                    break;
                                }
                            }
                        }
                    }
                    if (!$enough) break;
                }
                if ($enough) {
                    $array[] = [
                        'id' => $center->id,
                        'center' => $center->name,
                        'distance' => self::getDistance($center->lat, $center->lng, $latDst, $lngDst),
                        'stock' => min($available)
                    ];
                }
            }
        }
        return self::sortByDistance($array);
    }

    protected function getDistance($latOrg, $lngOrg, $latDst, $lngDst) 
    {
        //usamos el api de Google maps para obtener la distancia
        $response = \GoogleMaps::load('directions')
            ->setParam([
                'origin'        => "$latOrg,$lngOrg",
                'destination'   => "$latDst,$lngDst",
                'travelMode'    => 'DRIVING'
            ])->get();
        //obtenemos el valor en metros
        return json_decode($response, true)['routes'][0]['legs'][0]['distance']['value'] ?? null;
    }

    protected function sortByDistance($centers) 
    {
        usort($centers, function ($a, $b) {
            return $a['distance'] > $b['distance'];
        });
        return $centers;
    }
    
    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'det_center_id.required' => 'Debes seleccionar obligatoriamente un local de distribución.',
            'det_center_id.integer' => 'El ID de local de distribución ingresado no tiene un formato válido.',
            'det_center_id.min' => 'El ID de local de distribución ingresado no es válido.',

            'det_product_code.required' => 'Debes seleccionar obligatoriamente un producto.',
            'det_product_id.min' => 'El ID de producto ingresado no es válido.',

            'det_quantity.required' => 'Debes ingresar obligatoriamente una cantidad.',
            'det_quantity.integer' => 'La cantidad ingresada no tiene un formato válido.',
            'det_quantity.min' => 'La cantidad ingresada no es válida.',
            
            'code.required' => 'Debes ingresar obligatoriamente un código de producto.',
            'code.regex' => 'El código de producto ingresado no tiene un formato válido.',

            'quantity.required' => 'Debes ingresar obligatoriamente una cantidad de producto.',
            'quantity.integer' => 'La cantidad de producto ingresado no tiene un formato válido.',
            'quantity.min' => 'La cantidad de producto ingresado no es válida.',

            'indexes.required' => 'Debes ingresar de manera obligatoria una lista de índices.',
            'indexes.array' => 'La lista de índices ingresada no tiene un formato válido.',

            'lat_destiny.numeric' => 'La latitud ingresada no tiene un formato válido.',
            'lng_destiny.numeric' => 'La longitud ingresada no tiene un formato válido.',
        ];
    }
}