@php
$flashSuccess = session('success');
$flashError = session('error') ?: session('pesan');
$flashValidation = count($errors) > 0 ? $errors->first() : null;
@endphp

<div class="modal fade" id="alertModal" tabindex="-1" aria-hidden="true"
    data-flash-success="{{ $flashSuccess }}"
    data-flash-error="{{ $flashError }}"
    data-flash-validation="{{ $flashValidation }}">
    <div class="modal-dialog toast-modal-right">
        <div id="alertContent" class="modal-content border-0 shadow-lg overflow-hidden">
            <div class="modal-body p-0">
                <div class="d-flex p-3">
                    <div id="alertIconBox" class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-3 me-3" style="width: 48px; height: 48px;">
                        <i id="alertIcon" class="ti fs-2 text-white"></i>
                    </div>
                    <div class="flex-grow-1 pe-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 id="alertTitle" class="mb-0 fw-bold text-dark"></h6>
                            <small class="text-muted">Pemberitahuan</small>
                        </div>
                        <p id="alertMessage" class="mb-0 text-muted small"></p>
                    </div>
                    <button type="button" class="btn-close ms-auto small" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="alertProgress" class="progress" style="height: 3px; border-radius: 0;">
                    <div class="progress-bar" role="progressbar" style="width: 0%; transition: width 3s linear;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .toast-modal-right {
        position: fixed;
        top: 25px;
        right: 25px;
        margin: 0;
        width: 380px;
        max-width: calc(100vw - 50px);
        transform: translateX(100%);
        transition: transform 0.3s ease-out;
        z-index: 1060;
    }

    .modal.show .toast-modal-right {
        transform: translateX(0);
    }

    .modal-backdrop.show {
        opacity: 0.1 !important;
    }

    #alertContent {
        border-radius: 12px;
        background: #ffffff;
    }

    [data-pc-theme="dark"] #alertContent {
        background: #1a2531;
    }

    [data-pc-theme="dark"] #alertTitle {
        color: #f7fafc !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alertModalEl = document.getElementById('alertModal');
        const alertModal = new bootstrap.Modal(alertModalEl, {
            backdrop: 'static'
        });
        const alertTitle = document.getElementById('alertTitle');
        const alertMessage = document.getElementById('alertMessage');
        const alertIconBox = document.getElementById('alertIconBox');
        const alertIcon = document.getElementById('alertIcon');
        const alertProgressBar = document.querySelector('#alertProgress .progress-bar');

        let autoCloseTimeout;

        function showAlert(type, title, message) {
            alertTitle.innerText = title || (type === 'success' ? 'Berhasil' : (type === 'warning' ? 'Peringatan' : 'Gagal'));
            alertMessage.innerText = message;

            alertIconBox.className = 'flex-shrink-0 d-flex align-items-center justify-content-center rounded-3 me-3';
            alertProgressBar.className = 'progress-bar';

            if (type === 'success') {
                alertIconBox.classList.add('bg-success');
                alertIcon.className = 'ti ti-circle-check fs-2 text-white';
                alertProgressBar.classList.add('bg-success');
            } else if (type === 'warning') {
                alertIconBox.classList.add('bg-warning');
                alertIcon.className = 'ti ti-alert-circle fs-2 text-white';
                alertProgressBar.classList.add('bg-warning');
            } else {
                alertIconBox.classList.add('bg-danger');
                alertIcon.className = 'ti ti-circle-x fs-2 text-white';
                alertProgressBar.classList.add('bg-danger');
            }

            alertProgressBar.style.width = '0%';
            alertModal.show();
            clearTimeout(autoCloseTimeout);
            setTimeout(() => {
                alertProgressBar.style.width = '100%';
            }, 100);
            autoCloseTimeout = setTimeout(() => {
                alertModal.hide();
            }, 3500);
        }

        // Bridge for Livewire events
        window.addEventListener('alert', event => {
            const detail = event.detail[0] || event.detail;
            showAlert(detail.type, detail.title, detail.message);
        });

        // Read flash data from HTML data attributes — no PHP inside <script>
        const flashSuccess = alertModalEl.dataset.flashSuccess;
        const flashError = alertModalEl.dataset.flashError;
        const flashValidation = alertModalEl.dataset.flashValidation;

        if (flashSuccess) showAlert('success', 'Berhasil', flashSuccess);
        if (flashError) showAlert('danger', 'Gagal', flashError);
        if (flashValidation) showAlert('danger', 'Validasi Gagal', flashValidation);
    });
</script>