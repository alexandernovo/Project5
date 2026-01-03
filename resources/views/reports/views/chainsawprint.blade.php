@extends('layout.mainlayout')
@section('content')
    <div class="row mx-auto">
        <div class="card-body px-2 py-1">
            <div class="row align-items-center">
                <div class="col-12">
                    <div
                        class="d-flex align-items-center mb-2 flex-wrap text-lg-start text-sm-center gap-2 title-tips-class">
                        <h4 class="fw-semibold mb-0 text-nowrap">Report | Chainsaw</h4>
                    </div>
                    <nav aria-label="breadcrumb" class="breadcrum-sm-class">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Report | Chainsaw</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body p-2">
                <div class="d-flex justify-content-between align-items-end">
                    <form method="GET" class=" w-25 mb-0">
                        <div class="form-group">
                            <label for="" class="mb-1">Select Month and Year</label>
                            <input type="month" class="form-control" name="monthyear"
                                value="{{ request('monthyear', date('Y-m')) }}" onchange="this.form.submit()">
                        </div>
                    </form>
                    <div class="d-flex gap-2 align-items-center">
                        <button class="btn btn-primary-new" id="printBtn">
                            <i class="bi bi-printer"></i>
                            Print Report
                        </button>
                        <i class="bi bi-file-earmark-pdf-fill text-danger download-btn pdf-button" data-type="pdf"></i>
                        <i class="bi bi-file-earmark-word-fill text-primary download-btn word-button" data-type="word"></i>
                        <i class="bi bi-file-earmark-excel-fill text-success download-btn excel-button"
                            data-type="excel"></i>
                    </div>
                </div>
                <hr class="my-2">
                <div id="printable">
                    <div class="d-flex justify-content-center gap-3 align-items-center">
                        <img src="{{ asset('assets/images/logo.jpg') }}" class="bg-white rounded-circle" width=""
                            alt="" style="width: 78px; height: 78px" />

                        <div class="d-flex justify-content-center align-items-center flex-column mt-4">
                            <p class="mb-1" style="color: black; font-size: 15px; line-height: 18px">
                                Republic of the Philippines
                            </p>
                            <p class="mb-1" style="color: black; font-size: 15px; line-height: 18px">
                                Province of Antique
                            </p>
                            <p class="mb-1 fw-semibold" style="color: black; font-size: 17px; line-height: 18px">
                                MUNICIPALITY OF BARBAZA
                            </p>
                        </div>
                        <img src="{{ asset('assets/images/logo2.png') }}" class="bg-white rounded-circle" width=""
                            alt="" style="width: 78px; height: 78px" />
                    </div>
                    <p class="mb-2 mt-4 text-center fw-semibold text-uppercase" style="font-size: 16px; color: #F90E00">
                        MUNICIPAL ENVIRONMENT & NATURAL RESOURCES OFFICE
                    </p>
                    <p class="mb-2 mt-4 text-center fw-semibold text-uppercase" style="font-size: 20px; color: black">
                        CHAINSAW REPORT AS OF
                        {{ date('F Y', strtotime(request('monthyear', date('Y-m')) . '-01')) }}
                    </p>
                    <table class="table-bordered border-dark table mt-3 table-reports">
                        <thead>
                            <tr>
                                <th class="text-center p-1 align-middle  border-left-report  border-right-report" style="font-size: 12px" style="font-size: 12px">
                                    No.
                                </th>
                                <th class="text-center p-1 align-middle  border-right-report" style="font-size: 12px" style="font-size: 12px">
                                    Name of Owner
                                </th>
                                <th class="text-center p-1 align-middle  border-right-report" style="font-size: 12px" style="font-size: 12px">
                                    OR Number
                                </th>
                                <th class="text-center p-1 align-middle  border-right-report" style="font-size: 12px" style="font-size: 12px">
                                    Brand
                                </th>
                                <th class="text-center p-1 align-middle  border-right-report" style="font-size: 12px" style="font-size: 12px">
                                    Model No.
                                </th>
                                <th class="text-center p-1 align-middle  border-right-report" style="font-size: 12px" style="font-size: 12px">
                                    Serial No.
                                </th>
                                <th class="text-center p-1 align-middle  border-right-report" style="font-size: 12px" style="font-size: 12px">
                                    Address
                                </th>
                                <th class="text-center p-1 align-middle  border-right-report" style="font-size: 12px" style="font-size: 12px">
                                    Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td class="text-center px-2 py-1 align-middle" style="font-size: 12px">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-center px-2 py-1 align-middle" style="font-size: 12px">
                                        {{ $d->owner_name }}
                                    </td>
                                    <td class="text-center px-2 py-1 align-middle" style="font-size: 12px">
                                        {{ $d->ornumber }}
                                    </td>
                                    <td class="text-center px-2 py-1 align-middle" style="font-size: 12px">
                                        {{ $d->brand }}
                                    </td>
                                    <td class="text-center px-2 py-1 align-middle" style="font-size: 12px">
                                        {{ $d->model_no }}</td>
                                    <td class="text-center px-2 py-1 align-middle" style="font-size: 12px">
                                        {{ $d->serial_no }}</td>
                                    <td class="text-center px-2 py-1 align-middle" style="font-size: 12px">
                                        {{ $d->address }}</td>
                                    <td class="text-center px-2 py-1 align-middle" style="font-size: 12px">
                                        {{ date('F d, Y h:i a', strtotime($d->created_at)) }}
                                    </td>
                                </tr>
                            @endforeach

                            @if (empty($data) || count($data) == 0)
                                <tr>
                                    <td colspan="8" class="text-center py-1" style="font-size: 12px">No Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <div class="text-end mt-2 d-flex justify-content-center align-items-center flex-column">
                            <p class="fw-semibold mb-0">GALILEO E. NACIONALES</p>
                            <p class="mb-0">MENRO</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('reports.js.printing')
    <script>
        const reportData = @json($data);
    </script>
    @include('reports.js.chainsawdownload')
@endsection
