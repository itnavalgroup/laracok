<div>
    @if($isOpen)
    <div class="modal fade show d-block" id="modalFormDetail" tabindex="-1" aria-modal="true" style="background:rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h5 class="modal-title text-white fw-bold">
                        <i class="fas fa-{{ $detailId ? 'edit' : 'plus-circle' }} me-2"></i>
                        {{ $detailId ? 'Edit Item PR' : 'Tambah Item PR' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                </div>

                <div class="modal-body">
                    {{-- Mode Alert --}}
                    @if($isViewOnly)
                    <div class="alert alert-info py-2 mb-3">
                        <i class="fas fa-eye me-1"></i> Mode View-Only: Anda hanya dapat melihat rincian item ini.
                    </div>
                    @endif

                    {{-- ========== SECTION 1: Detail Info ========== --}}
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <h6 class="fw-bold text-muted border-bottom pb-2">
                                <i class="fas fa-info-circle text-primary me-1"></i> Informasi Item
                            </h6>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-medium">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('detail') is-invalid @enderror"
                                wire:model="detail" rows="3"
                                placeholder="Masukkan deskripsi item..." {{ $isViewOnly ? 'readonly' : '' }}></textarea>
                            @error('detail') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium">BL Number</label>
                            <input type="text" class="form-control" wire:model="bl_number" placeholder="BL Number (opsional)" {{ $isViewOnly ? 'readonly' : '' }}>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium">Qty <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('qty') is-invalid @enderror"
                                id="detail-qty" value="{{ $qty ? number_format((float)$qty, 2, ',', '.') : '' }}" placeholder="0,00" autocomplete="off" {{ $isViewOnly ? 'readonly' : '' }}>
                            @error('qty') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium">UOM <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_uom') is-invalid @enderror" wire:model="id_uom" {{ $isViewOnly ? 'disabled' : '' }}>
                                <option value="">Pilih UOM</option>
                                @foreach($uoms as $uom)
                                <option value="{{ $uom->id_uom }}">{{ $uom->uom }}</option>
                                @endforeach
                            </select>
                            @error('id_uom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium">Harga Satuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                id="detail-price" value="{{ $price ? number_format((float)$price, 2, ',', '.') : '' }}" placeholder="0,00" autocomplete="off" {{ $isViewOnly ? 'readonly' : '' }}>
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-medium">Discount</label>
                            <input type="text" class="form-control"
                                id="detail-discount" value="{{ $discount ? number_format((float)($discount ?: 0), 2, ',', '.') : '' }}" placeholder="0,00" autocomplete="off" {{ $isViewOnly ? 'readonly' : '' }}>
                        </div>
                    </div>

                    {{-- ========== SECTION 2: Special Options ========== --}}
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <h6 class="fw-bold text-muted border-bottom pb-2">
                                <i class="fas fa-cogs text-info me-1"></i> Opsi Khusus
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch px-4">
                                <input class="form-check-input ms-0 me-2" type="checkbox" id="gross-check" onchange="updateFlags()" {{ $isViewOnly ? 'disabled' : '' }}>
                                <label class="form-check-label" for="gross-check">
                                    <strong>Gross Up</strong> <small class="text-muted">(Perusahaan menanggung PPh)</small>
                                </label>
                            </div>
                            <input type="hidden" id="gross-hidden" value="{{ $gross }}">
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch px-4">
                                <input class="form-check-input ms-0 me-2" type="checkbox" id="progresif-check" onchange="handleProgresifChange()" {{ $isViewOnly ? 'disabled' : '' }}>
                                <label class="form-check-label" for="progresif-check">
                                    <strong>Progresif</strong> <small class="text-muted">(Tarif 5%-35%)</small>
                                </label>
                            </div>
                            <input type="hidden" id="progresif-hidden" value="{{ $progresif }}">
                        </div>
                    </div>

                    {{-- ========== SECTION 3: Tax Configuration ========== --}}
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <h6 class="fw-bold text-muted border-bottom pb-2">
                                <i class="fas fa-percent text-warning me-1"></i> Konfigurasi Pajak
                            </h6>
                        </div>

                        {{-- PPN --}}
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Tipe PPN</label>
                            <select class="form-select" id="ppntype" onchange="loadTaxOptions('ppntype', 'ppn')" {{ $isViewOnly ? 'disabled' : '' }}>
                                <option value="">Pilih Tipe PPN</option>
                                @foreach($taxTypes as $tt)
                                <option value="{{ $tt->id_tax_type }}">{{ $tt->tax_type }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="ppntype-hidden" value="{{ $id_tax_type1 }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">PPN</label>
                            <select class="form-select" id="ppn" onchange="calculate()" {{ $isViewOnly ? 'disabled' : '' }}>
                                <option value="">Pilih PPN</option>
                            </select>
                            <input type="hidden" id="ppn-hidden" value="{{ $id_tax1 }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Jumlah PPN</label>
                            <input type="text" class="form-control" id="tax1-display" value="{{ number_format((float)($tax1 ?: 0), 2, ',', '.') }}" readonly>
                            <input type="hidden" id="tax1-hidden" value="{{ (float)($tax1 ?: 0) }}">
                        </div>

                        {{-- PPh --}}
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Tipe PPh</label>
                            <select class="form-select" id="pphtype" onchange="loadTaxOptions('pphtype', 'pph')" {{ $isViewOnly ? 'disabled' : '' }}>
                                <option value="">Pilih Tipe PPh</option>
                                @foreach($taxTypes as $tt)
                                <option value="{{ $tt->id_tax_type }}">{{ $tt->tax_type }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="pphtype-hidden" value="{{ $id_tax_type2 }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">PPh</label>
                            <select class="form-select" id="pph" onchange="calculate()" {{ $isViewOnly ? 'disabled' : '' }}>
                                <option value="">Pilih PPh</option>
                            </select>
                            <input type="hidden" id="pph-hidden" value="{{ $id_tax2 }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">DPP PPh</label>
                            <input type="text" class="form-control" id="dpp-pph"
                                value="{{ $dpp_pph ? number_format((float)$dpp_pph, 2, ',', '.') : '' }}"
                                placeholder="0" autocomplete="off" {{ $isViewOnly ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-medium">Jumlah PPh</label>
                            <input type="text" class="form-control" id="tax2-display" value="{{ number_format((float)($tax2 ?: 0), 2, ',', '.') }}" readonly>
                            <input type="hidden" id="tax2-hidden" value="{{ (float)($tax2 ?: 0) }}">
                        </div>
                    </div>

                    {{-- ========== SECTION 4: Total ========== --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                                <span class="text-white fw-bold fs-5 text-uppercase">Total Amount</span>
                                <span class="text-white fw-bold fs-4" id="amount-display">{{ number_format((float)($ammount ?: 0), 2, ',', '.') }}</span>
                            </div>
                            <input type="hidden" id="amount-hidden" value="{{ (float)($ammount ?: 0) }}">
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">
                        <i class="fas fa-times me-1"></i> {{ $isViewOnly ? 'Tutup' : 'Batal' }}
                    </button>
                    @if(!$isViewOnly)
                    <button type="button" class="btn btn-primary px-4" onclick="submitFormDetail()">
                        <i class="fas fa-save me-1"></i> {{ $detailId ? 'Perbarui' : 'Simpan' }}
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @push('scripts')
    <script>
        (function() {
            'use strict';

            var dppRaw = 0;
            var isManualDpp = false;

            // =====================================================
            // FORMATTERS (Indonesian Format: . for 1000s, , for dec)
            // =====================================================

            function applyDecimalID(el) {
                if (!el || el.dataset.decimalBound) return;
                el.dataset.decimalBound = '1';

                el.addEventListener('input', function() {
                    var v = this.value.replace(/[^0-9.,]/g, '');
                    var parts = v.split(',');
                    if (parts.length > 2) v = parts.shift() + ',' + parts.join('');

                    var split = v.split(',');
                    var intPart = (split[0] || '').replace(/\./g, '');
                    var decPart = split[1];

                    intPart = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    this.value = decPart !== undefined ? intPart + ',' + decPart : intPart;
                });

                el.addEventListener('blur', function() {
                    var v = this.value;
                    if (!v) return;
                    if (v.indexOf(',') === -1) this.value = v + ',00';
                    else if (v.slice(-1) === ',') this.value = v + '00';
                    else if (v.split(',')[1].length === 1) this.value = v + '0';
                });
            }

            function applyQtyDecimalID(el) {
                if (!el || el.dataset.qtyBound) return;
                el.dataset.qtyBound = '1';

                el.addEventListener('input', function() {
                    var v = this.value.replace(/[^0-9,]/g, ''); // Qty typically doesn't use thousands dot in legacy input
                    var parts = v.split(',');
                    if (parts.length > 2) v = parts.shift() + ',' + parts.join('');
                    this.value = v;
                });
            }

            // =====================================================
            // PARSERS
            // =====================================================

            function parseID(val) {
                if (!val) return 0;
                return parseFloat(String(val).replace(/\./g, '').replace(',', '.')) || 0;
            }

            function parseQtyID(val) {
                if (!val) return 0;
                return parseFloat(String(val).replace(',', '.')) || 0;
            }

            function getTaxPercent(select) {
                if (!select || !select.selectedOptions || !select.selectedOptions.length) return 0;
                var val = parseFloat(select.selectedOptions[0].getAttribute('data-percent') || 0);
                return isNaN(val) ? 0 : val;
            }

            function formatDecimal(n) {
                return (n || 0).toLocaleString('id-ID', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            function formatRupiahNoDec(n) {
                return Math.round(n || 0).toLocaleString('id-ID');
            }

            // =====================================================
            // AJAX LOAD TAX
            // =====================================================

            function loadTax(typeSelectId, targetSelectId) {
                var typeSelect = document.getElementById(typeSelectId);
                var target = document.getElementById(targetSelectId);
                if (!typeSelect || !target) return;

                var id = typeSelect.value;
                if (!id) {
                    target.innerHTML = '<option value="">Pilih Opsi</option>';
                    calculate();
                    return;
                }

                target.innerHTML = '<option>Loading...</option>';

                fetch('/api/pr/taxes/' + id)
                    .then(function(r) {
                        return r.json();
                    })
                    .then(function(data) {
                        var opt = '<option value="">Pilih Opsi</option>';
                        data.forEach(function(v) {
                            var raw = String(v.tax_persen).replace(',', '.');
                            var percent = parseFloat(raw);
                            if (isNaN(percent)) percent = 0;
                            if (percent >= 1) percent = percent / 100;
                            opt += '<option value="' + v.id_tax + '" data-percent="' + percent + '">' +
                                v.tax + ' - ' + (percent * 100).toLocaleString('id-ID') + '%' +
                                '</option>';
                        });
                        target.innerHTML = opt;

                        var hiddenId = (targetSelectId === 'ppn') ? 'ppn-hidden' : 'pph-hidden';
                        var savedId = (document.getElementById(hiddenId) || {}).value;
                        if (savedId) target.value = savedId;

                        calculate();
                    })
                    .catch(function() {
                        target.innerHTML = '<option value="">Pilih Opsi</option>';
                    });
            }

            // =====================================================
            // LEGACY TAX LOGIC (PPh21 Helper Port)
            // =====================================================

            function hitungPPh21ProgresifNonPegawai(bruto) {
                var dpp = bruto * 0.5;
                var pkp = dpp,
                    pph = 0;
                var layers = [
                    [60000000, 0.05],
                    [190000000, 0.15],
                    [250000000, 0.25],
                    [4500000000, 0.30],
                    [Infinity, 0.35]
                ];
                for (var i = 0; i < layers.length; i++) {
                    if (pkp <= 0) break;
                    var take = Math.min(layers[i][0], pkp);
                    pph += take * layers[i][1];
                    pkp -= take;
                }
                return {
                    dpp: dpp,
                    pph: pph
                };
            }

            function hitungPPh21ProgresifGrossUp(honor) {
                var bruto = honor,
                    last = 0,
                    res = {
                        pph: 0,
                        dpp: 0
                    };
                for (var i = 0; i < 10; i++) { // LEGACY: 10 iterations
                    res = hitungPPh21ProgresifNonPegawai(bruto);
                    if (Math.abs(res.pph - last) < 1) return res;
                    last = res.pph;
                    bruto = honor + res.pph;
                }
                return res;
            }

            // =====================================================
            // MAIN CALCULATION
            // =====================================================

            function calculate() {
                var gh = document.getElementById('gross-hidden');
                var ph = document.getElementById('progresif-hidden');
                if (!gh || !ph) return;

                var isGross = gh.value === '1';
                var isProg = ph.value === '1';

                var qty = parseQtyID((document.getElementById('detail-qty') || {}).value);
                var price = parseID((document.getElementById('detail-price') || {}).value);
                var discount = parseID((document.getElementById('detail-discount') || {}).value);

                var bruto = qty * price - discount;
                var vatPercent = getTaxPercent(document.getElementById('ppn'));
                var vatAmount = bruto * vatPercent;
                var tax2 = 0;

                if (isProg) {
                    var res = isGross ? hitungPPh21ProgresifGrossUp(bruto) : hitungPPh21ProgresifNonPegawai(bruto);

                    dppRaw = res.dpp;
                    tax2 = res.pph;
                    var dppEl = document.getElementById('dpp-pph');
                    if (dppEl) dppEl.value = formatRupiahNoDec(dppRaw);
                    isManualDpp = false;
                } else {
                    var pphPercent = getTaxPercent(document.getElementById('pph'));
                    if (pphPercent > 0) {
                        if (isManualDpp) {
                            dppRaw = parseID((document.getElementById('dpp-pph') || {}).value);
                        } else {
                            dppRaw = isGross ? bruto / (1 - pphPercent) : bruto;
                            var dppEl2 = document.getElementById('dpp-pph');
                            if (dppEl2) dppEl2.value = formatRupiahNoDec(dppRaw);
                        }
                        tax2 = dppRaw * pphPercent;
                    } else {
                        dppRaw = 0;
                        tax2 = 0;
                        var dppEl3 = document.getElementById('dpp-pph');
                        if (!isManualDpp && dppEl3) dppEl3.value = '';
                    }
                }

                var amount = isGross ? bruto + vatAmount : bruto + vatAmount - tax2;

                var t1disp = document.getElementById('tax1-display');
                var t1h = document.getElementById('tax1-hidden');
                var t2disp = document.getElementById('tax2-display');
                var t2h = document.getElementById('tax2-hidden');
                var amtDisp = document.getElementById('amount-display');
                var amtH = document.getElementById('amount-hidden');

                if (t1disp) t1disp.value = formatDecimal(vatAmount);
                if (t1h) t1h.value = vatAmount;
                if (t2disp) t2disp.value = formatDecimal(tax2);
                if (t2h) t2h.value = tax2;
                if (amtDisp) amtDisp.textContent = formatDecimal(amount);
                if (amtH) amtH.value = amount;
            }

            // =====================================================
            // ACTIONS
            // =====================================================

            function updateFlags() {
                var gc = document.getElementById('gross-check');
                var gh = document.getElementById('gross-hidden');
                if (gc && gh) gh.value = gc.checked ? '1' : '2';
                calculate();
            }

            function handleProgresifChange() {
                var pc = document.getElementById('progresif-check');
                var ph = document.getElementById('progresif-hidden');
                if (pc && ph) ph.value = pc.checked ? '1' : '2';

                var dppEl = document.getElementById('dpp-pph');
                var pphtype = document.getElementById('pphtype');
                var pph = document.getElementById('pph');

                if (pc.checked) {
                    isManualDpp = false;
                    if (dppEl) dppEl.readOnly = true;
                    if (pphtype) pphtype.disabled = true;
                    if (pph) pph.disabled = true;
                } else {
                    if (dppEl) dppEl.readOnly = false;
                    if (pphtype) pphtype.disabled = false;
                    if (pph) pph.disabled = false;
                }
                calculate();
            }

            window.submitFormDetail = function() {
                var qty = parseQtyID((document.getElementById('detail-qty') || {}).value);
                var price = parseID((document.getElementById('detail-price') || {}).value);
                var discount = parseID((document.getElementById('detail-discount') || {}).value);
                var dppVal = parseID((document.getElementById('dpp-pph') || {}).value);
                var ppntype = (document.getElementById('ppntype') || {}).value;
                var ppn = (document.getElementById('ppn') || {}).value;
                var tax1 = parseFloat((document.getElementById('tax1-hidden') || {}).value || 0);
                var pphtype = (document.getElementById('pphtype') || {}).value;
                var pph = (document.getElementById('pph') || {}).value;
                var tax2 = parseFloat((document.getElementById('tax2-hidden') || {}).value || 0);
                var amount = parseFloat((document.getElementById('amount-hidden') || {}).value || 0);
                var gross = (document.getElementById('gross-hidden') || {}).value || '2';
                var progresif = (document.getElementById('progresif-hidden') || {}).value || '2';

                @this.syncAndSave(qty, price, discount, dppVal, ppntype, ppn, tax1, pphtype, pph, tax2, amount, gross, progresif);
            };

            window.updateFlags = updateFlags;
            window.handleProgresifChange = handleProgresifChange;
            window.loadTaxOptions = loadTax;
            window.calculate = calculate;

            window._initFormDetailModal = function() {
                var qtyEl = document.getElementById('detail-qty');
                if (!qtyEl) return;

                applyQtyDecimalID(qtyEl);
                applyDecimalID(document.getElementById('detail-price'));
                applyDecimalID(document.getElementById('detail-discount'));
                applyDecimalID(document.getElementById('dpp-pph'));

                [qtyEl, document.getElementById('detail-price'), document.getElementById('detail-discount')].forEach(function(el) {
                    if (el && !el.dataset.calcBound) {
                        el.dataset.calcBound = '1';
                        el.addEventListener('input', calculate);
                    }
                });

                var dppEl = document.getElementById('dpp-pph');
                if (dppEl && !dppEl.dataset.dppBound) {
                    dppEl.dataset.dppBound = '1';
                    dppEl.addEventListener('input', function() {
                        isManualDpp = true;
                        calculate();
                    });
                    dppEl.addEventListener('blur', function() {
                        if (!this.value.trim()) {
                            isManualDpp = false;
                            calculate();
                        }
                    });
                }

                var gVal = (document.getElementById('gross-hidden') || {}).value;
                var pVal = (document.getElementById('progresif-hidden') || {}).value;
                var gc = document.getElementById('gross-check');
                var pc = document.getElementById('progresif-check');
                if (gc) gc.checked = (gVal === '1');
                if (pc) {
                    pc.checked = (pVal === '1');
                    if (pVal === '1') {
                        if (dppEl) dppEl.readOnly = true;
                        if (document.getElementById('pphtype')) document.getElementById('pphtype').disabled = true;
                        if (document.getElementById('pph')) document.getElementById('pph').disabled = true;
                    }
                }

                var ppntypeEl = document.getElementById('ppntype');
                var pphtypeEl = document.getElementById('pphtype');
                var ppnTypeVal = (document.getElementById('ppntype-hidden') || {}).value;
                var pphTypeVal = (document.getElementById('pphtype-hidden') || {}).value;

                if (ppntypeEl && ppnTypeVal) {
                    ppntypeEl.value = ppnTypeVal;
                    loadTax('ppntype', 'ppn');
                }
                if (pphtypeEl && pphTypeVal) {
                    pphtypeEl.value = pphTypeVal;
                    loadTax('pphtype', 'pph');
                }

                setTimeout(calculate, 400);
            };

            document.addEventListener('livewire:updated', function() {
                if (document.getElementById('detail-qty') && !document.getElementById('detail-qty').dataset.qtyBound) {
                    window._initFormDetailModal();
                }
            });

            document.addEventListener('livewire:initialized', function() {
                Livewire.on('open-detail-form', function() {
                    setTimeout(window._initFormDetailModal, 200);
                });
            });
        })();
    </script>
    @endpush
</div>