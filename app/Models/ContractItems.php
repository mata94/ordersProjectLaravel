<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractItems extends Model
{
    protected $fillable = [
        'contract_id',
        'item_id',
        'quantity',
        'price_per_unit'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
