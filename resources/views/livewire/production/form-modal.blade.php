<div class="modal fade" id="productionFormModal" tabindex="-1" aria-labelledby="productionFormModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">

            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold text-white text-uppercase" id="productionFormModalLabel">
                    <i class="ti ti-plus me-2"></i>
                    <span>{{ $isEdit ? 'Edit Production Record' : 'Create New Production' }}</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form wire:submit.prevent="save">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Departemen <span class="text-danger">*</span></label>
                            <select wire:model="id_departement" class="form-select" required>
                                <option value="">-- Pilih Departemen --</option>
                                @foreach ($departements as $dept)
                                    <option value="{{ $dept->id_departement }}">{{ $dept->departement }}</option>
                                @endforeach
                            </select>
                            @error('id_departement') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Company <span class="text-danger">*</span></label>
                            <select wire:model="id_company" class="form-select" required>
                                <option value="">-- Pilih Company --</option>
                                @foreach ($companies as $comp)
                                    <option value="{{ $comp->id_company }}">{{ $comp->company_name }}</option>
                                @endforeach
                            </select>
                            @error('id_company') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Warehouse <span class="text-danger">*</span></label>
                            <select wire:model="id_warehouse" class="form-select" required>
                                <option value="">-- Pilih Warehouse --</option>
                                @foreach ($warehouses as $wh)
                                    <option value="{{ $wh->id_warehouse }}">{{ $wh->warehouse_name }}</option>
                                @endforeach
                            </select>
                            @error('id_warehouse') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Requested Date <span class="text-danger">*</span></label>
                            <input type="date" wire:model="production_date" class="form-control" required>
                            @error('production_date') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold small text-uppercase">Nomor Dokumen</label>
                            <input type="text" wire:model="production_number" class="form-control" placeholder="Opsional (Auto-Generate)" @if($isEdit) disabled @endif>
                            @error('production_number') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12">
                            <label class="fw-bold small text-uppercase">Description / Notes <span class="text-danger">*</span></label>
                            <textarea wire:model="description" class="form-control" rows="3" placeholder="Deskripsi mengenai produksi / konversi barang..." required></textarea>
                            @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold text-uppercase" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold text-uppercase shadow-sm">
                            <i class="ti ti-device-floppy me-2"></i> Save Production
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('show-modal', (data) => {
            if (data.id === 'productionFormModal') {
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('productionFormModal'));
                modal.show();
            }
        });
    });
</script>
@endpush

