<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductsInController;
use App\Http\Controllers\ProductsOutController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;
use App\Models\ProductsOutModel;
use App\Models\User;
use App\Models\UsersModel;
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

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/barang', [ProductsController::class, 'index'])->middleware('auth');
Route::get('/barang/tambah', [ProductsController::class, 'formAdd'])->middleware('auth');
Route::post('/barang',[ProductsController::class,'add'])->middleware('auth');
Route::get('/barang/edit/{id}',[ProductsController::class,'formEdit'])->middleware('auth');
Route::put('/barang/{id}',[ProductsController::class,'edit'])->middleware('auth');
Route::get('/barang/hapus/{id}',[ProductsController::class,'delete'])->middleware('auth');

Route::get('/supplier', [SuppliersController::class, 'index'])->middleware('auth');
Route::get('/supplier/tambah', [SuppliersController::class, 'formAdd'])->middleware('auth');
Route::post('/supplier',[SuppliersController::class,'add'])->middleware('auth');
Route::get('/supplier/edit/{id}',[SuppliersController::class,'formEdit'])->middleware('auth');
Route::put('/supplier/{id}',[SuppliersController::class,'edit'])->middleware('auth');
Route::get('/supplier/hapus/{id}',[SuppliersController::class,'delete'])->middleware('auth');

Route::get('/barangMasuk', [ProductsInController::class, 'index'])->middleware('auth');
Route::get('/barangMasuk/tambah', [ProductsInController::class, 'formAdd'])->middleware('auth');
Route::post('/barangMasuk',[ProductsInController::class,'add'])->middleware('auth');
Route::get('/barangMasuk/hapus/{id}', [ProductsInController::class, 'delete'])->middleware('auth');
Route::get('/barangMasuk/detail/{id}', [ProductsInController::class, 'detail'])->middleware('auth');

Route::get('/barangRetur', [ProductsOutController::class, 'index'])->middleware('auth');
Route::get('/barangRetur/tambah', [ProductsOutController::class, 'formAdd'])->middleware('auth');
Route::post('/barangRetur',[ProductsOutController::class,'add'])->middleware('auth');
Route::get('/barangRetur/hapus/{id}', [ProductsOutController::class, 'delete'])->middleware('auth');
Route::get('/barangRetur/detail/{id}', [ProductsOutController::class, 'detail'])->middleware('auth');

Route::get('/user', [UsersController::class, 'index'])->middleware('auth');
Route::get('/user/tambah', [UsersController::class, 'formAdd'])->middleware('auth');
Route::post('/user',[UsersController::class,'add'])->middleware('auth');
Route::get('/user/edit/{id}',[UsersController::class,'formEdit'])->middleware('auth');
Route::put('/user/{id}',[UsersController::class,'edit'])->middleware('auth');
Route::get('/user/hapus/{id}',[UsersController::class,'delete'])->middleware('auth');

Route::get('/role', [RolesController::class, 'index'])->middleware('auth');
Route::get('/role/tambah', [RolesController::class, 'formAdd'])->middleware('auth');
Route::post('/role',[RolesController::class,'add'])->middleware('auth');
Route::get('/role/edit/{id}',[RolesController::class,'formEdit'])->middleware('auth');
Route::put('/role/{id}',[RolesController::class,'edit'])->middleware('auth');
Route::get('/role/hapus/{id}',[RolesController::class,'delete'])->middleware('auth');

Route::get('/kasir',[CashierController::class,'index']);
Route::post('/kasir/tambah',[CashierController::class,'addCart']);
Route::get('/kasir/hapus/{cartId}/{productId}/{productQty}',[CashierController::class,'deleteCart']);
Route::post('/kasir/pembayaran',[CashierController::class,'payment']);
Route::post('/kasir/simpan',[CashierController::class,'save']);

Route::get('/transaksi',[TransactionController::class,'index']);
Route::get('/transaksi/detail/{id}',[TransactionController::class,'detail']);
Route::get('/transaksi/printDetail/{id}',[TransactionController::class,'print']);
Route::get('/transaksi/report',[TransactionController::class,'report']);
Route::get('/transaksi/report/{date}',[TransactionController::class,'detailReport']);

Route::get('/pengaturan/akun/{id}',[SettingController::class,'formAccount']);
Route::post('/pengaturan/akun',[SettingController::class,'editAccount']);
Route::get('/pengaturan/password/{id}',[SettingController::class,'formPassword']);
Route::post('/pengaturan/password',[SettingController::class,'editPassword']);
