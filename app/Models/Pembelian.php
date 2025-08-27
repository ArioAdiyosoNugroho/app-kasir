<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $fillable = ['id_supplier', 'total_item', 'total_harga', 'diskon', 'bayar', 'kembalian'];

// app/Models/Pembelian.php
    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'id_supplier', 'id_supplier');
    }

    public function items()
    {
        return $this->hasMany(PembelianDetail::class, 'id_pembelian', 'id_pembelian');
    }
}

