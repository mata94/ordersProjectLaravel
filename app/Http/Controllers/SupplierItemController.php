<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\SupplierItems;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class SupplierItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();


        return view('itemSuppliers/index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $supplierId = 1; // fiksni supplier ID

        $item = Item::findOrFail($validated['item_id']); // dohvat cijene

        SupplierItems::create([
            'supplier_id' => $supplierId,
            'item_id' => $validated['item_id'],
            'quantity' => $validated['quantity'],
            'price_per_unit' => $item->unit_price, // OBAVEZNO DODANO
        ]);

        return redirect()->back()->with('success', 'Item added to supplier list successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show($supplierId)
    {
        $supplier = Suppliers::findOrFail($supplierId);
        $items = $supplier->items; // Pretpostavljam da imaš relaciju items na Supplier modelu

        return view('itemSuppliers.addeditems', compact('supplier', 'items'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
