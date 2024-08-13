@extends('kerangka.master')
@section('title', 'Daftar Anime')
@section('content')
@extends('layouts.app')

@section('content')
<h1>Daftar Jadwal</h1>
<a href="{{ route('jadwals.create') }}">Buat Jadwal Baru</a>

<table>
    <thead>
        <tr>
            <th>Anime</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jadwals as $jadwal)
        <tr>
            <td>{{ $jadwal->anime->name }}</td>
            <td>{{ $jadwal->tanggal }}</td>
            <td>{{ $jadwal->waktu }}</td>
            <td>{{ $jadwal->keterangan }}</td>
            <td>
                <a href="{{ route('jadwals.edit', $jadwal->id) }}">Edit</a>
                <form action="{{ route('jadwals.destroy', $jadwal->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
  
@endsection