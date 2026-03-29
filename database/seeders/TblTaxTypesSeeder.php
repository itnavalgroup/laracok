<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblTaxTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
                    [
                        'id_tax_type' => 9,
                        'tax_type' => 'PPh',
                        'tax_type_description' => 'Pajak Penghasilan',
                        'created_at' => '2025-09-02 01:53:03',
                        'updated_at' => '2025-11-20 07:09:57',
                        'deleted_at' => null,
                    ],
                    [
                        'id_tax_type' => 10,
                        'tax_type' => 'PPN',
                        'tax_type_description' => 'Pajak Pertambahan Nilai',
                        'created_at' => '2025-09-02 01:53:18',
                        'updated_at' => '2025-10-15 11:00:19',
                        'deleted_at' => null,
                    ]
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_tax_types')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
