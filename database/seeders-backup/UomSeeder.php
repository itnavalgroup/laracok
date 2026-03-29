<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uoms = [
            ['id_uom' => 1, 'uom' => 'Pack', 'qty_kg' => 0.0000, 'created_at' => '2025-10-24 03:10:35', 'updated_at' => '2025-10-24 03:21:25'],
            ['id_uom' => 2, 'uom' => 'IBC', 'qty_kg' => 870.0000, 'created_at' => '2025-10-24 03:14:56', 'updated_at' => '2025-10-24 03:20:03'],
            ['id_uom' => 3, 'uom' => 'Kg', 'qty_kg' => 1.0000, 'created_at' => '2025-10-24 03:33:17', 'updated_at' => '2025-10-24 03:33:17'],
            ['id_uom' => 4, 'uom' => 'Drum', 'qty_kg' => 0.0000, 'created_at' => '2025-11-23 09:02:38', 'updated_at' => '2025-11-23 09:02:38'],
            ['id_uom' => 5, 'uom' => 'Pcs', 'qty_kg' => 0.0000, 'created_at' => '2025-11-23 09:02:45', 'updated_at' => '2025-11-23 09:02:45'],
            ['id_uom' => 6, 'uom' => 'Kardus', 'qty_kg' => 0.0000, 'created_at' => '2025-11-23 09:03:03', 'updated_at' => '2025-11-23 09:03:03'],
            ['id_uom' => 8, 'uom' => 'Trip', 'qty_kg' => 0.0000, 'created_at' => '2025-12-10 06:36:52', 'updated_at' => '2025-12-10 06:36:52'],
            ['id_uom' => 9, 'uom' => 'Liter', 'qty_kg' => 0.0000, 'created_at' => '2025-12-17 09:11:32', 'updated_at' => '2025-12-17 09:11:32'],
            ['id_uom' => 10, 'uom' => 'Galon', 'qty_kg' => 0.0000, 'created_at' => '2025-12-17 09:11:40', 'updated_at' => '2025-12-17 09:11:40'],
            ['id_uom' => 11, 'uom' => 'Truck', 'qty_kg' => 0.0000, 'created_at' => '2025-12-17 09:11:45', 'updated_at' => '2025-12-17 09:11:45'],
            ['id_uom' => 12, 'uom' => 'Unit', 'qty_kg' => 0.0000, 'created_at' => '2025-12-17 09:11:51', 'updated_at' => '2025-12-17 09:11:51'],
            ['id_uom' => 13, 'uom' => 'Roll', 'qty_kg' => 0.0000, 'created_at' => '2025-12-17 09:12:00', 'updated_at' => '2025-12-17 09:12:00'],
            ['id_uom' => 14, 'uom' => 'Lembar', 'qty_kg' => 0.0000, 'created_at' => '2025-12-17 09:13:11', 'updated_at' => '2025-12-17 09:13:11'],
            ['id_uom' => 15, 'uom' => 'Bulan', 'qty_kg' => 0.0000, 'created_at' => '2025-12-22 10:04:02', 'updated_at' => '2025-12-22 10:04:02'],
            ['id_uom' => 16, 'uom' => 'Hari', 'qty_kg' => 0.0000, 'created_at' => '2025-12-22 10:04:09', 'updated_at' => '2025-12-22 10:04:09'],
            ['id_uom' => 17, 'uom' => 'Orang', 'qty_kg' => 0.0000, 'created_at' => '2025-12-22 10:04:24', 'updated_at' => '2025-12-22 10:04:24'],
            ['id_uom' => 18, 'uom' => 'Tahun', 'qty_kg' => 0.0000, 'created_at' => '2025-12-22 10:04:57', 'updated_at' => '2025-12-22 10:04:57'],
            ['id_uom' => 19, 'uom' => 'Minggu', 'qty_kg' => 0.0000, 'created_at' => '2026-01-02 03:18:28', 'updated_at' => '2026-01-02 03:18:28'],
        ];

        DB::table('tbl_uoms')->upsert(
            $uoms,
            ['id_uom'],
            ['uom', 'qty_kg', 'created_at', 'updated_at']
        );
    }
}
