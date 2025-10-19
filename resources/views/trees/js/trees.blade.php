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
                title: 'Owner of Trees',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.name_other;
                }
            },
            {
                title: 'Lot No.',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.lot_no;
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
