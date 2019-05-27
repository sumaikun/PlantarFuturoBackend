<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DryRavineRound extends Model
{
    protected $table = 'dry_ravine_rounds';
    protected $fillable =['code','waterdam','wd_location','wd_description','materialdrag','md_location','md_description','noises','ns_location','ns_description','level','responsible_name','responsible_id','observations','project_id','user_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
