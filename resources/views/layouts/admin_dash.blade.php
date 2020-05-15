<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>    
    <div id="app"> 
      <div class="columns is-multiline is-mobile is-tablet is-desktop"> <!-- is-touch -->
          @include('partials.admin.aside')
          <div class="column is-frozen admin-contant">
            @include('partials.admin.header')
            @yield('content')
          </div>
      </div>
    </div>    <!-- Scripts --> 
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/func.js') }}" defer></script>
    <script src="{{ asset('js/laraseven.js') }}" defer></script>

    @yield('scripts')
</body>
</html>