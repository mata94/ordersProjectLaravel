<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'user_id',
        'contact_person',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'supplier_items','supplier_id','item_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function supplierItems()
    {
        return $this->hasMany(SupplierItems::class, 'supplier_id','id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}

