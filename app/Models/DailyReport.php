<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $table = 'daily_reports';
    protected $fillable = ['responsible', 'field_assistant', 'location', 'report_date', 'people_number', 'type', 'project_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    function report_activities()
    {
    	return $this->hasMany('App\Models\ReportActivity');
    }
}
