<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_tax' => 33, 'id_tax_type' => 9, 'tax' => 'PPh 22', 'tax_persen' => 0.0025, 'tax_description' => 'Pembelian getah ', 'status' => 1, 'created_at' => '2025-11-20 07:15:55', 'updated_at' => '2025-11-20 07:15:55'],
            ['id_tax' => 34, 'id_tax_type' => 9, 'tax' => 'PPh 22', 'tax_persen' => 0.025, 'tax_description' => 'Impor ', 'status' => 1, 'created_at' => '2025-11-20 07:16:43', 'updated_at' => '2025-11-20 07:16:43'],
            ['id_tax' => 35, 'id_tax_type' => 9, 'tax' => 'PPh 23', 'tax_persen' => 0.02, 'tax_description' => 'Jasa', 'status' => 1, 'created_at' => '2025-11-20 07:17:25', 'updated_at' => '2025-11-20 07:17:25'],
            ['id_tax' => 36, 'id_tax_type' => 9, 'tax' => 'PPh 4(2)', 'tax_persen' => 0.02, 'tax_description' => 'Pelaksana Konstruksi Bersertifikat', 'status' => 1, 'created_at' => '2025-11-20 07:17:51', 'updated_at' => '2025-11-20 07:17:51'],
            ['id_tax' => 37, 'id_tax_type' => 9, 'tax' => 'PPh 4(2)', 'tax_persen' => 0.04, 'tax_description' => 'Pelaksana Konstruksi Tidak Bersertifikat', 'status' => 1, 'created_at' => '2025-11-20 07:18:18', 'updated_at' => '2025-11-20 07:18:18'],
            ['id_tax' => 38, 'id_tax_type' => 9, 'tax' => 'PPh 4(2)', 'tax_persen' => 0.03, 'tax_description' => 'Perencana/Pengawas Konstruksi Bersertifikat', 'status' => 1, 'created_at' => '2025-11-20 07:18:59', 'updated_at' => '2025-11-20 07:18:59'],
            ['id_tax' => 39, 'id_tax_type' => 9, 'tax' => 'PPh 4(2)', 'tax_persen' => 0.06, 'tax_description' => 'Perencana/Pengawas Konstruksi Tidak Bersertifikat', 'status' => 1, 'created_at' => '2025-11-20 07:19:31', 'updated_at' => '2025-11-20 07:19:31'],
            ['id_tax' => 40, 'id_tax_type' => 9, 'tax' => '10', 'tax_persen' => 0.1, 'tax_description' => 'Sewa Bangunan & Tanah', 'status' => 1, 'created_at' => '2025-11-20 07:20:04', 'updated_at' => '2025-11-20 07:20:04'],
            ['id_tax' => 41, 'id_tax_type' => 9, 'tax' => 'PPh 4(2)', 'tax_persen' => 0.005, 'tax_description' => 'Tarif UMKM', 'status' => 1, 'created_at' => '2025-11-20 07:20:50', 'updated_at' => '2025-12-01 04:10:40'],
            ['id_tax' => 42, 'id_tax_type' => 10, 'tax' => 'Kode Faktur 010', 'tax_persen' => 0.12, 'tax_description' => 'Kode Faktur 010', 'status' => 1, 'created_at' => '2025-11-20 07:21:30', 'updated_at' => '2025-11-20 07:21:30'],
            ['id_tax' => 43, 'id_tax_type' => 10, 'tax' => 'Kode Faktur 040', 'tax_persen' => 0.11, 'tax_description' => 'Kode Faktur 040', 'status' => 1, 'created_at' => '2025-11-20 07:21:52', 'updated_at' => '2025-11-20 07:21:52'],
            ['id_tax' => 44, 'id_tax_type' => 10, 'tax' => 'Freight Forwarding', 'tax_persen' => 0.011, 'tax_description' => 'Freight Forwarding', 'status' => 1, 'created_at' => '2025-11-20 07:22:47', 'updated_at' => '2025-12-01 04:10:18'],
            ['id_tax' => 45, 'id_tax_type' => 10, 'tax' => 'KMS', 'tax_persen' => 0.024, 'tax_description' => 'KMS (Kegiatan Membangun Sendiri)', 'status' => 1, 'created_at' => '2025-11-20 07:23:19', 'updated_at' => '2025-11-20 07:23:19'],
        ];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_tax')->upsert($chunk, ['id_tax'], ['id_tax_type', 'tax', 'tax_persen', 'tax_description', 'status', 'created_at', 'updated_at']);
        }
    }
}
