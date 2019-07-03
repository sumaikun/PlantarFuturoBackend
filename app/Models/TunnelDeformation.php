<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TunnelDeformation extends Model
{
    protected $table = 'tunnel_deformations';
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
