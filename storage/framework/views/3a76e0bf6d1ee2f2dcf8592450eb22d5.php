<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
            <div class="modal-body p-4 text-center">
                <div id="confirmIconContainer" class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px;">
                    <i id="confirmIcon" class="ti fs-1"></i>
                </div>
                <h4 id="confirmTitle" class="fw-bold mb-2 text-dark"></h4>
                <p id="confirmMessage" class="text-muted mb-4"></p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" id="confirmBtn" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #confirmModal .modal-content {
        background: #ffffff;
    }

    [data-pc-theme="dark"] #confirmModal .modal-content {
        background: #1a2531;
    }

    [data-pc-theme="dark"] #confirmTitle {
        color: #f7fafc !important;
    }

    #confirmIconContainer.bg-primary-subtle {
        background-color: rgba(67, 97, 238, 0.1) !important;
        color: #4361ee;
    }

    #confirmIconContainer.bg-danger-subtle {
        background-color: rgba(239, 68, 68, 0.1) !important;
        color: #ef4444;
    }

    #confirmIconContainer.bg-warning-subtle {
        background-color: rgba(245, 158, 11, 0.1) !important;
        color: #f59e0b;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmModalEl = document.getElementById('confirmModal');
        const confirmModal = new bootstrap.Modal(confirmModalEl);

        const confirmTitle = document.getElementById('confirmTitle');
        const confirmMessage = document.getElementById('confirmMessage');
        const confirmIcon = document.getElementById('confirmIcon');
        const confirmIconContainer = document.getElementById('confirmIconContainer');
        const confirmBtn = document.getElementById('confirmBtn');

        let confirmCallback = null;

        window.showConfirm = function(options) {
            const {
                title = 'Konfirmasi',
                    message = 'Apakah Anda yakin ingin melanjutkan?',
                    type = 'primary',
                    onConfirm = null,
                    btnText = 'Ya, Lanjutkan'
            } = options;

            confirmTitle.innerText = title;
            confirmMessage.innerText = message;
            confirmBtn.innerText = btnText;
            confirmCallback = onConfirm;

            // Reset classes
            confirmIconContainer.className = 'mb-3 d-inline-flex align-items-center justify-content-center rounded-circle';
            confirmBtn.className = 'btn rounded-pill px-4 fw-semibold shadow-sm';

            // Set Style based on type
            if (type === 'danger') {
                confirmIconContainer.classList.add('bg-danger-subtle');
                confirmIcon.className = 'ti ti-trash fs-1';
                confirmBtn.classList.add('btn-danger');
            } else if (type === 'warning') {
                confirmIconContainer.classList.add('bg-warning-subtle');
                confirmIcon.className = 'ti ti-alert-triangle fs-1';
                confirmBtn.classList.add('btn-warning');
            } else {
                confirmIconContainer.classList.add('bg-primary-subtle');
                confirmIcon.className = 'ti ti-help fs-1';
                confirmBtn.classList.add('btn-primary');
            }

            confirmModal.show();
        };

        confirmBtn.addEventListener('click', function() {
            if (confirmCallback && typeof confirmCallback === 'function') {
                confirmCallback();
            }
            confirmModal.hide();
        });

        // Bridge for Livewire (if needed)
        window.addEventListener('confirm-modal', event => {
            const detail = event.detail[0] || event.detail;
            showConfirm({
                ...detail,
                onConfirm: () => {
                    Livewire.dispatch(detail.action, {
                        id: detail.id
                    });
                }
            });
        });
    });
</script><?php /**PATH D:\!Kerja\laracok - Copy\resources\views/components/confirm-modal.blade.php ENDPATH**/ ?>