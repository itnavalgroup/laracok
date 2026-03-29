<?php

namespace App\Http\Controllers;

use App\Models\AttachmentIkb;
use App\Models\Ikb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IkbAttachmentController extends Controller
{
    public function store(Request $request, $hash)
    {
        $id_ikb = hashid_decode($hash, 'ikb');
        abort_if(!$id_ikb, 404);

        $ikb = Ikb::findOrFail($id_ikb);
        $user = Auth::user();
        $isAdmin = $user->level == 1;
        $isOwner = $user->id_user == $ikb->id_user;

        // Add document only in Draft (0), Revision (11), or Step 8 (Security)
        if ($ikb->status >= 9) {
            return redirect()->back()->with('error', 'Tidak dapat menambah lampiran setelah tahap Security selesai diproses.');
        }

        if ($ikb->status == 8) {
            // Only Security Officer with permission or Admin
            if (!$isAdmin && !$user->hasPermission('ikb.approve.step8')) {
                return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk menambah foto pada tahap ini.');
            }
        } elseif (in_array($ikb->status, [0, 11])) {
            // Only Owner with permission or Admin
            if (!$isAdmin && !($isOwner && $user->hasPermission('ikb_detail.create'))) {
                return redirect()->back()->with('error', 'Hanya pemilik data yang dapat menambah lampiran.');
            }
        } else {
            return redirect()->back()->with('error', 'Tidak dapat menambah dokumen pada status IKB saat ini.');
        }

        $request->validate([
            'id_attachment' => 'required|exists:tbl_attachment,id_attachment',
            'file.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'note.*' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $notes = $request->note ?? [];
            $id_attachment = $request->id_attachment;

            foreach ($files as $index => $file) {
                $ext = strtolower($file->getClientOriginalExtension());
                $destinationPath = public_path('assets/attachmentikb');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $filename = time() . '_' . uniqid() . '.' . $ext;
                $file->move($destinationPath, $filename);

                \App\Models\AttachmentIkb::create([
                    'id_ikb' => $id_ikb,
                    'id_attachment' => $id_attachment,
                    'id_user' => Auth::id(),
                    'filename' => $filename,
                    'note' => $notes[$index] ?? null,
                ]);
            }
        }

        if ($ikb->status == 11) {
            $ikb->status = 0;
            $ikb->save();
        }

        return redirect()->back()->with('success', 'Attachments uploaded successfully.');
    }

    public function update(Request $request, $hash)
    {
        $id = hashid_decode($hash, 'att_ikb');
        $att = AttachmentIkb::findOrFail($id);
        $ikb = $att->ikb;
        $user = Auth::user();
        $isAdmin = $user->level == 1;
        $isOwner = $user->id_user == $ikb->id_user;

        $request->validate([
            'id_attachment' => 'required|exists:tbl_attachment,id_attachment',
            'note' => 'nullable|string',
            'filename' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        if ($ikb->status >= 9) {
            return redirect()->back()->with('error', 'Tidak dapat mengubah lampiran setelah tahap Security selesai diproses.');
        }

        if ($ikb->status == 8) {
            // Security can only edit what they uploaded in status 8
            $lastSignStep7 = \App\Models\SignTransaction::where('id_ikb', '=', $ikb->id_ikb)
                ->where('status', '=', 7)
                ->latest()
                ->first();
            
            $isStep8Upload = ($lastSignStep7 && $att->created_at > $lastSignStep7->created_at);
            
            if (!$isAdmin) {
                if (!$isStep8Upload || $att->id_user != $user->id_user) {
                    return redirect()->back()->with('error', 'Anda tidak dapat mengubah lampiran ini.');
                }
            }
        } elseif (in_array($ikb->status, [0, 11])) {
            // Only Owner with permission or Admin
            if (!$isAdmin && !($isOwner && $user->hasPermission('ikb_detail.edit'))) {
                return redirect()->back()->with('error', 'Hanya pemilik data yang dapat mengubah lampiran.');
            }
        } else {
            return redirect()->back()->with('error', 'Tidak dapat mengubah dokumen pada status IKB saat ini.');
        }

        $data = [
            'id_attachment' => $request->id_attachment,
            'note' => $request->note,
        ];

        if ($request->hasFile('filename')) {
            // Delete old file
            $oldPath = public_path('assets/attachmentikb/' . $att->filename);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Save new file
            $file = $request->file('filename');
            $ext = strtolower($file->getClientOriginalExtension());
            $filename = time() . '_' . uniqid() . '.' . $ext;
            $file->move(public_path('assets/attachmentikb'), $filename);
            $data['filename'] = $filename;
        }

        $att->update($data);

        if ($ikb->status == 11) {
            $ikb->status = 0;
            $ikb->save();
        }

        return redirect()->back()->with('success', 'Attachment updated successfully.');
    }

    public function destroy($hash)
    {
        $id = hashid_decode($hash, 'att_ikb');
        $att = AttachmentIkb::findOrFail($id);
        $ikb = $att->ikb;
        $user = Auth::user();
        $isAdmin = $user->level == 1;
        $isOwner = $user->id_user == $ikb->id_user;

        if ($ikb->status >= 9) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus lampiran setelah tahap Security selesai diproses.');
        }

        if ($ikb->status == 8) {
            $lastSignStep7 = \App\Models\SignTransaction::where('id_ikb', '=', $ikb->id_ikb)
                ->where('status', '=', 7)
                ->latest()
                ->first();
            
            $isStep8Upload = ($lastSignStep7 && $att->created_at > $lastSignStep7->created_at);

            if (!$isAdmin) {
                if (!$isStep8Upload || $att->id_user != $user->id_user) {
                    return redirect()->back()->with('error', 'Anda tidak dapat menghapus lampiran ini.');
                }
            }
        } elseif (in_array($ikb->status, [0, 11])) {
            // Only Owner with permission or Admin
            if (!$isAdmin && !($isOwner && $user->hasPermission('ikb_detail.delete'))) {
                return redirect()->back()->with('error', 'Hanya pemilik data yang dapat menghapus lampiran.');
            }
        } else {
            return redirect()->back()->with('error', 'Tidak dapat menghapus dokumen pada status IKB saat ini.');
        }

        $filePath = public_path('assets/attachmentikb/' . $att->filename);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $att->delete();

        if ($ikb->status == 11) {
            $ikb->status = 0;
            $ikb->save();
        }

        return redirect()->back()->with('success', 'Attachment deleted successfully.');
    }
}
