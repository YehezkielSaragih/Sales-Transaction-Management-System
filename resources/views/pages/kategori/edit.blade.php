@extends('layouts.default')

@section('title', 'Toko Aneka ATK - Kategori Edit')

@section('content')

    <!-- Form Card -->
    <div class="container">
        <div class="card">
            <div class="card-header">Update Data Kategori {{ $edit->id_kategori }}</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <!-- Update function redirect back to /kategori/kategori_table -->
                    <form action="{{ route('kategori.update', ['id' => $edit->id_kategori]) }}" method="POST">
                        @csrf 
                        @method('PUT')
                        <label>Kategori</label>
                        <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori" value="{{ $edit->nama_kategori }}" required>
                        <button type="submit" class="btn btn-success">Update</button>                        
                    </form>
                </li>
            </ul>
        </div>
    </div>

@endsection

@section('script')

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
@endsection
