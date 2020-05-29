
@extends('layouts.error')
@section('title') Forbidden @endsection
@section('content')
<div class="error-page forbidden">
    <div class="flex-center position-ref full-height">
        <div class="content">
        <section class="hero is-medium is-bold is-danger">
            <div class="hero-body">
                <div class="container">
                  <i class="fa fa-6x fa-lock"></i>
                  <h1 class="title m-t-0">
                      {{ __('403') }} | {{ __('Forbidden') }}
                  </h1>
                  <h3 class="subtitle">
                      {{ __($exception->getMessage() ?:'Forbidden') }}
                  </h3>
                <p><a class="button is-outlined" href="{{ route('dashboard')}}">Home</a></p>
                  
                </div>
            </div>
        </section>
    </div>
  </div>
</div>
@endsection
