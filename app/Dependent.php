<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dependent extends Model
{
    use SoftDeletes;

    protected $table = 'dependents';
    
    protected $fillable = [
        'dependent_type_id', 'document_type_id', 'gender_id', 'user_id', 
        'name', 'lastname', 'document', 'birthdate' 
    ];

    public function getFullnameAttribute() {
        return $this->lastname.', '.$this->name;
    }

    public function dependentType()
    {
    	return $this->belongsTo(DependentType::class);
    }

    public function documentType()
    {
    	return $this->belongsTo(DocumentType::class);
    }

    public function gender()
    {
    	return $this->belongsTo(Gender::class);
    }
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}