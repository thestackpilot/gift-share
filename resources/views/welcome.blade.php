<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'GiftShare') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="text-center">
        <div class="mb-4">
            <span class="display-4 fw-bold">
                <span class="text-primary">Gift</span><span class="text-dark">Share</span>
            </span>
        </div>
        
        <p class="lead text-muted mb-4">
            A community platform for sharing items you no longer need.
        </p>

        @if (Route::has('login'))
            <div class="d-flex gap-3 justify-content-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="mt-5">
            <small class="text-muted">Share freely. Give generously.</small>
        </div>
    </div>
</body>
</html>
