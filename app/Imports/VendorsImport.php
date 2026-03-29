<?php

namespace App\Imports;

use App\Models\Vendor;
use App\Models\VendorEmail;
use App\Models\VendorBankAccount;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class VendorsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['vendor'])) {
            return null;
        }

        return DB::transaction(function () use ($row) {
            // Skip if NPWP or NIK already exists (using legacy encryption)
            if (!empty($row['npwp'])) {
                $cleanNpwp = trim($row['npwp']);
                $encryptedNpwp = encrypt_legacy($cleanNpwp);
                if (Vendor::where('npwp', $encryptedNpwp)->exists()) {
                    return null;
                }
                $row['npwp'] = $cleanNpwp; // Update with trimmed value
            }

            if (!empty($row['nik'])) {
                $cleanNik = trim($row['nik']);
                $encryptedNik = encrypt_legacy($cleanNik);
                if (Vendor::where('nik', $encryptedNik)->exists()) {
                    return null;
                }
                $row['nik'] = $cleanNik; // Update with trimmed value
            }

            $deptId = (auth()->user()->level == 1) ? null : auth()->user()->id_departement;

            $vendor = Vendor::create([
                'vendor' => $row['vendor'],
                'npwp' => !empty($row['npwp']) ? encrypt_legacy($row['npwp']) : null,
                'nik' => !empty($row['nik']) ? encrypt_legacy($row['nik']) : null,
                'id_user' => auth()->id(),
                'id_departement' => $deptId,
            ]);

            if (!empty($row['email'])) {
                VendorEmail::create([
                    'id_vendor' => $vendor->id_vendor,
                    'email' => $row['email'],
                ]);
            }

            if (!empty($row['norek'])) {
                VendorBankAccount::create([
                    'id_vendor' => $vendor->id_vendor,
                    'nama_bank' => $row['nama_bank'] ?? null,
                    'nama_penerima' => $row['nama_penerima'] ?? null,
                    'norek' => $row['norek'],
                ]);
            }

            return $vendor;
        });
    }
}
