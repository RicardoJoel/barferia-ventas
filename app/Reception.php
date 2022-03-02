<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Reception extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'receptions';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'distribution_id', 'user_id', 'date', 'status', 'closed_at'
    ];

    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'code'
    ];

    public function distribution()
    {
    	return $this->belongsTo(Distribution::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function details()
    {
        return self::hasMany(ReceptionDetail::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Reception $reception) {
            $center = $reception->distribution->destiny->nemo;
            $date = Carbon::parse($reception->date)->format('dmy');
            $maxCod = Reception::where('code','like','R'.$center.$date.'%')->max(\DB::raw('substr(code,11,2)'));
            $reception->code = 'R'.$center.$date.str_pad(++$maxCod,2,'0',STR_PAD_LEFT);
            return true;
        });
    }
}
