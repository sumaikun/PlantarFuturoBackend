<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForestalName extends Model
{
    protected $table = 'common_names';
    protected $fillable = ['common_name','scientific_name'];
}
