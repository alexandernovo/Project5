<script>
    $(document).ready(function() {

        // List of all Summernote editors
        var editors = ['#description', '#signatory', '#ornodescription'];

        // Keep track of the last focused editor
        var lastFocusedEditor = '#description'; // default

        function initEditor(id, height, width = null) {
            var editor = $(id);

            editor.summernote({
                height: height,
                width: width,
                dialogsInBody: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'superscript']],
                    ['view', ['fullscreen']]
                ],
                callbacks: {
                    onInit: function() {
                        // Save cursor position and track focus
                        editor.on('summernote.keyup summernote.mouseup focus', function() {
                            editor.summernote('saveRange');
                            lastFocusedEditor = id; // mark this editor as last focused
                        });
                    }
                }
            });
        }

        // Initialize all editors
        initEditor('#description', 290);
        initEditor('#signatory', 100, 350);
        initEditor('#ornodescription', 90, 350);

        // Insert badge at the last focused editor
        $('.badge-choice').on('click', function() {
            var badgeText = $(this).data('badge');
            var html = '<strong class="highlight-bg-cert" contenteditable="false">' + badgeText +
                '</strong>';

            // Restore cursor of last focused editor
            $(lastFocusedEditor).summernote('restoreRange');

            // Insert badge at cursor
            $(lastFocusedEditor).summernote('pasteHTML', html);

            // Focus editor after inserting
            $(lastFocusedEditor).summernote('focus');
        });

    });

    $(document).on("submit", "#form_certification", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        postRequest("{{ route('saveCertification') }}", formData, (response) => {
            if (response.status == "success") {
                Swal.fire({
                    title: "Success",
                    text: "Certification Updated Successfully",
                    icon: "success",
                    showCancelButton: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
        });
    });
</script>
