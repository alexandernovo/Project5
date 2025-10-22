<script>
    const allMonths = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    let chart = null;

    function loadChart(year) {
        $.ajax({
            url: "{{ route('getChartData') }}",
            method: 'POST',
            data: {
                year: year
            },
            success: function(data) {
                const dataMonths = [...new Set(data.map(item => item.month))];
                const months = allMonths.filter(m => dataMonths.includes(m));
                const types = [...new Set(data.map(item => item.type))];

                const series = types.map(type => ({
                    name: typeLibrary[type] ?? type,
                    data: allMonths.map(month => {
                        const found = data.find(item => item.month === month && item
                            .type === type);
                        return found ? found.total : 0;
                    })
                }));

                const options = {
                    chart: {
                        type: 'bar',
                        height: 400
                    },
                    series: series,
                    xaxis: {
                        categories: allMonths,
                        title: {
                            text: 'Month'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Items'
                        },
                        labels: {
                            formatter: function(val) {
                                return Math.floor(val);
                            }
                        },
                        forceNiceScale: true
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '50%'
                        }
                    },
                    dataLabels: {
                        formatter: function(val, opts) {
                            const name = opts.w.globals.seriesNames[opts.seriesIndex];
                            return val != 0 ? `${name}: ${val}` : '';
                        },
                        style: {
                            colors: ['#000'],
                            fontSize: '11px',
                            fontWeight: 'bold'
                        },
                        background: {
                            enabled: false
                        },
                        offsetY: -10
                    },
                    colors: ['#808080']
                };

                // Destroy previous chart before re-render
                if (chart) {
                    chart.destroy();
                }

                chart = new ApexCharts(document.querySelector("#recordsChart"), options);
                chart.render();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching chart data:', error);
            }
        });
    }

    // Load chart initially with current year
    $(document).ready(function() {
        const currentYear = $('#yearSelect').val();
        loadChart(currentYear);

        // Reload chart when year changes
        $('#yearSelect').on('change', function() {
            loadChart($(this).val());
        });
    });
</script>
