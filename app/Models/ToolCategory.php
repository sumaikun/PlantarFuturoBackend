<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolCategory extends Model
{
    protected $table = 'tool_categories';
    protected $fillable =['name'];

    public function tools()
    {
        return $this->hasMany('App\Models\Tool');
    }
}
