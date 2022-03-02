<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Choice extends Model
{
    use SoftDeletes;

    protected $table = 'choices';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sale_detail_id', 'product_id', 'quantity'
    ];

    public function saleDetail()
    {
    	return $this->belongsTo(SaleDetail::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
