<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public const PENDING = 'Pending';
    public const REJECTED = 'Rejected';
    public const APPROVED = 'Approved';

    protected $fillable = [
        'supplier_id',
        'user_id',
        'contract_number',
        'total_value',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'approved_at' => 'datetime',
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

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'contract_items', 'contract_id', 'item_id')
            ->withPivot('quantity', 'price_per_unit')
            ->withTimestamps();
    }
}
