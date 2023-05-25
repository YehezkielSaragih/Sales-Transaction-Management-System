<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kategori;

class KategoriController extends Controller
{
    //
    public function __construct()
    {
        Session::regenerateToken();
    }

    public function index($id = null) {
        $data = Kategori::paginate(10);
        return view('kategori.kategori_table', compact('data'));
        // return $data;
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

    public function edit(Request $request, $id) {
        $data = Kategori::paginate(10);
        $edit = Kategori::findOrFail($id);
        return view('kategori.kategori_edit', ['editId' => $id, 'edit' => $edit], compact('data'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_kategori' => 'required'
        ]);
        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return redirect()->route('kategori.index');
    }

    public function delete($id){
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori.index');
    }
}
