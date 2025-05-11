<?php

namespace App\Http\Controllers\Director;

use App\Exports\BillsExport;
use App\Models\Bill;
use Maatwebsite\Excel\Facades\Excel;

class BillController
{
    public function getAllBills()
    {
        $bills = Bill::all();
        return view('director.bills', compact('bills'));
    }

    public function export()
    {
        return Excel::download(new BillsExport(), 'bills.xlsx');
    }
}
