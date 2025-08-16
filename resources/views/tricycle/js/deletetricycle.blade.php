<script>
    $(document).on("click", "#deletetricycleBtn", function() {
        var selectedRow = tricycleTable.row('.selected');

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                Swal.fire({
                    title: "Warning",
                    text: "Delete this Tricycle Record?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        postRequest("{{ route('deletetricycle') }}", {
                            record_id: data.record_id
                        }, (response) => {
                            if (response.status == "success") {
                                reloadtricycleTable();
                                Swal.fire({
                                    title: "Success",
                                    text: response.message,
                                    icon: "success",
                                    showCancelButton: false,
                                })
                            }
                        })
                    }
                });
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
