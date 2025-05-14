<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\BaseController::class, 'index'])->name('index');

Route::resource('contracts', \App\Http\Controllers\ContractController::class);

Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':director'])->group(function () {
    Route::get('/director/pending-contracts', [\App\Http\Controllers\Director\ContractController::class, 'getAllPendingContracts'])->name('director.pendingContracts');
    Route::get('/director/contracts', [\App\Http\Controllers\Director\ContractController::class, 'allContracts'])->name('director.allContracts');
    Route::get('/director/contract/{contractId}/items', [\App\Http\Controllers\Director\ContractController::class, 'getContractItems'])->name('director.contractItems');
    Route::post('/director/contract/{contractId}/change-status', [\App\Http\Controllers\Director\ContractController::class, 'changeStatus'])->name('director.changeContractStatus');
    Route::get('/director/bills', [\App\Http\Controllers\Director\BillController::class, 'getAllBills'])->name('director.bills');
    Route::get('/director/bills/{contract}/items', [\App\Http\Controllers\Director\BillController::class, 'showItems'])->name('director.bills.items');
    Route::get('/director/bills/export', [\App\Http\Controllers\Director\BillController::class, 'export'])->name('director.bills.export');

});

Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':supplier'])->group(function () {
    Route::resource('/supplier/available-items', \App\Http\Controllers\Supplier\SupplierItemController::class)->names([
        'index' => 'supplier.available-items',
        'create' => 'supplier-items.create',
        'store' => 'supplier-items.store',
    ]);
    Route::get('/supplier/my-items', [\App\Http\Controllers\Supplier\SupplierItemController::class, 'show'])->name('supplier-items.show');
    Route::get('/supplier/bills', [\App\Http\Controllers\Supplier\BillController::class, 'getAllBills'])->name('supplier.bills');
});

Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':worker'])->group(function () {
    Route::get('/worker/suppliers', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'index'])->name('worker.suppliers.index');
    Route::get('/worker/suppliers/{id}', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'showWorkerSuppliers'])->name('worker.suppliers.showWorkerSuppliers');
    Route::get('/worker/supplier/{id}/create-contract', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'createContract'])->name('worker.suppliers.createContract');
    Route::post('/worker/supplier/contract/{contractId}/add-item', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'addItemToContract'])->name('contract.addItem');
    Route::post('/contract/{id}/finish', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'finishContract'])->name('contract.finish');
    Route::get('/worker/contracts', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'myContracts'])->name('worker.contract.myContracts');
    Route::get('/worker/contract/{contractId}/items', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'contractItems'])->name('worker.myContract.contractItems');
    Route::get('/worker/bills', [\App\Http\Controllers\Worker\BillController::class, 'getAllBills'])->name('worker.bills');
    Route::post('/worker/contract/{contractId}/bill', [\App\Http\Controllers\Worker\BillController::class, 'createBill'])->name('worker.createBill');
    Route::get('/worker/unpaidContracts', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'unpaidContracts'])->name('worker.unpaidContracts');
    Route::delete('/worker/contract/{contractId}', [\App\Http\Controllers\Worker\SuppliersWorker::class, 'deletePendingContract'])->name('worker.deletePendingContract');
});

Route::middleware([\App\Http\Middleware\RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/create-user', [AdminController::class, 'showCreateUserForm'])->name('admin.create_user_form');
    Route::post('/admin/create-user', [AdminController::class, 'createUser'])->name('admin.create_user');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');

    Route::resource('/admin/items', \App\Http\Controllers\Admin\ItemController::class)->names([
        'index' => 'admin.items',
        'create' => 'admin.items.create',
        'store' => 'admin.items.store',
        'edit' => 'admin.items.edit',
        'update' => 'admin.items.update',
        'destroy' => 'admin.items.destroy',
    ]);

    Route::resource('admin/suppliers', \App\Http\Controllers\Admin\SuppliersController::class)->names([
        'index' => 'admin.suppliers',
        'edit' => 'admin.suppliers.edit',
        'update' => 'admin.suppliers.update',
    ]);
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


