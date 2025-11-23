<script>
    $(document).on("click", ".deleteButton", function() {
        let wastecollect_id = $(this).data('wastecollect_id');
        let data = wastecollectData.find(x => x.wastecollect_id == wastecollect_id);

        if (data) {
            Swal.fire({
                title: "Warning",
                text: "Delete this Waste Collection Record?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    postRequest("{{ route('deletewastecollect') }}", {
                        wastecollect_id: data.wastecollect_id
                    }, (response) => {
                        if (response.status == "success") {
                            reloadwastecollectTable();
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
