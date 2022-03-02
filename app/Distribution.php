<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Distribution extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'distributions';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'origin_id', 'destiny_id', 'user_id', 'date', 'status', 'closed_at', 'verified_at'
    ];

    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'code'
    ];

    public function origin()
    {
    	return $this->belongsTo(Center::class, 'origin_id');
    }

    public function destiny()
    {
    	return $this->belongsTo(Center::class, 'destiny_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function details()
    {
        return self::hasMany(DistributionDetail::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Distribution $distribution) {
            $center = $distribution->destiny->nemo;
            $date = Carbon::parse($distribution->date)->format('dmy');
            $maxCod = Distribution::where('code','like','D'.$center.$date.'%')->max(\DB::raw('substr(code,11,2)'));
            $distribution->code = 'D'.$center.$date.str_pad(++$maxCod,2,'0',STR_PAD_LEFT);
            return true;
        });
    }
}
