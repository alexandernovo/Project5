@extends('layout.mainlayout')
@section('content')
    @include('dashboard.css.dashboard')


    @php
        $countCards = [
            [
                'title' => 'Association | Month',
                'icon' => asset('assets/images/icons/Association.png'),
                'count_id' => '',
            ],
            [
                'title' => 'Boating | Month',
                'icon' => asset('assets/images/icons/Boating.png'),
                'count_id' => '',
            ],
            [
                'title' => 'Chainsaw | Month',
                'icon' => asset('assets/images/icons/Chainsaw.png'),
                'count_id' => '',
            ],
            [
                'title' => 'Cutting Trees | Month',
                'icon' => asset('assets/images/icons/Cutting Trees.png'),
                'count_id' => '',
            ],
            [
                'title' => 'Sari-Sari Store | Month',
                'icon' => asset('assets/images/icons/Sari-Sari Store.png'),
                'count_id' => '',
            ],
            [
                'title' => 'Tricycle | Month',
                'icon' => asset('assets/images/icons/Tricycle.png'),
                'count_id' => '',
            ],
            [
                'title' => 'Vendors | Month',
                'icon' => asset('assets/images/icons/Vendors.png'),
                'count_id' => '',
            ],
        ];
    @endphp

    <div class="row mx-auto">
        <div class="card-body px-2 py-1">
            <div class="row align-items-center">
                <div class="col-12">
                    <div
                        class="d-flex align-items-center mb-2 flex-wrap text-lg-start text-sm-center gap-2 title-tips-class">
                        <h4 class="fw-semibold mb-0 text-nowrap">
                            <i class="bi bi-microsoft"></i>
                            Dashboard
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($countCards as $cC)
            <div class="col-3 mb-3">
                <div class="secondary-bg p-3" style="border-radius: 8px">
                    <p class="mb-0 text-center text-white fw-semibold">{{ $cC['title'] }}</p>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <img src="{{ $cC['icon'] }}" style="width: 50px; height: 70px" alt="">
                        <p class="mb-0 text-white" style="font-size: 24px">0</p>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0 fw-semibold" style="font-size: 14px">REPORT | MONTH</p>
                    <table id="dashboardTable" class="table table-bordered dashboard-table-font">
                        <thead>
                            <tr>
                                <th class="text-nowrap p-3 text-center">No.</th>
                                <th class="text-nowrap p-3">Owner of Association</th>
                                <th class="text-nowrap p-3">OR No.</th>
                                <th class="text-nowrap p-3">Address</th>
                                <th class="text-nowrap p-3">Sex</th>
                                <th class="text-nowrap p-3">Contact No.</th>
                                <th class="text-nowrap p-3">Type of<br>Certification</th>
                                <th class="text-nowrap p-3">Date Created</th>
                                <th class="text-nowrap p-3 text-center">Renewal Status</th>
                                <th class="text-nowrap p-3">Date of<br>Renewal</th>
                                <th class="text-nowrap p-3">Date of<br>Expiration</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0 fw-semibold" style="font-size: 14px">STATISTIC DATA CHART</p>
                    <div id="recordsChart" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('dashboard.js.dashboard')
    @include('dashboard.js.chart')
@endsection
