@extends('kerangka.master')

@section('title', 'Edit Anime')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Edit Anime</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('anime.update', $anime->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Anime -->
                    <div class="form-group mb-3">
                        <label for="name">Nama Anime</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name', $anime->name) }}" required>
                    </div>

                    <!-- Tanggal Rilis -->
                    <div class="form-group mb-3">
                        <label for="release_date">Tanggal Rilis</label>
                        <input type="date" id="release_date" name="release_date" class="form-control"
                            value="{{ old('release_date', $anime->release_date ? \Carbon\Carbon::parse($anime->release_date)->format('Y-m-d') : '') }}"
                            required>
                    </div>                    

                    <!-- Gambar Anime -->
                    <div class="form-group mb-3">
                        <label for="image">Gambar Anime</label>
                        <input type="file" id="image" name="image" class="form-control mb-2"
                            accept="image/*,.webp" onchange="previewImage(event)">
                        @if ($anime->image)
                            <img id="preview-image" src="{{ asset('storage/' . $anime->image) }}" alt="Gambar Anime"
                                class="img-thumbnail" width="200">
                        @else
                            <img id="preview-image" class="img-thumbnail" width="200" style="display: none;">
                        @endif
                    </div>

                    <!-- Video Anime -->
                    <div class="form-group mb-3">
                        <label for="video">Video Anime (optional)</label>
                        <input type="file" name="video" class="form-control" accept="video/*">
                    </div>

                    <!-- Kategori -->
                    <div class="form-group mb-3">
                        <label for="category_id">Kategori</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $anime->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control">{{ old('description', $anime->description) }}</textarea>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="Ongoing" {{ old('status', $anime->status) == 'Ongoing' ? 'selected' : '' }}>
                                Ongoing</option>
                            <option value="Completed" {{ old('status', $anime->status) == 'Completed' ? 'selected' : '' }}>
                                Completed</option>
                            <option value="Upcoming" {{ old('status', $anime->status) == 'Upcoming' ? 'selected' : '' }}>
                                Upcoming</option>
                        </select>
                    </div>

                    <!-- Studio -->
                    <div class="form-group mb-3">
                        <label for="studio">Studio</label>
                        <input type="text" id="studio" name="studio" class="form-control"
                            value="{{ old('studio', $anime->studio) }}">
                    </div>

                    <!-- Jumlah Episode -->
                    <div class="form-group mb-3">
                        <label for="episodes">Jumlah Episode</label>
                        <input type="number" id="episodes" name="episodes" class="form-control"
                            value="{{ old('episodes', $anime->episodes) }}">
                    </div>

                    <!-- Trailer -->
                    <div class="form-group mb-3">
                        <label for="trailer">Trailer</label>
                        <input type="text" id="trailer" name="trailer" class="form-control"
                            value="{{ old('trailer', $anime->trailer) }}">
                    </div>

                    <!-- Tipe -->
                    <div class="form-group mb-3">
                        <label for="type">Tipe</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="TV" {{ old('type', $anime->type) == 'TV' ? 'selected' : '' }}>TV</option>
                            <option value="Movie" {{ old('type', $anime->type) == 'Movie' ? 'selected' : '' }}>Movie</option>
                            <option value="OVA" {{ old('type', $anime->type) == 'OVA' ? 'selected' : '' }}>OVA</option>
                        </select>
                    </div>

                    <!-- Popularitas -->
                    <div class="form-group mb-3">
                        <label for="popularity">Popularitas</label>
                        <input type="number" id="popularity" name="popularity" class="form-control"
                            value="{{ old('popularity', $anime->popularity) }}">
                    </div>

                    <!-- Tanggal Tayang -->
                    <div class="form-group mb-3">
                        <label for="aired_from">Tanggal Tayang</label>
                        <input type="text" id="aired_from" name="aired_from" class="form-control datepicker"
                            value="{{ old('aired_from', \Carbon\Carbon::parse($anime->aired_from)->format('d-m-Y')) }}"
                            required>
                        <input type="text" id="aired_to" name="aired_to" class="form-control datepicker mt-2"
                            value="{{ old('aired_to', \Carbon\Carbon::parse($anime->aired_to)->format('d-m-Y')) }}">
                    </div>

                    <!-- Durasi -->
                    <div class="form-group mb-3">
                        <label for="duration">Durasi</label>
                        <input type="text" id="duration" name="duration" class="form-control"
                            value="{{ old('duration', $anime->duration) }}">
                    </div>

                    <!-- Sinonyms -->
                    <div class="form-group mb-3">
                        <label for="synonyms">Sinonyms</label>
                        <input type="text" id="synonyms" name="synonyms" class="form-control"
                            value="{{ old('synonyms', $anime->synonyms) }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Anime</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview-image');
            preview.style.display = 'block';
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
