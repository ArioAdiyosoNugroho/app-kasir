<x-header> Edit pengeluaran</x-header>
<x-sidebar></x-sidebar>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit</span> pengeluaran</h4>
    @include('kategori.notifikasi')

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit</h5>
            <small class="text-muted float-end">Edit pengeluaran</small>
          </div>
          <div class="card-body">
            <form action="{{ url('pengeluaran/'.$pengeluaran->id_pengeluaran) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">deskripsi</label>
                <div class="col-sm-10">
                  <input 
                  type="text" 
                  class="form-control" 
                  id="deskripsi" 
                  name="deskripsi"
                  value="{{ $pengeluaran->deskripsi }}"
                  placeholder="deskripsi pengeluaran..." />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">nominal</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control"
                    id="nominal"
                    name="nominal"
                    value="{{ $pengeluaran->nominal }}"
                    placeholder="nominal..."
                  />
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Update</button>
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