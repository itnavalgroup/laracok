<div class="production-detail" id="print-area">
    <style>
        .btn-cancel-qr {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 4px 12px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 12px;
            border: 2px solid #ff4d4f;
            color: #ff4d4f;
            background-color: transparent;
            transition: all 0.2s ease-in-out;
        }

        .btn-cancel-qr:hover {
            background-color: #ff4d4f;
            color: #fff;
            border-color: #ff4d4f;
        }
    </style>
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
            @if (
                $status == 0 &&
                    (auth()->user()->id_user == $production->id_user ||
                        auth()->user()->id_user == $production->id_requestor ||
                        auth()->user()->level == 1))
                <button type="button" class="btn btn-success btn-sm rounded-pill px-3 no-print-btn"
                    onclick="showConfirm({title: 'Submit Form?', message: 'Pastikan item sudah benar.', type: 'warning', onConfirm: () => @this.submitProduction()})"><i
                        class="ti ti-check me-1"></i> Submit</button>
            @elseif ($status == 1 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.process')))
                <button type="button" class="btn btn-success btn-sm rounded-pill px-3 no-print-btn"
                    data-bs-toggle="modal" data-bs-target="#modalProcessDate"><i class="ti ti-check me-1"></i>
                    Process</button>
                <button type="button"
                    class="btn border border-danger text-danger btn-sm rounded-pill px-3 no-print-btn bg-white"
                    onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => @this.cancelProduction() })"><i
                        class="ti ti-arrow-back-up me-1"></i> Cancel</button>
            @elseif ($status == 2 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.verify')))
                @if($production->results->isEmpty())
                    <button type="button" class="btn btn-success btn-sm rounded-pill px-3 no-print-btn"
                        onclick="window.dispatchEvent(new CustomEvent('alert', {detail: {type: 'error', title: 'Gagal', message: 'Result (Output) belum ditambahkan. Silakan tambahkan hasil produksi terlebih dahulu!'}}))">
                        <i class="ti ti-check me-1"></i> Verify
                    </button>
                @else
                    <button type="button" class="btn btn-success btn-sm rounded-pill px-3 no-print-btn"
                        data-bs-toggle="modal" data-bs-target="#modalFinishDate"><i class="ti ti-check me-1"></i>
                        Verify</button>
                @endif
                <button type="button"
                    class="btn border border-danger text-danger btn-sm rounded-pill px-3 no-print-btn bg-white"
                    onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => @this.cancelProduction() })"><i
                        class="ti ti-arrow-back-up me-1"></i> Cancel</button>
            @endif
        </div>
    </template>

    <div class="row">
        <div class="col-12">
            <div class="card p-4 border-0 shadow-sm">

                {{-- Header Atas: Teks DETAIL & Tombol --}}
                <div class="d-flex justify-content-between align-items-start mb-4 border-bottom pb-3"
                    data-html2canvas-ignore="true">
                    <div>
                        <h5 class="fw-bold mb-0">DETAIL</h5>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex gap-2">
                            <a href="{{ route('production.index') }}" class="btn btn-secondary btn-sm">Back</a>
                            <a href="{{ route('production.download', hashid_encode($production->id_production, 'production')) }}"
                                target="_blank" class="btn btn-danger btn-sm">
                                <i class="ti ti-download me-1"></i>Download
                            </a>
                            <button onclick="window.print()" class="btn btn-primary btn-sm">Print</button>

                            @if (
                                $status == 0 &&
                                    (auth()->user()->id_user == $production->id_user ||
                                        auth()->user()->id_user == $production->id_requestor ||
                                        auth()->user()->level == 1))
                                <button type="button"
                                    wire:click="$dispatch('open-production-form', { id: {{ $production->id_production }} })"
                                    class="btn btn-warning btn-sm">Edit</button>
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
                            <div class="col-4 fw-bold text-uppercase">REQUESTOR</div>
                            <div class="col-1 text-center">:</div>
                            <div class="col-7">{{ $production->requestor->name ?? '-' }}</div>
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
                        <thead class="text-center" style="background-color: #2e7d32;">
                            <tr>
                                <th style="width: 50px; color: rgb(230, 230, 230) !important;">NO</th>
                                <th style="color: rgb(230, 230, 230) !important;">CATEGORY</th>
                                <th style="color: rgb(230, 230, 230) !important;">CODE & ITEM NAME</th>
                                <th style="color: rgb(230, 230, 230) !important;">QTY</th>
                                <th style="color: rgb(230, 230, 230) !important;">UOM</th>
                                <th style="color: rgb(230, 230, 230) !important;">PACKAGING</th>
                                @if ($status == 0)
                                    <th style="width: 80px; color: rgb(230, 230, 230) !important;"
                                        class="no-print-btn">AKSI</th>
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
                        @if (in_array($status, [1, 2]) &&
                                (auth()->user()->level == 1 ||
                                    auth()->user()->hasPermission('production.process') ||
                                    auth()->user()->hasPermission('production.verify')))
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
                        <thead class="text-center" style="background-color: #0d47a1;">
                            <tr>
                                <th style="width: 50px; color: rgb(230, 230, 230) !important;">NO</th>
                                <th style="color: rgb(230, 230, 230) !important;">CATEGORY</th>
                                <th style="color: rgb(230, 230, 230) !important;">CODE & ITEM NAME</th>
                                <th style="color: rgb(230, 230, 230) !important;">QTY</th>
                                <th style="color: rgb(230, 230, 230) !important;">UOM</th>
                                <th style="color: rgb(230, 230, 230) !important;">PACKAGING</th>
                                @if (in_array($status, [1, 2]) &&
                                        (auth()->user()->level == 1 ||
                                            auth()->user()->hasPermission('production.process') ||
                                            auth()->user()->hasPermission('production.verify')))
                                    <th style="width: 80px; color: rgb(230, 230, 230) !important;"
                                        class="no-print-btn">AKSI</th>
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
                                    @if (in_array($status, [1, 2]) &&
                                            (auth()->user()->level == 1 ||
                                                auth()->user()->hasPermission('production.process') ||
                                                auth()->user()->hasPermission('production.verify')))
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
                                    <td colspan="{{ in_array($status, [1, 2]) && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.process') || auth()->user()->hasPermission('production.verify')) ? 7 : 6 }}"
                                        class="text-center py-4 text-muted small">Belum
                                        ada hasil produksi ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Supporting Document --}}
                <div class="card border-0 shadow-sm theme-responsive-card">
                    <div class="card-body p-4">
                        @php
                            $canManageAtt =
                                auth()->user()->level == 1 ||
                                auth()->user()->id_user == $production->id_user ||
                                auth()->user()->hasPermission('production.process') ||
                                auth()->user()->hasPermission('production.verify');
                            $isAllowedStatus = in_array($production->status, [0, 1, 2]);
                            $canViewAtt = true;
                        @endphp
                        <div class="card-header align-items-center bg-transparent d-flex px-0 py-3 mt-4 border-bottom">
                            <h6 class="card-title mb-0 flex-grow-1 fw-bold text-uppercase">SUPPORTING DOCUMENT :</h6>
                            <div class="flex-shrink-0">
                                @if ($isAllowedStatus && $canManageAtt)
                                    <button type="button" class="btn btn-primary no-print-btn"
                                        data-bs-toggle="modal" data-bs-target="#modalAddAttachment"
                                        data-html2canvas-ignore>
                                        ADD
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="row g-3 py-3" style="font-size: 15px;">
                            @foreach ($production->attachments as $file)
                                @php
                                    $canEditDeleteAtt = $production->status == 0 && $canManageAtt;
                                    $attHash = hashid_encode($file->id_production_attachment, 'attachment-production');
                                    $fileUrl = asset('assets/attachmentproduction/' . $file->filename);
                                @endphp
                                <div class="col-md-2 d-flex align-items-center mb-2">
                                    <div class="form-check form-check-inline d-flex align-items-center mb-0">
                                        <input type="checkbox" class="form-check-input input-primary me-2" checked
                                            onclick="return false;" style="width: 1.2rem; height: 1.2rem;">
                                        <label class="form-check-label text-justify flex-grow-1 fw-bold text-uppercase"
                                            style="cursor:pointer; font-size: 0.9rem;">
                                            <a href="javascript:void(0)" data-url="{{ $fileUrl }}"
                                                data-type="{{ $file->attachment->attachment ?? 'GENERAL' }}"
                                                data-note="{{ $file->note }}"
                                                data-delete="{{ route('production.attachment.delete', $attHash) }}"
                                                data-update="{{ route('production.attachment.update', $attHash) }}"
                                                data-catid="{{ $file->id_attachment }}"
                                                data-can-edit="{{ $canEditDeleteAtt ? 'true' : 'false' }}"
                                                onclick="{{ $canViewAtt ? 'previewAttachment(this)' : 'window.dispatchEvent(new CustomEvent(\'alert\', { detail: { type: \'error\', title: \'Access Denied\', message: \'Anda tidak memiliki izin untuk melihat lampiran.\' } }))' }}; return false;"
                                                style="color: inherit; text-decoration: none;">
                                                {{ $file->attachment->attachment ?? ($file->note ?: '-') }}
                                            </a>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Signature Flow --}}
                <div class="mt-5 pt-4 border-top mb-5">
                    <div class="row g-3 text-center justify-content-center">

                        {{-- Box 1: Requested By --}}
                        <div class="col-md-3">
                            <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Requested By</div>
                            <div class="border-bottom mx-auto position-relative image-container d-flex flex-column align-items-center justify-content-center"
                                style="height: 120px; border-color: #333 !important;">
                                @if (isset($approverSigns[0]))
                                    <img src="{{ $approverSigns[0]['qr'] }}"
                                        style="height: 100px; width: 100px; object-fit: contain;">
                                    @if ($status == 1 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.process')))
                                        <button type="button"
                                            onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => @this.cancelProduction() })"
                                            class="btn position-absolute no-print-btn btn-cancel-qr">Cancel</button>
                                    @endif
                                @elseif($status == 0)
                                    @if (auth()->user()->id_user == $production->id_user ||
                                            auth()->user()->id_user == $production->id_requestor ||
                                            auth()->user()->level == 1)
                                        <div class="d-flex justify-content-center gap-2 w-100">
                                            <button type="button"
                                                onclick="showConfirm({title: 'Submit Form?', message: 'Pastikan item sudah benar.', type: 'warning', onConfirm: () => @this.submitProduction()})"
                                                class="btn btn-outline-primary btn-xs mt-4 no-print-btn"
                                                style="font-size: 12px;">SUBMIT</button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="mt-2 fw-bold small text-uppercase" style="font-size: 14px;">
                                {{ $approverSigns[0]['user_name'] ?? ($production->requestor->name ?? ($production->user->name ?? '-')) }}
                            </div>
                            <div class="mt-1 x-small fw-bold text-uppercase">
                                {{ $production->requestor->departement->departement ?? ($production->user->departement->departement ?? 'REQUESTOR') }}
                            </div>
                        </div>

                        {{-- Box 2: Processed By --}}
                        <div class="col-md-3 mx-1">
                            <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Processed By</div>
                            <div class="border-bottom mx-auto position-relative image-container d-flex flex-column align-items-center justify-content-center"
                                style="height: 120px; border-color: #333 !important;">
                                @if (isset($approverSigns[1]))
                                    <img src="{{ $approverSigns[1]['qr'] }}"
                                        style="height: 100px; width: 100px; object-fit: contain;">
                                    @if ($status == 2 && (auth()->user()->level == 1 || auth()->user()->hasPermission('production.verify')))
                                        <button type="button"
                                            onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => @this.cancelProduction() })"
                                            class="btn position-absolute no-print-btn btn-cancel-qr">Cancel</button>
                                    @endif
                                @elseif($status == 1)
                                    @if (auth()->user()->level == 1 || auth()->user()->hasPermission('production.process'))
                                        <div class="d-flex justify-content-center gap-2 w-100">
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalProcessDate"
                                                class="btn btn-success rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                style="width: 35px; height: 35px;" title="Process"><i
                                                    class="ti ti-check fs-4"></i></button>
                                            <button type="button"
                                                onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => @this.cancelProduction() })"
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
                                style="height: 120px; border-color: #333 !important;">
                                @if (isset($approverSigns[2]))
                                    <img src="{{ $approverSigns[2]['qr'] }}"
                                        style="height: 100px; width: 100px; object-fit: contain;">
                                @elseif($status == 2)
                                    @if (auth()->user()->level == 1 || auth()->user()->hasPermission('production.verify'))
                                        <div class="d-flex justify-content-center gap-2 w-100">
                                            @if($production->results->isEmpty())
                                                <button type="button"
                                                    onclick="window.dispatchEvent(new CustomEvent('alert', {detail: {type: 'error', title: 'Gagal', message: 'Result (Output) belum ditambahkan. Silakan tambahkan hasil produksi terlebih dahulu!'}}))"
                                                    class="btn btn-success rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                    style="width: 35px; height: 35px;" title="Verify"><i
                                                        class="ti ti-check fs-4"></i></button>
                                            @else
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modalFinishDate"
                                                    class="btn btn-success rounded-circle p-0 d-flex align-items-center justify-content-center no-print-btn text-white hover-scale"
                                                    style="width: 35px; height: 35px;" title="Verify"><i
                                                        class="ti ti-check fs-4"></i></button>
                                            @endif
                                            <button type="button"
                                                onclick="showConfirm({ title: 'Batalkan Step?', message: 'Mundur satu langkah ke status sebelumnya?', type: 'warning', onConfirm: () => @this.cancelProduction() })"
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

                @if ($production->cancel_reason && $status == 0)
                    <div class="alert alert-danger d-flex align-items-center mb-2 no-print-history" role="alert"
                        style="padding: 5px 15px;">
                        <div style="text-decoration: underline; font-weight:600; font-size: 12px;">REJECT / REVISION
                            HISTORY</div>
                    </div>
                    <div class="table-responsive mb-4 no-print-history">
                        <table class="table table-sm table-bordered table-striped" style="font-size: 11px;">
                            <thead class="bg-danger text-white">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>By</th>
                                    <th>Reason</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">
                                        <span class="badge bg-danger">REJECTED</span>
                                    </td>
                                    <td>{{ $production->canceledBy->name ?? 'Admin / System' }}</td>
                                    <td>{{ $production->cancel_reason }}</td>
                                    <td class="text-center">
                                        {{ $production->updated_at ? \Carbon\Carbon::parse($production->updated_at)->format('d/m/Y H:i') : '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
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
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn-sm fw-bold" wire:click="processProduction">
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
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label fw-bold small text-uppercase">Finished Date <span
                            class="text-danger">*</span></label>
                    <input type="date" wire:model="finish_date" class="form-control"
                        min="{{ $production->production_date ? \Carbon\Carbon::parse($production->production_date)->format('Y-m-d') : '' }}">
                    @error('finish_date')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer py-2 justify-content-between">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success btn-sm fw-bold" wire:click="verifyProduction">
                        VERIFY & FINISH
                    </button>
                </div>
            </div>
        </div>
    </div>



    @include('livewire.production.attachment-modals', ['productionHash' => $hash])
</div>





@push('scripts')
    @include('livewire.production.attachment-scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('production-refresh', () => {
                window.location.reload();
            });

            Livewire.on('close-modal-process', () => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalProcessDate'));
                if (modal) modal.hide();
                cleanupBackdrops();
            });

            Livewire.on('close-modal-verify', () => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalFinishDate'));
                if (modal) modal.hide();
                cleanupBackdrops();
            });
        });

        function cleanupBackdrops() {
            setTimeout(() => {
                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                if (!document.querySelector('.modal.show')) {
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                }
            }, 300);
        }


    </script>
@endpush
