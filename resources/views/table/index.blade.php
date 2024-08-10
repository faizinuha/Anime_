@extends('kerangka.master')
@section('title')
@section('content')
<style>/* Button styling */
  .btn-primary, .btn-warning, .btn-danger {
      padding: 0.375rem 1.5rem;
      font-size: 1rem;
  }
  
  .btn-warning {
      background-color: #ffc107;
      border-color: #ffc107;
  }
  
  .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
  }
  
  /* Table adjustments */
  .table th, .table td {
      vertical-align: middle;
      text-align: center;
  }
  
  .table img {
      max-width: 50px;
      height: auto;
      border-radius: 5px;
  }
  
  .card-header {
      background-color: #f8f9fa;
      padding: 1rem;
  }
  
  .card-header .btn-primary {
      margin-bottom: 0;
  }
  
  .table-responsive {
      padding: 1rem;
  }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Tables /</span> Daftar Anime
</h4>

    <!-- Basic Bootstrap Table -->
    @php
        $no = 1;
    @endphp
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="#" class="btn btn-primary rounded-pill">Tambah data</a>
        </div>   
        <div class="table-responsive text-nowrap">
        <table id="example" class="table tabel-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>nama</th>
              <th>email</th>
              <th>users</th>
              <th>status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($user as $item)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $item->is_admin ? 'Admin' : 'Member' }}</td>
                  <td>{{ $item->email }}</td>
                  <td>
                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                      @if ($item->is_admin)
                      <li
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up"
                      title="{{ $item->name }}"
                     > <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar" class="rounded-circle" />
                    </li>
                      @else
                      <li
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up"
                      title="{{ $item->name }}"
                    >
                      <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar" class="rounded-circle" />
                    </li>
                      @endif
                    </ul>
                  </td>
                  <td><span class="{{ $item->is_admin ? 'badge bg-label-primary me-1' : 'badge bg-label-success me-1'}}">Active</span></td>
                  <td class="w-1">
                    @if ($item->is_admin)
                    <button class="btn btn-warning w-10 h-10">edit</button>
                    @else
                    <button class="btn btn-warning w-10 h-10">edit</button>
                    <button class="btn btn-danger ">hapus</button>
                    @endif
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <hr class="my-5" />
    
  </div>
@endsection