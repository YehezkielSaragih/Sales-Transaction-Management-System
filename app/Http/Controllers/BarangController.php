<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    //
    function show(){
        $data = Barang::all();
        return view('barang', ['barang' => $data]);
    }
}
