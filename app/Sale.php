<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Sale extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sales';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'center_id', 'customer_id', 'location_id', 'payment_method_id', //'location_id', 
        'status', 'happened_at', 'requested_at', 'ini_hour', 'end_hour', 
        //'address', 'other_ubigeo', 'reference', 'latitude', 'longitude', 
        'discount', 'paidout', 'delivery'
    ];
        
    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'code'
    ];

    /**
     * Default values for attributes
     * @var array an array with attribute as key and default as value
     */
    protected $attributes = [
        'status' => 'PENDIENTE'
    ];

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->details as $det)
            $total += $det->subtotal;
        return $total;
    }

    public function getTotalFinalAttribute()
    {
        return $this->total - $this->discount;
    }

    public function getDebtAttribute()
    {
        return $this->totalFinal - $this->paidout;
    }
    
    public function getDebtPlusDeliveryAttribute()
    {
        return $this->debt + $this->delivery;
    }

    public function center()
    {
    	return self::belongsTo(Center::class);
    }

    public function customer()
    {
    	return self::belongsTo(Customer::class);
    }
    
    public function location()
    {
    	return self::belongsTo(Location::class);
    }

    public function paymentMethod()
    {
    	return self::belongsTo(PaymentMethod::class);
    }

    public function details()
    {
        return self::hasMany(SaleDetail::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Sale $sale) {
            $center = $sale->center->nemo;
            $date = Carbon::parse($sale->happend_at)->format('dmy');
            $maxCod = Sale::where('code','like','V'.$center.$date.'%')->max(\DB::raw('substr(code,11,3)'));
            $sale->code = 'V'.$center.$date.str_pad(++$maxCod,3,'0',STR_PAD_LEFT);
            return true;
        });
    }
}
