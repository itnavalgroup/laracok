<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary">
                <img src="<?php echo e(asset('assets/images/logo-dashboard.png')); ?>" class="img-fluid" alt="logo">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="<?php echo e(route('dashboard')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>DataBase</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('user.view.all') || auth()->user()->hasPermission('user.view.dept') || auth()->user()->hasPermission('user.view.subordinate')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('users.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user"></i></span>
                        <span class="pc-mtext">User</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('user.permission')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('permissions.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-shield-lock"></i></span>
                        <span class="pc-mtext">Permissions</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('vendor.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('vendors.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-users"></i></span>
                        <span class="pc-mtext">Vendor</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('company.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('companies.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-building-community"></i></span>
                        <span class="pc-mtext">Company</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('branch.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('branches.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-building-bank"></i></span>
                        <span class="pc-mtext">Branch</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('warehouse.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('warehouses.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-building-warehouse"></i></span>
                        <span class="pc-mtext">Warehouse</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('uom.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('uoms.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-ruler"></i></span>
                        <span class="pc-mtext">UOM</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('package.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('packages.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-package"></i></span>
                        <span class="pc-mtext">Package</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('dept.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('departements.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-hierarchy-2"></i></span>
                        <span class="pc-mtext">Departemen</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('position.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('positions.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-man"></i></span>
                        <span class="pc-mtext">Position</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('doc_type.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('doc-types.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file-text"></i></span>
                        <span class="pc-mtext">Document Type</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('currency.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('currencies.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-currency-dollar"></i></span>
                        <span class="pc-mtext">Currency</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('cost_category.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('cost-categories.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-hierarchy"></i></span>
                        <span class="pc-mtext">Cost Category</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('cost_type.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('cost-types.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-receipt"></i></span>
                        <span class="pc-mtext">Cost Type</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('attachment.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('attachments.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-attachment"></i></span>
                        <span class="pc-mtext">Attachment</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('loan.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('loans.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-loan"></i></span>
                        <span class="pc-mtext">Loan</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('tax_type.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('tax-types.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-receipt"></i></span>
                        <span class="pc-mtext">Tax Type</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('tax.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('taxes.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-receipt-2"></i></span>
                        <span class="pc-mtext">Tax</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('pr.view.all') || auth()->user()->hasPermission('pr.view.dept') || auth()->user()->hasPermission('pr.view.subordinate')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('payment-requests.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="fab fa-pied-piper-pp"></i></span>
                        <span class="pc-mtext">Payment Request</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('sr.view.all') || auth()->user()->hasPermission('sr.view.dept') || auth()->user()->hasPermission('sr.view.subordinate')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('settlement-reports.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file-invoice"></i></span>
                        <span class="pc-mtext">Settlement Report</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('contract.view') || auth()->user()->hasPermission('contract.view.dept') || auth()->user()->hasPermission('contract.view.subordinate') || auth()->user()->hasPermission('contract.create')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('contracts.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file-certificate"></i></span>
                        <span class="pc-mtext">Contract</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <li class="pc-item pc-caption">
                    <label>Inventory</label>
                    <i class="ti ti-box"></i>
                </li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_category.view')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('item-categories.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-box"></i></span>
                        <span class="pc-mtext">Item Category</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('item.view.all') || auth()->user()->hasPermission('item.view.warehouse') || auth()->user()->hasPermission('item.view.subordinate')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('items.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-items"></i></span>
                        <span class="pc-mtext">Item</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('item_transaction.view.all') || auth()->user()->hasPermission('item_transaction.view.warehouse') || auth()->user()->hasPermission('item_transaction.view.subordinate')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('item-transactions.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-transaction"></i></span>
                        <span class="pc-mtext">Item Transaction</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('ikb.view.all') || auth()->user()->hasPermission('ikb.view.warehouse') || auth()->user()->hasPermission('ikb.view.subordinate') || auth()->user()->hasPermission('ikb.view.dept')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('ikb.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-box"></i></span>
                        <span class="pc-mtext">IKB</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->level === 1 || auth()->user()->hasPermission('production.view.all') || auth()->user()->hasPermission('production.view.warehouse') || auth()->user()->hasPermission('production.view.dept')): ?>
                <li class="pc-item">
                    <a href="<?php echo e(route('production.index')); ?>" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-tools"></i></span>
                        <span class="pc-mtext">Production</span>
                    </a>
                </li>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <li class="pc-item pc-caption">
                    <label>Panduan</label>
                    <i class="ti ti-book"></i>
                </li>
                <li class="pc-item">
                    <a href="<?php echo e(asset('documentation/index.html')); ?>" class="pc-link" target="_blank">
                        <span class="pc-micon"><i class="ti ti-book-2"></i></span>
                        <span class="pc-mtext">Documentation</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end --><?php /**PATH D:\!Kerja\laracok - Copy\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>