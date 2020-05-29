@extends('layouts.login')
 
@section('content')
<div class="container">
    <div class="columns is-multiline is-touch is-desktop">
        <div class="column is-6-touch is-offset-3-touch is-4-desktop is-offset-4-desktop login-cutomize">  
            <div class="label login-title">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a class="verification" href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    {{-- <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form> --}}
                </div>
        </div>
    </div>
</div>
@endsection
