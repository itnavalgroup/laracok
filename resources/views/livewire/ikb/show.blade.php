<div class="ikb-detail">
    @php
    $status = intval($ikb->status);
    // permissions - Some passed from component, some defined here for view-only logic
    $user = auth()->user();
    $isAdmin = $user->level == 1;
    $isOwner = $user->id_user == $ikb->id_user;
    $isSales = $user->id_user == $ikb->sales;

    // canSubmit, canEditDetail, canDeleteDetail are passed from component
    $canSubmit =
    ($status === 0 || $status === 11) && ($isAdmin || ($isSales && $user->hasPermission('ikb.submit')));
    $canEditHeader =
    ($status === 0 || $status === 11) && ($isAdmin || ($isOwner && $user->hasPermission('ikb.edit')));
    $canDownload = $isAdmin || $isOwner || $user->hasPermission('ikb.download');
    $canPrint = $isAdmin || $isOwner || $user->hasPermission('ikb.print');

    $sign = fn(int $s) => $ikb->signTransactions->where('status', $s)->first();

    $statusBadge = [
    0 => ['label' => 'DRAFT', 'color' => 'secondary'],
    1 => ['label' => 'PENDING SPV/MGR SIGN', 'color' => 'warning'],
    2 => ['label' => 'PENDING DIR LOG SIGN', 'color' => 'warning'],
    3 => ['label' => 'PENDING PPIC SIGN', 'color' => 'warning'],
    4 => ['label' => 'PENDING INV CTRL SIGN', 'color' => 'warning'],
    5 => ['label' => 'PENDING LOG COORD SIGN', 'color' => 'warning'],
    6 => ['label' => 'PENDING WH STAFF SIGN', 'color' => 'warning'],
    7 => ['label' => 'PENDING WH SPV SIGN', 'color' => 'warning'],
    8 => ['label' => 'PENDING SECURITY SIGN', 'color' => 'warning'],
    9 => ['label' => 'PENDING FINAL LOG COORD', 'color' => 'warning'],
    10 => ['label' => 'APPROVED / DONE', 'color' => 'success'],
    11 => ['label' => 'REVISION', 'color' => 'primary'],
    12 => ['label' => 'REJECTED', 'color' => 'danger'],
    ];
    $sbadge = $statusBadge[$status] ?? ['label' => 'UNKNOWN', 'color' => 'dark'];

    // Determine if current user can approve/reject/revision at the CURRENT status
    $canApproveCurrent = false;
    $currentStep = $status;
    if ($currentStep > 0 && $currentStep < 10) {
        if ($isAdmin) {
        $canApproveCurrent=true;
        } else {
        $canApproveCurrent=$user->hasPermission("ikb.approve.step{$currentStep}");
        if ($currentStep == 1) {
        $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();
        if (!in_array($ikb->sales, $subordinateIds)) {
        $canApproveCurrent = false;
        }
        }
        }
        }

        // Determine if current user can cancel at the CURRENT status
        $canCancelCurrent = false;
        if ($status > 1 && $status <= 10) {
            $cancelStep=$status - 1;
            $prevSign=$sign($cancelStep);
            if ($isAdmin || ($prevSign && $user->id_user == $prevSign->id_user)) {
            $canCancelCurrent = true;
            }
            }
            @endphp

            <template x-teleport="#ikb-header-actions">
                <div class="d-flex align-items-center gap-2">
                    @if ($canSubmit)
                    <button type="button" class="btn btn-primary btn-sm rounded-pill shadow-sm px-3 fw-bold"
                        onclick="openApprovalModal('approve', {{ $status }})">
                        <i class="ti ti-send me-1"></i> Submit
                    </button>
                    @endif

                    @if ($canApproveCurrent)
                    <button type="button" class="btn btn-success btn-sm rounded-pill shadow-sm px-3 fw-bold"
                        onclick="openApprovalModal('approve', {{ $status }})">
                        <i class="ti ti-check me-1"></i> Approve
                    </button>
                    @if ($status < 6)
                        <button type="button" class="btn btn-warning btn-sm rounded-pill shadow-sm px-3 fw-bold"
                        onclick="openApprovalModal('revision', {{ $status }})">
                        <i class="ti ti-refresh me-1"></i> Revision
                        </button>
                        <button type="button" class="btn btn-danger btn-sm rounded-pill shadow-sm px-3 fw-bold"
                            onclick="openApprovalModal('reject', {{ $status }})">
                            <i class="ti ti-x me-1"></i> Reject
                        </button>
                        @endif
                        @endif

                        @if ($canCancelCurrent)
                        <button type="button"
                            class="btn btn-outline-danger btn-sm rounded-pill shadow-sm px-3 fw-bold bg-white"
                            onclick="showCancelModal('cancelApproval')">
                            <i class="ti ti-arrow-back-up me-1"></i> Cancel
                        </button>
                        @endif
                </div>
            </template>

            <div class="row">
                <div class="col-12">
                    <div class="card p-3 border-0 shadow-sm">
                        {{-- Header Atas: Teks DETAIL & QR + Tombol --}}
                        <div class="d-flex justify-content-between align-items-start mb-4 border-bottom pb-3">
                            <div>
                                <h5 class="fw-bold mb-0 no-print-btn">DETAIL</h5>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                {{-- Tombol Actions --}}
                                <div class="d-flex gap-2">
                                    <a href="{{ route('ikb.index') }}" class="btn btn-secondary btn-sm no-print-btn">Back</a>
                                    @if ($canDownload)
                                    <button id="btnDownloadPDF" onclick="downloadPDF()"
                                        class="btn btn-danger btn-sm no-print-btn">
                                        <span id="btnDownloadNormal"><i class="ti ti-download me-1"></i>Download</span>
                                        <span id="btnDownloadLoading" class="d-none">
                                            <span class="spinner-border spinner-border-sm me-1"
                                                role="status"></span>Generating...
                                        </span>
                                    </button>
                                    @endif
                                    @if ($canPrint)
                                    <button onclick="window.printIKB()"
                                        class="btn btn-primary btn-sm no-print-btn">Print</button>
                                    @endif
                                    @if ($canEditHeader)
                                    <button type="button"
                                        wire:click="$dispatch('open-ikb-form', { id: {{ $ikb->id_ikb }} })"
                                        class="btn btn-warning btn-sm no-print-btn">Edit</button>
                                    @endif
                                </div>
                                {{-- QR Code --}}
                                @if ($ikb->qr)
                                <img alt="QR IKB" src="{{ asset('assets/qr/' . $ikb->qr) }}"
                                    style="height: 60px; width: 60px; object-fit: contain;">
                                @endif
                            </div>
                        </div>

                        {{-- Header Bawah: Logo & Judul --}}
                        <div class="d-flex align-items-center mb-4">
                            {{-- Logo --}}
                            <div style="width: 30%;">
                                @php
                                $logoPath = $ikb->company->logo ?? 'logo.png';
                                @endphp
                                <img src="{{ asset('assets/companies/logos/' . $logoPath) }}" class="img-fluid" alt="Logo"
                                    style="max-height: 120px; object-fit: contain;">
                            </div>
                            {{-- Judul --}}
                            <div class="text-center" style="flex: 1;">
                                <h4 style="font-weight: 700; color: #3b5998; text-transform: uppercase; margin-bottom: 5px;">
                                    {{ $ikb->company->company_name ?? ($ikb->company->company ?? config('app.name')) }}
                                </h4>
                                <h4 style="font-weight: 600; text-decoration: underline; color: #435e2c; margin-bottom: 0;">
                                    GOODS ISSUE INSTRUCTION FORM (IKB)
                                </h4>
                            </div>
                            <div style="width: 30%;"></div>
                        </div>

                        {{-- Status Info --}}
                        <div class="alert alert-{{ $sbadge['color'] }} d-flex align-items-center mb-4" role="alert"
                            style="padding: 8px 15px; border-radius: 4px;">
                            <div style="text-decoration: underline; font-weight:600; font-size: 13px;">IKB DETAIL INFORMATION
                            </div>
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
                                        <span class="badge bg-light-info text-info border px-3" style="font-size: 11px;">
                                            {{ $ikb->transactionType->transaction_type ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">IKB NUMBER</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->ikb_number ?? 'DRAFT' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">PO NUMBER</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->po_number ?? '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">SO NUMBER</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->so_number ?? '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">RI NUMBER</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->ri_number ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">REQUEST DATE</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->created_at->format('d F Y') }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">BOOKING DATE</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->booking_date ? $ikb->booking_date->format('d F Y') : '-' }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">DELIVERY DATE</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7 d-flex align-items-center gap-2">
                                        @if ($ikb->delivery_date)
                                        {{ $ikb->delivery_date->format('d F Y') }}
                                        @if ($canApproveStep8 && $status == 8)
                                        <button class="btn btn-outline-secondary no-print-btn"
                                            style="font-size:10px;padding:1px 6px;"
                                            wire:click="$set('deliveryDate', '{{ $ikb->delivery_date->format('Y-m-d') }}')"
                                            data-bs-toggle="modal" data-bs-target="#modalDeliveryDate">Edit</button>
                                        @endif
                                        @elseif($canApproveStep8 && $status == 8)
                                        <button class="btn btn-primary btn-sm no-print-btn"
                                            style="font-size:11px;padding:2px 8px;" data-bs-toggle="modal"
                                            data-bs-target="#modalDeliveryDate">
                                            📅 Set Delivery Date
                                        </button>
                                        @else
                                        -
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">STUFFING DATE</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7 d-flex align-items-center gap-2">
                                        @if ($ikb->stuffing_date)
                                        {{ $ikb->stuffing_date->format('d F Y') }}
                                        @if ($canApproveStep6 && $status == 6)
                                        <button class="btn btn-outline-secondary no-print-btn"
                                            style="font-size:10px;padding:1px 6px;"
                                            data-date="{{ $ikb->stuffing_date->format('Y-m-d') }}"
                                            data-bs-toggle="modal" data-bs-target="#modalStuffingDate">Edit</button>
                                        @endif
                                        @elseif($canApproveStep6 && $status == 6)
                                        <button class="btn btn-primary btn-sm no-print-btn"
                                            style="font-size:11px;padding:2px 8px;" data-bs-toggle="modal"
                                            data-bs-target="#modalStuffingDate">
                                            📅 Set Stuffing Date
                                        </button>
                                        @else
                                        -
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row g-3" style="font-size: 15px;">
                            <div class="col-md-6">
                                <div class="row mb-2 no-print-btn">
                                    <div class="col-4 fw-bold text-uppercase">CREATOR</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->user->name ?? '-' }}</div>
                                </div>
                                <div class="row mb-2 no-print-btn">
                                    <div class="col-4 fw-bold text-uppercase">SALES</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->salesUser->name ?? '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">DEPARTEMENT</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->departement->departement ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">WAREHOUSE</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->warehouse->warehouse_name ?? '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">CUSTOMER</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->vendor->vendor ?? '-' }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold text-uppercase">DESTINATION</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-7">{{ $ikb->destination ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Item Table Setup --}}
                        <div class="card-header align-items-center bg-transparent d-flex px-0 py-3 mt-4 border-bottom">
                            <h5 class="fw-bold mb-0 flex-grow-1">LIST ITEMS</h5>
                            <div class="d-flex gap-2">
                                @if (($status == 0 || $status == 11) && ($isAdmin || ($isOwner && $user->hasPermission('ikb_detail.create'))))
                                <button class="btn btn-primary btn-sm no-print-btn"
                                    wire:click="$dispatchTo('ikb.form-detail-modal', 'openModal')">ADD ITEM</button>
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
                                        <th>DESCRIPTION</th>
                                        @if ($status == 0 || $status == 11 || (($status >= 4 && $status <= 9) && $canEditDetail))
                                        <th style="width: 80px;" class="no-print-btn">AKSI</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ikb->details as $index => $detail)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $detail->itemCategory->item_category ?? '-' }}</td>
                                        <td>
                                            <span class="fw-bold">{{ $detail->item->item_code ?? 'N/A' }}</span><br>
                                            {{ $detail->item->item_name ?? 'N/A' }}
                                        </td>
                                        <td class="text-center fw-bold">{{ number_format($detail->qty, 2, '.', ',') }}
                                        </td>
                                        <td class="text-center">{{ $detail->uom->uom ?? '-' }}</td>
                                        <td class="text-center">{{ $detail->packaging->packaging ?? '-' }}</td>
                                        <td class="text-center">{{ $detail->description ?? '-' }}</td>
                                        @if (($status == 0 || $status == 11 || (($status >= 4 && $status <= 9) && $canEditDetail)) && ($canEditDetail || $canDeleteDetail))
                                        <td class="text-center no-print-btn">
                                            @if ($canEditDetail)
                                            <button class="btn btn-link p-0 text-warning me-2" title="Edit Item"
                                                wire:click="$dispatchTo('ikb.form-detail-modal', 'openModal', { id: {{ $detail->id_ikb_detail }} })">
                                                <i class="ti ti-edit fs-4"></i>
                                            </button>
                                            @endif
                                            @if ($canDeleteDetail && ($status == 0 || $status == 11))
                                            <button class="btn btn-link p-0 text-danger" title="Hapus Item"
                                                onclick="showConfirm({
                                            title: 'Hapus Item',
                                            message: 'Apakah Anda yakin ingin menghapus item ini?',
                                            type: 'danger',
                                            onConfirm: () => @this.dispatch('delete-detail', { id: {{ $detail->id_ikb_detail }} })
                                        })">
                                                <i class="ti ti-trash fs-4"></i>
                                            </button>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted small">Belum ada item
                                            ditambahkan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Attachment Setup --}}
                        <div class="card-header align-items-center bg-transparent d-flex px-0 py-3 mt-4 border-bottom">
                            <h6 class="card-title mb-0 flex-grow-1">SUPPORTING DOCUMENT :</h6>
                            <div class="flex-shrink-0">
                                @php
                                $canViewAtt =
                                $isAdmin ||
                                $isOwner ||
                                $user->id_user == $ikb->sales ||
                                $user->hasPermission('ikb.view.attachment');
                                @endphp
                                @if (
                                $status < 9 &&
                                    ($isAdmin ||
                                    (($status==0 || $status==11) && $isOwner && $user->hasPermission('ikb_detail.create')) ||
                                    ($status == 8 && $user->hasPermission('ikb.approve.step8'))))
                                    <button class="btn btn-primary no-print-btn" data-bs-toggle="modal"
                                        data-bs-target="#modalAddAttachment">ADD</button>
                                    @endif
                            </div>
                        </div>
                        <div class="row g-3" style="font-size: 15px;">
                            @php
                            $lastSignStep7 = null;
                            if ($status == 8) {
                            $lastSignStep7 = \App\Models\SignTransaction::where('id_ikb', '=', $ikb->id_ikb)
                            ->where('status', '=', 7)
                            ->latest()
                            ->first();
                            }
                            @endphp
                            @foreach ($ikb->attachments as $att)
                            @php
                            $canViewThisAtt = $canViewAtt || $att->id_user == $user->id_user;
                            $canEditAtt = false;
                            if ($isAdmin) {
                            $canEditAtt = true;
                            } elseif ($status == 0 || $status == 11) {
                            if (
                            $isOwner &&
                            ($user->hasPermission('ikb_detail.edit') ||
                            $user->hasPermission('ikb_detail.delete'))
                            ) {
                            $canEditAtt = true;
                            }
                            } elseif ($status == 8) {
                            // In Step 8, Security can only edit what they themselves uploaded during this step
                            if (
                            $lastSignStep7 &&
                            $att->created_at > $lastSignStep7->created_at &&
                            $att->id_user == $user->id_user
                            ) {
                            $canEditAtt = true;
                            }
                            }

                            // Global override: No actions allowed if Step 8 finalized (Status 9 or 10)
                            if ($status >= 9) {
                            $canEditAtt = false;
                            }
                            @endphp
                            <div class="col-md-2 d-flex align-items-center mb-3">
                                <div class="form-check form-check-inline d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input input-primary me-2" checked
                                        onclick="return false;">
                                    <label class="form-check-label text-justify flex-grow-1" style="cursor:pointer;">
                                        @php $attHash = hashid_encode($att->id_attachment_ikb, 'att_ikb'); @endphp
                                        <a href="#"
                                            data-url="{{ asset('assets/attachmentikb/' . $att->filename) }}"
                                            data-type="{{ $att->type->attachment ?? 'GENERAL' }}"
                                            data-note="{{ $att->note ?? '' }}"
                                            data-delete="{{ route('ikb.attachment.delete', $attHash) }}"
                                            data-update="{{ route('ikb.attachment.update', $attHash) }}"
                                            data-catid="{{ $att->id_attachment }}"
                                            data-can-edit="{{ $canEditAtt ? 'true' : 'false' }}"
                                            onclick="{{ $canViewThisAtt ? 'window.previewAttachment(this)' : 'window.dispatchEvent(new CustomEvent(\'alert\', { detail: { type: \'error\', title: \'Access Denied\', message: \'Anda tidak memiliki izin untuk melihat lampiran ini.\' } }))' }}; return false;"
                                            style="color:inherit;text-decoration:none;">
                                            {{ $att->type->attachment ?? ($att->note ?: '-') }}
                                        </a>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Signature Flow --}}
                        <div class="mt-5 pt-4 border-top">
                            <!-- Row 1: 6 Boxes -->
                            <div class="row g-3 text-center">
                                {{-- Box 1: Requested By (Sales) --}}
                                <div class="col">
                                    <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">Requested By</div>
                                    <div class="border-bottom mx-auto position-relative image-container"
                                        style="height: 100px; width: 120px; border-color: #333 !important;">
                                        @php $s0 = $sign(0); @endphp
                                        @if ($s0)
                                        @php
                                        $qrText =
                                        'IKB: ' .
                                        ($ikb->ikb_number ?? 'DRAFT') .
                                        "\nBy: " .
                                        ($s0->user->name ?? '-') .
                                        "\nDate: " .
                                        $s0->created_at->format('d/m/Y H:i') .
                                        "\nUrl: " .
                                        route('ikb.show', hashid_encode($ikb->id_ikb, 'ikb'));
                                        @endphp
                                        <div class="pt-2">
                                            <img src="{{ $this->getQr($qrText) }}"
                                                style="height: 80px; width: 80px; object-fit: contain;">
                                        </div>
                                        @if ($status == 1 && ($isAdmin || ($isSales && $user->hasPermission('ikb.cancel_submit'))))
                                        <button type="button"
                                            class="btn btn-outline-danger btn-xs position-absolute top-50 start-50 translate-middle no-print-btn"
                                            onclick="showCancelModal('cancelSubmit')">Cancel</button>
                                        @endif
                                        @elseif($canSubmit)
                                        <button onclick="openApprovalModal('approve', 0)"
                                            class="btn btn-outline-primary btn-xs mt-4 no-print-btn"
                                            style="font-size: 12px;">SUBMIT</button>
                                        @endif
                                    </div>
                                    <div class="mt-2 fw-bold small text-uppercase" style="font-size: 14px;">
                                        {{ $s0->user->name ?? ($ikb->salesUser->name ?? '-') }}
                                    </div>
                                    <div class="mt-1 x-small fw-bold">SALES</div>
                                </div>

                                {{-- Box 2: Verified By (Supervisor) --}}
                                @php
                                $cols = [
                                ['step' => 1, 'title' => 'Verified By', 'role' => 'SUPERVISOR'],
                                ['step' => 2, 'title' => 'Approved By', 'role' => 'DIRECTOR'],
                                ['step' => 3, 'title' => 'Checked By', 'role' => 'PPIC'],
                                ['step' => 4, 'title' => 'Checked By', 'role' => 'INVENTORY CONTROL'],
                                ['step' => 5, 'title' => 'Checked By', 'role' => 'LOGISTIC COORDINATOR'],
                                ];
                                @endphp
                                @foreach ($cols as $col)
                                <div class="col">
                                    <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">
                                        {{ $col['title'] }}
                                    </div>
                                    <div class="border-bottom mx-auto position-relative image-container"
                                        style="height: 100px; width: 120px; border-color: #333 !important;">
                                        @php $s = $sign($col['step']); @endphp
                                        @if ($s)
                                        @php
                                        $qrText =
                                        'IKB: ' .
                                        ($ikb->ikb_number ?? 'DRAFT') .
                                        "\nApproved By: " .
                                        ($s->user->name ?? '-') .
                                        "\nRole: " .
                                        $col['role'] .
                                        "\nDate: " .
                                        $s->created_at->format('d/m/Y H:i') .
                                        "\nUrl: " .
                                        route('ikb.show', hashid_encode($ikb->id_ikb, 'ikb'));
                                        @endphp
                                        <div class="pt-2">
                                            <img src="{{ $this->getQr($qrText) }}"
                                                style="height: 80px; width: 80px; object-fit: contain;">
                                        </div>
                                        @if ($status == $col['step'] + 1 && ($isAdmin || $user->id_user == $s->id_user))
                                        <button type="button"
                                            class="btn btn-outline-danger btn-xs position-absolute top-50 start-50 translate-middle no-print-btn"
                                            onclick="showCancelModal('cancelApproval')">Cancel</button>
                                        @endif
                                        @elseif($status == $col['step'])
                                        @php
                                        $canApprove = false;
                                        if ($isAdmin) {
                                        $canApprove = true;
                                        } else {
                                        $canApprove = $user->hasPermission("ikb.approve.step{$col['step']}");
                                        if ($col['step'] == 1) {
                                        $subordinateIds = $user
                                        ->subordinates()
                                        ->pluck('id_user')
                                        ->toArray();
                                        if (!in_array($ikb->sales, $subordinateIds)) {
                                        $canApprove = false;
                                        }
                                        }
                                        }
                                        @endphp
                                        @if ($canApprove)
                                        <div class="d-flex flex-row justify-content-center gap-1 pt-4 px-1 no-print-btn"
                                            data-html2canvas-ignore="true">
                                            <button onclick="openApprovalModal('approve', {{ $col['step'] }})"
                                                class="btn btn-success btn-icon btn-sm" title="Approve"><i
                                                    class="ti ti-check fs-6"></i></button>
                                            <button onclick="openApprovalModal('reject', {{ $col['step'] }})"
                                                class="btn btn-danger btn-icon btn-sm" title="Reject"><i
                                                    class="ti ti-x fs-6"></i></button>
                                            <button onclick="openApprovalModal('revision', {{ $col['step'] }})"
                                                class="btn btn-warning btn-icon btn-sm" title="Revision"><i
                                                    class="ti ti-refresh fs-6"></i></button>
                                        </div>
                                        @else
                                        <span class="badge bg-light text-muted fw-normal mt-4 no-print-btn"
                                            style="font-size: 10px;" data-html2canvas-ignore="true">PENDING</span>
                                        @endif
                                        @endif
                                    </div>
                                    <div class="mt-2 fw-bold small text-uppercase" style="font-size: 14px;">
                                        {{ $s->user->name ?? '-' }}
                                    </div>
                                    <div class="mt-1 x-small fw-bold">{{ $col['role'] }}</div>
                                </div>
                                @endforeach
                            </div>

                            <div class="alert alert-light border text-center fw-bold py-1 my-2 text-uppercase"
                                style="font-size: 11px; letter-spacing: 1px; color: #555;">WAREHOUSE PROCESSING</div>

                            <!-- Row 2: 4 Boxes -->
                            <div class="row g-3 text-center justify-content-center">
                                @php
                                $cols2 = [
                                ['step' => 6, 'title' => 'Prepared By', 'role' => 'WAREHOUSE STAFF'],
                                ['step' => 7, 'title' => 'Verified By', 'role' => 'WAREHOUSE SUPERVISOR'],
                                ['step' => 8, 'title' => 'Checked By', 'role' => 'SECURITY OFFICER'],
                                ['step' => 9, 'title' => 'Authorized By', 'role' => 'LOGISTIC COORDINATOR'],
                                ];
                                @endphp
                                @foreach ($cols2 as $col)
                                <div class="col-md-2">
                                    <div class="fw-bold mb-1 small text-uppercase" style="font-size: 14px;">
                                        {{ $col['title'] }}
                                    </div>
                                    <div class="border-bottom mx-auto position-relative image-container"
                                        style="height: 100px; width: 120px; border-color: #333 !important;">
                                        @php $s = $sign($col['step']); @endphp
                                        @if ($s)
                                        @php
                                        $qrText =
                                        'IKB: ' .
                                        ($ikb->ikb_number ?? 'DRAFT') .
                                        "\nApproved By: " .
                                        ($s->user->name ?? '-') .
                                        "\nRole: " .
                                        $col['role'] .
                                        "\nDate: " .
                                        $s->created_at->format('d/m/Y H:i') .
                                        "\nUrl: " .
                                        route('ikb.show', hashid_encode($ikb->id_ikb, 'ikb'));
                                        @endphp
                                        <div class="pt-2">
                                            <img src="{{ $this->getQr($qrText) }}"
                                                style="height: 80px; width: 80px; object-fit: contain;">
                                        </div>
                                        @if ($status == $col['step'] + 1 && ($isAdmin || $user->id_user == $s->id_user))
                                        <button type="button"
                                            class="btn btn-outline-danger btn-xs position-absolute top-50 start-50 translate-middle no-print-btn"
                                            onclick="showCancelModal('cancelApproval')">Cancel</button>
                                        @endif
                                        @elseif($status == $col['step'])
                                        @php $canApprove = $isAdmin || $user->hasPermission("ikb.approve.step{$col['step']}"); @endphp
                                        @if ($canApprove)
                                        <div class="d-flex flex-row justify-content-center gap-1 pt-4 px-1 no-print-btn"
                                            style="z-index: 10;" data-html2canvas-ignore="true">
                                            <button onclick="openApprovalModal('approve', {{ $col['step'] }})"
                                                class="btn btn-success btn-icon btn-sm" title="Approve"><i
                                                    class="ti ti-check fs-6"></i></button>
                                        </div>
                                        @else
                                        <span class="badge bg-light text-muted fw-normal mt-4 no-print-btn"
                                            style="font-size: 10px;" data-html2canvas-ignore="true">PENDING</span>
                                        @endif
                                        @endif
                                    </div>
                                    <div class="mt-2 fw-bold small text-uppercase" style="font-size: 14px;">
                                        {{ $s->user->name ?? '-' }}
                                    </div>
                                    <div class="mt-1 x-small fw-bold">{{ $col['role'] }}</div>
                                    @if ($col['step'] == 8 && $status == 8 && ($isAdmin || $user->hasPermission('ikb.approve.step8')))
                                    <div class="text-danger mt-1" style="font-size: 9px; font-weight: 600;">UPLOAD
                                        PHOTO ATTACHMENT FIRST</div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- Reject/Revision History Table --}}
                    @php
                    $history = $ikb
                    ->signTransactions()
                    ->where('id_doc_type', 4)
                    ->whereIn('status', [11, 12])
                    ->orderBy('created_at', 'desc')
                    ->get();
                    @endphp
                    @if ($history->count() > 0 && ($status == 11 || $status == 12))
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
                                @foreach ($history as $idx => $h)
                                <tr>
                                    <td class="text-center">{{ $idx + 1 }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $h->status == 12 ? 'danger' : 'primary' }}">
                                            {{ $h->status == 12 ? 'REJECTED' : 'REVISION' }}
                                        </span>
                                    </td>
                                    <td>{{ $h->user->name ?? '-' }}</td>
                                    <td>{{ $h->reject_reason ?? '-' }}</td>
                                    <td class="text-center">{{ $h->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    {{-- Approval Notes Table --}}
                    @php
                    $approvalNotes = $ikb
                    ->signTransactions()
                    ->where('id_doc_type', 4)
                    ->whereNotIn('status', [11, 12])
                    ->whereNotNull('director_reason')
                    ->where('director_reason', '!=', '')
                    ->orderBy('created_at', 'asc')
                    ->get();

                    $stepNames = [
                    0 => 'SALES / REQUESTOR',
                    1 => 'SPV/MANAGER',
                    2 => 'DIRECTOR LOG',
                    3 => 'PPIC',
                    4 => 'INVENTORY CONTROL',
                    5 => 'LOGISTIC COORDINATOR',
                    6 => 'WAREHOUSE STAFF',
                    7 => 'WAREHOUSE SUPERVISOR',
                    8 => 'SECURITY OFFICER',
                    9 => 'LOGISTIC COORDINATOR (FINAL)',
                    ];
                    @endphp
                    @if ($approvalNotes->count() > 0 && !in_array($status, [0, 11, 12]))
                    <div class="alert alert-info d-flex align-items-center mb-2 no-print-history" role="alert"
                        style="padding: 5px 15px;">
                        <div style="text-decoration: underline; font-weight:600; font-size: 12px;">APPROVAL NOTES</div>
                    </div>
                    <div class="table-responsive mb-4 no-print-history">
                        <table class="table table-sm table-bordered table-striped" style="font-size: 11px;">
                            <thead class="bg-info text-white">
                                <tr class="text-center">
                                    <th style="width: 50px;">No</th>
                                    <th>Step / Role</th>
                                    <th>By</th>
                                    <th>Note</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approvalNotes as $idx => $n)
                                <tr>
                                    <td class="text-center">{{ $idx + 1 }}</td>
                                    <td class="text-center fw-bold">{{ $stepNames[$n->status] ?? 'Unknown' }}</td>
                                    <td>{{ $n->user->name ?? '-' }}</td>
                                    <td>{{ $n->director_reason ?? '-' }}</td>
                                    <td class="text-center">{{ $n->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Modals --}}
            <livewire:ikb.form-modal />
            <livewire:ikb.form-detail-modal :ikbId="$ikb->id_ikb" />

            {{-- Modal Stuffing Date (Step 6) --}}
            <div class="modal fade" id="modalStuffingDate" tabindex="-1" aria-labelledby="modalStuffingDateLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header py-2">
                            <h6 class="modal-title fw-bold" id="modalStuffingDateLabel">📅 Set Stuffing Date</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label fw-bold small text-uppercase">Stuffing Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" wire:model="stuffingDate" class="form-control">
                            @error('stuffingDate')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer py-2 justify-content-between">
                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success btn-sm" wire:click="setStuffingDate"
                                data-bs-dismiss="modal">
                                <i class="ti ti-check me-1"></i>Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Delivery Date (Step 8) --}}
            <div class="modal fade" id="modalDeliveryDate" tabindex="-1" aria-labelledby="modalDeliveryDateLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-header py-2">
                            <h6 class="modal-title fw-bold" id="modalDeliveryDateLabel">📅 Set Delivery Date</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label fw-bold small text-uppercase">Delivery Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" wire:model="deliveryDate" class="form-control">
                            @error('deliveryDate')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer py-2 justify-content-between">
                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success btn-sm" wire:click="setDeliveryDate"
                                data-bs-dismiss="modal">
                                <i class="ti ti-check me-1"></i>Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Approve/Revision/Reject --}}
            <div class="modal fade" id="modalApprove" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalApproveTitle">Approval Action</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="approvalAction">
                            <input type="hidden" id="approvalStep">

                            <div id="approveBox" class="mb-3 d-none">
                                <label class="form-label fw-bold">Approval Note (Optional)</label>
                                <textarea class="form-control" id="approve_reason" rows="3" placeholder="Enter note here..."></textarea>
                            </div>
                            <div id="revisionBox" class="d-none mb-3">
                                <label class="form-label fw-bold">Revision Reason <span class="text-danger">*</span></label>
                                <textarea class="form-control border-warning" id="revision_reason" rows="3"
                                    placeholder="Explain what needs to be fixed..."></textarea>
                                <div class="text-danger small mt-1 d-none" id="revisionError">Reason is required.</div>
                            </div>
                            <div id="rejectBox" class="d-none mb-3">
                                <label class="form-label fw-bold">Reject Reason <span class="text-danger">*</span></label>
                                <textarea class="form-control border-danger" id="reject_reason" rows="3"
                                    placeholder="Explain why it's rejected..."></textarea>
                                <div class="text-danger small mt-1 d-none" id="rejectError">Reason is required.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="btnConfirmApprove" class="btn btn-success d-none">Confirm
                                Approve</button>
                            <button type="button" id="btnConfirmRevision" class="btn btn-warning d-none">Send for
                                Revision</button>
                            <button type="button" id="btnConfirmReject" class="btn btn-danger d-none">Confirm
                                Reject</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Cancel Action --}}
            <div class="modal fade" id="modalCancelAction" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content text-center">
                        <div class="modal-header justify-content-center">
                            <h5 class="modal-title text-danger">CANCEL ACTION</h5>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0">Are you sure you want to <b>cancel/undo</b> this action?</p>
                        </div>
                        <div class="modal-footer justify-content-center gap-2">
                            <input type="hidden" id="cancelMethod">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="btnConfirmCancelAction">Yes, Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Preview Modal --}}
            <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Preview Dokumen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3 border rounded p-3 bg-light">
                                <div><strong>Note:</strong> <span id="previewNote"></span></div>
                                <div><strong>Attachment:</strong> <span id="previewAttachment"></span></div>
                            </div>
                            <div id="previewBody" style="min-height:60vh;"></div>
                        </div>
                        <div class="modal-footer">
                            <button id="editBtn" class="btn btn-warning"><i class="ti ti-edit"></i> Edit</button>
                            <button id="deleteBtn" class="btn btn-danger"><i class="ti ti-trash"></i> Delete</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Add Attachment Modal --}}
            <div class="modal fade" id="modalAddAttachment" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form id="formAddAttachment" method="POST"
                            action="{{ route('ikb.attachment.store', hashid_encode($ikb->id_ikb, 'ikb')) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Add Attachment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Note / Description</label>
                                    <input type="text" class="form-control" name="note[]">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Document Type</label>
                                    <select class="form-select" name="id_attachment" required>
                                        <option value="">- Select Type -</option>
                                        @foreach (\App\Models\Attachment::orderBy('attachment')->get() as $type)
                                        <option value="{{ $type->id_attachment }}">{{ $type->attachment }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">File (Image/PDF) <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="file[]"
                                        accept="image/*,application/pdf" required>
                                    <small class="text-muted">Max 5MB. Support: JPG, PNG, PDF.</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" id="btnUploadAdd" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Edit Attachment Modal --}}
            <div class="modal fade" id="modalEditAttachment" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form id="formEditAttachment" method="POST" action="" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Attachment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Note / Description</label>
                                    <input type="text" class="form-control" name="note" id="edit_note">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Document Type</label>
                                    <select class="form-select" name="id_attachment" id="edit_attachment" required>
                                        <option value="">- Select Type -</option>
                                        @foreach (\App\Models\Attachment::orderBy('attachment')->get() as $type)
                                        <option value="{{ $type->id_attachment }}">{{ $type->attachment }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Replace File (Optional)</label>
                                    <input type="file" class="form-control" name="filename"
                                        accept="image/*,application/pdf">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" id="btnUploadEdit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @push('scripts')
            <script>
                // Form Validation & Loading States for Attachments
                const addForm = document.getElementById('formAddAttachment');
                const editForm = document.getElementById('formEditAttachment');

                const validateSize = (files) => {
                    const maxSize = 5 * 1024 * 1024; // 5MB
                    for (let i = 0; i < files.length; i++) {
                        if (files[i].size > maxSize) return false;
                    }
                    return true;
                };

                const setBtnLoading = (btn) => {
                    btn.disabled = true;
                    btn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> Please wait...`;
                };

                if (addForm) {
                    addForm.onsubmit = function(e) {
                        const files = addForm.querySelector('input[type="file"]').files;
                        if (!validateSize(files)) {
                            e.preventDefault();
                            window.dispatchEvent(new CustomEvent('alert', {
                                detail: {
                                    type: 'warning',
                                    title: 'File Terlalu Besar',
                                    message: 'Ukuran maksimal file adalah 5MB.'
                                }
                            }));
                            return false;
                        }
                        setBtnLoading(document.getElementById('btnUploadAdd'));
                        return true;
                    };
                }

                if (editForm) {
                    editForm.onsubmit = function(e) {
                        const files = editForm.querySelector('input[type="file"]').files;
                        if (files.length > 0 && !validateSize(files)) {
                            e.preventDefault();
                            window.dispatchEvent(new CustomEvent('alert', {
                                detail: {
                                    type: 'warning',
                                    title: 'File Terlalu Besar',
                                    message: 'Ukuran maksimal file adalah 5MB.'
                                }
                            }));
                            return false;
                        }
                        setBtnLoading(document.getElementById('btnUploadEdit'));
                        return true;
                    };
                }

                window.openPreview = function(url, attachment, note, deleteUrl, updateUrl, catId, canEdit) {
                    document.getElementById('previewNote').textContent = note;
                    document.getElementById('previewAttachment').textContent = attachment;
                    const body = document.getElementById('previewBody');
                    const lower = url.toLowerCase().split('?')[0];
                    if (lower.endsWith('.pdf')) {
                        body.innerHTML = `<iframe src="${url}" style="width:100%;height:70vh;" frameborder="0"></iframe>`;
                    } else {
                        body.innerHTML = `<img src="${url}" style="max-width:100%;max-height:70vh;" class="d-block mx-auto">`;
                    }

                    const editBtn = document.getElementById('editBtn');
                    const deleteBtn = document.getElementById('deleteBtn');
                    if (editBtn) editBtn.style.display = (canEdit === true || canEdit === "true") ? 'inline-block' : 'none';
                    if (deleteBtn) deleteBtn.style.display = (canEdit === true || canEdit === "true") ? 'inline-block' : 'none';

                    document.getElementById('deleteBtn').onclick = function() {
                        showConfirm({
                            title: 'Hapus Attachment',
                            message: 'Apakah Anda yakin ingin menghapus attachment ini?',
                            type: 'danger',
                            onConfirm: () => {
                                window.location.href = deleteUrl;
                            }
                        });
                    };
                    if (document.getElementById('editBtn')) {
                        document.getElementById('editBtn').onclick = function() {
                            document.getElementById('formEditAttachment').action = updateUrl;
                            document.getElementById('edit_note').value = note;
                            document.getElementById('edit_attachment').value = catId;
                            bootstrap.Modal.getInstance(document.getElementById('previewModal'))?.hide();
                            new bootstrap.Modal(document.getElementById('modalEditAttachment')).show();
                        };
                    }
                    new bootstrap.Modal(document.getElementById('previewModal')).show();
                };

                window.previewAttachment = function(el) {
                    const url = el.dataset.url;
                    const type = el.dataset.type;
                    const note = el.dataset.note;
                    const deleteUrl = el.dataset.delete;
                    const updateUrl = el.dataset.update;
                    const catId = el.dataset.catid;
                    const canEdit = el.dataset.canEdit;
                    window.openPreview(url, type, note, deleteUrl, updateUrl, catId, canEdit);
                };

                window.downloadPDF = function() {
                    const element = document.querySelector('.card');
                    const noPrint = document.querySelectorAll('.no-print-btn, [data-html2canvas-ignore="true"]');
                    const btnDownload = document.getElementById('btnDownloadPDF');
                    const btnNormal = document.getElementById('btnDownloadNormal');
                    const btnLoading = document.getElementById('btnDownloadLoading');

                    // Show loading state
                    btnDownload.disabled = true;
                    btnNormal.classList.add('d-none');
                    btnLoading.classList.remove('d-none');

                    // Hard hide before capture
                    noPrint.forEach(b => b.style.setProperty('display', 'none', 'important'));

                    const options = {
                        margin: 0,
                        filename: 'IKB-{{ $ikb->ikb_number ?? '
                        DRAFT ' }}.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 0.85
                        },
                        html2canvas: {
                            scale: 1.5,
                            useCORS: true,
                            logging: false,
                            letterRendering: true
                        },
                        jsPDF: {
                            unit: 'mm',
                            format: 'a4',
                            orientation: 'portrait'
                        }
                    };

                    const {
                        jsPDF
                    } = window.jspdf;

                    html2canvas(element, options.html2canvas).then(canvas => {
                        const imgData = canvas.toDataURL('image/jpeg', options.image.quality);
                        const pdf = new jsPDF(options.jsPDF);
                        const imgProps = pdf.getImageProperties(imgData);
                        const pdfWidth = pdf.internal.pageSize.getWidth();
                        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                        pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
                        pdf.save(options.filename);

                        // Reset button
                        btnDownload.disabled = false;
                        btnNormal.classList.remove('d-none');
                        btnLoading.classList.add('d-none');

                        // Show back
                        noPrint.forEach(b => b.style.display = '');
                    }).catch(err => {
                        console.error('PDF Generation Error:', err);
                        // Reset button
                        btnDownload.disabled = false;
                        btnNormal.classList.remove('d-none');
                        btnLoading.classList.add('d-none');
                        noPrint.forEach(b => b.style.display = '');
                        alert('Gagal menghasilkan PDF. Silakan coba lagi.');
                    });
                };

                window.printIKB = function() {
                    const element = document.querySelector('.card');
                    const noPrint = document.querySelectorAll('.no-print-btn, [data-html2canvas-ignore="true"]');

                    // Hard hide before capture
                    noPrint.forEach(b => b.style.setProperty('display', 'none', 'important'));

                    const {
                        jsPDF
                    } = window.jspdf;

                    html2canvas(element, {
                        scale: 1.5,
                        useCORS: true,
                        logging: false,
                        letterRendering: true
                    }).then(canvas => {
                        const imgData = canvas.toDataURL('image/jpeg', 0.85);
                        const pdf = new jsPDF({
                            unit: 'mm',
                            format: 'a4',
                            orientation: 'portrait'
                        });
                        const imgProps = pdf.getImageProperties(imgData);
                        const pdfWidth = pdf.internal.pageSize.getWidth();
                        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                        pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
                        const pdfBlob = pdf.output('blob');
                        const pdfUrl = URL.createObjectURL(pdfBlob);

                        // Open in hidden iframe and print silently
                        const iframe = document.createElement('iframe');
                        iframe.style.display = 'none';
                        iframe.src = pdfUrl;
                        document.body.appendChild(iframe);
                        iframe.onload = function() {
                            iframe.contentWindow.focus();
                            iframe.contentWindow.print();
                            setTimeout(() => {
                                document.body.removeChild(iframe);
                                URL.revokeObjectURL(pdfUrl);
                            }, 3000);
                        };

                        // Show back
                        noPrint.forEach(b => b.style.display = '');
                    }).catch(err => {
                        console.error('Print Generation Error:', err);
                        noPrint.forEach(b => b.style.display = '');
                        alert('Gagal generate print. Silakan coba lagi.');
                    });
                };

                // ── Stuffing Date Modal pre-fill ──────────────────────────────
                document.getElementById('modalStuffingDate').addEventListener('show.bs.modal', function(e) {
                    const btn = e.relatedTarget;
                    const dateVal = btn ? btn.dataset.date : '';
                    const input = this.querySelector('input[type="date"]');
                    if (input) {
                        input.value = dateVal || '';
                        // Sync value to Livewire property without triggering re-render
                        if (dateVal) {
                            @this.set('stuffingDate', dateVal, false);
                        } else {
                            input.dispatchEvent(new Event('input', {
                                bubbles: true
                            }));
                        }
                    }
                });

                // ── Delivery Date Modal pre-fill ──────────────────────────────
                document.getElementById('modalDeliveryDate').addEventListener('show.bs.modal', function(e) {
                    const btn = e.relatedTarget;
                    const dateVal = btn ? btn.dataset.date : '';
                    const input = this.querySelector('input[type="date"]');
                    if (input) {
                        input.value = dateVal || '';
                        if (dateVal) {
                            @this.set('deliveryDate', dateVal, false);
                        } else {
                            input.dispatchEvent(new Event('input', {
                                bubbles: true
                            }));
                        }
                    }
                });

                // Approval Modal Logic
                const modalApprove = new bootstrap.Modal(document.getElementById('modalApprove'));

                window.openApprovalModal = function(action, step) {
                    document.getElementById('approvalAction').value = action;
                    document.getElementById('approvalStep').value = step;

                    // Clear previous values to show placeholders
                    document.getElementById('approve_reason').value = '';
                    document.getElementById('revision_reason').value = '';
                    document.getElementById('reject_reason').value = '';

                    // Reset visibility
                    ['approveBox', 'revisionBox', 'rejectBox', 'btnConfirmApprove', 'btnConfirmRevision', 'btnConfirmReject']
                    .forEach(id => {
                        document.getElementById(id).classList.add('d-none');
                    });
                    ['revisionError', 'rejectError'].forEach(id => document.getElementById(id).classList.add('d-none'));

                    if (action === 'approve') {
                        document.getElementById('modalApproveTitle').innerText = (step == 0) ? 'Submit IKB' : 'Approve IKB';
                        document.getElementById('approveBox').classList.remove('d-none');
                        document.getElementById('btnConfirmApprove').classList.remove('d-none');
                    } else if (action === 'revision') {
                        document.getElementById('modalApproveTitle').innerText = 'Request Revision';
                        document.getElementById('revisionBox').classList.remove('d-none');
                        document.getElementById('btnConfirmRevision').classList.remove('d-none');
                    } else if (action === 'reject') {
                        document.getElementById('modalApproveTitle').innerText = 'Reject IKB';
                        document.getElementById('rejectBox').classList.remove('d-none');
                        document.getElementById('btnConfirmReject').classList.remove('d-none');
                    }

                    modalApprove.show();
                };

                document.getElementById('btnConfirmApprove').onclick = function() {
                    const step = document.getElementById('approvalStep').value;
                    const note = document.getElementById('approve_reason').value;
                    @this.dispatch('processSign', {
                        action: 'approve',
                        step: step,
                        note: note
                    });
                    modalApprove.hide();
                };

                document.getElementById('btnConfirmRevision').onclick = function() {
                    const step = document.getElementById('approvalStep').value;
                    const note = document.getElementById('revision_reason').value;
                    if (!note) {
                        document.getElementById('revisionError').classList.remove('d-none');
                        return;
                    }
                    @this.dispatch('processSign', {
                        action: 'revision',
                        step: step,
                        note: note
                    });
                    modalApprove.hide();
                };

                document.getElementById('btnConfirmReject').onclick = function() {
                    const step = document.getElementById('approvalStep').value;
                    const note = document.getElementById('reject_reason').value;
                    if (!note) {
                        document.getElementById('rejectError').classList.remove('d-none');
                        return;
                    }
                    @this.dispatch('processSign', {
                        action: 'reject',
                        step: step,
                        note: note
                    });
                    modalApprove.hide();
                };

                // Cancel Action Logic
                const modalCancel = new bootstrap.Modal(document.getElementById('modalCancelAction'));
                window.showCancelModal = function(method) {
                    document.getElementById('cancelMethod').value = method;
                    modalCancel.show();
                };

                document.getElementById('btnConfirmCancelAction').onclick = function() {
                    const method = document.getElementById('cancelMethod').value;
                    if (method === 'cancelSubmit') {
                        @this.cancelSubmit();
                    } else {
                        @this.cancelApproval();
                    }
                    modalCancel.hide();
                };
            </script>
            @endpush

            <style>
                .x-small {
                    font-size: 0.8rem;
                }

                .btn-xs {
                    padding: 0.125rem 0.25rem;
                    font-size: 0.8rem;
                }

                .image-container:hover .no-print-btn {
                    opacity: 1;
                }

                .image-container .no-print-btn {
                    opacity: 0.8;
                    transition: opacity 0.2s;
                    z-index: 20;
                }

                .btn-icon {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 24px;
                    height: 24px;
                    padding: 0;
                    border-radius: 4px;
                }

                .btn-icon i {
                    font-size: 14px;
                }

                @media print {
                    @page {
                        size: A4;
                        margin: 5mm 10mm;
                    }

                    /* Hide EVERYTHING except our content */
                    html,
                    body,
                    .body-wrapper,
                    .page-wrapper,
                    .container-fluid {
                        height: auto !important;
                        min-height: auto !important;
                        background: white !important;
                        margin: 0 !important;
                        padding: 0 !important;
                        overflow: visible !important;
                    }

                    header,
                    footer,
                    nav,
                    aside,
                    .navbar,
                    .breadcrumb,
                    .page-header,
                    .sidebar,
                    .no-print-btn,
                    .no-print-history,
                    [data-html2canvas-ignore="true"],
                    .btn {
                        display: none !important;
                    }

                    /* Radical isolation from layout wrappers */
                    #main-wrapper,
                    .body-wrapper {
                        display: block !important;
                        padding: 0 !important;
                        margin: 0 !important;
                    }

                    .ikb-detail,
                    .ikb-detail .card {
                        display: block !important;
                        border: none !important;
                        box-shadow: none !important;
                        padding: 0 !important;
                        margin: 0 !important;
                        width: 100% !important;
                    }

                    /* Force black text and high contrast */
                    * {
                        -webkit-print-color-adjust: exact !important;
                        print-color-adjust: exact !important;
                        color: black !important;
                    }

                    /* Compact layout for print */
                    h4,
                    h5,
                    h6 {
                        margin: 5px 0 !important;
                    }

                    hr {
                        margin: 10px 0 !important;
                        border-top: 1px solid #000 !important;
                        opacity: 1 !important;
                    }

                    .mb-4 {
                        margin-bottom: 10px !important;
                    }

                    .mt-4 {
                        margin-top: 10px !important;
                    }

                    .mt-5 {
                        margin-top: 15px !important;
                    }

                    .pt-4 {
                        padding-top: 5px !important;
                    }

                    .pb-3 {
                        padding-bottom: 5px !important;
                    }

                    .alert {
                        padding: 5px 10px !important;
                        margin-bottom: 10px !important;
                        border: 1px solid #000 !important;
                        background: transparent !important;
                    }

                    /* Grid refinement */
                    .row {
                        margin: 0 !important;
                        display: flex !important;
                        flex-wrap: nowrap !important;
                    }

                    .col,
                    .col-md-6,
                    .col-md-2 {
                        padding: 0 5px !important;
                        flex: 1 !important;
                    }

                    .col-7 {
                        flex: 0 0 58.33% !important;
                        max-width: 58.33% !important;
                    }

                    .col-4 {
                        flex: 0 0 33.33% !important;
                        max-width: 33.33% !important;
                    }

                    .col-1 {
                        flex: 0 0 8.33% !important;
                        max-width: 8.33% !important;
                    }

                    body {
                        font-size: 13px !important;
                    }

                    .table-responsive {
                        overflow: visible !important;
                        width: 100% !important;
                    }

                    table {
                        width: 100% !important;
                        border-collapse: collapse !important;
                        border: 1px solid #000 !important;
                    }

                    th,
                    td {
                        border: 1px solid #000 !important;
                        padding: 2px 4px !important;
                        font-size: 12px !important;
                    }

                    .badge {
                        border: 1px solid #000 !important;
                        display: inline-block !important;
                        padding: 1px 3px !important;
                        background: transparent !important;
                    }

                    /* Signature boxes adjustment */
                    .border-bottom {
                        border-bottom: 1px solid #000 !important;
                    }

                    .image-container {
                        height: 75px !important;
                        width: 90px !important;
                    }

                    .image-container img {
                        height: 60px !important;
                        width: 60px !important;
                    }

                    .x-small {
                        font-size: 11px !important;
                    }

                    .small {
                        font-size: 12px !important;
                    }
                }
            </style>
</div>