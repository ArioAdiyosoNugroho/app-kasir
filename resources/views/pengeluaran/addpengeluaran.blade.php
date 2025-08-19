<x-header> Tambah Produk</x-header>
<x-sidebar></x-sidebar>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah</span> pengeluaran</h4>
    @include('kategori.notifikasi')

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah</h5>
            <small class="text-muted float-end">Tambahkan pengeluaran</small>
          </div>
          <div class="card-body">
            <form action="{{ url('pengeluaran') }}" method="POST">
              @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Deskripsi</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control"
                    id="deskripsi"
                    name="deskripsi"
                    placeholder="deskripsi..."
                  />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Nominal</label>
                <div class="col-sm-10">
                  <input
                    type="number"
                    class="form-control"
                    id="nominal"
                    name="nominal"
                    placeholder="nominal..."
                  />
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- ======= --}}
    </div>
  </div>

  <!-- / Content -->
  <x-footer></x-footer>

  <script>
          
    function shownotif(url) {
      $('#notifikasi').modal('show'); // Menampilkan modal
    }
  </script>