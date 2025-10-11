<script>
    $(document).on("click", "#printCertificate", function() {
        var selectedRow = tricycleTable.row('.selected');

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                window.location.href = `{{ route('printTricycle') }}?record_id=${data.record_id}`;
            }
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })
</script>
