<?php

namespace App\Livewire\Contracts;

use App\Models\Contract;
use App\Models\Company;
use App\Models\Departement;
use App\Models\IkbDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search       = '';
    public $perPage      = 10;
    public $filterCompany     = '';
    public $filterDepartement = '';
    public $dateFrom     = '';
    public $dateTo       = '';

    protected $queryString = [
        'search'            => ['except' => ''],
        'perPage'           => ['except' => 10],
        'filterCompany'     => ['except' => ''],
        'filterDepartement' => ['except' => ''],
        'dateFrom'          => ['except' => ''],
        'dateTo'            => ['except' => ''],
    ];

    public function mount()
    {
        $user = Auth::user();
        abort_if(
            $user->level !== 1
                && !$user->hasPermission('contract.view')
                && !$user->hasPermission('contract.view.dept')
                && !$user->hasPermission('contract.view.subordinate'),
            403
        );
    }

    public function updatedSearch()          { $this->resetPage(); }
    public function updatedFilterCompany()   { $this->resetPage(); }
    public function updatedFilterDepartement(){ $this->resetPage(); }
    public function updatedDateFrom()        { $this->resetPage(); }
    public function updatedDateTo()          { $this->resetPage(); }

    public function delete($id)
    {
        $contract = Contract::findOrFail($id);
        $user     = Auth::user();

        // Only owner or admin
        if ($user->level !== 1 && $user->id_user !== $contract->id_user) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki akses untuk menghapus kontrak ini.']);
            return;
        }

        // Block if any IKB detail references this contract
        $usedInIkb = IkbDetail::where('id_contract', $id)->whereNull('deleted_at')->exists();
        if ($usedInIkb) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Kontrak tidak dapat dihapus karena sudah digunakan pada data IKB.']);
            return;
        }

        // Delete file if exists
        if ($contract->file_name) {
            $filePath = public_path('assets/contract/' . $contract->file_name);
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }

        $contract->details()->delete();
        $contract->delete();

        $this->dispatch('alert', ['type' => 'success', 'message' => 'Kontrak berhasil dihapus.']);
    }

    public function render()
    {
        $user  = Auth::user();
        $query = Contract::with(['user', 'company', 'departement', 'details.item', 'details.itemCategory'])
            ->visibleTo($user);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('contract_number', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterCompany) {
            $query->where('id_company', $this->filterCompany);
        }

        if ($this->filterDepartement) {
            $query->where('id_departement', $this->filterDepartement);
        }

        if ($this->dateFrom) {
            $query->whereDate('start_date', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('end_date', '<=', $this->dateTo);
        }

        $contracts = $query->orderByDesc('id_contract')->paginate($this->perPage);

        return view('livewire.contracts.index', [
            'contracts'    => $contracts,
            'companies'    => Company::orderBy('company_name')->get(),
            'departements' => Departement::orderBy('departement')->get(),
        ])->layout('layouts.app');
    }
}
