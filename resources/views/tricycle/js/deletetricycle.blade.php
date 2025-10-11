<script>
    $(document).on("click", ".deleteButton", function(e) {
        e.stopPropagation();

        let record_id = $(this).data('record_id');
        let data = tricycleData.find(x => x.record_id == record_id);
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
    })
</script>
