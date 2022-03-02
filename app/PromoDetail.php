<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoDetail extends Model
{
    use SoftDeletes;

    protected $table = 'promo_details';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'promo_id', 'product_id', 'quantity'
    ];

    public function getSubtotalAttribute() {
        return $this->product ? $this->product->price * $this->quantity : 0;
    }

    public function promo()
    {
    	return $this->belongsTo(Promo::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
