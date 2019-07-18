<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolAsignation extends Model
{
    protected $table = 'tool_asignations';
    protected $fillable =['state','checkin','checkout','transfer_notes','evidence_photo','project_id','tool_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function tool()
    {
        return $this->belongsTo('App\Models\Tool');
    }
}
