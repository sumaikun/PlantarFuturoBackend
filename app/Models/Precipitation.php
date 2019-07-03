<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Precipitation extends Model
{
    protected $table = 'precipitations';
    protected $fillable =['code','report_date','type','mm_hours','start','finish','level','responsible_name','responsible_id','observations','project_id','user_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
