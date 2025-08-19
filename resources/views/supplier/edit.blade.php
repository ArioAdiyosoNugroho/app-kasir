<x-header> Edit supplier</x-header>
<x-sidebar></x-sidebar>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit</span> supplier</h4>
    @include('kategori.notifikasi')

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit</h5>
            <small class="text-muted float-end">Edit supplier</small>
          </div>
          <div class="card-body">
            <form action="{{ url('supplier/'.$supplier->id_supplier) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">nama supplier</label>
                <div class="col-sm-10">
                  <input 
                  type="text" 
                  class="form-control" 
                  id="nama" 
                  name="nama"
                  value="{{ $supplier->nama }}"
                  placeholder="nama supplier..." />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Telepon</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control"
                    id="telepon"
                    name="telepon"
                    value="{{ $supplier->telepon }}"
                    placeholder="Telepon..."
                  />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">alamat</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control"
                    id="alamat"
                    name="alamat"
                    value="{{ $supplier->alamat }}"
                    placeholder=" alamat..."
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