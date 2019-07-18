<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SSTReport extends Model
{
   	protected $table = 'sst_reports';
    protected $fillable = ['report_date', 'location', 'goal', 'responsible', 'notes', 'progress_img1', 'progress_img2', 'progress_img3', 'progress_img4', 'project_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    function assistants()
    {
    	return $this->hasMany('App\Models\Assistant');
    }

    function report_visitors()
    {
        return $this->hasMany('App\Models\ReportVisitor');
    }
}
