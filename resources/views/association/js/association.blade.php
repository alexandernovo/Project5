<script>
    let associationOptions;
    let associationTable;
    let associationData = [];

    associationOptions = {
        processing: false,
        serverSide: false,
        data: [],
        // ajax: {
        //     url: "",
        //     type: 'POST',
        //     dataType: 'json',
        //     data: function(d) {
        //         d._token = '{{ csrf_token() }}';
        //         d.sectionCodeFilter = sectionCodeFilter;
        //     },
        //     dataSrc: function(json) {
        //         associationData = json.data;
        //         return json.data;
        //     }
        // },
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
                    return ``;
                }
            },
            {
                title: 'Owner of Association',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return '';
                }
            },
            {
                title: 'Address',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return ``;
                }
            },
            {
                title: 'Permit Status',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return ``;
                }
            }
        ],
        initComplete: function(settings, json) {
            appendButtonsassociation();
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };

    $(document).ready(function() {
        console.log("hello")
        renderassociationTable();
    })

    function renderassociationTable() {
        if (associationTable) {
            associationTable.destroy();
        }
        associationTable = new DataTable('#associationTable', associationOptions)
    }

    $(document).on("click", "#reloadassociationBtn", function() {
        reloadButtonLoading(true);
        reloadassociationTable();
        setTimeout(() => {
            reloadButtonLoading(false);
        }, 500);
    });

    function reloadassociationTable() {
        if (associationTable) {
            associationTable.ajax.reload(null, false);
        } else {
            renderassociationTable();
        }
    }

    function reloadassociationTableWithPagination() {
        if (associationTable) {
            associationTable.ajax.reload(null, true);
        } else {
            renderassociationTable();
        }
    }

    function appendButtonsassociation() {
        $('#associationTable_wrapper .row .dt-length').append(`
            <div class="d-flex gap-2 ms-2 align-items-center associationBtnSm">
                 <button class="btn btn-primary d-flex flex-nowrap align-items-center gap-2" id="reloadassociationBtn">
                    <span>
                        <i class="bi bi-node-plus"></i>
                    </span>
                    Request Renew
                </button>
                <button class="btn btn-success d-flex flex-nowrap align-items-center gap-2" id="associationBTN">
                    <span>
                        <i class="bi bi-clipboard-plus"></i>
                    </span>
                    Add New
                </button>
                <button class="btn btn-danger d-flex flex-nowrap align-items-center gap-2" id="associationBTN">
                    <span>
                        <i class="ti ti-trash"></i>
                    </span>
                    Delete
                </button>
                <button class="btn btn-primary d-flex flex-nowrap align-items-center gap-2" id="associationBTN">
                    <span>
                        <i class="bi bi-share"></i>
                    </span>
                    Share
                </button>
                <button class="btn btn-info d-flex flex-nowrap align-items-center gap-2" id="reloadassociationBtn">
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
            $("#reloadassociationBtn").html(`
                    <div class="spinner-border text-white" role="status" style="width: 14px; height: 14px">
                </div>
                Reloading
            `);
        } else {
            $("#reloadassociationBtn").html(`
                <i class="bi bi-arrow-clockwise"></i>
                Reload
            `);
        }
    }


    $(document).on("click", ".removeassociation", function() {
        let employee_id = $(this).data("employee_id");

        Swal.fire({
            title: "Warning",
            text: "Remove this association?",
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
                            reloadassociationTable();
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
</script>
