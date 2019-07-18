<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $table = 'activity_types';
    protected $fillable = ['name'];

    function default_activities()
    {
        return $this->hasMany('App\Models\DefaultActivity');
    }
}
