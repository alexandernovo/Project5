<script>
    $(document).on("click", "#newCertification", function() {
        $(".button-submit").text("Add Certification");
        resettricycle();
        $("#newtricycleModal").modal("show");
    });

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        $(".button-submit").text("Edit Certification");
        let record_id = $(this).data('record_id');
        let data = tricycleData.find(x => x.record_id == record_id);

        resettricycle();

        if (data) {
            populateForm(data, "newtricycleform");
            $("#newtricycleModal").modal("show");
        }
    })

    $(document).on("submit", "#newtricycleform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        postRequest("{{ route('save_new_tricycle') }}", formData, (response) => {
            if (response.status == "success") {
                reloadtricycleTable();
                $("#newtricycleModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resettricycle() {
        $("#newtricycleform")[0].reset();
        $("#newtricycleform input[type='hidden']").val(0);
    }
</script>
