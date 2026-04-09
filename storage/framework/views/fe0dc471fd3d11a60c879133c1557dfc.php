<!-- [ Header Topbar ] start -->
<header class="pc-header">
    <div class="header-wrapper">
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-arrows-right-left"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-indent-increase"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="ms-auto d-flex align-items-center">
            <div id="ikb-header-actions" class="d-flex align-items-center gap-2 me-2"></div>
            <div id="pr-header-actions" class="d-flex align-items-center gap-2 me-2"></div>
            <div id="sr-header-actions" class="d-flex align-items-center gap-2 me-2"></div>
            <div id="production-header-actions" class="d-flex align-items-center gap-2 me-2"></div>
            <ul class="list-unstyled mb-0 d-flex align-items-center">
                <li class="pc-h-item">
                    <a href="#!" class="pc-head-link me-0" id="dark-mode-toggle">
                        <i class="ti ti-moon dark-icon"></i>
                        <i class="ti ti-sun light-icon d-none"></i>
                    </a>
                </li>
                <li class="dropdown pc-h-item header-user-profile">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        data-bs-auto-close="outside"
                        aria-expanded="false">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->photo): ?>
                        <img src="<?php echo e(asset('storage/image/' . auth()->user()->photo)); ?>" alt="user-image" class="user-avtar">
                        <?php else: ?>
                        <img src="<?php echo e(asset('assets/images/user/avatar-2.jpg')); ?>" alt="user-image" class="user-avtar">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <span><?php echo e(auth()->user()->position->position ?? 'User'); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header">
                            <div class="d-flex mb-1">
                                <div class="flex-shrink-0">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->photo): ?>
                                    <img src="<?php echo e(asset('storage/image/' . auth()->user()->photo)); ?>" alt="user-image" class="user-avtar wid-35">
                                    <?php else: ?>
                                    <img src="<?php echo e(asset('assets/images/user/avatar-2.jpg')); ?>" alt="user-image" class="user-avtar wid-35">
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 text-wrap"><?php echo e(auth()->user()->name); ?></h6>
                                    <span><?php echo e(auth()->user()->position->position ?? 'User'); ?></span>
                                </div>
                                <form method="POST" action="<?php echo e(route('logout')); ?>" id="logout-form" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="pc-head-link bg-transparent">
                                    <i class="ti ti-power text-danger"></i>
                                </a>
                            </div>
                        </div>
                        <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link active"
                                    id="drp-t1"
                                    data-bs-toggle="tab"
                                    data-bs-target="#drp-tab-1"
                                    type="button"
                                    role="tab"
                                    aria-controls="drp-tab-1"
                                    aria-selected="true"><i class="ti ti-user"></i> Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link"
                                    id="drp-t2"
                                    data-bs-toggle="tab"
                                    data-bs-target="#drp-tab-2"
                                    type="button"
                                    role="tab"
                                    aria-controls="drp-tab-2"
                                    aria-selected="false"><i class="ti ti-help"></i> Help</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="mysrpTabContent">
                            <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                                <a href="#" class="dropdown-item">
                                    <i class="ti ti-edit-circle"></i>
                                    <span>Edit Password</span>
                                </a>
                                <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                                    <i class="ti ti-user"></i>
                                    <span>Edit Profile</span>
                                </a>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                                    <i class="ti ti-power"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                            <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2" tabindex="0">
                                <a href="https://wa.me/6282199005570" target="_blank" class="dropdown-item">
                                    <i class="ti ti-help"></i>
                                    <span>Support</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<?php /**PATH D:\!Kerja\laracok - Copy\resources\views\layouts\header.blade.php ENDPATH**/ ?>