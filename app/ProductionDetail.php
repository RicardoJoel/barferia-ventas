<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionDetail extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'production_details';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'production_id', 'product_id', 'batch', 'openstock', 'quantity', 'removed'
    ];

    public function getFinalStockAttribute() {
        return $this->openstock + $this->quantity - $this->removed;
    }

    public function production()
    {
    	return $this->belongsTo(Production::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
