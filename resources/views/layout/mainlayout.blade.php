<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('template_assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('template_assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/twitterbootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatablesbootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link id="pagestyle" href="{{ asset('template_assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <title>System</title>
</head>
@yield('config')

<body class="g-sidenav-show  bg-gray-100">
    <div class="min-height-300 bg-dark position-absolute w-100"></div>
    @include('components.sidebar')
    <main class="main-content position-relative border-radius-lg ">
        @include('components.navbar')
        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>
    @include('components.plugins')
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @vite('resources/js/app.js')
    <script src="{{ asset('template_assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/twitterbootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.js') }}"></script>
    <script src="{{ asset('assets/js/datatablesbootstrap.js') }}"></script>
    @yield('javascript')
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('template_assets/js/argon-dashboard.min.js') }}?v=2.1.0"></script>
</body>

</html>
