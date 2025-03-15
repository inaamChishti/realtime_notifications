<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav ms-auto">
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Initialize Toastr with Custom Options
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 5000,
            extendedTimeOut: 1000,
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut',
        };

        // WebSocket connection
        const socket = new WebSocket('ws://127.0.0.1:8080');

        socket.onmessage = function(event) {
            const message = JSON.parse(event.data);
            if (message.event === 'user_registered') {
                toastr.success(`New user registered: ${message.data.name} (${message.data.email})`);
            }
        };

        socket.onopen = function() {
            console.log('WebSocket connection established');
        };

        socket.onclose = function() {
            console.log('WebSocket connection closed');
        };

        // Example Toastr Test Messages
        setTimeout(() => {
            toastr.success('Success! This is a colorful toast.');
            toastr.info('Info! This is a blue notification.');
            toastr.warning('Warning! Check this out.');
            toastr.error('Error! Something went wrong.');
        }, 2000);
    </script>

</body>
</html>
<style>
    /* Success - Green with Gradient */
    .toast-success {
        background: linear-gradient(135deg, #28a745, #74d680);
        color: white !important;
    }

    /* Info - Blue with Gradient */
    .toast-info {
        background: linear-gradient(135deg, #007bff, #6bb9f0);
        color: white !important;
    }

    /* Warning - Orange with Gradient */
    .toast-warning {
        background: linear-gradient(135deg, #ffc107, #ffdd67);
        color: black !important;
    }

    /* Error - Red with Gradient */
    .toast-error {
        background: linear-gradient(135deg, #dc3545, #ff6b6b);
        color: white !important;
    }

    /* Toast Title Styling */
    .toast-title {
        font-weight: bold;
        font-size: 16px;
    }

    /* Toast Message Styling */
    .toast-message {
        font-size: 14px;
    }

    /* Adding Box Shadow */
    .toast {
    background-color: rgba(0, 0, 0, 0.85) !important;
    opacity: 1 !important;
}
</style>
