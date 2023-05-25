<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'id_kategori',
        'nama_barang',
        'harga_barang'
    ];
    public function isBeingUsed(){
        // Check if the category is being referenced in the 'detail_transaksi' table
        return DetailTransaksi::where('id_barang', $this->id_barang)->exists();
    }
}
