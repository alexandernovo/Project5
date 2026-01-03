@php
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
@endphp
<div class="modal fade" id="newwastecollectModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="newwastecollectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 500px">
        <div class="modal-content">
            <div class="modal-header position-relative d-flex justify-content-center align-items-center flex-column">
                <img class="mb-1" src="{{ asset('assets/images/logo.jpg') }}" style="height: 70px; width: 70px"
                    alt="">
                <div>
                    <p class="mb-0 text-center fw-semibold" style="color: #5D0900; font-size: 20px">
                        WASTE COLLECTION
                    </p>
                </div>
                <button type="button"
                    class="btn position-absolute rounded-circle d-flex justify-content-center align-items-center"
                    style="top: 5px; right: 5px; width: 40px; height: 40px" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg" style="font-size: 15px"></i>
                </button>
            </div>
            <form id="newwastecollectform">
                <input type="hidden" id="wastecollect_id" name="wastecollect_id" value="0">
                <div class="modal-body">
                    <div class="row mx-auto">
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Barangay</label>
                                 <select class="form-select" name="barangay" id="barangay" required>
                                    <option value="" disabled selected>Barangay</option>
                                    @foreach ($barangays_global as $brgy)
                                        <option>{{ $brgy }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group mb-1">
                                <label for="" class="mb-1">Schedule From</label>
                                <select name="schedule_from" id="schedule_from" class="form-select" required>
                                    @foreach ($days as $d)
                                        <option value="{{ $d }}">{{ $d }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Schedule To</label>
                                <select name="schedule_to" id="schedule_to" class="form-select" required>
                                    @foreach ($days as $d)
                                        <option value="{{ $d }}">{{ $d }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Municipality</label>
                                <input type="text" name="municipality" id="municipality" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Province</label>
                                <input type="text" name="province" id="province" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Purok</label>
                                <input type="text" name="purok" id="purok" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12 mb-1">
                            <p class="mb-0 fw-semibold">SOLID WASTE MANAGEMENT</p>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Biodegradable</label>
                                <input type="number" step="0.01" min="0" name="biodegradable"
                                    id="biodegradable" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Non-Biodegradable</label>
                                <input type="number" step="0.01" min="0" name="nonbio" id="nonbio"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Recyclable</label>
                                <input type="number" step="0.01" min="0" name="recyclable" id="recyclable"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Special Waste</label>
                                <input type="number" step="0.01" min="0" name="specialwaste"
                                    id="specialwaste" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group mb-1">
                                <label for="" class="mb-1">Total Waste</label>
                                <input type="number" step="0.01" min="0" id="total"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary-new" id="wasteCollectionSubmit">Add Waste
                        Collection</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
