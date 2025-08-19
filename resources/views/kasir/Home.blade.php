    <x-header>
        Dashboard
    </x-header>
        <!-- Menu -->

        <x-sidebar>
            
        </x-sidebar>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                          <p class="mb-4">
                            You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                            your profile.
                          </p>

                          <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="{{ asset('sneat/assets/img/illustrations/man-with-laptop-light.png') }}"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="{{ asset('sneat/assets/img/icons/unicons/chart-success.png') }}"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>

{{-- ======================================bagian profit=======================================--}}
                          <span class="fw-semibold d-block mb-1">Profit</span>
                          <h3 class="card-title mb-2">{{ formatRupiah($pendapatan, 0, ',', '.') }}</h3>
                          {{-- <h3 class="card-title mb-2">$12,628</h3> --}}
                          {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="{{ asset('sneat/assets/img/icons/unicons/wallet-info.png') }}"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>
                          {{-- ==== bagian penjualan=== --}}
                          <span>Total penjualan</span>
                          <h3 class="card-title text-nowrap mb-1">{{ formatRupiah($totalPenjualan, 0, ',', '.') }}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Total Revenue -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
              <div class="card">
                  <div class="row row-bordered g-0">
                      <div class="col-md-8">
                          <h5 class="card-header m-0 me-2 pb-3">
                            Riwayat Transaksi
                          </h5>
                          <div class="px-2">
                            <div class="card">
                              {{-- <h5 class="card-header">Table Basic</h5> --}}
                              <div class="table-responsive text-nowrap">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>Tanggal</th>
                                      <th>transaksi</th>
                                      <th>Nominal</th>
                                      <th>Kasir</th>
                                    </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="card-body">
                              <div class="text-center">
                              </div>
                          </div>
                          <div class="p-10">
                            <img src="{{ asset('sneat/assets/img/illustrations/girl-doing-yoga-light.png') }}" alt="" class="img-fluid" style="width: 250px; height: 200px;">
                          </div>                        

                          <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                              <div class="d-flex">
                                  <div class="me-2">
                                      <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                                  </div>
                                  <div class="d-flex flex-column">
                                      <small>Sell</small>
                                      <h6 class="mb-0">{{ formatRupiah($totalPenjualan) }}</h6>
                                  </div>
                              </div>
                              <div class="d-flex">
                                  <div class="me-2">
                                      <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                                  </div>
                                  <div class="d-flex flex-column">
                                      <small>Buy</small>
                                      <h6 class="mb-0">{{ formatRupiah($totalPembelian) }}</h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="{{ asset('sneat/assets/img/icons/unicons/paypal.png')}}" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt4"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>
                          {{-- =======total pembelian==== --}}
                          <span class="d-block mb-1">Pembelian</span>
                          <h3 class="card-title text-nowrap mb-2">{{ formatRupiah($totalPembelian, 0, ',', '.') }}</h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="{{ asset('sneat/assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt1"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Pengeluaran</span>
                          <h3 class="card-title mb-2">{{ formatRupiah($totalPengeluaran, 0, ',', '.') }}</h3>
                        </div>
                      </div>
                    </div>
                    {{-- beda lagi nih wak============== --}}
                    <div class="col-12 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                              <div class="card-title">
                                <h5 class="text-nowrap mb-2">Profile Report</h5>
                                <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                              </div>
                              <div class="mt-sm-auto">
                                <small class="text-success text-nowrap fw-semibold"
                                  ><i class="bx bx-chevron-up"></i> 68.2%</small
                                >
                                <h3 class="mb-0">$84,686k</h3>
                              </div>
                            </div>
                            <div id="profileReportChart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->


                            
            <x-footer></x-footer>
            @php
            function formatRupiah($number)
            {
                if ($number >= 1000000000) {
                    return number_format($number / 1000000000, 1) . 'M';
                } elseif ($number >= 1000000) {
                    return number_format($number / 1000000, 1) . 'Jt';
                } elseif ($number >= 1000) {
                    return number_format($number / 1000, 1) . 'Rb';
                }
            
                return number_format($number, 0, ',', '.');
            }
            @endphp

            