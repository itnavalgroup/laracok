<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxTypeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_tax_type' => 9, 'tax_type' => 'PPh', 'tax_type_description' => 'Pajak Penghasilan', 'created_at' => '2025-09-02 01:53:03', 'updated_at' => '2025-11-20 07:09:57'],
            ['id_tax_type' => 10, 'tax_type' => 'PPN', 'tax_type_description' => 'Pajak Pertambahan Nilai', 'created_at' => '2025-09-02 01:53:18', 'updated_at' => '2025-10-15 11:00:19'],
        ];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_tax_types')->upsert($chunk, ['id_tax_type'], ['tax_type', 'tax_type_description', 'created_at', 'updated_at']);
        }
    }
}
