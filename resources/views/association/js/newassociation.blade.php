<script>
    $(document).on("click", "#newassociationBtn", function() {
        $(".button-submit").text("Add Certification");
        resetFormAssociation();
        $("#newassociationModal").modal("show");
    });

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        let record_id = $(this).data('record_id');
        let data = associationData.find(x => x.record_id == record_id);
        $(".button-submit").text("Edit Certification");
        resetFormAssociation();
        if (data) {
            populateForm(data, "newassociationform");
            $("#newassociationModal").modal("show");
        } else {
            Swal.fire({
                title: "Warning",
                text: "Please Select a Row First",
                icon: "warning",
            });
        }
    })

    $(document).on("submit", "#newassociationform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        postRequest("{{ route('save_new_association') }}", formData, (response) => {
            if (response.status == "success") {
                reloadassociationTable();
                $("#newassociationModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resetFormAssociation() {
        $("#newassociationform")[0].reset();
        $("#newassociationform input[type='hidden']").val(0);
    }
</script>
