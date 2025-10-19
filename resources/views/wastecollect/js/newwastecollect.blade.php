<script>
    $(document).on("click", "#newwastecollectBtn", function() {
        $("#newwastecollectModalLabel").text("New Waste Collection");
        resetWasteCollect();
        $("#newwastecollectModal").modal("show");
    });

    $(document).on("click", "#editwastecollectBtn", function() {
        $("#newwastecollectModalLabel").text("Edit Waste Collection");
        var selectedRow = wastecollectTable.row('.selected');
        resetWasteCollect();

        if (selectedRow.node()) {
            var data = selectedRow.data();
            if (data) {
                populateForm(data, "newwastecollectform");
                $("#newwastecollectModal").modal("show");
            }
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })

    $(document).on("submit", "#newwastecollectform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        postRequest("{{ route('save_new_wastecollect') }}", formData, (response) => {
            if (response.status == "success") {
                reloadwastecollectTable();
                $("#newwastecollectModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resetWasteCollect() {
        $("#newwastecollectform")[0].reset();
        $("#newwastecollectform input[type='hidden']").val(0);
    }

    function calculateTotalWaste() {
        let biodegradable = parseFloat($("#biodegradable").val()) || 0;
        let nonbio = parseFloat($("#nonbio").val()) || 0;
        let recyclable = parseFloat($("#recyclable").val()) || 0;
        let specialwaste = parseFloat($("#specialwaste").val()) || 0;

        let total = biodegradable + nonbio + recyclable + specialwaste;
        $("#total").val(total.toFixed(2)); // keep 2 decimal places
    }

    calculateTotalWaste();

    $("#biodegradable, #nonbio, #recyclable, #specialwaste").on("input change", calculateTotalWaste);
</script>
