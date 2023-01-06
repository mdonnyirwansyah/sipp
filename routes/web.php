<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Customer;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::prefix('data-order')->name('data-order.')->controller(OrderController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('get-data', 'get_data')->name('get-data');
        Route::get('create', 'create')->name('create');
        Route::get('show', 'show')->name('show');
        Route::post('', 'store')->name('store');
        Route::get('edit/{order}', 'edit')->name('edit');
        Route::put('{order}', 'update')->name('update');
        Route::delete('{order}', 'destroy')->name('destroy');
    });

    Route::prefix('update')->name('update.')->controller(OrderController::class)->group(function () {
        Route::get('status', 'status')->name('status');
        Route::put('status/{order}', 'update_status')->name('update-status');
        Route::get('payment-status', 'payment_status')->name('payment-status');
        Route::put('payment-status/{order}', 'update_payment_status')->name('update-payment-status');
    });

    Route::prefix('report')->name('report.')->controller(ReportController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('print', 'print')->name('print');
    });


    Route::get('profile-information', function () {
        return view('main.profile-information');
    })->name('profile-information');
    Route::get('update-password', function () {
        return view('main.update-password');
    })->name('update-password');
});
