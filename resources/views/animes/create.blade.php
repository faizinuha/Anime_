<!-- resources/views/animes/create.blade.php -->

@extends('kerangka.master')

@section('title', 'Tambah Anime')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Tambah Anime</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('animes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">Nama Anime</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                            required>
                    </div>



                    <div class="form-group mb-3">
                        <label for="release_date">Di Rilis Pada:</label>
                        <input type="date" id="release_date" name="release_date" class="form-control"
                            value="{{ old('release_date') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image">Gambar Anime</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="video">Video Anime (optional)</label>
                        <input type="file" name="video" class="form-control" accept="video/*">
                    </div>
                    <div class="form-group mb-3">
                        <label for="category_id">Kategori Anime</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
