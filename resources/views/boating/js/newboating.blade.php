<script>
    $(document).on("click", "#newboatingBtn", function() {
        $("#newBoatingModalLabel").text("New Boat");
        resetBoating();
        $("#newBoatingModal").modal("show");
    });

    $(document).on("click", "#editboatingBtn", function() {
        $("#newBoatingModalLabel").text("Edit Boat");
        var selectedRow = boatingTable.row('.selected');
        resetBoating();

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                populateForm(data, "newBoatingform");
                $("#newBoatingModal").modal("show");
            }
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })

    $(document).on("submit", "#newBoatingform", function(e) {
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

        postRequest("{{ route('save_new_boating') }}", formData, (response) => {
            if (response.status == "success") {
                reloadboatingTable();
                $("#newBoatingModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resetBoating() {
        $("#newBoatingform")[0].reset();
        $("#newBoatingform input[type='hidden']").val(0);
    }
</script>
