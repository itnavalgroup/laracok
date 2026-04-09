<div class="user-management" wire:poll.5s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none">DASHBOARD</a></li>
                    <li class="breadcrumb-item active">USER</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Users</h6>
                            <h2 class="mb-0 fw-bold"><?php echo e($totalUsers); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card summary-card bg-info">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Per Page</h6>
                            <h2 class="mb-0 fw-bold"><?php echo e($perPage); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card summary-card bg-success">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Current Page</h6>
                            <h2 class="mb-0 fw-bold"><?php echo e($currentPage); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card summary-card bg-warning">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Pages</h6>
                            <h2 class="mb-0 fw-bold text-white"><?php echo e($totalPages); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold text-primary">User Management</h4>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1): ?>
            <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="ti ti-plus me-2"></i> Add User
            </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <!-- Filter Section -->
        <div class="col-12 flex">
            <div class="filter-section w-100">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">SEARCH</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control" placeholder="Name or ID..." wire:model.live="search">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">LEVEL ACCESS</label>
                        <select class="form-select" wire:model.live="levelFilter">
                            <option value="">All Levels</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <option value="<?php echo e($level->level); ?>"><?php echo e($level->level_name); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">DEPARTMENT</label>
                        <select class="form-select" wire:model.live="departmentFilter">
                            <option value="">All Departments</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <option value="<?php echo e($dept->id_departement); ?>"><?php echo e($dept->departement); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
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

        <!-- Modern Table -->
        <div class="col-12">
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 80px;">Photo</th>
                            <th>User Info</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr>
                            <td><?php echo e(($users->currentPage()-1) * $users->perPage() + $loop->index + 1); ?></td>
                            <td>
                                <div class="avatar avatar-sm bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center overflow-hidden" style="width: 45px; height: 45px;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->photo): ?>
                                    <img src="<?php echo e(asset('storage/image/'.$user->photo)); ?>" class="img-fluid h-100 w-100 object-fit-cover" alt="User">
                                    <?php else: ?>
                                    <span class="fw-bold text-primary"><?php echo e(strtoupper(substr($user->name, 0, 1))); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold modern-text-title"><?php echo e($user->name); ?></div>
                                <div class="modern-text-muted small">ID: <?php echo e($user->id_employee); ?></div>
                                <span class="badge bg-light text-primary border border-primary-subtle mt-1" style="font-size: 0.65rem;">
                                    <?php echo e($user->level_detail->level_name ?? '-'); ?>

                                </span>
                            </td>
                            <td><?php echo e($user->position->position ?? '-'); ?></td>
                            <td><?php echo e($user->departement->departement ?? '-'); ?></td>
                            <td>
                                <div class="small modern-text-muted"><i class="ti ti-phone me-1 opacity-50"></i><?php echo e($user->phone ?? '-'); ?></div>
                            </td>
                            <td>
                                <div class="small modern-text-muted text-truncate" style="max-width: 150px;" title="<?php echo e($user->primary_email->email ?? '-'); ?>">
                                    <i class="ti ti-mail me-1 opacity-50"></i><?php echo e($user->primary_email->email ?? '-'); ?>

                                </div>
                            </td>
                            <td>
                                <span class="badge <?php echo e($user->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'); ?> rounded-pill px-3">
                                    <?php echo e($user->is_active ? 'Active' : 'Inactive'); ?>

                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="<?php echo e(route('users.show', hashid_encode($user->id_user))); ?>" class="btn btn-sm btn-icon btn-outline-info rounded-circle border-0" title="View Details">
                                        <i class="ti ti-eye fs-5"></i>
                                    </a>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->canEditUser($user)): ?>
                                    <a href="<?php echo e(route('users.edit', hashid_encode($user->id_user))); ?>" class="btn btn-sm btn-icon btn-outline-primary rounded-circle border-0" title="Edit">
                                        <i class="ti ti-edit fs-5"></i>
                                    </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1): ?>
                                    <button type="button"
                                        onclick="showConfirm({
                                            title: 'Hapus User',
                                            message: 'Apakah Anda yakin ingin menghapus user <?php echo e($user->name); ?>? Tindakan ini tidak dapat dibatalkan.',
                                            type: 'danger',
                                            onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').delete(<?php echo e($user->id_user); ?>)
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
                            <td colspan="9" class="text-center py-5">
                                <div class="py-4">
                                    <i class="ti ti-users-minus fs-1 modern-text-muted opacity-50"></i>
                                    <h5 class="mt-3 modern-text-muted">No users found</h5>
                                    <p class="modern-text-muted small">Try adjusting your filters or search keywords</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Centered Pagination -->
            <div class="mt-4 d-flex justify-content-center">
                <?php echo e($users->links()); ?>

            </div>
        </div>
    </div>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\users\index.blade.php ENDPATH**/ ?>