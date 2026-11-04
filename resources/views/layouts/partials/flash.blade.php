@if (session('success') || session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = @json(session('success'));
            const errorMessage = @json(session('error'));

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            if (successMessage) {
                Toast.fire({
                    icon: 'success',
                    title: successMessage
                });
            }

            if (errorMessage) {
                Toast.fire({
                    icon: 'error',
                    title: errorMessage
                });
            }
        });
    </script>
@endif
