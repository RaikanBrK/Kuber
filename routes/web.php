<?php

use Illuminate\Support\Facades\Route;
use Kuber\Http\Controllers\Admin\SettingsController;
use Kuber\Http\Controllers\Admin\DashboardController;
use Kuber\Http\Controllers\Admin\SettingsTagsController;
use Kuber\Http\Controllers\Admin\AdministratorController;
use Kuber\Http\Controllers\Admin\Auth\AdminLoginController;
use Kuber\Http\Controllers\Admin\Auth\ResetPasswordController;
use Kuber\Http\Controllers\Admin\Auth\ForgotPasswordController;
use Kuber\Http\Controllers\Admin\AdministratorProfileController;
use Kuber\Http\Controllers\Admin\Auth\AdminLogoutController;
use Kuber\Http\Controllers\Admin\LogoAndFaviconController;

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
    Route::middleware(['auth:admin'])->group(function () {
        Route::post('logout', AdminLogoutController::class)->name('logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('administrators', AdministratorController::class)->except('show');
        Route::get('profile', [AdministratorProfileController::class, 'index'])->name('profile.index');
        Route::post('profile', [AdministratorProfileController::class, 'store'])->name('profile.store');

        Route::prefix('settings')->name('settings.')->group(function () {
            Route::controller(SettingsController::class)->name('site.')->group(function() {
                Route::get('site', 'index')->name('index');
                Route::post('site', 'store')->name('store');
            });
            Route::controller(SettingsTagsController::class)->name('tags.')->group(function() {
                Route::get('tags', 'index')->name('index');
                Route::post('tags', 'store')->name('store');
            });
            Route::controller(LogoAndFaviconController::class)->name('assets.')->group(function() {
                Route::get('logo-and-favicon', 'index')->name('index');
                Route::post('logo-and-favicon', 'store')->name('store');
            });
        });
    });

    Route::middleware(['guest:admin'])->group(function () {
        Route::get('login', [AdminLoginController::class, 'index'])->name('login');
        Route::post('login', [AdminLoginController::class, 'store'])->name('login.store');
        Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
        Route::post('forgot-password', [ForgotPasswordController::class, 'store'])->name('forgot-password.store');
        Route::get('reset-password/{token}', [ResetPasswordController::class, 'index'])->name('reset-password');
        Route::post('reset-password', [ResetPasswordController::class, 'store'])->name('reset-password.store'); 
    });
});
