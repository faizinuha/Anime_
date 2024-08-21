@extends('kerangka.master')

@section('title', 'Edit Anime')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Edit Anime</h4>

        <div class="card">
            <div class="card-body">
                
                {{-- @dd($anime) --}}
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
                        <input type="text" id="release_date" name="release_date" class="form-control datepicker"
                            value="{{ old('release_date', \Carbon\Carbon::parse($anime->release_date)->format('d-m-Y')) }}"
                            required>
                    </div>

                    <!-- Gambar Anime -->
                    <div class="form-group mb-3">
                        <label for="image">Gambar Anime</label>
                        <input type="file" id="image" name="image" class="form-control mb-2"
                            onchange="previewImage(event)">
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
                    <div class="form-group mb-3">
                        <label for="Tayang_id">Tayang Hari</label>
                        <select name="Tayang_id" id="Tayang_id" class="form-control" required>
                            @foreach ($tayangHaris  as $tayangHaris )
                            <option value="">-- Pilih Hari --</option>
                                <option value="{{$tayangHaris->id}}"> {{$tayangHaris->nama}} </option>
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
                            <option value="Movie" {{ old('type', $anime->type) == 'Movie' ? 'selected' : '' }}>Movie
                            </option>
                            <option value="OVA" {{ old('type', $anime->type) == 'OVA' ? 'selected' : '' }}>OVA</option>
                            <option value="ONA" {{ old('type', $anime->type) == 'ONA' ? 'selected' : '' }}>ONA</option>
                            <option value="Special" {{ old('type', $anime->type) == 'Special' ? 'selected' : '' }}>Special
                            </option>
                        </select>
                    </div>


                    <!-- Durasi -->
                    <div class="form-group mb-3">
                        <label for="duration">Durasi (menit)</label>
                        <input type="number" id="duration" name="duration" class="form-control"
                            value="{{ old('duration', $anime->duration) }}">
                    </div>

                    <!-- Sinonim -->
                    <div class="form-group mb-3">
                        <label for="synonyms">Sinonim</label>
                        <input type="text" id="synonyms" name="synonyms" class="form-control"
                            value="{{ old('synonyms', $anime->synonyms) }}">
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">

    <script>
        // Datepicker initialization
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });

        // Preview Image Function
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-image');
                output.src = reader.result;
                output.style.display = 'block'; // Show the image
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
