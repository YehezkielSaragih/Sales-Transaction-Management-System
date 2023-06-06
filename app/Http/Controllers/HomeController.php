<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
 
class HomeController extends Controller
{
    //
    function index(){

        // Today transaction
        $today = date('d-m-Y');
        $transaksiCount = Transaksi::where('tanggal', $today)->count();
        $totalTransaksi = Transaksi::where('tanggal', $today)->sum('total_transaksi');
        // Most sold barang today
        $mostSoldBarangIdToday = DetailTransaksi::select('id_barang')
        ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
        ->where('transaksi.tanggal', $today)
        ->groupBy('id_barang')
        ->orderByRaw('SUM(jumlah_barang) DESC')
        ->first();
        if($mostSoldBarangIdToday == null){
            $mostSoldBarangToday = "Tidak ada";
        }
        else{
            $mostSoldBarangToday = Barang::find($mostSoldBarangIdToday->id_barang)->nama_barang;
        }
        
        // Barang
        $barangCount = Barang::count();
        // Most sold barang from beginning
        $mostSoldBarangId = DetailTransaksi::select('id_barang')
        ->groupBy('id_barang')
        ->orderByRaw('SUM(jumlah_barang) DESC')
        ->first();
        $mostSoldBarang = Barang::find($mostSoldBarangId->id_barang)->nama_barang;

        // Kategori
        $kategoriCount = Kategori::count();

        // Return view
        return view('pages.home', compact('today', 'transaksiCount', 'totalTransaksi', 'barangCount', 'kategoriCount', 'mostSoldBarang', 'mostSoldBarangToday'));
    }
}