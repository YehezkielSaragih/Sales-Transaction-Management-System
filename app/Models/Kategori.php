<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'nama_kategori',
    ];
    public function isBeingUsed(){
        // Check if the category is being referenced in the 'barang' table
        return Barang::where('id_kategori', $this->id_kategori)->exists();
    }
}
