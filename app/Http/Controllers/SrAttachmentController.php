<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sr;
use App\Models\SrAttachment;
use Illuminate\Support\Facades\Auth;

class SrAttachmentController extends Controller
{
    /**
     * Simpan attachment SR baru
     * File disimpan ke public/assets/attachmentsr/
     */
    public function store(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'sr');
        if (!$id) abort(404);

        $sr   = Sr::findOrFail($id);
        $user = Auth::user();

        $canAdd = $user->level === 1
            || $user->id_user == $sr->id_user
            || $user->hasPermission('sr_attachment.create');

        if (!$canAdd) {
            return back()->with('error', 'Anda tidak berhak menambahkan attachment.');
        }

        // Status constraint: Draft (0), Revision (12), Payment Parsial (8)
        if (!in_array($sr->status, [0, 8, 12])) {
            return back()->with('error', 'Attachment tidak dapat ditambahkan pada status SR ini.');
        }

        $request->validate([
            'filename'           => $request->filled('captured_photo') ? 'nullable' : 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'captured_photo'     => 'nullable|string',
            'id_attachment'      => 'required|integer',
            'note'               => 'nullable|string',
        ]);

        $folder = public_path('assets/attachmentsr');
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $newName = null;

        if ($request->filled('captured_photo')) {
            $rawBase64 = $request->input('captured_photo');
            $mimeType  = $request->input('captured_photo_mime', 'image/jpeg');
            $base64Data = base64_decode($rawBase64, true);
            if ($base64Data === false || empty($rawBase64)) {
                return back()->with('error', 'Format data foto tidak valid.');
            }
            $extension = 'png';
            if ($mimeType === 'application/pdf') $extension = 'pdf';
            elseif (str_contains($mimeType, 'jpeg')) $extension = 'jpg';
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

        SrAttachment::create([
            'id_sr'         => $id,
            'id_attachment' => $request->id_attachment,
            'note'          => $request->note,
            'filename'      => $newName,
            'id_user'       => $user->id_user,
        ]);

        return back()->with('success', 'Attachment berhasil ditambahkan.');
    }

    /**
     * Update attachment SR
     */
    public function update(Request $request, string $id)
    {
        $decodedId  = hashid_decode($id, 'attachment-sr') ?: $id;
        $attachment = SrAttachment::findOrFail($decodedId);
        $sr         = Sr::findOrFail($attachment->id_sr);
        $user       = Auth::user();

        $canEdit = $user->level === 1
            || $user->id_user == $sr->id_user
            || $user->hasPermission('sr_attachment.edit');

        if (!$canEdit) {
            return back()->with('error', 'Anda tidak berhak mengubah attachment ini.');
        }

        if (!in_array($sr->status, [0, 8, 12])) {
            return back()->with('error', 'Attachment tidak dapat diubah pada status SR ini.');
        }

        $folder  = public_path('assets/attachmentsr');
        $newName = $attachment->filename;

        if ($request->hasFile('filename') || $request->filled('captured_photo')) {
            // Delete old file
            $oldPath = $folder . DIRECTORY_SEPARATOR . $attachment->filename;
            if (is_file($oldPath)) @unlink($oldPath);

            if (!is_dir($folder)) mkdir($folder, 0777, true);

            if ($request->filled('captured_photo')) {
                $rawBase64  = $request->input('captured_photo');
                $mimeType   = $request->input('captured_photo_mime', 'image/jpeg');
                $base64Data = base64_decode($rawBase64, true);
                if ($base64Data === false || empty($rawBase64)) {
                    return back()->with('error', 'Format data foto tidak valid.');
                }
                $extension = 'png';
                if ($mimeType === 'application/pdf') $extension = 'pdf';
                elseif (str_contains($mimeType, 'jpeg')) $extension = 'jpg';
                $newName = "capture_" . time() . "_" . uniqid() . "." . $extension;
                file_put_contents($folder . DIRECTORY_SEPARATOR . $newName, $base64Data);
            } else {
                $file = $request->file('filename');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $newName = str_replace(' ', '_', $originalFileName) . '_' . time() . '_' . uniqid() . '.' . $extension;
                $file->move($folder, $newName);
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
     * Hapus attachment SR
     */
    public function destroy(string $id)
    {
        $decodedId  = hashid_decode($id, 'attachment-sr') ?: $id;
        $attachment = SrAttachment::findOrFail($decodedId);
        $sr         = Sr::findOrFail($attachment->id_sr);
        $user       = Auth::user();

        $canDelete = $user->level === 1
            || $user->id_user == $sr->id_user
            || $user->hasPermission('sr_attachment.delete');

        if (!$canDelete) {
            return back()->with('error', 'Anda tidak berhak menghapus attachment ini.');
        }

        if (!in_array($sr->status, [0, 8, 12])) {
            return back()->with('error', 'Attachment tidak dapat dihapus pada status SR ini.');
        }

        $filePath = public_path('assets/attachmentsr') . DIRECTORY_SEPARATOR . $attachment->filename;
        if (is_file($filePath)) @unlink($filePath);

        $attachment->delete();

        return back()->with('success', 'Attachment berhasil dihapus.');
    }
}
