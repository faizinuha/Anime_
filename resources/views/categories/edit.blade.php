<!-- resources/views/categories/edit.blade.php -->

@extends('kerangka.master')

@section('title', 'Edit Kategori')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Kategori</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Nama Kategori</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
