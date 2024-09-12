@extends('kerangka.master')

@section('content')
    <div class="container">
        <h1>Create Episode</h1>

        <!-- Tampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulir untuk membuat episode -->
        <form action="{{ route('episodes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="video" class="form-label">Video URL</label>
                <input type="file" class="form-control" id="video" name="video" required>
            </div>

            <div class="mb-3">
                <label for="episode" class="form-label">Episode</label>
                <input type="text" class="form-control" id="episode" name="episode" required>
            </div>

            <div class="mb-3">
                <label for="anime_id" class="form-label">Anime</label>
                <select class="form-select" id="anime_id" name="anime_id" required >
                    <option value="">Select Anime</option>
                    @foreach($animes as $anime)
                        <option   value="{{ old('anime_id',$anime->id) }}">{{ $anime->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Episode</button>
        </form>
    </div>
@endsection
