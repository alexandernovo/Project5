@extends('layout.mainlayout')
@section('content')
    @php
        $dashboard = [
            [
                'title' => 'ASSOCIATION REPORT',
                'route' => '',
                'icon' => asset('assets/images/icons/Association.png'),
            ],
            [
                'title' => 'BOATING REPORT',
                'route' => '',
                'icon' => asset('assets/images/icons/Boating.png'),
            ],
            [
                'title' => 'CHAINSAW REPORT',
                'route' => '',
                'icon' => asset('assets/images/icons/Chainsaw.png'),
            ],
            [
                'title' => 'CUTTING TREES REPORT',
                'route' => '',
                'icon' => asset('assets/images/icons/Cutting Trees.png'),
            ],
            [
                'title' => 'SARI-SARI STORE REPORT',
                'route' => '',
                'icon' => asset('assets/images/icons/Sari-Sari Store.png'),
            ],
            [
                'title' => 'TRICYCLE REPORT',
                'route' => '',
                'icon' => asset('assets/images/icons/Tricycle.png'),
            ],
            [
                'title' => 'VENDORS REPORT',
                'route' => '',
                'icon' => asset('assets/images/icons/Vendors.png'),
            ],
        ];
    @endphp

    <div class="row mx-auto">
        @foreach ($dashboard as $d)
            <div class="col-3 mb-4">
                <div class="border p-4" style="min-height: 300px; border-radius: 16px; background-color: #545454">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ $d['icon'] }}" style="width: 120px; height: 170px" alt="">
                        <p class="mb-0 text-white" style="font-size: 20px">{{ $d['title'] }}</p>
                        <button class="btn w-100 mt-4 text-white" style="border: 1px solid white;">View</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
