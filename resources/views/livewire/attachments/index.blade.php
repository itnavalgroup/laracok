<div class="attachment-management">
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">JENIS LAMPIRAN</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary h-100">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Attachment Categories</h6>
                            <h2 class="mb-0 fw-bold text-white">{{ $totalAttachments }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">Attachment Management</h4>
                                <p class="text-muted small mb-0">Manage attachment types and categories for documents</p>
                            </div>
                            <div class="d-flex gap-2">
                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('attachment.download'))
                                <button wire:click="export" class="btn btn-outline-success rounded-pill px-3 d-flex align-items-center gap-2">
                                    <i class="ti ti-download fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Export</span>
                                </button>
                                @endif

                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('attachment.upload'))
                                <button type="button" data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-outline-primary rounded-pill px-3 d-flex align-items-center gap-2">
                                    <i class="ti ti-upload fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Import</span>
                                </button>
                                @endif
                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('attachment.create'))
                                <button wire:click="create" class="btn btn-primary rounded-pill px-4 d-flex align-items-center gap-2">
                                    <i class="ti ti-plus fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Add Attachment</span>
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
                                placeholder="Search by name...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select wire:model.live="departmentFilter" class="form-select">
                            <option value="">-- ALL DEPARTMENTS --</option>
                            <option value="0">Global (All Dept)</option>
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
                            <th style="width: 50px;" class="text-center">#</th>
                            <th>ATTACHMENT NAME</th>
                            <th>DEPARTMENT</th>
                            <th>CREATED BY</th>
                            <th style="width: 120px;" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attachments as $att)
                        <tr wire:key="att-{{ $att->id_attachment }}">
                            <td class="text-center text-muted small">{{ ($attachments->currentPage()-1) * $attachments->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold modern-text-title text-uppercase">{{ $att->attachment }}</div>
                            </td>
                            <td>
                                @if($att->id_departement == 0)
                                <span class="badge bg-light-primary text-primary text-uppercase">GLOBAL</span>
                                @else
                                <span class="badge bg-light-info text-info text-uppercase">{{ $att->departement->departement ?? 'N/A' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="small">{{ $att->creator->fullname ?? 'System' }}</div>
                                <div class="text-muted extra-small">{{ $att->created_at->format('d M Y H:i') }}</div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('attachment.edit'))
                                    <button wire:click="edit({{ $att->id_attachment }})" class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                        <i class="ti ti-edit fs-5"></i>
                                    </button>
                                    @endif

                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('attachment.delete'))
                                    <button type="button"
                                        onclick="showConfirm({
                                                title: 'Hapus Jenis Lampiran',
                                                message: 'Apakah Anda yakin ingin menghapus data lampiran {{ $att->attachment }}? Tindakan ini tidak dapat dibatalkan.',
                                                type: 'danger',
                                                onConfirm: () => @this.delete({{ $att->id_attachment }})
                                            })"
                                        class="btn btn-icon bg-light-danger rounded-circle" title="Delete">
                                        <i class="ti ti-trash fs-5"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-4">
                                    <i class="ti ti-file-off fs-1 modern-text-muted opacity-50"></i>
                                    <h5 class="mt-3 modern-text-muted text-uppercase">No attachments found</h5>
                                    <p class="modern-text-muted small">Try adjusting your filters or keywords</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $attachments->links() }}
            </div>
        </div>
    </div>

    <!-- Attachment Modal -->
    <div wire:ignore.self class="modal fade" id="attachmentModal" tabindex="-1" aria-labelledby="attachmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase" id="attachmentModalLabel">
                        <i class="ti ti-{{ $isEditing ? 'edit' : 'plus' }} me-2"></i>
                        {{ $isEditing ? 'Edit Lampiran' : 'Tambah Lampiran' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <!-- Attachment Name -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">ATTACHMENT NAME <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('attachment') is-invalid @enderror"
                                    wire:model="attachment" placeholder="e.g. KTP, NPWP, SIUP, etc.">
                                @error('attachment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Department -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">DEPARTMENT <span class="text-danger">*</span></label>
                                <select class="form-select @error('id_departement') is-invalid @enderror" wire:model="id_departement" {{ auth()->user()->level !== 1 ? 'disabled' : '' }}>
                                    <option value="0">GLOBAL (ALL DEPARTMENTS)</option>
                                    @foreach($departments as $dept)
                                    <option value="{{ $dept->id_departement }}">{{ $dept->departement }}</option>
                                    @endforeach
                                </select>
                                @error('id_departement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" wire:loading.attr="disabled">
                            <i class="ti ti-device-floppy me-2"></i> {{ $isEditing ? 'Update Data' : 'Simpan Lampiran' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div wire:ignore.self class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-info text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase" id="importModalLabel">
                        <i class="ti ti-upload me-2"></i> Import dari Excel
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="import">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="alert alert-light-info border-info-subtle small mb-3">
                                    <i class="ti ti-info-circle me-1"></i> Gunakan template yang disediakan untuk menghindari kesalahan format.
                                </div>
                                <div class="mb-3">
                                    <button type="button" wire:click="downloadTemplate" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                        <i class="ti ti-download me-1"></i> Download Template
                                    </button>
                                </div>
                                <label class="form-label fw-bold small text-uppercase text-info">Pilih File Excel</label>
                                <input type="file" wire:model="file_excel" class="form-control @error('file_excel') is-invalid @enderror">
                                @error('file_excel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div wire:loading wire:target="file_excel" class="text-info mt-1 small">
                                    <i class="ti ti-loader animate-spin me-1"></i> Mengunggah file...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 text-uppercase">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-info text-white rounded-pill px-4" wire:loading.attr="disabled">
                            <i class="ti ti-cloud-upload me-2"></i> Proses Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        window.addEventListener('openAttachmentModal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('attachmentModal'));
            myModal.show();
        });

        window.addEventListener('closeAttachmentModal', () => {
            var modalEl = document.getElementById('attachmentModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        });

        window.addEventListener('closeImportModal', () => {
            var modalEl = document.getElementById('importModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        });
    </script>
    @endpush

    <style>
        .attachment-management .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .attachment-management .filter-section {
            background-color: #1a2531;
        }

        .summary-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .summary-card:hover {
            transform: translateY(-2px);
        }
    </style>
</div>