<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DistributionDetail extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'distribution_details';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'distribution_id', 'product_id', 'openstock', 'opendestiny', 
        'quantity', 'received', 'returned', 'observation', 'checked'
    ];

    /**
     * Default values for attributes
     * @var array an array with attribute as key and default as value
     */
    protected $attributes = [
        'received' => 0, 'returned' => 0, 'checked' => true
    ];

    public function getFinalStockAttribute() {
        return $this->openstock - $this->quantity + $this->returned;
    }

    public function getFinalDestinyAttribute() {
        return $this->opendestiny + $this->received;
    }

    public function distribution()
    {
    	return $this->belongsTo(Distribution::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
