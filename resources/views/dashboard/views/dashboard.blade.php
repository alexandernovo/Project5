@extends('layout.mainlayout')
@section('content')
    @include('dashboard.css.dashboard')
    @include('association.modals.newassociation')
    @include('boating.modals.newboating')
    @include('chainsaw.modals.newchainsaw')
    @include('store.modals.newstore')
    @include('trees.modals.newtrees')
    @include('tricycle.modals.newtricycle')
    @include('vendors.modals.newvendor')
    @php
        $countCards = [
            [
                'title' => 'Association | Month',
                'icon' => asset('assets/images/icons/Association.png'),
                'count_id' => 'associationCount',
                'style' => 'background-color: #5F040C',
            ],
            [
                'title' => 'Boating | Month',
                'icon' => asset('assets/images/icons/Boating.png'),
                'count_id' => 'boatingCount',
                'style' => 'background-color: #830202',
            ],
            [
                'title' => 'Chainsaw | Month',
                'icon' => asset('assets/images/icons/Chainsaw.png'),
                'count_id' => 'chainsawCount',
                'style' => 'background-color: #00068C',
            ],
            [
                'title' => 'Cutting Trees | Month',
                'icon' => asset('assets/images/icons/Cutting Trees.png'),
                'count_id' => 'treesCount',
                'style' => 'background-color: #63300B',
            ],
            [
                'title' => 'Sari-Sari Store | Month',
                'icon' => asset('assets/images/icons/Sari-Sari Store.png'),
                'count_id' => 'storeCount',
                'style' => 'background-color: #06510C',
            ],
            [
                'title' => 'Tricycle | Month',
                'icon' => asset('assets/images/icons/Tricycle.png'),
                'count_id' => 'tricycleCount',
                'style' => 'background-color: #2C7101',
            ],
            [
                'title' => 'Vendors | Month',
                'icon' => asset('assets/images/icons/Vendors.png'),
                'count_id' => 'vendorsCount',
                'style' => 'background-color: #545454',
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
                <div class="p-2" style="border-radius: 16px; {{ $cC['style'] }}">
                    <p class="mb-0 text-center text-white fw-semibold">{{ $cC['title'] }}</p>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <img src="{{ $cC['icon'] }}" style="width: 70px; height: 90px" alt="">
                        <p class="mb-0 text-white" style="font-size: 34px" id="{{ $cC['count_id'] }}">0</p>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0 fw-semibold" style="font-size: 16px">REPORT | THIS MONTH</p>
                    <table id="dashboardTable" class="table table-bordered dashboard-table-font data_table">
                        <thead>
                            <tr>
                                <th class="text-nowrap text-center">No.</th>
                                <th class="text-nowrap">Owner of Association</th>
                                <th class="text-nowrap">OR No.</th>
                                <th class="text-nowrap">Address</th>
                                <th class="text-nowrap">Sex</th>
                                <th class="text-nowrap">Contact No.</th>
                                <th class="text-nowrap">Type of<br>Certification</th>
                                <th class="text-nowrap">Date Created</th>
                                <th class="text-nowrap text-center">Status</th>
                                <th class="text-nowrap">Date of<br>Renewal</th>
                                <th class="text-nowrap">Date of<br>Expiration</th>
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
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 fw-semibold" style="font-size: 16px">
                            STATISTIC DATA CHART
                        </p>

                        <div class="d-flex gap-2">
                            <div>
                                <select id="monthSelect" class="form-select">
                                    <option value="all">All Months</option>
                                    @foreach (range(1, 12) as $m)
                                        <option value="{{ $m }}">
                                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <select id="yearSelect" class="form-select">
                                    @php $currentYear = now()->year; @endphp
                                    @for ($year = $currentYear; $year >= $currentYear - 5; $year--)
                                        <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                        </div>
                    </div>
                    <div id="recordsChart" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('dashboard.js.dashboard')
    @include('dashboard.js.chart')
    @include('dashboard.js.dashboardcounts')
@endsection
