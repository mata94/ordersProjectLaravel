<?php

namespace App\Http\Controllers\Worker;

use App\Models\Suppliers;

class SuppliersWorker
{
    public function index()
    {
        $suppliers = Suppliers::all();
    }


}
