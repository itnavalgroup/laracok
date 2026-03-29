<div class="modal fade" id="ikbFormModal" tabindex="-1" aria-labelledby="ikbFormModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;"
            x-data="ikbFormData()"
            x-init="initForm()">

            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold text-white text-uppercase" id="ikbFormModalLabel">
                    <i class="ti ti-plus me-2"></i>
                    <span x-text="isEditing ? 'Edit Izin Keluar Barang' : 'Create Izin Keluar Barang'"></span>
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
                            <select x-model="form.id_doc_type" class="form-select select2-ikb" id="ikb_doc_type">
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
                                :class="isEditing ? 'bg-secondary bg-opacity-10 text-muted' : ''"
                            >
                            <div class="form-text small" style="font-size: 0.75rem;" x-show="!isEditing">
                                Biarkan kosong jika auto-generate.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Departemen <span class="text-danger">*</span></label>
                            <select x-model="form.id_departement" class="form-select select2-ikb" id="ikb_departement"
                                @if(Auth::user()->level != 1) disabled @endif>
                                <option value="">-- Pilih Departemen --</option>
                                @foreach($departements as $dept)
                                    <option value="{{ $dept->id_departement }}">{{ $dept->departement }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Company <span class="text-danger">*</span></label>
                            <select x-model="form.id_company" class="form-select select2-ikb" id="ikb_company">
                                <option value="">-- Pilih Company --</option>
                                @foreach($companies as $comp)
                                    <option value="{{ $comp->id_company }}">{{ $comp->company }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" x-show="errors.id_company" x-text="errors.id_company"></span>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Warehouse <span class="text-danger">*</span></label>
                            <select x-model="form.id_warehouse" class="form-select select2-ikb" id="ikb_warehouse">
                                <option value="">-- Pilih Warehouse --</option>
                                @foreach($warehouses as $wh)
                                    <option value="{{ $wh->id_warehouse }}">{{ $wh->warehouse_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" x-show="errors.id_warehouse" x-text="errors.id_warehouse"></span>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Sales (Requestor) <span class="text-danger">*</span></label>
                            <select x-model="form.sales" class="form-select select2-ikb" id="ikb_sales">
                                <option value="">-- Pilih Sales User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id_user }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" x-show="errors.sales" x-text="errors.sales"></span>
                        </div>
                    </div>
                </div>

                <div class="hr-border opacity-25 my-4"></div>

                <!-- TRANSACTION DETAILS -->
                <div class="mb-4">
                    <h6 class="text-primary fw-bold text-uppercase mb-3 d-flex align-items-center gap-2">
                        <i class="ti ti-truck fs-5"></i> TRANSACTION DETAILS
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Transaction Type <span class="text-danger">*</span></label>
                            <select x-model="form.id_ikb_transaction_type" class="form-select select2-ikb" id="ikb_transaction_type">
                                <option value="">-- Pilih Tipe Transaksi --</option>
                                @foreach($transactionTypes as $tt)
                                    <option value="{{ $tt->id_ikb_transaction_type }}">{{ $tt->transaction_type }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger small" x-show="errors.id_ikb_transaction_type" x-text="errors.id_ikb_transaction_type"></span>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Vendor</label>
                            <select x-model="form.id_vendor" class="form-select select2-ikb" id="ikb_vendor">
                                <option value="">-- Pilih Vendor (Opsional) --</option>
                                @foreach($vendors as $v)
                                    <option value="{{ $v->id_vendor }}">{{ $v->vendor_name ?: $v->vendor }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Destination <span class="text-danger">*</span></label>
                            <input type="text" x-model="form.destination" class="form-control" placeholder="Tujuan pengiriman...">
                            <span class="text-danger small" x-show="errors.destination" x-text="errors.destination"></span>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6">
                                    <label class="fw-bold small text-uppercase">Booking Date <span class="text-danger">*</span></label>
                                    <input type="date" x-model="form.booking_date" class="form-control">
                                    <span class="text-danger small" x-show="errors.booking_date" x-text="errors.booking_date"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">PO Number</label>
                            <input type="text" x-model="form.po_number" class="form-control" placeholder="Opsional">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">SO Number</label>
                            <input type="text" x-model="form.so_number" class="form-control" placeholder="Opsional">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">RI Number</label>
                            <input type="text" x-model="form.ri_number" class="form-control" placeholder="Opsional">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">SK Number</label>
                            <input type="text" x-model="form.sk_number" class="form-control" placeholder="Opsional">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">DO Number</label>
                            <input type="text" x-model="form.do_number" class="form-control" placeholder="Opsional">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Batch Number</label>
                            <input type="text" x-model="form.batch_number" class="form-control" placeholder="Opsional">
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer border-0 d-flex justify-content-between">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold text-uppercase" data-bs-dismiss="modal">Close</button>
                <div class="d-flex gap-2">
                    <button type="button" @click="submitForm()" class="btn btn-primary rounded-pill px-5 fw-bold text-uppercase shadow-sm" :disabled="saving">
                        <span x-show="saving"><i class="ti ti-loader-2 me-2 spin"></i> Menyimpan...</span>
                        <span x-show="!saving"><i class="ti ti-device-floppy me-2"></i> Save IKB</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
function ikbFormData() {
    return {
        isEditing: false,
        ikbId: null,
        saving: false,
        errorMsg: '',
        errors: {},

        form: {
            number: '',
            id_doc_type: '',
            id_departement: '{{ Auth::user()->id_departement }}',
            id_company: '',
            id_warehouse: '',
            sales: '',
            id_vendor: '',
            id_ikb_transaction_type: '',
            destination: '',
            booking_date: '',
            stuffing_date: '',
            po_number: '',
            so_number: '',
            ri_number: '',
            sk_number: '',
            do_number: '',
            batch_number: '',
        },

        initForm() {
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('open-ikb-form-js', (data) => {
                    this.openModal(data[0] || {});
                });
            });

            this.$nextTick(() => this.initSelect2());
        },

        openModal(data = {}) {
            this.errorMsg = '';
            this.errors = {};

            if (data.ikb) {
                // Edit mode
                this.isEditing = true;
                this.ikbId = data.ikb.id_ikb;
                
                Object.keys(this.form).forEach(k => {
                    let val = data.ikb[k];
                    // Format dates properly for input[type="date"]
                    if (val && (k === 'booking_date' || k === 'stuffing_date')) {
                        val = val.split('T')[0];
                    }
                    this.form[k] = (val !== null && val !== undefined) ? String(val) : '';
                });
            } else {
                // Create mode
                this.isEditing = false;
                this.ikbId = null;
                this.resetForm();
            }

            const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('ikbFormModal'));
            modal.show();

            this.$nextTick(() => {
                this.initSelect2();
            });
        },

        resetForm() {
            Object.keys(this.form).forEach(k => this.form[k] = '');
            this.form.id_departement = '{{ Auth::user()->id_departement }}';
        },

        async submitForm() {
            this.errors = {};
            this.errorMsg = '';
            this.saving = true;
            try {
                const result = await @this.saveFromJs(this.form, this.ikbId);
                if (result && result.errors) {
                    this.errors = result.errors;
                    this.errorMsg = 'Lengkapi form yang wajib diisi.';
                } else if (result && result.success) {
                    bootstrap.Modal.getOrCreateInstance(document.getElementById('ikbFormModal')).hide();
                    if (result.redirect) {
                        window.location.href = result.redirect;
                    }
                } else if (result && result.error) {
                    this.errorMsg = result.error;
                }
            } catch(e) {
                this.errorMsg = 'Terjadi kesalahan tak terduga.';
                console.error(e);
            } finally {
                this.saving = false;
            }
        },

        initSelect2() {
            const modal = document.getElementById('ikbFormModal');
            document.querySelectorAll('.select2-ikb').forEach(el => {
                if ($(el).data('select2')) $(el).select2('destroy');
                $(el).select2({ dropdownParent: $(modal), width: '100%' })
                    .on('change', e => {
                        const mapping = {
                            'ikb_doc_type': 'id_doc_type',
                            'ikb_departement': 'id_departement',
                            'ikb_company': 'id_company',
                            'ikb_warehouse': 'id_warehouse',
                            'ikb_sales': 'sales',
                            'ikb_vendor': 'id_vendor',
                            'ikb_transaction_type': 'id_ikb_transaction_type',
                        };
                        const key = mapping[el.id];
                        if (key) {
                            this.form[key] = e.target.value;
                        }
                    });
            });
            // Update UI
            $('#ikb_doc_type').val(this.form.id_doc_type).trigger('change.select2');
            $('#ikb_departement').val(this.form.id_departement).trigger('change.select2');
            $('#ikb_company').val(this.form.id_company).trigger('change.select2');
            $('#ikb_warehouse').val(this.form.id_warehouse).trigger('change.select2');
            $('#ikb_sales').val(this.form.sales).trigger('change.select2');
            $('#ikb_vendor').val(this.form.id_vendor).trigger('change.select2');
            $('#ikb_transaction_type').val(this.form.id_ikb_transaction_type).trigger('change.select2');
        }
    };
}
</script>
<style>
.spin { animation: spin 1s linear infinite; display: inline-block; }
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>
@endpush
