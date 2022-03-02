<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetail extends Model
{
    use SoftDeletes;

    protected $table = 'sale_details';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sale_id', 'product_id', 'promo_id', 'quantity'
    ];

    public function getSubtotalAttribute() {
        return ($this->product->price ?? $this->promo->price) * $this->quantity;
    }

    public function sale()
    {
    	return $this->belongsTo(Sale::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function promo()
    {
    	return $this->belongsTo(Promo::class);
    }

    public function choices()
    {
        return self::hasMany(Choice::class);
    }
}
