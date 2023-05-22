<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    //
    function index(){
        $data = Kategori::all();
        return view('kategori', compact('data'));
        // return $data;
    }
}
