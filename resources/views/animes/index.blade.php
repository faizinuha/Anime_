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

        /* Perbesar gambar dan video dengan ukuran yang pas */
        .table img,
        .table video {
            max-width: 120px;
            max-height: 200px;
            border-radius: 5px;
            object-fit: cover;
        }

        /* Responsive untuk perangkat kecil */
        @media (max-width: 768px) {

            .table img,
            .table video {
                max-width: 80px;
                max-height: 120px;
            }
        }

        @media (max-width: 576px) {

            .table img,
            .table video {
                max-width: 60px;
                max-height: 100px;
            }
        }

        /* Media Container */
        .media-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            align-items: center;
            justify-content: center;
        }

        .media-container video {
            grid-column: 1 / -1;
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
            <span class="text-muted fw-light">Tabel /</span> Daftar Anime
        </h4>

        <a href="{{ route('anime.create') }}" class="btn btn-primary mb-3">Tambah Anime</a>

        <!-- Tabel Daftar Anime -->
        <div class="table-responsive">
            <table id="example12" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Pv</th>
                        <th>Rilis</th>
                        {{-- <th>Episode</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($animes as $index => $anime)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $anime->name }}</td>
                            <td>
                                @if ($anime->image)
                                    <img src="{{ asset('storage/' .$anime->image) }}" alt="Gambar Anime" />
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
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('anime.edit', $anime->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                    <form action="{{ route('anime.destroy', $anime->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Tambahan Baris untuk Data Tambahan -->
                        {{-- @dd($anime->animeEpisodes) --}}
                        <tr>
                            <td colspan="6" class="text-start">
                                <strong>Category:</strong> {{ $anime->category->name }} |
                                <strong>Studio:</strong> {{ $anime->studio }} |
                                <strong>Tipe:</strong> {{ $anime->type }} |
                                <strong>Sinonim:</strong> {{ $anime->synonyms }} |
                                <strong>TotalEps:</strong> {{ $anime->TotalEps }} |
                                <strong>Episode:</strong> {{ count($anime->animeEpisodes) > 0 ? $anime->animeEpisodes->first()->episode : 0 }} |
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <hr class="my-5" />
    </div>
    @push('styles')
        <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    @endpush

    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example12').DataTable();
            });
        </script>
    @endpush

@endsection
