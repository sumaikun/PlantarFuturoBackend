<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';
    protected $fillable = ['file', 'pass', 'contract_document_id', 'user_id'];

    public function contract_document()
    {
        return $this->belongsTo('App\Models\ContractDocument');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
