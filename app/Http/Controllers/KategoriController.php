<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    //
    function show(){
        $data = Kategori::all();
        return view('kategori', ['data' => $data]);
    }
}
