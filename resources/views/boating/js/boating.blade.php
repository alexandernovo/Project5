<script>
    let boatingOptions;
    let boatingTable;
    let boatingData = [];
    let selectedboatingId = null;
    let dateFrom = "";
    let dateTo = "";

    boatingOptions = {
        processing: false,
        serverSide: true,
        ajax: {
            url: "{{ route('getBoatings') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFrom;
                d.dateTo = dateTo;
            },
            dataSrc: function(json) {
                boatingData = json.data;
                return json.data;
            }
        },
        columns: [{
                title: 'No.',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                title: 'Owner',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return row.owner_name;
                }
            },
            {
                title: 'OR Number',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return row.ornumber;
                }
            },
            {
                title: 'Name of  Activities',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return row.nameactivities;;
                }
            },
            {
                title: 'Date of Activities',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return formatDateToStr(row.dateactivities, false);
                }
            },
            // {
            //     title: 'Name of Boat',
            //     className: 'text-nowrap p-3',
            //     render: function(data, type, row) {
            //         return row.name_other;
            //     }
            // },
            {
                title: 'Address',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return row.address;
                }
            },
            {
                title: 'Sex',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return row.sex;
                }
            },
            {
                title: 'Contact No.',
                className: 'text-nowrap text-start p-3',
                render: function(data, type, row) {
                    return row.contact_no;
                }
            },
            {
                title: 'Date Created',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return formatDateToStr(row.created_at, false);
                }
            },
            {
                title: 'Action',
                className: 'text-nowrap p-2 text-center align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                        <div class="d-flex gap-2 text-center justify-content-center align-items-center px-3">
                            <button class="btn btn-warning editButton px-2" data-record_id="${row.record_id}"><i class="bi bi-pencil-fill"></i></button>
                            <a href="{{ route('printBoating') }}?record_id=${row.record_id}" onclick="event.stopPropagation();"  class="btn btn-secondary-new-2 px-2"><i class="bi bi-printer"></i></a>
                            <button class="btn btn-red deleteButton px-2" data-record_id="${row.record_id}"><i class="bi bi-trash3"></i></button>
                        </div>
                    `;
                }
            }
        ],
        initComplete: function(settings, json) {
            appendButtonsboating();
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };

    $(document).ready(function() {
        console.log("hello")
        renderboatingTable();
    })

    function renderboatingTable() {
        if (boatingTable) {
            boatingTable.destroy();
        }
        boatingTable = new DataTable('#boatingTable', boatingOptions)
    }

    $(document).on("click", "#reloadButton", function() {
        reloadButtonLoading(true);
        resetDate();
        reloadboatingTable();
        setTimeout(() => {
            reloadButtonLoading(false);
        }, 500);
    });

    function reloadboatingTable() {
        if (boatingTable) {
            boatingTable.ajax.reload(null, false);
        } else {
            renderboatingTable();
        }
    }

    function reloadboatingTableWithPagination() {
        if (boatingTable) {
            boatingTable.ajax.reload(null, true);
        } else {
            renderboatingTable();
        }
    }

    function appendButtonsboating() {
        $('#boatingTable_wrapper .row .dt-length').append(`
            <div class="d-flex gap-2 text-center ms-2 align-items-center associationBtnSm">
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


    $(document).on("click", ".removeboating", function() {
        let employee_id = $(this).data("employee_id");

        Swal.fire({
            title: "Warning",
            text: "Remove this boating?",
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
                            reloadboatingTable();
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

    $(document).on('click', '#boatingTable tbody tr', function() {
        let data = boatingTable.row(this).data();
        if (!data) return;

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedboatingId = null;
        } else {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedboatingId = data.record_id; // store the ID
        }
    });

    // Restore selection after reload
    boatingOptions.drawCallback = function(settings) {
        boatingTable.rows().every(function() {
            let data = this.data();
            if (data.record_id === selectedboatingId) {
                $(this.node()).addClass('selected');
            }
        });
    };

    $(document).on('click', '#filterDateBtn', function() {
        dateFrom = $("#dateFromFilter").val();
        dateTo = $("#dateToFilter").val();
        boatingOptions.ajax.data.dateFrom = dateFrom;
        boatingOptions.ajax.data.dateTo = dateTo;
        reloadboatingTableWithPagination();
    });

    function resetDate() {
        dateFrom = "";
        dateTo = "";

        boatingOptions.ajax.data.dateFrom = dateFrom;
        boatingOptions.ajax.data.dateTo = dateTo;
    }
</script>
