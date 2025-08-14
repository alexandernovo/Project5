<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Digital Incident Reporting System</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logoico.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/twitterbootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatablesbootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/css/icons/tabler-icons/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('template_assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('components.sidebar')
        <div class="body-wrapper">
            @include('components.header')
            <div class="px-3 pb-3 mt-3">
                @yield('content')
            </div>
        </div>
    </div>
    {{-- container for toast alert --}}
    <div class="toast-container position-fixed z-3 pb-2 pe-2" id="toast-container-global" style="right: 0; bottom: 0">
    </div>

    {{-- toast template --}}
    {{-- <div class="toast-container position-fixed z-3 pb-2 pe-2" style="right: 0; bottom: 0">
        <div class="toast show glass-card text-white" role="alert" aria-live="assertive" aria-atomic="true"
            data-bs-autohide="false">
            <div class="toast-header glass-card border-bottom">
                <img src="{{ asset('assets/images/incidentreport/notification_bell2.png') }}"
                    class="toast-icon rounded me-2" alt="Notification">
                <strong class="me-auto text-white">New Notification</strong>
                <small class="text-white fs-1 datetime-notif" data-date="">2 seconds ago</small>
                <button type="button" class="p-0 px-1 ms-1 close-btn" data-bs-dismiss="toast" aria-label="Close">
                    <i class="bi bi-x-lg text-white"></i>
                </button>
            </div>
            <div class="toast-body glass-card">
                <div class="d-flex gap-1 align-items-center">
                    <div class="profile-avatar"></div>
                    <div>
                        <p class="mb-0 fs-2 toast-username">Alexander E. Novo</p>
                        <p class="mb-0 fs-2 toast-role">Computer Maintenance Technologist 1</p>
                    </div>
                </div>

                <div class="mt-3 glass-card2 p-2 rounded">
                    <p class="mb-0 fs-2 toast-message">
                        <i class="bi bi-app-indicator me-1"></i>
                        Incident Report has been Received.
                    </p>
                </div>

                <div class="mt-2">
                    <div class="col-6 ps-0">
                        <button class="btn w-100 glass-card3 text-white btn-notif-hover" style="font-size: 11px; letter-spacing: 1px">
                            View
                        </button>
                    </div>
                    <div class="col-6"></div>
                </div>
            </div>
        </div>
    </div> --}}
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
    @include('layout.js.socket')
    @yield('javascript')
    @include('layout.js.notification')
</body>

</html>
