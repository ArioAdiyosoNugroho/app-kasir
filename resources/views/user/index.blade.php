<x-header>Data User</x-header>
<x-sidebar></x-sidebar>

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
                                <h5 class="card-title text-primary">User</h5>
                                <p class="mb-4">
                                    Data dari seluruh <span class="fw-bold">user</span> yang ada, anda bisa menambahkan user sebagai admin atau kasir.
                                </p>

                                <a href="{{ route('user.create') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bx bx-plus"></i> Tambah user
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
        <h4 class="fw-bold py-2 mb-4"><span class="text-muted fw-light">Data/</span> user</h4>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="m-0">user</h5>
                <form action="{{ url('user') }}">
                    <div class="input-group" style="max-width: 300px;">
                        <span class="input-group-text bg-light border-light rounded-start-pill">
                            <i class='bx bx-search'></i>
                        </span>
                        <input type="text" name="katakunci" id="katakunci" class="form-control border-light rounded-end-pill" placeholder="Cari user..." value="{{ request::get('katakunci') }}" onkeyup="searchTable()" style="box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.05);">
                    </div>
                </form>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="text-center align-middle">
                                <i class="fab fa-angular fa-lg text-danger me-2"></i> <strong>{{ $loop->iteration }}</strong>
                            </td>
                            <td class="align-middle text-center">{{ $user->name }}</td>
                            <td class="align-middle text-center">{{ $user->email }}</td>
                            <td class="align-middle text-center">{{ $user->level == 1 ? 'Admin' : 'Kasir' }}</td>
                            <td class="text-center align-middle">
                                <a href="{{ route('user.edit', $user->id) }}">
                                    <button type="button" class="btn btn-sm btn-primary rounded-pill">Edit</button>
                                </a>
                                <form onsubmit="return confirm('Yakin ingin menghapus user?')" class="d-inline" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-sm btn-danger rounded-pill">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
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