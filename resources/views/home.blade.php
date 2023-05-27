<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Aneka ATK - Homepage</title>
    <!-- Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-primary bg-light sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="/home">Toko Aneka ATK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Content -->
            <div class="collapse navbar-collapse justify-content-between"" id="navbarSupportedContent">
                <div class="navbar-nav">
                    <!-- Transaksi -->
                    <a class="nav-item nav-link" href="/transaksi/transaksi_table">Transaksi</a>
                    <!-- Detail Transaksi -->
                    <a class="nav-item nav-link" href="/detail_transaksi/detail_transaksi_table">Detail Transaksi</a>                         
                    <!-- Barang -->
                    <a class="nav-item nav-link" href="/barang/barang_table">Barang</a>                    
                    <!-- Kategori -->
                    <a class="nav-item nav-link" href="/kategori/kategori_table">Kategori</a>
                </div>
                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Welcome-->
    <div class="container mt-2">
       <h1> Welcome, {{ Auth::user()->name }}</h1>
    </div>

    <!-- Main -->
    <div class="container mt-3">
        <!-- <div class="row"> -->
            <div class="card mt-3" id="homeinfo">
                <div class="card-header">Transaksi {{ $today }}</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Terjadi {{ $transaksiCount }} transaksi</li>
                    <li class="list-group-item">Total transaksi mencapai Rp {{ $totalTransaksi }} </li>
                </ul>
            </div>
            <div class="card mt-3" id="homeinfo">
                <div class="card-header">Barang</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Terdapat {{ $barangCount }} jenis barang yang tersedia</li>
                </ul>
            </div>
            <div class="card mt-3" id="homeinfo">
                <div class="card-header">Kategori</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Terdapat {{ $kategoriCount }} kategori barang yang tersedia</li>
                </ul>
            </div>
        <!-- </div> -->
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>