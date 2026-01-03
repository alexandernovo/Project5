<script>
    $(document).on("click", ".download-btn", function() {
        let type = $(this).data("type");

        if (!reportData || reportData.length === 0) {
            alert("No data available to download.");
            return;
        }

        // Generate dynamic title
        let reportTitle = "Waste Bottle Report";
        if (categoryWaste === "Overall") {
            reportTitle += " AS OF " + formatMonth(monthWaste);
        } else {
            reportTitle += " OF BARANGAY " + (barangayWaste ?? "") + " AS OF " + formatMonth(monthWaste);
        }

        if (type === "excel") {
            downloadExcel(reportData, reportTitle);
        } else if (type === "word") {
            downloadWord(reportData, reportTitle);
        } else if (type === "pdf") {
            downloadPDF(); // uses printable div
        }
    });

    function formatMonth(monthStr) {
        if (!monthStr) return "";
        let date = new Date(monthStr + "-01");
        const options = {
            year: 'numeric',
            month: 'long'
        };
        return date.toLocaleDateString('en-US', options);
    }

    // ✅ Excel
    function downloadExcel(data, title) {
        let headers = ["No"];
        if (categoryWaste === 'Overall') {
            headers.push("Date");
        } else {
            headers.push("Barangay", "Purok");
        }
        headers.push("Bottle in Kg", "Rice in Kg", "Total");

        let sheetData = [
            [title.toUpperCase()]
        ]; // title row
        sheetData.push([]); // empty row
        sheetData.push(headers.map(h => h.toUpperCase())); // headers uppercase

        data.forEach((row, i) => {
            let rowData = [i + 1];
            if (categoryWaste === 'Overall') {
                rowData.push(row.created_at ? formatDate(row.created_at) : "");
            } else {
                rowData.push(row.brgy ?? "", row.purok ?? "");
            }
            rowData.push(
                row.bottleinkg ?? "",
                row.riceinkg ?? "",
                row.total ?? ""
            );
            sheetData.push(rowData);
        });

        // Grand Total
        let grandTotalRow = [];
        grandTotalRow.push(""); // first column
        if (categoryWaste === 'Overall') {
            grandTotalRow.push("GRAND TOTAL");
        } else {
            grandTotalRow.push("", "GRAND TOTAL");
        }
        grandTotalRow.push(
            totals.bottleinkg ?? "",
            totals.riceinkg ?? "",
            totals.total ?? ""
        );
        sheetData.push(grandTotalRow);

        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.aoa_to_sheet(sheetData);
        XLSX.utils.book_append_sheet(wb, ws, "Waste Bottle Report");
        XLSX.writeFile(wb, "Waste_Bottle_Report.xlsx");
    }

    // ✅ Word
    function downloadWord(data, title) {
        let headers = ["No"];
        if (categoryWaste === 'Overall') {
            headers.push("Date");
        } else {
            headers.push("Barangay", "Purok");
        }
        headers.push("Bottle in Kg", "Rice in Kg", "Total");

        let content = `<h3 style="text-align:center;">${title.toUpperCase()}</h3>
        <table border='1' cellspacing='0' cellpadding='5' style='border-collapse:collapse; width:100%; font-size:12px;'>
            <tr style="background:#f2f2f2;">${headers.map(h => `<th>${h.toUpperCase()}</th>`).join('')}</tr>`;

        data.forEach((row, i) => {
            content += `<tr>`;
            content += `<td>${i + 1}</td>`;
            if (categoryWaste === 'Overall') {
                content += `<td>${row.created_at ? formatDate(row.created_at) : ""}</td>`;
            } else {
                content += `<td>${row.brgy ?? ""}</td><td>${row.purok ?? ""}</td>`;
            }
            content += `<td>${row.bottleinkg ?? ""}</td>`;
            content += `<td>${row.riceinkg ?? ""}</td>`;
            content += `<td>${row.total ?? ""}</td>`;
            content += `</tr>`;
        });

        // Grand Total
        content += `<tr style="font-weight:bold; background:#f2f2f2;">`;
        if (categoryWaste === 'Overall') {
            content += `<td></td><td>GRAND TOTAL</td>`;
        } else {
            content += `<td></td><td></td><td>GRAND TOTAL</td>`;
        }
        content += `<td>${totals.bottleinkg ?? ""}</td>`;
        content += `<td>${totals.riceinkg ?? ""}</td>`;
        content += `<td>${totals.total ?? ""}</td>`;
        content += `</tr>`;

        content += "</table>";

        let blob = new Blob(['\ufeff', content], {
            type: 'application/msword'
        });
        let url = URL.createObjectURL(blob);
        let a = document.createElement("a");
        a.href = url;
        a.download = "Waste_Bottle_Report.doc";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    // ✅ PDF
    function downloadPDF() {
        const element = document.getElementById("printable");
        const opt = {
            margin: 0.5,
            filename: "Waste_Bottle_Report.pdf",
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
