<div class="modal fade" id="productionDetailModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($production): ?>
            <div class="modal-header bg-light">
                <h5 class="modal-title">
                    Detail Production: <strong><?php echo e($production->production_number); ?></strong>
                    <?php
                        $statusBadge = [
                            0 => ['label' => 'Draft', 'color' => 'secondary'],
                            1 => ['label' => 'Processed', 'color' => 'warning'],
                            2 => ['label' => 'Finished', 'color' => 'success'],
                            3 => ['label' => 'Canceled', 'color' => 'danger'],
                        ];
                        $badge = $statusBadge[$production->status] ?? ['label' => 'Unknown', 'color' => 'dark'];
                    ?>
                    <span class="badge bg-<?php echo e($badge['color']); ?> ms-2"><?php echo e($badge['label']); ?></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                
                <div class="row mb-4">
                    <div class="col-md-3"><strong>Date:</strong> <?php echo e($production->production_date); ?></div>
                    <div class="col-md-3"><strong>Warehouse:</strong> <?php echo e($production->warehouse->warehouse_name ?? '-'); ?></div>
                    <div class="col-md-3"><strong>Department:</strong> <?php echo e($production->departement->departement ?? '-'); ?></div>
                    <div class="col-md-3"><strong>Company:</strong> <?php echo e($production->company->company_name ?? '-'); ?></div>
                </div>

                <div class="row">
                    <!-- MATERIALS (Inputs) -->
                    <div class="col-md-6 border-end">
                        <h6 class="fw-bold text-danger"><i class="ti ti-minus"></i> Raw Materials (Inputs)</h6>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($production->status == 0): ?>
                        <div class="card bg-light mb-3 p-2">
                            <form wire:submit.prevent="addMaterial" class="d-flex gap-2">
                                <select wire:model="mat_id_item" class="form-select" required>
                                    <option value="">-- Pilih Item --</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($item->id_item); ?>"><?php echo e($item->item); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <input type="number" step="0.01" wire:model="mat_qty" class="form-control" placeholder="Qty" style="width: 100px" required>
                                <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-plus"></i></button>
                            </form>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $production->materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <td><?php echo e($mat->item->item ?? 'Unknown'); ?></td>
                                    <td><?php echo e($mat->qty); ?> <?php echo e($mat->uom->uom ?? ''); ?></td>
                                    <td>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($production->status == 0): ?>
                                        <button wire:click="deleteMaterial(<?php echo e($mat->id_production_material); ?>)" class="btn btn-sm btn-link text-danger p-0"><i class="ti ti-trash"></i></button>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- RESULTS (Outputs) -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-success"><i class="ti ti-plus"></i> Production Results (Outputs)</h6>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($production->status == 0): ?>
                        <div class="card bg-light mb-3 p-2">
                            <form wire:submit.prevent="addResult" class="d-flex gap-2">
                                <select wire:model="res_id_item" class="form-select" required>
                                    <option value="">-- Pilih Produk --</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <option value="<?php echo e($item->id_item); ?>"><?php echo e($item->item); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                                <input type="number" step="0.01" wire:model="res_qty" class="form-control" placeholder="Qty" style="width: 100px" required>
                                <button type="submit" class="btn btn-success btn-sm"><i class="ti ti-plus"></i></button>
                            </form>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Produk Jadi</th>
                                    <th>Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $production->results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr>
                                    <td><?php echo e($res->item->item ?? 'Unknown'); ?></td>
                                    <td><?php echo e($res->qty); ?> <?php echo e($res->uom->uom ?? ''); ?></td>
                                    <td>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($production->status == 0): ?>
                                        <button wire:click="deleteResult(<?php echo e($res->id_production_result); ?>)" class="btn btn-sm btn-link text-danger p-0"><i class="ti ti-trash"></i></button>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer bg-light d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <div class="d-flex gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($production->status == 0): ?>
                        <button type="button" onclick="showConfirm({title:'Process?',message:'Set status ke Processed?',type:'warning',onConfirm:()=>window.Livewire.find('<?php echo e($_instance->getId()); ?>').processProduction()})" class="btn btn-warning"><i class="ti ti-settings"></i> Process</button>
                    <?php elseif($production->status == 1): ?>
                        <button type="button" onclick="showConfirm({title:'Cancel?',message:'Set status ke Canceled?',type:'danger',onConfirm:()=>window.Livewire.find('<?php echo e($_instance->getId()); ?>').cancelProduction()})" class="btn btn-danger"><i class="ti ti-x"></i> Cancel</button>
                        <button type="button" onclick="showConfirm({title:'Finish?',message:'Selesaikan production dan update inventory?',type:'success',onConfirm:()=>window.Livewire.find('<?php echo e($_instance->getId()); ?>').finishProduction()})" class="btn btn-success"><i class="ti ti-check"></i> Finish Production</button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\production\detail-modal.blade.php ENDPATH**/ ?>