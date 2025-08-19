<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member'; // Pastikan tabel yang benar digunakan
    protected $primaryKey = 'id_member'; // Pastikan primary key yang benar digunakan

    // Kolom yang dapat diisi
    protected $fillable = [
        'kode_member',
        'nama',
        'alamat',
        'telepon',
    ];
}

