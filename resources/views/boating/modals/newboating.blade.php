<div class="modal fade" id="newBoatingModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="newBoatingModalLabel" aria-hidden="true">
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
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">OR Number</label>
                                <input type="text" name="ornumber" id="ornumber" class="form-control" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Owner of Boat</label>
                                <input type="text" name="owner_name" id="owner_name" class="form-control" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Name of Boat</label>
                                <input type="text" name="name_other" id="name_other" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Address</label>
                                <input type="text" name="address" id="address" class="form-control" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Expiration Date</label>
                                <input type="date" name="expiration" id="expiration" class="form-control" required>
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
