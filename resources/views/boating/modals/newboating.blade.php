<div class="modal fade" id="newBoatingModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="newBoatingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 ms-2">
                    <span>
                        <i class="ti ti-user-plus" style="font-size: 20px"></i>
                    </span>
                    <span id="newBoatingModalLabel">
                        New Boat
                    </span>
                </h1>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg" style="font-size: 15px"></i>
                </button>
            </div>
            <form id="newBoatingform">
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
                                <label for="" class="mb-1">Name of Boat</label>
                                <input type="text" name="name_other" placeholder="Name of Boat"
                                    id="name_other" class="form-control" required>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
