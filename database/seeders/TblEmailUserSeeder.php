<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblEmailUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_email_user')->truncate();

        $data = [
            [
                'id_email_user' => 35,
                'email' => '',
                'id_user' => 21,
                'created_at' => '2025-11-20 02:04:37',
                'updated_at' => '2025-11-20 02:04:37',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 36,
                'email' => '',
                'id_user' => 22,
                'created_at' => '2025-11-20 02:05:31',
                'updated_at' => '2025-11-20 02:05:31',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 39,
                'email' => 'ibrahim@navalgroup.biz',
                'id_user' => 25,
                'created_at' => '2025-11-20 02:26:01',
                'updated_at' => '2025-11-20 02:26:01',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 40,
                'email' => 'hr@navalgroup.biz',
                'id_user' => 26,
                'created_at' => '2025-11-20 02:43:50',
                'updated_at' => '2026-03-27 00:40:57',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 44,
                'email' => '',
                'id_user' => 30,
                'created_at' => '2025-11-20 05:08:12',
                'updated_at' => '2025-11-20 05:08:12',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 45,
                'email' => 'kamija@navalgroup.biz',
                'id_user' => 31,
                'created_at' => '2025-11-20 05:09:57',
                'updated_at' => '2025-11-20 05:09:57',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 46,
                'email' => 'sofyan@navalgroup.biz',
                'id_user' => 32,
                'created_at' => '2025-11-20 05:12:34',
                'updated_at' => '2026-03-24 20:19:01',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 50,
                'email' => 'srihatin@navalgroup.biz',
                'id_user' => 36,
                'created_at' => '2025-11-20 05:35:45',
                'updated_at' => '2026-03-27 00:41:36',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 51,
                'email' => 'Nurmayanti@navalgroup.biz',
                'id_user' => 37,
                'created_at' => '2025-11-20 05:40:15',
                'updated_at' => '2025-11-20 05:40:15',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 54,
                'email' => 'zarqa@navalgroup.biz',
                'id_user' => 40,
                'created_at' => '2025-11-20 05:48:07',
                'updated_at' => '2025-11-20 05:48:07',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 56,
                'email' => 'roy@navalgroup.biz',
                'id_user' => 42,
                'created_at' => '2025-11-20 05:55:41',
                'updated_at' => '2026-03-27 00:42:14',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 57,
                'email' => '',
                'id_user' => 43,
                'created_at' => '2025-11-20 06:35:55',
                'updated_at' => '2025-11-20 06:35:55',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 64,
                'email' => 'leena@navalgroup.biz',
                'id_user' => 46,
                'created_at' => '2025-11-20 06:48:14',
                'updated_at' => '2025-11-20 06:48:14',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 76,
                'email' => 'mariani@navalgroup.biz',
                'id_user' => 51,
                'created_at' => '2025-12-03 19:56:30',
                'updated_at' => '2025-12-03 19:56:30',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 78,
                'email' => 'hrga@navalgroup.biz',
                'id_user' => 53,
                'created_at' => '2025-12-03 20:03:08',
                'updated_at' => '2025-12-03 20:03:08',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 87,
                'email' => 'nana@navalgroup.biz',
                'id_user' => 54,
                'created_at' => '2025-12-07 21:12:19',
                'updated_at' => '2025-12-07 21:12:19',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 92,
                'email' => 'usman@navalgroup.biz',
                'id_user' => 58,
                'created_at' => '2025-12-08 21:10:09',
                'updated_at' => '2026-03-24 20:18:37',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 93,
                'email' => 'batang2navalgroup@outlook.com',
                'id_user' => 29,
                'created_at' => '2025-12-09 21:58:28',
                'updated_at' => '2026-03-24 20:17:09',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 104,
                'email' => 'aman@navalgroup.biz',
                'id_user' => 23,
                'created_at' => '2025-12-21 23:29:32',
                'updated_at' => '2025-12-21 23:29:32',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 106,
                'email' => 'pardi@navalgroup.biz',
                'id_user' => 34,
                'created_at' => '2025-12-22 00:00:42',
                'updated_at' => '2025-12-22 00:00:42',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 107,
                'email' => 'sby@krisabadi.com',
                'id_user' => 33,
                'created_at' => '2025-12-22 00:01:50',
                'updated_at' => '2026-03-31 00:12:09',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 108,
                'email' => 'batang2navalgroup@outlook.com',
                'id_user' => 57,
                'created_at' => '2025-12-22 00:17:42',
                'updated_at' => '2026-03-24 20:19:45',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 109,
                'email' => 'victor@navalgroup.biz',
                'id_user' => 60,
                'created_at' => '2025-12-22 00:25:06',
                'updated_at' => '2026-03-24 20:20:10',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 110,
                'email' => 'dasdad@gmail.com',
                'id_user' => 1,
                'created_at' => '2025-12-22 18:42:25',
                'updated_at' => '2025-12-22 18:42:25',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 111,
                'email' => 'dasdasjd@gmail.com',
                'id_user' => 1,
                'created_at' => '2025-12-22 18:42:25',
                'updated_at' => '2025-12-22 18:42:25',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 112,
                'email' => 'indri@navalgroup.biz',
                'id_user' => 44,
                'created_at' => '2025-12-22 18:50:44',
                'updated_at' => '2026-03-25 19:50:13',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 113,
                'email' => 'asha@navalgroup.biz',
                'id_user' => 49,
                'created_at' => '2025-12-22 18:50:52',
                'updated_at' => '2025-12-22 18:50:52',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 114,
                'email' => 'indah@navalgroup.biz',
                'id_user' => 45,
                'created_at' => '2025-12-22 18:51:01',
                'updated_at' => '2025-12-22 18:51:01',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 115,
                'email' => 'ozy@navalgroup.biz',
                'id_user' => 47,
                'created_at' => '2025-12-22 18:56:27',
                'updated_at' => '2025-12-22 18:56:27',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 116,
                'email' => 'ozy@navalgroup.biz',
                'id_user' => 47,
                'created_at' => '2025-12-22 18:56:27',
                'updated_at' => '2025-12-22 18:56:27',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 117,
                'email' => 'parash@navalgroup.biz',
                'id_user' => 24,
                'created_at' => '2025-12-22 18:59:38',
                'updated_at' => '2025-12-22 18:59:38',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 118,
                'email' => 'maya@navalgroup.biz',
                'id_user' => 48,
                'created_at' => '2025-12-22 19:06:28',
                'updated_at' => '2025-12-22 19:06:28',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 119,
                'email' => 'inggrid@navalgroup.biz',
                'id_user' => 55,
                'created_at' => '2025-12-22 19:53:53',
                'updated_at' => '2025-12-22 19:53:53',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 120,
                'email' => 'inggrid@navalgroup.biz',
                'id_user' => 35,
                'created_at' => '2025-12-22 19:54:55',
                'updated_at' => '2025-12-22 19:54:55',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 121,
                'email' => 'dian@navalgroup.biz',
                'id_user' => 50,
                'created_at' => '2025-12-28 20:14:09',
                'updated_at' => '2025-12-28 20:14:09',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 122,
                'email' => 'aini@navalgroup.biz',
                'id_user' => 38,
                'created_at' => '2025-12-28 20:48:13',
                'updated_at' => '2025-12-28 20:48:13',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 123,
                'email' => 'titin@navalgroup.biz',
                'id_user' => 39,
                'created_at' => '2025-12-30 20:26:28',
                'updated_at' => '2025-12-30 20:26:28',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 124,
                'email' => 'nana@navalgroup.biz',
                'id_user' => 41,
                'created_at' => '2026-01-06 23:11:54',
                'updated_at' => '2026-01-06 23:11:54',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 125,
                'email' => 'nadya@navalgroup.biz',
                'id_user' => 52,
                'created_at' => '2026-01-08 23:32:46',
                'updated_at' => '2026-04-05 18:29:05',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 126,
                'email' => 'production@navalgroup.biz',
                'id_user' => 52,
                'created_at' => '2026-01-08 23:32:46',
                'updated_at' => '2026-04-05 18:29:05',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 127,
                'email' => 'shava@navalgroup.biz',
                'id_user' => 61,
                'created_at' => '2026-01-09 00:30:06',
                'updated_at' => '2026-01-09 00:30:06',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 128,
                'email' => 'santi@navalgroup.biz',
                'id_user' => 27,
                'created_at' => '2026-01-20 20:30:16',
                'updated_at' => '2026-01-20 20:30:16',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 129,
                'email' => 'indri@navalgroup.biz',
                'id_user' => 62,
                'created_at' => '2026-01-21 23:31:03',
                'updated_at' => '2026-03-25 19:51:16',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 130,
                'email' => 'neelesh@navalgroup.biz',
                'id_user' => 63,
                'created_at' => '2026-01-26 02:09:55',
                'updated_at' => '2026-03-26 19:15:25',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 131,
                'email' => 'syifa@navalgroup.biz',
                'id_user' => 64,
                'created_at' => '2026-02-12 02:24:29',
                'updated_at' => '2026-02-12 02:24:29',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 133,
                'email' => 'Irvansyah@navalgroup.biz',
                'id_user' => 65,
                'created_at' => '2026-02-26 01:38:05',
                'updated_at' => '2026-02-26 01:38:05',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 134,
                'email' => 'test@navalgroup.biz',
                'id_user' => 66,
                'created_at' => '2026-03-02 23:27:48',
                'updated_at' => '2026-03-24 18:32:47',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 135,
                'email' => 'hrga@navalgroup.biz',
                'id_user' => 53,
                'created_at' => '2026-03-17 21:22:20',
                'updated_at' => '2026-03-17 21:22:20',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 136,
                'email' => 'khoiriyah@navalgroup.biz',
                'id_user' => 56,
                'created_at' => '2026-03-24 20:16:42',
                'updated_at' => '2026-03-24 20:16:42',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 137,
                'email' => 'zumadil@navalgroup.biz',
                'id_user' => 67,
                'created_at' => '2026-03-25 17:12:20',
                'updated_at' => '2026-03-25 17:12:20',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 138,
                'email' => 'fanny@navalgroup.biz',
                'id_user' => 68,
                'created_at' => '2026-03-25 19:47:53',
                'updated_at' => '2026-03-25 19:47:53',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 139,
                'email' => 'example@epr.com',
                'id_user' => 59,
                'created_at' => '2026-03-27 00:39:05',
                'updated_at' => '2026-03-27 00:39:05',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 140,
                'email' => 'neelesh@navalgroup.biz',
                'id_user' => 20,
                'created_at' => '2026-03-30 18:56:07',
                'updated_at' => '2026-03-30 18:56:07',
                'deleted_at' => null
            ],
            [
                'id_email_user' => 141,
                'email' => 'devita@navalgroup.com',
                'id_user' => 69,
                'created_at' => '2026-03-30 23:31:15',
                'updated_at' => '2026-03-31 00:11:45',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_email_user')->insert($chunk);
        }
    }
}
