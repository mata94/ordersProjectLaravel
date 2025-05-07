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

}
