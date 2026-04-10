<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblItemsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_items')->truncate();

        $data = [
            [
                'id_item' => 1,
                'id_item_category' => 1,
                'item_name' => 'Alpha Pinene',
                'item_code' => 'ALP.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 2,
                'id_item_category' => 3,
                'item_name' => 'Caustic Soda Flake',
                'item_code' => 'CSF.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 3,
                'id_item_category' => 5,
                'item_name' => 'Depentine',
                'item_code' => 'DPT.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 4,
                'id_item_category' => 6,
                'item_name' => 'Fumaric Acid Tech Grade',
                'item_code' => 'FAC.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 5,
                'id_item_category' => 7,
                'item_name' => 'Pine Oil',
                'item_code' => 'IAS.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 6,
                'id_item_category' => 8,
                'item_name' => 'Gum Copal PWS Grade',
                'item_code' => 'ICO.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 7,
                'id_item_category' => 8,
                'item_name' => 'Gum Copal DBB Grade',
                'item_code' => 'ICO.002',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 8,
                'id_item_category' => 8,
                'item_name' => 'Gum Copal WS Grade',
                'item_code' => 'ICO.003',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 9,
                'id_item_category' => 8,
                'item_name' => 'Gum Copal Dust',
                'item_code' => 'ICO.004',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 10,
                'id_item_category' => 8,
                'item_name' => 'Gum Copal Asalan Grade',
                'item_code' => 'ICO.005',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 11,
                'id_item_category' => 8,
                'item_name' => 'Gum Copal Debu',
                'item_code' => 'ICO.006',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 12,
                'id_item_category' => 8,
                'item_name' => 'Gum Copal Mutu U',
                'item_code' => 'ICO.007',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 13,
                'id_item_category' => 8,
                'item_name' => 'Gum Copal Mutu P',
                'item_code' => 'ICO.008',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 14,
                'id_item_category' => 9,
                'item_name' => 'Gum Damar ABX',
                'item_code' => 'IDA.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 15,
                'id_item_category' => 9,
                'item_name' => 'Gum Damar CDX',
                'item_code' => 'IDA.002',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 16,
                'id_item_category' => 9,
                'item_name' => 'Gum Damar AB MIX',
                'item_code' => 'IDA.003',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 17,
                'id_item_category' => 10,
                'item_name' => 'DAMAR BATU',
                'item_code' => 'IDB.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 18,
                'id_item_category' => 11,
                'item_name' => 'Terpineol',
                'item_code' => 'IDE.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 19,
                'id_item_category' => 13,
                'item_name' => 'PARAFFIN YSW 60',
                'item_code' => 'IKI.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 20,
                'id_item_category' => 13,
                'item_name' => 'Parafin SRW Fully refined 58',
                'item_code' => 'IKI.002',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 21,
                'id_item_category' => 13,
                'item_name' => 'parafin srw semi refined 58',
                'item_code' => 'IKI.003',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 22,
                'id_item_category' => 23,
                'item_name' => 'Seng Plat Ukuran 025 x 914 x 1829 (S)',
                'item_code' => 'IPA.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 23,
                'id_item_category' => 23,
                'item_name' => 'Seng Plat Ukuran 020 x 762 x 50 m',
                'item_code' => 'IPA.002',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 24,
                'id_item_category' => 23,
                'item_name' => 'Seng Plat Ukuran 020 x 914 x 1829',
                'item_code' => 'IPA.003',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 25,
                'id_item_category' => 23,
                'item_name' => 'IBC',
                'item_code' => 'IPA.004',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 26,
                'id_item_category' => 23,
                'item_name' => 'Drum GR',
                'item_code' => 'IPA.005',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 27,
                'id_item_category' => 23,
                'item_name' => 'TUTUP ATAS DRUM - BESAR (GR)',
                'item_code' => 'IPA.006',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 28,
                'id_item_category' => 23,
                'item_name' => 'TUTUP ATAS DRUM - KECIL (GR)',
                'item_code' => 'IPA.007',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 29,
                'id_item_category' => 23,
                'item_name' => 'TUTUP BAWAH DRUM (GR)',
                'item_code' => 'IPA.008',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 30,
                'id_item_category' => 23,
                'item_name' => 'Drum Fiber',
                'item_code' => 'IPA.010',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 31,
                'id_item_category' => 23,
                'item_name' => 'Drum Besi',
                'item_code' => 'IPA.011',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 32,
                'id_item_category' => 15,
                'item_name' => 'Gum Rosin X Grade',
                'item_code' => 'IRO.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 33,
                'id_item_category' => 15,
                'item_name' => 'Gum Rosin WW Grade',
                'item_code' => 'IRO.002',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 34,
                'id_item_category' => 15,
                'item_name' => 'Gum Rosin WG',
                'item_code' => 'IRO.003',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 35,
                'id_item_category' => 15,
                'item_name' => 'Gum Rosin Black Grade',
                'item_code' => 'IRO.004',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 36,
                'id_item_category' => 16,
                'item_name' => 'Gum Turpentine',
                'item_code' => 'ITU.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 37,
                'id_item_category' => 16,
                'item_name' => 'Gum Turpentine Grade B',
                'item_code' => 'ITU.002',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 38,
                'id_item_category' => 17,
                'item_name' => 'Lithium Hydroxide Monohydrate',
                'item_code' => 'LHM.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 39,
                'id_item_category' => 18,
                'item_name' => 'Melamine Powder',
                'item_code' => 'MEL.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 40,
                'id_item_category' => 19,
                'item_name' => 'Stearic Acid Type 1801',
                'item_code' => 'SAC.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 41,
                'id_item_category' => 19,
                'item_name' => 'Stearic Acid Type 1807',
                'item_code' => 'SAC.002',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 42,
                'id_item_category' => 19,
                'item_name' => 'Stearic Acid Type 1810',
                'item_code' => 'SAC.003',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 43,
                'id_item_category' => 19,
                'item_name' => 'Stearic Acid Type 1838',
                'item_code' => 'SAC.004',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 44,
                'id_item_category' => 19,
                'item_name' => 'Stearic Acid Type 1840',
                'item_code' => 'SAC.005',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 45,
                'id_item_category' => 19,
                'item_name' => 'Stearic Acid Type 1842',
                'item_code' => 'SAC.006',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 46,
                'id_item_category' => 20,
                'item_name' => 'Sereh Oil',
                'item_code' => 'SOL.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 47,
                'id_item_category' => 21,
                'item_name' => 'Sodium Tripolyphosphate',
                'item_code' => 'STP.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 48,
                'id_item_category' => 22,
                'item_name' => 'White Oil',
                'item_code' => 'WOL.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 49,
                'id_item_category' => 12,
                'item_name' => 'Oleo Pine Resin',
                'item_code' => 'IGE.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 50,
                'id_item_category' => 14,
                'item_name' => 'Limbah',
                'item_code' => 'ILB.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 51,
                'id_item_category' => 2,
                'item_name' => 'Cineol',
                'item_code' => 'CIN.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ],
            [
                'id_item' => 52,
                'id_item_category' => 4,
                'item_name' => 'Daun Nilam',
                'item_code' => 'DNL.001',
                'description' => '',
                'is_active' => 1,
                'created_at' => '2026-03-26 02:12:07',
                'updated_at' => '2026-03-26 02:12:07',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_items')->insert($chunk);
        }
    }
}
