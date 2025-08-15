<script>
    $(document).on("click", "#newassociationBtn", function() {
        $("#newassociationModalLabel").text("New Association");
        resetFormAssociation();
        $("#newassociationModal").modal("show");
    });

    $(document).on("click", "#editassociationBtn", function() {
        $("#newassociationModalLabel").text("Edit Association");
        var selectedRow = associationTable.row('.selected');
        resetFormAssociation();

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                populateForm(data, "newassociationform");
                $("#newassociationModal").modal("show");
            }
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })

    $(document).on("submit", "#newassociationform", function(e) {
        e.preventDefault();

        let formData = {
            ornumber: $('#ornumber').val(),
            record_id: $('#record_id').val(),
            client_id: $('#client_id').val(),
            owner_name: $('#owner_name').val(),
            association: $('#association').val(),
            address: $('#address').val(),
            expiration: $('#expiration').val()
        };

        postRequest("{{ route('save_new_association') }}", formData, (response) => {
            if (response.status == "success") {
                reloadassociationTable();
                $("#newassociationModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resetFormAssociation() {
        $("#newassociationform")[0].reset();
        $("#newassociationform input[type='hidden']").val(0);
    }
</script>
