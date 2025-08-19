<x-header>
    Dashboard
</x-header>
    <!-- Menu -->

    <x-sidebar>
        
    </x-sidebar>

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-4">
                        <div class="card-header">Dashboard Kasir</div>
        
                        <div class="card-body">
                            <h5>Selamat🎉, Sekarang anda sudah login sebagai kasir.</h5>
                            <span>Selamat bekerja, {{ Auth::user()->name }}</span>
                            <div class="shortcut mt-4">
                                <!-- Produk Button Group -->
                                <div class="btn-group mb-3">
                                    <a href="{{ route('produk.index') }}" class="btn btn-primary">Data Produk</a>
                                    <a href="{{ route('addproduk') }}" class="btn btn-primary">Tambah Produk</a>
                                    <a href="{{ route('kategori.index') }}" class="btn btn-primary">Kategori Produk</a>
                                </div>

                                <!-- Transaksi Button Group -->
                                <div class="btn-group mb-3">
                                    <a href="{{ route('addtransaksi') }}" class="btn btn-info">Tambah Transaksi</a>
                                    <a href="{{ route('penjualan.index') }}" class="btn btn-info">Riwayat Transaksi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-footer></x-footer>

        <style>
            .shortcut .btn-group {
                margin: 10px;
            }
            .card-header {
                font-size: 24px;
                font-weight: bold;
            }
            .card-body h5 {
                font-size: 20px;
                margin-bottom: 10px;
            }
        </style>