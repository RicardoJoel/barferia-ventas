<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceptionDetail extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reception_details';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reception_id', 'product_id', 'received', 'returned', 'observation'
    ];

    /**
     * Default values for attributes
     * @var array an array with attribute as key and default as value
     */
    protected $attributes = [
        'returned' => 0
    ];

    public function reception()
    {
    	return $this->belongsTo(Reception::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
