<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Aneka ATK - Barang Table</title>
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
            <div class="card-header">Tambah Data Barang</div>
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
                    <!-- Create function redirect back to /barang/barang_table -->
                    <form action="{{ route('barang.create') }}" method="POST">
                        @csrf
                        <label>Kategori</label>
                        <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori"  required>
                        <label>Barang</label>
                        <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" required>
                        <label>Harga Barang</label>
                        <input type="number" class="form-control" placeholder="Harga Barang" name="harga_barang" required>
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
            <!-- Search Bar -->
            <form action="{{ route('barang.index') }}" method="GET">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <strong>
                                <label>Nama Barang</label>
                            </strong>                            
                            <input type="text" class="form-control" placeholder="Search" name="nama_barang" value="{{ $searchQuery ?? '' }}">                            
                        </div>             
                        <div class="col-md-2">
                            <strong>
                                <label>Nama Kategori</label>
                            </strong>
                            <select id="filter-kategori" class="form-control" name = "kategori_barang">
                                <option value="">Select Kategori</option>
                                @foreach($dataKategori as $row)
                                    <option value="{{$row->nama_kategori}}" @if($selectedKategori == $row->nama_kategori) selected @endif>{{$row->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>   
                        <div class="col-md-2">
                            <strong>
                                <label>Range Harga Minimum</label>
                            </strong>                            
                            <input type="number" class="form-control" placeholder="Minimum Price" name="range_harga_min" value="{{ $rangeQueryMin ?? '' }}" min="0">                            
                        </div> 
                        <div class="col-md-2">
                            <strong>
                                <label>Range Harga Maximum</label>
                            </strong>                            
                            <input type="number" class="form-control" placeholder="Maximum Price" name="range_harga_max" value="{{ $rangeQueryMax ?? '' }}" min="0">                            
                        </div> 
                        <div class="col-md-4 search-button-container mt-4 ml-1">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>     
                    </div>
                </div>
            </form>
            <!-- Table -->
            <table class="table table-bordered table-striped" id="barang">
                <thead>
                    <tr>
                        <th>
                            <div class="column-header">
                                <div>ID Barang</div>
                                <div>
                                    <a class="sort-link" href="{{ route('barang.index', ['sort_field' => 'barang.id_barang', 'sort_order' => 'asc']) }}">
                                        <i class="fa fa-arrow-up{{ $sortField === 'barang.id_barang' && $sortOrder === 'asc' ? ' text-primary' : '' }}"></i>
                                    </a>
                                    <a class="sort-link" href="{{ route('barang.index', ['sort_field' => 'barang.id_barang', 'sort_order' => 'desc']) }}">
                                        <i class="fa fa-arrow-down{{ $sortField === 'barang.id_barang' && $sortOrder === 'desc' ? ' text-primary' : ' text-muted' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="column-header">
                                <div>Nama Barang</div>
                                <div>
                                    <a class="sort-link" href="{{ route('barang.index', ['sort_field' => 'barang.nama_barang', 'sort_order' => 'asc']) }}">
                                        <i class="fa fa-arrow-up{{ $sortField === 'barang.nama_barang' && $sortOrder === 'asc' ? ' text-primary' : '' }}"></i>
                                    </a>
                                    <a class="sort-link" href="{{ route('barang.index', ['sort_field' => 'barang.nama_barang', 'sort_order' => 'desc']) }}">
                                        <i class="fa fa-arrow-down{{ $sortField === 'barang.nama_barang' && $sortOrder === 'desc' ? ' text-primary' : ' text-muted' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="column-header">
                                <div>Nama Kategori</div>
                                <div>
                                    <a class="sort-link" href="{{ route('barang.index', ['sort_field' => 'kategori.nama_kategori', 'sort_order' => 'asc']) }}">
                                        <i class="fa fa-arrow-up{{ $sortField === 'kategori.nama_kategori' && $sortOrder === 'asc' ? ' text-primary' : '' }}"></i>
                                    </a>
                                    <a class="sort-link" href="{{ route('barang.index', ['sort_field' => 'kategori.nama_kategori', 'sort_order' => 'desc']) }}">
                                        <i class="fa fa-arrow-down{{ $sortField === 'kategori.nama_kategori' && $sortOrder === 'desc' ? ' text-primary' : ' text-muted' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="column-header">
                                <div>Harga Barang</div>
                                <div>
                                    <a class="sort-link" href="{{ route('barang.index', ['sort_field' => 'harga_barang', 'sort_order' => 'asc']) }}">
                                        <i class="fa fa-arrow-up{{ $sortField === 'harga_barang' && $sortOrder === 'asc' ? ' text-primary' : '' }}"></i>
                                    </a>
                                    <a class="sort-link" href="{{ route('barang.index', ['sort_field' => 'harga_barang', 'sort_order' => 'desc']) }}">
                                        <i class="fa fa-arrow-down{{ $sortField === 'harga_barang' && $sortOrder === 'desc' ? ' text-primary' : ' text-muted' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th>Modify</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataBarang as $row)
                        <tr>
                            <td>{{ $row['id_barang'] }}</td>
                            <td>{{ $row['nama_barang'] }}</td>
                            <td>{{ $row['nama_kategori'] }}</td>
                            <td>{{ $row['harga_barang'] }}</td>
                            <td class="d-flex">   
                                <!-- Edit function redirect to /barang/barang_edit -->
                                <form action="{{ route('barang.edit', $row['id_barang']) }}" method="POST" class="me-2">
                                    @csrf
                                    <button class="btn btn-primary">Edit</button>
                                </form>
                                <!-- Delete function redirect back to /barang/barang_table -->
                                <form action="{{ route('barang.delete', $row['id_barang']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="barang">{{ $dataBarang->links() }}</div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0b159b0f50.js" crossorigin="anonymous"></script>
    
</body>

</html>