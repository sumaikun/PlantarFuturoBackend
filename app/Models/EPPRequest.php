<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EPPRequest extends Model
{
    protected $table = 'epp_requests';
    protected $fillable = ['report_date', 'subject', 'request', 'project_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
