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
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_item_categories` (`id_item_category`, `id_user`, `item_category_code`, `item_category`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'ALP.000', 'ALPHAPINENE', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(2, 1, 'CIN.000', 'CINEOL', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(3, 1, 'CSF.000', 'CAUSTIC SODA FLAKE', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(4, 1, 'DNL.000', 'DAUN NILAM', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(5, 1, 'DPT.000', 'DEPENTENE', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(6, 1, 'FAC.000', 'FUMARIC ACID TECH GRADE', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(7, 1, 'IAS.000', 'PINE OIL', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(8, 1, 'ICO.000', 'COPAL', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(9, 1, 'IDA.000', 'DAMAR', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(10, 1, 'IDB.000', 'DAMAR BATU', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(11, 1, 'IDE.000', 'TERPENIOL', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(12, 1, 'IGE.000', 'OLEO PINE RESIN', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(13, 1, 'IKI.000', 'PARAFIN', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(14, 1, 'ILB.000', 'LIMBAH', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(15, 1, 'IRO.000', 'GUM ROSIN', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(16, 1, 'ITU.000', 'TURPENTINE OIL', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(17, 1, 'LHM.000', 'LITHIUM HYDROXIDE MONOHYDRATE', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(18, 1, 'MEL.000', 'MELAMINE', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(19, 1, 'SAC.000', 'STEARIC ACID', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(20, 1, 'SOL.000', 'SEREH OIL', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(21, 1, 'STP.000', 'SODIUM TRIPOLYPHOSPHATE', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(22, 1, 'WOL.000', 'WHITE OIL', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL),
(23, 1, 'IPA.000', 'RAW MATERIAL', 1, '2026-03-25 17:17:01', '2026-03-25 17:17:01', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
