<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">
@include('layout.style')

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layout.sidebar')
            <div class="layout-page">
                @include('layout.navbar')
                <div class="content-wrapper">
                    @yield('content')
                    @include('layout.footer')
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    @include('layout.script')

    <script>
        window.addEventListener('load', function() {
            if (!navigator.onLine) {
                // Simpan URL halaman saat ini sebelum offline
                localStorage.setItem('previousPage', window.location.href);
                // Arahkan ketika offline
                window.location.href = '{{ url('Jaringandown') }}';
            }
        });
    
        window.addEventListener('offline', function() {
            // Arahkan ketika offline
            window.location.href = '{{ url('Jaringandown') }}';
        });
    
        window.addEventListener('online', function() {
            // Kembalikan pengguna ke halaman sebelumnya jika perlu
            console.log('Kembali online');
            const previousPage = localStorage.getItem('previousPage');
            if (previousPage) {
                window.location.href = previousPage;
                localStorage.removeItem('previousPage');
            }
        });
    </script>
    
</body>

</html>
