<div class="user-show user-edit">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">DASHBOARD</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none">USER</a></li>
                    <li class="breadcrumb-item active">USER DETAILS</li>
                </ol>
            </nav>

            <div class="card edit-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold"><i class="ti ti-user-check me-2"></i>USER DETAILS</h4>
                    <div class="d-flex gap-2">
                        @if(auth()->user()->canEditUser($user))
                        <a href="{{ route('users.edit', hashid_encode($user->id_user)) }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                            <i class="ti ti-edit me-1"></i> Edit User
                        </a>
                        @endif
                        <a href="{{ route('users.index') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                            <i class="ti ti-arrow-left me-1"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    <!-- Profile Header -->
                    <div class="user-profile-header">
                        <h6 class="text-white-50 mb-1">USER PROFILE</h6>
                        <h3 class="mb-0 fw-bold">{{ $user->name }}</h3>
                        <p class="mb-0 mt-1 small opacity-75">ID: {{ $user->id_employee }} | Level: {{ $user->level_detail->level_name ?? '-' }}</p>
                    </div>

                    <!-- Photo Section -->
                    <div class="form-section">
                        <div class="section-header d-flex align-items-center">
                            <i class="ti ti-camera me-2 text-primary"></i>
                            <h5 class="mb-0">Profile Photo</h5>
                        </div>
                        <div class="d-flex align-items-center flex-column flex-md-row text-center text-md-start">
                            <div class="photo-preview-container mb-3 mb-md-0 shadow-sm rounded-circle me-md-4">
                                @if ($user->photo)
                                <img src="{{ asset('storage/image/' . $user->photo) }}" class="h-100 w-100 object-fit-cover rounded-circle">
                                @else
                                <div class="h-100 w-100 d-flex align-items-center justify-content-center bg-light rounded-circle shadow-inner">
                                    <i class="ti ti-user fs-2 text-muted"></i>
                                </div>
                                @endif
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">{{ $user->name }}</h6>
                                <p class="modern-text-muted small mb-0">{{ $user->position->position ?? 'No Position Assigned' }}</p>
                                <span class="badge {{ $user->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} rounded-pill mt-2">
                                    {{ $user->is_active ? 'ACCOUNT ACTIVE' : 'ACCOUNT INACTIVE' }}
                                </span>
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
                                <label class="form-label small">Employee ID</label>
                                <input type="text" class="form-control" value="{{ $user->id_employee }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Full Name</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small">Email Addresses</label>
                                @foreach($user->emails as $email)
                                <div class="input-group mb-2">
                                    <span class="input-group-text bg-light"><i class="ti ti-mail text-muted"></i></span>
                                    <input type="email" class="form-control" value="{{ $email->email }}" readonly>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">NIK</label>
                                <input type="text" class="form-control" value="{{ $nik ?: '-' }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">NPWP</label>
                                <input type="text" class="form-control" value="{{ $npwp ?: '-' }}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text">62</span>
                                    <input type="text" class="form-control" value="{{ $user->phone ?: '-' }}" readonly>
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
                                <label class="form-label small">Access Level</label>
                                <input type="text" class="form-control" value="{{ $user->level_detail->level_name ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Department</label>
                                <input type="text" class="form-control" value="{{ $user->departement->departement ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Warehouse</label>
                                <input type="text" class="form-control" value="{{ $user->warehouse->warehouse_name ?? 'No Warehouse' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Position</label>
                                <input type="text" class="form-control" value="{{ $user->position->position ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">Supervisor</label>
                                <input type="text" class="form-control" value="{{ $user->boss->name ?? 'None' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Banking Information -->
                    <div class="form-section border-0">
                        <div class="section-header d-flex align-items-center">
                            <i class="ti ti-building-bank me-2 text-primary"></i>
                            <h5 class="mb-0">Banking Information</h5>
                        </div>

                        @if($user->bankAccounts->isEmpty())
                        <div class="text-center py-4 bg-light-subtle rounded-3 mb-3 border border-dashed opacity-75">
                            <i class="ti ti-info-circle fs-3 text-muted mb-2"></i>
                            <p class="text-muted small mb-0">No bank accounts registered.</p>
                        </div>
                        @else
                        @foreach($user->bankAccounts as $index => $bank)
                        <div class="card mb-3 border shadow-none bg-light-subtle rounded-3 overflow-hidden bank-account-card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center mb-3">
                                    <h6 class="mb-0 fw-bold text-primary small me-2">ACCOUNT #{{ $index + 1 }}</h6>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label small text-muted mb-1">Bank Name</label>
                                        <input type="text" class="form-control form-control-sm bg-white" value="{{ $bank->nama_bank }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small text-muted mb-1">Account Holder</label>
                                        <input type="text" class="form-control form-control-sm bg-white" value="{{ $bank->nama_penerima }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small text-muted mb-1">Account Number</label>
                                        <input type="text" class="form-control form-control-sm bg-white" value="{{ $bank->norek }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>