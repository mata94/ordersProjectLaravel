<?php

namespace App\Http\Controllers\Worker;

use App\Models\Bill;
use App\Models\Contract;

class BillController
{
    public function getAllBills()
    {
        $bills = Bill::where('created_by', auth()->id())->with('contract')->get();
        return view('worker.bills', compact('bills'));
    }

    public function createBill($contractId)
    {
        $contract = Contract::findOrFail($contractId);

        if($contract->status === Contract::APPROVED){
            Bill::create([
                'contract_id' => $contractId,
                'supplier_id' => $contract->supplier_id,
                'amount' => $contract->total_value,
                'created_by' => auth()->id(),
            ]);
        }

        return redirect()->route('worker.bills');
    }
}
