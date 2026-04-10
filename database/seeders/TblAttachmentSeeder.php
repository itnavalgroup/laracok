<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblAttachmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_attachment')->truncate();

        $data = [
            [
                'id_attachment' => 38,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Original Invoice',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 39,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Faktur Pajak',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 40,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Kwitansi',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 41,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Surat Jalan / DO',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 42,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Purchase Order / SPK',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 43,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Penerimaan Barang',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 44,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Contract',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 45,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Inspection Letter',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 46,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Supporting Documents',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 47,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Timbangan',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 48,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'PI',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 49,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'KTP',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 50,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'NPWP',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 51,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Packing List',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 52,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'GOV.FEE',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 53,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'COO',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 54,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'COA',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 55,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'BL',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 56,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'ASURANSI',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 57,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'SKT',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 58,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'SPPKP',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-29 09:28:02',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 59,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'EKP',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 60,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'LOG',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 61,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'SKB',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 62,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'TRUCKING',
                'created_at' => '2025-11-23 02:08:49',
                'updated_at' => '2025-11-23 02:08:49',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 63,
                'id_departement' => 0,
                'id_user' => 1,
                'attachment' => 'Nota',
                'created_at' => '2025-11-23 02:09:42',
                'updated_at' => '2025-11-29 09:27:52',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 64,
                'id_departement' => 9,
                'id_user' => 38,
                'attachment' => 'Invoice dan Faktur Pajak',
                'created_at' => '2025-12-16 20:55:38',
                'updated_at' => '2025-12-16 20:55:38',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 65,
                'id_departement' => 7,
                'id_user' => 53,
                'attachment' => 'MEMO INTERNAL',
                'created_at' => '2026-01-07 18:44:41',
                'updated_at' => '2026-01-07 18:44:41',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 66,
                'id_departement' => 6,
                'id_user' => 52,
                'attachment' => 'Perjanjian Kerja Sama',
                'created_at' => '2026-01-08 02:26:48',
                'updated_at' => '2026-01-08 02:26:48',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 67,
                'id_departement' => 7,
                'id_user' => 53,
                'attachment' => 'LAPORAN',
                'created_at' => '2026-01-22 18:40:25',
                'updated_at' => '2026-01-22 18:40:25',
                'deleted_at' => null
            ],
            [
                'id_attachment' => 68,
                'id_departement' => 7,
                'id_user' => 53,
                'attachment' => 'FORMULIR',
                'created_at' => '2026-02-02 18:37:29',
                'updated_at' => '2026-02-02 18:37:29',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_attachment')->insert($chunk);
        }
    }
}
