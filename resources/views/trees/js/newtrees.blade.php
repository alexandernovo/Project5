<script>
    $(document).on("click", "#newtreesBtn", function() {
        $("#newtreesModalLabel").text("New Cutting Trees");
        resetFormAssociation();
        $("#newtreesModal").modal("show");
    });

    $(document).on("click", "#edittreesBtn", function() {
        $("#newtreesModalLabel").text("Edit Cutting Trees");
        var selectedRow = treesTable.row('.selected');
        resetFormAssociation();

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                populateForm(data, "newtreesform");
                $("#newtreesModal").modal("show");
            }
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })

    $(document).on("submit", "#newtreesform", function(e) {
        e.preventDefault();

        let formData = {
            ornumber: $('#ornumber').val(),
            record_id: $('#record_id').val(),
            client_id: $('#client_id').val(),
            owner_name: $('#owner_name').val(),
            name_other: $('#name_other').val(),
            address: $('#address').val(),
            lot_no: $('#lot_no').val(),
            requester: $('#requester').val(),
            expiration: $('#expiration').val()
        };

        postRequest("{{ route('save_new_trees') }}", formData, (response) => {
            if (response.status == "success") {
                reloadtreesTable();
                $("#newtreesModal").modal("hide");
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
        $("#newtreesform")[0].reset();
        $("#newtreesform input[type='hidden']").val(0);
    }
</script>
