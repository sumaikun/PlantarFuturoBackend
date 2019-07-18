<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $table = 'tools';
    protected $fillable =['code','name','description','type','model','customer','workfront','condition','provider','remaining_service','buy_date','price', 'tool_category_id'];

    public function tool_category()
    {
        return $this->belongsTo('App\Models\ToolCategory');
    }

    public function tool_asignations()
    {
        return $this->hasMany('App\Models\ToolAsignation');
    }
}
