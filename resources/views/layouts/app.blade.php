<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Garden Heaven</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-green-600 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-green-600 py-6 border-solid border-grey-2 border-b-2 ">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        Garden Heaven
                    </a>
                </div>
                <nav class="space-x-4 text-gray-200 text-sm sm:text-base">
                    <a class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" href="/">Home</a>
                    <a class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" href="/blog">Blog</a>
                    <a class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" href="/plantFinder">Plant Identifier</a>

                    @guest
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <span>{{ Auth::user()->name }}</span>

                        <a href="{{ route('logout') }}"
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header>

        <div class="bg-gray-100">
            @yield('content')
        </div>

        <div>
            @include('layouts.footer')
        </div>
    </div>
</body>
</html>
