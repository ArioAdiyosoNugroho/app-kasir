@if (Session::has('success'))
<div class="alert alert-primary alert-dismissible" role="alert">
  <div class="d-flex align-items-center" >
    <i class='bx bx-check-circle' style="font-size: 1.5rem;"></i>
      <ul class="mb-0">
        {{ Session::get('success') }}
      </ul>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if($errors->any())
    <div class="alert alert-primary alert-dismissible" role="alert">
        <div class="d-flex align-items-center">
            <i class="bx bxs-info-circle me-2" style="font-size: 1.5rem;"></i>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif