<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model
{
    use SoftDeletes;

    protected $table = 'genders';
    
    protected $fillable = [
        'name', 'code'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }

    public function contacts()
    {
    	return $this->hasMany(Contact::class);
    }
    
    public function dependents()
    {
    	return $this->hasMany(Dependent::class);
    }
}
