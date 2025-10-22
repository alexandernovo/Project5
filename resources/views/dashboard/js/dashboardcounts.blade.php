<script>
    function getDashboardCounts() {
        postRequest("{{ route('getDashboardCounts') }}", {}, (response) => {
            if (response.status == "success") {
                response.counts.forEach(item => {
                    const type = item.type.toUpperCase();
                    if (type === "ASSOCIATION") $("#associationCount").text(item.total);
                    else if (type === "BOATING") $("#boatingCount").text(item.total);
                    else if (type === "CHAINSAW") $("#chainsawCount").text(item.total);
                    else if (type === "TREES") $("#treesCount").text(item.total);
                    else if (type === "STORE") $("#storeCount").text(item.total);
                    else if (type === "TRICYCLE") $("#tricycleCount").text(item.total);
                    else if (type === "VENDOR") $("#vendorsCount").text(item.total);
                });
            }
        })
    }

    getDashboardCounts();
</script>
