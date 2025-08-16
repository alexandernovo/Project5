<script>
    let tricycleOptions;
    let tricycleTable;
    let tricycleData = [];
    let selectedtricycleId = null;

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
            },
            dataSrc: function(json) {
                tricycleData = json.data;
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
                title: 'Owner of Tricycle',
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
                 <button class="btn btn-primary d-flex flex-nowrap align-items-center gap-2" id="">
                    <span>
                        <i class="bi bi-node-plus"></i>
                    </span>
                    Request Renew
                </button>
                <button class="btn btn-success d-flex flex-nowrap align-items-center gap-2" id="newtricycleBtn">
                    <span>
                        <i class="bi bi-clipboard-plus"></i>
                    </span>
                    Add New
                </button>
                <button class="btn btn-info d-flex flex-nowrap align-items-center gap-2" id="edittricycleBtn">
                    <span>
                        <i class="bi bi-pencil-square"></i>
                    </span>
                    Edit
                </button>
                <button class="btn btn-danger d-flex flex-nowrap align-items-center gap-2" id="deletetricycleBtn">
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
                <button class="btn btn-info d-flex flex-nowrap align-items-center gap-2" id="reloadtricycleBtn">
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
            $("#reloadtricycleBtn").html(`
                    <div class="spinner-border text-white" role="status" style="width: 14px; height: 14px">
                </div>
                Reloading
            `);
        } else {
            $("#reloadtricycleBtn").html(`
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
</script>
