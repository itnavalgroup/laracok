<div class="warehouse-management" wire:poll.5s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">WAREHOUSE</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary h-100 text-white">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Warehouses</h6>
                            <h2 class="mb-0 fw-bold"><?php echo e($totalWarehouses); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">Warehouse Management</h4>
                                <p class="text-muted small mb-0">Manage storage locations and warehouses</p>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('warehouse.create')): ?>
                            <button wire:click="create" class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center gap-2">
                                <i class="ti ti-plus fs-4"></i>
                                <span class="fw-semibold text-uppercase">Add Warehouse</span>
                            </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="col-12 mb-4">
            <div class="filter-section shadow-sm border-0">
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted">
                                <i class="ti ti-search fs-5"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 ps-0"
                                placeholder="Search by name or address...">
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="d-flex align-items-center gap-2 justify-content-end">
                            <span class="text-muted small">Show:</span>
                            <select wire:model.live="perPage" class="form-select form-select-sm w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="col-12">
            <div class="table-responsive shadow-sm rounded-3">
                <table class="modern-table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 50px;" class="text-center">#</th>
                            <th>WAREHOUSE NAME</th>
                            <th>ADDRESS</th>
                            <th class="text-center">STATUS</th>
                            <th style="width: 120px;" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('warehouse-{{ $w->id_warehouse }}', get_defined_vars()); ?>wire:key="warehouse-<?php echo e($w->id_warehouse); ?>">
                            <td class="text-center text-muted small"><?php echo e(($warehouses->currentPage()-1) * $warehouses->perPage() + $loop->iteration); ?></td>
                            <td>
                                <div class="fw-bold modern-text-title text-uppercase text-primary"><?php echo e($w->warehouse_name); ?></div>
                            </td>
                            <td class="text-wrap" style="max-width: 300px;">
                                <span class="text-muted small"><?php echo e($w->address ?? '-'); ?></span>
                            </td>
                            <td class="text-center">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($w->is_active): ?>
                                <span class="badge bg-light-success text-success rounded-pill px-3">ACTIVE</span>
                                <?php else: ?>
                                <span class="badge bg-light-danger text-danger rounded-pill px-3">INACTIVE</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('warehouse.edit')): ?>
                                    <button wire:click="edit(<?php echo e($w->id_warehouse); ?>)" class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                        <i class="ti ti-edit fs-5"></i>
                                    </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('warehouse.delete')): ?>
                                    <button type="button"
                                        onclick="showConfirm({
                                                title: 'Hapus Gudang',
                                                message: 'Hapus gudang <?php echo e($w->warehouse_name); ?>? Tindakan ini tidak dapat dibatalkan.',
                                                type: 'danger',
                                                onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').delete(<?php echo e($w->id_warehouse); ?>)
                                            })"
                                        class="btn btn-icon bg-light-danger rounded-circle" title="Delete">
                                        <i class="ti ti-trash fs-5"></i>
                                    </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="ti ti-building-warehouse fs-1 opacity-25"></i>
                                <h6 class="mt-2 text-muted uppercase">No warehouses found</h6>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-4"><?php echo e($warehouses->links()); ?></div>
        </div>
    </div>

    <!-- Warehouse Modal -->
    <div wire:ignore.self class="modal fade" id="warehouseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase">
                        <i class="ti ti-<?php echo e($isEditing ? 'edit' : 'plus'); ?> me-2"></i>
                        <?php echo e($isEditing ? 'Edit Warehouse' : 'Add Warehouse'); ?>

                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">WAREHOUSE NAME <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['warehouse_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="warehouse_name">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['warehouse_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback text-uppercase small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">ADDRESS</label>
                            <textarea class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="address" rows="3"></textarea>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback text-uppercase small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-bold small text-uppercase d-block">STATUS</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="1" wire:model="is_active" id="active">
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="0" wire:model="is_active" id="inactive">
                                <label class="form-check-label" for="inactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="ti ti-device-floppy me-2"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        window.addEventListener('openWarehouseModal', () => {
            (new bootstrap.Modal(document.getElementById('warehouseModal'))).show();
        });
        window.addEventListener('closeWarehouseModal', () => {
            let el = document.getElementById('warehouseModal');
            let instance = bootstrap.Modal.getInstance(el);
            if (instance) instance.hide();
        });
    </script>
    <?php $__env->stopPush(); ?>
    <style>
        .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .filter-section {
            background-color: #1a2531;
        }

        .summary-card {
            border: none;
            border-radius: 12px;
        }
    </style>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views/livewire/warehouses/index.blade.php ENDPATH**/ ?>