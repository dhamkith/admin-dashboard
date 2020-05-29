@extends('layouts.error')
@section('title') Too-Many-Requests @endsection
@section('content')
<div class="error-page unauthorized">
    <div class="flex-center position-ref full-height">
        <div class="content">
          <section class="hero is-medium  is-bold is-warning">
              <div class="hero-body">
                  <div class="container">
                    <i class="fa fa-6x fa-lock"></i>
                    <h1 class="title m-t-0">
                        {{ __('429') }} | {{ __('Too Many Requests') }}
                    </h1>
                    <h3 class="subtitle">
                        {{ __('Too Many Requests') }}
                    </h3>
                  <p><a class="button is-outlined" href="{{ route('dashboard')}}">Home</a></p>
                    
                  </div>
              </div>
          </section>
        </div>
    </div>
</div>

@endsection
