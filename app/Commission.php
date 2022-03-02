<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commission extends Model
{
    use SoftDeletes;

    protected $table = 'commissions';
    
    protected $fillable = [
        'name'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }
}
