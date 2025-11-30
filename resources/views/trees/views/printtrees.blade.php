@extends('layout.mainlayout')
@section('content')
    @include('chainsaw.css.chainsaw')
    @include('chainsaw.modals.newchainsaw')
    <div class="row mx-auto">
        <div class="card-body px-2 py-1">
            <div class="row align-items-center">
                <div class="col-12">
                    <div
                        class="d-flex align-items-center mb-2 flex-wrap text-lg-start text-sm-center gap-2 title-tips-class">
                        <h4 class="fw-semibold mb-0 text-nowrap">
                            <img src="{{ asset('assets/images/icons/Cutting Trees.png') }}"
                                style="width: 30px; height:40px; filter: invert(1);" alt="">
                            Cutting Trees
                        </h4>
                    </div>
                    <nav aria-label="breadcrumb" class="breadcrum-sm-class">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('trees_view') }}">Cutting
                                    Trees</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Print Cutting Trees</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center justify-content-center">
            <div class="container bg-white p-0 mt-3 d-flex justify-content-end"
                style="max-width:800px; margin:auto; position:relative;">
                <button class="btn btn-primary-new" id="printButton">
                    <i class="bi bi-printer-fill"></i>
                    Print
                </button>
            </div>
            <div class="container bg-white p-5 border rounded shadow-sm mt-2 paper_printable"
                style="max-width:800px; margin:auto; position:relative;" id="print_area">
                <div class="text-center mb-3">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <img src="{{ asset('assets/images/logo.jpg') }}" alt="Left Logo" style="width:90px; height:auto;">
                        <div>
                            <p class="mb-0 fw-semibold" style="font-size:14px; color: #06B9E8">Republic of the
                                Philippines<br>
                                <span style="text-transform:uppercase;">Province of Antique</span><br>
                                <span style="text-transform:uppercase; font-weight:700;">Municipality of Barbaza</span>
                            </p>
                        </div>
                        <img src="{{ asset('assets/images/logo2.png') }}" alt="Right Logo" style="width:90px; height:auto;">
                    </div>
                </div>

                <div class="text-center py-2 mb-4" style="border-bottom:3px solid #06B9E8 !important;">
                    <p class="mb-0 text-danger" style="font-size:16px; font-weight: bold">
                        MUNICIPAL ENVIRONMENT &amp; NATURAL
                        RESOURCES
                        OFFICE</p>
                </div>

                <h5 class="text-center mb-4" style="letter-spacing:3px; font-size: 20px; font-weight: bold">CERTIFICATION
                </h5>

                <div style="font-size:16px; text-align:justify; line-height:1.8;">
                    <p><strong>TO WHOM IT MAY CONCERN:</strong></p>
                    <p style="text-indent: 40px">
                        This is to certify that this Office interposes no objection over the request of <strong
                            class="text-uppercase"> {{ $record->owner_name }}</strong> a
                        resident of
                        {{ $record->address }} is the owner of
                        @php
                            $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);
                            $words = ucfirst($formatter->format($record->nooftrees));
                        @endphp
                        {{ $words }} ({{ $record->nooftrees }}) {{ $record->typeoftrees }} tree situated at
                        {{ $record->treeslocated }}
                        within the land declared under Lot {{ $record->lot_no }} in the name of <strong
                            class="text-uppercase"> {{ $record->owner_name }}</strong>. The purpose is to cut the said
                        trees for personal use.
                    </p>
                    <p style="text-indent: 40px">
                        This Certification is hereby issued upon the request of <strong class="text-uppercase"> {{ $record->owner_name }}</strong>
                        for whatever legal
                        purpose
                        it may
                        serve.
                    </p>
                    @php
                        $date = \Carbon\Carbon::parse($record->date_renewal);
                        $day = $date->format('j');
                        $month = $date->format('F');
                        $year = $date->format('Y');

                        if ($day % 10 == 1 && $day != 11) {
                            $suffix = 'st';
                        } elseif ($day % 10 == 2 && $day != 12) {
                            $suffix = 'nd';
                        } elseif ($day % 10 == 3 && $day != 13) {
                            $suffix = 'rd';
                        } else {
                            $suffix = 'th';
                        }
                    @endphp

                    <p style="text-indent: 40px">
                        Done this {{ $day }}<sup>{{ $suffix }}</sup> day of {{ $month }},
                        {{ $year }} at Barbaza, Antique.
                    </p>
                </div>
                <div class="d-flex justify-content-start">
                    <div class="text-end mt-5 d-flex justify-content-center align-items-center flex-column">
                        <p class="fw-semibold mb-0 align-self-start mb-4">Recommending Approval:</p>
                        <p class="fw-semibold mb-0 ms-5">GALILEO E. NACIONALES</p>
                        <p class="mb-0 ms-5">MENRO</p>
                    </div>
                </div>
                <div class="d-flex justify-content-end me-5">
                    <div class="text-end mt-5 d-flex justify-content-center align-items-center flex-column">
                        <p class="fw-semibold mb-0 align-self-start mb-4">Approved:</p>
                        <p class="fw-semibold mb-0">ROBERTO C. NECOR</p>
                        <p class="mb-0">Municipal Mayor</p>
                    </div>
                </div>
                <div class="mt-4 fw-semibold" style="font-size:11px; color:#555;">
                    <p class="mb-0"><em>Paid under O.R. No. {{ $record->ornumber }}</em></p>
                    <p class="mb-0"><em>Issued at Barbaza, Antique</em></p>
                    <p><em>On {{ date('F d, Y', strtotime($record->created_at)) }}</em></p>
                </div>

                <a href="{{ route('trees_view') }}" type="button" class="btn-close position-absolute" style="top:15px; right:15px;"
                    aria-label="Close"></a>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#printButton').on('click', function() {
                printDiv('print_area');
            });

            function printDiv(divId) {
                var printContents = $('#' + divId).html();
                var originalTitle = document.title;

                // Calculate center position
                var width = 800;
                var height = 800;
                var left = (screen.width / 2) - (width / 2);
                var top = (screen.height / 2) - (height / 2);

                // Open centered window
                var printWindow = window.open('', '', `width=${width},height=${height},top=${top},left=${left}`);

                // Write HTML with Bootstrap CSS
                printWindow.document.write(`
                <html>
                <head>
                    <title>${originalTitle}</title>
                    <link rel="stylesheet" href="{{ asset('template_assets/css/styles.min.css') }}">
                    <style>
                        body {
                            background: white !important;
                            -webkit-print-color-adjust: exact !important;
                            print-color-adjust: exact !important;
                            margin: 40px;
                            font-family: 'Arial', sans-serif;
                        }
                        @media print {
                            .btn, .btn-close { display: none !important; }
                            body { margin: 0; }
                        }
                    </style>
                </head>
                <body>
                    ${printContents}
                </body>
                </html>
            `);

                printWindow.document.close();
                printWindow.focus();

                // Wait for styles to load before printing
                setTimeout(function() {
                    printWindow.print();
                    printWindow.close();
                }, 600);
            }
        });
    </script>
@endsection
