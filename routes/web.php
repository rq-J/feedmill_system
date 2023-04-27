<?php

use App\Http\Controllers\AccountingBillsController;
use App\Http\Controllers\AccountingPayrollsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AuditController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmInformationController;
use App\Http\Controllers\FeedRequestController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\InventoryLevelsController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemDailyController;
use App\Http\Controllers\MacroController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MessageSlackController;
use App\Http\Controllers\MicroController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PivotController;
use App\Http\Controllers\PremixesController;
use App\Http\Controllers\ProductionOrderController;
use App\Http\Controllers\RawMaterialsController;
use App\Http\Livewire\AddDivision;
use App\Http\Livewire\AddFarm;
use App\Http\Livewire\AddLocation;
use App\Http\Livewire\AddRawMaterial;
use App\Http\Livewire\UpdateFarm;
use App\Http\Livewire\UpdateFarmLocation;
use App\Http\Livewire\UpdateRawMaterial;
use App\Models\Audit;
use App\Models\RawMaterial;
use App\Utilities\GenericUtilities as GU;
use App\Services\GenericServices as GS;

// Fixed Route for all new application that will use Auth
Route::get('/app-login/{id}', [AuthenticationController::class, 'app_login'])->name('app.login');
// Login Route
Route::get('/login', [LoginController::class, 'login'])->name('login');
// Auth Middleware Group
Route::middleware('auth')->group(function () {
    // Main Session Check for Authetication
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    // Dash/Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    /**
     * YOUR CODE STARTS HERE
     * DO NOT ALTER ABOVE CODE
     */

    //Ingredient Storage
    Route::get('/item_daily', [ItemDailyController::class, 'index'])->name('item_daily');

    //Feed Request
    Route::get('/feed', [FeedRequestController::class, 'index'])->name('feed');

    // Farm
    Route::prefix('/farm')->group(function () {
        Route::get('/', [FarmInformationController::class, 'index'])->name('farm');
        Route::prefix('/farm')->group(function () {  //Farm
            Route::get('/', [FarmInformationController::class, 'f_add'])->name('farm.f');
            Route::get('/{id?}', [FarmInformationController::class, 'f_show'])->name('farm.f.show');
            Route::get('/remove/{id?}', [FarmInformationController::class, 'f_remove'])->name('farm.f.remove');
        });
        Route::prefix('/location')->group(function () {  // Location
            Route::get('/', [FarmInformationController::class, 'l_add'])->name('farm.l');
            Route::get('/{id?}', [FarmInformationController::class, 'l_show'])->name('farm.l.show');
            Route::get('/remove/{id?}', [FarmInformationController::class, 'l_remove'])->name('farm.l.remove');
        });
    });



    //Forecasting
    Route::get('/inventory', [InventoryLevelsController::class, 'index'])->name('inventory');
    Route::get('/slack', [MessageSlackController::class, 'index'])->name('slack');

    //Production Management
    Route::get('/order', [ProductionOrderController::class, 'index'])->name('order');
    Route::prefix('/formula')->group(function () {
        Route::get('/', [FormulaController::class, 'index'])->name('formula');
        Route::get('/{id?}', [FormulaController::class, 'update'])->name('formula.update');
        Route::get('/remove/{id?}', [FormulaController::class, 'remove'])->name('formula.remove');
    });
    Route::get('/premixes', [PremixesController::class, 'index'])->name('premixes');
    // Route::get('/item', [ItemController::class, 'index'])->name('item');
    Route::prefix('/item')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('item');
        Route::get('/{id?}', [ItemController::class, 'update'])->name('item.update');
        Route::get('/remove/{id?}', [ItemController::class, 'remove'])->name('item.remove');
    });
    Route::prefix('/raw')->group(function () {
        Route::get('/', [RawMaterialsController::class, 'index'])->name('raw');
        Route::get('/{id?}', [RawMaterialsController::class, 'update'])->name('raw.update');
        Route::get('/remove/{id?}', [RawMaterialsController::class, 'remove'])->name('raw.remove');
    });

    //Reports
    Route::get('/bills', [AccountingBillsController::class, 'index'])->name('bills');
    Route::get('/payrolls', [AccountingPayrollsController::class, 'index'])->name('payrolls');
    Route::get('/audit', [AuditController::class, 'index'])->name('audit');
    Route::get('/pivot', [PivotController::class, 'index'])->name('pivot');

    //Users
    Route::get('/accounts', [AccountsController::class, 'index'])->name('accounts');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
});

Route::get('/gs', function () {
    return GS::service1();
});
