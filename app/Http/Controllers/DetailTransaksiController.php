<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Barang;

class DetailTransaksiController extends Controller
{
    //
    public function index(Request $request){
        
        // Sort query
        $sortField = $request->input('sort_field', 'id_detail_transaksi');
        $sortOrder = $request->input('sort_order', 'asc');
        
        // Data
        $data = DetailTransaksi::join('barang', 'detail_transaksi.id_barang', '=', 'barang.id_barang')
        ->select('detail_transaksi.id_transaksi', 'detail_transaksi.id_detail_transaksi', 'barang.nama_barang', 'detail_transaksi.jumlah_barang', 'detail_transaksi.harga_barang_transaksi');
        
        // Search query
        if($request->has('nama_barang')){
            $data = $data->where('barang.nama_barang','LIKE',"%".$request->input('nama_barang')."%");
        }
        if($request->filled('range_harga_min')){
            $range_harga = (float)$request->input('range_harga_min');
            $data = $data->where('detail_transaksi.harga_barang_transaksi',">=",$range_harga);
        }
        if($request->filled('range_harga_max')){
            $range_harga = (float)$request->input('range_harga_max');
            $data = $data->where('detail_transaksi.harga_barang_transaksi',"<=",$range_harga);
        }
        
        // Sort and Paginate
        $data = $data->orderBy($sortField, $sortOrder)->paginate(10);
        // Pass the search query back to the view
        $searchQuery = $request->input('nama_barang');
        $rangeQueryMin = $request->input('range_harga_min');
        $rangeQueryMax = $request-> input('range_harga_max');
        
        // Return view
        return view('detail_transaksi.detail_transaksi_table', compact('data','searchQuery','rangeQueryMin','rangeQueryMax', 'sortField', 'sortOrder'));
    }

    public function create(Request $request){
        // Validate the request
        $request->validate([
            'tanggal' => 'required',
            'nama_barang' => 'required|array',
            'nama_barang.*' => 'required',
            'jumlah_barang' => 'required|array',
            'jumlah_barang.*' => 'required|numeric|min:1',
        ]);
        // Get the form input values
        $tanggal = $request->input('tanggal');
        $namaBarangInputs = $request->input('nama_barang');
        $jumlahBarangInputs = $request->input('jumlah_barang');
        // Declare variables
        $idBarang = [];
        $hargaBarangTransaksi = [];
        $totalTransaksi = 0;
        // First loop
        foreach ($namaBarangInputs as $index => $namaBarang) {
            // Check if nama barang is valid
            $barang = Barang::where('nama_barang', $namaBarang)->first();
            if (!$barang) {
                $errorMessage = 'Nama barang tidak valid: ' . $namaBarang;
                return redirect()->back()->with('error', $errorMessage);
            }
            // Barang variables
            $idBarang[$index] = $barang->id_barang;
            $hargaBarang = $barang->harga_barang;
            // Calculate harga barang transaksi
            $hargaBarangTransaksi[$index] = $hargaBarang * $jumlahBarangInputs[$index];
            // Calculate total transaksi
            $totalTransaksi += $hargaBarangTransaksi[$index];
        }
        // Create data, transaksi record and take the id
        $dataTransaksi = [
            'tanggal' => $tanggal,
            'total_transaksi' => $totalTransaksi
        ];
        $transaksi = Transaksi::create($dataTransaksi);
        $idTransaksi = $transaksi->id_transaksi;
        // return $idTransaksi;
        // Create data and detail transaksi record
        foreach ($namaBarangInputs as $index => $namaBarang) {
            $dataDetailTransaksi = [
                'id_transaksi' => $idTransaksi,
                'id_barang' => $idBarang[$index],
                'jumlah_barang' => $jumlahBarangInputs[$index],
                'harga_barang_transaksi' => $hargaBarangTransaksi[$index]
            ];
            DetailTransaksi::create($dataDetailTransaksi);
        }
        // Show success message or perform any other action
        $successMessage = 'Transaksi berhasil ditambahkan.';
        return redirect()->back()->with('success', $successMessage);
    }

    public function edit($id){
        // Avoiding pagination error
        $data = DetailTransaksi::join('barang', 'detail_transaksi.id_barang', '=', 'barang.id_barang')
        ->select('detail_transaksi.id_transaksi', 'detail_transaksi.id_detail_transaksi', 'barang.nama_barang', 'detail_transaksi.jumlah_barang', 'detail_transaksi.harga_barang_transaksi')
        ->orderBy('id_detail_transaksi', 'asc');
        // For form value
        $edit = $data->where('id_detail_transaksi', $id)->first();
        return view('detail_transaksi.detail_transaksi_edit', ['editId' => $id, 'edit' => $edit]);
    }

    public function update(Request $request, $id){
        // Validate the request
        $request->validate([
            'nama_barang' => 'required',
            'jumlah_barang' => 'required|numeric'
        ]);
        // Search for barang based on nama barang
        $barang = Barang::where('nama_barang', $request->input('nama_barang'))->first();
        if (!$barang) {
            $errorMessage = 'Nama barang tidak valid: ' . $request->input('nama_barang');
            return redirect()->back()->with('error', $errorMessage);
        }
        $idBarang = $barang->id_barang;
        // Prev Harga Transaksi
        $detailTransaksi = DetailTransaksi::findOrFail($id);
        $prevHargaBarangTransaksi = $detailTransaksi->harga_barang_transaksi;
        // New Harga Transaksi
        $hargaBarang = $barang->harga_barang;
        $jumlahBarang = $request->input('jumlah_barang');
        $newHargaBarangTransaksi = $hargaBarang * $jumlahBarang;
        // Update transaksi data
        $transaksi = Transaksi::findOrFail($detailTransaksi->id_transaksi);
        if($newHargaBarangTransaksi > $prevHargaBarangTransaksi){
            $transaksi->total_transaksi += $newHargaBarangTransaksi - $prevHargaBarangTransaksi;
        }
        else{
            $transaksi->total_transaksi -= $prevHargaBarangTransaksi - $newHargaBarangTransaksi;
        }
        $transaksi->save();
        // Update detail transaksi data
        $detailTransaksi->id_barang = $idBarang;
        $detailTransaksi->jumlah_barang = $jumlahBarang;
        $detailTransaksi->harga_barang_transaksi = $newHargaBarangTransaksi;
        $detailTransaksi->save();
        // Redirect to the index with success message
        $successMessage = 'Detail transaksi berhasil diubah.';
        return redirect()->route('detail_transaksi.index')->with('success', $successMessage);
    }

    public function delete($id){
        // Get detail transaksi row
        $detailTransaksi = DetailTransaksi::findOrFail($id);
        // Get id transaksi from detail transaksi row
        $idTransaksi = $detailTransaksi->id_transaksi;
        // Get harga barang transaksi from detail transaksi row
        $hargaBarangTransaksi = $detailTransaksi->harga_barang_transaksi;
        // Get transaksi row
        $transaksi = Transaksi::findOrFail($idTransaksi);
        // Change total transaksi
        $transaksi->total_transaksi -= $hargaBarangTransaksi;
        // Save transaksi row
        $transaksi->save();
        // Delete detail transaksi row
        $detailTransaksi->delete();
        // If total transaksi = 0 then delete transaksi row
        if($transaksi->total_transaksi == 0){
            $transaksi->delete();
        }
        // Redirect to the index with success message
        $successMessage = 'Detail transaksi berhasil dihapus.';
        return back()->with('success', $successMessage);
    }
}
