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
        let sheetData = [
            ["No", "Name of Owner", "OR Number", "Owner of Trees", "Lot No.", "Address", "Date"]
        ];

        data.forEach((row, i) => {
            sheetData.push([
                i + 1,
                row.owner_name ?? "",
                row.ornumber ?? "",
                row.name_other ?? "",
                row.lot_no ?? "",
                row.address ?? "",
                row.created_at ? formatDate(row.created_at) : ""
            ]);
        });

        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.aoa_to_sheet(sheetData);
        XLSX.utils.book_append_sheet(wb, ws, "Cutting Trees Report");

        XLSX.writeFile(wb, "Cutting_Trees_Report.xlsx");
    }

    // ✅ Word Export
    function downloadWord(data) {
        let content = `
            <h3 style="text-align:center;">Cutting Trees Report</h3>
            <table border='1' cellspacing='0' cellpadding='5' 
                style='border-collapse:collapse; width:100%; font-size:12px;'>
                <tr style="background:#f2f2f2;">
                    <th>No</th>
                    <th>Name of Owner</th>
                    <th>OR Number</th>
                    <th>Owner of Trees</th>
                    <th>Lot No.</th>
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
                    <td>${row.name_other ?? ""}</td>
                    <td>${row.lot_no ?? ""}</td>
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
        a.download = "Cutting_Trees_Report.doc";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    // ✅ PDF Export
    function downloadPDF() {
        const element = document.getElementById("printable");
        const opt = {
            margin: 0.5,
            filename: "Cutting_Trees_Report.pdf",
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

    // ✅ Print Button
    document.getElementById("printBtn").addEventListener("click", function() {
        const printContents = document.getElementById("printable").innerHTML;
        const originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    });

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
