@extends('kerangka.master')

@section('content')
<div class="container">
    <h1>Create Episode</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('episodes.createEps') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="anime_id">Anime:</label>
            <select name="anime_id" id="anime_id" class="form-control" required>
                @foreach($animes as $anime)
                    <option value="{{ $anime->id }}">{{ $anime->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="episode">Episode:</label>
            <input type="text" name="episode" id="episode" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="video">Video:</label>
            <input type="file" name="video" id="video" class="form-control" required>
        </div>

        <br>
        <button type="submit" class="btn btn-secondary">Save</button>
    </form>
</div>
@endsection
