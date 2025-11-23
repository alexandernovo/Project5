@extends('layout.mainlayout')
@section('content')
    @php
        $dashboard = [
            [
                'title' => 'ASSOCIATION REPORT',
                'route' => route('associationPrint'),
                'icon' => asset('assets/images/icons/Association.png'),
                'style' => 'background-color: #5F040C',
            ],
            [
                'title' => 'BOATING REPORT',
                'route' => route('boatingPrint'),
                'icon' => asset('assets/images/icons/Boating.png'),
                'style' => 'background-color: #830202'
            ],
            [
                'title' => 'CHAINSAW REPORT',
                'route' => route('chainsawPrint'),
                'icon' => asset('assets/images/icons/Chainsaw.png'),
                'style' => 'background-color: #00068C'
            ],
            [
                'title' => 'CUTTING TREES REPORT',
                'route' => route('treesPrint'),
                'icon' => asset('assets/images/icons/Cutting Trees.png'),
                'style' => 'background-color: #63300B'
            ],
            [
                'title' => 'SARI-SARI STORE REPORT',
                'route' => route('sarisaristorePrint'),
                'icon' => asset('assets/images/icons/Sari-Sari Store.png'),
                'style' => 'background-color: #06510C'
            ],
            [
                'title' => 'TRICYCLE REPORT',
                'route' => route('tricyclePrint'),
                'icon' => asset('assets/images/icons/Tricycle.png'),
                'style' => 'background-color: #2C7101'
            ],
            [
                'title' => 'VENDORS REPORT',
                'route' => route('vendorsPrint'),
                'icon' => asset('assets/images/icons/Vendors.png'),
                'style' => 'background-color: #545454'
            ],
        ];
    @endphp

    <div class="row mx-auto">
        @foreach ($dashboard as $d)
            <div class="col-3 mb-4">
                <div class="border p-4" style="min-height: 300px; border-radius: 16px; {{ $d['style'] }}">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ $d['icon'] }}" style="width: 110px; height: 160px" alt="">
                        <p class="mb-0 text-white text-center text-nowrap" style="font-size: 16px">{{ $d['title'] }}</p>
                        <a href="{{ $d['route'] }}" class="btn w-100 mt-4 text-white" style="border: 1px solid white;">
                            View
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
