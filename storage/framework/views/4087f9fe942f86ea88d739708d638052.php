<div class="payment-request-detail" id="print-area">
    <?php
        $pr = $this->pr;
        $prHash = $this->prHash;
        $status = intval($pr->status);
        $symbol = $pr->currency->symbol ?? 'Rp';
        $user = auth()->user();

        // totals
        $grandTotal = $pr->details->sum('ammount') - floatval($pr->additional_discount ?? 0);
        $totalPayment = $pr->payments->sum('grand_total');
        $balance = $grandTotal - $totalPayment;

        // roles
        $isAdmin = $user->level == 1;
        $isOwner = $user->id_user == $pr->id_user;

        // approval logics
        $isPendingDept = $status === 1;
        $isPendingDirector = $status === 2;
        $isPendingAccounting = $status === 3;
        $isPendingFinance = $status === 4;
        $isPendingSpvFinance = $status === 5;
        $isPendingCfo = $status === 6;

        // permissions
        $canSubmit =
            ($isAdmin || $isOwner) &&
            ($isAdmin || $user->hasPermission('pr.submit')) &&
            in_array($status, [0, null, 12]);
        $canCancelSubmit =
            ($isAdmin ||
                $isOwner ||
                ($this->isSupervisor($pr) && $user->hasPermission('pr.cancel_submit')) ||
                $user->hasPermission('pr.cancel_submit')) &&
            $status === 1;

        $canEdit = ($isAdmin || $isOwner || $user->hasPermission('pr.edit')) && in_array($status, [0, null, 12]);
        $canDelete = ($isAdmin || $isOwner || $user->hasPermission('pr.delete')) && in_array($status, [0, null, 13]);

        $canApprove = $this->canUserApproveCurrentStep();
        $canCancelApprove = $this->canUserCancelApproval();

        $canPayment = $isAdmin || $user->hasPermission('pr.payment') || $isOwner;
        $showPayment = in_array($status, [7, 8, 9, 10, 11, 12, 13, 14, 15]);
        $canDownload =
            ($isAdmin || $isOwner || $user->hasPermission('pr.print')) &&
            in_array($status, [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]);

        $sign = fn(int $s) => $pr->signTransactions->where('status', $s)->first();

        $statusBadge = [
            null => ['label' => 'Draft', 'color' => 'secondary'],
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
        $sbadge = $statusBadge[$pr->status] ?? ['label' => 'Unknown', 'color' => 'dark'];
    ?>

    
    <template x-teleport="#pr-header-actions">
        <div class="d-flex align-items-center gap-2" data-html2canvas-ignore="true">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canSubmit): ?>
                <button type="button" class="btn btn-primary btn-sm rounded-pill shadow-sm px-3 fw-bold approveSign"
                    data-action="submit">
                    <i class="ti ti-send me-1"></i> Submit PR
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCancelSubmit): ?>
                <button type="button"
                    class="btn btn-outline-danger btn-sm rounded-pill shadow-sm px-3 fw-bold openCancelAction"
                    data-action="cancelSubmit" data-bs-toggle="modal" data-bs-target="#modalCancelAction">
                    <i class="ti ti-arrow-back-up me-1"></i> Cancel Submit
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canApprove): ?>
                <button type="button" class="btn btn-success btn-sm rounded-pill shadow-sm px-3 fw-bold approveSign"
                    data-bs-toggle="modal" data-bs-target="#modalApprove"
                    data-role="<?php echo e($isPendingDept ? 'dept' : ($isPendingDirector ? 'director' : ($isPendingAccounting ? 'accounting' : ($isPendingFinance ? 'finance' : ($isPendingSpvFinance ? 'spvfinance' : 'cfo'))))); ?>">
                    <i class="ti ti-check me-1"></i> Approve
                </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin || $user->hasPermission('pr.revision')): ?>
                    <button type="button"
                        class="btn btn-warning btn-sm rounded-pill shadow-sm px-3 fw-bold approveSign"
                        data-bs-toggle="modal" data-bs-target="#modalApprove" data-action="revision">
                        <i class="ti ti-refresh me-1"></i> Revision
                    </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin || $user->hasPermission('pr.reject')): ?>
                    <button type="button" class="btn btn-danger btn-sm rounded-pill shadow-sm px-3 fw-bold approveSign"
                        data-bs-toggle="modal" data-bs-target="#modalApprove" data-action="reject">
                        <i class="ti ti-x me-1"></i> Reject
                    </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCancelApprove): ?>
                <button type="button"
                    class="btn btn-outline-danger btn-sm rounded-pill shadow-sm px-3 fw-bold openCancelAction"
                    data-action="cancelApproval" data-bs-toggle="modal" data-bs-target="#modalCancelAction">
                    <i class="ti ti-arrow-back-up me-1"></i> Cancel Approval
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </template>

    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4 d-none">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"
                            class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('payment-requests.index')); ?>"
                            class="text-decoration-none text-uppercase">PAYMENT REQUEST</a></li>
                    <li class="breadcrumb-item active text-uppercase">DETAIL</li>
                </ol>
            </nav>
        </div>

        <div class="col-12">
            <div class="card p-4 border-0 shadow-sm">
                
                <div class="d-flex justify-content-between align-items-start mb-4 border-bottom pb-3"
                    data-html2canvas-ignore="true">
                    <div>
                        <h5 class="fw-bold mb-0">DETAIL</h5>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        
                        <div class="d-flex gap-2">
                            <a href="<?php echo e(route('payment-requests.index')); ?>" class="btn btn-secondary btn-sm"
                                data-html2canvas-ignore="true">
                                <i class="ti ti-arrow-left me-1"></i> Back
                            </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showPayment || $canPayment): ?>
                                <a href="<?php echo e(route('payment-requests.payment', $prHash)); ?>"
                                    class="btn btn-primary btn-sm">Payment</a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($status, [11]) && $pr->id_doc_type == 2): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($existingSr): ?>
                                    <?php $srHash = hashid_encode($existingSr->id_pr, 'pr'); ?>
                                    <a href="<?php echo e(route('settlement-reports.show', $srHash)); ?>"
                                        class="btn btn-outline-success btn-sm" title="Settlement sudah ada">
                                        <i class="ti ti-report me-1"></i>View SR
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('settlement-reports.create', $prHash)); ?>"
                                        class="btn btn-success btn-sm">Settlement</a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin || $isOwner || $user->hasPermission('pr_invoice.view') || $user->hasPermission('pr_invoice.create')): ?>
                                <a href="<?php echo e(route('payment-requests.invoice', $prHash)); ?>"
                                    class="btn btn-info btn-sm text-white" data-html2canvas-ignore="true">
                                    <i class="ti ti-file-invoice me-1"></i> Invoice
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canDownload): ?>
                                <button id="btnDownloadPDF" class="btn btn-danger btn-sm" onclick="downloadPDF()">
                                    <span id="btnDownloadNormal">Download</span>
                                    <span id="btnDownloadLoading" class="d-none">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                    </span>
                                </button>
                                <button class="btn btn-success btn-sm" onclick="printPR()">Print</button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEdit): ?>
                                <button type="button"
                                    wire:click="$dispatch('open-pr-form', { id: <?php echo e($pr->id_pr); ?> })"
                                    class="btn btn-warning btn-sm" data-html2canvas-ignore="true">
                                    <i class="ti ti-edit me-1"></i> Edit
                                </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canDelete): ?>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="showConfirm({
                                        title: 'Hapus PR',
                                        message: 'Apakah Anda yakin ingin menghapus PR ini? Tindakan ini tidak dapat dibatalkan.',
                                        type: 'danger',
                                        onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').deletePr()
                                    })"
                                    data-html2canvas-ignore="true">Delete</button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        
                        <button class="btn btn-success btn-sm d-flex align-items-center justify-content-center"
                            style="height: 38px; width: 38px;" data-html2canvas-ignore="true">
                            <i class="ti ti-brand-whatsapp fs-4"></i>
                        </button>
                    </div>
                </div>

                
                <div class="d-flex align-items-center mb-4">
                    
                    <div style="width: 30%;">
                        <?php
                            $logoPath = $pr->company->logo ?? 'logo.png';
                            $logoFullPath = public_path('assets/companies/logos/' . $logoPath);
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(file_exists($logoFullPath)): ?>
                            <img src="<?php echo e(asset('assets/companies/logos/' . $logoPath)); ?>" class="img-fluid"
                                alt="Logo" style="max-height: 120px; object-fit: contain;">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    
                    <div class="text-center" style="flex: 1;">
                        <h4 style="font-weight: 700; color: #3b5998; text-transform: uppercase; margin-bottom: 5px;">
                            <?php echo e($pr->company->company_name ?? ($pr->company->company ?? config('app.name'))); ?>

                        </h4>
                        <h5 style="font-weight: 600; text-decoration: underline; color: #435e2c; margin-bottom: 0;">
                            PAYMENT REQUEST FORM
                        </h5>
                    </div>
                    
                    <div style="width: 30%;"></div>
                </div>

                
                <div class="row pt-2">
                    <div class="alert alert-success d-flex align-items-center mb-4" role="alert"
                        style="padding: 8px 15px; background-color: #dcf2d1; border-color: #c8e6b9; border-radius: 4px;">
                        <div style="text-decoration: underline; font-weight:600; color: #3b5a2b; font-size: 13px;">
                            PAYMENT REQUEST DETAIL</div>
                        <div class="mx-3">
                            <span class="badge bg-<?php echo e($sbadge['color'] == 'warning' ? 'warning' : $sbadge['color']); ?>"
                                style="font-size:11px; padding: 4px 8px; <?php echo e($sbadge['color'] == 'warning' ? 'color: #000;' : ''); ?>"><?php echo e($sbadge['label']); ?></span>
                        </div>
                    </div>

                    <!-- 1 -->
                    <div class="form-group col-md-6">
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">SUBJECT</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8" style="text-align: justify;"><?php echo e($pr->subject); ?></div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">REQUEST DATE</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->created_at?->format('d F Y')); ?></div>
                        </div>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">PAYMENT DUE DATE</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8">
                                <?php echo e($pr->payment_due_date ? \Carbon\Carbon::parse($pr->payment_due_date)->format('d F Y') : '-'); ?>

                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($pr->id_doc_type, [2, 3])): ?>
                            <div class="mb-3 d-flex" style="font-size: 13px;">
                                <div class="col-3 fw-bold">ES SETTLEMENT DATE</div>
                                <div class="col-1 text-end">:&nbsp;</div>
                                <div class="col-8">
                                    <?php echo e($pr->est_settlement_date ? \Carbon\Carbon::parse($pr->est_settlement_date)->format('d F Y') : '-'); ?>

                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">PR NUMBER</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->pr_number); ?></div>
                        </div>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">BRANCH</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->branch->branch ?? '-'); ?></div>
                        </div>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">DEPARTEMENT</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->departement->departement ?? '-'); ?></div>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="form-group col-md-6">
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">PR CATEGORY</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8">
                                <?php echo e($pr->id_doc_type != 3 ? $pr->docType->doc_type ?? '-' : 'Settlement'); ?></div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">CATEGORY</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->costCategory->cost_category ?? '-'); ?></div>
                        </div>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">EXPENSE</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->costType->cost_type ?? '-'); ?></div>
                        </div>
                        <div class="mb-3 d-flex align-items-center" style="font-size: 13px;">
                            <div class="col-3 fw-bold">LOAN</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8">
                                <?php
                                    $canManageLoan =
                                        ($isAdmin || $user->hasPermission('loan.view')) && !in_array($status, [11]);
                                ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr->loan && $pr->loan->loan): ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canManageLoan): ?>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalLoan"
                                            class="text-decoration-none text-dark btn btn-success fw-bold btn-sm">
                                            <?php echo e($pr->loan->loan); ?>

                                        </a>
                                    <?php else: ?>
                                        <span class="text-dark btn btn-success fw-bold btn-sm disabled"
                                            style="opacity: 1;">
                                            <?php echo e($pr->loan->loan); ?>

                                        </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php else: ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canManageLoan): ?>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalLoan"
                                            class="text-decoration-none btn btn-primary fw-bold btn-sm">
                                            ADD
                                        </a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="form-group col-md-6">
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">VENDOR</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->vendor->vendor ?? '-'); ?></div>
                        </div>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">NO. INVOICE</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->no_invoice ?? '-'); ?></div>
                        </div>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">PO NUMBER</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->po_number ?? '-'); ?></div>
                        </div>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">EMAIL</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8">
                                <?php echo e($pr->emailVendor->email ?? '-'); ?><br>
                                <?php echo e($pr->emailUser->email ?? '-'); ?>

                            </div>
                        </div>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <?php
                                $npwp = !empty($pr->vendor->npwp) ? decrypt_legacy($pr->vendor->npwp) : '';
                                $nik = !empty($pr->vendor->nik) ? decrypt_legacy($pr->vendor->nik) : '';
                                if (!empty($npwp) && !empty($nik)) {
                                    $npwp_nik = $npwp . ' - ' . $nik;
                                } elseif (!empty($npwp)) {
                                    $npwp_nik = $npwp;
                                } elseif (!empty($nik)) {
                                    $npwp_nik = $nik;
                                } else {
                                    $npwp_nik = '-';
                                }
                            ?>
                            <div class="col-3 fw-bold">NPWP/NIK</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($npwp_nik); ?></div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">PAYMENT METHOD</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->payment_method == 1 ? 'Transfer' : 'Cash'); ?></div>
                        </div>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">PAYMENT TYPE</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8">
                                <?php echo e($pr->payment_type_pr == 1 ? 'Parsial' : ($pr->payment_type_pr == 2 ? 'Full Payment' : 'Full Payment')); ?>

                            </div>
                        </div>

                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">BANK NAME</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->nama_bank ?: $pr->norek_vendor->nama_bank ?? ''); ?></div>
                        </div>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">ACCOUNT NAME</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->nama_penerima ?: $pr->norek_vendor->nama_penerima ?? ''); ?>

                            </div>
                        </div>
                        <div class="mb-3 d-flex" style="font-size: 13px;">
                            <div class="col-3 fw-bold">ACCOUNT NUMBER</div>
                            <div class="col-1 text-end">:&nbsp;</div>
                            <div class="col-8"><?php echo e($pr->norek ?: $pr->norek_vendor->norek ?? ''); ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="card-header align-items-center bg bg-transparent d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">LIST PAYMENT</h4>
                    <?php
                        $canAddDetail = $isAdmin || ($isOwner && $user->hasPermission('pr_detail.create'));
                        $canEditDetail = $isAdmin || ($isOwner && $user->hasPermission('pr_detail.edit'));
                        $canViewDetail = $isAdmin || $isOwner || $user->hasPermission('pr_detail.view');
                    ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canAddDetail && in_array($pr->status, [null, 0, 12])): ?>
                        <div class="flex-shrink-0">
                            <button class="btn btn-primary"
                                wire:click="$dispatchTo('payment-requests.form-detail-modal', 'openModal')">ADD</button>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="table-responsive dt-responsive">
                    <table class="table table-striped table-bordered nowrap">
                        <thead class="text-center" style="background-color: green; color: white;">
                            <tr>
                                <th>No</th>
                                <th>DESCRIPTION</th>
                                <th>BL Number</th>
                                <th>QTY</th>
                                <th>UOM</th>
                                <th>UNIT PRICE</th>
                                <th>DISCOUNT</th>
                                <th>VAT</th>
                                <th>PPH</th>
                                <th>AMOUNT</th>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEditDetail && in_array($pr->status, [null, 0, 12])): ?>
                                    <th data-html2canvas-ignore="true">ACTION</th>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pr->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <td class="text-center"><?php echo e($no++); ?></td>
                                    <td class="text-wrap"
                                        style="max-width: 360px; cursor: <?php echo e($canViewDetail ? 'pointer' : 'default'); ?>;"
                                        <?php if($canViewDetail): ?> wire:click="$dispatchTo('payment-requests.form-detail-modal', 'openModal', { id: <?php echo e($item->id_detail_pr); ?>, viewOnly: true })" <?php endif; ?>>
                                        <?php echo e($item->detail); ?>

                                    </td>
                                    <td class="text-wrap text-center" style="max-width: 360px;">
                                        <?php echo e($item->bl_number ?? '-'); ?></td>
                                    <td class="text-center"><?php echo e(number_format($item->qty, 2, ',', '.')); ?></td>
                                    <td class="text-center"><?php echo e($item->uom->uom ?? '-'); ?></td>
                                    <td class="text-center"><?php echo e($symbol); ?>

                                        <?php echo e(number_format($item->price, 2, ',', '.')); ?></td>
                                    <td class="text-center"><?php echo e($symbol); ?>

                                        <?php echo e(number_format($item->discount, 2, ',', '.')); ?></td>
                                    <td class="text-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item->taxSatu) && $item->tax1 > 0): ?>
                                            <?php echo e($item->taxSatu->tax); ?>

                                            (<?php echo e(number_format($item->taxSatu->tax_persen * 100, 2, ',', '.')); ?>%)<br>
                                            <?php echo e($symbol); ?> <?php echo e(number_format($item->tax1, 2, ',', '.')); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            $labels = [];
                                            if (!empty($item->progresif) && $item->progresif == 1) {
                                                $labels[] = 'Progresif';
                                            }
                                            if (!empty($item->gross) && $item->gross == 1) {
                                                $labels[] = 'PPh Gross Up';
                                            }
                                            echo $labels ? implode('<br>', $labels) . '<br>' : '';
                                        ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->tax2 > 0): ?>
                                            <?php echo e($item->taxDua->tax ?? ''); ?>

                                            (<?php echo e(number_format(($item->taxDua->tax_persen ?? 0) * 100, 2, ',', '.')); ?>%)<br>
                                            <?php echo e($symbol); ?> <?php echo e(number_format($item->tax2, 2, ',', '.')); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="fw-bold"><?php echo e($symbol); ?>

                                        <?php echo e(number_format($item->ammount, 2, ',', '.')); ?></td>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canEditDetail && in_array($pr->status, [null, 0, 12])): ?>
                                        <td class="text-center" data-html2canvas-ignore="true">
                                            <span>
                                                <button class="ti ti-edit fs-3 btn btn-link p-0"
                                                    wire:click="$dispatchTo('payment-requests.form-detail-modal', 'openModal', { id: <?php echo e($item->id_detail_pr); ?> })"></button>
                                            </span>
                                            <span style="color:red;">
                                                <button class="ti ti-trash fs-3 btn btn-link p-0"
                                                    onclick="showConfirm({
                                                title: 'Hapus Item',
                                                message: 'Apakah Anda yakin ingin menghapus item ini?',
                                                type: 'danger',
                                                onConfirm: () => Livewire.dispatch('delete-detail', { id: <?php echo e($item->id_detail_pr); ?> })
                                            })"></button>
                                            </span>
                                        </td>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                <?php $showActionColumn = $canEditDetail && in_array($pr->status, [null, 0, 12]); ?>
                                <tr>
                                    <td colspan="<?php echo e($showActionColumn ? 11 : 10); ?>" class="text-center py-3">Tidak
                                        ada item.</td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="9" style="text-align:right; background-color: darkseagreen;">
                                    ADDITIONAL DISCOUNT</th>
                                <th colspan="1"><?php echo e($symbol); ?>

                                    <?php echo e(number_format($pr->additional_discount ?? 0, 2, ',', '.')); ?></th>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showActionColumn ?? $canEditDetail && in_array($pr->status, [null, 0, 12])): ?>
                                    <th data-html2canvas-ignore="true"></th>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tr>
                            <tr>
                                <th colspan="9" style="text-align:right; background-color: darkseagreen;">GRAND
                                    TOTAL</th>
                                <th colspan="1"><?php echo e($symbol); ?> <?php echo e(number_format($grandTotal, 2, ',', '.')); ?>

                                </th>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showActionColumn ?? $canEditDetail && in_array($pr->status, [null, 0, 12])): ?>
                                    <th data-html2canvas-ignore="true"></th>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tr>
                            <tr>
                                <th colspan="9" style="text-align:right; background-color: darkseagreen;">TOTAL
                                    PAYMENT</th>
                                <th colspan="1"><?php echo e($symbol); ?>

                                    <?php echo e(number_format($totalPayment, 2, ',', '.')); ?></th>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showActionColumn ?? $canEditDetail && in_array($pr->status, [null, 0, 12])): ?>
                                    <th data-html2canvas-ignore="true"></th>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tr>
                            <tr>
                                <th colspan="9" style="text-align:right; background-color: burlywood;">BALANCE</th>
                                <th colspan="1"><?php echo e($symbol); ?> <?php echo e(number_format($balance, 2, ',', '.')); ?>

                                </th>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showActionColumn ?? $canEditDetail && in_array($pr->status, [null, 0, 12])): ?>
                                    <th data-html2canvas-ignore="true"></th>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                
                <div class="card border-0 shadow-sm theme-responsive-card">
                    <div class="card-body p-4">
                        <?php
                            // 1. Can Manage? (Add/Edit/Delete overall eligibility - excluding status 8 specifics for editing which is done per file)
                            $canManageAtt =
                                auth()->user()->level === 1 ||
                                (auth()->user()->id_user == $pr->id_user &&
                                    auth()->user()->hasPermission('pr_attachment.create'));

                            // 2. Allowed Status?
                            $isAllowedStatus = in_array($pr->status, [0, 8, 12, 14]); // Added 14 as per earlier discussion

                            // 3. Can View?
                            $canViewAtt =
                                auth()->user()->level === 1 ||
                                auth()->user()->id_user == $pr->id_user ||
                                auth()->user()->hasPermission('pr_attachment.view');
                        ?>
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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pr->attachmentPrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php
                                    $canEditDeleteAtt = false;
                                    $attHash = hashid_encode($file->id_attachment_pr, 'attachment-pr');
                                    if ($isAllowedStatus && $canManageAtt) {
                                        $canEditDeleteAtt = true;
                                        if ($pr->status == 8) {
                                            $enter8Date = App\Models\SignTransaction::where('id_pr', $pr->id_pr)
                                                ->where('status', 8)
                                                ->latest()
                                                ->value('updated_at');
                                            if ($enter8Date && $file->created_at < $enter8Date) {
                                                $canEditDeleteAtt = false;
                                            }
                                        }
                                    }
                                ?>
                                <div class="col-md-2 d-flex align-items-center mb-2">
                                    <div class="form-check form-check-inline d-flex align-items-center mb-0">
                                        <input type="checkbox" class="form-check-input input-primary me-2" checked
                                            onclick="return false;" style="width: 1.2rem; height: 1.2rem;">
                                        <label class="form-check-label text-justify flex-grow-1 fw-bold text-uppercase"
                                            style="cursor:pointer; font-size: 0.9rem;">
                                            <a href="javascript:void(0)"
                                                data-url="<?php echo e(asset('assets/attachmentpr/' . $file->filename)); ?>"
                                                data-type="<?php echo e($file->attachment->attachment ?? 'GENERAL'); ?>"
                                                data-note="<?php echo e($file->note); ?>"
                                                data-delete="<?php echo e(route('payment-requests.attachment.delete', $attHash)); ?>"
                                                data-update="<?php echo e(route('payment-requests.attachment.update', $attHash)); ?>"
                                                data-catid="<?php echo e($file->id_attachment); ?>"
                                                data-can-edit="<?php echo e($canEditDeleteAtt ? 'true' : 'false'); ?>"
                                                onclick="<?php echo e($canViewAtt ? 'previewAttachment(this)' : 'window.dispatchEvent(new CustomEvent(\'alert\', { detail: { type: \'error\', title: \'Access Denied\', message: \'Anda tidak memiliki izin untuk melihat lampiran ini.\' } }))'); ?>; return false;"
                                                style="color: inherit; text-decoration: none;">
                                                <?php echo e($file->attachment->attachment ?? ($file->note ?: '-')); ?>

                                            </a>
                                        </label>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <div class="modal fade" id="modalLoan" tabindex="-1" aria-labelledby="modalLoanLabel"
                    aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form wire:submit.prevent="saveLoan">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLoanLabel">Input Loan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3" wire:ignore>
                                        <label for="loanSelect" class="form-label">Loan</label>
                                        <select id="loanSelect" class="form-select select2" style="width: 100%;">
                                            <option value="">-</option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                                <option value="<?php echo e($l->id_loan); ?>"><?php echo e($l->loan); ?></option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                
                <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Preview Dokumen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="bg-light p-3 border rounded mb-3">
                                    <div class="small mb-1">
                                        <strong>Note:</strong> <span id="previewNote" class="text-dark"></span>
                                    </div>
                                    <div class="small">
                                        <strong>Attachment:</strong> <span id="previewAttachment"
                                            class="text-dark"></span>
                                    </div>
                                </div>
                                <div id="previewBody" class="text-center p-2 rounded"
                                    style="min-height: 400px; background: #fff; border: 1px solid #dee2e6;">
                                    <div class="spinner-border text-primary mt-5" role="status"></div>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 d-flex justify-content-end gap-2">
                                <a href="#" id="downloadBtn" class="btn btn-primary d-none" download>
                                    <i class="ti ti-download"></i>
                                </a>
                                <button type="button" id="editBtn" class="btn btn-warning px-4"
                                    style="display:none;">
                                    <i class="ti ti-edit me-1"></i>Edit
                                </button>
                                <button type="button" id="deleteBtn" class="btn btn-danger px-4"
                                    style="display:none;">
                                    <i class="ti ti-trash me-1"></i>Hapus
                                </button>
                                <button type="button" class="btn btn-secondary px-4"
                                    data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="modal fade" id="modalEditAttachment" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form id="formEditAttachment" method="POST" action=""
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?> <?php echo method_field('POST'); ?> 
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Attachment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Note / Description</label>
                                        <input type="text" class="form-control" name="note" id="edit_note">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Document Type</label>
                                        <select class="form-select" name="id_attachment" id="edit_id_attachment"
                                            required>
                                            <option value="">- Select Type -</option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\Attachment::orderBy('attachment')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                                <option value="<?php echo e($type->id_attachment); ?>"><?php echo e($type->attachment); ?>

                                                </option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Replace File (Optional)</label>
                                        <div class="btn-group w-100 mb-2" role="group">
                                            <input type="radio" class="btn-check" name="edit_upload_mode"
                                                id="editModeUpload" value="upload" checked>
                                            <label class="btn btn-outline-primary btn-sm" for="editModeUpload"><i
                                                    class="ti ti-upload me-1"></i> Upload</label>
                                            <input type="radio" class="btn-check" name="edit_upload_mode"
                                                id="editModeCamera" value="camera">
                                            <label class="btn btn-outline-primary btn-sm" for="editModeCamera"><i
                                                    class="ti ti-camera me-1"></i> Camera</label>
                                        </div>

                                        <div id="edit_upload_container">
                                            <input type="file" class="form-control" name="filename"
                                                id="input_edit_file" accept="image/*,application/pdf">
                                        </div>
                                        <div id="edit_camera_container" class="d-none">
                                            <div class="camera-wrapper bg-light rounded p-2 text-center border">
                                                <video id="video_edit" width="100%" height="auto" autoplay
                                                    class="rounded mb-2 d-none"></video>
                                                <canvas id="canvas_edit" class="d-none"></canvas>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" id="start-camera-edit"
                                                        class="btn btn-sm btn-info rounded-pill px-3">
                                                        <i class="ti ti-video me-1"></i> Start Camera
                                                    </button>
                                                    <button type="button" id="take-photo-edit"
                                                        class="btn btn-sm btn-success rounded-pill px-3 d-none">
                                                        <i class="ti ti-camera me-1"></i> Capture
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="captured_photo" id="captured_photo_edit">
                                        <input type="hidden" name="captured_photo_mime"
                                            id="captured_photo_mime_edit">
                                        <div class="small text-muted mt-1">Maksimal 5MB. Format: JPG, JPEG, PNG, PDF.
                                        </div>
                                    </div>
                                    <div id="edit_gallery_container" class="mt-2 d-none">
                                        <label class="form-label small fw-bold">Captured Photos:</label>
                                        <div class="d-flex flex-wrap gap-2 p-2 border rounded bg-light"
                                            id="edit_gallery_list">
                                            <!-- Photos will be appended here -->
                                        </div>
                                        <div class="small text-muted mt-1">Single photo will be saved as image,
                                            multiple as PDF.</div>
                                    </div>
                                    <div id="edit_preview_container" class="mt-2 d-none">
                                        <label class="form-label small fw-bold"
                                            id="edit_preview_label">Preview:</label>
                                        <div class="border rounded p-2 text-center bg-light position-relative">
                                            <img id="edit_preview_img" src=""
                                                class="img-fluid rounded d-none" style="max-height: 200px;">
                                            <div id="edit_preview_pdf" class="d-none">
                                                <i class="ti ti-file-text fs-1 text-danger"></i>
                                                <div class="small fw-bold text-muted mt-1" id="edit_pdf_name">
                                                    Merged_Attachment.pdf</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" id="btnUploadEdit"
                                        class="btn btn-warning px-4">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                
                <div class="modal fade" id="modalAddAttachment" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <form id="formAddAttachment" method="POST"
                                action="<?php echo e(route('payment-requests.attachment.store', $prHash)); ?>"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Attachment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Note</label>
                                        <input type="text" class="form-control" name="note">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Attachment</label>
                                        <select class="form-select select2" name="id_attachment">
                                            <option value="">-</option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\Attachment::orderBy('attachment')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                                <option value="<?php echo e($att->id_attachment); ?>"><?php echo e($att->attachment); ?>

                                                </option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">File (Image/PDF)</label>
                                        <div class="btn-group w-100 mb-2" role="group">
                                            <input type="radio" class="btn-check" name="add_upload_mode"
                                                id="addModeUpload" value="upload" checked>
                                            <label class="btn btn-outline-primary btn-sm" for="addModeUpload"><i
                                                    class="ti ti-upload me-1"></i> Upload</label>
                                            <input type="radio" class="btn-check" name="add_upload_mode"
                                                id="addModeCamera" value="camera">
                                            <label class="btn btn-outline-primary btn-sm" for="addModeCamera"><i
                                                    class="ti ti-camera me-1"></i> Camera</label>
                                        </div>

                                        <div id="add_upload_container">
                                            <input type="file" class="form-control" name="filename"
                                                id="input_add_file" accept="image/*,application/pdf">
                                        </div>
                                        <div id="add_camera_container" class="d-none">
                                            <div class="camera-wrapper bg-light rounded p-2 text-center border">
                                                <video id="video_add" width="100%" height="auto" autoplay
                                                    class="rounded mb-2 d-none"></video>
                                                <canvas id="canvas_add" class="d-none"></canvas>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" id="start-camera-add"
                                                        class="btn btn-sm btn-info rounded-pill px-3">
                                                        <i class="ti ti-video me-1"></i> Start Camera
                                                    </button>
                                                    <button type="button" id="take-photo-add"
                                                        class="btn btn-sm btn-success rounded-pill px-3 d-none">
                                                        <i class="ti ti-camera me-1"></i> Capture
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="captured_photo" id="captured_photo_add">
                                        <input type="hidden" name="captured_photo_mime"
                                            id="captured_photo_mime_add">
                                    </div>
                                    <div id="add_gallery_container" class="mt-2 d-none">
                                        <label class="form-label small fw-bold">Captured Photos:</label>
                                        <div class="d-flex flex-wrap gap-2 p-2 border rounded bg-light"
                                            id="add_gallery_list">
                                            <!-- Photos will be appended here -->
                                        </div>
                                        <div class="small text-muted mt-1">Single photo will be saved as image,
                                            multiple as PDF.</div>
                                    </div>
                                    <div id="add_preview_container" class="mt-2 d-none">
                                        <label class="form-label small fw-bold"
                                            id="add_preview_label">Preview:</label>
                                        <div class="border rounded p-2 text-center bg-light position-relative">
                                            <img id="add_preview_img" src="" class="img-fluid rounded d-none"
                                                style="max-height: 200px;">
                                            <div id="add_preview_pdf" class="d-none">
                                                <i class="ti ti-file-text fs-1 text-danger"></i>
                                                <div class="small fw-bold text-muted mt-1" id="add_pdf_name">
                                                    Merged_Attachment.pdf</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" id="btnUploadAdd" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            
            <div class="container mt-4 text-center">
                <div class="row text-uppercase fw-bold" style="color: #002b00;">
                    <div class="row d-flex justify-content-center flex-wrap text-center">

                        
                        <div class="col-12 col-sm-6 col-md-3 mb-4">
                            <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Requested By</div>
                            <div class="border-bottom mx-auto position-relative image-container"
                                style="height: 100px; width: 120px; border-color: #333 !important;">
                                <?php $s1 = $sign(1); ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($s1): ?>
                                    <?php
                                        $qrText1 =
                                            'PR: ' .
                                            ($pr->pr_number ?? 'DRAFT') .
                                            "\nSubmitted By: " .
                                            ($s1->user->name ?? '-') .
                                            "\nRole: APPLICANT\nDate: " .
                                            $s1->created_at->format('d/m/Y H:i');
                                    ?>
                                    <div class="pt-2">
                                        <img src="<?php echo e($this->getQr($qrText1)); ?>" class="signature-img"
                                            style="height: 80px; width: 80px; object-fit: contain; display: block; margin: 0 auto;">
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canCancelSubmit): ?>
                                    <button type="button"
                                        class="btn btn-outline-danger btn-xs position-absolute top-50 start-50 translate-middle no-print-btn openCancelAction"
                                        data-action="cancelSubmit" data-bs-toggle="modal"
                                        data-bs-target="#modalCancelAction"
                                        data-html2canvas-ignore="true">Cancel</button>
                                <?php elseif($canSubmit): ?>
                                    <div class="d-flex justify-content-center no-print-btn mt-3"
                                        data-html2canvas-ignore="true">
                                        <button type="button" data-action="submit"
                                            class="btn btn-outline-primary btn-xs px-3 fw-bold approveSign">SUBMIT</button>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="mt-2 fw-bold small <?php echo e($s1 ? 'text-uppercase' : ''); ?>"
                                style="font-size: 14px;"><?php echo e($s1?->user?->name ?? 'User'); ?></div>
                        </div>

                        
                        <div class="col-12 col-sm-6 col-md-3 mb-4">
                            <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Verified By</div>
                            <div class="border-bottom mx-auto position-relative image-container"
                                style="height: 100px; width: 120px; border-color: #333 !important;">
                                <?php $s2 = $sign(2); ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($s2): ?>
                                    <?php
                                        $qrText2 =
                                            'PR: ' .
                                            ($pr->pr_number ?? 'DRAFT') .
                                            "\nVerified By: " .
                                            ($s2->user->name ?? '-') .
                                            "\nRole: DEPARTMENT HEAD\nDate: " .
                                            $s2->created_at->format('d/m/Y H:i');
                                    ?>
                                    <div class="pt-2">
                                        <img src="<?php echo e($this->getQr($qrText2)); ?>" class="signature-img"
                                            style="height: 80px; width: 80px; object-fit: contain; display: block; margin: 0 auto;">
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status == 2 && $canCancelApprove): ?>
                                    <button type="button"
                                        class="btn btn-outline-danger btn-xs position-absolute top-50 start-50 translate-middle no-print-btn openCancelAction"
                                        data-action="cancelApproval" data-bs-toggle="modal"
                                        data-bs-target="#modalCancelAction"
                                        data-html2canvas-ignore="true">Cancel</button>
                                <?php elseif($status == 1 && $canApprove): ?>
                                    <div class="d-flex flex-row justify-content-center gap-1 pt-4 no-print-btn"
                                        data-html2canvas-ignore="true">
                                        <button type="button"
                                            class="btn btn-success btn-icon btn-sm rounded-circle approveSign"
                                            data-role="dept" data-action="approve" title="Approve"><i
                                                class="ti ti-check fs-6"></i></button>
                                        <button type="button"
                                            class="btn btn-danger btn-icon btn-sm rounded-circle approveSign"
                                            data-role="dept" data-action="reject" title="Reject"><i
                                                class="ti ti-x fs-6"></i></button>
                                        <button type="button"
                                            class="btn btn-warning btn-icon btn-sm rounded-circle approveSign"
                                            data-role="dept" data-action="revision" title="Revision"><i
                                                class="ti ti-refresh fs-6"></i></button>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="mt-2 fw-bold small <?php echo e($s2 ? 'text-uppercase' : ''); ?>"
                                style="font-size: 14px;"><?php echo e($s2?->user?->name ?? 'Department Head'); ?></div>
                        </div>

                        
                        <div class="col-12 col-sm-6 col-md-3 mb-4">
                            <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Approved By</div>
                            <div class="border-bottom mx-auto position-relative image-container"
                                style="height: 100px; width: 120px; border-color: #333 !important;">
                                <?php
                                    $dirStatus = $pr->id_doc_type == 1 ? 3 : 4;
                                    $s3 = $sign($dirStatus);
                                ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($s3): ?>
                                    <?php
                                        $qrText3 =
                                            'PR: ' .
                                            ($pr->pr_number ?? 'DRAFT') .
                                            "\nApproved By: " .
                                            ($s3->user->name ?? '-') .
                                            "\nRole: DIRECTOR\nDate: " .
                                            $s3->created_at->format('d/m/Y H:i');
                                    ?>
                                    <div class="pt-2">
                                        <img src="<?php echo e($this->getQr($qrText3)); ?>" class="signature-img"
                                            style="height: 80px; width: 80px; object-fit: contain; display: block; margin: 0 auto;">
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status == $dirStatus && $canCancelApprove): ?>
                                    <button type="button"
                                        class="btn btn-outline-danger btn-xs position-absolute top-50 start-50 translate-middle no-print-btn openCancelAction"
                                        data-action="cancelApproval" data-bs-toggle="modal"
                                        data-bs-target="#modalCancelAction"
                                        data-html2canvas-ignore="true">Cancel</button>
                                <?php elseif($status == 2 && $canApprove): ?>
                                    <div class="d-flex flex-row justify-content-center gap-1 pt-4 no-print-btn"
                                        data-html2canvas-ignore="true">
                                        <button type="button"
                                            class="btn btn-success btn-icon btn-sm rounded-circle approveSign"
                                            data-role="director" data-action="approve" title="Approve"><i
                                                class="ti ti-check fs-6"></i></button>
                                        <button type="button"
                                            class="btn btn-danger btn-icon btn-sm rounded-circle approveSign"
                                            data-role="director" data-action="reject" title="Reject"><i
                                                class="ti ti-x fs-6"></i></button>
                                        <button type="button"
                                            class="btn btn-warning btn-icon btn-sm rounded-circle approveSign"
                                            data-role="director" data-action="revision" title="Revision"><i
                                                class="ti ti-refresh fs-6"></i></button>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="mt-2 fw-bold small <?php echo e($s3 ? 'text-uppercase' : ''); ?>"
                                style="font-size: 14px;"><?php echo e($s3?->user?->name ?? 'Director'); ?></div>
                        </div>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($pr->id_doc_type, [1, 3])): ?>
                            <div class="col-12 col-sm-6 col-md-3 mb-4">
                                <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Checked By
                                </div>
                                <div class="border-bottom mx-auto position-relative image-container"
                                    style="height: 100px; width: 120px; border-color: #333 !important;">
                                    <?php $s4 = $sign(4); ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($s4): ?>
                                        <?php
                                            $qrText4 =
                                                'PR: ' .
                                                ($pr->pr_number ?? 'DRAFT') .
                                                "\nChecked By: " .
                                                ($s4->user->name ?? '-') .
                                                "\nRole: ACCOUNTING\nDate: " .
                                                $s4->created_at->format('d/m/Y H:i');
                                        ?>
                                        <div class="pt-2">
                                            <img src="<?php echo e($this->getQr($qrText4)); ?>" class="signature-img"
                                                style="height: 80px; width: 80px; object-fit: contain; display: block; margin: 0 auto;">
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status == 4 && $canCancelApprove): ?>
                                        <button type="button"
                                            class="btn btn-outline-danger btn-xs position-absolute top-50 start-50 translate-middle no-print-btn openCancelAction"
                                            data-action="cancelApproval" data-bs-toggle="modal"
                                            data-bs-target="#modalCancelAction"
                                            data-html2canvas-ignore="true">Cancel</button>
                                    <?php elseif($status == 3 && $canApprove): ?>
                                        <div class="d-flex flex-row justify-content-center gap-1 pt-4 no-print-btn"
                                            data-html2canvas-ignore="true">
                                            <button type="button"
                                                class="btn btn-success btn-icon btn-sm rounded-circle approveSign"
                                                data-role="accounting" data-action="approve" title="Approve"><i
                                                    class="ti ti-check fs-6"></i></button>
                                            <button type="button"
                                                class="btn btn-danger btn-icon btn-sm rounded-circle approveSign"
                                                data-role="accounting" data-action="reject" title="Reject"><i
                                                    class="ti ti-x fs-6"></i></button>
                                            <button type="button"
                                                class="btn btn-warning btn-icon btn-sm rounded-circle approveSign"
                                                data-role="accounting" data-action="revision" title="Revision"><i
                                                    class="ti ti-refresh fs-6"></i></button>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="mt-2 fw-bold small <?php echo e($s4 ? 'text-uppercase' : ''); ?>"
                                    style="font-size: 14px;"><?php echo e($s4?->user?->name ?? 'Accounting'); ?></div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="alert alert-light border text-center fw-bold py-1 my-2 text-uppercase"
                    style="font-size: 11px; letter-spacing: 1px; color: #555;">PAYMENT PROCESSING</div>
                <div class="container mt-3 text-center">
                    <div class="row text-uppercase fw-bold" style="color: #002b00;">
                        <div class="row d-flex justify-content-center flex-wrap text-center">

                            
                            <div class="col-12 col-sm-6 col-md-4 mb-4">
                                <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Prepared By
                                </div>
                                <div class="border-bottom mx-auto position-relative image-container"
                                    style="height: 100px; width: 120px; border-color: #333 !important;">
                                    <?php $s5 = $sign(5); ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($s5): ?>
                                        <?php
                                            $qrText5 =
                                                'PR: ' .
                                                ($pr->pr_number ?? 'DRAFT') .
                                                "\nPrepared By: " .
                                                ($s5->user->name ?? '-') .
                                                "\nRole: FINANCE STAFF\nDate: " .
                                                $s5->created_at->format('d/m/Y H:i');
                                        ?>
                                        <div class="pt-2">
                                            <img src="<?php echo e($this->getQr($qrText5)); ?>" class="signature-img"
                                                style="height: 80px; width: 80px; object-fit: contain; display: block; margin: 0 auto;">
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status == 5 && $canCancelApprove): ?>
                                        <button type="button"
                                            class="btn btn-outline-danger btn-xs position-absolute top-50 start-50 translate-middle no-print-btn openCancelAction"
                                            data-action="cancelApproval" data-bs-toggle="modal"
                                            data-bs-target="#modalCancelAction"
                                            data-html2canvas-ignore="true">Cancel</button>
                                    <?php elseif($status == 4 && $canApprove): ?>
                                        <div class="d-flex flex-row justify-content-center gap-1 pt-4 no-print-btn"
                                            data-html2canvas-ignore="true">
                                            <button type="button"
                                                class="btn btn-success btn-icon btn-sm rounded-circle approveSign"
                                                data-role="finance" data-action="approve" title="Approve"><i
                                                    class="ti ti-check fs-6"></i></button>
                                            <button type="button"
                                                class="btn btn-danger btn-icon btn-sm rounded-circle approveSign"
                                                data-role="finance" data-action="reject" title="Reject"><i
                                                    class="ti ti-x fs-6"></i></button>
                                            <button type="button"
                                                class="btn btn-warning btn-icon btn-sm rounded-circle approveSign"
                                                data-role="finance" data-action="revision" title="Revision"><i
                                                    class="ti ti-refresh fs-6"></i></button>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="mt-2 fw-bold small <?php echo e($s5 ? 'text-uppercase' : ''); ?>"
                                    style="font-size: 14px;"><?php echo e($s5?->user?->name ?? 'Finance Staff'); ?></div>
                            </div>

                            
                            <div class="col-12 col-sm-6 col-md-4 mb-4">
                                <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Verified By
                                </div>
                                <div class="border-bottom mx-auto position-relative image-container"
                                    style="height: 100px; width: 120px; border-color: #333 !important;">
                                    <?php $s6 = $sign(6); ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($s6): ?>
                                        <?php
                                            $qrText6 =
                                                'PR: ' .
                                                ($pr->pr_number ?? 'DRAFT') .
                                                "\nVerified By: " .
                                                ($s6->user->name ?? '-') .
                                                "\nRole: FINANCE SUPERVISOR\nDate: " .
                                                $s6->created_at->format('d/m/Y H:i');
                                        ?>
                                        <div class="pt-2">
                                            <img src="<?php echo e($this->getQr($qrText6)); ?>" class="signature-img"
                                                style="height: 80px; width: 80px; object-fit: contain; display: block; margin: 0 auto;">
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status == 6 && $canCancelApprove): ?>
                                        <button type="button"
                                            class="btn btn-outline-danger btn-xs position-absolute top-50 start-50 translate-middle no-print-btn openCancelAction"
                                            data-action="cancelApproval" data-bs-toggle="modal"
                                            data-bs-target="#modalCancelAction"
                                            data-html2canvas-ignore="true">Cancel</button>
                                    <?php elseif($status == 5 && $canApprove): ?>
                                        <div class="d-flex flex-row justify-content-center gap-1 pt-4 no-print-btn"
                                            data-html2canvas-ignore="true">
                                            <button type="button"
                                                class="btn btn-success btn-icon btn-sm rounded-circle approveSign"
                                                data-role="spvfinance" data-action="approve" title="Approve"><i
                                                    class="ti ti-check fs-6"></i></button>
                                            <button type="button"
                                                class="btn btn-danger btn-icon btn-sm rounded-circle approveSign"
                                                data-role="spvfinance" data-action="reject" title="Reject"><i
                                                    class="ti ti-x fs-6"></i></button>
                                            <button type="button"
                                                class="btn btn-warning btn-icon btn-sm rounded-circle approveSign"
                                                data-role="spvfinance" data-action="revision" title="Revision"><i
                                                    class="ti ti-refresh fs-6"></i></button>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="mt-2 fw-bold small <?php echo e($s6 ? 'text-uppercase' : ''); ?>"
                                    style="font-size: 14px;"><?php echo e($s6?->user?->name ?? 'Finance Supervisor'); ?></div>
                            </div>

                            
                            <div class="col-12 col-sm-6 col-md-4 mb-4">
                                <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Authorized By
                                </div>
                                <div class="border-bottom mx-auto position-relative image-container"
                                    style="height: 100px; width: 120px; border-color: #333 !important;">
                                    <?php $s7 = $sign(7); ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($s7): ?>
                                        <?php
                                            $qrText7 =
                                                'PR: ' .
                                                ($pr->pr_number ?? 'DRAFT') .
                                                "\nAuthorized By: " .
                                                ($s7->user->name ?? '-') .
                                                "\nRole: CHIEF FINANCE OFFICER\nDate: " .
                                                $s7->created_at->format('d/m/Y H:i');
                                        ?>
                                        <div class="pt-2">
                                            <img src="<?php echo e($this->getQr($qrText7)); ?>" class="signature-img"
                                                style="height: 80px; width: 80px; object-fit: contain; display: block; margin: 0 auto;">
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status == 7 && $canCancelApprove): ?>
                                        <button type="button"
                                            class="btn btn-outline-danger btn-xs position-absolute top-50 start-50 translate-middle no-print-btn openCancelAction"
                                            data-action="cancelApproval" data-bs-toggle="modal"
                                            data-bs-target="#modalCancelAction"
                                            data-html2canvas-ignore="true">Cancel</button>
                                    <?php elseif($status == 6 && $canApprove): ?>
                                        <div class="d-flex flex-row justify-content-center gap-1 pt-4 no-print-btn"
                                            data-html2canvas-ignore="true">
                                            <button type="button"
                                                class="btn btn-success btn-icon btn-sm rounded-circle approveSign"
                                                data-role="cfo" data-action="approve" title="Approve"><i
                                                    class="ti ti-check fs-6"></i></button>
                                            <button type="button"
                                                class="btn btn-danger btn-icon btn-sm rounded-circle approveSign"
                                                data-role="cfo" data-action="reject" title="Reject"><i
                                                    class="ti ti-x fs-6"></i></button>
                                            <button type="button"
                                                class="btn btn-warning btn-icon btn-sm rounded-circle approveSign"
                                                data-role="cfo" data-action="revision" title="Revision"><i
                                                    class="ti ti-refresh fs-6"></i></button>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="mt-2 fw-bold small <?php echo e($s7 ? 'text-uppercase' : ''); ?>"
                                    style="font-size: 14px;"><?php echo e($s7?->user?->name ?? 'Chief Finance Officer'); ?></div>
                            </div>

                        </div>
                    </div>
                </div>

                
                <div class="modal fade" id="modalApprove" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalApproveTitle">Approval Action</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div id="approveBox" class="mb-3 d-none">
                                    <label class="form-label fw-bold">Approval Note (Optional)</label>
                                    <textarea class="form-control" id="approve_reason" rows="3" placeholder="Enter note here..."></textarea>
                                </div>
                                <div id="revisionBox" class="d-none mb-3">
                                    <label class="form-label fw-bold">Revision Reason <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control border-warning" id="revision_reason" rows="3"
                                        placeholder="Explain what needs to be fixed..."></textarea>
                                </div>
                                <div id="rejectBox" class="d-none mb-3">
                                    <label class="form-label fw-bold">Reject Reason <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control border-danger" id="reject_reason" rows="3"
                                        placeholder="Explain why it's rejected..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" id="btnApprove" class="btn btn-success d-none">Confirm
                                    Approve</button>
                                <button type="button" id="btnSubmitPrConfirm" class="btn btn-primary d-none">Confirm
                                    Submit PR</button>
                                <button type="button" id="btnSubmitRevision" class="btn btn-warning d-none">Send for
                                    Revision</button>
                                <button type="button" id="btnSubmitReject" class="btn btn-danger d-none">Confirm
                                    Reject</button>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="modal fade" id="modalCancelAction" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content text-center">
                            <div class="modal-header justify-content-center">
                                <h5 class="modal-title text-danger">CANCEL ACTION</h5>
                            </div>
                            <div class="modal-body">
                                <p class="mb-0">Are you sure you want to <b>cancel/undo</b> this action?</p>
                            </div>
                            <div class="modal-footer justify-content-center gap-2">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" id="btnConfirmCancel">Yes,
                                    Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($status, [12, 13])): ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div style="text-decoration: underline;">Reject or Revision</div>
                    </div>
                    <div class="table-responsive dt-responsive">
                        <table class="table table-striped table-bordered nowrap">
                            <thead class="text-center" style="background-color: green; color:white;">
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Reject/Revision By</th>
                                    <th>Reject/Revision Reason</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pr->signTransactions->whereIn('status', [12, 13]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($no++); ?></td>
                                        <td><?php echo e($t->status == 12 ? 'Revision' : 'Rejected'); ?></td>
                                        <td><?php echo e($t->user->name ?? '-'); ?></td>
                                        <td><?php echo e($t->reject_reason); ?></td>
                                        <td class="text-center"><?php echo e($t->created_at?->format('d F Y')); ?></td>
                                    </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php $dirReason = $pr->signTransactions->whereNotNull('director_reason')->first(); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dirReason && in_array($status, [3, 4, 5, 6, 7, 8, 9, 10, 11, 12])): ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div style="text-decoration: underline;">Director Reason</div>
                    </div>
                    <div class="table-responsive dt-responsive">
                        <table class="table table-striped table-bordered nowrap">
                            <thead class="text-center" style="background-color: green; color:white;">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Director Reason</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pr->signTransactions->whereNotNull('director_reason'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($idx + 1); ?></td>
                                        <td><?php echo e($t->user->name ?? '-'); ?></td>
                                        <td><?php echo e($t->director_reason); ?></td>
                                        <td class="text-center"><?php echo e($t->created_at?->format('d F Y')); ?></td>
                                    </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
[$__name, $__params] = $__split('payment-requests.form-detail-modal', ['prId' => $prId]);

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3285853303-0', $key);

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
[$__name, $__params] = $__split('payment-requests.payment-modal');

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3285853303-1', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

    <?php $__env->startPush('scripts'); ?>
        <script>
            let currentRole = '';
            let cancelAction = '';

            // Initialize Bootstrap Modal
            const approveModal = new bootstrap.Modal(document.getElementById('modalApprove'));

            // Reset Appove Modal helper
            function resetApproveModal() {
                document.getElementById('modalApproveTitle').innerText = 'Approval Action';
                ['approveBox', 'revisionBox', 'rejectBox', 'btnApprove', 'btnSubmitPrConfirm', 'btnSubmitRevision',
                    'btnSubmitReject'
                ].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.classList.add('d-none');
                });
                document.getElementById('approve_reason').value = '';
                document.getElementById('revision_reason').value = '';
                document.getElementById('reject_reason').value = '';
            }

            // Form Validation & Loading States for Attachments
            // No direct form references here, using event delegation instead

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

            document.addEventListener('submit', async function(e) {
                if (e.target.id === 'formAddAttachment' || e.target.id === 'formEditAttachment') {
                    e.preventDefault();
                    const form = e.target;
                    const suffix = form.id === 'formAddAttachment' ? 'add' : 'edit';
                    const hasCaptured = capturedPhotos[suffix].length > 0;
                    const files = form.querySelector('input[type="file"]').files;
                    const submitBtn = document.getElementById(suffix === 'add' ? 'btnUploadAdd' : 'btnUploadEdit');

                    if (hasCaptured) {
                        const success = await processCapturedPhotos(suffix);
                        if (!success) return; // null means compression failed (alert already shown)
                    } else if (files.length > 0) {
                        const validation = validateFile(files);
                        if (!validation.valid) {
                            window.dispatchEvent(new CustomEvent('alert', {
                                detail: {
                                    type: 'warning',
                                    title: 'Validation Error',
                                    message: validation.message
                                }
                            }));
                            return;
                        }
                    } else if (suffix === 'add') {
                        window.dispatchEvent(new CustomEvent('alert', {
                            detail: {
                                type: 'warning',
                                title: 'Validation Error',
                                message: 'Silakan pilih file atau ambil foto.'
                            }
                        }));
                        return;
                    }

                    if (submitBtn) setBtnLoading(submitBtn);
                    form.submit();
                }
            });

            // Camera & Preview Logic
            let activeStream = null;
            let capturedPhotos = {
                add: [],
                edit: []
            };

            function stopActiveCamera() {
                if (activeStream) {
                    activeStream.getTracks().forEach(track => track.stop());
                    activeStream = null;
                }
            }

            function handleTakePhoto(suffix) {
                const video = document.getElementById('video_' + suffix);
                const canvas = document.getElementById('canvas_' + suffix);
                const startBtn = document.getElementById('start-camera-' + suffix);
                const takeBtn = document.getElementById('take-photo-' + suffix);

                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);

                const data = canvas.toDataURL('image/jpeg', 0.8);
                capturedPhotos[suffix].push(data);

                updateGalleryUI(suffix);

                startBtn.classList.remove('d-none');
                startBtn.innerHTML = '<i class="ti ti-camera me-1"></i> Add Another Photo';
            }

            function updateGalleryUI(suffix) {
                const list = document.getElementById(suffix + '_gallery_list');
                const cont = document.getElementById(suffix + '_gallery_container');
                list.innerHTML = '';

                if (capturedPhotos[suffix].length === 0) {
                    cont.classList.add('d-none');
                    return;
                }

                capturedPhotos[suffix].forEach((photo, index) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'position-relative';
                    wrapper.style.width = '80px';
                    wrapper.style.height = '80px';

                    wrapper.innerHTML = `
                <img src="${photo}" class="img-fluid rounded w-100 h-100 object-fit-cover border">
                <button type="button" class="btn btn-danger btn-sm rounded-circle position-absolute top-0 end-0 p-0 d-flex align-items-center justify-content-center"
                        style="width:20px; height:20px; font-size:10px;" onclick="removeCapturedPhoto('${suffix}', ${index})">
                    <i class="ti ti-x"></i>
                </button>
            `;
                    list.appendChild(wrapper);
                });
                cont.classList.remove('d-none');
            }

            window.removeCapturedPhoto = function(suffix, index) {
                capturedPhotos[suffix].splice(index, 1);
                updateGalleryUI(suffix);
            };

            /**
             * Merge images to PDF with compression to stay under 5MB
             */
            async function processCapturedPhotos(suffix) {
                const photos = capturedPhotos[suffix];
                if (photos.length === 0) return null;

                const mimeInput = document.getElementById('captured_photo_mime_' + suffix);
                const dataInput = document.getElementById('captured_photo_' + suffix);

                // Single photo -> stay as image (JPEG/PNG)
                if (photos.length === 1) {
                    const singleData = photos[0]; // data:image/jpeg;base64,...
                    const commaIdx = singleData.indexOf(',');
                    const headerPart = singleData.substring(0, commaIdx); // data:image/jpeg;base64
                    const rawBase64 = singleData.substring(commaIdx + 1);
                    // Extract mime type from header
                    const mimeMatch = headerPart.match(/^data:([^;]+)/);
                    mimeInput.value = mimeMatch ? mimeMatch[1] : 'image/jpeg';
                    dataInput.value = rawBase64;
                    return true;
                }

                // Multiple photos -> merge to PDF
                const {
                    jsPDF
                } = window.jspdf;
                const maxSize = 5 * 1024 * 1024; // 5MB

                let quality = 0.8;
                let pdfBase64 = null;
                let fileSize = 0;

                while (quality > 0.05) {
                    const doc = new jsPDF();
                    for (let i = 0; i < photos.length; i++) {
                        if (i > 0) doc.addPage();
                        const img = photos[i];
                        const imgProps = doc.getImageProperties(img);
                        const pdfWidth = doc.internal.pageSize.getWidth();
                        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                        doc.addImage(img, 'JPEG', 0, 0, pdfWidth, pdfHeight, undefined, 'FAST');
                    }

                    // Get raw base64 only (no data URI prefix)
                    pdfBase64 = doc.output('datauristring').split(',')[1];
                    fileSize = (pdfBase64.length * 3) / 4;

                    if (fileSize <= maxSize) {
                        mimeInput.value = 'application/pdf';
                        dataInput.value = pdfBase64;
                        return true;
                    }
                    quality -= 0.15;
                }

                // If even at 0.05 it's still > 5MB
                window.dispatchEvent(new CustomEvent('alert', {
                    detail: {
                        type: 'danger',
                        title: 'File Too Large',
                        message: 'Total file terlalu besar (>5MB) dan tidak bisa di-compress lagi. Silakan hapus beberapa foto.'
                    }
                }));
                return null;
            }

            function handleFilePreview(input, suffix) {
                const previewCont = document.getElementById(suffix + '_preview_container');
                const previewImg = document.getElementById(suffix + '_preview_img');
                const previewPdf = document.getElementById(suffix + '_preview_pdf');
                const pdfName = document.getElementById(suffix + '_pdf_name');
                const hiddenInput = document.getElementById('captured_photo_' + suffix);
                const galleryCont = document.getElementById(suffix + '_gallery_container');

                // Clear camera data if switching to upload
                capturedPhotos[suffix] = [];
                updateGalleryUI(suffix);
                hiddenInput.value = '';

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const reader = new FileReader();

                    if (file.type.startsWith('image/')) {
                        reader.onload = function(e) {
                            previewImg.src = e.target.result;
                            previewImg.classList.remove('d-none');
                            previewPdf.classList.add('d-none');
                            previewCont.classList.remove('d-none');
                        }
                        reader.readAsDataURL(file);
                    } else if (file.type === 'application/pdf') {
                        pdfName.textContent = file.name;
                        previewImg.classList.add('d-none');
                        previewPdf.classList.remove('d-none');
                        previewCont.classList.remove('d-none');
                    } else {
                        previewCont.classList.add('d-none');
                    }
                } else {
                    previewCont.classList.add('d-none');
                }
            }

            document.addEventListener('change', function(e) {
                // Upload Mode Toggles
                if (e.target.name === 'add_upload_mode') {
                    const isCamera = e.target.value === 'camera';
                    document.getElementById('add_upload_container').classList.toggle('d-none', isCamera);
                    document.getElementById('add_camera_container').classList.toggle('d-none', !isCamera);
                    const input = document.getElementById('input_add_file');
                    if (isCamera) {
                        input.value = '';
                        document.getElementById('input_add_file').required = false;
                    } else {
                        stopActiveCamera();
                        document.getElementById('video_add').classList.add('d-none');
                        document.getElementById('start-camera-add').classList.remove('d-none');
                        document.getElementById('take-photo-add').classList.add('d-none');
                        document.getElementById('input_add_file').required = true;
                        handleFilePreview(input, 'add');
                    }
                }
                if (e.target.name === 'edit_upload_mode') {
                    const isCamera = e.target.value === 'camera';
                    document.getElementById('edit_upload_container').classList.toggle('d-none', isCamera);
                    document.getElementById('edit_camera_container').classList.toggle('d-none', !isCamera);
                    if (isCamera) {
                        document.getElementById('input_edit_file').value = '';
                    } else {
                        stopActiveCamera();
                        document.getElementById('video_edit').classList.add('d-none');
                        document.getElementById('start-camera-edit').classList.remove('d-none');
                        document.getElementById('take-photo-edit').classList.add('d-none');
                        handleFilePreview(document.getElementById('input_edit_file'), 'edit');
                    }
                }

                // File Inputs
                if (e.target.id === 'input_add_file') handleFilePreview(e.target, 'add');
                if (e.target.id === 'input_edit_file') handleFilePreview(e.target, 'edit');
            });

            document.addEventListener('click', function(e) {
                if (e.target.id === 'start-camera-add') handleStartCamera('add');
                if (e.target.id === 'take-photo-add') handleTakePhoto('add');
                if (e.target.id === 'start-camera-edit') handleStartCamera('edit');
                if (e.target.id === 'take-photo-edit') handleTakePhoto('edit');
            });

            async function handleStartCamera(suffix) {
                const video = document.getElementById('video_' + suffix);
                const startBtn = document.getElementById('start-camera-' + suffix);
                const takeBtn = document.getElementById('take-photo-' + suffix);
                const previewCont = document.getElementById(suffix + '_preview_container');
                const galleryCont = document.getElementById(suffix + '_gallery_container');

                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    alert("Camera access not available.");
                    return;
                }

                try {
                    stopActiveCamera();
                    activeStream = await navigator.mediaDevices.getUserMedia({
                        video: true,
                        audio: false
                    });
                    video.srcObject = activeStream;
                    video.classList.remove('d-none');
                    startBtn.classList.add('d-none');
                    takeBtn.classList.remove('d-none');
                    previewCont.classList.add('d-none');
                    galleryCont.classList.add('d-none');
                } catch (err) {
                    alert("Error accessing camera: " + err.message);
                }
            }

            // Cleanup camera when modals close
            ['modalAddAttachment', 'modalEditAttachment'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('hidden.bs.modal', function() {
                        stopActiveCamera();
                        // Reset UI if needed
                        const suffix = id === 'modalAddAttachment' ? 'add' : 'edit';
                        capturedPhotos[suffix] = [];
                        updateGalleryUI(suffix);
                        document.getElementById(suffix + '_preview_container').classList.add('d-none');
                        document.getElementById('captured_photo_' + suffix).value = '';

                        if (suffix === 'add') {
                            document.getElementById('addModeUpload').checked = true;
                            document.getElementById('add_upload_container').classList.remove('d-none');
                            document.getElementById('add_camera_container').classList.add('d-none');
                            document.getElementById('start-camera-add').innerHTML =
                                '<i class="ti ti-video me-1"></i> Start Camera';
                            document.getElementById('start-camera-add').classList.remove('d-none');
                        } else {
                            document.getElementById('editModeUpload').checked = true;
                            document.getElementById('edit_upload_container').classList.remove('d-none');
                            document.getElementById('edit_camera_container').classList.add('d-none');
                            document.getElementById('start-camera-edit').innerHTML =
                                '<i class="ti ti-video me-1"></i> Start Camera';
                            document.getElementById('start-camera-edit').classList.remove('d-none');
                        }
                    });
                }
            });

            // Open Approval Modal handler
            window.openApprovalModal = function(action, role = '') {
                resetApproveModal();
                currentRole = role;

                if (action === 'submit') {
                    document.getElementById('modalApproveTitle').innerText = 'Submit PR';
                    document.getElementById('approveBox').classList.remove('d-none');
                    document.getElementById('btnSubmitPrConfirm').classList.remove('d-none');
                } else if (action === 'approve') {
                    document.getElementById('modalApproveTitle').innerText = 'Approve PR';
                    document.getElementById('approveBox').classList.remove('d-none');
                    document.getElementById('btnApprove').classList.remove('d-none');
                } else if (action === 'revision') {
                    document.getElementById('modalApproveTitle').innerText = 'Request Revision';
                    document.getElementById('revisionBox').classList.remove('d-none');
                    document.getElementById('btnSubmitRevision').classList.remove('d-none');
                } else if (action === 'reject') {
                    document.getElementById('modalApproveTitle').innerText = 'Reject PR';
                    document.getElementById('rejectBox').classList.remove('d-none');
                    document.getElementById('btnSubmitReject').classList.remove('d-none');
                }

                approveModal.show();
            };

            // Use Event Delegation for persistent listeners (teleport/refreshes)
            document.addEventListener('click', function(e) {
                const approveBtn = e.target.closest('.approveSign');
                if (approveBtn) {
                    e.preventDefault();
                    const action = approveBtn.dataset.action || 'approve';
                    const role = approveBtn.dataset.role || '';
                    window.openApprovalModal(action, role);
                    return;
                }

                const cancelBtn = e.target.closest('.openCancelAction');
                if (cancelBtn) {
                    cancelAction = cancelBtn.dataset.action || 'cancelApproval';
                    // Trigger modal show is handled by data-bs-toggle, but we capture the action here
                }
            });

            // Confirm actions
            document.getElementById('btnSubmitPrConfirm')?.addEventListener('click', function() {
                const note = document.getElementById('approve_reason').value;
                approveModal.hide();
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').submitPr(note);
            });

            document.getElementById('btnApprove')?.addEventListener('click', function() {
                const note = document.getElementById('approve_reason').value;
                approveModal.hide();
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').processSign('approve', currentRole, note);
            });

            document.getElementById('btnSubmitRevision')?.addEventListener('click', function() {
                const reason = document.getElementById('revision_reason').value;
                if (!reason.trim()) {
                    window.dispatchEvent(new CustomEvent('alert', {
                        detail: {
                            type: 'warning',
                            title: 'Perhatian',
                            message: 'Alasan revisi wajib diisi.'
                        }
                    }));
                    return;
                }
                approveModal.hide();
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').processSign('revision', currentRole, reason);
            });

            document.getElementById('btnSubmitReject')?.addEventListener('click', function() {
                const reason = document.getElementById('reject_reason').value;
                if (!reason.trim()) {
                    window.dispatchEvent(new CustomEvent('alert', {
                        detail: {
                            type: 'warning',
                            title: 'Perhatian',
                            message: 'Alasan penolakan wajib diisi.'
                        }
                    }));
                    return;
                }
                approveModal.hide();
                window.Livewire.find('<?php echo e($_instance->getId()); ?>').processSign('reject', currentRole, reason);
            });
            document.getElementById('btnConfirmCancel')?.addEventListener('click', function() {
                bootstrap.Modal.getInstance(document.getElementById('modalCancelAction'))?.hide();
                if (cancelAction === 'cancelSubmit') {
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').cancelSubmit();
                } else {
                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').cancelApproval();
                }
            });

            // Preview attachment
            window.openPreview = function(url, attachment, note, deleteUrl, updateUrl, catId, canEdit) {
                document.getElementById('previewNote').textContent = note;
                document.getElementById('previewAttachment').textContent = attachment;
                const body = document.getElementById('previewBody');
                body.innerHTML = '<div class="spinner-border text-primary mt-5" role="status"></div>';

                const lower = url.toLowerCase().split('?')[0];
                const isPdf = lower.endsWith('.pdf') || url.startsWith('data:application/pdf');

                if (isPdf) {
                    body.innerHTML = `<iframe src="${url}" style="width:100%;height:75vh;" frameborder="0"></iframe>`;
                } else {
                    body.innerHTML =
                        `<img src="${url}" style="max-width:100%;max-height:75vh;object-fit:contain;" class="d-block mx-auto border shadow-sm rounded">`;
                }

                document.getElementById('downloadBtn').href = url;

                const editBtn = document.getElementById('editBtn');
                const deleteBtn = document.getElementById('deleteBtn');

                if (canEdit === true || canEdit === "true") {
                    editBtn.style.display = 'inline-block';
                    deleteBtn.style.display = 'inline-block';

                    editBtn.onclick = function() {
                        const modalPreview = bootstrap.Modal.getInstance(document.getElementById('previewModal'));
                        if (modalPreview) modalPreview.hide();

                        document.getElementById('formEditAttachment').action = updateUrl;
                        document.getElementById('edit_note').value = note;
                        document.getElementById('edit_id_attachment').value = catId;

                        const modalEdit = new bootstrap.Modal(document.getElementById('modalEditAttachment'));
                        modalEdit.show();
                    };

                    deleteBtn.onclick = function() {
                        window.showConfirm({
                            title: 'Hapus Attachment',
                            message: 'Apakah Anda yakin ingin menghapus attachment ini?',
                            type: 'danger',
                            btnText: 'Ya, Hapus',
                            onConfirm: () => {
                                window.location.href = deleteUrl;
                            }
                        });
                    };
                } else {
                    editBtn.style.display = 'none';
                    deleteBtn.style.display = 'none';
                }

                const myModal = new bootstrap.Modal(document.getElementById('previewModal'));
                myModal.show();
            };

            window.previewAttachment = function(el) {
                const url = el.dataset.url;
                const type = el.dataset.type;
                const note = el.dataset.note;
                const deleteUrl = el.dataset.delete;
                const updateUrl = el.dataset.update;
                const catId = el.dataset.catid;
                const canEdit = el.dataset.canEdit;
                window.openPreview(url, type, note, deleteUrl, updateUrl, catId, canEdit);
            };

            // Payment modal listener
            window.addEventListener('show-payment-modal', () => {
                new bootstrap.Modal(document.getElementById('prPaymentModal')).show();
            });

            // LOAN SELECT2 Binding
            document.addEventListener('livewire:initialized', () => {
                let loanModal = document.getElementById('modalLoan');
                let loanSelect = $('#loanSelect');

                if (loanModal) {
                    loanModal.addEventListener('shown.bs.modal', function() {
                        loanSelect.select2({
                            dropdownParent: $('#modalLoan')
                        });

                        let currentLoan = window.Livewire.find('<?php echo e($_instance->getId()); ?>').get('id_loan');
                        if (currentLoan) {
                            loanSelect.val(currentLoan).trigger('change');
                        }
                    });

                    loanSelect.on('change', function(e) {
                        window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('id_loan', e.target.value, false);
                    });
                }

                window.Livewire.find('<?php echo e($_instance->getId()); ?>').on('close-modal-loan', () => {
                    let modalEl = document.getElementById('modalLoan');
                    let modalInstance = bootstrap.Modal.getInstance(modalEl);
                    if (modalInstance) {
                        modalInstance.hide();
                    } else {
                        $('#modalLoan').modal('hide');
                    }
                });
            });

            window.addEventListener('hide-payment-modal', () => {
                bootstrap.Modal.getInstance(document.getElementById('prPaymentModal'))?.hide();
            });

            window.downloadPDF = function() {
                const element = document.getElementById('print-area');
                const noPrint = document.querySelectorAll('.no-print-btn, [data-html2canvas-ignore="true"]');
                const btnDownload = document.getElementById('btnDownloadPDF');
                const btnNormal = document.getElementById('btnDownloadNormal');
                const btnLoading = document.getElementById('btnDownloadLoading');

                btnDownload.disabled = true;
                btnNormal.classList.add('d-none');
                btnLoading.classList.remove('d-none');

                noPrint.forEach(b => b.style.setProperty('display', 'none', 'important'));

                const options = {
                    margin: 0,
                    filename: 'PR-<?php echo e($pr->pr_number ?? 'DRAFT'); ?>.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.85
                    },
                    html2canvas: {
                        scale: 1.5,
                        useCORS: true,
                        logging: false,
                        letterRendering: true
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'portrait'
                    }
                };

                const {
                    jsPDF
                } = window.jspdf;

                html2canvas(element, options.html2canvas).then(canvas => {
                    const imgData = canvas.toDataURL('image/jpeg', options.image.quality);
                    const pdf = new jsPDF(options.jsPDF);
                    const pageWidth = pdf.internal.pageSize.getWidth();
                    const pageHeight = pdf.internal.pageSize.getHeight();
                    const imgProps = pdf.getImageProperties(imgData);

                    // Calculate scale to fit both width and height
                    let printWidth = pageWidth;
                    let printHeight = (imgProps.height * printWidth) / imgProps.width;

                    // If height overflows A4, scale down based on height
                    if (printHeight > pageHeight) {
                        printHeight = pageHeight;
                        printWidth = (imgProps.width * printHeight) / imgProps.height;
                    }

                    // Center horizontally
                    const xOffset = (pageWidth - printWidth) / 2;
                    const yOffset = 5; // small top margin

                    pdf.addImage(imgData, 'JPEG', xOffset, yOffset, printWidth, printHeight);
                    pdf.save(options.filename);

                    btnDownload.disabled = false;
                    btnNormal.classList.remove('d-none');
                    btnLoading.classList.add('d-none');
                    noPrint.forEach(b => b.style.display = '');
                }).catch(err => {
                    console.error('PDF Generation Error:', err);
                    btnDownload.disabled = false;
                    btnNormal.classList.remove('d-none');
                    btnLoading.classList.add('d-none');
                    noPrint.forEach(b => b.style.display = '');
                    window.dispatchEvent(new CustomEvent('alert', {
                        detail: {
                            type: 'danger',
                            message: 'Gagal menghasilkan PDF.'
                        }
                    }));
                });
            };

            window.printPR = function() {
                const element = document.getElementById('print-area');
                const noPrint = document.querySelectorAll('.no-print-btn, [data-html2canvas-ignore="true"]');

                noPrint.forEach(b => b.style.setProperty('display', 'none', 'important'));

                const {
                    jsPDF
                } = window.jspdf;
                html2canvas(element, {
                    scale: 1.5,
                    useCORS: true,
                    logging: false,
                    letterRendering: true
                }).then(canvas => {
                    const imgData = canvas.toDataURL('image/jpeg', 0.85);
                    const pdf = new jsPDF({
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'portrait'
                    });
                    const pageWidth = pdf.internal.pageSize.getWidth();
                    const pageHeight = pdf.internal.pageSize.getHeight();
                    const imgProps = pdf.getImageProperties(imgData);

                    // Margins
                    const marginX = 5;
                    const marginY = 5;
                    const availableWidth = pageWidth - (marginX * 2);
                    const availableHeight = pageHeight - (marginY * 2);

                    let printWidth = availableWidth;
                    let printHeight = (imgProps.height * printWidth) / imgProps.width;

                    if (printHeight > availableHeight) {
                        printHeight = availableHeight;
                        printWidth = (imgProps.width * printHeight) / imgProps.height;
                    }

                    const xOffset = marginX + (availableWidth - printWidth) / 2;
                    const yOffset = marginY;

                    pdf.addImage(imgData, 'JPEG', xOffset, yOffset, printWidth, printHeight);
                    const pdfBlob = pdf.output('blob');
                    const pdfUrl = URL.createObjectURL(pdfBlob);

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
                    noPrint.forEach(b => b.style.display = '');
                }).catch(err => {
                    console.error('Print Generation Error:', err);
                    noPrint.forEach(b => b.style.display = '');
                    window.dispatchEvent(new CustomEvent('alert', {
                        detail: {
                            type: 'danger',
                            message: 'Gagal generate print.'
                        }
                    }));
                });
            };
        </script>
    <?php $__env->stopPush(); ?>

    <style>
        @media print {
            @page {
                size: A4;
                margin: 5mm 10mm;
            }

            html,
            body,
            .body-wrapper,
            .page-wrapper,
            .container-fluid {
                height: auto !important;
                min-height: auto !important;
                background: white !important;
                margin: 0 !important;
                padding: 0 !important;
                overflow: visible !important;
            }

            header,
            footer,
            nav,
            aside,
            .navbar,
            .breadcrumb,
            .page-header,
            .sidebar,
            .no-print-btn,
            .btn,
            [data-html2canvas-ignore] {
                display: none !important;
            }

            #main-wrapper,
            .body-wrapper {
                display: block !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .payment-request-detail,
            .payment-request-detail .card {
                display: block !important;
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color: black !important;
            }

            body {
                font-size: 16px !important;
            }

            h4,
            h5,
            h6 {
                margin: 5px 0 !important;
            }

            .mb-4 {
                margin-bottom: 10px !important;
            }

            .alert {
                padding: 5px 10px !important;
                margin-bottom: 10px !important;
                border: 1px solid #000 !important;
                background: transparent !important;
            }

            .table-responsive {
                overflow: visible !important;
                width: 100% !important;
            }

            table {
                width: 100% !important;
                border-collapse: collapse !important;
                border: 1px solid #000 !important;
            }

            th,
            td {
                border: 1px solid #000 !important;
                padding: 3px 5px !important;
                font-size: 15px !important;
            }

            .small {
                font-size: 15px !important;
            }

            .x-small {
                font-size: 14px !important;
            }

            .badge {
                border: 1px solid #000 !important;
                display: inline-block !important;
                padding: 1px 3px !important;
                background: transparent !important;
            }

            .image-container {
                height: 80px !important;
            }
        }
    </style>

    <!-- PR Form Modal Component -->
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('payment-requests.form-modal');

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3285853303-2', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
</div>
<?php /**PATH D:\!Kerja\laracok - Copy\resources\views/livewire/payment-requests/show.blade.php ENDPATH**/ ?>