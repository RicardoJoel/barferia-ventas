<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $table = 'locations';
    
    protected $fillable = [
        'customer_id', 'ubigeo_id', 'address', 'other_ubigeo', 'ref', 'lat', 'lng' 
    ];

    public function ubigeo()
    {
    	return $this->belongsTo(Ubigeo::class);
    }
    
    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}