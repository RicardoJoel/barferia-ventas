<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $table = 'countries';
    
    protected $fillable = [
        'name', 'code', 'mob_pattern'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }
    
    public function customers()
    {
    	return $this->hasMany(Customer::class);
    }

    public function suppliers()
    {
    	return $this->hasMany(Supplier::class);
    }
}
