<div wire:poll.30s>
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase">DASHBOARD</a></li>
                    <li class="breadcrumb-item active text-uppercase">CONTRACT</li>
                </ol>
            </nav>
        </div>

        <!-- Header Cards -->
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100" style="background:linear-gradient(135deg,#0f4c75,#1b6ca8);">
                        <div class="card-body">
                            <h6 class="text-white-50 mb-2">Total Kontrak</h6>
                            <h2 class="mb-0 fw-bold text-white">{{ $contracts->total() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex align-items-center justify-content-between py-2">
                            <div>
                                <h4 class="mb-0 fw-bold text-uppercase">Contract Management</h4>
                                <p class="text-muted small mb-0">Kelola kontrak dan pantau realisasi pengiriman item.</p>
                            </div>
                            @if(auth()->user()->level === 1 || auth()->user()->hasPermission('contract.create'))
                            <button type="button" wire:click="$dispatch('open-contract-form')"
                                class="btn rounded-pill px-4 d-flex align-items-center gap-2 fw-semibold text-uppercase"
                                style="background:#0f4c75;color:#fff;">
                                <i class="ti ti-plus fs-4"></i> New Contract
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm p-3 rounded-3">
                <div class="row g-3 align-items-center">
                    <div class="col-md-5 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text border-end-0 bg-transparent text-muted"><i class="ti ti-search fs-5"></i></span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control border-start-0 ps-0"
                                placeholder="Cari nomor / deskripsi...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select wire:model.live="filterCompany" class="form-select border-0 bg-light rounded-3">
                            <option value="">Semua Perusahaan</option>
                            @foreach($companies as $c)
                            <option value="{{ $c->id_company }}">{{ $c->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select wire:model.live="filterDepartement" class="form-select border-0 bg-light rounded-3">
                            <option value="">Semua Departemen</option>
                            @foreach($departements as $d)
                            <option value="{{ $d->id_departement }}">{{ $d->departement }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1 d-flex justify-content-end">
                        <select wire:model.live="perPage" class="form-select border-0 bg-light rounded-3 w-auto">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-3">
                        <input type="date" wire:model.live="dateFrom" class="form-control border-0 bg-light rounded-3" placeholder="Start Date">
                    </div>
                    <div class="col-md-3">
                        <input type="date" wire:model.live="dateTo" class="form-control border-0 bg-light rounded-3" placeholder="End Date">
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="col-12">
            <div class="table-responsive shadow-sm rounded-3">
                <table class="modern-table mb-0">
                    <thead>
                        <tr>
                            <th style="width:40px;" class="text-center">#</th>
                            <th>Contract Number</th>
                            <th>Company / Dept</th>
                            <th>Deskripsi</th>
                            <th>Periode</th>
                            <th>Items</th>
                            <th style="width:110px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contracts as $contract)
                        <tr wire:key="ctr-{{ $contract->id_contract }}">
                            <td class="text-center text-muted small">{{ ($contracts->currentPage()-1)*$contracts->perPage()+$loop->iteration }}</td>
                            <td>
                                <a href="{{ route('contracts.show', hashid_encode($contract->id_contract,'pr')) }}"
                                    class="fw-bold text-decoration-none" style="color:#0f4c75;">
                                    {{ $contract->contract_number }}
                                </a>
                                <br><small class="text-muted">Dibuat: {{ $contract->created_at->format('d M Y') }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold small">{{ optional($contract->company)->company_name ?? '-' }}</div>
                                <div class="text-muted small">{{ optional($contract->departement)->departement ?? '-' }}</div>
                                <div class="text-muted small"><i class="ti ti-user me-1"></i>{{ optional($contract->user)->name ?? '-' }}</div>
                            </td>
                            <td class="small text-muted">{{ Str::limit($contract->description, 60) ?: '-' }}</td>
                            <td class="small">
                                @if($contract->start_date)
                                <div><i class="ti ti-calendar-event me-1 text-info"></i>{{ \Carbon\Carbon::parse($contract->start_date)->format('d M Y') }}</div>
                                @endif
                                @if($contract->end_date)
                                <div><i class="ti ti-calendar-off me-1 text-danger"></i>{{ \Carbon\Carbon::parse($contract->end_date)->format('d M Y') }}</div>
                                @endif
                            </td>
                            <td>
                                @forelse($contract->details as $detail)
                                @php
                                    $shipped   = (float) \App\Models\IkbDetail::where('id_contract', $contract->id_contract)
                                        ->where('id_item', $detail->id_item)->whereNull('deleted_at')->sum('qty');
                                    $remaining = $detail->qty - $shipped;
                                @endphp
                                <div class="small mb-1 pb-1 border-bottom">
                                    <span class="fw-semibold">{{ optional($detail->item)->item_name ?? '-' }}</span>
                                    <span class="text-muted ms-1">({{ optional($detail->itemCategory)->item_category ?? '-' }})</span>
                                    <div class="d-flex gap-2 mt-1">
                                        <span class="badge bg-light-primary text-primary" title="Qty Kontrak">K: {{ number_format($detail->qty,0,',','.') }}</span>
                                        <span class="badge bg-light-success text-success" title="Sudah Dikirim">S: {{ number_format($shipped,0,',','.') }}</span>
                                        <span class="badge {{ $remaining > 0 ? 'bg-light-warning text-warning' : 'bg-light-success text-success' }}" title="Sisa">R: {{ number_format($remaining,0,',','.') }}</span>
                                    </div>
                                </div>
                                @empty
                                <span class="text-muted small">Belum ada item</span>
                                @endforelse
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('contracts.show', hashid_encode($contract->id_contract,'pr')) }}"
                                        class="btn btn-icon bg-light-primary rounded-circle" title="Lihat">
                                        <i class="ti ti-eye fs-5"></i>
                                    </a>
                                    @if(auth()->user()->level === 1 || auth()->user()->id_user == $contract->id_user)
                                    <button type="button"
                                        wire:click="$dispatch('open-contract-form', { id: {{ $contract->id_contract }} })"
                                        class="btn btn-icon bg-light-warning rounded-circle" title="Edit">
                                        <i class="ti ti-edit fs-5"></i>
                                    </button>
                                    <button type="button"
                                        onclick="showConfirm({ title: 'Hapus Kontrak', message: 'Yakin hapus kontrak ini?', type: 'danger', onConfirm: () => @this.delete({{ $contract->id_contract }}) })"
                                        class="btn btn-icon bg-light-danger rounded-circle" title="Hapus">
                                        <i class="ti ti-trash fs-5"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="ti ti-file-certificate fs-1 opacity-50 text-muted"></i>
                                <h5 class="mt-3 text-muted text-uppercase">Tidak ada kontrak ditemukan</h5>
                                <p class="text-muted small">Buat kontrak baru dengan tombol "New Contract"</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">{{ $contracts->links() }}</div>
        </div>
    </div>

    @livewire('contracts.form-modal')

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('close-contract-modal', () => {
                const el = document.getElementById('contractFormModal');
                if (el) bootstrap.Modal.getOrCreateInstance(el).hide();
            });
        });
    </script>
</div>
