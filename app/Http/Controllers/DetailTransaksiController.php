<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;

class DetailTransaksiController extends Controller
{
    //
    function index(){
        $data = DetailTransaksi::orderBy('id_detail_transaksi', 'asc')
        ->join('barang', 'detail_transaksi.id_barang', '=', 'barang.id_barang')
        ->select('detail_transaksi.id_transaksi', 'detail_transaksi.id_detail_transaksi', 'barang.nama_barang', 'detail_transaksi.jumlah_barang', 'detail_transaksi.harga_barang_transaksi')
        ->orderBy('id_detail_transaksi', 'asc')
        ->paginate(10);
        return view('detail_transaksi.detail_transaksi_table', compact('data'));
        //return $data;
    }
}
