<?php

namespace App\Services;

use App\Center;

class Centers
{
    public function get()
    {
        $centers = Center::orderBy('name')->get();
        $array = [];
        foreach ($centers as $center) {
            $array[$center->id] = $center->name;
        }
        return $array;
    }

    public function getByType($type)
    {
        $centers = Center::where('type',$type)->orderBy('name')->get();
        $array = [];
        foreach ($centers as $center) {
            $array[$center->id] = $center->name;
        }
        return $array;
    }
}