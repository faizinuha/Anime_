@extends('kerangka.master')
@section('title', 'Edit User')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Edit User</h4>

  <div class="card">
      <div class="card-body">
          <form action="{{ route('table.update', $user->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-3">
                  <label for="name" class="form-label">Nama</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
          </form>
      </div>
  </div>
</div>
@endsection
