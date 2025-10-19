<script>
    let wastecollectOptions;
    let wastecollectTable;
    let wastecollectData = [];
    let selectedwastecollectId = null;
    let dateFrom = "";
    let dateTo = "";

    wastecollectOptions = {
        processing: false,
        serverSide: true,
        // data:[],
        ajax: {
            url: "{{ route('getwastecollect') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFrom;
                d.dateTo = dateTo;
            },
            dataSrc: function(json) {
                wastecollectData = json.data;
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
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return row.barangay;
                }
            },
            {
                title: 'Municipality',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return row.municipality;
                }
            },
            {
                title: 'Province',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return row.province;
                }
            },
            {
                title: 'Purok',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return row.purok
                }
            },
            {
                title: 'Biodegradable',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return row.biodegradable
                }
            },
            {
                title: 'Non-Biodegradable',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return row.nonbio
                }
            },
            {
                title: 'Non-Biodegradable',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return row.nonbio
                }
            },
            {
                title: 'Recyclable',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return row.recyclable
                }
            },
            {
                title: 'Special Waste',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return row.specialwaste
                }
            },
            {
                title: 'Total',
                className: 'text-nowrap p-3 text-center',
                render: function(data, type, row) {
                    return row.total
                }
            },
            {
                title: 'Date Created',
                className: 'text-nowrap p-3',
                render: function(data, type, row) {
                    return formatDateToStr(row.created_at);
                }
            },
        ],
        initComplete: function(settings, json) {
            appendButtonswastecollect();
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };

    $(document).ready(function() {
        renderwastecollectTable();
    })

    function renderwastecollectTable() {
        if (wastecollectTable) {
            wastecollectTable.destroy();
        }
        wastecollectTable = new DataTable('#wastecollectTable', wastecollectOptions)
    }

    $(document).on("click", "#reloadButton", function() {
        reloadButtonLoading(true);
        resetDate();
        reloadwastecollectTable();
        setTimeout(() => {
            reloadButtonLoading(false);
        }, 500);
    });

    function reloadwastecollectTable() {
        if (wastecollectTable) {
            wastecollectTable.ajax.reload(null, false);
        } else {
            renderwastecollectTable();
        }
    }

    function reloadwastecollectTableWithPagination() {
        if (wastecollectTable) {
            wastecollectTable.ajax.reload(null, true);
        } else {
            renderwastecollectTable();
        }
    }

    function appendButtonswastecollect() {
        $('#wastecollectTable_wrapper .row .dt-length').append(`
            <div class="d-flex gap-2 ms-2 align-items-center wastecollectBtnSm">
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
            $("#reloadwastecollectBtn").html(`
                    <div class="spinner-border text-white" role="status" style="width: 14px; height: 14px">
                </div>
                Reloading
            `);
        } else {
            $("#reloadwastecollectBtn").html(`
                <i class="bi bi-arrow-clockwise"></i>
                Reload
            `);
        }
    }

    // $(document).on('click', '#wastecollectTable tbody tr', function() {
    //     let data = wastecollectTable.row(this).data();
    //     if (!data) return;

    //     if ($(this).hasClass('selected')) {
    //         $(this).removeClass('selected');
    //         selectedwastecollectId = null;
    //     } else {
    //         $('tr.selected').removeClass('selected');
    //         $(this).addClass('selected');
    //         selectedwastecollectId = data.record_id; // wastecollect the ID
    //     }
    // });

    $(document).on('click', '#filterDateBtn', function() {
        dateFrom = $("#dateFromFilter").val();
        dateTo = $("#dateToFilter").val();
        wastecollectOptions.ajax.data.dateFrom = dateFrom;
        wastecollectOptions.ajax.data.dateTo = dateTo;
        reloadwastecollectTableWithPagination();
    });

    function resetDate() {
        dateFrom = "";
        dateTo = "";

        wastecollectOptions.ajax.data.dateFrom = dateFrom;
        wastecollectOptions.ajax.data.dateTo = dateTo;
    }
    // Rewastecollect selection after reload
    wastecollectOptions.drawCallback = function(settings) {
        wastecollectTable.rows().every(function() {
            let data = this.data();
            if (data.record_id === selectedwastecollectId) {
                $(this.node()).addClass('selected');
            }
        });
    };
</script>
