<!-- resources/views/categories/edit.blade.php -->

@extends('kerangka.master')

@section('title', 'Edit Kategori')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Kategori</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('Tayanghari.update', $tayangHari->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $tayangHari->nama) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
