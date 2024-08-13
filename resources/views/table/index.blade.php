@extends('kerangka.master')

@section('title', 'Daftar Anime')
@if (session('success'))
    <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Anime</div>
            <small></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
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
@section('content')
    <style>
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
            background-color: #28a745;
            color: #fff;
            border-radius: 0.25rem;
        }

        .toast .toast-body {
            padding: 0.75rem;
        }

        .toast .close {
            color: #fff;
            opacity: 0.8;
        }

        /* Button styling */
        .btn-primary,
        .btn-warning,
        .btn-danger {
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
        .table th,
        .table td {
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
                <a href="{{ route('table.create') }}" class="btn btn-primary rounded-pill">Tambah Data</a>
            </div>

            <div class="table-responsive text-nowrap">
                <table id="example" class="table tabel-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Avatar</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                            class="avatar avatar-xs pull-up" title="{{ $item->name }}">
                                            <img src="{{ asset($item->is_admin ? 'assets/img/avatars/5.png' : 'assets/img/avatars/6.png') }}"
                                                alt="Avatar" class="rounded-circle" />
                                        </li>
                                    </ul>
                                </td>
                                <td>{{ $item->role }}</td>
                                <td>
                                    <span
                                        class="{{ $item->is_admin ? 'badge bg-label-primary me-1' : 'badge bg-label-success me-1' }}">
                                        {{ $item->is_admin ? 'Admin' : 'Member' }}
                                    </span>
                                </td>
                                <td class="w-1">
                                    <a href="{{ route('table.edit', $item->id) }}"
                                        class="btn btn-warning w-10 h-10">Edit</a>
                                    @if (!$item->is_admin)
                                        <form action="{{ route('table.destroy', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
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
