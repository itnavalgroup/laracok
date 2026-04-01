<?php

namespace App\Livewire\Ikb;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Ikb;
use App\Models\SignTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Support\Str;

class Show extends Component
{
    public $ikbId;
    public $note;
    public $rejectReason;
    public $revisionReason;
    public $stuffingDate;
    public $deliveryDate;

    public function mount($hash)
    {
        $id = hashid_decode($hash, 'ikb');
        abort_if(!$id, 404);

        $this->ikbId = $id;

        $ikb = Ikb::findOrFail($id);
        $user = Auth::user();

        $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();

        // Check view permissions
        $canView = $user->level === 1
            || $user->id_user == $ikb->id_user
            || $user->id_user == $ikb->sales
            || $user->hasPermission('ikb.view.all')
            || ($user->hasPermission('ikb.view.dept') && $user->id_departement == $ikb->id_departement)
            || ($user->hasPermission('ikb.view.warehouse') && $user->id_warehouse == $ikb->id_warehouse)
            || ($user->hasPermission('ikb.view.subordinate') && (in_array($ikb->sales, $subordinateIds) || in_array($ikb->id_user, $subordinateIds)))
            || $user->hasPermission('ikb.approve.step1')
            || $user->hasPermission('ikb.approve.step2')
            || $user->hasPermission('ikb.approve.step3')
            || $user->hasPermission('ikb.approve.step4')
            || $user->hasPermission('ikb.approve.step5')
            || $user->hasPermission('ikb.approve.step6')
            || $user->hasPermission('ikb.approve.step7')
            || $user->hasPermission('ikb.approve.step8')
            || $user->hasPermission('ikb.approve.step9');

        abort_if(!$canView, 403);
    }

    #[On('ikb-refresh')]
    public function refresh()
    {
        // Just used to trigger re-render
    }

    public function getQr($text)
    {
        try {
            $qr = new QrCode(
                data: $text,
                errorCorrectionLevel: ErrorCorrectionLevel::Low,
                size: 200,
                margin: 10
            );

            $writer = new PngWriter();
            $result = $writer->write($qr);

            return $result->getDataUri();
        } catch (\Throwable $e) {
            return '';
        }
    }

    public function render()
    {
        $ikb = Ikb::with([
            'user',
            'salesUser',
            'departement',
            'company',
            'warehouse',
            'vendor',
            'transactionType',
            'details.item',
            'attachments.user',
            'signTransactions.user'
        ])->findOrFail($this->ikbId);

        $user = Auth::user();
        $isLevel1 = $user->level == 1;

        // Determine if current user can submit
        $canSubmit = ($ikb->status == 0 || $ikb->status == 11) &&
            ($isLevel1 || ($user->id_user == $ikb->sales && $user->hasPermission('ikb.submit')));

        // Subordinate logic for Step 1
        $isSubordinateOfCurrentUser = in_array($ikb->sales, $user->subordinates()->pluck('id_user')->toArray());

        $canApproveStep1 = $ikb->status == 1 && ($isLevel1 || ($user->hasPermission('ikb.approve.step1') && $isSubordinateOfCurrentUser));
        $canApproveStep2 = $ikb->status == 2 && ($isLevel1 || $user->hasPermission('ikb.approve.step2'));
        $canApproveStep3 = $ikb->status == 3 && ($isLevel1 || $user->hasPermission('ikb.approve.step3'));
        $canApproveStep4 = $ikb->status == 4 && ($isLevel1 || $user->hasPermission('ikb.approve.step4'));
        $canApproveStep5 = $ikb->status == 5 && ($isLevel1 || $user->hasPermission('ikb.approve.step5'));
        $canApproveStep6 = $ikb->status == 6 && ($isLevel1 || $user->hasPermission('ikb.approve.step6'));
        $canApproveStep7 = $ikb->status == 7 && ($isLevel1 || $user->hasPermission('ikb.approve.step7'));
        $canApproveStep8 = $ikb->status == 8 && ($isLevel1 || $user->hasPermission('ikb.approve.step8'));
        $canApproveStep9 = $ikb->status == 9 && ($isLevel1 || $user->hasPermission('ikb.approve.step9'));

        // Approver signs
        $approverSigns = [];
        $signStatuses = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        foreach ($signStatuses as $stepStatus) {
            $sign = $ikb->signTransactions->where('id_doc_type', 4)->where('status', $stepStatus)->first();
            if ($sign) {
                // Determine step name
                $stepName = '';
                switch ($stepStatus) {
                    case 1:
                        $stepName = 'SPV/Manager';
                        break;
                    case 2:
                        $stepName = 'Director Log';
                        break;
                    case 3:
                        $stepName = 'PPIC';
                        break;
                    case 4:
                        $stepName = 'Inventory Control';
                        break;
                    case 5:
                        $stepName = 'Logistic Coord';
                        break;
                    case 6:
                        $stepName = 'Warehouse Staff';
                        break;
                    case 7:
                        $stepName = 'Warehouse SPV';
                        break;
                    case 8:
                        $stepName = 'Security Officer';
                        break;
                    case 9:
                        $stepName = 'Log Coord Final';
                        break;
                }

                $approverSigns[$stepStatus] = [
                    'step_name' => $stepName,
                    'user_name' => $sign->user->name ?? 'Unknown',
                    'date'      => $sign->created_at->format('d/m/Y H:i'),
                    'qr'        => $sign->qr,
                    'notes'     => $sign->notes
                ];
            }
        }

        // Permission flags for frontend
        $isOwnerEditor = $user->id_user == $ikb->id_user && $user->hasPermission('ikb_detail.edit');
        $isInvCtrlApprover = !$isLevel1 && $user->hasPermission('ikb.approve.step4');
        $canEditDetail = $isLevel1
            || (($isOwnerEditor) && ($ikb->status == 0 || $ikb->status == 11))
            || (($ikb->status >= 4 && $ikb->status <= 9) && ($isLevel1 || $user->hasPermission('ikb.approve.step4')));
        // isInvCtrlEditMode = true means only qty can be edited (not category/item/uom/packaging)
        $isInvCtrlEditMode = ($ikb->status >= 4 && $ikb->status <= 9) && $isInvCtrlApprover && !$isOwnerEditor;
        $canDeleteDetail = $isLevel1 || (($user->id_user == $ikb->id_user && $user->hasPermission('ikb_detail.delete')) && ($ikb->status == 0 || $ikb->status == 11));

        return view('livewire.ikb.show', [
            'ikb' => $ikb,
            'canSubmit' => $canSubmit,
            'canApproveStep1' => $canApproveStep1,
            'canApproveStep2' => $canApproveStep2,
            'canApproveStep3' => $canApproveStep3,
            'canApproveStep4' => $canApproveStep4,
            'canApproveStep5' => $canApproveStep5,
            'canApproveStep6' => $canApproveStep6,
            'canApproveStep7' => $canApproveStep7,
            'canApproveStep8' => $canApproveStep8,
            'canApproveStep9' => $canApproveStep9,
            'approverSigns' => $approverSigns,
            'canEditDetail' => $canEditDetail,
            'canDeleteDetail' => $canDeleteDetail,
            'isInvCtrlEditMode' => $isInvCtrlEditMode,
            'attachments' => \App\Models\Attachment::all(),
        ])->layout('layouts.app');
    }

    public function setStuffingDate()
    {
        $ikb = Ikb::findOrFail($this->ikbId);
        $user = Auth::user();

        if ($ikb->status != 6 || ($user->level != 1 && !$user->hasPermission('ikb.approve.step6'))) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Anda tidak memiliki hak untuk mengisi Stuffing Date.']);
            return;
        }

        $this->validate(['stuffingDate' => 'required|date'], [
            'stuffingDate.required' => 'Stuffing Date wajib diisi.',
            'stuffingDate.date' => 'Format tanggal tidak valid.',
        ]);

        $ikb->stuffing_date = $this->stuffingDate;
        $ikb->save();

        $this->dispatch('alert', ['type' => 'success', 'message' => 'Stuffing Date berhasil disimpan.']);
        $this->dispatch('ikb-refresh');
    }

    public function setDeliveryDate()
    {
        $ikb = Ikb::findOrFail($this->ikbId);
        $user = Auth::user();

        if ($ikb->status != 8 || ($user->level != 1 && !$user->hasPermission('ikb.approve.step8'))) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Anda tidak memiliki hak untuk mengisi Delivery Date.']);
            return;
        }

        $this->validate(['deliveryDate' => 'required|date'], [
            'deliveryDate.required' => 'Delivery Date wajib diisi.',
            'deliveryDate.date' => 'Format tanggal tidak valid.',
        ]);

        $ikb->delivery_date = $this->deliveryDate;
        $ikb->save();

        $this->dispatch('alert', ['type' => 'success', 'message' => 'Delivery Date berhasil disimpan.']);
        $this->dispatch('ikb-refresh');
    }

    public function submitIkb()
    {
        $ikb = Ikb::with('details')->findOrFail($this->ikbId);
        $user = Auth::user();

        // Permission check: Admin or (Sales AND ikb.submit)
        abort_if(
            $user->level != 1 &&
                !($user->id_user == $ikb->sales && $user->hasPermission('ikb.submit')),
            403
        );

        if ($ikb->details->isEmpty()) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'IKB tidak dapat diajukan karena belum ada item detail!']);
            return;
        }

        DB::beginTransaction();
        try {
            // Record Sales Signature (Box 1) - Metadata only
            $sign = new SignTransaction([
                'id_user' => $user->id_user,
                'id_ikb' => $ikb->id_ikb,
                'id_doc_type' => 4,
                'status' => 0, // Requestor/Sales Box
                'director_reason' => $this->note,
                // signature_file is now null as we use dynamic QR
            ]);
            $sign->save();

            $ikb->status = 1;
            $ikb->save();

            // Clear any previous rejection history for this doc type if needed?
            // Usually PR clears status 12 records here.
            SignTransaction::where('id_ikb', '=', $ikb->id_ikb)
                ->where('id_doc_type', '=', 4)
                ->where('status', '=', 12)
                ->delete();

            DB::commit();
            $this->note = null;
            $this->dispatch('alert', ['type' => 'success', 'message' => 'IKB berhasil diajukan!']);
            $this->dispatch('ikb-refresh');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Gagal submit: ' . $e->getMessage()]);
        }
    }

    public function cancelSubmit()
    {
        $ikb = Ikb::findOrFail($this->ikbId);
        $user = Auth::user();

        if ($ikb->status != 1) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'IKB tidak dapat dibatalkan pada status ini.']);
            return;
        }

        // Permission check: Admin or (Sales AND ikb.cancel_submit)
        if ($user->level != 1 && !($user->id_user == $ikb->sales && $user->hasPermission('ikb.cancel_submit'))) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Anda tidak memiliki hak akses untuk membatalkan submit ini (Harus Sales tertunjuk dengan izin cancel_submit).']);
            return;
        }

        DB::beginTransaction();
        try {
            $ikb->status = 0;
            $ikb->save();

            SignTransaction::where('id_ikb', '=', $ikb->id_ikb)
                ->where('id_doc_type', '=', 4)
                ->where('status', '=', 0)
                ->delete();

            DB::commit();
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Submit IKB berhasil dibatalkan.']);
            $this->dispatch('ikb-refresh');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Gagal membatalkan submit: ' . $e->getMessage()]);
        }
    }

    #[On('processSign')]
    public function processSign($action, $step, $note = '')
    {
        $this->note = $note;
        $this->rejectReason = $note;
        $this->revisionReason = $note;

        switch ($action) {
            case 'approve':
                $this->approve($step);
                break;
            case 'revision':
                $this->revision($step);
                break;
            case 'reject':
                $this->reject($step);
                break;
        }
    }

    public function approve($step)
    {
        $ikb = Ikb::with(['details'])->findOrFail($this->ikbId);
        $user = Auth::user();

        if ($ikb->status != $step) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Status IKB tidak sesuai untuk langkah persetujuan ini.']);
            return;
        }

        // --- STEP 6 (Box 7): Warehouse Staff - Stuffing Date required ---
        if ($step == 6 && !$ikb->stuffing_date) {
            $this->dispatch('alert', [
                'type' => 'error',
                'title' => 'Stuffing Date Belum Diisi',
                'message' => 'Stuffing Date wajib diisi sebelum melakukan approval Step 6. Klik tombol "Set Stuffing Date" di bagian informasi IKB.'
            ]);
            return;
        }

        // --- STEP 8 (Box 9): Security Officer - Delivery Date required ---
        if ($step == 8 && !$ikb->delivery_date) {
            $this->dispatch('alert', [
                'type' => 'error',
                'title' => 'Delivery Date Belum Diisi',
                'message' => 'Delivery Date wajib diisi sebelum melakukan approval Step 8. Klik tombol "Set Delivery Date" di bagian informasi IKB.'
            ]);
            return;
        }

        // --- STEP 4 (Box 5): Inventory Control - Stock Validation ---
        if ($step == 4) {
            foreach ($ikb->details as $detail) {
                // Total available stock in the specified warehouse AND company
                $totalIn = \App\Models\ItemTransaction::where('id_item', '=', $detail->id_item)
                    ->where('id_warehouse', '=', $ikb->id_warehouse)
                    ->where('id_company', '=', $ikb->id_company)
                    ->sum('income');
                $totalOut = \App\Models\ItemTransaction::where('id_item', '=', $detail->id_item)
                    ->where('id_warehouse', '=', $ikb->id_warehouse)
                    ->where('id_company', '=', $ikb->id_company)
                    ->sum('outcome');
                $actualStock = $totalIn - $totalOut;

                // Calculate reserved stock from other IKBs in progress (status >= 4 but < 10)
                // Must also filter by the same warehouse and company
                $reservedQty = \App\Models\IkbDetail::whereHas('ikb', function ($q) use ($ikb) {
                    $q->where('status', '>=', 4)
                        ->where('status', '<', 10)
                        ->where('id_warehouse', '=', $ikb->id_warehouse)
                        ->where('id_company', '=', $ikb->id_company)
                        ->where('id_ikb', '!=', $ikb->id_ikb);
                })
                    ->where('id_item', '=', $detail->id_item)
                    ->sum('qty');

                $availableStock = $actualStock - $reservedQty;

                if ($availableStock < $detail->qty) {
                    $itemName = $detail->item->item_name ?? 'Item ID: ' . $detail->id_item;
                    $this->dispatch('alert', [
                        'type' => 'error',
                        'title' => 'Stok Tidak Cukup',
                        'message' => "Stok untuk {$itemName} tidak mencukupi untuk Company ini. (Available: {$availableStock}, Requested: {$detail->qty})"
                    ]);
                    return;
                }
            }
        }

        // --- STEP 8 (Box 9): Security Officer - Attachment Validation ---
        if ($step == 8) {
            $lastStep7 = \App\Models\SignTransaction::where('id_ikb', '=', $ikb->id_ikb)
                ->where('status', '=', 7)
                ->latest()
                ->first();

            $query = \App\Models\AttachmentIkb::where('id_ikb', $ikb->id_ikb);
            if ($lastStep7) {
                $query->where('created_at', '>', $lastStep7->created_at);
            }

            if (!$query->exists()) {
                $this->dispatch('alert', [
                    'type' => 'error',
                    'message' => 'Anda wajib mengunggah dokumen/foto (Step 8) sebelum melakukan approval.'
                ]);
                return;
            }
        }

        // --- STEP 9 (Box 10): Logistic Coord Final - Security Officer Attachment Validation ---
        if ($step == 9) {
            $lastStep7 = \App\Models\SignTransaction::where('id_ikb', '=', $ikb->id_ikb)
                ->where('status', '=', 7)
                ->latest()
                ->first();

            $query = \App\Models\AttachmentIkb::where('id_ikb', $ikb->id_ikb);
            if ($lastStep7) {
                $query->where('created_at', '>', $lastStep7->created_at);
            }

            if (!$query->exists()) {
                $this->dispatch('alert', [
                    'type' => 'error',
                    'message' => 'Persetujuan Final (Step 9) tidak bisa dilakukan karena dokumen/foto security (Step 8) belum diunggah.'
                ]);
                return;
            }
        }

        DB::beginTransaction();
        try {
            $sign = new SignTransaction([
                'id_user' => $user->id_user,
                'id_ikb' => $ikb->id_ikb,
                'id_doc_type' => 4,
                'status' => $step,
                'director_reason' => $this->note,
            ]);
            $sign->save();

            // Next step Logic
            if ($step == 9) {
                // Final approval implies Status 10 (Approved/Completed)
                $ikb->status = 10;

                // --- STOCK DEDUCTION ---
                $trxCodePrefix = 'IKB-' . ($ikb->ikb_number ?? 'TEMP');

                // Pre-emptively force delete any existing transactions with this prefix (including soft-deleted ones)
                \App\Models\ItemTransaction::withTrashed()
                    ->where('transaction_code', 'LIKE', $trxCodePrefix . '%')
                    ->where('id_doc_type', '=', 4)
                    ->forceDelete();

                // Build detailed description for fields that don't have direct columns
                $descParts = [];
                if ($ikb->ri_number) $descParts[] = "RI: " . $ikb->ri_number;
                if ($ikb->sk_number) $descParts[] = "SK: " . $ikb->sk_number;
                if ($ikb->do_number) $descParts[] = "DO: " . $ikb->do_number;
                if ($ikb->batch_number) $descParts[] = "Batch: " . $ikb->batch_number;
                if ($ikb->destination) $descParts[] = "Dest: " . $ikb->destination;
                if ($ikb->delivery_date) $descParts[] = "Delivery: " . \Carbon\Carbon::parse($ikb->delivery_date)->format('d/m/Y');

                $description = implode(' | ', $descParts);

                foreach ($ikb->details as $index => $detail) {
                    \App\Models\ItemTransaction::create([
                        'id_user' => $user->id_user,
                        'id_item' => $detail->id_item,
                        'id_item_category' => $detail->id_item_category,
                        'id_warehouse' => $ikb->id_warehouse,
                        'id_company' => $ikb->id_company,
                        'id_departement' => $ikb->id_departement,
                        'id_uom' => $detail->id_uom,
                        'id_packaging' => $detail->id_packaging,
                        'id_doc_type' => 4,
                        'transaction_code' => $trxCodePrefix . '-' . ($index + 1),
                        'income' => 0,
                        'outcome' => $detail->qty,
                        'transaction_date' => now(),
                        'id_vendor' => $ikb->id_vendor,
                        'po_number' => $ikb->po_number,
                        'so_number' => $ikb->so_number,
                        'description' => $description,
                    ]);
                }
            } else {
                $ikb->status = $step + 1;
            }
            $ikb->save();

            DB::commit();
            $this->dispatch('alert', ['type' => 'success', 'message' => "IKB berhasil di-approve (Step {$step})."]);
            $this->dispatch('ikb-refresh');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function revision($step)
    {
        if (empty($this->revisionReason)) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Alasan revisi wajib diisi.']);
            return;
        }

        $ikb = Ikb::findOrFail($this->ikbId);
        $user = Auth::user();

        DB::beginTransaction();
        try {
            $ikb->status = 11; // Revision status
            // Reset stuffing_date and delivery_date when revision resets the flow
            $ikb->stuffing_date = null;
            $ikb->delivery_date = null;
            $ikb->save();

            // Record revision record
            $sign = new SignTransaction([
                'id_user' => $user->id_user,
                'id_ikb' => $ikb->id_ikb,
                'id_doc_type' => 4,
                'status' => 11,
                'reject_reason' => $this->revisionReason,
            ]);
            $sign->save();

            // Delete attachments uploaded at Step 8 if revision is triggered from Step 8 or later
            if ($step >= 8) {
                $this->deleteStep8Attachments($ikb);
            }

            // Clear all previous approvals (except the revision itself)
            SignTransaction::where('id_ikb', '=', $ikb->id_ikb)
                ->where('id_doc_type', '=', 4)
                ->where('id_sign_transaction', '!=', $sign->id_sign_transaction)
                ->delete();

            DB::commit();
            $this->revisionReason = null;
            $this->dispatch('alert', ['type' => 'success', 'message' => 'IKB dikembalikan untuk revisi.']);
            $this->dispatch('ikb-refresh');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Gagal revisi: ' . $e->getMessage()]);
        }
    }

    public function reject($step)
    {
        if (empty($this->rejectReason)) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Alasan penolakan wajib diisi.']);
            return;
        }

        $ikb = Ikb::findOrFail($this->ikbId);
        $user = Auth::user();

        DB::beginTransaction();
        try {
            $ikb->status = 12; // Rejected
            // Reset stuffing_date and delivery_date when IKB is rejected
            $ikb->stuffing_date = null;
            $ikb->delivery_date = null;
            $ikb->save();

            $sign = new SignTransaction([
                'id_user' => $user->id_user,
                'id_ikb' => $ikb->id_ikb,
                'id_doc_type' => 4,
                'status' => 12,
                'reject_reason' => $this->rejectReason,
            ]);
            $sign->save();

            // Delete Step 8 attachments if rejecting from Step 8 or later
            if ($step >= 8) {
                $this->deleteStep8Attachments($ikb);
            }

            DB::commit();
            $this->rejectReason = null;
            $this->dispatch('alert', ['type' => 'success', 'message' => 'IKB berhasil ditolak.']);
            $this->dispatch('ikb-refresh');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Gagal menolak: ' . $e->getMessage()]);
        }
    }

    public function cancelApproval()
    {
        $ikb = Ikb::findOrFail($this->ikbId);
        $status = intval($ikb->status);
        $currentStep = $status - 1;

        if ($status < 2 || $status > 10) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Approval tidak dapat dibatalkan pada status ini.']);
            return;
        }

        $user = Auth::user();
        $sign = SignTransaction::where('id_ikb', '=', $ikb->id_ikb)
            ->where('id_doc_type', '=', 4)
            ->where('status', '=', $currentStep)
            ->first();

        // Admin or the last signer can cancel
        if ($user->level !== 1 && (!$sign || $user->id_user !== $sign->id_user)) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Anda tidak memiliki hak akses untuk membatalkan approval ini.']);
            return;
        }

        DB::beginTransaction();
        try {
            // Delete Step 8 attachments if we are cancelling Step 8 or Step 9
            // $status 8 -> $currentStep 7 (cancelling Step 7 approval, rolling back to Step 8 start)
            // $status 9 -> $currentStep 8 (cancelling Step 8 approval, rolling back to Step 9 start)
            if ($currentStep == 7 || $currentStep == 8) {
                $this->deleteStep8Attachments($ikb);
            }

            $ikb->status = $currentStep;

            // Clear stuffing_date when cancelling step 6, delivery_date when cancelling step 8
            if ($currentStep == 6) {
                $ikb->stuffing_date = null;
            }
            if ($currentStep == 8) {
                $ikb->delivery_date = null;
            }

            $ikb->save();

            if ($status == 10) {
                // Final approval cancelled, force delete all associated stock deduction records
                // Use withTrashed(), LIKE pattern, and forceDelete() to handle multi-item IKBs
                $trxCodePrefix = 'IKB-' . ($ikb->ikb_number ?? 'TEMP');
                \App\Models\ItemTransaction::withTrashed()
                    ->where('transaction_code', 'LIKE', $trxCodePrefix . '%')
                    ->where('id_doc_type', '=', 4)
                    ->forceDelete();
            }

            if ($sign) {
                $sign->delete();
            }

            DB::commit();
            $this->dispatch('alert', ['type' => 'success', 'message' => 'Approval berhasil dibatalkan.']);
            $this->dispatch('ikb-refresh');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Gagal membatalkan approval: ' . $e->getMessage()]);
        }
    }

    private function deleteStep8Attachments($ikb)
    {
        // Temukan record approval Step 7 yang terakhir (saat status IKB menjadi 8)
        $lastStep7 = \App\Models\SignTransaction::withTrashed()
            ->where('id_ikb', '=', $ikb->id_ikb)
            ->where('status', '=', 7)
            ->latest()
            ->first();

        if (!$lastStep7) return;

        // Semua attachment yang diupload setelah approval Step 7 adalah milik Step 8
        $attachments = \App\Models\AttachmentIkb::where('id_ikb', $ikb->id_ikb)
            ->where('created_at', '>', $lastStep7->created_at)
            ->get();

        foreach ($attachments as $att) {
            $filePath = public_path('assets/attachmentikb/' . $att->filename);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
            $att->forceDelete();
        }
    }

    #[On('delete-detail')]
    public function deleteDetail($id)
    {
        $detail = \App\Models\IkbDetail::findOrFail($id);
        $ikb = $detail->ikb;
        $user = Auth::user();

        // Permission check
        $canDelete = $user->level == 1 || ($user->id_user == $ikb->id_user && $user->hasPermission('ikb_detail.delete') && ($ikb->status == 0 || $ikb->status == 11));

        if (!$canDelete) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Anda tidak memiliki hak akses untuk menghapus item ini atau status IKB tidak sesuai.']);
            return;
        }

        if (!in_array($ikb->status, [0, 11])) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Tidak dapat menghapus item saat IKB sedang diproses.']);
            return;
        }

        if ($ikb->status == 11) {
            $ikb->status = 0;
            $ikb->save();
        }

        $detail->delete();
        $this->dispatch('alert', ['type' => 'success', 'message' => 'Item berhasil dihapus.']);
        $this->dispatch('ikb-refresh');
    }
}
