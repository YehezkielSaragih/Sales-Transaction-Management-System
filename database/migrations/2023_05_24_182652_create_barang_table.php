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
        Schema::create('barang', function (Blueprint $table) {
            // Column Setup
            $table->unsignedBigInteger('id_barang', 8)->autoIncrement()->primary();
            $table->unsignedBigInteger('id_kategori', 8)->nullable(false);
            $table->string('nama_barang', 100)->nullable(false);
            $table->unsignedBigInteger('harga_barang', 10)->nullable(false);
            // Table relation
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
