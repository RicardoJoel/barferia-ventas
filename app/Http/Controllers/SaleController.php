<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Customer;
use App\Choice;
use App\Location;
use App\Product;
use App\Promo;
use App\Sale;
use App\SaleDetail;
use App\Stock;
use App\Ubigeo;
use Redirect;
use DB;

class SaleController extends Controller
{
    protected const MSG_SCS_CRTSAL = 'Venta con código value registrada de manera exitosa.';
    protected const MSG_ERR_CRTSAL = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar la venta.';
    protected const MSG_SCS_UPDSAL = 'Venta con código value actualizada de manera exitosa.';
    protected const MSG_ERR_UPDSAL = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar la venta.';
    protected const MSG_SCS_DELSAL = 'Venta con código value eliminada de manera exitosa.';
    protected const MSG_ERR_DELSAL = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar la venta.';
    protected const MSG_NOT_FNDSAL = 'La venta solicitada no ha sido encontrada.';
    
    protected const MSG_SCS_CRTDET = 'Línea de venta con código value registrada de manera exitosa.';
    protected const MSG_ERR_CRTDET = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar una línea de venta.';
    protected const MSG_SCS_UPDDET = 'Línea de venta con código value actualizada de manera exitosa.';
    protected const MSG_ERR_UPDDET = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar una línea de venta.';
    protected const MSG_SCS_DELDET = 'Línea de venta con código value eliminada de manera exitosa.';
    protected const MSG_ERR_DELDET = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar una línea de venta.';
    protected const MSG_NOT_FNDDET = 'La línea de venta solicitada no ha sido encontrada.';

    protected const MSG_SCS_CRTCHS = 'Selección con código value registrada de manera exitosa.';
    protected const MSG_ERR_CRTCHS = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar una selección.';
    protected const MSG_SCS_UPDCHS = 'Selección con código value actualizada de manera exitosa.';
    protected const MSG_ERR_UPDCHS = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar una selección.';
    protected const MSG_SCS_DELCHS = 'Selección con código value eliminada de manera exitosa.';
    protected const MSG_ERR_DELCHS = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar una selección.';
    protected const MSG_NOT_FNDCHS = 'La selección solicitada no ha sido encontrada.';

    protected const MSG_ERR_CRTCST = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el cliente.';
    protected const MSG_ERR_UPDCST = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el cliente.';
    protected const MSG_ERR_CRTLOC = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el lugar de entrega.';
    protected const STATUS_SALE = 'PENDIENTE,PAGADA,REEMBOLSADA,RECHAZADA,REINTENTANDO COBRO,IMPAGA';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::orderByDesc('happened_at')->paginate(1000000);
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (session()->has('errors')) {
            $details = session('saledetails', []);
            $locations = session('locations', []);
            $pets = session('pets', []);
        }
        else {
            $details = $locations = $pets = [];
            session([
                'saledetails' => $details,
                'locations' => $locations,
                'pets' => $pets,
            ]);
        }        
        return view('sales.create', compact('details','locations','pets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['num_details'] = count(session('saledetails', []));

        self::validate($request, [
            'happened_at' => 'required|date',
            'status' => 'required|string|in:'.self::STATUS_SALE,
            'customer_id' => 'nullable|integer|min:1',
            'center_id' => 'required|integer|min:1',
            'requested_at' => 'nullable|date_format:Y-m-d',
            'ini_hour' => 'nullable|date_format:H:i',
            'end_hour' => 'nullable|date_format:H:i|after_or_equal:ini_hour',
            'location_id' => 'nullable|integer|min:1',
            'delivery' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0', 
            'paidout' => 'required|numeric|min:0',
            'payment_method_id' => 'nullable|integer|min:1',
            'num_details' => 'required|integer|min:1',
        ], self::validationErrorMessages());

        // Búsqueda del cliente
        $customer = Customer::find($request->customer_id);

        // Cliente no registrado
        if (!$customer) {
            // Validación de datos cliente
            self::validate($request, [
                'customer_name' => 'required|string|max:50',
                'customer_lastname' => 'required|string|max:50',
                'customer_doc' => 'required|string|unique:customers,document,NULL,id,deleted_at,NULL|max:15',
                'customer_email' => 'nullable|email:rfc|unique:customers,email,NULL,id,deleted_at,NULL|max:50',
                'customer_mobile' => 'required|string|unique:customers,mobile,NULL,id,deleted_at,NULL|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
                'customer_phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            ], self::validationErrorMessages());

            // Registro del cliente
            $customer = Customer::create([
                'name' => $request->customer_name,
                'lastname' => $request->customer_lastname,
                'document' => $request->customer_doc,
                'email' => $request->customer_email,
                'mobile' => $request->customer_mobile,
                'phone' => $request->customer_phone,
                'document_type_id' => 1,
                'country_id' => 164
            ]);
            //Registro NO exitoso
            if (!$customer)
                return Redirect::back()->with('error', self::MSG_ERR_CRTCST)->withInput();
            //Registro exitoso
            $request['customer_id'] = $customer->id;
        }
        else {
            // Validación de datos cliente
            self::validate($request, [
                'customer_name' => 'required|string|max:50',
                'customer_lastname' => 'required|string|max:50',
                'customer_doc' => 'required|string|unique:customers,document,'.$customer->id.',id,deleted_at,NULL|max:15',
                'customer_email' => 'nullable|email:rfc|unique:customers,email,'.$customer->id.',id,deleted_at,NULL|max:50',
                'customer_mobile' => 'required|string|unique:customers,mobile,'.$customer->id.',id,deleted_at,NULL|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
                'customer_phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            ], self::validationErrorMessages());
            // Actualización de datos del cliente
            if (!$customer->update([
                'name' => $request->customer_name,
                'lastname' => $request->customer_lastname,
                'document' => $request->customer_doc,
                'email' => $request->customer_email,
                'mobile' => $request->customer_mobile,
                'phone' => $request->customer_phone
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_UPDCST)->withInput();
        }

        // Localización no registrada
        if (!$request->location_id && $request->address) {
            // Validación de datos cliente
            self::validate($request, [
                'address' => 'required|string|max:100',
                'ubigeo' => 'required|string|max:300',
                'reference' => 'nullable|string|max:100',
                'latitude' => 'nullable|numeric|max:100',
                'longitude' => 'nullable|numeric|max:100',
            ], self::validationErrorMessages());
            // Búsqueda de la ubicación
            $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->ubigeo)->get()->first()->id ?? null;
            $other = $ubigeo ? null : $request->ubigeo;
            // Registro de la localización
            $location = Location::create([
                'address' => $request->address,
                'ubigeo_id' => $ubigeo,
                'other_ubigeo' => $other,
                'ref' => $request->reference,
                'lat' => $request->latitude,
                'lng' => $request->longitude,
                'customer_id' => $request['customer_id']
            ]);
            //Registro NO exitoso
            if (!$location)
                return Redirect::back()->with('error', self::MSG_ERR_CRTLOC)->withInput();
            //Registro exitoso
            $request['location_id'] = $location->id;
        }

        // Registro de la venta
        $sale = Sale::create($request->all());
        if (!$sale)
            return Redirect::back()->with('error', self::MSG_ERR_CRTSAL)->withInput();

        // Obtengo el ultimo stock registrado del local
        $stock = Stock::where('center_id',$request->center_id)->latest('date')->first();

        // Registro de los detalles de venta
        $details = session('saledetails', []);
        foreach ($details as $detail) {
            if ($detail['code'][0] == 'P') { //Es producto
                if (!SaleDetail::create([
                    'quantity' => $detail['quantity'],
                    'product_id' => Product::where('code',$detail['code'])->get()->first()->id,
                    'promo_id' => null,
                    'sale_id' => $sale->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
                // Decremento el stock
                self::decStock($stock->details, $detail['code'], $detail['quantity']);
            }
            else { //Es promoción
                $saleDetail = SaleDetail::create([
                    'quantity' => $detail['quantity'],
                    'product_id' => null,
                    'promo_id' => Promo::where('code',$detail['code'])->get()->first()->id,
                    'sale_id' => $sale->id
                ]);
                if (!$saleDetail)
                    return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
                
                //Registramos la selección por cada producto
                foreach ($detail['choices'] as $choice) {
                    if (!Choice::create([
                        'quantity' => $choice['quantity'],
                        'product_id' => Product::where('code',$choice['code'])->get()->first()->id,
                        'sale_detail_id' => $saleDetail->id
                    ]))
                        return Redirect::back()->with('error', self::MSG_ERR_CRTCHS)->withInput();
                    // Decremento el stock
                    if ($choice['quantity'] > 0)
                        self::decStock($stock->details, $choice['code'], $detail['quantity'] * $choice['quantity']);
                }
            }
        }
        session()->forget('saledetails');

        // Aviso de cofirmación
        self::sendMessage($sale);
        self::sendLocation($sale);

        // Retorno exitoso
        return Redirect::route('sales.index')->with('success', str_replace('value', $sale->code, self::MSG_SCS_CRTSAL));
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
        $sale = Sale::find($id);
        
        if (!$sale) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDSAL);

        if (session()->has('errors')) {
            $details = session('saledetails', []);
            $locations = session('locations', []);
            $pets = session('pets', []);
        }
        else {
            $details = $locations = $pets = [];
            foreach ($sale->details as $det) {
                $choices = [];
                foreach ($det->choices as $cho)
                    $choices[] = [
                        'id' => $cho->id,
                        'code' => $cho->product->code,
                        'product' => $cho->product->name,
                        'quantity' => $cho->quantity,
                    ];
                $details[] = [
                    'id' => $det->id,
                    'code' => $det->product->code ?? $det->promo->code,
                    'product' => $det->product->nameCode ?? $det->promo->nameCode,
                    'quantity' => $det->quantity,
                    'price' => $det->product->price ?? $det->promo->price,
                    'subtotal' => ($det->product->price ?? $det->promo->price) * $det->quantity,
                    'choices' => $choices
                ];
            }
            session([
                'saledetails' => $details,
                'locations' => $locations,
                'pets' => $pets,
            ]);
        }        
        return view('sales.edit', compact('sale','details','locations','pets'));   
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
        $request['num_details'] = count(session('saledetails', []));

        self::validate($request, [
            'happened_at' => 'required|date',
            'status' => 'required|string|in:'.self::STATUS_SALE,
            'customer_id' => 'nullable|integer|min:1',
            'center_id' => 'required|integer|min:1',
            'requested_at' => 'nullable|date_format:Y-m-d',
            'ini_hour' => 'nullable|date_format:H:i',
            'end_hour' => 'nullable|date_format:H:i|after_or_equal:ini_hour',
            'location_id' => 'nullable|integer|min:1',
            'delivery' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0', 
            'paidout' => 'required|numeric|min:0',
            'payment_method_id' => 'nullable|integer|min:1',
            'num_details' => 'required|integer|min:1',
        ], self::validationErrorMessages());

        // Registro del cliente
        $sale = Sale::find($id);

        if (!$sale)
            return Redirect::back()->with('error', self::MSG_NOT_FNDSAL)->withInput();

        // Búsqueda del cliente
        $customer = Customer::find($request->customer_id);

        // Cliente no registrado
        if (!$customer) {
            // Validación de datos cliente
            self::validate($request, [
                'customer_name' => 'required|string|max:50',
                'customer_lastname' => 'required|string|max:50',
                'customer_doc' => 'required|string|unique:customers,document,NULL,id,deleted_at,NULL|max:15',
                'customer_email' => 'nullable|email:rfc|unique:customers,email,NULL,id,deleted_at,NULL|max:50',
                'customer_mobile' => 'required|string|unique:customers,mobile,NULL,id,deleted_at,NULL|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
                'customer_phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            ], self::validationErrorMessages());

            // Registro del cliente
            $customer = Customer::create([
                'name' => $request->customer_name,
                'lastname' => $request->customer_lastname,
                'document' => $request->customer_doc,
                'email' => $request->customer_email,
                'mobile' => $request->customer_mobile,
                'phone' => $request->customer_phone,
                'document_type_id' => 1,
                'country_id' => 164
            ]);
            // Registro NO exitoso
            if (!$customer)
                return Redirect::back()->with('error', self::MSG_ERR_CRTCST)->withInput();
            // Registro exitoso
            $request['customer_id'] = $customer->id;
        }
        else {
            // Validación de datos cliente
            self::validate($request, [
                'customer_name' => 'required|string|max:50',
                'customer_lastname' => 'required|string|max:50',
                'customer_doc' => 'required|string|unique:customers,document,'.$customer->id.',id,deleted_at,NULL|max:15',
                'customer_email' => 'nullable|email:rfc|unique:customers,email,'.$customer->id.',id,deleted_at,NULL|max:50',
                'customer_mobile' => 'required|string|unique:customers,mobile,'.$customer->id.',id,deleted_at,NULL|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
                'customer_phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            ], self::validationErrorMessages());
            // Actualización de datos del cliente
            if (!$customer->update([
                'name' => $request->customer_name,
                'lastname' => $request->customer_lastname,
                'document' => $request->customer_doc,
                'email' => $request->customer_email,
                'mobile' => $request->customer_mobile,
                'phone' => $request->customer_phone
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_UPDCST)->withInput();
        }

        // Localización no registrada
        if (!$request->location_id && $request->address) {
            // Validación de datos cliente
            self::validate($request, [
                'address' => 'required|string|max:100',
                'ubigeo' => 'required|string|max:300',
                'reference' => 'nullable|string|max:100',
                'latitude' => 'nullable|numeric|max:100',
                'longitude' => 'nullable|numeric|max:100',
            ], self::validationErrorMessages());
            // Búsqueda de la ubicación
            $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->ubigeo)->get()->first()->id ?? null;
            $other = $ubigeo ? null : $request->ubigeo;
            // Registro de la localización
            $location = Location::create([
                'address' => $request->address,
                'ubigeo_id' => $ubigeo,
                'other_ubigeo' => $other,
                'ref' => $request->reference,
                'lat' => $request->latitude,
                'lng' => $request->longitude,
                'customer_id' => $request['customer_id']
            ]);
            // Registro NO exitoso
            if (!$location)
                return Redirect::back()->with('error', self::MSG_ERR_CRTLOC)->withInput();
            // Registro exitoso
            $request['location_id'] = $location->id;
        }

        // Actualización de la venta
        if (!$sale->update($request->all()))
            return Redirect::back()->with('error', self::MSG_ERR_UPDSAL)->withInput();

        // Obtengo el ultimo stock registrado del local
        $stock = Stock::where('center_id',$request->center_id)->latest('date')->first();

        // Registro de los detalles de venta
        $details = session('saledetails', []);
        foreach ($sale->details as $detail)
            if (!self::inArray($detail->id, $details)) {
                if ($detail->product) { //Es producto
                    // Incremento el stock
                    self::decStock($stock->details, $detail->product->code, -$detail->quantity);
                }
                else { //Es promoción
                    foreach ($detail->choices as $choice) {
                        // Incremento el stock
                        self::decStock($stock->details, $choice->product->code, -$detail->quantity * $choice->quantity);
                        //Elimino la seleccion
                        $choice->delete();
                    }
                }
                // Elimino el detalle
                $detail->delete();
            }

        foreach ($details as $detail) {
            if (!$detail['id']) { //Detalle sin registrar
                if ($detail['code'][0] == 'P') { //Es producto
                    if (!SaleDetail::create([
                        'quantity' => $detail['quantity'],
                        'product_id' => Product::where('code',$detail['code'])->get()->first()->id,
                        'promo_id' => null,
                        'sale_id' => $sale->id
                    ]))
                        return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
                    // Decremento el stock
                    self::decStock($stock->details, $detail['code'], $detail['quantity']);
                }
                else { //Es promoción
                    $saleDetail = SaleDetail::create([
                        'quantity' => $detail['quantity'],
                        'product_id' => null,
                        'promo_id' => Promo::where('code',$detail['code'])->get()->first()->id,
                        'sale_id' => $sale->id
                    ]);
                    if (!$saleDetail)
                        return Redirect::back()->with('error', self::MSG_ERR_CRTDET)->withInput();
                    
                    //Registramos la selección por cada producto
                    foreach ($detail['choices'] as $choice) {
                        if (!Choice::create([
                            'quantity' => $choice['quantity'],
                            'product_id' => Product::where('code',$choice['code'])->get()->first()->id,
                            'sale_detail_id' => $saleDetail->id
                        ]))
                            return Redirect::back()->with('error', self::MSG_ERR_CRTCHS)->withInput();
                        // Decremento el stock
                        if ($choice['quantity'] > 0)
                            self::decStock($stock->details, $choice['code'], $detail['quantity'] * $choice['quantity']);
                    }
                }
            }
        }
        session()->forget('saledetails');

        // Aviso de cofirmación
        self::sendMessage($sale);
        self::sendLocation($sale);

        // Retorno exitoso
        return Redirect::route('sales.index')->with('success', str_replace('value', $sale->code, self::MSG_SCS_UPDSAL));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        
        if (!$sale) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDSAL);

        foreach ($sale->details as $detail) {
            foreach ($detail->choices as $choice) {
                if (!$choice->delete())
                    return Redirect::back()->with('error', self::MSG_ERR_DELCHS);
            }
            if (!$detail->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DELDET);
        }
        if (!$sale->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELSAL);
        
        return Redirect::route('sales.index')->with('success',str_replace('value',$user->code,self::MSG_SCS_DELSAL));
    }

    protected function sendMessage($sale)
    {
        $number = str_replace(' ','',substr($sale->center->manager->codemobile,1));
        if (!$number) return;

        //obtengo la lista de productos ingresados
        $products = [];
        foreach (Product::orderBy('name')->get() as $product)
            $products[] = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => 0
            ];

        $detalle = $sabores = '';
        foreach ($sale->details as $det) {
            if ($det->product) {
                $idx = array_search($det->product_id, array_column($products, 'id'));
                $products[$idx]['quantity'] += $det->quantity;
            }
            else if ($det->promo) {
                $detalle .= $det->quantity.' '.$det->promo->name.', ';
                foreach ($det->choices as $cho) {
                    $idx = array_search($cho->product_id, array_column($products, 'id'));
                    $products[$idx]['quantity'] += $det->quantity*$cho->quantity;
                }
            }
        }        
        foreach ($products as $prod)
            if ($prod['quantity'] > 0)
                $sabores .= $prod['quantity'].' '.$prod['name'].', ';
                
        $message = 
            'Nombre: '.($sale->customer->natfullname ?? '')."\n".
            'Documento: '.($sale->customer->document ?? '')."\n".
            'Correo: '.($sale->customer->email ?? '')."\n".
            'Teléfono: '.($sale->customer->codemobile ?? '')."\n".
            'Dirección: '.($sale->location->address ?? '')."\n".
            'Distrito: '.($sale->location->ubigeo->name ?? $sale->location->other_ubigeo ?? '')."\n".
            'Referencia: '.($sale->location->reference ?? '')."\n".
            'Local encargado: '.($sale->center->name ?? '')."\n".
            'Fecha de entrega: '.($sale->requested_at ? Carbon::parse($sale->requested_at)->format('d/m/Y') : ' - ')."\n".
            'Rango horario: '.($sale->ini_hour ? Carbon::parse($sale->ini_hour)->format('H:i') : '').' - '.($sale->end_hour ? Carbon::parse($sale->end_hour)->format('H:i') : '')."\n".
            'Promociones: '.substr($detalle,0,-2)."\n".
            'Sabores: '.substr($sabores,0,-2)."\n".
            'Método de pago: '.($sale->paymentMethod->name ?? '')."\n".
            'Por pagar: S/ '.number_format($sale->debt,2)."\n".
            'Delivery: S/ '.number_format($sale->delivery,2)."\n".
            'Total: S/ '.number_format($sale->debtPlusDelivery,2);
            
        $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
        $params = ["to" => ["type" => "whatsapp", "number" => $number],
            "from" => ["type" => "whatsapp", "number" => config('services.nexmo.number')],
            "message" => [
                "content" => [
                    "type" => "text",
                    "text" => $message
                ]
            ]
        ];
        $headers = ["Authorization" => "Basic ".base64_encode(config('services.nexmo.key').":".config('services.nexmo.secret'))];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
        $data = $response->getBody();
        \Log::Info($data);
    }

    protected function sendLocation($sale)
    {
        $number = str_replace(' ','',substr($sale->center->manager->codemobile,1));
        if (!$number) return;

        $url = "https://messages-sandbox.nexmo.com/v0.1/messages";
        $params = ["to" => ["type" => "whatsapp", "number" => $number],
            "from" => ["type" => "whatsapp", "number" => config('services.nexmo.number')],
            "message" => [
                "content" => [
                    "type" => "custom",
                    "custom" => [
                        "type" => "location",
                        "location" => [
                            "longitude" => ($sale->location->lng ?? ''),
                            "latitude" => ($sale->location->lat ?? ''),
                            "name" => "Ver en Maps",
                            "address" => ($sale->location->address ?? '')
                        ]
                    ]
                ]
            ]
        ];
        $headers = ["Authorization" => "Basic ".base64_encode(config('services.nexmo.key').":".config('services.nexmo.secret'))];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, ["headers" => $headers, "json" => $params]);
        $data = $response->getBody();
        \Log::Info($data);
    }

    protected function decStock($details, $code, $quantity)
    {
        $det = $details->filter(function($item) use ($code) {
            return !strcasecmp($item->product->code,$code);
        })->first();
        $det->quantity -= $quantity;
        $det->save();
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'happened_at.required' => 'Debes ingresar obligatoriamente una fecha y hora de venta.',
            'happened_at.date' => 'La fecha y hora de venta ingresada no tiene un formato válido.',

            'status.required' => 'Debes ingresar obligatoriamente un estado.',
            'status.in' => 'El estado ingresado no es válido.',

            'customer_id.required' => 'Debes ingresar obligatoriamente un cliente.',
            'customer_id.integer' => 'El ID de cliente ingresado no tiene un formato válido.',
            'customer_id.min' => 'El ID de cliente ingresado no es válido.',

            'center_id.required' => 'Debes ingresar obligatoriamente un local de distribución.',
            'center_id.integer' => 'El ID de local de distribución ingresado no tiene un formato válido.',
            'center_id.min' => 'El ID de local de distribución ingresado no es válido.',

            'requested_at.date' => 'La fecha y hora de entrega solicitada no tiene un formato válido.',
            'requested_at.after_or_equal' => 'La fecha y hora de entrega solicitada no puede ser anterior a la fecha de venta.',

            'address.required' => 'Debes ingresar obligatoriamente una dirección de entrega.',
            'address.max' => 'La dirección de entrega no puede superar los cien (100) caracteres.',

            'ubigeo.required' => 'Debes ingresar obligatoriamente una ubicación.',
            'ubigeo.max' => 'La ubicación no debe superar los trescientos (300) caracteres.',

            'reference.max' => 'La referencia no puede superar los cien (100) caracteres.',

            'latitude.required' => 'Debes ingresar obligatoriamente una latitud.',
            'latitude.numeric' => 'La latitud ingresada no tiene un formato válido.',
            'latitude.max' => 'La latitud no puede ser mayor a cien (100).',

            'longitude.required' => 'Debes ingresar obligatoriamente una longitud.',
            'longitude.numeric' => 'La longitud ingresada no tiene un formato válido.',
            'longitude.max' => 'La longitud no puede ser mayor a cien (100).',

            'discount.required' => 'Debes ingresar obligatoriamente el valor del descuento.',
            'discount.numeric' => 'El descuento ingresado no tiene un formato válido.', 
            'discount.min' => 'El descuento no puede ser negativo.', 

            'paidout.required' => 'Debes ingresar obligatoriamente el valor del adelanto.',
            'paidout.numeric' => 'El adelanto ingresado no tiene un formato válido.',
            'paidout.min' => 'El adelanto no puede ser negativo.',

            'delivery.required' => 'Debes ingresar obligatoriamente el valor del costo de envío.',
            'delivery.numeric' => 'El costo de envío ingresado no tiene un formato válido.',
            'delivery.min' => 'El costo de envío no puede ser negativo.',

            'payment_method_id.integer' => 'El ID de método de pago ingresado no tiene un formato válido.',
            'payment_method_id.min' => 'El ID de método de pago ingresado no es válido.',

            'num_details.min' => 'Debes ingresar, al menos, un detalle de venta.',

            'customer_name.required' => 'Debes ingresar obligatoriamente el nombre del cliente.',
            'customer_name.max' => 'El nombre del cliente no debe superar los cincuenta (50) caracteres.',

            'customer_lastname.required' => 'Debes ingresar obligatoriamente el apellido del cliente.',
            'customer_lastname.max' => 'El apellido del cliente no debe superar los cincuenta (50) caracteres.',

            'customer_doc.required' => 'Debes ingresar obligatoriamente el N° Documento del cliente.',
            'customer_doc.unique' => 'El N° Documento del cliente ingresado ya existe en el sistema.',
            'customer_doc.max' => 'El N° Documento del cliente no debe superar los quince (15) caracteres.',
         
            'customer_email.unique' => 'El correo electrónico del cliente ingresado ya existe en el sistema.',
            'customer_email.email' => 'El correo electrónico del cliente ingresado no tiene un formato válido.',
            'customer_email.max' => 'El correo electrónico del cliente no debe superar los cincuenta (50) caracteres.',

            'customer_mobile.required' => 'Debes ingresar obligatoriamente el celular del cliente.',
            'customer_mobile.unique' => 'El celular del cliente ingresado ya existe en el sistema.',
            'customer_mobile.regex' => 'El celular del cliente debe estar compuesto por nueve (9) dígitos.',
            
            'customer_phone.regex' => 'El teléfono fijo del cliente debe estar compuesto por el código de ciudad seguido de seis (6) o siete (7) dígitos.',
        ];
    }
}