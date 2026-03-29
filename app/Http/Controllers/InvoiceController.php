<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pr;
use App\Models\Invoice;
use App\Models\PrDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Cek apakah user boleh CRUD invoice
     * CI4: in_array(level, [1,5,6,7,8]) || userId == PR.userId
     * Laravel: level 1, atau pr_invoice.create, atau creator PR
     */
    private function canManageInvoice(Pr $pr): bool
    {
        $user = Auth::user();
        return $user->level === 1
            || ($user->id_user == $pr->id_user && $user->hasPermission('pr_invoice.create'))
            || ($user->id_user == $pr->id_user && $user->hasPermission('pr_invoice.edit'))
            || $user->hasPermission('pr_invoice.create')
            || $user->hasPermission('pr_invoice.edit');
    }

    private function isOwner(Pr $pr): bool
    {
        $user = Auth::user();
        return $user->level === 1 || $user->id_user == $pr->id_user;
    }

    /**
     * Simpan invoice baru
     * CI4: simpaninvoice()
     * Auto-generate invoice_number: INVOICE.{Company}.{YYMM}.{NNN}
     */
    public function store(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr = Pr::with('company')->findOrFail($id);

        if (!$this->canManageInvoice($pr)) {
            return back()->with('error', 'Anda tidak berhak menerbitkan invoice.');
        }

        // PR harus di status submitted atau lebih (status >= 1)
        if ($pr->status < 1) {
            return back()->with('error', 'PR belum disubmit. Tidak dapat membuat invoice.');
        }

        // Cek apakah sudah ada invoice
        $existingCount = Invoice::where('id_pr', $id)
            ->where('id_doc_type', $pr->id_doc_type)
            ->count();

        if ($existingCount > 0) {
            return back()->with('error', 'Invoice sudah ada untuk PR ini.');
        }

        $request->validate([
            'invoice_date'  => 'required|date',
            'delivery_date' => 'nullable|date',
            'truck'         => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Generate invoice number: INVOICE.{Company}.{YYMM}.{NNN}
            $companyCode = $pr->company->company ?? 'COMP';
            $invoiceDate = $request->invoice_date;
            $year        = substr(date('Y', strtotime($invoiceDate)), -2);
            $month       = str_pad(date('m', strtotime($invoiceDate)), 2, '0', STR_PAD_LEFT);

            $lastNumber = Invoice::where('id_company', $pr->id_company)->count();
            $numPad     = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

            $invoiceNumber = "INVOICE.{$companyCode}.{$year}{$month}.{$numPad}";

            Invoice::create([
                'id_pr'           => $id,
                'id_user'         => $pr->id_user,
                'id_departement'  => $pr->id_departement,
                'id_vendor'       => $pr->id_vendor,
                'id_doc_type'     => $pr->id_doc_type,
                'id_company'      => $pr->id_company,
                'id_norek_vendor' => $pr->id_norek_vendor ?? 0,
                'nama_bank'       => $pr->bank ?? null,
                'nama_penerima'   => $pr->penerima ?? null,
                'norek'           => $pr->norek_vendor ?? null,
                'truck'           => $request->truck,
                'invoice_date'    => $invoiceDate,
                'delivery_date'   => $request->delivery_date,
                'invoice_number'  => $invoiceNumber,
            ]);

            // Jika toggle aktif → update no_invoice di PR (TIDAK BISA DIKEMBALIKAN)
            if ($request->boolean('update_pr_no_invoice')) {
                $pr->update(['no_invoice' => $invoiceNumber]);
            }

            DB::commit();
            return redirect()->route('payment-requests.invoice', $hash)
                ->with('success', 'Invoice berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update invoice
     * CI4: updateinvoice()
     * Hanya dapat diedit jika file_name (attachment) masih kosong
     */
    public function update(Request $request, string $invoiceHash)
    {
        $id = hashid_decode($invoiceHash, 'invoice');
        if (!$id) abort(404);

        $invoice = Invoice::findOrFail($id);
        $pr      = Pr::findOrFail($invoice->id_pr);

        if (!$this->isOwner($pr)) {
            return back()->with('error', 'Hanya pembuat PR yang berhak mengubah invoice ini.');
        }

        if (!empty($invoice->file_name)) {
            return back()->with('error', 'Invoice tidak dapat diubah karena sudah ter-verifikasi (file sudah diupload).');
        }

        $request->validate([
            'invoice_date'  => 'required|date',
            'delivery_date' => 'nullable|date',
            'truck'         => 'nullable|string|max:255',
        ]);

        $invoice->update([
            'truck'         => $request->truck,
            'invoice_date'  => $request->invoice_date,
            'delivery_date' => $request->delivery_date,
        ]);

        // Jika nomor invoice berbeda dengan di PR, dan checkbox dicentang -> update PR
        if ($request->boolean('update_pr_no_invoice') && $pr->no_invoice != $invoice->invoice_number) {
            $pr->update(['no_invoice' => $invoice->invoice_number]);
        }

        $prHash = hashid_encode($invoice->id_pr, 'pr');
        return redirect()->route('payment-requests.invoice', $prHash)
            ->with('success', 'Invoice berhasil diperbarui.');
    }

    /**
     * Hapus invoice
     * CI4: deleteinvoice()
     * Hanya dapat dihapus jika file_name masih kosong
     */
    public function destroy(string $invoiceHash)
    {
        $id = hashid_decode($invoiceHash, 'invoice');
        if (!$id) abort(404);

        $invoice = Invoice::findOrFail($id);
        $pr      = Pr::findOrFail($invoice->id_pr);
        $user    = Auth::user();

        $canDelete = $user->level === 1
            || $user->id_user == $pr->id_user
            || $user->hasPermission('pr_invoice.delete');

        if (!$this->isOwner($pr)) {
            return back()->with('error', 'Hanya pembuat PR yang berhak menghapus invoice.');
        }

        if (!empty($invoice->file_name)) {
            return back()->with('error', 'Invoice tidak dapat dihapus karena sudah ter-verifikasi.');
        }

        $prHash = hashid_encode($invoice->id_pr, 'pr');
        $invoice->delete();

        return redirect()->route('payment-requests.show', $prHash)
            ->with('success', 'Invoice berhasil dihapus.');
    }

    /**
     * Upload attachment invoice (verified invoice file)
     * CI4: simpanattinvoice()
     * File disimpan ke public/invoice/
     */
    public function storeAttachment(Request $request, string $invoiceHash)
    {
        $id = hashid_decode($invoiceHash, 'invoice');
        if (!$id) abort(404);

        $invoice = Invoice::findOrFail($id);
        $pr      = Pr::findOrFail($invoice->id_pr);

        if (!$this->canManageInvoice($pr)) {
            return back()->with('error', 'Anda tidak berhak upload invoice.');
        }

        $request->validate([
            'file_name' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $file    = $request->file('file_name');
        $newName = str_replace(' ', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '_' . time() . '.' . $file->getClientOriginalExtension();

        $folder = public_path('assets/invoice');
        if (!is_dir($folder)) mkdir($folder, 0777, true);
        $file->move($folder, $newName);

        $invoice->update(['file_name' => $newName]);

        $prHash = hashid_encode($invoice->id_pr, 'pr');
        return redirect()->route('payment-requests.invoice', $prHash)
            ->with('success', 'Invoice berhasil diupload.');
    }

    /**
     * Update attachment invoice
     * CI4: updateattinvoice()
     */
    public function updateAttachment(Request $request, string $invoiceHash)
    {
        $id = hashid_decode($invoiceHash, 'invoice');
        if (!$id) abort(404);

        $invoice = Invoice::findOrFail($id);
        $pr      = Pr::findOrFail($invoice->id_pr);

        if (!$this->canManageInvoice($pr)) {
            return back()->with('error', 'Anda tidak berhak mengubah attachment invoice.');
        }

        $newName = $invoice->file_name;

        if ($request->hasFile('file_name')) {
            $request->validate(['file_name' => 'file|mimes:jpg,jpeg,png,pdf|max:5120']);
            $file = $request->file('file_name');

            // Hapus file lama
            if ($invoice->file_name) {
                $oldPath = public_path('invoice') . DIRECTORY_SEPARATOR . $invoice->file_name;
                if (is_file($oldPath)) unlink($oldPath);
            }

            $newName = str_replace(' ', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '_' . time() . '.' . $file->getClientOriginalExtension();
            $folder = public_path('assets/invoice');
            if (!is_dir($folder)) mkdir($folder, 0777, true);
            $file->move($folder, $newName);
        }

        $invoice->update(['file_name' => $newName]);

        $prHash = hashid_encode($invoice->id_pr, 'pr');
        return redirect()->route('payment-requests.invoice', $prHash)
            ->with('success', 'Attachment invoice berhasil diperbarui.');
    }

    /**
     * Hapus attachment invoice (null-kan file_name)
     * CI4: deleteattinvoice()
     */
    public function destroyAttachment(string $invoiceHash)
    {
        $id = hashid_decode($invoiceHash, 'invoice');
        if (!$id) abort(404);

        $invoice = Invoice::findOrFail($id);
        $pr      = Pr::findOrFail($invoice->id_pr);

        if (!$this->canManageInvoice($pr)) {
            return back()->with('error', 'Anda tidak berhak menghapus attachment invoice.');
        }

        // Hapus file fisik
        if ($invoice->file_name) {
            $path = public_path('invoice') . DIRECTORY_SEPARATOR . $invoice->file_name;
            if (is_file($path)) unlink($path);
        }

        $invoice->update(['file_name' => null]);

        $prHash = hashid_encode($invoice->id_pr, 'pr');
        return redirect()->route('payment-requests.invoice', $prHash)
            ->with('success', 'Attachment invoice berhasil dihapus.');
    }

    /**
     * Canvas / download PDF invoice
     * CI4: invoicecanvas()
     */
    public function canvas(string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr = Pr::with([
            'user',
            'company',
            'vendor',
            'departement',
            'details.uom',
            'signTransactions.user',
            'norek_vendor',
        ])->findOrFail($id);

        $user = Auth::user();
        $canView = $user->level === 1
            || $user->id_user == $pr->id_user
            || $user->hasPermission('pr_invoice.view')
            || $user->hasPermission('pr_invoice.download');

        if (!$canView) abort(403);

        $invoice = Invoice::where('id_pr', $id)
            ->where('id_doc_type', $pr->id_doc_type)
            ->first();

        if (!$invoice) {
            return redirect()->route('payment-requests.invoice', $hash)
                ->with('error', 'Invoice belum dibuat.');
        }

        $detail     = PrDetail::where('id_pr', $id)->get();
        $grandTotal = $detail->sum('ammount') - floatval($pr->additional_discount ?? 0);

        return view('payment-requests.invoice-print', compact('pr', 'invoice', 'detail', 'grandTotal'));
    }
    /**
     * Print invoice — opens browser print-friendly view, same data as canvas()
     * User triggers window.print() via JS on page load
     */
    public function print(string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr = Pr::with([
            'user',
            'company',
            'vendor',
            'departement',
            'details.uom',
            'signTransactions.user',
            'norek_vendor',
        ])->findOrFail($id);

        $user = Auth::user();
        $canView = $user->level === 1
            || $user->id_user == $pr->id_user
            || $user->hasPermission('pr_invoice.view')
            || $user->hasPermission('pr_invoice.print');

        if (!$canView) {
            return redirect()->route('payment-requests.show', $hash)
                ->with('error', 'Anda tidak memiliki akses untuk mencetak invoice.');
        }

        $invoice = Invoice::where('id_pr', $id)
            ->where('id_doc_type', $pr->id_doc_type)
            ->first();

        if (!$invoice) {
            return redirect()->route('payment-requests.invoice', $hash)
                ->with('error', 'Invoice belum dibuat.');
        }

        $detail     = PrDetail::where('id_pr', $id)->get();
        $grandTotal = $detail->sum('ammount') - floatval($pr->additional_discount ?? 0);

        return view('payment-requests.invoice-print', compact('pr', 'invoice', 'detail', 'grandTotal'));
    }
}
