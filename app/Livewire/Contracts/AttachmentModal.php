<?php

namespace App\Livewire\Contracts;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttachmentModal extends Component
{
    use WithFileUploads;

    public $contractId;
    public $file = null;

    protected function rules(): array
    {
        return [
            'file' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
        ];
    }

    protected $messages = [
        'file.required' => 'File wajib dipilih.',
        'file.max'      => 'Ukuran file maksimal 5 MB.',
        'file.mimes'    => 'Format file harus PDF atau gambar (jpg, jpeg, png).',
    ];

    #[On('openContractAttachmentModal')]
    public function openModal($contractId)
    {
        // Livewire 3 sometimes passes params wrapped in array
        if (is_array($contractId)) {
            $contractId = $contractId[0] ?? null;
        }
        $this->reset(['file']);
        $this->contractId = $contractId;
        $this->dispatch('show-contract-attachment-modal');
    }

    public function save()
    {
        $this->validate();

        $user     = Auth::user();
        $contract = Contract::findOrFail($this->contractId);

        // Only owner or admin can upload
        if ($user->level !== 1 && $user->id_user !== $contract->id_user) {
            $this->addError('file', 'Anda tidak memiliki akses untuk upload file kontrak ini.');
            return;
        }

        DB::beginTransaction();
        try {
            // Delete old file if exists
            if ($contract->file_name) {
                $oldPath = public_path('assets/contract/' . $contract->file_name);
                if (is_file($oldPath)) {
                    unlink($oldPath);
                }
            }

            $ext     = $this->file->getClientOriginalExtension();
            $filename = 'CTR_' . $contract->id_contract . '_' . time() . '.' . $ext;
            $destDir  = public_path('assets/contract');

            if (!is_dir($destDir)) {
                mkdir($destDir, 0775, true);
            }

            // Copy from Livewire tmp using getRealPath() to avoid move() permission issues
            copy($this->file->getRealPath(), $destDir . DIRECTORY_SEPARATOR . $filename);

            $contract->update(['file_name' => $filename]);

            DB::commit();
            $this->reset(['file']);
            $this->dispatch('hide-contract-attachment-modal');
            $this->dispatch('alert', ['type' => 'success', 'message' => 'File kontrak berhasil diupload.']);
            $this->dispatch('contract-refresh');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('file', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteFile()
    {
        $user     = Auth::user();
        $contract = Contract::findOrFail($this->contractId);

        if ($user->level !== 1 && $user->id_user !== $contract->id_user) {
            $this->dispatch('alert', ['type' => 'danger', 'message' => 'Anda tidak memiliki akses.']);
            return;
        }

        if ($contract->file_name) {
            $path = public_path('assets/contract/' . $contract->file_name);
            if (is_file($path)) unlink($path);
            $contract->update(['file_name' => null]);
        }

        $this->dispatch('alert', ['type' => 'success', 'message' => 'File berhasil dihapus.']);
        $this->dispatch('contract-refresh');
    }

    public function render()
    {
        return view('livewire.contracts.attachment-modal');
    }
}
