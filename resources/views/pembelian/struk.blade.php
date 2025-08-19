
<style>
    @media print {
        body * {
            visibility: hidden; /* Sembunyikan semua elemen */
        }
    
        #print-area, #print-area * {
            visibility: visible; /* Hanya elemen dalam #print-area yang terlihat */
        }
    
        #print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    
        /* Sembunyikan tombol cetak saat print */
        .btn, 
        .btn-sm, 
        .btn-outline-primary, 
        a[onclick^="addform"], 
        button[onclick^="printStruk"] {
            display: none !important;
        }
    }
    </style>
<div id="print-area">
<div class="modal" tabindex="-1" id="modal-form">
    <div class="modal-dialog">
        <div class="container mt-5" id="print-area"> <!-- Tambahkan id di sini -->
            <h1 class="mb-4">Struk Pembelian</h1>
            <div class="card p-4">
                <h3>Supplier: {{ $suplier->nama }}</h3>
                <p>Alamat: {{ $suplier->alamat }}</p>
                <p>Telepon: {{ $suplier->telepon }}</p>
                <h4>Detail Produk</h4>
                <ul>
                    @foreach($produkDetails as $produk)
                        <li>{{ $produk['nama_produk'] }} ({{ $produk['kode_produk'] }}) - Rp. {{ number_format($produk['harga_beli'], 0, ',', '.') }} x {{ $produk['jumlah'] }} = Rp. {{ number_format($produk['subtotal'], 0, ',', '.') }}</li>
                    @endforeach
                </ul>
                <p>Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</p>
                <p>Diskon: {{ $diskon }}%</p>
                <p>Total Harga Setelah Diskon: Rp. {{ number_format($totalHargaDenganDiskon, 0, ',', '.') }}</p>
                <p>Bayar: Rp. {{ number_format($bayar, 0, ',', '.') }}</p>
                <p>Kembalian: Rp. {{ number_format($kembalian, 0, ',', '.') }}</p>
                <p>Terima kasih telah berbelanja!</p>
                <button onclick="printStruk()" class="btn btn-sm btn-outline-primary">
                    <i class="bx bx-printer"></i> Cetak Struk
                </button>
            </div>
        </div>
    </div>
</div>
</div>

<script>a
    function printStruk() {
        window.print();
    }
</script>

<script>
    function printStruk() {
        var modal = document.getElementById('modal-form');
        modal.style.display = 'block'; 
        setTimeout(() => {
            window.print();
            modal.style.display = 'none'; 
        }, 500);
    }
</script>

