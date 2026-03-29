<div class="tax-management" wire:poll.5s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">TARIF PAJAK</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary h-100">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Tax Tariffs</h6>
                            <h2 class="mb-0 fw-bold text-white">{{ $totalTaxes }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">Tax Management</h4>
                                <p class="text-muted small mb-0">Manage specific tax percentages and tariffs</p>
                            </div>
                            @if(auth()->user()->level === 1 || auth()->user()->hasPermission('tax.create'))
                            <button wire:click="create" class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center gap-2">
                                <i class="ti ti-plus fs-4"></i>
                                <span class="fw-semibold text-uppercase">Add Tax Tariff</span>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="col-12 mb-4">
            <div class="filter-section shadow-sm border-0">
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted">
                                <i class="ti ti-search fs-5"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 ps-0"
                                placeholder="Search by name, type, or description...">
                        </div>
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
                            <th>TAX NAME</th>
                            <th>TAX TYPE</th>
                            <th class="text-center">PERCENTAGE</th>
                            <th class="text-center">STATUS</th>
                            <th style="width: 120px;" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($taxes as $tax_item)
                        <tr wire:key="tax-{{ $tax_item->id_tax }}">
                            <td class="text-center text-muted small">{{ ($taxes->currentPage()-1) * $taxes->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold modern-text-title text-uppercase">{{ $tax_item->tax }}</div>
                                <div class="extra-small text-muted">{{ $tax_item->tax_description }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light-info text-info text-uppercase">{{ $tax_item->taxType->tax_type ?? 'N/A' }}</span>
                            </td>
                            <td class="text-center">
                                <div class="fw-bold">{{ number_format($tax_item->tax_persen * 100, 2) }}%</div>
                            </td>
                            <td class="text-center">
                                @if($tax_item->status == 1)
                                <span class="badge bg-light-success text-success">ACTIVE</span>
                                @else
                                <span class="badge bg-light-danger text-danger">INACTIVE</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('tax.edit'))
                                    <button wire:click="edit({{ $tax_item->id_tax }})" class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                        <i class="ti ti-edit fs-5"></i>
                                    </button>
                                    @endif

                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('tax.delete'))
                                    <button type="button"
                                        onclick="showConfirm({
                                                title: 'Hapus Tarif Pajak',
                                                message: 'Apakah Anda yakin ingin menghapus data tarif {{ $tax_item->tax }}? Tindakan ini tidak dapat dibatalkan.',
                                                type: 'danger',
                                                onConfirm: () => @this.delete({{ $tax_item->id_tax }})
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
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <i class="ti ti-file-off fs-1 modern-text-muted opacity-50"></i>
                                    <h5 class="mt-3 modern-text-muted text-uppercase">No tax tariffs found</h5>
                                    <p class="modern-text-muted small">Try adjusting your search keywords</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $taxes->links() }}
            </div>
        </div>
    </div>

    <!-- Tax Modal -->
    <div wire:ignore.self class="modal fade" id="taxModal" tabindex="-1" aria-labelledby="taxModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase" id="taxModalLabel">
                        <i class="ti ti-{{ $isEditing ? 'edit' : 'plus' }} me-2"></i>
                        {{ $isEditing ? 'Edit Tarif Pajak' : 'Tambah Tarif Pajak' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <!-- Tax Type -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">TAX TYPE <span class="text-danger">*</span></label>
                                <select class="form-select @error('id_tax_type') is-invalid @enderror" wire:model="id_tax_type">
                                    <option value="">-- PILIH JENIS PAJAK --</option>
                                    @foreach($taxTypes as $tType)
                                    <option value="{{ $tType->id_tax_type }}">{{ $tType->tax_type }}</option>
                                    @endforeach
                                </select>
                                @error('id_tax_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <!-- Tax Name -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">TAX NAME <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('tax') is-invalid @enderror"
                                    wire:model="tax" placeholder="e.g. PPN 11%, PPh 21, etc.">
                                @error('tax') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <!-- Percentage -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">PERCENTAGE (%) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control @error('tax_persen') is-invalid @enderror"
                                        wire:model="tax_persen" placeholder="e.g. 11">
                                    <span class="input-group-text border-start-0">%</span>
                                    @error('tax_persen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">DESCRIPTION <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('tax_description') is-invalid @enderror"
                                    wire:model="tax_description" rows="3" placeholder="Tax description..."></textarea>
                                @error('tax_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <!-- Status -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">STATUS <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" wire:model="status">
                                    <option value="1">ACTIVE</option>
                                    <option value="0">INACTIVE</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" wire:loading.attr="disabled">
                            <i class="ti ti-device-floppy me-2"></i> {{ $isEditing ? 'Update Data' : 'Simpan Tarif' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        window.addEventListener('openTaxModal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('taxModal'));
            myModal.show();
        });

        window.addEventListener('closeTaxModal', () => {
            var modalEl = document.getElementById('taxModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        });
    </script>
    @endpush

    <style>
        .tax-management .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .tax-management .filter-section {
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