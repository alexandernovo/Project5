<script>
    let treesOptions;
    let treesTable;
    let treesData = [];
    let selectedtreesId = null;

    treesOptions = {
        processing: false,
        serverSide: true,
        // data:[],
        ajax: {
            url: "{{ route('gettrees') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
            },
            dataSrc: function(json) {
                treesData = json.data;
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
                title: 'Owner of Trees',
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
            appendButtonstrees();
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };

    $(document).ready(function() {
        rendertreesTable();
    })

    function rendertreesTable() {
        if (treesTable) {
            treesTable.destroy();
        }
        treesTable = new DataTable('#treesTable', treesOptions)
    }

    $(document).on("click", "#reloadtreesBtn", function() {
        reloadButtonLoading(true);
        reloadtreesTable();
        setTimeout(() => {
            reloadButtonLoading(false);
        }, 500);
    });

    function reloadtreesTable() {
        if (treesTable) {
            treesTable.ajax.reload(null, false);
        } else {
            rendertreesTable();
        }
    }

    function reloadtreesTableWithPagination() {
        if (treesTable) {
            treesTable.ajax.reload(null, true);
        } else {
            rendertreesTable();
        }
    }

    function appendButtonstrees() {
        $('#treesTable_wrapper .row .dt-length').append(`
            <div class="d-flex gap-2 ms-2 align-items-center treesBtnSm">
                 <button class="btn btn-primary d-flex flex-nowrap align-items-center gap-2" id="">
                    <span>
                        <i class="bi bi-node-plus"></i>
                    </span>
                    Request Renew
                </button>
                <button class="btn btn-success d-flex flex-nowrap align-items-center gap-2" id="newtreesBtn">
                    <span>
                        <i class="bi bi-clipboard-plus"></i>
                    </span>
                    Add New
                </button>
                <button class="btn btn-info d-flex flex-nowrap align-items-center gap-2" id="edittreesBtn">
                    <span>
                        <i class="bi bi-pencil-square"></i>
                    </span>
                    Edit
                </button>
                <button class="btn btn-danger d-flex flex-nowrap align-items-center gap-2" id="deletetreesBtn">
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
                <button class="btn btn-info d-flex flex-nowrap align-items-center gap-2" id="reloadtreesBtn">
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
            $("#reloadtreesBtn").html(`
                    <div class="spinner-border text-white" role="status" style="width: 14px; height: 14px">
                </div>
                Reloading
            `);
        } else {
            $("#reloadtreesBtn").html(`
                <i class="bi bi-arrow-clockwise"></i>
                Reload
            `);
        }
    }


    $(document).on("click", ".removetrees", function() {
        let employee_id = $(this).data("employee_id");

        Swal.fire({
            title: "Warning",
            text: "Remove this trees?",
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
                            reloadtreesTable();
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

    $(document).on('click', '#treesTable tbody tr', function() {
        let data = treesTable.row(this).data();
        if (!data) return;

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedtreesId = null;
        } else {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedtreesId = data.record_id; // store the ID
        }
    });

    // Restore selection after reload
    treesOptions.drawCallback = function(settings) {
        treesTable.rows().every(function() {
            let data = this.data();
            if (data.record_id === selectedtreesId) {
                $(this.node()).addClass('selected');
            }
        });
    };
</script>
