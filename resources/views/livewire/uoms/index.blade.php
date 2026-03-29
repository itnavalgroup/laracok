<div class="uom-management" wire:poll.5s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">UOM</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary h-100">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total UOMs</h6>
                            <h2 class="mb-0 fw-bold text-white">{{ $totalUoms }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">UOM Management</h4>
                                <p class="text-muted small mb-0">Manage units of measurement and conversion factors</p>
                            </div>
                            @if(auth()->user()->level === 1 || auth()->user()->hasPermission('uom.create'))
                            <button wire:click="create" class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center gap-2">
                                <i class="ti ti-plus fs-4"></i>
                                <span class="fw-semibold text-uppercase">Add UOM</span>
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
                                placeholder="Search by UOM name...">
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
                            <th>UOM NAME</th>
                            <th class="text-center">NETTO (KG)</th>
                            <th style="width: 120px;" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($uoms as $u)
                        <tr wire:key="uom-{{ $u->id_uom }}">
                            <td class="text-center text-muted small">{{ ($uoms->currentPage()-1) * $uoms->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold modern-text-title text-uppercase">{{ $u->uom }}</div>
                            </td>
                            <td class="text-center">
                                @if($u->qty_kg)
                                <span class="badge bg-light-primary text-primary fw-semibold px-3 py-2 rounded-pill">
                                    {{ number_format($u->qty_kg) }} Kg
                                </span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('uom.edit'))
                                    <button wire:click="edit({{ $u->id_uom }})" class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                        <i class="ti ti-edit fs-5"></i>
                                    </button>
                                    @endif

                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('uom.delete'))
                                    <button type="button"
                                        onclick="showConfirm({
                                            title: 'Hapus UOM',
                                            message: 'Apakah Anda yakin ingin menghapus UOM {{ $u->uom }}? Tindakan ini tidak dapat dibatalkan.',
                                            type: 'danger',
                                            onConfirm: () => @this.delete({{ $u->id_uom }})
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
                            <td colspan="4" class="text-center py-5">
                                <div class="py-4">
                                    <i class="ti ti-ruler-off fs-1 modern-text-muted opacity-50"></i>
                                    <h5 class="mt-3 modern-text-muted text-uppercase">No UOMs found</h5>
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
                {{ $uoms->links() }}
            </div>
        </div>
    </div>

    <!-- UOM Modal -->
    <div wire:ignore.self class="modal fade" id="uomModal" tabindex="-1" aria-labelledby="uomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase" id="uomModalLabel">
                        <i class="ti ti-{{ $isEditing ? 'edit' : 'plus' }} me-2"></i>
                        {{ $isEditing ? 'Edit UOM' : 'Add New UOM' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <!-- UOM Name -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">UOM NAME <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('uom') is-invalid @enderror"
                                    wire:model="uom" placeholder="e.g. PCS, BOX, KG">
                                @error('uom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Qty KG -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">NETTO (KG)</label>
                                <div class="input-group">
                                    <input type="number" step="0.0001" class="form-control @error('qty_kg') is-invalid @enderror"
                                        wire:model="qty_kg" placeholder="e.g. 1.0000">
                                    <span class="input-group-text bg-light border-start-0 text-muted small fw-bold">KG</span>
                                </div>
                                @error('qty_kg') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <p class="text-muted small mt-1 mb-0 italic">Leave empty if not applicable</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" wire:loading.attr="disabled">
                            <i class="ti ti-device-floppy me-2"></i> {{ $isEditing ? 'Update Data' : 'Save UOM' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        window.addEventListener('openUomModal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('uomModal'));
            myModal.show();
        });

        window.addEventListener('closeUomModal', () => {
            var modalEl = document.getElementById('uomModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        });
    </script>
    @endpush

    <style>
        .uom-management .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .uom-management .filter-section {
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