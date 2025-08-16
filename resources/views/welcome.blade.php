<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="custom-container">
        <header class="custom-header">
            @if (Route::has('login'))
                <nav class="custom-nav">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="custom-link">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="custom-link custom-link-primary">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="custom-link">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        
        <main class="custom-main">
            <div class="custom-content">
                <h1 class="custom-title">Let's get started</h1>
                <p class="custom-description">
                    Laravel has an incredibly rich ecosystem. <br>We suggest starting with the following.
                </p>
                
                <ul class="custom-list">
                    <li class="custom-list-item">
                        <span class="custom-bullet">
                            <span class="custom-bullet-inner">
                                <span class="custom-bullet-dot"></span>
                            </span>
                        </span>
                        <span>
                            Read the
                            <a href="https://laravel.com/docs" target="_blank" class="custom-link-external">
                                <span>Documentation</span>
                                <svg width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5">
                                    <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" stroke="currentColor" stroke-linecap="square"/>
                                </svg>
                            </a>
                        </span>
                    </li>
                    <li class="custom-list-item">
                        <span class="custom-bullet">
                            <span class="custom-bullet-inner">
                                <span class="custom-bullet-dot"></span>
                            </span>
                        </span>
                        <span>
                            Watch video tutorials at
                            <a href="https://laracasts.com" target="_blank" class="custom-link-external">
                                <span>Laracasts</span>
                                <svg width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5">
                                    <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" stroke="currentColor" stroke-linecap="square"/>
                                </svg>
                            </a>
                        </span>
                    </li>
                </ul>
                
                <ul class="custom-actions">
                    <li>
                        <a href="https://github.com/laravel/laravel" target="_blank" class="custom-action-link">
                            Laravel on GitHub
                        </a>
                    </li>
                    <li>
                        <a href="https://laravel.com/docs" target="_blank" class="custom-action-link">
                            Documentation
                        </a>
                    </li>
                    <li>
                        <a href="https://laracasts.com" target="_blank" class="custom-action-link">
                            Laracasts
                        </a>
                    </li>
                </ul>
            </div>
        </main>
    </body>
</html>
