<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Aneka ATK - Kategori Table</title>
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
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <div class="navbar-nav">
                    <!-- Transaksi -->
                    <a class="nav-item nav-link" href="/transaksi/transaksi_table">Transaksi</a>
                    <!-- Detail Transaksi -->
                    <a class="nav-item nav-link" href="/detail_transaksi/detail_transaksi_table">Detail Transaksi</a>                         
                    <!-- Barang -->
                    <a class="nav-item nav-link" href="/barang/barang_table">Barang</a>                    
                    <!-- Kategori -->
                    <a class="nav-item nav-link active" href="/kategori/kategori_table">Kategori</a>
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
            <div class="card-header">Tambah Data Kategori</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <!-- Error Message -->
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <!-- Success Message -->
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <!-- Create function redirect back to /kategori/kategori_table -->
                    <form action="{{ route('kategori.create') }}" method="POST"> 
                        @csrf
                        <label>Kategori</label>
                        <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori" required>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Table -->
    <div class="container">
        <div class="card">
            <div class="card-header">Tabel Data Kategori</div>
            <!-- Pagination -->
            <form action="{{ route('kategori.index') }}" method="GET" id="kategori" class="mt-3">
                <label for="page_size">Show :</label>
                <select name="page_size" id="page_size" onchange="this.form.submit()">
                    <option value="10" {{ $pageSize == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ $pageSize == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ $pageSize == 20 ? 'selected' : '' }}>20</option>
                    <option value="25" {{ $pageSize == 25 ? 'selected' : '' }}>25</option>
                </select>
            </form>
            <!-- Table -->
            <table class="table table-bordered table-striped mt-3" id="kategori">
                <thead>                        
                    <tr>
                        <th>
                            <div class="column-header">
                                <div>ID Kategori</div>
                                <div>
                                    <a class="sort-link" href="{{ route('kategori.index', ['sort_field' => 'id_kategori', 'sort_order' => 'asc']) }}">
                                        <i class="fa fa-arrow-up{{ $sortField === 'id_kategori' && $sortOrder === 'asc' ? ' text-primary' : '' }}"></i>
                                    </a>
                                    <a class="sort-link" href="{{ route('kategori.index', ['sort_field' => 'id_kategori', 'sort_order' => 'desc']) }}">
                                        <i class="fa fa-arrow-down{{ $sortField === 'id_kategori' && $sortOrder === 'desc' ? ' text-primary' : ' text-muted' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="column-header">
                                <div>Nama Kategori</div>
                                <div>
                                    <a class="sort-link" href="{{ route('kategori.index', ['sort_field' => 'nama_kategori', 'sort_order' => 'asc']) }}">
                                        <i class="fa fa-arrow-up{{ $sortField === 'nama_kategori' && $sortOrder === 'asc' ? ' text-primary' : '' }}"></i>
                                    </a>
                                    <a class="sort-link" href="{{ route('kategori.index', ['sort_field' => 'nama_kategori', 'sort_order' => 'desc']) }}">
                                        <i class="fa fa-arrow-down{{ $sortField === 'nama_kategori' && $sortOrder === 'desc' ? ' text-primary' : ' text-muted' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th>Modify</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $row['id_kategori'] }}</td>
                            <td>{{ $row['nama_kategori'] }}</td>
                            <td class="d-flex">   
                                <!-- Edit function redirect to /kategori/kategori_edit -->
                                <form action="{{ route('kategori.edit', $row['id_kategori']) }}" method="POST" class="me-2">
                                    @csrf
                                    <button name="edit" class="btn btn-primary">Edit</button>
                                </form>
                                <!-- Delete function redirect back to /kategori/kategori_table -->
                                <form action="{{ route('kategori.delete', $row['id_kategori']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button name="delete"class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div id="kategori">{{ $data->links() }}</div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0b159b0f50.js" crossorigin="anonymous"></script>

</body>

</html>