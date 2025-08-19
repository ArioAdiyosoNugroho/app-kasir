<!-- filepath: /d:/laragon/www/appkasir/resources/views/penjualan/show.blade.php -->
<x-header>Detail Penjualan</x-header>
<x-sidebar></x-sidebar>

<div class="container mt-5">
    <h1 class="mb-4">Detail Penjualan</h1>

    <div class="card p-4">
        <h6>Kasir: {{ $penjualan->user->name }}</h6>
        <hr>

        <h4>Detail Produk</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Kode Produk</th>
                    <th>Harga Jual</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualan->items as $item)
                    <tr>
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td>{{ $item->produk->kode_produk }}</td>
                        <td>Rp. {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>

        <p>Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</p>
        <p>Diskon: {{ $diskon }}%</p>
        <p>Total Harga Setelah Diskon: Rp. {{ number_format($totalHargaDenganDiskon, 0, ',', '.') }}</p>
        <p>Bayar: Rp. {{ number_format($bayar, 0, ',', '.') }}</p>
        <p>Kembalian: Rp. {{ number_format($kembalian, 0, ',', '.') }}</p>
        <hr>

        <a href="{{ route('penjualan.struk', $penjualan->id_penjualan) }}" class="btn btn-sm btn-outline-primary">
            <i class="bx bx-printer"></i> Cetak Struk
        </a>
    </div>
</div>

<x-footer></x-footer>
