@extends('layouts.app')

@section('content')
<h1>{{ isset($jadwal) ? 'Edit Jadwal' : 'Buat Jadwal Baru' }}</h1>

<form action="{{ isset($jadwal) ? route('jadwals.update', $jadwal->id) : route('jadwals.store') }}" method="POST">
    @csrf
    @if(isset($jadwal))
        @method('PUT')
    @endif

    <label for="anime_id">Anime:</label>
    <select name="anime_id" id="anime_id">
        @foreach($animes as $anime)
            <option value="{{ $anime->id }}" {{ isset($jadwal) && $jadwal->anime_id == $anime->id ? 'selected' : '' }}>
                {{ $anime->name }}
            </option>
        @endforeach
    </select>

    <label for="tanggal">Tanggal:</label>
    <input type="date" name="tanggal" id="tanggal" value="{{ isset($jadwal) ? $jadwal->tanggal : old('tanggal') }}">

    <label for="waktu">Waktu:</label>
    <input type="text" name="waktu" id="waktu" value="{{ isset($jadwal) ? $jadwal->waktu : old('waktu') }}">

    <label for="keterangan">Keterangan:</label>
    <textarea name="keterangan" id="keterangan">{{ isset($jadwal) ? $jadwal->keterangan : old('keterangan') }}</textarea>

    <button type="submit">{{ isset($jadwal) ? 'Update' : 'Simpan' }}</button>
</form>
@endsection
