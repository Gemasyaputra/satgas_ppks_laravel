<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-t">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Panel Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex">
        @include('partials.admin_sidebar')

        <div class="flex-grow-1 d-flex flex-column" style="margin-left: 280px; min-height: 100vh;">
            @include('partials.panel_header')

            <main class="flex-grow-1 p-4" style="background-color: #f8f9fa;">
                @yield('content')
            </main>

            @include('partials.panel_footer')
        </div>
    </div>
</body>
</html>