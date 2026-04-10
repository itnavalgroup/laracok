<div>
    <div wire:ignore.self class="modal fade" id="modalLoan" tabindex="-1" aria-labelledby="modalLoanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="saveLoan">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLoanLabel">Input Loan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="loan" class="form-label">Loan</label>
                            <select id="loan" class="form-select" wire:model="id_loan">
                                <option value="">-</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($loanItem->id_loan); ?>"><?php echo e($loanItem->loan); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading wire:target="saveLoan" class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('livewire:init', () => {
            window.addEventListener('show-loan-modal', () => {
                const modal = new bootstrap.Modal(document.getElementById('modalLoan'));
                modal.show();
            });

            window.addEventListener('hide-loan-modal', () => {
                const modalEl = document.getElementById('modalLoan');
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) {
                    modal.hide();
                }
                // Ensure backdrop is removed correctly to avoiding ghost overlays
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            });
        });
    </script>
    <?php $__env->stopPush(); ?>
</div>
<?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\payment-requests\loan-modal.blade.php ENDPATH**/ ?>