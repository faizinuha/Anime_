@extends('kerangka.master')

@section('title', 'Edit Anime')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Edit Anime</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('animes.update', $anime->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Anime -->
                <div class="form-group mb-3">
                    <label for="name">Nama Anime</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $anime->name }}" required>
                </div>

                <!-- Tanggal Rilis -->
                <div class="form-group mb-3">
                    <label for="release_date">Tanggal Rilis</label>
                    <input type="text" id="release_date" name="release_date" class="form-control datepicker" value="{{ \Carbon\Carbon::parse($anime->release_date)->format('d-m-Y') }}" required>
                </div>

                <!-- Gambar Anime -->
                <div class="form-group mb-3">
                    <label for="image">Gambar Anime</label>
                    <input type="file" id="image" name="image" class="form-control mb-2" onchange="previewImage(event)">
                    @if($anime->image)
                        <img id="preview-image" src="{{ asset('storage/' . $anime->image) }}" alt="Gambar Anime" class="img-thumbnail" width="200">
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
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $anime->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">

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
        reader.onload = function(){
            var output = document.getElementById('preview-image');
            output.src = reader.result;
            output.style.display = 'block'; // Show the image
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
