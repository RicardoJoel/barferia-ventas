<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    protected const LONGITUD_CODIGO = 60;
    protected const PERMITTED_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    protected const EMAIL_ACT_ACCNT = '¡Bienvenido!';
    protected const EMAIL_PSW_RESET = 'Notificación de restablecimiento de contraseña';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'document_type_id', 'document', 'gender_id', 'birthdate', 
        'address', 'country_id', 'ubigeo_id', 'other_ubigeo', 'mobile', 'phone', 'annex', 'alt_email',
        'relationship_id', 'profile_id', 'center_id', 'str_salary', 'cur_salary', 'commission', 'frequency_id', 'start_at', 'end_at',
        'bank_id', 'bank_account', 'cci', 'afp_id', 'commission_id', 'cuspp', 'cts_id', 'cts_account', 'eps_id', 'essalud',
        'contact_fullname', 'contact_relationship', 'contact_address', 'contact_country_id', 'contact_ubigeo_id', 
        'contact_other_ubigeo', 'contact_mobile', 'contact_phone', 'contact_annex', 'password'
    ];

    /**
     * Default values for attributes
     * @var array an array with attribute as key and default as value
     */
    protected $attributes = [
        'is_admin' => false
    ];

    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'is_admin', 'code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'confirmation_code'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];
    
    public function getFullnameAttribute() {
        return $this->lastname.', '.$this->name;
    }
    
    public function getFullnameCodeAttribute() {
        return $this->lastname.', '.$this->name.' - '.$this->code;
    }

    public function getCodeMobileAttribute() {
        return ($this->country->code ?? '').' '.$this->mobile;
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

    public function gender()
    {
    	return $this->belongsTo(Gender::class);
    }

    public function relationship()
    {
    	return $this->belongsTo(Relationship::class);
    }

    public function profile()
    {
    	return $this->belongsTo(Profile::class);
    }
    
    public function center()
    {
    	return $this->belongsTo(Center::class);
    }

    public function bank()
    {
    	return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function afp()
    {
    	return $this->belongsTo(AFP::class);
    }

    public function cts()
    {
    	return $this->belongsTo(Bank::class, 'cts_id');
    }

    public function eps()
    {
    	return $this->belongsTo(EPS::class);
    }

    public function afpCommission()
    {
    	return $this->belongsTo(Commission::class, 'commission_id');
    }

    public function frequency()
    {
    	return $this->belongsTo(Frequency::class);
    }

    public function dependents()
    {
    	return $this->hasMany(Dependent::class);
    }

    public function variations()
    {
    	return $this->hasMany(Variation::class)->orderBy('start_at');
    }

    public function inventories()
    {
    	return $this->hasMany(Inventory::class);
    }
    
    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(User $user) {
            $maxCod = User::where('code','LIKE','U'.date('Y').'%')->max(\DB::raw('substr(code,6,3)'));
            $user->code = 'U'.date('Y').str_pad(++$maxCod,3,'0',STR_PAD_LEFT);
            $user->cur_salary = $user->str_salary;
            $user->generateConfirmationCode();
            return true;
        });
    }

    /**
     * Generates the value for the User::confirmation_code field. Used to 
     * activate the user's account.
     * @return bool 
     */
    protected function generateConfirmationCode()
    {
        $length = strlen(self::PERMITTED_CHARS);
        $rndStr = '';

        for ($i=0; $i<self::LONGITUD_CODIGO; $i++) {
            $rndChr = self::PERMITTED_CHARS[mt_rand(0, $length - 1)];
            $rndStr .= $rndChr;
        }
        $this->attributes['confirmation_code'] = $rndStr;

        return !is_null($this->attributes['confirmation_code']);
    }

    public function sendEmailVerificationNotification()
    {
        $data = ['name' => $this->name, 'code' => $this->confirmation_code];

        Mail::send('emails.verify', $data, function($message) {
            $message->subject(self::EMAIL_ACT_ACCNT);
            $message->to($this->email);
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $data = ['name' => $this->name, 'code' => $token];

        Mail::send('emails.reset', $data, function($message) {
            $message->subject(self::EMAIL_PSW_RESET);
            $message->to($this->email);
        });
    }
}