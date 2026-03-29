<div class="item-categories-management" wire:poll.5s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">MASTER DATA</li>
                    <li class="breadcrumb-item active text-uppercase">ITEM CATEGORY</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary h-100">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Item Categories</h6>
                            <h2 class="mb-0 fw-bold text-white">{{ $totalCategories }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">Item Category Management</h4>
                                <p class="text-muted small mb-0">Manage categories for items and inventory</p>
                            </div>
                            <div class="d-flex gap-2">
                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_category.download'))
                                <button wire:click="export" class="btn btn-outline-success rounded-pill px-3 d-flex align-items-center gap-2">
                                    <i class="ti ti-download fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Export</span>
                                </button>
                                @endif

                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_category.upload'))
                                <button type="button" data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-outline-primary rounded-pill px-3 d-flex align-items-center gap-2">
                                    <i class="ti ti-upload fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Import</span>
                                </button>
                                @endif

                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_category.create'))
                                <button wire:click="create" class="btn btn-primary rounded-pill px-4 d-flex align-items-center gap-2">
                                    <i class="ti ti-plus fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Add Category</span>
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
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted">
                                <i class="ti ti-search fs-5"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 ps-0"
                                placeholder="Search by name or code...">
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
                            <th style="width: 150px;">CODE</th>
                            <th>CATEGORY NAME</th>
                            <th style="width: 150px;" class="text-center">STATUS</th>
                            <th>CREATED BY</th>
                            <th style="width: 120px;" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr wire:key="cat-{{ $category->id_item_category }}">
                            <td class="text-center text-muted small">{{ ($categories->currentPage()-1) * $categories->perPage() + $loop->iteration }}</td>
                            <td>
                                <span class="badge bg-light-secondary text-secondary text-uppercase">{{ $category->item_category_code }}</span>
                            </td>
                            <td>
                                <div class="fw-bold modern-text-title text-uppercase">{{ $category->item_category }}</div>
                            </td>
                            <td class="text-center">
                                @if($category->is_active)
                                <span class="badge bg-light-success text-success text-uppercase">ACTIVE</span>
                                @else
                                <span class="badge bg-light-danger text-danger text-uppercase">INACTIVE</span>
                                @endif
                            </td>
                            <td>
                                <div class="small">{{ $category->creator->name ?? 'System' }}</div>
                                <div class="text-muted extra-small">{{ $category->created_at->format('d M Y H:i') }}</div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_category.edit'))
                                    <button wire:click="edit({{ $category->id_item_category }})" class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                        <i class="ti ti-edit fs-5"></i>
                                    </button>
                                    @endif

                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_category.delete'))
                                    <button type="button"
                                        onclick="showConfirm({
                                                title: 'Hapus Kategori Barak',
                                                message: 'Apakah Anda yakin ingin menghapus kategori {{ $category->item_category }}? Tindakan ini tidak dapat dibatalkan.',
                                                type: 'danger',
                                                onConfirm: () => @this.delete({{ $category->id_item_category }})
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
                                    <i class="ti ti-category-off fs-1 modern-text-muted opacity-50"></i>
                                    <h5 class="mt-3 modern-text-muted text-uppercase">No categories found</h5>
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
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <!-- Category Modal -->
    <div wire:ignore.self class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase" id="categoryModalLabel">
                        <i class="ti ti-{{ $isEditing ? 'edit' : 'plus' }} me-2"></i>
                        {{ $isEditing ? 'Edit Category' : 'Add Category' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <!-- Category Code -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">CATEGORY CODE <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('item_category_code') is-invalid @enderror"
                                    wire:model="item_category_code" placeholder="e.g. CAT001">
                                @error('item_category_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Category Name -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">CATEGORY NAME <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('item_category') is-invalid @enderror"
                                    wire:model="item_category" placeholder="e.g. ELECTRONIC, STATIONARY, etc.">
                                @error('item_category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">STATUS <span class="text-danger">*</span></label>
                                <select class="form-select @error('is_active') is-invalid @enderror" wire:model="is_active">
                                    <option value="1">ACTIVE</option>
                                    <option value="0">INACTIVE</option>
                                </select>
                                @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" wire:loading.attr="disabled">
                            <i class="ti ti-device-floppy me-2"></i> {{ $isEditing ? 'Update Data' : 'Simpan Kategori' }}
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
        window.addEventListener('openCategoryModal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('categoryModal'));
            myModal.show();
        });

        window.addEventListener('closeCategoryModal', () => {
            var modalEl = document.getElementById('categoryModal');
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
        .item-categories-management .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .item-categories-management .filter-section {
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