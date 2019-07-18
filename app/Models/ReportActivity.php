<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportActivity extends Model
{
    protected $table = 'report_activities';
    protected $fillable = ['hours', 'quantity', 'activity_id', 'daily_report_id'];

    public function daily_report()
    {
        return $this->belongsTo('App\Models\DailyReport');
    }

    function activity()
    {
    	return $this->belongsTo('App\Models\Activity');
    }
}
