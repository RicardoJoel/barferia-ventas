<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Production extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'productions';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'center_id', 'user_id', 'date', 'status', 'closed_at'
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

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function details()
    {
        return self::hasMany(ProductionDetail::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Production $production) {
            $center = $production->center->nemo;
            $date = Carbon::parse($production->date)->format('dmy');
            $maxCod = Production::where('code','like','P'.$center.$date.'%')->max(\DB::raw('substr(code,11,2)'));
            $production->code = 'P'.$center.$date.str_pad(++$maxCod,2,'0',STR_PAD_LEFT);
            return true;
        });
    }
}