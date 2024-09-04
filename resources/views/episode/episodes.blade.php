@extends('kerangka.master')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Episodes List</h1>

    <!-- Tampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tautan untuk menambahkan episode baru -->
    <a href="{{ route('episodes.create') }}" class="btn btn-primary mb-3">Add New Episode</a>

    <!-- Tabel untuk menampilkan daftar episode -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Video</th>
                    <th>Episode</th>
                    <th>Anime</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($episodes as $episode)
                    <tr>
                        <td>{{ $episode->id }}</td>
                        <td>
                            <div class="media-container">
                                @if ($episode->video)
                                    <video src="{{ asset('storage/' . $episode->video) }}" controls width="200"></video>
                                @else
                                    <span>No Video Available</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ $episode->episode }}</td>
                        <td>{{ $episode->anime->name }}</td>
                        <td>
                            <!-- Tautan untuk edit dan delete -->
                            <a href="#" class="btn btn-warning btn-sm">Tambah Episode</a>
                            <form action="{{ route('episodes.destroy', $episode->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this episode?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tambahkan pagination jika perlu -->
    {{-- {{ $episodes->links() }} --}}
</div>
@endsection
