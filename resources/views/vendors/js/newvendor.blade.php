<script>
    $(document).on("click", "#newCertification", function() {
        $(".button-submit").text("Add Certification");
        resetvendor();
        $("#newvendorModal").modal("show");
    });

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        $(".button-submit").text("Edit Certification");
        let record_id = $(this).data('record_id');
        let data = vendorData.find(x => x.record_id == record_id);

        resetvendor();

        if (data) {
            populateForm(data, "newvendorform");
            $("#newvendorModal").modal("show");
        }
    })

    $(document).on("submit", "#newvendorform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

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
