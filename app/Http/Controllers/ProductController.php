<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Promo;
use Redirect;

class ProductController extends Controller
{
    protected const MSG_SCS_CRTPRD = 'Producto con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTPRD = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el producto.';
    protected const MSG_SCS_UPDPRD = 'Producto con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDPRD = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el producto.';
    protected const MSG_SCS_DELPRD = 'Producto con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELPRD = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar el producto.';
    protected const MSG_NOT_FNDPRD = 'El producto solicitado no ha sido encontrado.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('code')->paginate(1000000);
        return view('products.index', compact('products'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ], $this->validationErrorMessages());

        $product = Product::create($request->all());
        
        if (!$product)
            return Redirect::back()->with('error', self::MSG_ERR_CRTPRD)->withInput();

        return Redirect::route('products.index')->with('success', str_replace('value', $product->code, self::MSG_SCS_CRTPRD));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
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
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ], $this->validationErrorMessages());

        $product = Product::find($id);
        
        if (!$product)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRD)->withInput();
        
        if (!$product->update($request->all()))
            return Redirect::back()->with('error', self::MSG_ERR_UPDPRD)->withInput();

        return Redirect::route('products.index')->with('success',str_replace('value', $product->code, self::MSG_SCS_UPDPRD));        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        
        if (!$product) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRD);

        if (!$product->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELPRD);
        
        return Redirect::route('products.index')->with('success',str_replace('value',$product->code,self::MSG_SCS_DELPRD));
    }

    public function getByCode($code)
    {
        if ($code[0] == 'P') { //Es producto
            $product = Product::where('code',$code)->get()->first();
            return [
                'product' => $product->nameCode,
                'code' => $product->code,
                'price' => $product->price
            ];
        }
        else if ($code[0] == 'O') { //Es promoción
            $promo = Promo::where('code',$code)->get()->first();
            $products = Product::orderBy('name')->get();
            $choices = $details = [];
            foreach ($products as $pro)
                $choices[] = [
                    'product' => $pro->name,
                    'code' => $pro->code
                ];
            
            $quantity = 0;
            $specified = false;
            foreach ($promo->details as $det) {
                $details[] = [
                    'product' => $det->product->name ?? '',
                    'code' => $det->product->code ?? '',
                    'quantity' => $det->quantity
                ];
                $quantity += $det->quantity;
                if ($det->product_id) $specified = true;
            }

            return [
                'product' => $promo->nameCode,
                'code' => $promo->code,
                'price' => $promo->price,
                'items' => $quantity,
                'specified' => $specified,
                'details' => $details,
                'choices' => $choices
            ];
        }
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'name.required' => 'Debes ingresar obligatoriamente un nombre.',
            'name.max' => 'El nombre no debe superar los cincuenta (50) caracteres.',

            'price.required' => 'Debes ingresar obligatoriamente un precio unitario.',
            'price.numeric' => 'El precio unitario ingresado no tiene un formato válido.',
            'price.min' => 'El precio unitario ingresado no es válido.',

            'description.max' => 'La descripción no debe superar los quinientos (500) caracteres.',
        ];
    }
}
