<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HillsideDisplacement extends Model
{
    protected $table = 'hillside_displacements';
    protected $fillable =['code','report_date','longitude','width','new','location','description','level','responsible_name','responsible_id','observations','project_id','user_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
