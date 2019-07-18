<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';
    protected $fillable = ['name', 'document', 'entity', 'position', 'state', 'project_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    function report_visitors()
    {
    	return $this->hasMany('App\Models\ReportVisitor');
    }
}
