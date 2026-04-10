<div class="payment-show user-show">
    <?php
    $user = auth()->user();
    $isAdmin = $user->level === 1;
    $isCreator = $user->id_user == $pr->id_user;
    $prHash = hashid_encode($pr->id_pr, 'pr');
    $symbol = $pr->currency->symbol ?? 'Rp';
    $statusVal = intval($pr->status ?? 0);

    $statusConfig = [
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
    $statusLabel = $statusConfig[$statusVal]['label'] ?? 'Unknown';
    $statusColor = $statusConfig[$statusVal]['color'] ?? 'dark';

    $canPayment = $isAdmin || $user->hasPermission('pr_payment.create') || ($pr->payment_type_pr == 1 && $isCreator);
    $hasRevision = $payments->whereNotNull('reason')->where('reason', '!=', '')->isNotEmpty();
    $canAddPayment = $canPayment && in_array($statusVal, [7, 8]) && (!$hasRevision || $pr->payment_type_pr != 1);
    ?>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card edit-card">

                
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h4 class="mb-0"><i class="ti ti-wallet me-2"></i>PAYMENT DETAILS</h4>
                    <div class="d-flex flex-wrap gap-2 align-items-center">
                        <?php
                        $lastPaymentForHeader = $payments->last();
                        $canApproveP1 = $this->canApproveStep1();
                        $canCancelP1 = $this->canCancelApproveStep1();
                        $canApproveP2 = $this->canApprovePaymentDirector();
                        $canCancelP2 = $this->canCancelApprovePaymentDirector();
                        $canRevise = $this->canRevision();
                        $canPrint = $isAdmin || $isCreator || $user->hasPermission('pr_payment.print');
                        $canDownload = $isAdmin || $isCreator || $user->hasPermission('pr_payment.download');
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr->payment_type_pr == 1): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canApproveP1): ?>
                        <button class="btn btn-success btn-sm fw-bold" onclick="showConfirm({
                            title: 'Approve tahapan Manager?',
                            type: 'success',
                            btnText: 'Ya, Approve',
                            onConfirm: () => { submitPost('<?php echo e(route('payment-requests.payment.approve.step1', $prHash)); ?>'); }
                        })">
                            <i class="ti ti-check"></i> Approve Manager
                        </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCancelP1): ?>
                        <button class="btn btn-danger btn-sm fw-bold" onclick="showConfirm({
                            title: 'Batalkan approval Manager?',
                            type: 'warning',
                            btnText: 'Ya, Batalkan',
                            onConfirm: () => { submitPost('<?php echo e(route('payment-requests.payment.cancel-approve.step1', $prHash)); ?>'); }
                        })">
                            <i class="ti ti-rotate"></i> Cancel Manager
                        </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canApproveP2): ?>
                        <button class="btn btn-success btn-sm fw-bold" onclick="showConfirm({
                            title: 'Approve tahapan Director?',
                            type: 'success',
                            btnText: 'Ya, Approve',
                            onConfirm: () => { submitPost('<?php echo e(route('payment-requests.payment.approve-director', $prHash)); ?>'); }
                        })">
                            <i class="ti ti-check"></i> Approve DIR
                        </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCancelP2): ?>
                        <button class="btn btn-warning btn-sm fw-bold" onclick="showConfirm({
                            title: 'Batalkan approval Director?',
                            type: 'warning',
                            btnText: 'Ya, Batalkan',
                            onConfirm: () => { submitPost('<?php echo e(route('payment-requests.payment.cancel-approve-director', $prHash)); ?>'); }
                        })">
                            <i class="ti ti-rotate"></i> Cancel DIR
                        </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canRevise): ?>
                        <button class="btn btn-warning btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modalRevision">
                            <i class="ti ti-rotate"></i> Revision
                        </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payments->count() > 0 && $lastPaymentForHeader): ?>
                        <?php $lastPayHash = hashid_encode($lastPaymentForHeader->id_payment, 'payment'); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canPrint): ?>
                        <a href="<?php echo e(route('payment-requests.payment.print', $lastPayHash)); ?>" target="_blank" class="btn btn-light btn-sm text-primary fw-bold">
                            <i class="ti ti-printer"></i> Print
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canDownload): ?>
                        <a href="<?php echo e(route('payment-requests.payment.download', $lastPayHash)); ?>" target="_blank" class="btn btn-light btn-sm text-primary fw-bold">
                            <i class="ti ti-download"></i> Download
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr->invoices->count() > 0): ?>
                        <a href="<?php echo e(route('payment-requests.invoice', $prHash)); ?>" class="btn btn-info btn-sm">
                            <i class="ti ti-file-invoice"></i> INVOICE
                        </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <a href="<?php echo e(route('payment-requests.show', $prHash)); ?>" class="btn btn-outline-light btn-sm text-white border-white">
                            <i class="ti ti-arrow-left me-1"></i> Detail PR
                        </a>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">

                    
                    <div class="user-profile-header mb-4">
                        <div class="position-relative z-1">
                            <h6 class="text-white-50 mb-1 small fw-bold" style="letter-spacing: 2px;">PR NUMBER</h6>
                            <h2 class="mb-1 fw-bold text-white"><?php echo e($pr->pr_number); ?></h2>
                            <p class="mb-4 small opacity-75"><?php echo e($pr->subject); ?> &bull; <?php echo e($pr->vendor->vendor ?? '-'); ?></p>

                            <div class="mb-4">
                                <span class="badge-modern-status bg-<?php echo e($statusColor); ?>"><?php echo e($statusLabel); ?></span>
                            </div>

                            <div class="row g-3 justify-content-center">
                                <div class="col-md-3 col-6">
                                    <div class="glass-stat-card">
                                        <div class="amount-label text-white-50">Amount Due</div>
                                        <div class="amount-value text-white"><?php echo e($symbol); ?> <?php echo e(number_format($grandTotal, 2, ',', '.')); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="glass-stat-card">
                                        <div class="amount-label text-white-50">Total Paid</div>
                                        <div class="amount-value text-white"><?php echo e($symbol); ?> <?php echo e(number_format($totalPaid, 2, ',', '.')); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="glass-stat-card">
                                        <div class="amount-label text-white-50">Balance</div>
                                        <div class="amount-value <?php echo e(($grandTotal - $totalPaid) > 0 ? 'text-warning' : 'text-success'); ?>">
                                            <?php echo e($symbol); ?> <?php echo e(number_format($grandTotal - $totalPaid, 2, ',', '.')); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-section">
                        <div class="section-header d-flex align-items-center">
                            <i class="ti ti-file-description me-2 text-primary"></i>
                            <h5 class="mb-0">PR Information</h5>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small">No. Invoice</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($pr->no_invoice ?: '-'); ?>" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Departemen / Cabang</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($pr->departement->departement ?? '-'); ?> / <?php echo e($pr->branch->branch ?? '-'); ?>" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Metode & Tipe Payment</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($pr->payment_method == 1 ? 'Transfer' : 'Cash'); ?> — <?php echo e($pr->payment_type_pr == 1 ? 'Butuh Approval' : 'Langsung'); ?>" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Bank Default</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($pr->nama_bank ?: ($pr->norek_vendor->nama_bank ?? '-')); ?>" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Atas Nama Default</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($pr->nama_penerima ?: ($pr->norek_vendor->nama_penerima ?? '-')); ?>" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">No. Rekening Default</label>
                                <input type="text" class="form-control bg-light" value="<?php echo e($pr->norek ?: ($pr->norek_vendor->norek ?? '-')); ?>" readonly>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-section border-0">
                        <div class="section-header d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="ti ti-credit-card me-2 text-primary"></i>
                                <h5 class="mb-0">Payment Records</h5>
                                <span class="badge bg-secondary ms-2"><?php echo e($payments->count()); ?> payment</span>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canAddPayment): ?>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPayment">
                                <i class="ti ti-plus"></i> ADD PAYMENT
                            </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr->payment_type_pr == 1 && $statusVal == 14): ?>
                        <div class="alert alert-warning mb-3">
                            <i class="ti ti-clock me-1"></i>
                            <strong>Menunggu Approval Director.</strong> Attachment belum dapat diupload hingga Director menyetujui payment.
                        </div>
                        <?php elseif($pr->payment_type_pr == 1 && $statusVal == 15): ?>
                        <div class="alert alert-info mb-3">
                            <i class="ti ti-clock me-1"></i>
                            <strong>Menunggu Approval Manager.</strong> Payment dapat diedit/dihapus selama belum disetujui Manager.
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php $lastPaymentId = $payments->last()?->id_payment; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php
                        $payHash = hashid_encode($payment->id_payment, 'payment');
                        $atts = $payment->attachments ?? collect();
                        $isLastPayment = $payment->id_payment == $lastPaymentId;

                        // === canEditDelete logic (mirror sistem lama + status 15) ===
                        if ($pr->payment_type_pr == 1) {
                        $canEditDelete = ($isAdmin || $user->id_user == $payment->id_user)
                        && ($statusVal === 15 || !empty($payment->reason))
                        && $isLastPayment;
                        } else {
                        $canEditDelete = ($isAdmin || $user->id_user == $payment->id_user)
                        && in_array($statusVal, [8, 9, 10])
                        && $isLastPayment;
                        }
                        if ($statusVal == 11) $canEditDelete = false;

                        $canAddAtt = $this->canAddAttachment($payment->payment_type)
                        && $isLastPayment
                        && ($isAdmin || $user->hasPermission('pr_payment.create') || $isCreator || auth()->id_user() == $payment->id_user);

                        // Signature states
                        $hasManagerSign = str_contains($payment->filename ?? '', 'approved_manager')
                        || str_contains($payment->filename ?? '', 'approved_director');
                        $hasDirectorSign = str_contains($payment->filename ?? '', 'approved_director');
                        $isAutoApproved = $payment->filename === 'approved_by_system';
                        ?>

                        <div class="card mb-3 border shadow-sm">
                            
                            <div class="card-header d-flex justify-content-between align-items-start flex-wrap gap-2 bg-light">
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <span class="fw-bold text-muted">#<?php echo e($i + 1); ?></span>
                                    <span class="fw-bold text-muted"><?php echo e($payment->user->name); ?></span>
                                    <span class="badge bg-<?php echo e($payment->payment_type == 1 ? 'info' : 'primary'); ?>">
                                        <?php echo e($payment->payment_type == 1 ? 'Parsial' : 'Full'); ?>

                                    </span>
                                    <span class="badge bg-<?php echo e($payment->status == 2 ? 'success' : 'warning'); ?>">
                                        <?php echo e($payment->status == 2 ? 'Paid' : 'Pending'); ?>

                                    </span>
                                    <strong class="text-dark fs-6"><?php echo e($symbol); ?> <?php echo e(number_format($payment->grand_total ?? 0, 2, ',', '.')); ?></strong>
                                    <span class="text-muted small"><?php echo e($payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') : '-'); ?></span>
                                </div>
                                <div class="d-flex gap-2 flex-wrap">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canAddAtt): ?>
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalAddAtt<?php echo e($payment->id_payment); ?>" title="Upload Bukti Transfer">
                                        <i class="ti ti-upload"></i> Upload Bukti
                                    </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEditDelete): ?>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#modalEditPayment<?php echo e($payment->id_payment); ?>" title="Edit Payment">
                                        <i class="ti ti-edit"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" title="Delete Payment"
                                        onclick="window.showConfirm({title: 'Hapus Payment', message: 'Hapus payment ini?', type: 'danger', btnText: 'Ya, Lanjutkan!', onConfirm: () => window.location.href='<?php echo e(route('payment-requests.payment.delete', $payHash)); ?>'})">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="card-body pb-2">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label small">Nama Bank</label>
                                        <div class="fw-bold"><?php echo e($payment->nama_bank ?: ($pr->norek_vendor->nama_bank ?? '-')); ?></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small">Atas Nama</label>
                                        <div class="fw-bold"><?php echo e($payment->nama_penerima ?: ($pr->norek_vendor->nama_penerima ?? '-')); ?></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small">No. Rekening</label>
                                        <div class="fw-bold"><?php echo e($payment->norek ?: ($pr->norek_vendor->norek ?? '-')); ?></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label small">Amount / Additional</label>
                                        <div><span class="fw-bold"><?php echo e($symbol); ?> <?php echo e(number_format($payment->ammount, 2, ',', '.')); ?></span>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->additional): ?>
                                            <span class="text-muted"> + <?php echo e($symbol); ?> <?php echo e(number_format($payment->additional, 2, ',', '.')); ?></span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->payment_description): ?>
                                    <div class="col-12">
                                        <label class="form-label small">Keterangan</label>
                                        <div class="p-2 bg-light rounded small"><?php echo e($payment->payment_description); ?></div>
                                    </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment->reason): ?>
                                    <div class="col-12">
                                        <label class="form-label small text-danger">Catatan Revisi</label>
                                        <div class="p-2 bg-danger bg-opacity-10 rounded small text-danger"><?php echo e($payment->reason); ?></div>
                                    </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="card-footer bg-white border-top">
                                <div class="row g-3 align-items-start">
                                    <?php
                                    $hasDirectorSign = str_contains($payment->filename ?? '', 'approved_director');
                                    $hasManagerSign = str_contains($payment->filename ?? '', 'approved_manager') || $hasDirectorSign;
                                    $isAutoApproved = ($payment->filename == 'approved_by_system') || ($pr->payment_type_pr == 2);
                                    $isOldFile = !empty($payment->filename) && !$hasManagerSign && !$hasDirectorSign && !$isAutoApproved;
                                    ?>

                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr->payment_type_pr == 1): ?>
                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <div class="small fw-bold text-muted mb-2" style="font-size:0.7rem; text-transform:uppercase;">Manager Sign</div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasManagerSign): ?>
                                            <img src="data:image/svg+xml;base64,<?php echo e(base64_encode(generateQrSvg('Approved by Manager: ' . $pr->pr_number . ' - ' . \Carbon\Carbon::parse($payment->updated_at)->format('Y-m-d H:i'), 80, 0))); ?>"
                                                class="d-block mx-auto mb-1" style="max-height:70px;" alt="MGR QR">
                                            <span class="badge bg-success">APPROVED</span>
                                            <?php else: ?>
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto" style="width:80px;height:70px;">
                                                <span class="text-muted small fst-italic">Pending</span>
                                            </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <div class="col-md-3">
                                        <div class="text-center">
                                            <div class="small fw-bold text-muted mb-2" style="font-size:0.7rem; text-transform:uppercase;">Director / Auto Sign</div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAutoApproved): ?>
                                            <img src="data:image/svg+xml;base64,<?php echo e(base64_encode(generateQrSvg('Auto Approved: ' . $pr->pr_number, 80, 0))); ?>"
                                                class="d-block mx-auto mb-1" style="max-height:70px;" alt="AUTO QR">
                                            <?php elseif($hasDirectorSign): ?>
                                            <img src="data:image/svg+xml;base64,<?php echo e(base64_encode(generateQrSvg('Approved by Director: ' . $pr->pr_number . ' - ' . \Carbon\Carbon::parse($payment->updated_at)->format('Y-m-d H:i'), 80, 0))); ?>"
                                                class="d-block mx-auto mb-1" style="max-height:70px;" alt="DIR QR">
                                            <span class="badge bg-success">APPROVED</span>
                                            <?php elseif($isOldFile): ?>
                                            <img src="data:image/svg+xml;base64,<?php echo e(base64_encode(generateQrSvg('Approved [Migrated]: ' . $pr->pr_number . ' - Pay ID: ' . $payment->id_payment, 80, 0))); ?>"
                                                class="d-block mx-auto mb-1" style="max-height:70px;" alt="OLD QR">
                                            <span class="badge bg-success">APPROVED</span>
                                            <?php else: ?>
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto" style="width:80px;height:70px;">
                                                <span class="text-muted small fst-italic">Pending</span>
                                            </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>

                                    
                                    <div class="col">
                                        <div class="small fw-bold text-muted mb-2" style="font-size:0.7rem; text-transform:uppercase;">Bukti Transfer</div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($atts->count() > 0): ?>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $atts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                            <?php
                                            $attExt = strtolower(pathinfo($att->filename, PATHINFO_EXTENSION));
                                            $attUrl = asset('assets/attachmentpayment/' . $att->filename);
                                            $isImg = in_array($attExt, ['jpg','jpeg','png']);
                                            $attHash = hashid_encode($att->id_attachment_payment, 'attachmentpay');
                                            ?>
                                            <div class="d-flex flex-column align-items-center gap-1">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isImg): ?>
                                                <a href="<?php echo e($attUrl); ?>" target="_blank">
                                                    <img src="<?php echo e($attUrl); ?>" style="width:60px;height:60px;object-fit:cover;border-radius:6px;border:1px solid #dee2e6;" alt="Bukti">
                                                </a>
                                                <?php else: ?>
                                                <a href="<?php echo e($attUrl); ?>" target="_blank" class="btn btn-sm btn-outline-secondary" style="width:60px;height:60px;display:flex;align-items:center;justify-content:center;">
                                                    <i class="ti ti-file-text fs-4"></i>
                                                </a>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($att->note): ?>
                                                <span class="text-muted" style="font-size:0.65rem;max-width:70px;text-align:center;word-break:break-word;"><?php echo e($att->note); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canAddAtt): ?>
                                                <div class="d-flex gap-1">
                                                    <button class="btn btn-xs btn-warning p-1" style="font-size:0.65rem;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditAtt<?php echo e($att->id_attachment_payment); ?>"
                                                        title="Edit">
                                                        <i class="ti ti-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-danger p-1" style="font-size:0.65rem;"
                                                        onclick="window.showConfirm({title: 'Hapus Attachment', message: 'Hapus attachment ini?', type: 'danger', btnText: 'Ya, Lanjutkan!', onConfirm: () => window.location.href='<?php echo e(route('payment-requests.attachment-payment.delete', $att->id_attachment_payment)); ?>'})"
                                                        title="Delete">
                                                        <i class="ti ti-x"></i>
                                                    </button>
                                                </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </div>
                                        <?php else: ?>
                                        <div class="text-muted small fst-italic py-2">Belum ada bukti transfer.</div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="text-center py-5 bg-light rounded-3 border border-dashed">
                            <i class="ti ti-report-money fs-1 text-secondary opacity-50 d-block mb-2"></i>
                            <p class="text-muted mb-0">Belum ada payment.</p>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    
    
    

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canPayment): ?>
    <div class="modal fade" id="modalTambahPayment" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo e(route('payment-requests.payment.store', $prHash)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="ti ti-plus"></i> Tambah Payment</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tipe Payment <span class="text-danger">*</span></label>
                                <select name="payment_type" class="form-select" required>
                                    <option value="1">Parsial</option>
                                    <option value="2">Full</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Payment <span class="text-danger">*</span></label>
                                <input type="date" name="payment_date" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Metode Pembayaran</label>
                                <select name="payment_method" class="form-select">
                                    <option value="">-- pilih --</option>
                                    <option value="1">Transfer</option>
                                    <option value="2">Tunai</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Bank <span class="text-danger">*</span></label>
                                <input type="text" name="nama_bank" class="form-control" value="<?php echo e($pr->norek_vendor->nama_bank ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Penerima</label>
                                <input type="text" name="nama_penerima" class="form-control" value="<?php echo e($pr->norek_vendor->nama_penerima ?? ''); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">No Rekening <span class="text-danger">*</span></label>
                                <input type="text" name="norek" class="form-control" value="<?php echo e($pr->norek_vendor->norek ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Amount <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo e($symbol); ?></span>
                                    <input type="text" class="form-control amount-display" onkeyup="updateHiddenAndTotal('modalTambahPayment')" placeholder="0" required>
                                    <input type="hidden" name="amount" class="amount-hidden" value="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Additional (PPh/Pajak)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo e($symbol); ?></span>
                                    <input type="text" class="form-control additional-display" onkeyup="updateHiddenAndTotal('modalTambahPayment')" placeholder="0">
                                    <input type="hidden" name="additional" class="additional-hidden" value="0">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Grand Total</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><?php echo e($symbol); ?></span>
                                    <input type="text" class="form-control total-display bg-light text-muted fw-bold" readonly placeholder="Auto Calculate">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Keterangan / Deskripsi</label>
                                <textarea name="payment_description" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="ti ti-check"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
    <?php $payHash = hashid_encode($payment->id_payment, 'payment'); ?>

    
    <div class="modal fade" id="modalEditPayment<?php echo e($payment->id_payment); ?>" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo e(route('payment-requests.payment.update', $payHash)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title"><i class="ti ti-edit"></i> Edit Payment #<?php echo e($loop->iteration); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tipe Payment</label>
                                <select name="payment_type" class="form-select" required>
                                    <option value="1" <?php echo e($payment->payment_type==1?'selected':''); ?>>Parsial</option>
                                    <option value="2" <?php echo e($payment->payment_type==2?'selected':''); ?>>Full</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Payment</label>
                                <input type="date" name="payment_date" class="form-control"
                                    value="<?php echo e($payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') : ''); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Metode Pembayaran</label>
                                <select name="payment_method" class="form-select">
                                    <option value="">-- pilih --</option>
                                    <option value="1" <?php echo e($payment->payment_method==1?'selected':''); ?>>Transfer</option>
                                    <option value="2" <?php echo e($payment->payment_method==2?'selected':''); ?>>Tunai</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Bank</label>
                                <input type="text" name="nama_bank" class="form-control" value="<?php echo e($payment->nama_bank); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Penerima</label>
                                <input type="text" name="nama_penerima" class="form-control" value="<?php echo e($payment->nama_penerima); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">No Rekening</label>
                                <input type="text" name="norek" class="form-control" value="<?php echo e($payment->norek); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo e($symbol); ?></span>
                                    <input type="text" class="form-control amount-display" onkeyup="updateHiddenAndTotal('modalEditPayment<?php echo e($payment->id_payment); ?>')"
                                        value="<?php echo e(number_format($payment->ammount, 2, ',', '.')); ?>" required>
                                    <input type="hidden" name="amount" class="amount-hidden" value="<?php echo e(number_format($payment->ammount, 2, '.', '')); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Additional</label>
                                <div class="input-group">
                                    <span class="input-group-text"><?php echo e($symbol); ?></span>
                                    <input type="text" class="form-control additional-display" onkeyup="updateHiddenAndTotal('modalEditPayment<?php echo e($payment->id_payment); ?>')"
                                        value="<?php echo e(number_format($payment->additional ?? 0, 2, ',', '.')); ?>">
                                    <input type="hidden" name="additional" class="additional-hidden" value="<?php echo e(number_format($payment->additional ?? 0, 2, '.', '')); ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Grand Total</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><?php echo e($symbol); ?></span>
                                    <input type="text" class="form-control total-display bg-light text-muted fw-bold" readonly
                                        value="<?php echo e(number_format($payment->ammount, 2, ',', '.')); ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Keterangan</label>
                                <textarea name="payment_description" class="form-control" rows="2"><?php echo e($payment->payment_description); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalAddAtt<?php echo e($payment->id_payment); ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('payment-requests.attachment-payment.store', $prHash)); ?>" method="POST" enctype="multipart/form-data" class="formPayAtt" id="formAddAttPay-<?php echo e($payment->id_payment); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id_payment" value="<?php echo e($payment->id_payment); ?>">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="ti ti-upload"></i> Upload Bukti Transfer — Payment #<?php echo e($loop->iteration); ?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-bold">File (JPG/PNG/PDF, max 5MB) <span class="text-danger">*</span></label>
                                <input type="file" name="filename" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Attachment Type</label>
                                <select name="id_attachment" class="form-select" required>
                                    <option value="">-- pilih tipe --</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $attachmentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $at): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($at->id_attachment); ?>"><?php echo e($at->attachment); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Catatan</label>
                                <input type="text" name="note" class="form-control" placeholder="Contoh: Bukti bayar DP">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="btnSubmitAddAttPay-<?php echo e($payment->id_payment); ?>"><i class="ti ti-upload"></i> Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $payment->attachments ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
    <?php $attHash = hashid_encode($att->id_attachment_payment, 'attachmentpay'); ?>
    <div class="modal fade" id="modalEditAtt<?php echo e($att->id_attachment_payment); ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('payment-requests.attachment-payment.update', $att->id_attachment_payment)); ?>" method="POST" enctype="multipart/form-data" class="formPayAtt" id="formEditAttPay-<?php echo e($att->id_attachment_payment); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id_payment" value="<?php echo e($payment->id_payment); ?>">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title"><i class="ti ti-edit"></i> Edit Attachment Bukti Transfer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-bold">File Baru (kosongkan jika tidak ganti)</label>
                                <input type="file" name="filename" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                                <div class="form-text">File saat ini: <strong><?php echo e($att->filename); ?></strong></div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Attachment Type</label>
                                <select name="id_attachment" class="form-select" required>
                                    <option value="">-- pilih tipe --</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $attachmentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $atType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($atType->id_attachment); ?>" <?php echo e($att->id_attachment == $atType->id_attachment ? 'selected' : ''); ?>>
                                        <?php echo e($atType->attachment); ?>

                                    </option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Catatan</label>
                                <input type="text" name="note" class="form-control" value="<?php echo e($att->note); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning" id="btnSubmitEditAttPay-<?php echo e($att->id_attachment_payment); ?>">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?> 

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->canRevision()): ?>
    <div class="modal fade" id="modalRevision" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-secondary">
                <form action="<?php echo e(route('payment-requests.payment.revision', $prHash)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title"><i class="ti ti-rotate"></i> Revisi Payment</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <i class="ti ti-alert-triangle me-1"></i>
                            Tindakan ini akan mengembalikan payment ke tahap awal dan payment terakhir yang belum di-approve akan dikembalikan status-nya.
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alasan Revisi <span class="text-danger">*</span></label>
                            <textarea name="revision_reason" class="form-control" rows="3" required placeholder="Tuliskan alasan revisi..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="ti ti-check"></i> Revisi Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('payment-requests.loan-modal', []);

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-4076649688-0', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function formatRupiah(angka) {
        if (!angka) return '';
        var v = angka.toString().replace(/[^0-9,]/g, '');
        var parts = v.split(',');
        if (parts.length > 2) v = parts.shift() + ',' + parts.join('');

        var split = v.split(',');
        var intPart = (split[0] || '').replace(/\./g, '');
        var decPart = split[1];

        intPart = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        return decPart !== undefined ? intPart + ',' + decPart : intPart;
    }

    function parseID(str) {
        if (!str) return 0;
        return parseFloat(String(str).replace(/\./g, '').replace(',', '.')) || 0;
    }

    function updateHiddenAndTotal(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        const amountDisp = modal.querySelector('.amount-display');
        const amountHidden = modal.querySelector('.amount-hidden');
        const addDisp = modal.querySelector('.additional-display');
        const addHidden = modal.querySelector('.additional-hidden');
        const totalDisp = modal.querySelector('.total-display');

        if (amountDisp && amountHidden) {
            amountDisp.value = formatRupiah(amountDisp.value);
            amountHidden.value = parseID(amountDisp.value);
        }
        if (addDisp && addHidden) {
            addDisp.value = formatRupiah(addDisp.value);
            addHidden.value = parseID(addDisp.value);
        }
        if (amountDisp && totalDisp) {
            const amountVal = amountDisp ? parseID(amountDisp.value) : 0;
            const total = amountVal;
            totalDisp.value = isNaN(total) ? '' : total.toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 4
            });
        }
    }

    const validateFile = (files) => {
        const maxSize = 5 * 1024 * 1024; // 5MB
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const extension = file.name.split('.').pop().toLowerCase();

            if (file.size > maxSize) {
                return {
                    valid: false,
                    message: 'Ukuran maksimal file adalah 5MB.'
                };
            }
            if (!allowedExtensions.includes(extension)) {
                return {
                    valid: false,
                    message: 'Hanya file JPG, JPEG, PNG, dan PDF yang diperbolehkan.'
                };
            }
        }
        return {
            valid: true
        };
    };

    const setBtnLoading = (btn) => {
        btn.disabled = true;
        btn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> Please wait...`;
    };

    document.addEventListener('submit', function(e) {
        if (e.target && e.target.classList.contains('formPayAtt')) {
            const form = e.target;
            const files = form.querySelector('input[type="file"]').files;
            const submitBtn = form.querySelector('button[type="submit"]');

            // 1. Validasi File (Size & Ext)
            if (files.length > 0) {
                const validation = validateFile(files);
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
            } else if (form.id.startsWith('formAddAttPay-')) {
                // Form ADD wajib ada file
                e.preventDefault();
                window.dispatchEvent(new CustomEvent('alert', {
                    detail: {
                        type: 'warning',
                        title: 'Validation Error',
                        message: 'Silakan pilih file.'
                    }
                }));
                return;
            }

            // 2. Jika lolos, biarkan event jalan & set loading
            if (submitBtn) {
                // Set loading state (delay sedikit agar browser sempat mencatat event submit)
                setTimeout(() => {
                    setBtnLoading(submitBtn);
                }, 0);
            }
        }
    });

    window.submitPost = function(url) {
        let f = document.createElement('form');
        f.method = 'POST';
        f.action = url;
        let t = document.createElement('input');
        t.type = 'hidden';
        t.name = '_token';
        t.value = '<?php echo e(csrf_token()); ?>';
        f.appendChild(t);
        document.body.appendChild(f);
        f.submit();
    }
</script>
<?php $__env->stopPush(); ?><?php /**PATH D:\!Kerja\laracok - Copy\resources\views/livewire/payment-requests/payment-show.blade.php ENDPATH**/ ?>