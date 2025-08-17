<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MERO-BAARS</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/twitterbootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatablesbootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/css/icons/tabler-icons/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('template_assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}" />
</head>

<body class="position-relative">
    <div class="d-flex flex-column vh-100 justify-content-between">
        @include('components.header')
        <div class="page-wrapper flex-1" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
            data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            @if (Route::currentRouteName() != 'home')
                @include('components.sidebar')
            @endif
            @if (Route::currentRouteName() != 'home')
                <div class="body-wrapper">
                    <div class="px-3 pb-3 mt-3">
                        @yield('content')
                    </div>
                </div>
            @else
                @yield('content')
            @endif
        </div>
    </div>
    <div class="toast-container position-fixed z-3 pb-2 pe-2" id="toast-container-global" style="right: 0; bottom: 0">
    </div>
    @include('components.footer')
    <script src="{{ asset('assets/js/loader.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.js') }}"></script>
    <script src="{{ asset('assets/js/datatablesbootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap5.3.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('template_assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template_assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('template_assets/js/app.min.js') }}"></script>
    <script src="{{ asset('template_assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template_assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/jspdf.umd.min.js') }}"></script>
    <script src="{{ asset('assets/js/html2canvas.min.js') }}"></script>
    <script src="{{ asset('assets/js/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/socket.io.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @include('layout.js.layoutjs')
    @yield('js')
</body>

</html>
