<div class="vendor-management" wire:poll.5s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">VENDOR</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards & Header -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-2">
                    <div class="card summary-card bg-primary h-100 shadow-sm border-0">
                        <div class="card-body py-3">
                            <h6 class="text-white-50 mb-1 small text-uppercase">Total Vendors</h6>
                            <h3 class="mb-0 fw-bold text-white">{{ $totalVendors }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card summary-card bg-success h-100 shadow-sm border-0">
                        <div class="card-body py-3">
                            <h6 class="text-white-50 mb-1 small text-uppercase">My Vendors</h6>
                            <h3 class="mb-0 fw-bold text-white">{{ $myVendors }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">Vendor Management</h4>
                                <p class="text-muted small mb-0">Manage partners, contact details, and banking information</p>
                            </div>
                            <div class="d-flex gap-2">
                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('vendor.download'))
                                <button wire:click="export" class="btn btn-outline-success rounded-pill px-3 py-2 d-flex align-items-center gap-2 shadow-sm" title="Export to Excel">
                                    <i class="ti ti-download fs-4"></i>
                                    <span class="fw-semibold text-uppercase small d-none d-lg-inline">Export</span>
                                </button>
                                @endif
                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('vendor.upload'))
                                <button data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-outline-primary rounded-pill px-3 py-2 d-flex align-items-center gap-2 shadow-sm" title="Import from Excel">
                                    <i class="ti ti-upload fs-4"></i>
                                    <span class="fw-semibold text-uppercase small d-none d-lg-inline">Import</span>
                                </button>
                                @endif
                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('vendor.create'))
                                <button wire:click="create" class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center gap-2 shadow">
                                    <i class="ti ti-plus fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Add Vendor</span>
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="col-12 mb-4">
            <div class="filter-section shadow-sm border-0">
                <div class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted">
                                <i class="ti ti-search fs-5"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 ps-0"
                                placeholder="Search by vendor name or ID...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" wire:model.live="departmentFilter">
                            <option value="">All Departments</option>
                            @foreach($departments as $dept)
                            <option value="{{ $dept->id_departement }}">{{ $dept->departement }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-2 justify-content-end">
                            <span class="text-muted small text-nowrap">Show:</span>
                            <select wire:model.live="perPage" class="form-select form-select-sm w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="col-12">
            <div class="table-responsive shadow-sm rounded-3">
                <table class="modern-table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 80px;" class="text-center">ID</th>
                            <th>VENDOR NAME</th>
                            <th>DEPARTMENT</th>
                            <th class="d-none d-md-table-cell">CREATOR</th>
                            <th class="text-center">STATUS</th>
                            <th style="width: 150px;" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $v)
                        <tr wire:key="vendor-{{ $v->id_vendor }}">
                            <td class="text-center">
                                <span class="badge bg-light-secondary text-secondary rounded-pill fw-bold">#{{ $v->id_vendor }}</span>
                            </td>
                            <td>
                                <div class="fw-bold modern-text-title text-uppercase">{{ $v->vendor }}</div>
                                <div class="text-muted x-small">Created: {{ $v->created_at->format('d/m/Y') }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light-info text-info text-uppercase fw-normal">
                                    {{ $v->departement->departement ?? 'Global' }}
                                </span>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-light-primary text-primary d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 11px; font-weight: 700;">
                                        {{ strtoupper(substr($v->creator->name ?? '?', 0, 1)) }}
                                    </div>
                                    <span class="small text-muted text-uppercase">{{ $v->creator->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($v->deleted_at)
                                <span class="badge bg-light-danger text-danger text-uppercase px-3">Deleted</span>
                                @elseif($v->is_active)
                                <span class="badge bg-light-success text-success text-uppercase px-3">Active</span>
                                @else
                                <span class="badge bg-light-warning text-warning text-uppercase px-3">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button wire:click="show({{ $v->id_vendor }})" class="btn btn-icon bg-light-info rounded-circle" title="Detail">
                                        <i class="ti ti-eye fs-5 text-info"></i>
                                    </button>
                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('vendor.edit'))
                                    <button wire:click="edit({{ $v->id_vendor }})" class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                        <i class="ti ti-edit fs-5 text-warning"></i>
                                    </button>
                                    @endif
                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('vendor.delete'))
                                    <button type="button"
                                        onclick="showConfirm({
                                                title: 'Hapus Vendor',
                                                message: 'Apakah Anda yakin ingin menghapus vendor {{ $v->vendor }}?',
                                                type: 'danger',
                                                onConfirm: () => @this.delete({{ $v->id_vendor }})
                                            })"
                                        class="btn btn-icon bg-light-danger rounded-circle" title="Delete">
                                        <i class="ti ti-trash fs-5 text-danger"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <i class="ti ti-building-off fs-1 modern-text-muted opacity-50"></i>
                                    <h5 class="mt-3 modern-text-muted text-uppercase">No vendors found</h5>
                                    <p class="modern-text-muted small">Try adjusting your search or filters</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $vendors->links() }}
            </div>
        </div>
    </div>

    <!-- Vendor Modal (Create / Edit / Show) -->
    <div wire:ignore.self class="modal fade" id="vendorModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase">
                        <i class="ti ti-{{ $isShowOnly ? 'info-circle' : ($isEditing ? 'edit' : 'plus') }} me-2"></i>
                        @if($isShowOnly) Vendor Details @elseif($isEditing) Edit Vendor @else Add New Vendor @endif
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" wire:click="resetFields"></button>
                </div>
                <div class="modal-body p-4">
                    <form @if(!$isShowOnly) wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" @endif>

                        {{-- Data Utama --}}
                        <div class="mb-4">
                            <h6 class="text-primary fw-bold text-uppercase mb-3 d-flex align-items-center gap-2">
                                <i class="ti ti-building fs-5"></i> Basic Information
                            </h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-uppercase">Vendor Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('vendor') is-invalid @enderror" wire:model="vendor" placeholder="Enter Full Vendor Name" @if($isShowOnly) disabled @endif>
                                    @error('vendor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-uppercase">NPWP</label>
                                    <input type="text" class="form-control @error('npwp') is-invalid @enderror" wire:model="npwp" placeholder="00.000.000.0-000.000" @if($isShowOnly || ($isEditing && !$canEditMainData)) disabled @endif>
                                    @error('npwp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    @if($isEditing && !$canEditMainData) <div class="x-small text-muted mt-1">Locked (Only Admin/Creator can edit this)</div> @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-uppercase">NIK</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" wire:model="nik" placeholder="16-digit Personal ID Number" @if($isShowOnly || ($isEditing && !$canEditMainData)) disabled @endif>
                                    @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold text-uppercase">Status</label>
                                    <div class="form-check form-switch mt-1">
                                        <input class="form-check-input p-2" type="checkbox" role="switch" wire:model.live="is_active" id="isActiveSwitch"
                                            @if($isShowOnly || (auth()->user()->level !== 1 && !auth()->user()->hasPermission('vendor.activate'))) disabled @endif>
                                        <label class="form-check-label ms-2 fw-bold" for="isActiveSwitch">
                                            @if($is_active)
                                            <span class="text-success">Active</span>
                                            @else
                                            <span class="text-danger">Inactive</span>
                                            @endif
                                        </label>
                                    </div>
                                    <div class="x-small text-muted mt-1">Inactive vendors cannot be used in new transactions.</div>
                                </div>
                            </div>
                        </div>

                        <div class="hr-border opacity-25 my-4"></div>

                        {{-- Dynamic Emails --}}
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-primary fw-bold text-uppercase mb-0 d-flex align-items-center gap-2">
                                    <i class="ti ti-mail fs-5"></i> Contact Emails
                                </h6>
                                @if(!$isShowOnly)
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" wire:click="addEmail">
                                    <i class="ti ti-plus me-1"></i> Add Email
                                </button>
                                @endif
                            </div>
                            <div class="row g-2">
                                @forelse($emails as $index => $email)
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-transparent text-muted"><i class="ti ti-mail"></i></span>
                                        <input type="email" class="form-control @error('emails.'.$index.'.email') is-invalid @enderror"
                                            wire:model="emails.{{ $index }}.email" placeholder="example@vendor.com"
                                            @if($isShowOnly || (isset($email['is_used']) && $email['is_used'])) disabled @endif>
                                        @if(!$isShowOnly && count($emails) > 1 && !(isset($email['is_used']) && $email['is_used']))
                                        <button class="btn btn-outline-danger" type="button" wire:click="removeEmail({{ $index }})">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                        @elseif(isset($email['is_used']) && $email['is_used'])
                                        <span class="input-group-text bg-light text-muted" title="Used in transactions"><i class="ti ti-lock"></i></span>
                                        @endif
                                    </div>
                                    @error('emails.'.$index.'.email') <div class="x-small text-danger mt-1">{{ $message }}</div> @enderror
                                </div>
                                @empty
                                <div class="col-12 py-3 text-center bg-light rounded-3">
                                    <span class="text-muted small">No contact emails provided</span>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="hr-border opacity-25 my-4"></div>

                        {{-- Dynamic Bank accounts --}}
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="text-primary fw-bold text-uppercase mb-0 d-flex align-items-center gap-2">
                                    <i class="ti ti-credit-card fs-5"></i> Bank Accounts
                                </h6>
                                @if(!$isShowOnly)
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" wire:click="addBankAccount">
                                    <i class="ti ti-plus me-1"></i> Add Account
                                </button>
                                @endif
                            </div>

                            @forelse($bankAccounts as $index => $acc)
                            <div class="card bg-light bg-opacity-50 border-0 mb-3 rounded-3 shadow-none">
                                <div class="card-body p-3">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label x-small fw-bold text-uppercase mb-1">Bank Name</label>
                                            <input type="text" class="form-control form-control-sm border-0 shadow-sm" wire:model="bankAccounts.{{ $index }}.nama_bank" placeholder="e.g. BCA, MANDIRI" @if($isShowOnly || (isset($acc['is_used']) && $acc['is_used'])) disabled @endif>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label x-small fw-bold text-uppercase mb-1">Holder Name</label>
                                            <input type="text" class="form-control form-control-sm border-0 shadow-sm" wire:model="bankAccounts.{{ $index }}.nama_penerima" placeholder="BENEFICIARY NAME" @if($isShowOnly || (isset($acc['is_used']) && $acc['is_used'])) disabled @endif>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label x-small fw-bold text-uppercase mb-1">Account No. @if(isset($acc['is_used']) && $acc['is_used']) <i class="ti ti-lock text-muted fs-7"></i> @endif</label>
                                            <div class="input-group input-group-sm shadow-sm">
                                                <input type="text" class="form-control border-0" wire:model="bankAccounts.{{ $index }}.norek" placeholder="Numbers Only"
                                                    @if($isShowOnly || (isset($acc['is_used']) && $acc['is_used'])) disabled @endif>
                                                @if(!$isShowOnly && count($bankAccounts) > 1 && !(isset($acc['is_used']) && $acc['is_used']))
                                                <button class="btn btn-outline-danger border-0" type="button" wire:click="removeBankAccount({{ $index }})">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="py-3 text-center bg-light rounded-3">
                                <span class="text-muted small">No bank account details provided</span>
                            </div>
                            @endforelse
                        </div>

                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal" wire:click="resetFields">
                        {{ $isShowOnly ? 'Close' : 'Cancel' }}
                    </button>
                    @if(!$isShowOnly)
                    <button type="button" class="btn btn-primary rounded-pill px-4 shadow" wire:click="{{ $isEditing ? 'update' : 'store' }}" wire:loading.attr="disabled">
                        <span wire:loading.remove><i class="ti ti-device-floppy me-2"></i> {{ $isEditing ? 'Update Data' : 'Save Vendor' }}</span>
                        <span wire:loading class="spinner-border spinner-border-sm"></span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div wire:ignore.self class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase">Import Vendor Data</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-info border-0 rounded-3 mb-4">
                        <div class="d-flex gap-3">
                            <i class="ti ti-info-square fs-3"></i>
                            <div>
                                <h6 class="alert-heading fw-bold small text-uppercase mb-1">Pre-Import Instructions</h6>
                                <p class="small mb-3 text-muted">Please download and use our official spreadsheet template to ensure data compatibility.</p>
                                <button class="btn btn-sm btn-info text-white rounded-pill px-3 shadow-sm" wire:click="downloadTemplate">
                                    <i class="ti ti-download me-1"></i> Download Template
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-uppercase mb-2">Select Spreadsheet (.xls, .xlsx)</label>
                        <input type="file" class="form-control @error('file_excel') is-invalid @enderror shadow-sm" wire:model="file_excel">
                        <div wire:loading wire:target="file_excel" class="x-small text-primary mt-2">
                            <span class="spinner-border spinner-border-sm me-1"></span> Processing file...
                        </div>
                        @error('file_excel') <div class="invalid-feedback d-block mt-2">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-dark rounded-pill px-4 shadow" wire:click="import" wire:loading.attr="disabled" @if(!$file_excel) disabled @endif>
                        <span wire:loading.remove><i class="ti ti-upload me-2"></i> Upload & Import</span>
                        <span wire:loading class="spinner-border spinner-border-sm"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        window.addEventListener('showModal', event => {
            let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(event.detail.id));
            modal.show();
        });

        window.addEventListener('hideModal', event => {
            let modal = bootstrap.Modal.getInstance(document.getElementById(event.detail.id));
            if (modal) modal.hide();
        });
    </script>
    @endpush

    <style>
        .vendor-management .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .vendor-management .filter-section {
            background-color: #1a2531;
        }

        .summary-card {
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .summary-card:hover {
            transform: translateY(-2px);
        }

        .x-small {
            font-size: 0.7rem;
        }

        .hr-border {
            border-top: 1px solid #e2e8f0;
        }

        [data-pc-theme="dark"] .hr-border {
            border-top-color: #334155;
        }

        .bg-light-info {
            background-color: rgba(var(--bs-info-rgb), 0.1) !important;
        }

        .bg-light-warning {
            background-color: rgba(var(--bs-warning-rgb), 0.1) !important;
        }

        .bg-light-danger {
            background-color: rgba(var(--bs-danger-rgb), 0.1) !important;
        }

        .bg-light-primary {
            background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
        }

        .bg-light-secondary {
            background-color: rgba(var(--bs-secondary-rgb), 0.1) !important;
        }

        [data-pc-theme="dark"] .modal-body .bg-light {
            background-color: #1e293b !important;
        }
    </style>
</div>