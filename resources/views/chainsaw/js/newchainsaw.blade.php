<script>
    let default_chainsaw_req = [{
            requirement_id: 0,
            record_id: 0,
            description: "CTPO",
            progress: 0
        },
        {
            requirement_id: 0,
            record_id: 0,
            description: "Barangay Certification",
            progress: 0
        },
        {
            requirement_id: 0,
            record_id: 0,
            description: "OR Number (Treasury Office)",
            progress: 0
        },
        {
            requirement_id: 0,
            record_id: 0,
            description: "Certificate of Registration",
            progress: 0
        }
    ];

    let chainsawTableRequirements = [];
    let chainsawTableRequirementsRemoved = [];

    $(document).on("click", "#newCertification", function() {
        $(".button-submit").text("Add Certification");
        resetchainsaw();
        chainsawTableRequirementsRemoved = [];
        chainsawTableRequirements = JSON.parse(JSON.stringify(default_chainsaw_req));
        createNewTableChainsaw(chainsawTableRequirements);
        $("#newChainsawModal").modal("show");
    });

    function createNewTableChainsaw(data) {
        let tableHTML = data.map((x, index) => {
            return `
                <tr>
                    <td class="text-center">${index + 1}</td>
                    <td width="70%">
                        <input class="form-control description-change-chainsaw" required value="${x.description}" data-index="${index}"/>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <input class="form-check-input checkthis" type="checkbox" data-index="${index}" style="accent-color: #06500D"
                                value="1" ${x.progress == 1 ? "checked" : ''}>
                        </div>
                    </td>
                    <td width="30%" class="align-middle p-0">
                        <div class="d-flex justify-content-center">
                            <span>
                                ${x.progress == 1 ? `<span class="badge bg-success">Submitted</span>` : ''}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-red btn-sm p-1 removerequirementschainsaw" data-index="${index}"><i class="bi bi-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `;
        }).join("");

        $("#table_chainsaw").html(tableHTML);
    }

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();

        $(".button-submit").text("Edit Certification");

        let record_id = $(this).data('record_id');
        let data = chainsawData.find(x => x.record_id == record_id);
        resetchainsaw();

        if (data) {
            let data_new = JSON.parse(JSON.stringify(data));
            chainsawTableRequirements = data_new.chainsawTableRequirements.length > 0 ? data_new
                .chainsawTableRequirements : JSON.parse(JSON.stringify(default_chainsaw_req));
            chainsawTableRequirementsRemoved = [];
            console.log(data_new.chainsawTableRequirements);

            delete data_new.chainsawTableRequirements;
            populateForm(data_new, "newChainsawform");
            createNewTableChainsaw(chainsawTableRequirements);
            $("#newChainsawModal").modal("show");
        }
    })

    $(document).on("submit", "#newChainsawform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
            console.log(field.name);
        });

        formData['chainsawTableRequirements'] = chainsawTableRequirements;
        formData['chainsawTableRequirementsRemoved'] = chainsawTableRequirementsRemoved;
        console.log(formData);
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
        let index = $(this).data('index');
        let requirement = chainsawTableRequirements?.[index];

        if (requirement) {
            requirement.progress = $(this).is(":checked") ? 1 : 0;
            createNewTableChainsaw(chainsawTableRequirements);
        } else {
            console.warn("No requirement found for index:", index);
        }
    });

    $(document).on("click", "#addnewrequirementschainsaw", function() {
        console.log("clicked");
        chainsawTableRequirements.unshift({
            requirement_id: 0,
            record_id: 0,
            description: "",
            progress: 0
        });
        createNewTableChainsaw(chainsawTableRequirements);
    });

    $(document).on("input", ".description-change-chainsaw", function() {
        let index = $(this).data('index');
        let requirement = chainsawTableRequirements?.[index];
        if (requirement) {
            requirement.description = $(this).val();
        } else {
            console.warn("No requirement found for index:", index);
        }
    });

    $(document).on("click", ".removerequirementschainsaw", function() {
        let index = $(this).data('index');
        let requirement = chainsawTableRequirements?.[index];
        if (requirement) {
            if (requirement.requirement_id != 0) {
                chainsawTableRequirementsRemoved.push(requirement);
            }

            chainsawTableRequirements.splice(index, 1);
            createNewTableChainsaw(chainsawTableRequirements);
        }
    });
</script>
