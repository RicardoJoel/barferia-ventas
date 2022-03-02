<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use SoftDeletes;

    protected $table = 'payment_methods';
    
    protected $fillable = [
        'name'
    ];

    public function sales()
    {
    	return $this->hasMany(Sale::class);
    }
}
