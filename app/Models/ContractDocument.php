<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractDocument extends Model
{
    protected $table = 'contract_documents';
    protected $fillable = ['name'];

    public function contracts()
    {
        return $this->hasMany('App\Models\Contract');
    }
}
