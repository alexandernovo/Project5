<script>
    $(document).on("click", "#newwastecollectBtn", function() {
        $("#wasteCollectionSubmit").text("Add Waste Collection");
        resetWasteCollect();
        $("#newwastecollectModal").modal("show");
    });

    $(document).on("click", ".editButton", function() {
        $("#wasteCollectionSubmit").text("Edit Waste Collection");
        let wastecollect_id = $(this).data('wastecollect_id');
        let data = wastecollectData.find(x => x.wastecollect_id == wastecollect_id);
        resetWasteCollect();

        if (data) {
            populateForm(data, "newwastecollectform");
            $("#newwastecollectModal").modal("show");
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
