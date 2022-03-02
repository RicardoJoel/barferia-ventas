<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'description'
    ];
    
    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'code'
    ];

    public function getNameCodeAttribute() {
        return $this->name.' - '.$this->code;
    }

    public function inventoryDetails()
    {
    	return $this->hasMany(InventoryDetail::class);
    }

    public function saleDetails()
    {
        return self::hasMany(SaleDetail::class);
    }
    
    public function choices()
    {
        return self::hasMany(Choice::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Product $cust) {
            $maxCod = Product::where('code','like','P'.date('Y').'%')->max(\DB::raw('substr(code,6,3)'));
            $cust->code = 'P'.date('Y').str_pad(++$maxCod,3,'0',STR_PAD_LEFT);
            return true;
        });
    }
}
