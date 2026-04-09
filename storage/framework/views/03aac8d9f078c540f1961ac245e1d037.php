<div class="login-page-wrapper">
    <div class="login-container">
        <!-- Left Side - Illustration -->
        <div class="login-illustration d-none d-lg-flex">
            <i class="ti ti-lock-access fs-1 illustration-icon"></i>
            <h2 class="text-white fw-bold">Welcome Back!</h2>
            <p class="text-white opacity-75">Sign in to access your dashboard and manage your account</p>
            <div class="mt-4 text-center">
                <i class="ti ti-shield-check fs-2 opacity-50"></i>
                <p class="mt-2 text-white small">Secure & Reliable Platform</p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-form">
            <div class="logo-container mb-4 text-center">
                <img src="<?php echo e(asset('assets/images/logo-dashboard.png')); ?>" alt="Logo" class="img-fluid" style="max-height: 60px;">
            </div>

            <div class="login-header mb-4 text-center">
                <h3 class="fw-bold">Login to Account</h3>
                <p class="text-muted">Enter your credentials to continue</p>
            </div>


            <form wire:submit.prevent="login">
                <div class="mb-4">
                    <label class="form-label fw-semibold">Employee ID</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text bg-light border-end-0"><i class="ti ti-id"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Enter Employee ID" wire:model="id_employee" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text bg-light border-end-0"><i class="ti ti-lock"></i></span>
                        <input type="password" class="form-control border-start-0 ps-0" placeholder="Enter Password" wire:model="password" required>
                    </div>
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe" wire:model="remember">
                        <label class="form-check-label text-muted small" for="rememberMe">Remember me</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 shadow-sm fw-bold mb-4" wire:loading.attr="disabled">
                    <span wire:loading.remove><i class="ti ti-login me-2"></i> Sign In</span>
                    <span wire:loading><i class="ti ti-loader-2 animate-spin me-2"></i> Processing...</span>
                </button>
            </form>

            <div class="separator text-center my-4 position-relative">
                <span class="bg-white px-3 text-muted small position-relative z-index-1">Need Help?</span>
                <div class="border-bottom position-absolute top-50 start-0 end-0"></div>
            </div>

            <div class="text-center">
                <a href="https://wa.me/6282199005570" target="_blank" class="btn btn-outline-success border-0 rounded-pill px-4">
                    <i class="ti ti-brand-whatsapp me-2"></i> Chat with Support
                </a>
            </div>

            <div class="text-center mt-3">
                <a href="<?php echo e(asset('documentation/index.html')); ?>" class="btn btn-outline-secondary border-0 rounded-pill px-4">
                    <i class="ti ti-book me-2"></i> Lihat Dokumentasi
                </a>
            </div>

            <div class="footer-text text-center mt-5 text-muted small">
                <p class="mb-0">&copy; <?php echo e(date('Y')); ?> Naval Group. All rights reserved.</p>
            </div>
        </div>
    </div>

    <style>
        .login-page-wrapper {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Public Sans', sans-serif;
        }

        .login-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .login-illustration {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .illustration-icon {
            font-size: 6rem;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.8);
        }

        .login-form {
            flex: 1;
            padding: 60px;
            background: white;
        }

        .input-group-text {
            color: #6c757d;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #667eea;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.4);
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 991px) {
            .login-container {
                max-width: 500px;
            }

            .login-form {
                padding: 40px;
            }
        }
    </style>
</div><?php /**PATH D:\!Kerja\laracok - Copy\resources\views\livewire\auth\login.blade.php ENDPATH**/ ?>