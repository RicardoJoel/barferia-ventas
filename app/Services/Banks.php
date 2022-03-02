<?php

namespace App\Services;

use App\Bank;

class Banks
{
    public function get()
    {
        $banks = Bank::orderBy('name')->get();
        $array = [];
        foreach ($banks as $bank) {
            $array[$bank->id] = $bank->name;
        }
        return $array;
    }
}