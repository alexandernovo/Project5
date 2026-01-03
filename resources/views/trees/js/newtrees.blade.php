<script>
    let default_trees_req = [{
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
            description: "Title or Tax Declaration",
            progress: 0
        }
    ];

    let treesTableRequirements = [];
    let treesTableRequirementsRemoved = [];

    $(document).on("click", "#newCertification", function() {
        $(".button-submit").text("Add Certification");
        resettrees();
        treesTableRequirementsRemoved = [];
        treesTableRequirements = JSON.parse(JSON.stringify(default_trees_req));
        createNewTableTrees(treesTableRequirements);
        $("#newtreesModal").modal("show");
    });


    function createNewTableTrees(data) {
        let tableHTML = data.map((x, index) => {
            return `
                <tr>
                    <td class="text-center">${index + 1}</td>
                    <td width="70%">
                        <input class="form-control description-change-trees" required value="${x.description}" data-index="${index}"/>
                    </td>
                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center">
                            <input class="form-check-input checkthis-trees" type="checkbox" data-index="${index}" style="accent-color: #06500D"
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
                            <button type="button" class="btn btn-red btn-sm p-1 removerequirementstrees" data-index="${index}"><i class="bi bi-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `;
        }).join("");

        $("#table_trees").html(tableHTML);
    }

    $(document).on("click", "#addnewrequirementstrees", function() {
        treesTableRequirements.unshift({
            requirement_id: 0,
            record_id: 0,
            description: "",
            progress: 0
        });
        createNewTableTrees(treesTableRequirements);
    });

    $(document).on("input", ".description-change-trees", function() {
        let index = $(this).data('index');
        let requirement = treesTableRequirements?.[index];
        if (requirement) {
            requirement.description = $(this).val();
        } else {
            console.warn("No requirement found for index:", index);
        }
    });

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();

        let record_id = $(this).data('record_id');
        let data = treesData.find(x => x.record_id == record_id);
        $(".button-submit").text("Edit Certification");

        resettrees();

        if (data) {
            let data_new = JSON.parse(JSON.stringify(data));
            treesTableRequirements = data_new.treesTableRequirements.length > 0 ? data_new
                .treesTableRequirements : JSON.parse(JSON.stringify(default_trees_req));
            treesTableRequirementsRemoved = [];
            console.log(data_new.treesTableRequirements);

            delete data_new.treesTableRequirements;
            populateForm(data_new, "newtreesform");
            createNewTableTrees(treesTableRequirements);
            $("#newtreesModal").modal("show");
        }
    })

    $(document).on("submit", "#newtreesform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        formData['treesTableRequirements'] = treesTableRequirements;
        formData['treesTableRequirementsRemoved'] = treesTableRequirementsRemoved;

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


    $(document).on("change", ".checkthis-trees", function() {
        let index = $(this).data('index');
        let requirement = treesTableRequirements?.[index];

        if (requirement) {
            requirement.progress = $(this).is(":checked") ? 1 : 0;
            createNewTableChainsaw(treesTableRequirements);
        } else {
            console.warn("No requirement found for index:", index);
        }
    });

    $(document).on("click", ".removerequirementstrees", function() {
        let index = $(this).data('index');
        let requirement = treesTableRequirements?.[index];
        if (requirement) {
            if (requirement.requirement_id != 0) {
                treesTableRequirementsRemoved.push(requirement);
            }

            treesTableRequirements.splice(index, 1);
            createNewTableChainsaw(treesTableRequirements);
        }
    });
</script>
