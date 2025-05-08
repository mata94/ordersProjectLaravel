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

Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':worker'])->group(function () {
    Route::get('worker/suppliers', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'index'])
        ->name('worker.suppliers.index');

    Route::get('worker/suppliers/{id}', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'showWorkerSuppliers'])
        ->name('worker.suppliers.showWorkerSuppliers');

    Route::get('worker/supplier/{id}/create-contract', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'createContract'])
        ->name('worker.suppliers.createContract');

    Route::post('worker/supplier/contract/{contractId}/add-item', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'addItemToContract'])
        ->name('contract.addItem');

    Route::post('/contract/{id}/finish', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'finishContract'])
        ->name('contract.finish');

    Route::get('worker/contracts', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'myContracts'])
        ->name('worker.contract.myContracts');

    Route::get('worker/contract/{contractId}/items', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'contractItems'])
        ->name('worker.myContract.contractItems');
});

use App\Http\Controllers\AuthController;

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
