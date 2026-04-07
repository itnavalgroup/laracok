<?php

namespace App\Livewire\Users;

use App\Models\Departement;
use App\Models\Level;
use App\Models\Position;
use App\Models\Pr;
use App\Models\Sr;
use App\Models\User;
use App\Models\UserBankAccount;
use App\Models\UserEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $userId;

    public $id_employee;

    public $name;

    public $emails = [];

    public $bankAccounts = [];

    public $nik;

    public $npwp;

    public $phone;

    public $level;

    public $levelName;

    public $id_company;

    public $id_departement;

    public $id_position;

    public $supervisor;

    public $id_warehouse;

    public $is_active;

    public $photo;

    public $existingPhoto;

    public $croppedPhoto; // Base64 cropped image

    public $isReadOnly = false;

    public $canEditSecurity = false;

    public function mount($hash)
    {
        $id = hashid_decode($hash);
        abort_if(! $id, 404);

        $user = User::with(['emails', 'bankAccounts'])->findOrFail($id);
        $currentUser = Auth::user();

        if (! $currentUser->canEditUser($user)) {
            abort(403);
        }

        $this->userId = $user->id_user;
        $this->id_employee = $user->id_employee;
        $this->name = $user->name;
        $this->nik = decrypt_legacy($user->nik);
        $this->npwp = decrypt_legacy($user->npwp);
        $this->phone = $user->phone;
        $this->level = $user->level;
        $this->levelName = $user->level_detail->level_name ?? '-';
        $this->id_company = $user->id_company;
        $this->id_departement = $user->id_departement;
        $this->id_position = $user->id_position;
        $this->supervisor = $user->supervisor;
        $this->id_warehouse = $user->id_warehouse;
        $this->is_active = $user->is_active;
        $this->existingPhoto = $user->photo;

        // Load Emails
        $this->emails = $user->emails->map(function ($e) {
            return [
                'id' => $e->id_email_user,
                'email' => $e->email,
                'isUsed' => $this->checkEmailUsage($e->id_email_user),
            ];
        })->toArray();

        if (empty($this->emails)) {
            $this->emails[] = ['id' => null, 'email' => '', 'isUsed' => false];
        }

        // Load Bank Accounts
        $this->bankAccounts = $user->bankAccounts->map(function ($b) {
            return [
                'id' => $b->id_norek_user,
                'nama_bank' => $b->nama_bank,
                'nama_penerima' => $b->nama_penerima,
                'norek' => $b->norek,
                'isUsed' => $this->checkBankUsage($b->norek),
            ];
        })->toArray();

        // Logic for field restrictions
        if ($currentUser->level === 1 || $currentUser->hasPermission('user.permissions')) {
            $this->canEditSecurity = true;
        } else {
            $this->canEditSecurity = false;
        }
    }

    private function checkEmailUsage($id)
    {
        if (! $id) {
            return false;
        }

        return Pr::where('id_email_user', $id)->exists() || Sr::where('id_email_user', $id)->exists();
    }

    private function checkBankUsage($norek)
    {
        if (! $norek) {
            return false;
        }

        return Pr::where('norek', $norek)->exists() || Sr::where('norek', $norek)->exists();
    }

    public function addEmail()
    {
        $this->emails[] = ['id' => null, 'email' => '', 'isUsed' => false];
    }

    public function removeEmail($index)
    {
        if (isset($this->emails[$index])) {
            if ($this->emails[$index]['isUsed']) {
                $this->dispatch('alert', type: 'error', message: 'Email ini tidak dapat dihapus karena sudah digunakan dalam transaksi.');

                return;
            }
            if (count($this->emails) > 1) {
                unset($this->emails[$index]);
                $this->emails = array_values($this->emails);
            }
        }
    }

    public function addBankAccount()
    {
        $this->bankAccounts[] = ['id' => null, 'nama_bank' => '', 'nama_penerima' => '', 'norek' => '', 'isUsed' => false];
    }

    public function removeBankAccount($index)
    {
        if (isset($this->bankAccounts[$index])) {
            if ($this->bankAccounts[$index]['isUsed']) {
                $this->dispatch('alert', type: 'error', message: 'Rekening ini tidak dapat dihapus karena sudah digunakan dalam transaksi.');

                return;
            }
            unset($this->bankAccounts[$index]);
            $this->bankAccounts = array_values($this->bankAccounts);
        }
    }

    public function resetPassword()
    {
        if (Auth::user()->level !== 1 && ! Auth::user()->hasPermission('user.reset_password')) {
            $this->dispatch('alert', type: 'error', message: 'Anda tidak memiliki akses untuk meriset password!');

            return;
        }

        $user = User::findOrFail($this->userId);
        $user->password = '12345678';
        $user->save();

        $this->dispatch('alert', type: 'success', message: 'Password berhasil direset ke default (12345678).');
    }

    public function save()
    {
        $user = User::findOrFail($this->userId);

        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'emails.0.email' => 'required|email',
            'emails.*.email' => 'nullable|email',
            'id_warehouse' => 'nullable|exists:tbl_warehouse,id_warehouse',
        ];

        if ($this->canEditSecurity) {
            $rules['id_employee'] = 'required|unique:tbl_user,id_employee,'.$this->userId.',id_user';
            $rules['level'] = 'required|exists:tbl_levels,level';
        }

        $this->validate($rules);

        try {
            DB::beginTransaction();

            $data = [
                'name' => $this->name,
                'phone' => $this->phone,
                'nik' => encrypt_legacy($this->nik),
                'npwp' => encrypt_legacy($this->npwp),
                'id_company' => $this->id_company,
                'id_departement' => $this->id_departement,
                'id_position' => $this->id_position,
                'id_warehouse' => $this->id_warehouse === '' ? null : $this->id_warehouse,
                'supervisor' => $this->supervisor,
                'is_active' => $this->is_active,
            ];

            if ($this->canEditSecurity) {
                $data['id_employee'] = $this->id_employee;
                $data['level'] = $this->level;
            }

            if ($this->croppedPhoto) {
                $photoName = time().'_user.png';
                $imageData = str_replace('data:image/png;base64,', '', $this->croppedPhoto);
                $imageData = str_replace(' ', '+', $imageData);

                if ($this->existingPhoto && \Illuminate\Support\Facades\Storage::disk('public')->exists('image/'.$this->existingPhoto)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('image/'.$this->existingPhoto);
                }

                \Illuminate\Support\Facades\Storage::disk('public')->put('image/'.$photoName, base64_decode($imageData));
                $data['photo'] = $photoName;
            } elseif ($this->photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                $photoName = time().'_'.$this->photo->getClientOriginalName();
                $this->photo->storeAs('public/image', $photoName);
                $data['photo'] = $photoName;
            }

            $user->update($data);

            // Sync Emails
            $emailIds = collect($this->emails)->pluck('id')->filter()->toArray();
            UserEmail::where('id_user', $this->userId)->whereNotIn('id_email_user', $emailIds)->delete();

            foreach ($this->emails as $email) {
                if ($email['email']) {
                    if ($email['id']) {
                        UserEmail::where('id_email_user', $email['id'])->update(['email' => $email['email']]);
                    } else {
                        UserEmail::create(['id_user' => $this->userId, 'email' => $email['email']]);
                    }
                }
            }

            // Sync Bank Accounts
            $bankIds = collect($this->bankAccounts)->pluck('id')->filter()->toArray();
            UserBankAccount::where('id_user', $this->userId)->whereNotIn('id_norek_user', $bankIds)->delete();

            foreach ($this->bankAccounts as $bank) {
                if ($bank['nama_bank'] && $bank['norek']) {
                    $bankData = [
                        'nama_bank' => $bank['nama_bank'],
                        'nama_penerima' => $bank['nama_penerima'],
                        'norek' => $bank['norek'],
                    ];
                    if ($bank['id']) {
                        UserBankAccount::where('id_norek_user', $bank['id'])->update($bankData);
                    } else {
                        $bankData['id_user'] = $this->userId;
                        UserBankAccount::create($bankData);
                    }
                }
            }

            DB::commit();
            $this->dispatch('alert', type: 'success', message: 'Data user berhasil diperbarui.');

            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: 'Gagal update user: '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.users.edit', [
            'levels' => Level::all(),
            'positions' => Position::all(),
            'departements' => Departement::all(),
            'warehouses' => \App\Models\Warehouse::where('is_active', 1)->get(),
            'supervisors' => User::where('id_user', '!=', $this->userId)->get(),
        ])->layout('layouts.app');
    }
}
