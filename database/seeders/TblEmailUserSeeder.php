<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblEmailUserSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_email_user` (`id_email_user`, `email`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(35, '', 21, '2025-11-20 02:04:37', '2025-11-20 02:04:37', NULL),
(36, '', 22, '2025-11-20 02:05:31', '2025-11-20 02:05:31', NULL),
(39, 'ibrahim@navalgroup.biz', 25, '2025-11-20 02:26:01', '2025-11-20 02:26:01', NULL),
(40, 'hr@navalgroup.biz', 26, '2025-11-20 02:43:50', '2026-03-27 00:40:57', NULL),
(44, '', 30, '2025-11-20 05:08:12', '2025-11-20 05:08:12', NULL),
(45, 'kamija@navalgroup.biz', 31, '2025-11-20 05:09:57', '2025-11-20 05:09:57', NULL),
(46, 'sofyan@navalgroup.biz', 32, '2025-11-20 05:12:34', '2026-03-24 20:19:01', NULL),
(50, 'srihatin@navalgroup.biz', 36, '2025-11-20 05:35:45', '2026-03-27 00:41:36', NULL),
(51, 'Nurmayanti@navalgroup.biz', 37, '2025-11-20 05:40:15', '2025-11-20 05:40:15', NULL),
(54, 'zarqa@navalgroup.biz', 40, '2025-11-20 05:48:07', '2025-11-20 05:48:07', NULL),
(56, 'roy@navalgroup.biz', 42, '2025-11-20 05:55:41', '2026-03-27 00:42:14', NULL),
(57, '', 43, '2025-11-20 06:35:55', '2025-11-20 06:35:55', NULL),
(64, 'leena@navalgroup.biz', 46, '2025-11-20 06:48:14', '2025-11-20 06:48:14', NULL),
(76, 'mariani@navalgroup.biz', 51, '2025-12-03 19:56:30', '2025-12-03 19:56:30', NULL),
(78, 'hrga@navalgroup.biz', 53, '2025-12-03 20:03:08', '2025-12-03 20:03:08', NULL),
(87, 'nana@navalgroup.biz', 54, '2025-12-07 21:12:19', '2025-12-07 21:12:19', NULL),
(92, 'usman@navalgroup.biz', 58, '2025-12-08 21:10:09', '2026-03-24 20:18:37', NULL),
(93, 'batang2navalgroup@outlook.com', 29, '2025-12-09 21:58:28', '2026-03-24 20:17:09', NULL),
(104, 'aman@navalgroup.biz', 23, '2025-12-21 23:29:32', '2025-12-21 23:29:32', NULL),
(106, 'pardi@navalgroup.biz', 34, '2025-12-22 00:00:42', '2025-12-22 00:00:42', NULL),
(107, 'sby@krisabadi.com', 33, '2025-12-22 00:01:50', '2025-12-22 00:01:50', NULL),
(108, 'batang2navalgroup@outlook.com', 57, '2025-12-22 00:17:42', '2026-03-24 20:19:45', NULL),
(109, 'victor@navalgroup.biz', 60, '2025-12-22 00:25:06', '2026-03-24 20:20:10', NULL),
(110, 'dasdad@gmail.com', 1, '2025-12-22 18:42:25', '2025-12-22 18:42:25', NULL),
(111, 'dasdasjd@gmail.com', 1, '2025-12-22 18:42:25', '2025-12-22 18:42:25', NULL),
(112, 'indri@navalgroup.biz', 44, '2025-12-22 18:50:44', '2026-03-25 19:50:13', NULL),
(113, 'asha@navalgroup.biz', 49, '2025-12-22 18:50:52', '2025-12-22 18:50:52', NULL),
(114, 'indah@navalgroup.biz', 45, '2025-12-22 18:51:01', '2025-12-22 18:51:01', NULL),
(115, 'ozy@navalgroup.biz', 47, '2025-12-22 18:56:27', '2025-12-22 18:56:27', NULL),
(116, 'ozy@navalgroup.biz', 47, '2025-12-22 18:56:27', '2025-12-22 18:56:27', NULL),
(117, 'parash@navalgroup.biz', 24, '2025-12-22 18:59:38', '2025-12-22 18:59:38', NULL),
(118, 'maya@navalgroup.biz', 48, '2025-12-22 19:06:28', '2025-12-22 19:06:28', NULL),
(119, 'inggrid@navalgroup.biz', 55, '2025-12-22 19:53:53', '2025-12-22 19:53:53', NULL),
(120, 'inggrid@navalgroup.biz', 35, '2025-12-22 19:54:55', '2025-12-22 19:54:55', NULL),
(121, 'dian@navalgroup.biz', 50, '2025-12-28 20:14:09', '2025-12-28 20:14:09', NULL),
(122, 'aini@navalgroup.biz', 38, '2025-12-28 20:48:13', '2025-12-28 20:48:13', NULL),
(123, 'titin@navalgroup.biz', 39, '2025-12-30 20:26:28', '2025-12-30 20:26:28', NULL),
(124, 'nana@navalgroup.biz', 41, '2026-01-06 23:11:54', '2026-01-06 23:11:54', NULL),
(125, 'nadya@navalgroup.biz', 52, '2026-01-08 23:32:46', '2026-01-08 23:32:46', NULL),
(126, 'production@navalgroup.biz', 52, '2026-01-08 23:32:46', '2026-01-08 23:32:46', NULL),
(127, 'shava@navalgroup.biz', 61, '2026-01-09 00:30:06', '2026-01-09 00:30:06', NULL),
(128, 'santi@navalgroup.biz', 27, '2026-01-20 20:30:16', '2026-01-20 20:30:16', NULL),
(129, 'indri@navalgroup.biz', 62, '2026-01-21 23:31:03', '2026-03-25 19:51:16', NULL),
(130, 'neelesh@navalgroup.biz', 63, '2026-01-26 02:09:55', '2026-03-26 19:15:25', NULL),
(131, 'syifa@navalgroup.biz', 64, '2026-02-12 02:24:29', '2026-02-12 02:24:29', NULL),
(133, 'Irvansyah@navalgroup.biz', 65, '2026-02-26 01:38:05', '2026-02-26 01:38:05', NULL),
(134, 'test@navalgroup.biz', 66, '2026-03-02 23:27:48', '2026-03-24 18:32:47', NULL),
(135, 'hrga@navalgroup.biz', 53, '2026-03-17 21:22:20', '2026-03-17 21:22:20', NULL),
(136, 'khoiriyah@navalgroup.biz', 56, '2026-03-24 20:16:42', '2026-03-24 20:16:42', NULL),
(137, 'zumadil@navalgroup.biz', 67, '2026-03-25 17:12:20', '2026-03-25 17:12:20', NULL),
(138, 'fanny@navalgroup.biz', 68, '2026-03-25 19:47:53', '2026-03-25 19:47:53', NULL),
(139, 'example@epr.com', 59, '2026-03-27 00:39:05', '2026-03-27 00:39:05', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
