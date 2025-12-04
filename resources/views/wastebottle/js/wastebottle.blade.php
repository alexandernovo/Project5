<script>
    let wastebottleOptions;
    let wastebottleTable;
    let wastebottleData = [];
    let selectedwastebottleId = null;
    let dateFrom = "";
    let dateTo = "";

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
                d.dateFrom = dateFrom;
                d.dateTo = dateTo;
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
                title: 'Barangay',
                data: 'brgy',
                className: 'text-nowrap p-3',
                render: function(data) {
                    return data ?? '';
                }
            },
            {
                title: 'Municipality',
                data: 'municipality',
                className: 'text-nowrap p-3',
                render: function(data) {
                    return data ?? '';
                }
            },
            {
                title: 'Province',
                data: 'province',
                className: 'text-nowrap p-3 text-center',
                render: function(data) {
                    return data ?? '';
                }
            },
            {
                title: 'Purok',
                data: 'purok',
                className: 'text-nowrap p-3 text-center',
                render: function(data) {
                    return data ?? '';
                }
            },
            {
                title: 'Bottle in Kg',
                data: 'bottleinkg',
                className: 'text-nowrap p-3 text-center',
                render: function(data) {
                    return data ?? 0;
                }
            },
            {
                title: 'Rice in Kg',
                data: 'riceinkg',
                className: 'text-nowrap p-3 text-center',
                render: function(data) {
                    return data ?? 0;
                }
            },
            {
                title: 'Total in Rice',
                data: 'total',
                className: 'text-nowrap p-3 text-center',
                render: function(data) {
                    return data ?? 0;
                }
            },
            {
                title: 'Date Created',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return formatDateToStr(row.created_at);
                }
            },
            {
                title: 'Action',
                className: 'text-nowrap p-2 text-center  align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                        <div class="d-flex gap-2 text-center align-items-center px-3">
                            <button class="btn btn-warning editButton px-2" data-wastebottle_id="${row.wastebottle_id}"><i class="bi bi-pencil-fill"></i></button>
                            <button class="btn btn-red deleteButton px-2" data-wastebottle_id="${row.wastebottle_id}"><i class="bi bi-trash3"></i></button>
                        </div>
                    `;
                }
            },
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

    $(document).on("click", "#reloadButton", function() {
        reloadButtonLoading(true);
        resetDate();
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

    // $(document).on('click', '#wastebottleTable tbody tr', function() {
    //     let data = wastebottleTable.row(this).data();
    //     if (!data) return;

    //     if ($(this).hasClass('selected')) {
    //         $(this).removeClass('selected');
    //         selectedwastebottleId = null;
    //     } else {
    //         $('tr.selected').removeClass('selected');
    //         $(this).addClass('selected');
    //         selectedwastebottleId = data.record_id; // wastebottle the ID
    //     }
    // });

    $(document).on('click', '#filterDateBtn', function() {
        dateFrom = $("#dateFromFilter").val();
        dateTo = $("#dateToFilter").val();
        wastebottleOptions.ajax.data.dateFrom = dateFrom;
        wastebottleOptions.ajax.data.dateTo = dateTo;
        reloadwastebottleTableWithPagination();
    });

    function resetDate() {
        dateFrom = "";
        dateTo = "";

        wastebottleOptions.ajax.data.dateFrom = dateFrom;
        wastebottleOptions.ajax.data.dateTo = dateTo;
    }
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
