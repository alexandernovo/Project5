<script>
    let wastebottleOptions;
    let wastebottleTable;
    let wastebottleData = [];
    let selectedwastebottleId = null;

    wastebottleOptions = {
        processing: false,
        serverSide: true,
        // data:[],
        ajax: {
            url: "{{ route('getwastebottle') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
            },
            dataSrc: function(json) {
                wastebottleData = json.data;
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
                title: 'Resident Name',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return row.resident_name;
                }
            },
            {
                title: 'Bottle Kg',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return row.bottle_kg;
                }
            },
            {
                title: 'Rice Kg',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return row.rice_kg;
                }
            },
            {
                title: 'Total',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return row.total
                }
            }
        ],
        initComplete: function(settings, json) {
            appendButtonswastebottle();
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };

    $(document).ready(function() {
        renderwastebottleTable();
    })

    function renderwastebottleTable() {
        if (wastebottleTable) {
            wastebottleTable.destroy();
        }
        wastebottleTable = new DataTable('#wastebottleTable', wastebottleOptions)
    }

    $(document).on("click", "#reloadwastebottleBtn", function() {
        reloadButtonLoading(true);
        reloadwastebottleTable();
        setTimeout(() => {
            reloadButtonLoading(false);
        }, 500);
    });

    function reloadwastebottleTable() {
        if (wastebottleTable) {
            wastebottleTable.ajax.reload(null, false);
        } else {
            renderwastebottleTable();
        }
    }

    function reloadwastebottleTableWithPagination() {
        if (wastebottleTable) {
            wastebottleTable.ajax.reload(null, true);
        } else {
            renderwastebottleTable();
        }
    }

    function appendButtonswastebottle() {
        $('#wastebottleTable_wrapper .row .dt-length').append(`
            <div class="d-flex gap-2 ms-2 align-items-center wastebottleBtnSm">
                <button class="btn btn-success d-flex flex-nowrap align-items-center gap-2" id="newwastebottleBtn">
                    <span>
                        <i class="bi bi-clipboard-plus"></i>
                    </span>
                    Add New
                </button>
                <button class="btn btn-info d-flex flex-nowrap align-items-center gap-2" id="editwastebottleBtn">
                    <span>
                        <i class="bi bi-pencil-square"></i>
                    </span>
                    Edit
                </button>
                <button class="btn btn-danger d-flex flex-nowrap align-items-center gap-2" id="deletewastebottleBtn">
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
                <button class="btn btn-info d-flex flex-nowrap align-items-center gap-2" id="reloadwastebottleBtn">
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
            $("#reloadwastebottleBtn").html(`
                    <div class="spinner-border text-white" role="status" style="width: 14px; height: 14px">
                </div>
                Reloading
            `);
        } else {
            $("#reloadwastebottleBtn").html(`
                <i class="bi bi-arrow-clockwise"></i>
                Reload
            `);
        }
    }

    $(document).on('click', '#wastebottleTable tbody tr', function() {
        let data = wastebottleTable.row(this).data();
        if (!data) return;

        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            selectedwastebottleId = null;
        } else {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            selectedwastebottleId = data.record_id; // wastebottle the ID
        }
    });

    // Rewastebottle selection after reload
    wastebottleOptions.drawCallback = function(settings) {
        wastebottleTable.rows().every(function() {
            let data = this.data();
            if (data.record_id === selectedwastebottleId) {
                $(this.node()).addClass('selected');
            }
        });
    };
</script>
