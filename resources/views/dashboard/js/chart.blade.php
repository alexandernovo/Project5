<script>
    const allMonths = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    const barColors = {
        "ASSOCIATION": "#5F040C",
        "BOATING": "#830202",
        "CHAINSAW": "#00068C",
        "TREES": "#63300B",
        "STORE": "#06510C",
        "TRICYCLE": "#2C7101",
        "VENDORS": "#545454"
    };

    let chart = null;

    function loadChart(year, month = "all") {
        $.ajax({
            url: "{{ route('getChartData') }}",
            method: 'POST',
            data: {
                year: year,
                month: month
            },
            success: function(data) {

                const categories = data.map(item => item.type);
                const counts = data.map(item => parseInt(item.total));

                const colors = categories.map(type => barColors[type] || '#808080');

                const options = {
                    chart: {
                        type: 'bar',
                        height: 400
                    },
                    series: [{
                        name: "Total",
                        data: counts
                    }],
                    xaxis: {
                        categories: categories,
                        labels: {
                            style: {
                                fontWeight: 'bold',
                                fontSize: '13px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return Math.floor(val); // no decimals
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            fontSize: '12px'
                        }
                    },
                    legend: {
                        labels: {
                            style: {
                                fontWeight: 'bold',
                                fontSize: '13px'
                            }
                        }
                    },
                    colors: colors,
                    plotOptions: {
                        bar: {
                            distributed: true,
                            horizontal: false,
                            columnWidth: '50%'
                        }
                    }
                };

                if (chart) chart.destroy();

                chart = new ApexCharts(document.querySelector("#recordsChart"), options);
                chart.render();
            }
        });
    }


    // Load chart initially with current year
    $(document).ready(function() {
        const year = $('#yearSelect').val();
        loadChart(year);

        $('#yearSelect, #monthSelect').on('change', function() {
            const selectedYear = $('#yearSelect').val();
            const selectedMonth = $('#monthSelect').val();
            loadChart(selectedYear, selectedMonth);
        });
    });
</script>
