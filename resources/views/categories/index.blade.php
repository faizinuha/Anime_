<!-- resources/views/categories/index.blade.php -->

@extends('kerangka.master')

@section('title', 'Daftar Kategori')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Daftar Kategori</h4>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="badge badge-success text-success" >{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
