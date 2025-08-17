@extends('layout.mainlayout')
@section('content')
    @include('wastebottle.css.wastebottle')
    @include('wastebottle.modals.newwastebottle')
    <div class="row mx-auto">
        <div class="card-body px-2 py-1">
            <div class="row align-items-center">
                <div class="col-12">
                    <div
                        class="d-flex align-items-center mb-2 flex-wrap text-lg-start text-sm-center gap-2 title-tips-class">
                        <h4 class="fw-semibold mb-0 text-nowrap">Waste Bottle</h4>
                    </div>
                    <nav aria-label="breadcrumb" class="breadcrum-sm-class">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Waste Bottle</li>
                        </ol>
                    </nav>
                </div>
            </div>  
        </div>
        <div class="card w-100 px-0 mb-0">
            <div class="card-body p-3">
                <table id="wastebottleTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date Created</th>
                            <th>Resident Name</th>
                            <th>Bottle Kg</th>
                            <th>Rice Kg</th>
                            <th>Total | Rice</th>
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
    @include('wastebottle.js.wastebottle')
    @include('wastebottle.js.newwastebottle')
    @include('wastebottle.js.deletewastebottle')
@endsection
