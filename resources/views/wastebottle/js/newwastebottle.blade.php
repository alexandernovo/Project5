<script>
    $(document).on("click", "#newwastebottleBtn", function() {
        $("#newwastebottleModalLabel").text("New Waste Bottle");
        resetWasteBottle();
        $("#newwastebottleModal").modal("show");
    });

    $(document).on("click", "#editwastebottleBtn", function() {
        $("#newwastebottleModalLabel").text("Edit Waste Bottle");
        var selectedRow = wastebottleTable.row('.selected');
        resetWasteBottle();

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                populateForm(data, "newwastebottleform");
                $("#newwastebottleModal").modal("show");
            }
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })

    $(document).on("submit", "#newwastebottleform", function(e) {
        e.preventDefault();

        let formData = {
            wastebottle_id: $("#wastebottle_id").val(),
            resident_name: $("#resident_name").val(),
            bottle_kg: $("#bottle_kg").val(),
            rice_kg: $("#rice_kg").val(),
        };

        postRequest("{{ route('save_new_wastebottle') }}", formData, (response) => {
            if (response.status == "success") {
                reloadwastebottleTable();
                $("#newwastebottleModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resetWasteBottle() {
        $("#newwastebottleform")[0].reset();
        $("#newwastebottleform input[type='hidden']").val(0);
    }
</script>
