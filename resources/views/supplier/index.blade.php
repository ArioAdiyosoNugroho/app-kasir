<x-header>
    Supplier
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
                                <h5 class="card-title text-primary">Supplier</h5>
                                <p class="mb-4">
                                    You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                                    your profile.
                                </p>

                                <a href="{{ route('addsupplier') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bx bx-plus"></i> Tambah Supplier
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
        <h4 class="fw-bold py-2 mb-4"><span class="text-muted fw-light">Data/</span> Supplier</h4>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="m-0">Supplier</h5>
                <form action="{{ url('supplier') }}">
                    <div class="input-group" style="max-width: 300px;">
                        <span class="input-group-text bg-light border-light rounded-start-pill">
                            <i class='bx bx-search'></i>
                        </span>
                        <input type="text" name="katakunci" id="katakunci" class="form-control border-light rounded-end-pill" placeholder="Cari supplier..." value="{{ request::get('katakunci') }}" onkeyup="searchTable()" style="box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.05);">
                    </div>
                </form>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Supplier</th>
                            <th class="text-center">No Telephone</th>
                            <th class="text-center">Alamat</th>
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
                            <td class="align-middle text-center">{{ $item->nama }}</td>
                            <td class="align-middle text-center">{{ $item->telepon }}</td>
                            <td class="align-middle text-center">{{ $item->alamat }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('supplier.edit', $item->id_supplier) }}">
                                    <button type="button" class="btn btn-sm btn-primary rounded-pill">Edit</button>
                                </a>
                                <form onsubmit="return confirm('Yakin ingin menghapus supplier?')" class="d-inline" action="{{ route('supplier.destroy', $item->id_supplier) }}" method="POST">
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