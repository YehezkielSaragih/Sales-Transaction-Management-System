<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\Transaksi;
 
class HomeController extends Controller
{
    //
    function index(){

        $today = date('d-m-Y');
        $transaksiCount = Transaksi::where('tanggal', $today)->count();
        $totalTransaksi = Transaksi::where('tanggal', $today)->sum('total_transaksi');
        $barangCount = Barang::count();
        $kategoriCount = Kategori::count();

        return view('home', compact('today', 'transaksiCount', 'totalTransaksi', 'barangCount', 'kategoriCount'));
    }
}