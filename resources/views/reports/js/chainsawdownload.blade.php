<script>
    $(document).on("click", ".download-btn", function() {
        let type = $(this).data("type");

        if (!reportData || reportData.length === 0) {
            alert("No data available to download.");
            return;
        }

        if (type === "excel") {
            downloadExcel(reportData);
        } else if (type === "word") {
            downloadWord(reportData);
        } else if (type === "pdf") {
            downloadPDF();
        }
    });

    // ✅ Excel Export
    function downloadExcel(data) {
        // Define headers
        let sheetData = [
            ["No", "Name of Owner", "OR Number", "Brand", "Model No.", "Serial No.", "Address", "Date"]
        ];

        // Push rows
        data.forEach((row, i) => {
            sheetData.push([
                i + 1,
                row.owner_name ?? "",
                row.ornumber ?? "",
                row.brand ?? "",
                row.model_no ?? "",
                row.serial_no ?? "",
                row.address ?? "",
                row.created_at ? formatDate(row.created_at) : ""
            ]);
        });

        // Create workbook
        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.aoa_to_sheet(sheetData);
        XLSX.utils.book_append_sheet(wb, ws, "Chainsaw Report");

        // Download file
        XLSX.writeFile(wb, "Chainsaw_Report.xlsx");
    }

    // ✅ Word Export
    function downloadWord(data) {
        let content = `
            <h3 style="text-align:center;">Chainsaw Report</h3>
            <table border='1' cellspacing='0' cellpadding='5' style='border-collapse:collapse; width:100%; font-size:12px;'>
                <tr style="background:#f2f2f2;">
                    <th>No</th>
                    <th>Name of Owner</th>
                    <th>OR Number</th>
                    <th>Brand</th>
                    <th>Model No.</th>
                    <th>Serial No.</th>
                    <th>Address</th>
                    <th>Date</th>
                </tr>
        `;

        data.forEach((row, i) => {
            content += `
                <tr>
                    <td>${i + 1}</td>
                    <td>${row.owner_name ?? ""}</td>
                    <td>${row.ornumber ?? ""}</td>
                    <td>${row.brand ?? ""}</td>
                    <td>${row.model_no ?? ""}</td>
                    <td>${row.serial_no ?? ""}</td>
                    <td>${row.address ?? ""}</td>
                    <td>${row.created_at ? formatDate(row.created_at) : ""}</td>
                </tr>`;
        });

        content += "</table>";

        let blob = new Blob(['\ufeff', content], {
            type: 'application/msword'
        });
        let url = URL.createObjectURL(blob);
        let a = document.createElement("a");
        a.href = url;
        a.download = "Chainsaw_Report.doc";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    // ✅ PDF Export
    function downloadPDF() {
        const element = document.getElementById("printable");
        const opt = {
            margin: 0.5,
            filename: "Chainsaw_Report.pdf",
            image: {
                type: "jpeg",
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: "in",
                format: "a4",
                orientation: "portrait"
            }
        };
        html2pdf().set(opt).from(element).save();
    }

    // ✅ Helper: Format date
    function formatDate(dateString) {
        const options = {
            year: 'numeric',
            month: 'long',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit'
        };
        return new Date(dateString).toLocaleString('en-US', options);
    }
</script>
