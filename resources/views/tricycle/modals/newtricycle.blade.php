<div class="modal fade" id="newtricycleModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="newtricycleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"  style="max-width: 600px">
        <div class="modal-content">
            <div class="modal-header position-relative d-flex justify-content-center align-items-center flex-column">
                <img class="mb-1" src="{{ asset('assets/images/logo.jpg') }}" style="height: 70px; width: 70px"
                    alt="">
                <div>
                    <p class="mb-0 text-center fw-semibold" style="color: #5D0900; font-size: 20px">
                        TRICYCLE
                        CERTIFICATION FORM</p>
                </div>
                <button type="button"
                    class="btn position-absolute rounded-circle d-flex justify-content-center align-items-center"
                    style="top: 5px; right: 5px; width: 40px; height: 40px" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg" style="font-size: 15px"></i>
                </button>
            </div>
            <form id="newtricycleform">
                <input type="hidden" id="record_id" name="record_id" value="0">
                <input type="hidden" id="client_id" name="client_id" value="0">
                <div class="modal-body">
                    <div class="row mx-auto">
                        <div class="col-12 mb-1">
                            <p class="mb-0 fw-semibold">OWNER'S INFORMATION</p>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">First Name</label>
                                <input type="text" name="firstname" id="firstname" placeholder="First Name"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Middle Name</label>
                                <input type="text" name="middlename" id="middlename" placeholder="Middle Name"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Last Name</label>
                                <input type="text" name="lastname" id="lastname" placeholder="Last Name"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">OR Number</label>
                                <input type="text" name="ornumber" id="ornumber" placeholder="OR Number"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Name of Tricycle</label>
                                <input type="text" name="name_other" placeholder="Name of Tricycle" id="name_other"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Barangay</label>
                                <input type="text" name="barangay" id="barangay" placeholder="Barangay"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Municipality</label>
                                <input type="text" name="municipality" id="municipality" placeholder="Municipality"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Province</label>
                                <input type="text" name="province" id="province" placeholder="Province"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Sex</label>
                                <select name="sex" id="sex" class="form-select" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Contact Number</label>
                                <input type="number" name="contact_no" id="contact_no" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Date of Renewed</label>
                                <input type="date" name="date_renewal" id="date_renewal" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Date of Expired</label>
                                <input type="date" name="expiration" id="expiration" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary-new button-submit">Add Certification</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
