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
                <a class="nav-item nav-link {{Request::is('transaksi/table') ? 'active' : null}}" href="/transaksi/table">Transaksi</a>
                <!-- Detail Transaksi -->
                <a class="nav-item nav-link {{Request::is('detail_transaksi/table') ? 'active' : null}}" href="/detail_transaksi/table">Detail Transaksi</a>                         
                <!-- Barang -->
                <a class="nav-item nav-link {{Request::is('barang/table') ? 'active' : null}}" href="/barang/table">Barang</a>                    
                <!-- Kategori -->
                <a class="nav-item nav-link {{Request::is('kategori/table') ? 'active' : null}}" href="/kategori/table">Kategori</a>
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