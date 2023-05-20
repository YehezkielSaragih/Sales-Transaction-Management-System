<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;

class DetailTransaksiController extends Controller
{
    //
    function show(){
        $data = DetailTransaksi::all();
        return view('detailtransaksi', ['detailtransaksi' => $data]);
    }
}
