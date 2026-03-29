<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $levelFilter = '';
    public $departmentFilter = '';
    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $user = Auth::user();

        // Check if user has ANY allowed view permission
        $hasAccess = $user->level === 1
            || $user->hasPermission('user.view.all')
            || $user->hasPermission('user.view.dept')
            || $user->hasPermission('user.view.subordinate');

        if (!$hasAccess) {
            return $this->handleUnauthorized();
        }

        // If only subordinate and NO subordinates → redirect to own profile
        if (
            $user->hasPermission('user.view.subordinate')
            && !($user->level === 1 || $user->hasPermission('user.view.all') || $user->hasPermission('user.view.dept'))
        ) {
            if ($user->subordinates()->count() === 0) {
                return redirect()->route('users.show', hashid_encode($user->id_user));
            }
        }
    }

    private function handleUnauthorized()
    {
        session()->flash('error', 'Anda tidak memiliki akses ke halaman tersebut.');

        $previous = url()->previous();
        $current = url()->current();

        // If from another page, go back
        if ($previous && $previous !== $current) {
            return redirect()->to($previous);
        }

        // Fallback 1: Dashboard
        if (\Illuminate\Support\Facades\Route::has('dashboard')) {
            return redirect()->route('dashboard');
        }

        // Fallback 2: Profile (Edit)
        return redirect()->route('profile.edit');
    }

    protected $queryString = [
        'search' => ['except' => ''],
        'levelFilter' => ['except' => ''],
        'departmentFilter' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'levelFilter', 'departmentFilter', 'perPage'])) {
            $this->resetPage();
        }
    }

    public function delete($id)
    {
        if (Auth::user()->level !== 1) {
            $this->dispatch('alert', type: 'error', message: 'Hanya Admin yang dapat menghapus user!');
            return;
        }

        $user = User::findOrFail($id);
        $user->delete();

        $this->dispatch('alert', type: 'success', message: 'User berhasil dihapus.');
    }

    public function render()
    {
        $currentUser = Auth::user();
        $query = User::with(['level_detail', 'position', 'departement', 'primary_email']);

        // Base filtering based on permission
        if ($currentUser->level === 1 || $currentUser->hasPermission('user.view.all')) {
            // No base filter
        } elseif ($currentUser->hasPermission('user.view.dept')) {
            $query->where('id_departement', $currentUser->id_departement);
        } elseif ($currentUser->hasPermission('user.view.subordinate')) {
            $query->where('supervisor', $currentUser->id_user);
        } else {
            $query->where('id_user', $currentUser->id_user);
        }

        // Apply Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('id_employee', 'like', '%' . $this->search . '%');
            });
        }

        // Apply Level Filter
        if ($this->levelFilter) {
            $query->where('level', $this->levelFilter);
        }

        // Apply Department Filter
        if ($this->departmentFilter) {
            $query->where('id_departement', $this->departmentFilter);
        }

        $totalUsers = $query->count();
        $users = $query->paginate($this->perPage);

        return view('livewire.users.index', [
            'users' => $users,
            'totalUsers' => $totalUsers,
            'levels' => \App\Models\Level::all(),
            'departments' => \App\Models\Departement::all(),
            'currentPage' => $users->currentPage(),
            'totalPages' => $users->lastPage(),
        ])->layout('layouts.app');
    }
}
