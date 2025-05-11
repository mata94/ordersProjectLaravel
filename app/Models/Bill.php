<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'supplier_id',
        'contract_id',
        'amount',
        'created_by',
    ];

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
