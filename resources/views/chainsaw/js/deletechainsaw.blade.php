<script>
    $(document).on("click", "#deletechainsawBtn", function() {
        var selectedRow = chainsawTable.row('.selected');

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                Swal.fire({
                    title: "Warning",
                    text: "Delete this Chainsaw Record?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        postRequest("{{ route('deletechainsaw') }}", {
                            record_id: data.record_id
                        }, (response) => {
                            if (response.status == "success") {
                                reloadChainsawTable();
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
