<div>
    <div wire:ignore.self class="modal fade" id="prInvoiceModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase">
                        <i class="ti ti-receipt me-2"></i> Tambah Dokumen Invoice
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit.prevent="saveInvoice">
                    <div class="modal-body p-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->has('error')): ?>
                        <div class="alert alert-danger p-2 small mb-3">
                            <i class="ti ti-alert-triangle me-1"></i> <?php echo e($errors->first('error')); ?>

                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr): ?>
                        <div class="alert alert-light-secondary border-secondary-subtle small mb-4">
                            <h6 class="fw-bold mb-2">Ringkasan Tagihan (Detail List)</h6>
                            <div class="d-flex justify-content-between mb-1">
                                <span>No. Request</span>
                                <span class="fw-semibold"><?php echo e($pr->pr_number); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span>Total Item</span>
                                <span class="fw-semibold"><?php echo e($pr->details->count()); ?> Items</span>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-2 mt-2">
                                <span class="fw-bold text-uppercase">Grand Total Kalkulasi</span>
                                <span class="fw-bold text-dark fs-6"><?php echo e(number_format($grandTotal, 0, ',', '.')); ?></span>
                            </div>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Invoice / Faktur No. <span class="text-danger">*</span></label>
                                <input type="text" wire:model="invoice_number" class="form-control <?php $__errorArgs = ['invoice_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Contoh: INV-2026/001">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['invoice_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Tanggal Invoice <span class="text-danger">*</span></label>
                                <input type="date" wire:model="invoice_date" class="form-control <?php $__errorArgs = ['invoice_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['invoice_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Tanggal Pengiriman (Opsional)</label>
                                <input type="date" wire:model="delivery_date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">No. Polisi / Kendaraan Truk (Opsional)</label>
                                <input type="text" wire:model="truck" class="form-control" placeholder="Plat Kendaraan">
                            </div>

                            <div class="col-12 mt-4">
                                <label class="fw-bold small text-uppercase">Lampiran Dokumen Invoice (Scan PDF/Image)</label>
                                <input type="file" wire:model="file" class="form-control form-control-lg border-dashed <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept=".pdf,.png,.jpg,.jpeg">
                                <div class="text-muted small mt-1"><i class="ti ti-info-circle me-1"></i> Maksimal ukuran file 5MB. Pastikan file jelas dan terstruktur.</div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-dark rounded-pill px-4 shadow-sm" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="saveInvoice"><i class="ti ti-upload me-1"></i> Simpan Laporan</span>
                            <span wire:loading wire:target="saveInvoice"><i class="ti ti-loader pe-spin me-1"></i> Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php $__env->startPush('scripts'); ?>
    <script>
        window.addEventListener('show-invoice-modal', () => {
            var modal = new bootstrap.Modal(document.getElementById('prInvoiceModal'));
            modal.show();
        });
        window.addEventListener('hide-invoice-modal', () => {
            var modalEl = document.getElementById('prInvoiceModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        });
    </script>
    <?php $__env->stopPush(); ?>
</div>
<?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\payment-requests\invoice-modal.blade.php ENDPATH**/ ?>