<?php

namespace App\Services;

use App\Relationship;

class Relationships
{
    public function get()
    {
        $relationships = Relationship::orderBy('code')->get();
        $array = [];
        foreach ($relationships as $relationship) {
            $array[$relationship->id] = $relationship->name;
        }
        return $array;
    }
}