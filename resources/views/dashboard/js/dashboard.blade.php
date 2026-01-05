<script>
    let dashboardOptions;
    let dashboardTable;
    let dashboardData = [];
    let selecteddashboardId = null;
    let dateFrom = "";
    let dateTo = "";

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
    let chainsawTableRequirements = [];
    let chainsawTableRequirementsRemoved = [];

    let typeLibrary = {
        "STORE": "SARI-SARI STORE",
        "TREES": "CUTTING TREES"
    };

    dashboardOptions = {
        processing: false,
        serverSide: true,
        // data: [],
        ajax: {
            url: "{{ route('getDashboardDetails') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFrom;
                d.dateTo = dateTo;
            },
            dataSrc: function(json) {
                dashboardData = json.data;
                return json.data;
            }
        },
        columns: [{
                title: 'No.',
                className: 'text-nowrap p-2 text-center align-middle',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                title: 'Owner',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.owner_name;
                }
            },
            {
                title: 'OR No.',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.ornumber;
                }
            },
            {
                title: 'Address',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.address;
                }
            },
            {
                title: 'Sex',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.sex;
                }
            },
            {
                title: 'Contact No.',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return row.contact_no;
                }
            },
            {
                title: 'Type of Certification',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return `<span>${typeLibrary[row.type] ?? row.type}</span>`;
                }
            },
            {
                title: 'Date Created',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return formatDateToStr(row.created_at);
                }
            },
            {
                title: 'Status',
                className: 'text-nowrap p-2 text-center  align-middle text-center',
                render: function(data, type, row) {
                    return (row.type != "TREES" && row.type != "BOATING") ? renderExpirationStatus(row
                        .record_status, row.expiration) : 'NA';

                }
            },
            {
                title: 'Date of Renewed',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return (row.type != "TREES" && row.type != "BOATING") ? formatDateToStr(row
                        .date_renewal, false) : 'NA';
                }
            },
            {
                title: 'Date of Expired',
                className: 'text-nowrap p-2 text-center  align-middle',
                render: function(data, type, row) {
                    return (row.type != "TREES" && row.type != "BOATING") ? formatDateToStr(row.expiration,
                        false) : 'NA';
                }
            },
            {
                title: 'Action',
                className: 'text-nowrap p-2 text-center  align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                        <div class="d-flex gap-2 text-center align-items-center">
                            <button class="btn btn-warning editButton px-2" data-type="${row.type}" data-record_id="${row.record_id}"><i class="bi bi-pencil-fill"></i></button>
                            <button class="btn btn-red deleteButton px-2" data-type="${row.type}" data-record_id="${row.record_id}"><i class="bi bi-trash3"></i></button>
                        </div>
                    `;
                }
            },

        ],
        initComplete: function(settings, json) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    };

    function renderdashboardTable() {
        if (dashboardTable) {
            dashboardTable.destroy();
        }
        dashboardTable = new DataTable('#dashboardTable', dashboardOptions)
    }

    function reloaddashboardTable() {
        if (dashboardTable) {
            dashboardTable.ajax.reload(null, false);
        } else {
            renderdashboardTable();
        }
    }
    $(document).ready(function() {
        console.log("hello")
        renderdashboardTable();
    })

    $(document).on("click", ".editButton", function() {
        let type = $(this).data("type");
        let record_id = $(this).data('record_id');
        $(".button-submit").text("Edit Certification");
        let data = dashboardData.find(x => x.record_id == record_id);

        if (type == "ASSOCIATION") {
            resetFormAssociation();
            if (data) {
                populateForm(data, "newassociationform");
                $("#newassociationModal").modal("show");
            }
        }

        if (type == "BOATING") {
            resetBoating();

            if (data) {
                populateForm(data, "newBoatingform");
                $("#newBoatingModal").modal("show");
            }
        }

        if (type == "CHAINSAW") {
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
        }

        if (type == "TREES") {
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
        }

        if (type == "STORE") {
            resetstore();
            if (data) {
                populateForm(data, "newstoreform");
                $("#newstoreModal").modal("show");
            }
        }

        if (type == "TRICYCLE") {
            resettricycle();

            if (data) {
                populateForm(data, "newtricycleform");
                $("#newtricycleModal").modal("show");
            }
        }

        if (type == "VENDOR") {
            resetvendor();
            if (data) {
                populateForm(data, "newvendorform");
                $("#newvendorModal").modal("show");
            }
        }
    });

    function resetFormAssociation() {
        $("#newassociationform")[0].reset();
        $("#newassociationform input[type='hidden']").val(0);
    }

    function resetBoating() {
        $("#newBoatingform")[0].reset();
        $("#newBoatingform input[type='hidden']").val(0);
    }

    function resetchainsaw() {
        $("#newChainsawform")[0].reset();
        $("#newChainsawform input[type='hidden']").val(0);
    }

    function resetstore() {
        $("#newstoreform")[0].reset();
        $("#newstoreform input[type='hidden']").val(0);
    }

    function resettrees() {
        $("#newtreesform")[0].reset();
        $("#newtreesform input[type='hidden']").val(0);
    }

    function resettricycle() {
        $("#newtricycleform")[0].reset();
        $("#newtricycleform input[type='hidden']").val(0);
    }

    function resetvendor() {
        $("#newvendorform")[0].reset();
        $("#newvendorform input[type='hidden']").val(0);
    }

    $(document).on("submit", "#newassociationform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        postRequest("{{ route('save_new_association') }}", formData, (response) => {
            if (response.status == "success") {
                reloaddashboardTable();
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

    $(document).on("submit", "#newBoatingform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        postRequest("{{ route('save_new_boating') }}", formData, (response) => {
            if (response.status == "success") {
                reloaddashboardTable();
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

    $(document).on("submit", "#newChainsawform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });
        formData['chainsawTableRequirements'] = chainsawTableRequirements;
        formData['chainsawTableRequirementsRemoved'] = chainsawTableRequirementsRemoved;
        postRequest("{{ route('save_new_chainsaw') }}", formData, (response) => {
            if (response.status == "success") {
                reloaddashboardTable();
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


    $(document).on("submit", "#newstoreform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        postRequest("{{ route('save_new_store') }}", formData, (response) => {
            if (response.status == "success") {
                reloaddashboardTable();
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
                reloaddashboardTable();
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

    $(document).on("submit", "#newtricycleform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        postRequest("{{ route('save_new_tricycle') }}", formData, (response) => {
            if (response.status == "success") {
                reloaddashboardTable();
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

    $(document).on("submit", "#newvendorform", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        postRequest("{{ route('save_new_vendor') }}", formData, (response) => {
            if (response.status == "success") {
                reloaddashboardTable();
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


    $(document).on("click", ".deleteButton", function(e) {
        e.stopPropagation();
        let record_id = $(this).data('record_id');
        let data = dashboardData.find(x => x.record_id == record_id);

        if (data) {
            Swal.fire({
                title: "Warning",
                text: "Delete this Certification?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    postRequest("{{ route('deleteAssociation') }}", {
                        record_id: data.record_id
                    }, (response) => {
                        if (response.status == "success") {
                            reloaddashboardTable();
                            Swal.fire({
                                title: "Success",
                                text: "Certificate Deleted Successfully",
                                icon: "success",
                                showCancelButton: false,
                            })
                        }
                    })
                }
            });
        }
    })
    $(document).on("change", ".checkthis", function() {
        let index = $(this).attr('data-index');
        let type = $(this).attr('data-type');
        if (type == "chainsaw") {
            let requirement = chainsawTableRequirements?.[index];

            if (requirement) {
                requirement.progress = $(this).is(":checked") ? 1 : 0;
                createNewTableChainsaw(chainsawTableRequirements);
            } else {
                console.warn("No requirement found for index:", index);
            }
        } else {

        }
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
                            <input class="form-check-input checkthis" type="checkbox" data-index="${index}" data-type="chainsaw" style="accent-color: #06500D"
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

    $(document).on("change", ".checkthis-trees", function() {
        let index = $(this).data('index');
        let requirement = treesTableRequirements?.[index];

        if (requirement) {
            requirement.progress = $(this).is(":checked") ? 1 : 0;
            createNewTableTrees(treesTableRequirements);
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
            createNewTableTrees(treesTableRequirements);
        }
    });
</script>
