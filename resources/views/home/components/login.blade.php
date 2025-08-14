<div class="offcanvas offcanvas-end primary-bg-new" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-white" id="staticBackdropLabel">
            <i class="bi bi-person-lock me-1" style="font-size: 20px"></i>
            Admin Login
        </h5>
        <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-x-lg text-white"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="d-flex flex-column justify-content-center align-items-center mt-4">
            <img src="{{ asset('assets/images/logo.jpg') }}" class="rounded-circle" alt=""
                style="width: 120px; height: 120px">
            <div class="w-100 px-3 mt-4">
                <div class="form-group mb-2">
                    <label for="" class="mb-1 text-white">Username</label>
                    <input type="text" class="form-control bg-white" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="" class="mb-1 text-white">Password</label>
                    <input type="password" class="form-control bg-white" placeholder="Password">
                </div>
                <div class="form-group mt-4">
                    <button class="btn w-100 text-white" style="background-color: gray">Login</button>
                </div>
            </div>
        </div>
    </div>
</div>
