<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblTaxSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_tax` (`id_tax`, `id_tax_type`, `tax`, `tax_persen`, `tax_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(33, 9, 'PPh 22', 0.00250, 'Pembelian getah ', 1, '2025-11-20 00:15:55', '2025-11-20 00:15:55', NULL),
(34, 9, 'PPh 22', 0.02500, 'Impor ', 1, '2025-11-20 00:16:43', '2025-11-20 00:16:43', NULL),
(35, 9, 'PPh 23', 0.02000, 'Jasa', 1, '2025-11-20 00:17:25', '2025-11-20 00:17:25', NULL),
(36, 9, 'PPh 4(2)', 0.02000, 'Pelaksana Konstruksi Bersertifikat', 1, '2025-11-20 00:17:51', '2025-11-20 00:17:51', NULL),
(37, 9, 'PPh 4(2)', 0.04000, 'Pelaksana Konstruksi Tidak Bersertifikat', 1, '2025-11-20 00:18:18', '2025-11-20 00:18:18', NULL),
(38, 9, 'PPh 4(2)', 0.03000, 'Perencana/Pengawas Konstruksi Bersertifikat', 1, '2025-11-20 00:18:59', '2025-11-20 00:18:59', NULL),
(39, 9, 'PPh 4(2)', 0.06000, 'Perencana/Pengawas Konstruksi Tidak Bersertifikat', 1, '2025-11-20 00:19:31', '2025-11-20 00:19:31', NULL),
(40, 9, '10', 0.10000, 'Sewa Bangunan & Tanah', 1, '2025-11-20 00:20:04', '2025-11-20 00:20:04', NULL),
(41, 9, 'PPh 4(2)', 0.00500, 'Tarif UMKM', 1, '2025-11-20 00:20:50', '2025-11-30 21:10:40', NULL),
(42, 10, 'Kode Faktur 010', 0.12000, 'Kode Faktur 010', 1, '2025-11-20 00:21:30', '2025-11-20 00:21:30', NULL),
(43, 10, 'Kode Faktur 040', 0.11000, 'Kode Faktur 040', 1, '2025-11-20 00:21:52', '2025-11-20 00:21:52', NULL),
(44, 10, 'Freight Forwarding', 0.01100, 'Freight Forwarding', 1, '2025-11-20 00:22:47', '2025-11-30 21:10:18', NULL),
(45, 10, 'KMS', 0.02400, 'KMS (Kegiatan Membangun Sendiri)', 1, '2025-11-20 00:23:19', '2025-11-20 00:23:19', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
