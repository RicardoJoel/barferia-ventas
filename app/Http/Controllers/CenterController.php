<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Center;
use App\Ubigeo;
use App\Stock;
use Redirect;
use Response;
use DB;

class CenterController extends Controller
{
    protected const MSG_SCS_CRTCTR = 'Local con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTCTR = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el local.';
    protected const MSG_SCS_UPDCTR = 'Local con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDCTR = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el local.';
    protected const MSG_SCS_DELCTR = 'Local con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELCTR = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar el local.';
    protected const MSG_NOT_FNDCTR = 'El local solicitado no ha sido encontrado.';
    protected const MSG_ERR_CLSCTR = 'Lo sentimos, ocurrió un problema mientras se intentaba calcular el local más cercano.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers = Center::orderBy('code')->paginate(1000000);
        return view('centers.index', compact('centers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('centers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'nemo' => 'required|string|unique:centers,nemo,NULL,id,deleted_at,NULL|regex:/[A-Z0-9]{3}/',
            'type' => 'required|in:T,F',
            'address' => 'required|string|max:100',
            'ubigeo' => 'required|string|max:300',
            'ref' => 'nullable|string|max:100',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ], $this->validationErrorMessages());
        
        // Búsqueda de la ubicación
        $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->ubigeo)->get()->first()->id ?? null;
        $other = $ubigeo ? null : $request->ubigeo;
        
        // Registro del local
        $center = Center::create($request->all() + ['ubigeo_id' => $ubigeo, 'other_ubigeo' => $other]);
        if (!$center)
            return Redirect::back()->with('error', self::MSG_ERR_CRTCTR)->withInput();

        // Retorno exitoso
        return Redirect::route('centers.index')->with('success', str_replace('value', $center->code, self::MSG_SCS_CRTCTR));
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
        $center = Center::find($id);
        
        if (!$center) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDCTR);

        return view('centers.edit', compact('center'));
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
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'nemo' => 'required|string|unique:centers,nemo,'.$id.',id,deleted_at,NULL|regex:/[A-Z0-9]{3}/',
            'type' => 'required|in:T,F',
            'address' => 'required|string|max:100',
            'ubigeo' => 'required|string|max:300',
            'ref' => 'nullable|string|max:100',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ], $this->validationErrorMessages());

        // Registro del local
        $center = Center::find($id);

        if (!$center)
            return Redirect::back()->with('error', self::MSG_NOT_FNDCTR)->withInput();

        // Búsqueda de la ubicación
        $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->ubigeo)->get()->first()->id ?? null;
        $other = $ubigeo ? null : $request->ubigeo;

        // Registro del local
        if (!$center->update($request->all() + ['ubigeo_id' => $ubigeo, 'other_ubigeo' => $other]))
            return Redirect::back()->with('error', self::MSG_ERR_CRTCTR)->withInput();

        // Retorno exitoso
        return Redirect::route('centers.index')->with('success',str_replace('value', $center->code, self::MSG_SCS_UPDCTR));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $center = Center::find($id);
        
        if (!$center) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDCTR);

        if (!$center->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELCTR);
        
        return Redirect::route('centers.index')->with('success',str_replace('value',$center->code,self::MSG_SCS_DELCTR));
    }

    public function getClosest($lat, $lng)
    {
        $centers = Center::where('type','T')->get();
        $minDist = 100000000;
        $id = $name = $manager = $mobile = null;

        foreach ($centers as $center) {
            //usamos el api de Google maps para obtener la distancia
            $response = \GoogleMaps::load('directions')
                ->setParam([
                    'origin'        => "$center->lat,$center->lng",
                    'destination'   => "$lat,$lng",
                    'travelMode'    => 'DRIVING'
                ])->get();
            //obtenemos el valor en metros
            $dist = json_decode($response, true)['routes'][0]['legs'][0]['distance']['value'] ?? null;
            if (!$dist)
                return Response::json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_CLSCTR]], 400);
            //comparamos con la menor distancia obtenida
            if ($dist < $minDist) {
                $minDist = $dist;
                $id = $center->id;
                $name = $center->name;
                $manager = $center->manager->fullname ?? '';
                $mobile = $center->manager->mobile ?? '';
            }
        }
        
        return [
            'removed' => self::getRemoved($id),
            'center' => [
                'id' => $id,
                'name' => $name,
                'manager' => $manager,
                'mobile' => $mobile
            ]
        ];
    }

    public function getById($id)
    {
        $center = Center::find($id);
        if (!$center) return null;

        return [
            'removed' => self::getRemoved($id),
            'center' => [
                'id' => $id,
                'name' => $center->name,
                'manager' => $center->manager->fullname ?? '',
                'mobile' => $center->manager->mobile ?? ''
            ]
        ];
    }
    
    protected function getRemoved($center_id)
    {
        //Inicializamos variables
        $details = session('saledetails', []);
        $removed = [];

        //Verificamos que el local seleccionado haya declarado stock
        $stock = Stock::where('center_id',$center_id)->latest('date')->first();

        //Si no declaró stock, remover todos los detalles de venta
        if (!$stock) {
            foreach ($details as $index => $detail) {
                $removed[] = [
                    'index' => $index,
                    'product' => substr($detail['product'],0,-10),
                    'code' => $detail['code'],
                    'quantity' => $detail['quantity'],
                ];
            }
        }
        //De lo contrario, verificar stock suficiente por cada producto
        else {
            foreach ($details as $index => $detail) {
                //Obtenemos el codigo
                $code = $detail['code'];
                $name = $detail['product'];
                $cant = $detail['quantity'];
                //Si es producto
                if ($code[0] === 'P') {
                    //obtenemos cantidad de producto disponible en el local
                    $disp = $stock->details->filter(function ($item) use ($code) {
                        return !strcasecmp($item->product->code, $code);
                    })->first()['quantity'] ?? 0;
                    //comparamos con la cantidad solicitada
                    if ($cant > $disp)
                        $removed[] = [
                            'index' => $index,
                            'product' => substr($name,0,-10),
                            'code' => $code,
                            'quantity' => $cant,
                        ];
                }
                //Si es promoción
                else {
                    foreach ($detail['choices'] as $choice) {
                        //obtenemos cantidad de producto disponible en el local
                        $disp = $stock->details->filter(function ($item) use ($code) {
                            return !strcasecmp($item->product->code, $code);
                        })->first()['quantity'] ?? 0;
                        if (self::insufStock($stock->details, $details, $choice['code'], $detail['quantity'] * $choice['quantity'])) {
                            $removed[] = [
                                'index' => $index,
                                'product' => substr($name,0,-10),
                                'code' => $code,
                                'quantity' => $cant,
                            ];
                        }
                    }
                }
            }
        }
        return $removed;
    }

    protected function insufStock($stockdetails, $saledetails, $code, $quantity)
    {
        //productos en la venta
        $count = 0;
        foreach ($saledetails as $det) {
            //Si es producto
            if ($det['code'][0] === 'P' && !strcasecmp($det['code'], $code))
                $count += $det['quantity'];
            //Si es promoción
            else if ($code[0] === 'O') {
                $count += $det['quantity'] * (collect($det['choices'])->filter(function ($item) use ($code) {
                    return !strcasecmp($item['code'], $code);
                })->first()['quantity'] ?? 0);
            }
        }
        //comparo cantidades
        return $quantity + $count > $stock;
    }

    protected function validationErrorMessages()
    {
        return [
            'name.required' => 'Debes ingresar obligatoriamente un nombre.',
            'name.max' => 'El nombre no debe superar los cincuenta (50) caracteres.',

            'nemo.required' => 'Debes ingresar obligatoriamente un código referencial.',
            'nemo.unique' => 'El código referencial ingresado ya existe en el sistema.',
            'nemo.regex' => 'El código referencial debe estar compuesto por tres (3) letras o dígitos.',
            
            'type.required' => 'Debes ingresar obligatoriamente un tipo.',
            'type.unique' => 'El tipo ingresado no es válido.',

            'address.required' => 'Debes ingresar obligatoriamente una dirección.',
            'address.max' => 'La dirección no debe superar los cien (100) caracteres.',
            
            'ubigeo.required' => 'Debes ingresar obligatoriamente una ubicación.',
            'ubigeo.max' => 'La ubicación no debe superar los trescientos (300) caracteres.',

            'ref.max' => 'La referencia no debe superar los cien (100) caracteres.',
            'lat.numeric' => 'La latitud ingresada no tiene un formato válido.',
            'lng.numeric' => 'La longitud ingresada no tiene un formato válido.',
        ];
    }
}
