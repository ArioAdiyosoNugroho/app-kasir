<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('produk', function (Blueprint $table) {
        // Mengubah tipe data kolom id_kategori menjadi unsignedInteger
        $table->unsignedInteger('id_kategori')->change(); 

        // Menambahkan foreign key constraint
        $table->foreign('id_kategori')
              ->references('id_kategori')
              ->on('kategori')
              ->onUpdate('restrict')
              ->onDelete('restrict');
    });
}

public function down(): void
{
    Schema::table('produk', function (Blueprint $table) {
        $table->integer('id_kategori')->change(); // Mengembalikan tipe data ke integer
        $table->dropForeign('produk_id_kategori_foreign');
    });
}
};