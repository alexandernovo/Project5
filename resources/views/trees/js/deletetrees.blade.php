<script>
    $(document).on("click", ".deleteButton", function(e) {
        e.stopPropagation();
        var selectedRow = treesTable.row('.selected');
        let record_id = $(this).data('record_id');
        let data = treesData.find(x => x.record_id == record_id);

        if (data) {
            Swal.fire({
                title: "Warning",
                text: "Delete this Cutting Trees Record?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    postRequest("{{ route('deletetrees') }}", {
                        record_id: data.record_id
                    }, (response) => {
                        if (response.status == "success") {
                            reloadtreesTable();
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
    })
</script>
