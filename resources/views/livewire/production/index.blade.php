<div class="production-management" wire:poll.10s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">TRANSACTION</li>
                    <li class="breadcrumb-item active text-uppercase">PRODUCTION</li>
                </ol>
            </nav>
        </div>

        <!-- Summary Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card summary-card bg-primary h-100">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Production</h6>
                            <h2 class="mb-0 fw-bold text-white">{{ $productions->total() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold modern-text-title text-uppercase">Daftar Production</h4>
                                <p class="text-muted small mb-0">Kelola konversi bahan baku (stock asalan) menjadi beberapa produk</p>
                            </div>
                            <div class="d-flex gap-2">
                                @if(auth()->user()->level === 1 || auth()->user()->hasPermission('production.create'))
                                <button type="button" wire:click="$dispatch('open-production-form')" class="btn btn-primary rounded-pill px-4 d-flex align-items-center gap-2">
                                    <i class="ti ti-plus fs-4"></i>
                                    <span class="fw-semibold text-uppercase">New Production</span>
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
            <div class="filter-section shadow-sm border-0 theme-responsive-card p-3 rounded-3">

                <!-- Primary Filter Bar -->
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted">
                                <i class="ti ti-search fs-5"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 ps-0 text-truncate"
                                placeholder="Cari No Production...">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <select wire:model.live="filterStatus" class="form-select border-0 bg-light shadow-none rounded-3 h-100">
                            <option value="">Semua Status</option>
                            <option value="0">Draft</option>
                            <option value="1">Submitted (Request)</option>
                            <option value="2">Processed (Process)</option>
                            <option value="3">Verified / Finished</option>
                            <option value="9">Canceled</option>
                        </select>
                    </div>

                    <div class="col-md-5 d-flex justify-content-md-end justify-content-between align-items-center gap-2">
                        <!-- Toggle Filters Button -->
                        <button class="btn btn-light border-0 shadow-sm d-flex align-items-center gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#advancedTableFilters" aria-expanded="false" aria-controls="advancedTableFilters">
                            <i class="ti ti-filter fs-5"></i>
                            <span class="d-none d-sm-inline">More Filters</span>
                        </button>

                        <!-- Show Pagination -->
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted small text-nowrap d-none d-sm-inline">Show:</span>
                            <select wire:model.live="perPage" class="form-select border-0 bg-light shadow-none rounded-3 w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Advanced Filters -->
                <div class="collapse mt-3" id="advancedTableFilters" wire:ignore.self>
                    <div class="p-3 bg-light rounded-3 bg-opacity-50">
                        <div class="row g-3">
                            <!-- Department Filter -->
                            @if(auth()->user()->level === 1 || auth()->user()->hasPermission('production.view.all'))
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Departemen</label>
                                <select wire:model.live="filterDepartement" class="form-select border-0 bg-white shadow-none rounded-3">
                                    <option value="">Semua Departemen</option>
                                    @foreach($departements as $dept)
                                    <option value="{{ $dept->id_departement }}">{{ $dept->departement }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <!-- Company Filter -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Perusahaan</label>
                                <select wire:model.live="filterCompany" class="form-select border-0 bg-white shadow-none rounded-3">
                                    <option value="">Semua Perusahaan</option>
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id_company }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Warehouse Filter -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Warehouse</label>
                                <select wire:model.live="filterWarehouse" class="form-select border-0 bg-white shadow-none rounded-3" @if(auth()->user()->id_warehouse && !auth()->user()->hasPermission('production.view.all')) disabled @endif>
                                    <option value="">Semua Warehouse</option>
                                    @foreach($warehouses as $wh)
                                    <option value="{{ $wh->id_warehouse }}">{{ $wh->warehouse_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Date Range -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Periode Tanggal Awal</label>
                                <input type="date" wire:model.live="dateFrom" class="form-control border-0 bg-white shadow-none rounded-3">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Periode Tanggal Akhir</label>
                                <input type="date" wire:model.live="dateTo" class="form-control border-0 bg-white shadow-none rounded-3">
                            </div>
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
                            <th style="width: 200px;">PRODUCTION NO & DATE</th>
                            <th>DEPARTMENT & COMPANY</th>
                            <th>WAREHOUSE & CREATOR</th>
                            <th class="text-center">ITEMS (IN/OUT)</th>
                            <th style="width: 150px;" class="text-center">STATUS</th>
                            <th style="width: 120px;" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productions as $production)
                        <tr wire:key="production-{{ $production->id_production }}">
                            <td class="text-center text-muted small">{{ ($productions->currentPage()-1) * $productions->perPage() + $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('production.show', hashid_encode($production->id_production, 'production')) }}" class="fw-bold text-primary text-decoration-none">
                                    {{ $production->production_number ?? 'DRAFT' }}
                                </a>
                                <br>
                                <span class="text-muted small">
                                    <i class="ti ti-calendar me-1"></i>{{ $production->production_date ? \Carbon\Carbon::parse($production->production_date)->format('d M Y') : '-' }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold modern-text-title text-uppercase">{{ $production->departement->departement ?? '-' }}</div>
                                <div class="text-muted small">
                                    <i class="ti ti-building me-1"></i>{{ $production->company->company_name ?? '-' }}
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold mb-1"><i class="ti ti-building-warehouse me-1 text-primary"></i>{{ $production->warehouse->warehouse_name ?? '-' }}</div>
                                <div class="text-muted small"><i class="ti ti-user me-1"></i>{{ $production->user->name ?? '-' }}</div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light-danger text-danger border border-danger-subtle ms-1" title="Materials (Bahan Baku)">{{ $production->materials_count }} Mat</span>
                                <span class="badge bg-light-success text-success border border-success-subtle" title="Results (Barang Jadi)">{{ $production->results_count }} Res</span>
                            </td>
                            <td class="text-center">
                                @php
                                $statusBadge = [
                                    0 => ['label' => 'Draft', 'color' => 'secondary'],
                                    1 => ['label' => 'Submitted', 'color' => 'warning'],
                                    2 => ['label' => 'Processed', 'color' => 'primary'],
                                    3 => ['label' => 'Finished / Verified', 'color' => 'success'],
                                    9 => ['label' => 'Canceled', 'color' => 'danger'],
                                ];

                                $status = $production->status ?? 0;
                                $badge = $statusBadge[$status] ?? ['label' => 'Unknown', 'color' => 'dark'];
                                @endphp
                                <span class="badge w-100 bg-light-{{ $badge['color'] }} text-{{ $badge['color'] }} p-2" style="white-space: normal;">{{ $badge['label'] }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('production.show', hashid_encode($production->id_production, 'production')) }}" class="btn btn-icon bg-light-primary rounded-circle" title="View Details">
                                        <i class="ti ti-eye fs-5"></i>
                                    </a>

                                    @php
                                    $canDelete = (auth()->user()->level === 1 || auth()->user()->hasPermission('production.delete.all')) 
                                        || ($production->status == 0 && (auth()->user()->hasPermission('production.delete') || auth()->user()->id_user == $production->id_user));
                                    @endphp
                                    @if($canDelete)
                                    <button type="button"
                                        onclick="showConfirm({ title: 'Hapus Production', message: 'Apakah Anda yakin ingin menghapus Data ini secara keseluruhan (termasuk membatalkan mutasi stok)?', type: 'danger', onConfirm: () => @this.delete({{ $production->id_production }}) })"
                                        class="btn btn-icon bg-light-danger rounded-circle" title="Delete">
                                        <i class="ti ti-trash fs-5"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="py-4">
                                    <i class="ti ti-file-export fs-1 modern-text-muted opacity-50"></i>
                                    <h5 class="mt-3 modern-text-muted text-uppercase">No Production Found</h5>
                                    <p class="modern-text-muted small">Mulai dengan membuat Production baru melalui tombol "New Production"</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $productions->links() }}
            </div>
        </div>
    </div>

    <!-- Listener JS for Modal -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('close-production-modal', () => {
                const modalEl = document.getElementById('productionFormModal');
                if (modalEl) {
                    bootstrap.Modal.getOrCreateInstance(modalEl).hide();
                }
                const detailModalEl = document.getElementById('productionDetailModal');
                if (detailModalEl) {
                    bootstrap.Modal.getOrCreateInstance(detailModalEl).hide();
                }
            });
        });
    </script>

    <style>
        .production-management .filter-section {
            background-color: #fff;
            padding: 1.25rem;
            border-radius: 12px;
        }

        [data-pc-theme="dark"] .production-management .filter-section {
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

        .hr-border {
            border-top: 1px solid #e2e8f0;
        }

        [data-pc-theme="dark"] .hr-border {
            border-top-color: #334155;
        }

        [data-pc-theme="dark"] .modal-body .bg-light {
            background-color: #1e293b !important;
        }
    </style>
    <livewire:production.form-modal />
</div>

