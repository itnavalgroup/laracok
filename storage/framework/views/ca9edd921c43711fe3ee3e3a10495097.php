<div class="production-detail" id="print-area">
    <style>
        .btn-cancel-qr {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 4px 12px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 12px;
            border: 2px solid #ff4d4f;
            color: #ff4d4f;
            background-color: transparent;
            transition: all 0.2s ease-in-out;
        }

        .btn-cancel-qr:hover {
            background-color: #ff4d4f;
            color: #fff;
            border-color: #ff4d4f;
        }
    </style>
    <?php
        $status = intval($production->status);
        $user = auth()->user();
        $isAdmin = $user->level == 1;
        $isOwner = $user->id_user == $production->id_user;
        $isRequestor = $user->id_user == $production->id_requestor;

        // ── Sign / Workflow Permissions ──────────────────────────────────
        $canSubmit   = $status == 0 && ($isAdmin || $isOwner || $isRequestor || $user->hasPermission('production.submit'));
        $canProcess  = $status == 1 && ($isAdmin || $user->hasPermission('production.process'));
        $canVerify   = $status == 2 && ($isAdmin || $user->hasPermission('production.verify'));

        // Cancel per-step
        $canCancelSubmit  = $status == 1 && ($isAdmin || $user->hasPermission('production.cancel_submit'));
        $canCancelProcess = $status == 2 && ($isAdmin || $user->hasPermission('production.cancel_process'));
        $canCancelVerify  = $status == 3 && ($isAdmin || $user->hasPermission('production.cancel_verify'));

        // ── Header Action Permissions ────────────────────────────────────
        $canEdit     = $status == 0 && ($isAdmin || $isOwner || $isRequestor || $user->hasPermission('production.edit'));
        $canPrint    = $isAdmin || $isOwner || $isRequestor || $user->hasPermission('production.print');
        $canDownload = $isAdmin || $isOwner || $isRequestor || $user->hasPermission('production.download');

        // ── Detail Permissions ───────────────────────────────────────────
        $canAddMaterial    = $status == 0 && ($isAdmin || $user->hasPermission('production_material.create'));
        $canEditMaterial   = $status == 0 && ($isAdmin || $user->hasPermission('production_material.edit'));
        $canDeleteMaterial = $status == 0 && ($isAdmin || $user->hasPermission('production_material.delete'));

        $canAddResult    = $status == 2 && ($isAdmin || $user->hasPermission('production_result.create'));
        $canEditResult   = $status == 2 && ($isAdmin || $user->hasPermission('production_result.edit'));
        $canDeleteResult = $status == 2 && ($isAdmin || $user->hasPermission('production_result.delete'));

        $canManageAtt = $isAdmin || $isOwner || $isRequestor || $user->hasPermission('production_attachment.create');
        $canViewAtt   = $isAdmin || $isOwner || $isRequestor || $user->hasPermission('production.view.attachment');
        $isAllowedStatus = in_array($production->status, [0, 1, 2]);

        $statusBadge = [
            0 => ['label' => 'DRAFT', 'color' => 'secondary'],
            1 => ['label' => 'SUBMITTED (REQ TO PROCESS)', 'color' => 'warning'],
            2 => ['label' => 'PROCESSED (REQ TO VERIFY)', 'color' => 'primary'],
            3 => ['label' => 'APPROVED / DONE', 'color' => 'success'],
            9 => ['label' => 'CANCELED', 'color' => 'danger'],
        ];
        $sbadge = $statusBadge[$status] ?? ['label' => 'UNKNOWN', 'color' => 'dark'];
    ?>

    <template x-teleport="#production-header-actions">
        <div class="d-flex align-items-center gap-2" data-html2canvas-ignore="true">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canSubmit): ?>
                <button type="button" class="btn btn-success btn-sm rounded-pill px-3 no-print-btn"
                    onclick="showConfirm({title: 'Submit Form?', message: 'Pastikan item sudah benar.', type: 'warning', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').submitProduction()})"><i
                        class="ti ti-check me-1"></i> Submit</button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canProcess): ?>
                <button type="button" class="btn btn-success btn-sm rounded-pill px-3 no-print-btn"
                    data-bs-toggle="modal" data-bs-target="#modalProcessDate"><i class="ti ti-check me-1"></i>
                    Process</button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCancelSubmit || $canCancelProcess): ?>
                <button type="button"
                    class="btn border border-danger text-danger btn-sm rounded-pill px-3 no-print-btn bg-white"
                    onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').cancelProduction() })"><i
                        class="ti ti-arrow-back-up me-1"></i> Cancel</button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canVerify): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($production->results->isEmpty()): ?>
                    <button type="button" class="btn btn-success btn-sm rounded-pill px-3 no-print-btn"
                        onclick="window.dispatchEvent(new CustomEvent('alert', {detail: {type: 'error', title: 'Gagal', message: 'Result (Output) belum ditambahkan. Silakan tambahkan hasil produksi terlebih dahulu!'}}))">
                        <i class="ti ti-check me-1"></i> Verify
                    </button>
                <?php else: ?>
                    <button type="button" class="btn btn-success btn-sm rounded-pill px-3 no-print-btn"
                        data-bs-toggle="modal" data-bs-target="#modalFinishDate"><i class="ti ti-check me-1"></i>
                        Verify</button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCancelVerify): ?>
                <button type="button"
                    class="btn border border-danger text-danger btn-sm rounded-pill px-3 no-print-btn bg-white"
                    onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya dan batalkan hasil produksi?', type: 'warning', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').cancelProduction() })"><i
                        class="ti ti-arrow-back-up me-1"></i> Cancel Process</button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </template>

    <div class="row">
        <div class="col-12">
            <div class="card p-4 border-0 shadow-sm">

                
                <div class="d-flex justify-content-between align-items-start mb-4 border-bottom pb-3"
                    data-html2canvas-ignore="true">
                    <div>
                        <h5 class="fw-bold mb-0">DETAIL</h5>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex gap-2">
                            <a href="<?php echo e(route('production.index')); ?>" class="btn btn-secondary btn-sm">Back</a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canDownload): ?>
                                <button id="btnDownloadPDF" onclick="downloadProductionPDF()"
                                    class="btn btn-danger btn-sm">
                                    <span id="btnDownloadNormal"><i class="ti ti-download me-1"></i>Download</span>
                                    <span id="btnDownloadLoading" class="d-none">
                                        <span class="spinner-border spinner-border-sm me-1" role="status"></span>Generating...
                                    </span>
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canPrint): ?>
                                <button onclick="window.printProduction()" class="btn btn-primary btn-sm">Print</button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEdit): ?>
                                <button type="button"
                                    wire:click="$dispatch('open-production-form', { id: <?php echo e($production->id_production); ?> })"
                                    class="btn btn-warning btn-sm">Edit</button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <div class="d-flex align-items-center mb-4">
                    
                    <div style="width: 30%;">
                        <?php $logoPath = $production->company->logo ?? 'logo.png'; ?>
                        <img src="<?php echo e(asset('assets/companies/logos/' . $logoPath)); ?>" class="img-fluid" alt="Logo"
                            style="max-height: 120px; object-fit: contain;">
                    </div>
                    
                    <div class="text-center" style="flex: 1;">
                        <h4 style="font-weight: 700; color: #3b5998; text-transform: uppercase; margin-bottom: 5px;">
                            <?php echo e($production->company->company_name ?? ($production->company->company ?? config('app.name'))); ?>

                        </h4>
                        <h4 style="font-weight: 600; text-decoration: underline; color: #435e2c; margin-bottom: 0;">
                            PRODUCTION CONVERSION FORM
                        </h4>
                    </div>
                    <div style="width: 30%;"></div>
                </div>

                
                <div class="alert alert-<?php echo e($sbadge['color']); ?> d-flex align-items-center mb-4" role="alert"
                    style="padding: 8px 15px; border-radius: 4px;">
                    <div style="text-decoration: underline; font-weight:600; font-size: 13px;">PRODUCTION DETAIL
                        INFORMATION</div>
                    <div class="mx-3">
                        <span class="badge bg-<?php echo e($sbadge['color']); ?>"
                            style="font-size:11px; padding: 4px 8px;"><?php echo e($sbadge['label']); ?></span>
                    </div>
                </div>

                
                <div class="row g-3" style="font-size: 15px;">
                    <div class="col-md-6">
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase text-nowrap">TRANSACTION TYPE</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">
                                <span class="badge bg-light-info text-info border px-3"
                                    style="font-size: 11px;">Production</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">PRODUCTION NUMBER</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7"><?php echo e($production->production_number ?? 'DRAFT'); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">COMPANY</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7"><?php echo e($production->company->company_name ?? '-'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">REQUEST DATE</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7"><?php echo e($production->created_at->format('d F Y')); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">PRODUCTION DATE</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">
                                <?php echo e($production->production_date ? \Carbon\Carbon::parse($production->production_date)->format('d F Y') : '-'); ?>

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">FINISHED DATE</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">
                                <?php echo e($production->finished_date ? \Carbon\Carbon::parse($production->finished_date)->format('d F Y') : '-'); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <div class="row g-3" style="font-size: 15px;">
                    <div class="col-md-6">
                        <div class="row mb-2 no-print-btn">
                            <div class="col-4 fw-bold text-uppercase">CREATOR</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7"><?php echo e($production->user->name ?? '-'); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">REQUESTOR</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7"><?php echo e($production->requestor->name ?? '-'); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">DEPARTEMENT</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7"><?php echo e($production->departement->departement ?? '-'); ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">WAREHOUSE</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7"><?php echo e($production->warehouse->warehouse_name ?? '-'); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">DESCRIPTION</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7"><?php echo e($production->description ?? '-'); ?></div>
                        </div>
                    </div>
                </div>

                
                <div class="card-header align-items-center bg-transparent d-flex px-0 py-3 mt-4 border-bottom">
                    <h5 class="fw-bold mb-0 flex-grow-1 text-danger">RAW MATERIALS (INPUTS)</h5>
                    <div class="d-flex gap-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canAddMaterial): ?>
                            <div class="d-flex gap-2 align-items-center no-print-btn">
                                <button type="button" class="btn btn-primary"
                                    onclick="document.dispatchEvent(new CustomEvent('open-production-modal-direct', {detail: {type: 'material'}}))">
                                    <i class="ti ti-plus me-1"></i> ADD MATERIAL
                                </button>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped" style="font-size: 15px;">
                        <thead class="text-center" style="background-color: #2e7d32;">
                            <tr>
                                <th style="width: 45px; color: rgb(230, 230, 230) !important;">NO</th>
                                <th style="width: 150px; color: rgb(230, 230, 230) !important;">CATEGORY</th>
                                <th style="color: rgb(230, 230, 230) !important;">CODE &amp; ITEM NAME</th>
                                <th style="width: 90px; color: rgb(230, 230, 230) !important;">QTY</th>
                                <th style="width: 80px; color: rgb(230, 230, 230) !important;">UOM</th>
                                <th style="width: 130px; color: rgb(230, 230, 230) !important;">PACKAGING</th>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEditMaterial || $canDeleteMaterial): ?>
                                    <th style="width: 80px; color: rgb(230, 230, 230) !important;"
                                        class="no-print-btn">AKSI</th>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $production->materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $mat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <td class="text-center"><?php echo e($index + 1); ?></td>
                                    <td class="text-center"><?php echo e($mat->category->item_category ?? '-'); ?></td>
                                    <td>
                                        <span class="fw-bold"><?php echo e($mat->item->item_code ?? 'N/A'); ?></span><br>
                                        <?php echo e($mat->item->item_name ?? '-'); ?>

                                    </td>
                                    <td class="text-end fw-bold"><?php echo e(number_format($mat->qty, 2, '.', ',')); ?></td>
                                    <td class="text-center"><?php echo e($mat->uom->uom ?? '-'); ?></td>
                                    <td class="text-center"><?php echo e($mat->packaging->packaging ?? '-'); ?></td>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEditMaterial || $canDeleteMaterial): ?>
                                        <td class="text-center no-print-btn">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEditMaterial): ?>
                                                <button type="button" class="btn btn-link p-0 text-primary me-2"
                                                    title="Edit Item"
                                                    onclick="Livewire.dispatch('openProductionDetailModal', ['material', <?php echo e($mat->id_production_material); ?>])"><i
                                                        class="ti ti-edit fs-4"></i></button>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canDeleteMaterial): ?>
                                                <button class="btn btn-link p-0 text-danger" title="Hapus Item"
                                                    onclick="showConfirm({ title: 'Hapus Item', message: 'Hapus material ini?', type: 'danger', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').deleteMaterial(<?php echo e($mat->id_production_material); ?>) })">
                                                    <i class="ti ti-trash fs-4"></i>
                                                </button>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </td>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="<?php echo e(($canEditMaterial || $canDeleteMaterial) ? 7 : 6); ?>"
                                        class="text-center py-4 text-muted small">
                                        Belum ada bahan baku ditambahkan.</td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="card-header align-items-center bg-transparent d-flex px-0 py-3 mt-4 border-bottom">
                    <h5 class="fw-bold mb-0 flex-grow-1 text-success">PRODUCTION RESULTS (OUTPUTS)</h5>
                    <div class="d-flex gap-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canAddResult): ?>
                            <div class="d-flex gap-2 align-items-center no-print-btn">
                                <button type="button" class="btn btn-primary"
                                    onclick="document.dispatchEvent(new CustomEvent('open-production-modal-direct', {detail: {type: 'result'}}))">
                                    <i class="ti ti-plus me-1"></i> ADD RESULT
                                </button>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped" style="font-size: 15px;">
                        <thead class="text-center" style="background-color: #0d47a1;">
                            <tr>
                                <th style="width: 45px; color: rgb(230, 230, 230) !important;">NO</th>
                                <th style="width: 150px; color: rgb(230, 230, 230) !important;">CATEGORY</th>
                                <th style="color: rgb(230, 230, 230) !important;">CODE &amp; ITEM NAME</th>
                                <th style="width: 90px; color: rgb(230, 230, 230) !important;">QTY</th>
                                <th style="width: 80px; color: rgb(230, 230, 230) !important;">UOM</th>
                                <th style="width: 130px; color: rgb(230, 230, 230) !important;">PACKAGING</th>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEditResult || $canDeleteResult): ?>
                                    <th style="width: 80px; color: rgb(230, 230, 230) !important;"
                                        class="no-print-btn">AKSI</th>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $production->results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <td class="text-center"><?php echo e($index + 1); ?></td>
                                    <td class="text-center"><?php echo e($res->category->item_category ?? '-'); ?></td>
                                    <td>
                                        <span class="fw-bold"><?php echo e($res->item->item_code ?? 'N/A'); ?></span><br>
                                        <?php echo e($res->item->item_name ?? '-'); ?>

                                    </td>
                                    <td class="text-end fw-bold"><?php echo e(number_format($res->qty, 2, '.', ',')); ?></td>
                                    <td class="text-center"><?php echo e($res->uom->uom ?? '-'); ?></td>
                                    <td class="text-center"><?php echo e($res->packaging->packaging ?? '-'); ?></td>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEditResult || $canDeleteResult): ?>
                                        <td class="text-center no-print-btn">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEditResult): ?>
                                                <button type="button" class="btn btn-link p-0 text-primary me-2"
                                                    title="Edit Item"
                                                    onclick="Livewire.dispatch('openProductionDetailModal', ['result', <?php echo e($res->id_production_result); ?>])"><i
                                                        class="ti ti-edit fs-4"></i></button>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canDeleteResult): ?>
                                                <button class="btn btn-link p-0 text-danger" title="Hapus Item"
                                                    onclick="showConfirm({ title: 'Hapus Item', message: 'Hapus result ini?', type: 'danger', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').deleteResult(<?php echo e($res->id_production_result); ?>) })">
                                                    <i class="ti ti-trash fs-4"></i>
                                                </button>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </td>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <tr>
                                    <td colspan="<?php echo e(($canEditResult || $canDeleteResult) ? 7 : 6); ?>"
                                        class="text-center py-4 text-muted small">Belum
                                        ada hasil produksi ditambahkan.</td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status == 3): ?>
                    
                    <div class="card-header align-items-center bg-transparent d-flex px-0 py-3 mt-4 border-bottom">
                        <h5 class="fw-bold mb-0 flex-grow-1 text-secondary">ITEM TRANSACTIONS (INVENTORY MOVEMENT)</h5>
                    </div>
                    <div class="table-responsive mt-2 mb-4">
                        <table class="table table-bordered table-striped" style="font-size: 15px;">
                            <thead class="text-center" style="background-color: #6c757d;">
                                <tr>
                                    <th style="width: 50px; color: rgb(230, 230, 230) !important;">NO</th>
                                    <th style="color: rgb(230, 230, 230) !important;">DATE</th>
                                    <th style="color: rgb(230, 230, 230) !important;">CODE & ITEM NAME</th>
                                    <th style="color: rgb(230, 230, 230) !important;">INCOME (+)</th>
                                    <th style="color: rgb(230, 230, 230) !important;">OUTCOME (-)</th>
                                    <th style="color: rgb(230, 230, 230) !important;">UOM</th>
                                    <th style="color: rgb(230, 230, 230) !important;">TRX CODE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $itemTransactions ?? collect(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($index + 1); ?></td>
                                        <td class="text-center">
                                            <?php echo e(\Carbon\Carbon::parse($trx->transaction_date)->format('d/m/Y')); ?></td>
                                        <td>
                                            <span class="fw-bold"><?php echo e($trx->item->item_code ?? 'N/A'); ?></span><br>
                                            <?php echo e($trx->item->item_name ?? '-'); ?>

                                        </td>
                                        <td class="text-end fw-bold text-success">
                                            <?php echo e(number_format($trx->income, 2, '.', ',')); ?></td>
                                        <td class="text-end fw-bold text-danger">
                                            <?php echo e(number_format($trx->outcome, 2, '.', ',')); ?></td>
                                        <td class="text-center"><?php echo e($trx->uom->uom ?? '-'); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo e(route('item-transactions.show', hashid_encode($trx->id_item_transaction))); ?>"
                                                target="_blank" class="fw-bold modern-text-title text-decoration-none"
                                                title="Detail Transaksi">
                                                <?php echo e($trx->transaction_code); ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted small">Tidak ada histori
                                            transaksi.</td>
                                    </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <div class="card-header align-items-center bg-transparent d-flex px-0 py-3 mt-4 border-bottom">
                    <h6 class="card-title mb-0 flex-grow-1 fw-bold text-uppercase">SUPPORTING DOCUMENT :</h6>
                    <div class="flex-shrink-0">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAllowedStatus && $canManageAtt): ?>
                            <button type="button" class="btn btn-primary no-print-btn"
                                data-bs-toggle="modal" data-bs-target="#modalAddAttachment"
                                data-html2canvas-ignore>
                                ADD
                            </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <div class="row g-3 py-3" style="font-size: 15px;">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $production->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php
                            if ($file->upload_status == 0) {
                                $canEditDeleteAtt = $production->status == 0 && $canManageAtt;
                            } else {
                                $canEditDeleteAtt = $production->status > 0 && $canManageAtt;
                            }
                            $attHash = hashid_encode($file->id_production_attachment, 'attachment-production');
                            $fileUrl = asset('assets/attachmentproduction/' . $file->filename);
                        ?>
                        <div class="col-md-2 d-flex align-items-center mb-2">
                            <div class="form-check form-check-inline d-flex align-items-center mb-0">
                                <input type="checkbox" class="form-check-input input-primary me-2" checked
                                    onclick="return false;" style="width: 1.2rem; height: 1.2rem;">
                                <label class="form-check-label text-justify flex-grow-1 fw-bold text-uppercase"
                                    style="cursor:pointer; font-size: 0.9rem;">
                                    <a href="javascript:void(0)" data-url="<?php echo e($fileUrl); ?>"
                                        data-type="<?php echo e($file->attachment->attachment ?? 'GENERAL'); ?>"
                                        data-note="<?php echo e($file->note); ?>"
                                        data-delete="<?php echo e(route('production.attachment.delete', $attHash)); ?>"
                                        data-update="<?php echo e(route('production.attachment.update', $attHash)); ?>"
                                        data-catid="<?php echo e($file->id_attachment); ?>"
                                        data-can-edit="<?php echo e($canEditDeleteAtt ? 'true' : 'false'); ?>"
                                        onclick="<?php echo e($canViewAtt ? 'previewAttachment(this)' : 'window.dispatchEvent(new CustomEvent(\'alert\', { detail: { type: \'error\', title: \'Access Denied\', message: \'Anda tidak memiliki izin untuk melihat lampiran.\' } }))'); ?>; return false;"
                                        style="color: inherit; text-decoration: none;">
                                        <?php echo e($file->attachment->attachment ?? ($file->note ?: '-')); ?>

                                    </a>
                                </label>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="col-12 text-center py-4 text-muted">
                            <i class="ti ti-file-off fs-1 mb-2 d-block"></i>
                            <p class="mb-0 small">Belum ada supporting document ditambahkan.</p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAllowedStatus && $canManageAtt): ?>
                                <button type="button" class="btn btn-sm btn-outline-primary mt-3 no-print-btn"
                                    data-bs-toggle="modal" data-bs-target="#modalAddAttachment"
                                    data-html2canvas-ignore>
                                    <i class="ti ti-plus me-1"></i> Tambah Document
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="mt-5 pt-4 border-top mb-5">
                    <div class="row g-3 text-center justify-content-center">

                        
                        <div class="col-md-3">
                            <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Requested By</div>
                            <div class="border-bottom mx-auto position-relative image-container d-flex flex-column align-items-center justify-content-center"
                                style="height: 120px; border-color: #333 !important;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($approverSigns[0])): ?>
                                    <img src="<?php echo e($approverSigns[0]['qr']); ?>"
                                        style="height: 100px; width: 100px; object-fit: contain;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCancelSubmit): ?>
                                        <button type="button"
                                            onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').cancelProduction() })"
                                            class="btn position-absolute no-print-btn btn-cancel-qr">Cancel</button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php elseif($status == 0): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canSubmit): ?>
                                        <div class="d-flex justify-content-center gap-2 w-100">
                                            <button type="button"
                                                onclick="showConfirm({title: 'Submit Form?', message: 'Pastikan item sudah benar.', type: 'warning', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').submitProduction()})"
                                                class="btn btn-outline-primary btn-xs mt-4 no-print-btn"
                                                style="font-size: 12px;">SUBMIT</button>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="mt-2 fw-bold small text-uppercase" style="font-size: 14px;">
                                <?php echo e($approverSigns[0]['user_name'] ?? ($production->requestor->name ?? ($production->user->name ?? '-'))); ?>

                            </div>
                            <div class="mt-1 x-small fw-bold text-uppercase">
                                <?php echo e($production->requestor->departement->departement ?? ($production->user->departement->departement ?? 'REQUESTOR')); ?>

                            </div>
                        </div>

                        
                        <div class="col-md-3 mx-1">
                            <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Processed By</div>
                            <div class="border-bottom mx-auto position-relative image-container d-flex flex-column align-items-center justify-content-center"
                                style="height: 120px; border-color: #333 !important;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($approverSigns[1])): ?>
                                    <img src="<?php echo e($approverSigns[1]['qr']); ?>"
                                        style="height: 100px; width: 100px; object-fit: contain;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCancelProcess): ?>
                                        <button type="button"
                                            onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').cancelProduction() })"
                                            class="btn position-absolute no-print-btn btn-cancel-qr">Cancel</button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php elseif($status == 1): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canProcess): ?>
                                        <div class="d-flex justify-content-center gap-2 w-100">
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalProcessDate"
                                                class="btn btn-success rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                style="width: 35px; height: 35px;" title="Process"><i
                                                    class="ti ti-check fs-4"></i></button>
                                            <button type="button"
                                                onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').cancelProduction() })"
                                                class="btn btn-danger rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                style="width: 35px; height: 35px;" title="Cancel"><i
                                                    class="ti ti-x fs-4"></i></button>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="mt-2 fw-bold small text-uppercase" style="font-size: 14px;">
                                <?php echo e($approverSigns[1]['user_name'] ?? '-'); ?>

                            </div>
                            <div class="mt-1 x-small fw-bold">PROCESSOR</div>
                        </div>

                        
                        <div class="col-md-3 mx-1">
                            <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Verified By</div>
                            <div class="border-bottom mx-auto position-relative image-container d-flex flex-column align-items-center justify-content-center"
                                style="height: 120px; border-color: #333 !important;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($approverSigns[2])): ?>
                                    <img src="<?php echo e($approverSigns[2]['qr']); ?>"
                                        style="height: 100px; width: 100px; object-fit: contain;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCancelVerify): ?>
                                        <button type="button"
                                            onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').cancelProduction() })"
                                            class="btn position-absolute no-print-btn btn-cancel-qr">Cancel</button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php elseif($status == 2): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canVerify): ?>
                                        <div class="d-flex justify-content-center gap-2 w-100">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($production->results->isEmpty()): ?>
                                                <button type="button"
                                                    onclick="window.dispatchEvent(new CustomEvent('alert', {detail: {type: 'error', title: 'Gagal', message: 'Result (Output) belum ditambahkan. Silakan tambahkan hasil produksi terlebih dahulu!'}}))"
                                                    class="btn btn-success rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                    style="width: 35px; height: 35px;" title="Verify"><i
                                                        class="ti ti-check fs-4"></i></button>
                                            <?php else: ?>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modalFinishDate"
                                                    class="btn btn-success rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                    style="width: 35px; height: 35px;" title="Verify"><i
                                                        class="ti ti-check fs-4"></i></button>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <button type="button"
                                                onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').cancelProduction() })"
                                                class="btn btn-danger rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                style="width: 35px; height: 35px;" title="Cancel"><i
                                                    class="ti ti-x fs-4"></i></button>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="mt-2 fw-bold small text-uppercase" style="font-size: 14px;">
                                <?php echo e($approverSigns[2]['user_name'] ?? '-'); ?>

                            </div>
                            <div class="mt-1 x-small fw-bold">VERIFIER</div>
                        </div>

                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($production->cancel_reason && $status == 0): ?>
                    <div class="alert alert-danger d-flex align-items-center mb-2 no-print-history" role="alert"
                        style="padding: 5px 15px;">
                        <div style="text-decoration: underline; font-weight:600; font-size: 12px;">REJECT / REVISION
                            HISTORY</div>
                    </div>
                    <div class="table-responsive mb-4 no-print-history">
                        <table class="table table-sm table-bordered table-striped" style="font-size: 11px;">
                            <thead class="bg-danger text-white">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>By</th>
                                    <th>Reason</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">
                                        <span class="badge bg-danger">REJECTED</span>
                                    </td>
                                    <td><?php echo e($production->canceledBy->name ?? 'Admin / System'); ?></td>
                                    <td><?php echo e($production->cancel_reason); ?></td>
                                    <td class="text-center">
                                        <?php echo e($production->updated_at ? \Carbon\Carbon::parse($production->updated_at)->format('d/m/Y H:i') : '-'); ?>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('production.form-modal', []);

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4065962619-0', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('production.form-detail-modal', ['productionId' => $production->id_production]);

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4065962619-1', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

    
    <div class="modal fade" id="modalProcessDate" tabindex="-1" aria-labelledby="modalProcessDateLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header py-2 bg-success text-white">
                    <h6 class="modal-title fw-bold" id="modalProcessDateLabel">Mulai Proses Production</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label fw-bold small text-uppercase">Production Date (Process) <span
                            class="text-danger">*</span></label>
                    <input type="date" wire:model="process_date" class="form-control">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['process_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="modal-footer py-2 justify-content-between">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn-sm fw-bold" wire:click="processProduction">
                        PROCESS
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalFinishDate" tabindex="-1" aria-labelledby="modalFinishDateLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header py-2 bg-success text-white">
                    <h6 class="modal-title fw-bold" id="modalFinishDateLabel">Selesaikan & Potong Stok</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label fw-bold small text-uppercase">Finished Date <span
                            class="text-danger">*</span></label>
                    <input type="date" wire:model="finish_date" class="form-control"
                        min="<?php echo e($production->production_date ? \Carbon\Carbon::parse($production->production_date)->format('Y-m-d') : ''); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['finish_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="modal-footer py-2 justify-content-between">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn-sm fw-bold" wire:click="verifyProduction">
                        VERIFY & FINISH
                    </button>
                </div>
            </div>
        </div>
    </div>



    <?php echo $__env->make('livewire.production.attachment-modals', ['productionHash' => $hash], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>





<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('livewire.production.attachment-scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('production-refresh', () => {
                window.location.reload();
            });

            Livewire.on('close-modal-process', () => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalProcessDate'));
                if (modal) modal.hide();
                cleanupBackdrops();
            });

            Livewire.on('close-modal-verify', () => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalFinishDate'));
                if (modal) modal.hide();
                cleanupBackdrops();
            });
        });

        function cleanupBackdrops() {
            setTimeout(() => {
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                if (!document.querySelector('.modal.show')) {
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                }
            }, 300);
        }

        window.downloadProductionPDF = function() {
            const element = document.querySelector('.card');
            const noPrint = document.querySelectorAll('.no-print-btn, [data-html2canvas-ignore], [data-html2canvas-ignore="true"]');
            const btnDownload = document.getElementById('btnDownloadPDF');
            const btnNormal = document.getElementById('btnDownloadNormal');
            const btnLoading = document.getElementById('btnDownloadLoading');

            // Show loading state
            btnDownload.disabled = true;
            btnNormal.classList.add('d-none');
            btnLoading.classList.remove('d-none');

            // Hard hide before capture
            noPrint.forEach(b => b.style.setProperty('display', 'none', 'important'));

            const options = {
                margin: 0,
                filename: 'PRODUCTION-<?php echo e($production->production_number ?? "DRAFT"); ?>.pdf',
                image: { type: 'jpeg', quality: 0.85 },
                html2canvas: { scale: 1.5, useCORS: true, logging: false, letterRendering: true },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            const { jsPDF } = window.jspdf;

            html2canvas(element, options.html2canvas).then(canvas => {
                const imgData = canvas.toDataURL('image/jpeg', options.image.quality);
                const pdf = new jsPDF(options.jsPDF);
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
                pdf.save(options.filename);

                // Reset button
                btnDownload.disabled = false;
                btnNormal.classList.remove('d-none');
                btnLoading.classList.add('d-none');

                // Show back
                noPrint.forEach(b => b.style.display = '');
            }).catch(err => {
                console.error('PDF Generation Error:', err);
                btnDownload.disabled = false;
                btnNormal.classList.remove('d-none');
                btnLoading.classList.add('d-none');
                noPrint.forEach(b => b.style.display = '');
                alert('Gagal menghasilkan PDF. Silakan coba lagi.');
            });
        };

        window.printProduction = function() {
            const element = document.querySelector('.card');
            const noPrint = document.querySelectorAll('.no-print-btn, [data-html2canvas-ignore], [data-html2canvas-ignore="true"]');

            // Hard hide before capture
            noPrint.forEach(b => b.style.setProperty('display', 'none', 'important'));

            const { jsPDF } = window.jspdf;

            html2canvas(element, {
                scale: 1.5,
                useCORS: true,
                logging: false,
                letterRendering: true
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/jpeg', 0.85);
                const pdf = new jsPDF({ unit: 'mm', format: 'a4', orientation: 'portrait' });
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
                const pdfBlob = pdf.output('blob');
                const pdfUrl = URL.createObjectURL(pdfBlob);

                // Open in hidden iframe and print silently
                const iframe = document.createElement('iframe');
                iframe.style.display = 'none';
                iframe.src = pdfUrl;
                document.body.appendChild(iframe);
                iframe.onload = function() {
                    iframe.contentWindow.focus();
                    iframe.contentWindow.print();
                    setTimeout(() => {
                        document.body.removeChild(iframe);
                        URL.revokeObjectURL(pdfUrl);
                    }, 3000);
                };

                // Show back
                noPrint.forEach(b => b.style.display = '');
            }).catch(err => {
                console.error('Print Generation Error:', err);
                noPrint.forEach(b => b.style.display = '');
                alert('Gagal generate print. Silakan coba lagi.');
            });
        };
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\!Kerja\laracok - Copy\resources\views/livewire/production/show.blade.php ENDPATH**/ ?>