<div class="modal" tabindex="-1" id="modal-form">
    <div class="modal-dialog">
      
        <form action="{{ url('kategori') }}" method="POST" class="form-horizontal">
            @csrf
            {{-- @method('post') --}}
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Kategori Produk</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="form-groub row">
                    <label for="nama_kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required autofocus>
                      <span class="help-block with-error"></span>
                    </div>
  

                  </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
              </div>
        </form>
    </div>
  </div>