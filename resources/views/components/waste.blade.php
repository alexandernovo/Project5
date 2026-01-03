<div class="modal fade" id="wasteModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="wasteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 450px">
        <div class="modal-content">
            <div class="modal-header position-relative d-flex justify-content-center align-items-center flex-column"
                style="border-bottom: 2px solid lightgray">
                <img class="mb-1" src="{{ asset('assets/images/logo.jpg') }}" style="height: 70px; width: 70px"
                    alt="">
                <div>
                    <p class="mb-0 text-center fw-semibold mt-2" style="color: #5D0900; font-size: 19px">
                        MUNICIPAL ENVIRONMENT & NATURAL RESOURCE OFFICE
                    </p>
                </div>
                <button type="button"
                    class="btn position-absolute rounded-circle d-flex justify-content-center align-items-center"
                    style="top: 5px; right: 5px; width: 40px; height: 40px" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg" style="font-size: 15px"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="waste_report_select">
                    <div class="form-group mt-2">
                        <label for="" class="mb-1">Waste Report Type:</label>
                        <select id="type_waste" class="form-select" required>
                            <option value="" disabled selected>Please Select</option>
                            <option value="Collection">Waste Collection</option>
                            <option value="Bottle">Waste in the Bottle</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="" class="mb-1">Category:</label>
                        <select id="category_waste" class="form-select" required>
                            <option value="" disabled selected>Please Select</option>
                            <option value="Barangay">Per Barangay</option>
                            <option value="Overall">Overall Barangay</option>
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <label for="" class="mb-1">Select Barangay:</label>
                        <select class="form-select" id="barangay_waste" disabled>
                            <option value="" disabled selected>Barangay</option>
                            @foreach ($barangays_global as $brgy)
                                <option>{{ $brgy }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <label for="" class="mb-1">Select Month:</label>
                        <input type="month" id="month_waste" class="form-control" required>
                    </div>

                    <div class="mt-4 mb-4">
                        <button class="btn btn-primary-new w-100">
                            View Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
