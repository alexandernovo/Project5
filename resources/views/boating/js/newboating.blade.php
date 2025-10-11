<script>
    $(document).on("click", "#newCertification", function() {
        resetBoating();
        $(".button-submit").text("Add Certification");
        $("#newBoatingModal").modal("show");
    });

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        $(".button-submit").text("Edit Certification");

        let record_id = $(this).data('record_id');
        let data = boatingData.find(x => x.record_id == record_id);
        resetBoating();

        if (data) {
            populateForm(data, "newBoatingform");
            $("#newBoatingModal").modal("show");
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

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

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
