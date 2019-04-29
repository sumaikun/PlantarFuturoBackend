<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = 'document_types';
    protected $fillable =['name','abbreviation'];

    function users()
    {
    	return $this->hasMany('App\Models\User');
    }
}
