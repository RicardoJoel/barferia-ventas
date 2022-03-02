<?php

namespace App\Services;

use App\Frequency;

class Frequencies
{
    public function get()
    {
        $frequencies = Frequency::orderBy('code')->get();
        $array = [];
        foreach ($frequencies as $frequency) {
            $array[$frequency->id] = $frequency->name;
        }
        return $array;
    }
}