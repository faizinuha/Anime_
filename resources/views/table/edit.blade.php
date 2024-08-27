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
                  <label for="role" class="form-label">Role</label>
                  <select name="role" id="role" class="form-control" required>
                      <option value="" disabled>Pilih Role</option>
                      <option value="is_admin" {{ $user->role == 'is_admin' ? 'selected' : '' }}>Admin</option>
                      <option value="is_member" {{ $user->role == 'is_member' ? 'selected' : '' }}>Member</option>
                      <option value="is_guest" {{ $user->role == 'is_guest' ? 'selected' : '' }}>Guest</option>
                  </select>
              </div>
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="" disabled>Pilih Status Member</option>
                    <option value="FrontEnd" {{ $user->status == 'FrontEnd' ? 'selected' : '' }}>FrontEnd</option>
                    <option value="Backend" {{ $user->status == 'Backend' ? 'selected' : '' }}>Backend</option>
                    <option value="Server" {{ $user->status == 'Server' ? 'selected' : '' }}>Server</option>
                    <option value="UI/UX" {{ $user->status == 'UI/UX' ? 'selected' : '' }}>UI/UX</option>
                    <option value="Service" {{ $user->status == 'Service' ? 'selected' : '' }}>Service</option>
                    <option value="Mobile" {{ $user->status == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                    <option value="Database" {{ $user->status == 'Database' ? 'selected' : '' }}>Database</option>
                    <option value="Network" {{ $user->status == 'Network' ? 'selected' : '' }}>Network</option>
                    <option value="Security" {{ $user->status == 'Security' ? 'selected' : '' }}>Security</option>
                    <option value="AI" {{ $user->status == 'AI' ? 'selected' : '' }}>AI</option>
                </select>
            </div>
              <div class="mb-3">
                  <label for="name" class="form-label">Nama</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
              </div>
              
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
              </div>

              <div class="mb-3">
                  <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                  <input type="password" id="password" name="password" class="form-control">
              </div>
              
              <div class="mb-3">
                  <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
              </div>
              
              <button type="submit" class="btn btn-primary">Update</button>
          </form>
      </div>
  </div>
</div>
@endsection
