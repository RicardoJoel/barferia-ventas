<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Race extends Model
{
    use SoftDeletes;

    protected $table = 'races';
    
    protected $fillable = [
        'name', 'code', 'type'
    ];

    public function pets()
    {
    	return $this->hasMany(Pet::class);
    }
}
