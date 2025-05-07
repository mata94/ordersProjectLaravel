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
        $supplierItems = SupplierItems::with('item')->where('supplier_id', $id)->get();
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
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $contract = Contract::findOrFail($contractId);
        $item = Item::findOrFail($request->item_id);

        ContractItems::create([
            'contract_id' => $contract->id,
            'item_id' => $item->id,
            'quantity' => $request->quantity,
            'price_per_unit' => $item->unit_price,
        ]);

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

        return redirect()->route('worker.suppliers.show', $contract->supplier_id)
            ->with('success', 'Contract finalized.');
    }
}
