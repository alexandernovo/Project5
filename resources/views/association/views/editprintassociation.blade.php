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
                            <li class="breadcrumb-item" aria-current="page">Edit Association Certificate</li>
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
                            ['label' => 'Association Name', 'value' => ':association_name'],
                            ['label' => 'Address', 'value' => ':address'],
                            ['label' => 'Year', 'value' => ':year'],
                            ['label' => 'Month', 'value' => ':month'],
                            ['label' => 'Day', 'value' => ':day'],
                            ['label' => 'OR Number', 'value' => ':or_number'],
                            ['label' => 'Created Date', 'value' => ':created_at'],
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
                    @endphp
                    <div class="mb-2">
                        <label class="fw-semibold">Available Placeholder: (Tip - Click the row you want before clicking this
                            placeholder)</label><br>
                        @foreach ($badges as $badge)
                            <span class="badge badge-choice bg-secondary-new text-white" data-badge="{{ $badge['value'] }}"
                                style="cursor:pointer;">
                                {{ $badge['label'] }}
                            </span>
                        @endforeach
                    </div>
                    <textarea id="description" name="description" required>
                        {{ ($certificate && $certificate->description ) ? $certificate->description 
                        : "<p style='font-size:16px;'><strong>TO WHOM IT MAY CONCERN:</strong></p>
                            <p style='text-indent: 40px;font-size:16px;'>
                                This is to certify that the <strong class='highlight-bg-cert' contenteditable='false'>:association_name</strong> located at
                                <span class='highlight-bg-cert' contenteditable='false'>:address</span> has compiled all the requirements based on Article I Section 2 of Municipal
                                Ordinance No. 4
                                Series 2018 known as the Ecological and Integrated Solid Waste Management and allowed to operate for
                                business.
                            </p>
                            <p style='text-indent: 40px; font-size:16px;'>
                                This certification is issued to <strong class='highlight-bg-cert' contenteditable='false'>:association_name</strong> for whatever legal
                                purpose
                                it may
                                serve.
                            </p>

                            <p style='text-indent: 40px; font-size:16px;'>
                                Done this  <span class='highlight-bg-cert' contenteditable='false'>:day</span><sup>{$suffix}</sup> day of  <span class='highlight-bg-cert' contenteditable='false'>:month</span>,
                                <span class='highlight-bg-cert' contenteditable='false'>:year</span> Barbaza, Antique.
                            </p>"
                        }}
                    </textarea>

                    <div class="d-flex justify-content-end">
                   
                        <textarea id="signatory" name="signatory" required>
                            {{ ($certificate && $certificate->signatory ) ? $certificate->signatory 
                            : "<div class='text-end mt-5 d-flex justify-content-center align-items-center flex-column'>
                                    <p class='fw-semibold mb-0'>GALILEO E. NACIONALES</p>
                                    <p class='mb-0'>MENRO</p>
                                </div>"
                            }}
                        </textarea>
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

                    <a href="{{ route('association_view') }}" type="button" class="btn-close position-absolute"
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
    @include('association.js.editcertification')
@endsection
