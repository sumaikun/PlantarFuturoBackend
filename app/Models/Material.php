<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';
    protected $fillable =['name','measuring_unit','abbreviation'];

    public function material_bills()
    {
        return $this->hasMany('App\Models\MaterialBill');
    }
}
