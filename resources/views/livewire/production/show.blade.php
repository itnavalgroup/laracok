<div class="production-detail">
    @php
        $status = intval($production->status);
        $user = auth()->user();
        $isAdmin = $user->level == 1;
        $isOwner = $user->id_user == $production->id_user;

        $statusBadge = [
            0 => ['label' => 'DRAFT', 'color' => 'secondary'],
            1 => ['label' => 'SUBMITTED (REQ TO PROCESS)', 'color' => 'warning'],
            2 => ['label' => 'PROCESSED (REQ TO VERIFY)', 'color' => 'primary'],
            3 => ['label' => 'APPROVED / DONE', 'color' => 'success'],
            9 => ['label' => 'CANCELED', 'color' => 'danger'],
        ];
        $sbadge = $statusBadge[$status] ?? ['label' => 'UNKNOWN', 'color' => 'dark'];
    @endphp

    <template x-teleport="#production-header-actions">
        <div class="d-flex align-items-center gap-2" data-html2canvas-ignore="true">
            @if ($status == 0 && (auth()->user()->id_user == $production->id_user || auth()->user()->level == 1))
                <button type="button" class="btn btn-success btn-sm rounded-pill px-3 no-print-btn"
                    onclick="showConfirm({title: 'Submit Form?', message: 'Pastikan item sudah benar.', type: 'warning', onConfirm: () => @this.submitProduction()})"><i
                        class="ti ti-check me-1"></i> Submit</button>
            @elseif ($status == 1 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.process')))
                <button type="button" class="btn btn-success btn-sm rounded-pill px-3 no-print-btn"
                    data-bs-toggle="modal" data-bs-target="#modalProcessDate"><i class="ti ti-check me-1"></i>
                    Process</button>
                <button type="button"
                    class="btn border border-danger text-danger btn-sm rounded-pill px-3 no-print-btn bg-white"
                    data-bs-toggle="modal" data-bs-target="#modalCancelProduction"><i
                        class="ti ti-arrow-back-up me-1"></i> Cancel</button>
            @elseif ($status == 2 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.verify')))
                <button type="button" class="btn btn-success btn-sm rounded-pill px-3 no-print-btn"
                    data-bs-toggle="modal" data-bs-target="#modalFinishDate"><i class="ti ti-check me-1"></i>
                    Verify</button>
                <button type="button"
                    class="btn border border-danger text-danger btn-sm rounded-pill px-3 no-print-btn bg-white"
                    data-bs-toggle="modal" data-bs-target="#modalCancelProduction"><i
                        class="ti ti-arrow-back-up me-1"></i> Cancel</button>
            @endif
        </div>
    </template>

    <div class="row">
        <div class="col-12">
            <div class="card p-3 border-0 shadow-sm mt-3">

                {{-- Header Atas: Teks DETAIL & Tombol --}}
                <div class="d-flex justify-content-between align-items-start mb-4 border-bottom pb-3">
                    <div>
                        <h5 class="fw-bold mb-0 no-print-btn">DETAIL</h5>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex gap-2">
                            <a href="{{ route('production.index') }}"
                                class="btn btn-secondary btn-sm no-print-btn">Back</a>
                            <a href="{{ route('production.download', hashid_encode($production->id_production, 'production')) }}"
                                target="_blank" class="btn btn-danger btn-sm no-print-btn">
                                <i class="ti ti-download me-1"></i>Download
                            </a>
                            <button onclick="window.print()" class="btn btn-primary btn-sm no-print-btn">Print</button>

                            @if ($status == 0 && (auth()->user()->id_user == $production->id_user || auth()->user()->level == 1))
                                <button type="button"
                                    wire:click="$dispatch('open-production-form', { id: {{ $production->id_production }} })"
                                    class="btn btn-warning btn-sm no-print-btn">Edit</button>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Header Bawah: Logo & Judul --}}
                <div class="d-flex align-items-center mb-4">
                    {{-- Logo --}}
                    <div style="width: 30%;">
                        @php $logoPath = $production->company->logo ?? 'logo.png'; @endphp
                        <img src="{{ asset('assets/companies/logos/' . $logoPath) }}" class="img-fluid" alt="Logo"
                            style="max-height: 120px; object-fit: contain;">
                    </div>
                    {{-- Judul --}}
                    <div class="text-center" style="flex: 1;">
                        <h4 style="font-weight: 700; color: #3b5998; text-transform: uppercase; margin-bottom: 5px;">
                            {{ $production->company->company_name ?? ($production->company->company ?? config('app.name')) }}
                        </h4>
                        <h4 style="font-weight: 600; text-decoration: underline; color: #435e2c; margin-bottom: 0;">
                            PRODUCTION CONVERSION FORM
                        </h4>
                    </div>
                    <div style="width: 30%;"></div>
                </div>

                {{-- Status Info --}}
                <div class="alert alert-{{ $sbadge['color'] }} d-flex align-items-center mb-4" role="alert"
                    style="padding: 8px 15px; border-radius: 4px;">
                    <div style="text-decoration: underline; font-weight:600; font-size: 13px;">PRODUCTION DETAIL
                        INFORMATION</div>
                    <div class="mx-3">
                        <span class="badge bg-{{ $sbadge['color'] }}"
                            style="font-size:11px; padding: 4px 8px;">{{ $sbadge['label'] }}</span>
                    </div>
                </div>

                {{-- Main Content Grid --}}
                <div class="row g-3" style="font-size: 15px;">
                    <div class="col-md-6">
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase text-nowrap">TRANSACTION TYPE</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">
                                <span class="badge bg-light-info text-info border px-3"
                                    style="font-size: 11px;">Production</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">PRODUCTION NUMBER</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">{{ $production->production_number ?? 'DRAFT' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">COMPANY</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">{{ $production->company->company_name ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">PRODUCTION DATE</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">
                                {{ $production->production_date ? \Carbon\Carbon::parse($production->production_date)->format('d F Y') : '-' }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">FINISHED DATE</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">
                                {{ $production->finished_date ? \Carbon\Carbon::parse($production->finished_date)->format('d F Y') : '-' }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">REQUEST DATE</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">{{ $production->created_at->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <div class="row g-3" style="font-size: 15px;">
                    <div class="col-md-6">
                        <div class="row mb-2 no-print-btn">
                            <div class="col-4 fw-bold text-uppercase">CREATOR</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">{{ $production->user->name ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">DEPARTEMENT</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">{{ $production->departement->departement ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">WAREHOUSE</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">{{ $production->warehouse->warehouse_name ?? '-' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-uppercase">DESCRIPTION</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">{{ $production->description ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                {{-- Table 1: Raw Materials Setup --}}
                <div class="card-header align-items-center bg-transparent d-flex px-0 py-3 mt-4 border-bottom">
                    <h5 class="fw-bold mb-0 flex-grow-1 text-danger">RAW MATERIALS (INPUTS)</h5>
                    <div class="d-flex gap-2">
                        @if ($status == 0)
                            <div class="d-flex gap-2 align-items-center no-print-btn">
                                <button type="button" class="btn btn-primary"
                                    onclick="Livewire.dispatch('openModal', { type: 'material' })">
                                    <i class="ti ti-plus me-1"></i> ADD MATERIAL
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped" style="font-size: 15px;">
                        <thead class="text-center" style="background-color: #2e7d32; color: white;">
                            <tr>
                                <th style="width: 50px;">NO</th>
                                <th>CATEGORY</th>
                                <th>CODE & ITEM NAME</th>
                                <th>QTY</th>
                                <th>UOM</th>
                                <th>PACKAGING</th>
                                @if ($status == 0)
                                    <th style="width: 80px;" class="no-print-btn">AKSI</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($production->materials as $index => $mat)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $mat->category->item_category ?? '-' }}</td>
                                    <td>
                                        <span class="fw-bold">{{ $mat->item->item_code ?? 'N/A' }}</span><br>
                                        {{ $mat->item->item_name ?? '-' }}
                                    </td>
                                    <td class="text-end fw-bold">{{ number_format($mat->qty, 2, '.', ',') }}</td>
                                    <td class="text-center">{{ $mat->uom->uom ?? '-' }}</td>
                                    <td class="text-center">{{ $mat->packaging->packaging ?? '-' }}</td>
                                    @if ($status == 0)
                                        <td class="text-center no-print-btn">
                                            <button class="btn btn-link p-0 text-primary me-2" title="Edit Item"
                                                onclick="Livewire.dispatch('openModal', { type: 'material', id: {{ $mat->id_production_material }} })"><i
                                                    class="ti ti-edit fs-4"></i></button>
                                            <button class="btn btn-link p-0 text-danger" title="Hapus Item"
                                                onclick="showConfirm({ title: 'Hapus Item', message: 'Hapus material ini?', type: 'danger', onConfirm: () => @this.deleteMaterial({{ $mat->id_production_material }}) })">
                                                <i class="ti ti-trash fs-4"></i>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $status == 0 ? 7 : 6 }}"
                                        class="text-center py-4 text-muted small">
                                        Belum ada bahan baku ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Table 2: Production Results Setup --}}
                <div class="card-header align-items-center bg-transparent d-flex px-0 py-3 mt-4 border-bottom">
                    <h5 class="fw-bold mb-0 flex-grow-1 text-success">PRODUCTION RESULTS (OUTPUTS)</h5>
                    <div class="d-flex gap-2">
                        @if ($status == 2 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.verify')))
                            <div class="d-flex gap-2 align-items-center no-print-btn">
                                <button type="button" class="btn btn-primary"
                                    onclick="Livewire.dispatch('openModal', { type: 'result' })">
                                    <i class="ti ti-plus me-1"></i> ADD RESULT
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped" style="font-size: 15px;">
                        <thead class="text-center" style="background-color: #0d47a1; color: white;">
                            <tr>
                                <th style="width: 50px;">NO</th>
                                <th>CATEGORY</th>
                                <th>CODE & ITEM NAME</th>
                                <th>QTY</th>
                                <th>UOM</th>
                                <th>PACKAGING</th>
                                @if ($status == 2 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.verify')))
                                    <th style="width: 80px;" class="no-print-btn">AKSI</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($production->results as $index => $res)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $res->category->item_category ?? '-' }}</td>
                                    <td>
                                        <span class="fw-bold">{{ $res->item->item_code ?? 'N/A' }}</span><br>
                                        {{ $res->item->item_name ?? '-' }}
                                    </td>
                                    <td class="text-end fw-bold">{{ number_format($res->qty, 2, '.', ',') }}</td>
                                    <td class="text-center">{{ $res->uom->uom ?? '-' }}</td>
                                    <td class="text-center">{{ $res->packaging->packaging ?? '-' }}</td>
                                    @if ($status == 2 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.verify')))
                                        <td class="text-center no-print-btn">
                                            <button class="btn btn-link p-0 text-primary me-2" title="Edit Item"
                                                onclick="Livewire.dispatch('openModal', { type: 'result', id: {{ $res->id_production_result }} })"><i
                                                    class="ti ti-edit fs-4"></i></button>
                                            <button class="btn btn-link p-0 text-danger" title="Hapus Item"
                                                onclick="showConfirm({ title: 'Hapus Item', message: 'Hapus result ini?', type: 'danger', onConfirm: () => @this.deleteResult({{ $res->id_production_result }}) })">
                                                <i class="ti ti-trash fs-4"></i>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $status == 2 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.verify')) ? 7 : 6 }}"
                                        class="text-center py-4 text-muted small">Belum
                                        ada hasil produksi ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card border-0 shadow-none" style="background: none !important;">
                {{-- Signature Flow --}}
                <div class="mb-5">
                    <div class="row g-3 text-center justify-content-center">

                        {{-- Box 1: Requested By --}}
                        <div class="col-md-3">
                            <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Requested By</div>
                            <div class="border-bottom mx-auto position-relative image-container d-flex flex-column align-items-center justify-content-center"
                                style="height: 100px; border-color: #333 !important;">
                                @if (isset($approverSigns[0]))
                                    <img src="{{ $approverSigns[0]['qr'] }}"
                                        style="height: 80px; width: 80px; object-fit: contain;">
                                    @if ($status == 1 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.process')))
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalCancelProduction"
                                            class="btn position-absolute no-print-btn text-danger bg-white"
                                            style="top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 2px 10px; border-radius: 6px; font-weight: bold; border: 2px solid #dc3545; font-size: 11px;">Cancel</button>
                                    @endif
                                @elseif($status == 0)
                                    @if (auth()->user()->id_user == $production->id_user || auth()->user()->level == 1)
                                        <div class="d-flex justify-content-center gap-2 w-100">
                                            <button type="button"
                                                onclick="showConfirm({title: 'Submit Form?', message: 'Pastikan item sudah benar.', type: 'warning', onConfirm: () => @this.submitProduction()})"
                                                class="btn btn-success rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                style="width: 35px; height: 35px;" title="Submit"><i
                                                    class="ti ti-check fs-4"></i></button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="mt-2 fw-bold small text-uppercase" style="font-size: 14px;">
                                {{ $approverSigns[0]['user_name'] ?? ($production->user->name ?? '-') }}
                            </div>
                            <div class="mt-1 x-small fw-bold">REQUESTOR</div>
                        </div>

                        {{-- Box 2: Processed By --}}
                        <div class="col-md-3 mx-1">
                            <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Processed By</div>
                            <div class="border-bottom mx-auto position-relative image-container d-flex flex-column align-items-center justify-content-center"
                                style="height: 100px; border-color: #333 !important;">
                                @if (isset($approverSigns[1]))
                                    <img src="{{ $approverSigns[1]['qr'] }}"
                                        style="height: 80px; width: 80px; object-fit: contain;">
                                    @if ($status == 2 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.verify')))
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalCancelProduction"
                                            class="btn position-absolute no-print-btn text-danger bg-white"
                                            style="top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 2px 10px; border-radius: 6px; font-weight: bold; border: 2px solid #dc3545; font-size: 11px;">Cancel</button>
                                    @endif
                                @elseif($status == 1)
                                    @if (auth()->user()->level == 1 || auth()->user()->hasPermission('production.process'))
                                        <div class="d-flex justify-content-center gap-2 w-100">
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalProcessDate"
                                                class="btn btn-success rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                style="width: 35px; height: 35px;" title="Process"><i
                                                    class="ti ti-check fs-4"></i></button>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalCancelProduction"
                                                class="btn btn-danger rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                style="width: 35px; height: 35px;" title="Cancel"><i
                                                    class="ti ti-x fs-4"></i></button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="mt-2 fw-bold small text-uppercase" style="font-size: 14px;">
                                {{ $approverSigns[1]['user_name'] ?? '-' }}
                            </div>
                            <div class="mt-1 x-small fw-bold">PROCESSOR</div>
                        </div>

                        {{-- Box 3: Verified By --}}
                        <div class="col-md-3 mx-1">
                            <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Verified By</div>
                            <div class="border-bottom mx-auto position-relative image-container d-flex flex-column align-items-center justify-content-center"
                                style="height: 100px; border-color: #333 !important;">
                                @if (isset($approverSigns[2]))
                                    <img src="{{ $approverSigns[2]['qr'] }}"
                                        style="height: 80px; width: 80px; object-fit: contain;">
                                @elseif($status == 2)
                                    @if (auth()->user()->level == 1 || auth()->user()->hasPermission('production.verify'))
                                        <div class="d-flex justify-content-center gap-2 w-100">
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalFinishDate"
                                                class="btn btn-success rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                style="width: 35px; height: 35px;" title="Verify"><i
                                                    class="ti ti-check fs-4"></i></button>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalCancelProduction"
                                                class="btn btn-danger rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                style="width: 35px; height: 35px;" title="Cancel"><i
                                                    class="ti ti-x fs-4"></i></button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="mt-2 fw-bold small text-uppercase" style="font-size: 14px;">
                                {{ $approverSigns[2]['user_name'] ?? '-' }}
                            </div>
                            <div class="mt-1 x-small fw-bold">VERIFIER</div>
                        </div>

                    </div>
                </div>

                @if ($production->cancel_reason)
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div style="text-decoration: underline;">Cancel Reason</div>
                    </div>
                    <div class="table-responsive dt-responsive">
                        <table class="table table-striped table-bordered nowrap">
                            <thead class="text-center" style="background-color: green; color:white;">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Cancel Reason</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>{{ strtoupper($production->canceledBy->name ?? '-') }}</td>
                                    <td>{{ strtoupper($production->cancel_reason) }}</td>
                                    <td class="text-center">
                                        {{ $production->updated_at ? strtoupper(\Carbon\Carbon::parse($production->updated_at)->format('d F Y')) : '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <livewire:production.form-modal />
            <livewire:production.form-detail-modal :productionId="$production->id_production" />

            {{-- Modal Process Date --}}
            <div class="modal fade" id="modalProcessDate" tabindex="-1" aria-labelledby="modalProcessDateLabel"
                aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header py-2 bg-success text-white">
                            <h6 class="modal-title fw-bold" id="modalProcessDateLabel">Mulai Proses Production</h6>
                            <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label fw-bold small text-uppercase">Production Date (Process) <span
                                    class="text-danger">*</span></label>
                            <input type="date" wire:model="process_date" class="form-control">
                            @error('process_date')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer py-2 justify-content-between">
                            <button type="button" class="btn btn-light btn-sm"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success btn-sm fw-bold"
                                wire:click="processProduction" data-bs-dismiss="modal">
                                PROCESS
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Finished Date --}}
            <div class="modal fade" id="modalFinishDate" tabindex="-1" aria-labelledby="modalFinishDateLabel"
                aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header py-2 bg-success text-white">
                            <h6 class="modal-title fw-bold" id="modalFinishDateLabel">Selesaikan & Potong Stok</h6>
                            <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label fw-bold small text-uppercase">Finished Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" wire:model="finish_date" class="form-control">
                            @error('finish_date')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer py-2 justify-content-between">
                            <button type="button" class="btn btn-light btn-sm"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success btn-sm fw-bold"
                                wire:click="verifyProduction" data-bs-dismiss="modal">
                                VERIFY & FINISH
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Cancel Reason --}}
            <div class="modal fade" id="modalCancelProduction" tabindex="-1"
                aria-labelledby="modalCancelProductionLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header py-2 bg-danger text-white">
                            <h6 class="modal-title fw-bold" id="modalCancelProductionLabel">Alasan Pembatalan /
                                Penolakan</h6>
                            <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label fw-bold small text-uppercase">Reason <span
                                    class="text-danger">*</span></label>
                            <textarea wire:model="cancel_reason" class="form-control" rows="3"
                                placeholder="Masukkan alasan kenapa form ini dikembalikan/ditolak..."></textarea>
                            @error('cancel_reason')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer py-2 justify-content-between">
                            <button type="button" class="btn btn-light btn-sm"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger btn-sm fw-bold"
                                wire:click="cancelProduction" data-bs-dismiss="modal">
                                SUBMIT CANCEL
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>





@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('production-refresh', () => {
                window.location.reload();
            });
        });
    </script>
@endpush
