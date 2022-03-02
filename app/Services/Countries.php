<?php

namespace App\Services;

use App\Country;

class Countries
{
    public function get()
    {
        $countries = Country::orderBy('name')->get();
        $array = [];
        foreach ($countries as $country) {
            $array[$country->id] = $country->name.' ('.$country->code.')';
        }
        return $array;
    }
}