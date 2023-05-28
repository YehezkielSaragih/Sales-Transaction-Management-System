<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Aneka ATK - Transaksi Table</title>
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
                    <a class="nav-item nav-link active" href="/transaksi/transaksi_table">Transaksi</a>
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
    <!-- Form Card -->
    <div class="container">
        <div class="card">
            <div class="card-header">Tambah Data Transaksi</div>
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
                    <!-- Create function redirect back to /transaksi/transaksi_table -->
                    <form action="{{ route('transaksi.create') }}" method="POST">
                        @csrf
                        <!-- Static Form Fields -->
                        <div class="form-group">
                            <label for="tanggal">Tanggal Transaksi</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <!-- Dynamic Form Fields -->
                        <div class="card mb-3" id="dynamic-form">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <label for="barang">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang[]" required>
                                    <label for="jumlah-barang">Jumlah Barang</label>
                                    <input type="number" class="form-control" name="jumlah_barang[]" required>
                                    <button class="btn btn-danger" onclick="removeField(event)">Delete</button>
                                </li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addField()">Add Another</button>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Table -->
    <div class="container">
        <div class="card">
            <div class="card-header">Tabel Data Transaksi</div>
            <table class="table table-bordered table-striped mt-3" id="transaksi">
                <thead>
                    <tr>
                        <th>
                            <div class="column-header">
                                <div>ID Transaksi</div>
                                <div>
                                    <a class="sort-link" href="{{ route('transaksi.index', ['sort_field' => 'id_transaksi', 'sort_order' => 'asc']) }}">
                                        <i class="fa fa-arrow-up{{ $sortField === 'id_transaksi' && $sortOrder === 'asc' ? ' text-primary' : '' }}"></i>
                                    </a>
                                    <a class="sort-link" href="{{ route('transaksi.index', ['sort_field' => 'id_transaksi', 'sort_order' => 'desc']) }}">
                                        <i class="fa fa-arrow-down{{ $sortField === 'id_transaksi' && $sortOrder === 'desc' ? ' text-primary' : ' text-muted' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="column-header">
                                <div>Tanggal</div>
                                <div>
                                    <a class="sort-link" href="{{ route('transaksi.index', ['sort_field' => 'tanggal', 'sort_order' => 'asc']) }}">
                                        <i class="fa fa-arrow-up{{ $sortField === 'tanggal' && $sortOrder === 'asc' ? ' text-primary' : '' }}"></i>
                                    </a>
                                    <a class="sort-link" href="{{ route('transaksi.index', ['sort_field' => 'tanggal', 'sort_order' => 'desc']) }}">
                                        <i class="fa fa-arrow-down{{ $sortField === 'tanggal' && $sortOrder === 'desc' ? ' text-primary' : ' text-muted' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="column-header">
                                <div>Total Transaksi</div>
                                <div>
                                    <a class="sort-link" href="{{ route('transaksi.index', ['sort_field' => 'total_transaksi', 'sort_order' => 'asc']) }}">
                                        <i class="fa fa-arrow-up{{ $sortField === 'total_transaksi' && $sortOrder === 'asc' ? ' text-primary' : '' }}"></i>
                                    </a>
                                    <a class="sort-link" href="{{ route('transaksi.index', ['sort_field' => 'total_transaksi', 'sort_order' => 'desc']) }}">
                                        <i class="fa fa-arrow-down{{ $sortField === 'total_transaksi' && $sortOrder === 'desc' ? ' text-primary' : ' text-muted' }}"></i>
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
                            <td>{{ $row['id_transaksi'] }}</td>
                            <td>{{ $row['tanggal'] }}</td>
                            <td>Rp {{ $row['total_transaksi'] }}</td>
                            <td class="d-flex">   
                                <!-- Edit function redirect to /barang/barang_edit -->
                                <form action="{{ route('transaksi.edit', $row['id_transaksi']) }}" method="POST" class="me-2">
                                    @csrf
                                    <button class="btn btn-primary">Edit</button>
                                </form>
                                <!-- Delete function redirect back to /barang/barang_table -->
                                <form action="{{ route('transaksi.delete', $row['id_transaksi']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="transaksi">{{ $data->links() }}</div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/dynamic_form.js') }}"></script>
    <script src="https://kit.fontawesome.com/0b159b0f50.js" crossorigin="anonymous"></script>

</body>

</html>