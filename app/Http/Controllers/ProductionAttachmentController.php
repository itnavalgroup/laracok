<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\ProductionAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductionAttachmentController extends Controller
{
    public function store(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'production');
        if (!$id) abort(404);

        $production = Production::findOrFail($id);
        $user = Auth::user();

        $canAdd = $user->level === 1
            || $user->id_user == $production->id_user
            || $user->hasPermission('production.process')
            || $user->hasPermission('production.verify');

        if (!$canAdd) {
            return back()->with('error', 'Anda tidak berhak menambahkan attachment.');
        }

        if (!in_array($production->status, [0, 1, 2])) {
            return back()->with('error', 'Attachment tidak dapat ditambahkan pada status Production ini.');
        }

        $request->validate([
            'filename' => $request->filled('captured_photo') ? 'nullable' : 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'captured_photo' => 'nullable|string',
            'id_attachment' => 'required|integer',
            'note' => 'required|string',
        ]);

        $folder = public_path('assets/attachmentproduction');
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

        ProductionAttachment::create([
            'id_production' => $id,
            'id_attachment' => $request->id_attachment,
            'note'          => $request->note,
            'filename'      => $newName,
            'id_user'       => $user->id_user,
        ]);

        return back()->with('success', 'Attachment berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $decodedId = hashid_decode($id, 'attachment-production') ?: $id;
        $attachment = ProductionAttachment::findOrFail($decodedId);
        $production = Production::findOrFail($attachment->id_production);
        $user       = Auth::user();

        $canEdit = $user->level === 1
            || $user->id_user == $production->id_user
            || $user->hasPermission('production.process')
            || $user->hasPermission('production.verify');

        if (!$canEdit) {
            return back()->with('error', 'Anda tidak berhak mengubah attachment ini.');
        }

        if ($production->status != 0) {
            return back()->with('error', 'Attachment tidak dapat diubah (hanya bisa menambah) jika sudah di-submit.');
        }

        $newName = $attachment->filename;

        if ($request->hasFile('filename') || $request->filled('captured_photo')) {
            if ($request->hasFile('filename')) {
                $request->validate([
                    'filename' => 'file|mimes:jpg,jpeg,png,pdf|max:5120',
                ]);
            }

            $publicFolder = public_path('assets/attachmentproduction');
            $oldFilePath = $publicFolder . DIRECTORY_SEPARATOR . $attachment->filename;
            if (is_file($oldFilePath)) {
                @unlink($oldFilePath);
            }

            if (!is_dir($publicFolder)) {
                mkdir($publicFolder, 0777, true);
            }

            if ($request->filled('captured_photo')) {
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

    public function destroy(string $id)
    {
        $decodedId = hashid_decode($id, 'attachment-production') ?: $id;
        $attachment = ProductionAttachment::findOrFail($decodedId);
        $production = Production::findOrFail($attachment->id_production);
        $user       = Auth::user();

        $canDelete = $user->level === 1
            || $user->id_user == $production->id_user
            || $user->hasPermission('production.process')
            || $user->hasPermission('production.verify');

        if (!$canDelete) {
            return back()->with('error', 'Anda tidak berhak menghapus attachment ini.');
        }

        if ($production->status != 0) {
            return back()->with('error', 'Attachment tidak dapat dihapus jika sudah di-submit.');
        }

        $filePath = public_path('assets/attachmentproduction') . DIRECTORY_SEPARATOR . $attachment->filename;
        if (is_file($filePath)) {
            @unlink($filePath);
        }

        $attachment->delete();

        return back()->with('success', 'Attachment berhasil dihapus.');
    }
}
