<?php

namespace App\Http\Controllers\Worker;

use App\Models\Contract;
use App\Models\ContractItems;
use App\Models\Item;
use App\Models\SupplierItems;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SuppliersWorker
{
    public function index()
    {
        $suppliers = Suppliers::all();
        return view('workerSuppliers/index', compact('suppliers'));
    }

    public function showWorkerSuppliers($id)
    {
        $supplier = Suppliers::findOrFail($id);
        $supplierItems = SupplierItems::with('item')->where('supplier_id', $id)
            ->get();

        return view('workerSuppliers/showItems', compact('supplier', 'supplierItems'));
    }

    public function createContract($id)
    {
        $supplier = Suppliers::findOrFail($id);
        $supplierItems = SupplierItems::with('item')->where('supplier_id', $id)->where('quantity', '>', 0)->get();
        $contractId = request()->input('contractId');

        if ($contractId) {
            $contract = Contract::find($contractId);
        } else {
            $contract = $this->createNewContract($id);
        }
        return view('workerSuppliers/itemsForContract', [
            'supplier' => $supplier,
            'supplierItems' => $supplierItems,
            'contract' => $contract,
            'contractItems' => $contract->contractItems()->with('item')->get(),
        ]);
    }

    private function createNewContract($id)
    {
        $userId = auth()->id() ?? 1;

        return Contract::create([
            'supplier_id' => $id,
            'user_id' => $userId,
            'contract_number' => Str::upper(Str::random(10)),
            'total_value' => 0.00,
        ]);
    }

    public function addItemToContract(Request $request,$contractId)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $contract = Contract::findOrFail($contractId);
        $item = Item::findOrFail($request->item_id);

        $supplier = $contract->supplier;

        $supplierItem = $supplier->supplierItems()
            ->where('item_id', $item->id)
            ->first();

        $supplierItem->update([
            'quantity' => $supplierItem->quantity - $request->quantity,
        ]);

        $contractItem = $contract->contractItems()
            ->where('item_id', $item->id)
            ->first();

        if($contractItem){
            $contractItem->update(['quantity' => $contractItem->quantity + $request->quantity]);
        }else{
            ContractItems::create([
                'contract_id' => $contract->id,
                'item_id' => $item->id,
                'quantity' => $request->quantity,
                'price_per_unit' => $item->unit_price,
            ]);
        }

        $total = ContractItems::where('contract_id', $contract->id)
            ->get()
            ->sum(function ($ci) {
                return $ci->quantity * $ci->price_per_unit;
            });

        $contract->update(['total_value' => $total]);

        return redirect()->route('worker.suppliers.createContract', ['id' => $contract->supplier_id, 'contractId' => $contract->id])
            ->with('success', 'Item added and contract updated.');
    }

    public function finishContract($id)
    {
        $contract = Contract::findOrFail($id);
        $contract->update([
            'start_date' => now(),
            'end_date' => now()->addYear(),
        ]);

        return redirect()->route('worker.suppliers.index', $contract->supplier_id)
            ->with('success', 'Contract finalized.');
    }

    public function myContracts()
    {
        $userId = auth()->id();

        $contracts = Contract::where('user_id', $userId)
            ->with('supplier', 'user')
            ->get();

        return view('workerSuppliers/myContracts',[
            "contracts" => $contracts,
        ]);
    }

    public function unpaidContracts()
    {
        $userId = auth()->id();

        $contracts = Contract::where('user_id', $userId)
            ->where('status', Contract::APPROVED)
            ->whereDoesntHave('bills')
            ->with('supplier', 'user')
            ->get();

        return view('workerSuppliers/unpaidContracts',[
            "contracts" => $contracts,
        ]);
    }

    public function contractItems($contractId)
    {
        $contractItems = ContractItems::where('contract_id',$contractId)->with('item')->get();
        return view('workerSuppliers/contractItems', [
            'contractItems' => $contractItems,
        ]);
    }

    public function deletePendingContract($contractId)
    {
        $contract = Contract::findOrFail($contractId);
        $contractItems = $contract->contractItems();
        if($contractItems){
            foreach ($contractItems as $contractItem) {
                $contractItem->delete();
            }
        }

        $contract->delete();
        return redirect()->route('worker.contract.myContracts');
    }
}
