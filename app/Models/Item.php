<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $primaryKey = 'item_id';

    protected $fillable = [
        'item_name',
        'item_description',
        'unit_price',
    ];
}
