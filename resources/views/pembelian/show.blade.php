<!-- filepath: /d:/laragon/www/appkasir/resources/views/pembelian/show.blade.php -->
<x-header>Detail Pembelian</x-header>
<x-sidebar></x-sidebar>

<div class="container mt-5">
    <h1 class="mb-4">Detail Pembelian</h1>

    <div class="card p-4">
        <h3>Supplier: {{ $pembelian->suplier->nama }}</h3>
        <p>Alamat: {{ $pembelian->suplier->alamat }}</p>
        <p>Telepon: {{ $pembelian->suplier->telepon }}</p>
        <hr>

        <h4>Detail Produk</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Kode Produk</th>
                    <th>Harga Beli</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembelian->items as $item)
                    <tr>
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td>{{ $item->produk->kode_produk }}</td>
                        <td>Rp. {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>

        <p>Total Harga: Rp. {{ number_format($pembelian->total_harga, 0, ',', '.') }}</p>
        <p>Diskon: {{ $pembelian->diskon }}%</p>
        <p>Total Harga Setelah Diskon: Rp. {{ number_format($pembelian->total_harga * (1 - $pembelian->diskon / 100), 0, ',', '.') }}</p>
        <p>Bayar: Rp. {{ number_format($pembelian->bayar, 0, ',', '.') }}</p>
        <p>Kembalian: Rp. {{ number_format($pembelian->kembalian, 0, ',', '.') }}</p>
        <hr>

        <button onclick="printStruk()" class="btn btn-sm btn-outline-primary">
            <i class="bx bx-printer"></i> Cetak Struk
        </button>
    </div>
</div>

<x-footer></x-footer>

<script>
    function printStruk() {
        window.print();
    }
</script>
