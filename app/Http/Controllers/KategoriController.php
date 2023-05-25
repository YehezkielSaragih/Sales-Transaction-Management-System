<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kategori;

class KategoriController extends Controller
{
    //
    public function index() {
        $data = Kategori::paginate(10);
        return view('kategori.kategori_table', compact('data'));
        // return $data;
    }

    public function create(Request $request){
        // Validate the request
        $request->validate([
            'nama_kategori' => 'required'
        ]);
        // Save the data
        $data = [
            'nama_kategori' => $request->nama_kategori
        ];
        Kategori::create($data);
        // Redirect to the index with success message
        $successMessage = 'Kategori berhasil ditambahkan.';
        return redirect()->route('kategori.index')->with('success', $successMessage);
    }

    public function edit(Request $request, $id) {
        $data = Kategori::paginate(10);
        $edit = Kategori::findOrFail($id);
        return view('kategori.kategori_edit', ['editId' => $id, 'edit' => $edit], compact('data'));
    }

    public function update(Request $request, $id){
        // Validate the request
        $request->validate([
            'nama_kategori' => 'required'
        ]);
        // Update the data
        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        // Redirect to the index with success message
        $successMessage = 'Kategori berhasil diperbarui.';
        return redirect()->route('kategori.index')->with('success', $successMessage);
    }

    public function delete($id){
        $kategori = Kategori::findOrFail($id);
        // Kategori is being used
        if ($kategori->isBeingUsed()) {
            $errorMessage = 'Kategori tidak dapat dihapus karena digunakan pada tabel lain.';
            return back()->with('error', $errorMessage);
        }
        // Kategori is not used
        $kategori->delete();
        $successMessage = 'Kategori berhasil dihapus.';
        return back()->with('success', $successMessage);
    }
}
