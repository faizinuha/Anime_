@extends('layouts.app')

@section('content') 
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="container text-center">
                <img src="{{ asset('Img1/verfy.png') }}" class="img-fluid" width="150px">
            </div>
            <div class="card-header text-center">Verify Your Email Address</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif
                
                <p>Before proceeding, please check your email for a verification link. If you did not receive the email,</p>
                
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}" id="resendForm">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click here to request another</button>.
                </form>

                <hr>
                <div class="text-center">
                    <p>If you want to skip the verification process, click the button below:</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Skip Verification</a>
                </div>
            </div>
        </div>
    </div>    
</div>
<script>
    document.getElementById('resendForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Loading');
        setTimeout(() => {
            this.submit();
        }, 3000);
    });
</script>
@endsection
