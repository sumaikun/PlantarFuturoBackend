<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsability extends Model
{
    protected $table = 'responsabilities';
    protected $fillable =['t_responsible','forest_unit_id','user_id'];

    public function forest_unit()
    {
        return $this->belongsTo('App\Models\ForestUnit');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
