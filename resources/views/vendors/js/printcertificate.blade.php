<script>
    $(document).on("click", "#printCertificate", function() {
        var selectedRow = vendorTable.row('.selected');

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                window.location.href = `{{ route('printVendor') }}?record_id=${data.record_id}`;
            }
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })

    $(document).on("click", "#editCertificationBtn", function() {
        var selectedRow = vendorTable.row('.selected');

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                window.location.href = `{{ route('vendor_certificate') }}?record_id=${data.record_id}`;
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
