<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunctionalUnit extends Model
{
    protected $table = 'functional_units';
    protected $fillable =['code','project_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    function forest_units()
    {
    	return $this->hasMany('App\Models\ForestUnit');
    }
}
