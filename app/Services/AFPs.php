<?php

namespace App\Services;

use App\AFP;

class AFPs
{
    public function get()
    {
        $afps = AFP::orderBy('name')->get();
        $array = [];
        foreach ($afps as $afp) {
            $array[$afp->id] = $afp->name;
        }
        return $array;
    }
}