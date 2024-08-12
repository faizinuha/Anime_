@extends('kerangka.master')
@section('title','Dates')
@section('content')

<div class="col-sm-7">
  <div class="card-body">
      <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }} 🎉</h5>
      <p class="mb-4">
          Semua data <span class="fw-bold"></span> Anime Category Dll
      </p>
      {{-- <a href="javascript:;" id="data" class="btn btn-sm btn-outline-primary">lihat data</a> --}}
  </div>
</div>

<div class="row g-2"> <!-- Menambahkan gap antar card -->
    <!-- Card untuk Jumlah Anime -->
    <div class="col-sm-6 mb-3 m-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-primary">Total Anime</h5>
                <p class="card-text">{{ $animeCount }} Anime terdaftar</p>
                {{-- <a href="javascript:;" id="anime-data" class="btn btn-sm btn-outline-primary">Lihat Data Anime</a> --}}
            </div>
        </div>
    </div>

    <!-- Card untuk Jumlah User -->
    <div class="col-sm-6 mb-3 m-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-primary">Total User</h5>
                <p class="card-text">{{ $userCount }} User terdaftar</p>
                {{-- <a href="javascript:;" id="user-data" class="btn btn-sm btn-outline-primary">Lihat Data User</a> --}}
            </div>
        </div>
    </div>
</div>

@endsection
