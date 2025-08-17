<script>
    $(document).on("click", "#newstoreBtn", function() {
        $("#newstoreModalLabel").text("New Store");
        resetstore();
        $("#newstoreModal").modal("show");
    });

    $(document).on("click", "#editstoreBtn", function() {
        $("#newstoreModalLabel").text("Edit Store");
        var selectedRow = storeTable.row('.selected');
        resetstore();

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                populateForm(data, "newstoreform");
                $("#newstoreModal").modal("show");
            }
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })

    $(document).on("submit", "#newstoreform", function(e) {
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

        postRequest("{{ route('save_new_store') }}", formData, (response) => {
            if (response.status == "success") {
                reloadstoreTable();
                $("#newstoreModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resetstore() {
        $("#newstoreform")[0].reset();
        $("#newstoreform input[type='hidden']").val(0);
    }
</script>
