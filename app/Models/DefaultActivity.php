<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DefaultActivity extends Model
{
    protected $table = 'default_activities';
    protected $fillable = ['name', 'measuring_unit', 'activity_type_id'];

    public function activity_type()
    {
        return $this->belongsTo('App\Models\ActivityType');
    }

    function report_activities()
    {
    	return $this->hasMany('App\Models\ReportActivity');
    }
}
