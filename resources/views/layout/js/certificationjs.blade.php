<script>
    const certification_routes = [{
            title: "Association",
            route: "{{ route('associationPrint') }}"
        },
        {
            title: "Boating",
            route: "{{ route('boatingPrint') }}"
        },
        {
            title: "Chainsaw",
            route: "{{ route('chainsawPrint') }}"
        },
        {
            title: "Trees",
            route: "{{ route('treesPrint') }}"
        },
        {
            title: "Store",
            route: "{{ route('sarisaristorePrint') }}"
        },
        {
            title: "Tricycle",
            route: "{{ route('tricyclePrint') }}"
        },
        {
            title: "Vendors",
            route: "{{ route('vendorsPrint') }}"
        }
    ];

    function getRouteByTitle(title) {
        const item = certification_routes.find(d => d.title.toLowerCase() === title.toLowerCase());
        return item ? item.route : null;
    }

    $(document).on("submit", "#certification_report_select", function(e) {
        e.preventDefault();
        let typecertification = $("#typecertification").val();
        let month_certification = $("#month_certification").val();
        let route_certification = getRouteByTitle(typecertification);

        if (!route_certification) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Selected certification type not found!"
            });
            return;
        }

        let routefinal = `${route_certification}?monthyear=${month_certification}`;

        window.location.href = routefinal;
    })
</script>
