<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suppliers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SuppliersController extends Controller
{
    /**
     * Prikaz svih dobavljača.
     */
    public function index()
    {
        $suppliers = Suppliers::with('user')->get();
        return view('suppliers/index', compact('suppliers'));
    }

    /**
     * Prikaz forme za kreiranje novog dobavljača.
     */
    public function create()
    {
        $users = User::all();
        return view('suppliers/create', compact('users'));
    }

    /**
     * Spremanje novog dobavljača.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('suppliers', 'user_id'),
            ],
            'contact_person' => 'nullable|string|max:255',
        ]);

        Suppliers::create($validated);

        return redirect()->route('admin.suppliers')->with('success', 'Supplier updated successfully!');
    }

    /**
     * Prikaz forme za uređivanje dobavljača.
     */
    public function edit(Suppliers $supplier)
    {
        $users = User::all();
        return view('suppliers/edit', compact('supplier', 'users'));
    }

    /**
     * Ažuriranje dobavljača.
     */
    public function update(Request $request, Suppliers $supplier)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'contact_person' => 'nullable|string|max:255',
        ]);

        $supplier->update($validated);

        return redirect()->route('admin.suppliers')->with('success', 'Supplier updated successfully!');
    }

    /**
     * Brisanje dobavljača.
     */
    public function destroy(Suppliers $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers/index')->with('success', 'Supplier deleted successfully!');
    }
}
