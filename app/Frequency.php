<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Frequency extends Model
{
    use SoftDeletes;

    protected $table = 'frequencies';
    
    protected $fillable = [
        'name', 'code'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }
}
