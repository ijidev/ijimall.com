<nav class="navbar navbar-expand-sm navbar-light bg-white " 
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