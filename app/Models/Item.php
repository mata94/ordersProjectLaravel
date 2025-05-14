<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'item_name',
        'item_description',
        'unit_price',
    ];

    public function suppliers()
    {
        return $this->belongsToMany(Suppliers::class, 'supplier_items')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function supplierItems()
    {
        return $this->hasMany(SupplierItems::class);
    }

    public function contracts()
    {
        return $this->belongsToMany(Contract::class, 'contract_items', 'item_id', 'contract_id');
    }

}
