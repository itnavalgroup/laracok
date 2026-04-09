<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblUomsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_uoms')->truncate();

        $data = [
            [
                'id_uom' => 1,
                'uom' => 'Pack',
                'qty_kg' => 0.0000,
                'created_at' => '2025-10-23 20:10:35',
                'updated_at' => '2025-10-23 20:21:25',
                'deleted_at' => null
            ],
            [
                'id_uom' => 2,
                'uom' => 'IBC',
                'qty_kg' => 870.0000,
                'created_at' => '2025-10-23 20:14:56',
                'updated_at' => '2025-10-23 20:20:03',
                'deleted_at' => null
            ],
            [
                'id_uom' => 3,
                'uom' => 'Kg',
                'qty_kg' => 1.0000,
                'created_at' => '2025-10-23 20:33:17',
                'updated_at' => '2025-10-23 20:33:17',
                'deleted_at' => null
            ],
            [
                'id_uom' => 4,
                'uom' => 'Drum',
                'qty_kg' => 0.0000,
                'created_at' => '2025-11-23 02:02:38',
                'updated_at' => '2025-11-23 02:02:38',
                'deleted_at' => null
            ],
            [
                'id_uom' => 5,
                'uom' => 'Pcs',
                'qty_kg' => 0.0000,
                'created_at' => '2025-11-23 02:02:45',
                'updated_at' => '2025-11-23 02:02:45',
                'deleted_at' => null
            ],
            [
                'id_uom' => 6,
                'uom' => 'Kardus',
                'qty_kg' => 0.0000,
                'created_at' => '2025-11-23 02:03:03',
                'updated_at' => '2025-11-23 02:03:03',
                'deleted_at' => null
            ],
            [
                'id_uom' => 8,
                'uom' => 'Trip',
                'qty_kg' => 0.0000,
                'created_at' => '2025-12-09 23:36:52',
                'updated_at' => '2025-12-09 23:36:52',
                'deleted_at' => null
            ],
            [
                'id_uom' => 9,
                'uom' => 'Liter',
                'qty_kg' => 0.0000,
                'created_at' => '2025-12-17 02:11:32',
                'updated_at' => '2025-12-17 02:11:32',
                'deleted_at' => null
            ],
            [
                'id_uom' => 10,
                'uom' => 'Galon',
                'qty_kg' => 0.0000,
                'created_at' => '2025-12-17 02:11:40',
                'updated_at' => '2025-12-17 02:11:40',
                'deleted_at' => null
            ],
            [
                'id_uom' => 11,
                'uom' => 'Truck',
                'qty_kg' => 0.0000,
                'created_at' => '2025-12-17 02:11:45',
                'updated_at' => '2025-12-17 02:11:45',
                'deleted_at' => null
            ],
            [
                'id_uom' => 12,
                'uom' => 'Unit',
                'qty_kg' => 0.0000,
                'created_at' => '2025-12-17 02:11:51',
                'updated_at' => '2025-12-17 02:11:51',
                'deleted_at' => null
            ],
            [
                'id_uom' => 13,
                'uom' => 'Roll',
                'qty_kg' => 0.0000,
                'created_at' => '2025-12-17 02:12:00',
                'updated_at' => '2025-12-17 02:12:00',
                'deleted_at' => null
            ],
            [
                'id_uom' => 14,
                'uom' => 'Lembar',
                'qty_kg' => 0.0000,
                'created_at' => '2025-12-17 02:13:11',
                'updated_at' => '2025-12-17 02:13:11',
                'deleted_at' => null
            ],
            [
                'id_uom' => 15,
                'uom' => 'Bulan',
                'qty_kg' => 0.0000,
                'created_at' => '2025-12-22 03:04:02',
                'updated_at' => '2025-12-22 03:04:02',
                'deleted_at' => null
            ],
            [
                'id_uom' => 16,
                'uom' => 'Hari',
                'qty_kg' => 0.0000,
                'created_at' => '2025-12-22 03:04:09',
                'updated_at' => '2025-12-22 03:04:09',
                'deleted_at' => null
            ],
            [
                'id_uom' => 17,
                'uom' => 'Orang',
                'qty_kg' => 0.0000,
                'created_at' => '2025-12-22 03:04:24',
                'updated_at' => '2025-12-22 03:04:24',
                'deleted_at' => null
            ],
            [
                'id_uom' => 18,
                'uom' => 'Tahun',
                'qty_kg' => 0.0000,
                'created_at' => '2025-12-22 03:04:57',
                'updated_at' => '2025-12-22 03:04:57',
                'deleted_at' => null
            ],
            [
                'id_uom' => 19,
                'uom' => 'Minggu',
                'qty_kg' => 0.0000,
                'created_at' => '2026-01-01 20:18:28',
                'updated_at' => '2026-01-01 20:18:28',
                'deleted_at' => null
            ],
            [
                'id_uom' => 20,
                'uom' => 'MT',
                'qty_kg' => 1000.0000,
                'created_at' => '2026-03-09 00:03:15',
                'updated_at' => '2026-03-09 00:03:15',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_uoms')->insert($chunk);
        }
    }
}
