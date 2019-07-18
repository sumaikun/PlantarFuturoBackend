<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportVisitor extends Model
{
    protected $table = 'report_visitors';
    protected $fillable = ['report_visitors', 'visitor_id', 'sst_report_id'];

    public function visitor()
    {
        return $this->belongsTo('App\Models\Visitor');
    }

    public function sst_report()
    {
        return $this->belongsTo('App\Models\SSTReport');
    }
}
