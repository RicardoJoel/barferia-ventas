<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DependentType extends Model
{
    use SoftDeletes;

    protected $table = 'dependent_types';
    
    protected $fillable = [
        'name', 'code'
    ];

    public function dependents()
    {
    	return $this->hasMany(Dependent::class);
    }
}
