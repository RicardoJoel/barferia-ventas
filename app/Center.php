<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Center extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'centers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nemo', 'type', 'ubigeo_id', 'address', 'other_ubigeo', 'ref', 'lat', 'lng' 
    ];

    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'code'
    ];

    public function ubigeo()
    {
    	return $this->belongsTo(Ubigeo::class);
    }
    
    public function manager()
    {
    	return $this->hasOne(User::class);
    }

    public function inventories()
    {
    	return $this->hasMany(Inventory::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Center $center) {
            $maxCod = Center::where('code','like','L'.date('Y').'%')->max(\DB::raw('substr(code,6,3)'));
            $center->code = 'L'.date('Y').str_pad(++$maxCod,3,'0',STR_PAD_LEFT);
            return true;
        });
    }
}
