<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblAttachmentIkbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<SQL
INSERT IGNORE INTO `tbl_attachment_ikb` (`id_attachment_ikb`, `id_ikb`, `id_attachment`, `id_user`, `note`, `filename`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 67, 1, 'Test', '1773282209_69b223a1929d5.pdf', '2026-03-12 02:23:29', '2026-03-12 02:37:04', '2026-03-11 19:37:04'),
(2, 1, 46, 1, 'Gooo', '1773283139_69b227430d256.png', '2026-03-12 02:38:59', '2026-03-12 02:39:17', NULL),
(3, 1, 57, 1, 'fafasfasf', '1773287857_69b239b141a66.pdf', '2026-03-12 03:57:37', '2026-03-12 03:57:37', NULL),
(4, 1, 41, 1, 'vzvzxvzxv', '1773292443_69b24b9b431cd.pdf', '2026-03-12 05:14:03', '2026-03-12 05:14:03', NULL),
(5, 2, 47, 1, 'Test', '1773296834_69b25cc25dec3.pdf', '2026-03-12 06:27:14', '2026-03-12 06:27:14', NULL),
(6, 3, 60, 1, 'dsdasdasd', '1773297010_69b25d7206e8c.pdf', '2026-03-12 06:30:10', '2026-03-12 06:30:10', NULL),
(7, 3, 39, 1, 'dasdasd', '1773297098_69b25dca60138.jpg', '2026-03-12 06:31:38', '2026-03-12 06:31:38', NULL),
(8, 4, 49, 1, 'tidadsd', '1773298357_69b262b59a686.jpg', '2026-03-12 06:52:37', '2026-03-12 06:52:37', NULL),
(9, 4, 63, 1, 'dasdasd', '1773298507_69b2634b3dead.jpg', '2026-03-12 06:55:07', '2026-03-12 06:55:07', NULL),
(10, 5, 39, 24, 'GHJK', '1773377377_69b3976161c95.pdf', '2026-03-13 04:49:37', '2026-03-13 05:47:36', '2026-03-12 22:47:36'),
(11, 5, 67, 1, 'asdasdasd', '1773381736_69b3a868353d8.pdf', '2026-03-13 06:02:16', '2026-03-13 06:02:16', NULL),
(12, 5, 56, 24, 'wiasdhsausosdada', '1773383638_69b3afd6a8b53.pdf', '2026-03-13 06:33:58', '2026-03-13 06:33:58', NULL),
(13, 2, 51, 1, 'sadasdasd', '1773389053_69b3c4fd51ceb.jpg', '2026-03-13 08:04:13', '2026-03-13 08:04:13', NULL),
(14, 4, 38, 1, 'bknkj', '1773429284_69b4622461f36.pdf', '2026-03-13 19:14:44', '2026-03-13 19:14:44', NULL);

SQL);

        Schema::enableForeignKeyConstraints();
    }
}
