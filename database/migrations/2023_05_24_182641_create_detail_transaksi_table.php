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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            // Column Setup
            $table->unsignedBigInteger('id_detail_transaksi', 8)->autoIncrement()->primary();
            $table->unsignedBigInteger('id_transaksi', 8)->nullable(false);
            $table->unsignedBigInteger('id_barang', 8)->nullable(false);
            $table->unsignedBigInteger('jumlah_barang', 10)->nullable(false);
            $table->unsignedBigInteger('harga_barang_transaksi', 10)->nullable(false);
            // Table Relation
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi');
            $table->foreign('id_barang')->references('id_barang')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};
