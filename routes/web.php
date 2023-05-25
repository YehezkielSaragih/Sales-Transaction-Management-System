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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
    Route::get('/detail_transaksi', [DetailTransaksiController::class, 'index'])->name('detail_transaksi');
    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'create'])->name('kategori.create');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::delete('/kategori/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');
    // Logout
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});