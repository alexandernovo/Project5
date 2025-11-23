<script>
    $(document).on("click", ".deleteButton", function() {
        let wastebottle_id = $(this).data('wastebottle_id');
        let data = wastebottleData.find(x => x.wastebottle_id == wastebottle_id);

        if (data) {
            Swal.fire({
                title: "Warning",
                text: "Delete this Waste Bottle Record?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    postRequest("{{ route('deletewastebottle') }}", {
                        wastebottle_id: data.wastebottle_id
                    }, (response) => {
                        if (response.status == "success") {
                            reloadwastebottleTable();
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
