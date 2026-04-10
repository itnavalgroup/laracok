<div>
    

    
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h6 class="text-primary fw-bold mb-0">
            <i class="fas fa-paperclip me-1"></i> SUPPORTING DOCUMENTS
            <span class="badge bg-secondary rounded-pill ms-1"><?php echo e($attachments->count()); ?></span>
        </h6>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEdit): ?>
        <button class="btn btn-sm btn-outline-primary rounded-pill px-3"
            wire:click="$dispatch('open-upload-modal')"
            onclick="document.getElementById('attUploadModal-<?php echo e($modelType); ?>-<?php echo e($modelId); ?>').classList.add('show'); document.getElementById('attUploadModal-<?php echo e($modelType); ?>-<?php echo e($modelId); ?>').style.display='block'; document.body.classList.add('modal-open');">
            <i class="fas fa-file-upload me-1"></i> Upload Baru
        </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div class="row g-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
        <?php
        $ext = strtolower(pathinfo($att->filename, PATHINFO_EXTENSION));
        $icon = 'fa-file-alt';
        $color = 'text-secondary';
        if(in_array($ext, ['jpg','jpeg','png','gif','webp'])) { $icon = 'fa-file-image'; $color = 'text-success'; }
        elseif($ext === 'pdf') { $icon = 'fa-file-pdf'; $color = 'text-danger'; }
        elseif(in_array($ext, ['xls','xlsx'])) { $icon = 'fa-file-excel'; $color = 'text-success'; }
        elseif(in_array($ext, ['doc','docx'])) { $icon = 'fa-file-word'; $color = 'text-primary'; }
        $attName = $att->attachment->attachment ?? 'Lampiran';
        $fileUrl = asset('storage/qr/' . $att->filename);
        ?>
        <div class="col-6 col-md-3 col-lg-2">
            <div class="card h-100 border text-center shadow-sm" style="border-radius: 10px; transition: all 0.2s;">
                <div class="card-body p-3 d-flex flex-column">
                    
                    <div class="fs-1 <?php echo e($color); ?> mb-2">
                        <i class="fas <?php echo e($icon); ?>"></i>
                    </div>
                    
                    <div class="fw-bold text-truncate mb-0" style="font-size: 0.82rem;" title="<?php echo e($attName); ?>">
                        <?php echo e($attName); ?>

                    </div>
                    
                    <small class="text-muted d-block mb-1" style="font-size: 0.7rem;">
                        <?php echo e(strtoupper($ext)); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($att->note): ?>
                        · <span class="fst-italic"><?php echo e(Str::limit($att->note, 20)); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </small>
                    <small class="text-muted d-block mb-2" style="font-size: 0.65rem;">
                        <?php echo e($att->user->name ?? '-'); ?> · <?php echo e($att->created_at?->format('d/m/Y')); ?>

                    </small>
                    
                    <div class="d-flex gap-1 justify-content-center mt-auto">
                        
                        <button class="btn btn-xs btn-primary px-2 py-1" title="Preview"
                            onclick="attPreview('<?php echo e($fileUrl); ?>', '<?php echo e(addslashes($attName)); ?>', '<?php echo e(addslashes($att->note ?? '')); ?>')">
                            <i class="fas fa-eye" style="font-size:0.75rem;"></i>
                        </button>
                        
                        <a href="<?php echo e($fileUrl); ?>" download="<?php echo e($attName); ?>.<?php echo e($ext); ?>"
                            class="btn btn-xs btn-secondary px-2 py-1" title="Download">
                            <i class="fas fa-download" style="font-size:0.75rem;"></i>
                        </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEdit): ?>
                        
                        <button class="btn btn-xs btn-warning px-2 py-1" title="Edit"
                            wire:click="openEditNote(<?php echo e($att->id_attachment_pr); ?>)">
                            <i class="fas fa-pencil-alt" style="font-size:0.75rem;"></i>
                        </button>
                        
                        <button class="btn btn-xs btn-danger px-2 py-1" title="Hapus"
                            onclick="if(confirm('Yakin hapus lampiran ini?')) $wire.deleteAttachment(<?php echo e($att->id_attachment_pr); ?>)">
                            <i class="fas fa-trash" style="font-size:0.75rem;"></i>
                        </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <div class="col-12">
            <div class="alert alert-light border text-center py-4 mb-0">
                <i class="fas fa-folder-open text-muted fs-2 mb-2 d-block"></i>
                <p class="mb-0 text-muted small">Belum ada lampiran pendukung.</p>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div class="modal fade" id="attUploadModal-<?php echo e($modelType); ?>-<?php echo e($modelId); ?>" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <form wire:submit.prevent="addAttachment">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-file-upload me-2"></i> Upload Lampiran
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                            onclick="attCloseUpload('<?php echo e($modelType); ?>-<?php echo e($modelId); ?>')"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lampiran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['attachment_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                wire:model.defer="attachment_name"
                                placeholder="Contoh: Invoice Supplier, Kwitansi, Foto Barang">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['attachment_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih File <span class="text-danger">*</span></label>
                            <input type="file" class="form-control <?php $__errorArgs = ['attachment_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                wire:model.defer="attachment_file">
                            <small class="text-muted">Maks 10MB (PDF, JPG, PNG, XLS, DOC)</small>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['attachment_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                            onclick="attCloseUpload('<?php echo e($modelType); ?>-<?php echo e($modelId); ?>')">Batal</button>
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

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editingAttId): ?>
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
                        <input type="text" class="form-control <?php $__errorArgs = ['editingName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            wire:model.defer="editingName">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editingName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
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

    <?php $__env->startPush('scripts'); ?>
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
    <?php $__env->stopPush(); ?>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\attachments\attachment-manager.blade.php ENDPATH**/ ?>