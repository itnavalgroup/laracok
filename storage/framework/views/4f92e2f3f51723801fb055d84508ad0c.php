<div class="vendor-management" wire:poll.5s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">VENDOR</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards & Header -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-2">
                    <div class="card summary-card bg-primary h-100 shadow-sm border-0">
                        <div class="card-body py-3">
                            <h6 class="text-white-50 mb-1 small text-uppercase">Total Vendors</h6>
                            <h3 class="mb-0 fw-bold text-white"><?php echo e($totalVendors); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card summary-card bg-success h-100 shadow-sm border-0">
                        <div class="card-body py-3">
                            <h6 class="text-white-50 mb-1 small text-uppercase">My Vendors</h6>
                            <h3 class="mb-0 fw-bold text-white"><?php echo e($myVendors); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">Vendor Management</h4>
                                <p class="text-muted small mb-0">Manage partners, contact details, and banking information</p>
                            </div>
                            <div class="d-flex gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('vendor.download')): ?>
                                <button wire:click="export" class="btn btn-outline-success rounded-pill px-3 py-2 d-flex align-items-center gap-2 shadow-sm" title="Export to Excel">
                                    <i class="ti ti-download fs-4"></i>
                                    <span class="fw-semibold text-uppercase small d-none d-lg-inline">Export</span>
                                </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('vendor.upload')): ?>
                                <button data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-outline-primary rounded-pill px-3 py-2 d-flex align-items-center gap-2 shadow-sm" title="Import from Excel">
                                    <i class="ti ti-upload fs-4"></i>
                                    <span class="fw-semibold text-uppercase small d-none d-lg-inline">Import</span>
                                </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('vendor.create')): ?>
                                <button wire:click="create" class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center gap-2 shadow">
                                    <i class="ti ti-plus fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Add Vendor</span>
                                </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="col-12 mb-4">
            <div class="filter-section shadow-sm border-0">
                <div class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted">
                                <i class="ti ti-search fs-5"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 ps-0"
                                placeholder="Search by vendor name or ID...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" wire:model.live="departmentFilter">
                            <option value="">All Departments</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <option value="<?php echo e($dept->id_departement); ?>"><?php echo e($dept->departement); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-2 justify-content-end">
                            <span class="text-muted small text-nowrap">Show:</span>
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
                            <th style="width: 80px;" class="text-center">ID</th>
                            <th>VENDOR NAME</th>
                            <th>DEPARTMENT</th>
                            <th class="d-none d-md-table-cell">CREATOR</th>
                            <th class="text-center">STATUS</th>
                            <th style="width: 150px;" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('vendor-{{ $v->id_vendor }}', get_defined_vars()); ?>wire:key="vendor-<?php echo e($v->id_vendor); ?>">
                            <td class="text-center">
                                <span class="badge bg-light-secondary text-secondary rounded-pill fw-bold">#<?php echo e($v->id_vendor); ?></span>
                            </td>
                            <td>
                                <div class="fw-bold modern-text-title text-uppercase"><?php echo e($v->vendor); ?></div>
                                <div class="text-muted x-small">Created: <?php echo e($v->created_at->format('d/m/Y')); ?></div>
                            </td>
                            <td>
                                <span class="badge bg-light-info text-info text-uppercase fw-normal">
                                    <?php echo e($v->departement->departement ?? 'Global'); ?>

                                </span>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 11px; font-weight: 700;">
                                        <?php echo e(strtoupper(substr($v->creator->name ?? '?', 0, 1))); ?>

                                    </div>
                                    <span class="small text-muted text-uppercase"><?php echo e($v->creator->name ?? 'Unknown'); ?></span>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($v->deleted_at): ?>
                                <span class="badge bg-light-danger text-danger text-uppercase px-3">Deleted</span>
                                <?php elseif($v->is_active): ?>
                                <span class="badge bg-light-success text-success text-uppercase px-3">Active</span>
                                <?php else: ?>
                                <span class="badge bg-light-warning text-warning text-uppercase px-3">Inactive</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button wire:click="show(<?php echo e($v->id_vendor); ?>)" class="btn btn-icon bg-light-info rounded-circle" title="Detail">
                                        <i class="ti ti-eye fs-5 text-info"></i>
                                    </button>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('vendor.edit')): ?>
                                    <button wire:click="edit(<?php echo e($v->id_vendor); ?>)" class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                        <i class="ti ti-edit fs-5 text-warning"></i>
                                    </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('vendor.delete')): ?>
                                    <button type="button"
                                        onclick="showConfirm({
                                                title: 'Hapus Vendor',
                                                message: 'Apakah Anda yakin ingin menghapus vendor <?php echo e($v->vendor); ?>?',
                                                type: 'danger',
                                                onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').delete(<?php echo e($v->id_vendor); ?>)
                                            })"
                                        class="btn btn-icon bg-light-danger rounded-circle" title="Delete">
                                        <i class="ti ti-trash fs-5 text-danger"></i>
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
                                    <h5 class="mt-3 modern-text-muted text-uppercase">No vendors found</h5>
                                    <p class="modern-text-muted small">Try adjusting your search or filters</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <?php echo e($vendors->links()); ?>

            </div>
        </div>
    </div>

    <!-- Vendor Modal (Create / Edit / Show) -->
    <div wire:ignore.self class="modal fade" id="vendorModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase">
                        <i class="ti ti-<?php echo e($isShowOnly ? 'info-circle' : ($isEditing ? 'edit' : 'plus')); ?> me-2"></i>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isShowOnly): ?> Vendor Details <?php elseif($isEditing): ?> Edit Vendor <?php else: ?> Add New Vendor <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" wire:click="resetFields"></button>
                </div>
                <div class="modal-body p-4">
                    <form <?php if(!$isShowOnly): ?> wire:submit.prevent="<?php echo e($isEditing ? 'update' : 'store'); ?>" <?php endif; ?>>

                        
                        <div class="mb-4">
                            <h6 class="text-primary fw-bold text-uppercase mb-3 d-flex align-items-center gap-2">
                                <i class="ti ti-building fs-5"></i> Basic Information
                            </h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-uppercase">Vendor Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['vendor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="vendor" placeholder="Enter Full Vendor Name" <?php if($isShowOnly): ?> disabled <?php endif; ?>>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['vendor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-uppercase">NPWP</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['npwp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="npwp" placeholder="00.000.000.0-000.000" <?php if($isShowOnly || ($isEditing && !$canEditMainData)): ?> disabled <?php endif; ?>>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['npwp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isEditing && !$canEditMainData): ?> <div class="x-small text-muted mt-1">Locked (Only Admin/Creator can edit this)</div> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-uppercase">NIK</label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="nik" placeholder="16-digit Personal ID Number" <?php if($isShowOnly || ($isEditing && !$canEditMainData)): ?> disabled <?php endif; ?>>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold text-uppercase">Status</label>
                                    <div class="form-check form-switch mt-1">
                                        <input class="form-check-input p-2" type="checkbox" role="switch" wire:model.live="is_active" id="isActiveSwitch"
                                            <?php if($isShowOnly || (auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.activate'))): ?> disabled <?php endif; ?>>
                                        <label class="form-check-label ms-2 fw-bold" for="isActiveSwitch">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($is_active): ?>
                                            <span class="text-success">Active</span>
                                            <?php else: ?>
                                            <span class="text-danger">Inactive</span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </label>
                                    </div>
                                    <div class="x-small text-muted mt-1">Inactive vendors cannot be used in new transactions.</div>
                                </div>
                            </div>
                        </div>

                        <div class="hr-border opacity-25 my-4"></div>

                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-primary fw-bold text-uppercase mb-0 d-flex align-items-center gap-2">
                                    <i class="ti ti-mail fs-5"></i> Contact Emails
                                </h6>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isShowOnly): ?>
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" wire:click="addEmail">
                                    <i class="ti ti-plus me-1"></i> Add Email
                                </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="row g-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-transparent text-muted"><i class="ti ti-mail"></i></span>
                                        <input type="email" class="form-control <?php $__errorArgs = ['emails.'.$index.'.email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            wire:model="emails.<?php echo e($index); ?>.email" placeholder="example@vendor.com"
                                            <?php if($isShowOnly || (isset($email['is_used']) && $email['is_used'])): ?> disabled <?php endif; ?>>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isShowOnly && count($emails) > 1 && !(isset($email['is_used']) && $email['is_used'])): ?>
                                        <button class="btn btn-outline-danger" type="button" wire:click="removeEmail(<?php echo e($index); ?>)">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                        <?php elseif(isset($email['is_used']) && $email['is_used']): ?>
                                        <span class="input-group-text bg-light text-muted" title="Used in transactions"><i class="ti ti-lock"></i></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['emails.'.$index.'.email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="x-small text-danger mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <div class="col-12 py-3 text-center bg-light rounded-3">
                                    <span class="text-muted small">No contact emails provided</span>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        <div class="hr-border opacity-25 my-4"></div>

                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-primary fw-bold text-uppercase mb-0 d-flex align-items-center gap-2">
                                    <i class="ti ti-credit-card fs-5"></i> Bank Accounts
                                </h6>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isShowOnly): ?>
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" wire:click="addBankAccount">
                                    <i class="ti ti-plus me-1"></i> Add Account
                                </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $bankAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <div class="card bg-light bg-opacity-50 border-0 mb-3 rounded-3 shadow-none">
                                <div class="card-body p-3">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label x-small fw-bold text-uppercase mb-1">Bank Name</label>
                                            <input type="text" class="form-control form-control-sm border-0 shadow-sm" wire:model="bankAccounts.<?php echo e($index); ?>.nama_bank" placeholder="e.g. BCA, MANDIRI" <?php if($isShowOnly || (isset($acc['is_used']) && $acc['is_used'])): ?> disabled <?php endif; ?>>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label x-small fw-bold text-uppercase mb-1">Holder Name</label>
                                            <input type="text" class="form-control form-control-sm border-0 shadow-sm" wire:model="bankAccounts.<?php echo e($index); ?>.nama_penerima" placeholder="BENEFICIARY NAME" <?php if($isShowOnly || (isset($acc['is_used']) && $acc['is_used'])): ?> disabled <?php endif; ?>>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label x-small fw-bold text-uppercase mb-1">Account No. <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($acc['is_used']) && $acc['is_used']): ?> <i class="ti ti-lock text-muted fs-7"></i> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></label>
                                            <div class="input-group input-group-sm shadow-sm">
                                                <input type="text" class="form-control border-0" wire:model="bankAccounts.<?php echo e($index); ?>.norek" placeholder="Numbers Only"
                                                    <?php if($isShowOnly || (isset($acc['is_used']) && $acc['is_used'])): ?> disabled <?php endif; ?>>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isShowOnly && count($bankAccounts) > 1 && !(isset($acc['is_used']) && $acc['is_used'])): ?>
                                                <button class="btn btn-outline-danger border-0" type="button" wire:click="removeBankAccount(<?php echo e($index); ?>)">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <div class="py-3 text-center bg-light rounded-3">
                                <span class="text-muted small">No bank account details provided</span>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal" wire:click="resetFields">
                        <?php echo e($isShowOnly ? 'Close' : 'Cancel'); ?>

                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$isShowOnly): ?>
                    <button type="button" class="btn btn-primary rounded-pill px-4 shadow" wire:click="<?php echo e($isEditing ? 'update' : 'store'); ?>" wire:loading.attr="disabled">
                        <span wire:loading.remove><i class="ti ti-device-floppy me-2"></i> <?php echo e($isEditing ? 'Update Data' : 'Save Vendor'); ?></span>
                        <span wire:loading class="spinner-border spinner-border-sm"></span>
                    </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div wire:ignore.self class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase">Import Vendor Data</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-info border-0 rounded-3 mb-4">
                        <div class="d-flex gap-3">
                            <i class="ti ti-info-square fs-3"></i>
                            <div>
                                <h6 class="alert-heading fw-bold small text-uppercase mb-1">Pre-Import Instructions</h6>
                                <p class="small mb-3 text-muted">Please download and use our official spreadsheet template to ensure data compatibility.</p>
                                <button class="btn btn-sm btn-info text-white rounded-pill px-3 shadow-sm" wire:click="downloadTemplate">
                                    <i class="ti ti-download me-1"></i> Download Template
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase mb-2">Select Spreadsheet (.xls, .xlsx)</label>
                        <input type="file" class="form-control <?php $__errorArgs = ['file_excel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> shadow-sm" wire:model="file_excel">
                        <div wire:loading wire:target="file_excel" class="x-small text-primary mt-2">
                            <span class="spinner-border spinner-border-sm me-1"></span> Processing file...
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['file_excel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block mt-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-dark rounded-pill px-4 shadow" wire:click="import" wire:loading.attr="disabled" <?php if(!$file_excel): ?> disabled <?php endif; ?>>
                        <span wire:loading.remove><i class="ti ti-upload me-2"></i> Upload & Import</span>
                        <span wire:loading class="spinner-border spinner-border-sm"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        window.addEventListener('showModal', event => {
            let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(event.detail.id));
            modal.show();
        });

        window.addEventListener('hideModal', event => {
            let modal = bootstrap.Modal.getInstance(document.getElementById(event.detail.id));
            if (modal) modal.hide();
        });
    </script>
    <?php $__env->stopPush(); ?>

    <style>
        .vendor-management .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .vendor-management .filter-section {
            background-color: #1a2531;
        }

        .summary-card {
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .summary-card:hover {
            transform: translateY(-2px);
        }

        .x-small {
            font-size: 0.7rem;
        }

        .hr-border {
            border-top: 1px solid #e2e8f0;
        }

        [data-pc-theme="dark"] .hr-border {
            border-top-color: #334155;
        }

        .bg-light-info {
            background-color: rgba(var(--bs-info-rgb), 0.1) !important;
        }

        .bg-light-warning {
            background-color: rgba(var(--bs-warning-rgb), 0.1) !important;
        }

        .bg-light-danger {
            background-color: rgba(var(--bs-danger-rgb), 0.1) !important;
        }

        .bg-light-primary {
            background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
        }

        .bg-light-secondary {
            background-color: rgba(var(--bs-secondary-rgb), 0.1) !important;
        }

        [data-pc-theme="dark"] .modal-body .bg-light {
            background-color: #1e293b !important;
        }
    </style>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\vendors\index.blade.php ENDPATH**/ ?>