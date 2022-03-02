<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Stock extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stocks';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'center_id', 'date'
    ];

    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'code'
    ];

    public function center()
    {
    	return $this->belongsTo(Center::class);
    }

    public function details()
    {
        return self::hasMany(StockDetail::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Stock $stock) {
            $center = $stock->center->nemo;
            $date = Carbon::parse($stock->date)->format('dmy');
            $maxCod = Stock::where('code','like','S'.$center.$date.'%')->max(\DB::raw('substr(code,11,2)'));
            $stock->code = 'S'.$center.$date.str_pad(++$maxCod,2,'0',STR_PAD_LEFT);
            return true;
        });
    }
}
