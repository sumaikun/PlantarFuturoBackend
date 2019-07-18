<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    protected $table = 'assistants';
    protected $fillable = ['assistance', 'checkin', 'checkout', 'reason', 'notes', 'contractor_id', 'sst_report_id'];

    public function contractor()
    {
        return $this->belongsTo('App\Models\Contractor');
    }

    public function sst_report()
    {
        return $this->belongsTo('App\Models\SSTReport');
    }
}
