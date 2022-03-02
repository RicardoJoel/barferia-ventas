<?php

namespace App\Services;

use App\EPS;

class EPSs
{
    public function get()
    {
        $epss = EPS::orderBy('code')->get();
        $array = [];
        foreach ($epss as $eps) {
            $array[$eps->id] = $eps->name;
        }
        return $array;
    }
}