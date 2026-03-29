<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Login extends Component
{
    public $id_employee;
    public $password;

    protected $rules = [
        'id_employee' => 'required',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        $user = User::where('id_employee', $this->id_employee)->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($this->password, $user->password)) {
            if ($user->is_active == 0) {
                $this->dispatch('alert', type: 'error', title: 'Gagal', message: 'Akun Anda tidak aktif.');
                return;
            }

            if (!$user->level || !\App\Models\Level::where('level', $user->level)->exists()) {
                $this->dispatch('alert', type: 'error', title: 'Akses Ditolak', message: 'User Level (' . $user->level . ') tidak terdaftar di sistem. Silakan hubungi admin.');
                return;
            }

            if (!$user->id_position || !\App\Models\Position::where('id_position', $user->id_position)->exists()) {
                $this->dispatch('alert', type: 'error', title: 'Akses Ditolak', message: 'Position ID (' . $user->id_position . ') tidak terdaftar di sistem. Silakan hubungi admin.');
                return;
            }

            if ($user->supervisor && !\App\Models\User::where('id_user', $user->supervisor)->exists()) {
                $this->dispatch('alert', type: 'error', title: 'Akses Ditolak', message: 'Data Supervisor tidak valid. Silakan hubungi admin.');
                return;
            }

            Auth::login($user);
            session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        $this->dispatch('alert', type: 'error', title: 'Gagal', message: 'Employee ID atau Password salah.');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.app');
    }
}
