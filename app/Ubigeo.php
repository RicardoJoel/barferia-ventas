<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubigeo extends Model
{
    use SoftDeletes;

    protected $table = 'ubigeos';
    
    protected $fillable = [
        'department', 'province', 'ubigeo'
    ];

    public function getNameAttribute()
    {
    	return $this->department.' / '.$this->province.' / '.$this->district;
    }

    public function users()
    {
    	return $this->hasMany(User::class);
    }

    public function customers()
    {
    	return $this->hasMany(Customer::class);
    }

    public function freelancers()
    {
    	return $this->hasMany(Freelancer::class);
    }

    public function suppliers()
    {
    	return $this->hasMany(Supplier::class);
    }
}