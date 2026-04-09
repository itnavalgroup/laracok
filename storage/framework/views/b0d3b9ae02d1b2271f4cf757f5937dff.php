<div wire:listen="contract-refresh" wire:poll.30s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none">DASHBOARD</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(route('contracts.index')); ?>" class="text-decoration-none">CONTRACT</a></li>
                    <li class="breadcrumb-item active"><?php echo e($this->contract->contract_number); ?></li>
                </ol>
            </nav>
        </div>

        <?php $c = $this->contract; ?>

        <!-- Info Panel -->
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header d-flex align-items-center justify-content-between py-3"
                    style="background:linear-gradient(135deg,#0f4c75,#1b6ca8);border-radius:12px 12px 0 0;">
                    <div>
                        <h5 class="text-white fw-bold mb-0"><?php echo e($c->contract_number); ?></h5>
                        <small class="text-white-50">Dibuat: <?php echo e($c->created_at->format('d M Y')); ?></small>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->canEdit()): ?>
                    <button type="button" wire:click="$dispatch('open-contract-form', { id: <?php echo e($c->id_contract); ?> })"
                        class="btn btn-sm btn-light rounded-pill px-3">
                        <i class="ti ti-edit me-1"></i>Edit
                    </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted small" style="width:130px;">Perusahaan</td>
                            <td class="fw-semibold small"><?php echo e(optional($c->company)->company_name ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted small">Departemen</td>
                            <td class="small"><?php echo e(optional($c->departement)->departement ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted small">User</td>
                            <td class="small"><?php echo e(optional($c->user)->name ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted small">Mulai</td>
                            <td class="small"><?php echo e($c->start_date ? \Carbon\Carbon::parse($c->start_date)->format('d M Y') : '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted small">Selesai</td>
                            <td class="small"><?php echo e($c->end_date ? \Carbon\Carbon::parse($c->end_date)->format('d M Y') : '-'); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted small">Deskripsi</td>
                            <td class="small"><?php echo e($c->description ?: '-'); ?></td>
                        </tr>
                    </table>

                    <!-- Attachment -->
                    <div class="mt-3 pt-3 border-top">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="fw-semibold small"><i class="ti ti-paperclip me-1"></i>File Kontrak</span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->canEdit()): ?>
                            <button wire:click="$dispatch('openContractAttachmentModal', [<?php echo e($c->id_contract); ?>])"
                                class="btn btn-sm btn-outline-primary rounded-pill px-3 small">
                                <i class="ti ti-upload me-1"></i><?php echo e($c->file_name ? 'Ganti' : 'Upload'); ?>

                            </button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($c->file_name): ?>
                        <a href="<?php echo e(asset('assets/contract/'.$c->file_name)); ?>" target="_blank"
                            class="btn btn-sm btn-light rounded-pill px-3 small">
                            <i class="ti ti-download me-1"></i><?php echo e($c->file_name); ?>

                        </a>
                        <?php else: ?>
                        <span class="text-muted small">Belum ada file</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Items Panel -->
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header d-flex align-items-center justify-content-between py-3" style="background:#f8f9fa;">
                    <span class="fw-bold small text-uppercase"><i class="ti ti-list-details me-1"></i>Item Kontrak</span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->canEdit()): ?>
                    <button wire:click="$dispatch('openContractDetailModal')"
                        class="btn btn-sm rounded-pill px-3 fw-semibold"
                        style="background:#0f4c75;color:#fff;">
                        <i class="ti ti-plus me-1"></i>Tambah Item
                    </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="card-body p-0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($c->details->isEmpty()): ?>
                    <div class="text-center py-5">
                        <i class="ti ti-package-off fs-1 text-muted opacity-50"></i>
                        <p class="text-muted mt-3 small">Belum ada item. Klik "+ Tambah Item" untuk menambahkan.</p>
                    </div>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 small">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">#</th>
                                    <th>Kategori / Item</th>
                                    <th class="text-end">Qty Kontrak</th>
                                    <th class="text-end text-success">Sudah Kirim</th>
                                    <th class="text-end text-info">Dalam Proses</th>
                                    <th class="text-end text-warning">Sisa</th>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->canEdit()): ?> <th class="text-center pe-3">Aksi</th> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $c->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php
                                    $shipped = (float)\App\Models\IkbDetail::where('id_contract', $c->id_contract)
                                        ->where('id_item', $detail->id_item)
                                        ->whereNull('deleted_at')
                                        ->whereHas('ikb', fn($q) => $q->where('status', 9))
                                        ->sum('qty');
                                    $inProcess = (float)\App\Models\IkbDetail::where('id_contract', $c->id_contract)
                                        ->where('id_item', $detail->id_item)
                                        ->whereNull('deleted_at')
                                        ->whereHas('ikb', fn($q) => $q->whereBetween('status', [1, 8]))
                                        ->sum('qty');
                                    $remaining = $detail->qty - $shipped - $inProcess;
                                ?>
                                <tr <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('detail-{{ $detail->id_contract_detail }}', get_defined_vars()); ?>wire:key="detail-<?php echo e($detail->id_contract_detail); ?>">
                                    <td class="ps-3 text-muted"><?php echo e($i+1); ?></td>
                                    <td>
                                        <div class="fw-semibold"><?php echo e(optional($detail->item)->item_name ?? '-'); ?></div>
                                        <div class="text-muted small"><?php echo e(optional($detail->itemCategory)->item_category ?? '-'); ?></div>
                                    </td>
                                    <td class="text-end fw-semibold"><?php echo e(number_format($detail->qty,0,',','.')); ?></td>
                                    <td class="text-end text-success"><?php echo e(number_format($shipped,0,',','.')); ?></td>
                                    <td class="text-end text-info"><?php echo e(number_format($inProcess,0,',','.')); ?></td>
                                    <td class="text-end fw-bold <?php echo e($remaining > 0 ? 'text-warning' : 'text-success'); ?>">
                                        <?php echo e(number_format($remaining,0,',','.')); ?>

                                    </td>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->canEdit()): ?>
                                    <td class="text-center pe-3">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button wire:click="$dispatch('openContractDetailModal', <?php echo e($detail->id_contract_detail); ?>)"
                                                class="btn btn-icon bg-light-warning rounded-circle btn-sm" title="Edit">
                                                <i class="ti ti-edit fs-6"></i>
                                            </button>
                                            <button onclick="showConfirm({ title: 'Hapus Item', message: 'Yakin hapus item ini?', type: 'danger', onConfirm: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>').dispatch('delete-contract-detail', [<?php echo e($detail->id_contract_detail); ?>]) })"
                                                class="btn btn-icon bg-light-danger rounded-circle btn-sm" title="Hapus">
                                                <i class="ti ti-trash fs-6"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('contracts.detail-modal', ['contractId' => $this->contractId]);

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3185337468-4', $key);

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
[$__name, $__params] = $__split('contracts.attachment-modal', ['contractId' => $this->contractId]);

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3185337468-5', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('show-contract-attachment-modal', () => {
                bootstrap.Modal.getOrCreateInstance(document.getElementById('contractAttachmentModal')).show();
            });
            Livewire.on('hide-contract-attachment-modal', () => {
                bootstrap.Modal.getOrCreateInstance(document.getElementById('contractAttachmentModal')).hide();
            });
            Livewire.on('open-contract-detail-modal', () => {
                bootstrap.Modal.getOrCreateInstance(document.getElementById('contractDetailModal')).show();
            });
            Livewire.on('close-contract-detail-modal', () => {
                bootstrap.Modal.getOrCreateInstance(document.getElementById('contractDetailModal')).hide();
            });
        });
    </script>
</div>
<?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\contracts\show.blade.php ENDPATH**/ ?>