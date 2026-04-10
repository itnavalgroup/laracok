<div class="modal fade" id="productionDetailModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @if($production)
            <div class="modal-header bg-light">
                <h5 class="modal-title">
                    Detail Production: <strong>{{ $production->production_number }}</strong>
                    @php
                        $statusBadge = [
                            0 => ['label' => 'Draft', 'color' => 'secondary'],
                            1 => ['label' => 'Processed', 'color' => 'warning'],
                            2 => ['label' => 'Finished', 'color' => 'success'],
                            3 => ['label' => 'Canceled', 'color' => 'danger'],
                        ];
                        $badge = $statusBadge[$production->status] ?? ['label' => 'Unknown', 'color' => 'dark'];
                    @endphp
                    <span class="badge bg-{{ $badge['color'] }} ms-2">{{ $badge['label'] }}</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                
                <div class="row mb-4">
                    <div class="col-md-3"><strong>Date:</strong> {{ $production->production_date }}</div>
                    <div class="col-md-3"><strong>Warehouse:</strong> {{ $production->warehouse->warehouse_name ?? '-' }}</div>
                    <div class="col-md-3"><strong>Department:</strong> {{ $production->departement->departement ?? '-' }}</div>
                    <div class="col-md-3"><strong>Company:</strong> {{ $production->company->company_name ?? '-' }}</div>
                </div>

                <div class="row">
                    <!-- MATERIALS (Inputs) -->
                    <div class="col-md-6 border-end">
                        <h6 class="fw-bold text-danger"><i class="ti ti-minus"></i> Raw Materials (Inputs)</h6>
                        
                        @if($production->status == 0)
                        <div class="card bg-light mb-3 p-2">
                            <form wire:submit.prevent="addMaterial" class="d-flex gap-2">
                                <select wire:model="mat_id_item" class="form-select" required>
                                    <option value="">-- Pilih Item --</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id_item }}">{{ $item->item }}</option>
                                    @endforeach
                                </select>
                                <input type="number" step="0.01" wire:model="mat_qty" class="form-control" placeholder="Qty" style="width: 100px" required>
                                <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-plus"></i></button>
                            </form>
                        </div>
                        @endif

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($production->materials as $mat)
                                <tr>
                                    <td>{{ $mat->item->item ?? 'Unknown' }}</td>
                                    <td>{{ $mat->qty }} {{ $mat->uom->uom ?? '' }}</td>
                                    <td>
                                        @if($production->status == 0)
                                        <button wire:click="deleteMaterial({{ $mat->id_production_material }})" class="btn btn-sm btn-link text-danger p-0"><i class="ti ti-trash"></i></button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- RESULTS (Outputs) -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-success"><i class="ti ti-plus"></i> Production Results (Outputs)</h6>
                        
                        @if($production->status == 0)
                        <div class="card bg-light mb-3 p-2">
                            <form wire:submit.prevent="addResult" class="d-flex gap-2">
                                <select wire:model="res_id_item" class="form-select" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id_item }}">{{ $item->item }}</option>
                                    @endforeach
                                </select>
                                <input type="number" step="0.01" wire:model="res_qty" class="form-control" placeholder="Qty" style="width: 100px" required>
                                <button type="submit" class="btn btn-success btn-sm"><i class="ti ti-plus"></i></button>
                            </form>
                        </div>
                        @endif

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Produk Jadi</th>
                                    <th>Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($production->results as $res)
                                <tr>
                                    <td>{{ $res->item->item ?? 'Unknown' }}</td>
                                    <td>{{ $res->qty }} {{ $res->uom->uom ?? '' }}</td>
                                    <td>
                                        @if($production->status == 0)
                                        <button wire:click="deleteResult({{ $res->id_production_result }})" class="btn btn-sm btn-link text-danger p-0"><i class="ti ti-trash"></i></button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer bg-light d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <div class="d-flex gap-2">
                    @if($production->status == 0)
                        <button type="button" onclick="showConfirm({title:'Process?',message:'Set status ke Processed?',type:'warning',onConfirm:()=>@this.processProduction()})" class="btn btn-warning"><i class="ti ti-settings"></i> Process</button>
                    @elseif($production->status == 1)
                        <button type="button" onclick="showConfirm({title:'Cancel?',message:'Set status ke Canceled?',type:'danger',onConfirm:()=>@this.cancelProduction()})" class="btn btn-danger"><i class="ti ti-x"></i> Cancel</button>
                        <button type="button" onclick="showConfirm({title:'Finish?',message:'Selesaikan production dan update inventory?',type:'success',onConfirm:()=>@this.finishProduction()})" class="btn btn-success"><i class="ti ti-check"></i> Finish Production</button>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
