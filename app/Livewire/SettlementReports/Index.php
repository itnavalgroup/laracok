<?php

namespace App\Livewire\SettlementReports;

use App\Models\Sr;
use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[On('refreshSrIndex')]
    public function refreshSrIndex()
    {
        $this->resetPage();
    }

    public $search = '';
    public $perPage = 10;
    public $filterDepartement = '';
    public $filterCompany = '';
    public $filterStatus = '';
    public $filterSrStatus = '';
    public $dateFrom = '';
    public $dateTo = '';

    const SESSION_KEY = 'sr_index_filters';

    public function mount()
    {
        abort_if(
            Auth::user()->level !== 1
            && !Auth::user()->hasPermission('sr.view.all')
            && !Auth::user()->hasPermission('sr.view.dept')
            && !Auth::user()->hasPermission('sr.view.subordinate'),
            403
        );

        // Restore filters from PHP session
        $saved = session(self::SESSION_KEY, []);
        if (!empty($saved)) {
            $this->search            = $saved['search']            ?? '';
            $this->perPage           = $saved['perPage']           ?? 10;
            $this->filterDepartement = $saved['filterDepartement'] ?? '';
            $this->filterCompany     = $saved['filterCompany']     ?? '';
            $this->filterStatus      = $saved['filterStatus']      ?? '';
            $this->filterSrStatus    = $saved['filterSrStatus']    ?? '';
            $this->dateFrom          = $saved['dateFrom']          ?? '';
            $this->dateTo            = $saved['dateTo']            ?? '';
        }
    }

    private function saveFiltersToSession(): void
    {
        session([self::SESSION_KEY => [
            'search'            => $this->search,
            'perPage'           => $this->perPage,
            'filterDepartement' => $this->filterDepartement,
            'filterCompany'     => $this->filterCompany,
            'filterStatus'      => $this->filterStatus,
            'filterSrStatus'    => $this->filterSrStatus,
            'dateFrom'          => $this->dateFrom,
            'dateTo'            => $this->dateTo,
        ]]);
    }

    public function updatedSearch()           { $this->resetPage(); $this->saveFiltersToSession(); }
    public function updatedPerPage()          { $this->resetPage(); $this->saveFiltersToSession(); }
    public function updatedFilterDepartement(){ $this->resetPage(); $this->saveFiltersToSession(); }
    public function updatedFilterCompany()    { $this->resetPage(); $this->saveFiltersToSession(); }
    public function updatedFilterStatus()     { $this->resetPage(); $this->saveFiltersToSession(); }
    public function updatedFilterSrStatus()   { $this->resetPage(); $this->saveFiltersToSession(); }
    public function updatedDateFrom()         { $this->resetPage(); $this->saveFiltersToSession(); }
    public function updatedDateTo()           { $this->resetPage(); $this->saveFiltersToSession(); }

    public function resetFilters()
    {
        $this->search            = '';
        $this->filterDepartement = '';
        $this->filterCompany     = '';
        $this->filterStatus      = '';
        $this->filterSrStatus    = '';
        $this->dateFrom          = '';
        $this->dateTo            = '';
        session()->forget(self::SESSION_KEY);
        $this->resetPage();
    }

    public function delete($id)
    {
        $sr = Sr::findOrFail($id);
        $user = Auth::user();

        // Restricted to Admin or Owner
        abort_if($user->level !== 1 && $user->id_user !== $sr->id_user, 403);

        if ($sr->status > 0) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Settlement Report yang sudah diajukan tidak dapat dihapus.',
            ]);
            return;
        }

        $sr->details()->forceDelete();
        $sr->attachments()->forceDelete();
        $sr->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Settlement Report berhasil dihapus.',
        ]);
    }

    public function render()
    {
        $query = Sr::with(['user', 'departement', 'company', 'vendor', 'norekVendor', 'details', 'payments', 'pr'])
            ->withSum('details as total_amount', 'ammount')
            ->visibleTo(Auth::user());

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('tbl_sr.subject', 'like', '%' . $this->search . '%')
                    // PR number lives in tbl_pr — search via the `pr` relation
                    ->orWhereHas('pr', function ($pq) {
                        $pq->where('pr_number', 'like', '%' . $this->search . '%');
                    })
                    // Vendor name
                    ->orWhereHas('vendor', function ($vq) {
                        $vq->where('vendor', 'like', '%' . $this->search . '%');
                    })
                    // Creator name
                    ->orWhereHas('user', function ($uq) {
                        $uq->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->filterDepartement) {
            $query->where('tbl_sr.id_departement', $this->filterDepartement);
        }

        if ($this->filterCompany) {
            $query->where('tbl_sr.id_company', $this->filterCompany);
        }

        // filterStatus = PR status (via relation)
        if ($this->filterStatus !== '') {
            $query->whereHas('pr', function ($pq) {
                $pq->where('status', $this->filterStatus);
            });
        }

        // filterSrStatus = SR own status (tbl_sr.status)
        if ($this->filterSrStatus !== '') {
            $query->where(function ($q) {
                $q->where('tbl_sr.status', $this->filterSrStatus);
                if ($this->filterSrStatus == '0') {
                    $q->orWhereNull('tbl_sr.status');
                }
            });
        }

        if ($this->dateFrom) {
            $query->whereDate('tbl_sr.created_at', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('tbl_sr.created_at', '<=', $this->dateTo);
        }

        // Advanced Sorting: Prioritize SRs that need the current user's approval
        $user = Auth::user();
        $isLevel1 = $user->level === 1;

        $caseStatements = [];
        $userId = $user->id_user;
        
        // 0. Prioritize SRs that need Action from the creator themselves (Draft: 0, Revision: 12)
        $caseStatements[] = "WHEN tbl_sr.status IN (0, 12) AND tbl_sr.id_user = $userId THEN 0";

        // 1. If user is a Department Head / Spv, prioritize their subordinates' Draft (0) or Pending Dept Sign (1)
        if ($isLevel1 || $user->hasPermission('sr.approve.step1')) {
            $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();
            if (!empty($subordinateIds)) {
                $subIdsStr = implode(',', $subordinateIds);
                $caseStatements[] = "WHEN tbl_sr.status IN (0, 1) AND tbl_sr.id_user IN ($subIdsStr) THEN 1";
            }
            $caseStatements[] = "WHEN tbl_sr.status = 1 THEN 2";
        }

        $priorityLevel = 3;

        $srStepPermissions = [
            2 => 'sr.approve.step2',
            3 => 'sr.approve.step3',
            4 => 'sr.approve.step4',
            5 => 'sr.approve.step5',
            6 => 'sr.approve.step6',
            7 => 'sr_payment.create',
            9 => 'sr_payment.create',
            10 => 'sr_payment.create',
        ];

        foreach (range(2, 10) as $statusLevel) {
            if (isset($srStepPermissions[$statusLevel]) && ($isLevel1 || $user->hasPermission($srStepPermissions[$statusLevel]))) {
                $caseStatements[] = "WHEN tbl_sr.status = $statusLevel THEN $priorityLevel";
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

        $srs = $query->orderBy('tbl_sr.id_pr', 'desc')->paginate($this->perPage);

        return view('livewire.settlement-reports.index', [
            'srs' => $srs,
            'departements' => Departement::orderBy('departement')->get(),
            'companies' => \App\Models\Company::orderBy('company_name')->get()
        ])->layout('layouts.app');
    }
}
