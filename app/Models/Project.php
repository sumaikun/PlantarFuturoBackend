<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable =['name','inspector','responsible','representative_name','representative_position','administrative_act','enviromental_control','east_coord','north_coord','location','phase','customer_id'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    function functional_units()
    {
    	return $this->hasMany('App\Models\FunctionalUnit');
    }

    function contractors()
    {
        return $this->hasMany('App\Models\Contractor');
    }
}
