<script>
    let treesTableRequirements = [
        "brgy_cert",
        "orno_check",
        "tax_check"
    ];

    $(document).on("click", "#newCertification", function() {
        $(".button-submit").text("Add Certification");
        resettrees();
        $("#newtreesModal").modal("show");
    });

    $(document).on("click", ".editButton", function() {
        let record_id = $(this).data('record_id');
        let data = treesData.find(x => x.record_id == record_id);
        $(".button-submit").text("Edit Certification");

        resettrees();

        if (data) {
            populateForm(data, "newtreesform");
            treesTableRequirements.forEach(req => {
                if (data.hasOwnProperty(req)) {
                    if (data[req] != 0 && data[req] != null) {
                        $(`#${req}_status`).html(`<span class="badge bg-success">Submitted</span>`);
                    } else {
                        $(`#${req}_status`).empty();
                    }
                } else {
                    $(`#${req}_status`).empty();
                }
            });
            $("#newtreesModal").modal("show");
        }
    })

    $(document).on("submit", "#newtreesform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        $(this).find("input[type='checkbox']").each(function() {
            if (!$(this).is(":checked")) {
                formData[$(this).attr("name")] = 0;
            }
        });

        postRequest("{{ route('save_new_trees') }}", formData, (response) => {
            if (response.status == "success") {
                reloadtreesTable();
                $("#newtreesModal").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    showCancelButton: false,
                })
            }
        });

    });

    function resettrees() {
        $("#newtreesform")[0].reset();
        $("#newtreesform input[type='hidden']").val(0);
    }


    $(document).on("change", ".checkthis", function() {
        let id = $(this).attr('id');
        if ($(this).prop("checked")) {
            $(`#${id}_status`).html(`<span class="badge bg-success">Submitted</span>`);
        } else {
            $(`#${id}_status`).empty();
        }
    })
</script>
