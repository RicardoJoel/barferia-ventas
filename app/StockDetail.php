<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockDetail extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stock_details';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stock_id', 'product_id', 'quantity'
    ];

    public function stock()
    {
    	return $this->belongsTo(Stock::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
