<script>
    $(document).on("click", "#newwastebottleBtn", function() {
        $("#wasteBottleSubmit").html(`
            <img src="{{ asset('assets/images/icons/Waste Bottle.png') }}" style="width: 20px; height:20px;"alt="">
            Add Waste Bottle
        `);
        resetWasteBottle();
        $("#newwastebottleModal").modal("show");
    });

    $(document).on("click", ".editButton", function() {
        $("#wasteBottleSubmit").html(`
            <img src="{{ asset('assets/images/icons/Waste Bottle.png') }}" style="width: 20px; height:20px;"alt=""> 
            Edit Waste Bottle
        `);
        let wastebottle_id = $(this).data('wastebottle_id');
        let data = wastebottleData.find(x => x.wastebottle_id == wastebottle_id);
        resetWasteBottle();
        if (data) {
            populateForm(data, "newwastebottleform");
            $("#newwastebottleModal").modal("show");
        }
    })

    $(document).on("submit", "#newwastebottleform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

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

    $(document).ready(function() {
        function calculateTotal() {
            let bottle = parseFloat($("#bottleinkg").val()) || 0;
            let rice = parseFloat($("#riceinkg").val()) || 0;
            let total = bottle + rice;
            $("#totalinrice").val(total);
        }

        $("#bottleinkg, #riceinkg").on("input change", calculateTotal);
    });
</script>
