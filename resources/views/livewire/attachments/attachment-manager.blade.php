<div>
    {{-- ================================================================
         ATTACHMENT MANAGER - Reusable Component
         Usage: @livewire('attachments.attachment-manager', ['modelType' => 'pr', 'modelId' => $prId, 'canEdit' => true])
    ================================================================ --}}

    {{-- Upload Button & Header --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h6 class="text-primary fw-bold mb-0">
            <i class="fas fa-paperclip me-1"></i> SUPPORTING DOCUMENTS
            <span class="badge bg-secondary rounded-pill ms-1">{{ $attachments->count() }}</span>
        </h6>
        @if($canEdit)
        <button class="btn btn-sm btn-outline-primary rounded-pill px-3"
            wire:click="$dispatch('open-upload-modal')"
            onclick="document.getElementById('attUploadModal-{{ $modelType }}-{{ $modelId }}').classList.add('show'); document.getElementById('attUploadModal-{{ $modelType }}-{{ $modelId }}').style.display='block'; document.body.classList.add('modal-open');">
            <i class="fas fa-file-upload me-1"></i> Upload Baru
        </button>
        @endif
    </div>

    {{-- Attachment Grid --}}
    <div class="row g-3">
        @forelse($attachments as $att)
        @php
        $ext = strtolower(pathinfo($att->filename, PATHINFO_EXTENSION));
        $icon = 'fa-file-alt';
        $color = 'text-secondary';
        if(in_array($ext, ['jpg','jpeg','png','gif','webp'])) { $icon = 'fa-file-image'; $color = 'text-success'; }
        elseif($ext === 'pdf') { $icon = 'fa-file-pdf'; $color = 'text-danger'; }
        elseif(in_array($ext, ['xls','xlsx'])) { $icon = 'fa-file-excel'; $color = 'text-success'; }
        elseif(in_array($ext, ['doc','docx'])) { $icon = 'fa-file-word'; $color = 'text-primary'; }
        $attName = $att->attachment->attachment ?? 'Lampiran';
        $fileUrl = asset('storage/qr/' . $att->filename);
        @endphp
        <div class="col-6 col-md-3 col-lg-2">
            <div class="card h-100 border text-center shadow-sm" style="border-radius: 10px; transition: all 0.2s;">
                <div class="card-body p-3 d-flex flex-column">
                    {{-- Icon --}}
                    <div class="fs-1 {{ $color }} mb-2">
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    {{-- Name --}}
                    <div class="fw-bold text-truncate mb-0" style="font-size: 0.82rem;" title="{{ $attName }}">
                        {{ $attName }}
                    </div>
                    {{-- Meta --}}
                    <small class="text-muted d-block mb-1" style="font-size: 0.7rem;">
                        {{ strtoupper($ext) }}
                        @if($att->note)
                        · <span class="fst-italic">{{ Str::limit($att->note, 20) }}</span>
                        @endif
                    </small>
                    <small class="text-muted d-block mb-2" style="font-size: 0.65rem;">
                        {{ $att->user->name ?? '-' }} · {{ $att->created_at?->format('d/m/Y') }}
                    </small>
                    {{-- Actions --}}
                    <div class="d-flex gap-1 justify-content-center mt-auto">
                        {{-- Preview --}}
                        <button class="btn btn-xs btn-primary px-2 py-1" title="Preview"
                            onclick="attPreview('{{ $fileUrl }}', '{{ addslashes($attName) }}', '{{ addslashes($att->note ?? '') }}')">
                            <i class="fas fa-eye" style="font-size:0.75rem;"></i>
                        </button>
                        {{-- Download --}}
                        <a href="{{ $fileUrl }}" download="{{ $attName }}.{{ $ext }}"
                            class="btn btn-xs btn-secondary px-2 py-1" title="Download">
                            <i class="fas fa-download" style="font-size:0.75rem;"></i>
                        </a>
                        @if($canEdit)
                        {{-- Edit Note --}}
                        <button class="btn btn-xs btn-warning px-2 py-1" title="Edit"
                            wire:click="openEditNote({{ $att->id_attachment_pr }})">
                            <i class="fas fa-pencil-alt" style="font-size:0.75rem;"></i>
                        </button>
                        {{-- Delete --}}
                        <button class="btn btn-xs btn-danger px-2 py-1" title="Hapus"
                            onclick="if(confirm('Yakin hapus lampiran ini?')) $wire.deleteAttachment({{ $att->id_attachment_pr }})">
                            <i class="fas fa-trash" style="font-size:0.75rem;"></i>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-light border text-center py-4 mb-0">
                <i class="fas fa-folder-open text-muted fs-2 mb-2 d-block"></i>
                <p class="mb-0 text-muted small">Belum ada lampiran pendukung.</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- ================================================================
         MODAL: Upload Attachment
    ================================================================ --}}
    <div class="modal fade" id="attUploadModal-{{ $modelType }}-{{ $modelId }}" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <form wire:submit.prevent="addAttachment">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-file-upload me-2"></i> Upload Lampiran
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                            onclick="attCloseUpload('{{ $modelType }}-{{ $modelId }}')"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lampiran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('attachment_name') is-invalid @enderror"
                                wire:model.defer="attachment_name"
                                placeholder="Contoh: Invoice Supplier, Kwitansi, Foto Barang">
                            @error('attachment_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih File <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('attachment_file') is-invalid @enderror"
                                wire:model.defer="attachment_file">
                            <small class="text-muted">Maks 10MB (PDF, JPG, PNG, XLS, DOC)</small>
                            @error('attachment_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div wire:loading wire:target="attachment_file" class="mt-1">
                                <small class="text-primary"><i class="fas fa-spinner fa-spin me-1"></i> Mengupload...</small>
                            </div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-bold">Catatan</label>
                            <textarea class="form-control" wire:model.defer="attachment_note" rows="2"
                                placeholder="Catatan tambahan (opsional)"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light border"
                            onclick="attCloseUpload('{{ $modelType }}-{{ $modelId }}')">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 fw-bold"
                            wire:loading.attr="disabled" wire:target="addAttachment">
                            <span wire:loading.remove wire:target="addAttachment">
                                <i class="fas fa-upload me-1"></i> Upload
                            </span>
                            <span wire:loading wire:target="addAttachment">
                                <i class="fas fa-spinner fa-spin me-1"></i> Mengupload...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ================================================================
         MODAL: Edit Note
    ================================================================ --}}
    @if($editingAttId)
    <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-pencil-alt me-2"></i> Edit Lampiran
                    </h5>
                    <button type="button" class="btn-close" wire:click="cancelEdit"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lampiran <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('editingName') is-invalid @enderror"
                            wire:model.defer="editingName">
                        @error('editingName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold">Catatan</label>
                        <textarea class="form-control" wire:model.defer="editingNote" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light border" wire:click="cancelEdit">Batal</button>
                    <button type="button" class="btn btn-warning px-4 fw-bold text-dark" wire:click="saveEditNote">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ================================================================
         MODAL: Preview Attachment (Shared/Static - satu per halaman)
    ================================================================ --}}
    <div class="modal fade" id="attPreviewModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-dark text-white py-2">
                    <h5 class="modal-title fw-bold" id="attPreviewTitle"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0 bg-dark" style="height: 80vh;">
                    <iframe id="attPreviewFrame" src="" class="w-100 h-100 border-0 d-none"></iframe>
                    <div id="attPreviewImgContainer" class="w-100 h-100 d-none d-flex align-items-center justify-content-center">
                        <img id="attPreviewImg" src="" class="img-fluid" style="max-height: 100%;">
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <small class="text-muted me-auto" id="attPreviewNote"></small>
                    <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Global preview function
        window.attPreview = function(url, name, note) {
            document.getElementById('attPreviewTitle').textContent = name;
            document.getElementById('attPreviewNote').textContent = note || '';
            const frame = document.getElementById('attPreviewFrame');
            const imgC = document.getElementById('attPreviewImgContainer');
            const img = document.getElementById('attPreviewImg');
            const ext = url.split('.').pop().toLowerCase();

            if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
                frame.classList.add('d-none');
                imgC.classList.remove('d-none');
                img.src = url;
            } else {
                imgC.classList.add('d-none');
                frame.classList.remove('d-none');
                frame.src = url;
            }
            new bootstrap.Modal(document.getElementById('attPreviewModal')).show();
        };

        // Open upload modal helper
        window.attOpenUpload = function(key) {
            const el = document.getElementById('attUploadModal-' + key);
            if (!el) return;
            el.classList.add('show');
            el.style.display = 'block';
            document.body.classList.add('modal-open');
        };

        // Close upload modal helper
        window.attCloseUpload = function(key) {
            const el = document.getElementById('attUploadModal-' + key);
            if (!el) return;
            el.classList.remove('show');
            el.style.display = 'none';
            document.body.classList.remove('modal-open');
        };

        // Close upload modal on success
        window.addEventListener('attachment-upload-success', () => {
            document.querySelectorAll('[id^="attUploadModal-"]').forEach(el => {
                el.classList.remove('show');
                el.style.display = 'none';
            });
            document.body.classList.remove('modal-open');
        });
    </script>
    @endpush
</div>