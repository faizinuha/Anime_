@extends('kerangka.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }} 🎉</h5>
                                <p class="mb-4">
                                    selamat bekerja <span class="fw-bold"></span> nikmati harimu dengan lebih baik
                                </p>
                                <a href="javascript:;" id="data" class="btn btn-sm btn-outline-primary">lihat data</a>
                            </div>
                        </div>
                        <script>
                            document.getElementById('data').addEventListener('click', function(event) {
                                event.preventDefault();
                                window.location.href = "{{ route('home.Dates') }}";
                            });
                        </script>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png ') }}"
                                    height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
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
                                <div class="card-title d-flex align-items-center justify-content-center">
                                    <div class="avatar flex-shrink-0 ">
                                        <img src="{{ asset('/assets/img/icons/unicons/chart-success.png') }}"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1 text-center">Data User</span>
                                <h3 class="card-title mb-2">
                                    <div class="fs-5 text-primary text-center">{{ $user == 0 ? 'data kosong' : $user }}
                                    </div>
                                </h3>
                                <small class="text-success fw-semibold d-flex justify-content-center "><i
                                        class="bx bx-up-arrow-alt "></i> Data</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('/assets/img/icons/unicons/wallet-info.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span>data produk</span>
                                <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Revenue -->
            <div class="col-12 col-lg-7 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-lg-12 ">
                            <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                            <div id="totalRevenueChart" class="px-2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-4 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-lg-12 ">
                            <h5 class="card-header m-0 me-2 pb-3">Kalender</h5>
                            <div class="card-body ">
                                <div class="today ">
                                    <div class="fs-5 mb-5 text-center bg-primary text-white today-piece  top  day"></div>
                                    <div class="fs-3 text-center today-piece  middle  month"></div>
                                    <div class="fs-3 mb-5 text-center today-piece  middle  date"></div>
                                    <div class="fs-5 bg-primary text-white text-center today-piece  bottom  year"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Total Revenue -->
                
            </div>

        </div>
    </div>
@endsection
