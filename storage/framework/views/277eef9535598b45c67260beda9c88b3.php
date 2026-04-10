<div class="items-management">
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">INVENTORY</li>
                    <li class="breadcrumb-item active text-uppercase">ITEM TRANSACTION</li>
                </ol>
            </nav>
        </div>

        <!-- Summary & Header -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary h-100">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Transaksi</h6>
                            <h2 class="mb-0 fw-bold text-white"><?php echo e($totalTransactions); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">Item Transactions</h4>
                                <p class="text-muted small mb-0">Kelola riwayat barang masuk dan keluar di gudang</p>
                            </div>
                            <div class="d-flex gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_transaction.download')): ?>
                                <button wire:click="export" class="btn btn-outline-primary rounded-pill px-3 d-flex align-items-center gap-2">
                                    <i class="ti ti-file-export fs-4"></i>
                                    <span class="fw-semibold text-uppercase d-none d-md-inline">Export</span>
                                </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_transaction.upload')): ?>
                                <button type="button" class="btn btn-outline-success rounded-pill px-3 d-flex align-items-center gap-2"
                                    data-bs-toggle="modal" data-bs-target="#importModal">
                                    <i class="ti ti-file-import fs-4"></i>
                                    <span class="fw-semibold text-uppercase d-none d-md-inline">Import</span>
                                </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_transaction.create')): ?>
                                <button wire:click="create" class="btn btn-primary rounded-pill px-4 d-flex align-items-center gap-2">
                                    <i class="ti ti-plus fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Buat Transaksi</span>
                                </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_transaction.view.report')): ?>
        <!-- Report Visualization Section -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm h-100 theme-responsive-card">
                <div class="card-header border-0 pt-4 pb-0 bg-transparent">
                    <?php
                        $activeChartFilters = [];
                        if ($reportCategory) {
                            $rCatLabel = collect($categories)->firstWhere('id_item_category', $reportCategory)?->item_category ?? 'Kategori';
                            $activeChartFilters['reportCategory'] = $rCatLabel;
                        }
                        if ($reportItem) {
                            $rItemLabel = collect($reportItemsDropdown)->firstWhere('id_item', $reportItem)?->item_name ?? 'Barang';
                            $activeChartFilters['reportItem'] = $rItemLabel;
                        }
                        if ($reportWarehouse) {
                            $rWhLabel = collect($warehouses)->firstWhere('id_warehouse', $reportWarehouse)?->warehouse_name ?? 'Gudang';
                            $activeChartFilters['reportWarehouse'] = $rWhLabel;
                        }
                        if ($reportCompany) {
                            $rCmpLabel = collect($companies)->firstWhere('id_company', $reportCompany)?->company_name ?? 'Company';
                            $activeChartFilters['reportCompany'] = $rCmpLabel;
                        }
                        if ($reportDateFilter !== 'all') {
                            $rDateLabels = ['today' => 'Hari Ini', 'this_week' => 'Minggu Ini', 'this_month' => 'Bulan Ini', 'custom' => 'Custom'];
                            $activeChartFilters['reportDateFilter'] = $rDateLabels[$reportDateFilter] ?? $reportDateFilter;
                        }
                        $hasActiveChartFilter = count($activeChartFilters) > 0;
                    ?>

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <h5 class="mb-0 fw-bold modern-text-title text-uppercase">Ringkasan Transaksi</h5>

                        <div class="d-flex align-items-center gap-2 flex-wrap justify-content-end">
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasActiveChartFilter): ?>
                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $activeChartFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
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
                                class="btn btn-light border-0 shadow-sm d-flex align-items-center gap-2 <?php echo e($hasActiveChartFilter ? 'border-primary border' : ''); ?>"
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#advancedChartFilters"
                                aria-expanded="<?php echo e($hasActiveChartFilter ? 'true' : 'false'); ?>"
                                aria-controls="advancedChartFilters">
                                <i class="ti ti-filter fs-5 <?php echo e($hasActiveChartFilter ? 'text-primary' : ''); ?>"></i>
                                <span class="d-none d-sm-inline">Filters Chart</span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasActiveChartFilter): ?>
                                    <span class="badge bg-primary rounded-pill"
                                        style="font-size:0.7rem;"><?php echo e(count($activeChartFilters)); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Report Filters (Collapsible) -->
                    <div class="collapse mb-4 <?php echo e($hasActiveChartFilter ? 'show' : ''); ?>" id="advancedChartFilters" wire:ignore.self>
                        <div class="p-3 bg-light rounded-3 bg-opacity-50">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label small text-muted">Periode</label>
                                    <select wire:model.live="reportDateFilter" class="form-select border-0 bg-white shadow-none rounded-3">
                                        <option value="all">Semua Waktu</option>
                                        <option value="today">Hari Ini</option>
                                        <option value="this_week">Minggu Ini</option>
                                        <option value="this_month">Bulan Ini</option>
                                        <option value="custom">Custom Tanggal</option>
                                    </select>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($reportDateFilter === 'custom'): ?>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Range Tanggal</label>
                                    <div class="input-group">
                                        <input type="date" wire:model.live="reportStartDate" class="form-control border-0 bg-white shadow-none rounded-start-3">
                                        <span class="input-group-text border-0 bg-white">sd</span>
                                        <input type="date" wire:model.live="reportEndDate" class="form-control border-0 bg-white shadow-none rounded-end-3">
                                    </div>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <div class="col-md-3">
                                    <label class="form-label small text-muted">Kategori</label>
                                    <select wire:model.live="reportCategory" class="form-select border-0 bg-white shadow-none rounded-3 select2">
                                        <option value="">Semua Kategori</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($cat->id_item_category); ?>"><?php echo e($cat->item_category); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label small text-muted">Barang</label>
                                    <select wire:model.live="reportItem" class="form-select border-0 bg-white shadow-none rounded-3" <?php echo e(empty($reportCategory) ? 'disabled' : ''); ?>>
                                        <option value="">Semua Barang</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($reportItemsDropdown)): ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $reportItemsDropdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($item->id_item); ?>"><?php echo e($item->item_name); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label small text-muted">Perusahaan</label>
                                    <select wire:model.live="reportCompany" class="form-select border-0 bg-white shadow-none rounded-3">
                                        <option value="">Semua Perusahaan</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($cmp->id_company); ?>"><?php echo e($cmp->company_name); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </select>
                                </div>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_transaction.view.all')): ?>
                                <div class="col-md-3">
                                    <label class="form-label small text-muted">Gudang</label>
                                    <select wire:model.live="reportWarehouse" class="form-select border-0 bg-white shadow-none rounded-3">
                                        <option value="">Semua Gudang</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($wh->id_warehouse); ?>"><?php echo e($wh->warehouse_name); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </select>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Chart & Summary Cards -->
                    <div class="row">
                        <!-- Chart Container -->
                        <div class="col-md-9 mb-3 mb-md-0">
                            <div id="itemTransactionChart" style="min-height: 350px;" wire:ignore></div>
                        </div>
                        <!-- Summary Number Cards -->
                        <div class="col-md-3">
                            <div class="d-flex flex-column gap-3 h-100 justify-content-center">
                                <div class="card bg-success bg-opacity-10 border-success border-opacity-25 border shadow-sm" style="backdrop-filter: blur(5px);">
                                    <div class="card-body py-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="text-success mb-0 fw-semibold">Total Income</h6>
                                            <i class="ti ti-arrow-down-right fs-4 text-success opacity-75"></i>
                                        </div>
                                        <h3 class="mb-0 fw-bold text-success"><?php echo e(number_format($reportData['total_income'], 2, '.', ',') ?? "Error"); ?></h3>
                                    </div>
                                </div>
                                <div class="card bg-danger bg-opacity-10 border-danger border-opacity-25 border shadow-sm" style="backdrop-filter: blur(5px);">
                                    <div class="card-body py-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="text-danger mb-0 fw-semibold">Total Outcome</h6>
                                            <i class="ti ti-arrow-up-right fs-4 text-danger opacity-75"></i>
                                        </div>
                                        <h3 class="mb-0 fw-bold text-danger"><?php echo e(number_format($reportData['total_outcome'], 2, ".", ",") ?? "Error"); ?></h3>
                                    </div>
                                </div>
                                <div class="card bg-primary bg-opacity-10 border-primary border-opacity-25 border shadow-sm" style="backdrop-filter: blur(5px);">
                                    <div class="card-body py-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="text-primary mb-0 fw-semibold">Net (Sisa)</h6>
                                            <i class="ti ti-chart-pie fs-4 text-primary opacity-75"></i>
                                        </div>
                                        <h3 class="mb-0 fw-bold text-primary"><?php echo e(number_format($reportData['total_net'], 2, ".", ",") ?? "Error"); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($stockSummaryCategoryId): ?>
        <!-- Stock Summary Table -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm theme-responsive-card">
                <div class="card-header bg-transparent border-0 pt-4 pb-0 d-flex align-items-center gap-2">
                    <i class="ti ti-chart-bar fs-4 text-primary"></i>
                    <h5 class="mb-0 fw-bold modern-text-title text-uppercase">
                        Ringkasan Stock: <?php echo e($stockSummaryCategoryName); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($stockSummaryItemName): ?>
                            <span class="text-muted fw-normal">— <?php echo e($stockSummaryItemName); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </h5>
                </div>
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped modern-table mb-0">
                            <thead style="background-color: #1a4a8a; color: white;">
                                <tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$stockSummaryItemId): ?>
                                    <th>BARANG</th>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <th>GUDANG</th>
                                    <th>COMPANY</th>
                                    <th class="text-end">INCOME</th>
                                    <th class="text-end">OUTCOME</th>
                                    <th class="text-end">STOCK (NET)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $stockSummary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $summary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$stockSummaryItemId): ?>
                                    <td>
                                        <span class="fw-bold"><?php echo e($summary->item->item_name ?? '-'); ?></span><br>
                                        <small class="text-muted"><?php echo e($summary->item->item_code ?? ''); ?></small>
                                    </td>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <td><?php echo e($summary->warehouse->warehouse_name ?? '-'); ?></td>
                                    <td><?php echo e($summary->company->company_name ?? '-'); ?></td>
                                    <td class="text-end text-success fw-bold"><?php echo e(number_format($summary->total_income, 2)); ?></td>
                                    <td class="text-end text-danger fw-bold"><?php echo e(number_format($summary->total_outcome, 2)); ?></td>
                                    <?php $net = $summary->total_income - $summary->total_outcome; ?>
                                    <td class="text-end fw-bold <?php echo e($net >= 0 ? 'text-primary' : 'text-danger'); ?>">
                                        <?php echo e(number_format($net, 2)); ?>

                                    </td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="<?php echo e(!$stockSummaryItemId ? 6 : 5); ?>" class="text-center py-4 text-muted">Belum ada data stok untuk filter ini.</td>
                                </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($stockSummary->count() > 1): ?>
                            <tfoot class="table-light fw-bold">
                                <tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$stockSummaryItemId): ?><td>TOTAL</td><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <td colspan="2" class="text-muted small"><?php echo e($stockSummary->count()); ?> kombinasi data</td>
                                    <td class="text-end text-success"><?php echo e(number_format($stockSummary->sum('total_income'), 2)); ?></td>
                                    <td class="text-end text-danger"><?php echo e(number_format($stockSummary->sum('total_outcome'), 2)); ?></td>
                                    <td class="text-end text-primary"><?php echo e(number_format($stockSummary->sum('total_income') - $stockSummary->sum('total_outcome'), 2)); ?></td>
                                </tr>
                            </tfoot>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Filter Section -->
        <div class="col-12 mb-4">
            <div class="filter-section shadow-sm border-0 theme-responsive-card p-3 rounded-3">

                <?php
                    $activeFilters = [];
                    if ($filterCategory) {
                        $catLabel = collect($categories)->firstWhere('id_item_category', $filterCategory)?->item_category ?? 'Kategori';
                        $activeFilters['filterCategory'] = $catLabel;
                    }
                    if ($filterItem) {
                        $itemLabel = collect($filterItemsDropdown)->firstWhere('id_item', $filterItem)?->item_name ?? 'Barang';
                        $activeFilters['filterItem'] = $itemLabel;
                    }
                    if ($filterWarehouse) {
                        $whLabel = collect($warehouses)->firstWhere('id_warehouse', $filterWarehouse)?->warehouse_name ?? 'Gudang';
                        $activeFilters['filterWarehouse'] = $whLabel;
                    }
                    if ($filterCompany) {
                        $cmpLabel = collect($companies)->firstWhere('id_company', $filterCompany)?->company_name ?? 'Company';
                        $activeFilters['filterCompany'] = $cmpLabel;
                    }
                    if ($filterDate !== 'all') {
                        $dateLabels = ['today' => 'Hari Ini', 'this_week' => 'Minggu Ini', 'this_month' => 'Bulan Ini', 'custom' => 'Custom'];
                        $activeFilters['filterDate'] = $dateLabels[$filterDate] ?? $filterDate;
                    }
                    $hasActiveFilter = count($activeFilters) > 0;
                ?>

                <!-- Primary Filter Bar (Always visible) -->
                <div class="row g-3 align-items-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted">
                                <i class="ti ti-search fs-5"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 ps-0 text-truncate"
                                placeholder="Cari Kode Transaksi / Nama Barang...">
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-8 d-flex justify-content-md-end justify-content-between align-items-center gap-2 flex-wrap">

                        
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
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Kategori</label>
                                <select wire:model.live="filterCategory" class="form-select border-0 bg-white shadow-none rounded-3">
                                    <option value="">Semua Kategori</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($cat->id_item_category); ?>"><?php echo e($cat->item_category); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Barang</label>
                                <select wire:model.live="filterItem" class="form-select border-0 bg-white shadow-none rounded-3" <?php echo e(empty($filterCategory) ? 'disabled' : ''); ?>>
                                    <option value="">Semua Barang</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filterItemsDropdown)): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filterItemsDropdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($item->id_item); ?>"><?php echo e($item->item_name); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Periode</label>
                                <select wire:model.live="filterDate" class="form-select border-0 bg-white shadow-none rounded-3">
                                    <option value="all">Semua Waktu</option>
                                    <option value="today">Hari Ini</option>
                                    <option value="this_week">Minggu Ini</option>
                                    <option value="this_month">Bulan Ini</option>
                                    <option value="custom">Pilih Tanggal</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Perusahaan</label>
                                <select wire:model.live="filterCompany" class="form-select border-0 bg-white shadow-none rounded-3">
                                    <option value="">Semua Perusahaan</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($cmp->id_company); ?>"><?php echo e($cmp->company_name); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_transaction.view.all')): ?>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Gudang</label>
                                <select wire:model.live="filterWarehouse" class="form-select border-0 bg-white shadow-none rounded-3">
                                    <option value="">Semua Gudang</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($wh->id_warehouse); ?>"><?php echo e($wh->warehouse_name); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <!-- Custom Date Range -->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filterDate === 'custom'): ?>
                            <div class="col-md-2">
                                <label class="form-label small text-muted">Mulai</label>
                                <input type="date" wire:model.live="filterStartDate" class="form-control border-0 bg-white shadow-none rounded-3">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small text-muted">Akhir</label>
                                <input type="date" wire:model.live="filterEndDate" class="form-control border-0 bg-white shadow-none rounded-3">
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                            <th>TRX CODE</th>
                            <th>TANGGAL</th>
                            <th>BARANG</th>
                            <th>KATEGORI</th>
                            <th>WAREHOUSE</th>
                            <th class="text-end">IN/OUT</th>
                            <th style="width: 120px;" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('trx-{{ $trx->id_item_transaction }}', get_defined_vars()); ?>wire:key="trx-<?php echo e($trx->id_item_transaction); ?>">
                            <td class="text-center text-muted small"><?php echo e(($transactions->currentPage()-1) * $transactions->perPage() + $loop->iteration); ?></td>
                            <td>
                                <span class="badge bg-light-secondary text-secondary fw-bold"><?php echo e($trx->transaction_code); ?></span>
                                <div class="small mt-1 text-muted">User: <?php echo e($trx->user->name ?? '-'); ?></div>
                            </td>
                            <td>
                                <div class="text-muted small"><?php echo e(\Carbon\Carbon::parse($trx->transaction_date)->format('d M Y')); ?></div>
                            </td>
                            <td>
                                <div class="fw-bold modern-text-title text-uppercase"><?php echo e($trx->item->item_name ?? '-'); ?></div>
                                <div class="text-muted small">
                                    <?php echo e($trx->company->company_name ?? '-'); ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trx->uom): ?> | <?php echo e($trx->uom->uom); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <span class="text-uppercase small fw-semibold text-primary">
                                    <i class="ti ti-tag me-1 text-primary-50"></i>
                                    <?php echo e($trx->category->item_category ?? '-'); ?>

                                </span>
                            </td>
                            <td>
                                <span class="text-uppercase small text-muted">
                                    <?php echo e($trx->warehouse->warehouse_name ?? '-'); ?>

                                </span>
                            </td>
                            <td class="text-end">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trx->income > 0): ?>
                                <span class="text-success fw-bold">+<?php echo e(number_format($trx->income, 2)); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trx->outcome > 0): ?>
                                <span class="text-danger fw-bold">-<?php echo e(number_format($trx->outcome, 2)); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <?php
                                    // View level permission evaluation for edit and delete actions
                                    $user = auth()->user();

                                    // Edit logic
                                    $canEdit = false;
                                    if (!str_starts_with($trx->transaction_code, 'IKB-') && !str_starts_with($trx->transaction_code, 'PROD/')) {
                                    if ($user->level === 1 || $user->hasPermission('item_transaction.edit.all')) {
                                    $canEdit = true;
                                    } elseif ($user->hasPermission('item_transaction.edit')) {
                                    if ($trx->id_user == $user->id_user) {
                                    $canEdit = true;
                                    }
                                    }
                                    }

                                    // Delete logic
                                    $canDelete = false;
                                    if (!str_starts_with($trx->transaction_code, 'IKB-') && !str_starts_with($trx->transaction_code, 'PROD/')) {
                                    if ($user->level === 1 || $user->hasPermission('item_transaction.delete.all')) {
                                    $canDelete = true;
                                    } elseif ($user->hasPermission('item_transaction.delete')) {
                                    if ($trx->id_user == $user->id_user) {
                                    $canDelete = true;
                                    }
                                    }
                                    }

                                    // View logic
                                    $canView = false;
                                    $ikbHash = null;
                                    $prodHash = null;
                                    
                                    if (str_starts_with($trx->transaction_code, 'IKB-')) {
                                        // Specific logic for IKB: parse number and check permissions via ikbMap
                                        if (preg_match('/^IKB-(.+)-(\d+)$/', $trx->transaction_code, $matches)) {
                                            $num = $matches[1];
                                            if (isset($ikbMap[$num]) && $ikbMap[$num]['can_show']) {
                                                $canView = true;
                                                $ikbHash = $ikbMap[$num]['hashid'];
                                            }
                                        }
                                    } elseif (str_starts_with($trx->transaction_code, 'PROD/')) {
                                        // Specific logic for Production
                                        $prodNumber = preg_replace('/-(RAW|PROD)$/', '', $trx->transaction_code);
                                        if (isset($prodMap[$prodNumber]) && $prodMap[$prodNumber]['can_show']) {
                                            $canView = true;
                                            $prodHash = $prodMap[$prodNumber]['hashid'];
                                        }
                                    } else {
                                        // Standard transaction view permission
                                        if ($user->level === 1 || $user->hasPermission('item_transaction.detail')) {
                                            $canView = true;
                                        }
                                    }
                                    ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canView): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ikbHash): ?>
                                    <a href="<?php echo e(route('ikb.show', $ikbHash)); ?>" class="btn btn-icon bg-light-info rounded-circle" title="View IKB Detail">
                                        <i class="ti ti-eye fs-5"></i>
                                    </a>
                                    <?php elseif($prodHash): ?>
                                    <a href="<?php echo e(route('production.show', $prodHash)); ?>" class="btn btn-icon bg-light-info rounded-circle" title="View Production Detail">
                                        <i class="ti ti-eye fs-5"></i>
                                    </a>
                                    <?php else: ?>
                                    <a href="<?php echo e(route('item-transactions.show', hashid_encode($trx->id_item_transaction))); ?>" class="btn btn-icon bg-light-info rounded-circle" title="View">
                                        <i class="ti ti-eye fs-5"></i>
                                    </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEdit): ?>
                                    <button wire:click="edit(<?php echo e($trx->id_item_transaction); ?>)" class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                        <i class="ti ti-edit fs-5"></i>
                                    </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canDelete): ?>
                                    <button type="button"
                                        onclick="showConfirm({
                                                title: 'Hapus Transaksi',
                                                message: 'Apakah Anda yakin ingin menghapus transaksi <?php echo e($trx->transaction_code); ?>? Tindakan ini tidak dapat dibatalkan.',
                                                type: 'danger',
                                                onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').delete(<?php echo e($trx->id_item_transaction); ?>)
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
                            <td colspan="8" class="text-center py-5">
                                <div class="py-4">
                                    <i class="ti ti-folder-x fs-1 modern-text-muted opacity-50"></i>
                                    <h5 class="mt-3 modern-text-muted text-uppercase">Tidak ada data transaksi</h5>
                                    <p class="modern-text-muted small">Coba sesuaikan filter atau katakunci pencarian</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <?php echo e($transactions->links()); ?>

            </div>
        </div>
    </div>

    <!-- Transaction Modal -->
    <div wire:ignore.self class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase" id="transactionModalLabel">
                        <i class="ti ti-<?php echo e($isEditing ? 'edit' : 'plus'); ?> me-2"></i>
                        <?php echo e($isEditing ? 'Edit Transaksi' : 'Buat Transaksi'); ?>

                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTransaction" wire:submit.prevent="save">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <!-- Kategori Barang -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-uppercase">KATEGORI BARANG <span class="text-danger">*</span></label>
                                <select class="form-select <?php $__errorArgs = ['id_item_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model.live="id_item_category">
                                    <option value="">Pilih Kategori</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($cat->id_item_category); ?>"><?php echo e($cat->item_category); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['id_item_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Barang -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-uppercase">BARANG <span class="text-danger">*</span></label>
                                <select class="form-select <?php $__errorArgs = ['id_item'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="id_item" <?php echo e(empty($items) ? 'disabled' : ''); ?>>
                                    <option value="">Pilih Barang</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($item->id_item); ?>"><?php echo e($item->item_name); ?> (<?php echo e($item->item_code); ?>)</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['id_item'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($items) && $id_item_category): ?>
                                <small class="text-muted mt-1">Tidak ada barang aktif di kategori ini.</small>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Warehouse -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-uppercase">GUDANG (WAREHOUSE) <span class="text-danger">*</span></label>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->id_warehouse && !$isEditing): ?>
                                <!-- Using User Default Warehouse -->
                                <input type="text" class="form-control" value="<?php echo e(App\Models\Warehouse::find(auth()->user()->id_warehouse)->warehouse_name ?? 'Default'); ?>" disabled readonly>
                                <input type="hidden" wire:model="id_warehouse">
                                <?php else: ?>
                                <select class="form-select <?php $__errorArgs = ['id_warehouse'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="id_warehouse">
                                    <option value="">Pilih Gudang</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($wh->id_warehouse); ?>"><?php echo e($wh->warehouse_name); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['id_warehouse'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Company -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-uppercase">COMPANY <span class="text-danger">*</span></label>
                                <select class="form-select <?php $__errorArgs = ['id_company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="id_company">
                                    <option value="">Pilih Company</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($company->id_company); ?>"><?php echo e($company->company_name); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['id_company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- UOM -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-uppercase">UOM <span class="text-danger">*</span></label>
                                <select class="form-select <?php $__errorArgs = ['id_uom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="id_uom">
                                    <option value="">Pilih UOM</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $uoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($u->id_uom); ?>"><?php echo e($u->uom); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['id_uom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Packaging -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-uppercase">PACKAGING <span class="text-danger">*</span></label>
                                <select class="form-select <?php $__errorArgs = ['id_packaging'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="id_packaging">
                                    <option value="">Pilih Packaging</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $packagings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($p->id_packaging); ?>"><?php echo e($p->packaging); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['id_packaging'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Income Amt -->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_transaction.create')): ?>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-uppercase">INCOME / MASUK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['income'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    wire:model="income" placeholder="0" onkeyup="formatNumber(this)">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['income'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_transaction.out')): ?>
                            <!-- Outcome Amt -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-uppercase">OUTCOME / KELUAR <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['outcome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    wire:model="outcome" placeholder="0" onkeyup="formatNumber(this)">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['outcome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <!-- Transaction Date -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-uppercase">TANGGAL TRANSAKSI <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control <?php $__errorArgs = ['transaction_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    wire:model="transaction_date">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['transaction_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Vendor -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-uppercase">VENDOR</label>
                                <div wire:ignore <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('vendor-select-wrapper', get_defined_vars()); ?>wire:key="vendor-select-wrapper" x-data="{
                                    initVendor() {
                                        if ($(this.$refs.select).data('select2')) {
                                            $(this.$refs.select).select2('destroy');
                                        }
                                        $(this.$refs.select).select2({ 
                                            dropdownParent: $('#transactionModal'), 
                                            width: '100%' 
                                        }).on('change', (e) => {
                                            if ($wire.id_vendor !== e.target.value) {
                                                $wire.set('id_vendor', e.target.value);
                                            }
                                        });
                                    }
                                }" x-init="$watch('$wire.id_vendor', value => {
                                    if ($($refs.select).val() != value) {
                                        $($refs.select).val(value).trigger('change.select2');
                                    }
                                })">
                                    <select x-ref="select" x-init="initVendor()" class="form-select select2-trx-vendor" style="width: 100%;">
                                        <option value="">Pilih Vendor</option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($v->id_vendor); ?>"><?php echo e($v->vendor); ?></option>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </select>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['id_vendor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Police Number -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-uppercase">POLICE NUMBER</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['police_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="police_number" placeholder="e.g. B 1234 ABC">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['police_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Driver Name -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-uppercase">DRIVER NAME</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['driver_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="driver_name" placeholder="Enter Driver Name">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['driver_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- SO Number -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-uppercase">SO NUMBER</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['so_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="so_number" placeholder="Enter SO Number">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['so_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Invoice Number -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-uppercase">INVOICE NUMBER</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['invoice_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="invoice_number" placeholder="Enter Invoice Number">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['invoice_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- PO Number -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-uppercase">PO NUMBER</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['po_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="po_number" placeholder="Enter PO Number">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['po_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- FOB -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-uppercase">FOB</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['fob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="fob" placeholder="Enter FOB">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['fob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label class="form-label fw-bold small text-uppercase">KETERANGAN / DESCRIPTION</label>
                                <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="description" rows="2" placeholder="Tambahkan keterangan jika ada..."></textarea>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- Attachment Section -->
                            <div class="col-md-12">
                                <label class="form-label fw-bold small text-uppercase d-block">DOKUMEN PENDUKUNG <span class="text-danger">*</span></label>

                                <div class="btn-group w-100 mb-3" role="group">
                                    <input type="radio" class="btn-check" name="upload_mode" id="modeUpload" value="upload" wire:model.live="upload_mode">
                                    <label class="btn btn-outline-primary" for="modeUpload"><i class="ti ti-upload me-1"></i> Upload File</label>

                                    <input type="radio" class="btn-check" name="upload_mode" id="modeCamera" value="camera" wire:model.live="upload_mode">
                                    <label class="btn btn-outline-primary" for="modeCamera"><i class="ti ti-camera me-1"></i> Ambil Foto</label>
                                </div>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($upload_mode === 'upload'): ?>
                                <div class="p-3 bg-light rounded-3 text-center border-dashed">
                                    <input type="file" id="input_uploaded_file" class="form-control <?php $__errorArgs = ['uploaded_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="uploaded_file" accept="image/*,application/pdf">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['uploaded_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($uploaded_file): ?>
                                    <div class="mt-3 preview-container">
                                        <?php
                                        $extension = strtolower($uploaded_file->getClientOriginalExtension());
                                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                        ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isImage): ?>
                                        <img src="<?php echo e($uploaded_file->temporaryUrl()); ?>" class="img-fluid rounded-3 shadow-sm border" style="max-height: 200px;">
                                        <?php elseif($extension === 'pdf'): ?>
                                        <div class="p-3 bg-white rounded-3 border d-inline-block">
                                            <i class="ti ti-file-text fs-1 text-danger mb-2"></i>
                                            <div class="small fw-bold text-muted"><?php echo e($uploaded_file->getClientOriginalName()); ?></div>
                                        </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <div wire:loading wire:target="uploaded_file" class="mt-2 small text-primary">
                                        <i class="ti ti-loader ti-spin me-1"></i> Mengunggah...
                                    </div>
                                    <div class="small text-muted mt-2">Format: JPG, PNG, PDF (Max 5MB)</div>
                                </div>
                                <?php else: ?>
                                <div class="p-3 bg-light rounded-3 text-center border-dashed">
                                    <div id="camera-container" wire:ignore>
                                        <video id="video" width="100%" height="auto" autoplay class="rounded-3 mb-2 d-none"></video>
                                        <canvas id="canvas" class="d-none"></canvas>
                                        <div id="photo-preview" class="mb-2 <?php echo e($captured_photo ? '' : 'd-none'); ?>">
                                            <img src="<?php echo e($captured_photo); ?>" class="img-fluid rounded-3 shadow-sm" style="max-height: 250px;">
                                        </div>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" id="start-camera" class="btn btn-sm btn-info rounded-pill px-3">
                                                <i class="ti ti-video me-1"></i> Aktifkan Kamera
                                            </button>
                                            <button type="button" id="take-photo" class="btn btn-sm btn-success rounded-pill px-3 d-none">
                                                <i class="ti ti-camera me-1"></i> Ambil Foto
                                            </button>
                                            <button type="button" id="retake-photo" class="btn btn-sm btn-warning rounded-pill px-3 <?php echo e($captured_photo ? '' : 'd-none'); ?>">
                                                <i class="ti ti-refresh me-1"></i> Ambil Ulang
                                            </button>
                                        </div>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['captured_photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isEditing && $filename && !$uploaded_file && !$captured_photo): ?>
                                <div class="mt-2 small">
                                    <span class="text-muted text-uppercase fw-bold">File Saat Ini:</span>
                                    <a href="<?php echo e(asset('assets/attachmenttransaction/' . $filename)); ?>" target="_blank" class="text-decoration-none ms-1">
                                        <i class="ti ti-file-text me-1"></i> <?php echo e($filename); ?>

                                    </a>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="btnSaveTransaction" class="btn btn-primary rounded-pill px-4">
                            <i class="ti ti-device-floppy me-2"></i> <?php echo e($isEditing ? 'Update Transaksi' : 'Simpan Transaksi'); ?>

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div wire:ignore.self class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-success text-white py-3">
                    <h5 class="modal-title fw-bold" id="importModalLabel">
                        <i class="ti ti-file-upload me-2 d-inline-block"></i> IMPORT TRANSAKSI BARANG
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formImport" wire:submit.prevent="import">
                    <div class="modal-body p-4">
                        <div class="alert alert-info bg-light-info border-0 rounded-3 mb-4">
                            <h6 class="fw-bold mb-2"><i class="ti ti-info-circle me-1"></i> Informasi Panduan</h6>
                            <ul class="mb-0 small ps-3">
                                <li class="mb-1">Tipe format file yang didukung: <strong>.xlsx, .xls</strong></li>
                                <li class="mb-1">Batas maksimal ukuran upload file: <strong>5MB</strong></li>
                                <li>Pastikan template referensi kode disalin dari format terbaru. Jangan ganti judul kolom pertama. Baris berisi text akan diubah dengan id pada sistem referensi.</li>
                            </ul>
                        </div>
                        <div class="mb-4 text-center">
                            <button type="button" wire:click="downloadTemplate" class="btn btn-outline-success rounded-pill px-4 py-2 border-2 fw-semibold">
                                <i class="ti ti-download me-2"></i> Download Excel Template
                            </button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-uppercase small">Pilih File Excel Import <span class="text-danger">*</span></label>
                            <input type="file" id="input_file_excel" class="form-control <?php $__errorArgs = ['file_excel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model="file_excel" accept=".xlsx,.xls">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['file_excel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div wire:loading wire:target="file_excel" class="text-primary mt-2 small">
                                <i class="ti ti-loader ti-spin me-1"></i> Sedang mengunggah file...
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" id="btnStartImport" class="btn btn-success rounded-pill px-4" wire:loading.attr="disabled" wire:target="file_excel, import">
                            <i class="ti ti-check me-2" wire:loading.remove wire:target="import"></i>
                            <i class="ti ti-loader ti-spin me-2" wire:loading wire:target="import"></i>
                            Mulai Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        // Form Validation & Loading States for Item Transactions
        const validateFileSize = (input) => {
            const maxSize = 5 * 1024 * 1024; // 5MB
            if (input.files.length > 0 && input.files[0].size > maxSize) {
                window.dispatchEvent(new CustomEvent('alert', {
                    detail: {
                        type: 'warning',
                        title: 'File Terlalu Besar',
                        message: 'Ukuran maksimal file adalah 5MB.'
                    }
                }));
                input.value = ''; // Reset input to stop Livewire upload
                return false;
            }
            return true;
        };

        const setBtnLoading = (btn) => {
            if (!btn) return;
            btn.disabled = true;
            btn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> Please wait...`;
        };

        // Listen for changes early to prevent Livewire upload attempts for large files
        document.addEventListener('change', function(e) {
            if (e.target.id === 'input_uploaded_file' || e.target.id === 'input_file_excel') {
                validateFileSize(e.target);
            }
        });

        // Form submission loading states
        const formTrx = document.getElementById('formTransaction');
        if (formTrx) {
            formTrx.addEventListener('submit', function() {
                // validation is done on change, so here we just set loading
                setBtnLoading(document.getElementById('btnSaveTransaction'));
            });
        }

        const formImport = document.getElementById('formImport');
        if (formImport) {
            formImport.addEventListener('submit', function() {
                setBtnLoading(document.getElementById('btnStartImport'));
            });
        }

        document.addEventListener('livewire:init', () => {
            let scrollY = 0;

            Livewire.hook('commit', ({
                component,
                commit,
                respond,
                succeed,
                fail
            }) => {
                // Save the scroll position right before Livewire fetches the new HTML
                scrollY = window.scrollY;

                succeed(({
                    snapshot,
                    effect
                }) => {
                    // Restore the scroll smoothly after the DOM merges
                    setTimeout(() => {
                        // Jangan trigger scroll jika ada modal yang sedang terbuka,
                        // karena bisa menyebabkan dropdown Select2 (atau UI lainnya) tertutup secara paksa.
                        if (!document.body.classList.contains('modal-open')) {
                            window.scrollTo({
                                top: scrollY,
                                behavior: 'instant'
                            });
                        }
                    }, 0);
                });
            });
        });

        // -------------------------------------------------------
        // Manual polling: pause saat modal terbuka, agar Select2
        // dropdown tidak tertutup paksa saat Livewire re-render.
        // -------------------------------------------------------
        let pollInterval = null;

        function startPolling() {
            if (pollInterval) return;
            pollInterval = setInterval(() => {
                if (!document.body.classList.contains('modal-open')) {
                    // Refresh semua komponen Livewire aktif di halaman ini
                    Livewire.all().forEach(c => {
                        if (c.el && c.el.closest('.items-management')) {
                            c.$refresh();
                        }
                    });
                }
            }, 5000);
        }

        function stopPolling() {
            if (pollInterval) {
                clearInterval(pollInterval);
                pollInterval = null;
            }
        }

        // Mulai polling saat halaman dimuat
        startPolling();

        // Pause polling saat modal transaction dibuka
        const transactionModal = document.getElementById('transactionModal');
        if (transactionModal) {
            transactionModal.addEventListener('show.bs.modal', stopPolling);
            transactionModal.addEventListener('hidden.bs.modal', startPolling);
        }

        // Pause polling saat modal import dibuka
        const importModal = document.getElementById('importModal');
        if (importModal) {
            importModal.addEventListener('show.bs.modal', stopPolling);
            importModal.addEventListener('hidden.bs.modal', startPolling);
        }

        function formatNumber(input) {
            let value = input.value.replace(/,/g, '');
            if (isNaN(value) || value === '') {
                input.value = value.replace(/[^0-9.]/g, '');
                return;
            }

            // Allow decimals
            let parts = value.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            input.value = parts.join(".");
        }

        window.addEventListener('openTransactionModal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('transactionModal'));
            myModal.show();
        });

        window.addEventListener('closeTransactionModal', () => {
            var modalEl = document.getElementById('transactionModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        });

        window.addEventListener('closeImportModal', () => {
            var modalEl = document.getElementById('importModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        });

        // Camera Logic using Event Delegation for Livewire compatibility
        let stream = null;

        function getCameraElements() {
            return {
                video: document.getElementById('video'),
                canvas: document.getElementById('canvas'),
                startBtn: document.getElementById('start-camera'),
                takeBtn: document.getElementById('take-photo'),
                retakeBtn: document.getElementById('retake-photo'),
                previewDiv: document.getElementById('photo-preview'),
                previewImg: document.querySelector('#photo-preview img')
            };
        }

        async function startCamera() {
            const els = getCameraElements();
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert("Kamera tidak dapat diakses. Pastikan Anda menggunakan koneksi aman (HTTPS) atau diakses melalui localhost.");
                return;
            }

            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: true,
                    audio: false
                });
                if (els.video) {
                    els.video.srcObject = stream;
                    els.video.classList.remove('d-none');
                }
                if (els.takeBtn) els.takeBtn.classList.remove('d-none');
                if (els.startBtn) els.startBtn.classList.add('d-none');
                if (els.previewDiv) els.previewDiv.classList.add('d-none');
                if (els.retakeBtn) els.retakeBtn.classList.add('d-none');
            } catch (err) {
                alert("Error akses kamera: " + err.message);
            }
        }

        function takePhoto() {
            const els = getCameraElements();
            if (!els.video || !els.canvas) return;

            const context = els.canvas.getContext('2d');
            els.canvas.width = els.video.videoWidth;
            els.canvas.height = els.video.videoHeight;
            context.drawImage(els.video, 0, 0, els.canvas.width, els.canvas.height);

            const data = els.canvas.toDataURL('image/png');
            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('captured_photo', data);

            stopCamera();
            if (els.previewImg) els.previewImg.src = data;
            if (els.video) els.video.classList.add('d-none');
            if (els.takeBtn) els.takeBtn.classList.add('d-none');
            if (els.previewDiv) els.previewDiv.classList.remove('d-none');
            if (els.retakeBtn) els.retakeBtn.classList.remove('d-none');
            if (els.startBtn) {
                els.startBtn.classList.remove('d-none');
                els.startBtn.innerHTML = '<i class="ti ti-video me-1"></i> Ganti Foto';
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
        }

        // Global click listener for camera buttons (Delegation)
        document.addEventListener('click', (e) => {
            const startBtn = e.target.closest('#start-camera');
            const takeBtn = e.target.closest('#take-photo');
            const retakeBtn = e.target.closest('#retake-photo');

            if (startBtn) startCamera();
            if (takeBtn) takePhoto();
            if (retakeBtn) startCamera();
        });

        window.addEventListener('closeTransactionModal', () => {
            stopCamera();
        });
    </script>
    <?php $__env->stopPush(); ?>

    <style>
        .items-management .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .items-management .filter-section {
            background-color: #1a2531;
        }

        [data-pc-theme="dark"] .theme-responsive-card {
            background-color: #1a2531 !important;
        }

        /* ApexCharts Tooltip Dark Mode Fix */
        [data-pc-theme="dark"] .apexcharts-tooltip {
            background: #2d3b48 !important;
            border-color: #405161 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3) !important;
        }

        [data-pc-theme="dark"] .apexcharts-tooltip-title {
            background: #1a2531 !important;
            border-bottom: 1px solid #405161 !important;
            color: #ffffff !important;
        }

        [data-pc-theme="dark"] .apexcharts-tooltip-text {
            color: #ffffff !important;
        }

        .summary-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .summary-card:hover {
            transform: translateY(-2px);
        }
    </style>

        <?php
        $__scriptKey = '2812544604-0';
        ob_start();
    ?>
    <script>
        let chart = null;

        const renderChart = (data, isDarkMode) => {
            if (!data || !document.getElementById('itemTransactionChart')) return;

            const options = {
                series: [{
                    name: 'Income',
                    data: data.income
                }, {
                    name: 'Outcome',
                    data: data.outcome
                }, {
                    name: 'Net (Sisa)',
                    data: data.net,
                }],
                chart: {
                    type: 'area', // or 'bar'
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'Inter, sans-serif'
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#28a745', '#dc3545', '#0d6efd'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: data.categories,
                    labels: {
                        style: {
                            colors: isDarkMode ? '#aab8c5' : '#6c757d'
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Items',
                        style: {
                            color: isDarkMode ? '#aab8c5' : '#6c757d'
                        }
                    },
                    labels: {
                        style: {
                            colors: isDarkMode ? '#aab8c5' : '#6c757d'
                        },
                        formatter: function(val) {
                            return new Intl.NumberFormat('en-US').format(val);
                        }
                    }
                },
                legend: {
                    labels: {
                        colors: isDarkMode ? '#aab8c5' : '#6c757d'
                    }
                },
                grid: {
                    borderColor: isDarkMode ? '#2d3b48' : '#e0e0e0',
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    theme: isDarkMode ? 'dark' : 'light',
                    y: {
                        formatter: function(val) {
                            return new Intl.NumberFormat('en-US').format(val) + " items"
                        }
                    }
                }
            };

            if (chart) {
                chart.destroy();
            }

            chart = new ApexCharts(document.querySelector("#itemTransactionChart"), options);
            chart.render();
        };

        const renderWithCurrentTheme = (data) => {
            const isDarkMode = document.documentElement.getAttribute('data-pc-theme') === 'dark' || document.body.getAttribute('data-sidebar-theme') === 'dark';
            renderChart(data, isDarkMode);
        };

        // Initial render if data exists
        let initialData = <?php echo json_encode($reportData ?? null, 15, 512) ?>;
        if (initialData) {
            setTimeout(() => renderWithCurrentTheme(initialData), 50); // slight delay for DOM
        }

        // Listen for updates from Livewire
        $wire.on('update-report-chart', ({
            data
        }) => {
            renderWithCurrentTheme(data);
        });

        // Optional: Re-render if Theme changes (if your app logic toggles the data attributes)
        const observer = new MutationObserver(() => {
            if (chart && initialData) renderWithCurrentTheme(initialData);
        });
        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['data-pc-theme']
        });
    </script>
        <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views/livewire/item-transactions/index.blade.php ENDPATH**/ ?>