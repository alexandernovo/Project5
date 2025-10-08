<div class="offcanvas offcanvas-end" style="background-color: #313131" data-bs-backdrop="static" tabindex="-1"
    id="staticBackdrop" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-x-lg text-white"></i>
        </button>
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
                        <input type="text" name="username" id="username" class="form-control bg-white"
                            placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="" class="mb-1 text-white">Password</label>
                        <input type="password" name="password" id="password" class="form-control bg-white"
                            placeholder="Password">
                        <p id="error_login" class="text-warning mt-1 d-none mb-0 error-class"></p>
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn w-100 text-white" style="background-color: #41080D">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
