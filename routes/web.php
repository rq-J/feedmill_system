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
use App\Http\Controllers\WeeklyRequestController;
use App\Http\Controllers\InventoryLevelsController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemDailyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PivotController;
use App\Http\Controllers\PremixesController;
use App\Http\Controllers\ProductionOrderController;
use App\Http\Controllers\RawMaterialsController;
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
    Route::prefix('/request')->group(function () {
        Route::get('/', [WeeklyRequestController::class, 'index'])->name('request');
        Route::get('/{id?}', [WeeklyRequestController::class, 'update'])->name('request.update');
        Route::get('/remove/{id?}', [WeeklyRequestController::class, 'remove'])->name('request.remove');
        Route::get('/monitor/{id?}', [WeeklyRequestController::class, 'monitor'])->name('request.monitor');
    });

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

    //Production Management
    Route::get('/order', [ProductionOrderController::class, 'index'])->name('order');
    Route::get('/premixes', [PremixesController::class, 'index'])->name('premixes');
    Route::prefix('/item')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('item');
        Route::get('/remove/{id?}', [ItemController::class, 'remove'])->name('item.remove');
    });
    Route::prefix('/raw')->group(function () {
        Route::get('/', [RawMaterialsController::class, 'index'])->name('raw');
        Route::get('/{id?}', [RawMaterialsController::class, 'update'])->name('raw.update');
        Route::get('/remove/{id?}', [RawMaterialsController::class, 'remove'])->name('raw.remove');
    });

    //Reports
    Route::prefix('/bills')->group(function () {
        Route::get('/', [AccountingBillsController::class, 'index'])->name('bills');
        Route::get('/{id?}', [AccountingBillsController::class, 'update'])->name('bills.update');
        Route::get('/remove/{id?}', [AccountingBillsController::class, 'remove'])->name('bills.remove');

    });
    Route::prefix('/payrolls')->group(function () {
        Route::get('/', [AccountingPayrollsController::class, 'index'])->name('payrolls');
        Route::get('/{id?}', [AccountingPayrollsController::class, 'view'])->name('payrolls.view');
        Route::get('/remove/{id?}', [AccountingPayrollsController::class, 'remove'])->name('payrolls.remove');
    });
    Route::get('/audit', [AuditController::class, 'index'])->name('audit');
    Route::get('/pivot', [PivotController::class, 'index'])->name('pivot');

    //Users
    Route::get('/accounts', [AccountsController::class, 'index'])->name('accounts');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
});

Route::get('/gs', function () {
    return GS::service1();
});
