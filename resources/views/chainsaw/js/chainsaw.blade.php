<script>
    let chainsawOptions;
    let chainsawTable;
    let chainsawData = [];
    let selectedchainsawId = null;
    let dateFrom = "";
    let dateTo = "";

    chainsawOptions = {
        processing: false,
        serverSide: true,
        // data:[],
        ajax: {
            url: "{{ route('getchainsaws') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFrom;
                d.dateTo = dateTo;
            },
            dataSrc: function(json) {
                chainsawData = json.data;
                return json.data;
            }
        },
        columns: [{
                title: 'No.',
                className: 'text-nowrap p-2 text-center align-middle',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                title: 'Owner',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.owner_name;
                }
            },
            {
                title: 'OR No.',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.ornumber;
                }
            },
            {
                title: 'Brand',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.brand;
                }
            },
            {
                title: 'Model No.',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.model_no;
                }
            },
            {
                title: 'Serial No.',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.serial_no;
                }
            },
            {
                title: 'Address',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.address;
                }
            },
            {
                title: 'Sex',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.sex;
                }
            },
            {
                title: 'Contact No.',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.contact_no;
                }
            },
            {
                title: 'Date Created',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return formatDateToStr(row.created_at);
                }
            },
            {
                title: 'Renewal Status',
                className: 'text-nowrap p-2 text-center  align-middle text-center',
                render: function(data, type, row) {
                    return renderExpirationStatus(row.expiration);
                }
            },
            {
                title: 'Date of Renewal',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return formatDateToStr(row.date_renewal, false);
                }
            },
            {
                title: 'Date of Expiration',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return formatDateToStr(row.expiration, false);
                }
            },
            {
                title: 'Action',
                className: 'text-nowrap p-2 text-center  align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                        <div class="d-flex gap-2 text-center align-items-center">
                            <button class="btn btn-warning editButton" data-record_id="${row.record_id}">Edit</button>
                            <button class="btn btn-secondary-new deleteButton" data-record_id="${row.record_id}">Delete</button>
                        </div>
                    `;
                }
            },

        ],
        initComplete: function(settings, json) {
            appendButtonschainsaw();
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };

    $(document).ready(function() {
        renderChainsawTable();
    })

    function renderChainsawTable() {
        if (chainsawTable) {
            chainsawTable.destroy();
        }
        chainsawTable = new DataTable('#chainsawTable', chainsawOptions)
    }

    $(document).on("click", "#reloadchainsawBtn", function() {
        reloadButtonLoading(true);
        resetDate();
        reloadChainsawTable();
        setTimeout(() => {
            reloadButtonLoading(false);
        }, 500);
    });

    function reloadChainsawTable() {
        if (chainsawTable) {
            chainsawTable.ajax.reload(null, false);
        } else {
            renderChainsawTable();
        }
    }

    function reloadChainsawTableWithPagination() {
        if (chainsawTable) {
            chainsawTable.ajax.reload(null, true);
        } else {
            renderChainsawTable();
        }
    }

    function appendButtonschainsaw() {
        $('#chainsawTable_wrapper .row .dt-length').append(`
            <div class="d-flex gap-2 ms-2 align-items-center chainsawBtnSm">
                    <div class="d-flex">
                    <div class="input-group" style="width: 120%">
                        <span  style="border: 1px solid #EAEFF4 !important" class="input-group-text filter-padding">From:</span>
                        <input type="date" id="dateFromFilter" value="{{ date('Y-m-d') }}" class="form-control filter-padding rounded-end-0 border-end-0">
                    </div>
                    <div class="input-group" style="width: 110%">
                        <span  style="border: 1px solid #EAEFF4 !important" class="input-group-text rounded-start-0 filter-padding">To:</span>
                        <input type="date" id="dateToFilter" value="{{ date('Y-m-d') }}" class="form-control filter-padding rounded-end-0 border-end-0">
                    </div>
                    <button data-bs-toggle="tooltip" data-bs-title="Filter by Date & Time of Incident" type="button" id="filterDateBtn" class="btn btn-secondary-new filter-padding d-flex gap-1 align-items-center border-1 rounded-start-0 position-relative">
                        <i class="bi bi-funnel-fill"></i>
                        Filter
                    </button>
                </div>
            </div>
        `);
    }

    function reloadButtonLoading(isLoading) {
        if (isLoading) {
            $("#reloadchainsawBtn").html(`
                    <div class="spinner-border text-white" role="status" style="width: 14px; height: 14px">
                </div>
                Reloading
            `);
        } else {
            $("#reloadchainsawBtn").html(`
                <i class="bi bi-arrow-clockwise"></i>
                Reload
            `);
        }
    }


    $(document).on("click", ".removechainsaw", function() {
        let employee_id = $(this).data("employee_id");

        Swal.fire({
            title: "Warning",
            text: "Remove this chainsaw?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Remove'
        }).then((result) => {
            if (result.isConfirmed) {
                postRequest("", {
                    employee_id: employee_id
                }, (response) => {
                    if (response.status == "success") {
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: "success",
                            allowOutsideClick: false
                        }).then((result) => {
                            reloadChainsawTable();
                        });
                    } else {
                        Swal.fire({
                            title: "Failed",
                            text: "Something's wrong, Please try again later.",
                            icon: "error"
                        })
                    }
                })
            }
        });
    });

    $(document).on('click', '#chainsawTable tbody tr', function() {
        let data = chainsawTable.row(this).data();
        if (!data) return;

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedchainsawId = null;
        } else {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedchainsawId = data.record_id; // store the ID
        }
    });

    $(document).on('click', '#filterDateBtn', function() {
        dateFrom = $("#dateFromFilter").val();
        dateTo = $("#dateToFilter").val();
        chainsawOptions.ajax.data.dateFrom = dateFrom;
        chainsawOptions.ajax.data.dateTo = dateTo;
        reloadChainsawTableWithPagination();
    });

    function resetDate() {
        dateFrom = "";
        dateTo = "";

        chainsawOptions.ajax.data.dateFrom = dateFrom;
        chainsawOptions.ajax.data.dateTo = dateTo;
    }
    // Restore selection after reload
    chainsawOptions.drawCallback = function(settings) {
        chainsawTable.rows().every(function() {
            let data = this.data();
            if (data.record_id === selectedchainsawId) {
                $(this.node()).addClass('selected');
            }
        });
    };
</script>
