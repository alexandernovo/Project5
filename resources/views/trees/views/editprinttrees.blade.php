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
                            <li class="breadcrumb-item" aria-current="page">Edit Cutting Trees Certificate</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form id="form_certification">
            <input type="hidden" name="record_id" value="{{ request('record_id') }}">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="container bg-white p-5 border rounded shadow-sm mt-2"
                    style="max-width:800px; margin:auto; position:relative; height: auto;" id="print_area">
                    <div class="text-center mb-3">
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <img src="{{ asset('assets/images/logo.jpg') }}" alt="Left Logo"
                                style="width:90px; height:auto;">
                            <div>
                                <p class="mb-0 fw-semibold" style="font-size:14px; color: #06B9E8">Republic of the
                                    Philippines<br>
                                    <span style="text-transform:uppercase;">Province of Antique</span><br>
                                    <span style="text-transform:uppercase; font-weight:700;">Municipality of Barbaza</span>
                                </p>
                            </div>
                            <img src="{{ asset('assets/images/logo2.png') }}" alt="Right Logo"
                                style="width:90px; height:auto;">
                        </div>
                    </div>

                    <div class="text-center py-2 mb-4" style="border-bottom:3px solid #06B9E8 !important;">
                        <p class="mb-0 text-danger" style="font-size:16px; font-weight: bold">
                            MUNICIPAL ENVIRONMENT &amp; NATURAL
                            RESOURCES
                            OFFICE</p>
                    </div>

                    <h5 class="text-center mb-4" style="letter-spacing:3px; font-size: 20px; font-weight: bold">
                        CERTIFICATION
                    </h5>

                    @php
                        $badges = [
                            ['label' => 'Address', 'value' => ':address'],
                            ['label' => 'No. of Trees', 'value' => ':no_trees'],
                            ['label' => 'Type of Trees', 'value' => ':type_trees'],
                            ['label' => 'Trees Location', 'value' => ':trees_located'],
                            ['label' => 'Lot No.', 'value' => ':lot_no'],
                            ['label' => 'Owner', 'value' => ':OWNER_NAME', 'type'=>"text-uppercase"],
                            ['label' => 'Day', 'value' => ':day'],
                            ['label' => 'Month', 'value' => ':month'],
                            ['label' => 'Year', 'value' => ':year'],
                            ['label' => 'Created Date', 'value' => ':created_at'],
                            ['label' => 'OR Number', 'value' => ':or_number'],
                        ];
                    @endphp
                     @php
                        $date = \Carbon\Carbon::parse($record->created_at);
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
                        $sex = $record->sex == 'Female' ? 'her' : 'his';
                    @endphp
                    <div class="mb-2">
                        <label class="fw-semibold">Available Placeholder: (Tip - Click the row you want before clicking this
                            placeholder)</label><br>
                        <div class="d-flex gap-1 flex-wrap">
                            @foreach ($badges as $badge)
                                @php
                                    $type= $badge["type"] ?? '';
                                @endphp
                                <span {{ $type ? "data-type=' $type'" : "" }}  class="badge badge-choice bg-secondary-new text-white" data-badge="{{ $badge['value'] }}"
                                    style="cursor:pointer;">
                                    {{ $badge['label'] }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @php
                        $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);
                        $words = ucfirst($formatter->format($record->nooftrees));
                    @endphp
                    <textarea id="description" name="description" required>
                        {{ ($certificate && $certificate->description ) ? $certificate->description 
                        : " <p><strong>TO WHOM IT MAY CONCERN:</strong></p>
                            <p style='text-indent: 40px'>
                                This is to certify that this Office interposes no objection over the request of <strong class='highlight-bg-cert text-uppercase' contenteditable='false'>:OWNER_NAME</strong> a
                                resident of
                                <span class='highlight-bg-cert' contenteditable='false'>:address</span> is the owner of
                                <span class='highlight-bg-cert' contenteditable='false'>:no_trees</span> <span class='highlight-bg-cert' contenteditable='false'>:type_trees</span> tree situated at
                                <span class='highlight-bg-cert' contenteditable='false'>:trees_located</span>
                                within the land declared under Lot <span class='highlight-bg-cert' contenteditable='false'>:lot_no</span> in the name of 
                                <strong class='highlight-bg-cert text-uppercase' contenteditable='false'>:OWNER_NAME</strong>. The purpose is to cut the said
                                trees for personal use.
                            </p>
                            <p style='text-indent: 40px'>
                                This Certification is hereby issued upon the request of <strong class='highlight-bg-cert text-uppercase' contenteditable='false'>:OWNER_NAME</strong>
                                for whatever legal
                                purpose
                                it may
                                serve.
                            </p>
                            <p style='text-indent: 40px'>
                                Issued the <span class='highlight-bg-cert' contenteditable='false'>:day</span><sup>$suffix</sup> day of <span class='highlight-bg-cert' contenteditable='false'>:month</span>,
                                <span class='highlight-bg-cert' contenteditable='false'>:year</span> at Municipality of Barbaza, Antique, Philippines.
                            </p>
                            "
                        }}
                    </textarea>
                    <div class="d-flex justify-content-start">
                        <div class='text-end mt-5 d-flex justify-content-center align-items-center flex-column'>
                            <textarea id="signatory" name="signatory" required>
                            {{ ($certificate && $certificate->signatory) ? $certificate->signatory 
                            : "<p class='text-start fw-semibold mb-0 align-self-start mb-4'>Recommending Approval:</p>
                                <p class='text-center fw-semibold mb-0 ms-5'>GALILEO E. NACIONALES</p>
                                <p class='text-center mb-0 ms-5'>MENRO</p>
                                "
                            }}
                            </textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end me-5">
                        <div class='text-end mt-5 d-flex justify-content-center align-items-center flex-column'>
                            <textarea id="approved" name="approved" required>
                                {{ ($certificate && $certificate->approved ) ? $certificate->approved 
                                : "
                                    <p class='fw-semibold text-start mb-0 align-self-start mb-4'>Approved:</p>
                                    <p class='fw-semibold text-center mb-0'>ROBERTO C. NECOR</p>
                                    <p class='mb-0 text-center'>Municipal Mayor</p>
                                    "
                                }}
                            </textarea>
                        </div>
                    </div>
                    <textarea id="ornodescription" name="ornodescription" required>
                        {{ ($certificate && $certificate->ornodescription ) ? $certificate->ornodescription 
                            : "<div class='mt-4 fw-semibold' style='font-size:11px; color:#555;'>
                            <p class='mb-0'><em>Paid under O.R. No. <span class='highlight-bg-cert' contenteditable='false'>:or_number</span></em></p>
                            <p class='mb-0'><em>Issued at Barbaza, Antique</em></p>
                            <p><em>On <span class='highlight-bg-cert' contenteditable='false'>:created_at</span></em></p>
                            </div>"
                        }}
                    </textarea>

                    <a href="{{ route('trees_view') }}" type="button" class="btn-close position-absolute"
                        style="top:15px; right:15px;" aria-label="Close"></a>
                    <div class="d-flex justify-content-end" style="border-top: 2px solid gray">
                        <button class="btn btn-green mt-2" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    @include('trees.js.editcertification')
@endsection
