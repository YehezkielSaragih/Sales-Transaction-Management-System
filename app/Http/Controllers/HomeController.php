<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
 
class HomeController extends Controller
{
    //
    function index()
    {
        $data = Transaksi::join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('barang', 'detail_transaksi.id_barang', '=', 'barang.id_barang')
            ->join('kategori', 'barang.id_kategori', '=', 'kategori.id_kategori')
            ->select(
                'transaksi.id_transaksi',
                'transaksi.tanggal',
                'barang.nama_barang AS barang',
                'kategori.nama_kategori AS kategori',
                'barang.harga_barang',
                'detail_transaksi.jumlah_barang',
                'detail_transaksi.harga_barang_transaksi',
                'transaksi.total_transaksi'
            )
            ->orderBy('transaksi.id_transaksi', 'asc')
            ->paginate(10);

        return view('home', compact('data'));
        // return $data;
    }
}