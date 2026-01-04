<div class="modal fade" id="certificationModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="certificationModalLabel" aria-hidden="true">
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
                <form id="certification_report_select">
                    <div class="form-group mt-2">
                        <label for="" class="mb-1">Certification Report Type:</label>
                        <select id="typecertification" class="form-select" required>
                            <option value="" disabled selected>Please Select</option>
                            <option value="Association">Association</option>
                            <option value="Boating">Boating</option>
                            <option value="Chainsaw">Chainsaw</option>
                            <option value="Trees">Cutting Trees</option>
                            <option value="Store">Sari-Sari Store</option>
                            <option value="Tricycle">Tricycle</option>
                            <option value="Vendors">Vendors</option>
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <label for="" class="mb-1">Select Month:</label>
                        <input type="month" id="month_certification" class="form-control" required>
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
