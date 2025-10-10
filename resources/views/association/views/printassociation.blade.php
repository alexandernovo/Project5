@extends('layout.mainlayout')
@section('content')
    @include('association.css.association')
    @include('association.modals.newassociation')
    <div class="row mx-auto">
        <div class="card-body px-2 py-1">
            <div class="row align-items-center">
                <div class="col-12">
                    <div
                        class="d-flex align-items-center mb-2 flex-wrap text-lg-start text-sm-center gap-2 title-tips-class">
                        <h4 class="fw-semibold mb-0 text-nowrap">
                            <img src="{{ asset('assets/images/icons/Association.png') }}"
                                style="width: 30px; height:40px; filter: invert(1);" alt="">
                            Association
                        </h4>
                    </div>
                    <nav aria-label="breadcrumb" class="breadcrum-sm-class">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('association_view') }}">Association</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Print Association</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container bg-white p-5 border rounded shadow-sm"
            style="max-width:800px; margin:auto; position:relative;">
            <!-- Header logos -->
            <div class="text-center mb-3">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="Left Logo" style="width:90px; height:auto;">
                    <div>
                        <p class="mb-0 fw-semibold" style="font-size:14px; color: #06B9E8">Republic of the Philippines<br>
                            <span style="text-transform:uppercase;">Province of Antique</span><br>
                            <span style="text-transform:uppercase; font-weight:700;">Municipality of Barbaza</span>
                        </p>
                    </div>
                    <img src="{{ asset('assets/images/logo2.png') }}" alt="Right Logo" style="width:90px; height:auto;">
                </div>
            </div>

            <!-- Department title -->
            <div class="text-center py-2 mb-4" style="border-bottom:3px solid #06B9E8 !important;">
                <p class="mb-0 text-danger" style="font-size:16px; font-weight: bold">
                    MUNICIPAL ENVIRONMENT &amp; NATURAL
                    RESOURCES
                    OFFICE</p>
            </div>

            <!-- Certification title -->
            <h5 class="text-center mb-4" style="letter-spacing:3px; font-size: 20px; font-weight: bold">CERTIFICATION</h5>

            <!-- Body -->
            <div style="font-size:16px; text-align:justify; line-height:1.8;">
                <p><strong>TO WHOM IT MAY CONCERN:</strong></p>
                <p style="text-indent: 40px">
                    This is to certify that the <strong>{{ $record->association }}</strong> located at Brgy. Poblacion,
                    Barbaza,
                    Antique has compiled all the requirements based on Article I Section 2 of Municipal Ordinance No. 4
                    Series 2018 known as the Ecological and Integrated Solid Waste Management and allowed to operate for
                    business.
                </p>
                <p style="text-indent: 40px">
                    This certification is issued to <strong>{{ $record->association }}</strong> for whatever legal purpose
                    it may
                    serve.
                </p>
                @php
                    $date = \Carbon\Carbon::parse($record->date_renewal);
                    $day = $date->format('j'); // numeric day without leading zero
                    $month = $date->format('F');
                    $year = $date->format('Y');

                    // Determine ordinal suffix (st, nd, rd, th)
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
                    Done this <strong>{{ $day }}<sup>{{ $suffix }}</sup> day of {{ $month }},
                        {{ $year }}</strong> at Barbaza, Antique.
                </p>
            </div>

            <!-- Signature -->
            <div class="d-flex justify-content-end">
                <div class="text-end mt-5 d-flex justify-content-center align-items-center flex-column">
                    <p class="fw-semibold mb-0">GALILEO E. NACIONALES</p>
                    <p class="mb-0">MENRO</p>
                </div>
            </div>
            <!-- Footer -->
            <div class="mt-4 fw-semibold" style="font-size:11px; color:#555;">
                <p class="mb-0"><em>Paid under O.R. No. {{ $record->ornumber }}</em></p>
                <p class="mb-0"><em>Issued at Barbaza, Antique</em></p>
                <p><em>On {{ date('F d, Y', strtotime($record->created_at)) }}</em></p>
            </div>

            <!-- Close button (top-right) -->
            <button type="button" class="btn-close position-absolute" style="top:15px; right:15px;"
                aria-label="Close"></button>
        </div>
    </div>
@endsection
