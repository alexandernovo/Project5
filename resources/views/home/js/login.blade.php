<script>
    $(document).on('submit', '#login_form', function(e) {
        e.preventDefault();

        $('#error_login').addClass('d-none').text('');

        $.ajax({
            type: 'POST',
            url: '{{ route('login') }}',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {
                    window.location = "{{ route('dashboard') }}";
                } else {
                    $('#error_login').removeClass('d-none').text(response.message);
                }
            },
            error: function(xhr) {
                $('#error_login').removeClass('d-none').text(
                    xhr.responseJSON?.message ?? 'An unexpected error occurred.'
                );
            }
        });
    });
</script>
