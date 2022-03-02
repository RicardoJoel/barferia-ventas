<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $table = 'profiles';
    
    protected $fillable = [
        'name', 'code', 'type'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }
    
    public function resources()
    {
    	return $this->hasMany(Resource::class);
    }
}
