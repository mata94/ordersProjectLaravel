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

Route::resource('worker/suppliers', \App\Http\Controllers\Worker\SuppliersWorker::class)->names([
    'show' => 'worker.suppliers.show',
]);


Route::get('worker/supplier/{id}/create-contract', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'createContract'])
    ->name('worker.suppliers.createContract');

Route::post('worker/supplier/contract/{contractId}/add-item', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'addItemToContract'])
    ->name('contract.addItem');

Route::post('/contract/{id}/finish', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'finishContract'])->name('contract.finish');
