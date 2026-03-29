<div class="items-management" wire:poll.5s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">MASTER DATA</li>
                    <li class="breadcrumb-item active text-uppercase">ITEM</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary h-100">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Master Barang</h6>
                            <h2 class="mb-0 fw-bold text-white">{{ $totalItems }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">Item Management</h4>
                                <p class="text-muted small mb-0">Kelola data barang untuk transaksi inventaris, PR, dan SR</p>
                            </div>
                            <div class="d-flex gap-2">
                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('item.download'))
                                <button wire:click="export" class="btn btn-outline-success rounded-pill px-3 d-flex align-items-center gap-2">
                                    <i class="ti ti-download fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Export</span>
                                </button>
                                @endif

                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('item.upload'))
                                <button type="button" data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-outline-primary rounded-pill px-3 d-flex align-items-center gap-2">
                                    <i class="ti ti-upload fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Import</span>
                                </button>
                                @endif

                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('item.create'))
                                <button wire:click="create" class="btn btn-primary rounded-pill px-4 d-flex align-items-center gap-2">
                                    <i class="ti ti-plus fs-4"></i>
                                    <span class="fw-semibold text-uppercase">Add Item</span>
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
                                placeholder="Cari nama atau kode barang...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select wire:model.live="filterCategory" class="form-select border-0 bg-light shadow-none rounded-3">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id_item_category }}">{{ $cat->item_category }}</option>
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
                            <th style="width: 150px;">KODE</th>
                            <th>NAMA BARANG</th>
                            <th>KATEGORI</th>
                            <th class="text-end">NET (SISA)</th>
                            <th style="width: 120px;" class="text-center">STATUS</th>
                            <th style="width: 120px;" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr wire:key="item-{{ $item->id_item }}">
                            <td class="text-center text-muted small">{{ ($items->currentPage()-1) * $items->perPage() + $loop->iteration }}</td>
                            <td>
                                <span class="badge bg-light-secondary text-secondary text-uppercase">{{ $item->item_code ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="fw-bold modern-text-title text-uppercase">{{ $item->item_name }}</div>
                                <div class="text-muted small">{{ Str::limit($item->description, 50) }}</div>
                            </td>
                            <td>
                                <span class="text-uppercase small fw-semibold text-primary">
                                    <i class="ti ti-tag me-1 text-primary-50"></i>
                                    {{ $item->category->item_category ?? 'Tanpa Kategori' }}
                                </span>
                            </td>
                            <td class="text-end fw-bold">
                                @php
                                $net = ($item->total_income ?? 0) - ($item->total_outcome ?? 0);
                                @endphp
                                @if($net > 0)
                                <span class="text-success">+{{ number_format($net, 2, ',', '.') }}</span>
                                @elseif($net < 0)
                                    <span class="text-danger">{{ number_format($net, 2, ',', '.') }}</span>
                                    @else
                                    <span class="text-secondary">{{ number_format($net, 2, ',', '.') }}</span>
                                    @endif
                            </td>
                            <td class="text-center">
                                @if($item->is_active)
                                <span class="badge bg-light-success text-success text-uppercase">ACTIVE</span>
                                @else
                                <span class="badge bg-light-danger text-danger text-uppercase">INACTIVE</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('item.edit'))
                                    <button wire:click="edit({{ $item->id_item }})" class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                        <i class="ti ti-edit fs-5"></i>
                                    </button>
                                    @endif

                                    @if(auth()->user()->level === 1 || auth()->user()->hasPermission('item.delete'))
                                    <button type="button"
                                        onclick="showConfirm({
                                                title: 'Hapus Barang',
                                                message: 'Apakah Anda yakin ingin menghapus {{ $item->item_name }}? Tindakan ini tidak dapat dibatalkan.',
                                                type: 'danger',
                                                onConfirm: () => @this.delete({{ $item->id_item }})
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
                                    <i class="ti ti-package-off fs-1 modern-text-muted opacity-50"></i>
                                    <h5 class="mt-3 modern-text-muted text-uppercase">No items found</h5>
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
                {{ $items->links() }}
            </div>
        </div>
    </div>

    <!-- Item Modal -->
    <div wire:ignore.self class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white text-uppercase" id="itemModalLabel">
                        <i class="ti ti-{{ $isEditing ? 'edit' : 'plus' }} me-2"></i>
                        {{ $isEditing ? 'Edit Item' : 'Add Item' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <!-- Category -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">KATEGORI <span class="text-danger">*</span></label>
                                <select class="form-select @error('id_item_category') is-invalid @enderror" wire:model="id_item_category">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->id_item_category }}">{{ $cat->item_category }}</option>
                                    @endforeach
                                </select>
                                @error('id_item_category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Item Code -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">KODE BARANG <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('item_code') is-invalid @enderror"
                                    wire:model="item_code" placeholder="e.g. ITEM001">
                                @error('item_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Item Name -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">NAMA BARANG <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('item_name') is-invalid @enderror"
                                    wire:model="item_name" placeholder="e.g. Gumrosin">
                                @error('item_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase">DESKRIPSI</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                    wire:model="description" rows="3" placeholder="Tambahkan keterangan barang..."></textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                            <i class="ti ti-device-floppy me-2"></i> {{ $isEditing ? 'Update Data' : 'Simpan Barang' }}
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
                        <i class="ti ti-upload me-2"></i> Import Barang dari Excel
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="import">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="alert alert-light-info border-info-subtle small mb-3">
                                    <i class="ti ti-info-circle me-1"></i> Gunakan template yang disediakan. Pastikan **category_code** sudah terdaftar di sistem.
                                </div>
                                <div class="mb-3">
                                    <button type="button" wire:click="downloadTemplate" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                        <i class="ti ti-download me-1"></i> Download Template
                                    </button>
                                </div>
                                <label class="form-label fw-bold small text-uppercase text-info">Pilih File Excel</label>
                                <input type="file" wire:model="file_excel" class="form-control @error('file_excel') is-invalid @enderror">
                                @error('file_excel') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
        window.addEventListener('openItemModal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('itemModal'));
            myModal.show();
        });

        window.addEventListener('closeItemModal', () => {
            var modalEl = document.getElementById('itemModal');
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
        .items-management .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .items-management .filter-section {
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