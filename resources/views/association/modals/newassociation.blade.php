<div class="modal fade" id="newassociationModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="newassociationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 ms-2">
                    <span>
                        <i class="ti ti-user-plus" style="font-size: 20px"></i>
                    </span>
                    <span id="newassociationModalLabel">
                        New Association
                    </span>
                </h1>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg" style="font-size: 15px"></i>
                </button>
            </div>
            <form id="newassociationform">
                <input type="hidden" id="record_id" name="record_id" value="0">
                <input type="hidden" id="client_id" name="client_id" value="0">
                <div class="modal-body overflow-y-auto" style="max-height: 70vh">
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
                                <label for="" class="mb-1">Name of Association</label>
                                <input type="text" name="association" placeholder="Name of Association"
                                    id="association" class="form-control" required>
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
                                <label for="" class="mb-1">Date of Renewal</label>
                                <input type="date" name="date_renewal" id="date_renewal" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Date of Expiration</label>
                                <input type="date" name="expiration" id="expiration" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary-new">Add Certification</button>
                    <button type="button" class="btn btn-secondary-new" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
