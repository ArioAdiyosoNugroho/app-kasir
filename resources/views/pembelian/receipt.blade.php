<x-header>Struk Pembelian</x-header>
<x-sidebar></x-sidebar>

<style>
@media print {
    body * {
        visibility: hidden;
    }

    #print-area, #print-area * {
        visibility: visible;
    }

    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        font-family: 'Courier New', monospace;
        text-align: center;
    }

    .btn, 
    .btn-sm, 
    .btn-outline-primary, 
    a[onclick^="addform"], 
    button[onclick^="printStruk"] {
        display: none !important;
    }
}

.receipt {
    max-width: 300px;
    margin: auto;
    padding: 10px;
    border: 1px dashed #000;
    font-family: 'Courier New', monospace;
    text-align: center;
}

.receipt h3 {
    margin-bottom: 5px;
}

.receipt hr {
    border: none;
    border-top: 1px dashed #000;
    margin: 5px 0;
}

.receipt .separator {
    font-weight: bold;
    margin: 5px 0;
}

.receipt .detail {
    text-align: left;
}
</style>

<div class="container mt-5" id="print-area">
    <div class="receipt">
        <h3>Struk Pembelian</h3>
        <p class="separator">==============================</p>
        <p>Supplier: {{ $suplier->nama }}</p>
        <p>Alamat: {{ $suplier->alamat }}</p>
        <p>Telepon: {{ $suplier->telepon }}</p>
        <p class="separator">==============================</p>
        <p><strong>Detail Produk</strong></p>
        <div class="detail">
            @foreach($produkDetails as $produk)
                <p>{{ $produk['nama_produk'] }}
                <br>{{ $produk['kode_produk'] }} - Rp. {{ number_format($produk['harga_beli'], 0, ',', '.') }}
                <br>x {{ $produk['jumlah'] }} = Rp. {{ number_format($produk['subtotal'], 0, ',', '.') }}</p>
                <p class="separator">------------------------------</p>
            @endforeach
        </div>
        <p class="separator">==============================</p>
        <p>Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</p>
        <p>Diskon: {{ $diskon }}%</p>
        <p>Total Setelah Diskon: Rp. {{ number_format($totalHargaDenganDiskon, 0, ',', '.') }}</p>
        <p>Bayar: Rp. {{ number_format($bayar, 0, ',', '.') }}</p>
        <p>Kembalian: Rp. {{ number_format($kembalian, 0, ',', '.') }}</p>
        <p class="separator">==============================</p>
        <p>Terima Kasih!</p>
        <p>Selamat Berbelanja Kembali</p>
        <p class="separator">******************************</p>
    </div>
    <button onclick="printStruk()" class="btn btn-sm btn-outline-primary">
        <i class="bx bx-printer"></i> Cetak Struk
    </button>
</div>

<x-footer></x-footer>

<script>
    function printStruk() {
        window.print();
    }
</script>
