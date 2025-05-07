<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('items', \App\Http\Controllers\ItemController::class);

Route::resource('suppliers', \App\Http\Controllers\SuppliersController::class);

Route::resource('contracts', \App\Http\Controllers\ContractController::class);

Route::resource('supplier-items', \App\Http\Controllers\SupplierItemController::class);

Route::get('/supplier-items/{supplier}', [\App\Http\Controllers\SupplierItemController::class, 'show'])->name('supplier-items.show');

