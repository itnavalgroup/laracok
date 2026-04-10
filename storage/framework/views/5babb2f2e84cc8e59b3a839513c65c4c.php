<div class="company-management" wire:poll.5s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none">DASHBOARD</a></li>
                    <li class="breadcrumb-item active">COMPANY</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Companies</h6>
                            <h2 class="mb-0 fw-bold text-white"><?php echo e($totalCompanies); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card summary-card bg-info">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Per Page</h6>
                            <h2 class="mb-0 fw-bold text-white"><?php echo e($perPage); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card summary-card bg-success">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Current Page</h6>
                            <h2 class="mb-0 fw-bold text-white"><?php echo e($currentPage); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card summary-card bg-warning">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Pages</h6>
                            <h2 class="mb-0 fw-bold text-white"><?php echo e($totalPages); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold text-primary">Company Management</h4>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('company.create')): ?>
            <button wire:click="create" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="ti ti-plus me-2"></i> Add Company
            </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Filter Section -->
        <div class="col-12">
            <div class="filter-section w-100">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">SEARCH</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search Company Name or Alias..." wire:model.live="search">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">RECORDS PER PAGE</label>
                        <select class="form-select" wire:model.live="perPage">
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                            <option value="100">100 per page</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="col-12">
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 80px;">Logo</th>
                            <th>Company Name</th>
                            <th>Alias/Code</th>
                            <th>Created At</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr>
                            <td><?php echo e($companies->firstItem() + $index); ?></td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($c->logo): ?>
                                <div class="avatar avatar-sm bg-light rounded-2 d-flex align-items-center justify-content-center overflow-hidden" style="width: 45px; height: 45px;">
                                    <img src="<?php echo e(asset('assets/companies/logos/' . $c->logo)); ?>" alt="logo" class="img-fluid h-100 w-100 object-fit-contain">
                                </div>
                                <?php else: ?>
                                <div class="avatar avatar-sm bg-light rounded-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                    <i class="ti ti-building fs-4 text-muted"></i>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-bold modern-text-title"><?php echo e($c->company_name); ?></div>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 rounded-pill">
                                    <?php echo e($c->company); ?>

                                </span>
                            </td>
                            <td>
                                <div class="small modern-text-muted">
                                    <i class="ti ti-calendar me-1 opacity-50"></i><?php echo e($c->created_at->format('d M Y')); ?>

                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex gap-1 justify-content-end">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('company.edit')): ?>
                                    <button wire:click="edit(<?php echo e($c->id_company); ?>)" class="btn btn-sm btn-icon btn-outline-warning rounded-circle border-0" title="Edit">
                                        <i class="ti ti-edit fs-5"></i>
                                    </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('company.delete')): ?>
                                    <button type="button"
                                        onclick="showConfirm({
                                            title: 'Hapus Perusahaan',
                                            message: 'Apakah Anda yakin ingin menghapus <?php echo e($c->company_name); ?>? Tindakan ini dapat dibatalkan melalui database.',
                                            type: 'danger',
                                            onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').delete(<?php echo e($c->id_company); ?>)
                                        })"
                                        class="btn btn-sm btn-icon btn-outline-danger rounded-circle border-0" title="Delete">
                                        <i class="ti ti-trash fs-5"></i>
                                    </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <i class="ti ti-building-off fs-1 modern-text-muted opacity-50"></i>
                                    <h5 class="mt-3 modern-text-muted">No companies found</h5>
                                    <p class="modern-text-muted small">Try adjusting your search keywords</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Centered Pagination -->
            <div class="mt-4 d-flex justify-content-center">
                <?php echo e($companies->links()); ?>

            </div>
        </div>
    </div>

    <!-- Company Modal -->
    <div wire:ignore.self class="modal fade" id="companyModal" tabindex="-1" aria-labelledby="companyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white" id="companyModalLabel">
                        <i class="ti ti-<?php echo e($isEditing ? 'edit' : 'plus'); ?> me-2"></i>
                        <?php echo e($isEditing ? 'Edit Company' : 'Add New Company'); ?>

                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <!-- Company Name -->
                            <div class="col-12">
                                <label class="form-label fw-bold small">COMPANY NAME <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    wire:model="company_name" placeholder="e.g. PT. Antigravity Indonesia">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Alias / Code -->
                            <div class="col-12">
                                <label class="form-label fw-bold small">ALIAS / CODE <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    wire:model="company" placeholder="e.g. AGID">
                                <div class="form-text small">Unique code for internal reference.</div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Logo -->
                            <div class="col-12">
                                <label class="form-label fw-bold small">COMPANY LOGO</label>
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($logo): ?>
                                    <div class="position-relative">
                                        <img src="<?php echo e($logo->temporaryUrl()); ?>" class="rounded-3 shadow-sm border" style="width: 80px; height: 80px; object-fit: contain; background: #fff;">
                                        <button type="button" wire:click="$set('logo', null)" class="btn btn-danger btn-sm rounded-circle position-absolute top-0 start-100 translate-middle shadow-sm p-1" style="width: 20px; height: 20px; line-height: 10px;">
                                            <i class="ti ti-x" style="font-size: 10px;"></i>
                                        </button>
                                    </div>
                                    <?php elseif($existingLogo): ?>
                                    <img src="<?php echo e(asset('assets/companies/logos/' . $existingLogo)); ?>" class="rounded-3 shadow-sm border" style="width: 80px; height: 80px; object-fit: contain; background: #fff;">
                                    <?php else: ?>
                                    <div class="bg-light-subtle rounded-3 d-flex align-items-center justify-content-center shadow-sm border" style="width: 80px; height: 80px;">
                                        <i class="ti ti-upload fs-2 text-muted"></i>
                                    </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="flex-grow-1">
                                        <input type="file" class="form-control form-control-sm <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="logo">
                                        <div class="form-text x-small">Max 1MB (JPG, PNG, WEBP)</div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                                <div wire:loading wire:target="logo" class="text-primary small">
                                    <i class="ti ti-loader animate-spin me-1"></i> Uploading...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" wire:loading.attr="disabled">
                            <i class="ti ti-device-floppy me-2"></i> <?php echo e($isEditing ? 'Update Data' : 'Save Company'); ?>

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        window.addEventListener('openCompanyModal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('companyModal'));
            myModal.show();
        });

        window.addEventListener('closeCompanyModal', () => {
            bootstrap.Modal.getInstance(document.getElementById('companyModal')).hide();
        });
    </script>
    <?php $__env->stopPush(); ?>

    <style>
        .bg-light-primary {
            background-color: rgba(var(--bs-primary-rgb), 0.1);
        }

        .modern-table thead th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
        }

        .modern-table tbody tr {
            transition: all 0.2s ease;
        }

        .modern-table tbody tr:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.02);
            transform: translateY(-1px);
        }

        [data-pc-theme="dark"] .modern-table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-light-warning {
            background-color: rgba(var(--bs-warning-rgb), 0.1);
            color: var(--bs-warning);
        }

        .bg-light-danger {
            background-color: rgba(var(--bs-danger-rgb), 0.1);
            color: var(--bs-danger);
        }

        .bg-light-warning:hover {
            background-color: var(--bs-warning);
            color: #fff;
        }

        .bg-light-danger:hover {
            background-color: var(--bs-danger);
            color: #fff;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            display: inline-block;
            animation: spin 1s linear infinite;
        }
    </style>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views/livewire/companies/index.blade.php ENDPATH**/ ?>