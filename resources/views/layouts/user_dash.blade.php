<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      @if(admin_setting('site_name') !== null)
          {{ admin_setting('site_name') }}
      @else 
          {{ config('app.name', 'blog') }}
      @endif
    </title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @if(admin_setting('theme_color') !== null && admin_setting('theme_color') === 'theme_color_dark')
      <link href="{{ asset('css/theme-color-dark.css') }}" rel="stylesheet">
    @endif
</head>
<body>    
    <div id="app"> 
      <div class="columns is-multiline is-mobile is-tablet is-desktop" style="margin-bottom: -12px;"> <!-- is-touch -->
          @include('partials.user.aside')
          <div class="column is-frozen admin-contant">
            @include('partials.user.header')
            <div class="is-frozen-content">
              @yield('content')
              <div class="is-frozen-overlay"></div>
            </div>
          </div>
      </div>
    </div>    <!-- Scripts --> 
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/func.js') }}" defer></script>
    <script src="{{ asset('js/laraseven.js') }}" defer></script>

    @yield('scripts')
</body>
</html>