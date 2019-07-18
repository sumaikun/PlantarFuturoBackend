<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $table = 'contractors';
    protected $fillable = ['project_id','role_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    function assistants()
    {
        return $this->hasMany('App\Models\Assistant');
    }
}
