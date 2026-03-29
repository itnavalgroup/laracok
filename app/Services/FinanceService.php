<?php

namespace App\Services;

class FinanceService
{
    /**
     * Hitung PPh21 Non Pegawai dengan tarif progresif 5–35%
     * Mengembalikan array: dpp, pph
     */
    public function hitungPPh21ProgresifNonPegawai($bruto)
    {
        // DPP = 50% dari bruto
        $dpp = $bruto * 0.5;

        $pkp = $dpp;
        $pph = 0;

        // Lapisan 0 - 60 juta → 5%
        if ($pkp > 0) {
            $lapis = min(60000000, $pkp);
            $pph += $lapis * 0.05;
            $pkp -= $lapis;
        }

        // Lapisan 60 - 250 juta → 15%
        if ($pkp > 0) {
            $lapis = min(190000000, $pkp);
            $pph += $lapis * 0.15;
            $pkp -= $lapis;
        }

        // Lapisan 250 - 500 juta → 25%
        if ($pkp > 0) {
            $lapis = min(250000000, $pkp);
            $pph += $lapis * 0.25;
            $pkp -= $lapis;
        }

        // Lapisan 500 juta - 5 M → 30%
        if ($pkp > 0) {
            $lapis = min(4500000000, $pkp);
            $pph += $lapis * 0.30;
            $pkp -= $lapis;
        }

        // Di atas 5 M → 35%
        if ($pkp > 0) {
            $pph += $pkp * 0.35;
        }

        return [
            'dpp' => $dpp,
            'pph' => $pph
        ];
    }

    /**
     * Hitung PPh21 NON Pegawai Progresif dengan GROSS-UP
     * Menghitung bruto final = honor + pph
     */
    public function hitungPPh21ProgresifGrossUp($honor)
    {
        $bruto = $honor;
        $result = [];
        $pph = 0;

        // Iterasi 10x untuk konvergen karena tarif progresif bertingkat
        for ($i = 0; $i < 10; $i++) {
            $result = $this->hitungPPh21ProgresifNonPegawai($bruto);
            $pph = $result['pph'];
            $bruto = $honor + $pph;
        }

        return [
            'dpp' => $result['dpp'] ?? 0,
            'pph' => $pph,
            'bruto_final' => $bruto
        ];
    }

    /**
     * Hitung PPh Non Pegawai (bukan progresif) dengan GROSS-UP satu lapis
     * Rumus:
     *  DPP = bruto / (1 - tarif)
     *  PPh = DPP × tarif
     */
    public function hitungPPh21NonProgresifGrossUp($bruto, $tarif)
    {
        if ($tarif >= 1) {
             // Avoid division by zero or negative
            return [
                'dpp' => 0,
                'pph' => 0
            ];
        }

        $dpp = $bruto / (1 - $tarif);
        $pph = $dpp * $tarif;

        return [
            'dpp' => $dpp,
            'pph' => $pph
        ];
    }
}
