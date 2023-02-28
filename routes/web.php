<?php

use Illuminate\Support\Facades\Route;
use Kuber\Http\Controllers\AdminLoginController;

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
    Route::get('/login', [AdminLoginController::class, 'index']);
    Route::get('/dashboard', function () {
        return view('kuber::admin.home');
    });
});


