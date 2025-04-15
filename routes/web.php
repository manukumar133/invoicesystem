<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\InvoiceGenerate;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::post('/try_login', 'tryLogin')->name('try_login');
    Route::get('/logout', 'logout')->name('logout');
});


Route::group(['middleware' => ['auth:user'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
    });

    Route::resource('invoice', InvoiceGenerate::class);
    Route::group(['prefix' => 'invoice', 'as' => 'invoice.'], function () {
        Route::post('/duplicate/{id}', [InvoiceGenerate::class, 'duplicateInvoice'])->name('duplicate');
        Route::post('/download/{id}', [InvoiceGenerate::class, 'downloadInvoice'])->name('download');
    });
});
