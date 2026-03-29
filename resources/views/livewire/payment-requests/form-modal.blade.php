<div class="modal fade" id="prFormModal" tabindex="-1" aria-labelledby="prFormModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;"
            x-data="prFormData()"
            x-init="initForm()">

            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold text-white text-uppercase" id="prFormModalLabel">
                    <i class="ti ti-plus me-2"></i>
                    <span x-text="isEditing ? 'Edit Payment Request' : 'Create Payment Request'"></span>
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
                    <h6 class="text-primary fw-bold text-uppercase mb-3 d-flex align-items-center gap-2">
                        <i class="ti ti-file-description fs-5"></i> BASIC INFORMATION
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Tipe Dokumen <span class="text-danger">*</span></label>
                            <select x-model="form.id_doc_type" class="form-select select2-pr" id="pr_doc_type">
                                <option value="">-- Pilih Tipe --</option>
                                @foreach($docTypes as $doc)
                                <option value="{{ $doc->id_doc_type }}">{{ $doc->doc_type }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" x-show="errors.id_doc_type" x-text="errors.id_doc_type"></span>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Nomor Dokumen</label>
                            <input type="text" x-model="form.number" class="form-control"
                                :disabled="isEditing"
                                :placeholder="isEditing ? 'Nomor tidak bisa diubah saat edit' : 'Opsional (Auto-Generate)'"
                                :class="isEditing ? 'bg-secondary bg-opacity-10 text-muted' : ''">
                            <div class="form-text small" style="font-size: 0.75rem;" x-show="!isEditing">
                                Biarkan kosong jika auto-generate.
                            </div>
                            <div class="form-text small text-warning" style="font-size: 0.75rem;" x-show="isEditing">
                                <i class="ti ti-lock me-1"></i>Nomor dokumen tidak dapat diubah.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Departemen <span class="text-danger">*</span></label>
                            <select x-model="form.id_departement" class="form-select select2-pr" id="pr_departement"
                                @if(Auth::user()->level != 1) disabled @endif>
                                <option value="">-- Pilih Departemen --</option>
                                @foreach($departements as $dept)
                                <option value="{{ $dept->id_departement }}">{{ $dept->departement }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Company <span class="text-danger">*</span></label>
                            <select x-model="form.id_company" class="form-select select2-pr" id="pr_company">
                                <option value="">-- Pilih Company --</option>
                                @foreach($companies as $comp)
                                <option value="{{ $comp->id_company }}">{{ $comp->company }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" x-show="errors.id_company" x-text="errors.id_company"></span>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Branch <span class="text-danger">*</span></label>
                            <select x-model="form.id_branch" class="form-select select2-pr" id="pr_branch">
                                <option value="">-- Pilih Branch --</option>
                                @foreach($branches as $br)
                                <option value="{{ $br->id_branch }}">{{ $br->branch }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" x-show="errors.id_branch" x-text="errors.id_branch"></span>
                        </div>

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
                            <label class="fw-bold small text-uppercase">Cost Category <span class="text-danger">*</span></label>
                            <select x-model="form.id_cost_category" @change="onCostCategoryChange()" class="form-select select2-pr" id="pr_cost_category">
                                <option value="">-- Pilih Category --</option>
                                @foreach($costCategories as $cc)
                                <option value="{{ $cc->id_cost_category }}">{{ $cc->cost_category }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" x-show="errors.id_cost_category" x-text="errors.id_cost_category"></span>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Cost Type <span class="text-danger">*</span></label>
                            <select x-model="form.id_cost_type" class="form-select" :disabled="!form.id_cost_category || loadingCostTypes">
                                <option value="">-- Pilih Cost Type --</option>
                                <template x-for="ct in costTypes" :key="ct.id_cost_type">
                                    <option :value="ct.id_cost_type" x-text="ct.cost_type"></option>
                                </template>
                            </select>
                            <span class="text-danger small" x-show="errors.id_cost_type" x-text="errors.id_cost_type"></span>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Currency <span class="text-danger">*</span></label>
                            <select x-model="form.id_currency" class="form-select select2-pr" id="pr_currency">
                                <option value="">-- Default (IDR) --</option>
                                @foreach($currencies as $cur)
                                <option value="{{ $cur->id_currency }}">{{ $cur->code }} - {{ $cur->country }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" x-show="errors.id_currency" x-text="errors.id_currency"></span>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Payment Type <span class="text-danger">*</span></label>
                            <select x-model="form.payment_type_pr" class="form-select select2-pr" id="pr_payment_type">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="1">Parsial</option>
                                <option value="2">Full Payment</option>
                            </select>
                            <span class="text-danger small" x-show="errors.payment_type_pr" x-text="errors.payment_type_pr"></span>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Payment Method <span class="text-danger">*</span></label>
                            <select x-model="form.payment_method" class="form-select select2-pr" id="pr_payment_method">
                                <option value="">-- Pilih Method --</option>
                                <option value="1">Transfer</option>
                                <option value="2">Cash</option>
                            </select>
                            <span class="text-danger small" x-show="errors.payment_method" x-text="errors.payment_method"></span>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6">
                                    <label class="fw-bold small text-uppercase">Payment Due Date <span class="text-danger">*</span></label>
                                    <input type="date" x-model="form.payment_due_date" class="form-control">
                                    <span class="text-danger small" x-show="errors.payment_due_date" x-text="errors.payment_due_date"></span>
                                </div>
                                <div class="col-6">
                                    <label class="fw-bold small text-uppercase text-nowrap">Est. Settlement <span x-show="form.id_doc_type == 2" class="text-danger">*</span></label>
                                    <input type="date" x-model="form.est_settlement_date" class="form-control">
                                    <span class="text-danger small" x-show="errors.est_settlement_date" x-text="errors.est_settlement_date"></span>
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
                            <select x-model="form.id_vendor" @change="onVendorChange()" class="form-select select2-pr" id="pr_vendor">
                                <option value="">-- Pilih Vendor --</option>
                                @foreach($vendors as $v)
                                @if($v->is_active == 1)
                                <option value="{{ $v->id_vendor }}">{{ $v->vendor_name ?: $v->vendor }}</option>
                                @endif
                                @endforeach
                            </select>
                            <span class="text-danger small" x-show="errors.id_vendor" x-text="errors.id_vendor"></span>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Vendor Email</label>
                            <select x-model="form.id_email_vendor" class="form-select" :disabled="!form.id_vendor || loadingVendor">
                                <option value="">-- Pilih Email Vendor --</option>
                                <template x-for="ve in vendorEmails" :key="ve.id_email_vendor">
                                    <option :value="ve.id_email_vendor" x-text="ve.email"></option>
                                </template>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Vendor Bank</label>
                            <select x-model="form.id_norek_vendor" class="form-select" :disabled="!form.id_vendor || loadingVendor">
                                <option value="">-- Opsional (Kosongkan bila target manual) --</option>
                                <template x-for="vb in vendorBanks" :key="vb.id_norek_vendor">
                                    <option :value="vb.id_norek_vendor" x-text="vb.nama_bank + ' - ' + vb.nama_penerima"></option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">User Email <span class="text-danger">*</span></label>
                            <select x-model="form.id_email_user" class="form-select select2-pr" id="pr_user_email">
                                <option value="">-- Email Pengaju --</option>
                                @foreach($userEmails as $ue)
                                <option value="{{ $ue->id_email_user }}">{{ $ue->email }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" x-show="errors.id_email_user" x-text="errors.id_email_user"></span>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">PO Number</label>
                            <input type="text" x-model="form.po_number" class="form-control" placeholder="Opsional">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">No Invoice / Ref <span class="text-danger">*</span></label>
                            <input type="text" x-model="form.no_invoice" class="form-control">
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
                                    <input type="text" x-model="form.nama_bank" class="form-control form-control-sm" placeholder="Contoh: BCA">
                                    <span class="text-danger small" x-show="errors.nama_bank" x-text="errors.nama_bank"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold x-small text-uppercase mb-1">Nomor Rekening <span class="text-danger">*</span></label>
                                    <input type="text" x-model="form.norek" class="form-control form-control-sm" placeholder="0291039943">
                                    <span class="text-danger small" x-show="errors.norek" x-text="errors.norek"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold x-small text-uppercase mb-1">Nama Penerima <span class="text-danger">*</span></label>
                                    <input type="text" x-model="form.nama_penerima" class="form-control form-control-sm" placeholder="Atas nama...">
                                    <span class="text-danger small" x-show="errors.nama_penerima" x-text="errors.nama_penerima"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                @if(in_array(Auth::user()->level, [1]) || Auth::user()->hasPermission('loan.view'))
                <div class="hr-border opacity-25 my-4"></div>
                <div class="mb-2">
                    <h6 class="text-primary fw-bold text-uppercase mb-3 d-flex align-items-center gap-2">
                        <i class="ti ti-wallet fs-5"></i> LOAN INFORMATION (INTERNAL / ADMIN)
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="fw-bold small text-uppercase">Tipe Loan</label>
                            <select x-model="form.id_loan" class="form-select">
                                <option value="">-- Pilih Data Loan --</option>
                                @foreach($loans as $ln)
                                <option value="{{ $ln->id_loan }}">{{ $ln->loan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="modal-footer border-0 d-flex justify-content-between">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold text-uppercase" data-bs-dismiss="modal">Close</button>
                <div class="d-flex gap-2">
                    <button type="button" @click="submitForm()" class="btn btn-primary rounded-pill px-5 fw-bold text-uppercase shadow-sm" :disabled="saving">
                        <span x-show="saving"><i class="ti ti-loader-2 me-2 spin"></i> Menyimpan...</span>
                        <span x-show="!saving"><i class="ti ti-device-floppy me-2"></i> Save Tagihan</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    function prFormData() {
        return {
            isEditing: false,
            prId: null,
            saving: false,
            errorMsg: '',
            errors: {},
            loadingVendor: false,
            loadingCostTypes: false,

            vendorEmails: [],
            vendorBanks: [],
            costTypes: [],

            form: {
                number: '',
                id_doc_type: '',
                id_departement: '{{ Auth::user()->id_departement }}',
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
                est_settlement_date: '',
            },

            initForm() {
                // Listen for the Livewire event to open the modal
                document.addEventListener('livewire:initialized', () => {
                    Livewire.on('open-pr-form-js', (data) => {
                        this.openModal(data[0] || {});
                    });
                });

                // For initial Select2 setup
                this.$nextTick(() => this.initSelect2());
            },

            openModal(data = {}) {
                this.errorMsg = '';
                this.errors = {};
                this.vendorEmails = [];
                this.vendorBanks = [];
                this.costTypes = [];

                if (data.pr) {
                    // Edit mode — simpan semua nilai dulu
                    this.isEditing = true;
                    this.prId = data.pr.id_pr;

                    // Konversi semua nilai ke string agar x-model cocok dengan value option HTML
                    Object.keys(this.form).forEach(k => {
                        const val = data.pr[k];
                        if (val && (k === 'payment_due_date' || k === 'est_settlement_date')) {
                            this.form[k] = String(val).split('T')[0].split(' ')[0];
                        } else {
                            this.form[k] = (val !== null && val !== undefined) ? String(val) : '';
                        }
                    });

                    // Simpan ID dinamis sebelum dipanggil fetch (yang akan di-restore setelah load)
                    const savedCostType = this.form.id_cost_type;
                    const savedEmailVendor = this.form.id_email_vendor;
                    const savedNorekVendor = this.form.id_norek_vendor;

                    // Reset field dinamis dulu (akan di-restore setelah fetch selesai)
                    this.form.id_cost_type = '';
                    this.form.id_email_vendor = '';
                    this.form.id_norek_vendor = '';

                    // Ambil data dinamis dan pulihkan pilihan lama setelah fetch
                    if (this.form.id_cost_category) {
                        this.loadCostTypes(this.form.id_cost_category, savedCostType);
                    }
                    if (this.form.id_vendor) {
                        this.loadVendorDetails(this.form.id_vendor, savedEmailVendor, savedNorekVendor);
                    }
                } else {
                    // Create mode
                    this.isEditing = false;
                    this.prId = null;
                    this.resetForm();
                }

                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('prFormModal'));
                modal.show();

                this.$nextTick(() => this.initSelect2());
            },

            resetForm() {
                Object.keys(this.form).forEach(k => this.form[k] = '');
                this.form.additional_discount = 0;
                this.form.id_departement = '{{ Auth::user()->id_departement }}';
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

                    // Tunggu Alpine render opsi ke DOM, baru set nilai terpilih
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

                    // Tunggu Alpine render opsi ke DOM, baru set nilai terpilih
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
                    const result = await @this.saveFromJs(this.form, this.prId);
                    if (result && result.errors) {
                        this.errors = result.errors;
                        this.errorMsg = 'Lengkapi form yang wajib diisi.';
                    } else if (result && result.success) {
                        bootstrap.Modal.getOrCreateInstance(document.getElementById('prFormModal')).hide();
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
                const modal = document.getElementById('prFormModal');
                document.querySelectorAll('.select2-pr').forEach(el => {
                    if ($(el).data('select2')) $(el).select2('destroy');
                    const fieldKey = el.id.replace('pr_', 'id_').replace('pr_', '');
                    $(el).select2({
                            dropdownParent: $(modal),
                            width: '100%'
                        })
                        .on('change', e => {
                            const mapping = {
                                'pr_doc_type': 'id_doc_type',
                                'pr_departement': 'id_departement',
                                'pr_company': 'id_company',
                                'pr_branch': 'id_branch',
                                'pr_cost_category': 'id_cost_category',
                                'pr_currency': 'id_currency',
                                'pr_payment_type': 'payment_type_pr',
                                'pr_payment_method': 'payment_method',
                                'pr_vendor': 'id_vendor',
                                'pr_user_email': 'id_email_user',
                            };
                            const key = mapping[el.id];
                            if (key) {
                                this.form[key] = e.target.value;
                                if (el.id === 'pr_vendor') this.onVendorChange();
                                if (el.id === 'pr_cost_category') this.onCostCategoryChange();
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
@endpush