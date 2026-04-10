<div>
    <div wire:ignore.self class="modal fade" id="prPaymentModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase">
                        <i class="fas fa-money-check-alt me-2"></i>
                        <?php echo e($paymentId ? 'Edit Payment' : 'Tambah Payment'); ?>

                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit.prevent="savePayment">
                    <div class="modal-body p-4">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->has('error')): ?>
                        <div class="alert alert-danger p-2 small mb-3">
                            <i class="fas fa-exclamation-triangle me-1"></i> <?php echo e($errors->first('error')); ?>

                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <div class="alert alert-info py-2 small mb-4 d-flex align-items-center justify-content-between">
                            <span><i class="fas fa-info-circle me-1"></i> Sisa tagihan:</span>
                            <strong class="fs-6"><?php echo e(number_format($maxAmount, 2, ',', '.')); ?></strong>
                        </div>

                        <div class="row g-3">

                            
                            <div class="col-12">
                                <label class="fw-bold small text-uppercase">Deskripsi <span class="text-danger">*</span></label>
                                <textarea wire:model.defer="payment_description" rows="2"
                                    class="form-control <?php $__errorArgs = ['payment_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Keterangan payment..."></textarea>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['payment_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Payment Type <span class="text-danger">*</span></label>
                                <select wire:model.defer="payment_type"
                                    class="form-select <?php $__errorArgs = ['payment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Pilih --</option>
                                    <option value="1">Parsial</option>
                                    <option value="2">Full</option>
                                </select>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['payment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Payment Method <span class="text-danger">*</span></label>
                                <select wire:model.defer="payment_method"
                                    class="form-select <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Pilih --</option>
                                    <option value="1">Transfer</option>
                                    <option value="2">Cash</option>
                                </select>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            
                            <div class="col-md-4">
                                <label class="fw-bold small text-uppercase">Bank Name</label>
                                <input type="text" wire:model.defer="nama_bank" class="form-control" placeholder="Nama Bank">
                            </div>

                            
                            <div class="col-md-4">
                                <label class="fw-bold small text-uppercase">Account Name</label>
                                <input type="text" wire:model.defer="nama_penerima" class="form-control" placeholder="Nama Penerima">
                            </div>

                            
                            <div class="col-md-4">
                                <label class="fw-bold small text-uppercase">Account Number</label>
                                <input type="text" wire:model.defer="norek" class="form-control" placeholder="No. Rekening">
                            </div>

                            
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Tanggal Payment <span class="text-danger">*</span></label>
                                <input type="date" wire:model.defer="payment_date"
                                    class="form-control <?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Amount <span class="text-danger">*</span></label>
                                <input type="text" id="payment-amount" wire:model.defer="ammount"
                                    class="form-control text-end <?php $__errorArgs = ['ammount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="0,00" autocomplete="off"
                                    oninput="calcPaymentTotal()" onblur="calcPaymentTotal()">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['ammount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Additional</label>
                                <input type="text" id="payment-additional" wire:model.defer="additional"
                                    class="form-control text-end"
                                    placeholder="0,00" autocomplete="off"
                                    oninput="calcPaymentTotal()" onblur="calcPaymentTotal()">
                                <small class="text-muted">Biaya tambahan (opsional)</small>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Grand Total</label>
                                <input type="text" id="payment-grand-total"
                                    class="form-control text-end bg-light fw-bold"
                                    placeholder="0,00" readonly
                                    value="<?php echo e($grand_total ? number_format($grand_total, 2, ',', '.') : ''); ?>">
                                <input type="hidden" wire:model.defer="grand_total" id="payment-grand-total-hidden">
                            </div>

                            
                            <div class="col-12">
                                <label class="fw-bold small text-uppercase">Bukti Transfer (Opsional)</label>
                                <input type="file" wire:model="file"
                                    class="form-control <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <small class="text-muted">Maks 5MB (PDF, JPG, PNG)</small>
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
                        <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm"
                            wire:loading.attr="disabled" wire:target="savePayment">
                            <span wire:loading.remove wire:target="savePayment">
                                <i class="fas fa-save me-1"></i>
                                <?php echo e($paymentId ? 'Update Payment' : 'Simpan Payment'); ?>

                            </span>
                            <span wire:loading wire:target="savePayment">
                                <i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        // Show/hide modal
        window.addEventListener('show-payment-modal', () => {
            const el = document.getElementById('prPaymentModal');
            new bootstrap.Modal(el).show();
            // Wait for Livewire to render then recalc
            setTimeout(calcPaymentTotal, 200);
        });
        window.addEventListener('hide-payment-modal', () => {
            const el = document.getElementById('prPaymentModal');
            const m = bootstrap.Modal.getInstance(el);
            if (m) m.hide();
        });

        /* ----------------------------------------------------------------
         * Format input: ribuan pakai titik, desimal pakai koma
         * ---------------------------------------------------------------- */
        function applyPaymentFormat(el) {
            if (!el) return;
            el.addEventListener('input', function() {
                let v = this.value.replace(/[^0-9,]/g, '');
                let parts = v.split(',');
                if (parts.length > 2) v = parts.shift() + ',' + parts.join('');
                let [int, dec] = v.split(',');
                int = (int || '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                this.value = dec !== undefined ? `${int},${dec}` : int;
            });
        }

        function parsePaymentID(v) {
            if (!v) return 0;
            return parseFloat(String(v).replace(/\./g, '').replace(',', '.')) || 0;
        }

        function formatPaymentID(n) {
            return (n || 0).toLocaleString('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        window.calcPaymentTotal = function() {
            const amnt = parsePaymentID(document.getElementById('payment-amount')?.value);
            const add = parsePaymentID(document.getElementById('payment-additional')?.value);
            const tot = amnt + add;
            const dispEl = document.getElementById('payment-grand-total');
            const hiddenEl = document.getElementById('payment-grand-total-hidden');
            if (dispEl) dispEl.value = formatPaymentID(tot);
            if (hiddenEl) hiddenEl.value = tot;
        };

        // Init formats when modal opens
        window.addEventListener('show-payment-modal', () => {
            setTimeout(() => {
                applyPaymentFormat(document.getElementById('payment-amount'));
                applyPaymentFormat(document.getElementById('payment-additional'));
                calcPaymentTotal();
            }, 300);
        });
    </script>
    <?php $__env->stopPush(); ?>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\payment-requests\payment-modal.blade.php ENDPATH**/ ?>