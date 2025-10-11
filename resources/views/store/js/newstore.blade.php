<script>
    $(document).on("click", "#newCertification", function() {
        $(".button-submit").text("Add Certification");
        resetstore();
        $("#newstoreModal").modal("show");
    });

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        $(".button-submit").text("Edit Certification");

        let record_id = $(this).data('record_id');
        let data = storeData.find(x => x.record_id == record_id);
        resetstore();

        if (data) {
            populateForm(data, "newstoreform");
            $("#newstoreModal").modal("show");
        }
    })

    $(document).on("submit", "#newstoreform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        postRequest("{{ route('save_new_store') }}", formData, (response) => {
            if (response.status == "success") {
                reloadstoreTable();
                $("#newstoreModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resetstore() {
        $("#newstoreform")[0].reset();
        $("#newstoreform input[type='hidden']").val(0);
    }
</script>
