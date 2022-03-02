<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentType extends Model
{
    use SoftDeletes;

    protected $table = 'document_types';
    
    protected $fillable = [
        'name', 'code', 'length', 'is_number', 'is_exact'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }

    public function contacts()
    {
    	return $this->hasMany(Contact::class);
    }

    public function dependents()
    {
    	return $this->hasMany(Dependent::class);
    }
}
