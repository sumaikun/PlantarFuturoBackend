<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressReport extends Model
{
    protected $table = 'progress_reports';
    protected $fillable = ['name', 'deadline', 'file', 'project_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
