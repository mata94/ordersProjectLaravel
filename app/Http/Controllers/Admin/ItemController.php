<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return view('items/index', compact('items'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
            'unit_price' => 'required|numeric|min:0',
        ]);

        Item::create([
            'item_name' => $request->item_name,
            'item_description' => $request->item_description,
            'unit_price' => $request->unit_price,
        ]);

        return redirect()->route('admin.items')->with('success', 'Item created successfully!');
    }

    /**
     * Display the specified resource.
     */

        public function show($item_id)
    {

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($item_id)
    {
        $item = Item::findOrFail($item_id);
        return view('items/edit', compact('item'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->only(['item_name', 'item_description', 'unit_price']));

        return redirect()->route('admin.items')->with('success', 'Item updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($item_id)
    {
        Item::destroy($item_id);
        return redirect()->route('admin.items')->with('success', 'Item deleted successfully!');
    }

}
