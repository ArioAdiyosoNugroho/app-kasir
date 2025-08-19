<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';  
    protected $primaryKey = 'id_produk';  
    protected $guarded = [];
    protected $fillable = [
        'id_produk','id_kategori','nama_produk','merk','harga_beli','harga_jual','diskon','stok','kode_produk',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
