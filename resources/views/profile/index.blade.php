<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to right, #3498db, #8e44ad);
    }

    .container {
        max-width: 600px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h1 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    p {
        font-size: 18px;
        color: #555;
        margin: 10px 0;
    }

    .btn-danger {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: white;
        background-color: #e74c3c;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-top: 20px;
    }

    .alert-success {
        background-color: #dff0d8;
        color: #3c763d;
    }

    .alert-danger {
        background-color: #f2dede;
        color: #a94442;
    }

    .confirm-input {
        margin: 10px 0;
        padding: 10px;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>

<div class="container">
    <h1>Profil Pengguna</h1>

    @forelse($profiles as $profile)
        <p>Nama: {{ $profile->user->name }}</p>
        <p>Email: {{ $profile->user->email }}</p>
        {{-- <p>Role: {{  $profile->user->role}}</p> --}}
        <hr>
    @empty
        <p>Profil tidak ditemukan.</p>
    @endforelse

    @if(Auth::check())
        <form id="delete-account-form" action="{{ route('profile.delete-account') }}" method="POST">
            @csrf
            @method('DELETE')

            <input type="text" id="confirm-text" class="confirm-input" placeholder="Ketik 'hapus' untuk konfirmasi" required>

            <button type="button" class="btn-danger" onclick="confirmDelete()">Hapus Akun</button>
        </form>
    @endif

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>


<script>
    function confirmDelete() {
        const confirmText = document.getElementById('confirm-text').value;

        if (confirmText === 'hapus') {
            if (confirm('Apakah Anda yakin ingin menghapus akun ini? Ini tidak dapat diurungkan!')) {
                document.getElementById('delete-account-form').submit();
            }
        } else {
            alert('Silakan ketik "hapus" untuk mengonfirmasi penghapusan akun.');
        }
    }
</script>
