<script>
    let dashboardOptions;
    let dashboardTable;
    let dashboardData = [];
    let selecteddashboardId = null;
    let dateFrom = "";
    let dateTo = "";

    let typeLibrary = {
        "STORE": "SARI-SARI STORE",
        "TREES": "CUTTING TREES"
    };

    dashboardOptions = {
        processing: false,
        serverSide: true,
        // data: [],
        ajax: {
            url: "{{ route('getDashboardDetails') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFrom;
                d.dateTo = dateTo;
            },
            dataSrc: function(json) {
                dashboardData = json.data;
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
                title: 'Owner of dashboard',
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
                title: 'Type of Certification',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return `<span>${typeLibrary[row.type] ?? row.type}</span>`;
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
                title: 'Renewal Status',
                className: 'text-nowrap p-2 text-center  align-middle text-center',
                render: function(data, type, row) {
                    return (row.type != "TREES" && row.type != "BOATING") ? renderExpirationStatus(row.expiration) : 'NA';
                }
            },
            {
                title: 'Date of Renewal',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return (row.type != "TREES" && row.type != "BOATING") ? formatDateToStr(row.date_renewal, false) : 'NA';
                }
            },
            {
                title: 'Date of Expiration',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return (row.type != "TREES" && row.type != "BOATING") ? formatDateToStr(row.expiration, false) : 'NA';
                }
            },

        ],
        initComplete: function(settings, json) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };

    function renderdashboardTable() {
        if (dashboardTable) {
            dashboardTable.destroy();
        }
        dashboardTable = new DataTable('#dashboardTable', dashboardOptions)
    }

    $(document).ready(function() {
        console.log("hello")
        renderdashboardTable();
    })
</script>
