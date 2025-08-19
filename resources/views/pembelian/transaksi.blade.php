<!-- filepath: /d:/laragon/www/appkasir/resources/views/pembelian/transaksi.blade.php -->
<x-header>Transaksi Pembelian</x-header>
<x-sidebar></x-sidebar>

<div class="container mt-5">
    <h1 class="mb-4">Transaksi Pembelian</h1>

    <div class="card p-4">
        <h3>Supplier: {{ $suplier->nama }}</h3>
        <p>Alamat: {{ $suplier->alamat }}</p>
        <p>Telepon: {{ $suplier->telepon }}</p>

        <!-- Form untuk transaksi pembelian -->
        <form action="{{ route('pembelian.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_supplier" value="{{ $suplier->id_supplier }}">

            <div class="mb-3">
                <label for="kode_produk" class="form-label">Masukkan Kode Produk:</label>
                <input type="text" id="kode_produk" class="form-control" placeholder="Kode Produk">
            </div>

            <div class="mb-3">
                <label for="select_produk" class="form-label">Pilih Produk:</label>
                <select id="select_produk" class="form-select">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produk as $item)
                        <option value="{{ $item->kode_produk }}" data-harga="{{ $item->harga_beli }}">
                            {{ $item->nama_produk }} ({{ $item->kode_produk }}) - Rp. {{ number_format($item->harga_beli, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="button" class="btn btn-secondary mb-3" id="tambah-produk">Tambah Produk</button>
            <div class="table-responsive text-nowrap">
            <table class="table table-bordered" id="produk-table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Kode Produk</th>
                        <th>Harga Beli</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Produk yang dipilih akan ditambahkan di sini -->
                </tbody>
            </table>
            </div>

            <div class="mb-3">
                <label for="diskon" class="form-label">Diskon (%):</label>
                <input type="number" name="diskon" id="diskon" class="form-control" placeholder="Diskon" min="0" max="100" onchange="updateTotal()">
            </div>

            <div class="mb-3">
                <label for="total_item" class="form-label">Total Item:</label>
                <input type="text" id="total_item" class="form-control" value="0" readonly>
            </div>

            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga:</label>
                <input type="text" name="total_harga" id="total_harga" class="form-control" value="Rp. 0" readonly>
            </div>

            <div class="mb-3">
                <label for="bayar" class="form-label">Jumlah Pembayaran:</label>
                <input type="number" name="bayar" id="bayar" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        </form>
    </div>
</div>

<x-footer></x-footer>

<script>
    let produkList = @json($produk);
    let selectedProduk = [];

    document.getElementById('tambah-produk').addEventListener('click', function() {
        const kodeProdukInput = document.getElementById('kode_produk').value;
        const selectProduk = document.getElementById('select_produk');
        const kodeProdukSelect = selectProduk.value;
        const kodeProduk = kodeProdukInput || kodeProdukSelect;

        console.log('Kode Produk Input:', kodeProdukInput);
        console.log('Kode Produk Select:', kodeProdukSelect);
        console.log('Kode Produk:', kodeProduk);

        if (!kodeProduk) {
            alert('Silakan masukkan kode produk atau pilih produk.');
            return;
        }

        const produk = produkList.find(item => item.kode_produk == kodeProduk);
        if (!produk) {
            alert('Produk tidak ditemukan.');
            return;
        }

        const existingProduk = selectedProduk.find(item => item.kode_produk == kodeProduk);
        if (existingProduk) {
            existingProduk.jumlah += 1;
            existingProduk.subtotal = existingProduk.harga_beli * existingProduk.jumlah;
        } else {
            selectedProduk.push({
                nama_produk: produk.nama_produk,
                kode_produk: produk.kode_produk,
                harga_beli: produk.harga_beli,
                jumlah: 1,
                subtotal: produk.harga_beli
            });
        }

        updateTable();
        updateTotal();
    });

    function updateTable() {
        const tbody = document.querySelector('#produk-table tbody');
        tbody.innerHTML = '';

        selectedProduk.forEach((produk, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${produk.nama_produk}</td>
                <td>${produk.kode_produk}</td>
                <td>Rp. ${produk.harga_beli.toLocaleString()}</td>
                <td>
                    <input type="number" name="produk[${index}][jumlah]" class="form-control" value="${produk.jumlah}" min="1" onchange="updateJumlah(${index}, this.value)">
                </td>
                <td>Rp. ${produk.subtotal.toLocaleString()}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusProduk(${index})">Hapus</button>
                </td>
                <input type="hidden" name="produk[${index}][kode_produk]" value="${produk.kode_produk}">
                <input type="hidden" name="produk[${index}][harga_beli]" value="${produk.harga_beli}">
            `;
            tbody.appendChild(tr);
        });
    }

    function updateJumlah(index, jumlah) {
        selectedProduk[index].jumlah = parseInt(jumlah);
        selectedProduk[index].subtotal = selectedProduk[index].harga_beli * selectedProduk[index].jumlah;
        updateTable();
        updateTotal();
    }

    function hapusProduk(index) {
        selectedProduk.splice(index, 1);
        updateTable();
        updateTotal();
    }

    function updateTotal() {
        let totalHarga = 0;
        let totalItem = 0;

        selectedProduk.forEach(produk => {
            totalHarga += produk.subtotal;
            totalItem += produk.jumlah;
        });

        const diskon = parseInt(document.getElementById('diskon').value) || 0;
        const hargaDenganDiskon = totalHarga * (1 - diskon / 100);

        document.getElementById('total_harga').value = 'Rp. ' + hargaDenganDiskon.toLocaleString();
        document.getElementById('total_item').value = totalItem;
    }
</script>