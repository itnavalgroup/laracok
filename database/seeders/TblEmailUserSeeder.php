<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblEmailUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
            [
                'id_email_user' => 35,
                'email' => '',
                'id_user' => 21,
                'created_at' => '2025-11-20 09:04:37',
                'updated_at' => '2025-11-20 09:04:37',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 36,
                'email' => '',
                'id_user' => 22,
                'created_at' => '2025-11-20 09:05:31',
                'updated_at' => '2025-11-20 09:05:31',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 39,
                'email' => 'ibrahim@navalgroup.biz',
                'id_user' => 25,
                'created_at' => '2025-11-20 09:26:01',
                'updated_at' => '2025-11-20 09:26:01',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 40,
                'email' => 'hr@navalgroup.biz',
                'id_user' => 26,
                'created_at' => '2025-11-20 09:43:50',
                'updated_at' => '2025-11-20 09:43:50',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 44,
                'email' => '',
                'id_user' => 30,
                'created_at' => '2025-11-20 12:08:12',
                'updated_at' => '2025-11-20 12:08:12',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 45,
                'email' => 'kamija@navalgroup.biz',
                'id_user' => 31,
                'created_at' => '2025-11-20 12:09:57',
                'updated_at' => '2025-11-20 12:09:57',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 46,
                'email' => 'sofyan@navalgroup.biz',
                'id_user' => 32,
                'created_at' => '2025-11-20 12:12:34',
                'updated_at' => '2025-11-20 12:12:34',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 50,
                'email' => 'srihatin@navalgroup.biz',
                'id_user' => 36,
                'created_at' => '2025-11-20 12:35:45',
                'updated_at' => '2025-11-20 12:35:45',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 51,
                'email' => 'Nurmayanti@navalgroup.biz',
                'id_user' => 37,
                'created_at' => '2025-11-20 12:40:15',
                'updated_at' => '2025-11-20 12:40:15',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 54,
                'email' => 'zarqa@navalgroup.biz',
                'id_user' => 40,
                'created_at' => '2025-11-20 12:48:07',
                'updated_at' => '2025-11-20 12:48:07',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 56,
                'email' => 'roy@navalgroup.biz',
                'id_user' => 42,
                'created_at' => '2025-11-20 12:55:41',
                'updated_at' => '2025-11-20 12:55:41',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 57,
                'email' => '',
                'id_user' => 43,
                'created_at' => '2025-11-20 13:35:55',
                'updated_at' => '2025-11-20 13:35:55',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 64,
                'email' => 'leena@navalgroup.biz',
                'id_user' => 46,
                'created_at' => '2025-11-20 13:48:14',
                'updated_at' => '2025-11-20 13:48:14',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 76,
                'email' => 'mariani@navalgroup.biz',
                'id_user' => 51,
                'created_at' => '2025-12-04 02:56:30',
                'updated_at' => '2025-12-04 02:56:30',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 78,
                'email' => 'hrga@navalgroup.biz',
                'id_user' => 53,
                'created_at' => '2025-12-04 03:03:08',
                'updated_at' => '2025-12-04 03:03:08',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 87,
                'email' => 'nana@navalgroup.biz',
                'id_user' => 54,
                'created_at' => '2025-12-08 04:12:19',
                'updated_at' => '2025-12-08 04:12:19',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 92,
                'email' => '',
                'id_user' => 58,
                'created_at' => '2025-12-09 04:10:09',
                'updated_at' => '2025-12-09 04:10:09',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 93,
                'email' => 'batang2navalgroup@outlook.com',
                'id_user' => 29,
                'created_at' => '2025-12-10 04:58:28',
                'updated_at' => '2025-12-10 04:58:28',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 104,
                'email' => 'aman@navalgroup.biz',
                'id_user' => 23,
                'created_at' => '2025-12-22 06:29:32',
                'updated_at' => '2025-12-22 06:29:32',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 106,
                'email' => 'pardi@navalgroup.biz',
                'id_user' => 34,
                'created_at' => '2025-12-22 07:00:42',
                'updated_at' => '2025-12-22 07:00:42',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 107,
                'email' => 'sby@krisabadi.com',
                'id_user' => 33,
                'created_at' => '2025-12-22 07:01:50',
                'updated_at' => '2025-12-22 07:01:50',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 108,
                'email' => 'batang2navalgroup@outlook.com',
                'id_user' => 57,
                'created_at' => '2025-12-22 07:17:42',
                'updated_at' => '2025-12-22 07:17:42',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 109,
                'email' => 'victor@navalgroup.biz',
                'id_user' => 60,
                'created_at' => '2025-12-22 07:25:06',
                'updated_at' => '2025-12-22 07:25:06',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 110,
                'email' => 'dasdad@gmail.com',
                'id_user' => 1,
                'created_at' => '2025-12-23 01:42:25',
                'updated_at' => '2025-12-23 01:42:25',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 111,
                'email' => 'dasdasjd@gmail.com',
                'id_user' => 1,
                'created_at' => '2025-12-23 01:42:25',
                'updated_at' => '2025-12-23 01:42:25',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 112,
                'email' => 'indri@navalgroup.biz',
                'id_user' => 44,
                'created_at' => '2025-12-23 01:50:44',
                'updated_at' => '2025-12-23 01:50:44',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 113,
                'email' => 'asha@navalgroup.biz',
                'id_user' => 49,
                'created_at' => '2025-12-23 01:50:52',
                'updated_at' => '2025-12-23 01:50:52',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 114,
                'email' => 'indah@navalgroup.biz',
                'id_user' => 45,
                'created_at' => '2025-12-23 01:51:01',
                'updated_at' => '2025-12-23 01:51:01',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 115,
                'email' => 'ozy@navalgroup.biz',
                'id_user' => 47,
                'created_at' => '2025-12-23 01:56:27',
                'updated_at' => '2025-12-23 01:56:27',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 116,
                'email' => 'ozy@navalgroup.biz',
                'id_user' => 47,
                'created_at' => '2025-12-23 01:56:27',
                'updated_at' => '2025-12-23 01:56:27',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 117,
                'email' => 'parash@navalgroup.biz',
                'id_user' => 24,
                'created_at' => '2025-12-23 01:59:38',
                'updated_at' => '2025-12-23 01:59:38',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 118,
                'email' => 'maya@navalgroup.biz',
                'id_user' => 48,
                'created_at' => '2025-12-23 02:06:28',
                'updated_at' => '2025-12-23 02:06:28',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 119,
                'email' => 'inggrid@navalgroup.biz',
                'id_user' => 55,
                'created_at' => '2025-12-23 02:53:53',
                'updated_at' => '2025-12-23 02:53:53',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 120,
                'email' => 'inggrid@navalgroup.biz',
                'id_user' => 35,
                'created_at' => '2025-12-23 02:54:55',
                'updated_at' => '2025-12-23 02:54:55',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 121,
                'email' => 'dian@navalgroup.biz',
                'id_user' => 50,
                'created_at' => '2025-12-29 03:14:09',
                'updated_at' => '2025-12-29 03:14:09',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 122,
                'email' => 'aini@navalgroup.biz',
                'id_user' => 38,
                'created_at' => '2025-12-29 03:48:13',
                'updated_at' => '2025-12-29 03:48:13',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 123,
                'email' => 'titin@navalgroup.biz',
                'id_user' => 39,
                'created_at' => '2025-12-31 03:26:28',
                'updated_at' => '2025-12-31 03:26:28',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 124,
                'email' => 'nana@navalgroup.biz',
                'id_user' => 41,
                'created_at' => '2026-01-07 06:11:54',
                'updated_at' => '2026-01-07 06:11:54',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 125,
                'email' => 'nadya@navalgroup.biz',
                'id_user' => 52,
                'created_at' => '2026-01-09 06:32:46',
                'updated_at' => '2026-01-09 06:32:46',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 126,
                'email' => 'production@navalgroup.biz',
                'id_user' => 52,
                'created_at' => '2026-01-09 06:32:46',
                'updated_at' => '2026-01-09 06:32:46',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 127,
                'email' => 'shava@navalgroup.biz',
                'id_user' => 61,
                'created_at' => '2026-01-09 07:30:06',
                'updated_at' => '2026-01-09 07:30:06',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 128,
                'email' => 'santi@navalgroup.biz',
                'id_user' => 27,
                'created_at' => '2026-01-21 03:30:16',
                'updated_at' => '2026-01-21 03:30:16',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 129,
                'email' => '',
                'id_user' => 62,
                'created_at' => '2026-01-22 06:31:03',
                'updated_at' => '2026-01-22 06:31:03',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 130,
                'email' => '',
                'id_user' => 63,
                'created_at' => '2026-01-26 09:09:55',
                'updated_at' => '2026-01-26 09:09:55',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 131,
                'email' => 'syifa@navalgroup.biz',
                'id_user' => 64,
                'created_at' => '2026-02-12 09:24:29',
                'updated_at' => '2026-02-12 09:24:29',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 133,
                'email' => 'Irvansyah@navalgroup.biz',
                'id_user' => 65,
                'created_at' => '2026-02-26 08:38:05',
                'updated_at' => '2026-02-26 08:38:05',
                'deleted_at' => null,
            ],
            [
                'id_email_user' => 134,
                'email' => '',
                'id_user' => 66,
                'created_at' => '2026-03-03 06:27:48',
                'updated_at' => '2026-03-03 06:27:48',
                'deleted_at' => null,
            ],
            // Data Baru per 21 Maret 2026
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_email_user')->insertOrIgnore($chunk);
        }



        // Data Baru per 21 March 2026 (skema diperbarui)
        DB::table('tbl_email_user')->insertOrIgnore([

            [
                'id_email_user' => 135,
                'email' => 'hrga@navalgroup.biz',
                'id_user' => 53,
                'created_at' => '2026-03-18 04:22:20',
                'updated_at' => '2026-03-18 04:22:20',
                'deleted_at' => null,
            ],
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
