<div>
    <style>
        .invoice-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .invoice-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .form-section {
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .invoice-info-card {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
        }

        .modern-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .modern-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            padding: 15px 12px;
            text-align: left;
            border-bottom: 2px solid #e9ecef;
        }

        .modern-table td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
        }

        .modern-table tr:hover {
            background-color: #f8f9fa;
        }

        .invoice-summary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .signature-section {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .attachment-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
    </style>

    <?php
    $symbol = $pr->currency->symbol ?? 'Rp';
    $discount = floatval($pr->additional_discount ?? 0);
    $grandTotal = $details->sum('ammount') - $discount;

    $norekVendor = $pr->norek_vendor;
    $bankName = $invoice ? ($invoice->nama_bank ?: ($norekVendor?->nama_bank ?? '-')) : ($norekVendor?->nama_bank ?? '-');
    $bankAccount = $invoice ? ($invoice->norek ?: ($norekVendor?->norek ?? '-')) : ($norekVendor?->norek ?? '-');
    $bankHolder = $invoice ? ($invoice->nama_penerima ?: ($norekVendor?->nama_penerima ?? '-')) : ($norekVendor?->nama_penerima ?? '-');

    // Handle case where old system saved the entire bank JSON object into the norek column
    if (is_string($bankAccount) && str_starts_with(trim($bankAccount), '{')) {
    $parsed = json_decode($bankAccount, true);
    if (is_array($parsed)) {
    $bankAccount = $parsed['norek'] ?? ($norekVendor?->norek ?? '-');
    if ($bankName === '-' || empty($bankName)) $bankName = $parsed['nama_bank'] ?? '-';
    if ($bankHolder === '-' || empty($bankHolder)) $bankHolder = $parsed['nama_penerima'] ?? '-';
    }
    }
    ?>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="invoice-card card">
                <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.25rem 1.5rem; border: none;">
                    <h4 class="mb-0 text-white"><i class="fas fa-file-invoice me-2"></i>INVOICE DETAILS</h4>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('payment-requests.show', $prHash)); ?>" class="btn btn-outline-light btn-sm text-white border-white">
                            <i class="fas fa-arrow-left me-1"></i> Back to PR
                        </a>
                    </div>
                </div>
                <div class="card-body" style="padding: 2rem;">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$invoice): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-file-invoice fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Invoice belum dibuat untuk PR ini.</h4>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCreate): ?>
                        <button class="btn btn-primary mt-3 px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalCreateInvoice">
                            <i class="fas fa-plus me-1"></i> Buat Invoice
                        </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php else: ?>

                    <div class="invoice-summary mb-4">
                        <!-- <h5 class="text-white opacity-75 mb-2">CURRENT INVOICE</h5> -->
                        <p class="fs-4 fw-bold mb-1"><i class="fas fa-file-invoice-dollar me-2" style="font-size:1.5rem"></i><?php echo e($invoice->invoice_number); ?></p>
                        <small>Date: <?php echo e($invoice->invoice_date ? $invoice->invoice_date->format('d M Y') : '-'); ?> | Delivery: <?php echo e($invoice->delivery_date ? $invoice->delivery_date->format('d M Y') : '-'); ?></small>
                    </div>

                    <div class="form-section mb-4 pb-3">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-info-circle text-primary fs-4 me-2"></i>
                            <h5 class="mb-0 fw-bold border-0">Invoice Information</h5>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="text-muted fw-semibold" style="font-size:0.85rem">TO</div>
                                    <div class="fw-bold fs-6"><?php echo e($pr->company->company ?? '-'); ?></div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted fw-semibold" style="font-size:0.85rem">TRUCK</div>
                                    <div class="fw-bold fs-6"><?php echo e($invoice->truck ?: '-'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="text-muted fw-semibold" style="font-size:0.85rem">INVOICE DATE</div>
                                    <div class="fw-bold fs-6"><?php echo e($invoice->invoice_date ? $invoice->invoice_date->format('d M Y') : '-'); ?></div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted fw-semibold" style="font-size:0.85rem">INVOICE NUMBER</div>
                                    <div class="fw-bold fs-6"><?php echo e($invoice->invoice_number); ?></div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-muted fw-semibold" style="font-size:0.85rem">DELIVERY DATE</div>
                                    <div class="fw-bold fs-6"><?php echo e($invoice->delivery_date ? $invoice->delivery_date->format('d M Y') : '-'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section mb-4 pb-3">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-table text-success fs-4 me-2"></i>
                            <h5 class="mb-0 fw-bold border-0">Invoice Items</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="modern-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 25%">DESCRIPTION</th>
                                        <th class="text-center" style="width: 5%">QTY</th>
                                        <th class="text-center" style="width: 5%">UOM</th>
                                        <th class="text-end" style="width: 12%">UNIT PRICE</th>
                                        <th class="text-end" style="width: 10%">DISCOUNT</th>
                                        <th class="text-end" style="width: 10%">VAT</th>
                                        <th class="text-end" style="width: 10%">PPH</th>
                                        <th class="text-end" style="width: 18%">AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <tr>
                                        <td><?php echo e($i + 1); ?></td>
                                        <td class="text-wrap" style="max-width:300px"><?php echo e($item->detail); ?></td>
                                        <td class="text-center"><?php echo e(number_format($item->qty, 2, ',', '.')); ?></td>
                                        <td class="text-center"><?php echo e($item->uom->uom ?? '-'); ?></td>
                                        <td class="text-end"><?php echo e($symbol); ?> <?php echo e(number_format($item->price, 2, ',', '.')); ?></td>
                                        <td class="text-end"><?php echo e($symbol); ?> <?php echo e(number_format($item->discount, 2, ',', '.')); ?></td>
                                        <td class="text-end"><?php echo e($symbol); ?> <?php echo e(number_format($item->tax1, 2, ',', '.')); ?></td>
                                        <td class="text-end"><?php echo e($symbol); ?> <?php echo e(number_format($item->tax2, 2, ',', '.')); ?></td>
                                        <td class="fw-bold text-end"><?php echo e($symbol); ?> <?php echo e(number_format($item->ammount, 2, ',', '.')); ?></td>
                                    </tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="8" class="text-end" style="background-color: #e8f5e8;">ADDITIONAL DISCOUNT</th>
                                        <th class="text-end bg-light"><?php echo e($symbol); ?> <?php echo e(number_format($discount, 2, ',', '.')); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="8" class="text-end" style="background-color: #e8f5e8;">TOTAL PAYMENT</th>
                                        <th class="text-end fw-bold text-primary bg-light fs-6"><?php echo e($symbol); ?> <?php echo e(number_format($grandTotal, 2, ',', '.')); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="form-section mb-4 pb-3">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-university text-warning fs-4 me-2"></i>
                            <h5 class="mb-0 fw-bold border-0">Bank Information</h5>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="text-muted fw-semibold" style="font-size:0.85rem">BANK NAME</div>
                                <div class="fw-bold fs-6"><?php echo e($bankName); ?></div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted fw-semibold" style="font-size:0.85rem">ACCOUNT NAME</div>
                                <div class="fw-bold fs-6"><?php echo e($bankHolder); ?></div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted fw-semibold" style="font-size:0.85rem">ACCOUNT NUMBER</div>
                                <div class="fw-bold fs-6"><?php echo e($bankAccount); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="signature-section border-0 p-0 m-0">
                        <div class="row text-center mt-4">
                            <div class="col-md-6 mb-4">
                                <div class="fw-bold mb-5 pb-3">VERIFIED BY :</div>
                                <div class="border-bottom mx-auto" style="width: 200px; border-color: #000 !important;"></div>
                                <div class="fw-bold mt-2">NAME :</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="fw-bold mb-5 pb-3"><?php echo e($pr->vendor->vendor ?? 'VENDOR'); ?></div>
                                <div class="border-bottom mx-auto" style="width: 200px; border-color: #000 !important;"></div>
                                <div class="fw-bold mt-2">NAME :</div>
                            </div>
                        </div>
                    </div>

                    <div class="attachment-section border-top pt-4 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0 fw-bold d-flex align-items-center"><i class="fas fa-paperclip text-info me-2 fs-4"></i> DOCUMENT ATTACHMENTS</h5>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($invoice->file_name) && $canUploadAttachment): ?>
                            <button class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#modalAddAttInvoice">
                                <i class="fas fa-plus me-1"></i> ADD
                            </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($invoice->file_name)): ?>
                                <?php
                                $ext = Str::lower(pathinfo($invoice->file_name, PATHINFO_EXTENSION));
                                $isPdf = $ext === 'pdf';
                                ?>
                                <div class="attachment-item shadow-sm border">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPdf): ?>
                                    <i class="fas fa-file-pdf fa-2x text-danger attachment-icon"></i>
                                    <?php else: ?>
                                    <i class="fas fa-image fa-2x text-primary attachment-icon"></i>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="flex-grow-1 ms-3">
                                        <a href="#" onclick="openInvoicePreview('<?php echo e(asset('assets/invoice/' . $invoice->file_name)); ?>'); return false;" class="text-decoration-none fw-bold fs-6 text-dark" style="transition:all 0.2s;">
                                            <?php echo e($invoice->invoice_number ?: '-'); ?>

                                        </a>
                                        <div class="text-muted" style="font-size:0.875rem"><?php echo e(Str::upper($ext)); ?> Document</div>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canUploadAttachment): ?>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditAttInvoice">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <?php else: ?>
                                <div class="text-center text-muted py-4 rounded" style="background:#f8f9fa; border:2px dashed #dee2e6;">
                                    <i class="fas fa-file-invoice fa-3x mb-3 opacity-50"></i>
                                    <p class="mb-0">No attachments uploaded</p>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-4 border-top">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEdit): ?>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditInvoice">
                            <i class="fas fa-edit me-1"></i> Edit Invoice
                        </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canDelete): ?>
                        <button type="button" class="btn btn-danger" onclick="showConfirm({
                            title: 'Hapus Invoice',
                            message: 'Apakah Anda yakin ingin menghapus invoice ini? Data yang dihapus tidak dapat dikembalikan.',
                            type: 'danger',
                            btnText: 'Ya, Hapus',
                            onConfirm: () => {
                                window.location.href = '<?php echo e(route('payment-requests.invoice.delete', hashid_encode($invoice->id_invoice, 'invoice'))); ?>';
                            }
                        })">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canPrint): ?>
                        <button id="btnPrintInvoice" onclick="silentAction('<?php echo e(route('payment-requests.invoice.print', $prHash)); ?>', 'print', this)" class="btn btn-info text-white">
                            <i class="fas fa-print me-1"></i> Print
                        </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canDownload): ?>
                        <button id="btnDownloadInvoice" onclick="silentAction('<?php echo e(route('payment-requests.invoice.print', $prHash)); ?>', 'download', this)" class="btn btn-success">
                            <i class="fas fa-file-pdf me-1"></i> Download PDF
                        </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    
                    <iframe id="silentIframe" style="position:fixed; top:-9999px; left:-9999px; width:1400px; height:auto; border:none;"></iframe>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$invoice && $canCreate): ?>
    <div class="modal fade" id="modalCreateInvoice" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('payment-requests.invoice.store', $prHash)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header" style="background: linear-gradient(135deg,#667eea,#764ba2); color:#fff;">
                        <h5 class="modal-title"><i class="fas fa-file-invoice me-2"></i> Buat Invoice</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert mb-3" style="background:#eef2ff; border-left:4px solid #667eea; border-radius:0;">
                            <small class="text-muted d-block">PR Number</small>
                            <strong><?php echo e($pr->pr_number); ?></strong>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Truck <span class="text-muted fw-normal">(opsional)</span></label>
                            <input type="text" name="truck" class="form-control" autocomplete="off" placeholder="Nomor truck...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Invoice Date <span class="text-danger">*</span></label>
                            <input type="date" name="invoice_date" class="form-control" required value="<?php echo e(date('Y-m-d')); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Delivery Date <span class="text-muted fw-normal">(opsional)</span></label>
                            <input type="date" name="delivery_date" class="form-control">
                        </div>
                        <div class="alert alert-warning mb-0 p-3 mt-4" style="border-radius:8px;">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" name="update_pr_no_invoice" value="1" id="checkUpdatePrInvoice">
                                <label class="form-check-label fw-semibold" for="checkUpdatePrInvoice">Update Invoice Number pada PR</label>
                            </div>
                            <small class="text-danger d-block mt-1">Jika dicentang, nomor invoice akan diperbarui permanen.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($invoice): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEdit): ?>
    <div class="modal fade" id="modalEditInvoice" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('payment-requests.invoice.update', hashid_encode($invoice->id_invoice, 'invoice'))); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header" style="background: linear-gradient(135deg,#667eea,#764ba2); color:#fff;">
                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Edit Invoice</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Truck</label>
                            <input type="text" name="truck" class="form-control" value="<?php echo e($invoice->truck); ?>" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Invoice Date</label>
                            <input type="date" name="invoice_date" class="form-control" required value="<?php echo e($invoice->invoice_date?->format('Y-m-d')); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Delivery Date</label>
                            <input type="date" name="delivery_date" class="form-control" value="<?php echo e($invoice->delivery_date?->format('Y-m-d')); ?>">
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr->no_invoice != $invoice->invoice_number): ?>
                        <div class="alert alert-warning mb-0 p-3 mt-4" style="border-radius:8px;">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" name="update_pr_no_invoice" value="1" id="checkUpdatePrInvoiceEdit">
                                <label class="form-check-label fw-semibold" for="checkUpdatePrInvoiceEdit">Update Invoice Number pada PR</label>
                            </div>
                            <small class="text-danger d-block mt-1">Jika dicentang, nomor invoice PR (<?php echo e($pr->no_invoice ?: '-'); ?>) akan diperbarui menjadi <?php echo e($invoice->invoice_number); ?>.</small>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning text-dark fw-bold"><i class="fas fa-save me-1"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canUploadAttachment): ?>
    <div class="modal fade" id="modalAddAttInvoice" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form id="formAddAttInvoice" method="POST" action="<?php echo e(route('payment-requests.invoice.attachment.store', hashid_encode($invoice->id_invoice, 'invoice'))); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add Invoice Verification</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">File (Image/PDF)</label>
                            <input type="file" name="file_name" class="form-control" accept="image/*,application/pdf" required>
                            <div class="form-text">Upload invoice verification document (PDF, JPG, PNG) max 5MB.</div>
                        </div>
                    </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="btnUploadAddAtt" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEditAttInvoice" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form id="formEditAttInvoice" method="POST" action="<?php echo e(route('payment-requests.invoice.attachment.update', hashid_encode($invoice->id_invoice, 'invoice'))); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">Edit Invoice Verification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Replace File (optional)</label>
                            <input type="file" name="file_name" class="form-control" accept="image/*,application/pdf" required>
                            <div class="form-text">Upload new file to replace existing document</div>
                        </div>
                    </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="btnUploadEditAtt" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($invoice->file_name): ?>
    <div class="modal fade" id="modalPreviewInvoice" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Document Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div id="invoicePreviewBody" style="min-height:60vh; background:#f8f9fa;"></div>
                </div>
                <div class="modal-footer">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canUploadAttachment): ?>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditAttInvoice">
                        <i class="fas fa-edit me-1"></i> Edit
                    </button>
                    <button type="button" class="btn btn-danger" onclick="showConfirm({
                        title: 'Hapus Attachment',
                        message: 'Apakah Anda yakin ingin menghapus attachment ini?',
                        type: 'danger',
                        btnText: 'Ya, Hapus',
                        onConfirm: () => {
                            window.location.href = '<?php echo e(route('payment-requests.invoice.attachment.delete', hashid_encode($invoice->id_invoice, 'invoice'))); ?>';
                        }
                    })">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <a id="btnDownloadPreview" href="<?php echo e(asset('assets/invoice/' . $invoice->file_name)); ?>" class="btn btn-success" download>
                        <i class="fas fa-download me-1"></i> Download
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <script>
        function openInvoicePreview(url) {
            const body = document.getElementById('invoicePreviewBody');
            if (!body) return;
            const ext = url.split('?')[0].split('.').pop().toLowerCase();

            if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'].includes(ext)) {
                body.innerHTML = '<' + 'div class="d-flex justify-content-center align-items-center p-3" style="min-height:60vh"><' + 'img src="' + url + '" style="max-width:100%;max-height:80vh;object-fit:contain;" class="img-fluid rounded shadow-sm"><' + '/div>';
            } else if (ext === 'pdf') {
                body.innerHTML = '<' + 'iframe src="' + url + '" width="100%" style="height:80vh;border:none;display:block;"><' + '/iframe>';
            } else {
                body.innerHTML = '<' + 'div class="text-center py-5 text-muted"><' + 'i class="fas fa-file fs-1 d-block mb-3"><' + '/i>Preview tidak tersedia. <' + 'a href="' + url + '" target="_blank">Buka file<' + '/a><' + '/div>';
            }

            const modal = new bootstrap.Modal(document.getElementById('modalPreviewInvoice'));
            modal.show();
        }

        function silentAction(url, action, btn) {
            const iframe = document.getElementById('silentIframe');
            const targetUrl = url + (url.includes('?') ? '&' : '?') + 'action=' + action;

            // Save original state
            const originalContent = btn.innerHTML;
            btn.setAttribute('data-original-content', originalContent);
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Loading...';

            iframe.src = targetUrl;

            // Simple timeout fallback to reset if message is lost or print dialog stays open
            setTimeout(() => {
                if (btn.disabled) {
                    resetBtn(btn);
                }
            }, 10000); // 10 seconds fallback
        }

        function resetBtn(btn) {
            if (!btn) return;
            const original = btn.getAttribute('data-original-content');
            if (original) {
                btn.innerHTML = original;
            }
            btn.disabled = false;
        }

        // Listen for done message from iframe
        window.addEventListener('message', function(event) {
            if (event.data && event.data.action === 'done') {
                resetBtn(document.getElementById('btnPrintInvoice'));
                resetBtn(document.getElementById('btnDownloadInvoice'));
            }
        });

        // File validation & loading states
        const validateFile = (files) => {
            const maxSize = 5 * 1024 * 1024; // 5MB
            const allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const extension = file.name.split('.').pop().toLowerCase();

                if (file.size > maxSize) {
                    return { valid: false, message: 'Ukuran maksimal file adalah 5MB.' };
                }
                if (!allowedExtensions.includes(extension)) {
                    return { valid: false, message: 'Hanya file JPG, JPEG, PNG, dan PDF yang diperbolehkan.' };
                }
            }
            return { valid: true };
        };

        const setBtnLoadingAtt = (btn) => {
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Please wait...';
        };

        document.addEventListener('submit', function(e) {
            if (e.target.id === 'formAddAttInvoice' || e.target.id === 'formEditAttInvoice') {
                const form = e.target;
                const fileInput = form.querySelector('input[type="file"]');
                const submitBtn = document.getElementById(form.id === 'formAddAttInvoice' ? 'btnUploadAddAtt' : 'btnUploadEditAtt');

                if (fileInput && fileInput.files.length > 0) {
                    const validation = validateFile(fileInput.files);
                    if (!validation.valid) {
                        e.preventDefault();
                        window.dispatchEvent(new CustomEvent('alert', {
                            detail: {
                                type: 'warning',
                                title: 'Validation Error',
                                message: validation.message
                            }
                        }));
                        return;
                    }
                }

                if (submitBtn) setBtnLoadingAtt(submitBtn);
            }
        });
    </script>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views/livewire/payment-requests/invoice-show.blade.php ENDPATH**/ ?>