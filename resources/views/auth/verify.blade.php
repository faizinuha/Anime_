@extends('layouts.app')

@section('content') 

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="container text-center">
                <img src="{{ asset('img/verfy.png') }}" class="img-fluid" width="150px">
            </div>
            <div class="card-header text-center">Verify Your Email Address</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif
                
                Before proceeding, please check your email for a verification link. If you did not receive the email,
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline" onclick="alert()">click here to request another</button>.
                </form>
            </div>
        </div>
    </div>    
</div>
