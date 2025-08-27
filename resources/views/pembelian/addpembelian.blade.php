<!-- filepath: /d:/laragon/www/appkasir/resources/views/pembelian/addpembelian.blade.php -->
<x-header> Tambah Produk</x-header>
<x-sidebar></x-sidebar>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah</span> pembelian</h4>
    @include('kategori.notifikasi')

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah</h5>
            <small class="text-muted float-end">Tambahkan pembelian</small>
          </div>
          <div class="card-body">
            <form action="{{ route('pembelian.store') }}" method="POST">
              @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Suplier</label>
                <div class="col-sm-10">
                  <select class="form-select" name="id_supplier" id="id_supplier">
                    <option selected>Pilih Suplier</option>
                    @foreach ($supliers as $item)
                        <option value="{{ $item->id_supplier }}">{{ $item->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Produk</label>
                <div class="col-sm-10">
                  <select class="form-select" name="produk[0][kode_produk]" id="id_produk">
                    <option selected>Pilih Produk</option>
                    @foreach ($produk as $item)
                        <option value="{{ $item->kode_produk }}">{{ $item->nama_produk }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">Jumlah</label>
                <div class="col-sm-10">
                  <input
                    type="number"
                    class="form-control"
                    id="jumlah"
                    name="produk[0][jumlah]"
                    placeholder="Jumlah..."
                  />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">bayar</label>
                <div class="col-sm-10">
                  <input
                    type="number"
                    class="form-control"
                    id="bayar"
                    name="bayar"
                    placeholder="bayar..."
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
