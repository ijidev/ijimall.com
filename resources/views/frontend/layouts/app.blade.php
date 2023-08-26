<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('dashboard_asset/assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_asset/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('dashboard_asset/assets/img/favicon.ico') }}" />
</head>
<body>
    <div id="app">
        
        @include('frontend.layouts.navbar')
          
        <main class="section" style="top:2em;">
            @if (session('success'))
                <div class="alert alert-success z-index-1000" role="alert">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
            <div class="alert alert-danger z-index-1000" role="alert">
                {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </main>
        
    </div>
</body>
<footer>
     <!-- General JS Scripts -->
     <script src="{{ asset('dashboard_asset/assets/js/app.min.js') }}"></script>
     <!-- JS Libraies -->
     <script src="{{ asset('dashboard_asset/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
     <!-- Page Specific JS File -->
     <script src="{{ asset('dashboard_asset/assets/js/page/index.js') }}"></script>
     <!-- Template JS File -->
     <script src="{{ asset('dashboard_asset/assets/js/scripts.js') }}"></script>
     <!-- Custom JS File -->
     <script src="{{ asset('dashboard_asset/assets/js/custom.js') }}"></script>
    
    <!-- Plugins JS File -->
    {{-- <script src="{{ asset('front_assets/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/superfish.min.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('front_assets/assets/js/main.js') }}"></script> --}}

</footer>
</div>
</html>
