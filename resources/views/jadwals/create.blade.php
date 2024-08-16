@extends('kerangka.master')

@section('content')
    <h1>{{ isset($jadwal) ? 'Edit Jadwal' : 'Buat Jadwal Baru' }}</h1>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Tambah Anime</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ isset($jadwal) ? route('jadwals.update', $jadwal->id) : route('jadwals.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($jadwal))
                        @method('PUT')
                    @endif

                    <div class="form-group mb-4">
                        <label for="anime_id">Anime:</label>
                        <select name="anime_id" id="anime_id">
                            @foreach ($animes as $anime)
                                <option value="{{ $anime->id }}"
                                    {{ isset($jadwal) && $jadwal->anime_id == $anime->id ? 'selected' : '' }}>
                                    {{ $anime->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form group mb-3">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" name="tanggal" id="tanggal"
                            value="{{ isset($jadwal) ? $jadwal->tanggal : old('tanggal') }}" class="form-control">
                    </div>
                    <div class="form group mb-3">
                        <label for="waktu">Waktu:</label>
                        <input type="text" name="waktu" id="waktu"
                            value="{{ isset($jadwal) ? $jadwal->waktu : old('waktu') }}"  class="">
                    </div>

                    <div class="form group mb-3">
                        <label for="keterangan">Keterangan:</label>
                        <textarea name="keterangan" id="keterangan">{{ isset($jadwal) ? $jadwal->keterangan : old('keterangan') }} class=""</textarea>
                    </div>

                    <button type="submit">{{ isset($jadwal) ? 'Update' : 'Simpan' }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
