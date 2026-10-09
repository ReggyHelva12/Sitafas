<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title-content', 'Dashboard')</title>

    <!-- ICON -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/smart_scholl-only_icon.png') }}">

    <!-- FONT & ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS TEMPLATE -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.5') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- LIBRARY -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- CUSTOM CSS --}}
    @yield('additional-css')
    @stack('styles')

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden; /* FIX SCROLL */
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-200">

    {{-- SIDEBAR --}}
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark">
        @include('components.sidebar')
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main-content position-relative max-height-vh-100 h-100">

        {{-- NAVBAR --}}
        @include('components.navbar')

        <div class="container-fluid py-4">

            {{-- CONTENT --}}
            @yield('content')

            {{-- ALERT --}}
            @include('sweetalert::alert')

        </div>

        {{-- FOOTER --}}
        @include('components.footer')

    </main>

    {{-- SETTING PANEL --}}
    @include('components.setting')

    {{-- JS TEMPLATE --}}
    @include('components.js')

    {{-- CUSTOM SCRIPT --}}
    @yield('additional-js-top')
    @stack('scripts')

</body>

</html>