@extends('layout.mainlayout')
@section('content')
    @include('home.components.login')
    <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 " style="height: calc(100vh - 122px);">
        <div class="text-center ">
            <p class="mb-1" style="color: black; font-size: 35px; font-weight: bold">MENRO</p>
            <p class="mb-2" style="font-size: 18px">(Municipal Environment and Natural Resources Office)</p>
            <p class="mb-2" style="color: black; font-size: 35px; font-weight: bold">an Automated Recording System <br> in
                Municipality of Barbaza Antique</p>
            <p class="mb-1" style="font-size: 17px; font-style: italic;">Ensuring Business Legality, Supporting Environment
                Goals</p>
        </div>
        <div class="ms-3">
            <img src="{{ asset('assets/images/logo.jpg') }}" alt="" style="width: 400px; height: 400px">
        </div>
    </div>
@endsection

@section('js')
    @include('home.js.login')
@endsection
