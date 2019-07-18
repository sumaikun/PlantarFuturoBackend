<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document', 'name', 'lastname', 'phone', 'address', 'position', 'email', 'password', 'document_type_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function position()
    {
        return $this->belongsTo('App\Models\Position');
    }

    public function document_type()
    {
        return $this->belongsTo('App\Models\DocumentType');
    }

    function contractors()
    {
        return $this->hasMany('App\Models\Contractor');
    }

    function responsabilities()
    {
        return $this->hasMany('App\Models\Responsability');
    }

    function contracts()
    {
        return $this->hasMany('App\Models\Contract');
    }
}
