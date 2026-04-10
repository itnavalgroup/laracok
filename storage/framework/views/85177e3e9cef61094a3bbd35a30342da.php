<div class="modal fade" id="ikbDetailModal" tabindex="-1" aria-labelledby="ikbDetailModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;" x-data="ikbDetailData()"
            x-init="initForm()">

            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold text-white text-uppercase" id="ikbDetailModalLabel">
                    <i class="ti ti-plus me-2"></i>
                    <span x-text="isEditing ? 'Edit Item' : 'Tambah Item'"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">

                <!-- Error -->
                <div class="alert alert-danger px-4 py-3 border-0 rounded-3 mb-4" x-show="errorMsg" x-cloak>
                    <i class="ti ti-alert-triangle me-2"></i> <span x-text="errorMsg"></span>
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="fw-bold small text-uppercase">Item Category <span
                                class="text-danger">*</span></label>
                        <select x-model="form.id_item_category" class="form-select select2-ikb-detail"
                            id="ikb_detail_category" <?php echo e($isInvCtrlEditMode ?? false ? 'disabled' : ''); ?>>
                            <option value="">-- Pilih Category --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($cat->id_item_category); ?>"><?php echo e($cat->item_category); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                        <span class="text-danger small" x-show="errors.id_item_category"
                            x-text="errors.id_item_category"></span>
                    </div>

                    <div class="col-md-12">
                        <label class="fw-bold small text-uppercase">Pilih Item <span
                                class="text-danger">*</span></label>
                        <select x-model="form.id_item" class="form-select select2-ikb-detail" id="ikb_detail_item"
                            <?php echo e($isInvCtrlEditMode ?? false ? 'disabled' : ''); ?>>
                            <option value="">-- Pilih Item --</option>
                        </select>
                        <span class="text-danger small" x-show="errors.id_item" x-text="errors.id_item"></span>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold small text-uppercase">Quantity Request <span
                                class="text-danger">*</span></label>
                        <input type="text" x-model="form.qty" class="form-control" placeholder="0.00"
                            onkeyup="formatNumber(this)">
                        <span class="text-danger small" x-show="errors.qty" x-text="errors.qty"></span>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold small text-uppercase">UOM Request <span
                                class="text-danger">*</span></label>
                        <select x-model="form.id_uom" class="form-select select2-ikb-detail" id="ikb_detail_uom"
                            <?php echo e($isInvCtrlEditMode ?? false ? 'disabled' : ''); ?>>
                            <option value="">-- Pilih UOM --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $uoms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($uom->id_uom); ?>"><?php echo e($uom->uom); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                        <span class="text-danger small" x-show="errors.id_uom" x-text="errors.id_uom"></span>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold small text-uppercase">Packaging <span class="text-danger">*</span></label>
                        <select x-model="form.id_packaging" class="form-select select2-ikb-detail"
                            id="ikb_detail_packaging" <?php echo e($isInvCtrlEditMode ?? false ? 'disabled' : ''); ?>>
                            <option value="">-- Pilih Packaging --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $packagings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($pkg->id_packaging); ?>"><?php echo e($pkg->packaging); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                        <span class="text-danger small" x-show="errors.id_packaging"
                            x-text="errors.id_packaging"></span>
                    </div>

                    <div class="col-md-12">
                        <label class="fw-bold small text-uppercase">Description <span
                                class="text-muted fw-normal">(Opsional)</span></label>
                        <textarea x-model="form.description" class="form-control" id="ikb_detail_description" rows="3"></textarea>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canViewContract): ?>
                        <div class="col-md-12">
                            <label class="fw-bold small text-uppercase">Contract <span
                                    class="text-muted fw-normal">(Opsional)</span></label>
                            <select x-model="form.id_contract" class="form-select select2-ikb-detail"
                                id="ikb_detail_contract">
                                <option value="">-- Tanpa Contract --</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <option value="<?php echo e($contract->id_contract); ?>"><?php echo e($contract->contract_number); ?>

                                    </option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </div>

            </div>

            <div class="modal-footer border-0 d-flex justify-content-between">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold text-uppercase"
                    data-bs-dismiss="modal">Batal</button>
                <button type="button" @click="submitForm()"
                    class="btn btn-primary rounded-pill px-5 fw-bold text-uppercase shadow-sm" :disabled="saving">
                    <span x-show="saving"><i class="ti ti-loader-2 me-2 spin"></i> Menyimpan...</span>
                    <span x-show="!saving"><i class="ti ti-device-floppy me-2"></i> Save Item</span>
                </button>
            </div>

        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        function ikbDetailData() {
            return {
                isEditing: false,
                detailId: null,
                saving: false,
                errorMsg: '',
                errors: {},
                allItems: <?php echo json_encode($items, 15, 512) ?>,
                isInvCtrlEditMode: <?php echo e($isInvCtrlEditMode ? 'true' : 'false'); ?>,

                form: {
                    id_item_category: '',
                    id_item: '',
                    qty: '',
                    id_uom: '',
                    id_packaging: '',
                    id_contract: '',
                    description: '',
                },

                initForm() {
                    document.addEventListener('livewire:initialized', () => {
                        Livewire.on('open-ikb-detail-form-js', (data) => {
                            this.openModal(data[0] || {});
                        });
                    });

                    this.$nextTick(() => this.initSelect2());
                },

                filteredItems() {
                    if (!this.form.id_item_category) return [];
                    return this.allItems.filter(i => String(i.id_item_category) === String(this.form.id_item_category));
                },

                openModal(data = {}) {
                    this.errorMsg = '';
                    this.errors = {};

                    if (data.detail) {
                        this.isEditing = true;
                        this.detailId = data.detail.id_ikb_detail;

                        Object.keys(this.form).forEach(k => {
                            let val = data.detail[k];
                            if (k === 'qty' && val !== null) {
                                // Format existing qty with dot decimal and comma thousands
                                this.form[k] = parseFloat(val).toLocaleString('en-US', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 2
                                });
                            } else {
                                this.form[k] = (val !== null && val !== undefined) ? String(val) : '';
                            }
                        });

                        // In InvCtrlEditMode, we still need to select the right item details to show them in disabled selects
                        if (this.isInvCtrlEditMode) {
                            // Force update item options so the item name appears, even if category is manually set here
                            this.$nextTick(() => {
                                this.updateItemOptions();
                            });
                        }
                    } else {
                        this.isEditing = false;
                        this.detailId = null;
                        this.resetForm();
                    }

                    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('ikbDetailModal'));
                    modal.show();

                    this.$nextTick(() => {
                        this.initSelect2();
                    });
                },

                resetForm() {
                    Object.keys(this.form).forEach(k => this.form[k] = '');
                },

                async submitForm() {
                    this.errors = {};
                    this.errorMsg = '';

                    // Client-side stock validation
                    if (this.form.id_item && this.form.qty) {
                        const selectedItem = this.allItems.find(i => String(i.id_item) === String(this.form.id_item));
                        if (selectedItem) {
                            let reqQty = parseFloat(this.form.qty.toString().replace(/,/g, ''));
                            let availStock = parseFloat(selectedItem.available_stock);

                            // If we are editing, the available_stock from backend already has our current
                            // detail's qty deducted as outcome OR reserved. But wait, we shouldn't fail if 
                            // editing our own qty. For simplicity, we trigger error if reqQty > availStock 
                            // + current qty (if edit). But let's let backend handle the strict check if edit,
                            // or just do a simple check:
                            if (!this.isEditing && reqQty > availStock) {
                                this.errors.qty = 'Quantity melampaui stok tersedia (' + availStock.toLocaleString(
                                    'en-US') + ')';
                                this.errorMsg = 'Periksa quantity request Anda.';
                                return;
                            }
                        }
                    }

                    this.saving = true;
                    try {
                        const result = await window.Livewire.find('<?php echo e($_instance->getId()); ?>').saveFromJs(this.form, this.detailId);
                        if (result && result.errors) {
                            this.errors = result.errors;
                            this.errorMsg = 'Lengkapi form yang wajib diisi.';
                        } else if (result && result.success) {
                            bootstrap.Modal.getOrCreateInstance(document.getElementById('ikbDetailModal')).hide();
                        } else if (result && result.error) {
                            this.errorMsg = result.error;
                        }
                    } catch (e) {
                        this.errorMsg = 'Terjadi kesalahan tak terduga.';
                        console.error(e);
                    } finally {
                        this.saving = false;
                    }
                },

                initSelect2() {
                    const modal = document.getElementById('ikbDetailModal');
                    document.querySelectorAll('.select2-ikb-detail').forEach(el => {
                        if ($(el).data('select2')) $(el).select2('destroy');

                        // Ensure the element itself has the disabled attribute if needed before init
                        if (this.isInvCtrlEditMode && el.id !== 'ikb_detail_qty') {
                            $(el).prop('disabled', true);
                        } else if (el.id !== 'ikb_detail_qty') {
                            $(el).prop('disabled', false);
                        }

                        $(el).select2({
                                dropdownParent: $(modal),
                                width: '100%'
                            })
                            .on('change', e => {
                                const mapping = {
                                    'ikb_detail_category': 'id_item_category',
                                    'ikb_detail_item': 'id_item',
                                    'ikb_detail_uom': 'id_uom',
                                    'ikb_detail_packaging': 'id_packaging',
                                    'ikb_detail_contract': 'id_contract',
                                };
                                const key = mapping[el.id];
                                if (key) {
                                    this.form[key] = e.target.value;
                                    if (key === 'id_item_category') {
                                        this.form.id_item = '';
                                        this.$nextTick(() => {
                                            this.updateItemOptions();
                                        });
                                    }
                                }
                            });
                    });
                    // Update UI
                    $('#ikb_detail_category').val(this.form.id_item_category).trigger('change.select2');
                    this.updateItemOptions();
                    $('#ikb_detail_uom').val(this.form.id_uom).trigger('change.select2');
                    $('#ikb_detail_packaging').val(this.form.id_packaging).trigger('change.select2');
                    $('#ikb_detail_contract').val(this.form.id_contract).trigger('change.select2');

                    // If InvCtrlEditMode, lock non-qty selects
                    if (this.isInvCtrlEditMode) {
                        $('#ikb_detail_category, #ikb_detail_item, #ikb_detail_uom, #ikb_detail_packaging, #ikb_detail_contract')
                            .prop('disabled', true);
                        // Force select2 to update its disabled visual state
                        $('#ikb_detail_category, #ikb_detail_item, #ikb_detail_uom, #ikb_detail_packaging, #ikb_detail_contract')
                            .trigger('change.select2');
                    } else {
                        $('#ikb_detail_category, #ikb_detail_item, #ikb_detail_uom, #ikb_detail_packaging, #ikb_detail_contract')
                            .prop('disabled', false);
                        $('#ikb_detail_category, #ikb_detail_item, #ikb_detail_uom, #ikb_detail_packaging, #ikb_detail_contract')
                            .trigger('change.select2');
                    }
                },

                updateItemOptions() {
                    const $itemSelect = $('#ikb_detail_item');
                    $itemSelect.empty().append('<option value="">-- Pilih Item --</option>');

                    this.filteredItems().forEach(item => {
                        const selected = String(item.id_item) === String(this.form.id_item) ? 'selected' : '';
                        const stockDisplay = parseFloat(item.available_stock).toLocaleString('en-US', {
                            minimumFractionDigits: 2
                        });
                        $itemSelect.append(
                            `<option value="${item.id_item}" ${selected}>${item.item_code} - ${item.item_name} (Stock: ${stockDisplay})</option>`
                        );
                    });

                    $itemSelect.trigger('change.select2');
                }
            };
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
    </script>
    <style>
        .spin {
            animation: spin 1s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\ikb\form-detail-modal.blade.php ENDPATH**/ ?>