<?php

namespace App\Services;

use App\PaymentMethod;

class PaymentMethods
{
    public function get()
    {
        $methods = PaymentMethod::orderBy('code')->get();
        $array = [];
        foreach ($methods as $method) {
            $array[$method->id] = $method->name;
        }
        return $array;
    }
}