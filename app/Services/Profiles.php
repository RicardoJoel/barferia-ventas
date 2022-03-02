<?php

namespace App\Services;

use App\Profile;

class Profiles
{
    public function get($type)
    {
        $profiles = Profile::whereIn('type',[$type,'X'])->orderBy('name')->get();
        $array = [];
        foreach ($profiles as $profile) {
            $array[$profile->id] = $profile->name;
        }
        return $array;
    }
}