<?php

namespace App\Livewire\Attachments;

use App\Models\Attachment;
use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $departmentFilter = '';

    // Form fields
    public $id_attachment;
    public $attachment;
    public $id_departement;

    public $isEditing = false;
    public $file_excel;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'departmentFilter' => ['except' => ''],
    ];

    public function mount()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('attachment.view'), 403);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('attachment.create'), 403);
        $this->resetForm();
        $this->isEditing = false;
        $this->dispatch('openAttachmentModal');
    }

    public function edit($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('attachment.edit'), 403);
        $this->resetForm();
        $item = Attachment::findOrFail($id);
        $this->id_attachment = $item->id_attachment;
        $this->attachment = $item->attachment;
        $this->id_departement = $item->id_departement;
        $this->isEditing = true;
        $this->dispatch('openAttachmentModal');
    }

    public function resetForm()
    {
        $this->id_attachment = null;
        $this->attachment = '';
        $this->id_departement = Auth::user()->level === 1 ? 0 : Auth::user()->id_departement;
        $this->resetErrorBag();
    }

    public function save()
    {
        $permission = $this->isEditing ? 'attachment.edit' : 'attachment.create';
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission($permission), 403);

        $rules = [
            'attachment' => 'required|string|max:255',
            'id_departement' => 'required|integer',
        ];

        $this->validate($rules);

        $data = [
            'attachment' => $this->attachment,
            'id_departement' => $this->id_departement,
            'id_user' => Auth::id(),
        ];

        if ($this->isEditing) {
            Attachment::find($this->id_attachment)->update($data);
            $message = 'Jenis lampiran berhasil diperbarui.';
        } else {
            Attachment::create($data);
            $message = 'Jenis lampiran baru berhasil ditambahkan.';
        }

        $this->dispatch('closeAttachmentModal');
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => $this->isEditing ? 'Berhasil' : 'Tersimpan',
            'message' => $message,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('attachment.delete'), 403);

        $item = Attachment::findOrFail($id);

        // Deletion Restriction: Check usage in PR, SR, and Payment attachments
        $isUsedInPr = DB::table('tbl_attachment_pr')->where('id_attachment', $id)->exists();
        $isUsedInSr = DB::table('tbl_attachment_sr')->where('id_attachment', $id)->exists();
        $isUsedInPayment = DB::table('tbl_attachment_payment')->where('id_attachment', $id)->exists();

        if ($isUsedInPr || $isUsedInSr || $isUsedInPayment) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Lampiran tidak dapat dihapus karena masih digunakan dalam dokumen transaksi.',
            ]);
            return;
        }

        $item->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Dihapus',
            'message' => 'Jenis lampiran telah dihapus.',
        ]);
    }

    public function downloadTemplate()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('attachment.upload'), 403);

        $headers = ['attachment_name'];
        $data = [['Contoh Nama Lampiran (Misal: KTP / NPWP / SIUP)']];

        return Excel::download(new \App\Exports\GenericExport($headers, $data), 'template_import_attachment.xlsx');
    }

    public function import()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('attachment.upload'), 403);

        $this->validate([
            'file_excel' => 'required|mimes:xlsx,xls|max:5120',
        ]);

        try {
            $data = Excel::toArray([], $this->file_excel->getRealPath());
            $rows = $data[0] ?? [];
            $count = 0;

            if (count($rows) > 1) {
                foreach ($rows as $index => $row) {
                    if ($index === 0) continue; // Skip header

                    $attachment_name = trim($row[0] ?? '');
                    if ($attachment_name === '') continue;

                    Attachment::updateOrCreate(
                        ['attachment' => $attachment_name, 'id_departement' => Auth::user()->level === 1 ? 0 : Auth::user()->id_departement],
                        ['id_user' => Auth::id()]
                    );
                    $count++;
                }
            }

            $this->dispatch('closeImportModal');
            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => "$count data lampiran berhasil diimport.",
            ]);
            $this->file_excel = null;
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Terjadi kesalahan saat mengimport data: ' . $e->getMessage(),
            ]);
        }
    }

    public function export()
    {
        abort_if(Auth::user()->level !== 1 && !Auth::user()->hasPermission('attachment.download'), 403);

        $attachments = Attachment::with(['departement', 'creator'])
            ->when($this->departmentFilter, fn($q) => $q->where('id_departement', $this->departmentFilter))
            ->get();

        $headers = ['ID', 'Nama Lampiran', 'Departement', 'Dibuat Oleh', 'Tgl Dibuat'];
        $data = $attachments->map(fn($item) => [
            $item->id_attachment,
            $item->attachment,
            $item->departement->departement ?? 'Global',
            $item->creator->name ?? 'System',
            $item->created_at->format('d/m/Y H:i')
        ])->toArray();

        return Excel::download(new \App\Exports\GenericExport($headers, $data), 'Data_Lampiran_' . date('Ymd_His') . '.xlsx');
    }

    public function render()
    {
        $query = Attachment::with(['departement', 'creator']);

        if ($this->search) {
            $query->where('attachment', 'like', '%' . $this->search . '%');
        }

        if ($this->departmentFilter) {
            $query->where('id_departement', $this->departmentFilter);
        }

        $attachments = $query->orderBy('id_attachment', 'desc')->paginate($this->perPage);

        return view('livewire.attachments.index', [
            'attachments' => $attachments,
            'departments' => Departement::all(),
            'totalAttachments' => Attachment::count(),
        ]);
    }
}
