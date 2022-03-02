<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EPS extends Model
{
    use SoftDeletes;

    protected $table = 'epss';
    
    protected $fillable = [
        'name', 'code'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }
}
