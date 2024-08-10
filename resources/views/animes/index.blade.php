@extends('kerangka.master')

@section('title', 'Daftar Anime')

@section('content')
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
    <style>
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

        /* Perbesar gambar dan video */
        .table img,
        .table video {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        /* Container for video and images */
        .media-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            align-items: center;
            justify-content: center;
        }

        .media-container video {
            grid-column: 1 / -1;
            /* Span across both columns */
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

        /* Toast/Alert styling */
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
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Tables /</span> Daftar Anime
        </h4>

        <!-- Tabel Daftar Anime -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('animes.create') }}" class="btn btn-primary rounded-pill">Tambah Anime</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anime</th>
                            <th>Img Anim</th>
                            <th>Media</th>
                            <th>Tanggal Rilis</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($animes as $index => $anime)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $anime->name }}</td>
                                <td>
                                    @if ($anime->image)
                                        <img src="{{ asset('storage/' . $anime->image) }}" alt="Gambar Anime 1">
                                    @endif
                                </td>
                                <td>
                                    <div class="media-container">
                                        @if ($anime->video)
                                            <video src="{{ asset('storage/' . $anime->video) }}" controls></video>
                                        @endif
                                    </div>
                                </td>
                                
                                <td>{{ \Carbon\Carbon::parse($anime->release_date)->format('d-m-Y') }}</td>
                                <td>{{ $anime->category->name }}</td> 
                                <td>
                                    <a href="{{ route('animes.edit', $anime->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('animes.destroy', $anime->id) }}" method="POST"
                                        style="display:inline;">
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

        <hr class="my-5" />
    </div>
@endsection
