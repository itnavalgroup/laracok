<div class="permission-management">
    <div class="row">
        <!-- Breadcrumb -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">DASHBOARD</a></li>
                    <li class="breadcrumb-item active">PERMISSION MANAGEMENT</li>
                </ol>
            </nav>
        </div>

        <!-- Page Header -->
        <div class="col-12 mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 fw-bold text-primary"><i class="ti ti-shield-lock me-2"></i>Permission Management</h4>
                <small class="text-muted">Kelola hak akses untuk setiap user</small>
            </div>
        </div>

        <!-- Two Panel Layout -->
        <div class="col-12">
            <div class="row g-4">

                <!-- LEFT: User List -->
                <div class="col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-primary text-white py-3">
                            <h6 class="mb-0 fw-bold"><i class="ti ti-users me-2"></i>Pilih User</h6>
                        </div>
                        <div class="card-body p-0">
                            <!-- Search -->
                            <div class="p-3 border-bottom">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="ti ti-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Cari nama..." wire:model.live="userSearch">
                                </div>
                            </div>
                            <!-- User List -->
                            <div class="user-list-scroll" style="max-height: calc(100vh - 320px); overflow-y: auto;">
                                @forelse($users as $user)
                                <div wire:click="selectUser({{ $user->id_user }})"
                                    class="user-list-item d-flex align-items-center p-3 border-bottom cursor-pointer {{ $selectedUserId == $user->id_user ? 'bg-primary text-white' : '' }}"
                                    style="cursor: pointer; transition: background 0.15s;">
                                    <div class="avatar-sm me-3 flex-shrink-0">
                                        @if($user->photo)
                                        <img src="{{ asset('storage/image/' . $user->photo) }}" class="rounded-circle" style="width:36px;height:36px;object-fit:cover;" alt="">
                                        @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center {{ $selectedUserId == $user->id_user ? 'bg-white text-primary' : 'bg-primary-subtle text-primary' }}" style="width:36px;height:36px;font-size:14px;font-weight:700;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <div class="fw-semibold text-truncate small">{{ $user->name }}</div>
                                        <div class="text-truncate" style="font-size:0.7rem; opacity:0.75;">{{ $user->position->position ?? '-' }}</div>
                                    </div>
                                    @if($selectedUserId == $user->id_user)
                                    <i class="ti ti-chevron-right ms-2"></i>
                                    @endif
                                </div>
                                @empty
                                <div class="text-center py-5 text-muted small">
                                    <i class="ti ti-users-minus fs-2 d-block mb-2 opacity-50"></i>
                                    Tidak ada user ditemukan
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Permission Table -->
                <div class="col-lg-9">
                    <div class="card border-0 shadow-sm h-100">
                        @if($selectedUser)
                        <!-- User Header (Assignment Mode) -->
                        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #1e3a5f, #2563eb);">
                            <div class="d-flex align-items-center gap-3">
                                @if($selectedUser->photo)
                                <img src="{{ asset('storage/image/' . $selectedUser->photo) }}" class="rounded-circle border border-2 border-white" style="width:48px;height:48px;object-fit:cover;">
                                @else
                                <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center fw-bold" style="width:48px;height:48px;font-size:18px;">
                                    {{ strtoupper(substr($selectedUser->name, 0, 1)) }}
                                </div>
                                @endif
                                <div class="text-white">
                                    <h6 class="mb-0 fw-bold text-white">{{ $selectedUser->name }}</h6>
                                    <small class="opacity-75">{{ $selectedUser->position->position ?? '-' }} • {{ $selectedUser->departement->departement ?? '-' }}</small>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button"
                                    onclick="showConfirm({
                                            title: 'Grant All Permissions',
                                            message: 'Apakah Anda yakin ingin memberikan SEMUA hak akses ke user {{ $selectedUser->name }}?',
                                            type: 'success',
                                            onConfirm: () => @this.grantAll()
                                        })"
                                    class="btn btn-sm btn-success rounded-pill px-3">
                                    <i class="ti ti-check-all me-1"></i>Grant All
                                </button>
                                <button type="button"
                                    onclick="showConfirm({
                                            title: 'Revoke All Permissions',
                                            message: 'Apakah Anda yakin ingin mencabut SEMUA hak akses dari user {{ $selectedUser->name }}?',
                                            type: 'danger',
                                            onConfirm: () => @this.revokeAll()
                                        })"
                                    class="btn btn-sm btn-danger rounded-pill px-3">
                                    <i class="ti ti-x me-1"></i>Revoke All
                                </button>
                                <button wire:click="clearSelectedUser" class="btn btn-sm btn-light rounded-circle px-2" title="Keluar dari Assignment Mode">
                                    <i class="ti ti-x fs-5"></i>
                                </button>
                            </div>
                        </div>
                        @else
                        <!-- Master Header (Management Mode) -->
                        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white border-0">
                            <h6 class="mb-0 fw-bold text-white"><i class="ti ti-settings me-2"></i>Master Permission List</h6>
                            <div class="d-flex gap-2">
                                <button type="button"
                                    onclick="showConfirm({
                                            title: 'Revoke SEMUA Permission (Global)',
                                            message: 'APAKAH ANDA YAKIN? Tindakan ini akan mencabut SELURUH hak akses dari SEMUA user di sistem. Ini adalah tindakan permanen yang tidak bisa dibatalkan.',
                                            type: 'danger',
                                            onConfirm: () => @this.revokeAllGlobal()
                                        })"
                                    class="btn btn-sm btn-danger rounded-pill px-3 fw-bold shadow-sm">
                                    <i class="ti ti-trash me-1"></i>Revoke All Global
                                </button>
                                <button wire:click="createPermission" class="btn btn-sm btn-light rounded-pill px-3 fw-bold text-primary shadow-sm">
                                    <i class="ti ti-plus me-1"></i>Add Permission
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Search Bar -->
                        <div class="px-4 py-3 border-bottom search-bar-container">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border-end-0 search-icon-bg"><i class="ti ti-search text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0 search-input" placeholder="Cari permission berdasarkan nama, deskripsi atau modul..." wire:model.live="permissionSearch">
                            </div>
                        </div>

                        <!-- Permissions TableBody -->
                        <div class="card-body p-0" style="max-height: calc(100vh - 350px); overflow-y: auto;">
                            @forelse($permissionsByModule as $module => $permissions)
                            <div class="permission-module-section">
                                <!-- Module Header -->
                                <div class="px-4 py-2 d-flex align-items-center justify-content-between module-header"
                                    style="border-bottom:1px solid var(--bs-border-color);">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="ti ti-folder text-primary"></i>
                                        <span class="fw-bold text-primary small text-uppercase">{{ $module }}</span>
                                        @if($selectedUser)
                                        <span class="badge bg-primary-subtle text-primary rounded-pill ms-1" style="font-size:0.65rem;">
                                            {{ $permissions->filter(fn($p) => $userPermissions[$p->id_permission] ?? false)->count() }}
                                            / {{ $permissions->count() }}
                                        </span>
                                        @endif
                                    </div>

                                    @if($selectedUser)
                                    <div class="form-check form-switch mb-0">
                                        @php
                                        $allChecked = $permissions->count() > 0 && $permissions->every(fn($p) => $userPermissions[$p->id_permission] ?? false);
                                        @endphp
                                        <input class="form-check-input"
                                            type="checkbox"
                                            role="switch"
                                            wire:click="toggleModule('{{ $module }}')"
                                            {{ $allChecked ? 'checked' : '' }}
                                            style="width:2.2em; height:1.1em; cursor:pointer;">
                                    </div>
                                    @endif
                                </div>
                                <!-- Permission Rows -->
                                @foreach($permissions as $permission)
                                <div class="d-flex align-items-center px-4 py-2 border-bottom permission-row"
                                    style="transition: background 0.15s;">
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold small permission-desc">{{ $permission->permission_description }}</div>
                                        <code class="text-muted permission-name" style="font-size:0.7rem;">{{ $permission->permission_name }}</code>
                                    </div>

                                    @if(!$selectedUser)
                                    <!-- Management Mode Actions -->
                                    <div class="d-flex align-items-center gap-1 ms-3">
                                        <button wire:click="editPermission({{ $permission->id_permission }})" class="btn btn-sm btn-icon btn-outline-primary border-0 action-btn" title="Edit Master">
                                            <i class="ti ti-edit fs-5"></i>
                                        </button>
                                        <button type="button"
                                            onclick="showConfirm({
                                                            title: 'Hapus Permission',
                                                            message: 'Apakah Anda yakin ingin menghapus permission {{ $permission->permission_name }}? Ini akan menghapus master data dan mencabut akses dari SEMUA user.',
                                                            type: 'danger',
                                                            onConfirm: () => @this.deletePermission({{ $permission->id_permission }})
                                                        })"
                                            class="btn btn-sm btn-icon btn-outline-danger border-0 action-btn" title="Delete Master">
                                            <i class="ti ti-trash fs-5"></i>
                                        </button>
                                    </div>
                                    @else
                                    <!-- Assignment Mode Toggle -->
                                    <div class="form-check form-switch mb-0 ms-3">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            role="switch"
                                            style="width:2.5em;height:1.25em;cursor:pointer;"
                                            wire:click="togglePermission({{ $permission->id_permission }})"
                                            {{ ($userPermissions[$permission->id_permission] ?? false) ? 'checked' : '' }}>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @empty
                            <div class="text-center py-5 text-muted opacity-50">
                                <i class="ti ti-search fs-1 d-block mb-2"></i>
                                Permission tidak ditemukan
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Permission CRUD Modal -->
    <div wire:ignore.self class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg modal-dark-fix">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fw-bold text-white" id="permissionModalLabel">
                        {{ $editingPermissionId ? 'Edit Permission' : 'Add New Permission' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" wire:click="resetForm"></button>
                </div>
                <form wire:submit.prevent="savePermission">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-muted">PERMISSION NAME</label>
                            <input type="text" class="form-control modal-input @error('permissionForm.permission_name') is-invalid @enderror"
                                placeholder="e.g. user.view" wire:model="permissionForm.permission_name">
                            @error('permissionForm.permission_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-muted">DESCRIPTION</label>
                            <input type="text" class="form-control modal-input @error('permissionForm.permission_description') is-invalid @enderror"
                                placeholder="e.g. View User List" wire:model="permissionForm.permission_description">
                            @error('permissionForm.permission_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-semibold small text-muted">MODULE / CATEGORY</label>
                            <input type="text" class="form-control modal-input @error('permissionForm.module') is-invalid @enderror"
                                placeholder="e.g. User" wire:model="permissionForm.module">
                            @error('permissionForm.module') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal" wire:click="resetForm">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            <i class="ti ti-device-floppy me-1"></i> {{ $editingPermissionId ? 'Update Permission' : 'Save Permission' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalEl = document.getElementById('permissionModal');
            let modalInstance = null;

            if (modalEl) {
                modalInstance = new bootstrap.Modal(modalEl);
            }

            window.addEventListener('openPermissionModal', () => {
                if (modalInstance) modalInstance.show();
            });

            window.addEventListener('closePermissionModal', () => {
                if (modalInstance) modalInstance.hide();
            });
        });
    </script>

    <style>
        /* Card & Layout Fixes */
        .card {
            background-color: var(--bs-card-bg, #fff);
            border: 1px solid var(--bs-border-color, #e5e7eb) !important;
        }

        /* Dark Mode Specific Improvements */
        [data-pc-theme="dark"] .permission-management {
            color: #e5e7eb;
        }

        [data-pc-theme="dark"] .card {
            background-color: #1a202c !important;
        }

        [data-pc-theme="dark"] .bg-light,
        [data-pc-theme="dark"] .search-bar-container {
            background-color: #171c26 !important;
        }

        [data-pc-theme="dark"] .module-header {
            background-color: #212836 !important;
        }

        [data-pc-theme="dark"] .permission-desc {
            color: #f3f4f6 !important;
        }

        /* User List Dark Mode Fixes */
        [data-pc-theme="dark"] .user-list-item {
            border-bottom-color: #2d3748 !important;
        }

        [data-pc-theme="dark"] .user-list-item .fw-semibold {
            color: #f3f4f6 !important;
        }

        [data-pc-theme="dark"] .user-list-item .text-muted,
        [data-pc-theme="dark"] .user-list-item div[style*="opacity:0.75"] {
            color: #9ca3af !important;
            opacity: 1 !important;
        }

        [data-pc-theme="dark"] .user-list-item.bg-primary .fw-semibold,
        [data-pc-theme="dark"] .user-list-item.bg-primary div[style*="opacity:0.75"] {
            color: #ffffff !important;
        }

        [data-pc-theme="dark"] .search-input {
            background-color: #1a202c !important;
            border-color: #2d3748 !important;
            color: #fff !important;
        }

        [data-pc-theme="dark"] .search-icon-bg {
            background-color: #2d3748 !important;
            border-color: #2d3748 !important;
            color: #fff !important;
        }

        [data-pc-theme="dark"] .input-group-text i {
            color: #9ca3af !important;
        }

        [data-pc-theme="dark"] .modal-dark-fix {
            background-color: #1a202c !important;
        }

        [data-pc-theme="dark"] .modal-input {
            background-color: #2d3748 !important;
            border-color: #4a5568 !important;
            color: #fff !important;
        }

        [data-pc-theme="dark"] .permission-row {
            border-bottom-color: #2d3748 !important;
        }

        [data-pc-theme="dark"] .border-bottom {
            border-color: #2d3748 !important;
        }

        /* General Interactive Elements */
        .permission-row:hover {
            background-color: var(--bs-primary-bg-subtle, rgba(37, 99, 235, 0.05)) !important;
        }

        .user-list-item:hover {
            background-color: var(--bs-primary-bg-subtle, rgba(37, 99, 235, 0.07)) !important;
        }

        .action-btn:hover {
            background-color: var(--bs-primary-bg-subtle, rgba(37, 99, 235, 0.1)) !important;
        }

        /* Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        [data-pc-theme="dark"] ::-webkit-scrollbar-thumb {
            background: #4a5568;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .btn-link-primary {
            color: var(--bs-primary);
            background: transparent;
        }

        .btn-link-primary:hover {
            border-color: var(--bs-primary) !important;
            background: var(--bs-primary-bg-subtle);
        }

        .btn-link-danger {
            color: var(--bs-danger);
            background: transparent;
        }

        .btn-link-danger:hover {
            border-color: var(--bs-danger) !important;
            background: var(--bs-danger-bg-subtle);
        }

        .module-header {
            background-color: #f8f9fa;
        }
    </style>
</div>