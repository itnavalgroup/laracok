<?php

namespace App\Livewire\Production;

use App\Models\Production;
use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[On('refreshProductionIndex')]
    public function refreshProductionIndex()
    {
        $this->resetPage();
    }

    public $search = '';
    public $perPage = 10;
    public $filterWarehouse = '';
    public $filterDepartement = '';
    public $filterCompany = '';
    public $filterStatus = '';
    public $dateFrom = '';
    public $dateTo = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'filterWarehouse' => ['except' => ''],
        'filterDepartement' => ['except' => ''],
        'filterCompany' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'dateFrom' => ['except' => ''],
        'dateTo' => ['except' => ''],
    ];

    public function mount()
    {
        abort_if(
            Auth::user()->level !== 1 &&
                !Auth::user()->hasPermission('production.view.all') &&
                !Auth::user()->hasPermission('production.view.dept') &&
                !Auth::user()->hasPermission('production.view.warehouse'),
            403
        );
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedFilterWarehouse()
    {
        $this->resetPage();
    }
    public function updatedFilterDepartement()
    {
        $this->resetPage();
    }
    public function updatedFilterCompany()
    {
        $this->resetPage();
    }
    public function updatedFilterStatus()
    {
        $this->resetPage();
    }
    public function updatedDateFrom()
    {
        $this->resetPage();
    }
    public function updatedDateTo()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $production = Production::findOrFail($id);
        $user = Auth::user();

        abort_if(
            $user->level !== 1 &&
                !($user->id_user == $production->id_user && $user->hasPermission('production.delete')),
            403
        );

        if ($production->status > 0) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Production yang sudah diproses tidak dapat dihapus.',
            ]);
            return;
        }

        $production->materials()->forceDelete();
        $production->results()->forceDelete();
        $production->attachments()->forceDelete();
        $production->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Production berhasil dihapus.',
        ]);
    }

    public function render()
    {
        $query = Production::with(['user', 'departement', 'company', 'warehouse'])
            ->withCount(['materials', 'results'])
            ->visibleTo(Auth::user());

        if ($this->filterWarehouse) {
            $query->where('id_warehouse', $this->filterWarehouse);
        }

        if ($this->search) {
            $query->where('production_number', 'like', '%' . $this->search . '%');
        }

        if ($this->filterDepartement) {
            $query->where('id_departement', $this->filterDepartement);
        }

        if ($this->filterCompany) {
            $query->where('id_company', $this->filterCompany);
        }

        if ($this->filterStatus !== '') {
            $query->where('status', $this->filterStatus);
        }

        if ($this->dateFrom) {
            $query->whereDate('created_at', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('created_at', '<=', $this->dateTo);
        }

        $productions = $query->orderBy('status', 'asc')
            ->orderBy('id_production', 'desc')
            ->paginate($this->perPage);

        return view('livewire.production.index', [
            'productions' => $productions,
            'departements' => Departement::orderBy('departement', 'asc')->get(),
            'companies' => \App\Models\Company::orderBy('company_name', 'asc')->get(),
            'warehouses' => \App\Models\Warehouse::orderBy('warehouse_name', 'asc')->get(),
        ])->layout('layouts.app');
    }
}
