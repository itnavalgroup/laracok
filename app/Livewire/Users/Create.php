<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Models\Level;
use App\Models\Position;
use App\Models\Departement;
use App\Models\UserEmail;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use WithFileUploads;

    public $id_employee;
    public $name;
    public $emails = [''];
    public $bankAccounts = []; // [['nama_bank' => '', 'nama_penerima' => '', 'norek' => '']]
    public $nik;
    public $npwp;
    public $phone;
    public $level;
    public $id_company = 1; // Default
    public $id_departement;
    public $id_position;
    public $supervisor;
    public $id_warehouse;
    public $is_active = 1;
    public $photo;
    public $croppedPhoto; // Base64 cropped image

    public function addEmail()
    {
        $this->emails[] = '';
    }

    public function removeEmail($index)
    {
        if (count($this->emails) > 1) {
            unset($this->emails[$index]);
            $this->emails = array_values($this->emails);
        }
    }

    public function addBankAccount()
    {
        $this->bankAccounts[] = ['nama_bank' => '', 'nama_penerima' => '', 'norek' => ''];
    }

    public function removeBankAccount($index)
    {
        unset($this->bankAccounts[$index]);
        $this->bankAccounts = array_values($this->bankAccounts);
    }

    public function save()
    {
        $this->validate([
            'id_employee' => 'required|unique:tbl_user,id_employee',
            'name' => 'required|string|max:255',
            'emails.0' => 'required|email|unique:tbl_email_user,email',
            'emails.*' => 'nullable|email|unique:tbl_email_user,email',
            'bankAccounts.*.nama_bank' => 'nullable|string|max:255',
            'bankAccounts.*.nama_penerima' => 'nullable|string|max:255',
            'bankAccounts.*.norek' => 'nullable|string|max:255',
            'level' => 'required|exists:tbl_levels,level',
            'id_departement' => 'required|exists:tbl_departement,id_departement',
            'id_position' => 'required|exists:tbl_position,id_position',
            'id_warehouse' => 'nullable|exists:tbl_warehouse,id_warehouse',
            'phone' => 'nullable|string|max:20',
        ]);

        try {
            DB::beginTransaction();

            $photoName = null;
            if ($this->croppedPhoto) {
                $photoName = time() . '_user.png';
                $imageData = str_replace('data:image/png;base64,', '', $this->croppedPhoto);
                $imageData = str_replace(' ', '+', $imageData);
                \Illuminate\Support\Facades\Storage::disk('public')->put('image/' . $photoName, base64_decode($imageData));
            } elseif ($this->photo) {
                $photoName = time() . '_' . $this->photo->getClientOriginalName();
                $this->photo->storeAs('public/image', $photoName);
            }

            $user = User::create([
                'id_employee' => $this->id_employee,
                'name' => $this->name,
                'password' => '12345678', // Default password
                'nik' => encrypt_legacy($this->nik),
                'npwp' => encrypt_legacy($this->npwp),
                'phone' => $this->phone,
                'level' => $this->level,
                'id_company' => $this->id_company,
                'id_departement' => $this->id_departement,
                'id_position' => $this->id_position,
                'id_warehouse' => $this->id_warehouse,
                'supervisor' => $this->supervisor,
                'is_active' => $this->is_active,
                'photo' => $photoName,
            ]);

            foreach ($this->emails as $email) {
                if ($email) {
                    \App\Models\UserEmail::create([
                        'id_user' => $user->id_user,
                        'email' => $email,
                    ]);
                }
            }

            foreach ($this->bankAccounts as $bank) {
                if ($bank['nama_bank'] && $bank['norek']) {
                    \App\Models\UserBankAccount::create([
                        'id_user' => $user->id_user,
                        'nama_bank' => $bank['nama_bank'],
                        'nama_penerima' => $bank['nama_penerima'],
                        'norek' => $bank['norek'],
                    ]);
                }
            }

            DB::commit();

            $this->dispatch('alert', type: 'success', message: 'User berhasil ditambahkan.');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: 'Gagal menambahkan user: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.users.create', [
            'levels' => Level::all(),
            'positions' => Position::all(),
            'departements' => Departement::all(),
            'warehouses' => \App\Models\Warehouse::where('is_active', 1)->get(),
            'supervisors' => User::all(),
        ])->layout('layouts.app');
    }
}
