@extends('layout.mainlayout')
@section('content')
    @include('home/css/homecss')
    @include('home.components.login')
    <div class="d-flex flex-nowrap justify-content-between align-items-center gap-4 banner px-5"
        style="height: calc(100vh - 122px);">
        <div class="text-start text-white">
            <p class="mb-4" style="font-size: 20px">Welcome to</p>
            <p class="mb-1" style="font-size: 43px; font-weight: bold">BARBAZA MENRO-BAARS</p>
            <p style="font-size: 20px; font-style: italic">( Municipal Environment and Natural Resources)</p>
            <p class="mb-1" style="font-size: 18px; margin-top: 70px">
                "Ensuring Business Legality, Supporting Environment Goals"
            </p>
        </div>
        <div class="ms-3 d-flex justify-content-center gap-3">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="" class="rounded-circle"
                style="width: 270px; height: 270px">
            <img src="{{ asset('assets/images/logo2.png') }}" alt="" class="rounded-circle"
                style="width: 270px; height: 270px">
        </div>
    </div>
@endsection

@section('js')
    @include('home.js.login')
@endsection
