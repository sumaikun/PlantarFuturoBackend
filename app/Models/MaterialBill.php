<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialBill extends Model
{
    protected $table = 'projects';
    protected $fillable =['quantity','price','bill_date','voucher','material_id','project_id'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function material()
    {
        return $this->belongsTo('App\Models\Material');
    }
}
