<div>
    <!-- Contract Attachment Modal -->
    <div class="modal fade" id="contractAttachmentModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"
                x-data="{
                    clientError: '',
                    uploading: false,
                    validateFile(event) {
                        this.clientError = '';
                        const file = event.target.files[0];
                        if (!file) return;

                        const maxBytes = 5 * 1024 * 1024; // 5 MB
                        const allowed = ['application/pdf', 'image/jpeg', 'image/png'];
                        const allowedExt = ['pdf', 'jpg', 'jpeg', 'png'];
                        const ext = file.name.split('.').pop().toLowerCase();

                        if (!allowed.includes(file.type) && !allowedExt.includes(ext)) {
                            this.clientError = 'Format file tidak valid. Hanya PDF, JPG, JPEG, PNG.';
                            event.target.value = '';
                            return;
                        }
                        if (file.size > maxBytes) {
                            this.clientError = 'Ukuran file melebihi 5 MB (' + (file.size / 1024 / 1024).toFixed(2) + ' MB). Pilih file yang lebih kecil.';
                            event.target.value = '';
                            return;
                        }
                    }
                }"
                x-init="
                    $wire.on('livewire-upload-start', () => { uploading = true; });
                    $wire.on('livewire-upload-finish', () => { uploading = false; });
                    $wire.on('livewire-upload-cancel', () => { uploading = false; });
                    $wire.on('livewire-upload-error', () => {
                        uploading = false;
                        clientError = 'Upload gagal. File melebihi batas maksimal server atau format tidak didukung.';
                    });
                "
            >
                <div class="modal-header" style="background:#0f4c75;">
                    <h5 class="modal-title text-white fw-bold">
                        <i class="ti ti-upload me-2"></i>Upload File Kontrak
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">

                    {{-- Server-side errors --}}
                    @if($errors->any())
                    <div class="alert alert-danger small">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Client-side error --}}
                    <div x-show="clientError" x-cloak class="alert alert-danger small" x-text="clientError"></div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">File <span class="text-danger">*</span></label>
                        <input type="file"
                            wire:model="file"
                            class="form-control rounded-3"
                            accept=".pdf,.jpg,.jpeg,.png"
                            @change="validateFile($event)"
                        >
                        <small class="text-muted">Format: PDF, Gambar (JPG, JPEG, PNG). Maks 5 MB.</small>
                    </div>

                    <div x-show="uploading" class="text-center py-2">
                        <span class="spinner-border spinner-border-sm text-primary"></span> Mengupload file...
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button class="btn fw-semibold rounded-pill px-4"
                        style="background:#0f4c75;color:#fff;"
                        wire:click="save"
                        wire:loading.attr="disabled"
                        wire:target="file,save"
                        :disabled="uploading || clientError !== ''"
                    >
                        <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
