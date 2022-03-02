<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Inventory extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventories';
    
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
        return self::hasMany(InventoryDetail::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Inventory $inventory) {
            $center = $inventory->center->nemo;
            $date = Carbon::parse($inventory->date)->format('dmy');
            $maxCod = Inventory::where('code','like','I'.$center.$date.'%')->max(\DB::raw('substr(code,11,2)'));
            $inventory->code = 'I'.$center.$date.str_pad(++$maxCod,2,'0',STR_PAD_LEFT);
            return true;
        });
    }
}
