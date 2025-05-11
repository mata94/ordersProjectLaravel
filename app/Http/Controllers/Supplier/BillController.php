<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Bill;
use App\Models\Suppliers;

class BillController
{
    public function getAllBills()
    {
        $supplier = Suppliers::where('user_id', auth()->id())->first();
        $bills = Bill::where('supplier_id', $supplier->id)->with('contract')->get();
        return view('suppliers.bills', compact('bills'));
    }
}
