<!DOCTYPE html>
<html lang="es" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- CSS de Vuexy --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

    {{-- Íconos --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}">
</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- Sidebar --}}
            @include('profile.partials.sidebar')

            <!-- Layout page -->
            <div class="layout-page">

                {{-- Navbar --}}
                @include('profile.partials.navbar')

                <!-- Contenido principal -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- JS de Vuexy --}}
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</body>
</html>
