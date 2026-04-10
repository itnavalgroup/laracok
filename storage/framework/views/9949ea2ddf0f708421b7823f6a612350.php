<div class="modal fade" id="srFormModal" tabindex="-1" aria-labelledby="srFormModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;"
            x-data="srFormData()"
            x-init="initForm()">

            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold text-white text-uppercase" id="srFormModalLabel">
                    <i class="ti ti-file-analytics me-2"></i>
                    <span x-text="isEditing ? 'Edit Settlement Report' : (isNewFromPr ? 'Create Settlement Report dari PR' : 'Create Settlement Report')"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4" style="max-height: calc(100vh - 200px); overflow-y: auto;">

                <!-- Error -->
                <div class="alert alert-danger px-4 py-3 border-0 rounded-3 mb-4" x-show="errorMsg" x-cloak>
                    <i class="ti ti-alert-triangle me-2"></i> <span x-text="errorMsg"></span>
                </div>

                <!-- BASIC INFORMATION -->
                <div class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Subject / Keperluan <span class="text-danger">*</span></label>
                            <textarea x-model="form.subject" class="form-control" rows="2" placeholder="Masukkan keperluan detail..."></textarea>
                            <span class="text-danger small" x-show="errors.subject" x-text="errors.subject"></span>
                        </div>
                    </div>
                </div>

                <div class="hr-border opacity-25 my-4"></div>

                <!-- COSTING & PAYMENT TERMS -->
                <div class="mb-4">
                    <h6 class="text-primary fw-bold text-uppercase mb-3 d-flex align-items-center gap-2">
                        <i class="ti ti-tags fs-5"></i> COSTING & PAYMENT TERMS
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Payment Method <span class="text-danger">*</span></label>
                            <select x-model="form.payment_method" class="form-select select2-sr" id="sr_payment_method" :disabled="isNewFromPr">
                                <option value="">-- Pilih Method --</option>
                                <option value="1">Transfer</option>
                                <option value="2">Cash</option>
                            </select>
                            <span class="text-danger small" x-show="errors.payment_method" x-text="errors.payment_method"></span>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="fw-bold small text-uppercase">Settlement Date <span class="text-danger">*</span></label>
                                    <input type="date" x-model="form.payment_due_date" class="form-control">
                                    <span class="text-danger small" x-show="errors.payment_due_date" x-text="errors.payment_due_date"></span>
                                    <small class="text-muted">Tanggal aktual settlement.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hr-border opacity-25 my-4"></div>

                <!-- EXTERNAL LINKS & REFERENCES -->
                <div class="mb-4">
                    <h6 class="text-primary fw-bold text-uppercase mb-3 d-flex align-items-center gap-2">
                        <i class="ti ti-link fs-5"></i> EXTERNAL LINKS & REFERENCES
                    </h6>
                    <div class="row g-3">


                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Vendor <span class="text-danger">*</span></label>
                            <select x-model="form.id_vendor" @change="onVendorChange()" class="form-select select2-sr" id="sr_vendor" :disabled="isNewFromPr">
                                <option value="">-- Pilih Vendor --</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($v->is_active == 1): ?>
                                <option value="<?php echo e($v->id_vendor); ?>"><?php echo e($v->vendor_name ?: $v->vendor); ?></option>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                            <span class="text-danger small" x-show="errors.id_vendor" x-text="errors.id_vendor"></span>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Vendor Email</label>
                            <select x-model="form.id_email_vendor" class="form-select" :disabled="!form.id_vendor || loadingVendor || isNewFromPr">
                                <option value="">-- Pilih Email Vendor --</option>
                                <template x-for="ve in vendorEmails" :key="ve.id_email_vendor">
                                    <option :value="ve.id_email_vendor" x-text="ve.email"></option>
                                </template>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Vendor Bank</label>
                            <select x-model="form.id_norek_vendor" class="form-select" :disabled="!form.id_vendor || loadingVendor || isNewFromPr">
                                <option value="">-- Opsional (Kosongkan bila target manual) --</option>
                                <template x-for="vb in vendorBanks" :key="vb.id_norek_vendor">
                                    <option :value="vb.id_norek_vendor" x-text="vb.nama_bank + ' - ' + vb.nama_penerima"></option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">No Invoice / Ref</label>
                            <input type="text" x-model="form.no_invoice" class="form-control" :disabled="isNewFromPr">
                            <span class="text-danger small" x-show="errors.no_invoice" x-text="errors.no_invoice"></span>
                        </div>



                        <div class="col-12 mt-3 w-100">
                            <label class="fw-bold small text-uppercase text-danger">Potongan Tambahan (Discount Header)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-muted">Rp</span>
                                <input type="text" class="form-control"
                                    :value="formatNumber(form.additional_discount)"
                                    @input="form.additional_discount = parseNumber($event.target.value)"
                                    placeholder="Masukkan nominal (opsional)...">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Manual Bank Target -->
                <template x-if="!form.id_norek_vendor">
                    <div>
                        <div class="hr-border opacity-25 my-4"></div>
                        <div class="mb-4 bg-light p-3 rounded-3 shadow-sm border">
                            <h6 class="text-primary fw-bold text-uppercase mb-3 d-flex align-items-center gap-2">
                                <i class="ti ti-credit-card fs-5"></i> TARGET PEMBAYARAN MANUAL
                            </h6>
                            <div class="row g-3">


                                <div class="col-12">
                                    <div class="x-small text-muted mb-2">(Diharuskan mengisi target karena tidak mengarah ke Rekening Vendor Terdaftar)</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold x-small text-uppercase mb-1">Nama Bank <span class="text-danger">*</span></label>
                                    <input type="text" x-model="form.nama_bank" class="form-control form-control-sm" placeholder="Contoh: BCA" :disabled="isNewFromPr">
                                    <span class="text-danger small" x-show="errors.nama_bank" x-text="errors.nama_bank"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold x-small text-uppercase mb-1">Nomor Rekening <span class="text-danger">*</span></label>
                                    <input type="text" x-model="form.norek" class="form-control form-control-sm" placeholder="0291039943" :disabled="isNewFromPr">
                                    <span class="text-danger small" x-show="errors.norek" x-text="errors.norek"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold x-small text-uppercase mb-1">Nama Penerima <span class="text-danger">*</span></label>
                                    <input type="text" x-model="form.nama_penerima" class="form-control form-control-sm" placeholder="Atas nama..." :disabled="isNewFromPr">
                                    <span class="text-danger small" x-show="errors.nama_penerima" x-text="errors.nama_penerima"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array(Auth::user()->level, [1]) || Auth::user()->hasPermission('loan.view')): ?>
                <div class="hr-border opacity-25 my-4"></div>
                <div class="mb-2">
                    <h6 class="text-primary fw-bold text-uppercase mb-3 d-flex align-items-center gap-2">
                        <i class="ti ti-wallet fs-5"></i> LOAN INFORMATION (INTERNAL / ADMIN)
                    </h6>
                    <div class="row g-3">


                        <div class="col-md-4">
                            <label class="fw-bold small text-uppercase">Tipe Loan</label>
                            <select x-model="form.id_loan" class="form-select" :disabled="isNewFromPr">
                                <option value="">-- Pilih Data Loan --</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ln): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($ln->id_loan); ?>"><?php echo e($ln->loan); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="modal-footer border-0 d-flex justify-content-between">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold text-uppercase" data-bs-dismiss="modal">Close</button>
                <div class="d-flex gap-2">
                    <button type="button" @click="submitForm()" class="btn btn-primary rounded-pill px-5 fw-bold text-uppercase shadow-sm" :disabled="saving">
                        <span x-show="saving"><i class="ti ti-loader-2 me-2 spin"></i> Menyimpan...</span>
                        <span x-show="!saving"><i class="ti ti-device-floppy me-2"></i> Save SR</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function srFormData() {
        return {
            isEditing: false,
            isNewFromPr: false,
            srId: null,
            saving: false,
            errorMsg: '',
            errors: {},
            loadingVendor: false,
            loadingCostTypes: false,

            vendorEmails: [],
            vendorBanks: [],
            costTypes: [],

            form: {
                id_pr: '', // if generated from PR
                number: '',
                id_doc_type: '3', // Default Settlement
                id_departement: '<?php echo e(Auth::user()->id_departement); ?>',
                id_cost_type: '',
                id_cost_category: '',
                id_branch: '',
                id_loan: '',
                id_company: '',
                id_vendor: '',
                id_email_vendor: '',
                id_norek_vendor: '',
                id_email_user: '',
                id_currency: '',
                subject: '',
                no_invoice: '',
                additional_discount: 0,
                nama_bank: '',
                nama_penerima: '',
                norek: '',
                payment_type_pr: '',
                po_number: '',
                payment_method: '',
                payment_due_date: '',
            },

            initForm() {
                document.addEventListener('livewire:initialized', () => {
                    Livewire.on('open-sr-form-js', (data) => {
                        this.openModal(data[0] || {});
                    });
                });

                this.$nextTick(() => this.initSelect2());
            },

            openModal(data = {}) {
                this.errorMsg = '';
                this.errors = {};
                this.vendorEmails = [];
                this.vendorBanks = [];
                this.costTypes = [];
                this.isNewFromPr = false;

                if (data.sr) {
                    if (data.is_new_from_pr) {
                        this.isEditing = false;
                        this.isNewFromPr = true;
                        this.srId = null;
                        this.form.id_pr = data.sr.id_pr; // store PR id for detail copy
                    } else {
                        this.isEditing = true;
                        this.srId = data.sr.id_sr;
                    }

                    Object.keys(this.form).forEach(k => {
                        const val = data.sr[k];
                        if (val && k === 'payment_due_date') {
                            this.form[k] = String(val).split('T')[0].split(' ')[0];
                        } else {
                            this.form[k] = (val !== null && val !== undefined) ? String(val) : '';
                        }
                    });

                    this.form.id_doc_type = '3'; // Force Settlement type
                    if (data.is_new_from_pr) {
                        this.form.payment_due_date = new Date().toISOString().split('T')[0];
                        if (data.sr.est_settlement_date) this.form.payment_due_date = String(data.sr.est_settlement_date).split('T')[0].split(' ')[0];
                    }

                    const savedCostType = this.form.id_cost_type;
                    const savedEmailVendor = this.form.id_email_vendor;
                    const savedNorekVendor = this.form.id_norek_vendor;

                    this.form.id_cost_type = '';
                    this.form.id_email_vendor = '';
                    this.form.id_norek_vendor = '';

                    // Reload dynamic details to populate dropdowns even if disabled
                    if (this.form.id_cost_category) {
                        this.loadCostTypes(this.form.id_cost_category, savedCostType);
                    }
                    if (this.form.id_vendor) {
                        this.loadVendorDetails(this.form.id_vendor, savedEmailVendor, savedNorekVendor);
                    }
                } else {
                    this.isEditing = false;
                    this.srId = null;
                    this.resetForm();
                }

                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('srFormModal'));
                modal.show();

                this.$nextTick(() => {
                    this.initSelect2();
                    // trigger refresh of select2 elements after data is loaded so they show correct values even if disabled
                    setTimeout(() => {
                        $('.select2-sr').trigger('change.select2');
                    }, 100);
                });
            },

            resetForm() {
                Object.keys(this.form).forEach(k => this.form[k] = '');
                this.form.id_doc_type = '3';
                this.form.additional_discount = 0;
                this.form.id_departement = '<?php echo e(Auth::user()->id_departement); ?>';
                this.form.payment_due_date = new Date().toISOString().split('T')[0];
            },

            async loadVendorDetails(vendorId, prevEmailId = null, prevBankId = null) {
                this.vendorEmails = [];
                this.vendorBanks = [];
                this.loadingVendor = true;
                try {
                    const res = await fetch(`/api/vendors/${vendorId}/details`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        }
                    });
                    const json = await res.json();
                    this.vendorEmails = json.emails || [];
                    this.vendorBanks = json.banks || [];
                    await this.$nextTick();
                    if (prevEmailId) this.form.id_email_vendor = String(prevEmailId);
                    if (prevBankId) this.form.id_norek_vendor = String(prevBankId);
                } catch (e) {
                    console.error(e);
                } finally {
                    this.loadingVendor = false;
                }
            },

            async loadCostTypes(categoryId, prevTypeId = null) {
                this.costTypes = [];
                this.loadingCostTypes = true;
                try {
                    const res = await fetch(`/api/cost-categories/${categoryId}/types`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        }
                    });
                    const json = await res.json();
                    this.costTypes = json || [];
                    await this.$nextTick();
                    if (prevTypeId) this.form.id_cost_type = String(prevTypeId);
                } catch (e) {
                    console.error(e);
                } finally {
                    this.loadingCostTypes = false;
                }
            },

            async onVendorChange() {
                const vendorId = this.form.id_vendor;
                this.form.id_email_vendor = '';
                this.form.id_norek_vendor = '';
                await this.loadVendorDetails(vendorId);
            },

            async onCostCategoryChange() {
                const categoryId = this.form.id_cost_category;
                this.form.id_cost_type = '';
                await this.loadCostTypes(categoryId);
            },

            async submitForm() {
                this.errors = {};
                this.errorMsg = '';
                this.saving = true;
                try {
                    const result = await window.Livewire.find('<?php echo e($_instance->getId()); ?>').saveFromJs(this.form, this.srId);
                    if (result && result.errors) {
                        this.errors = result.errors;
                        this.errorMsg = 'Lengkapi form yang wajib diisi.';
                    } else if (result && result.success) {
                        bootstrap.Modal.getOrCreateInstance(document.getElementById('srFormModal')).hide();
                        if (result.redirect) {
                            window.location.href = result.redirect;
                        }
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

            formatNumber(val) {
                if (!val) return '';
                return Number(val).toLocaleString('id-ID');
            },

            parseNumber(str) {
                return parseFloat(str.replace(/\./g, '').replace(',', '.')) || 0;
            },

            initSelect2() {
                const modal = document.getElementById('srFormModal');
                document.querySelectorAll('.select2-sr').forEach(el => {
                    if ($(el).data('select2')) $(el).select2('destroy');
                    const fieldKey = el.id.replace('sr_', 'id_').replace('sr_', '');
                    $(el).select2({
                            dropdownParent: $(modal),
                            width: '100%',
                            disabled: this.isNewFromPr || el.hasAttribute('disabled') // Re-apply disabled state in Select2 instance
                        })
                        .on('change', e => {
                            const mapping = {
                                'sr_doc_type': 'id_doc_type',
                                'sr_departement': 'id_departement',
                                'sr_company': 'id_company',
                                'sr_branch': 'id_branch',
                                'sr_cost_category': 'id_cost_category',
                                'sr_currency': 'id_currency',
                                'sr_payment_type': 'payment_type_pr',
                                'sr_payment_method': 'payment_method',
                                'sr_vendor': 'id_vendor',
                                'sr_user_email': 'id_email_user',
                            };
                            const key = mapping[el.id];
                            if (key) {
                                this.form[key] = e.target.value;
                                if (el.id === 'sr_vendor') this.onVendorChange();
                                if (el.id === 'sr_cost_category') this.onCostCategoryChange();
                            }
                        });
                });
            }
        };
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
</style>
<?php $__env->stopPush(); ?>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\settlement-reports\form-modal.blade.php ENDPATH**/ ?>