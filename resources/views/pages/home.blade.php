@extends('layouts.default')

@section('title', 'Toko Aneka ATK - Homepage')

@section('content')

    <!-- Welcome-->
    <div class="container mt-2">
        <h1> Welcome, {{ Auth::user()->name }}</h1>
    </div>

    <!-- Main -->
    <div class="container mt-3">
        <div class="card mt-3" id="homeinfo">
            <div class="card-header">Transaksi {{ $today }}</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Terjadi {{ $transaksiCount }} transaksi pada hari ini</li>
                <li class="list-group-item">Total transaksi pada hari ini mencapai Rp {{ $totalTransaksi }} </li>
                @if ($mostSoldBarangToday != 'Tidak ada')
                    <li class="list-group-item">{{ $mostSoldBarangToday }} adalah barang yang paling banyak terjual pada hari
                        ini</li>
                @endif
            </ul>
        </div>
        <div class="card mt-3" id="homeinfo">
            <div class="card-header">Barang</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Terdapat {{ $barangCount }} jenis barang yang tersedia</li>
                <li class="list-group-item">{{ $mostSoldBarang }} adalah barang yang paling banyak terjual</li>
            </ul>
        </div>
        <div class="card mt-3" id="homeinfo">
            <div class="card-header">Kategori</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Terdapat {{ $kategoriCount }} kategori barang yang tersedia</li>
            </ul>
        </div>
    </div>
    
@endsection

@section('script')

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>    

@endsection
