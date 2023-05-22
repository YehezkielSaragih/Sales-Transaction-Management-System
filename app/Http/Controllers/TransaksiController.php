<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    //
    function index(){
        $data = Transaksi::all();
        return view('transaksi', compact('data'));
        // return $data;
    }
}
