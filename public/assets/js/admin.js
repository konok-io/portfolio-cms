document.addEventListener('DOMContentLoaded', function () {
    // --- Sidebar toggle (mobile) ---
    const toggleBtn = document.querySelector('.sidebar-toggle-btn');
    const sidebar = document.querySelector('.admin-sidebar');

    toggleBtn?.addEventListener('click', function () {
        sidebar?.classList.toggle('show');
    });

    document.addEventListener('click', function (e) {
        if (window.innerWidth <= 991 && sidebar?.classList.contains('show')) {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        }
    });

    // --- SweetAlert2 delete confirmation for forms with [data-confirm-delete] ---
    document.querySelectorAll('[data-confirm-delete]').forEach((form) => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const message = form.dataset.confirmDelete || 'This action cannot be undone.';

            if (window.Swal) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            } else if (confirm(message)) {
                form.submit();
            }
        });
    });

    // --- Auto-dismiss alerts ---
    document.querySelectorAll('.alert-auto-dismiss').forEach((alert) => {
        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 300);
        }, 4000);
    });

    // --- Image input live preview for inputs with [data-preview-target] ---
    document.querySelectorAll('[data-preview-target]').forEach((input) => {
        input.addEventListener('change', function () {
            const target = document.querySelector(this.dataset.previewTarget);
            if (target && this.files && this.files[0]) {
                target.src = URL.createObjectURL(this.files[0]);
            }
        });
    });

    // --- Success/error toast from session flash (rendered server-side as data attrs on body) ---
    const flashSuccess = document.body.dataset.flashSuccess;
    const flashError = document.body.dataset.flashError;

    if (flashSuccess && window.Swal) {
        Swal.fire({ icon: 'success', title: 'Success', text: flashSuccess, confirmButtonColor: '#2563EB', timer: 3500, timerProgressBar: true });
    }
    if (flashError && window.Swal) {
        Swal.fire({ icon: 'error', title: 'Error', text: flashError, confirmButtonColor: '#2563EB' });
    }
});
