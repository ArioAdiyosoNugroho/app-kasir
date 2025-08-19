<!-- filepath: /d:/laragon/www/appkasir/resources/views/laporan/bulanan.blade.php -->
<x-header>Laporan Bulanan</x-header>
<x-sidebar></x-sidebar>

<div class="container mt-5">
    <h1 class="mb-4">Laporan Bulanan</h1>

    <form action="{{ route('laporan.bulanan') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="bulan" class="form-label">Bulan</label>
                <select name="bulan" id="bulan" class="form-select">
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ $bulan == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <label for="tahun" class="form-label">Tahun</label>
                <select name="tahun" id="tahun" class="form-select">
                    @for($i = 2020; $i <= Carbon\Carbon::now()->year; $i++)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </div>
        </div>
    </form>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Rekapitulasi Transaksi</h5>
        </div>
        <div class="card-body">
            <p>Total Penjualan: Rp. {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
            <p>Total Pembelian: Rp. {{ number_format($totalPembelian, 0, ',', '.') }}</p>
            <p>Total Pengeluaran: Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            <p>Pendapatan: Rp. {{ number_format($pendapatan, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="table-responsive text-nowrap">
        <div class="card-header">
            <h5>Detail Penjualan</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Diskon</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualan as $item)
                        <tr>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $item->diskon }}%</td>
                            <td>Rp. {{ number_format($item->bayar, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Detail Pembelian</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembelian as $item)
                        <tr>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mb-4">
        <div class="table-responsive text-nowrap">
        <div class="card-header">
            <h5>Detail Pengeluaran</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengeluaran as $item)
                        <tr>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                            <td>Rp. {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td>{{ $item->deskripsi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

<x-footer></x-footer>