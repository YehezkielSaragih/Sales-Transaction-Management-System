<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kategori;

class KategoriController extends Controller{

    public function index(Request $request){

        // Sort and paginate query
        $sortField = $request->input('sort_field', 'id_kategori');
        $sortOrder = $request->input('sort_order', 'asc');
        $pageSize = $request->input('page_size', 10);

        // Sort and paginate
        $data = Kategori::orderBy($sortField, $sortOrder)->paginate($pageSize);
        $data->appends([
            'sort_field' => $sortField,
            'sort_order' => $sortOrder,
            'page_size' => $pageSize
        ]);

        // Return view
        return view('kategori.kategori_table', compact('data', 'sortField', 'sortOrder', 'pageSize'));
    }


    public function create(Request $request){

        // Validate the request
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        // Check
        if(Kategori::where('nama_kategori', $request->nama_kategori)->exists()){
            $errorMessage = 'Kategori sudah ada.';
            return redirect()->back()->with('error', $errorMessage);
        }

        // Save the data
        $data = [
            'nama_kategori' => $request->nama_kategori
        ];

        Kategori::create($data);

        // Redirect to the index with success message
        $successMessage = 'Kategori berhasil ditambahkan.';
        return redirect()->back()->with('success', $successMessage);
    }

    public function edit($id) {

        $data = Kategori::get();
        $edit = $data->where('id_kategori', $id)->first();
        return view('kategori.kategori_edit', compact('edit'));
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
        
        // Redirect to the index with success message
        $successMessage = 'Kategori berhasil dihapus.';
        return redirect()->back()->with('success', $successMessage);
    }
}
