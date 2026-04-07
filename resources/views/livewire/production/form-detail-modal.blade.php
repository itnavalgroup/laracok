<div class="modal fade" id="productionDetailModal" tabindex="-1" aria-labelledby="productionDetailModalLabel" aria-hidden="true" wire:ignore>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;" x-data="productionDetailData()" x-init="initForm()">

            <div class="modal-header py-3" :class="form.type === 'material' ? 'bg-danger text-white' : 'bg-success text-white'">
                <h5 class="modal-title fw-bold text-white text-uppercase" id="productionDetailModalLabel">
                    <i class="ti ti-plus me-2"></i>
                    <span x-text="isEditing ? 'Edit ' + (form.type === 'material' ? 'Material' : 'Result') : 'Tambah ' + (form.type === 'material' ? 'Material' : 'Result')"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">

                <!-- Error -->
                <div class="alert alert-danger px-4 py-3 border-0 rounded-3 mb-4" x-show="errorMsg" x-cloak>
                    <i class="ti ti-alert-triangle me-2"></i> <span x-text="errorMsg"></span>
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="fw-bold small text-uppercase">Item Category <span class="text-danger">*</span></label>
                        <div wire:ignore>
                            <select x-model="form.id_item_category" class="form-select select2-prod-detail" id="prod_detail_category">
                                <option value="">-- Pilih Category --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id_item_category }}">{{ $cat->item_category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger small" x-show="errors.id_item_category" x-text="errors.id_item_category"></span>
                    </div>

                    <div class="col-md-12">
                        <label class="fw-bold small text-uppercase">Pilih Item <span class="text-danger">*</span></label>
                        <div wire:ignore>
                            <select x-model="form.id_item" class="form-select select2-prod-detail" id="prod_detail_item">
                                <option value="">-- Pilih Item --</option>
                            </select>
                        </div>
                        <span class="text-danger small" x-show="errors.id_item" x-text="errors.id_item"></span>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold small text-uppercase">Quantity <span class="text-danger">*</span></label>
                        <input type="text" x-model="form.qty" class="form-control" placeholder="0.00" onkeyup="formatNumber(this)">
                        <span class="text-danger small" x-show="errors.qty" x-text="errors.qty"></span>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold small text-uppercase">UOM</label>
                        <div wire:ignore>
                            <select x-model="form.id_uom" class="form-select select2-prod-detail" id="prod_detail_uom">
                                <option value="">-- Pilih UOM --</option>
                                @foreach ($uoms as $uom)
                                    <option value="{{ $uom->id_uom }}">{{ $uom->uom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger small" x-show="errors.id_uom" x-text="errors.id_uom"></span>
                    </div>

                    <div class="col-md-4">
                        <label class="fw-bold small text-uppercase">Packaging</label>
                        <div wire:ignore>
                            <select x-model="form.id_packaging" class="form-select select2-prod-detail" id="prod_detail_packaging">
                                <option value="">-- Pilih Packaging --</option>
                                @foreach ($packagings as $pkg)
                                    <option value="{{ $pkg->id_packaging }}">{{ $pkg->packaging }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger small" x-show="errors.id_packaging" x-text="errors.id_packaging"></span>
                    </div>
                </div>

            </div>

            <div class="modal-footer border-0 d-flex justify-content-between">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold text-uppercase" data-bs-dismiss="modal">Batal</button>
                <button type="button" @click="submitForm()" class="btn btn-primary rounded-pill px-5 fw-bold text-uppercase shadow-sm" :class="form.type === 'material' ? 'btn-danger' : 'btn-success'" :disabled="saving">
                    <span x-show="saving"><i class="ti ti-loader-2 me-2 spin"></i> Menyimpan...</span>
                    <span x-show="!saving"><i class="ti ti-device-floppy me-2"></i> Save Item</span>
                </button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        function productionDetailData() {
            return {
                isEditing: false,
                detailId: null,
                saving: false,
                errorMsg: '',
                errors: {},
                matItems: @json($matItems),
                resItems: @json($resItems),

                form: {
                    type: 'material',
                    id_item_category: '',
                    id_item: '',
                    qty: '',
                    id_uom: '',
                    id_packaging: '',
                },

                initForm() {
                    document.addEventListener('livewire:initialized', () => {
                        Livewire.on('open-production-detail-form-js', (data) => {
                            this.openModal(data[0] || {});
                        });
                    });

                    this.$nextTick(() => this.initSelect2());
                },

                filteredItems() {
                    if (!this.form.id_item_category) return [];
                    let itemsSource = this.form.type === 'material' ? this.matItems : this.resItems;
                    return itemsSource.filter(i => String(i.id_item_category) === String(this.form.id_item_category));
                },

                openModal(data = {}) {
                    this.errorMsg = '';
                    this.errors = {};

                    if (data.type) {
                        this.form.type = data.type;
                    }

                    if (data.detail) {
                        this.isEditing = true;
                        this.detailId = data.detail.id_detail; // from our custom unified id

                        Object.keys(this.form).forEach(k => {
                            if (k !== 'type') {
                                let val = data.detail[k];
                                if (k === 'qty' && val !== null) {
                                    this.form[k] = parseFloat(val).toLocaleString('en-US', {
                                        minimumFractionDigits: 0,
                                        maximumFractionDigits: 2
                                    });
                                } else {
                                    this.form[k] = (val !== null && val !== undefined) ? String(val) : '';
                                }
                            }
                        });
                        
                    } else {
                        this.isEditing = false;
                        this.detailId = null;
                        this.resetForm();
                        if (data.type) this.form.type = data.type;
                    }

                    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('productionDetailModal'));
                    modal.show();

                    this.$nextTick(() => {
                        this.initSelect2();
                    });
                },

                resetForm() {
                    Object.keys(this.form).forEach(k => {
                        if (k !== 'type') this.form[k] = '';
                    });
                },

                async submitForm() {
                    this.errors = {};
                    this.errorMsg = '';

                    if (this.form.type === 'material' && this.form.id_item && this.form.qty) {
                        const selectedItem = this.matItems.find(i => String(i.id_item) === String(this.form.id_item));
                        if (selectedItem) {
                            let reqQty = parseFloat(this.form.qty.toString().replace(/,/g, ''));
                            let availStock = parseFloat(selectedItem.available_stock);

                            if (!this.isEditing && reqQty > availStock) {
                                this.errors.qty = 'Qty melampaui stok (' + availStock.toLocaleString('en-US') + ')';
                                this.errorMsg = 'Periksa quantity request Anda.';
                                return;
                            }
                        }
                    }

                    this.saving = true;
                    try {
                        const result = await this.$wire.saveFromJs(this.form, this.detailId);
                        if (result && result.errors) {
                            this.errors = result.errors;
                            this.errorMsg = 'Lengkapi form yang wajib diisi.';
                        } else if (result && result.success) {
                            bootstrap.Modal.getOrCreateInstance(document.getElementById('productionDetailModal')).hide();
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
                    const modal = document.getElementById('productionDetailModal');
                    if (!modal) return; // modal not in DOM yet, skip

                    try {
                        modal.querySelectorAll('.select2-prod-detail').forEach(el => {
                            if ($(el).data('select2')) $(el).select2('destroy');

                            $(el).select2({ dropdownParent: $(modal), width: '100%' })
                                .on('change', e => {
                                    const mapping = {
                                        'prod_detail_category': 'id_item_category',
                                        'prod_detail_item': 'id_item',
                                        'prod_detail_uom': 'id_uom',
                                        'prod_detail_packaging': 'id_packaging',
                                    };
                                    const key = mapping[el.id];
                                    if (key) {
                                        this.form[key] = e.target.value;
                                        if (key === 'id_item_category') {
                                            this.form.id_item = '';
                                            this.$nextTick(() => this.updateItemOptions());
                                        }
                                    }
                                });
                        });

                        $('#prod_detail_category').val(this.form.id_item_category).trigger('change.select2');
                        this.updateItemOptions();
                        $('#prod_detail_uom').val(this.form.id_uom).trigger('change.select2');
                        $('#prod_detail_packaging').val(this.form.id_packaging).trigger('change.select2');
                    } catch (e) {
                        console.warn('Select2 init error (non-fatal):', e);
                    }
                },

                updateItemOptions() {
                    const $itemSelect = $('#prod_detail_item');
                    $itemSelect.empty().append('<option value="">-- Pilih Item --</option>');

                    this.filteredItems().forEach(item => {
                        const selected = String(item.id_item) === String(this.form.id_item) ? 'selected' : '';
                        let stockDisplay = '';
                        if (this.form.type === 'material') {
                            stockDisplay = ` (Stock: ${parseFloat(item.available_stock).toLocaleString('en-US', {minimumFractionDigits: 2})})`;
                        }
                        $itemSelect.append(
                            `<option value="${item.id_item}" ${selected}>[${item.item_code}] ${item.item_name}${stockDisplay}</option>`
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
            let parts = value.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            input.value = parts.join(".");
        }
    </script>
    <style>
        .spin { animation: spin 1s linear infinite; display: inline-block; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        [x-cloak] { display: none !important; }
        .select2-container .select2-dropdown { z-index: 9999 !important; }
    </style>
@endpush
