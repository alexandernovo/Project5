<div class="modal fade" id="newtreesModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="newtreesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1100px">
        <div class="modal-content">
            <div class="modal-header position-relative d-flex justify-content-center align-items-center flex-column">
                <img class="mb-1" src="{{ asset('assets/images/logo.jpg') }}" style="height: 70px; width: 70px"
                    alt="">
                <div>
                    <p class="mb-0 text-center fw-semibold" style="color: #5D0900; font-size: 20px">
                        CUTTING TREES CERTIFICATION FORM & REQUIREMENTS</p>
                </div>
                <button type="button"
                    class="btn position-absolute rounded-circle d-flex justify-content-center align-items-center"
                    style="top: 5px; right: 5px; width: 40px; height: 40px" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg" style="font-size: 15px"></i>
                </button>
            </div>
            <form id="newtreesform">
                <input type="hidden" id="record_id" name="record_id" value="0">
                <input type="hidden" id="client_id" name="client_id" value="0">
                <div class="modal-body overflow-y-auto" style="max-height: 450px">
                    <div class="row">
                        <div class="col-6">
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
                                        <input type="text" name="middlename" id="middlename"
                                            placeholder="Middle Name" class="form-control" required>
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
                                <div class="col-6">
                                    <div class="form-group mb-1">
                                        <label for="" class="mb-1">Owner of Trees</label>
                                        <input type="text" name="name_other" id="name_other"
                                            placeholder="Owner of Trees" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-1">
                                        <label for="" class="mb-1">Lot Number</label>
                                        <input type="text" name="lot_no" id="lot_no" placeholder="Lot Number"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-1">
                                        <label for="" class="mb-1">Type of Tree</label>
                                        <input type="text" name="typeoftrees" id="typeoftrees"
                                            placeholder="Type of tree (e.g., Narra)" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-1">
                                        <label for="" class="mb-1">Number of Trees</label>
                                        <input type="number" name="nooftrees" id="nooftrees"
                                            placeholder="Number of Trees" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-1">
                                        <label for="" class="mb-1">Trees Location</label>
                                        <input type="text" name="treeslocated" id="treeslocated"
                                            placeholder="Trees Location" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-1">
                                        <label for="" class="mb-1">Barangay</label>
                                        <select class="form-select" name="barangay" id="barangay" required>
                                            <option value="" disabled selected>Barangay</option>
                                            @foreach ($barangays_global as $brgy)
                                                <option>{{ $brgy }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-1">
                                        <label for="" class="mb-1">Municipality</label>
                                        <input type="text" name="municipality" id="municipality"
                                            placeholder="Municipality" class="form-control" required>
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
                                {{-- <div class="col-6">
                                    <div class="form-group mb-1">
                                        <label for="" class="mb-1">Date of Renewed</label>
                                        <input type="date" name="date_renewal" id="date_renewal"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-1">
                                        <label for="" class="mb-1">Date of Expired</label>
                                        <input type="date" name="expiration" id="expiration" class="form-control"
                                            required>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12 mb-1">
                                <p class="mb-0 fw-semibold">CUTTING TREES REQUIREMENTS</p>
                            </div>
                            <div style="max-height: 400px; overflow-y: auto">
                                <table class="table table-bordered mb-1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Requirements</th>
                                            <th>Progress</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_trees">

                                    </tbody>
                                </table>
                            </div>
                            <i class="bi bi-plus-circle cursor-pointer" data-type="trees" id="addnewrequirementstrees"
                                style="font-size: 25px; color: #06510C"></i>
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
