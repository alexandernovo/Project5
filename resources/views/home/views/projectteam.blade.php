@extends('layout.mainlayout')
@section('content')
    @include('home.css.projectcss')
    @include('home.components.login')
    <div class="d-flex justify-content-center">
        <h1 class="text-center mt-3 text-white pb-1"
            style="font-weight: bold; letter-spacing: 1px; font-size: 37px; width: 320px; border-bottom: 4px solid white">DREAM TEAM</h1>
    </div>
    @php
        $team = [
            [
                'name' => 'MERRY MAE D. TOMOLIN',
                'image' => '1.png',
            ],
            [
                'name' => 'JOHN MICHAEL G. ESPAÑOLA',
                'image' => '2.png',
            ],
            [
                'name' => 'AILYN JOY B. GABILA',
                'image' => '3.png',
            ],
            [
                'name' => 'DAVE F. NECESITO',
                'image' => '4.png',
            ],
            [
                'name' => 'JEZEL FAITH A. JAYME',
                'image' => '5.png',
            ],
        ];
    @endphp

    <div class="d-flex justify-content-around px-4 gap-5 mt-5">
        @foreach ($team as $member)
            <div class="text-center d-flex flex-column justify-content-center align-items-center" style="width: 160px;">
                <div style="width: 160px; height: 160px">
                    <img src="{{ asset('assets/images/team/' . $member['image']) }}" alt="{{ $member['name'] }}"
                        class="w-100 h-100 object-fit-cover rounded-circle">
                </div>

                <p class="mt-2 text-white text-uppercase text-nowrap fw-semibold" style="font-size: 14px; letter-spacing: 1px">
                    {{ $member['name'] }}
                </p>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">
        <div class="text-center d-flex flex-column justify-content-center align-items-center" style="width: 160px;">
            <div style="width: 160px; height: 160px">
                <img src="{{ asset('assets/images/team/rexphoto.png') }}" alt="Rex P. Bernesto"
                    class="w-100 h-100 object-fit-cover rounded-circle">
            </div>

            <p class="mt-2 text-white text-uppercase text-nowrap mb-0 fw-semibold" style="font-size: 14px;">
                Rex P. Bernesto
            </p>
            <p class="text-white text-nowrap fw-semibold" style="font-size: 14px; border-top: 2px solid white; width: 170px">
                Capstone Adviser
            </p>
        </div>
    </div>
@endsection

@section('js')
    @include('home.js.login')
@endsection
