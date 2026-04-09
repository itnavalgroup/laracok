<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblTaxTypesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_tax_types')->truncate();

        $data = [
            [
                'id_tax_type' => 9,
                'tax_type' => 'PPh',
                'tax_type_description' => 'Pajak Penghasilan',
                'created_at' => '2025-09-01 18:53:03',
                'updated_at' => '2025-11-20 00:09:57',
                'deleted_at' => null
            ],
            [
                'id_tax_type' => 10,
                'tax_type' => 'PPN',
                'tax_type_description' => 'Pajak Pertambahan Nilai',
                'created_at' => '2025-09-01 18:53:18',
                'updated_at' => '2025-10-15 04:00:19',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_tax_types')->insert($chunk);
        }
    }
}
