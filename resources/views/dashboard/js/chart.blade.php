<script>
    $.ajax({
        url: "{{ route('getChartData') }}",
        method: 'POST',
        success: function(data) {
            // Define all months (or replace with dynamic range if needed)
            const allMonths = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            // Get all unique months present in data (for flexibility)
            const dataMonths = [...new Set(data.map(item => item.month))];

            // Combine and sort by allMonths order
            const months = allMonths.filter(m => dataMonths.includes(m));

            const types = [...new Set(data.map(item => item.type))];

            const series = types.map(type => ({
                name: typeLibrary[type] ?? type,
                data: allMonths.map(month => {
                    const found = data.find(item => item.month === month && item
                        .type === type);
                    return found ? found.total : 0; // 👈 substitute 0 if no value
                })
            }));

            const options = {
                chart: {
                    type: 'bar',
                    height: 400
                },
                series: series,
                xaxis: {
                    categories: allMonths, // use all months, even if empty
                },
                yaxis: {
                    title: {
                        text: 'Number of Items'
                    }
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
                    offsetY: -10,
                },
                colors: ['#808080'], // gray bars
            };

            const chart = new ApexCharts(document.querySelector("#recordsChart"), options);
            chart.render();
        },
        error: function(xhr, status, error) {
            console.error('Error fetching chart data:', error);
        }
    });
</script>
