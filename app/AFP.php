<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AFP extends Model
{
    use SoftDeletes;

    protected $table = 'afps';
    
    protected $fillable = [
        'name', 'code'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }
}
