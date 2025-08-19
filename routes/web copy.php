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
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\Title;


Route::get('/', fn () =>redirect()->route('login'));
Route::get('/kasir', [DashboardController::class, 'index'])->name('home');


//bagian sidebar menu===================
Route::get('/dataproduk', function () {
    return view('kasir.dataP',['title'=>'dataproduk']);
})->name('dataP');

Route::get('/editproduk', function () {
    return view('produk.edit',['title'=>'editproduk']);
})->name('editproduk');



Route::get('/addproduk', function () {
    return view('produk.addproduk',['title'=>'addproduk']);
})->name('addproduk');

//jetstream================================================================
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/kasir', [DashboardController::class, 'index'])->name('home');
});
// ========================================================================


Route::resource('kategori', KategoriController::class);
Route::resource('produk', ProdukController::class);
Route::get('/addprod', [ProdukController::class, 'create'])->name('addproduk');

Route::resource('member', MemberController::class);
Route::get('/addmember', [MemberController::class, 'create'])->name('addmember');

Route::resource('supplier', SuplierController::class);
Route::get('/addsupplier', [SuplierController::class, 'create'])->name('addsupplier');

Route::resource('pengeluaran', PengeluaranController::class);
Route::get('/addpengeluaran', [PengeluaranController::class, 'create'])->name('addpengeluaran');


// beli================================================================
Route::resource('pembelian', PembelianController::class);
Route::get('/addpembelian', [PembelianController::class, 'create'])->name('addpembelian');


Route::get('/pembelian/create', [PembelianController::class, 'chooseSuplier'])->name('pembelian.chooseSuplier');
Route::get('/pembelian/{id_supplier}/transaksi', [PembelianController::class, 'showTransaksi'])->name('pembelian.showTransaksi'); // Use GET for displaying the form
Route::get('pembelian/{id}', [PembelianDetailController::class, 'show'])->name('pembelian.show');
Route::get('pembelian/{id}', [PembelianController::class, 'show'])->name('pembelian.show');
Route::post('/pembelian/store', [PembelianController::class, 'store'])->name('pembelian.store');
// ========================================================================


Route::resource('transaksi', PenjualanController::class);
Route::get('/addtransaksi', [PenjualanController::class, 'create'])->name('addtransaksi');

//jual/transaksi================================================================
Route::resource('penjualan', PenjualanController::class);
Route::get('/penjualan/{id}/struk', [PenjualanController::class, 'showStruk'])->name('penjualan.struk');
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
// =======================================================

Route::get('/laporan/bulanan', [LaporanController::class, 'laporanBulanan'])->name('laporan.bulanan');

Route::resource('user', userController::class);
Route::get('/adduser', [userController::class, 'create'])->name('adduser');