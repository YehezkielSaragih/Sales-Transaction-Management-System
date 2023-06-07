@extends('layouts.default')

@section('title', 'Toko Aneka ATK - Barang Table')
    
@section('content')

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
                        <button class="btn btn-success">Submit</button>
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
                            <input type="text" class="form-control" placeholder="Cari" name="nama_barang" value="{{ $searchQuery ?? '' }}">                            
                        </div>             
                        <div class="col-md-2">
                            <strong>
                                <label>Nama Kategori</label>
                            </strong>
                            <select id="filter-kategori" class="form-control" name = "kategori_barang">
                                <option value="">Pilih Kategori</option>
                                @foreach($dataKategori as $row)
                                    <option value="{{$row->nama_kategori}}" @if($selectedKategori == $row->nama_kategori) selected @endif>{{$row->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>   
                        <div class="col-md-2">
                            <strong>
                                <label>Range Harga Minimum</label>
                            </strong>                            
                            <input type="number" class="form-control" placeholder="Terendah" name="range_harga_min" value="{{ $rangeQueryMin ?? '' }}" min="0">                            
                        </div> 
                        <div class="col-md-2">
                            <strong>
                                <label>Range Harga Maximum</label>
                            </strong>                            
                            <input type="number" class="form-control" placeholder="Tertinggi" name="range_harga_max" value="{{ $rangeQueryMax ?? '' }}" min="0">                            
                        </div> 
                        <div class="col-md-4 search-button-container mt-4 ml-1">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>     
                    </div>
                </div>
            </form>

            <!-- Pagination -->
            <form action="{{ route('barang.index') }}" method="GET" id="barang">
                <label for="page_size">Show :</label>
                <select name="page_size" id="page_size" onchange="this.form.submit()">
                    <option value="10" {{ $pageSize == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ $pageSize == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ $pageSize == 20 ? 'selected' : '' }}>20</option>
                    <option value="25" {{ $pageSize == 25 ? 'selected' : '' }}>25</option>
                </select>
            </form>

            <!-- Table -->
            <div class="table-responsive me-3">
                <table class="table table-bordered table-striped mt-3" id="barang">
                    <thead>
                        <tr>
                            <th>
                                <div class="column-header">
                                    <div>ID Barang</div>
                                    <div>
                                        <a class="sort-link" href="{{ route('barang.index', ['sort_field' => 'barang.id_barang', 'sort_order' => 'asc']) }}">
                                            <i class="fa fa-arrow-up{{ $sortField === 'barang.id_barang' && $sortOrder === 'asc' ? ' text-primary' : ' text-muted' }}"></i>
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
                                            <i class="fa fa-arrow-up{{ $sortField === 'barang.nama_barang' && $sortOrder === 'asc' ? ' text-primary' : ' text-muted' }}"></i>
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
                                            <i class="fa fa-arrow-up{{ $sortField === 'kategori.nama_kategori' && $sortOrder === 'asc' ? ' text-primary' : ' text-muted' }}"></i>
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
                                            <i class="fa fa-arrow-up{{ $sortField === 'harga_barang' && $sortOrder === 'asc' ? ' text-primary' : ' text-muted' }}"></i>
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
                                        <button class="btn btn-warning">Edit</button>
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
            </div>

            <!-- Pagination -->
            <div id="barang">{{ $dataBarang->links() }}</div>

        </div>
    </div>

@endsection
    
@section('script')

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0b159b0f50.js" crossorigin="anonymous"></script>

@endsection
    
