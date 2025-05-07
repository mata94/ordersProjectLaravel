<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'supplier_id',
        'user_id',
        'contract_number',
        'total_value',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class);
    }

    public function contractItems()
    {
        return $this->hasMany(ContractItems::class);
    }
}
