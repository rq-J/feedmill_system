<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

use App\Utilities\GenericUtilities as GU;
use App\Services\GenericServices as GS;

// Fixed Route for all new application that will use Auth
Route::get('/app-login/{id}', [AuthenticationController::class, 'app_login'])->name('app.login');
// Login Route
// Route::get('/login', [LoginController::class, 'login'])->name('login');
// Auth Middleware Group
Route::middleware('auth')->group(function () {
    // Main Session Check for Authetication
    // Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    // Dash/Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/macro', [ContentController::class, 'macro'])->name('macro');
    Route::get('/micro', [ContentController::class, 'micro'])->name('micro');
    Route::get('/medicine', [ContentController::class, 'medicine'])->name('medicine');

    Route::get('/feed_request', [ContentController::class, 'feed_request'])->name('feed_request');
    Route::get('/farm_information', [ContentController::class, 'farm_information'])->name('farm_information');

    Route::get('/inventory_levels', [ContentController::class, 'inventory_levels'])->name('inventory_levels');
    Route::get('/message_slack', [ContentController::class, 'message_slack'])->name('message_slack');

    Route::get('/production_order', [ContentController::class, 'production_order'])->name('production_order');
    Route::get('/premixes', [ContentController::class, 'premixes'])->name('premixes');
    Route::get('/feeds_information', [ContentController::class, 'feeds_information'])->name('feeds_information');

    Route::get('/accounting_bills', [ContentController::class, 'accounting_bills'])->name('accounting_bills');
    Route::get('/accounting_payrolls', [ContentController::class, 'accounting_payrolls'])->name('accounting_payrolls');
    Route::get('/audit_logs', [ContentController::class, 'audit_logs'])->name('audit_logs');
    Route::get('/pivot_logs', [ContentController::class, 'pivot_logs'])->name('pivot_logs');

    Route::get('/accounts', [ContentController::class, 'accounts'])->name('accounts');
    Route::get('/permissions', [ContentController::class, 'permissions'])->name('permissions');
    /**
     * YOUR CODE STARTS HERE
     * DO NOT ALTER ABOVE CODE
     */
});

Route::get('/gs', function () {
    return GS::service1();
});
