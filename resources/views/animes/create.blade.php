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
                        <label for="release_date">Di Publish Tanggal:</label>
                        <input type="date" id="release_date" name="release_date" class="form-control"
                            value="{{ old('release_date') }}" required>
                    </div>
                    {{-- <div class="form-group mb-3">
                        <label for="Tayang_Hari">tayang Hari:</label>
                        <input type="text" id="Tayang_Hari" name="Tayang_Hari" class="form-control"
                            value="{{ old('Tayang_Hari') }}" required>
                    </div> --}}

                    <div class="form-group mb-3">
                        <label for="category_id">Kategori Anime</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="Tayang_id">Tayang Hari</label>
                        <select name="Tayang_id" id="Tayang_id" class="form-control" required>
                            <option value="">-- Pilih Hari --</option>
                            @foreach ($tayangHaris  as $tayangHaris )
                                <option value="{{$tayangHaris->id}}"> {{$tayangHaris->nama}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Gambar Anime</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="video">Video Anime (optional)</label>
                        <input type="file" id="video" name="video" class="form-control" accept="video/*">
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                            <option value="Upcoming">Upcoming</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="type">Tipe</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="TV">TV</option>
                            <option value="Movie">Movie</option>
                            <option value="OVA">OVA</option>
                            <option value="ONA">ONA</option>
                            <option value="Special">Special</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="studio">Studio</label>
                        <input type="text" id="studio" name="studio" class="form-control"
                            value="{{ old('studio') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="episodes">Jumlah Episode</label>
                        <input type="number" id="episodes" name="episodes" class="form-control"
                            value="{{ old('episodes') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="trailer">Trailer</label>
                        <input type="text" id="trailer" name="trailer" class="form-control"
                            value="{{ old('trailer') }}">
                    </div>




                    <div class="form-group mb-3">
                        <label for="duration">Durasi (menit)</label>
                        <input type="number" id="duration" name="duration" class="form-control"
                            value="{{ old('duration') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="synonyms">Sinonim</label>
                        <input type="text" id="synonyms" name="synonyms" class="form-control"
                            value="{{ old('synonyms') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
