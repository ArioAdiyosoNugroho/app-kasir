<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;

    protected $table = 'penjualan_detail'; // Pastikan tabel yang benar digunakan
    protected $primaryKey = 'id_penjualan_detail'; // Pastikan primary key yang benar digunakan

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_penjualan',
        'id_produk',
        'harga_jual',
        'jumlah',
        'diskon',
        'subtotal',
    ];

    // Relasi dengan model Penjualan
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }

    // Relasi dengan model Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
