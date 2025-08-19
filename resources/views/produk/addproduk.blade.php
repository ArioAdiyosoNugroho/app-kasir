<x-header> Tambah Produk</x-header>
<x-sidebar></x-sidebar>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah</span> Produk</h4>
    @include('kategori.notifikasi')

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah</h5>
            <small class="text-muted float-end">Default label</small>
          </div>
          <div class="card-body">
            <form action="{{ url('produk') }}" method="POST">
              @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Produk</label>
                <div class="col-sm-10">
                  <input 
                  type="text" 
                  class="form-control" 
                  id="kode_produk" 
                  name="kode_produk"
                  placeholder="Kode Produk..." />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Nama Produk</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control"
                    id="nama_produk"
                    name="nama_produk"
                    placeholder="Nama Produk..."
                  />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Merk</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control"
                    id="merk"
                    name="merk"
                    placeholder="Nama Merk..."
                  />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-kategori">Kategori</label>
                <div class="col-sm-10">
                  <select class="form-select" name="id_kategori" id="id_kategori">
                    <option selected>Pilih Kategori</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
                </div>
              </div>
              
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Harga Beli</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control"
                    id="harga_beli"
                    name="harga_beli"
                    placeholder="Harga Beli Produk..."
                  />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Harga Jual</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control"
                    id="harga_jual"
                    name="harga_jual"
                    placeholder="Harga Jual Produk..."
                  />
                </div>
              </div>
              {{-- <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Diskon</label>
                <div class="col-sm-10">
                  <input
                    type="text"
                    class="form-control"
                    id="diskon"
                    name="diskon"
                    placeholder="Tambah Diskon(Opsional)..."
                  />
                </div>
              </div> --}}
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Stok</label>
                <div class="col-sm-10">
                  <input
                    type="number"
                    class="form-control"
                    id="stok"
                    name="stok"
                    placeholder="Tambah Stok..."
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