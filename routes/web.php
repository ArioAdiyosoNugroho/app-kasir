<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Redirect ke login jika belum masuk
Route::get('/', fn () => redirect()->route('login'));

// Middleware Jetstream (auth & verifikasi)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Semua user bisa akses dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kasir', [DashboardController::class, 'index'])->name('home');

    /*
    |--------------------------------------------------------------------------
    | Routes yang Bisa Diakses oleh Admin & Kasir
    |--------------------------------------------------------------------------
    */
    Route::resource('produk', ProdukController::class);
    Route::resource('penjualan', PenjualanController::class);

    // Halaman produk
    Route::get('/dataproduk', function () {
        return view('kasir.dataP', ['title' => 'Data Produk']);
    })->name('dataP');

    // Halaman penjualan
    Route::resource('kategori', KategoriController::class);

    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/penjualan/{id}/struk', [PenjualanController::class, 'showStruk'])->name('penjualan.struk');

    Route::get('/addtransaksi', [PenjualanController::class, 'create'])
    ->name('addtransaksi');
    // ->middleware('checkLevel:0'); 
    
    Route::get('/addproduk', [ProdukController::class, 'create'])->name('addproduk');

    /*
    |--------------------------------------------------------------------------
    | Routes untuk Admin (Level 1)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['checkLevel:1'])->group(function () {
        Route::resource('member', MemberController::class);
        Route::resource('supplier', SuplierController::class);
        Route::resource('pengeluaran', PengeluaranController::class);
        Route::resource('pembelian', PembelianController::class);
        Route::resource('user', UserController::class);
        Route::resource('transaksi', PenjualanController::class);

        Route::get('/laporan/bulanan', [LaporanController::class, 'laporanBulanan'])->name('laporan.bulanan');

        // Tambah data (Admin)
        Route::get('/addmember', [MemberController::class, 'create'])->name('addmember');
        Route::get('/addsupplier', [SuplierController::class, 'create'])->name('addsupplier');
        Route::get('/addpengeluaran', [PengeluaranController::class, 'create'])->name('addpengeluaran');
        Route::get('/addpembelian', [PembelianController::class, 'create'])->name('addpembelian');
        Route::get('/adduser', [UserController::class, 'create'])->name('adduser');

        // Pembelian
        Route::get('/pembelian/create', [PembelianController::class, 'chooseSuplier'])->name('pembelian.chooseSuplier');
        Route::get('/pembelian/{id_supplier}/transaksi', [PembelianController::class, 'showTransaksi'])->name('pembelian.showTransaksi');
        Route::post('/pembelian/store', [PembelianController::class, 'store'])->name('pembelian.store');
        Route::get('/pembelian/detail/{id}', [PembelianDetailController::class, 'show'])->name('pembelian.detail');
    });

});
