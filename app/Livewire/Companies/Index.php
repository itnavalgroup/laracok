<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';

    // Form data
    public $id_company;
    public $company_name;
    public $company; // Alias or Code
    public $logo;
    public $existingLogo;

    public $isEditing = false;

    public function mount()
    {
        if (Auth::user()->level !== 1 && !Auth::user()->hasPermission('company.view')) {
            return $this->handleUnauthorized();
        }
    }

    private function handleUnauthorized()
    {
        session()->flash('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        $previous = url()->previous();
        $current = url()->current();
        if ($previous && $previous !== $current) {
            return redirect()->to($previous);
        }
        if (Route::has('dashboard')) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('profile.edit');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->id_company = null;
        $this->company_name = '';
        $this->company = '';
        $this->logo = null;
        $this->existingLogo = null;
        $this->isEditing = false;
        $this->resetErrorBag();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('company.create'), 403);
        $this->resetForm();
        $this->dispatch('openCompanyModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('company.edit'), 403);
        $this->resetForm();
        $company = Company::findOrFail($id);
        $this->id_company = $company->id_company;
        $this->company_name = $company->company_name;
        $this->company = $company->company;
        $this->existingLogo = $company->logo;
        $this->isEditing = true;
        $this->dispatch('openCompanyModal');
    }

    public function save()
    {
        $rules = [
            'company_name' => 'required|string|max:255',
            'company' => 'required|string|max:50|unique:tbl_company,company,' . ($this->id_company ?? 'NULL') . ',id_company',
            'logo' => 'nullable|image|max:5024', // Max 5MB
        ];

        $this->validate($rules);

        $data = [
            'company_name' => $this->company_name,
            'company' => $this->company,
        ];

        if ($this->logo) {
            $folder = public_path('assets/companies/logos');
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            if ($this->existingLogo) {
                $oldPath = $folder . DIRECTORY_SEPARATOR . $this->existingLogo;
                if (is_file($oldPath)) {
                    unlink($oldPath);
                }
            }

            $newName = str_replace(' ', '_', pathinfo($this->logo->getClientOriginalName(), PATHINFO_FILENAME))
                . '_' . time() . '.' . $this->logo->getClientOriginalExtension();

            // Using Livewire's storeAs with the default 'public' disk (storage/app/public) doesn't help if we link to public/assets. 
            // The user's original logic used move() since the files are not symbolic linked but hardcoded in public/assets.
            // But Livewire's TemporaryUploadedFile restricts move() sometimes if it can't resolve the path.
            // A safer workaround: reading the content and putting it to the physical file path.
            file_put_contents($folder . DIRECTORY_SEPARATOR . $newName, $this->logo->get());
            $data['logo'] = $newName;
        }

        if ($this->isEditing) {
            abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('company.edit'), 403);
            Company::find($this->id_company)->update($data);
            $message = 'Data perusahaan berhasil diperbarui.';
        } else {
            abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('company.create'), 403);
            Company::create($data);
            $message = 'Perusahaan baru berhasil ditambahkan.';
        }

        $this->dispatch('closeCompanyModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('company.delete'), 403);

        $company = Company::findOrFail($id);

        // Check for active relationships before deleting
        $relationships = [
            'User' => $company->users()->exists(),
            'Purchase Request (PR)' => $company->prs()->exists(),
            'Service Request (SR)' => $company->srs()->exists(),
            'IKB' => $company->ikbs()->exists(),
            'Invoice' => $company->invoices()->exists(),
        ];

        foreach ($relationships as $label => $exists) {
            if ($exists) {
                $this->dispatch('alert', [
                    'type' => 'danger',
                    'title' => 'Gagal Menghapus',
                    'message' => "Perusahaan tidak dapat dihapus karena masih digunakan pada data $label.",
                ]);
                return;
            }
        }

        // Soft delete handles the 'deleted_at'
        $company->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Data perusahaan telah dihapus.',
        ]);
    }

    public function render()
    {
        $query = Company::query()
            ->when($this->search, function ($q) {
                $q->where('company_name', 'like', '%' . $this->search . '%')
                    ->orWhere('company', 'like', '%' . $this->search . '%');
            });

        $totalCompanies = $query->count();
        $companies = $query->latest()->paginate($this->perPage);

        return view('livewire.companies.index', [
            'companies' => $companies,
            'totalCompanies' => $totalCompanies,
            'currentPage' => $companies->currentPage(),
            'totalPages' => $companies->lastPage(),
        ])->layout('layouts.app');
    }
}
