<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Models\UserEmail;
use App\Models\UserBankAccount;
use App\Models\Pr;
use App\Models\Sr;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Edit extends Component
{
    use WithFileUploads;

    public $userId;
    public $id_employee;
    public $name;
    public $nik;
    public $npwp;
    public $phone;
    public $photo;
    public $newPhoto;
    public $croppedPhoto;

    public $emails = [];
    public $bankAccounts = [];

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = User::with(['emails', 'bankAccounts', 'position', 'departement', 'boss', 'level_detail'])
            ->findOrFail(Auth::id());

        $this->userId       = $user->id_user;
        $this->id_employee  = $user->id_employee;
        $this->name         = $user->name;
        $this->nik          = decrypt_legacy($user->nik);
        $this->npwp         = decrypt_legacy($user->npwp);
        $this->phone        = $user->phone;
        $this->photo        = $user->photo;

        // Load Emails
        $this->emails = $user->emails->map(function ($e) {
            return [
                'id'     => $e->id_email_user,
                'email'  => $e->email,
                'isUsed' => $this->checkEmailUsage($e->id_email_user),
            ];
        })->toArray();

        if (empty($this->emails)) {
            $this->emails[] = ['id' => null, 'email' => '', 'isUsed' => false];
        }

        // Load Bank Accounts
        $this->bankAccounts = $user->bankAccounts->map(function ($b) {
            return [
                'id'            => $b->id_norek_user,
                'nama_bank'     => $b->nama_bank,
                'nama_penerima' => $b->nama_penerima,
                'norek'         => $b->norek,
                'isUsed'        => $this->checkBankUsage($b->norek),
            ];
        })->toArray();
    }

    private function checkEmailUsage($id): bool
    {
        if (!$id) return false;
        return Pr::where('id_email_user', $id)->exists() || Sr::where('id_email_user', $id)->exists();
    }

    private function checkBankUsage($norek): bool
    {
        if (!$norek) return false;
        return Pr::where('norek', $norek)->exists() || Sr::where('norek', $norek)->exists();
    }

    // ── Email Methods ──────────────────────────────────────────────────────────
    public function addEmail()
    {
        $this->emails[] = ['id' => null, 'email' => '', 'isUsed' => false];
    }

    public function removeEmail($index)
    {
        if (!isset($this->emails[$index])) return;

        if ($this->emails[$index]['isUsed']) {
            $this->dispatch('alert', type: 'error', message: 'Email ini tidak dapat dihapus karena sudah digunakan dalam transaksi.');
            return;
        }
        if (count($this->emails) > 1) {
            unset($this->emails[$index]);
            $this->emails = array_values($this->emails);
        }
    }

    // ── Bank Account Methods ────────────────────────────────────────────────────
    public function addBankAccount()
    {
        $this->bankAccounts[] = ['id' => null, 'nama_bank' => '', 'nama_penerima' => '', 'norek' => '', 'isUsed' => false];
    }

    public function removeBankAccount($index)
    {
        if (!isset($this->bankAccounts[$index])) return;

        if ($this->bankAccounts[$index]['isUsed']) {
            $this->dispatch('alert', type: 'error', message: 'Rekening ini tidak dapat dihapus karena sudah digunakan dalam transaksi.');
            return;
        }
        unset($this->bankAccounts[$index]);
        $this->bankAccounts = array_values($this->bankAccounts);
    }

    // ── Save Profile ────────────────────────────────────────────────────────────
    public function updateProfile()
    {
        $this->validate([
            'name'            => 'required|string|max:255',
            'phone'           => 'nullable|string|max:20',
            'emails.0.email'  => 'required|email',
            'emails.*.email'  => 'nullable|email',
        ]);

        try {
            DB::beginTransaction();

            $user = User::findOrFail($this->userId);

            $data = [
                'name'  => $this->name,
                'phone' => $this->phone,
                'nik'   => encrypt_legacy($this->nik),
                'npwp'  => encrypt_legacy($this->npwp),
            ];

            if ($this->croppedPhoto) {
                $photoName = time() . '_profile.png';
                $imageData = str_replace('data:image/png;base64,', '', $this->croppedPhoto);
                $imageData = str_replace(' ', '+', $imageData);
                \Illuminate\Support\Facades\Storage::disk('public')->put('image/' . $photoName, base64_decode($imageData));
                $data['photo'] = $photoName;
            } elseif ($this->newPhoto) {
                $photoName = time() . '_' . $this->newPhoto->getClientOriginalName();
                $this->newPhoto->storeAs('public/image', $photoName);
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
                        'nama_bank'     => $bank['nama_bank'],
                        'nama_penerima' => $bank['nama_penerima'],
                        'norek'         => $bank['norek'],
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

            // Refresh photo after save
            $fresh = $user->fresh();
            $this->photo        = $fresh->photo;
            $this->newPhoto     = null;
            $this->croppedPhoto = null;

            $this->dispatch('alert', type: 'success', message: 'Profil berhasil diperbarui.');
            $this->dispatch('closeProfileModal');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: 'Gagal menyimpan profil: ' . $e->getMessage());
        }
    }

    // ── Change Password ─────────────────────────────────────────────────────────
    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password'     => 'required|min:8|confirmed',
        ]);

        $user = User::findOrFail($this->userId);
        $user->password = $this->new_password;
        $user->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->dispatch('alert', type: 'success', message: 'Password berhasil diperbarui.');
        $this->dispatch('closePasswordModal');
    }

    public function render()
    {
        return view('livewire.profile.edit')->layout('layouts.app');
    }
}
