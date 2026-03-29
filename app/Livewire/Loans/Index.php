<?php

namespace App\Livewire\Loans;

use App\Models\Loan;
use App\Models\Pr;
use App\Models\Sr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    // Form fields
    public $id_loan;
    public $loan;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('loan.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('loan.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openLoanModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('loan.edit'), 403);
        $this->resetForm();
        $item = Loan::findOrFail($id);
        $this->id_loan = $item->id_loan;
        $this->loan = $item->loan;
        $this->isEditing = true;
        $this->dispatch('openLoanModal');
    }

    public function resetForm()
    {
        $this->id_loan = null;
        $this->loan = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'loan.edit' : 'loan.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'loan' => 'required|string|max:255|unique:tbl_loans,loan,' . ($this->id_loan ?? 'NULL') . ',id_loan',
        ];

        $this->validate($rules);

        $data = [
            'loan' => $this->loan,
            'id_user' => Auth::id(),
        ];

        if ($this->isEditing) {
            Loan::find($this->id_loan)->update($data);
            $message = 'Data loan berhasil diperbarui.';
        } else {
            Loan::create($data);
            $message = 'Data loan baru berhasil ditambahkan.';
        }

        $this->dispatch('closeLoanModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('loan.delete'), 403);

        $item = Loan::findOrFail($id);

        // Deletion Restriction: Check if used by PR or SR
        $isUsedInPr = Pr::where('id_loan', $id)->exists();
        $isUsedInSr = Sr::where('id_loan', $id)->exists();

        if ($isUsedInPr || $isUsedInSr) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Loan tidak dapat dihapus karena sudah digunakan dalam transaksi PR atau SR.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Data loan telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = Loan::query()->with('user');

        if ($this->search) {
            $query->where('loan', 'like', '%' . $this->search . '%');
        }

        $loans = $query->orderBy('id_loan', 'desc')->paginate($this->perPage);

        return view('livewire.loans.index', [
            'loans' => $loans,
            'totalLoans' => Loan::count(),
        ]);
    }
}
