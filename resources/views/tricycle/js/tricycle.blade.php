<script>
    let tricycleOptions;
    let tricycleTable;
    let tricycleData = [];
    let selectedtricycleId = null;
    let dateFrom = "";
    let dateTo = "";

    tricycleOptions = {
        processing: false,
        serverSide: true,
        // data:[],
        ajax: {
            url: "{{ route('gettricycle') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFrom;
                d.dateTo = dateTo;
            },
            dataSrc: function(json) {
                tricycleData = json.data;
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
                title: 'Name of Tricycle',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.name_other;
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
                    return formatDateToStr(row.expiration, false);
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
            appendButtonstricycle();
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };

    $(document).ready(function() {
        rendertricycleTable();
    })

    function rendertricycleTable() {
        if (tricycleTable) {
            tricycleTable.destroy();
        }
        tricycleTable = new DataTable('#tricycleTable', tricycleOptions)
    }

    $(document).on("click", "#reloadtricycleBtn", function() {
        reloadButtonLoading(true);
        resetDate();
        reloadtricycleTable();
        setTimeout(() => {
            reloadButtonLoading(false);
        }, 500);
    });

    function reloadtricycleTable() {
        if (tricycleTable) {
            tricycleTable.ajax.reload(null, false);
        } else {
            rendertricycleTable();
        }
    }

    function reloadtricycleTableWithPagination() {
        if (tricycleTable) {
            tricycleTable.ajax.reload(null, true);
        } else {
            rendertricycleTable();
        }
    }

    function appendButtonstricycle() {
        $('#tricycleTable_wrapper .row .dt-length').append(`
            <div class="d-flex gap-2 ms-2 align-items-center tricycleBtnSm">
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
            $("#reloadButton").html(`
                    <div class="spinner-border text-white" role="status" style="width: 14px; height: 14px">
                </div>
                Reloading
            `);
        } else {
            $("#reloadButton").html(`
                <i class="bi bi-arrow-clockwise"></i>
                Reload
            `);
        }
    }


    $(document).on("click", ".removetricycle", function() {
        let employee_id = $(this).data("employee_id");

        Swal.fire({
            title: "Warning",
            text: "Remove this tricycle?",
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
                            reloadtricycleTable();
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

    $(document).on('click', '#tricycleTable tbody tr', function() {
        let data = tricycleTable.row(this).data();
        if (!data) return;

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedtricycleId = null;
        } else {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedtricycleId = data.record_id; // tricycle the ID
        }
    });

    // Retricycle selection after reload
    tricycleOptions.drawCallback = function(settings) {
        tricycleTable.rows().every(function() {
            let data = this.data();
            if (data.record_id === selectedtricycleId) {
                $(this.node()).addClass('selected');
            }
        });
    };

    $(document).on('click', '#filterDateBtn', function() {
        dateFrom = $("#dateFromFilter").val();
        dateTo = $("#dateToFilter").val();
        tricycleOptions.ajax.data.dateFrom = dateFrom;
        tricycleOptions.ajax.data.dateTo = dateTo;
        reloadtricycleTableWithPagination();
    });

    function resetDate() {
        dateFrom = "";
        dateTo = "";

        tricycleOptions.ajax.data.dateFrom = dateFrom;
        tricycleOptions.ajax.data.dateTo = dateTo;
    }
</script>
