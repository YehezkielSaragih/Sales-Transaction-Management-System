<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    //
    public function index(){
        $data = Kategori::paginate(10);
        return view('kategori', compact('data'));
    }

    public function create(Request $request){
        $request->validate([
            'nama_kategori' => 'required'
        ]);
        $data = [
            'nama_kategori' => $request->nama_kategori
        ];
        Kategori::create($data);
        return redirect()->route('kategori.index');
    }

    public function delete($id){
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori.index');
    }

}
