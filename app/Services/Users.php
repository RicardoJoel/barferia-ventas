<?php

namespace App\Services;

use App\User;

class Users
{
    public function get()
    {
        $users = User::where('id','!=','1')->whereNull('end_at')->orderByRaw('name','lastname')->get();
        $array = [];
        foreach ($users as $user) {
            $array[$user->id] = $user->fullname;
        }
        return $array;
    }

    public function getSellers()
    {
        $users = User::where('id','!=','1')->whereNull('end_at')->where('commission','>',0)->orderByRaw('name','lastname')->get();
        $array = [];
        foreach ($users as $user) {
            $array[$user->id] = $user->fullname;
        }
        return $array;
    }
}