@extends('layouts.default')

@section('title', 'Toko Aneka ATK - Detail Transaksi Edit')

@section('content')

    <!-- Form Card -->
    <div class="container">
        <div class="card">
            <div class="card-header">Update Data Detail Transaksi {{ $edit->id_transaksi }}</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <!-- Error Message -->
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <!-- Success Message -->
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <!-- Create function redirect back to /detail_transaksi/detail_transaksi_table -->
                    <form action="{{ route('detail_transaksi.update', ['id' => $editId]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" value="{{ $edit->nama_barang }}"
                            required>
                        <label for="jumlah-barang">Jumlah Barang</label>
                        <input type="number" class="form-control" name="jumlah_barang" value="{{ $edit->jumlah_barang }}"
                            required>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </li>
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
