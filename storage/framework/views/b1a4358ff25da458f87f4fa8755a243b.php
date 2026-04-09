<div wire:poll.30s>
     <?php $__env->slot('header', null, []); ?> 
        <h5 class="mb-0">Dashboard</h5>
     <?php $__env->endSlot(); ?>

    
    
    
    <div class="dash-welcome-card mb-4 p-4 rounded-4 shadow-sm d-flex align-items-center justify-content-between flex-wrap gap-3"
        style="background: linear-gradient(135deg, #1a237e 0%, #283593 50%, #3949ab 100%); color: #fff;">
        <div>
            <h4 class="fw-bold mb-1 text-white">
                <i class="ti ti-hand-stop me-2" style="color: #FFD54F;"></i>
                Selamat datang, <?php echo e($user->name); ?>!
            </h4>
            <p class="mb-0 opacity-75">
                <i class="ti ti-calendar me-1"></i>
                <?php echo e(\Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y')); ?>

            </p>
        </div>
        <div class="text-end">
            <div class="badge rounded-pill px-3 py-2 fs-6" style="background: rgba(255,255,255,0.2);">
                <i class="ti ti-shield-check me-1"></i>
                <?php echo e($user->level === 1 ? 'Administrator' : ($user->position->position ?? 'User')); ?>

            </div>
        </div>
    </div>

    
    
    
    
    
    
    <div class="row g-3 mb-4">
        
        <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm dash-stat-card" style="border-radius:14px; background: linear-gradient(135deg,#FF8F00,#FFB300);">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stat-icon rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="background:rgba(255,255,255,0.2); width:42px; height:42px;">
                            <i class="ti ti-hourglass-low" style="font-size:1.5rem;color:#fff;"></i>
                        </div>
                        <span class="badge rounded-pill" style="background:rgba(255,255,255,0.2);color:#fff;font-size:.7rem;">PR</span>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex align-items-baseline gap-2">
                            <h5 class="fw-bold text-white mb-0" style="font-size:1.6rem; line-height:1;"><?php echo e(number_format($stats['prPendingApprovalCount'])); ?></h5>
                            <span class="text-white" style="font-size:.75rem; opacity:.8;">PR</span>
                        </div>
                        <p class="mb-0" style="color:#fff; font-size:.82rem; font-weight:600;"><?php echo e('Rp ' . number_format($stats['nilaiPrPendingApproval'], 0, ',', '.')); ?></p>
                        <p class="mb-0 small" style="color:rgba(255,255,255,0.85);">PR Pending Persetujuan</p>
                        <p class="mb-0" style="color:rgba(255,255,255,0.6); font-size:.68rem;">Status 1–6 (dalam proses tanda tangan)</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm dash-stat-card" style="border-radius:14px; background: linear-gradient(135deg,#5E35B1,#7E57C2);">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stat-icon rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="background:rgba(255,255,255,0.2); width:42px; height:42px;">
                            <i class="ti ti-alert-circle" style="font-size:1.5rem;color:#fff;"></i>
                        </div>
                        <span class="badge rounded-pill" style="background:rgba(255,255,255,0.2);color:#fff;font-size:.7rem;">PR</span>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex align-items-baseline gap-2">
                            <h5 class="fw-bold text-white mb-0" style="font-size:1.6rem; line-height:1;"><?php echo e(number_format($stats['prPendingPaymentCount'])); ?></h5>
                            <span class="text-white" style="font-size:.75rem; opacity:.8;">PR</span>
                        </div>
                        <p class="mb-0" style="color:#fff; font-size:.82rem; font-weight:600;"><?php echo e('Rp ' . number_format($stats['nilaiPrPendingPayment'], 0, ',', '.')); ?></p>
                        <p class="mb-0 small" style="color:rgba(255,255,255,0.85);">PR Pending Pembayaran</p>
                        <p class="mb-0" style="color:rgba(255,255,255,0.6); font-size:.68rem;">Sisa tagihan yang belum dibayar</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm dash-stat-card" style="border-radius:14px; background: linear-gradient(135deg,#1565C0,#1976D2);">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stat-icon rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="background:rgba(255,255,255,0.2); width:42px; height:42px;">
                            <i class="ti ti-circle-check" style="font-size:1.5rem;color:#fff;"></i>
                        </div>
                        <span class="badge rounded-pill" style="background:rgba(255,255,255,0.2);color:#fff;font-size:.7rem;">PR</span>
                    </div>
                    <div class="mt-2">
                        <div class="d-flex align-items-baseline gap-2">
                            <h5 class="fw-bold text-white mb-0" style="font-size:1.6rem; line-height:1;"><?php echo e(number_format($stats['prSelesaiCount'])); ?></h5>
                            <span class="text-white" style="font-size:.75rem; opacity:.8;">PR</span>
                        </div>
                        <p class="mb-0 fw-bold" style="color:#fff; font-size:.82rem; margin-top:2px;"><?php echo e('Rp ' . number_format($stats['nilaiPrSelesai'], 0, ',', '.')); ?></p>
                        <p class="mb-0 small" style="color:rgba(255,255,255,0.85);">PR Selesai / Lunas</p>
                        <p class="mb-0" style="color:rgba(255,255,255,0.6); font-size:.68rem;">Status 11</p>
                        
                        
                        <hr style="border-color:rgba(255,255,255,0.2); margin:6px 0;">
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <span style="color:rgba(255,255,255,0.75); font-size:.72rem;">
                                Lebih Bayar
                            </span>
                            <span class="fw-bold" style="color:#FFF9C4; font-size:.75rem;">
                                Rp <?php echo e(number_format($stats['prSelesaiOverpaid'], 0, ',', '.')); ?>

                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <span style="color:rgba(255,255,255,0.75); font-size:.72rem;">
                                Kurang Bayar
                            </span>
                            <span class="fw-bold" style="color:#FFCDD2; font-size:.75rem;">
                                Rp <?php echo e(number_format($stats['prSelesaiUnderpaid'], 0, ',', '.')); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm dash-stat-card" style="border-radius:14px; background: linear-gradient(135deg,#0277BD,#039BE5);">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stat-icon rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="background:rgba(255,255,255,0.2); width:42px; height:42px;">
                            <i class="ti ti-receipt-2" style="font-size:1.5rem;color:#fff;"></i>
                        </div>
                        <span class="badge rounded-pill" style="background:rgba(255,255,255,0.2);color:#fff;font-size:.7rem;">PR</span>
                    </div>
                    <div class="mt-2">
                        <div class="d-flex align-items-baseline gap-2">
                            <h5 class="fw-bold text-white mb-0" style="font-size:1.6rem; line-height:1;"><?php echo e(number_format($stats['prParsialCount'])); ?></h5>
                            <span class="text-white" style="font-size:.75rem; opacity:.8;">PR</span>
                        </div>
                        <p class="mb-0 small fw-bold" style="color:rgba(255,255,255,0.85); margin-top:2px;">PR Bayar Sebagian</p>
                        
                        
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span style="color:rgba(255,255,255,0.75); font-size:.72rem;">
                                <i class="ti ti-file-invoice me-1"></i>Total Tagihan
                            </span>
                            <span class="fw-bold text-white" style="font-size:.8rem;">
                                Rp <?php echo e(number_format($stats['totalTagihanParsial'], 0, ',', '.')); ?>

                            </span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <span style="color:rgba(255,255,255,0.75); font-size:.72rem;">
                                <i class="ti ti-check me-1"></i>Sudah Dibayar
                            </span>
                            <span class="fw-bold" style="color:#A5D6A7; font-size:.8rem;">
                                Rp <?php echo e(number_format($stats['totalTerbayarParsial'], 0, ',', '.')); ?>

                            </span>
                        </div>
                        <hr style="border-color:rgba(255,255,255,0.2); margin:6px 0;">
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span style="color:rgba(255,255,255,0.85); font-size:.72rem; font-weight:600;">Sisa Tagihan</span>
                            <span class="fw-bold" style="color:#FFF9C4; font-size:.8rem;">
                                Rp <?php echo e(number_format($stats['sisaTagihanParsial'], 0, ',', '.')); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    
    <div class="row g-3 mb-4">
        
        <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm dash-stat-card" style="border-radius:14px; background: linear-gradient(135deg,#E65100,#FF6D00);">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stat-icon rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="background:rgba(255,255,255,0.2); width:42px; height:42px;">
                            <i class="ti ti-writing-sign" style="font-size:1.5rem;color:#fff;"></i>
                        </div>
                        <span class="badge rounded-pill" style="background:rgba(255,255,255,0.2);color:#fff;font-size:.7rem;">SR</span>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex align-items-baseline gap-2">
                            <h5 class="fw-bold text-white mb-0" style="font-size:1.6rem; line-height:1;"><?php echo e(number_format($stats['srPendingApprovalCount'])); ?></h5>
                            <span class="text-white" style="font-size:.75rem; opacity:.8;">SR</span>
                        </div>
                        <p class="mb-0" style="color:#fff; font-size:.82rem; font-weight:600;"><?php echo e('Rp ' . number_format($stats['nilaiSrPendingApproval'], 0, ',', '.')); ?></p>
                        <p class="mb-0 small" style="color:rgba(255,255,255,0.85);">SR Pending Persetujuan</p>
                        <p class="mb-0" style="color:rgba(255,255,255,0.6); font-size:.68rem;">Status 1–6 (dalam proses tanda tangan)</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm dash-stat-card" style="border-radius:14px; background: linear-gradient(135deg,#6A1B9A,#8E24AA);">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stat-icon rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="background:rgba(255,255,255,0.2); width:42px; height:42px;">
                            <i class="ti ti-arrows-exchange" style="font-size:1.5rem;color:#fff;"></i>
                        </div>
                        <span class="badge rounded-pill" style="background:rgba(255,255,255,0.2);color:#fff;font-size:.7rem;">SR</span>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex align-items-baseline gap-2">
                            <h5 class="fw-bold text-white mb-0" style="font-size:1.6rem; line-height:1;"><?php echo e(number_format($stats['srPendingSettlementCount'])); ?></h5>
                            <span class="text-white" style="font-size:.75rem; opacity:.8;">SR</span>
                        </div>
                        <p class="mb-0" style="color:#fff; font-size:.82rem; font-weight:600;"><?php echo e('Rp ' . number_format($stats['nilaiSrPendingSettlement'], 0, ',', '.')); ?></p>
                        <p class="mb-0 small" style="color:rgba(255,255,255,0.85);">SR Pending Settlement</p>
                        <p class="mb-0" style="color:rgba(255,255,255,0.6); font-size:.68rem;">Menunggu kembalian / tambahan dana</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm dash-stat-card" style="border-radius:14px; background: linear-gradient(135deg,#2E7D32,#43A047);">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stat-icon rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="background:rgba(255,255,255,0.2); width:42px; height:42px;">
                            <i class="ti ti-circle-check" style="font-size:1.5rem;color:#fff;"></i>
                        </div>
                        <span class="badge rounded-pill" style="background:rgba(255,255,255,0.2);color:#fff;font-size:.7rem;">SR</span>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex align-items-baseline gap-2">
                            <h5 class="fw-bold text-white mb-0" style="font-size:1.6rem; line-height:1;"><?php echo e(number_format($stats['srSelesaiCount'])); ?></h5>
                            <span class="text-white" style="font-size:.75rem; opacity:.8;">SR</span>
                        </div>
                        <p class="mb-0" style="color:#fff; font-size:.82rem; font-weight:600;"><?php echo e('Rp ' . number_format($stats['nilaiSrSelesai'], 0, ',', '.')); ?></p>
                        <p class="mb-0 small" style="color:rgba(255,255,255,0.85);">SR Selesai</p>
                        <p class="mb-0" style="color:rgba(255,255,255,0.6); font-size:.68rem;">Status 10–11 (settled / lunas)</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card h-100 border-0 shadow-sm dash-stat-card" style="border-radius:14px; background: linear-gradient(135deg,#00695C,#00897B);">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="stat-icon rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="background:rgba(255,255,255,0.2); width:42px; height:42px;">
                            <i class="ti ti-coin" style="font-size:1.5rem;color:#fff;"></i>
                        </div>
                        <span class="badge rounded-pill" style="background:rgba(255,255,255,0.2);color:#fff;font-size:.7rem;">SR</span>
                    </div>
                    <div class="mt-2">
                        <p class="mb-0 small fw-bold" style="color:rgba(255,255,255,0.85);">Dana Settlement SR</p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span style="color:rgba(255,255,255,0.75); font-size:.72rem;">
                                <i class="ti ti-arrow-narrow-left me-1"></i>Kembalian Karyawan
                            </span>
                            <span class="fw-bold" style="color:#A5D6A7; font-size:.8rem;">
                                Rp <?php echo e(number_format($stats['totalKembalianKaryawan'], 0, ',', '.')); ?>

                            </span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <span style="color:rgba(255,255,255,0.75); font-size:.72rem;">
                                <i class="ti ti-arrow-narrow-right me-1"></i>Tambahan Perusahaan
                            </span>
                            <span class="fw-bold" style="color:#FFCC80; font-size:.8rem;">
                                Rp <?php echo e(number_format($stats['totalTambahanPerusahaan'], 0, ',', '.')); ?>

                            </span>
                        </div>
                        <hr style="border-color:rgba(255,255,255,0.2); margin:6px 0;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span style="color:rgba(255,255,255,0.6); font-size:.68rem;">Total settlement</span>
                            <span class="fw-bold text-white" style="font-size:.8rem;">
                                Rp <?php echo e(number_format($stats['totalKembalianKaryawan'] + $stats['totalTambahanPerusahaan'], 0, ',', '.')); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row g-3 mb-4">
        
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 shadow-sm dash-stat-card" style="border-radius:10px; background: #fff;">
                <div class="card-body p-2 d-flex align-items-center gap-2">
                    <div class="rounded-2 p-2 d-flex align-items-center justify-content-center" style="background:rgba(21, 101, 192, 0.1); width:32px; height:32px;">
                        <i class="ti ti-file-description" style="font-size:1.1rem;color:#1565C0;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size:0.9rem;"><?php echo e(number_format($stats['totalPr'])); ?></h6>
                        <p class="mb-0 text-muted" style="font-size:0.7rem;">Total PR</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 shadow-sm dash-stat-card" style="border-radius:10px; background: #fff;">
                <div class="card-body p-2 d-flex align-items-center gap-2">
                    <div class="rounded-2 p-2 d-flex align-items-center justify-content-center" style="background:rgba(230, 81, 0, 0.1); width:32px; height:32px;">
                        <i class="ti ti-clock-pause" style="font-size:1.1rem;color:#E65100;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size:0.9rem;"><?php echo e(number_format($stats['pendingPr'])); ?></h6>
                        <p class="mb-0 text-muted" style="font-size:0.7rem;">PR Pen.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 shadow-sm dash-stat-card" style="border-radius:10px; background: #fff;">
                <div class="card-body p-2 d-flex align-items-center gap-2">
                    <div class="rounded-2 p-2 d-flex align-items-center justify-content-center" style="background:rgba(27, 94, 32, 0.1); width:32px; height:32px;">
                        <i class="ti ti-file-analytics" style="font-size:1.1rem;color:#1B5E20;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size:0.9rem;"><?php echo e(number_format($stats['totalSr'])); ?></h6>
                        <p class="mb-0 text-muted" style="font-size:0.7rem;">Total SR</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 shadow-sm dash-stat-card" style="border-radius:10px; background: #fff;">
                <div class="card-body p-2 d-flex align-items-center gap-2">
                    <div class="rounded-2 p-2 d-flex align-items-center justify-content-center" style="background:rgba(136, 14, 79, 0.1); width:32px; height:32px;">
                        <i class="ti ti-clock-pause" style="font-size:1.1rem;color:#880E4F;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size:0.9rem;"><?php echo e(number_format($stats['pendingSr'])); ?></h6>
                        <p class="mb-0 text-muted" style="font-size:0.7rem;">SR Pending</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 shadow-sm dash-stat-card" style="border-radius:10px; background: #fff;">
                <div class="card-body p-2 d-flex align-items-center gap-2">
                    <div class="rounded-2 p-2 d-flex align-items-center justify-content-center" style="background:rgba(0, 77, 64, 0.1); width:32px; height:32px;">
                        <i class="ti ti-currency-rupiah" style="font-size:1.1rem;color:#004D40;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size:0.75rem;"><?php echo e(number_format($stats['totalPrValue'])); ?></h6>
                        <p class="mb-0 text-muted" style="font-size:0.7rem;">Nilai PR</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card border-0 shadow-sm dash-stat-card" style="border-radius:10px; background: #fff;">
                <div class="card-body p-2 d-flex align-items-center gap-2">
                    <div class="rounded-2 p-2 d-flex align-items-center justify-content-center" style="background:rgba(74, 20, 140, 0.1); width:32px; height:32px;">
                        <i class="ti ti-package" style="font-size:1.1rem;color:#4A148C;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark" style="font-size:0.9rem;"><?php echo e(number_format($stats['totalItThisMonth'])); ?></h6>
                        <p class="mb-0 text-muted" style="font-size:0.7rem;">Transaksi Bulan Ini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    
    <div class="card border-0 shadow-sm" style="border-radius:14px;">
        <div class="card-header border-0 p-0" style="background: transparent; border-radius: 14px 14px 0 0;">
            <ul class="nav nav-tabs nav-fill dashboard-tabs" id="pendingTabs" role="tablist" style="border-bottom: 1px solid #eee;">
                
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-3 <?php echo e($activeTab === 'all' ? 'active' : ''); ?>"
                        wire:click="$set('activeTab', 'all')" type="button">
                        <i class="ti ti-list-details me-1"></i>
                        SEMUA
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tabCounts['all'] > 0): ?>
                        <span class="badge rounded-pill bg-danger ms-1"><?php echo e($tabCounts['all']); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-3 <?php echo e($activeTab === 'PR' ? 'active' : ''); ?>"
                        wire:click="$set('activeTab', 'PR')" type="button">
                        <i class="ti ti-file-description me-1"></i>
                        PR
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tabCounts['PR'] > 0): ?>
                        <span class="badge rounded-pill bg-primary ms-1"><?php echo e($tabCounts['PR']); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-3 <?php echo e($activeTab === 'SR' ? 'active' : ''); ?>"
                        wire:click="$set('activeTab', 'SR')" type="button">
                        <i class="ti ti-file-analytics me-1"></i>
                        SR
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tabCounts['SR'] > 0): ?>
                        <span class="badge rounded-pill bg-success ms-1"><?php echo e($tabCounts['SR']); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-3 <?php echo e($activeTab === 'IKB' ? 'active' : ''); ?>"
                        wire:click="$set('activeTab', 'IKB')" type="button">
                        <i class="ti ti-box me-1"></i>
                        IKB
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tabCounts['IKB'] > 0): ?>
                        <span class="badge rounded-pill bg-warning ms-1 text-dark"><?php echo e($tabCounts['IKB']); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </button>
                </li>
                
                <li class="nav-item d-flex align-items-center" role="presentation">
                    <div style="width:1px; height:28px; background:#dee2e6; margin: 0 4px;"></div>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-3 <?php echo e($activeTab === 'pr_payment_full' ? 'active' : ''); ?>"
                        wire:click="$set('activeTab', 'pr_payment_full')" type="button">
                        <i class="ti ti-cash me-1"></i>
                        PR Lunas
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($tabCounts['pr_payment_full'] ?? 0) > 0): ?>
                        <span class="badge rounded-pill ms-1" style="background:#0277BD; color:#fff;"><?php echo e($tabCounts['pr_payment_full']); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-3 <?php echo e($activeTab === 'pr_partial_payment' ? 'active' : ''); ?>"
                        wire:click="$set('activeTab', 'pr_partial_payment')" type="button">
                        <i class="ti ti-receipt-2 me-1"></i>
                        PR Parsial
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($tabCounts['pr_partial_payment'] ?? 0) > 0): ?>
                        <span class="badge rounded-pill ms-1" style="background:#5E35B1; color:#fff;"><?php echo e($tabCounts['pr_partial_payment']); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-3 <?php echo e($activeTab === 'sr_pending_settlement' ? 'active' : ''); ?>"
                        wire:click="$set('activeTab', 'sr_pending_settlement')" type="button">
                        <i class="ti ti-arrows-exchange me-1"></i>
                        SR Settlement
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($tabCounts['sr_pending_settlement'] ?? 0) > 0): ?>
                        <span class="badge rounded-pill ms-1" style="background:#00695C; color:#fff;"><?php echo e($tabCounts['sr_pending_settlement']); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body p-0">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($activeTab, ['all','PR','SR','IKB'])): ?>
            
            <div class="px-4 py-2 border-bottom bg-light d-flex align-items-center justify-content-between">
                <span class="small fw-bold text-uppercase text-muted">
                    <i class="ti ti-bell-ringing text-danger me-1"></i>
                    Perlu Tindakan Saya (<?php echo e($activeTab); ?>)
                </span>
                <span class="text-muted small">Menampilkan <?php echo e($pendingItems->count()); ?> dari <?php echo e($pendingItems->total()); ?> data</span>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendingItems->isEmpty()): ?>
            <div class="text-center py-5">
                <i class="ti ti-circle-check" style="font-size:3.5rem;color:#22c55e;"></i>
                <p class="mt-3 fw-semibold text-muted">Tidak ada dokumen yang perlu tindakan saat ini.</p>
                <p class="text-muted small">Semua dokumen telah diproses dengan baik 🎉</p>
            </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold text-muted" style="width:80px;">Tipe</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Nomor</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Subject / Keperluan</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Tanggal</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Status</th>
                            <th class="py-3 pe-4 text-uppercase small fw-bold text-muted text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pendingItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php
                        if ($item['type'] === 'PR') {
                        [$statusText, $statusColor] = \App\Livewire\Dashboard::prStatusLabel($item['status']);
                        } elseif ($item['type'] === 'SR') {
                        [$statusText, $statusColor] = \App\Livewire\Dashboard::srStatusLabel($item['status']);
                        } else {
                        [$statusText, $statusColor] = \App\Livewire\Dashboard::ikbStatusLabel($item['status']);
                        }
                        $colorMap = [
                        'primary' => '#1565C0',
                        'success' => '#2E7D32',
                        'warning' => '#F57F17',
                        'info' => '#0277BD',
                        'danger' => '#C62828',
                        'secondary'=> '#546e7a',
                        'purple' => '#6A1B9A',
                        'orange' => '#E65100',
                        ];
                        $badgeBg = $colorMap[$item['color']] ?? '#1565C0';
                        $statusBg = $colorMap[$statusColor] ?? '#546e7a';
                        ?>
                        <tr class="dash-approval-row" style="cursor:pointer;"
                            onclick="window.location='<?php echo e(route($item['route'], $item['hash'])); ?>'">
                            <td class="ps-4">
                                <span class="badge rounded-pill px-3 py-2 fw-bold"
                                    style="background: <?php echo e($badgeBg); ?>; color:#fff; font-size:.75rem; letter-spacing:.5px;">
                                    <i class="ti <?php echo e($item['icon']); ?> me-1"></i><?php echo e($item['type']); ?>

                                </span>
                            </td>
                            <td><span class="fw-semibold text-dark"><?php echo e($item['number']); ?></span></td>
                            <td>
                                <span class="text-muted" style="max-width:300px; display:block; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    <?php echo e($item['subject']); ?>

                                </span>
                            </td>
                            <td><span class="text-muted small"><?php echo e($item['date'] ? \Carbon\Carbon::parse($item['date'])->format('d M Y') : '-'); ?></span></td>
                            <td>
                                <span class="badge rounded-pill px-3 py-1"
                                    style="background:<?php echo e($statusBg); ?>22; color:<?php echo e($statusBg); ?>; border:1px solid <?php echo e($statusBg); ?>44; font-size:.75rem;">
                                    <?php echo e($statusText); ?>

                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="<?php echo e(route($item['route'], $item['hash'])); ?>"
                                    class="btn btn-sm rounded-pill px-3 fw-semibold"
                                    style="background: <?php echo e($badgeBg); ?>; color:#fff; font-size:.75rem;"
                                    onclick="event.stopPropagation();">
                                    <i class="ti ti-arrow-right me-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 border-top d-flex justify-content-center">
                <?php echo e($pendingItems->links()); ?>

            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php elseif($activeTab === 'pr_payment_full'): ?>
            
            <div class="px-4 py-2 border-bottom d-flex align-items-center justify-content-between" style="background:#E3F2FD;">
                <span class="small fw-bold text-uppercase" style="color:#0277BD;">
                    <i class="ti ti-cash me-1"></i>
                    PR Pending Payment (Tipe Full / Lunas Sekaligus) — <?php echo e($tabCounts['pr_payment_full']); ?> dokumen
                </span>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prFullPaymentItems->isEmpty()): ?>
            <div class="text-center py-5">
                <i class="ti ti-circle-check" style="font-size:3.5rem;color:#22c55e;"></i>
                <p class="mt-3 fw-semibold text-muted">Tidak ada PR Pending Payment (Full) saat ini.</p>
            </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#E3F2FD;">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold" style="color:#0277BD;">PR Number</th>
                            <th class="py-3 text-uppercase small fw-bold" style="color:#0277BD;">Vendor</th>
                            <th class="py-3 text-uppercase small fw-bold" style="color:#0277BD;">User</th>
                            <th class="py-3 text-uppercase small fw-bold text-end" style="color:#0277BD;">Jumlah Tagihan</th>
                            <th class="py-3 pe-4 text-uppercase small fw-bold text-end" style="color:#0277BD;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $prFullPaymentItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr class="dash-approval-row" style="cursor:pointer;"
                            onclick="window.location='<?php echo e(route('payment-requests.show', hashid_encode($pr->id_pr,'pr'))); ?>'">
                            <td class="ps-4">
                                <span class="fw-bold" style="color:#0277BD;"><?php echo e($pr->pr_number ?? 'Draft'); ?></span>
                                <br><small class="text-muted"><?php echo e(Str::limit($pr->subject, 35)); ?></small>
                            </td>
                            <td><span class="text-dark"><?php echo e(optional($pr->vendor)->vendor ?? '-'); ?></span></td>
                            <td><span class="text-dark"><?php echo e(optional($pr->user)->name ?? '-'); ?></span></td>
                            <td class="text-end">
                                <span class="fw-semibold">Rp <?php echo e(number_format($pr->total_tagihan, 0, ',', '.')); ?></span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="<?php echo e(route('payment-requests.show', hashid_encode($pr->id_pr,'pr'))); ?>"
                                    class="btn btn-sm rounded-pill px-3 fw-semibold"
                                    style="background:#0277BD; color:#fff; font-size:.75rem;"
                                    onclick="event.stopPropagation();">
                                    <i class="ti ti-arrow-right me-1"></i>Bayar
                                </a>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prFullPaymentItems instanceof \Illuminate\Pagination\LengthAwarePaginator && $prFullPaymentItems->hasPages()): ?>
            <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between">
                <span class="text-muted small">Menampilkan <?php echo e($prFullPaymentItems->firstItem()); ?>&ndash;<?php echo e($prFullPaymentItems->lastItem()); ?> dari <?php echo e($prFullPaymentItems->total()); ?> data</span>
                <div class="d-flex gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prFullPaymentItems->currentPage() > 1): ?>
                    <button wire:click="$set('monitorPage', <?php echo e($prFullPaymentItems->currentPage() - 1); ?>)" class="btn btn-sm btn-outline-secondary rounded-pill px-3"><i class="ti ti-chevron-left"></i></button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <span class="btn btn-sm btn-primary rounded-pill px-3 disabled"><?php echo e($prFullPaymentItems->currentPage()); ?> / <?php echo e($prFullPaymentItems->lastPage()); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prFullPaymentItems->hasMorePages()): ?>
                    <button wire:click="$set('monitorPage', <?php echo e($prFullPaymentItems->currentPage() + 1); ?>)" class="btn btn-sm btn-outline-secondary rounded-pill px-3"><i class="ti ti-chevron-right"></i></button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php elseif($activeTab === 'pr_partial_payment'): ?>
            
            <div class="px-4 py-2 border-bottom d-flex align-items-center justify-content-between" style="background:#EDE7F6;">
                <span class="small fw-bold text-uppercase" style="color:#5E35B1;">
                    <i class="ti ti-receipt-2 me-1"></i>
                    PR Bayar Sebagian (Parsial / Termin) — <?php echo e($tabCounts['pr_partial_payment']); ?> dokumen
                </span>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prPartialPaymentItems->isEmpty()): ?>
            <div class="text-center py-5">
                <i class="ti ti-circle-check" style="font-size:3.5rem;color:#22c55e;"></i>
                <p class="mt-3 fw-semibold text-muted">Tidak ada PR Bayar Sebagian yang aktif saat ini.</p>
            </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#EDE7F6;">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold" style="color:#5E35B1;">PR Number</th>
                            <th class="py-3 text-uppercase small fw-bold" style="color:#5E35B1;">Vendor</th>
                            <th class="py-3 text-uppercase small fw-bold" style="color:#5E35B1;">User</th>
                            <th class="py-3 text-uppercase small fw-bold text-end" style="color:#5E35B1;">Total Tagihan</th>
                            <th class="py-3 text-uppercase small fw-bold text-end" style="color:#5E35B1;">Sudah Dibayar</th>
                            <th class="py-3 text-uppercase small fw-bold text-end" style="color:#E53935;">Sisa Tagihan</th>
                            <th class="py-3 pe-4 text-uppercase small fw-bold text-end" style="color:#5E35B1;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $prPartialPaymentItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php
                            $tagihan = $pr->total_tagihan ?? 0;
                            $dibayar = $pr->total_dibayar ?? 0;
                            $sisa = $tagihan - $dibayar;
                        ?>
                        <tr class="dash-approval-row" style="cursor:pointer;"
                            onclick="window.location='<?php echo e(route('payment-requests.show', hashid_encode($pr->id_pr,'pr'))); ?>'">
                            <td class="ps-4">
                                <span class="fw-bold" style="color:#5E35B1;"><?php echo e($pr->pr_number ?? 'Draft'); ?></span>
                                <br><small class="text-muted"><?php echo e(Str::limit($pr->subject, 35)); ?></small>
                            </td>
                            <td><?php echo e(optional($pr->vendor)->vendor ?? '-'); ?></td>
                            <td><?php echo e(optional($pr->user)->name ?? '-'); ?></td>
                            <td class="text-end fw-semibold">Rp <?php echo e(number_format($tagihan, 0, ',', '.')); ?></td>
                            <td class="text-end" style="color:#2E7D32;">Rp <?php echo e(number_format($dibayar, 0, ',', '.')); ?></td>
                            <td class="text-end fw-bold" style="color:#E53935;">Rp <?php echo e(number_format($sisa, 0, ',', '.')); ?></td>
                            <td class="pe-4 text-end">
                                <a href="<?php echo e(route('payment-requests.show', hashid_encode($pr->id_pr,'pr'))); ?>"
                                    class="btn btn-sm rounded-pill px-3 fw-semibold"
                                    style="background:#5E35B1; color:#fff; font-size:.75rem;"
                                    onclick="event.stopPropagation();">
                                    <i class="ti ti-arrow-right me-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prPartialPaymentItems instanceof \Illuminate\Pagination\LengthAwarePaginator && $prPartialPaymentItems->hasPages()): ?>
            <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between">
                <span class="text-muted small">Menampilkan <?php echo e($prPartialPaymentItems->firstItem()); ?>&ndash;<?php echo e($prPartialPaymentItems->lastItem()); ?> dari <?php echo e($prPartialPaymentItems->total()); ?> data</span>
                <div class="d-flex gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prPartialPaymentItems->currentPage() > 1): ?>
                    <button wire:click="$set('monitorPage', <?php echo e($prPartialPaymentItems->currentPage() - 1); ?>)" class="btn btn-sm btn-outline-secondary rounded-pill px-3"><i class="ti ti-chevron-left"></i></button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <span class="btn btn-sm rounded-pill px-3 disabled" style="background:#5E35B1; color:#fff;"><?php echo e($prPartialPaymentItems->currentPage()); ?> / <?php echo e($prPartialPaymentItems->lastPage()); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($prPartialPaymentItems->hasMorePages()): ?>
                    <button wire:click="$set('monitorPage', <?php echo e($prPartialPaymentItems->currentPage() + 1); ?>)" class="btn btn-sm btn-outline-secondary rounded-pill px-3"><i class="ti ti-chevron-right"></i></button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php elseif($activeTab === 'sr_pending_settlement'): ?>
            
            <div class="px-4 py-2 border-bottom d-flex align-items-center justify-content-between" style="background:#E0F2F1;">
                <span class="small fw-bold text-uppercase" style="color:#00695C;">
                    <i class="ti ti-arrows-exchange me-1"></i>
                    SR Pending Settlement — <?php echo e($tabCounts['sr_pending_settlement']); ?> dokumen
                </span>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($srSettlementItems->isEmpty()): ?>
            <div class="text-center py-5">
                <i class="ti ti-circle-check" style="font-size:3.5rem;color:#22c55e;"></i>
                <p class="mt-3 fw-semibold text-muted">Tidak ada SR yang menunggu settlement saat ini.</p>
            </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background:#E0F2F1;">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bold" style="color:#00695C;">PR Number (Referensi)</th>
                            <th class="py-3 text-uppercase small fw-bold" style="color:#00695C;">User</th>
                            <th class="py-3 text-uppercase small fw-bold text-end" style="color:#00695C;">Total Penerimaan</th>
                            <th class="py-3 text-uppercase small fw-bold text-end" style="color:#00695C;">Total Dilaporkan</th>
                            <th class="py-3 text-uppercase small fw-bold text-end" style="color:#00695C;">Selisih</th>
                            <th class="py-3 pe-4 text-uppercase small fw-bold text-end" style="color:#00695C;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $srSettlementItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php
                            $penerimaan  = $sr->total_penerimaan ?? 0;
                            $dilaporkan  = $sr->total_dilaporkan ?? 0;
                            $selisih     = $dilaporkan - $penerimaan;
                            $selisihLabel = $selisih > 0 ? 'Nombok' : ($selisih < 0 ? 'Kembalian' : 'Balance');
                            $selisihColor = $selisih > 0 ? '#E53935' : ($selisih < 0 ? '#2E7D32' : '#546e7a');
                        ?>
                        <tr class="dash-approval-row" style="cursor:pointer;"
                            onclick="window.location='<?php echo e(route('settlement-reports.show', hashid_encode($sr->id_pr,'pr'))); ?>'">
                            <td class="ps-4">
                                <span class="fw-bold" style="color:#00695C;"><?php echo e($sr->pr_number ?? 'SR-'.$sr->id_sr); ?></span>
                                <br><small class="text-muted"><?php echo e(Str::limit($sr->subject, 35)); ?></small>
                            </td>
                            <td><?php echo e(optional($sr->user)->name ?? '-'); ?></td>
                            <td class="text-end fw-semibold">Rp <?php echo e(number_format($penerimaan, 0, ',', '.')); ?></td>
                            <td class="text-end fw-semibold">Rp <?php echo e(number_format($dilaporkan, 0, ',', '.')); ?></td>
                            <td class="text-end">
                                <span class="badge rounded-pill" style="background:<?php echo e($selisihColor); ?>22; color:<?php echo e($selisihColor); ?>; border:1px solid <?php echo e($selisihColor); ?>55; font-size:.75rem;">
                                    <?php echo e($selisihLabel); ?>: Rp <?php echo e(number_format(abs($selisih), 0, ',', '.')); ?>

                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="<?php echo e(route('settlement-reports.show', hashid_encode($sr->id_pr,'pr'))); ?>"
                                    class="btn btn-sm rounded-pill px-3 fw-semibold"
                                    style="background:#00695C; color:#fff; font-size:.75rem;"
                                    onclick="event.stopPropagation();">
                                    <i class="ti ti-arrow-right me-1"></i>Detail SR
                                </a>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($srSettlementItems instanceof \Illuminate\Pagination\LengthAwarePaginator && $srSettlementItems->hasPages()): ?>
            <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between">
                <span class="text-muted small">Menampilkan <?php echo e($srSettlementItems->firstItem()); ?>&ndash;<?php echo e($srSettlementItems->lastItem()); ?> dari <?php echo e($srSettlementItems->total()); ?> data</span>
                <div class="d-flex gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($srSettlementItems->currentPage() > 1): ?>
                    <button wire:click="$set('monitorPage', <?php echo e($srSettlementItems->currentPage() - 1); ?>)" class="btn btn-sm btn-outline-secondary rounded-pill px-3"><i class="ti ti-chevron-left"></i></button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <span class="btn btn-sm rounded-pill px-3 disabled" style="background:#00695C; color:#fff;"><?php echo e($srSettlementItems->currentPage()); ?> / <?php echo e($srSettlementItems->lastPage()); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($srSettlementItems->hasMorePages()): ?>
                    <button wire:click="$set('monitorPage', <?php echo e($srSettlementItems->currentPage() + 1); ?>)" class="btn btn-sm btn-outline-secondary rounded-pill px-3"><i class="ti ti-chevron-right"></i></button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <style>
        .dash-stat-card {
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .dash-stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .dash-approval-row:hover td {
            background-color: rgba(25, 118, 210, 0.04);
        }

        .dash-pulse-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #e53935;
            box-shadow: 0 0 0 0 rgba(229, 57, 53, .7);
            animation: pulse-dash 1.6s infinite;
        }

        @keyframes pulse-dash {
            0% {
                box-shadow: 0 0 0 0 rgba(229, 57, 53, .7);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(229, 57, 53, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(229, 57, 53, 0);
            }
        }

        .dash-welcome-card {
            background: linear-gradient(135deg, #1a237e, #3949ab) !important;
        }

        .dashboard-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            transition: all 0.2s ease;
            border-bottom: 3px solid transparent;
        }

        .dashboard-tabs .nav-link:hover {
            color: #1a237e;
            background: rgba(26, 35, 126, 0.03);
        }

        .dashboard-tabs .nav-link.active {
            color: #1a237e;
            background: transparent;
            border-bottom: 3px solid #1a237e;
        }

        .dashboard-tabs .badge {
            font-size: 0.65rem;
            padding: 0.35em 0.65em;
        }
    </style>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\dashboard.blade.php ENDPATH**/ ?>