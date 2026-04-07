<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;


// Public route — accessible to everyone (guest & auth)
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect('/documentation/index.html');
});

Route::get('/documentation', function () {
    return redirect('/documentation/index.html');
})->name('documentation');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', \App\Livewire\Users\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Users\Create::class)->name('create');
        Route::get('/edit/{hash}', \App\Livewire\Users\Edit::class)->name('edit');
        Route::get('/{hash}', \App\Livewire\Users\Show::class)->name('show');
    });

    Route::get('/profile', \App\Livewire\Profile\Edit::class)->name('profile.edit');
    Route::get('/permissions', \App\Livewire\Permissions\Index::class)->name('permissions.index');
    Route::get('/companies', \App\Livewire\Companies\Index::class)->name('companies.index');
    Route::get('/branches', \App\Livewire\Branches\Index::class)->name('branches.index');
    Route::get('/uoms', \App\Livewire\Uoms\Index::class)->name('uoms.index');
    Route::get('/positions', \App\Livewire\Positions\Index::class)->name('positions.index');
    Route::get('/departements', \App\Livewire\Departements\Index::class)->name('departements.index');
    Route::get('/packages', \App\Livewire\Packages\Index::class)->name('packages.index');
    Route::get('/warehouses', \App\Livewire\Warehouses\Index::class)->name('warehouses.index');
    Route::get('/vendors', \App\Livewire\Vendors\Index::class)->name('vendors.index');
    Route::get('/currencies', \App\Livewire\Currencies\Index::class)->name('currencies.index');
    Route::get('/cost-categories', \App\Livewire\CostCategories\Index::class)->name('cost-categories.index');
    Route::get('/cost-types', \App\Livewire\CostTypes\Index::class)->name('cost-types.index');
    Route::get('/doc-types', \App\Livewire\DocTypes\Index::class)->name('doc-types.index');
    Route::get('/loans', \App\Livewire\Loans\Index::class)->name('loans.index');
    Route::get('/tax-types', \App\Livewire\TaxTypes\Index::class)->name('tax-types.index');
    Route::get('/taxes', \App\Livewire\Taxes\Index::class)->name('taxes.index');
    Route::get('/attachments', \App\Livewire\Attachments\Index::class)->name('attachments.index');
    Route::get('/item-categories', \App\Livewire\ItemCategories\Index::class)->name('item-categories.index');
    Route::get('/items', \App\Livewire\Items\Index::class)->name('items.index');
    Route::get('/item-transactions', \App\Livewire\ItemTransactions\Index::class)->name('item-transactions.index');
    Route::get('/item-transactions/{hash}', \App\Livewire\ItemTransactions\Show::class)->name('item-transactions.show');

    // =========================================================================
    // PAYMENT REQUEST ROUTES - Sesuai CI4 Pr.php
    // =========================================================================
    Route::prefix('payment-requests')->name('payment-requests.')->group(function () {

        // INDEX
        Route::get('/', \App\Livewire\PaymentRequests\Index::class)->name('index');

        // DOWNLOAD / PRINT PR (pdfcanvas)
        Route::get('/{hash}/download', function ($hash) {
            $id = hashid_decode($hash, 'pr');
            if (!$id) abort(404);
            $pr = \App\Models\Pr::with([
                'user',
                'departement',
                'company',
                'branch',
                'vendor',
                'details.uom',
                'details.taxType1',
                'details.taxType2',
                'signTransactions.user',
                'currency',
                'docType',
                'costCategory',
                'costType',
                'loan',
                'norek_vendor',
                'emailUser',
                'emailVendor',
                'attachmentPrs.attachment',
                'invoices',
                'payments',
            ])->findOrFail($id);

            $user = auth()->user();
            $canView = $user->level === 1
                || $user->id_user === $pr->id_user
                || $user->hasPermission('pr_detail.view')
                || $user->hasPermission('pr.approve.step1')
                || $user->hasPermission('pr.approve.step2')
                || $user->hasPermission('pr.approve.step3')
                || $user->hasPermission('pr.approve.step4')
                || $user->hasPermission('pr.approve.step5')
                || $user->hasPermission('pr.approve.step6')
                || $user->hasPermission('pr.payment');

            if (!$canView) abort(403);

            $grandTotal = $pr->details->sum('ammount') - floatval($pr->additional_discount ?? 0);
            $paidTotal  = $pr->payments->where('id_doc_type', $pr->id_doc_type)->sum('ammount');
            $balance    = $paidTotal - $grandTotal;

            return view('payment-requests.print', compact('pr', 'grandTotal', 'paidTotal', 'balance'));
        })->name('download');

        // -----------------------------------------------------------------
        // PAYMENT PAGE: /payment-requests/{hash}/payment
        // Level akses: creator PR, level akuntansi/finance, atau pr.payment
        // -----------------------------------------------------------------
        Route::get('/{hash}/payment', \App\Livewire\PaymentRequests\PaymentShow::class)->name('payment');

        // -----------------------------------------------------------------
        // INVOICE PAGE: /payment-requests/{hash}/invoice
        // Level akses: creator PR atau pr_invoice.view
        // -----------------------------------------------------------------
        Route::get('/{hash}/invoice', \App\Livewire\PaymentRequests\InvoiceShow::class)->name('invoice');

        // -----------------------------------------------------------------
        // ATTACHMENT PR (simpanattachment, updateattachment, deleteattpr)
        // Disimpan ke public/attachmentpr/
        // -----------------------------------------------------------------
        Route::post('/{hash}/attachment/store', [\App\Http\Controllers\PrAttachmentController::class, 'store'])->name('attachment.store');
        Route::post('/attachment/{id}/update', [\App\Http\Controllers\PrAttachmentController::class, 'update'])->name('attachment.update');
        Route::get('/attachment/{id}/delete', [\App\Http\Controllers\PrAttachmentController::class, 'destroy'])->name('attachment.delete');

        // -----------------------------------------------------------------
        // PAYMENT CRUD (simpanpayment, updatepayment, deletepayment)
        // -----------------------------------------------------------------
        Route::post('/{hash}/payment/store', [\App\Http\Controllers\PaymentController::class, 'store'])->name('payment.store');
        Route::post('/payment/{paymentHash}/update', [\App\Http\Controllers\PaymentController::class, 'update'])->name('payment.update');
        Route::get('/payment/{paymentHash}/delete', [\App\Http\Controllers\PaymentController::class, 'destroy'])->name('payment.delete');
        Route::get('/payment/{paymentHash}/print', [\App\Http\Controllers\PaymentController::class, 'print'])->name('payment.print');
        Route::get('/payment/{paymentHash}/download', [\App\Http\Controllers\PaymentController::class, 'download'])->name('payment.download');

        // Approve payment director (payment_type_pr == 1, status 14 → 9/10)
        Route::post('/{hash}/payment/approve-director', [\App\Http\Controllers\PaymentController::class, 'approveDirector'])->name('payment.approve-director');
        Route::post('/{hash}/payment/cancel-approve-director', [\App\Http\Controllers\PaymentController::class, 'cancelApproveDirector'])->name('payment.cancel-approve-director');

        // Approve payment manager step 1 (payment_type_pr == 1, status 15 → 14)
        Route::post('/{hash}/payment/approve-step1', [\App\Http\Controllers\PaymentController::class, 'approveStep1'])->name('payment.approve.step1');
        Route::post('/{hash}/payment/cancel-approve-step1', [\App\Http\Controllers\PaymentController::class, 'cancelApproveStep1'])->name('payment.cancel-approve.step1');
        Route::post('/{hash}/payment/revision', [\App\Http\Controllers\PaymentController::class, 'revision'])->name('payment.revision');

        // -----------------------------------------------------------------
        // ATTACHMENT PAYMENT (simpanattpayment, updateattpayment, deleteattpayment)
        // Disimpan ke public/attachmentpayment/
        // -----------------------------------------------------------------
        Route::post('/{hash}/attachment-payment/store', [\App\Http\Controllers\PaymentAttachmentController::class, 'store'])->name('attachment-payment.store');
        Route::post('/attachment-payment/{id}/update', [\App\Http\Controllers\PaymentAttachmentController::class, 'update'])->name('attachment-payment.update');
        Route::get('/attachment-payment/{id}/delete', [\App\Http\Controllers\PaymentAttachmentController::class, 'destroy'])->name('attachment-payment.delete');

        // -----------------------------------------------------------------
        // INVOICE CRUD (simpaninvoice, updateinvoice, deleteinvoice)
        // -----------------------------------------------------------------
        Route::post('/{hash}/invoice/store', [\App\Http\Controllers\InvoiceController::class, 'store'])->name('invoice.store');
        Route::post('/invoice/{invoiceHash}/update', [\App\Http\Controllers\InvoiceController::class, 'update'])->name('invoice.update');
        Route::get('/invoice/{invoiceHash}/delete', [\App\Http\Controllers\InvoiceController::class, 'destroy'])->name('invoice.delete');

        // Invoice attachment (simpanattinvoice, updateattinvoice, deleteattinvoice)
        // Disimpan ke public/invoice/
        Route::post('/invoice/{invoiceHash}/attachment/store', [\App\Http\Controllers\InvoiceController::class, 'storeAttachment'])->name('invoice.attachment.store');
        Route::post('/invoice/{invoiceHash}/attachment/update', [\App\Http\Controllers\InvoiceController::class, 'updateAttachment'])->name('invoice.attachment.update');
        Route::get('/invoice/{invoiceHash}/attachment/delete', [\App\Http\Controllers\InvoiceController::class, 'destroyAttachment'])->name('invoice.attachment.delete');

        // Invoice canvas/download PDF
        Route::get('/{hash}/invoice/download', [\App\Http\Controllers\InvoiceController::class, 'canvas'])->name('invoice.download');
        Route::get('/{hash}/invoice/print', [\App\Http\Controllers\InvoiceController::class, 'print'])->name('invoice.print');

        // Invoice show page (Livewire) - must be before /{hash} catch-all
        Route::get('/{hash}/invoice', \App\Livewire\PaymentRequests\InvoiceShow::class)->name('invoice');

        // DETAIL PR - taruh PALING BAWAH agar tidak menimpa route lain
        Route::get('/{hash}', \App\Livewire\PaymentRequests\Show::class)->name('show');
    });


    // =========================================================================
    // IKB (Izin Keluar Barang) ROUTES
    // =========================================================================
    Route::prefix('ikb')->name('ikb.')->group(function () {
        Route::get('/', \App\Livewire\Ikb\Index::class)->name('index');

        // DOWNLOAD / PRINT IKB
        Route::get('/{hash}/download', function ($hash) {
            $id = hashid_decode($hash, 'ikb');
            if (!$id) abort(404);
            $ikb = \App\Models\Ikb::with([
                'user', 'salesUser', 'departement', 'company', 'warehouse', 
                'vendor', 'transactionType', 'details.itemCategory', 'details.item', 'details.uom', 'details.packaging',
                'signTransactions.user'
            ])->findOrFail($id);

            $user = auth()->user();
            $canView = $user->level === 1
                || $user->id_user === $ikb->id_user
                || $user->id_user === $ikb->sales
                || $user->hasPermission('ikb.view.all')
                || $user->hasPermission('ikb.print')
                || $user->hasPermission('ikb.download')
                || ($user->hasPermission('ikb.view.dept') && $user->id_departement === $ikb->id_departement)
                || ($user->hasPermission('ikb.view.warehouse') && $user->id_warehouse === $ikb->id_warehouse)
                || ($user->hasPermission('ikb.view.subordinate') && in_array($ikb->sales, $user->subordinates()->pluck('id_user')->toArray()))
                || $user->hasPermission('ikb.approve.step1')
                || $user->hasPermission('ikb.approve.step2')
                || $user->hasPermission('ikb.approve.step3')
                || $user->hasPermission('ikb.approve.step4')
                || $user->hasPermission('ikb.approve.step5')
                || $user->hasPermission('ikb.approve.step6')
                || $user->hasPermission('ikb.approve.step7')
                || $user->hasPermission('ikb.approve.step8')
                || $user->hasPermission('ikb.approve.step9');

            if (!$canView) abort(403);

            return view('ikb.print', compact('ikb'));
        })->name('download');

        Route::get('/{hash}', \App\Livewire\Ikb\Show::class)->name('show');
        
        Route::post('/{hash}/attachment/store', [\App\Http\Controllers\IkbAttachmentController::class, 'store'])->name('attachment.store');
        Route::post('/attachment/{hash}/update', [\App\Http\Controllers\IkbAttachmentController::class, 'update'])->name('attachment.update');
        Route::get('/attachment/{hash}/delete', [\App\Http\Controllers\IkbAttachmentController::class, 'destroy'])->name('attachment.delete');
    });

    // =========================================================================
    // PRODUCTION ROUTES
    // =========================================================================
    Route::prefix('production')->name('production.')->group(function () {
        Route::get('/', \App\Livewire\Production\Index::class)->name('index');
        
        // DOWNLOAD / PRINT
        Route::get('/{hash}/download', function ($hash) {
            $id = hashid_decode($hash, 'production');
            if (!$id) abort(404);
            
            $production = \App\Models\Production::with([
                'user', 'warehouse', 'departement', 'company',
                'materials.item.category', 'materials.uom', 
                'results.item.category', 'results.uom',
                'processedBy', 'finishedBy', 'canceledBy', 'attachments'
            ])->findOrFail($id);
            
            return view('production.print', compact('production'));
        })->name('download');

        // SHOW
        Route::get('/{hash}', \App\Livewire\Production\Show::class)->name('show');
        
        // ATTACHMENT
        Route::post('/{hash}/attachment/store', [\App\Http\Controllers\ProductionAttachmentController::class, 'store'])->name('attachment.store');
        Route::post('/attachment/{hash}/update', [\App\Http\Controllers\ProductionAttachmentController::class, 'update'])->name('attachment.update');
        Route::get('/attachment/{hash}/delete', [\App\Http\Controllers\ProductionAttachmentController::class, 'destroy'])->name('attachment.delete');
    });

    // =========================================================================
    // JSON API routes untuk form dynamic
    // =========================================================================
    Route::get('/api/vendors/{id}/details', function ($id) {
        $vendor = \App\Models\Vendor::findOrFail($id);
        return response()->json([
            'emails' => \App\Models\VendorEmail::where('id_vendor', $id)->get(['id_email_vendor', 'email']),
            'banks'  => \App\Models\VendorBankAccount::where('id_vendor', $id)->get(['id_norek_vendor', 'nama_bank', 'nama_penerima', 'norek']),
        ]);
    });
    Route::get('/api/cost-categories/{id}/types', function ($id) {
        return response()->json(
            \App\Models\CostType::where('id_cost_category', $id)->get(['id_cost_type', 'cost_type'])
        );
    });
    Route::get('/api/pr/taxes/{typeId}', function ($typeId) {
        $taxes = \App\Models\Tax::where('id_tax_type', $typeId)
            ->where('status', 1)
            ->get(['id_tax', 'tax', 'tax_persen']);
        return response()->json($taxes);
    });

    // =========================================================================
    // SETTLEMENT REPORTS
    // =========================================================================
    Route::prefix('settlement-reports')->name('settlement-reports.')->group(function () {

        // INDEX
        Route::get('/', \App\Livewire\SettlementReports\Index::class)->name('index');

        // DOWNLOAD / PRINT SR
        Route::get('/{hash}/download', function ($hash) {
            $id = hashid_decode($hash, 'sr');
            if (!$id) abort(404);
            $sr = \App\Models\Sr::with([
                'user', 'departement', 'company', 'branch', 'vendor',
                'details.uom', 'details.taxSatu', 'details.taxDua',
                'signTransactions.user', 'docType', 'costCategory', 'costType',
                'loan', 'norekVendor', 'emailUser', 'emailVendor',
                'attachments.attachment', 'pr',
            ])->findOrFail($id);

            $user = auth()->user();
            $canView = $user->level === 1
                || $user->id_user === $sr->id_user
                || $user->hasPermission('sr_detail.view')
                || $user->hasPermission('sr.approve.step1')
                || $user->hasPermission('sr.approve.step2')
                || $user->hasPermission('sr.approve.step3')
                || $user->hasPermission('sr.approve.step4')
                || $user->hasPermission('sr.approve.step5')
                || $user->hasPermission('sr.approve.step6')
                || $user->hasPermission('sr_payment.view');

            if (!$canView) abort(403);

            $grandTotal = $sr->details->sum('ammount') - floatval($sr->additional_discount ?? 0);

            return view('settlement-reports.print', compact('sr', 'grandTotal'));
        })->name('download');

        // PAYMENT PAGE
        Route::get('/{hash}/payment', \App\Livewire\SettlementReports\PaymentShow::class)->name('payment');

        // ATTACHMENT SR CRUD
        Route::post('/{hash}/attachment/store', [\App\Http\Controllers\SrAttachmentController::class, 'store'])->name('attachment.store');
        Route::post('/attachment/{id}/update', [\App\Http\Controllers\SrAttachmentController::class, 'update'])->name('attachment.update');
        Route::get('/attachment/{id}/delete', [\App\Http\Controllers\SrAttachmentController::class, 'destroy'])->name('attachment.delete');

        // PAYMENT SR CRUD
        Route::post('/{hash}/payment/store', [\App\Http\Controllers\SrPaymentController::class, 'store'])->name('payment.store');
        Route::post('/payment/{paymentHash}/update', [\App\Http\Controllers\SrPaymentController::class, 'update'])->name('payment.update');
        Route::get('/payment/{paymentHash}/delete', [\App\Http\Controllers\SrPaymentController::class, 'destroy'])->name('payment.delete');
        Route::get('/payment/{paymentHash}/print', [\App\Http\Controllers\SrPaymentController::class, 'print'])->name('payment.print');
        Route::get('/payment/{paymentHash}/download', [\App\Http\Controllers\SrPaymentController::class, 'download'])->name('payment.download');

        // ATTACHMENT PAYMENT SR
        Route::post('/{hash}/attachment-payment/store', [\App\Http\Controllers\SrPaymentAttachmentController::class, 'store'])->name('attachment-payment.store');
        Route::post('/attachment-payment/{id}/update', [\App\Http\Controllers\SrPaymentAttachmentController::class, 'update'])->name('attachment-payment.update');
        Route::get('/attachment-payment/{id}/delete', [\App\Http\Controllers\SrPaymentAttachmentController::class, 'destroy'])->name('attachment-payment.delete');

        // CREATE SR (dari PR hash)
        Route::get('/create/{prHash}', \App\Livewire\SettlementReports\Form::class)->name('create');

        // EDIT SR
        Route::get('/{id}/edit', \App\Livewire\SettlementReports\Form::class)->name('edit');

        // DETAIL SR - taruh PALING BAWAH
        Route::get('/{hash}', \App\Livewire\SettlementReports\Show::class)->name('show');
    });

    // =========================================================================
    // CONTRACTS
    // =========================================================================
    Route::prefix('contracts')->name('contracts.')->group(function () {
        Route::get('/', \App\Livewire\Contracts\Index::class)->name('index');
        Route::get('/{hash}', \App\Livewire\Contracts\Show::class)->name('show');
    });

});
