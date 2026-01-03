@extends('layout.mainlayout')

@section('content')
    <style>
        .div-prof {
            margin-top: 0 !important;
            background-color: #B4B4B4;
            flex: 1
        }

        .div-upper {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
    </style>
    <div class="card pt-3 bg-transparent" style="flex: 1">
        <div class="card-body p-0">
            <div class="row mx-auto">
                <div class="col-4 border-end p-4 pb-3" style="border-right: 1px solid #555554; background-color: #093a0d;">
                    <div class="d-flex justify-content-center">
                        <div class="border rounded-circle bg-white position-relative" style="width: 150px; height: 150px">
                            <img src="{{ asset(auth()->user()->profile) }}"
                                onerror="this.onerror=null;this.src='{{ asset('assets/images/default.png') }}';"
                                alt="Profile" class="w-100 h-100 object-fit-cover rounded-circle" id="profilePreview">
                            <input type="file" id="profileInput" class="d-none" accept="image/*">

                            <button type="button" onclick="document.getElementById('profileInput').click()"
                                class="bg-white rounded-circle d-flex justify-content-center align-items-center border position-absolute"
                                style="width: 30px; height:30px; bottom: 5px; right: 10px;">
                                <i class="bi bi-camera-fill" style="font-size: 20px"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mb-0 text-center mt-1 text-white">
                        @galileonacionales
                    </p>
                    <p class="mb-1 text-center mt-0 text-white" style="font-size: 24px">
                        {{-- {{ auth()->user()->firstname }}
                        {{ auth()->user()->middlename ? strtoupper(substr(auth()->user()->middlename, 0, 1)) . '.' : '' }}
                        {{ auth()->user()->lastname }} --}}
                        Galileo E. Nacionales
                    </p>
                    <div style="background-color: #2C7101; border-radius: 25px"
                        class="gap-3 p-2 px-3 text-white d-flex justify-content-between align-items-center"
                        style="border-radius: 20px">
                        <img src="{{ asset('assets/images/logo.jpg') }}" class="rounded-circle" alt=""
                            style="height: 35px; width: 35px">
                        <p class="mb-0" style="font-size: 18px">
                            MENRO Administrator
                        </p>
                        <img src="{{ asset('assets/images/logo2.png') }}" alt="" style="height: 35px; width: 35px">
                    </div>
                    <div class="mt-3">
                        <form id="userUpdateForm">
                            <div class="form-group bg-white rounded position-relative mb-2">
                                <i class="bi bi-person-circle position-absolute"
                                    style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                                <input type="text" name="username" class="form-control" style="text-indent: 20px"
                                    value="{{ auth()->user()->username }}">
                            </div>
                            <div class="form-group bg-white rounded position-relative mb-2">
                                <i class="bi bi-eye-slash-fill position-absolute toggle-password"
                                    style="left: 15px; top: 50%; transform: translateY(-50%);"
                                    data-target="profile_pass"></i>
                                <input type="text" name="password" id="profile_pass" class="form-control"
                                    style="text-indent: 20px" placeholder="********">
                            </div>
                            <div class="form-group bg-white rounded position-relative mb-2">
                                <i class="bi bi-house-door-fill position-absolute"
                                    style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                                <input type="text" name="address" class="form-control" style="text-indent: 20px"
                                    value="{{ auth()->user()->address }}">
                            </div>
                            <div class="form-group bg-white rounded position-relative mb-2">
                                <i class="bi bi-telephone-fill position-absolute"
                                    style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                                <input type="text" name="phone_num" class="form-control" style="text-indent: 20px"
                                    value="{{ auth()->user()->phone_num }}">
                            </div>
                            <div class="form-group bg-white rounded position-relative mb-2">
                                <i class="bi bi-envelope-fill position-absolute"
                                    style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                                <input type="text" name="email" class="form-control" style="text-indent: 20px"
                                    value="{{ auth()->user()->email }}">
                            </div>

                            <div class="d-flex justify-content-between mt-2">
                                <button type="submit" class="btn btn-secondary-new-2">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-8 p-4 d-flex justify-content-between flex-column bg-white">
                    <div class="border" style="height: 480px">
                        <input type="file" id="backgroundInput" class="d-none" accept="image/*">
                        <img src="{{ asset(auth()->user()->background) }}" id="backgroundPreview"
                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.png') }}';"
                            class="" style="width: 100%; height: 100%; object-fit: cover" alt="" />
                    </div>
                    <div class="d-flex justify-content-end gap-3 mt-3">
                        <button class="btn btn-primary-new"
                            onclick="document.getElementById('backgroundInput').click()">
                            <i class="bi bi-arrow-bar-up"></i>
                            Upload
                        </button>
                        <button class="btn btn-primary-new" id="deleteCover">
                            <i class="bi bi-trash-fill"></i>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('profile.js.profile')
@endsection
