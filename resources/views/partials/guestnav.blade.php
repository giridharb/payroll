<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="background-color:#343a40 !important;">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt=""  class="brand-image elevation-3" style="width:80px">
               <strong style="font-size:30px;color:#fff"> Hartley Lab Payroll</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
               
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto" >
                    <!-- Authentication Links -->
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color:#fff">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" style="color:#fff">{{ __('Register') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</div>