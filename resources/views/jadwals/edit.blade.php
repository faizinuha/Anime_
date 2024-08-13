@extends('kerangka.master')

{{-- @section('title', 'Daftar Anime') --}}
@section('content')
@extends('layouts.app')

@section('content')
<h1>Edit Jadwal</h1>

<form action="{{ route('jadwals.update', $jadwal->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="anime_id">Anime:</label>
    <select name="anime_id" id="anime_id">
        @foreach($animes as $anime)
            <option value="{{ $anime->id }}" {{ $jadwal->anime_id == $anime->id ? 'selected' : '' }}>
                {{ $anime->name }}
            </option>
        @endforeach
    </select>

    <label for="tanggal">Tanggal:</label>
    <input type="date" name="tanggal" id="tanggal" value="{{ $jadwal->tanggal }}">

    <label for="waktu">Waktu:</label>
    <input type="text" name="waktu" id="waktu" value="{{ $jadwal->waktu }}">

    <label for="keterangan">Keterangan:</label>
    <textarea name="keterangan" id="keterangan">{{ $jadwal->keterangan }}</textarea>

    <button type="submit">Update</button>
</form>
@endsection

@endsection
