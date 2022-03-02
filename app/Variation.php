<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variation extends Model
{
    use SoftDeletes;

    protected $table = 'variations';
    
    protected $fillable = [
        'user_id', 'type', 'start_at', 'before', 'amount', 'after', 'observation'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
