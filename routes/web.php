<?php

use Illuminate\Support\Facades\Route;
use Kuber\Http\Controllers\Admin\Auth\AdminLoginController;
use Kuber\Http\Controllers\Admin\Auth\ResetPasswordController;
use Kuber\Http\Controllers\Admin\Auth\ForgotPasswordController;

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

$routesCfgAdmin = [
    'as' => "admin.",
    'prefix' => "admin",
    'middleware' => ['web'],
];

Route::group($routesCfgAdmin, function () {
    Route::get('dashboard', function () {
        return 'dashboard';
    })->name('dashboard');

    Route::get('login', [AdminLoginController::class, 'index'])->name('login');
    Route::post('login', [AdminLoginController::class, 'store'])->name('login.store');
    Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
    Route::post('forgot-password', [ForgotPasswordController::class, 'store'])->name('forgot-password.store');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'index'])->name('reset-password');
    Route::post('reset-password', [ResetPasswordController::class, 'store'])->name('reset-password.store');
});
