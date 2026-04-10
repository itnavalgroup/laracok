<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblCompanySeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_company` (`id_company`, `company_name`, `company`, `logo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PT Sumber Banyu Biru', 'SBB', '1746512637_a6711f0f28420f340fba.png', '2025-05-02 12:01:17', '2025-05-05 17:03:42', NULL),
(5, 'PT Naval Group', 'NVL', '1746416094_67c48c6b8c22d5dd71d3.png', '2025-05-04 13:34:54', '2025-05-05 17:03:24', NULL),
(6, 'PT Krishna Sukses Abadi', 'KSA', '1746416165_f7be3f8c47aff5891ce0.png', '2025-05-04 13:36:05', '2025-05-04 13:36:05', NULL),
(8, 'PT Rakyat Aceh Makmur', 'RAM-MAKMUR', '1765165615_c0a4c454c5866d63499b.jpg', '2025-12-07 13:46:55', '2025-12-07 14:44:48', NULL),
(9, 'PT Rakyat Aceh Mandiri', 'RAM-MANDIRI', '1765165691_b1166eec1d44032ea9e2.jpeg', '2025-12-07 13:48:11', '2025-12-07 14:45:03', NULL),
(10, 'PT Hamper Nusantara Indonesia', 'HNI', '1768882496_fb838c4dbe0fe891ad4b.png', '2026-01-19 14:14:56', '2026-01-19 14:15:09', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
