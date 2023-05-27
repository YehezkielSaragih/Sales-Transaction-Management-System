<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    //
    public function index(){
        $data = Transaksi::paginate(10);
        return view('transaksi.transaksi_table', compact('data'));
        // return $data;
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

    public function delete($id){
        // Delete detail transaksi records
        $detailTransaksi = DetailTransaksi::where('id_transaksi', $id)->get();
        foreach ($detailTransaksi as $detail) {
            $detail->delete();
        }
        // Delete transaksi record
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        // Redirect to the index with success message
        $successMessage = 'Transaksi berhasil dihapus.';
        return redirect()->back()->with('success', $successMessage);
    }
}
