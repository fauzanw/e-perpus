<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, DashboardController};
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

    $route->get('/data/buku', [DashboardController::class, 'buku'])->name('dashboard.data.buku');
    $route->get('/data/buku/create', [DashboardController::class, 'createBuku'])->name('dashboard.data.buku.create');
    $route->post('/data/buku/create', [DashboardController::class, 'doCreateBuku'])->name('dashboard.data.buku.doCreate');

    $route->get('/data/kategori_buku', [DashboardController::class, 'kategoriBuku'])->name('dashboard.data.kategori_buku');
    $route->post('/data/kategori_buku/create', [DashboardController::class, 'createKategoriBuku'])->name('dashboard.data.kategori_buku.create');
    $route->get('/data/kategori_buku/{id_kategori}/delete', [DashboardController::class, 'deleteKategoriBuku'])->name('dashboard.data.kategori_buku.delete');
    $route->get('/data/kategori_buku/get', [DashboardController::class, 'getKategoriBuku'])->name('dashboard.data.kategori_buku.get');
    $route->put('/data/kategori_buku/edit', [DashboardController::class, 'editKategoriBuku'])->name('dashboard.data.kategori_buku.edit');

    $route->get('/data/anggota', [DashboardController::class, 'anggota'])->name('dashboard.data.anggota');
    $route->post('data/anggota', [DashboardController::class, 'createAnggota'])->name('dashboard.data.anggota.create');
    $route->get('/data/anggota/get', [DashboardController::class, 'getAnggota'])->name('dashboard.data.anggota.get');
    $route->put('/data/anggota/edit', [DashboardController::class, 'editAnggota'])->name('dashboard.data.anggota.edit');
    $route->get('/data/anggota/{id_user:id_user}/delete', [DashboardController::class, 'deleteAnggota'])->name('dashboard.data.anggota.delete');
    
    $route->get('/data/penerbit', [DashboardController::class, 'penerbit'])->name('dashboard.data.penerbit');
    $route->get('/data/penerbit/get', [DashboardController::class, 'getPenerbit'])->name('dashboard.data.penerbit.get');
    $route->post('/data/penerbit/create', [DashboardController::class, 'createPenerbit'])->name('dashboard.data.penerbit.create');
    $route->get('/data/penerbit/verify', [DashboardController::class, 'verifyPenerbit'])->name('dashboard.data.penerbit.verify');
    $route->put('/data/anggota/edit', [DashboardController::class, 'editPenerbit'])->name('dashboard.data.penerbit.edit');
    $route->get('/data/penerbit/{id_penerbit:id_penerbit}/delete', [DashboardController::class, 'deletePenerbit'])->name('dashboard.data.penerbit.delete');
    
    $route->get('/data/administrator', [DashboardController::class, 'administrator'])->name('dashboard.data.administrator');
    $route->post('data/administrator', [DashboardController::class, 'createAdministrator'])->name('dashboard.data.administrator.create');
    $route->get('/data/administrator/{id_user:id_user}/delete', [DashboardController::class, 'deleteAdministrator'])->name('dashboard.data.administrator.delete');
});