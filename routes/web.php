<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, DashboardController};


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

Route::group(['prefix' => 'auth', 'middleware' => ['custom-guest']], function($route) {
    $route->get('/login', [AuthController::class, 'login'])->name('auth.login');
    $route->post('/login', [AuthController::class, 'doLogin'])->name('auth.doLogin');
    $route->get('/register', [AuthController::class, 'register'])->name('auth.register');
    $route->post('/register', [AuthController::class, 'doRegister'])->name('auth.doRegister');
    $route->get('/logout', [AuthController::class, 'logout'])->name('auth.logout')->withoutMiddleware('custom-guest');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['custom-auth']], function($route) {
    $route->get('index', [DashboardController::class, 'index'])->name('dashboard.index');
});