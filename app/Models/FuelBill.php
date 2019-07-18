<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelBill extends Model
{
    protected $table = 'fuel_bills';
    protected $fillable =['quantity','price','bill_date','voucher','fuel_id','tool_id'];

    public function fuel()
    {
        return $this->belongsTo('App\Models\Fuel');
    }

    public function tool()
    {
        return $this->belongsTo('App\Models\Tool');
    }
}
