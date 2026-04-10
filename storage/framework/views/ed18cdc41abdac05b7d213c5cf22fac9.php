<div class="pr-management" wire:poll.10s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"
                            class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">TRANSACTION</li>
                    <li class="breadcrumb-item active text-uppercase">PAYMENT REQUEST</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary h-100">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Payment Requests</h6>
                            <h2 class="mb-0 fw-bold text-white"><?php echo e($prs->total()); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">Payment Requests</h4>
                                <p class="text-muted small mb-0">Kelola dan lacak siklus persetujuan Payment Request</p>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" wire:click="export" wire:loading.attr="disabled"
                                    wire:target="export"
                                    class="btn btn-success text-white rounded-pill px-4 d-flex align-items-center gap-2">
                                    <span wire:loading wire:target="export" class="spinner-border spinner-border-sm"
                                        role="status" aria-hidden="true"></span>
                                    <i wire:loading.remove wire:target="export" class="ti ti-file-spreadsheet fs-4"></i>
                                    <span wire:loading.remove wire:target="export"
                                        class="fw-semibold text-uppercase">Export</span>
                                    <span wire:loading wire:target="export"
                                        class="fw-semibold text-uppercase">Exporting...</span>
                                </button>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('pr.create')): ?>
                                    <button type="button" wire:click="$dispatch('open-pr-form')"
                                        class="btn btn-primary rounded-pill px-4 d-flex align-items-center gap-2">
                                        <i class="ti ti-plus fs-4"></i>
                                        <span class="fw-semibold text-uppercase">New PR</span>
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
            <div class="filter-section shadow-sm border-0 theme-responsive-card p-3 rounded-3">

                <!-- Primary Filter Bar (Always visible) -->
                <div class="row g-3 align-items-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted">
                                <i class="ti ti-search fs-5"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 ps-0 text-truncate"
                                placeholder="Cari PR No/vendor/user/Subject...">
                        </div>
                    </div>

                    <div
                        class="col-md-6 col-lg-8 d-flex justify-content-md-end justify-content-between align-items-center gap-2 flex-wrap">
                        <?php
                            $activeFilters = [];
                            if ($filterDepartement) {
                                $deptLabel =
                                    $departements->firstWhere('id_departement', $filterDepartement)?->departement ??
                                    'Dept';
                                $activeFilters['filterDepartement'] = $deptLabel;
                            }
                            if ($filterCompany) {
                                $compLabel =
                                    $companies->firstWhere('id_company', $filterCompany)?->company_name ?? 'Company';
                                $activeFilters['filterCompany'] = $compLabel;
                            }
                            $prStatusLabels = [
                                '0' => 'Draft',
                                '1' => 'Pending Dept Sign',
                                '2' => 'Pending Director Sign',
                                '3' => 'Pending Accounting Sign',
                                '4' => 'Pending Finance Sign',
                                '5' => 'Pending SPV Finance Sign',
                                '6' => 'Pending CFO Sign',
                                '7' => 'Pending Payment',
                                '8' => 'Payment Parsial',
                                '9' => 'Pending Receipt Parsial',
                                '10' => 'Pending Receipt',
                                '11' => 'Paid / Selesai',
                                '12' => 'Revision',
                                '13' => 'Rejected',
                                '14' => 'Pending Director Sign Payment',
                                '15' => 'Pending Manager Sign Payment',
                            ];
                            if (!empty($filterStatus)) {
                                $m_pr = array_map(fn($v) => $prStatusLabels[$v] ?? $v, $filterStatus);
                                $activeFilters['filterStatus'] = 'PR: ' . implode(', ', $m_pr);
                            }
                            $srStatusLabels = [
                                '0' => 'Draft',
                                '1' => 'Pending Dept Sign',
                                '2' => 'Pending Director Sign',
                                '3' => 'Pending Accounting Sign',
                                '4' => 'Pending Finance Sign',
                                '5' => 'Pending SPV Finance Sign',
                                '6' => 'Pending CFO Sign',
                                '7' => 'Pending Payment',
                                '8' => 'Payment Parsial',
                                '9' => 'Pending Receipt Parsial',
                                '10' => 'Pending Receipt',
                                '11' => 'Paid / Selesai',
                                '12' => 'Revision',
                                '13' => 'Rejected',
                            ];
                            if (!empty($filterSrStatus)) {
                                $m_sr = array_map(fn($v) => $srStatusLabels[$v] ?? $v, $filterSrStatus);
                                $activeFilters['filterSrStatus'] = 'SR: ' . implode(', ', $m_sr);
                            }
                            if ($dateFromCreated) {
                                $activeFilters['dateFromCreated'] =
                                    'Dari: ' . \Carbon\Carbon::parse($dateFromCreated)->format('d M Y');
                            }
                            if ($dateToCreated) {
                                $activeFilters['dateToCreated'] =
                                    'S/d: ' . \Carbon\Carbon::parse($dateToCreated)->format('d M Y');
                            }

                            if ($dateFromDueDate) {
                                $activeFilters['dateFromDueDate'] =
                                    'Dari: ' . \Carbon\Carbon::parse($dateFromDueDate)->format('d M Y');
                            }
                            if ($dateToDueDate) {
                                $activeFilters['dateToDueDate'] =
                                    'S/d: ' . \Carbon\Carbon::parse($dateToDueDate)->format('d M Y');
                            }
                            $hasActiveFilter = count($activeFilters) > 0;
                        ?>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasActiveFilter): ?>
                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $activeFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <span class="badge rounded-pill bg-primary d-flex align-items-center gap-1"
                                        style="font-size:0.75rem; padding: 5px 10px;">
                                        <?php echo e($label); ?>

                                        <button type="button" wire:click="$set('<?php echo e($field); ?>', '')"
                                            class="btn-close btn-close-white ms-1" style="font-size:0.55rem;"
                                            aria-label="Hapus filter"></button>
                                    </span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <button wire:click="resetFilters"
                                    class="btn btn-sm btn-link text-danger p-0 text-decoration-none"
                                    style="font-size:0.78rem;">Reset All</button>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <button
                            class="btn btn-light border-0 shadow-sm d-flex align-items-center gap-2 <?php echo e($hasActiveFilter ? 'border-primary border' : ''); ?>"
                            type="button" id="filterToggleBtn" data-bs-toggle="collapse"
                            data-bs-target="#advancedTableFilters"
                            aria-expanded="<?php echo e($hasActiveFilter ? 'true' : 'false'); ?>"
                            aria-controls="advancedTableFilters">
                            <i class="ti ti-filter fs-5 <?php echo e($hasActiveFilter ? 'text-primary' : ''); ?>"></i>
                            <span class="d-none d-sm-inline">Filters</span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasActiveFilter): ?>
                                <span class="badge bg-primary rounded-pill"
                                    style="font-size:0.7rem;"><?php echo e(count($activeFilters)); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </button>

                        
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted small text-nowrap d-none d-sm-inline">Show:</span>
                            <select wire:model.live="perPage"
                                class="form-select border-0 bg-light shadow-none rounded-3 w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>

                </div>

                <!-- Advanced Filters (Collapsible) -->
                <div class="collapse mt-3 <?php echo e($hasActiveFilter ? 'show' : ''); ?>" id="advancedTableFilters"
                    wire:ignore.self>

                    <div class="p-3 bg-light rounded-3 bg-opacity-50">
                        <div class="row g-3">
                            <!-- Department Filter (Restricted based on Permissions) -->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('pr.view.all')): ?>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Departemen</label>
                                    <select wire:model.live="filterDepartement"
                                        class="form-select border-0 bg-white shadow-none rounded-3">
                                        <option value="">Semua Departemen</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $departements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                            <option value="<?php echo e($dept->id_departement); ?>"><?php echo e($dept->departement); ?>

                                            </option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </select>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <!-- Company Filter -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Perusahaan</label>
                                <select wire:model.live="filterCompany"
                                    class="form-select border-0 bg-white shadow-none rounded-3">
                                    <option value="">Semua Perusahaan</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($company->id_company); ?>"><?php echo e($company->company_name); ?>

                                        </option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>

                            <!-- Status PR Filter -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Status PR</label>
                                <div class="dropdown">
                                    <button
                                        class="form-select border-0 bg-white shadow-none rounded-3 text-start d-flex justify-content-between align-items-center"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                        data-bs-auto-close="outside">
                                        <span class="text-truncate">
                                            <?php echo e(empty($filterStatus) ? 'Semua Status PR' : count($filterStatus) . ' Status Dipilih'); ?>

                                        </span>
                                    </button>
                                    <ul class="dropdown-menu w-100 p-2 shadow-sm border-0"
                                        style="max-height: 250px; overflow-y: auto;">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['0' => 'Draft', '1' => 'Pending Dept Sign', '2' => 'Pending Director Sign', '3' => 'Pending Accounting Sign', '4' => 'Pending Finance Sign', '5' => 'Pending SPV Finance Sign', '6' => 'Pending CFO Sign', '7' => 'Pending Payment', '8' => 'Payment Parsial', '9' => 'Pending Receipt Parsial', '10' => 'Pending Receipt', '11' => 'Paid / Selesai', '12' => 'Revision', '13' => 'Rejected', '14' => 'Pending Director Sign Payment', '15' => 'Pending Manager Sign Payment']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                            <li>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input" style="cursor: pointer;"
                                                        type="checkbox" wire:model.live="filterStatus"
                                                        value="<?php echo e($val); ?>" id="chk-pr-<?php echo e($val); ?>">
                                                    <label class="form-check-label w-100 d-block"
                                                        style="cursor: pointer;" for="chk-pr-<?php echo e($val); ?>">
                                                        <?php echo e($label); ?>

                                                    </label>
                                                </div>
                                            </li>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Status SR Filter -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Status SR</label>
                                <div class="dropdown">
                                    <button
                                        class="form-select border-0 bg-white shadow-none rounded-3 text-start d-flex justify-content-between align-items-center"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                        data-bs-auto-close="outside">
                                        <span class="text-truncate">
                                            <?php echo e(empty($filterSrStatus) ? 'Semua Status SR' : count($filterSrStatus) . ' Status Dipilih'); ?>

                                        </span>
                                    </button>
                                    <ul class="dropdown-menu w-100 p-2 shadow-sm border-0"
                                        style="max-height: 250px; overflow-y: auto;">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['0' => 'Draft', '1' => 'Pending Dept Sign', '2' => 'Pending Director Sign', '3' => 'Pending Accounting Sign', '4' => 'Pending Finance Sign', '5' => 'Pending SPV Finance Sign', '6' => 'Pending CFO Sign', '7' => 'Pending Payment', '8' => 'Payment Parsial', '9' => 'Pending Receipt Parsial', '10' => 'Pending Receipt', '11' => 'Paid / Selesai', '12' => 'Revision', '13' => 'Rejected']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                            <li>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input" style="cursor: pointer;"
                                                        type="checkbox" wire:model.live="filterSrStatus"
                                                        value="<?php echo e($val); ?>" id="chk-sr-<?php echo e($val); ?>">
                                                    <label class="form-check-label w-100 d-block"
                                                        style="cursor: pointer;" for="chk-sr-<?php echo e($val); ?>">
                                                        <?php echo e($label); ?>

                                                    </label>
                                                </div>
                                            </li>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Date Range -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Periode Tanggal Pembuatan Awal</label>
                                <input type="date" wire:model.live="dateFromCreated"
                                    class="form-control border-0 bg-white shadow-none rounded-3">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Periode Tanggal Pembuatan Akhir</label>
                                <input type="date" wire:model.live="dateToCreated"
                                    class="form-control border-0 bg-white shadow-none rounded-3">
                            </div>

                            <!-- Date Range -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Periode Due Date Awal</label>
                                <input type="date" wire:model.live="dateFromDueDate"
                                    class="form-control border-0 bg-white shadow-none rounded-3">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Periode Due Date Akhir</label>
                                <input type="date" wire:model.live="dateToDueDate"
                                    class="form-control border-0 bg-white shadow-none rounded-3">
                            </div>
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
                            <th style="width: 100px;">DOC TYPE</th>
                            <th style="width: 150px;">PR NUMBER</th>
                            <th>SUBJECT & USER</th>
                            <th>BANK & VENDOR</th>
                            <th class="text-end">AMOUNT (Rp)</th>
                            <th class="text-center">DATES</th>
                            <th style="width: 150px;" class="text-center">STATUS</th>
                            <th style="width: 120px;" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $prs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('pr-{{ $pr->id_pr }}', get_defined_vars()); ?>wire:key="pr-<?php echo e($pr->id_pr); ?>">
                                <td class="text-center text-muted small">
                                    <?php echo e(($prs->currentPage() - 1) * $prs->perPage() + $loop->iteration); ?></td>
                                <td>
                                    <?php
                                        $docTypes = [
                                            1 => ['name' => 'Payment', 'color' => 'primary'],
                                            2 => ['name' => 'Advance', 'color' => 'warning'],
                                            3 => ['name' => 'Settlement', 'color' => 'success'],
                                            4 => ['name' => 'IKB', 'color' => 'info'],
                                        ];
                                        $docType = $docTypes[$pr->id_doc_type] ?? [
                                            'name' => 'UNKNOWN',
                                            'color' => 'secondary',
                                        ];

                                        $paymentTypes = [
                                            1 => ['name' => 'Parsial', 'color' => 'warning'],
                                            2 => ['name' => 'Full', 'color' => 'success'],
                                        ];
                                        $paymentType = $paymentTypes[$pr->payment_type_pr] ?? [
                                            'name' => '-',
                                            'color' => 'secondary',
                                        ];
                                    ?>
                                    <span
                                        class="badge bg-light-<?php echo e($docType['color']); ?> text-<?php echo e($docType['color']); ?> mb-1 w-100"><?php echo e($docType['name']); ?></span>
                                    <span
                                        class="badge bg-light-<?php echo e($paymentType['color']); ?> text-<?php echo e($paymentType['color']); ?> w-100"><?php echo e($paymentType['name']); ?></span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('payment-requests.show', hashid_encode($pr->id_pr, 'pr'))); ?>"
                                        class="fw-bold text-primary text-decoration-none">
                                        <?php echo e($pr->pr_number ?? 'DRAFT'); ?>

                                    </a>
                                    <br>
                                    <?php
                                        $blNumbers = $pr->details
                                            ->pluck('bl_number')
                                            ->filter()
                                            ->unique()
                                            ->implode(', ');
                                    ?>
                                    <span class="text-muted small">BL: <?php echo e($blNumbers ?: '-'); ?></span><br>
                                    <span class="text-muted small">PO: <?php echo e($pr->po_number ?? '-'); ?></span>
                                </td>
                                <td>
                                    <div class="fw-bold modern-text-title text-uppercase"><?php echo e($pr->subject); ?></div>
                                    <div class="text-muted small mb-1">
                                        <i
                                            class="ti ti-layout-grid me-1"></i><?php echo e($pr->departement->departement ?? 'N/A'); ?>

                                    </div>
                                    <div class="text-muted small">
                                        <i class="ti ti-user me-1"></i><?php echo e($pr->user->name ?? '-'); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold mb-1"><?php echo e($pr->vendor->vendor ?? '-'); ?></div>
                                    <?php
                                        $namaBank = $pr->nama_bank ?: $pr->norek_vendor->nama_bank ?? 'Default';
                                        $norek = $pr->norek ?: $pr->norek_vendor->norek ?? '-';
                                        $namaPenerima = $pr->nama_penerima ?: $pr->norek_vendor->nama_penerima ?? '-';
                                    ?>
                                    <div class="text-muted small"><i
                                            class="ti ti-building-bank me-1"></i><?php echo e($namaBank); ?></div>
                                    <div class="text-muted small"><?php echo e($norek); ?></div>
                                    <div class="text-muted small"><?php echo e($namaPenerima); ?></div>
                                </td>
                                <td class="text-end">
                                    <?php
                                        $amount = $pr->total_amount ?? 0;
                                        $discount = $pr->additional_discount ?? 0;
                                        $total = $amount - $discount;
                                        // Total settlement on PR Advance means how much advance was given
                                        $advanceGiven = $pr->payments->sum('grand_total') ?? 0;
                                        $pendingAdvance = $total - $advanceGiven;

                                        $hasSr = $pr->id_doc_type == 2 && $pr->srs->count() > 0;
                                    ?>

                                    <div class="small d-flex justify-content-between">
                                        <span class="text-muted">Amount:</span>
                                        <span><?php echo e(number_format($amount, 0, ',', '.')); ?></span>
                                    </div>
                                    <div
                                        class="small d-flex justify-content-between text-danger mb-1 border-bottom pb-1">
                                        <span class="text-muted">Discount:</span>
                                        <span><?php echo e(number_format($discount, 0, ',', '.')); ?></span>
                                    </div>
                                    <div class="small fw-bold d-flex justify-content-between">
                                        <span>Total:</span>
                                        <span><?php echo e(number_format($total, 0, ',', '.')); ?></span>
                                    </div>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr->id_doc_type != 2): ?>
                                        <div class="small d-flex justify-content-between text-success mt-1">
                                            <span>Settlement:</span>
                                            <span><?php echo e(number_format($advanceGiven, 0, ',', '.')); ?></span>
                                        </div>
                                        <div class="small d-flex justify-content-between text-warning">
                                            <span>Pending:</span>
                                            <span><?php echo e(number_format($pendingAdvance, 0, ',', '.')); ?></span>
                                        </div>
                                    <?php else: ?>
                                        <?php
                                            // For Doc Type 2 (Advance) that has SR, show SR calculations
                                            $srTotal = 0;
                                            if ($pr->srs) {
                                                foreach ($pr->srs as $sr) {
                                                    $srTotal +=
                                                        $sr->details->sum('ammount') - ($sr->additional_discount ?? 0);
                                                }
                                            }
                                            $srBalance = $srTotal - $advanceGiven;
                                        ?>
                                        <div
                                            class="small d-flex justify-content-between text-success mt-1 border-top pt-1">
                                            <span class="text-muted"><i class="ti ti-receipt-2"></i> SR Amount:</span>
                                            <span class="fw-bold"><?php echo e(number_format($srTotal, 0, ',', '.')); ?></span>
                                        </div>
                                        <div
                                            class="small d-flex justify-content-between mt-1 <?php echo e($srBalance > 0 ? 'text-danger' : ($srBalance < 0 ? 'text-primary' : 'text-success')); ?>">
                                            <span>Balance:</span>
                                            <span class="fw-bold"><?php echo e(number_format($srBalance, 0, ',', '.')); ?></span>
                                        </div>
                                        <div class="small text-muted text-start" style="font-size: 0.70rem;">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($srBalance > 0): ?>
                                                (Kurang Bayar)
                                            <?php elseif($srBalance < 0): ?>
                                                (Lebih Bayar / Refund)
                                            <?php else: ?>
                                                (Settled)
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                </td>
                                <td class="text-center">
                                    <div class="small mb-1" title="Payment Due Date">
                                        <i class="ti ti-calendar-due text-danger me-1"></i>
                                        <?php echo e($pr->payment_due_date ? $pr->payment_due_date->format('d M Y') : '-'); ?>

                                    </div>
                                    <div class="small" title="Est. Settlement Date">
                                        <i class="ti ti-calendar-event text-info me-1"></i>
                                        <?php echo e($pr->est_settlement_date ? $pr->est_settlement_date->format('d M Y') : '-'); ?>

                                    </div>
                                </td>
                                <td class="text-center">
                                    <?php
                                        $statusBadge = [
                                            0 => ['label' => 'Draft', 'color' => 'secondary'],
                                            1 => ['label' => 'Pending Dept Sign', 'color' => 'warning'],
                                            2 => ['label' => 'Pending Director Sign', 'color' => 'warning'],
                                            3 => ['label' => 'Pending Accounting Sign', 'color' => 'warning'],
                                            4 => ['label' => 'Pending Finance Sign', 'color' => 'warning'],
                                            5 => ['label' => 'Pending SPV Finance Sign', 'color' => 'warning'],
                                            6 => ['label' => 'Pending CFO Sign', 'color' => 'warning'],
                                            7 => ['label' => 'Pending Payment', 'color' => 'warning'],
                                            8 => ['label' => 'Payment Parsial', 'color' => 'info'],
                                            9 => ['label' => 'Pending Receipt Parsial', 'color' => 'info'],
                                            10 => ['label' => 'Pending Receipt', 'color' => 'info'],
                                            11 => ['label' => 'Paid', 'color' => 'success'],
                                            12 => ['label' => 'Revision', 'color' => 'primary'],
                                            13 => ['label' => 'Rejected', 'color' => 'danger'],
                                            14 => ['label' => 'Pending Director Sign Payment', 'color' => 'danger'],
                                            15 => ['label' => 'Pending Manager Sign Payment', 'color' => 'danger'],
                                        ];

                                        $status = $pr->status ?? 0;
                                        $badge = $statusBadge[$status] ?? ['label' => 'Unknown', 'color' => 'dark'];
                                    ?>
                                    <span
                                        class="badge bg-light-<?php echo e($badge['color']); ?> text-<?php echo e($badge['color']); ?>"><?php echo e($badge['label']); ?></span>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr->id_doc_type == 2 && $pr->status >= 8 && $pr->status <= 11): ?>
                                        <?php
                                            $srStatusBadge = [
                                                0 => ['label' => 'Pending SR', 'color' => 'secondary'],
                                                1 => ['label' => 'Pending Dept Sign', 'color' => 'warning'],
                                                2 => ['label' => 'Pending Director Sign', 'color' => 'warning'],
                                                3 => ['label' => 'Pending Accounting Sign', 'color' => 'warning'],
                                                4 => ['label' => 'Pending Finance Sign', 'color' => 'warning'],
                                                5 => ['label' => 'Pending SPV Finance Sign', 'color' => 'warning'],
                                                6 => ['label' => 'Pending CFO Sign', 'color' => 'warning'],
                                                7 => ['label' => 'Pending Payment', 'color' => 'warning'],
                                                8 => ['label' => 'Payment Parsial', 'color' => 'info'],
                                                9 => ['label' => 'Pending Receipt Parsial', 'color' => 'info'],
                                                10 => ['label' => 'Pending Receipt', 'color' => 'info'],
                                                11 => ['label' => 'Balance', 'color' => 'success'],
                                                12 => ['label' => 'Revision', 'color' => 'primary'],
                                                13 => ['label' => 'Rejected', 'color' => 'danger'],
                                            ];

                                            // Retrieve real SR status if exists
                                            $srStatus = 0;
                                            if ($pr->srs->count() > 0) {
                                                $srStatus = $pr->srs->first()->status ?? 0;
                                            }
                                            $srBadge = $srStatusBadge[$srStatus] ?? [
                                                'label' => 'Pending SR',
                                                'color' => 'secondary',
                                            ];
                                        ?>
                                        <br>
                                        <span
                                            class="badge bg-light-<?php echo e($srBadge['color']); ?> text-<?php echo e($srBadge['color']); ?> mt-1">SR:
                                            <?php echo e($srBadge['label']); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?php echo e(route('payment-requests.show', hashid_encode($pr->id_pr, 'pr'))); ?>"
                                            class="btn btn-icon bg-light-primary rounded-circle" title="View">
                                            <i class="ti ti-eye fs-5"></i>
                                        </a>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($pr->status, [0, null, 13]) &&
                                                (auth()->user()->level === 1 ||
                                                    auth()->user()->hasPermission('pr.delete') ||
                                                    auth()->user()->id_user == $pr->id_user)): ?>
                                            <button type="button"
                                                wire:click="$dispatch('open-pr-form', { id: <?php echo e($pr->id_pr); ?> })"
                                                class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                                <i class="ti ti-edit fs-5"></i>
                                            </button>

                                            <button type="button"
                                                onclick="showConfirm({
                                                title: 'Hapus PR',
                                                message: 'Apakah Anda yakin ingin menghapus PR ini? Tindakan ini tidak dapat dibatalkan.',
                                                type: 'danger',
                                                onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').delete(<?php echo e($pr->id_pr); ?>)
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
                                <td colspan="7" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="ti ti-file-dollar fs-1 modern-text-muted opacity-50"></i>
                                        <h5 class="mt-3 modern-text-muted text-uppercase">No Payment Requests Found
                                        </h5>
                                        <p class="modern-text-muted small">Mulai dengan membuat PR baru melalui tombol
                                            "New PR"</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <?php echo e($prs->links()); ?>

            </div>
        </div>
    </div>


    <!-- Listener JS for Modal -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('close-pr-modal', () => {
                const modalEl = document.getElementById('prFormModal');
                if (modalEl) bootstrap.Modal.getOrCreateInstance(modalEl).hide();
            });
        });
    </script>



    <style>
        .pr-management .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .pr-management .filter-section {
            background-color: #1a2531;
        }

        .summary-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .summary-card:hover {
            transform: translateY(-2px);
        }

        .hr-border {
            border-top: 1px solid #e2e8f0;
        }

        [data-pc-theme="dark"] .hr-border {
            border-top-color: #334155;
        }

        [data-pc-theme="dark"] .modal-body .bg-light {
            background-color: #1e293b !important;
        }

        .x-small {
            font-size: 0.75rem;
        }
    </style>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('payment-requests.form-modal', []);

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1458724655-2', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
</div>
<?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\payment-requests\index.blade.php ENDPATH**/ ?>