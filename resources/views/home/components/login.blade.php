<div class="offcanvas offcanvas-end" style="background-color: #313131" data-bs-backdrop="static" tabindex="-1"
    id="staticBackdrop" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <div class="d-flex justify-content-end w-100">
            <button type="button" class="btn border border-white p-0 rounded-circle" style="width: 40px; height: 40px"
                data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="bi bi-x-lg text-white"></i>
            </button>
        </div>
    </div>
    <div class="offcanvas-body">
        <div class="d-flex flex-column justify-content-center align-items-center mt-3">
            <h5 class="text-center text-white mb-4">
                MENRO-BAARS Admin Login
            </h5>
            <img src="{{ asset('assets/images/logo.jpg') }}" class="rounded-circle" alt=""
                style="width: 120px; height: 120px">
            <div class="w-100 px-3 mt-4">
                <form id="login_form">
                    <div class="form-group mb-4">
                        <label for="" class="mb-1 text-white">Username</label>
                        <div class="d-flex align-items-center position-relative">
                            <i class="bi bi-person-circle position-absolute" style="left: 13px; font-size: 18px"></i>
                            <input type="text" name="username" id="username" style="text-indent: 22px"
                                class="form-control bg-white" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-1 text-white">Password</label>
                        <div class="d-flex align-items-center position-relative">
                            <svg xmlns="http://www.w3.org/2000/svg" style="left: 13px;" width="18" height="18" fill="currentColor"
                                class="bi bi-unlock2-fill position-absolute" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 0c1.07 0 2.041.42 2.759 1.104l.14.14.062.08a.5.5 0 0 1-.71.675l-.076-.066-.216-.205A3 3 0 0 0 5 4v2h6.5A2.5 2.5 0 0 1 14 8.5v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4" />
                            </svg>
                            <input type="password" name="password" style="text-indent: 22px" id="password"
                                class="form-control bg-white" placeholder="Password">
                        </div>
                        <p id="error_login" class="text-warning mt-1 d-none mb-0 error-class"></p>
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn w-100 text-white" style="background-color: #093A0D">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
