<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    //
    function index(){
        $data = Barang::paginate(10);
        return view('barang.barang_table', compact('data'));
        // return $data;
    }
}
