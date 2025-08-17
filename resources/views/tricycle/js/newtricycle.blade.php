<script>
    $(document).on("click", "#newtricycleBtn", function() {
        $("#newtricycleModalLabel").text("New Tricycle");
        resettricycle();
        $("#newtricycleModal").modal("show");
    });

    $(document).on("click", "#edittricycleBtn", function() {
        $("#newtricycleModalLabel").text("Edit Tricycle");
        var selectedRow = tricycleTable.row('.selected');
        resettricycle();

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                populateForm(data, "newtricycleform");
                $("#newtricycleModal").modal("show");
            }
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })

    $(document).on("submit", "#newtricycleform", function(e) {
        e.preventDefault();

        let formData = {
            ornumber: $('#ornumber').val(),
            record_id: $('#record_id').val(),
            client_id: $('#client_id').val(),
            owner_name: $('#owner_name').val(),
            name_other: $('#name_other').val(),
            address: $('#address').val(),
            expiration: $('#expiration').val()
        };

        postRequest("{{ route('save_new_tricycle') }}", formData, (response) => {
            if (response.status == "success") {
                reloadtricycleTable();
                $("#newtricycleModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resettricycle() {
        $("#newtricycleform")[0].reset();
        $("#newtricycleform input[type='hidden']").val(0);
    }
</script>
