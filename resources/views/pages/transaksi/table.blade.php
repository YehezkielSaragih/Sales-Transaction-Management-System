@extends('layouts.default')

@section('title', 'Toko Aneka ATK - Transaksi Table')

@section('content')

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

            <!-- Search bar -->
            <form action="{{ route('transaksi.index') }}" method="GET">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="form-group">
                                <strong>
                                    <label for="tanggal">Tanggal Mulai Transaksi</label>
                                </strong>                                    
                                <input type="date" class="form-control" id="tanggal" name="tanggal_mulai" value="startDate" >
                            </div>
                        </div>   
                        <div class="col-md-3">
                            <div class="form-group">
                                <strong>
                                    <label for="tanggal">Tanggal Akhir Transaksi</label>
                                </strong>                                    
                                <input type="date" class="form-control" id="tanggal" name="tanggal_akhir" value="endDate" >
                            </div>
                        </div>   
                        <div class="col-md-3 search-button-container mt-4 ml-1">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>                           
                    </div>
                </div>
            </form>

            <!-- Pagination -->
            <form action="{{ route('transaksi.index') }}" method="GET" id="transaksi">
                <label for="page_size">Show :</label>
                <select name="page_size" id="page_size" onchange="this.form.submit()">
                    <option value="10" {{ $pageSize == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ $pageSize == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ $pageSize == 20 ? 'selected' : '' }}>20</option>
                    <option value="25" {{ $pageSize == 25 ? 'selected' : '' }}>25</option>
                </select>
            </form>

            <!--Table-->
            <div class="table-responsive me-3">
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
                                <td>{{ date('m/d/Y', strtotime($row['tanggal'])) }}</td>
                                <td>Rp {{ $row['total_transaksi'] }}</td>
                                <td class="d-flex">   
                                    <!-- Edit function redirect to /transaksi/transaksi_edit -->
                                    <form action="{{ route('transaksi.edit', $row['id_transaksi']) }}" method="POST" class="me-2">
                                        @csrf
                                        <button class="btn btn-warning">Edit</button>
                                    </form>
                                    <!-- Delete function redirect back to /transaksi/transaksi_table -->
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
            </div>

            <!-- Pagination -->
            <div id="transaksi">{{ $data->links() }}</div>

        </div>
    </div>

@endsection

@section('script')

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/dynamic_form.js') }}"></script>
    <script src="https://kit.fontawesome.com/0b159b0f50.js" crossorigin="anonymous"></script>

@endsection
    
