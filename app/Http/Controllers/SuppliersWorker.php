<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;

class SuppliersWorker
{
    public function index()
    {
        $suppliers = Suppliers::all();
    }


}
