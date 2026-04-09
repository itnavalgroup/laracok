                
                <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Preview Dokumen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="bg-light p-3 border rounded mb-3">
                                    <div class="small mb-1">
                                        <strong>Note:</strong> <span id="previewNote" class="text-dark"></span>
                                    </div>
                                    <div class="small">
                                        <strong>Attachment:</strong> <span id="previewAttachment"
                                            class="text-dark"></span>
                                    </div>
                                </div>
                                <div id="previewBody" class="text-center p-2 rounded"
                                    style="min-height: 400px; background: #fff; border: 1px solid #dee2e6;">
                                    <div class="spinner-border text-primary mt-5" role="status"></div>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 d-flex justify-content-end gap-2">
                                <a href="#" id="downloadBtn" class="btn btn-primary d-none" download>
                                    <i class="ti ti-download"></i>
                                </a>
                                <button type="button" id="editBtn" class="btn btn-warning px-4"
                                    style="display:none;">
                                    <i class="ti ti-edit me-1"></i>Edit
                                </button>
                                <button type="button" id="deleteBtn" class="btn btn-danger px-4"
                                    style="display:none;">
                                    <i class="ti ti-trash me-1"></i>Hapus
                                </button>
                                <button type="button" class="btn btn-secondary px-4"
                                    data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="modal fade" id="modalEditAttachment" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form id="formEditAttachment" method="POST" action=""
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?> <?php echo method_field('POST'); ?> 
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Attachment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small text-uppercase">Note <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="note" id="edit_note" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small text-uppercase">Attachment Type <span class="text-danger">*</span></label>
                                        <select class="form-select" name="id_attachment" id="edit_id_attachment"
                                            required>
                                            <option value="">- Select Type -</option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\Attachment::orderBy('attachment')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                                <option value="<?php echo e($type->id_attachment); ?>"><?php echo e($type->attachment); ?>

                                                </option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Replace File (Optional)</label>
                                        <div class="btn-group w-100 mb-2" role="group">
                                            <input type="radio" class="btn-check" name="edit_upload_mode"
                                                id="editModeUpload" value="upload" checked>
                                            <label class="btn btn-outline-primary btn-sm" for="editModeUpload"><i
                                                    class="ti ti-upload me-1"></i> Upload</label>
                                            <input type="radio" class="btn-check" name="edit_upload_mode"
                                                id="editModeCamera" value="camera">
                                            <label class="btn btn-outline-primary btn-sm" for="editModeCamera"><i
                                                    class="ti ti-camera me-1"></i> Camera</label>
                                        </div>

                                        <div id="edit_upload_container">
                                            <input type="file" class="form-control" name="filename"
                                                id="input_edit_file" accept="image/*,application/pdf">
                                        </div>
                                        <div id="edit_camera_container" class="d-none">
                                            <div class="camera-wrapper bg-light rounded p-2 text-center border">
                                                <video id="video_edit" width="100%" height="auto" autoplay
                                                    class="rounded mb-2 d-none"></video>
                                                <canvas id="canvas_edit" class="d-none"></canvas>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" id="start-camera-edit"
                                                        class="btn btn-sm btn-info rounded-pill px-3">
                                                        <i class="ti ti-video me-1"></i> Start Camera
                                                    </button>
                                                    <button type="button" id="take-photo-edit"
                                                        class="btn btn-sm btn-success rounded-pill px-3 d-none">
                                                        <i class="ti ti-camera me-1"></i> Capture
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="captured_photo" id="captured_photo_edit">
                                        <input type="hidden" name="captured_photo_mime"
                                            id="captured_photo_mime_edit">
                                        <div class="small text-muted mt-1">Maksimal 5MB. Format: JPG, JPEG, PNG, PDF.
                                        </div>
                                    </div>
                                    <div id="edit_gallery_container" class="mt-2 d-none">
                                        <label class="form-label small fw-bold">Captured Photos:</label>
                                        <div class="d-flex flex-wrap gap-2 p-2 border rounded bg-light"
                                            id="edit_gallery_list">
                                            <!-- Photos will be appended here -->
                                        </div>
                                        <div class="small text-muted mt-1">Single photo will be saved as image,
                                            multiple as PDF.</div>
                                    </div>
                                    <div id="edit_preview_container" class="mt-2 d-none">
                                        <label class="form-label small fw-bold"
                                            id="edit_preview_label">Preview:</label>
                                        <div class="border rounded p-2 text-center bg-light position-relative">
                                            <img id="edit_preview_img" src=""
                                                class="img-fluid rounded d-none" style="max-height: 200px;">
                                            <div id="edit_preview_pdf" class="d-none">
                                                <i class="ti ti-file-text fs-1 text-danger"></i>
                                                <div class="small fw-bold text-muted mt-1" id="edit_pdf_name">
                                                    Merged_Attachment.pdf</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" id="btnUploadEdit"
                                        class="btn btn-warning px-4">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                
                <div class="modal fade" id="modalAddAttachment" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form id="formAddAttachment" method="POST"
                                action="<?php echo e(route('production.attachment.store', $productionHash)); ?>"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Attachment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small text-uppercase">Note <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="note" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small text-uppercase">Attachment <span class="text-danger">*</span></label>
                                        <select class="form-select select2" name="id_attachment" required>
                                            <option value="">-</option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\Attachment::orderBy('attachment')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                                <option value="<?php echo e($att->id_attachment); ?>"><?php echo e($att->attachment); ?>

                                                </option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold small text-uppercase">File (Image/PDF) <span class="text-danger">*</span></label>
                                        <div class="btn-group w-100 mb-2" role="group">
                                            <input type="radio" class="btn-check" name="add_upload_mode"
                                                id="addModeUpload" value="upload" checked>
                                            <label class="btn btn-outline-primary btn-sm" for="addModeUpload"><i
                                                    class="ti ti-upload me-1"></i> Upload</label>
                                            <input type="radio" class="btn-check" name="add_upload_mode"
                                                id="addModeCamera" value="camera">
                                            <label class="btn btn-outline-primary btn-sm" for="addModeCamera"><i
                                                    class="ti ti-camera me-1"></i> Camera</label>
                                        </div>

                                        <div id="add_upload_container">
                                            <input type="file" class="form-control" name="filename"
                                                id="input_add_file" accept="image/*,application/pdf">
                                        </div>
                                        <div id="add_camera_container" class="d-none">
                                            <div class="camera-wrapper bg-light rounded p-2 text-center border">
                                                <video id="video_add" width="100%" height="auto" autoplay
                                                    class="rounded mb-2 d-none"></video>
                                                <canvas id="canvas_add" class="d-none"></canvas>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" id="start-camera-add"
                                                        class="btn btn-sm btn-info rounded-pill px-3">
                                                        <i class="ti ti-video me-1"></i> Start Camera
                                                    </button>
                                                    <button type="button" id="take-photo-add"
                                                        class="btn btn-sm btn-success rounded-pill px-3 d-none">
                                                        <i class="ti ti-camera me-1"></i> Capture
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="captured_photo" id="captured_photo_add">
                                        <input type="hidden" name="captured_photo_mime"
                                            id="captured_photo_mime_add">
                                    </div>
                                    <div id="add_gallery_container" class="mt-2 d-none">
                                        <label class="form-label small fw-bold">Captured Photos:</label>
                                        <div class="d-flex flex-wrap gap-2 p-2 border rounded bg-light"
                                            id="add_gallery_list">
                                            <!-- Photos will be appended here -->
                                        </div>
                                        <div class="small text-muted mt-1">Single photo will be saved as image,
                                            multiple as PDF.</div>
                                    </div>
                                    <div id="add_preview_container" class="mt-2 d-none">
                                        <label class="form-label small fw-bold"
                                            id="add_preview_label">Preview:</label>
                                        <div class="border rounded p-2 text-center bg-light position-relative">
                                            <img id="add_preview_img" src="" class="img-fluid rounded d-none"
                                                style="max-height: 200px;">
                                            <div id="add_preview_pdf" class="d-none">
                                                <i class="ti ti-file-text fs-1 text-danger"></i>
                                                <div class="small fw-bold text-muted mt-1" id="add_pdf_name">
                                                    Merged_Attachment.pdf</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" id="btnUploadAdd" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


<?php /**PATH D:\!Kerja\laracok - Copy\resources\views/livewire/production/attachment-modals.blade.php ENDPATH**/ ?>