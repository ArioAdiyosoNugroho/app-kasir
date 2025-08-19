<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class suplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier'; 
    protected $guarded = [];
    protected $fillable = ['nama', 'alamat', 'telepon'];

}
