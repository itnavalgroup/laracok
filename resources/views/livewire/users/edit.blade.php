<div class="user-edit">


    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">DASHBOARD</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none">USER</a></li>
                    <li class="breadcrumb-item active">EDIT USER</li>
                </ol>
            </nav>

            <div class="card edit-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold"><i class="ti ti-user-edit me-2"></i>EDIT USER</h4>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                        <i class="ti ti-arrow-left me-1"></i> Back to List
                    </a>
                </div>
                <div class="card-body p-4 p-md-5">
                    <!-- Profile Header -->
                    <div class="user-profile-header">
                        <h6 class="text-white-50 mb-1">EDITING PROFILE</h6>
                        <h3 class="mb-0 fw-bold">{{ $name }}</h3>
                        <p class="mb-0 mt-1 small opacity-75">ID: {{ $id_employee }} | Level: {{ $levelName }}</p>
                    </div>


                    <form wire:submit.prevent="save">
                        <!-- Photo Section -->
                        <div class="form-section">
                            <div class="section-header d-flex align-items-center">
                                <i class="ti ti-camera me-2 text-primary"></i>
                                <h5 class="mb-0">Profile Photo</h5>
                            </div>
                            <div class="d-flex align-items-center flex-column flex-md-row text-center text-md-start">
                                <div class="photo-preview-container mb-3 mb-md-0 position-relative">
                                    @if ($croppedPhoto)
                                    <img src="{{ $croppedPhoto }}" class="h-100 w-100 object-fit-cover rounded-circle">
                                    @elseif ($existingPhoto)
                                    <img src="{{ asset('storage/image/' . $existingPhoto) }}" class="h-100 w-100 object-fit-cover rounded-circle shadow-sm">
                                    @elseif ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" class="h-100 w-100 object-fit-cover rounded-circle shadow-sm">
                                    @else
                                    <div class="h-100 w-100 d-flex align-items-center justify-content-center bg-light rounded-circle shadow-inner">
                                        <i class="ti ti-user fs-1 text-muted"></i>
                                    </div>
                                    @endif
                                    <label class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle p-0 shadow" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; transform: translate(10%, 10%);">
                                        <i class="ti ti-pencil"></i>
                                        <input type="file" id="photoInput" class="d-none" accept="image/*">
                                    </label>
                                </div>
                                <div class="ms-md-4">
                                    <h6 class="fw-bold mb-1">Update Avatar</h6>
                                    <p class="modern-text-muted small mb-0">Click the pencil icon to upload and crop.</p>
                                    @error('photo') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="form-section">
                            <div class="section-header d-flex align-items-center">
                                <i class="ti ti-user-circle me-2 text-primary"></i>
                                <h5 class="mb-0">Personal Information</h5>
                            </div>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="id_employee" {{ $canEditSecurity ? '' : 'readonly' }} placeholder="e.g. SBB-0000">
                                    @error('id_employee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="Enter Full Name">
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label d-flex justify-content-between align-items-center">
                                        <span>Email Address <span class="text-danger">*</span></span>
                                        <button type="button" class="btn btn-link btn-sm p-0 text-decoration-none fw-bold" wire:click="addEmail">
                                            <i class="ti ti-plus me-1"></i>Add More
                                        </button>
                                    </label>
                                    @foreach($emails as $index => $emailItem)
                                    <div class="input-group @if(!$loop->last) mb-2 @endif @if($emailItem['isUsed']) locked-row @endif">
                                        <span class="input-group-text bg-light border-end-0"><i class="ti ti-mail text-muted"></i></span>
                                        <input type="email" class="form-control @error('emails.'.$index.'.email') is-invalid @enderror" wire:model="emails.{{ $index }}.email" placeholder="example@navalgroup.com" {{ $emailItem['isUsed'] ? 'readonly' : '' }}>
                                        @if($emailItem['isUsed'])
                                        <span class="input-group-text bg-light border-start-0 text-warning" title="Used in Transactions"><i class="ti ti-lock"></i></span>
                                        @else
                                        @if(count($emails) > 1)
                                        <button class="btn btn-outline-danger border-start-0" type="button" wire:click="removeEmail({{ $index }})">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                        @endif
                                        @endif
                                    </div>
                                    @error('emails.'.$index.'.email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">NIK</label>
                                    <input type="text" class="form-control" wire:model="nik" placeholder="Citizen ID">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">NPWP</label>
                                    <input type="text" class="form-control" wire:model="npwp" placeholder="Tax ID">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text">62</span>
                                        <input type="text" class="form-control" wire:model="phone" placeholder="8123xxx">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Company Information -->
                        <div class="form-section">
                            <div class="section-header d-flex align-items-center">
                                <i class="ti ti-building me-2 text-primary"></i>
                                <h5 class="mb-0">Company Information</h5>
                            </div>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Access Level <span class="text-danger">*</span></label>
                                    <select class="form-select @error('level') is-invalid @enderror" wire:model="level" {{ $canEditSecurity ? '' : 'disabled' }}>
                                        <option value="">Select Level</option>
                                        @foreach($levels as $l)
                                        <option value="{{ $l->level }}">{{ $l->level_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Department <span class="text-danger">*</span></label>
                                    <select class="form-select @error('id_departement') is-invalid @enderror" wire:model="id_departement" {{ $canEditSecurity ? '' : 'disabled' }}>
                                        <option value="">Select Department</option>
                                        @foreach($departements as $d)
                                        <option value="{{ $d->id_departement }}">{{ $d->departement }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_departement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Position <span class="text-danger">*</span></label>
                                    <select class="form-select @error('id_position') is-invalid @enderror" wire:model="id_position" {{ $canEditSecurity ? '' : 'disabled' }}>
                                        <option value="">Select Position</option>
                                        @foreach($positions as $p)
                                        <option value="{{ $p->id_position }}">{{ $p->position }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Supervisor</label>
                                    <select class="form-select" wire:model="supervisor" {{ $canEditSecurity ? '' : 'disabled' }}>
                                        <option value="">None</option>
                                        @foreach($supervisors as $s)
                                        <option value="{{ $s->id_user }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-uppercase small fw-bold">Warehouse (Optional)</label>
                                    <select class="form-select @error('id_warehouse') is-invalid @enderror" wire:model="id_warehouse" {{ $canEditSecurity ? '' : 'disabled' }}>
                                        <option value="">No Warehouse</option>
                                        @foreach($warehouses as $w)
                                        <option value="{{ $w->id_warehouse }}">{{ $w->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_warehouse') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block">Account Status</label>
                                    <div class="d-flex gap-4 pt-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="active" value="1" wire:model="is_active" {{ $canEditSecurity ? '' : 'disabled' }}>
                                            <label class="form-check-label text-success fw-bold" for="active">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="inactive" value="0" wire:model="is_active" {{ $canEditSecurity ? '' : 'disabled' }}>
                                            <label class="form-check-label text-danger fw-bold" for="inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Banking Information -->
                        <div class="form-section">
                            <div class="section-header d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="ti ti-building-bank me-2 text-primary"></i>
                                    <h5 class="mb-0">Banking Information</h5>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" wire:click="addBankAccount">
                                    <i class="ti ti-plus me-1"></i> Add Account
                                </button>
                            </div>

                            @if(empty($bankAccounts))
                            <div class="text-center py-4 bg-light-subtle rounded-3 mb-3 border border-dashed opacity-75">
                                <i class="ti ti-info-circle fs-3 text-muted mb-2"></i>
                                <p class="text-muted small mb-0">No bank accounts added yet.</p>
                            </div>
                            @endif

                            @foreach($bankAccounts as $index => $bank)
                            <div class="card mb-3 border shadow-none bg-light-subtle rounded-3 overflow-hidden bank-account-card @if($bank['isUsed']) locked-row @endif">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0 fw-bold text-primary small me-2">REKENING #{{ $index + 1 }}</h6>
                                            @if($bank['isUsed'])
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle py-1 px-2 rounded-pill small" style="font-size: 0.65rem;">
                                                <i class="ti ti-lock me-1"></i> LOCKED
                                            </span>
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light text-danger rounded-circle p-0" style="width: 28px; height: 28px;" wire:click="removeBankAccount({{ $index }})" {{ $bank['isUsed'] ? 'disabled' : '' }}>
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label small text-muted mb-1">Bank Name</label>
                                            <input type="text" class="form-control form-control-sm bg-white" wire:model="bankAccounts.{{ $index }}.nama_bank" placeholder="e.g. OCB / BCA" {{ $bank['isUsed'] ? 'readonly' : '' }}>
                                            @error('bankAccounts.'.$index.'.nama_bank') <span class="text-danger smaller">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small text-muted mb-1">Account Holder</label>
                                            <input type="text" class="form-control form-control-sm bg-white" wire:model="bankAccounts.{{ $index }}.nama_penerima" placeholder="Full Name" {{ $bank['isUsed'] ? 'readonly' : '' }}>
                                            @error('bankAccounts.'.$index.'.nama_penerima') <span class="text-danger smaller">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small text-muted mb-1">Account Number</label>
                                            <input type="text" class="form-control form-control-sm bg-white" wire:model="bankAccounts.{{ $index }}.norek" placeholder="Number only" {{ $bank['isUsed'] ? 'readonly' : '' }}>
                                            @error('bankAccounts.'.$index.'.norek') <span class="text-danger smaller">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-5 pt-4 border-top d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <div>
                                @if($canEditSecurity)
                                <button type="button"
                                    onclick="showConfirm({
                                        title: 'Reset Password',
                                        message: 'Apakah Anda yakin ingin meriset password user ini ke default (12345678)?',
                                        type: 'danger',
                                        onConfirm: () => @this.resetPassword()
                                    })"
                                    class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                    <i class="ti ti-refresh me-1"></i> Reset Password
                                </button>
                                @endif
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary px-4 rounded-pill py-2">Cancel</a>
                                <button type="button"
                                    onclick="showConfirm({
                                        title: 'Simpan Perubahan',
                                        message: 'Simpan pembaruan data user ini?',
                                        type: 'primary',
                                        onConfirm: () => @this.save()
                                    })"
                                    class="btn btn-primary px-5 rounded-pill shadow-sm py-2">
                                    <i class="ti ti-device-floppy me-2"></i> Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cropping Modal -->
    <div class="modal fade" id="croppingModal" tabindex="-1" aria-labelledby="croppingModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="croppingModalLabel">Crop Profile Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div style="max-height: 500px; overflow: hidden;">
                        <img id="imageToCrop" style="max-width: 100%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="cropButton">Crop & Save</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            const photoInput = document.getElementById('photoInput');
            const croppingModal = new bootstrap.Modal(document.getElementById('croppingModal'));
            const imageToCrop = document.getElementById('imageToCrop');
            const cropButton = document.getElementById('cropButton');
            let cropper;

            photoInput.addEventListener('change', function(e) {
                const files = e.target.files;
                if (files && files.length > 0) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imageToCrop.src = e.target.result;
                        croppingModal.show();
                    };
                    reader.readAsDataURL(files[0]);
                }
            });

            document.getElementById('croppingModal').addEventListener('shown.bs.modal', function() {
                cropper = new Cropper(imageToCrop, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 1,
                    restore: false,
                    guides: true,
                    center: true,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                });
            });

            document.getElementById('croppingModal').addEventListener('hidden.bs.modal', function() {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                photoInput.value = '';
            });

            cropButton.addEventListener('click', function() {
                if (cropper) {
                    const canvas = cropper.getCroppedCanvas({
                        width: 400,
                        height: 400,
                    });
                    const base64 = canvas.toDataURL('image/png');
                    @this.set('croppedPhoto', base64);
                    croppingModal.hide();
                }
            });
        });
    </script>
    @endpush
</div>