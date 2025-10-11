@extends('layout.mainlayout')
@section('content')
    @include('boating.css.boating')
    @include('boating.modals.newboating')
    <div class="row mx-auto">
        <div class="card-body px-2 py-1">
            <div class="row align-items-center">
                <div class="col-12">
                    <div
                        class="d-flex align-items-center mb-2 flex-wrap text-lg-start text-sm-center gap-2 title-tips-class">
                        <h4 class="fw-semibold mb-0 text-nowrap">
                            <img src="{{ asset('assets/images/icons/Boating.png') }}"
                                style="width: 30px; height:40px; filter: invert(1);" alt="">
                            Boating
                        </h4>
                    </div>
                    <nav aria-label="breadcrumb" class="breadcrum-sm-class">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Boating</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card w-100 px-0 mb-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-secondary-new d-flex flex-nowrap align-items-center gap-2"
                        id="reloadButton">
                        <span>
                            <i class="bi bi-arrow-clockwise"></i>
                        </span>
                        Reload
                    </button>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary-new" id="printCertificate"><i class="bi bi-printer-fill"></i> Print
                            Certification</button>
                    </div>
                    <button class="btn btn-primary-new" id="newCertification">
                        <i class="bi bi-clipboard-plus-fill"></i>
                        Add Certification
                    </button>
                </div>
                <table id="boatingTable" class="table table-bordered data_table">
                    <thead>
                        <tr class="text-center">
                            <th class="text-nowrap p-3 text-center">No.</th>
                            <th class="text-nowrap p-3">Owner</th>
                            <th class="text-nowrap p-3">Name of Boat</th>
                            <th class="text-nowrap p-3">Address</th>
                            <th class="text-nowrap p-3">Sex</th>
                            <th class="text-nowrap p-3">Contact No.</th>
                            <th class="text-nowrap p-3">Date Created</th>
                            <th class="text-nowrap p-2 text-center align-middle sticky-action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('boating.js.boating')
    @include('boating.js.newboating')
    @include('boating.js.deleteboating')
    @include('boating.js.printcertificate')
@endsection
