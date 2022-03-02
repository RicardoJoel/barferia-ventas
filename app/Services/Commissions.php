<?php

namespace App\Services;

use App\Commission;

class Commissions
{
    public function get()
    {
        $commissions = Commission::orderBy('name')->get();
        $array = [];
        foreach ($commissions as $commission) {
            $array[$commission->id] = $commission->name;
        }
        return $array;
    }
}