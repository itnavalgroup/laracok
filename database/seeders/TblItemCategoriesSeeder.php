<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblItemCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_item_categories')->truncate();

        $data = [
            [
                'id_item_category' => 1,
                'id_user' => 1,
                'item_category_code' => 'ALP.000',
                'item_category' => 'ALPHAPINENE',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 2,
                'id_user' => 1,
                'item_category_code' => 'CIN.000',
                'item_category' => 'CINEOL',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 3,
                'id_user' => 1,
                'item_category_code' => 'CSF.000',
                'item_category' => 'CAUSTIC SODA FLAKE',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 4,
                'id_user' => 1,
                'item_category_code' => 'DNL.000',
                'item_category' => 'DAUN NILAM',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 5,
                'id_user' => 1,
                'item_category_code' => 'DPT.000',
                'item_category' => 'DEPENTENE',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 6,
                'id_user' => 1,
                'item_category_code' => 'FAC.000',
                'item_category' => 'FUMARIC ACID TECH GRADE',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 7,
                'id_user' => 1,
                'item_category_code' => 'IAS.000',
                'item_category' => 'PINE OIL',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 8,
                'id_user' => 1,
                'item_category_code' => 'ICO.000',
                'item_category' => 'COPAL',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 9,
                'id_user' => 1,
                'item_category_code' => 'IDA.000',
                'item_category' => 'DAMAR',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 10,
                'id_user' => 1,
                'item_category_code' => 'IDB.000',
                'item_category' => 'DAMAR BATU',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 11,
                'id_user' => 47,
                'item_category_code' => 'IDE.000',
                'item_category' => 'TERPINEOL',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-04-02 01:48:33',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 12,
                'id_user' => 1,
                'item_category_code' => 'IGE.000',
                'item_category' => 'OLEO PINE RESIN',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 13,
                'id_user' => 1,
                'item_category_code' => 'IKI.000',
                'item_category' => 'PARAFIN',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 14,
                'id_user' => 1,
                'item_category_code' => 'ILB.000',
                'item_category' => 'LIMBAH',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 15,
                'id_user' => 1,
                'item_category_code' => 'IRO.000',
                'item_category' => 'GUM ROSIN',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 16,
                'id_user' => 1,
                'item_category_code' => 'ITU.000',
                'item_category' => 'TURPENTINE OIL',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 17,
                'id_user' => 1,
                'item_category_code' => 'LHM.000',
                'item_category' => 'LITHIUM HYDROXIDE MONOHYDRATE',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 18,
                'id_user' => 1,
                'item_category_code' => 'MEL.000',
                'item_category' => 'MELAMINE',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 19,
                'id_user' => 1,
                'item_category_code' => 'SAC.000',
                'item_category' => 'STEARIC ACID',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 20,
                'id_user' => 1,
                'item_category_code' => 'SOL.000',
                'item_category' => 'SEREH OIL',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 21,
                'id_user' => 1,
                'item_category_code' => 'STP.000',
                'item_category' => 'SODIUM TRIPOLYPHOSPHATE',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 22,
                'id_user' => 1,
                'item_category_code' => 'WOL.000',
                'item_category' => 'WHITE OIL',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ],
            [
                'id_item_category' => 23,
                'id_user' => 1,
                'item_category_code' => 'IPA.000',
                'item_category' => 'RAW MATERIAL',
                'is_active' => 1,
                'created_at' => '2026-03-25 17:17:01',
                'updated_at' => '2026-03-25 17:17:01',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_item_categories')->insert($chunk);
        }
    }
}
