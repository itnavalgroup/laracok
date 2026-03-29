<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pr;
use App\Models\PrAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\SignTransaction;

class PrAttachmentController extends Controller
{
    /**
     * Simpan attachment PR baru
     * CI4: simpanattachment()
     * File disimpan ke public/attachmentpr/
     */
    public function store(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr   = Pr::findOrFail($id);
        $user = Auth::user();

        // Access control: creator PR atau permission pr_attachment.create
        $canAdd = $user->level === 1
            || $user->id_user == $pr->id_user
            || $user->hasPermission('pr_attachment.create');

        if (!$canAdd) {
            return back()->with('error', 'Anda tidak berhak menambahkan attachment.');
        }

        // Status constraint: only allow upload on Draft (0), Revision (12), Payment Parsial (8)
        if (!in_array($pr->status, [0, 8, 12])) {
            return back()->with('error', 'Attachment tidak dapat ditambahkan pada status PR ini.');
        }

        $request->validate([
            'filename' => $request->filled('captured_photo') ? 'nullable' : 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'captured_photo' => 'nullable|string',
            'id_attachment' => 'required|integer',
            'note' => 'nullable|string',
        ]);

        $folder = public_path('assets/attachmentpr');
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $newName = null;

        if ($request->filled('captured_photo')) {
            // JS now sends raw base64 (no data URI prefix) + MIME type separately
            $rawBase64 = $request->input('captured_photo');
            $mimeType  = $request->input('captured_photo_mime', 'image/jpeg');

            $base64Data = base64_decode($rawBase64, true);
            if ($base64Data === false || empty($rawBase64)) {
                return back()->with('error', 'Format data foto tidak valid.');
            }

            $extension = 'png';
            if ($mimeType === 'application/pdf') {
                $extension = 'pdf';
            } elseif (str_contains($mimeType, 'jpeg')) {
                $extension = 'jpg';
            }

            $newName = "capture_" . time() . "_" . uniqid() . "." . $extension;
            file_put_contents($folder . DIRECTORY_SEPARATOR . $newName, $base64Data);
        } elseif ($request->hasFile('filename')) {
            $file = $request->file('filename');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $newName = str_replace(' ', '_', $originalFileName) . '_' . time() . '_' . uniqid() . '.' . $extension;
            $file->move($folder, $newName);
        } else {
            return back()->with('error', 'Silakan pilih file atau ambil foto.');
        }

        if (!$newName) {
            return back()->with('error', 'Gagal memproses file attachment.');
        }

        PrAttachment::create([
            'id_pr'         => $id,
            'id_attachment' => $request->id_attachment,
            'note'          => $request->note,
            'filename'      => $newName,
            'id_user'       => $user->id_user,
        ]);

        return back()->with('success', 'Attachment berhasil ditambahkan.');
    }

    /**
     * Update attachment PR
     * CI4: updateattachment()
     */
    public function update(Request $request, string $id)
    {
        // Decode hash if needed, but the route currently uses {id}
        // Let's support both if possible, or just use what route provides
        $decodedId = hashid_decode($id, 'attachment-pr') ?: $id;
        $attachment = PrAttachment::findOrFail($decodedId);
        $pr         = Pr::findOrFail($attachment->id_pr);
        $user       = Auth::user();

        $canEdit = $user->level === 1
            || $user->id_user == $pr->id_user
            || $user->hasPermission('pr_attachment.edit');

        if (!$canEdit) {
            return back()->with('error', 'Anda tidak berhak mengubah attachment ini.');
        }

        // Status constraint: only allow edit on Draft (0), Revision (12), Payment Parsial (8)
        if (!in_array($pr->status, [0, 8, 12])) {
            return back()->with('error', 'Attachment tidak dapat diubah pada status PR ini.');
        }

        // If status is 8 (Payment Parsial), only allow editing if the attachment was uploaded *during* status 8
        if ($pr->status == 8) {
            $enterStatus8Date = SignTransaction::where('id_pr', $pr->id_pr)
                ->where('status', 8)
                ->latest()
                ->value('updated_at');

            if ($enterStatus8Date && $attachment->created_at < $enterStatus8Date) {
                return back()->with('error', 'Hanya attachment dokumen yang ditambahkan saat Payment Parsial yang dapat diubah.');
            }
        }

        $newName = $attachment->filename;

        if ($request->hasFile('filename') || $request->filled('captured_photo')) {
            if ($request->hasFile('filename')) {
                $request->validate([
                    'filename' => 'file|mimes:jpg,jpeg,png,pdf|max:5120',
                ]);
            }

            // Hapus file lama
            $oldPath = public_path('assets/attachmentpr') . DIRECTORY_SEPARATOR . $attachment->filename;
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }

            $publicFolder = public_path('assets/attachmentpr');
            $oldFilePath = $publicFolder . DIRECTORY_SEPARATOR . $attachment->filename;
            if (is_file($oldFilePath)) {
                @unlink($oldFilePath);
            }

            if (!is_dir($publicFolder)) {
                mkdir($publicFolder, 0777, true);
            }

            if ($request->filled('captured_photo')) {
                // JS sends raw base64 (no prefix) + MIME type separately
                $rawBase64 = $request->input('captured_photo');
                $mimeType  = $request->input('captured_photo_mime', 'image/jpeg');

                $base64Data = base64_decode($rawBase64, true);
                if ($base64Data === false || empty($rawBase64)) {
                    return back()->with('error', 'Format data foto tidak valid.');
                }

                $extension = 'png';
                if ($mimeType === 'application/pdf') {
                    $extension = 'pdf';
                } elseif (str_contains($mimeType, 'jpeg')) {
                    $extension = 'jpg';
                }

                $newName = "capture_" . time() . "_" . uniqid() . "." . $extension;
                file_put_contents($publicFolder . DIRECTORY_SEPARATOR . $newName, $base64Data);
            } else {
                $file = $request->file('filename');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $newName = str_replace(' ', '_', $originalFileName) . '_' . time() . '_' . uniqid() . '.' . $extension;
                $file->move($publicFolder, $newName);
            }
        }

        $attachment->update([
            'id_attachment' => $request->id_attachment ?? $attachment->id_attachment,
            'note'          => $request->note,
            'filename'      => $newName,
        ]);

        return back()->with('success', 'Attachment berhasil diperbarui.');
    }

    /**
     * Hapus attachment PR
     * CI4: deleteatt()
     */
    public function destroy(string $id)
    {
        $decodedId = hashid_decode($id, 'attachment-pr') ?: $id;
        $attachment = PrAttachment::findOrFail($decodedId);
        $pr         = Pr::findOrFail($attachment->id_pr);
        $user       = Auth::user();

        $canDelete = $user->level === 1
            || $user->id_user == $pr->id_user
            || $user->hasPermission('pr_attachment.delete');

        if (!$canDelete) {
            return back()->with('error', 'Anda tidak berhak menghapus attachment ini.');
        }

        // Status constraint: only allow delete on Draft (0), Revision (12), Payment Parsial (8)
        if (!in_array($pr->status, [0, 8, 12])) {
            return back()->with('error', 'Attachment tidak dapat dihapus pada status PR ini.');
        }

        // If status is 8 (Payment Parsial), only allow deleting if the attachment was uploaded *during* status 8
        if ($pr->status == 8) {
            $enterStatus8Date = SignTransaction::where('id_pr', $pr->id_pr)
                ->where('status', 8)
                ->latest()
                ->value('updated_at');

            if ($enterStatus8Date && $attachment->created_at < $enterStatus8Date) {
                return back()->with('error', 'Hanya attachment dokumen yang ditambahkan saat Payment Parsial yang dapat dihapus.');
            }
        }

        // Hapus file fisik
        $filePath = public_path('assets/attachmentpr') . DIRECTORY_SEPARATOR . $attachment->filename;
        if (is_file($filePath)) {
            @unlink($filePath);
        }

        $attachment->delete();

        return back()->with('success', 'Attachment berhasil dihapus.');
    }
}
