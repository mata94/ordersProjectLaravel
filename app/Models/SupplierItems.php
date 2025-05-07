<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierItems extends Model
{
    protected $table = 'supplier_items';


    protected $fillable = [
        'supplier_id',
        'item_id',
        'quantity',
        'price_per_unit',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

}

