<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parameter extends Model
{
    use SoftDeletes;

    protected $table = 'parameters';
    
    protected $fillable = [
        'name', 'description', 'value'
    ];
}
