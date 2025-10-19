@php
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
@endphp
<div class="modal fade" id="newwastebottleModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="newwastebottleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header position-relative d-flex justify-content-center align-items-center flex-column">
                <img class="mb-1" src="{{ asset('assets/images/logo.jpg') }}" style="height: 70px; width: 70px"
                    alt="">
                <div>
                    <p class="mb-0 text-center fw-semibold" style="color: #5D0900; font-size: 20px">
                        WASTE IN THE BOTTLE
                    </p>
                </div>
                <button type="button"
                    class="btn position-absolute rounded-circle d-flex justify-content-center align-items-center"
                    style="top: 5px; right: 5px; width: 40px; height: 40px" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg" style="font-size: 15px"></i>
                </button>
            </div>
            <form id="newwastebottleform">
                <input type="hidden" id="wastebottle_id" name="wastebottle_id" value="0">
                <div class="modal-body">
                    <div class="row mx-auto">
                        <div class="col-12">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Barangay</label>
                                <input type="text" name="brgy" id="brgy" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Municipality</label>
                                <input type="text" name="municipality" id="municipality" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Province</label>
                                <input type="text" name="province" id="province" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Purok</label>
                                <input type="text" name="purok" id="purok" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Bottle in Kg</label>
                                <input type="number" name="bottleinkg" id="bottleinkg" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Rice in Kg</label>
                                <input type="number" name="riceinkg" id="riceinkg" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Total Waste</label>
                                <input type="number" name="totalinrice" id="totalinrice" class="form-control" required
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary-new py-1">
                        <img src="{{ asset('assets/images/icons/Waste Bottle.png') }}" style="width: 30px; height:30px;"
                            alt="">
                        Add Waste
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
