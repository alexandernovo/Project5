@php
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
@endphp
<div class="modal fade" id="newwastebottleModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="newwastebottleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 ms-2">
                    <span>
                        <i class="ti ti-user-plus" style="font-size: 20px"></i>
                    </span>
                    <span id="newwastebottleModalLabel">
                        New Waste Bottle
                    </span>
                </h1>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg" style="font-size: 15px"></i>
                </button>
            </div>
            <form id="newwastebottleform">
                <input type="hidden" id="wastebottle_id" name="wastebottle_id" value="0">
                <div class="modal-body">
                    <div class="row mx-auto">
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Resident Name</label>
                                <input type="text" name="resident_name" id="resident_name" class="form-control" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Bottle Kg</label>
                                <input type="number" name="bottle_kg" id="bottle_kg" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Rice Kg</label>
                                <input type="number" name="rice_kg" id="rice_kg" class="form-control" required>
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
