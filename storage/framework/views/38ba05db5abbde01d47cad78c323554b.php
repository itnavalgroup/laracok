<div class="user-show user-edit transaction-show">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('item-transactions.index')); ?>" class="text-decoration-none text-uppercase">ITEM TRANSACTION</a></li>
                    <li class="breadcrumb-item active text-uppercase">TRANSACTION DETAILS</li>
                </ol>
            </nav>

            <div class="card edit-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold"><i class="ti ti-file-analytics me-2"></i>TRANSACTION DETAILS</h4>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('item-transactions.index')); ?>" class="btn btn-outline-light btn-sm rounded-pill px-3">
                            <i class="ti ti-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    <!-- Transaction Header -->
                    <div class="user-profile-header mb-5 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">TRANSACTION CODE</h6>
                            <h3 class="mb-0 fw-bold"><?php echo e($transaction->transaction_code); ?></h3>
                            <p class="mb-0 mt-1 small opacity-75">Date: <?php echo e(\Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y H:i')); ?> | Created by: <?php echo e($transaction->user->name ?? '-'); ?></p>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($relatedProduction): ?>
                        <div>
                            <a href="<?php echo e(route('production.show', hashid_encode($relatedProduction->id_production, 'production'))); ?>" class="btn btn-primary rounded-pill px-4">
                                <i class="ti ti-link me-1"></i> View Production
                            </a>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Item Information -->
                    <div class="form-section">
                        <div class="section-header d-flex align-items-center">
                            <i class="ti ti-package me-2 text-primary"></i>
                            <h5 class="mb-0">Item Information</h5>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label small">Item Name</label>
                                <div class="fw-bold modern-text-title"><?php echo e($transaction->item->item_name ?? '-'); ?></div>
                                <div class="text-muted small"><?php echo e($transaction->item->item_code ?? ''); ?></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Category</label>
                                <div><span class="badge bg-primary-subtle text-primary rounded-pill"><?php echo e($transaction->category->item_category ?? '-'); ?></span></div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">UOM</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->uom->uom ?? '-'); ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Packaging</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->packaging->packaging ?? '-'); ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-success fw-bold">Income (+)</label>
                                <input type="text" class="form-control bg-light text-success fw-bold" value="<?php echo e(number_format($transaction->income, 2)); ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-danger fw-bold">Outcome (-)</label>
                                <input type="text" class="form-control bg-light text-danger fw-bold" value="<?php echo e(number_format($transaction->outcome, 2)); ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Organization & Warehouse -->
                    <div class="form-section">
                        <div class="section-header d-flex align-items-center">
                            <i class="ti ti-building me-2 text-primary"></i>
                            <h5 class="mb-0">Organization & Warehouse</h5>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label small">Company</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->company->company_name ?? '-'); ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Warehouse</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->warehouse->warehouse_name ?? '-'); ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Department</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->departement->departement ?? '-'); ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Logistics & Documentation -->
                    <div class="form-section">
                        <div class="section-header d-flex align-items-center">
                            <i class="ti ti-truck me-2 text-primary"></i>
                            <h5 class="mb-0">Logistics & Documentation</h5>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label small">Vendor</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->vendor->vendor ?? '-'); ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Police Number</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->police_number ?: '-'); ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Driver Name</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->driver_name ?: '-'); ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">SO Number</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->so_number ?: '-'); ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Invoice Number</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->invoice_number ?: '-'); ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">PO Number</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->po_number ?: '-'); ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">FOB</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($transaction->fob ?: '-'); ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small">Keterangan / Description</label>
                                <div class="p-3 bg-light rounded-3 min-vh-10">
                                    <?php echo e($transaction->description ?: 'Tidak ada keterangan.'); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attachment Section -->
                    <div class="form-section border-0">
                        <div class="section-header d-flex align-items-center">
                            <i class="ti ti-paperclip me-2 text-primary"></i>
                            <h5 class="mb-0">Attachment / Dokumen Pendukung</h5>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($transaction->filename): ?>
                        <?php
                        $filePath = asset('assets/attachmenttransaction/' . $transaction->filename);
                        $extension = pathinfo($transaction->filename, PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        ?>

                        <div class="attachment-preview mt-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isImage): ?>
                            <div class="text-center">
                                <img src="<?php echo e($filePath); ?>" class="img-fluid rounded-3 shadow-sm border" style="max-height: 500px;">
                                <div class="mt-3">
                                    <a href="<?php echo e($filePath); ?>" target="_blank" class="btn btn-primary rounded-pill px-4">
                                        <i class="ti ti-external-link me-1"></i> View
                                    </a>
                                </div>
                            </div>
                            <?php elseif(strtolower($extension) === 'pdf'): ?>
                            <div class="pdf-preview mt-3">
                                <div class="ratio ratio-16x9 mb-3" style="min-height: 600px;">
                                    <iframe src="<?php echo e($filePath); ?>" class="rounded-3 border shadow-sm"></iframe>
                                </div>
                                <div class="text-center">
                                    <a href="<?php echo e($filePath); ?>" target="_blank" class="btn btn-primary rounded-pill px-4">
                                        <i class="ti ti-external-link me-1"></i> View
                                    </a>
                                    <a href="<?php echo e($filePath); ?>" download class="btn btn-outline-primary rounded-pill px-4 ms-2">
                                        <i class="ti ti-download me-1"></i> Download PDF
                                    </a>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="card border shadow-none bg-light-subtle rounded-3 p-4 text-center">
                                <i class="ti ti-file-text fs-1 text-primary mb-3"></i>
                                <h6 class="fw-bold mb-2"><?php echo e($transaction->filename); ?></h6>
                                <div class="d-flex justify-content-center gap-2 mt-2">
                                    <a href="<?php echo e($filePath); ?>" target="_blank" class="btn btn-primary rounded-pill px-4">
                                        <i class="ti ti-eye me-1"></i> Buka Dokumen
                                    </a>
                                    <a href="<?php echo e($filePath); ?>" download class="btn btn-outline-primary rounded-pill px-4">
                                        <i class="ti ti-download me-1"></i> Download
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php elseif(isset($relatedProduction) && $relatedProduction->attachments->count() > 0): ?>
                            <div class="row g-3 mt-3">
                                <div class="col-12 mb-1">
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Diambil dari Ref. Dokumen Production</span>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $relatedProduction->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <?php
                                        $filePath = asset('assets/attachmentproduction/' . $file->filename);
                                    ?>
                                    <div class="col-md-3">
                                        <div class="card border shadow-sm bg-light-subtle rounded-3 p-3 text-center h-100">
                                            <i class="ti ti-file-text fs-2 text-primary mb-2"></i>
                                            <h6 class="fw-bold mb-1 small text-truncate" title="<?php echo e($file->filename); ?>"><?php echo e($file->filename); ?></h6>
                                            <div class="mt-auto pt-2">
                                                <a href="<?php echo e($filePath); ?>" target="_blank" class="btn btn-sm btn-primary rounded-pill w-100 btn-hover-effect">
                                                    <i class="ti ti-external-link me-1"></i> Buka
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php else: ?>
                        <div class="text-center py-4 bg-light-subtle rounded-3 mb-3 border border-dashed opacity-75">
                            <i class="ti ti-info-circle fs-3 text-muted mb-2"></i>
                            <p class="text-muted small mb-0">Tidak ada lampiran dokumen.</p>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views/livewire/item-transactions/show.blade.php ENDPATH**/ ?>