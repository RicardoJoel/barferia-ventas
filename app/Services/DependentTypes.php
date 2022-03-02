<?php

namespace App\Services;

use App\DependentType;

class DependentTypes
{
    public function get()
    {
        $dependentTypes = DependentType::orderBy('code')->get();
        $array = [];
        foreach ($dependentTypes as $dependentType) {
            $array[$dependentType->id] = $dependentType->name;
        }
        return $array;
    }
}