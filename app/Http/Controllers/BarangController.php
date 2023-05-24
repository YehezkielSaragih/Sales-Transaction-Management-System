<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    //
    function index(){
        $data = Barang::paginate(10);
        return view('barang', compact('data'));
        // return $data;
    }
}
