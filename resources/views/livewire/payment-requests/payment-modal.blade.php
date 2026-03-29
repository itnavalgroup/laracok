<div>
    <div wire:ignore.self class="modal fade" id="prPaymentModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase">
                        <i class="fas fa-money-check-alt me-2"></i>
                        {{ $paymentId ? 'Edit Payment' : 'Tambah Payment' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit.prevent="savePayment">
                    <div class="modal-body p-4">

                        @if($errors->has('error'))
                        <div class="alert alert-danger p-2 small mb-3">
                            <i class="fas fa-exclamation-triangle me-1"></i> {{ $errors->first('error') }}
                        </div>
                        @endif

                        {{-- Info sisa tagihan --}}
                        <div class="alert alert-info py-2 small mb-4 d-flex align-items-center justify-content-between">
                            <span><i class="fas fa-info-circle me-1"></i> Sisa tagihan:</span>
                            <strong class="fs-6">{{ number_format($maxAmount, 2, ',', '.') }}</strong>
                        </div>

                        <div class="row g-3">

                            {{-- Description --}}
                            <div class="col-12">
                                <label class="fw-bold small text-uppercase">Deskripsi <span class="text-danger">*</span></label>
                                <textarea wire:model.defer="payment_description" rows="2"
                                    class="form-control @error('payment_description') is-invalid @enderror"
                                    placeholder="Keterangan payment..."></textarea>
                                @error('payment_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Payment Type --}}
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Payment Type <span class="text-danger">*</span></label>
                                <select wire:model.defer="payment_type"
                                    class="form-select @error('payment_type') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    <option value="1">Parsial</option>
                                    <option value="2">Full</option>
                                </select>
                                @error('payment_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Payment Method --}}
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Payment Method <span class="text-danger">*</span></label>
                                <select wire:model.defer="payment_method"
                                    class="form-select @error('payment_method') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    <option value="1">Transfer</option>
                                    <option value="2">Cash</option>
                                </select>
                                @error('payment_method') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Bank Name --}}
                            <div class="col-md-4">
                                <label class="fw-bold small text-uppercase">Bank Name</label>
                                <input type="text" wire:model.defer="nama_bank" class="form-control" placeholder="Nama Bank">
                            </div>

                            {{-- Account Name --}}
                            <div class="col-md-4">
                                <label class="fw-bold small text-uppercase">Account Name</label>
                                <input type="text" wire:model.defer="nama_penerima" class="form-control" placeholder="Nama Penerima">
                            </div>

                            {{-- Account Number --}}
                            <div class="col-md-4">
                                <label class="fw-bold small text-uppercase">Account Number</label>
                                <input type="text" wire:model.defer="norek" class="form-control" placeholder="No. Rekening">
                            </div>

                            {{-- Payment Date --}}
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Tanggal Payment <span class="text-danger">*</span></label>
                                <input type="date" wire:model.defer="payment_date"
                                    class="form-control @error('payment_date') is-invalid @enderror">
                                @error('payment_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Amount --}}
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Amount <span class="text-danger">*</span></label>
                                <input type="text" id="payment-amount" wire:model.defer="ammount"
                                    class="form-control text-end @error('ammount') is-invalid @enderror"
                                    placeholder="0,00" autocomplete="off"
                                    oninput="calcPaymentTotal()" onblur="calcPaymentTotal()">
                                @error('ammount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Additional --}}
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Additional</label>
                                <input type="text" id="payment-additional" wire:model.defer="additional"
                                    class="form-control text-end"
                                    placeholder="0,00" autocomplete="off"
                                    oninput="calcPaymentTotal()" onblur="calcPaymentTotal()">
                                <small class="text-muted">Biaya tambahan (opsional)</small>
                            </div>

                            {{-- Grand Total (readonly) --}}
                            <div class="col-md-6">
                                <label class="fw-bold small text-uppercase">Grand Total</label>
                                <input type="text" id="payment-grand-total"
                                    class="form-control text-end bg-light fw-bold"
                                    placeholder="0,00" readonly
                                    value="{{ $grand_total ? number_format($grand_total, 2, ',', '.') : '' }}">
                                <input type="hidden" wire:model.defer="grand_total" id="payment-grand-total-hidden">
                            </div>

                            {{-- Bukti Transfer --}}
                            <div class="col-12">
                                <label class="fw-bold small text-uppercase">Bukti Transfer (Opsional)</label>
                                <input type="file" wire:model="file"
                                    class="form-control @error('file') is-invalid @enderror">
                                <small class="text-muted">Maks 5MB (PDF, JPG, PNG)</small>
                                @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm"
                            wire:loading.attr="disabled" wire:target="savePayment">
                            <span wire:loading.remove wire:target="savePayment">
                                <i class="fas fa-save me-1"></i>
                                {{ $paymentId ? 'Update Payment' : 'Simpan Payment' }}
                            </span>
                            <span wire:loading wire:target="savePayment">
                                <i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Show/hide modal
        window.addEventListener('show-payment-modal', () => {
            const el = document.getElementById('prPaymentModal');
            new bootstrap.Modal(el).show();
            // Wait for Livewire to render then recalc
            setTimeout(calcPaymentTotal, 200);
        });
        window.addEventListener('hide-payment-modal', () => {
            const el = document.getElementById('prPaymentModal');
            const m = bootstrap.Modal.getInstance(el);
            if (m) m.hide();
        });

        /* ----------------------------------------------------------------
         * Format input: ribuan pakai titik, desimal pakai koma
         * ---------------------------------------------------------------- */
        function applyPaymentFormat(el) {
            if (!el) return;
            el.addEventListener('input', function() {
                let v = this.value.replace(/[^0-9,]/g, '');
                let parts = v.split(',');
                if (parts.length > 2) v = parts.shift() + ',' + parts.join('');
                let [int, dec] = v.split(',');
                int = (int || '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                this.value = dec !== undefined ? `${int},${dec}` : int;
            });
        }

        function parsePaymentID(v) {
            if (!v) return 0;
            return parseFloat(String(v).replace(/\./g, '').replace(',', '.')) || 0;
        }

        function formatPaymentID(n) {
            return (n || 0).toLocaleString('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        window.calcPaymentTotal = function() {
            const amnt = parsePaymentID(document.getElementById('payment-amount')?.value);
            const add = parsePaymentID(document.getElementById('payment-additional')?.value);
            const tot = amnt + add;
            const dispEl = document.getElementById('payment-grand-total');
            const hiddenEl = document.getElementById('payment-grand-total-hidden');
            if (dispEl) dispEl.value = formatPaymentID(tot);
            if (hiddenEl) hiddenEl.value = tot;
        };

        // Init formats when modal opens
        window.addEventListener('show-payment-modal', () => {
            setTimeout(() => {
                applyPaymentFormat(document.getElementById('payment-amount'));
                applyPaymentFormat(document.getElementById('payment-additional'));
                calcPaymentTotal();
            }, 300);
        });
    </script>
    @endpush
</div>