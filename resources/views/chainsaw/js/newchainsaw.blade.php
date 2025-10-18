<script>
    let chainsawTableRequirements = [
        "ctpo",
        "brgy_cert",
        "orno_check",
        "cr_check"
    ];

    $(document).on("click", "#newCertification", function() {
        $(".button-submit").text("Add Certification");
        resetchainsaw();
        $("#newChainsawModal").modal("show");
    });

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        
        $(".button-submit").text("Edit Certification");

        let record_id = $(this).data('record_id');
        let data = chainsawData.find(x => x.record_id == record_id);
        resetchainsaw();

        if (data) {
            populateForm(data, "newChainsawform");
            chainsawTableRequirements.forEach(req => {
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

            $("#newChainsawModal").modal("show");
        }
    })

    $(document).on("submit", "#newChainsawform", function(e) {
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

    $(document).on("change", ".checkthis", function() {
        let id = $(this).attr('id');
        if ($(this).prop("checked")) {
            $(`#${id}_status`).html(`<span class="badge bg-success">Submitted</span>`);
        } else {
            $(`#${id}_status`).empty();
        }
    })
</script>
