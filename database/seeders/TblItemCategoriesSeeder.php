<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblItemCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        
        $payload = [
                    [
                        'id_item_category' => 1,
                        'item_category_code' => 'ALP.000',
                        'id_user' => 1,
                        'item_category' => 'ALPHAPINENE',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 2,
                        'item_category_code' => 'CIN.000',
                        'id_user' => 1,
                        'item_category' => 'CINEOL',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 3,
                        'item_category_code' => 'CSF.000',
                        'id_user' => 1,
                        'item_category' => 'CAUSTIC SODA FLAKE',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 4,
                        'item_category_code' => 'DNL.000',
                        'id_user' => 1,
                        'item_category' => 'DAUN NILAM',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 5,
                        'item_category_code' => 'DPT.000',
                        'id_user' => 1,
                        'item_category' => 'DEPENTENE',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 6,
                        'item_category_code' => 'FAC.000',
                        'id_user' => 1,
                        'item_category' => 'FUMARIC ACID TECH GRADE',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 7,
                        'item_category_code' => 'IAS.000',
                        'id_user' => 1,
                        'item_category' => 'PINE OIL',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 8,
                        'item_category_code' => 'ICO.000',
                        'id_user' => 1,
                        'item_category' => 'COPAL',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 9,
                        'item_category_code' => 'IDA.000',
                        'id_user' => 1,
                        'item_category' => 'DAMAR',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 10,
                        'item_category_code' => 'IDB.000',
                        'id_user' => 1,
                        'item_category' => 'DAMAR BATU',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 11,
                        'item_category_code' => 'IDE.000',
                        'id_user' => 1,
                        'item_category' => 'TERPENIOL',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 12,
                        'item_category_code' => 'IGE.000',
                        'id_user' => 1,
                        'item_category' => 'OLEO PINE RESIN',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 13,
                        'item_category_code' => 'IKI.000',
                        'id_user' => 1,
                        'item_category' => 'PARAFIN',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 14,
                        'item_category_code' => 'ILB.000',
                        'id_user' => 1,
                        'item_category' => 'LIMBAH',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 15,
                        'item_category_code' => 'IPA.000',
                        'id_user' => 1,
                        'item_category' => 'RAW MATERIAL',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 16,
                        'item_category_code' => 'IRO.000',
                        'id_user' => 1,
                        'item_category' => 'GUM ROSIN',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 17,
                        'item_category_code' => 'ITU.000',
                        'id_user' => 1,
                        'item_category' => 'TURPENTINE OIL',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 18,
                        'item_category_code' => 'LHM.000',
                        'id_user' => 1,
                        'item_category' => 'LITHIUM HYDROXIDE MONOHYDRATE',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 19,
                        'item_category_code' => 'MEL.000',
                        'id_user' => 1,
                        'item_category' => 'MELAMINE',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 20,
                        'item_category_code' => 'SAC.000',
                        'id_user' => 1,
                        'item_category' => 'STEARIC ACID',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 21,
                        'item_category_code' => 'SOL.000',
                        'id_user' => 1,
                        'item_category' => 'SEREH OIL',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 22,
                        'item_category_code' => 'STP.000',
                        'id_user' => 1,
                        'item_category' => 'SODIUM TRIPOLYPHOSPHATE',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 23,
                        'item_category_code' => 'WOL.000',
                        'id_user' => 1,
                        'item_category' => 'WHITE OIL',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 24,
                        'item_category_code' => 'GR.0001',
                        'id_user' => 1,
                        'item_category' => 'Gumrosin Black',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id_item_category' => 25,
                        'item_category_code' => 'GR.0002',
                        'id_user' => 1,
                        'item_category' => 'Gumrosin White',
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
        ];

        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_item_categories')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
