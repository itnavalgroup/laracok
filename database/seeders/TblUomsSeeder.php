<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblUomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
                    [
                        'id_uom' => 1,
                        'uom' => 'Pack',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-10-24 03:10:35',
                        'updated_at' => '2025-10-24 03:21:25',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 2,
                        'uom' => 'IBC',
                        'qty_kg' => 870.0000,
                        'created_at' => '2025-10-24 03:14:56',
                        'updated_at' => '2025-10-24 03:20:03',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 3,
                        'uom' => 'Kg',
                        'qty_kg' => 1.0000,
                        'created_at' => '2025-10-24 03:33:17',
                        'updated_at' => '2025-10-24 03:33:17',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 4,
                        'uom' => 'Drum',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-11-23 09:02:38',
                        'updated_at' => '2025-11-23 09:02:38',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 5,
                        'uom' => 'Pcs',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-11-23 09:02:45',
                        'updated_at' => '2025-11-23 09:02:45',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 6,
                        'uom' => 'Kardus',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-11-23 09:03:03',
                        'updated_at' => '2025-11-23 09:03:03',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 8,
                        'uom' => 'Trip',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-12-10 06:36:52',
                        'updated_at' => '2025-12-10 06:36:52',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 9,
                        'uom' => 'Liter',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-12-17 09:11:32',
                        'updated_at' => '2025-12-17 09:11:32',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 10,
                        'uom' => 'Galon',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-12-17 09:11:40',
                        'updated_at' => '2025-12-17 09:11:40',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 11,
                        'uom' => 'Truck',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-12-17 09:11:45',
                        'updated_at' => '2025-12-17 09:11:45',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 12,
                        'uom' => 'Unit',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-12-17 09:11:51',
                        'updated_at' => '2025-12-17 09:11:51',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 13,
                        'uom' => 'Roll',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-12-17 09:12:00',
                        'updated_at' => '2025-12-17 09:12:00',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 14,
                        'uom' => 'Lembar',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-12-17 09:13:11',
                        'updated_at' => '2025-12-17 09:13:11',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 15,
                        'uom' => 'Bulan',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-12-22 10:04:02',
                        'updated_at' => '2025-12-22 10:04:02',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 16,
                        'uom' => 'Hari',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-12-22 10:04:09',
                        'updated_at' => '2025-12-22 10:04:09',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 17,
                        'uom' => 'Orang',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-12-22 10:04:24',
                        'updated_at' => '2025-12-22 10:04:24',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 18,
                        'uom' => 'Tahun',
                        'qty_kg' => 0.0000,
                        'created_at' => '2025-12-22 10:04:57',
                        'updated_at' => '2025-12-22 10:04:57',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 19,
                        'uom' => 'Minggu',
                        'qty_kg' => 0.0000,
                        'created_at' => '2026-01-02 03:18:28',
                        'updated_at' => '2026-01-02 03:18:28',
                        'deleted_at' => null,
                    ],
                    [
                        'id_uom' => 20,
                        'uom' => 'MT',
                        'qty_kg' => 1000.0000,
                        'created_at' => '2026-03-09 07:03:15',
                        'updated_at' => '2026-03-09 07:03:15',
                        'deleted_at' => null,
                    ]
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_uoms')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
