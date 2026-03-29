<div>
    <div wire:ignore.self class="modal fade" id="prInvoiceModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase">
                        <i class="ti ti-receipt me-2"></i> Tambah Dokumen Invoice
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit.prevent="saveInvoice">
                    <div class="modal-body p-4">
                        @if($errors->has('error'))
                        <div class="alert alert-danger p-2 small mb-3">
                            <i class="ti ti-alert-triangle me-1"></i> {{ $errors->first('error') }}
                        </div>
                        @endif

                        @if($pr)
                        <div class="alert alert-light-secondary border-secondary-subtle small mb-4">
                            <h6 class="fw-bold mb-2">Ringkasan Tagihan (Detail List)</h6>
                            <div class="d-flex justify-content-between mb-1">
                                <span>No. Request</span>
                                <span class="fw-semibold">{{ $pr->pr_number }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span>Total Item</span>
                                <span class="fw-semibold">{{ $pr->details->count() }} Items</span>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-2 mt-2">
                                <span class="fw-bold text-uppercase">Grand Total Kalkulasi</span>
                                <span class="fw-bold text-dark fs-6">{{ number_format($grandTotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Invoice / Faktur No. <span class="text-danger">*</span></label>
                                <input type="text" wire:model="invoice_number" class="form-control @error('invoice_number') is-invalid @enderror" placeholder="Contoh: INV-2026/001">
                                @error('invoice_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Tanggal Invoice <span class="text-danger">*</span></label>
                                <input type="date" wire:model="invoice_date" class="form-control @error('invoice_date') is-invalid @enderror">
                                @error('invoice_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Tanggal Pengiriman (Opsional)</label>
                                <input type="date" wire:model="delivery_date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">No. Polisi / Kendaraan Truk (Opsional)</label>
                                <input type="text" wire:model="truck" class="form-control" placeholder="Plat Kendaraan">
                            </div>

                            <div class="col-12 mt-4">
                                <label class="fw-bold small text-uppercase">Lampiran Dokumen Invoice (Scan PDF/Image)</label>
                                <input type="file" wire:model="file" class="form-control form-control-lg border-dashed @error('file') is-invalid @enderror" accept=".pdf,.png,.jpg,.jpeg">
                                <div class="text-muted small mt-1"><i class="ti ti-info-circle me-1"></i> Maksimal ukuran file 5MB. Pastikan file jelas dan terstruktur.</div>
                                @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-dark rounded-pill px-4 shadow-sm" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="saveInvoice"><i class="ti ti-upload me-1"></i> Simpan Laporan</span>
                            <span wire:loading wire:target="saveInvoice"><i class="ti ti-loader pe-spin me-1"></i> Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        window.addEventListener('show-invoice-modal', () => {
            var modal = new bootstrap.Modal(document.getElementById('prInvoiceModal'));
            modal.show();
        });
        window.addEventListener('hide-invoice-modal', () => {
            var modalEl = document.getElementById('prInvoiceModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        });
    </script>
    @endpush
</div>
