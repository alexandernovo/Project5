<script>
    $(document).on("shown.bs.modal", "#wasteModal", function() {
        $("#barangay_waste").attr("disabled", true);
    });

    $(document).on("submit", "#waste_report_select", function(e) {
        e.preventDefault();

        let type_waste = $("#type_waste").val();
        let category_waste = $("#category_waste").val();
        let barangay_waste = $("#barangay_waste").val();
        let month_waste = $("#month_waste").val();
        let routefinal =
            `{{ route('wastePrint') }}?type_waste=${type_waste}&category_waste=${category_waste}&barangay_waste=${barangay_waste ?? "overall"}&month_waste=${month_waste}`;
        window.location.href = routefinal;
    })

    $(document).on("change", "#category_waste", function() {
        if ($(this).val() == "Barangay") {
            $("#barangay_waste").attr("disabled", false)
        } else {
            $("#barangay_waste").attr("disabled", true)
        }
    })
</script>
