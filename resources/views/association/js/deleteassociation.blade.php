<script>
    $(document).on("click", "#deleteAssociationBtn", function() {
        var selectedRow = associationTable.row('.selected');

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                Swal.fire({
                    title: "Warning",
                    text: "Delete this Association Record?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        postRequest("{{ route('deleteAssociation') }}", {
                            record_id: data.record_id
                        }, (response) => {
                            if (response.status == "success") {
                                reloadassociationTable();
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
