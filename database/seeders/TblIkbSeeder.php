<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblIkbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<SQL
INSERT IGNORE INTO `tbl_ikb` (`id_ikb`, `id_user`, `sales`, `id_warehouse`, `id_vendor`, `id_departement`, `id_company`, `id_doc_type`, `id_ikb_transaction_type`, `number`, `ikb_number`, `po_number`, `so_number`, `ri_number`, `sk_number`, `do_number`, `batch_number`, `destination`, `qr`, `status`, `booking_date`, `stuffing_date`, `delivery_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 25, 1, 1, 1, 5, 4, NULL, 1, 'IKB.NVL.IT.2603.001', 'dasdasd', 'dsadasdasd', 'dasdasdasd', 'dasdasdas', 'dasfasfascasaddad', 'dasdasdad', 'Batangff', NULL, 10, '2026-03-12 00:00:00', '2026-03-12 00:00:00', '2026-03-12 00:00:00', '2026-03-12 00:20:45', '2026-03-12 05:14:22', NULL),
(2, 1, 31, 2, 3, 17, 5, 4, 2, 1, 'IKB.NVL.GA.2603.001', 'dasdasvasdas', 'dsavasdasfasf', 'fsavsadasgfas', 'dsavasfasfasfsa', 'fsavsadfasd', 'dsavsadsadsadavasdasd', 'Makassar', NULL, 10, '2026-03-12 00:00:00', '2026-03-12 00:00:00', '2026-03-12 00:00:00', '2026-03-12 05:27:39', '2026-03-13 08:04:29', NULL),
(3, 1, 50, 2, 2, 1, 5, 4, 5, 2, 'IKB.NVL.IT.2603.002', 'dasfasd', 'dasvsadasd', 'vsafdsadas', 'dsavsadsad', 'dsacasdas', 'dsasadsad', 'China', NULL, 10, '2026-03-12 00:00:00', '2026-03-10 00:00:00', '2026-03-12 00:00:00', '2026-03-12 06:29:15', '2026-03-12 06:32:04', NULL),
(4, 1, 51, 1, 2, 1, 1, 4, 6, 3, 'IKB.SBB.IT.2603.003', '123123', '4213123', 'rwrwe42432', '3124232', '321e213123', '3213123', 'China', NULL, 7, '2026-03-16 00:00:00', '2026-03-14 00:00:00', NULL, '2026-03-12 06:47:04', '2026-03-14 02:32:22', NULL),
(5, 41, 40, 1, 3, 8, 6, 4, 4, 1, 'IKB.KSA.PURCHASING.2603.001', 'jksahbdjsasahjkwdbj', 'bjsdfbdsjkfs bjkovbnk', 'dhsbbjksdfbjkdsfbhjj', 'dbhjkflsd nbhdsjds bj', 'bbjkldskfsdhfdsf', 'hbdfdshbfsfshdbnfg', 'Solo', NULL, 10, '2026-03-12 00:00:00', '2026-03-19 00:00:00', '2026-03-25 00:00:00', '2026-03-13 03:00:52', '2026-03-13 06:35:59', NULL);

SQL);

        Schema::enableForeignKeyConstraints();
    }
}
