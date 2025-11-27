@extends('layout.mainlayout')
@section('content')
    @include('vendors.css.vendor')
    @include('vendors.modals.newvendor')
    <div class="row mx-auto">
        <div class="card-body px-2 py-1">
            <div class="row align-items-center">
                <div class="col-12">
                    <div
                        class="d-flex align-items-center mb-2 flex-wrap text-lg-start text-sm-center gap-2 title-tips-class">
                        <h4 class="fw-semibold mb-0 text-nowrap">
                            <img src="{{ asset('assets/images/icons/Vendors.png') }}"
                                style="width: 30px; height:40px; filter: invert(1);" alt="">
                            Vendors
                        </h4>
                    </div>
                    <nav aria-label="breadcrumb" class="breadcrum-sm-class">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Vendors</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card w-100 px-0 mb-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-secondary-new d-flex flex-nowrap align-items-center gap-2" id="reloadButton">
                        <span>
                            <i class="bi bi-arrow-clockwise"></i>
                        </span>
                        Reload
                    </button>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-blue" id="printCertificate"><i class="bi bi-printer-fill"></i> Print
                            Certification</button>
                    </div>
                    <button class="btn btn-primary-new" id="newCertification">
                        <i class="bi bi-clipboard-plus-fill"></i>
                        Add Certification
                    </button>
                </div>
                <table id="vendorTable" class="table table-bordered data_table">
                    <thead>
                        <tr>
                            <th class="text-nowrap text-center">No.</th>
                            <th class="text-nowrap">Owner</th>
                            <th class="text-nowrap">OR No.</th>
                            <th class="text-nowrap">Name of Vendor</th>
                            <th class="text-nowrap">Address</th>
                            <th class="text-nowrap">Sex</th>
                            <th class="text-nowrap">Contact No.</th>
                            <th class="text-nowrap">Date Created</th>
                            <th class="text-nowrap text-center">Status</th>
                            <th class="text-nowrap">Date of Renewal</th>
                            <th class="text-nowrap">Date of Expiration</th>
                            <th class="text-nowrap sticky-action">Action</th>
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
    @include('vendors.js.vendor')
    @include('vendors.js.newvendor')
    @include('vendors.js.deletevendor')
    @include('vendors.js.printcertificate')
@endsection
