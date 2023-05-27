<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;

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

// Check database connection with php artisan
// try {
//         DB::connection()->getPdo();
//         if(DB::connection()->getDatabaseName()){
//             echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName() . "\n";
//         }
//         else{
//             die("Could not find the database. Please check your configuration.");
//         }
//     } 
// catch (\Exception $e) {
//     die("Could not open connection to database server.  Please check your configuration.");
// }

// Default route
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest Only
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

// Admin Only
Route::group(['middleware' => 'auth'], function () {
    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Transaksi
    Route::get('/transaksi/transaksi_table', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/transaksi_table', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::get('/transaksi/transaksi_table/{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/transaksi/transaksi_table/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/transaksi_table/{id}', [TransaksiController::class, 'delete'])->name('transaksi.delete');
    // Detail Transaksi
    Route::get('/detail_transaksi/detail_transaksi_table', [DetailTransaksiController::class, 'index'])->name('detail_transaksi.index');
    Route::post('/detail_transaksi/detail_transaksi_table', [DetailTransaksiController::class, 'create'])->name('detail_transaksi.create');
    Route::get('/detail_transaksi/detail_transaksi_table/{id}', [DetailTransaksiController::class, 'edit'])->name('detail_transaksi.edit');
    Route::put('/detail_transaksi/detail_transaksi_table/{id}', [DetailTransaksiController::class, 'update'])->name('detail_transaksi.update');
    Route::delete('/detail_transaksi/detail_transaksi_table/{id}', [DetailTransaksiController::class, 'delete'])->name('detail_transaksi.delete');
    // Barang
    Route::get('/barang/barang_table', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/barang/barang_table', [BarangController::class, 'create'])->name('barang.create');
    Route::get('/barang/barang_edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/barang_edit/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/barang_table/{id}', [BarangController::class, 'delete'])->name('barang.delete');
    // Kategori
    Route::get('/kategori/kategori_table', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori/kategori_table', [KategoriController::class, 'create'])->name('kategori.create');
    Route::get('/kategori/kategori_edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/kategori_edit/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/kategori_table/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');
    // Logout
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});