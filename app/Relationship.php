<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relationship extends Model
{
    use SoftDeletes;

    protected $table = 'relationships';
    
    protected $fillable = [
        'name', 'code'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }
}
