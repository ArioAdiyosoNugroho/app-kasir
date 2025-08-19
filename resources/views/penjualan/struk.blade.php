<x-header>cetak struk</x-header>
<x-sidebar></x-sidebar>

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
            width: 80mm; /* Lebar kertas struk */
            padding: 10mm; /* Margin kertas struk */
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

    .struk-container {
        width: 80mm; /* Lebar kertas struk */
        margin: auto;
        padding: 10mm; /* Margin kertas struk */
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #fff;
        font-family: Arial, sans-serif;
        font-size: 12px;
    }

    .struk-header {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .struk-header img {
        max-width: 25px; /* Ukuran logo */
        margin-right: 10px;
    }

    .struk-header h1 {
        font-size: 14px;
        margin: 0;
    }

    .struk-header p {
        font-size: 10px;
        margin: 0;
    }

    .struk-details {
        margin-bottom: 15px;
    }

    .struk-details ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .struk-details ul li {
        margin-bottom: 8px;
        font-size: 12px;
    }

    .struk-footer {
        text-align: center;
        font-size: 10px;
        margin-top: 15px;
    }

    .struk-footer p {
        margin: 0;
    }

    .line {
        border-top: 1px dashed #000;
        margin: 10px 0;
    }
</style>

<div id="print-area" class="m-5">
    <div class="struk-container">
        <div class="struk-header">
            <img src="{{ asset('sneat/assets/img/favicon/favicon.ico') }}" alt="Logo Toko">
            <div>
                <h1>Toko Ku</h1>
                <p>Jl. Contoh Alamat No. 123, Kota</p>
                <p>Telp: 08123456789</p>
            </div>
        </div>

        <div class="line"></div>

        <div class="struk-details">
            <h6>Kasir: {{ $penjualan->user->name }}</h6>
            <h6>Detail Produk</h6>
            <ul>
                @foreach($produkDetails as $produk)
                    <li>{{ $produk['nama_produk'] }} ({{ $produk['kode_produk'] }}) - Rp. {{ number_format($produk['harga_jual'], 0, ',', '.') }} x {{ $produk['jumlah'] }} = Rp. {{ number_format($produk['subtotal'], 0, ',', '.') }}</li>
                @endforeach
            </ul>
        </div>

        <div class="line"></div>

        <div class="struk-details">
            <p>Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</p>
            <p>Diskon: {{ $diskon }}%</p>
            <p>Total Harga Setelah Diskon: Rp. {{ number_format($totalHargaDenganDiskon, 0, ',', '.') }}</p>
            <p>Bayar: Rp. {{ number_format($bayar, 0, ',', '.') }}</p>
            <p>Kembalian: Rp. {{ number_format($kembalian, 0, ',', '.') }}</p>
        </div>

        <div class="struk-footer">
            <p>"Terima kasih telah berbelanja!"</p>
            <button onclick="printStruk()" class="btn btn-sm btn-outline-primary">
                <i class="bx bx-printer"></i> Cetak Struk
            </button>
        </div>
    </div>
</div>

<x-footer></x-footer>

<script>
    function printStruk() {
        window.print();
    }
</script>
