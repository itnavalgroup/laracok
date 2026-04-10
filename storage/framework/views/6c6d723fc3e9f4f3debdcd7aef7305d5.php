<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print PR - <?php echo e($pr->pr_number); ?></title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; font-size: 11px; color: #000; background: #fff; }

        /* ===== PAGE LAYOUT ===== */
        .container { max-width: 900px; margin: 0 auto; padding: 20px; }
        .no-print { margin-bottom: 15px; }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
            .page-break { page-break-after: always; }
        }

        /* ===== HEADER ===== */
        .doc-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .doc-title h2 { font-size: 16px; font-weight: bold; text-transform: uppercase; }
        .doc-title p { font-size: 10px; color: #555; }
        .doc-meta { text-align: right; }
        .doc-meta .pr-number { font-size: 14px; font-weight: bold; color: #333; }
        .status-badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 10px; font-weight: bold; color: #fff; margin-top: 4px;
            background-color: 
                <?php
                    $s = $pr->status;
                    echo match(true) {
                        $s === null || $s === 0 => '#6c757d',
                        in_array($s, [1,2,3,4,5,6]) => '#fd7e14',
                        $s === 7 => '#0d6efd',
                        in_array($s, [8,9]) => '#6f42c1',
                        in_array($s, [10,11]) => '#198754',
                        $s === 12 => '#ffc107',
                        $s === 13 => '#dc3545',
                        default => '#6c757d',
                    };
                ?>;
        }
        .qr-section { text-align: center; }
        .qr-section img { width: 80px; height: 80px; }

        /* ===== INFO GRID ===== */
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        .info-table td { padding: 4px 8px; vertical-align: top; }
        .info-table .label { font-weight: bold; color: #555; width: 140px; white-space: nowrap; }
        .info-table .colon { width: 12px; }
        .info-table .value { }
        .info-table tr:nth-child(odd) { background: #f9f9f9; }

        /* ===== ITEM TABLE ===== */
        .section-title { font-size: 12px; font-weight: bold; text-transform: uppercase; background: #2d3748; color: #fff; padding: 6px 10px; margin: 12px 0 6px; border-radius: 4px; }
        .item-table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        .item-table th { background: #f1f3f4; border: 1px solid #ddd; padding: 5px 8px; text-align: center; font-size: 10px; }
        .item-table td { border: 1px solid #ddd; padding: 4px 8px; font-size: 10px; vertical-align: top; }
        .item-table td.num { text-align: right; }
        .item-table td.center { text-align: center; }
        .item-table tfoot tr { font-weight: bold; }
        .item-table tfoot td { background: #f8f9fa; border: 1px solid #ddd; padding: 5px 8px; }

        /* ===== ATTACHMENTS ===== */
        .attachment-list { list-style: none; padding: 0; margin: 0; }
        .attachment-list li { display: flex; align-items: center; gap: 8px; padding: 4px 0; border-bottom: 1px dotted #eee; }
        .check-icon { color: #198754; font-weight: bold; }

        /* ===== SIGN FLOW ===== */
        .sign-section { margin-top: 16px; border-top: 1px solid #ccc; padding-top: 12px; }
        .sign-grid { display: grid; gap: 16px; }
        .sign-grid-4 { grid-template-columns: repeat(4, 1fr); }
        .sign-grid-3 { grid-template-columns: repeat(3, 1fr); }
        .sign-box { border: 1px solid #ccc; border-radius: 6px; padding: 10px; text-align: center; background: #fafafa; }
        .sign-box .sign-role { font-weight: bold; font-size: 10px; text-transform: uppercase; color: #555; margin-bottom: 6px; }
        .sign-box .sign-area { min-height: 50px; display: flex; flex-direction: column; align-items: center; justify-content: center; }
        .sign-box .sign-name { font-size: 10px; font-weight: bold; margin-top: 4px; color: #333; }
        .sign-box .sign-date { font-size: 9px; color: #777; margin-top: 2px; }
        .sign-box .sign-status { font-size: 9px; padding: 2px 6px; border-radius: 3px; color: #fff; display: inline-block; margin-top: 2px; }
        .sign-box .approved { background: #198754; }
        .sign-box .pending { background: #fd7e14; }
        .sign-box .revised { background: #ffc107; color: #000; }
        .sign-box .rejected { background: #dc3545; }

        /* ===== FOOTER ===== */
        .print-footer { margin-top: 20px; padding-top: 10px; border-top: 1px solid #ccc; text-align: center; font-size: 9px; color: #999; }

        /* ===== PRINT BUTTON ===== */
        .btn-print { display: inline-block; padding: 8px 20px; background: #0d6efd; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-size: 13px; text-decoration: none; margin-right: 8px; }
        .btn-back { display: inline-block; padding: 8px 20px; background: #6c757d; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-size: 13px; text-decoration: none; }
    </style>
</head>
<body>
<div class="container">
    <!-- ===== NO-PRINT BUTTONS ===== -->
    <div class="no-print" style="padding: 10px 0;">
        <button class="btn-print" onclick="window.print()">🖨️ Print / Download</button>
        <a href="<?php echo e(route('payment-requests.show', hashid_encode($pr->id_pr, 'pr'))); ?>" class="btn-back">← Kembali</a>
    </div>

    <!-- ===== HEADER ===== -->
    <div class="doc-header">
        <div class="doc-title">
            <h2>Payment Request Form</h2>
            <p><?php echo e($pr->company->company ?? '-'); ?> &bull; <?php echo e($pr->docType->doc_type ?? '-'); ?></p>
        </div>
        <div class="doc-meta">
            <div class="pr-number"><?php echo e($pr->pr_number); ?></div>
            <span class="status-badge">
                <?php
                    $statusLabels = [
                        null => 'Draft', 0 => 'Draft', 1 => 'Pending Dept Sign', 2 => 'Pending Director Sign',
                        3 => 'Pending Accounting Sign', 4 => 'Pending Finance Sign', 5 => 'Pending SPV Finance Sign',
                        6 => 'Pending CFO Sign', 7 => 'Pending Payment', 8 => 'Payment Parsial',
                        9 => 'Pending Receipt Parsial', 10 => 'Pending Receipt', 11 => 'Paid',
                        12 => 'Revision', 13 => 'Rejected', 14 => 'Pending Director Sign Payment',
                    ];
                    echo $statusLabels[$pr->status] ?? 'Unknown';
                ?>
            </span>
            <div style="margin-top: 4px; font-size: 10px; color:#555;">
                <?php echo e($pr->created_at?->format('d M Y')); ?>

            </div>
        </div>
        <div class="qr-section no-print">
            <?php
                $qrData = 'PR|' . $pr->id_pr . '|' . $pr->pr_number . '|' . $pr->status;
                $qrUrl  = 'https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=' . urlencode($qrData);
            ?>
            <img src="<?php echo e($qrUrl); ?>" alt="QR Code" title="<?php echo e($pr->pr_number); ?>">
        </div>
    </div>

    <!-- ===== PAYMENT REQUEST INFO ===== -->
    <div class="section-title">Informasi Payment Request</div>
    <table class="info-table">
        <tr><td class="label">Subject</td><td class="colon">:</td><td class="value"><?php echo e($pr->subject ?? '-'); ?></td>
            <td class="label">No Invoice</td><td class="colon">:</td><td class="value"><?php echo e($pr->no_invoice ?? '-'); ?></td></tr>
        <tr><td class="label">Tanggal</td><td class="colon">:</td><td class="value"><?php echo e($pr->created_at?->format('d M Y')); ?></td>
            <td class="label">PO Number</td><td class="colon">:</td><td class="value"><?php echo e($pr->po_number ?? '-'); ?></td></tr>
        <tr><td class="label">Departemen</td><td class="colon">:</td><td class="value"><?php echo e($pr->departement->departement ?? '-'); ?></td>
            <td class="label">Payment Method</td><td class="colon">:</td><td class="value"><?php echo e($pr->payment_method == 1 ? 'Transfer' : 'Cash'); ?></td></tr>
        <tr><td class="label">Cost Category</td><td class="colon">:</td><td class="value"><?php echo e($pr->costCategory->cost_category ?? '-'); ?></td>
            <td class="label">Payment Due Date</td><td class="colon">:</td><td class="value"><?php echo e($pr->payment_due_date?->format('d M Y') ?? '-'); ?></td></tr>
        <tr><td class="label">Cost Type</td><td class="colon">:</td><td class="value"><?php echo e($pr->costType->cost_type ?? '-'); ?></td>
            <td class="label">Est. Settlement</td><td class="colon">:</td><td class="value"><?php echo e($pr->est_settlement_date?->format('d M Y') ?? '-'); ?></td></tr>
        <tr><td class="label">Currency</td><td class="colon">:</td><td class="value"><?php echo e($pr->currency ? $pr->currency->currency . ' (' . $pr->currency->symbol . ')' : 'IDR (Rp)'); ?></td>
            <td class="label">Branch</td><td class="colon">:</td><td class="value"><?php echo e($pr->branch->branch ?? '-'); ?></td></tr>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr->id_loan): ?>
        <tr><td class="label">Loan</td><td class="colon">:</td><td class="value" colspan="3"><?php echo e($pr->loan->loan ?? '-'); ?></td></tr>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </table>

    <!-- ===== VENDOR INFO ===== -->
    <div class="section-title">Informasi Vendor</div>
    <table class="info-table">
        <tr><td class="label">Vendor</td><td class="colon">:</td><td class="value"><?php echo e($pr->vendor->vendor ?? '-'); ?></td>
            <td class="label">Email Vendor</td><td class="colon">:</td><td class="value"><?php echo e($pr->emailVendor->email ?? '-'); ?></td></tr>
        <tr><td class="label">NPWP / NIK</td><td class="colon">:</td><td class="value"><?php echo e($pr->vendor->npwp ?? '-'); ?></td>
            <td class="label">Email User</td><td class="colon">:</td><td class="value"><?php echo e($pr->emailUser->email ?? '-'); ?></td></tr>
        <?php
            // Bank: prioritaskan data manual, baru dari norek_vendor
            $bankName   = $pr->nama_bank ?: ($pr->norek_vendor?->nama_bank ?? '-');
            $bankHolder = $pr->nama_penerima ?: ($pr->norek_vendor?->nama_penerima ?? '-');
            $bankNorek  = $pr->norek ?: ($pr->norek_vendor?->norek ?? '-');
        ?>
        <tr><td class="label">Bank</td><td class="colon">:</td><td class="value"><?php echo e($bankName); ?></td>
            <td class="label">Atas Nama</td><td class="colon">:</td><td class="value"><?php echo e($bankHolder); ?></td></tr>
        <tr><td class="label">No. Rekening</td><td class="colon">:</td><td class="value" colspan="3"><?php echo e($bankNorek); ?></td></tr>
    </table>

    <!-- ===== ITEM TABLE ===== -->
    <div class="section-title">Detail Item PR</div>
    <?php $symbol = $pr->currency?->symbol ?? 'Rp'; ?>
    <table class="item-table">
        <thead>
            <tr>
                <th style="width:4%">No</th>
                <th style="width:28%">Deskripsi</th>
                <th style="width:8%">BL Number</th>
                <th style="width:7%">Qty</th>
                <th style="width:6%">UOM</th>
                <th style="width:12%">Harga Satuan</th>
                <th style="width:9%">Discount</th>
                <th style="width:9%">PPN</th>
                <th style="width:9%">PPh</th>
                <th style="width:12%">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pr->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <tr>
                <td class="center"><?php echo e($i + 1); ?></td>
                <td><?php echo e($d->detail); ?></td>
                <td class="center"><?php echo e($d->bl_number ?? '-'); ?></td>
                <td class="num"><?php echo e(number_format($d->qty, 2, ',', '.')); ?></td>
                <td class="center"><?php echo e($d->uom?->uom ?? '-'); ?></td>
                <td class="num"><?php echo e($symbol); ?> <?php echo e(number_format($d->price, 2, ',', '.')); ?></td>
                <td class="num"><?php echo e($symbol); ?> <?php echo e(number_format($d->discount ?? 0, 2, ',', '.')); ?></td>
                <td class="num"><?php echo e($symbol); ?> <?php echo e(number_format($d->tax1 ?? 0, 2, ',', '.')); ?></td>
                <td class="num"><?php echo e($symbol); ?> <?php echo e(number_format($d->tax2 ?? 0, 2, ',', '.')); ?></td>
                <td class="num"><strong><?php echo e($symbol); ?> <?php echo e(number_format($d->ammount ?? 0, 2, ',', '.')); ?></strong></td>
            </tr>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </tbody>
        <tfoot>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(floatval($pr->additional_discount ?? 0) > 0): ?>
            <tr>
                <td colspan="9" style="text-align:right">Additional Discount</td>
                <td class="num"><?php echo e($symbol); ?> <?php echo e(number_format($pr->additional_discount, 2, ',', '.')); ?></td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <tr>
                <td colspan="9" style="text-align:right">Grand Total</td>
                <td class="num"><?php echo e($symbol); ?> <?php echo e(number_format($grandTotal, 2, ',', '.')); ?></td>
            </tr>
            <tr>
                <td colspan="9" style="text-align:right">Total Payment</td>
                <td class="num"><?php echo e($symbol); ?> <?php echo e(number_format($paidTotal, 2, ',', '.')); ?></td>
            </tr>
            <tr>
                <td colspan="9" style="text-align:right">Saldo</td>
                <td class="num"><?php echo e($symbol); ?> <?php echo e(number_format($balance, 2, ',', '.')); ?></td>
            </tr>
        </tfoot>
    </table>

    <!-- ===== SUPPORTING DOCUMENTS ===== -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr->attachmentPrs->count() > 0): ?>
    <div class="section-title">Dokumen Pendukung</div>
    <ul class="attachment-list">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pr->attachmentPrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
        <li>
            <span class="check-icon">✓</span>
            <?php echo e($att->attachment?->attachment ?? 'Dokumen'); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($att->notes): ?> &mdash; <em><?php echo e($att->notes); ?></em> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </li>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </ul>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- ===== PAYMENT REQUEST DETAIL (SIGN FLOW 1) ===== -->
    <div class="sign-section">
        <strong>PAYMENT REQUEST DETAIL</strong>
        <?php
            // Build sign flow from signTransactions
            $signSteps = [
                1 => 'Requested By',
                2 => 'Verified By (Dept)',
                3 => 'Approved By (Director)',
                4 => 'Checked By (Accounting)',
            ];
            $signMap = [];
            foreach($pr->signTransactions as $st) {
                $signMap[$st->status] = $st;
            }
        ?>
        <div class="sign-grid sign-grid-4" style="margin-top:12px;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $signSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <?php $st = $signMap[$step] ?? null; ?>
            <div class="sign-box">
                <div class="sign-role"><?php echo e($role); ?></div>
                <div class="sign-area">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($st): ?>
                        <div><?php echo e($st->user?->name ?? '-'); ?></div>
                        <div class="sign-date"><?php echo e(\Carbon\Carbon::parse($st->created_at)->format('d/m/Y')); ?></div>
                        <span class="sign-status approved">✓ Approved</span>
                    <?php else: ?>
                        <div style="color:#ccc; font-size:9px;">Belum ditandatangani</div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pr->status >= $step): ?>
                            <span class="sign-status pending">Pending</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>

    <!-- ===== PAYMENT PROCESSING (SIGN FLOW 2) ===== -->
    <div class="sign-section" style="margin-top:20px;">
        <strong>PAYMENT PROCESSING</strong>
        <?php
            $signSteps2 = [
                5 => 'Prepared By (Finance)',
                6 => 'Verified By (SPV Finance)',
                7 => 'Authorized By (CFO)',
            ];
        ?>
        <div class="sign-grid sign-grid-3" style="margin-top:12px;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $signSteps2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <?php $st = $signMap[$step] ?? null; ?>
            <div class="sign-box">
                <div class="sign-role"><?php echo e($role); ?></div>
                <div class="sign-area">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($st): ?>
                        <div><?php echo e($st->user?->name ?? '-'); ?></div>
                        <div class="sign-date"><?php echo e(\Carbon\Carbon::parse($st->created_at)->format('d/m/Y')); ?></div>
                        <span class="sign-status approved">✓ Approved</span>
                    <?php else: ?>
                        <div style="color:#ccc; font-size:9px;">Belum ditandatangani</div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <div class="print-footer">
        Dokumen ini dicetak dari Sistem PPD Naval &bull; <?php echo e(now()->format('d M Y H:i')); ?>

    </div>
</div>
</body>
</html>
<?php /**PATH D:\!Kerja\laracok - Copy\resources\views\payment-requests\print.blade.php ENDPATH**/ ?>