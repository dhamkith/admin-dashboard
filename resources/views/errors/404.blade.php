@extends('layouts.error')
@section('title') Not-Found @endsection
@section('content')

<div class="error-page not-found">
    <div class="flex-center position-ref full-height">
        <div class="content">
          <section class="hero is-medium is-bold not-found">
              <div class="hero-body">
                  <div class="container">
                    <i class="fa fa-6x fa-exclamation"></i>
                    <h1 class="title m-t-0">
                        {{ __('404') }} | {{ __('Not Found') }}
                    </h1>
                    <h3 class="subtitle">
                        {{ __($exception->getMessage() ?: 'Not Found') }}
                    </h3>
                  <p><a class="button is-outlined" href="{{ route('dashboard')}}">home</a></p>
                    
                  </div>
              </div>
          </section>
        </div>
    </div>
</div>

@endsection

