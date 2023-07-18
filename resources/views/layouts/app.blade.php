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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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
        
            <nav class="navbar navbar-expand-md navbar-light bg-white " 
                style="
                    left:0;
                    /* top:0; */
                "
                >
                <div class="container">
                    <a class="navbar-brand text-dark" href="{{ url('/') }}">
                        {{ config('app.name', 'IJImall') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            @auth
                                @if (Auth::user()->hasRole('vendor'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('vendor.index') }}">{{ __('Vendor Dashboard') }}</a>
                                    </li>
                                    @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('vendor.index') }}">{{ __('Become a Vendor') }}</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            {{-- currency start--}}
                            @auth
                                <div class="dropdown open">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    {{ Auth::user()->currency->name }}
                                    </button>
                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                    @foreach ($currencies as $currency)
                                    <a class="dropdown-item" href="{{ route('user.currency',$currency->name) }}">{{ $currency->name }}</a>
                                    @endforeach
                                </div>
                                </div>
                            @endauth
                            {{-- currency end --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.index') }}">{{ __('Cart') }}
                                @auth
                                    <span class="badge bg-orange text-light">
                                        {{ $cart->count() }} 
                                    </span> 
                                @endauth
                                    
                                </a>
                            </li>
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
    
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        
           
        <main class="container section" style="top:8em;">
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
