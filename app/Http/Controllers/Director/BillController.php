<?php

namespace App\Http\Controllers\Director;

use App\Exports\BillsExport;
use App\Models\Bill;
use App\Models\Contract;
use Maatwebsite\Excel\Facades\Excel;

class BillController
{
    public function getAllBills()
    {
        $bills = Bill::all();
        return view('director.bills', compact('bills'));
    }

    // Director/BillController.php
    public function showItems($contract)
    {
        $contract = Contract::with('items')->findOrFail($contract);
        return view('director.billitems', compact('contract'));
    }


    public function export()
    {
        return Excel::download(new BillsExport(), 'bills.xlsx');
    }
}
