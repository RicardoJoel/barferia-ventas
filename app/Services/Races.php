<?php

namespace App\Services;

use App\Race;

class Races
{
    public function get($type)
    {
        $races = Race::whereIn('type',[$type,'X'])->orderBy('name')->get();
        $array = [];
        foreach ($races as $race) {
            $array[$race->id] = $race->name;
        }
        return $array;
    }

    public function getJSON($type)
    {
        $races = Race::whereIn('type',[$type,'X'])->orderBy('name')->get();
        $array = [];
        foreach ($races as $race) {
            $array[] = [
                'id' => $race->id,
                'name' => $race->name
            ];
        }
        return $array;
    }
}