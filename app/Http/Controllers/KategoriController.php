<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    //
    function index(){
        $data = Kategori::paginate(10);
        return view('kategori', compact('data'));
        // return $data;
    }
}
