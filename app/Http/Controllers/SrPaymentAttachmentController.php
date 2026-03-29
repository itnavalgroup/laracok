<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sr;
use App\Models\Payment;
use App\Models\PaymentAttachment;
use Illuminate\Support\Facades\Auth;

/**
 * SrPaymentAttachmentController
 * Mirip PaymentAttachmentController tapi untuk SR Payment
 */
class SrPaymentAttachmentController extends Controller
{
    private function updateSrStatus(int $idPr, int $idDocType): void
    {
        app(SrPaymentController::class)->updateSrStatusAfterPayments($idPr, $idDocType);
    }

    public function store(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $sr   = Sr::where('id_pr', $id)->firstOrFail();
        $user = Auth::user();

        $canAdd = $user->level === 1
            || $user->id_user == $sr->id_user
            || $user->hasPermission('sr_payment.create');

        if (!$canAdd) {
            return back()->with('error', 'Anda tidak berhak menambahkan attachment payment.');
        }

        $request->validate([
            'filename'      => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'id_payment'    => 'required|integer',
            'id_attachment' => 'nullable|integer',
            'note'          => 'nullable|string',
        ]);

        $payment = Payment::where('id_pr', $sr->id_pr)
            ->where('id_doc_type', $sr->id_doc_type)
            ->findOrFail($request->id_payment);

        $file    = $request->file('filename');
        $newName = str_replace(' ', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $folder = public_path('assets/attachmentpayment');
        if (!is_dir($folder)) mkdir($folder, 0777, true);
        $file->move($folder, $newName);

        PaymentAttachment::create([
            'id_doc_type'   => $sr->id_doc_type,
            'id_pr'         => $sr->id_pr,
            'id_payment'    => $request->id_payment,
            'id_attachment' => $request->id_attachment ?? null,
            'note'          => $request->note,
            'filename'      => $newName,
            'id_user'       => $user->id_user,
        ]);

        $this->updateSrStatus($sr->id_pr, $sr->id_doc_type);

        return back()->with('success', 'Attachment payment berhasil ditambahkan.');
    }

    public function update(Request $request, int $id)
    {
        $attachment = PaymentAttachment::findOrFail($id);
        $payment    = Payment::findOrFail($attachment->id_payment);
        $sr         = Sr::where('id_pr', $payment->id_pr)
            ->where('id_doc_type', $payment->id_doc_type)
            ->firstOrFail();
        $user       = Auth::user();

        $canEdit = $user->level === 1 || $user->id_user == $payment->id_user;
        if (!$canEdit) return back()->with('error', 'Anda tidak berhak mengubah attachment payment.');

        $newName = $attachment->filename;
        if ($request->hasFile('filename')) {
            $request->validate(['filename' => 'file|mimes:jpg,jpeg,png,pdf|max:5120']);
            $file    = $request->file('filename');
            $oldPath = public_path('assets/attachmentpayment') . DIRECTORY_SEPARATOR . $attachment->filename;
            if (is_file($oldPath)) @unlink($oldPath);
            $newName = str_replace(' ', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $folder  = public_path('assets/attachmentpayment');
            if (!is_dir($folder)) mkdir($folder, 0777, true);
            $file->move($folder, $newName);
        }

        $attachment->update([
            'id_attachment' => $request->id_attachment ?? $attachment->id_attachment,
            'note'          => $request->note,
            'filename'      => $newName,
        ]);

        $this->updateSrStatus($payment->id_pr, $payment->id_doc_type);
        return back()->with('success', 'Attachment payment berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $attachment = PaymentAttachment::findOrFail($id);
        $payment    = Payment::findOrFail($attachment->id_payment);
        $user       = Auth::user();

        $canDelete = $user->level === 1 || $user->id_user == $payment->id_user;
        if (!$canDelete) return back()->with('error', 'Anda tidak berhak menghapus attachment payment.');

        $filePath = public_path('assets/attachmentpayment') . DIRECTORY_SEPARATOR . $attachment->filename;
        if (is_file($filePath)) @unlink($filePath);

        $attachment->delete();

        $this->updateSrStatus($payment->id_pr, $payment->id_doc_type);
        return back()->with('success', 'Attachment payment berhasil dihapus.');
    }
}
