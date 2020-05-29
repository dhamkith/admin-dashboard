@extends('layouts.error')
@section('title') Page-Expired @endsection
@section('content')
<div class="error-page not-found">
    <div class="flex-center position-ref full-height">
        <div class="content">
          <section class="hero is-medium is-bold not-found">
              <div class="hero-body">
                  <div class="container">
                    <i class="fa fa-6x fa-lock"></i>
                    <h1 class="title m-t-0">
                        {{ __('419') }} | {{ __('Page Expired') }}
                    </h1>
                    <h3 class="subtitle">
                        {{ __('Page Expired') }}
                    </h3>
                  <p><a class="button is-outlined" href="{{ route('dashboard')}}">Home</a></p>
                    
                  </div>
              </div>
          </section>
        </div>
    </div>
</div>

@endsection