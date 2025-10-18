<script>
    $(document).on("click", ".deleteButton", function(e) {
        e.stopPropagation();
        var selectedRow = chainsawTable.row('.selected');
        let record_id = $(this).data('record_id');
        let data = chainsawData.find(x => x.record_id == record_id);

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
    })
</script>
