<script>
    $(document).ready(function() {
        $("#printBtn").on("click", function() {
            // Get the printable div
            var content = $("#printable").html();

            // Window size
            var w = screen.availWidth;
            var h = screen.availHeight;

            // Center position
            var left = (screen.width / 2) - (w / 2);
            var top = (screen.height / 2) - (h / 2);

            // Open a new centered window
            var printWindow = window.open("", "", `width=${w},height=${h},top=${top},left=${left}`);

            // Write the new HTML structure with the external stylesheet
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Incident Report</title>
                        <link rel="stylesheet" href="{{ asset('template_assets/css/styles.min.css') }}">
                    </head>
                    <body>
                        ${content}
                    </body>
                </html>
            `);

            setTimeout(() => {
                printWindow.document.close();
                printWindow.print();
                printWindow.close();
            }, 500);
        });
    });
</script>
