<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use SoftDeletes;

    protected $table = 'pets';
    
    protected $fillable = [
        'customer_id', 'race_id', 'name', 'species', 'gender', 'other_race', 'birthdate', 'observation' 
    ];

    public function race()
    {
    	return $this->belongsTo(Race::class);
    }
    
    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}