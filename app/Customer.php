<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_type_id', 'country_id', 'name', 'lastname', 'document', 'birthdate', 'email', 'mobile', 'phone'
    ];
        
    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'code'
    ];

    public function getNatFullnameAttribute() {
        return $this->name.' '.$this->lastname;
    }

    public function getFullnameAttribute() {
        return $this->lastname.', '.$this->name;
    }

    public function getFullnameCodeAttribute() {
        return $this->lastname.', '.$this->name.' ('.$this->code.')';
    }

    public function getCodeMobileAttribute() {
        return $this->mobile ? ($this->country->code ?? '').' '.$this->mobile : '';
    }
    
    public function documentType()
    {
    	return $this->belongsTo(DocumentType::class);
    }
    
    public function country()
    {
    	return $this->belongsTo(Country::class);
    }
    
    public function pets()
    {
    	return $this->hasMany(Pet::class);
    }

    public function locations()
    {
    	return $this->hasMany(Location::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Customer $cust) {
            $maxCod = Customer::where('code','like','C'.date('Y').'%')->max(\DB::raw('substr(code,6,3)'));
            $cust->code = 'C'.date('Y').str_pad(++$maxCod,3,'0',STR_PAD_LEFT);
            return true;
        });
    }
}
