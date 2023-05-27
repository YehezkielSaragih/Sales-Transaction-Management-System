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
        $today = date('Y-m-d');
        $transaksiCount = Transaksi::where('tanggal', $today)->count();
        $barangCount = Barang::count();
        $kategoriCount = Kategori::count();

        return view('home', compact('today', 'transaksiCount', 'barangCount', 'kategoriCount'));
    }
}