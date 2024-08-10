<!-- resources/views/categories/create.blade.php -->

@extends('kerangka.master')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Tambah Kategori</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="name">Nama Kategori</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
