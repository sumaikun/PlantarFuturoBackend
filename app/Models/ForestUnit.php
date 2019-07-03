<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForestUnit extends Model
{
    protected $table = 'forest_units';
    protected $fillable = ['inspector','code','common_name','scientific_name','family','cap_cm','total_heigth_m','commercial_heigth_m','x_cup_diameter_m','y_cup_diameter_m','north_coord','east_coord','waypoint','epiphytes','condition','health_status','origin','cup_density','products','margin','treatment','state','resolution','start_treatment','end_treatment','functional_unit_id','note'];

    public function functional_unit()
    {
        return $this->belongsTo('App\Models\FunctionalUnit');
    }

    function responsabilities()
    {
        return $this->hasMany('App\Models\Responsability');
    }
}
