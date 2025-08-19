<x-header>suplier</x-header>
<x-sidebar></x-sidebar>

    <div class="container mt-5">
        <h1 class="mb-4">Pilih Supplier</h1>

        <div class="list-group">
            @foreach($supliers as $suplier)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $suplier->nama }}</span>
                    <form action="{{ route('pembelian.showTransaksi', $suplier->id_supplier) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Pilih</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>


<x-footer></x-footer>
