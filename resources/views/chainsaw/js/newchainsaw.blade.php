<script>
    $(document).on("click", "#newchainsawBtn", function() {
        $("#newChainsawModalLabel").text("New Chainsaw");
        resetchainsaw();
        $("#newChainsawModal").modal("show");
    });

    $(document).on("click", "#editchainsawBtn", function() {
        $("#newChainsawModalLabel").text("Edit Chainsaw");
        var selectedRow = chainsawTable.row('.selected');
        resetchainsaw();

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                populateForm(data, "newChainsawform");
                $("#newChainsawModal").modal("show");
            }
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })

    $(document).on("submit", "#newChainsawform", function(e) {
        e.preventDefault();

        let formData = {
            ornumber: $('#ornumber').val(),
            record_id: $('#record_id').val(),
            client_id: $('#client_id').val(),
            owner_name: $('#owner_name').val(),
            name_other: $('#name_other').val(),
            address: $('#address').val(),

            model_no: $('#model_no').val(),
            brand: $('#brand').val(),
            serial_no: $('#serial_no').val(),
            
            expiration: $('#expiration').val()
        };

        postRequest("{{ route('save_new_chainsaw') }}", formData, (response) => {
            if (response.status == "success") {
                reloadChainsawTable();
                $("#newChainsawModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resetchainsaw() {
        $("#newChainsawform")[0].reset();
        $("#newChainsawform input[type='hidden']").val(0);
    }
</script>
