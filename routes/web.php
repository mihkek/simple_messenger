<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\Auth\Panel\AuthCheckingMiddleware;
use App\Http\Middleware\Auth\Panel\AuthRoleAdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(["middleware" => [AuthCheckingMiddleware::class]], function () {
    Route::group(["middleware" => [AuthRoleAdminMiddleware::class]], function () {
        Route::get('dashboard', [DashboardController::class, 'index']);
    });
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
