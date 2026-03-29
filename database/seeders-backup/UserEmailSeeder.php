<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserEmailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_email_user' => 35, 'id_user' => 1, 'email' => 21, 'created_at' => '2025-11-20 09:04:37',],
            ['id_email_user' => 36, 'id_user' => 1, 'email' => 22, 'created_at' => '2025-11-20 09:05:31',],
            ['id_email_user' => 39, 'id_user' => 25, 'email' => 'ibrahim@navalgroup.biz', 'created_at' => '2025-11-20 09:26:01',],
            ['id_email_user' => 40, 'id_user' => 26, 'email' => 'hr@navalgroup.biz', 'created_at' => '2025-11-20 09:43:50',],
            ['id_email_user' => 44, 'id_user' => 1, 'email' => 30, 'created_at' => '2025-11-20 12:08:12',],
            ['id_email_user' => 45, 'id_user' => 31, 'email' => 'kamija@navalgroup.biz', 'created_at' => '2025-11-20 12:09:57',],
            ['id_email_user' => 46, 'id_user' => 32, 'email' => 'sofyan@navalgroup.biz', 'created_at' => '2025-11-20 12:12:34',],
            ['id_email_user' => 50, 'id_user' => 36, 'email' => 'srihatin@navalgroup.biz', 'created_at' => '2025-11-20 12:35:45',],
            ['id_email_user' => 51, 'id_user' => 37, 'email' => 'Nurmayanti@navalgroup.biz', 'created_at' => '2025-11-20 12:40:15',],
            ['id_email_user' => 54, 'id_user' => 40, 'email' => 'zarqa@navalgroup.biz', 'created_at' => '2025-11-20 12:48:07',],
            ['id_email_user' => 56, 'id_user' => 42, 'email' => 'roy@navalgroup.biz', 'created_at' => '2025-11-20 12:55:41',],
            ['id_email_user' => 57, 'id_user' => 1, 'email' => 43, 'created_at' => '2025-11-20 13:35:55',],
            ['id_email_user' => 64, 'id_user' => 46, 'email' => 'leena@navalgroup.biz', 'created_at' => '2025-11-20 13:48:14',],
            ['id_email_user' => 76, 'id_user' => 51, 'email' => 'mariani@navalgroup.biz', 'created_at' => '2025-12-04 02:56:30',],
            ['id_email_user' => 78, 'id_user' => 53, 'email' => 'hrga@navalgroup.biz', 'created_at' => '2025-12-04 03:03:08',],
            ['id_email_user' => 87, 'id_user' => 54, 'email' => 'nana@navalgroup.biz', 'created_at' => '2025-12-08 04:12:19',],
            ['id_email_user' => 92, 'id_user' => 1, 'email' => 58, 'created_at' => '2025-12-09 04:10:09',],
            ['id_email_user' => 93, 'id_user' => 29, 'email' => 'batang2navalgroup@outlook.com', 'created_at' => '2025-12-10 04:58:28',],
            ['id_email_user' => 104, 'id_user' => 23, 'email' => 'aman@navalgroup.biz', 'created_at' => '2025-12-22 06:29:32',],
            ['id_email_user' => 106, 'id_user' => 34, 'email' => 'pardi@navalgroup.biz', 'created_at' => '2025-12-22 07:00:42',],
            ['id_email_user' => 107, 'id_user' => 33, 'email' => 'sby@krisabadi.com', 'created_at' => '2025-12-22 07:01:50',],
            ['id_email_user' => 108, 'id_user' => 57, 'email' => 'batang2navalgroup@outlook.com', 'created_at' => '2025-12-22 07:17:42',],
            ['id_email_user' => 109, 'id_user' => 60, 'email' => 'victor@navalgroup.biz', 'created_at' => '2025-12-22 07:25:06',],
            ['id_email_user' => 110, 'id_user' => 1, 'email' => 'dasdad@gmail.com', 'created_at' => '2025-12-23 01:42:25',],
            ['id_email_user' => 111, 'id_user' => 1, 'email' => 'dasdasjd@gmail.com', 'created_at' => '2025-12-23 01:42:25',],
            ['id_email_user' => 112, 'id_user' => 44, 'email' => 'indri@navalgroup.biz', 'created_at' => '2025-12-23 01:50:44',],
            ['id_email_user' => 113, 'id_user' => 49, 'email' => 'asha@navalgroup.biz', 'created_at' => '2025-12-23 01:50:52',],
            ['id_email_user' => 114, 'id_user' => 45, 'email' => 'indah@navalgroup.biz', 'created_at' => '2025-12-23 01:51:01',],
            ['id_email_user' => 115, 'id_user' => 47, 'email' => 'ozy@navalgroup.biz', 'created_at' => '2025-12-23 01:56:27',],
            ['id_email_user' => 116, 'id_user' => 47, 'email' => 'ozy@navalgroup.biz', 'created_at' => '2025-12-23 01:56:27',],
            ['id_email_user' => 117, 'id_user' => 24, 'email' => 'parash@navalgroup.biz', 'created_at' => '2025-12-23 01:59:38',],
            ['id_email_user' => 118, 'id_user' => 48, 'email' => 'maya@navalgroup.biz', 'created_at' => '2025-12-23 02:06:28',],
            ['id_email_user' => 119, 'id_user' => 55, 'email' => 'inggrid@navalgroup.biz', 'created_at' => '2025-12-23 02:53:53',],
            ['id_email_user' => 120, 'id_user' => 35, 'email' => 'inggrid@navalgroup.biz', 'created_at' => '2025-12-23 02:54:55',],
            ['id_email_user' => 121, 'id_user' => 50, 'email' => 'dian@navalgroup.biz', 'created_at' => '2025-12-29 03:14:09',],
            ['id_email_user' => 122, 'id_user' => 38, 'email' => 'aini@navalgroup.biz', 'created_at' => '2025-12-29 03:48:13',],
            ['id_email_user' => 123, 'id_user' => 39, 'email' => 'titin@navalgroup.biz', 'created_at' => '2025-12-31 03:26:28',],
            ['id_email_user' => 124, 'id_user' => 41, 'email' => 'nana@navalgroup.biz', 'created_at' => '2026-01-07 06:11:54',],
            ['id_email_user' => 125, 'id_user' => 52, 'email' => 'nadya@navalgroup.biz', 'created_at' => '2026-01-09 06:32:46',],
            ['id_email_user' => 126, 'id_user' => 52, 'email' => 'production@navalgroup.biz', 'created_at' => '2026-01-09 06:32:46',],
            ['id_email_user' => 127, 'id_user' => 61, 'email' => 'shava@navalgroup.biz', 'created_at' => '2026-01-09 07:30:06',],
            ['id_email_user' => 128, 'id_user' => 27, 'email' => 'santi@navalgroup.biz', 'created_at' => '2026-01-21 03:30:16',],
            ['id_email_user' => 129, 'id_user' => 1, 'email' => 62, 'created_at' => '2026-01-22 06:31:03',],
            ['id_email_user' => 130, 'id_user' => 1, 'email' => 63, 'created_at' => '2026-01-26 09:09:55',],
            ['id_email_user' => 131, 'id_user' => 64, 'email' => 'syifa@navalgroup.biz', 'created_at' => '2026-02-12 09:24:29',],
        ];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_email_user')->upsert($chunk, ['id_email_user'], ['id_email_user', 'id_user', 'email', 'created_at', 'updated_at']);
        }
    }
}
