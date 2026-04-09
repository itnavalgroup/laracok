<div class="sr-management" wire:poll.10s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">TRANSACTION</li>
                    <li class="breadcrumb-item active text-uppercase">SETTLEMENT REPORT</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary h-100">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Settlement Reports</h6>
                            <h2 class="mb-0 fw-bold text-white"><?php echo e($srs->total()); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">Settlement Reports</h4>
                                <p class="text-muted small mb-0">Kelola dan lacak siklus persetujuan Settlement Report</p>
                            </div>
                            <div class="d-flex gap-2">
                                <!-- 'New SR' button removed. SRs are exclusively created from the Advance PR show page -->
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
                                placeholder="Cari PR No / Vendor / User / Subject...">
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-8 d-flex justify-content-md-end justify-content-between align-items-center gap-2 flex-wrap">
                        <?php
                        $activeFilters = [];
                        if ($filterDepartement) {
                        $deptLabel = $departements->firstWhere('id_departement', $filterDepartement)?->departement ?? 'Dept';
                        $activeFilters['filterDepartement'] = $deptLabel;
                        }
                        if ($filterCompany) {
                        $compLabel = $companies->firstWhere('id_company', $filterCompany)?->company_name ?? 'Company';
                        $activeFilters['filterCompany'] = $compLabel;
                        }
                        $prStatusLabels = ['0'=>'Draft','1'=>'Pending Dept Sign','2'=>'Pending Director Sign','3'=>'Pending Accounting Sign','4'=>'Pending Finance Sign','5'=>'Pending SPV Finance Sign','6'=>'Pending CFO Sign','7'=>'Pending Payment','8'=>'Payment Parsial','11'=>'Paid','12'=>'Revision','13'=>'Rejected','14'=>'Pending Director Sign Payment','15'=>'Pending Manager Sign Payment'];
                        if ($filterStatus !== '') {
                        $activeFilters['filterStatus'] = 'PR: ' . ($prStatusLabels[$filterStatus] ?? $filterStatus);
                        }
                        $srStatusLabels = ['0'=>'Pending SR','1'=>'Pending Dept Sign','2'=>'Pending Director Sign','3'=>'Pending Accounting Sign','4'=>'Pending Finance Sign','5'=>'Pending SPV Finance Sign','6'=>'Pending CFO Sign','7'=>'Pending Payment','10'=>'Pending Receipt','11'=>'Balance','12'=>'Revision','13'=>'Rejected'];
                        if ($filterSrStatus !== '') {
                        $activeFilters['filterSrStatus'] = 'SR: ' . ($srStatusLabels[$filterSrStatus] ?? $filterSrStatus);
                        }
                        if ($dateFrom) {
                        $activeFilters['dateFrom'] = 'Dari: ' . \Carbon\Carbon::parse($dateFrom)->format('d M Y');
                        }
                        if ($dateTo) {
                        $activeFilters['dateTo'] = 'S/d: ' . \Carbon\Carbon::parse($dateTo)->format('d M Y');
                        }
                        $hasActiveFilter = count($activeFilters) > 0;
                        ?>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasActiveFilter): ?>
                        <div class="d-flex flex-wrap gap-1 align-items-center">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $activeFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <span class="badge rounded-pill bg-primary d-flex align-items-center gap-1" style="font-size:0.75rem; padding: 5px 10px;">
                                <?php echo e($label); ?>

                                <button type="button" wire:click="$set('<?php echo e($field); ?>', '')" class="btn-close btn-close-white ms-1" style="font-size:0.55rem;" aria-label="Hapus filter"></button>
                            </span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <button wire:click="resetFilters" class="btn btn-sm btn-link text-danger p-0 text-decoration-none" style="font-size:0.78rem;">Reset All</button>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <button class="btn btn-light border-0 shadow-sm d-flex align-items-center gap-2 <?php echo e($hasActiveFilter ? 'border-primary border' : ''); ?>" type="button"
                            data-bs-toggle="collapse" data-bs-target="#advancedTableFilters"
                            aria-expanded="<?php echo e($hasActiveFilter ? 'true' : 'false'); ?>"
                            aria-controls="advancedTableFilters">
                            <i class="ti ti-filter fs-5 <?php echo e($hasActiveFilter ? 'text-primary' : ''); ?>"></i>
                            <span class="d-none d-sm-inline">Filters</span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasActiveFilter): ?>
                            <span class="badge bg-primary rounded-pill" style="font-size:0.7rem;"><?php echo e(count($activeFilters)); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </button>

                        <!-- Show Pagination -->
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted small text-nowrap d-none d-sm-inline">Show:</span>
                            <select wire:model.live="perPage" class="form-select border-0 bg-light shadow-none rounded-3 w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Advanced Filters (Collapsible) -->
                <div class="collapse mt-3 <?php echo e($hasActiveFilter ? 'show' : ''); ?>" id="advancedTableFilters" wire:ignore.self>

                    <div class="p-3 bg-light rounded-3 bg-opacity-50">
                        <div class="row g-3">
                            <!-- Department Filter (Restricted based on Permissions) -->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('sr.view.all')): ?>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Departemen</label>
                                <select wire:model.live="filterDepartement" class="form-select border-0 bg-white shadow-none rounded-3">
                                    <option value="">Semua Departemen</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $departements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($dept->id_departement); ?>"><?php echo e($dept->departement); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <!-- Company Filter -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Perusahaan</label>
                                <select wire:model.live="filterCompany" class="form-select border-0 bg-white shadow-none rounded-3">
                                    <option value="">Semua Perusahaan</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($company->id_company); ?>"><?php echo e($company->company_name); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>

                            <!-- Status PR (Payment Request) Filter -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Status PR (Payment Request)</label>
                                <select wire:model.live="filterStatus" class="form-select border-0 bg-white shadow-none rounded-3">
                                    <option value="">Semua Status PR (Payment Request)</option>
                                    <option value="0">Draft</option>
                                    <option value="1">Pending Dept Sign</option>
                                    <option value="2">Pending Director Sign</option>
                                    <option value="3">Pending Accounting Sign</option>
                                    <option value="4">Pending Finance Sign</option>
                                    <option value="5">Pending SPV Finance Sign</option>
                                    <option value="6">Pending CFO Sign</option>
                                    <option value="7">Pending Payment</option>
                                    <option value="8">Payment Parsial</option>
                                    <option value="9">Pending Receipt Parsial</option>
                                    <option value="10">Pending Receipt</option>
                                    <option value="11">Paid</option>
                                    <option value="12">Revision</option>
                                    <option value="13">Rejected</option>
                                    <option value="14">Pending Director Sign Payment</option>
                                    <option value="15">Pending Manager Sign Payment</option>
                                </select>
                            </div>

                            <!-- Status SR Filter -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Status SR</label>
                                <select wire:model.live="filterSrStatus" class="form-select border-0 bg-white shadow-none rounded-3">
                                    <option value="">Semua Status SR</option>
                                    <option value="0">Pending SR</option>
                                    <option value="1">Pending Dept Sign</option>
                                    <option value="2">Pending Director Sign</option>
                                    <option value="3">Pending Accounting Sign</option>
                                    <option value="4">Pending Finance Sign</option>
                                    <option value="5">Pending SPV Finance Sign</option>
                                    <option value="6">Pending CFO Sign</option>
                                    <option value="7">Pending Payment</option>
                                    <option value="8">Payment Parsial</option>
                                    <option value="9">Pending Receipt Parsial</option>
                                    <option value="10">Pending Receipt</option>
                                    <option value="11">Balance</option>
                                    <option value="12">Revision</option>
                                    <option value="13">Rejected</option>
                                </select>
                            </div>

                            <!-- Date Range -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Periode Tanggal Awal</label>
                                <input type="date" wire:model.live="dateFrom" class="form-control border-0 bg-white shadow-none rounded-3">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Periode Tanggal Akhir</label>
                                <input type="date" wire:model.live="dateTo" class="form-control border-0 bg-white shadow-none rounded-3">
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
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $srs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('sr-{{ $sr->id_pr }}', get_defined_vars()); ?>wire:key="sr-<?php echo e($sr->id_pr); ?>">
                            <td class="text-center text-muted small"><?php echo e(($srs->currentPage()-1) * $srs->perPage() + $loop->iteration); ?></td>
                            <td>
                                <?php
                                $docTypes = [
                                1 => ['name' => 'Payment', 'color' => 'primary'],
                                2 => ['name' => 'Advance', 'color' => 'warning'],
                                3 => ['name' => 'Settlement', 'color' => 'success'],
                                4 => ['name' => 'IKB', 'color' => 'info']
                                ];
                                $docType = $docTypes[$sr->id_doc_type] ?? ['name' => 'UNKNOWN', 'color' => 'secondary'];

                                $paymentTypes = [
                                1 => ['name' => 'Parsial', 'color' => 'warning'],
                                2 => ['name' => 'Full', 'color' => 'success']
                                ];
                                $paymentType = $paymentTypes[$sr->payment_type_pr] ?? ['name' => '-', 'color' => 'secondary'];
                                ?>
                                <span class="badge bg-light-<?php echo e($docType['color']); ?> text-<?php echo e($docType['color']); ?> mb-1 w-100"><?php echo e($docType['name']); ?></span>
                                <span class="badge bg-light-<?php echo e($paymentType['color']); ?> text-<?php echo e($paymentType['color']); ?> w-100"><?php echo e($paymentType['name']); ?></span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('settlement-reports.show', hashid_encode($sr->id_pr, 'pr'))); ?>" class="fw-bold text-primary text-decoration-none">
                                    <?php echo e($sr->pr->pr_number ?? 'DRAFT'); ?>

                                </a>
                                <br>
                                <?php
                                $blNumbers = $sr->details->pluck('bl_number')->filter()->unique()->implode(', ');
                                ?>
                                <span class="text-muted small">BL: <?php echo e($blNumbers ?: '-'); ?></span><br>
                                <span class="text-muted small">PO: <?php echo e($sr->pr->po_number ?? '-'); ?></span>
                            </td>
                            <td>
                                <div class="fw-bold modern-text-title text-uppercase"><?php echo e($sr->subject); ?></div>
                                <div class="text-muted small mb-1">
                                    <i class="ti ti-layout-grid me-1"></i><?php echo e($sr->departement->departement ?? 'N/A'); ?>

                                </div>
                                <div class="text-muted small">
                                    <i class="ti ti-user me-1"></i><?php echo e($sr->user->name ?? '-'); ?>

                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold mb-1"><?php echo e($sr->vendor->vendor ?? '-'); ?></div>
                                <?php
                                $namaBank = $sr->nama_bank ?: ($sr->norek_vendor->nama_bank ?? 'Default');
                                $norek = $sr->norek ?: ($sr->norek_vendor->norek ?? '-');
                                $namaPenerima = $sr->nama_penerima ?: ($sr->norek_vendor->nama_penerima ?? '-');
                                ?>
                                <div class="text-muted small"><i class="ti ti-building-bank me-1"></i><?php echo e($namaBank); ?></div>
                                <div class="text-muted small"><?php echo e($norek); ?></div>
                                <div class="text-muted small"><?php echo e($namaPenerima); ?></div>
                            </td>
                            <td class="text-end">
                                <?php
                                $amount = $sr->total_amount ?? 0;
                                $discount = $sr->additional_discount ?? 0;
                                $total = $amount - $discount;
                                // Total settlement on PR Advance means how much advance was given
                                $advanceGiven = $sr->payments->sum('grand_total') ?? 0;
                                $pendingAdvance = $total - $advanceGiven;

                                $hasSr = $sr->id_doc_type == 2 && $sr->srs->count() > 0;
                                ?>

                                <div class="small d-flex justify-content-between">
                                    <span class="text-muted">Amount:</span>
                                    <span><?php echo e(number_format($amount, 0, ',', '.')); ?></span>
                                </div>
                                <div class="small d-flex justify-content-between text-danger mb-1 border-bottom pb-1">
                                    <span class="text-muted">Discount:</span>
                                    <span><?php echo e(number_format($discount, 0, ',', '.')); ?></span>
                                </div>
                                <div class="small fw-bold d-flex justify-content-between">
                                    <span>Total:</span>
                                    <span><?php echo e(number_format($total, 0, ',', '.')); ?></span>
                                </div>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sr->id_doc_type != 2): ?>
                                <div class="small d-flex justify-content-between text-warning">
                                    <span>Receipt:</span>
                                    <span><?php echo e(number_format($pendingAdvance, 0, ',', '.')); ?></span>
                                </div>
                                <div class="small d-flex justify-content-between text-success mt-1">
                                    <span>Refund:</span>
                                    <span><?php echo e(number_format($advanceGiven, 0, ',', '.')); ?></span>
                                </div>
                                <?php else: ?>
                                <?php
                                // For Doc Type 2 (Advance) that has SR, show SR calculations
                                $srTotal = 0;
                                if ($sr->srs) {
                                foreach($sr->srs as $nestedSr) {
                                $srTotal += $nestedSr->details->sum('ammount') - ($nestedSr->additional_discount ?? 0);
                                }
                                }
                                $srBalance = $srTotal - $advanceGiven;
                                ?>
                                <div class="small d-flex justify-content-between text-success mt-1 border-top pt-1">
                                    <span class="text-muted"><i class="ti ti-receipt-2"></i> SR Amount:</span>
                                    <span class="fw-bold"><?php echo e(number_format($srTotal, 0, ',', '.')); ?></span>
                                </div>
                                <div class="small d-flex justify-content-between mt-1 <?php echo e($srBalance > 0 ? 'text-danger' : ($srBalance < 0 ? 'text-primary' : 'text-success')); ?>">
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
                                    <?php echo e($sr->payment_due_date ? $sr->payment_due_date->format('d M Y') : '-'); ?>

                                </div>
                                <div class="small" title="Est. Settlement Date">
                                    <i class="ti ti-calendar-event text-info me-1"></i>
                                    <?php echo e($sr->est_settlement_date ? $sr->est_settlement_date->format('d M Y') : '-'); ?>

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
                                15 => ['label' => 'Pending Manager Sign Payment', 'color' => 'danger']
                                ];

                                $status = $sr->status ?? 0;
                                $badge = $statusBadge[$status] ?? ['label' => 'Unknown', 'color' => 'dark'];
                                ?>
                                <span class="badge bg-light-<?php echo e($badge['color']); ?> text-<?php echo e($badge['color']); ?>"><?php echo e($badge['label']); ?></span>


                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?php echo e(route('settlement-reports.show', hashid_encode($sr->id_pr, 'pr'))); ?>" class="btn btn-icon bg-light-primary rounded-circle" title="View">
                                        <i class="ti ti-eye fs-5"></i>
                                    </a>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sr->status == 0 && (auth()->user()->level === 1 || auth()->user()->hasPermission('sr.delete') || auth()->user()->id_user == $sr->id_user)): ?>
                                    <a href="<?php echo e(route('settlement-reports.edit', hashid_encode($sr->id_pr, 'pr'))); ?>" class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                        <i class="ti ti-edit fs-5"></i>
                                    </a>

                                    <button type="button"
                                        onclick="showConfirm({
                                                title: 'Hapus SR',
                                                message: 'Apakah Anda yakin ingin menghapus SR ini? Tindakan ini tidak dapat dibatalkan.',
                                                type: 'danger',
                                                onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').delete(<?php echo e($sr->id_pr); ?>)
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
                                    <h5 class="mt-3 modern-text-muted text-uppercase">No Settlement Reports Found</h5>
                                    <p class="modern-text-muted small">Mulai dengan membuat PR baru melalui tombol "New SR"</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <?php echo e($srs->links()); ?>

            </div>
        </div>
    </div>


    <style>
        .sr-management .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .sr-management .filter-section {
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

        .x-small {
            font-size: 0.75rem;
        }
    </style>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views/livewire/settlement-reports/index.blade.php ENDPATH**/ ?>