<?php

namespace App\Services;

use App\Product;
use App\Promo;

class Products
{
    public function get()
    {
        $products = Product::orderBy('name')->get();
        $array = [];
        foreach ($products as $product) {
            $array[$product->id] = $product->nameCode;
        }
        return $array;
    }

    public function getWithPromos()
    {
        $products = Product::orderBy('name')->get();
        $promos = Promo::orderBy('name')->get();
        $array = [];
        foreach ($products as $product) {
            $array[$product->code] = $product->nameCode;
        }
        foreach ($promos as $promo) {
            if ($promo->status == 'VIGENTE')
                $array[$promo->code] = $promo->nameCode;
        }
        return $array;
    }
}