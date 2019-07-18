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

    public function functional_units()
    {
    	return $this->hasMany('App\Models\FunctionalUnit');
    }

    public function contractors()
    {
        return $this->hasMany('App\Models\Contractor');
    }

    public function tunnel_deformations()
    {
        return $this->hasMany('App\Models\TunnelDeformation');
    }

    public function hillside_displacements()
    {
        return $this->hasMany('App\Models\HillsideDisplacement');
    }

    public function hillside_rounds()
    {
        return $this->hasMany('App\Models\HillsideRound');
    }

    public function dry_ravine_rounds()
    {
        return $this->hasMany('App\Models\DryRavineRound');
    }

    public function precipitations()
    {
        return $this->hasMany('App\Models\Precipitation');
    }

    public function sst_reports()
    {
        return $this->hasMany('App\Models\SSTReport');
    }

    public function visitors()
    {
        return $this->hasMany('App\Models\Visitor');
    }

    public function epp_requests()
    {
        return $this->hasMany('App\Models\EPPRequest');
    }

    public function progress_reports()
    {
        return $this->hasMany('App\Models\ProgressReport');
    }

    public function daily_reports()
    {
        return $this->hasMany('App\Models\DailyReport');
    }

    public function tool_asignations()
    {
        return $this->hasMany('App\Models\ToolAsignation');
    }

    public function fuel_bills()
    {
        return $this->hasMany('App\Models\FuelBill');
    }

    public function material_bills()
    {
        return $this->hasMany('App\Models\MaterialBill');
    }
}
