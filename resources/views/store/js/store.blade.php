<script>
    let storeOptions;
    let storeTable;
    let storeData = [];
    let selectedstoreId = null;
    let dateFrom = "";
    let dateTo = "";

    storeOptions = {
        processing: false,
        serverSide: true,
        // data:[],
        ajax: {
            url: "{{ route('getstore') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFrom;
                d.dateTo = dateTo;
            },
            dataSrc: function(json) {
                storeData = json.data;
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
                title: 'Name of Store',
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
                title: 'Status',
                className: 'text-nowrap p-2 text-center  align-middle text-center',
                render: function(data, type, row) {
                    return renderExpirationStatus(row.record_status, row.expiration);
                }
            },
            {
                title: 'Date of Renewed',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return formatDateToStr(row.expiration, false);
                }
            },
            {
                title: 'Date of Expired',
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
                            <button class="btn d-flex justify-content-center align-items-center btn-blue expRenButton" style="width: 90px" data-record_id="${row.record_id}">Renew</button>
                            <a href="{{ route('printStore') }}?record_id=${row.record_id}" onclick="event.stopPropagation();"  class="btn btn-secondary-new-2 px-2"><i class="bi bi-printer"></i></a>
                            <button class="btn btn-warning editButton px-2" data-record_id="${row.record_id}"><i class="bi bi-pencil-fill"></i></button>
                            <button class="btn btn-red deleteButton px-2" data-record_id="${row.record_id}"><i class="bi bi-trash3"></i></button>
                        </div>
                    `;
                }
            },

        ],
        initComplete: function(settings, json) {
            appendButtonsstore();
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };

    $(document).ready(function() {
        renderstoreTable();
    })

    function renderstoreTable() {
        if (storeTable) {
            storeTable.destroy();
        }
        storeTable = new DataTable('#storeTable', storeOptions)
    }

    $(document).on("click", "#reloadButton", function() {
        reloadButtonLoading(true);
        resetDate();
        reloadstoreTable();
        setTimeout(() => {
            reloadButtonLoading(false);
        }, 500);
    });

    function reloadstoreTable() {
        if (storeTable) {
            storeTable.ajax.reload(null, false);
        } else {
            renderstoreTable();
        }
    }

    function reloadstoreTableWithPagination() {
        if (storeTable) {
            storeTable.ajax.reload(null, true);
        } else {
            renderstoreTable();
        }
    }

    function appendButtonsstore() {
        $('#storeTable_wrapper .row .dt-length').append(`
            <div class="d-flex gap-2 ms-2 align-items-center storeBtnSm">
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


    $(document).on("click", ".removestore", function() {
        let employee_id = $(this).data("employee_id");

        Swal.fire({
            title: "Warning",
            text: "Remove this store?",
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
                            reloadstoreTable();
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

    $(document).on('click', '#storeTable tbody tr', function() {
        let data = storeTable.row(this).data();
        if (!data) return;

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedstoreId = null;
        } else {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedstoreId = data.record_id; // store the ID
        }
    });

    // Restore selection after reload
    storeOptions.drawCallback = function(settings) {
        storeTable.rows().every(function() {
            let data = this.data();
            if (data.record_id === selectedstoreId) {
                $(this.node()).addClass('selected');
            }
        });
    };

    $(document).on('click', '#filterDateBtn', function() {
        dateFrom = $("#dateFromFilter").val();
        dateTo = $("#dateToFilter").val();
        storeOptions.ajax.data.dateFrom = dateFrom;
        storeOptions.ajax.data.dateTo = dateTo;
        reloadstoreTableWithPagination();
    });

    function resetDate() {
        dateFrom = "";
        dateTo = "";

        storeOptions.ajax.data.dateFrom = dateFrom;
        storeOptions.ajax.data.dateTo = dateTo;
    }

    $(document).on("click", ".expRenButton", function(e) {
        e.stopPropagation();

        let record_id = $(this).data('record_id');
        let data = storeData.find(x => x.record_id == record_id);
        let message = "";
        let buttonConfirm = ""

        if (data) {
            message = 'Renew this Sari-Sari Store?';
            buttonConfirm = 'Renew';

            Swal.fire({
                title: "Warning",
                text: message,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: buttonConfirm
            }).then((result) => {
                if (result.isConfirmed) {
                    postRequest("{{ route('expireRenew') }}", {
                        record_id: data.record_id,
                        record_status: data.record_status,
                    }, (response) => {
                        if (response.status == "success") {
                            reloadstoreTable();
                            Swal.fire({
                                title: "Success",
                                text: response.message,
                                icon: "success",
                                showCancelButton: false,
                            })
                        }
                    })
                }
            });
        }
    })
</script>
