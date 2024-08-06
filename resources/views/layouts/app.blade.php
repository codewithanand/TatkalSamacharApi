<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="en">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.head')
    <title>
        @yield('title')
    </title>

    @include('layouts.styles')

    @yield('styles')
</head>

<body class="position-relative">


    <div class="position-absolute" style="top: 20px; right: 20px;">
        @if (!auth()->user())
            <a class="text-white mr-3" href="{{ route('login') }}">Login</a>
            <a class="text-white" href="{{ route('register') }}">Register</a>
        @else
            @if (auth()->user()->role == 'admin')
                <a class="text-white mr-3" href="{{ route('admin.dashboard') }}">Dashboard</a>
            @endif
        @endif
    </div>

    @yield('content')


    @include('layouts.scripts')
    @yield('scripts')
</body>

</html>
