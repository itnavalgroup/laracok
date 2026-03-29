<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pr;
use App\Models\Payment;
use App\Models\PaymentAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentAttachmentController extends Controller
{
    /**
     * Helper: cek last payment validity sesuai CI4
     */
    private function checkLastPaymentRule(Pr $pr, Payment $payment): ?string
    {
        $lastPayment = Payment::where('id_pr', $pr->id_pr)
            ->where('id_doc_type', $pr->id_doc_type)
            ->orderBy('id_payment', 'DESC')
            ->first();

        if (!$lastPayment) return 'Payment tidak ditemukan.';

        if ($payment->payment_type == 1) {
            // Parsial
            if ($lastPayment->payment_type == 2) {
                return 'Tidak bisa upload attachment karena sudah ada payment full.';
            }
            if ($lastPayment->id_payment != $payment->id_payment) {
                return 'Hanya payment parsial terakhir yang dapat diperbarui attachment-nya.';
            }
        } else {
            // Full
            if ($lastPayment->id_payment != $payment->id_payment) {
                return 'Payment full harus menjadi payment terakhir untuk mengubah attachment.';
            }
        }

        return null;
    }

    private function updatePrStatus(int $idPr, int $idDocType): void
    {
        app(PaymentController::class)->{'updatePrStatusAfterPayments'}($idPr, $idDocType);
    }

    /**
     * Simpan attachment payment
     * CI4: simpanattpayment()
     * File ke public/attachmentpayment/
     */
    public function store(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr   = Pr::findOrFail($id);
        $user = Auth::user();

        // Attachment Add Rule:
        // Full (2): hanya pr_payment.create
        // Parsial (1): owner OR pr_payment.create
        $paymentType = Payment::where('id_pr', $id)->findOrFail($request->id_payment)->payment_type;
        $canAdd = false;

        if ($user->level === 1 || $user->hasPermission('pr_payment.create')) {
            $canAdd = true;
        } elseif ($paymentType == 1 && $user->id_user == $pr->id_user) {
            $canAdd = true;
        }

        if (!$canAdd) {
            return back()->with('error', 'Anda tidak berhak menambahkan attachment payment.');
        }

        $request->validate([
            'filename'      => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'id_payment'    => 'required|integer',
            'id_attachment' => 'required|integer',
            'note'          => 'nullable|string',
        ]);

        $payment = Payment::where('id_pr', $id)->findOrFail($request->id_payment);

        // Validasi aturan last payment
        $error = $this->checkLastPaymentRule($pr, $payment);
        if ($error) {
            return back()->with('error', $error);
        }

        // Tidak boleh upload jika status 14 (Menunggu Director), tapi status 15 (Menunggu Manager) boleh upload/edit
        if (in_array($pr->status, [14])) {
            return back()->with('error', 'Tidak bisa menambahkan attachment saat status PR menunggu persetujuan Director.');
        }

        $file    = $request->file('filename');
        $newName = str_replace(' ', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $folder = public_path('assets/attachmentpayment');
        if (!is_dir($folder)) mkdir($folder, 0777, true);
        $file->move($folder, $newName);

        PaymentAttachment::create([
            'id_doc_type'   => $pr->id_doc_type,
            'id_pr'         => $id,
            'id_payment'    => $request->id_payment,
            'id_attachment' => $request->id_attachment ?? null,
            'note'          => $request->note,
            'filename'      => $newName,
            'id_user'       => $user->id_user,
        ]);

        // Update status PR
        $this->updatePrStatus($pr->id_pr, $pr->id_doc_type);

        return back()->with('success', 'Attachment payment berhasil ditambahkan.');
    }

    /**
     * Update attachment payment
     * CI4: updateattpayment()
     */
    public function update(Request $request, int $id)
    {
        $attachment = PaymentAttachment::findOrFail($id);
        $pr         = Pr::findOrFail($attachment->id_pr);
        $payment    = Payment::findOrFail($attachment->id_payment);
        $user       = Auth::user();

        // Sama seperti Edit Payment: Hanya uploader payment tersebut yg bisa edit (plus admin)
        $canEdit = $user->level === 1 || $user->id_user == $payment->id_user;

        if (!$canEdit) {
            return back()->with('error', 'Anda tidak berhak mengubah attachment payment.');
        }

        // Tidak boleh edit jika status 14 (Menunggu Director), tapi status 15 (Menunggu Manager) boleh upload/edit
        if (in_array($pr->status, [14])) {
            return back()->with('error', 'Tidak bisa mengubah attachment saat status PR menunggu persetujuan Director.');
        }

        $error = $this->checkLastPaymentRule($pr, $payment);
        if ($error) {
            return back()->with('error', $error);
        }

        $newName = $attachment->file_name;

        if ($request->hasFile('filename')) {
            $request->validate([
                'filename'      => 'file|mimes:jpg,jpeg,png,pdf|max:5120',
                'id_attachment' => 'required|integer',
            ]);
            $file = $request->file('filename');

            // Hapus file lama
            $oldPath = public_path('assets/attachmentpayment') . DIRECTORY_SEPARATOR . $attachment->filename;
            if (is_file($oldPath)) unlink($oldPath);

            $newName = str_replace(' ', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $folder = public_path('assets/attachmentpayment');
            if (!is_dir($folder)) mkdir($folder, 0777, true);
            $file->move($folder, $newName);
        }

        $attachment->update([
            'id_attachment' => $request->id_attachment ?? $attachment->id_attachment,
            'note'          => $request->note,
            'filename'      => $newName,
            'id_payment'    => $request->id_payment ?? $attachment->id_payment,
        ]);

        $this->updatePrStatus($pr->id_pr, $pr->id_doc_type);

        return back()->with('success', 'Attachment payment berhasil diperbarui.');
    }

    /**
     * Hapus attachment payment
     * CI4: deleteattpayment()
     */
    public function destroy(int $id)
    {
        $attachment = PaymentAttachment::findOrFail($id);
        $pr         = Pr::findOrFail($attachment->id_pr);
        $payment    = Payment::findOrFail($attachment->id_payment);
        $user       = Auth::user();

        // Sama seperti delete payment: Hanya pembuat payment tersebut yg bisa delete (plus admin)
        $canDelete = $user->level === 1 || $user->id_user == $payment->id_user;

        if (!$canDelete) {
            return back()->with('error', 'Anda tidak berhak menghapus attachment payment.');
        }

        // Tidak boleh delete jika status 14
        if (in_array($pr->status, [14])) {
            return back()->with('error', 'Tidak bisa menghapus attachment saat status PR menunggu persetujuan Director.');
        }

        $error = $this->checkLastPaymentRule($pr, $payment);
        if ($error) {
            return back()->with('error', $error);
        }

        // Hapus file fisik
        $filePath = public_path('assets/attachmentpayment') . DIRECTORY_SEPARATOR . $attachment->filename;
        if (is_file($filePath)) unlink($filePath);

        $attachment->delete();

        $this->updatePrStatus($pr->id_pr, $pr->id_doc_type);

        return back()->with('success', 'Attachment payment berhasil dihapus.');
    }
}
