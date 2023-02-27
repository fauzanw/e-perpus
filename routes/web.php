<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, 
    DashboardController, 
    BukuController, 
    KategoriBukuController,
    PenerbitController,
    AnggotaController,
    AdministratorController
};
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

Route::get('/layout', function() {
    return view('dashboard/example');
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

    $route->get('/data/buku', [BukuController::class, 'index'])->name('dashboard.data.buku');
    $route->get('/data/buku/create', [BukuController::class, 'create'])->name('dashboard.data.buku.create');
    $route->post('/data/buku/create', [BukuController::class, 'doCreate'])->name('dashboard.data.buku.doCreate');
    $route->get('/data/buku/get', [BukuController::class, 'get'])->name('dashboard.data.buku.get');

    $route->get('/data/kategori_buku', [KategoriBukuController::class, 'index'])->name('dashboard.data.kategori_buku');
    $route->post('/data/kategori_buku/create', [KategoriBukuController::class, 'create'])->name('dashboard.data.kategori_buku.create');
    $route->get('/data/kategori_buku/{id_kategori}/delete', [KategoriBukuController::class, 'delete'])->name('dashboard.data.kategori_buku.delete');
    $route->get('/data/kategori_buku/get', [KategoriBukuController::class, 'get'])->name('dashboard.data.kategori_buku.get');
    $route->put('/data/kategori_buku/edit', [KategoriBukuController::class, 'edit'])->name('dashboard.data.kategori_buku.edit');

    $route->get('/data/anggota', [AnggotaController::class, 'index'])->name('dashboard.data.anggota');
    $route->post('data/anggota', [AnggotaController::class, 'create'])->name('dashboard.data.anggota.create');
    $route->get('/data/anggota/get', [AnggotaController::class, 'get'])->name('dashboard.data.anggota.get');
    $route->put('/data/anggota/edit', [AnggotaController::class, 'edit'])->name('dashboard.data.anggota.edit');
    $route->get('/data/anggota/{id_user:id_user}/delete', [AnggotaController::class, 'delete'])->name('dashboard.data.anggota.delete');
    
    $route->get('/data/penerbit', [PenerbitController::class, 'index'])->name('dashboard.data.penerbit');
    $route->get('/data/penerbit/get', [PenerbitController::class, 'get'])->name('dashboard.data.penerbit.get');
    $route->post('/data/penerbit/create', [PenerbitController::class, 'create'])->name('dashboard.data.penerbit.create');
    $route->get('/data/penerbit/verify', [PenerbitController::class, 'verify'])->name('dashboard.data.penerbit.verify');
    $route->put('/data/penerbit/edit', [PenerbitController::class, 'edit'])->name('dashboard.data.penerbit.edit');
    $route->get('/data/penerbit/{id_penerbit:id_penerbit}/delete', [PenerbitController::class, 'delete'])->name('dashboard.data.penerbit.delete');
    
    $route->get('/data/administrator', [AdministratorController::class, 'index'])->name('dashboard.data.administrator');
    $route->post('data/administrator', [AdministratorController::class, 'create'])->name('dashboard.data.administrator.create');
    $route->get('/data/administrator/{id_user:id_user}/delete', [AdministratorController::class, 'delete'])->name('dashboard.data.administrator.delete');
});