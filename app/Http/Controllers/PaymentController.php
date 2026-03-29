<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pr;
use App\Models\Payment;
use App\Models\PaymentAttachment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class PaymentController extends Controller
{
    // =========================================================================
    // ACCESS HELPERS (Mirror CI4: canAccessPayment, canApprovePayment)
    // =========================================================================

    /**
     * Cek apakah user boleh mengakses/memodifikasi payment
     * CI4: canAccessPayment() – level 1,5,6,7,8 atau creator PR
     * Laravel: level 1, atau creator PR, atau pr.payment / pr_payment.create
     */
    public function canAccessPayment(Pr $pr): bool
    {
        $user   = Auth::user();
        $status = intval($pr->status);

        // Status PR yang boleh diakses payment-nya
        if (!in_array($status, [7, 8, 9, 10, 11, 14, 15])) {
            return false;
        }

        return $user->level === 1
            || $user->id_user == $pr->id_user
            || $user->hasPermission('pr.payment')
            || $user->hasPermission('pr_payment.create')
            || $user->hasPermission('pr_payment.view');
    }

    /**
     * Cek apakah user boleh create payment.
     * Full: hanya pr_payment.create
     * Parsial: owner PR atau pr_payment.create
     */
    private function canCreatePayment(Pr $pr, int $paymentType): bool
    {
        $user = Auth::user();

        if ($user->level === 1 || $user->hasPermission('pr_payment.create')) {
            return true;
        }

        if ($paymentType == 1 && $user->id_user == $pr->id_user) {
            return true;
        }

        return false;
    }

    private function canEditPayment(Payment $payment): bool
    {
        $user = Auth::user();
        return $user->level === 1 || $user->id_user == $payment->id_user;
    }

    private function canDeletePayment(Payment $payment): bool
    {
        return $this->canEditPayment($payment);
    }

    /**
     * Update status PR setelah payment berubah
     */
    public function updatePrStatusAfterPayments(int $idPr, int $idDocType): void
    {
        $pr = Pr::findOrFail($idPr);

        $payments = Payment::where('id_pr', $idPr)
            ->where('id_doc_type', $idDocType)
            ->orderBy('id_payment', 'DESC')
            ->get();

        if ($payments->isEmpty()) {
            $pr->update(['status' => 7]);
            return;
        }

        // ============================================================
        // payment_type_pr == 1 → harus approval
        // ============================================================
        if ($pr->payment_type_pr == 1) {
            $lastPayment = $payments->first();

            // Jika ada attachment payment, berarti sudah paid (Partial=8, Full=11)
            $attCount = PaymentAttachment::where('id_payment', $lastPayment->id_payment)->count();
            if ($attCount > 0) {
                $status = ($lastPayment->payment_type == 2) ? 11 : 8;
                $pr->update(['status' => $status]);
                return;
            }

            // Jika belum ada filename (QR sign) ATAU ada catatan revisi
            if (empty($lastPayment->filename) || !empty($lastPayment->reason)) {
                // Jangan reset status jika sudah 14 (Pending Director) dan TIDAK ada revisi
                if ($pr->status != 14 || !empty($lastPayment->reason)) {
                    $pr->update(['status' => 15]); // Pending Manager
                }
                return;
            }
        }

        // ============================================================
        // Hitung status dari payment terakhir (Normal Flow)
        // ============================================================
        $lastPayment = $payments->first();
        $type        = intval($lastPayment->payment_type);

        $attCount = PaymentAttachment::where('id_payment', $lastPayment->id_payment)->count();

        if ($type == 2) { // FULL
            $status = ($attCount > 0) ? 11 : 10;
        } else { // PARTIAL
            $status = ($attCount > 0) ? 8 : 9;
        }

        $pr->update(['status' => $status]);
    }

    // =========================================================================
    // SIMPAN PAYMENT (CI4: simpanpayment)
    // =========================================================================

    public function store(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr = Pr::findOrFail($id);

        if (!$this->canCreatePayment($pr, $request->payment_type)) {
            return back()->with('error', 'Anda tidak berhak menambahkan payment.');
        }

        // CI4: hanya boleh tambah payment saat status 7 atau 8
        if (!in_array($pr->status, [7, 8])) {
            return back()->with('error', 'Payment hanya dapat ditambahkan saat status Pending Payment atau Payment Parsial (status 7/8).');
        }

        // Cek apakah ada payment yang sedang direvisi (KHUSUS payment_type_pr == 1)
        if ($pr->payment_type_pr == 1) {
            $hasRevision = Payment::where('id_pr', $id)
                ->where(fn($q) => $q->whereNotNull('reason')->where('reason', '!=', ''))
                ->exists();
            if ($hasRevision) {
                return back()->with('error', 'Silakan perbaiki payment yang direvisi terlebih dahulu sebelum menambahkan payment baru.');
            }
        }

        $paymentFinished = Payment::where('id_pr', $id)
            ->where('id_doc_type', $pr->id_doc_type)
            ->where('payment_type', 2) // must be FULL payment
            ->where('status', 2)       // and must be CONFIRMED (status 2)
            ->exists();

        if ($paymentFinished) {
            return back()->with('error', 'PR ini sudah selesai.');
        }

        $request->validate([
            'payment_type'   => 'required|in:1,2',
            'nama_bank'      => 'required|string',
            'norek'          => 'required|string',
            'amount'         => 'required|numeric|min:0',
            'additional'     => 'nullable|numeric',
            'payment_date'   => 'required|date',
        ]);

        $paymentType = intval($request->payment_type);

        if (!$this->canCreatePayment($pr, $paymentType)) {
            return back()->with('error', 'Anda tidak berhak menambahkan payment dengan tipe ini.');
        }

        $amount      = (float) $request->amount;
        $additional  = (float) ($request->additional ?? 0);
        $grandTotal  = $amount;

        // Ambil last payment untuk validasi
        $lastPayment = Payment::where('id_pr', $id)
            ->where('id_doc_type', $pr->id_doc_type)
            ->orderBy('id_payment', 'DESC')
            ->first();

        // CI4: tidak boleh tambah parsial jika sudah ada full
        if ($paymentType == 1 && $lastPayment && $lastPayment->payment_type == 2) {
            return back()->with('error', 'Tidak bisa menambah payment parsial karena sudah ada payment full.');
        }

        // CI4: tidak boleh tambah full jika sudah ada full
        if ($paymentType == 2 && $lastPayment && $lastPayment->payment_type == 2) {
            return back()->with('error', 'Payment full sudah ada, tidak boleh membuat payment full lagi.');
        }

        // Status payment record: 1=parsial, 2=full
        $paymentStatus = ($paymentType == 1) ? 1 : 2;

        // Tentukan initial PR status:
        // payment_type_pr=1 (parsial approval flow) → 15 (Pending Manager)
        // payment_type_pr=2 → partial=9, full=10
        if ($pr->payment_type_pr == 1) {
            $statusPr = 15;
        } else {
            $statusPr = ($paymentType == 1) ? 9 : 10;
        }

        DB::beginTransaction();
        try {
            Payment::create([
                'id_doc_type'         => $pr->id_doc_type,
                'id_pr'               => $id,
                'id_departement'      => $pr->id_departement,
                'id_cost_type'        => $pr->id_cost_type,
                'id_cost_category'    => $pr->id_cost_category,
                'id_branch'           => $pr->id_branch,
                'id_company'          => $pr->id_company,
                'id_vendor'           => $pr->id_vendor,
                'id_user'             => Auth::id(),
                'payment_description' => $request->payment_description,
                'payment_type'        => $paymentType,
                'payment_method'      => $request->payment_method,
                'nama_bank'           => $request->nama_bank,
                'nama_penerima'       => $request->nama_penerima,
                'norek'               => $request->norek,
                'payment_date'        => $request->payment_date,
                'ammount'             => $amount,
                'additional'          => $additional,
                'grand_total'         => $grandTotal,
                'status'              => $paymentStatus,
                'filename'            => ($pr->payment_type_pr == 2) ? 'approved_by_system' : null, // Auto approve jika full
            ]);

            // Set status awal PR dulu, lalu recalculate
            $pr->update(['status' => $statusPr]);
            $this->updatePrStatusAfterPayments($id, $pr->id_doc_type);

            DB::commit();

            // Kirim notifikasi WA
            $this->sendPaymentWhatsapp($pr, $amount, 'Mengajukan Pembayaran');

            return back()->with('success', 'Data Berhasil Di Tambahkan !!!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // =========================================================================
    // UPDATE PAYMENT (CI4: updatepayment)
    // =========================================================================

    public function update(Request $request, string $paymentHash)
    {
        $id = hashid_decode($paymentHash, 'payment');
        if (!$id) abort(404);

        $payment = Payment::findOrFail($id);
        $pr      = Pr::findOrFail($payment->id_pr);

        if (!$this->canEditPayment($payment)) {
            return back()->with('error', 'Anda tidak berhak mengubah payment ini.');
        }

        if ($pr->status == 11) {
            return back()->with('error', 'PR ini sudah selesai.');
        }

        // payment_type_pr == 1 (approval flow): hanya boleh edit saat status 15 (Pending Manager)
        if ($pr->payment_type_pr == 1) {
            if ($pr->status != 15) {
                return back()->with('error', 'Payment hanya dapat diubah saat status Pending Manager (status 15).');
            }
        } else {
            // payment_type_pr == 2: Tidak diblokir di status 9 / 10 karena itu status Pending Receipt (wajar).
            // Validasi attachment dihandle terpisah.
        }

        // Cek apakah ini last payment
        $lastPayment = Payment::where('id_pr', $payment->id_pr)
            ->where('id_doc_type', $pr->id_doc_type)
            ->orderBy('id_payment', 'DESC')
            ->first();

        if ($payment->payment_type == 1) {
            if (!$lastPayment || $lastPayment->id_payment != $payment->id_payment) {
                return back()->with('error', 'Hanya payment parsial terakhir yang dapat diupdate.');
            }
        } else {
            if (!$lastPayment || $lastPayment->id_payment != $payment->id_payment) {
                return back()->with('error', 'Hanya payment full terakhir yang dapat diupdate.');
            }
        }

        $request->validate([
            'payment_type'   => 'required|in:1,2',
            'nama_bank'      => 'required|string',
            'norek'          => 'required|string',
            'amount'         => 'required|numeric|min:0',
            'additional'     => 'nullable|numeric',
            'payment_date'   => 'required|date',
        ]);

        $paymentType = intval($request->payment_type);
        $amount      = (float) $request->amount;
        $additional  = (float) ($request->additional ?? 0);
        $grandTotal  = $amount;
        $paymentStatus = ($paymentType == 1) ? 1 : 2;

        DB::beginTransaction();
        try {
            $payment->update([
                'id_doc_type'         => $pr->id_doc_type,
                'id_pr'               => $payment->id_pr,
                'id_departement'      => $pr->id_departement,
                'id_cost_type'        => $pr->id_cost_type,
                'id_cost_category'    => $pr->id_cost_category,
                'id_branch'           => $pr->id_branch,
                'id_company'          => $pr->id_company,
                'id_vendor'           => $pr->id_vendor,
                'id_user'             => Auth::id(),
                'payment_description' => $request->payment_description,
                'payment_type'        => $paymentType,
                'payment_method'      => $request->payment_method,
                'nama_bank'           => $request->nama_bank,
                'nama_penerima'       => $request->nama_penerima,
                'norek'               => $request->norek,
                'payment_date'        => $request->payment_date,
                'ammount'             => $amount,
                'additional'          => $additional,
                'grand_total'         => $grandTotal,
                'status'              => $paymentStatus,
                'reason'              => null, // Clear revision reason
            ]);

            $this->updatePrStatusAfterPayments($payment->id_pr, $pr->id_doc_type);

            DB::commit();

            // Kirim notifikasi WA
            $this->sendPaymentWhatsapp($pr, $amount, 'Mengubah Pengajuan Pembayaran');

            return back()->with('success', 'Data Berhasil Di Update !!!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // =========================================================================
    // HAPUS PAYMENT (CI4: deletepayment)
    // =========================================================================

    public function destroy(string $paymentHash)
    {
        $id = hashid_decode($paymentHash, 'payment');
        if (!$id) abort(404);

        $payment   = Payment::findOrFail($id);
        $pr        = Pr::findOrFail($payment->id_pr);
        $user      = Auth::user();
        $idDocType = $payment->id_doc_type;

        if (!$this->canDeletePayment($payment)) {
            return back()->with('error', 'Anda tidak berhak menghapus payment ini.');
        }

        if ($pr->status == 11) {
            return back()->with('error', 'PR sudah selesai, tidak dapat menghapus payment.');
        }

        // payment_type_pr == 1 (approval flow): hanya boleh hapus saat status 15 (Pending Manager)
        if ($pr->payment_type_pr == 1) {
            if ($pr->status != 15) {
                return back()->with('error', 'Payment hanya dapat dihapus saat status Pending Manager (status 15).');
            }
        } else {
            // payment_type_pr == 2: Tidak diblokir di status 9 / 10 karena itu status Pending Receipt.
            // Boleh dihapus jika belum ada attachment.
        }

        // Ambil last payment untuk validasi
        $lastPayment = Payment::where('id_pr', $payment->id_pr)
            ->where('id_doc_type', $idDocType)
            ->orderBy('id_payment', 'DESC')
            ->first();

        if ($payment->payment_type == 1) { // parsial
            // Tidak bisa hapus parsial jika sudah ada full
            if ($lastPayment && $lastPayment->payment_type == 2) {
                return back()->with('error', 'Tidak bisa menghapus payment parsial karena sudah ada payment full.');
            }
            // Hanya last parsial yang bisa dihapus
            if (!$lastPayment || $lastPayment->id_payment != $payment->id_payment) {
                return back()->with('error', 'Hanya payment parsial terakhir yang dapat dihapus.');
            }
        } else { // full
            if (!$lastPayment || $lastPayment->id_payment != $payment->id_payment) {
                return back()->with('error', 'Payment full harus menjadi payment terakhir. Tidak boleh dihapus.');
            }
            // Cek attachment: full payment dengan attachment tidak bisa dihapus
            $attCount = PaymentAttachment::where('id_payment', $payment->id_payment)->count();
            if ($attCount > 0) {
                return back()->with('error', 'Payment full memiliki attachment. Tidak bisa dihapus.');
            }
        }

        DB::beginTransaction();
        try {
            $idPr = $payment->id_pr;

            // Hapus attachment files dan records untuk payment ini
            $attachments = PaymentAttachment::where('id_payment', $payment->id_payment)->get();
            foreach ($attachments as $att) {
                if (!empty($att->filename)) {
                    $file = public_path('assets/attachmentpayment') . DIRECTORY_SEPARATOR . $att->filename;
                    if (is_file($file)) unlink($file);
                }
            }
            PaymentAttachment::where('id_payment', $payment->id_payment)->delete();

            $payment->delete();

            $this->updatePrStatusAfterPayments($idPr, $idDocType);

            DB::commit();

            $this->sendPaymentWhatsapp($pr, 0, 'Menghapus Pembayaran');

            return back()->with('success', 'Data Berhasil Di Hapus !!!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // =========================================================================
    // APPROVE PAYMENT DIRECTOR (CI4: approvePaymentDirector)
    // Permission: pr_payment.approve.step2 (= CI4 level 4 = Director)
    // =========================================================================

    public function approveDirector(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr   = Pr::findOrFail($id);
        $user = Auth::user();

        // Cek Permission
        $canApprove = $user->level === 1
            || $user->hasPermission('pr_payment.approve.step2');

        if (!$canApprove) {
            return back()->with('error', 'Anda tidak berhak menyetujui payment.');
        }

        // Hanya untuk payment_type_pr == 1 dan status 14
        if ($pr->payment_type_pr != 1 || $pr->status != 14) {
            return back()->with('error', 'Kondisi PR tidak valid untuk approve payment.');
        }

        // Ambil payment terakhir yg statusnya belum finish (contoh: filename string tdk komplit / blm ada)
        // Note: filename manager diisi string spesial saat step 1, saat step 2 kita override dgn string final
        $payment = Payment::where('id_pr', $id)
            ->where('id_doc_type', $pr->id_doc_type)
            ->orderBy('id_payment', 'DESC')
            ->first();

        if (!$payment) {
            return back()->with('error', 'Tidak ada payment yang perlu diapprove.');
        }

        DB::beginTransaction();
        try {
            // Kita tidak bikin fisik file, cukup isi string identitas
            $directorSignature = 'approved_director_' . $user->id_user . '_' . time();

            // Ambil signature lama (manager) jika ada, lalu gabung
            $newFilename = $payment->filename ? $payment->filename . '|' . $directorSignature : $directorSignature;

            // Simpan filename QR-string ke payment record (Tanpa reason untuk approve)
            $payment->update([
                'filename' => $newFilename,
                'status'   => 2, // 2 = Paid/Selesai untuk row ini
            ]);

            // Update PR status
            $this->updatePrStatusAfterPayments($id, $pr->id_doc_type);

            DB::commit();

            // Notif WA ke Finance (level 6)
            $this->sendApprovePaymentWhatsapp($pr);

            return redirect()->route('payment-requests.index')->with('success', 'Payment berhasil disetujui oleh Director.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // =========================================================================
    // APPROVE PAYMENT MANAGER (Step 1 - Status 15 -> 14)
    // Permission: pr_payment.approve.step1
    // =========================================================================

    public function approveStep1(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr   = Pr::findOrFail($id);
        $user = Auth::user();

        // Cek permission: pr_payment.approve.step1 DAN harus 1 departemen dengan pembuat PR
        // Level 1 (admin) bebas
        $canApprove = $user->level === 1 || (
            $user->hasPermission('pr_payment.approve.step1') &&
            $user->id_departement == $pr->user->id_departement
        );

        if (!$canApprove) {
            return back()->with('error', 'Anda tidak berhak menyetujui payment pada tahap ini.');
        }

        if ($pr->payment_type_pr != 1 || $pr->status != 15) {
            return back()->with('error', 'Kondisi PR tidak valid untuk approve payment manager.');
        }

        // Ambil payment terakhir yg blm diapprove (string manager null)
        $payment = Payment::where('id_pr', $id)
            ->where('id_doc_type', $pr->id_doc_type)
            ->orderBy('id_payment', 'DESC')
            ->first();

        DB::beginTransaction();
        try {
            // Tandai manager sudah approve dengan string spesial di filename
            if ($payment) {
                $managerSignature = 'approved_manager_' . $user->id_user . '_' . time();
                $payment->update([
                    'filename' => $managerSignature
                ]);
            }

            // Update PR status ke 14 (Pending Director Sign)
            $pr->update(['status' => 14]);
            DB::commit();

            return redirect()->route('payment-requests.index')->with('success', 'Payment berhasil disetujui oleh Manager.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cancelApproveStep1(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr   = Pr::findOrFail($id);
        $user = Auth::user();

        $canCancel = $user->level === 1 || (
            $user->hasPermission('pr_payment.cancel_approve.step1') &&
            $user->id_departement == $pr->user->id_departement
        );

        if (!$canCancel) {
            return back()->with('error', 'Anda tidak berhak membatalkan approval payment tahap ini.');
        }

        if ($pr->status != 14) {
            return back()->with('error', 'Hanya bisa membatalkan saat status Menunggu Director (14).');
        }

        $payment = Payment::where('id_pr', $id)
            ->where('id_doc_type', $pr->id_doc_type)
            ->orderBy('id_payment', 'DESC')
            ->first();

        // Pastikan director belum approve, kita ngecek string
        if ($payment && str_contains($payment->filename, 'approved_director')) {
            return back()->with('error', 'Tidak bisa dibatalkan karena Director sudah menyetujui payment.');
        }

        DB::beginTransaction();
        try {
            if ($payment) {
                $payment->update(['filename' => null]);
            }
            $pr->update(['status' => 15]);
            DB::commit();
            return redirect()->route('payment-requests.index')->with('success', 'Approval payment Manager berhasil dibatalkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // =========================================================================
    // REVISION (Kembalikan dari status 14 atau 15 ke 7/8)
    // =========================================================================
    public function revision(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr   = Pr::findOrFail($id);
        $user = Auth::user();

        // Hanya bisa dilakukan oleh yg punya pr_payment.revision dan punya minimal 1 akses approval
        $hasRevisionPerm = $user->hasPermission('pr_payment.revision');
        $isApprover = $user->level === 1 || $user->hasPermission('pr_payment.approve.step1') || $user->hasPermission('pr_payment.approve.step2');

        if (!$hasRevisionPerm || !$isApprover) {
            return back()->with('error', 'Anda tidak berhak melakukan revisi payment.');
        }

        // Hanya bisa revisi payment yang butuh approval
        if (!in_array($pr->status, [14, 15])) {
            return back()->with('error', 'PR ini tidak dalam status persetujuan payment.');
        }

        $request->validate(['revision_reason' => 'required|string']);

        DB::beginTransaction();
        try {
            $payments = Payment::where('id_pr', $id)
                ->where('id_doc_type', $pr->id_doc_type)
                ->orderBy('id_payment', 'DESC')
                ->get();

            $lastPayment = $payments->first();
            if ($lastPayment) {
                // Tandai alasan di row payment terakhir ini
                $lastPayment->update([
                    'reason'   => $request->revision_reason,
                    'filename' => null, // hapus sign jika ada
                    'status'   => 1 // kembali pending config
                ]);
            }

            // Kembalikan status PR ke Payment Parsial (8) atau Pending Payment (7)
            if ($payments->count() > 1) {
                $pr->update(['status' => 8]);
            } else {
                $pr->update(['status' => 7]);
            }

            DB::commit();

            return back()->with('success', 'Payment dikembalikan untuk direvisi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // =========================================================================
    // CANCEL APPROVE PAYMENT DIRECTOR (CI4: cancelapprovePaymentDirector)
    // =========================================================================

    public function cancelApproveDirector(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $pr   = Pr::findOrFail($id);
        $user = Auth::user();

        $payment = Payment::where('id_pr', $id)
            ->where('id_doc_type', $pr->id_doc_type)
            ->orderBy('id_payment', 'DESC')
            ->first();

        // Harus ada payment dan sudah diapprove director
        $isDirectorApproved = $payment && str_contains($payment->filename ?? '', 'approved_director');

        $canCancel = $user->level === 1
            || ($isDirectorApproved && $user->hasPermission('pr_payment.cancel_approve.step2'));

        if (!$canCancel) {
            return back()->with('error', 'Anda tidak berhak membatalkan approval payment director.');
        }

        DB::beginTransaction();
        try {
            if ($payment) {
                // Hapus signature director dari string (pemisah |)
                $signatures = explode('|', $payment->filename ?? '');
                $filtered = array_filter($signatures, fn($s) => !str_contains($s, 'approved_director'));

                $newFilename = !empty($filtered) ? implode('|', $filtered) : null;

                $payment->update([
                    'filename' => $newFilename,
                    'status'   => 1
                ]);
            }

            // Kembalikan ke status 14 (Pending Director)
            $pr->update(['status' => 14]);

            DB::commit();
            return redirect()->route('payment-requests.index')->with('success', 'Approval payment Director berhasil dibatalkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // =========================================================================
    // PRINT & DOWNLOAD PAYMENT RECEIPT
    // =========================================================================

    public function print(string $hash)
    {
        $id = hashid_decode($hash, 'payment');
        if (!$id) abort(404);

        $payment = Payment::with(['pr', 'pr.company', 'pr.vendor'])->findOrFail($id);

        $user = Auth::user();
        $canPrint = $user->level === 1 || $user->id_user == $payment->pr->id_user || $user->hasPermission('pr_payment.print');

        if (!$canPrint) {
            return back()->with('error', 'Anda tidak berhak mencetak payment ini.');
        }

        return view('payment-requests.payment-receipt', compact('payment'));
    }

    public function download(string $hash)
    {
        $id = hashid_decode($hash, 'payment');
        if (!$id) abort(404);

        $payment = Payment::with(['pr', 'pr.company', 'pr.vendor'])->findOrFail($id);

        $user = Auth::user();
        $canDownload = $user->level === 1 || $user->id_user == $payment->pr->id_user || $user->hasPermission('pr_payment.download');

        if (!$canDownload) {
            return back()->with('error', 'Anda tidak berhak mengunduh payment ini.');
        }

        if (!class_exists('\App\Services\PdfService')) {
            return back()->with('error', 'PDF Service tidak tersedia.');
        }

        $html = view('payment-requests.payment-receipt', compact('payment'))->render();
        $pdfService = new \App\Services\PdfService();
        $pdfContent = $pdfService->generate($html, [
            'format' => 'A5',
            'orientation' => 'L',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10,
        ]);

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Receipt_Payment_' . ($payment->pr->pr_number ?? 'PR') . '.pdf"',
        ]);
    }

    // =========================================================================
    // HELPERS: WhatsApp Notification (optional, skip jika tidak ada send_wa)
    // =========================================================================

    private function sendPaymentWhatsapp(Pr $pr, float $amount, string $action): void
    {
        // Kirim WA ke creator PR dan Director
        // Gunakan fungsi send_wa_fontee jika ada
        if (!function_exists('send_wa_fontee')) return;

        $phones = [];
        if ($pr->user && $pr->user->phone) {
            $phones[] = normalizePhone($pr->user->phone);
        }
        // Kirim ke semua user dengan permission pr_payment.approve.step2 (Director)
        $directors = User::where('level', 4)->get();
        foreach ($directors as $d) {
            if ($d->phone) $phones[] = normalizePhone($d->phone);
        }
        $phones = array_unique(array_filter($phones));

        foreach ($phones as $phone) {
            send_wa_fontee($phone, "📄 *{$action} PR*\n\nNomor PR: *{$pr->pr_number}*\nSubject: {$pr->subject}\nVendor: {$pr->vendor?->vendor}\nJumlah: " . number_format($amount, 2));
        }
    }

    private function sendApprovePaymentWhatsapp(Pr $pr): void
    {
        if (!function_exists('send_wa_fontee')) return;

        $phones = [];
        // Kirim ke Finance (level 6)
        $finances = User::where('level', 6)->get();
        foreach ($finances as $f) {
            if ($f->phone) $phones[] = normalizePhone($f->phone);
        }
        $phones = array_unique(array_filter($phones));

        foreach ($phones as $phone) {
            send_wa_fontee($phone, "✅ *Payment Disetujui Director*\n\nNomor PR: *{$pr->pr_number}*\nSubject: {$pr->subject}\nSilakan upload bukti transfer.");
        }
    }
}
