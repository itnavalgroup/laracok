<?php

namespace App\Livewire\Attachments;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Attachment;
use App\Models\PrAttachment;
use App\Models\PaymentAttachment;

class AttachmentManager extends Component
{
    use WithFileUploads;

    // Context props
    public string $modelType  = 'pr';   // 'pr' | 'payment' | 'invoice' | 'settlement'
    public int    $modelId    = 0;
    public bool   $canEdit    = false;

    // Upload form fields
    public $attachment_name  = '';
    public $attachment_file  = null;
    public $attachment_note  = '';

    // Edit Note
    public $editingAttId     = null;
    public $editingNote      = '';
    public $editingName      = '';

    // =====================================================================
    // COMPUTED: Attachments
    // =====================================================================

    public function getAttachmentsProperty()
    {
        return match ($this->modelType) {
            'pr'  => PrAttachment::with(['attachment', 'user'])
                ->where('id_pr', $this->modelId)
                ->latest()
                ->get(),
            // 'payment', 'invoice', 'settlement' → tambah model-nya nanti
            default => collect([]),
        };
    }

    // =====================================================================
    // UPLOAD
    // =====================================================================

    public function addAttachment()
    {
        $this->validate([
            'attachment_name' => 'required|string|max:255',
            'attachment_file' => 'required|file|max:10240',
            'attachment_note' => 'nullable|string|max:1000',
        ], [
            'attachment_name.required' => 'Nama lampiran wajib diisi.',
            'attachment_file.required' => 'File wajib dipilih.',
            'attachment_file.max'      => 'File maksimal 10MB.',
        ]);

        try {
            $path     = $this->attachment_file->store('assets/qr', 'public');
            $filename = basename($path);

            match ($this->modelType) {
                'pr' => $this->savePrAttachment($filename),
                default => null,
            };

            $this->reset(['attachment_name', 'attachment_file', 'attachment_note']);
            $this->dispatch('attachment-upload-success');
            $this->dispatch('swal-alert', ['type' => 'success', 'message' => 'Lampiran berhasil diupload.']);
        } catch (\Exception $e) {
            $this->dispatch('swal-alert', ['type' => 'error', 'message' => 'Gagal upload: ' . $e->getMessage()]);
        }
    }

    private function savePrAttachment(string $filename): void
    {
        // Find or create attachment category
        $category = Attachment::firstOrCreate(
            ['attachment' => $this->attachment_name],
            ['id_departement' => null, 'id_user' => Auth::id()]
        );

        PrAttachment::create([
            'id_pr'         => $this->modelId,
            'id_attachment' => $category->id_attachment,
            'id_user'       => Auth::id(),
            'note'          => $this->attachment_note,
            'filename'      => $filename,
        ]);
    }

    // =====================================================================
    // DELETE
    // =====================================================================

    public function deleteAttachment(int $id): void
    {
        if (!$this->canEdit) {
            $this->dispatch('swal-alert', ['type' => 'error', 'message' => 'Akses ditolak.']);
            return;
        }

        try {
            $att = $this->findAttachment($id);
            if (!$att) return;

            // Delete file from storage
            if ($att->filename) {
                Storage::disk('public')->delete('assets/qr/' . $att->filename);
            }

            $att->delete();
            $this->dispatch('swal-alert', ['type' => 'success', 'message' => 'Lampiran berhasil dihapus.']);
        } catch (\Exception $e) {
            $this->dispatch('swal-alert', ['type' => 'error', 'message' => 'Gagal hapus: ' . $e->getMessage()]);
        }
    }

    // =====================================================================
    // EDIT NOTE
    // =====================================================================

    public function openEditNote(int $id): void
    {
        $att = $this->findAttachment($id);
        if (!$att) return;

        $this->editingAttId = $id;
        $this->editingNote  = $att->note ?? '';
        $this->editingName  = $att->attachment->attachment ?? '';
    }

    public function saveEditNote(): void
    {
        $this->validate([
            'editingName' => 'required|string|max:255',
            'editingNote' => 'nullable|string|max:1000',
        ]);

        $att = $this->findAttachment($this->editingAttId);
        if (!$att) return;

        // Update note
        $att->note = $this->editingNote;
        $att->save();

        // Update attachment name
        if ($att->attachment) {
            $att->attachment->update(['attachment' => $this->editingName]);
        }

        $this->reset(['editingAttId', 'editingNote', 'editingName']);
        $this->dispatch('swal-alert', ['type' => 'success', 'message' => 'Lampiran berhasil diperbarui.']);
    }

    public function cancelEdit(): void
    {
        $this->reset(['editingAttId', 'editingNote', 'editingName']);
    }

    // =====================================================================
    // HELPERS
    // =====================================================================

    private function findAttachment(int $id)
    {
        return match ($this->modelType) {
            'pr'  => PrAttachment::where('id_attachment_pr', $id)
                ->where('id_pr', $this->modelId)
                ->with('attachment')
                ->first(),
            default => null,
        };
    }

    // =====================================================================
    // RENDER
    // =====================================================================

    public function render()
    {
        return view('livewire.attachments.attachment-manager', [
            'attachments' => $this->attachments,
        ]);
    }
}
