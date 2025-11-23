@extends('layout.mainlayout')
@section('content')
    @include('wastecollect.css.wastecollect')
    @include('wastecollect.modals.newwastecollect')
    <div class="row mx-auto">
        <div class="card-body px-2 py-1">
            <div class="row align-items-center">
                <div class="col-12">
                    <div
                        class="d-flex align-items-center mb-2 flex-wrap text-lg-start text-sm-center gap-2 title-tips-class">
                        <h4 class="fw-semibold mb-0 text-nowrap d-flex align-items-center">
                            <img src="{{ asset('assets/images/icons/Waste Collection.png') }}"
                                style="width: 30px; height:30px; filter: invert(1);" alt="">
                            Waste Collection
                        </h4>
                    </div>
                    <nav aria-label="breadcrumb" class="breadcrum-sm-class">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Waste Collection</li>
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
                    <button class="btn btn-primary-new" id="newwastecollectBtn">
                        <img src="{{ asset('assets/images/icons/Waste Collection.png') }}" style="width: 20px; height:20px;"
                            alt="">
                        Add Waste Collection
                    </button>
                </div>
                <table id="wastecollectTable" class="table table-bordered data_table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Barangay</th>
                            <th>Municipality</th>
                            <th>Province</th>
                            <th>Purok</th>
                            <th>Biodegradable</th>
                            <th>Non-Biodegradable</th>
                            <th>Recyclable</th>
                            <th>Special Waste</th>
                            <th>Date Created</th>
                            <th>Action</th>
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
    @include('wastecollect.js.wastecollect')
    @include('wastecollect.js.newwastecollect')
    @include('wastecollect.js.deletewastecollect')
@endsection
