<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $user;
    public $nik;
    public $npwp;

    public function mount($hash)
    {
        $id = hashid_decode($hash);
        abort_if(!$id, 404);

        $this->user = User::with(['emails', 'bankAccounts', 'departement', 'position', 'boss'])->findOrFail($id);

        // Decrypt NIK and NPWP for display
        $this->nik  = decrypt_legacy($this->user->nik);
        $this->npwp = decrypt_legacy($this->user->npwp);
    }

    public function render()
    {
        return view('livewire.users.show');
    }
}
