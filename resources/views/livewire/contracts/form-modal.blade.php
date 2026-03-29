<!-- Contract Form Modal -->
<div x-data="contractFormData()" x-init="initListeners()"
    @open-contract-form-js.window="openFromServer($event.detail)">

    <div class="modal fade" id="contractFormModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background:linear-gradient(135deg,#0f4c75,#1b6ca8);">
                    <h5 class="modal-title text-white fw-bold">
                        <i class="ti ti-file-certificate me-2"></i>
                        <span x-text="contractId ? 'Edit Kontrak' : 'Tambah Kontrak Baru'"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Errors -->
                    <template x-if="Object.keys(errors).length > 0">
                        <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                            <ul class="mb-0 ps-3">
                                <template x-for="msgs in Object.values(errors)" :key="msgs">
                                    <template x-for="msg in msgs" :key="msg">
                                        <li x-text="msg"></li>
                                    </template>
                                </template>
                            </ul>
                            <button type="button" class="btn-close" @click="errors = {}"></button>
                        </div>
                    </template>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Perusahaan <span class="text-danger">*</span></label>
                            <select x-model="form.id_company" class="form-select rounded-3">
                                <option value="">-- Pilih Perusahaan --</option>
                                @foreach($companies as $c)
                                <option value="{{ $c->id_company }}">{{ $c->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Departemen <span class="text-danger">*</span></label>
                            <select x-model="form.id_departement" class="form-select rounded-3">
                                <option value="">-- Pilih Departemen --</option>
                                @foreach($departements as $d)
                                <option value="{{ $d->id_departement }}">{{ $d->departement }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Tanggal Mulai</label>
                            <input type="date" x-model="form.start_date" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Tanggal Selesai</label>
                            <input type="date" x-model="form.end_date" class="form-control rounded-3">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Deskripsi</label>
                            <textarea x-model="form.description" class="form-control rounded-3" rows="3"
                                placeholder="Keterangan kontrak..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button class="btn fw-semibold rounded-pill px-4" style="background:#0f4c75;color:#fff;"
                        @click="save()" :disabled="saving">
                        <span x-show="saving" class="spinner-border spinner-border-sm me-1"></span>
                        <span x-text="contractId ? 'Update' : 'Simpan'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function contractFormData() {
    return {
        contractId: null,
        saving: false,
        errors: {},
        form: { id_company: '', id_departement: '', description: '', start_date: '', end_date: '' },

        initListeners() {
            this.$watch('form', () => this.errors = {});
        },

        openFromServer(data) {
            this.errors = {};
            this.saving = false;
            if (data && data.contract) {
                const c = data.contract;
                this.contractId = c.id_contract;
                this.form = {
                    id_company: c.id_company ?? '',
                    id_departement: c.id_departement ?? '',
                    description: c.description ?? '',
                    start_date: c.start_date ?? '',
                    end_date: c.end_date ?? '',
                };
            } else {
                this.contractId = null;
                this.form = { id_company: '', id_departement: '', description: '', start_date: '', end_date: '' };
            }
            bootstrap.Modal.getOrCreateInstance(document.getElementById('contractFormModal')).show();
        },

        async save() {
            this.saving = true;
            this.errors = {};
            const result = await @this.saveFromJs(this.form, this.contractId);
            this.saving = false;
            if (result) {
                if (result.errors) { this.errors = result.errors; return; }
                if (result.error)  { alert(result.error); return; }
                if (result.redirect) { window.location.href = result.redirect; return; }
                bootstrap.Modal.getOrCreateInstance(document.getElementById('contractFormModal')).hide();
            }
        }
    };
}
</script>
