@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="{{ asset('Img1/verfy.png') }}" class="img-fluid mb-3" width="100px" alt="Verify">
                        <h4 class="card-title">Verify Your Email Address</h4>
                        <p class="text-muted">Please verify your email to continue</p>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif

                    <p class="text-center">Before proceeding, please check your email for a verification link. If you did not receive the email,</p>

                    <form class="text-center" method="POST" action="{{ route('verification.resend') }}" id="resendForm">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary btn-sm">Resend Email</button>
                    </form>

                    <hr>
                    <div class="text-center">
                        <p>If you want to skip the verification process, click the button below:</p>
                        <a href="{{ route('Anim') }}" class="btn btn-primary">Skip Verification</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('notification'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (Notification.permission === 'granted') {
                    new Notification('Selamat Datang!', {
                        body: '{{ session('notification') }}',
                        icon: '{{ asset('Img1/verify.png') }}' // Ubah dengan path icon kamu
                    });
                }
            });
        </script>
    @endif

    <script>
        document.getElementById('resendForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Loading');
            setTimeout(() => {
                this.submit();
            }, 3000);
        });

        // Request permission for notifications
        Notification.requestPermission().then(function(permission) {
            if (permission === 'granted') {
                console.log('Notification permission granted.');
            } else {
                console.log('Notification permission denied.');
            }
        });
    </script>
@endsection
