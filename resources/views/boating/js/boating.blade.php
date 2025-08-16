<script>
    let boatingOptions;
    let boatingTable;
    let boatingData = [];
    let selectedboatingId = null;

    boatingOptions = {
        processing: false,
        serverSide: true,
        ajax: {
            url: "{{ route('getBoatings') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
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
                title: 'Date Created',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return formatDateToStr(row.created_at);
                }
            },
            {
                title: 'Owner of Boat',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return row.owner_name;
                }
            },
            {
                title: 'Address',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return row.address;
                }
            },
            {
                title: 'Expiration Date',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return formatDateToStr(row.expiration, false);
                }
            },
            {
                title: 'Permit Status',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return `<span class="${row.status == "ACTIVE" ? 'text-success': 'text-danger'} text-capitalize">${row.status ? row.status.toLowerCase() : ''}</span>`;
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

    $(document).on("click", "#reloadboatingBtn", function() {
        reloadButtonLoading(true);
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
            <div class="d-flex gap-2 ms-2 align-items-center boatingBtnSm">
                 <button class="btn btn-primary d-flex flex-nowrap align-items-center gap-2" id="">
                    <span>
                        <i class="bi bi-node-plus"></i>
                    </span>
                    Request Renew
                </button>
                <button class="btn btn-success d-flex flex-nowrap align-items-center gap-2" id="newboatingBtn">
                    <span>
                        <i class="bi bi-clipboard-plus"></i>
                    </span>
                    Add New
                </button>
                <button class="btn btn-info d-flex flex-nowrap align-items-center gap-2" id="editboatingBtn">
                    <span>
                        <i class="bi bi-pencil-square"></i>
                    </span>
                    Edit
                </button>
                <button class="btn btn-danger d-flex flex-nowrap align-items-center gap-2" id="deleteboatingBtn">
                    <span>
                        <i class="ti ti-trash"></i>
                    </span>
                    Delete
                </button>
                <button class="btn btn-primary d-flex flex-nowrap align-items-center gap-2" id="">
                    <span>
                        <i class="bi bi-share"></i>
                    </span>
                    Share
                </button>
                <button class="btn btn-info d-flex flex-nowrap align-items-center gap-2" id="reloadboatingBtn">
                    <span>
                        <i class="bi bi-arrow-clockwise"></i>
                    </span>
                    Reload
                </button>
               
            </div>
        `);
    }

    function reloadButtonLoading(isLoading) {
        if (isLoading) {
            $("#reloadboatingBtn").html(`
                    <div class="spinner-border text-white" role="status" style="width: 14px; height: 14px">
                </div>
                Reloading
            `);
        } else {
            $("#reloadboatingBtn").html(`
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
</script>
