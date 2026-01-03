<script>
$(document).on("click", ".download-btn", function() {
    let type = $(this).data("type");

    if (!reportData || reportData.length === 0) {
        alert("No data available to download.");
        return;
    }

    // Generate dynamic title based on category and month
    let reportTitle = "Waste Collection Report";
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
        downloadPDF(); // uses printable div, already dynamic
    }
});

// ✅ Helper: format Month
function formatMonth(monthStr) {
    if (!monthStr) return "";
    let date = new Date(monthStr + "-01");
    const options = { year: 'numeric', month: 'long' };
    return date.toLocaleDateString('en-US', options);
}

// ✅ Excel Export
function downloadExcel(data, title) {
    let headers = ["No"];
    if (categoryWaste != 'Overall') {
        headers.push("Date");
    } else {
        headers.push("Barangay", "Purok");
    }
    headers.push("Biodegradable", "Non-Biodegradable", "Recyclable", "Special Waste", "Total");

    let sheetData = [[title ? title.toUpperCase() : '']]; // first row is title
    sheetData.push([]); // empty row after title
    sheetData.push(headers);

    data.forEach((row, i) => {
        let rowData = [i + 1];
        if (categoryWaste != 'Overall') {
            rowData.push(row.created_at ? formatDate(row.created_at) : "");
        } else {
            rowData.push(row.barangay ?? "", row.purok ?? "");
        }
        rowData.push(
            row.biodegradable ?? "",
            row.nonbio ?? "",
            row.recyclable ?? "",
            row.specialwaste ?? "",
            row.total ?? ""
        );
        sheetData.push(rowData);
    });

    // Add Grand Total row
    let grandTotalRow = [];
    grandTotalRow.push("");
    if (categoryWaste != 'Overall') {
        grandTotalRow.push("GRAND TOTAL");
    } else {
        grandTotalRow.push("", "", "GRAND TOTAL");
    }
    grandTotalRow.push(
        totals.biodegradable ?? "",
        totals.nonbio ?? "",
        totals.recyclable ?? "",
        totals.specialwaste ?? "",
        totals.grand_total ?? ""
    );
    sheetData.push(grandTotalRow);

    let wb = XLSX.utils.book_new();
    let ws = XLSX.utils.aoa_to_sheet(sheetData);
    XLSX.utils.book_append_sheet(wb, ws, "Waste Collection Report");
    XLSX.writeFile(wb, "Waste_Collection_Report.xlsx");
}

// ✅ Word Export
function downloadWord(data, title) {
    let headers = ["No"];
    if (categoryWaste != 'Overall') {
        headers.push("Date");
    } else {
        headers.push("Barangay", "Purok");
    }
    headers.push("Biodegradable", "Non-Biodegradable", "Recyclable", "Special Waste", "Total");

    let content = `<h3 style="text-align:center;">${title ? title.toUpperCase() : ''}</h3>
        <table border='1' cellspacing='0' cellpadding='5' style='border-collapse:collapse; width:100%; font-size:12px;'>
            <tr style="background:#f2f2f2;">
                ${headers.map(h => `<th>${h}</th>`).join('')}
            </tr>`;

    data.forEach((row, i) => {
        content += `<tr>`;
        content += `<td>${i + 1}</td>`;
        if (categoryWaste != 'Overall') {
            content += `<td>${row.created_at ? formatDate(row.created_at) : ""}</td>`;
        } else {
            content += `<td>${row.barangay ?? ""}</td><td>${row.purok ?? ""}</td>`;
        }
        content += `<td>${row.biodegradable ?? ""}</td>`;
        content += `<td>${row.nonbio ?? ""}</td>`;
        content += `<td>${row.recyclable ?? ""}</td>`;
        content += `<td>${row.specialwaste ?? ""}</td>`;
        content += `<td>${row.total ?? ""}</td>`;
        content += `</tr>`;
    });

    // Grand Total row
    content += `<tr style="font-weight:bold; background:#f2f2f2;">`;
    if (categoryWaste != 'Overall') {
        content += `<td></td><td>GRAND TOTAL</td>`;
    } else {
        content += `<td></td><td></td><td>GRAND TOTAL</td>`;
    }
    content += `<td>${totals.biodegradable ?? ""}</td>`;
    content += `<td>${totals.nonbio ?? ""}</td>`;
    content += `<td>${totals.recyclable ?? ""}</td>`;
    content += `<td>${totals.specialwaste ?? ""}</td>`;
    content += `<td>${totals.grand_total ?? ""}</td>`;
    content += `</tr>`;

    content += "</table>";

    let blob = new Blob(['\ufeff', content], { type: 'application/msword' });
    let url = URL.createObjectURL(blob);
    let a = document.createElement("a");
    a.href = url;
    a.download = "Waste_Collection_Report.doc";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

// ✅ PDF Export (from printable div)
function downloadPDF() {
    const element = document.getElementById("printable");
    const opt = {
        margin: 0.5,
        filename: "Waste_Collection_Report.pdf",
        image: { type: "jpeg", quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: "in", format: "a4", orientation: "portrait" }
    };
    html2pdf().set(opt).from(element).save();
}

// ✅ Helper: Format date
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: '2-digit', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleString('en-US', options);
}
</script>
