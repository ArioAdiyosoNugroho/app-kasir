<!-- filepath: /d:/laragon/www/appkasir/resources/views/pembelian/index.blade.php -->
<x-header>
    pembelian
</x-header>
<!-- Menu -->

<x-sidebar>
</x-sidebar>

<style>
    .pagination {
        justify-content: center;
        padding: 20px;
    }

    .text-muted {
        margin-left: 10px;
    }
</style>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <!-- Daftar kategori atau konten lainnya di bawah sini -->

    <div class="container-xxl flex-grow-1 container-pb-0 mt-4">
        @include('kategori.notifikasi')

        <div class="row">
            <div class="col-lg-20 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Pembelian</h5>
                                <p class="mb-4">
                                    You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                                    your profile.
                                </p>

                                <a href="{{ route('pembelian.chooseSuplier') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bx bx-plus"></i> Tambah Pembelian
                                </a>

                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('sneat/assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ======table==== --}}
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-2 mb-4"><span class="text-muted fw-light">Data/</span> pembelian</h4>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="m-0">pembelian</h5>
                <form action="{{ url('pembelian') }}">
                    <div class="input-group" style="max-width: 300px;">
                        <span class="input-group-text bg-light border-light rounded-start-pill">
                            <i class='bx bx-search'></i>
                        </span>
                        <input type="text" name="katakunci" id="katakunci" class="form-control border-light rounded-end-pill" placeholder="Cari pembelian..." value="{{ request::get('katakunci') }}" onkeyup="searchTable()" style="box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.05);">
                    </div>
                </form>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Suplier</th>
                            <th class="text-center">Total Item</th>
                            <th class="text-center">Harga Total</th>
                            <th class="text-center">Diskon</th>
                            <th class="text-center">Total Bayar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstItem() ?>
                        @foreach ($data as $item)
                        <tr>
                            <td class="text-center align-middle">
                                <i class="fab fa-angular fa-lg text-danger me-2"></i> <strong>{{ $loop->iteration }}</strong>
                            </td>

                            <td class="align-middle text-center">{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                            <td class="align-middle text-center">
                                @if($item->suplier) 
                                    {{ $item->suplier->nama }} 
                                @else
                                    <em>Tidak ada supplier</em>
                                @endif
                            </td>
                            <td class="align-middle text-center">{{ $item->total_item }}</td>
                            <td class="align-middle text-center">{{ number_format($item->total_harga) }}</td>
                            <td class="align-middle text-center">{{ $item->diskon }}%</td>
                            <td class="align-middle text-center">{{ number_format($item->bayar) }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('pembelian.show', $item->id_pembelian) }}">
                                    <button type="button" class="btn btn-sm btn-info rounded-pill">Lihat</button>
                                </a>
                                <a href="{{ route('pembelian.edit', $item->id_pembelian) }}">
                                    <button type="button" class="btn btn-sm btn-primary rounded-pill">Edit</button>
                                </a>
                                <form onsubmit="return confirm('Yakin ingin menghapus pembelian?')" class="d-inline" action="{{ route('pembelian.destroy', $item->id_pembelian) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-sm btn-danger rounded-pill">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
        </div>
    </div>
</div>
<!--/ Basic Bootstrap Table -->
<!-- / Content -->

<x-footer></x-footer>

<script>
    function shownotif(url) {
        $('#notifikasi').modal('show'); // Menampilkan modal
    }
</script>