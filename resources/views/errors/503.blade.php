@extends('layouts.error')
@section('title') Service-Unavailable @endsection
@section('content')
<div class="error-page server-error">
    <div class="flex-center position-ref full-height">
        <div class="content">
          <section class="hero is-medium is-bold server-error">
              <div class="hero-body">
                  <div class="container">
                    <i class="fa fa-6x fa-lock"></i>
                    <h1 class="title m-t-0">
                        {{ __('503') }} | {{ __('Service Unavailable') }}
                    </h1>
                    <h3 class="subtitle">
                        {{ __($exception->getMessage() ?: 'Service Unavailable') }}
                    </h3>
                  <p><a class="button is-outlined" href="{{ route('dashboard')}}">Home</a></p>
                    
                  </div>
              </div>
          </section>
        </div>
    </div>
</div>

@endsection
