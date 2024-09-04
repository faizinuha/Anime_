<!-- resources/views/episode/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Episode</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('episodes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf



        <div class="form-group">
            <label for="episode">Episode:</label>
            <input type="text" name="episode" id="episode" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="video">Video:</label>
            <input type="file" name="video" id="video" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Episode</button>
    </form>

    <br>

    <!-- Form untuk menyimpan dan langsung membuat episode baru -->
    <form action="{{ route('episodes.storeAndCreate') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="anime_id" value="{{ old('anime_id') ?? $animes->first()->id }}">
        <input type="hidden" name="episode" value="{{ old('episode') }}">
        <input type="hidden" name="video" value="{{ old('video') }}">

        <button type="submit" class="btn btn-secondary">Save and Create Another</button>
    </form>

</div>
@endsection
