<script>
    $(document).on("click", "#newvendorBtn", function() {
        $("#newvendorModalLabel").text("New Vendor");
        resetvendor();
        $("#newvendorModal").modal("show");
    });

    $(document).on("click", "#editvendorBtn", function() {
        $("#newvendorModalLabel").text("Edit Vendor");
        var selectedRow = vendorTable.row('.selected');
        resetvendor();

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                populateForm(data, "newvendorform");
                $("#newvendorModal").modal("show");
            }
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })

    $(document).on("submit", "#newvendorform", function(e) {
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

        postRequest("{{ route('save_new_vendor') }}", formData, (response) => {
            if (response.status == "success") {
                reloadvendorTable();
                $("#newvendorModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resetvendor() {
        $("#newvendorform")[0].reset();
        $("#newvendorform input[type='hidden']").val(0);
    }
</script>
