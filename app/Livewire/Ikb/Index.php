<?php

namespace App\Livewire\Ikb;

use App\Models\Ikb;
use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[On('refreshIkbIndex')]
    public function refreshIkbIndex()
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
                !Auth::user()->hasPermission('ikb.view.all') &&
                !Auth::user()->hasPermission('ikb.view.dept') &&
                !Auth::user()->hasPermission('ikb.view.warehouse') &&
                !Auth::user()->hasPermission('ikb.view.subordinate'),
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
        $ikb = Ikb::findOrFail($id);
        $user = Auth::user();

        abort_if(
            $user->level !== 1 &&
                !($user->id_user == $ikb->id_user && $user->hasPermission('ikb.delete')),
            403
        );

        if ($ikb->status > 0) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'IKB yang sudah diajukan tidak dapat dihapus.',
            ]);
            return;
        }

        $ikb->details()->forceDelete();
        $ikb->attachments()->forceDelete();
        $ikb->signTransactions()->forceDelete();
        $ikb->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'IKB berhasil dihapus.',
        ]);
    }

    public function render()
    {
        $query = Ikb::with(['user', 'departement', 'company', 'warehouse', 'vendor', 'transactionType', 'salesUser'])
            ->withCount('details')
            ->visibleTo(Auth::user());

        if ($this->filterWarehouse) {
            $query->where('id_warehouse', $this->filterWarehouse);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('ikb_number', 'like', '%' . $this->search . '%')
                    ->orWhere('so_number', 'like', '%' . $this->search . '%')
                    ->orWhere('po_number', 'like', '%' . $this->search . '%')
                    ->orWhere('do_number', 'like', '%' . $this->search . '%');
            });
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

        $user = Auth::user();
        $isLevel1 = $user->level === 1;

        $caseStatements = [];

        $userId = $user->id_user;
        $caseStatements[] = "WHEN tbl_ikb.status IN (0, 11, 12) AND tbl_ikb.id_user = $userId THEN 0";

        // Approver mappings
        if ($isLevel1 || $user->hasPermission('ikb.approve.step1')) {
            $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();
            if (!empty($subordinateIds)) {
                $subIdsStr = implode(',', $subordinateIds);
                $caseStatements[] = "WHEN tbl_ikb.status IN (0, 1) AND tbl_ikb.sales IN ($subIdsStr) THEN 1";
            }
            $caseStatements[] = "WHEN tbl_ikb.status = 1 THEN 2";
        }

        $priorityLevel = 3;

        $ikbStepPermissions = [
            2 => 'ikb.approve.step2',
            3 => 'ikb.approve.step3',
            4 => 'ikb.approve.step4',
            5 => 'ikb.approve.step5',
            6 => 'ikb.approve.step6',
            7 => 'ikb.approve.step7',
            8 => 'ikb.approve.step8',
            9 => 'ikb.approve.step9',
        ];

        foreach (range(2, 9) as $statusLevel) {
            $hasPriority = false;
            if (isset($ikbStepPermissions[$statusLevel]) && ($isLevel1 || $user->hasPermission($ikbStepPermissions[$statusLevel]))) {
                $caseStatements[] = "WHEN tbl_ikb.status = $statusLevel THEN $priorityLevel";
                $hasPriority = true;
            }
            if ($hasPriority) {
                $priorityLevel++;
            }
        }

        if (!empty($caseStatements)) {
            $caseClause = implode(' ', $caseStatements);
            $query->orderByRaw("
                CASE 
                    $caseClause
                    ELSE 99 
                END ASC
            ");
        }

        $ikbs = $query->orderBy('tbl_ikb.status', 'asc')
            ->orderBy('tbl_ikb.id_ikb', 'desc')
            ->paginate($this->perPage);

        return view('livewire.ikb.index', [
            'ikbs' => $ikbs,
            'departements' => Departement::orderBy('departement', 'asc')->get(),
            'companies' => \App\Models\Company::orderBy('company_name', 'asc')->get(),
            'warehouses' => \App\Models\Warehouse::orderBy('warehouse_name', 'asc')->get(),
        ])->layout('layouts.app');
    }
}
