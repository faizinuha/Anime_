@extends('kerangka.master')
@section('title', 'Tambah User')
@section('content')
@if ($errors->has('name'))
<div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">Anime</div>
        <small></small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
       {{ $errors->first('name') }}
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl, {
                delay: 3000
            });
        });
        toastList.forEach(toast => toast.show());
    });
</script>
@endif
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Tambah User</h4>

  <div class="card">
      <div class="card-body">
          <form action="{{ route('table.store') }}" method="POST">
              @csrf
              
              <div class="mb-3">
                  <label for="role" class="form-label">Role</label>
                  <select name="role" id="role" class="form-control" required>
                      <option value="" disabled selected>Pilih Role</option>
                      <option value="is_admin">Admin</option>
                      <option value="is_member">Member</option>
                      <option value="is_guest">Guest</option>
                  </select>
              </div>
              <div class="mb-3">
                <label for="status" class="form-label">Status Member</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="FrontEnd">FrontEnd</option>
                    <option value="Backend">Backend</option>
                    <option value="Server">Server</option>
                    <option value="UI/UX">UI/UX</option>
                    <option value="Service">Service</option>
                    <option value="Mobile">Mobile</option>
                    <option value="Database">Database</option>
                    <option value="Network">Network</option>
                    <option value="Security">Security</option>
                    <option value="AI">AI</option>
                </select>
            </div>
            
              
              <div class="mb-3">
                  <label for="name" class="form-label">Nama</label>
                  <input type="text" id="name" name="name" class="form-control" required>
              </div>
              
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" id="email" name="email" class="form-control" required>
              </div>
              
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" id="password" name="password" class="form-control" required>
              </div>
              
              <div class="mb-3">
                  <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
              </div>
              
              <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
      </div>
  </div>
</div>
@endsection
