<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierItems extends Model
{
    // Ovdje navodimo naziv tablice ako je drugačiji od predložene
    protected $table = 'supplier_items';

    // Popis dopuštenih atributa za masovno dodavanje
    protected $fillable = [
        'supplier_id',
        'item_id',
        'quantity',
        'price_per_unit',
    ];

    // Ako koristiš soft delete
    // use SoftDeletes;

    // Ako trebaš dodatnu logiku, možeš ovdje definirati metode
}

