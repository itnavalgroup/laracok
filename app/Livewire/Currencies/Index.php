<?php

namespace App\Livewire\Currencies;

use App\Models\Currency;
use App\Models\Pr;
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
    public $id_currency;
    public $country;
    public $code;
    public $symbol;

    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('currency.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('currency.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openCurrencyModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('currency.edit'), 403);
        $this->resetForm();
        $item = Currency::findOrFail($id);
        $this->id_currency = $item->id_currency;
        $this->country = $item->country;
        $this->code = $item->code;
        $this->symbol = $item->symbol;
        $this->isEditing = true;
        $this->dispatch('openCurrencyModal');
    }

    public function resetForm()
    {
        $this->id_currency = null;
        $this->country = '';
        $this->code = '';
        $this->symbol = '';
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'currency.edit' : 'currency.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'country' => 'required|string|max:100',
            'code' => 'required|string|max:3|unique:tbl_currency,code,' . ($this->id_currency ?? 'NULL') . ',id_currency',
            'symbol' => 'required|string|max:10',
        ];

        $this->validate($rules);

        $data = [
            'country' => $this->country,
            'code' => $this->code,
            'symbol' => $this->symbol,
        ];

        if ($this->isEditing) {
            Currency::find($this->id_currency)->update($data);
            $message = 'Data mata uang berhasil diperbarui.';
        } else {
            Currency::create($data);
            $message = 'Mata uang baru berhasil ditambahkan.';
        }

        $this->dispatch('closeCurrencyModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('currency.delete'), 403);

        $item = Currency::findOrFail($id);

        // Deletion Restriction: Check usage
        $hasPr = Pr::where('id_currency', $id)->exists();

        if ($hasPr) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Mata uang tidak dapat dihapus karena masih digunakan pada data lain (Transaksi).',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Data mata uang telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = Currency::query();

        if ($this->search) {
            $query->where('country', 'like', '%' . $this->search . '%')
                ->orWhere('code', 'like', '%' . $this->search . '%')
                ->orWhere('symbol', 'like', '%' . $this->search . '%');
        }

        $currencies = $query->orderBy('id_currency', 'desc')->paginate($this->perPage);

        return view('livewire.currencies.index', [
            'currencies' => $currencies,
            'totalCurrencies' => Currency::count(),
        ]);
    }
}
