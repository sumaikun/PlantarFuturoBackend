<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HillsideRound extends Model
{
    protected $table = 'hillside_rounds';
    protected $fillable =['code','report_date','landslides','ls_location','ls_description','rockfall','rf_location','rf_description','noises','ns_location','ns_description','level','responsible_name','responsible_id','observations','project_id','user_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
