<div>
    <!-- Contract Detail Modal -->
    <div class="modal fade" id="contractDetailModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background:#0f4c75;">
                    <h5 class="modal-title text-white fw-bold">
                        <i class="ti ti-package me-2"></i>{{ $detailId ? 'Edit Item' : 'Tambah Item Kontrak' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" wire:click="closeModal"></button>
                </div>
                <div class="modal-body p-4">
                    @if($errors->any())
                    <div class="alert alert-danger small">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Kategori Item <span class="text-danger">*</span></label>
                        <select wire:model.live="id_item_category" class="form-select rounded-3">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($itemCategories as $cat)
                            <option value="{{ $cat->id_item_category }}">{{ $cat->item_category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Item <span class="text-danger">*</span></label>
                        <select wire:model="id_item" class="form-select rounded-3" {{ !$id_item_category ? 'disabled' : '' }}>
                            <option value="">-- Pilih Item --</option>
                            @foreach($items as $item)
                            <option value="{{ $item->id_item }}">{{ $item->item_name }}{{ $item->item_code ? ' ('.$item->item_code.')' : '' }}</option>
                            @endforeach
                        </select>
                        @if(!$id_item_category)<small class="text-muted">Pilih kategori terlebih dahulu</small>@endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Qty <span class="text-danger">*</span></label>
                        <input type="number" wire:model="qty" class="form-control rounded-3" step="0.01" min="0.01" placeholder="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal" wire:click="closeModal">Batal</button>
                    <button class="btn fw-semibold rounded-pill px-4" style="background:#0f4c75;color:#fff;" wire:click="save">
                        <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                        {{ $detailId ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
