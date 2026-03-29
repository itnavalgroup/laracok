<?php

namespace App\Livewire\Permissions;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $selectedUserId = null;
    public $selectedUser   = null;
    public $userSearch     = '';
    public $userPermissions = []; // [id_permission => bool]

    // Permission CRUD & Search
    public $permissionSearch = '';
    public $editingPermissionId = null;
    public $permissionForm = [
        'permission_name'        => '',
        'permission_description' => '',
        'module'                 => ''
    ];

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        if (Auth::user()->level !== 1) {
            return $this->handleUnauthorized();
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

    public function selectUser($userId)
    {
        $this->selectedUserId = $userId;
        $this->selectedUser   = User::with('permissions')->find($userId);

        if (!$this->selectedUser) return;

        $granted = $this->selectedUser->permissions->pluck('id_permission')->toArray();

        $this->refreshUserPermissions($granted);
    }

    private function refreshUserPermissions($grantedIds = null)
    {
        if ($grantedIds === null && $this->selectedUser) {
            $grantedIds = $this->selectedUser->permissions()->pluck('tbl_permissions.id_permission')->toArray();
        }

        $grantedIds = $grantedIds ?? [];

        $this->userPermissions = Permission::all()
            ->mapWithKeys(fn($p) => [$p->id_permission => in_array($p->id_permission, $grantedIds)])
            ->toArray();
    }

    public function togglePermission($permissionId)
    {
        abort_if(Auth::user()->level !== 1, 403);

        if (!$this->selectedUserId) return;

        $permissionId = (int) $permissionId;
        $exists = UserPermission::where('id_user', $this->selectedUserId)
            ->where('id_permission', $permissionId)
            ->exists();

        if ($exists) {
            UserPermission::where('id_user', $this->selectedUserId)
                ->where('id_permission', $permissionId)
                ->delete();
            $this->userPermissions[$permissionId] = false;
        } else {
            UserPermission::create([
                'id_user'       => $this->selectedUserId,
                'id_permission' => $permissionId,
            ]);
            $this->userPermissions[$permissionId] = true;
        }

        $this->dispatch('alert', [
            'type'    => 'success',
            'title'   => 'Permission Updated',
            'message' => 'Permission berhasil diperbarui.',
        ]);
    }

    public function toggleModule($module)
    {
        abort_if(Auth::user()->level !== 1, 403);
        if (!$this->selectedUserId) return;

        $permissions = Permission::where('module', $module)->pluck('id_permission')->toArray();
        $grantedIds = UserPermission::where('id_user', $this->selectedUserId)
            ->whereIn('id_permission', $permissions)
            ->pluck('id_permission')
            ->toArray();

        // Jika semua sudah diberikan, maka kita akan revoke semua. 
        // Sebaliknya, jika belum semua (termasuk jika tidak ada), maka kita grant semua.
        $allGrantedInModule = count($permissions) > 0 && count($grantedIds) === count($permissions);

        if ($allGrantedInModule) {
            // Revoke All in Module
            UserPermission::where('id_user', $this->selectedUserId)
                ->whereIn('id_permission', $permissions)
                ->delete();
            foreach ($permissions as $pid) {
                $this->userPermissions[$pid] = false;
            }
            $msg = "Seluruh hak akses pada modul $module telah dicabut.";
        } else {
            // Grant All in Module
            foreach ($permissions as $pid) {
                UserPermission::firstOrCreate([
                    'id_user'       => $this->selectedUserId,
                    'id_permission' => $pid,
                ]);
                $this->userPermissions[$pid] = true;
            }
            $msg = "Seluruh hak akses pada modul $module telah diberikan.";
        }

        $this->dispatch('alert', [
            'type'    => 'success',
            'title'   => 'Module Updated',
            'message' => $msg,
        ]);
    }

    public function clearSelectedUser()
    {
        $this->selectedUserId = null;
        $this->selectedUser = null;
        $this->userPermissions = [];
    }

    public function revokeAllGlobal()
    {
        abort_if(Auth::user()->level !== 1, 403);

        UserPermission::truncate(); // Menghapus semua data di tbl_user_permissions

        $this->userPermissions = [];
        $this->selectedUserId = null;
        $this->selectedUser = null;

        $this->dispatch('alert', [
            'type'    => 'warning',
            'title'   => 'Global Revoke Berhasil',
            'message' => 'Seluruh permission telah dicabut dari SEMUA user.',
        ]);
    }

    // --- PERMISSION CRUD ---

    public function createPermission()
    {
        $this->resetForm();
        $this->dispatch('openPermissionModal');
    }

    public function editPermission($id)
    {
        $this->resetForm();
        $permission = Permission::findOrFail($id);
        $this->editingPermissionId = $id;
        $this->permissionForm = [
            'permission_name'        => $permission->permission_name,
            'permission_description' => $permission->permission_description,
            'module'                 => $permission->module
        ];
        $this->dispatch('openPermissionModal');
    }

    public function savePermission()
    {
        $rules = [
            'permissionForm.permission_name'        => 'required|unique:tbl_permissions,permission_name,' . ($this->editingPermissionId ?: 'NULL') . ',id_permission',
            'permissionForm.permission_description' => 'required',
            'permissionForm.module'                 => 'required'
        ];

        $this->validate($rules);

        if ($this->editingPermissionId) {
            $permission = Permission::find($this->editingPermissionId);
            $permission->update($this->permissionForm);
            $message = 'Permission berhasil diperbarui.';
        } else {
            Permission::create($this->permissionForm);
            $message = 'Permission baru berhasil ditambahkan.';
        }

        $this->dispatch('closePermissionModal');
        $this->dispatch('alert', [
            'type'    => 'success',
            'title'   => 'Berhasil',
            'message' => $message,
        ]);

        $this->refreshUserPermissions();
    }

    public function deletePermission($id)
    {
        abort_if(Auth::user()->level !== 1, 403);
        Permission::find($id)->delete();

        $this->dispatch('alert', [
            'type'    => 'success',
            'title'   => 'Dihapus',
            'message' => 'Permission berhasil dihapus.',
        ]);

        $this->refreshUserPermissions();
    }

    public function resetForm()
    {
        $this->editingPermissionId = null;
        $this->permissionForm = [
            'permission_name'        => '',
            'permission_description' => '',
            'module'                 => ''
        ];
        $this->resetErrorBag();
    }

    // --- HELPERS ---

    public function grantAll()
    {
        abort_if(Auth::user()->level !== 1, 403);
        if (!$this->selectedUserId) return;

        $allIds = Permission::pluck('id_permission')->toArray();

        foreach ($allIds as $pid) {
            UserPermission::firstOrCreate([
                'id_user'       => $this->selectedUserId,
                'id_permission' => $pid,
            ]);
            $this->userPermissions[$pid] = true;
        }

        $this->dispatch('alert', [
            'type'    => 'success',
            'title'   => 'All Permissions Granted',
            'message' => 'Semua permission telah diberikan.',
        ]);
    }

    public function revokeAll()
    {
        abort_if(Auth::user()->level !== 1, 403);
        if (!$this->selectedUserId) return;

        UserPermission::where('id_user', $this->selectedUserId)->delete();

        $this->userPermissions = array_map(fn() => false, $this->userPermissions);

        $this->dispatch('alert', [
            'type'    => 'warning',
            'title'   => 'All Permissions Revoked',
            'message' => 'Semua permission telah dicabut.',
        ]);
    }

    public function getUsers()
    {
        return User::query()
            ->where('is_active', 1)
            ->when($this->userSearch, fn($q) => $q->where('name', 'like', '%' . $this->userSearch . '%'))
            ->orderBy('name')
            ->get();
    }

    public function getPermissionsByModule()
    {
        return Permission::query()
            ->when($this->permissionSearch, function ($q) {
                $q->where('permission_name', 'like', '%' . $this->permissionSearch . '%')
                    ->orWhere('permission_description', 'like', '%' . $this->permissionSearch . '%')
                    ->orWhere('module', 'like', '%' . $this->permissionSearch . '%');
            })
            ->get()
            ->groupBy('module');
    }

    public function render()
    {
        return view('livewire.permissions.index', [
            'users'             => $this->getUsers(),
            'permissionsByModule' => $this->getPermissionsByModule(),
        ])->layout('layouts.app');
    }
}
