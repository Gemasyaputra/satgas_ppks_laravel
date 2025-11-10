<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Satgas PPKPT Politeknik Negeri Padang</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

    <style>
        /* Terapkan font Poppins */
        body, .btn, .nav-link, .navbar-brand, h1, h2, h3, h4, h5 {
            font-family: 'Poppins', sans-serif;
        }
        /* Style untuk gradient text (dari HeroSection.tsx) */
        .text-gradient {
            background: -webkit-linear-gradient(45deg, #F97316, #F59E0B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body style="background-color: #FEFBF6;"> @include('partials.public_nav')

    <main>
        @yield('content')
    </main>

    @include('partials.public_footer')

</body>
</html>