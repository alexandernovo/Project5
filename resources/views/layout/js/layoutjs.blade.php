<script>
    $(document).on("click", ".logout-btn", function() {
        Swal.fire({
            title: "Logout?",
            text: "Are you sure you want to logout?",
            icon: 'question',
            imageWidth: 128,
            imageHeight: 128,
            showCancelButton: true,
            confirmButtonText: "Yes, Logout",
            cancelButtonText: "No, Stay Login",
            reverseButtons: true,
            backdrop: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'btn btn-danger ms-2',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                let timerInterval;
                return Swal.fire({
                    title: "Log out",
                    html: "Logging out in <b></b> seconds",
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getHtmlContainer().querySelector('b');
                        timerInterval = setInterval(() => {
                            const secondsLeft = Math.ceil(Swal.getTimerLeft() /
                                1000);
                            timer.textContent = `${secondsLeft}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        postRequest("{{ route('auth.logout') }}", {}, (response) => {
                            if (response.status == "success") {
                                window.location.href = "{{ route('home') }}";
                            }
                        })
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                console.log("Logout canceled");
            }
        });
    })
    $(document).ready(function() {
        $('.toast').each(function() {
            var toast = new bootstrap.Toast(this);
            toast.show();
        });
    });
</script>
