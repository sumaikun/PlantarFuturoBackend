<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $table = 'fuels';
    protected $fillable =['name','measuring_unit','abbreviation'];

    public function fuel_bills()
    {
    	return $this->hasMany('App\Models\FuelBill');
    }
}
