<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $table = 'suppliers';
    
    protected $fillable = [
        'profile_id', 'document_type_id', 'ubigeo_id', 'country_id', 'bank_id', 
        'name', 'document', 'address', 'other_profile', 'other_ubigeo', 
        'mobile', 'phone', 'annex', 'email', 'account', 'cci'
    ];
    
    protected $guarded = [
        'id', 'code'
    ];

    public function getCodeMobileAttribute() {
        return ($this->country->code ?? '').' '.$this->mobile;
    }
    
    public function profile()
    {
    	return $this->belongsTo(Profile::class);
    }
    
    public function documentType()
    {
    	return $this->belongsTo(DocumentType::class);
    }
    
    public function ubigeo()
    {
    	return $this->belongsTo(Ubigeo::class);
    }
    
    public function country()
    {
    	return $this->belongsTo(Country::class);
    }
        
    public function bank()
    {
    	return $this->belongsTo(Bank::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Supplier $supplier) {
            $maxCod = Supplier::where('code','like','S'.date('Y').'%')->max(\DB::raw('substr(code,6,3)'));
            $supplier->code = 'S'.date('Y').str_pad(++$maxCod,3,'0',STR_PAD_LEFT);
            return true;
        });
    }
}