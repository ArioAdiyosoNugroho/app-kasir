<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; // Pastikan tabel yang benar digunakan
    protected $primaryKey = 'id_penjualan'; // Pastikan primary key yang benar digunakan

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_member',
        'total_item',
        'total_harga',
        'diskon',
        'bayar',
        'diterima',
        'id_user',
    ];

    // Relasi dengan model Member
    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }

    // Relasi dengan model PenjualanDetail
    public function items()
    {
        return $this->hasMany(PenjualanDetail::class, 'id_penjualan');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
