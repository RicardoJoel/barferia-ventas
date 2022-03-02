<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryDetail extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventory_details';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_id', 'product_id', 'openstock', 'entry', 'exit', 'returned', 'removed'
    ];

    public function getFinalStockAttribute() {
        return $this->openstock + $this->entry - $this->exit + $this->returned - $this->removed;
    }

    public function inventory()
    {
    	return $this->belongsTo(Inventory::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
