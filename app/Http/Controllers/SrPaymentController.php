<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sr;
use App\Models\Payment;
use App\Models\PaymentAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * SrPaymentController
 * Mirip PaymentController tapi untuk SR:
 * - Tidak ada approval payment (payment_type_pr tidak dipakai)
 * - Tidak ada status 14/15 (payment approval)
 * - Uses sr_payment.* permissions
 */
class SrPaymentController extends Controller
{
    // SR status yang boleh di-payment: 7 (Pending Payment), 8 (Payment Parsial)
    private function canAccessPayment(Sr $sr): bool
    {
        $user = Auth::user();
        if (!in_array($sr->status, [7, 8, 9, 10, 11])) return false;
        return $user->level === 1
            || $user->id_user == $sr->id_user
            || $user->hasPermission('sr_payment.create')
            || $user->hasPermission('sr_payment.view');
    }

    /**
     * Cek apakah user bisa tambah payment SR.
     * Bergantung pada jenis selisih:
     * - Lebih Bayar (balance < 0): Admin + sr_payment.create + Creator/Owner
     * - Kurang Bayar (balance > 0): Hanya Admin + sr_payment.create
     */
    private function canCreatePayment(Sr $sr, float $balance = 0): bool
    {
        $user = Auth::user();
        if ($user->level === 1 || $user->hasPermission('sr_payment.create')) {
            return true; // Admin & Finance selalu bisa
        }
        // Lebih Bayar (balance < 0): Creator juga boleh
        if ($balance < 0 && $user->id_user == $sr->id_user) {
            return true;
        }
        // Kurang Bayar atau Balance 0: Hanya Admin/Finance (sudah ditangani di atas)
        return false;
    }

    private function canEditPayment(Payment $payment): bool
    {
        $user = Auth::user();
        return $user->level === 1 || $user->id_user == $payment->id_user;
    }

    /**
     * Update status SR setelah payment berubah
     * SR tidak ada approval payment, status langsung ke Paid (11) atau Payment Parsial (8)
     */
    public function updateSrStatusAfterPayments(int $idPr, int $idDocType): void
    {
        $sr = Sr::where('id_pr', $idPr)->where('id_doc_type', $idDocType)->first();
        if (!$sr) return;

        $payments = Payment::where('id_pr', $idPr)
            ->where('id_doc_type', $idDocType)
            ->orderBy('id_payment', 'DESC')
            ->get();

        if ($payments->isEmpty()) {
            $sr->update(['status' => 7]);
            return;
        }

        $lastPayment = $payments->first();
        $type        = intval($lastPayment->payment_type);
        $attCount    = PaymentAttachment::where('id_payment', $lastPayment->id_payment)->count();

        if ($type == 2) { // FULL
            $status = ($attCount > 0) ? 11 : 10;
        } else { // PARTIAL
            $status = ($attCount > 0) ? 8 : 9;
        }

        $sr->update(['status' => $status]);
    }

    /**
     * Store payment SR
     */
    public function store(Request $request, string $hash)
    {
        $id = hashid_decode($hash, 'pr');
        if (!$id) abort(404);

        $sr = Sr::where('id_pr', $id)->firstOrFail();

        // Hitung balance
        $receipt     = Payment::where('id_pr', $sr->id_pr)->whereIn('id_doc_type', [1, 2])->sum('grand_total');
        $grandTotal  = $sr->details()->sum('ammount');
        $outstanding = $grandTotal - $receipt; // >0=kurang bayar, <0=lebih bayar

        $refund = Payment::where('id_pr', $sr->id_pr)->where('id_doc_type', $sr->id_doc_type)->sum('grand_total');

        $currentBalance = 0;
        if ($outstanding < 0) {
            $currentBalance = $outstanding + $refund;
        } elseif ($outstanding > 0) {
            $currentBalance = $outstanding - $refund;
        }

        if (!$this->canCreatePayment($sr, $currentBalance)) {
            return back()->with('error', 'Anda tidak berhak menambahkan payment.');
        }

        if (!in_array($sr->status, [7, 8])) {
            return back()->with('error', 'Payment hanya dapat ditambahkan saat status Pending Payment atau Payment Parsial.');
        }

        $paymentFinished = Payment::where('id_pr', $sr->id_pr)
            ->where('id_doc_type', $sr->id_doc_type)
            ->where('payment_type', 2)
            ->exists();

        if ($paymentFinished) {
            return back()->with('error', 'SR ini sudah selesai.');
        }

        $request->validate([
            'payment_type'   => 'required|in:1,2',
            'nama_bank'      => 'nullable|string',
            'nama_penerima'  => 'nullable|string',
            'norek'          => 'nullable|string',
            'amount'         => 'required|numeric|min:0',
            'additional'     => 'nullable|numeric',
            'payment_date'   => 'required|date',
        ]);

        $paymentType   = intval($request->payment_type);
        $amount        = (float) $request->amount;

        // --- VALIDASI AMOUNT TIDAK BOLEH LEBIH DARI REMAINING BALANCE ---
        $remainingAbs = abs($currentBalance);
        if (round($amount, 2) > round($remainingAbs, 2)) {
            return back()->with('error', 'Jumlah payment tidak boleh melebihi sisa balance (Rp ' . number_format($remainingAbs, 2, ',', '.') . ').');
        }

        // --- AUTO FULL JIKA LUNAS / PARSIAL JIKA BELUM ---
        if (round($amount, 2) == round($remainingAbs, 2)) {
            $paymentType = 2; // Auto Full
        } else if (round($amount, 2) < round($remainingAbs, 2)) {
            $paymentType = 1; // Auto Parsial
        }

        $additional    = parseQtyID($request->additional ?? 0);
        $grandTotal    = $amount;
        $paymentStatus = ($paymentType == 1) ? 1 : 2;

        // SR tidak memerlukan approval payment, langsung set status
        $statusSr = ($paymentType == 1) ? 9 : 10;

        $lastPayment = Payment::where('id_pr', $sr->id_pr)
            ->where('id_doc_type', $sr->id_doc_type)
            ->orderBy('id_payment', 'DESC')
            ->first();

        if ($paymentType == 1 && $lastPayment && $lastPayment->payment_type == 2) {
            return back()->with('error', 'Tidak bisa menambah payment parsial karena sudah ada payment full.');
        }
        if ($paymentType == 2 && $lastPayment && $lastPayment->payment_type == 2) {
            return back()->with('error', 'Payment full sudah ada.');
        }

        $namaBank = $request->nama_bank;
        $namaPenerima = $request->nama_penerima;
        $norek = $request->norek;

        if (empty($namaBank)) {
            $namaBank = $sr->nama_bank ?: ($sr->norek_vendor->nama_bank ?? ($sr->pr->nama_bank ?: ($sr->pr->norek_vendor->nama_bank ?? '-')));
        }
        if (empty($namaPenerima)) {
            $namaPenerima = $sr->nama_penerima ?: ($sr->norek_vendor->nama_penerima ?? ($sr->pr->nama_penerima ?: ($sr->pr->norek_vendor->nama_penerima ?? '-')));
        }
        if (empty($norek)) {
            $norek = $sr->norek ?: ($sr->norek_vendor->norek ?? ($sr->pr->norek ?: ($sr->pr->norek_vendor->norek ?? '-')));
        }

        DB::beginTransaction();
        try {
            Payment::create([
                'id_doc_type'         => $sr->id_doc_type,
                'id_pr'               => $sr->id_pr,
                'id_departement'      => $sr->id_departement,
                'id_cost_type'        => $sr->id_cost_type,
                'id_cost_category'    => $sr->id_cost_category,
                'id_branch'           => $sr->id_branch,
                'id_company'          => $sr->id_company,
                'id_vendor'           => $sr->id_vendor,
                'id_user'             => Auth::id(),
                'payment_description' => $request->payment_description,
                'payment_type'        => $paymentType,
                'payment_method'      => $request->payment_method,
                'nama_bank'           => $namaBank,
                'nama_penerima'       => $namaPenerima,
                'norek'               => $norek,
                'payment_date'        => $request->payment_date,
                'ammount'             => $amount,
                'additional'          => $additional,
                'grand_total'         => $grandTotal,
                'status'              => $paymentStatus,
                'filename'            => 'approved_by_system', // SR tidak perlu approval payment
            ]);

            $sr->update(['status' => $statusSr]);
            $this->updateSrStatusAfterPayments($sr->id_pr, $sr->id_doc_type);

            DB::commit();
            return back()->with('success', 'Data Berhasil Di Tambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update payment SR
     */
    public function update(Request $request, string $paymentHash)
    {
        $id = hashid_decode($paymentHash, 'payment');
        if (!$id) abort(404);

        $payment = Payment::findOrFail($id);
        $sr      = Sr::where('id_pr', $payment->id_pr)
            ->where('id_doc_type', $payment->id_doc_type)
            ->firstOrFail();

        if (!$this->canEditPayment($payment)) {
            return back()->with('error', 'Anda tidak berhak mengubah payment ini.');
        }

        if ($sr->status == 11) {
            return back()->with('error', 'SR ini sudah selesai.');
        }

        $request->validate([
            'payment_type'   => 'required|in:1,2',
            'nama_bank'      => 'nullable|string',
            'norek'          => 'nullable|string',
            'nama_penerima'  => 'nullable|string',
            'amount'         => 'required|numeric|min:0',
            'additional'     => 'nullable|numeric',
            'payment_date'   => 'required|date',
        ]);

        $paymentType   = intval($request->payment_type);
        $amount        = (float) $request->amount;

        // Hitung remaining balance tanpa payment ini
        $receipt     = Payment::where('id_pr', $sr->id_pr)->whereIn('id_doc_type', [1, 2])->sum('grand_total');
        $grandTotal  = $sr->details()->sum('ammount');
        $outstanding = $grandTotal - $receipt;

        $refund = Payment::where('id_pr', $sr->id_pr)
            ->where('id_doc_type', $sr->id_doc_type)
            ->where('id_payment', '!=', $payment->id_payment)
            ->sum('grand_total');

        $currentBalance = 0;
        if ($outstanding < 0) {
            $currentBalance = $outstanding + $refund;
        } elseif ($outstanding > 0) {
            $currentBalance = $outstanding - $refund;
        }

        $remainingAbs = abs($currentBalance);

        // --- VALIDASI AMOUNT TIDAK BOLEH LEBIH DARI REMAINING BALANCE ---
        if (round($amount, 2) > round($remainingAbs, 2)) {
            return back()->with('error', 'Jumlah payment tidak boleh melebihi sisa balance (Rp ' . number_format($remainingAbs, 2, ',', '.') . ').');
        }

        // --- AUTO FULL JIKA LUNAS / PARSIAL JIKA BELUM ---
        if (round($amount, 2) == round($remainingAbs, 2)) {
            $paymentType = 2; // Auto Full
        } else if (round($amount, 2) < round($remainingAbs, 2)) {
            $paymentType = 1; // Auto Parsial
        }

        $additional    = parseQtyID($request->additional ?? 0);
        $paymentStatus = ($paymentType == 1) ? 1 : 2;

        $namaBank = $request->nama_bank;
        $namaPenerima = $request->nama_penerima;
        $norek = $request->norek;

        if (empty($namaBank)) {
            $namaBank = $sr->nama_bank ?: ($sr->norek_vendor->nama_bank ?? ($sr->pr->nama_bank ?: ($sr->pr->norek_vendor->nama_bank ?? '-')));
        }
        if (empty($namaPenerima)) {
            $namaPenerima = $sr->nama_penerima ?: ($sr->norek_vendor->nama_penerima ?? ($sr->pr->nama_penerima ?: ($sr->pr->norek_vendor->nama_penerima ?? '-')));
        }
        if (empty($norek)) {
            $norek = $sr->norek ?: ($sr->norek_vendor->norek ?? ($sr->pr->norek ?: ($sr->pr->norek_vendor->norek ?? '-')));
        }

        DB::beginTransaction();
        try {
            $payment->update([
                'payment_description' => $request->payment_description,
                'payment_type'        => $paymentType,
                'payment_method'      => $request->payment_method,
                'nama_bank'           => $namaBank,
                'nama_penerima'       => $namaPenerima,
                'norek'               => $norek,
                'payment_date'        => $request->payment_date,
                'ammount'             => $amount,
                'additional'          => $additional,
                'grand_total'         => $amount,
                'status'              => $paymentStatus,
            ]);

            $this->updateSrStatusAfterPayments($payment->id_pr, $payment->id_doc_type);

            DB::commit();
            return back()->with('success', 'Data Berhasil Di Update!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus payment SR
     */
    public function destroy(string $paymentHash)
    {
        $id = hashid_decode($paymentHash, 'payment');
        if (!$id) abort(404);

        $payment   = Payment::findOrFail($id);
        $sr        = Sr::where('id_pr', $payment->id_pr)
            ->where('id_doc_type', $payment->id_doc_type)
            ->firstOrFail();
        $idDocType = $payment->id_doc_type;

        if (!$this->canEditPayment($payment)) {
            return back()->with('error', 'Anda tidak berhak menghapus payment ini.');
        }

        if ($sr->status == 11) {
            return back()->with('error', 'SR sudah selesai, tidak dapat menghapus payment.');
        }

        $lastPayment = Payment::where('id_pr', $payment->id_pr)
            ->where('id_doc_type', $idDocType)
            ->orderBy('id_payment', 'DESC')
            ->first();

        if (!$lastPayment || $lastPayment->id_payment != $payment->id_payment) {
            return back()->with('error', 'Hanya payment terakhir yang dapat dihapus.');
        }

        DB::beginTransaction();
        try {
            $idPr = $payment->id_pr;

            $attachments = PaymentAttachment::where('id_payment', $payment->id_payment)->get();
            foreach ($attachments as $att) {
                if (!empty($att->filename)) {
                    $file = public_path('assets/attachmentpayment') . DIRECTORY_SEPARATOR . $att->filename;
                    if (is_file($file)) unlink($file);
                }
            }
            PaymentAttachment::where('id_payment', $payment->id_payment)->delete();

            $payment->delete();

            $this->updateSrStatusAfterPayments($idPr, $idDocType);

            DB::commit();
            return back()->with('success', 'Data Berhasil Di Hapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function print(string $hash)
    {
        $id = hashid_decode($hash, 'payment');
        if (!$id) abort(404);
        $payment = Payment::with(['pr', 'pr.company', 'pr.vendor'])->findOrFail($id);
        $user    = Auth::user();
        $canPrint = $user->level === 1 || $user->hasPermission('sr_payment.print');
        if (!$canPrint) return back()->with('error', 'Anda tidak berhak mencetak payment ini.');
        return view('settlement-reports.payment-receipt', compact('payment'));
    }

    public function download(string $hash)
    {
        $id = hashid_decode($hash, 'payment');
        if (!$id) abort(404);
        $payment = Payment::with(['pr', 'pr.company', 'pr.vendor'])->findOrFail($id);
        $user    = Auth::user();
        $canDl = $user->level === 1 || $user->hasPermission('sr_payment.download');
        if (!$canDl) return back()->with('error', 'Anda tidak berhak mengunduh payment ini.');
        return view('settlement-reports.payment-receipt', compact('payment'));
    }
}
