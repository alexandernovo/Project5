<script>
    $(document).on("click", "#deletestoreBtn", function() {
        var selectedRow = storeTable.row('.selected');

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                Swal.fire({
                    title: "Warning",
                    text: "Delete this Sari-Sari Store?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        postRequest("{{ route('deletestore') }}", {
                            record_id: data.record_id
                        }, (response) => {
                            if (response.status == "success") {
                                reloadstoreTable();
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
