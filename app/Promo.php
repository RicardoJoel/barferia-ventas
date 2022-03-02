<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Promo extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promos';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'start_at', 'end_at', 'type', 'amount'
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

    public function getStatusAttribute() {
        $start_at = Carbon::parse($this->start_at);
        $end_at = Carbon::parse($this->end_at);
        $today = Carbon::today();
        return $today->lt($start_at) ? 'PROXIMA' : ($today->gt($end_at) ? 'CADUCADA' : 'VIGENTE');
    }

    public function getNormalPriceAttribute() {
        $total = 0;
        foreach ($this->details as $det)
            $total += $det->subtotal;
        return $total;
    }

    public function getPriceAttribute() {
        return $this->type == 'M' ? $this->amount : $this->normalPrice * (1 - $this->amount/100);
    }

    public function getTotalItemsAttribute() {
        $total = 0;
        foreach ($this->details as $detail)
            $total += $detail->quantity;
        return $total;
    }

    public function details()
    {
        return self::hasMany(PromoDetail::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Promo $cust) {
            $maxCod = Promo::where('code','like','O'.date('Y').'%')->max(\DB::raw('substr(code,6,3)'));
            $cust->code = 'O'.date('Y').str_pad(++$maxCod,3,'0',STR_PAD_LEFT);
            return true;
        });
    }
}
