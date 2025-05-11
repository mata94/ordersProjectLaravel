<?php

namespace App\Http\Controllers\Director;

use App\Models\Contract;
use App\Models\ContractItems;
use Illuminate\Http\Request;

class ContractController
{
    public function __construct(
        private Request $request
    ){}

    public function allContracts()
    {
        $contracts = Contract::whereIn('status', [Contract::APPROVED, Contract::REJECTED])->get();
        return view('director.allContracts', compact('contracts'));
    }

    public function getAllPendingContracts()
    {
        $contracts = Contract::where('status', Contract::PENDING)->get();
        return view('director.pendingContracts', compact('contracts'));
    }

    public function getContractItems($contractId)
    {
        $contractItems = ContractItems::where('contract_id',$contractId)->with('item')->get();
        return view('director.contractItems', compact('contractItems'));
    }

    public function changeStatus($contractId)
    {
        $contract = Contract::findOrFail($contractId);
        $status = strtolower($this->request->get('status'));

        if($status === 'rejected'){
            $contract->status = Contract::REJECTED;
            $contract->approved_by = auth()->id();
            $contract->approved_at = now();
            $contract->save();

            return redirect(route('director.pendingContracts'))->with('success', 'Contract status updated successfully.');
        }elseif($status === 'approved'){
            $contract->status = Contract::APPROVED;
            $contract->approved_by = auth()->id();
            $contract->approved_at = now();
            $contract->save();

            return redirect(route('director.pendingContracts'))->with('success', 'Contract status updated successfully.');
        }else{
            $contract->status = Contract::PENDING;
            $contract->approved_by = null;
            $contract->approved_at = null;
            $contract->save();
            return redirect(route('director.pendingContracts'))->with('error', 'Invalid contract status');
        }
    }
}
