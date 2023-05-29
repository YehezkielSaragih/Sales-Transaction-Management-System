<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller{

    public function index(Request $request){   

        // Data
        $dataBarang = Barang::join('kategori', 'barang.id_kategori', '=', 'kategori.id_kategori')
        ->select('barang.id_barang', 'kategori.nama_kategori', 'barang.nama_barang', 'barang.harga_barang');
        $dataKategori = Kategori::orderBy('id_kategori')->paginate(10);

        // Sort and paginate query
        $sortField = $request->input('sort_field', 'barang.id_barang');
        $sortOrder = $request->input('sort_order', 'asc');
        $pageSize = $request->input('page_size', 10);

        // Search query
        if ($request->has('nama_barang')) {
            $dataBarang = $dataBarang->where('nama_barang', 'LIKE', "%" . $request->input('nama_barang') . "%");
        }
        if ($request->filled('kategori_barang')) {
            $dataBarang = $dataBarang->where('kategori.nama_kategori', $request->input('kategori_barang'));
        }           
        if ($request->filled('range_harga_min')) {
            $rangeHarga = (float) $request->input('range_harga_min');
            $dataBarang = $dataBarang->where('barang.harga_barang', '>=', $rangeHarga);
        }      
        if ($request->filled('range_harga_max')) {
            $rangeHarga = (float) $request->input('range_harga_max');
            $dataBarang = $dataBarang->where('barang.harga_barang', '<=', $rangeHarga);
        } 

        // Sort and paginate
        $dataBarang = $dataBarang->orderBy($sortField, $sortOrder)->paginate($pageSize);
        $dataBarang->appends([
            'sort_field' => $sortField,
            'sort_order' => $sortOrder,
            'pageSize' => $pageSize,
            'nama_barang' => $request->input('nama_barang'),
            'kategori_barang' => $request->input('kategori_barang'),
            'range_harga_min' => $request->input('range_harga_min'),
            'range_harga_max' => $request->input('range_harga_max')
        ]);
        // Pass the search query back to the view
        $searchQuery = $request->input('nama_barang');
        $selectedKategori = $request->input('kategori_barang');
        $rangeQueryMin = $request->input('range_harga_min');
        $rangeQueryMax = $request->input('range_harga_max');
        $rangeQuery = $request->input('range_harga');
        
        // Return view
        return view('barang.barang_table', compact('dataBarang', 'dataKategori', 'searchQuery', 'selectedKategori','rangeQueryMax','rangeQueryMin', 'sortField', 'sortOrder', 'pageSize'));
    }

    public function create(Request $request){

        // Validate the request
        $request->validate([
            'nama_kategori' => 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required',
        ]);

        // Check
        if(Barang::where('nama_barang', $request->nama_barang)->exists()){
            $errorMessage = 'Nama barang sudah ada.';
            return redirect()->back()->with('error', $errorMessage);
        }

        // Search for the kategori based on the nama_kategori
        $kategori = KATEGORI::where('nama_kategori', $request->nama_kategori)->first();
        // If kategori not found, return error message
        if (!$kategori) {
            $errorMessage = 'Nama kategori tidak valid.';
            return redirect()->back()->with('error', $errorMessage);
        }

        // Save the data
        $data = [
            'id_kategori' => $kategori->id_kategori,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
        ];
        BARANG::create($data);

        // Redirect to the index with success message
        $successMessage = 'Barang berhasil ditambahkan.';
        return redirect()->back()->with('success', $successMessage);
    }

    public function edit(Request $request, $id) {

        // Avoiding pagination error
        $data = Barang::join('kategori', 'barang.id_kategori', '=', 'kategori.id_kategori')
        ->select('barang.id_barang', 'kategori.nama_kategori', 'barang.nama_barang', 'barang.harga_barang')
        ->orderBy('barang.id_barang', 'asc'); 

        // For form value
        $edit = $data->where('id_barang', $id)->first();
        return view('barang.barang_edit', ['editId' => $id, 'edit' => $edit]);
    }

    public function update(Request $request, $id){

        // Validate the request
        $request->validate([
            'nama_kategori' => 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
        ]);

        // Search for the kategori based on the nama_kategori
        $kategori = KATEGORI::where('nama_kategori', $request->nama_kategori)->first();
        // If kategori not found, return error message
        if (!$kategori) {
            $errorMessage = 'Nama kategori tidak valid.';
            return redirect()->back()->with('error', $errorMessage);
        }

        // Update the data
        $barang = Barang::findOrFail($id);
        $barang->id_kategori = $kategori->id_kategori;
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_barang = $request->harga_barang;
        $barang->save();

        // Redirect to the index with success message
        $successMessage = 'Barang berhasil diperbarui.';
        return redirect()->route('barang.index')->with('success', $successMessage);
    }

    public function delete($id){

        $barang = Barang::findOrFail($id);

        // Barang is being used
        if ($barang->isBeingUsed()) {
            $errorMessage = 'Barang tidak dapat dihapus karena digunakan pada tabel lain.';
            return back()->with('error', $errorMessage);
        }
        // Barang is not used
        $barang->delete();
        
        // Redirect to the index with success message
        $successMessage = 'Barang berhasil dihapus.';
        return back()->with('success', $successMessage);
    }
}
