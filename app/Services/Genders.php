<?php

namespace App\Services;

use App\Gender;

class Genders
{
    public function get()
    {
        $genders = Gender::orderBy('code')->get();
        $array = [];
        foreach ($genders as $gender) {
            $array[$gender->id] = $gender->name;
        }
        return $array;
    }
}