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
                    <a class="nav-item nav-link active" href="/barang/barang_table">Barang</a>                    
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

    <!-- Form Card -->
    <div class="container">
        <div class="card">
            <div class="card-header">Tambah Barang</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <form action="">
                        <label>Kategori</label>
                        <input type="text" class="form-control" placeholder="Nama Kategori">
                        <label>Barang</label>
                        <input type="text" class="form-control" placeholder="Nama Barang">
                        <label>Harga Barang</label>
                        <input type="text" class="form-control" placeholder="Harga Barang">
                        <button class="btn btn-success">Tambah</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Table -->
    <div class="container">
        <div class="card">
            <div class="card-header">Tabel Data Barang</div>
            <table class="table table-bordered table-striped mt-3" id="barang-table">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Kategori</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Modify</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $row['id_barang'] }}</td>
                            <td>{{ $row['id_kategori'] }}</td>
                            <td>{{ $row['nama_barang'] }}</td>
                            <td>{{ $row['harga_barang'] }}</td>
                            <td class="d-flex">   
                                <form action="" method="POST" class="me-2">
                                    <button class="btn btn-primary">Edit</button>
                                </form>
                                <form action="" method="POST">
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="pagination">{{ $data->links() }}</div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>