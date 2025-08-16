<script>
    let vendorOptions;
    let vendorTable;
    let vendorData = [];
    let selectedvendorId = null;

    vendorOptions = {
        processing: false,
        serverSide: true,
        // data:[],
        ajax: {
            url: "{{ route('getvendor') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
            },
            dataSrc: function(json) {
                vendorData = json.data;
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
                title: 'Owner of Vendor',
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
            appendButtonsvendor();
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };

    $(document).ready(function() {
        rendervendorTable();
    })

    function rendervendorTable() {
        if (vendorTable) {
            vendorTable.destroy();
        }
        vendorTable = new DataTable('#vendorTable', vendorOptions)
    }

    $(document).on("click", "#reloadvendorBtn", function() {
        reloadButtonLoading(true);
        reloadvendorTable();
        setTimeout(() => {
            reloadButtonLoading(false);
        }, 500);
    });

    function reloadvendorTable() {
        if (vendorTable) {
            vendorTable.ajax.reload(null, false);
        } else {
            rendervendorTable();
        }
    }

    function reloadvendorTableWithPagination() {
        if (vendorTable) {
            vendorTable.ajax.reload(null, true);
        } else {
            rendervendorTable();
        }
    }

    function appendButtonsvendor() {
        $('#vendorTable_wrapper .row .dt-length').append(`
            <div class="d-flex gap-2 ms-2 align-items-center vendorBtnSm">
                 <button class="btn btn-primary d-flex flex-nowrap align-items-center gap-2" id="">
                    <span>
                        <i class="bi bi-node-plus"></i>
                    </span>
                    Request Renew
                </button>
                <button class="btn btn-success d-flex flex-nowrap align-items-center gap-2" id="newvendorBtn">
                    <span>
                        <i class="bi bi-clipboard-plus"></i>
                    </span>
                    Add New
                </button>
                <button class="btn btn-info d-flex flex-nowrap align-items-center gap-2" id="editvendorBtn">
                    <span>
                        <i class="bi bi-pencil-square"></i>
                    </span>
                    Edit
                </button>
                <button class="btn btn-danger d-flex flex-nowrap align-items-center gap-2" id="deletevendorBtn">
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
                <button class="btn btn-info d-flex flex-nowrap align-items-center gap-2" id="reloadvendorBtn">
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
            $("#reloadvendorBtn").html(`
                    <div class="spinner-border text-white" role="status" style="width: 14px; height: 14px">
                </div>
                Reloading
            `);
        } else {
            $("#reloadvendorBtn").html(`
                <i class="bi bi-arrow-clockwise"></i>
                Reload
            `);
        }
    }


    $(document).on("click", ".removevendor", function() {
        let employee_id = $(this).data("employee_id");

        Swal.fire({
            title: "Warning",
            text: "Remove this vendor?",
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
                            reloadvendorTable();
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

    $(document).on('click', '#vendorTable tbody tr', function() {
        let data = vendorTable.row(this).data();
        if (!data) return;

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedvendorId = null;
        } else {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedvendorId = data.record_id; // vendor the ID
        }
    });

    // Revendor selection after reload
    vendorOptions.drawCallback = function(settings) {
        vendorTable.rows().every(function() {
            let data = this.data();
            if (data.record_id === selectedvendorId) {
                $(this.node()).addClass('selected');
            }
        });
    };
</script>
