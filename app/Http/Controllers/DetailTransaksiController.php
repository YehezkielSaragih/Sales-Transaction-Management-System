<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;

class DetailTransaksiController extends Controller
{
    //
    function index(){
        $data = DetailTransaksi::all();
        return view('detail_transaksi', compact('data'));
        //return $data;
    }
}
