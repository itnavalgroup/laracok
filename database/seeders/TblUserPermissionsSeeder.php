<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblUserPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_user_permissions')->truncate();

        $data = [
            [
                'id_user_permission' => 1,
                'id_user' => 33,
                'id_permission' => 1,
                'created_at' => '2026-03-24 18:37:53',
                'updated_at' => '2026-03-24 18:37:53'
            ],
            [
                'id_user_permission' => 3,
                'id_user' => 33,
                'id_permission' => 13,
                'created_at' => '2026-03-24 18:38:12',
                'updated_at' => '2026-03-24 18:38:12'
            ],
            [
                'id_user_permission' => 4,
                'id_user' => 33,
                'id_permission' => 14,
                'created_at' => '2026-03-24 18:38:16',
                'updated_at' => '2026-03-24 18:38:16'
            ],
            [
                'id_user_permission' => 5,
                'id_user' => 33,
                'id_permission' => 15,
                'created_at' => '2026-03-24 18:38:20',
                'updated_at' => '2026-03-24 18:38:20'
            ],
            [
                'id_user_permission' => 6,
                'id_user' => 33,
                'id_permission' => 16,
                'created_at' => '2026-03-24 18:38:21',
                'updated_at' => '2026-03-24 18:38:21'
            ],
            [
                'id_user_permission' => 7,
                'id_user' => 33,
                'id_permission' => 19,
                'created_at' => '2026-03-24 18:38:37',
                'updated_at' => '2026-03-24 18:38:37'
            ],
            [
                'id_user_permission' => 9,
                'id_user' => 33,
                'id_permission' => 23,
                'created_at' => '2026-03-24 18:38:54',
                'updated_at' => '2026-03-24 18:38:54'
            ],
            [
                'id_user_permission' => 10,
                'id_user' => 33,
                'id_permission' => 39,
                'created_at' => '2026-03-24 18:39:08',
                'updated_at' => '2026-03-24 18:39:08'
            ],
            [
                'id_user_permission' => 11,
                'id_user' => 33,
                'id_permission' => 41,
                'created_at' => '2026-03-24 18:39:12',
                'updated_at' => '2026-03-24 18:39:12'
            ],
            [
                'id_user_permission' => 12,
                'id_user' => 33,
                'id_permission' => 40,
                'created_at' => '2026-03-24 18:39:16',
                'updated_at' => '2026-03-24 18:39:16'
            ],
            [
                'id_user_permission' => 13,
                'id_user' => 33,
                'id_permission' => 42,
                'created_at' => '2026-03-24 18:39:19',
                'updated_at' => '2026-03-24 18:39:19'
            ],
            [
                'id_user_permission' => 14,
                'id_user' => 33,
                'id_permission' => 59,
                'created_at' => '2026-03-24 18:39:39',
                'updated_at' => '2026-03-24 18:39:39'
            ],
            [
                'id_user_permission' => 15,
                'id_user' => 33,
                'id_permission' => 63,
                'created_at' => '2026-03-24 18:39:48',
                'updated_at' => '2026-03-24 18:39:48'
            ],
            [
                'id_user_permission' => 16,
                'id_user' => 33,
                'id_permission' => 75,
                'created_at' => '2026-03-24 18:40:01',
                'updated_at' => '2026-03-24 18:40:01'
            ],
            [
                'id_user_permission' => 17,
                'id_user' => 33,
                'id_permission' => 78,
                'created_at' => '2026-03-24 18:40:17',
                'updated_at' => '2026-03-24 18:40:17'
            ],
            [
                'id_user_permission' => 18,
                'id_user' => 33,
                'id_permission' => 79,
                'created_at' => '2026-03-24 18:40:22',
                'updated_at' => '2026-03-24 18:40:22'
            ],
            [
                'id_user_permission' => 19,
                'id_user' => 33,
                'id_permission' => 80,
                'created_at' => '2026-03-24 18:40:26',
                'updated_at' => '2026-03-24 18:40:26'
            ],
            [
                'id_user_permission' => 20,
                'id_user' => 33,
                'id_permission' => 81,
                'created_at' => '2026-03-24 18:40:29',
                'updated_at' => '2026-03-24 18:40:29'
            ],
            [
                'id_user_permission' => 21,
                'id_user' => 33,
                'id_permission' => 82,
                'created_at' => '2026-03-24 18:40:35',
                'updated_at' => '2026-03-24 18:40:35'
            ],
            [
                'id_user_permission' => 22,
                'id_user' => 33,
                'id_permission' => 83,
                'created_at' => '2026-03-24 18:40:44',
                'updated_at' => '2026-03-24 18:40:44'
            ],
            [
                'id_user_permission' => 23,
                'id_user' => 33,
                'id_permission' => 84,
                'created_at' => '2026-03-24 18:40:47',
                'updated_at' => '2026-03-24 18:40:47'
            ],
            [
                'id_user_permission' => 24,
                'id_user' => 33,
                'id_permission' => 85,
                'created_at' => '2026-03-24 18:40:50',
                'updated_at' => '2026-03-24 18:40:50'
            ],
            [
                'id_user_permission' => 25,
                'id_user' => 33,
                'id_permission' => 86,
                'created_at' => '2026-03-24 18:40:54',
                'updated_at' => '2026-03-24 18:40:54'
            ],
            [
                'id_user_permission' => 26,
                'id_user' => 33,
                'id_permission' => 87,
                'created_at' => '2026-03-24 18:40:59',
                'updated_at' => '2026-03-24 18:40:59'
            ],
            [
                'id_user_permission' => 27,
                'id_user' => 33,
                'id_permission' => 89,
                'created_at' => '2026-03-24 18:41:15',
                'updated_at' => '2026-03-24 18:41:15'
            ],
            [
                'id_user_permission' => 28,
                'id_user' => 33,
                'id_permission' => 90,
                'created_at' => '2026-03-24 18:41:19',
                'updated_at' => '2026-03-24 18:41:19'
            ],
            [
                'id_user_permission' => 29,
                'id_user' => 33,
                'id_permission' => 91,
                'created_at' => '2026-03-24 18:41:23',
                'updated_at' => '2026-03-24 18:41:23'
            ],
            [
                'id_user_permission' => 30,
                'id_user' => 33,
                'id_permission' => 92,
                'created_at' => '2026-03-24 18:41:31',
                'updated_at' => '2026-03-24 18:41:31'
            ],
            [
                'id_user_permission' => 31,
                'id_user' => 33,
                'id_permission' => 93,
                'created_at' => '2026-03-24 18:41:40',
                'updated_at' => '2026-03-24 18:41:40'
            ],
            [
                'id_user_permission' => 32,
                'id_user' => 33,
                'id_permission' => 94,
                'created_at' => '2026-03-24 18:41:49',
                'updated_at' => '2026-03-24 18:41:49'
            ],
            [
                'id_user_permission' => 33,
                'id_user' => 33,
                'id_permission' => 111,
                'created_at' => '2026-03-24 18:42:10',
                'updated_at' => '2026-03-24 18:42:10'
            ],
            [
                'id_user_permission' => 34,
                'id_user' => 33,
                'id_permission' => 112,
                'created_at' => '2026-03-24 18:42:10',
                'updated_at' => '2026-03-24 18:42:10'
            ],
            [
                'id_user_permission' => 35,
                'id_user' => 33,
                'id_permission' => 129,
                'created_at' => '2026-03-24 18:42:26',
                'updated_at' => '2026-03-24 18:42:26'
            ],
            [
                'id_user_permission' => 36,
                'id_user' => 33,
                'id_permission' => 130,
                'created_at' => '2026-03-24 18:42:35',
                'updated_at' => '2026-03-24 18:42:35'
            ],
            [
                'id_user_permission' => 37,
                'id_user' => 33,
                'id_permission' => 131,
                'created_at' => '2026-03-24 18:42:35',
                'updated_at' => '2026-03-24 18:42:35'
            ],
            [
                'id_user_permission' => 38,
                'id_user' => 33,
                'id_permission' => 132,
                'created_at' => '2026-03-24 18:42:42',
                'updated_at' => '2026-03-24 18:42:42'
            ],
            [
                'id_user_permission' => 39,
                'id_user' => 33,
                'id_permission' => 133,
                'created_at' => '2026-03-24 18:42:49',
                'updated_at' => '2026-03-24 18:42:49'
            ],
            [
                'id_user_permission' => 40,
                'id_user' => 33,
                'id_permission' => 134,
                'created_at' => '2026-03-24 18:42:52',
                'updated_at' => '2026-03-24 18:42:52'
            ],
            [
                'id_user_permission' => 41,
                'id_user' => 33,
                'id_permission' => 135,
                'created_at' => '2026-03-24 18:42:59',
                'updated_at' => '2026-03-24 18:42:59'
            ],
            [
                'id_user_permission' => 42,
                'id_user' => 33,
                'id_permission' => 136,
                'created_at' => '2026-03-24 18:43:03',
                'updated_at' => '2026-03-24 18:43:03'
            ],
            [
                'id_user_permission' => 43,
                'id_user' => 33,
                'id_permission' => 137,
                'created_at' => '2026-03-24 18:43:04',
                'updated_at' => '2026-03-24 18:43:04'
            ],
            [
                'id_user_permission' => 44,
                'id_user' => 33,
                'id_permission' => 138,
                'created_at' => '2026-03-24 18:43:09',
                'updated_at' => '2026-03-24 18:43:09'
            ],
            [
                'id_user_permission' => 45,
                'id_user' => 33,
                'id_permission' => 141,
                'created_at' => '2026-03-24 18:43:15',
                'updated_at' => '2026-03-24 18:43:15'
            ],
            [
                'id_user_permission' => 46,
                'id_user' => 33,
                'id_permission' => 142,
                'created_at' => '2026-03-24 18:43:19',
                'updated_at' => '2026-03-24 18:43:19'
            ],
            [
                'id_user_permission' => 47,
                'id_user' => 33,
                'id_permission' => 143,
                'created_at' => '2026-03-24 18:43:23',
                'updated_at' => '2026-03-24 18:43:23'
            ],
            [
                'id_user_permission' => 48,
                'id_user' => 33,
                'id_permission' => 144,
                'created_at' => '2026-03-24 18:43:26',
                'updated_at' => '2026-03-24 18:43:26'
            ],
            [
                'id_user_permission' => 49,
                'id_user' => 33,
                'id_permission' => 145,
                'created_at' => '2026-03-24 18:43:34',
                'updated_at' => '2026-03-24 18:43:34'
            ],
            [
                'id_user_permission' => 50,
                'id_user' => 33,
                'id_permission' => 146,
                'created_at' => '2026-03-24 18:43:38',
                'updated_at' => '2026-03-24 18:43:38'
            ],
            [
                'id_user_permission' => 52,
                'id_user' => 33,
                'id_permission' => 147,
                'created_at' => '2026-03-24 18:43:54',
                'updated_at' => '2026-03-24 18:43:54'
            ],
            [
                'id_user_permission' => 53,
                'id_user' => 33,
                'id_permission' => 148,
                'created_at' => '2026-03-24 18:44:01',
                'updated_at' => '2026-03-24 18:44:01'
            ],
            [
                'id_user_permission' => 54,
                'id_user' => 33,
                'id_permission' => 149,
                'created_at' => '2026-03-24 18:44:04',
                'updated_at' => '2026-03-24 18:44:04'
            ],
            [
                'id_user_permission' => 55,
                'id_user' => 33,
                'id_permission' => 150,
                'created_at' => '2026-03-24 18:44:17',
                'updated_at' => '2026-03-24 18:44:17'
            ],
            [
                'id_user_permission' => 56,
                'id_user' => 33,
                'id_permission' => 151,
                'created_at' => '2026-03-24 18:44:21',
                'updated_at' => '2026-03-24 18:44:21'
            ],
            [
                'id_user_permission' => 57,
                'id_user' => 33,
                'id_permission' => 157,
                'created_at' => '2026-03-24 18:44:28',
                'updated_at' => '2026-03-24 18:44:28'
            ],
            [
                'id_user_permission' => 58,
                'id_user' => 33,
                'id_permission' => 158,
                'created_at' => '2026-03-24 18:44:30',
                'updated_at' => '2026-03-24 18:44:30'
            ],
            [
                'id_user_permission' => 59,
                'id_user' => 33,
                'id_permission' => 223,
                'created_at' => '2026-03-24 18:44:59',
                'updated_at' => '2026-03-24 18:44:59'
            ],
            [
                'id_user_permission' => 60,
                'id_user' => 50,
                'id_permission' => 1,
                'created_at' => '2026-03-24 18:46:35',
                'updated_at' => '2026-03-24 18:46:35'
            ],
            [
                'id_user_permission' => 61,
                'id_user' => 50,
                'id_permission' => 13,
                'created_at' => '2026-03-24 18:46:57',
                'updated_at' => '2026-03-24 18:46:57'
            ],
            [
                'id_user_permission' => 62,
                'id_user' => 50,
                'id_permission' => 14,
                'created_at' => '2026-03-24 18:46:58',
                'updated_at' => '2026-03-24 18:46:58'
            ],
            [
                'id_user_permission' => 63,
                'id_user' => 50,
                'id_permission' => 15,
                'created_at' => '2026-03-24 18:47:02',
                'updated_at' => '2026-03-24 18:47:02'
            ],
            [
                'id_user_permission' => 64,
                'id_user' => 50,
                'id_permission' => 16,
                'created_at' => '2026-03-24 18:47:02',
                'updated_at' => '2026-03-24 18:47:02'
            ],
            [
                'id_user_permission' => 65,
                'id_user' => 50,
                'id_permission' => 19,
                'created_at' => '2026-03-24 18:47:10',
                'updated_at' => '2026-03-24 18:47:10'
            ],
            [
                'id_user_permission' => 66,
                'id_user' => 50,
                'id_permission' => 23,
                'created_at' => '2026-03-24 18:47:15',
                'updated_at' => '2026-03-24 18:47:15'
            ],
            [
                'id_user_permission' => 67,
                'id_user' => 50,
                'id_permission' => 39,
                'created_at' => '2026-03-24 18:47:26',
                'updated_at' => '2026-03-24 18:47:26'
            ],
            [
                'id_user_permission' => 68,
                'id_user' => 50,
                'id_permission' => 40,
                'created_at' => '2026-03-24 18:47:27',
                'updated_at' => '2026-03-24 18:47:27'
            ],
            [
                'id_user_permission' => 69,
                'id_user' => 50,
                'id_permission' => 41,
                'created_at' => '2026-03-24 18:47:30',
                'updated_at' => '2026-03-24 18:47:30'
            ],
            [
                'id_user_permission' => 70,
                'id_user' => 50,
                'id_permission' => 42,
                'created_at' => '2026-03-24 18:47:37',
                'updated_at' => '2026-03-24 18:47:37'
            ],
            [
                'id_user_permission' => 71,
                'id_user' => 50,
                'id_permission' => 59,
                'created_at' => '2026-03-24 18:48:17',
                'updated_at' => '2026-03-24 18:48:17'
            ],
            [
                'id_user_permission' => 72,
                'id_user' => 50,
                'id_permission' => 63,
                'created_at' => '2026-03-24 18:48:26',
                'updated_at' => '2026-03-24 18:48:26'
            ],
            [
                'id_user_permission' => 74,
                'id_user' => 50,
                'id_permission' => 78,
                'created_at' => '2026-03-24 18:48:53',
                'updated_at' => '2026-03-24 18:48:53'
            ],
            [
                'id_user_permission' => 75,
                'id_user' => 50,
                'id_permission' => 79,
                'created_at' => '2026-03-24 18:48:59',
                'updated_at' => '2026-03-24 18:48:59'
            ],
            [
                'id_user_permission' => 76,
                'id_user' => 50,
                'id_permission' => 80,
                'created_at' => '2026-03-24 18:49:06',
                'updated_at' => '2026-03-24 18:49:06'
            ],
            [
                'id_user_permission' => 77,
                'id_user' => 50,
                'id_permission' => 81,
                'created_at' => '2026-03-24 18:49:25',
                'updated_at' => '2026-03-24 18:49:25'
            ],
            [
                'id_user_permission' => 78,
                'id_user' => 50,
                'id_permission' => 82,
                'created_at' => '2026-03-24 18:49:30',
                'updated_at' => '2026-03-24 18:49:30'
            ],
            [
                'id_user_permission' => 79,
                'id_user' => 50,
                'id_permission' => 83,
                'created_at' => '2026-03-24 18:49:39',
                'updated_at' => '2026-03-24 18:49:39'
            ],
            [
                'id_user_permission' => 80,
                'id_user' => 50,
                'id_permission' => 84,
                'created_at' => '2026-03-24 18:49:45',
                'updated_at' => '2026-03-24 18:49:45'
            ],
            [
                'id_user_permission' => 81,
                'id_user' => 50,
                'id_permission' => 85,
                'created_at' => '2026-03-24 18:49:49',
                'updated_at' => '2026-03-24 18:49:49'
            ],
            [
                'id_user_permission' => 82,
                'id_user' => 50,
                'id_permission' => 86,
                'created_at' => '2026-03-24 18:49:59',
                'updated_at' => '2026-03-24 18:49:59'
            ],
            [
                'id_user_permission' => 83,
                'id_user' => 50,
                'id_permission' => 87,
                'created_at' => '2026-03-24 18:50:10',
                'updated_at' => '2026-03-24 18:50:10'
            ],
            [
                'id_user_permission' => 84,
                'id_user' => 50,
                'id_permission' => 89,
                'created_at' => '2026-03-24 18:50:21',
                'updated_at' => '2026-03-24 18:50:21'
            ],
            [
                'id_user_permission' => 85,
                'id_user' => 50,
                'id_permission' => 90,
                'created_at' => '2026-03-24 18:50:28',
                'updated_at' => '2026-03-24 18:50:28'
            ],
            [
                'id_user_permission' => 86,
                'id_user' => 50,
                'id_permission' => 91,
                'created_at' => '2026-03-24 18:50:33',
                'updated_at' => '2026-03-24 18:50:33'
            ],
            [
                'id_user_permission' => 87,
                'id_user' => 50,
                'id_permission' => 92,
                'created_at' => '2026-03-24 18:50:34',
                'updated_at' => '2026-03-24 18:50:34'
            ],
            [
                'id_user_permission' => 88,
                'id_user' => 50,
                'id_permission' => 93,
                'created_at' => '2026-03-24 18:50:47',
                'updated_at' => '2026-03-24 18:50:47'
            ],
            [
                'id_user_permission' => 89,
                'id_user' => 50,
                'id_permission' => 94,
                'created_at' => '2026-03-24 18:50:48',
                'updated_at' => '2026-03-24 18:50:48'
            ],
            [
                'id_user_permission' => 90,
                'id_user' => 50,
                'id_permission' => 111,
                'created_at' => '2026-03-24 18:51:11',
                'updated_at' => '2026-03-24 18:51:11'
            ],
            [
                'id_user_permission' => 91,
                'id_user' => 50,
                'id_permission' => 112,
                'created_at' => '2026-03-24 18:51:14',
                'updated_at' => '2026-03-24 18:51:14'
            ],
            [
                'id_user_permission' => 92,
                'id_user' => 50,
                'id_permission' => 129,
                'created_at' => '2026-03-24 18:51:58',
                'updated_at' => '2026-03-24 18:51:58'
            ],
            [
                'id_user_permission' => 93,
                'id_user' => 50,
                'id_permission' => 130,
                'created_at' => '2026-03-24 18:52:01',
                'updated_at' => '2026-03-24 18:52:01'
            ],
            [
                'id_user_permission' => 94,
                'id_user' => 50,
                'id_permission' => 131,
                'created_at' => '2026-03-24 18:52:01',
                'updated_at' => '2026-03-24 18:52:01'
            ],
            [
                'id_user_permission' => 95,
                'id_user' => 50,
                'id_permission' => 132,
                'created_at' => '2026-03-24 18:54:29',
                'updated_at' => '2026-03-24 18:54:29'
            ],
            [
                'id_user_permission' => 97,
                'id_user' => 50,
                'id_permission' => 134,
                'created_at' => '2026-03-24 18:54:38',
                'updated_at' => '2026-03-24 18:54:38'
            ],
            [
                'id_user_permission' => 98,
                'id_user' => 50,
                'id_permission' => 135,
                'created_at' => '2026-03-24 18:54:40',
                'updated_at' => '2026-03-24 18:54:40'
            ],
            [
                'id_user_permission' => 99,
                'id_user' => 50,
                'id_permission' => 137,
                'created_at' => '2026-03-24 18:54:49',
                'updated_at' => '2026-03-24 18:54:49'
            ],
            [
                'id_user_permission' => 100,
                'id_user' => 50,
                'id_permission' => 136,
                'created_at' => '2026-03-24 18:54:51',
                'updated_at' => '2026-03-24 18:54:51'
            ],
            [
                'id_user_permission' => 101,
                'id_user' => 50,
                'id_permission' => 138,
                'created_at' => '2026-03-24 18:54:59',
                'updated_at' => '2026-03-24 18:54:59'
            ],
            [
                'id_user_permission' => 102,
                'id_user' => 50,
                'id_permission' => 141,
                'created_at' => '2026-03-24 18:55:05',
                'updated_at' => '2026-03-24 18:55:05'
            ],
            [
                'id_user_permission' => 103,
                'id_user' => 50,
                'id_permission' => 142,
                'created_at' => '2026-03-24 18:55:12',
                'updated_at' => '2026-03-24 18:55:12'
            ],
            [
                'id_user_permission' => 104,
                'id_user' => 50,
                'id_permission' => 143,
                'created_at' => '2026-03-24 18:55:14',
                'updated_at' => '2026-03-24 18:55:14'
            ],
            [
                'id_user_permission' => 105,
                'id_user' => 50,
                'id_permission' => 144,
                'created_at' => '2026-03-24 18:55:14',
                'updated_at' => '2026-03-24 18:55:14'
            ],
            [
                'id_user_permission' => 106,
                'id_user' => 50,
                'id_permission' => 145,
                'created_at' => '2026-03-24 18:55:20',
                'updated_at' => '2026-03-24 18:55:20'
            ],
            [
                'id_user_permission' => 107,
                'id_user' => 50,
                'id_permission' => 146,
                'created_at' => '2026-03-24 18:55:24',
                'updated_at' => '2026-03-24 18:55:24'
            ],
            [
                'id_user_permission' => 108,
                'id_user' => 50,
                'id_permission' => 147,
                'created_at' => '2026-03-24 18:55:24',
                'updated_at' => '2026-03-24 18:55:24'
            ],
            [
                'id_user_permission' => 109,
                'id_user' => 50,
                'id_permission' => 148,
                'created_at' => '2026-03-24 18:55:36',
                'updated_at' => '2026-03-24 18:55:36'
            ],
            [
                'id_user_permission' => 110,
                'id_user' => 50,
                'id_permission' => 149,
                'created_at' => '2026-03-24 18:55:41',
                'updated_at' => '2026-03-24 18:55:41'
            ],
            [
                'id_user_permission' => 111,
                'id_user' => 50,
                'id_permission' => 150,
                'created_at' => '2026-03-24 18:55:41',
                'updated_at' => '2026-03-24 18:55:41'
            ],
            [
                'id_user_permission' => 112,
                'id_user' => 50,
                'id_permission' => 151,
                'created_at' => '2026-03-24 18:55:51',
                'updated_at' => '2026-03-24 18:55:51'
            ],
            [
                'id_user_permission' => 113,
                'id_user' => 50,
                'id_permission' => 157,
                'created_at' => '2026-03-24 18:55:56',
                'updated_at' => '2026-03-24 18:55:56'
            ],
            [
                'id_user_permission' => 114,
                'id_user' => 50,
                'id_permission' => 158,
                'created_at' => '2026-03-24 18:55:56',
                'updated_at' => '2026-03-24 18:55:56'
            ],
            [
                'id_user_permission' => 115,
                'id_user' => 50,
                'id_permission' => 223,
                'created_at' => '2026-03-24 18:56:26',
                'updated_at' => '2026-03-24 18:56:26'
            ],
            [
                'id_user_permission' => 117,
                'id_user' => 45,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:00:45',
                'updated_at' => '2026-03-24 19:00:45'
            ],
            [
                'id_user_permission' => 118,
                'id_user' => 45,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:01:07',
                'updated_at' => '2026-03-24 19:01:07'
            ],
            [
                'id_user_permission' => 119,
                'id_user' => 45,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:01:08',
                'updated_at' => '2026-03-24 19:01:08'
            ],
            [
                'id_user_permission' => 120,
                'id_user' => 45,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:01:13',
                'updated_at' => '2026-03-24 19:01:13'
            ],
            [
                'id_user_permission' => 121,
                'id_user' => 45,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:01:14',
                'updated_at' => '2026-03-24 19:01:14'
            ],
            [
                'id_user_permission' => 122,
                'id_user' => 45,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:01:22',
                'updated_at' => '2026-03-24 19:01:22'
            ],
            [
                'id_user_permission' => 123,
                'id_user' => 45,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:01:27',
                'updated_at' => '2026-03-24 19:01:27'
            ],
            [
                'id_user_permission' => 124,
                'id_user' => 45,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:01:43',
                'updated_at' => '2026-03-24 19:01:43'
            ],
            [
                'id_user_permission' => 125,
                'id_user' => 45,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:01:44',
                'updated_at' => '2026-03-24 19:01:44'
            ],
            [
                'id_user_permission' => 126,
                'id_user' => 45,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:01:47',
                'updated_at' => '2026-03-24 19:01:47'
            ],
            [
                'id_user_permission' => 127,
                'id_user' => 45,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:01:48',
                'updated_at' => '2026-03-24 19:01:48'
            ],
            [
                'id_user_permission' => 128,
                'id_user' => 45,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:01:59',
                'updated_at' => '2026-03-24 19:01:59'
            ],
            [
                'id_user_permission' => 129,
                'id_user' => 45,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:02:06',
                'updated_at' => '2026-03-24 19:02:06'
            ],
            [
                'id_user_permission' => 131,
                'id_user' => 45,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:02:18',
                'updated_at' => '2026-03-24 19:02:18'
            ],
            [
                'id_user_permission' => 132,
                'id_user' => 45,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:02:21',
                'updated_at' => '2026-03-24 19:02:21'
            ],
            [
                'id_user_permission' => 133,
                'id_user' => 45,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:02:24',
                'updated_at' => '2026-03-24 19:02:24'
            ],
            [
                'id_user_permission' => 134,
                'id_user' => 45,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:02:25',
                'updated_at' => '2026-03-24 19:02:25'
            ],
            [
                'id_user_permission' => 135,
                'id_user' => 45,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:02:48',
                'updated_at' => '2026-03-24 19:02:48'
            ],
            [
                'id_user_permission' => 136,
                'id_user' => 45,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:02:49',
                'updated_at' => '2026-03-24 19:02:49'
            ],
            [
                'id_user_permission' => 137,
                'id_user' => 45,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:02:52',
                'updated_at' => '2026-03-24 19:02:52'
            ],
            [
                'id_user_permission' => 138,
                'id_user' => 45,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:02:52',
                'updated_at' => '2026-03-24 19:02:52'
            ],
            [
                'id_user_permission' => 139,
                'id_user' => 45,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:02:56',
                'updated_at' => '2026-03-24 19:02:56'
            ],
            [
                'id_user_permission' => 141,
                'id_user' => 45,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:03:03',
                'updated_at' => '2026-03-24 19:03:03'
            ],
            [
                'id_user_permission' => 142,
                'id_user' => 45,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:03:04',
                'updated_at' => '2026-03-24 19:03:04'
            ],
            [
                'id_user_permission' => 143,
                'id_user' => 45,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:03:09',
                'updated_at' => '2026-03-24 19:03:09'
            ],
            [
                'id_user_permission' => 144,
                'id_user' => 45,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:03:09',
                'updated_at' => '2026-03-24 19:03:09'
            ],
            [
                'id_user_permission' => 145,
                'id_user' => 45,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:03:14',
                'updated_at' => '2026-03-24 19:03:14'
            ],
            [
                'id_user_permission' => 146,
                'id_user' => 45,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:03:37',
                'updated_at' => '2026-03-24 19:03:37'
            ],
            [
                'id_user_permission' => 147,
                'id_user' => 45,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:03:40',
                'updated_at' => '2026-03-24 19:03:40'
            ],
            [
                'id_user_permission' => 149,
                'id_user' => 45,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:03:52',
                'updated_at' => '2026-03-24 19:03:52'
            ],
            [
                'id_user_permission' => 150,
                'id_user' => 45,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:04:06',
                'updated_at' => '2026-03-24 19:04:06'
            ],
            [
                'id_user_permission' => 151,
                'id_user' => 45,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:04:07',
                'updated_at' => '2026-03-24 19:04:07'
            ],
            [
                'id_user_permission' => 152,
                'id_user' => 45,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:04:09',
                'updated_at' => '2026-03-24 19:04:09'
            ],
            [
                'id_user_permission' => 153,
                'id_user' => 45,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:04:10',
                'updated_at' => '2026-03-24 19:04:10'
            ],
            [
                'id_user_permission' => 154,
                'id_user' => 45,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:04:13',
                'updated_at' => '2026-03-24 19:04:13'
            ],
            [
                'id_user_permission' => 155,
                'id_user' => 23,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:04:23',
                'updated_at' => '2026-03-24 19:04:23'
            ],
            [
                'id_user_permission' => 156,
                'id_user' => 23,
                'id_permission' => 5,
                'created_at' => '2026-03-24 19:04:24',
                'updated_at' => '2026-03-24 19:04:24'
            ],
            [
                'id_user_permission' => 157,
                'id_user' => 23,
                'id_permission' => 9,
                'created_at' => '2026-03-24 19:04:30',
                'updated_at' => '2026-03-24 19:04:30'
            ],
            [
                'id_user_permission' => 158,
                'id_user' => 45,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:04:30',
                'updated_at' => '2026-03-24 19:04:30'
            ],
            [
                'id_user_permission' => 159,
                'id_user' => 45,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:04:31',
                'updated_at' => '2026-03-24 19:04:31'
            ],
            [
                'id_user_permission' => 160,
                'id_user' => 45,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:04:31',
                'updated_at' => '2026-03-24 19:04:31'
            ],
            [
                'id_user_permission' => 161,
                'id_user' => 23,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:04:31',
                'updated_at' => '2026-03-24 19:04:31'
            ],
            [
                'id_user_permission' => 162,
                'id_user' => 23,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:04:38',
                'updated_at' => '2026-03-24 19:04:38'
            ],
            [
                'id_user_permission' => 163,
                'id_user' => 23,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:04:39',
                'updated_at' => '2026-03-24 19:04:39'
            ],
            [
                'id_user_permission' => 164,
                'id_user' => 23,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:04:39',
                'updated_at' => '2026-03-24 19:04:39'
            ],
            [
                'id_user_permission' => 165,
                'id_user' => 45,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:04:44',
                'updated_at' => '2026-03-24 19:04:44'
            ],
            [
                'id_user_permission' => 166,
                'id_user' => 45,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:04:45',
                'updated_at' => '2026-03-24 19:04:45'
            ],
            [
                'id_user_permission' => 167,
                'id_user' => 45,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:04:45',
                'updated_at' => '2026-03-24 19:04:45'
            ],
            [
                'id_user_permission' => 168,
                'id_user' => 45,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:04:47',
                'updated_at' => '2026-03-24 19:04:47'
            ],
            [
                'id_user_permission' => 169,
                'id_user' => 45,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:04:48',
                'updated_at' => '2026-03-24 19:04:48'
            ],
            [
                'id_user_permission' => 170,
                'id_user' => 45,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:04:48',
                'updated_at' => '2026-03-24 19:04:48'
            ],
            [
                'id_user_permission' => 171,
                'id_user' => 23,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:04:49',
                'updated_at' => '2026-03-24 19:04:49'
            ],
            [
                'id_user_permission' => 172,
                'id_user' => 23,
                'id_permission' => 20,
                'created_at' => '2026-03-24 19:04:50',
                'updated_at' => '2026-03-24 19:04:50'
            ],
            [
                'id_user_permission' => 173,
                'id_user' => 45,
                'id_permission' => 147,
                'created_at' => '2026-03-24 19:04:51',
                'updated_at' => '2026-03-24 19:04:51'
            ],
            [
                'id_user_permission' => 174,
                'id_user' => 23,
                'id_permission' => 21,
                'created_at' => '2026-03-24 19:04:52',
                'updated_at' => '2026-03-24 19:04:52'
            ],
            [
                'id_user_permission' => 175,
                'id_user' => 23,
                'id_permission' => 22,
                'created_at' => '2026-03-24 19:04:55',
                'updated_at' => '2026-03-24 19:04:55'
            ],
            [
                'id_user_permission' => 176,
                'id_user' => 45,
                'id_permission' => 148,
                'created_at' => '2026-03-24 19:05:00',
                'updated_at' => '2026-03-24 19:05:00'
            ],
            [
                'id_user_permission' => 177,
                'id_user' => 45,
                'id_permission' => 149,
                'created_at' => '2026-03-24 19:05:01',
                'updated_at' => '2026-03-24 19:05:01'
            ],
            [
                'id_user_permission' => 178,
                'id_user' => 45,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:05:01',
                'updated_at' => '2026-03-24 19:05:01'
            ],
            [
                'id_user_permission' => 179,
                'id_user' => 23,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:05:02',
                'updated_at' => '2026-03-24 19:05:02'
            ],
            [
                'id_user_permission' => 180,
                'id_user' => 23,
                'id_permission' => 24,
                'created_at' => '2026-03-24 19:05:02',
                'updated_at' => '2026-03-24 19:05:02'
            ],
            [
                'id_user_permission' => 181,
                'id_user' => 23,
                'id_permission' => 25,
                'created_at' => '2026-03-24 19:05:02',
                'updated_at' => '2026-03-24 19:05:02'
            ],
            [
                'id_user_permission' => 182,
                'id_user' => 23,
                'id_permission' => 26,
                'created_at' => '2026-03-24 19:05:02',
                'updated_at' => '2026-03-24 19:05:02'
            ],
            [
                'id_user_permission' => 183,
                'id_user' => 45,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:05:03',
                'updated_at' => '2026-03-24 19:05:03'
            ],
            [
                'id_user_permission' => 184,
                'id_user' => 23,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:05:14',
                'updated_at' => '2026-03-24 19:05:14'
            ],
            [
                'id_user_permission' => 185,
                'id_user' => 23,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:05:15',
                'updated_at' => '2026-03-24 19:05:15'
            ],
            [
                'id_user_permission' => 186,
                'id_user' => 23,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:05:15',
                'updated_at' => '2026-03-24 19:05:15'
            ],
            [
                'id_user_permission' => 187,
                'id_user' => 23,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:05:15',
                'updated_at' => '2026-03-24 19:05:15'
            ],
            [
                'id_user_permission' => 188,
                'id_user' => 45,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:05:23',
                'updated_at' => '2026-03-24 19:05:23'
            ],
            [
                'id_user_permission' => 189,
                'id_user' => 45,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:05:23',
                'updated_at' => '2026-03-24 19:05:23'
            ],
            [
                'id_user_permission' => 190,
                'id_user' => 23,
                'id_permission' => 47,
                'created_at' => '2026-03-24 19:05:24',
                'updated_at' => '2026-03-24 19:05:24'
            ],
            [
                'id_user_permission' => 191,
                'id_user' => 23,
                'id_permission' => 51,
                'created_at' => '2026-03-24 19:05:26',
                'updated_at' => '2026-03-24 19:05:26'
            ],
            [
                'id_user_permission' => 192,
                'id_user' => 45,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:05:37',
                'updated_at' => '2026-03-24 19:05:37'
            ],
            [
                'id_user_permission' => 193,
                'id_user' => 23,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:05:42',
                'updated_at' => '2026-03-24 19:05:42'
            ],
            [
                'id_user_permission' => 194,
                'id_user' => 23,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:05:43',
                'updated_at' => '2026-03-24 19:05:43'
            ],
            [
                'id_user_permission' => 195,
                'id_user' => 23,
                'id_permission' => 74,
                'created_at' => '2026-03-24 19:05:54',
                'updated_at' => '2026-03-24 19:05:54'
            ],
            [
                'id_user_permission' => 196,
                'id_user' => 23,
                'id_permission' => 77,
                'created_at' => '2026-03-24 19:05:58',
                'updated_at' => '2026-03-24 19:05:58'
            ],
            [
                'id_user_permission' => 197,
                'id_user' => 23,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:06:06',
                'updated_at' => '2026-03-24 19:06:06'
            ],
            [
                'id_user_permission' => 198,
                'id_user' => 23,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:06:07',
                'updated_at' => '2026-03-24 19:06:07'
            ],
            [
                'id_user_permission' => 199,
                'id_user' => 23,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:06:08',
                'updated_at' => '2026-03-24 19:06:08'
            ],
            [
                'id_user_permission' => 200,
                'id_user' => 23,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:06:09',
                'updated_at' => '2026-03-24 19:06:09'
            ],
            [
                'id_user_permission' => 201,
                'id_user' => 23,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:06:11',
                'updated_at' => '2026-03-24 19:06:11'
            ],
            [
                'id_user_permission' => 202,
                'id_user' => 23,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:06:12',
                'updated_at' => '2026-03-24 19:06:12'
            ],
            [
                'id_user_permission' => 203,
                'id_user' => 23,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:06:19',
                'updated_at' => '2026-03-24 19:06:19'
            ],
            [
                'id_user_permission' => 204,
                'id_user' => 23,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:06:20',
                'updated_at' => '2026-03-24 19:06:20'
            ],
            [
                'id_user_permission' => 205,
                'id_user' => 23,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:06:22',
                'updated_at' => '2026-03-24 19:06:22'
            ],
            [
                'id_user_permission' => 206,
                'id_user' => 35,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:06:30',
                'updated_at' => '2026-03-24 19:06:30'
            ],
            [
                'id_user_permission' => 207,
                'id_user' => 35,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:06:40',
                'updated_at' => '2026-03-24 19:06:40'
            ],
            [
                'id_user_permission' => 208,
                'id_user' => 35,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:06:43',
                'updated_at' => '2026-03-24 19:06:43'
            ],
            [
                'id_user_permission' => 209,
                'id_user' => 35,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:06:43',
                'updated_at' => '2026-03-24 19:06:43'
            ],
            [
                'id_user_permission' => 210,
                'id_user' => 35,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:06:43',
                'updated_at' => '2026-03-24 19:06:43'
            ],
            [
                'id_user_permission' => 211,
                'id_user' => 35,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:06:50',
                'updated_at' => '2026-03-24 19:06:50'
            ],
            [
                'id_user_permission' => 212,
                'id_user' => 35,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:06:55',
                'updated_at' => '2026-03-24 19:06:55'
            ],
            [
                'id_user_permission' => 213,
                'id_user' => 35,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:07:06',
                'updated_at' => '2026-03-24 19:07:06'
            ],
            [
                'id_user_permission' => 214,
                'id_user' => 35,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:07:09',
                'updated_at' => '2026-03-24 19:07:09'
            ],
            [
                'id_user_permission' => 215,
                'id_user' => 35,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:07:09',
                'updated_at' => '2026-03-24 19:07:09'
            ],
            [
                'id_user_permission' => 216,
                'id_user' => 35,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:07:09',
                'updated_at' => '2026-03-24 19:07:09'
            ],
            [
                'id_user_permission' => 217,
                'id_user' => 23,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:07:13',
                'updated_at' => '2026-03-24 19:07:13'
            ],
            [
                'id_user_permission' => 218,
                'id_user' => 23,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:07:14',
                'updated_at' => '2026-03-24 19:07:14'
            ],
            [
                'id_user_permission' => 219,
                'id_user' => 23,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:07:14',
                'updated_at' => '2026-03-24 19:07:14'
            ],
            [
                'id_user_permission' => 220,
                'id_user' => 23,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:07:17',
                'updated_at' => '2026-03-24 19:07:17'
            ],
            [
                'id_user_permission' => 221,
                'id_user' => 23,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:07:18',
                'updated_at' => '2026-03-24 19:07:18'
            ],
            [
                'id_user_permission' => 222,
                'id_user' => 23,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:07:21',
                'updated_at' => '2026-03-24 19:07:21'
            ],
            [
                'id_user_permission' => 223,
                'id_user' => 35,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:07:21',
                'updated_at' => '2026-03-24 19:07:21'
            ],
            [
                'id_user_permission' => 224,
                'id_user' => 23,
                'id_permission' => 98,
                'created_at' => '2026-03-24 19:07:28',
                'updated_at' => '2026-03-24 19:07:28'
            ],
            [
                'id_user_permission' => 225,
                'id_user' => 23,
                'id_permission' => 99,
                'created_at' => '2026-03-24 19:07:29',
                'updated_at' => '2026-03-24 19:07:29'
            ],
            [
                'id_user_permission' => 226,
                'id_user' => 35,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:08:19',
                'updated_at' => '2026-03-24 19:08:19'
            ],
            [
                'id_user_permission' => 227,
                'id_user' => 35,
                'id_permission' => 75,
                'created_at' => '2026-03-24 19:08:32',
                'updated_at' => '2026-03-24 19:08:32'
            ],
            [
                'id_user_permission' => 228,
                'id_user' => 35,
                'id_permission' => 78,
                'created_at' => '2026-03-24 19:08:35',
                'updated_at' => '2026-03-24 19:08:35'
            ],
            [
                'id_user_permission' => 229,
                'id_user' => 35,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:08:41',
                'updated_at' => '2026-03-24 19:08:41'
            ],
            [
                'id_user_permission' => 230,
                'id_user' => 35,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:08:46',
                'updated_at' => '2026-03-24 19:08:46'
            ],
            [
                'id_user_permission' => 231,
                'id_user' => 35,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:08:46',
                'updated_at' => '2026-03-24 19:08:46'
            ],
            [
                'id_user_permission' => 232,
                'id_user' => 35,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:08:46',
                'updated_at' => '2026-03-24 19:08:46'
            ],
            [
                'id_user_permission' => 233,
                'id_user' => 35,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:08:56',
                'updated_at' => '2026-03-24 19:08:56'
            ],
            [
                'id_user_permission' => 234,
                'id_user' => 35,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:08:59',
                'updated_at' => '2026-03-24 19:08:59'
            ],
            [
                'id_user_permission' => 235,
                'id_user' => 35,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:08:59',
                'updated_at' => '2026-03-24 19:08:59'
            ],
            [
                'id_user_permission' => 236,
                'id_user' => 35,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:08:59',
                'updated_at' => '2026-03-24 19:08:59'
            ],
            [
                'id_user_permission' => 237,
                'id_user' => 35,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:09:04',
                'updated_at' => '2026-03-24 19:09:04'
            ],
            [
                'id_user_permission' => 238,
                'id_user' => 35,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:09:13',
                'updated_at' => '2026-03-24 19:09:13'
            ],
            [
                'id_user_permission' => 239,
                'id_user' => 35,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:09:17',
                'updated_at' => '2026-03-24 19:09:17'
            ],
            [
                'id_user_permission' => 240,
                'id_user' => 35,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:09:17',
                'updated_at' => '2026-03-24 19:09:17'
            ],
            [
                'id_user_permission' => 241,
                'id_user' => 35,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:09:17',
                'updated_at' => '2026-03-24 19:09:17'
            ],
            [
                'id_user_permission' => 242,
                'id_user' => 35,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:09:17',
                'updated_at' => '2026-03-24 19:09:17'
            ],
            [
                'id_user_permission' => 243,
                'id_user' => 35,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:09:28',
                'updated_at' => '2026-03-24 19:09:28'
            ],
            [
                'id_user_permission' => 244,
                'id_user' => 35,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:09:41',
                'updated_at' => '2026-03-24 19:09:41'
            ],
            [
                'id_user_permission' => 245,
                'id_user' => 35,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:09:44',
                'updated_at' => '2026-03-24 19:09:44'
            ],
            [
                'id_user_permission' => 246,
                'id_user' => 35,
                'id_permission' => 129,
                'created_at' => '2026-03-24 19:09:55',
                'updated_at' => '2026-03-24 19:09:55'
            ],
            [
                'id_user_permission' => 247,
                'id_user' => 35,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:09:58',
                'updated_at' => '2026-03-24 19:09:58'
            ],
            [
                'id_user_permission' => 248,
                'id_user' => 35,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:09:58',
                'updated_at' => '2026-03-24 19:09:58'
            ],
            [
                'id_user_permission' => 249,
                'id_user' => 35,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:09:58',
                'updated_at' => '2026-03-24 19:09:58'
            ],
            [
                'id_user_permission' => 250,
                'id_user' => 35,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:09:58',
                'updated_at' => '2026-03-24 19:09:58'
            ],
            [
                'id_user_permission' => 251,
                'id_user' => 35,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:09:58',
                'updated_at' => '2026-03-24 19:09:58'
            ],
            [
                'id_user_permission' => 252,
                'id_user' => 35,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:10:04',
                'updated_at' => '2026-03-24 19:10:04'
            ],
            [
                'id_user_permission' => 253,
                'id_user' => 35,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:10:16',
                'updated_at' => '2026-03-24 19:10:16'
            ],
            [
                'id_user_permission' => 254,
                'id_user' => 35,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:10:20',
                'updated_at' => '2026-03-24 19:10:20'
            ],
            [
                'id_user_permission' => 255,
                'id_user' => 35,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:10:20',
                'updated_at' => '2026-03-24 19:10:20'
            ],
            [
                'id_user_permission' => 256,
                'id_user' => 35,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:10:31',
                'updated_at' => '2026-03-24 19:10:31'
            ],
            [
                'id_user_permission' => 257,
                'id_user' => 35,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:10:35',
                'updated_at' => '2026-03-24 19:10:35'
            ],
            [
                'id_user_permission' => 258,
                'id_user' => 35,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:10:35',
                'updated_at' => '2026-03-24 19:10:35'
            ],
            [
                'id_user_permission' => 259,
                'id_user' => 35,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:10:35',
                'updated_at' => '2026-03-24 19:10:35'
            ],
            [
                'id_user_permission' => 260,
                'id_user' => 35,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:10:35',
                'updated_at' => '2026-03-24 19:10:35'
            ],
            [
                'id_user_permission' => 261,
                'id_user' => 35,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:10:35',
                'updated_at' => '2026-03-24 19:10:35'
            ],
            [
                'id_user_permission' => 262,
                'id_user' => 35,
                'id_permission' => 147,
                'created_at' => '2026-03-24 19:10:48',
                'updated_at' => '2026-03-24 19:10:48'
            ],
            [
                'id_user_permission' => 263,
                'id_user' => 35,
                'id_permission' => 148,
                'created_at' => '2026-03-24 19:10:51',
                'updated_at' => '2026-03-24 19:10:51'
            ],
            [
                'id_user_permission' => 264,
                'id_user' => 35,
                'id_permission' => 149,
                'created_at' => '2026-03-24 19:10:51',
                'updated_at' => '2026-03-24 19:10:51'
            ],
            [
                'id_user_permission' => 265,
                'id_user' => 35,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:10:58',
                'updated_at' => '2026-03-24 19:10:58'
            ],
            [
                'id_user_permission' => 266,
                'id_user' => 35,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:11:25',
                'updated_at' => '2026-03-24 19:11:25'
            ],
            [
                'id_user_permission' => 267,
                'id_user' => 35,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:11:28',
                'updated_at' => '2026-03-24 19:11:28'
            ],
            [
                'id_user_permission' => 268,
                'id_user' => 35,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:11:40',
                'updated_at' => '2026-03-24 19:11:40'
            ],
            [
                'id_user_permission' => 269,
                'id_user' => 55,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:12:49',
                'updated_at' => '2026-03-24 19:12:49'
            ],
            [
                'id_user_permission' => 270,
                'id_user' => 55,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:12:58',
                'updated_at' => '2026-03-24 19:12:58'
            ],
            [
                'id_user_permission' => 271,
                'id_user' => 55,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:13:04',
                'updated_at' => '2026-03-24 19:13:04'
            ],
            [
                'id_user_permission' => 272,
                'id_user' => 55,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:13:04',
                'updated_at' => '2026-03-24 19:13:04'
            ],
            [
                'id_user_permission' => 273,
                'id_user' => 55,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:13:04',
                'updated_at' => '2026-03-24 19:13:04'
            ],
            [
                'id_user_permission' => 274,
                'id_user' => 55,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:13:04',
                'updated_at' => '2026-03-24 19:13:04'
            ],
            [
                'id_user_permission' => 275,
                'id_user' => 55,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:13:09',
                'updated_at' => '2026-03-24 19:13:09'
            ],
            [
                'id_user_permission' => 276,
                'id_user' => 23,
                'id_permission' => 100,
                'created_at' => '2026-03-24 19:13:13',
                'updated_at' => '2026-03-24 19:13:13'
            ],
            [
                'id_user_permission' => 277,
                'id_user' => 23,
                'id_permission' => 101,
                'created_at' => '2026-03-24 19:13:15',
                'updated_at' => '2026-03-24 19:13:15'
            ],
            [
                'id_user_permission' => 278,
                'id_user' => 55,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:13:21',
                'updated_at' => '2026-03-24 19:13:21'
            ],
            [
                'id_user_permission' => 279,
                'id_user' => 55,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:13:26',
                'updated_at' => '2026-03-24 19:13:26'
            ],
            [
                'id_user_permission' => 280,
                'id_user' => 55,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:13:26',
                'updated_at' => '2026-03-24 19:13:26'
            ],
            [
                'id_user_permission' => 281,
                'id_user' => 55,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:13:26',
                'updated_at' => '2026-03-24 19:13:26'
            ],
            [
                'id_user_permission' => 282,
                'id_user' => 55,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:13:54',
                'updated_at' => '2026-03-24 19:13:54'
            ],
            [
                'id_user_permission' => 283,
                'id_user' => 55,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:13:58',
                'updated_at' => '2026-03-24 19:13:58'
            ],
            [
                'id_user_permission' => 284,
                'id_user' => 55,
                'id_permission' => 75,
                'created_at' => '2026-03-24 19:14:07',
                'updated_at' => '2026-03-24 19:14:07'
            ],
            [
                'id_user_permission' => 285,
                'id_user' => 55,
                'id_permission' => 78,
                'created_at' => '2026-03-24 19:14:18',
                'updated_at' => '2026-03-24 19:14:18'
            ],
            [
                'id_user_permission' => 286,
                'id_user' => 55,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:14:21',
                'updated_at' => '2026-03-24 19:14:21'
            ],
            [
                'id_user_permission' => 287,
                'id_user' => 55,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:14:21',
                'updated_at' => '2026-03-24 19:14:21'
            ],
            [
                'id_user_permission' => 288,
                'id_user' => 55,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:14:21',
                'updated_at' => '2026-03-24 19:14:21'
            ],
            [
                'id_user_permission' => 289,
                'id_user' => 55,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:14:21',
                'updated_at' => '2026-03-24 19:14:21'
            ],
            [
                'id_user_permission' => 290,
                'id_user' => 55,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:14:21',
                'updated_at' => '2026-03-24 19:14:21'
            ],
            [
                'id_user_permission' => 291,
                'id_user' => 55,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:14:23',
                'updated_at' => '2026-03-24 19:14:23'
            ],
            [
                'id_user_permission' => 292,
                'id_user' => 55,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:14:26',
                'updated_at' => '2026-03-24 19:14:26'
            ],
            [
                'id_user_permission' => 293,
                'id_user' => 23,
                'id_permission' => 104,
                'created_at' => '2026-03-24 19:14:37',
                'updated_at' => '2026-03-24 19:14:37'
            ],
            [
                'id_user_permission' => 294,
                'id_user' => 55,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:14:45',
                'updated_at' => '2026-03-24 19:14:45'
            ],
            [
                'id_user_permission' => 295,
                'id_user' => 55,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:14:48',
                'updated_at' => '2026-03-24 19:14:48'
            ],
            [
                'id_user_permission' => 296,
                'id_user' => 55,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:14:48',
                'updated_at' => '2026-03-24 19:14:48'
            ],
            [
                'id_user_permission' => 297,
                'id_user' => 23,
                'id_permission' => 105,
                'created_at' => '2026-03-24 19:14:51',
                'updated_at' => '2026-03-24 19:14:51'
            ],
            [
                'id_user_permission' => 298,
                'id_user' => 55,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:14:55',
                'updated_at' => '2026-03-24 19:14:55'
            ],
            [
                'id_user_permission' => 299,
                'id_user' => 55,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:15:03',
                'updated_at' => '2026-03-24 19:15:03'
            ],
            [
                'id_user_permission' => 300,
                'id_user' => 55,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:15:03',
                'updated_at' => '2026-03-24 19:15:03'
            ],
            [
                'id_user_permission' => 301,
                'id_user' => 55,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:15:03',
                'updated_at' => '2026-03-24 19:15:03'
            ],
            [
                'id_user_permission' => 302,
                'id_user' => 55,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:15:03',
                'updated_at' => '2026-03-24 19:15:03'
            ],
            [
                'id_user_permission' => 303,
                'id_user' => 23,
                'id_permission' => 106,
                'created_at' => '2026-03-24 19:15:03',
                'updated_at' => '2026-03-24 19:15:03'
            ],
            [
                'id_user_permission' => 304,
                'id_user' => 23,
                'id_permission' => 107,
                'created_at' => '2026-03-24 19:15:06',
                'updated_at' => '2026-03-24 19:15:06'
            ],
            [
                'id_user_permission' => 305,
                'id_user' => 23,
                'id_permission' => 108,
                'created_at' => '2026-03-24 19:15:06',
                'updated_at' => '2026-03-24 19:15:06'
            ],
            [
                'id_user_permission' => 306,
                'id_user' => 23,
                'id_permission' => 109,
                'created_at' => '2026-03-24 19:15:06',
                'updated_at' => '2026-03-24 19:15:06'
            ],
            [
                'id_user_permission' => 307,
                'id_user' => 23,
                'id_permission' => 110,
                'created_at' => '2026-03-24 19:15:11',
                'updated_at' => '2026-03-24 19:15:11'
            ],
            [
                'id_user_permission' => 308,
                'id_user' => 55,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:15:16',
                'updated_at' => '2026-03-24 19:15:16'
            ],
            [
                'id_user_permission' => 309,
                'id_user' => 23,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:15:17',
                'updated_at' => '2026-03-24 19:15:17'
            ],
            [
                'id_user_permission' => 310,
                'id_user' => 55,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:15:21',
                'updated_at' => '2026-03-24 19:15:21'
            ],
            [
                'id_user_permission' => 311,
                'id_user' => 23,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:15:23',
                'updated_at' => '2026-03-24 19:15:23'
            ],
            [
                'id_user_permission' => 312,
                'id_user' => 23,
                'id_permission' => 113,
                'created_at' => '2026-03-24 19:15:27',
                'updated_at' => '2026-03-24 19:15:27'
            ],
            [
                'id_user_permission' => 313,
                'id_user' => 23,
                'id_permission' => 114,
                'created_at' => '2026-03-24 19:15:27',
                'updated_at' => '2026-03-24 19:15:27'
            ],
            [
                'id_user_permission' => 314,
                'id_user' => 55,
                'id_permission' => 129,
                'created_at' => '2026-03-24 19:15:31',
                'updated_at' => '2026-03-24 19:15:31'
            ],
            [
                'id_user_permission' => 315,
                'id_user' => 55,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:15:35',
                'updated_at' => '2026-03-24 19:15:35'
            ],
            [
                'id_user_permission' => 316,
                'id_user' => 55,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:15:35',
                'updated_at' => '2026-03-24 19:15:35'
            ],
            [
                'id_user_permission' => 317,
                'id_user' => 55,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:15:35',
                'updated_at' => '2026-03-24 19:15:35'
            ],
            [
                'id_user_permission' => 318,
                'id_user' => 55,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:15:35',
                'updated_at' => '2026-03-24 19:15:35'
            ],
            [
                'id_user_permission' => 319,
                'id_user' => 23,
                'id_permission' => 126,
                'created_at' => '2026-03-24 19:15:40',
                'updated_at' => '2026-03-24 19:15:40'
            ],
            [
                'id_user_permission' => 320,
                'id_user' => 55,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:15:42',
                'updated_at' => '2026-03-24 19:15:42'
            ],
            [
                'id_user_permission' => 321,
                'id_user' => 23,
                'id_permission' => 125,
                'created_at' => '2026-03-24 19:15:43',
                'updated_at' => '2026-03-24 19:15:43'
            ],
            [
                'id_user_permission' => 322,
                'id_user' => 55,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:15:47',
                'updated_at' => '2026-03-24 19:15:47'
            ],
            [
                'id_user_permission' => 323,
                'id_user' => 55,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:15:47',
                'updated_at' => '2026-03-24 19:15:47'
            ],
            [
                'id_user_permission' => 324,
                'id_user' => 55,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:15:47',
                'updated_at' => '2026-03-24 19:15:47'
            ],
            [
                'id_user_permission' => 325,
                'id_user' => 55,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:15:47',
                'updated_at' => '2026-03-24 19:15:47'
            ],
            [
                'id_user_permission' => 327,
                'id_user' => 23,
                'id_permission' => 128,
                'created_at' => '2026-03-24 19:16:03',
                'updated_at' => '2026-03-24 19:16:03'
            ],
            [
                'id_user_permission' => 328,
                'id_user' => 23,
                'id_permission' => 129,
                'created_at' => '2026-03-24 19:16:04',
                'updated_at' => '2026-03-24 19:16:04'
            ],
            [
                'id_user_permission' => 329,
                'id_user' => 23,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:16:10',
                'updated_at' => '2026-03-24 19:16:10'
            ],
            [
                'id_user_permission' => 330,
                'id_user' => 55,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:16:11',
                'updated_at' => '2026-03-24 19:16:11'
            ],
            [
                'id_user_permission' => 331,
                'id_user' => 55,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:16:11',
                'updated_at' => '2026-03-24 19:16:11'
            ],
            [
                'id_user_permission' => 332,
                'id_user' => 55,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:16:11',
                'updated_at' => '2026-03-24 19:16:11'
            ],
            [
                'id_user_permission' => 333,
                'id_user' => 23,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:16:13',
                'updated_at' => '2026-03-24 19:16:13'
            ],
            [
                'id_user_permission' => 334,
                'id_user' => 23,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:16:13',
                'updated_at' => '2026-03-24 19:16:13'
            ],
            [
                'id_user_permission' => 335,
                'id_user' => 23,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:16:13',
                'updated_at' => '2026-03-24 19:16:13'
            ],
            [
                'id_user_permission' => 336,
                'id_user' => 23,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:16:13',
                'updated_at' => '2026-03-24 19:16:13'
            ],
            [
                'id_user_permission' => 337,
                'id_user' => 55,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:16:21',
                'updated_at' => '2026-03-24 19:16:21'
            ],
            [
                'id_user_permission' => 338,
                'id_user' => 23,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:16:21',
                'updated_at' => '2026-03-24 19:16:21'
            ],
            [
                'id_user_permission' => 339,
                'id_user' => 55,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:16:23',
                'updated_at' => '2026-03-24 19:16:23'
            ],
            [
                'id_user_permission' => 340,
                'id_user' => 55,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:16:23',
                'updated_at' => '2026-03-24 19:16:23'
            ],
            [
                'id_user_permission' => 341,
                'id_user' => 55,
                'id_permission' => 147,
                'created_at' => '2026-03-24 19:16:23',
                'updated_at' => '2026-03-24 19:16:23'
            ],
            [
                'id_user_permission' => 342,
                'id_user' => 55,
                'id_permission' => 148,
                'created_at' => '2026-03-24 19:16:23',
                'updated_at' => '2026-03-24 19:16:23'
            ],
            [
                'id_user_permission' => 343,
                'id_user' => 23,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:16:24',
                'updated_at' => '2026-03-24 19:16:24'
            ],
            [
                'id_user_permission' => 344,
                'id_user' => 23,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:16:24',
                'updated_at' => '2026-03-24 19:16:24'
            ],
            [
                'id_user_permission' => 345,
                'id_user' => 23,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:16:24',
                'updated_at' => '2026-03-24 19:16:24'
            ],
            [
                'id_user_permission' => 346,
                'id_user' => 55,
                'id_permission' => 149,
                'created_at' => '2026-03-24 19:16:28',
                'updated_at' => '2026-03-24 19:16:28'
            ],
            [
                'id_user_permission' => 347,
                'id_user' => 23,
                'id_permission' => 139,
                'created_at' => '2026-03-24 19:16:31',
                'updated_at' => '2026-03-24 19:16:31'
            ],
            [
                'id_user_permission' => 348,
                'id_user' => 55,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:16:32',
                'updated_at' => '2026-03-24 19:16:32'
            ],
            [
                'id_user_permission' => 349,
                'id_user' => 23,
                'id_permission' => 140,
                'created_at' => '2026-03-24 19:16:34',
                'updated_at' => '2026-03-24 19:16:34'
            ],
            [
                'id_user_permission' => 350,
                'id_user' => 23,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:16:34',
                'updated_at' => '2026-03-24 19:16:34'
            ],
            [
                'id_user_permission' => 351,
                'id_user' => 55,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:16:44',
                'updated_at' => '2026-03-24 19:16:44'
            ],
            [
                'id_user_permission' => 352,
                'id_user' => 23,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:16:50',
                'updated_at' => '2026-03-24 19:16:50'
            ],
            [
                'id_user_permission' => 353,
                'id_user' => 23,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:16:52',
                'updated_at' => '2026-03-24 19:16:52'
            ],
            [
                'id_user_permission' => 354,
                'id_user' => 23,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:16:52',
                'updated_at' => '2026-03-24 19:16:52'
            ],
            [
                'id_user_permission' => 355,
                'id_user' => 55,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:16:54',
                'updated_at' => '2026-03-24 19:16:54'
            ],
            [
                'id_user_permission' => 356,
                'id_user' => 55,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:16:57',
                'updated_at' => '2026-03-24 19:16:57'
            ],
            [
                'id_user_permission' => 357,
                'id_user' => 23,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:16:57',
                'updated_at' => '2026-03-24 19:16:57'
            ],
            [
                'id_user_permission' => 358,
                'id_user' => 23,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:17:02',
                'updated_at' => '2026-03-24 19:17:02'
            ],
            [
                'id_user_permission' => 359,
                'id_user' => 23,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:17:12',
                'updated_at' => '2026-03-24 19:17:12'
            ],
            [
                'id_user_permission' => 360,
                'id_user' => 23,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:17:13',
                'updated_at' => '2026-03-24 19:17:13'
            ],
            [
                'id_user_permission' => 361,
                'id_user' => 55,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:17:15',
                'updated_at' => '2026-03-24 19:17:15'
            ],
            [
                'id_user_permission' => 362,
                'id_user' => 23,
                'id_permission' => 152,
                'created_at' => '2026-03-24 19:17:18',
                'updated_at' => '2026-03-24 19:17:18'
            ],
            [
                'id_user_permission' => 363,
                'id_user' => 23,
                'id_permission' => 153,
                'created_at' => '2026-03-24 19:17:20',
                'updated_at' => '2026-03-24 19:17:20'
            ],
            [
                'id_user_permission' => 364,
                'id_user' => 23,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:17:27',
                'updated_at' => '2026-03-24 19:17:27'
            ],
            [
                'id_user_permission' => 365,
                'id_user' => 23,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:17:29',
                'updated_at' => '2026-03-24 19:17:29'
            ],
            [
                'id_user_permission' => 366,
                'id_user' => 23,
                'id_permission' => 159,
                'created_at' => '2026-03-24 19:17:55',
                'updated_at' => '2026-03-24 19:17:55'
            ],
            [
                'id_user_permission' => 367,
                'id_user' => 23,
                'id_permission' => 160,
                'created_at' => '2026-03-24 19:17:57',
                'updated_at' => '2026-03-24 19:17:57'
            ],
            [
                'id_user_permission' => 368,
                'id_user' => 23,
                'id_permission' => 171,
                'created_at' => '2026-03-24 19:18:03',
                'updated_at' => '2026-03-24 19:18:03'
            ],
            [
                'id_user_permission' => 369,
                'id_user' => 23,
                'id_permission' => 172,
                'created_at' => '2026-03-24 19:18:05',
                'updated_at' => '2026-03-24 19:18:05'
            ],
            [
                'id_user_permission' => 370,
                'id_user' => 23,
                'id_permission' => 173,
                'created_at' => '2026-03-24 19:18:09',
                'updated_at' => '2026-03-24 19:18:09'
            ],
            [
                'id_user_permission' => 371,
                'id_user' => 23,
                'id_permission' => 180,
                'created_at' => '2026-03-24 19:18:23',
                'updated_at' => '2026-03-24 19:18:23'
            ],
            [
                'id_user_permission' => 372,
                'id_user' => 23,
                'id_permission' => 184,
                'created_at' => '2026-03-24 19:18:27',
                'updated_at' => '2026-03-24 19:18:27'
            ],
            [
                'id_user_permission' => 373,
                'id_user' => 65,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:18:30',
                'updated_at' => '2026-03-24 19:18:30'
            ],
            [
                'id_user_permission' => 374,
                'id_user' => 65,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:18:34',
                'updated_at' => '2026-03-24 19:18:34'
            ],
            [
                'id_user_permission' => 375,
                'id_user' => 65,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:18:34',
                'updated_at' => '2026-03-24 19:18:34'
            ],
            [
                'id_user_permission' => 376,
                'id_user' => 65,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:18:40',
                'updated_at' => '2026-03-24 19:18:40'
            ],
            [
                'id_user_permission' => 377,
                'id_user' => 65,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:18:44',
                'updated_at' => '2026-03-24 19:18:44'
            ],
            [
                'id_user_permission' => 378,
                'id_user' => 23,
                'id_permission' => 243,
                'created_at' => '2026-03-24 19:18:45',
                'updated_at' => '2026-03-24 19:18:45'
            ],
            [
                'id_user_permission' => 379,
                'id_user' => 65,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:18:48',
                'updated_at' => '2026-03-24 19:18:48'
            ],
            [
                'id_user_permission' => 380,
                'id_user' => 23,
                'id_permission' => 244,
                'created_at' => '2026-03-24 19:18:48',
                'updated_at' => '2026-03-24 19:18:48'
            ],
            [
                'id_user_permission' => 381,
                'id_user' => 23,
                'id_permission' => 245,
                'created_at' => '2026-03-24 19:18:55',
                'updated_at' => '2026-03-24 19:18:55'
            ],
            [
                'id_user_permission' => 382,
                'id_user' => 23,
                'id_permission' => 191,
                'created_at' => '2026-03-24 19:19:12',
                'updated_at' => '2026-03-24 19:19:12'
            ],
            [
                'id_user_permission' => 383,
                'id_user' => 23,
                'id_permission' => 192,
                'created_at' => '2026-03-24 19:19:30',
                'updated_at' => '2026-03-24 19:19:30'
            ],
            [
                'id_user_permission' => 384,
                'id_user' => 23,
                'id_permission' => 193,
                'created_at' => '2026-03-24 19:19:30',
                'updated_at' => '2026-03-24 19:19:30'
            ],
            [
                'id_user_permission' => 385,
                'id_user' => 23,
                'id_permission' => 246,
                'created_at' => '2026-03-24 19:19:43',
                'updated_at' => '2026-03-24 19:19:43'
            ],
            [
                'id_user_permission' => 386,
                'id_user' => 23,
                'id_permission' => 247,
                'created_at' => '2026-03-24 19:19:55',
                'updated_at' => '2026-03-24 19:19:55'
            ],
            [
                'id_user_permission' => 387,
                'id_user' => 65,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:20:24',
                'updated_at' => '2026-03-24 19:20:24'
            ],
            [
                'id_user_permission' => 388,
                'id_user' => 65,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:20:27',
                'updated_at' => '2026-03-24 19:20:27'
            ],
            [
                'id_user_permission' => 389,
                'id_user' => 65,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:20:27',
                'updated_at' => '2026-03-24 19:20:27'
            ],
            [
                'id_user_permission' => 390,
                'id_user' => 65,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:20:27',
                'updated_at' => '2026-03-24 19:20:27'
            ],
            [
                'id_user_permission' => 391,
                'id_user' => 65,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:20:43',
                'updated_at' => '2026-03-24 19:20:43'
            ],
            [
                'id_user_permission' => 392,
                'id_user' => 65,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:20:48',
                'updated_at' => '2026-03-24 19:20:48'
            ],
            [
                'id_user_permission' => 393,
                'id_user' => 65,
                'id_permission' => 75,
                'created_at' => '2026-03-24 19:20:58',
                'updated_at' => '2026-03-24 19:20:58'
            ],
            [
                'id_user_permission' => 394,
                'id_user' => 65,
                'id_permission' => 78,
                'created_at' => '2026-03-24 19:21:07',
                'updated_at' => '2026-03-24 19:21:07'
            ],
            [
                'id_user_permission' => 395,
                'id_user' => 65,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:21:09',
                'updated_at' => '2026-03-24 19:21:09'
            ],
            [
                'id_user_permission' => 396,
                'id_user' => 65,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:21:09',
                'updated_at' => '2026-03-24 19:21:09'
            ],
            [
                'id_user_permission' => 397,
                'id_user' => 65,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:21:09',
                'updated_at' => '2026-03-24 19:21:09'
            ],
            [
                'id_user_permission' => 398,
                'id_user' => 65,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:21:09',
                'updated_at' => '2026-03-24 19:21:09'
            ],
            [
                'id_user_permission' => 399,
                'id_user' => 65,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:21:09',
                'updated_at' => '2026-03-24 19:21:09'
            ],
            [
                'id_user_permission' => 400,
                'id_user' => 65,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:21:27',
                'updated_at' => '2026-03-24 19:21:27'
            ],
            [
                'id_user_permission' => 401,
                'id_user' => 65,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:21:29',
                'updated_at' => '2026-03-24 19:21:29'
            ],
            [
                'id_user_permission' => 402,
                'id_user' => 65,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:21:29',
                'updated_at' => '2026-03-24 19:21:29'
            ],
            [
                'id_user_permission' => 403,
                'id_user' => 65,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:21:29',
                'updated_at' => '2026-03-24 19:21:29'
            ],
            [
                'id_user_permission' => 404,
                'id_user' => 65,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:21:34',
                'updated_at' => '2026-03-24 19:21:34'
            ],
            [
                'id_user_permission' => 405,
                'id_user' => 65,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:21:36',
                'updated_at' => '2026-03-24 19:21:36'
            ],
            [
                'id_user_permission' => 406,
                'id_user' => 65,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:21:36',
                'updated_at' => '2026-03-24 19:21:36'
            ],
            [
                'id_user_permission' => 407,
                'id_user' => 65,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:21:48',
                'updated_at' => '2026-03-24 19:21:48'
            ],
            [
                'id_user_permission' => 408,
                'id_user' => 65,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:21:52',
                'updated_at' => '2026-03-24 19:21:52'
            ],
            [
                'id_user_permission' => 409,
                'id_user' => 65,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:21:52',
                'updated_at' => '2026-03-24 19:21:52'
            ],
            [
                'id_user_permission' => 410,
                'id_user' => 65,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:22:14',
                'updated_at' => '2026-03-24 19:22:14'
            ],
            [
                'id_user_permission' => 411,
                'id_user' => 65,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:22:17',
                'updated_at' => '2026-03-24 19:22:17'
            ],
            [
                'id_user_permission' => 412,
                'id_user' => 65,
                'id_permission' => 129,
                'created_at' => '2026-03-24 19:22:32',
                'updated_at' => '2026-03-24 19:22:32'
            ],
            [
                'id_user_permission' => 413,
                'id_user' => 65,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:22:34',
                'updated_at' => '2026-03-24 19:22:34'
            ],
            [
                'id_user_permission' => 414,
                'id_user' => 65,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:22:34',
                'updated_at' => '2026-03-24 19:22:34'
            ],
            [
                'id_user_permission' => 415,
                'id_user' => 65,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:22:34',
                'updated_at' => '2026-03-24 19:22:34'
            ],
            [
                'id_user_permission' => 416,
                'id_user' => 65,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:22:40',
                'updated_at' => '2026-03-24 19:22:40'
            ],
            [
                'id_user_permission' => 417,
                'id_user' => 65,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:22:42',
                'updated_at' => '2026-03-24 19:22:42'
            ],
            [
                'id_user_permission' => 418,
                'id_user' => 65,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:22:42',
                'updated_at' => '2026-03-24 19:22:42'
            ],
            [
                'id_user_permission' => 419,
                'id_user' => 65,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:22:42',
                'updated_at' => '2026-03-24 19:22:42'
            ],
            [
                'id_user_permission' => 420,
                'id_user' => 65,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:23:18',
                'updated_at' => '2026-03-24 19:23:18'
            ],
            [
                'id_user_permission' => 421,
                'id_user' => 65,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:23:21',
                'updated_at' => '2026-03-24 19:23:21'
            ],
            [
                'id_user_permission' => 422,
                'id_user' => 65,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:23:31',
                'updated_at' => '2026-03-24 19:23:31'
            ],
            [
                'id_user_permission' => 423,
                'id_user' => 65,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:23:33',
                'updated_at' => '2026-03-24 19:23:33'
            ],
            [
                'id_user_permission' => 424,
                'id_user' => 65,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:23:33',
                'updated_at' => '2026-03-24 19:23:33'
            ],
            [
                'id_user_permission' => 425,
                'id_user' => 65,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:23:33',
                'updated_at' => '2026-03-24 19:23:33'
            ],
            [
                'id_user_permission' => 426,
                'id_user' => 65,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:23:33',
                'updated_at' => '2026-03-24 19:23:33'
            ],
            [
                'id_user_permission' => 427,
                'id_user' => 65,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:23:33',
                'updated_at' => '2026-03-24 19:23:33'
            ],
            [
                'id_user_permission' => 428,
                'id_user' => 65,
                'id_permission' => 147,
                'created_at' => '2026-03-24 19:23:38',
                'updated_at' => '2026-03-24 19:23:38'
            ],
            [
                'id_user_permission' => 429,
                'id_user' => 65,
                'id_permission' => 148,
                'created_at' => '2026-03-24 19:23:40',
                'updated_at' => '2026-03-24 19:23:40'
            ],
            [
                'id_user_permission' => 430,
                'id_user' => 65,
                'id_permission' => 149,
                'created_at' => '2026-03-24 19:23:46',
                'updated_at' => '2026-03-24 19:23:46'
            ],
            [
                'id_user_permission' => 431,
                'id_user' => 65,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:23:48',
                'updated_at' => '2026-03-24 19:23:48'
            ],
            [
                'id_user_permission' => 432,
                'id_user' => 65,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:23:54',
                'updated_at' => '2026-03-24 19:23:54'
            ],
            [
                'id_user_permission' => 433,
                'id_user' => 65,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:24:01',
                'updated_at' => '2026-03-24 19:24:01'
            ],
            [
                'id_user_permission' => 434,
                'id_user' => 65,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:24:03',
                'updated_at' => '2026-03-24 19:24:03'
            ],
            [
                'id_user_permission' => 435,
                'id_user' => 65,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:24:34',
                'updated_at' => '2026-03-24 19:24:34'
            ],
            [
                'id_user_permission' => 436,
                'id_user' => 56,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:25:33',
                'updated_at' => '2026-03-24 19:25:33'
            ],
            [
                'id_user_permission' => 437,
                'id_user' => 59,
                'id_permission' => 222,
                'created_at' => '2026-03-24 19:25:33',
                'updated_at' => '2026-03-24 19:25:33'
            ],
            [
                'id_user_permission' => 438,
                'id_user' => 59,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:25:35',
                'updated_at' => '2026-03-24 19:25:35'
            ],
            [
                'id_user_permission' => 439,
                'id_user' => 56,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:25:44',
                'updated_at' => '2026-03-24 19:25:44'
            ],
            [
                'id_user_permission' => 440,
                'id_user' => 56,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:25:46',
                'updated_at' => '2026-03-24 19:25:46'
            ],
            [
                'id_user_permission' => 441,
                'id_user' => 56,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:25:46',
                'updated_at' => '2026-03-24 19:25:46'
            ],
            [
                'id_user_permission' => 442,
                'id_user' => 56,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:25:46',
                'updated_at' => '2026-03-24 19:25:46'
            ],
            [
                'id_user_permission' => 443,
                'id_user' => 56,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:25:54',
                'updated_at' => '2026-03-24 19:25:54'
            ],
            [
                'id_user_permission' => 444,
                'id_user' => 56,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:25:59',
                'updated_at' => '2026-03-24 19:25:59'
            ],
            [
                'id_user_permission' => 445,
                'id_user' => 56,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:26:10',
                'updated_at' => '2026-03-24 19:26:10'
            ],
            [
                'id_user_permission' => 446,
                'id_user' => 56,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:26:12',
                'updated_at' => '2026-03-24 19:26:12'
            ],
            [
                'id_user_permission' => 447,
                'id_user' => 56,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:26:12',
                'updated_at' => '2026-03-24 19:26:12'
            ],
            [
                'id_user_permission' => 448,
                'id_user' => 56,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:26:12',
                'updated_at' => '2026-03-24 19:26:12'
            ],
            [
                'id_user_permission' => 449,
                'id_user' => 56,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:26:24',
                'updated_at' => '2026-03-24 19:26:24'
            ],
            [
                'id_user_permission' => 450,
                'id_user' => 56,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:26:28',
                'updated_at' => '2026-03-24 19:26:28'
            ],
            [
                'id_user_permission' => 451,
                'id_user' => 56,
                'id_permission' => 75,
                'created_at' => '2026-03-24 19:26:40',
                'updated_at' => '2026-03-24 19:26:40'
            ],
            [
                'id_user_permission' => 452,
                'id_user' => 43,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:26:49',
                'updated_at' => '2026-03-24 19:26:49'
            ],
            [
                'id_user_permission' => 453,
                'id_user' => 56,
                'id_permission' => 76,
                'created_at' => '2026-03-24 19:26:55',
                'updated_at' => '2026-03-24 19:26:55'
            ],
            [
                'id_user_permission' => 454,
                'id_user' => 56,
                'id_permission' => 77,
                'created_at' => '2026-03-24 19:26:57',
                'updated_at' => '2026-03-24 19:26:57'
            ],
            [
                'id_user_permission' => 455,
                'id_user' => 56,
                'id_permission' => 78,
                'created_at' => '2026-03-24 19:26:57',
                'updated_at' => '2026-03-24 19:26:57'
            ],
            [
                'id_user_permission' => 456,
                'id_user' => 56,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:26:57',
                'updated_at' => '2026-03-24 19:26:57'
            ],
            [
                'id_user_permission' => 457,
                'id_user' => 56,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:26:57',
                'updated_at' => '2026-03-24 19:26:57'
            ],
            [
                'id_user_permission' => 458,
                'id_user' => 43,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:27:02',
                'updated_at' => '2026-03-24 19:27:02'
            ],
            [
                'id_user_permission' => 459,
                'id_user' => 43,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:27:02',
                'updated_at' => '2026-03-24 19:27:02'
            ],
            [
                'id_user_permission' => 460,
                'id_user' => 43,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:27:02',
                'updated_at' => '2026-03-24 19:27:02'
            ],
            [
                'id_user_permission' => 461,
                'id_user' => 43,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:27:10',
                'updated_at' => '2026-03-24 19:27:10'
            ],
            [
                'id_user_permission' => 462,
                'id_user' => 43,
                'id_permission' => 20,
                'created_at' => '2026-03-24 19:27:10',
                'updated_at' => '2026-03-24 19:27:10'
            ],
            [
                'id_user_permission' => 463,
                'id_user' => 43,
                'id_permission' => 21,
                'created_at' => '2026-03-24 19:27:10',
                'updated_at' => '2026-03-24 19:27:10'
            ],
            [
                'id_user_permission' => 464,
                'id_user' => 43,
                'id_permission' => 22,
                'created_at' => '2026-03-24 19:27:10',
                'updated_at' => '2026-03-24 19:27:10'
            ],
            [
                'id_user_permission' => 465,
                'id_user' => 56,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:27:15',
                'updated_at' => '2026-03-24 19:27:15'
            ],
            [
                'id_user_permission' => 466,
                'id_user' => 56,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:27:17',
                'updated_at' => '2026-03-24 19:27:17'
            ],
            [
                'id_user_permission' => 467,
                'id_user' => 43,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:27:17',
                'updated_at' => '2026-03-24 19:27:17'
            ],
            [
                'id_user_permission' => 468,
                'id_user' => 43,
                'id_permission' => 24,
                'created_at' => '2026-03-24 19:27:17',
                'updated_at' => '2026-03-24 19:27:17'
            ],
            [
                'id_user_permission' => 469,
                'id_user' => 43,
                'id_permission' => 25,
                'created_at' => '2026-03-24 19:27:17',
                'updated_at' => '2026-03-24 19:27:17'
            ],
            [
                'id_user_permission' => 470,
                'id_user' => 43,
                'id_permission' => 26,
                'created_at' => '2026-03-24 19:27:17',
                'updated_at' => '2026-03-24 19:27:17'
            ],
            [
                'id_user_permission' => 471,
                'id_user' => 56,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:27:25',
                'updated_at' => '2026-03-24 19:27:25'
            ],
            [
                'id_user_permission' => 472,
                'id_user' => 43,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:27:27',
                'updated_at' => '2026-03-24 19:27:27'
            ],
            [
                'id_user_permission' => 473,
                'id_user' => 56,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:27:27',
                'updated_at' => '2026-03-24 19:27:27'
            ],
            [
                'id_user_permission' => 474,
                'id_user' => 56,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:27:27',
                'updated_at' => '2026-03-24 19:27:27'
            ],
            [
                'id_user_permission' => 475,
                'id_user' => 43,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:27:29',
                'updated_at' => '2026-03-24 19:27:29'
            ],
            [
                'id_user_permission' => 476,
                'id_user' => 43,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:27:29',
                'updated_at' => '2026-03-24 19:27:29'
            ],
            [
                'id_user_permission' => 477,
                'id_user' => 43,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:27:29',
                'updated_at' => '2026-03-24 19:27:29'
            ],
            [
                'id_user_permission' => 478,
                'id_user' => 56,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:27:32',
                'updated_at' => '2026-03-24 19:27:32'
            ],
            [
                'id_user_permission' => 479,
                'id_user' => 56,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:27:39',
                'updated_at' => '2026-03-24 19:27:39'
            ],
            [
                'id_user_permission' => 480,
                'id_user' => 43,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:27:48',
                'updated_at' => '2026-03-24 19:27:48'
            ],
            [
                'id_user_permission' => 481,
                'id_user' => 56,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:27:52',
                'updated_at' => '2026-03-24 19:27:52'
            ],
            [
                'id_user_permission' => 482,
                'id_user' => 43,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:27:52',
                'updated_at' => '2026-03-24 19:27:52'
            ],
            [
                'id_user_permission' => 483,
                'id_user' => 56,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:27:53',
                'updated_at' => '2026-03-24 19:27:53'
            ],
            [
                'id_user_permission' => 484,
                'id_user' => 56,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:27:53',
                'updated_at' => '2026-03-24 19:27:53'
            ],
            [
                'id_user_permission' => 485,
                'id_user' => 56,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:27:55',
                'updated_at' => '2026-03-24 19:27:55'
            ],
            [
                'id_user_permission' => 486,
                'id_user' => 56,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:27:57',
                'updated_at' => '2026-03-24 19:27:57'
            ],
            [
                'id_user_permission' => 487,
                'id_user' => 56,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:28:03',
                'updated_at' => '2026-03-24 19:28:03'
            ],
            [
                'id_user_permission' => 490,
                'id_user' => 56,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:28:14',
                'updated_at' => '2026-03-24 19:28:14'
            ],
            [
                'id_user_permission' => 491,
                'id_user' => 56,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:28:16',
                'updated_at' => '2026-03-24 19:28:16'
            ],
            [
                'id_user_permission' => 493,
                'id_user' => 56,
                'id_permission' => 129,
                'created_at' => '2026-03-24 19:28:39',
                'updated_at' => '2026-03-24 19:28:39'
            ],
            [
                'id_user_permission' => 494,
                'id_user' => 56,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:28:40',
                'updated_at' => '2026-03-24 19:28:40'
            ],
            [
                'id_user_permission' => 495,
                'id_user' => 56,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:28:40',
                'updated_at' => '2026-03-24 19:28:40'
            ],
            [
                'id_user_permission' => 496,
                'id_user' => 56,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:28:40',
                'updated_at' => '2026-03-24 19:28:40'
            ],
            [
                'id_user_permission' => 497,
                'id_user' => 56,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:28:40',
                'updated_at' => '2026-03-24 19:28:40'
            ],
            [
                'id_user_permission' => 498,
                'id_user' => 56,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:28:43',
                'updated_at' => '2026-03-24 19:28:43'
            ],
            [
                'id_user_permission' => 499,
                'id_user' => 56,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:28:44',
                'updated_at' => '2026-03-24 19:28:44'
            ],
            [
                'id_user_permission' => 500,
                'id_user' => 43,
                'id_permission' => 78,
                'created_at' => '2026-03-24 19:28:45',
                'updated_at' => '2026-03-24 19:28:45'
            ],
            [
                'id_user_permission' => 501,
                'id_user' => 43,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:28:54',
                'updated_at' => '2026-03-24 19:28:54'
            ],
            [
                'id_user_permission' => 502,
                'id_user' => 56,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:28:54',
                'updated_at' => '2026-03-24 19:28:54'
            ],
            [
                'id_user_permission' => 503,
                'id_user' => 56,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:28:56',
                'updated_at' => '2026-03-24 19:28:56'
            ],
            [
                'id_user_permission' => 504,
                'id_user' => 56,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:28:56',
                'updated_at' => '2026-03-24 19:28:56'
            ],
            [
                'id_user_permission' => 505,
                'id_user' => 56,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:29:00',
                'updated_at' => '2026-03-24 19:29:00'
            ],
            [
                'id_user_permission' => 506,
                'id_user' => 56,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:29:02',
                'updated_at' => '2026-03-24 19:29:02'
            ],
            [
                'id_user_permission' => 507,
                'id_user' => 56,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:29:02',
                'updated_at' => '2026-03-24 19:29:02'
            ],
            [
                'id_user_permission' => 508,
                'id_user' => 43,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:29:03',
                'updated_at' => '2026-03-24 19:29:03'
            ],
            [
                'id_user_permission' => 509,
                'id_user' => 43,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:29:03',
                'updated_at' => '2026-03-24 19:29:03'
            ],
            [
                'id_user_permission' => 510,
                'id_user' => 43,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:29:03',
                'updated_at' => '2026-03-24 19:29:03'
            ],
            [
                'id_user_permission' => 511,
                'id_user' => 43,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:29:03',
                'updated_at' => '2026-03-24 19:29:03'
            ],
            [
                'id_user_permission' => 512,
                'id_user' => 56,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:29:20',
                'updated_at' => '2026-03-24 19:29:20'
            ],
            [
                'id_user_permission' => 513,
                'id_user' => 56,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:29:24',
                'updated_at' => '2026-03-24 19:29:24'
            ],
            [
                'id_user_permission' => 514,
                'id_user' => 56,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:29:24',
                'updated_at' => '2026-03-24 19:29:24'
            ],
            [
                'id_user_permission' => 515,
                'id_user' => 56,
                'id_permission' => 147,
                'created_at' => '2026-03-24 19:29:24',
                'updated_at' => '2026-03-24 19:29:24'
            ],
            [
                'id_user_permission' => 516,
                'id_user' => 56,
                'id_permission' => 148,
                'created_at' => '2026-03-24 19:29:24',
                'updated_at' => '2026-03-24 19:29:24'
            ],
            [
                'id_user_permission' => 517,
                'id_user' => 56,
                'id_permission' => 149,
                'created_at' => '2026-03-24 19:29:24',
                'updated_at' => '2026-03-24 19:29:24'
            ],
            [
                'id_user_permission' => 518,
                'id_user' => 43,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:29:24',
                'updated_at' => '2026-03-24 19:29:24'
            ],
            [
                'id_user_permission' => 519,
                'id_user' => 43,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:29:24',
                'updated_at' => '2026-03-24 19:29:24'
            ],
            [
                'id_user_permission' => 520,
                'id_user' => 43,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:29:24',
                'updated_at' => '2026-03-24 19:29:24'
            ],
            [
                'id_user_permission' => 521,
                'id_user' => 43,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:29:24',
                'updated_at' => '2026-03-24 19:29:24'
            ],
            [
                'id_user_permission' => 522,
                'id_user' => 43,
                'id_permission' => 88,
                'created_at' => '2026-03-24 19:29:24',
                'updated_at' => '2026-03-24 19:29:24'
            ],
            [
                'id_user_permission' => 523,
                'id_user' => 43,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:29:24',
                'updated_at' => '2026-03-24 19:29:24'
            ],
            [
                'id_user_permission' => 524,
                'id_user' => 56,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:29:30',
                'updated_at' => '2026-03-24 19:29:30'
            ],
            [
                'id_user_permission' => 525,
                'id_user' => 56,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:29:30',
                'updated_at' => '2026-03-24 19:29:30'
            ],
            [
                'id_user_permission' => 526,
                'id_user' => 56,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:29:36',
                'updated_at' => '2026-03-24 19:29:36'
            ],
            [
                'id_user_permission' => 527,
                'id_user' => 56,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:29:36',
                'updated_at' => '2026-03-24 19:29:36'
            ],
            [
                'id_user_permission' => 528,
                'id_user' => 43,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:29:39',
                'updated_at' => '2026-03-24 19:29:39'
            ],
            [
                'id_user_permission' => 529,
                'id_user' => 43,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:29:39',
                'updated_at' => '2026-03-24 19:29:39'
            ],
            [
                'id_user_permission' => 530,
                'id_user' => 43,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:29:39',
                'updated_at' => '2026-03-24 19:29:39'
            ],
            [
                'id_user_permission' => 531,
                'id_user' => 43,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:29:46',
                'updated_at' => '2026-03-24 19:29:46'
            ],
            [
                'id_user_permission' => 532,
                'id_user' => 43,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:29:46',
                'updated_at' => '2026-03-24 19:29:46'
            ],
            [
                'id_user_permission' => 533,
                'id_user' => 56,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:29:49',
                'updated_at' => '2026-03-24 19:29:49'
            ],
            [
                'id_user_permission' => 534,
                'id_user' => 43,
                'id_permission' => 98,
                'created_at' => '2026-03-24 19:29:58',
                'updated_at' => '2026-03-24 19:29:58'
            ],
            [
                'id_user_permission' => 535,
                'id_user' => 43,
                'id_permission' => 99,
                'created_at' => '2026-03-24 19:29:58',
                'updated_at' => '2026-03-24 19:29:58'
            ],
            [
                'id_user_permission' => 536,
                'id_user' => 43,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:30:19',
                'updated_at' => '2026-03-24 19:30:19'
            ],
            [
                'id_user_permission' => 537,
                'id_user' => 43,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:30:21',
                'updated_at' => '2026-03-24 19:30:21'
            ],
            [
                'id_user_permission' => 538,
                'id_user' => 41,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:30:53',
                'updated_at' => '2026-03-24 19:30:53'
            ],
            [
                'id_user_permission' => 539,
                'id_user' => 41,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:30:58',
                'updated_at' => '2026-03-24 19:30:58'
            ],
            [
                'id_user_permission' => 540,
                'id_user' => 41,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:30:58',
                'updated_at' => '2026-03-24 19:30:58'
            ],
            [
                'id_user_permission' => 541,
                'id_user' => 41,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:30:58',
                'updated_at' => '2026-03-24 19:30:58'
            ],
            [
                'id_user_permission' => 542,
                'id_user' => 41,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:31:04',
                'updated_at' => '2026-03-24 19:31:04'
            ],
            [
                'id_user_permission' => 543,
                'id_user' => 43,
                'id_permission' => 129,
                'created_at' => '2026-03-24 19:31:22',
                'updated_at' => '2026-03-24 19:31:22'
            ],
            [
                'id_user_permission' => 544,
                'id_user' => 41,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:31:52',
                'updated_at' => '2026-03-24 19:31:52'
            ],
            [
                'id_user_permission' => 545,
                'id_user' => 41,
                'id_permission' => 27,
                'created_at' => '2026-03-24 19:31:56',
                'updated_at' => '2026-03-24 19:31:56'
            ],
            [
                'id_user_permission' => 546,
                'id_user' => 41,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:32:00',
                'updated_at' => '2026-03-24 19:32:00'
            ],
            [
                'id_user_permission' => 547,
                'id_user' => 43,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 548,
                'id_user' => 43,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 549,
                'id_user' => 43,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 550,
                'id_user' => 43,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 551,
                'id_user' => 43,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 552,
                'id_user' => 43,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 553,
                'id_user' => 43,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 554,
                'id_user' => 43,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 555,
                'id_user' => 43,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 556,
                'id_user' => 43,
                'id_permission' => 139,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 557,
                'id_user' => 43,
                'id_permission' => 140,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 558,
                'id_user' => 43,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 559,
                'id_user' => 43,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 560,
                'id_user' => 43,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 561,
                'id_user' => 43,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 562,
                'id_user' => 43,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 563,
                'id_user' => 43,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 564,
                'id_user' => 43,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 565,
                'id_user' => 43,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 566,
                'id_user' => 43,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 567,
                'id_user' => 43,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 568,
                'id_user' => 43,
                'id_permission' => 171,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 569,
                'id_user' => 43,
                'id_permission' => 172,
                'created_at' => '2026-03-24 19:32:10',
                'updated_at' => '2026-03-24 19:32:10'
            ],
            [
                'id_user_permission' => 570,
                'id_user' => 41,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:32:35',
                'updated_at' => '2026-03-24 19:32:35'
            ],
            [
                'id_user_permission' => 571,
                'id_user' => 41,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:32:40',
                'updated_at' => '2026-03-24 19:32:40'
            ],
            [
                'id_user_permission' => 572,
                'id_user' => 41,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:32:40',
                'updated_at' => '2026-03-24 19:32:40'
            ],
            [
                'id_user_permission' => 573,
                'id_user' => 41,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:32:40',
                'updated_at' => '2026-03-24 19:32:40'
            ],
            [
                'id_user_permission' => 574,
                'id_user' => 41,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:32:54',
                'updated_at' => '2026-03-24 19:32:54'
            ],
            [
                'id_user_permission' => 575,
                'id_user' => 41,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:32:58',
                'updated_at' => '2026-03-24 19:32:58'
            ],
            [
                'id_user_permission' => 576,
                'id_user' => 41,
                'id_permission' => 75,
                'created_at' => '2026-03-24 19:33:13',
                'updated_at' => '2026-03-24 19:33:13'
            ],
            [
                'id_user_permission' => 577,
                'id_user' => 43,
                'id_permission' => 173,
                'created_at' => '2026-03-24 19:33:29',
                'updated_at' => '2026-03-24 19:33:29'
            ],
            [
                'id_user_permission' => 578,
                'id_user' => 41,
                'id_permission' => 78,
                'created_at' => '2026-03-24 19:33:33',
                'updated_at' => '2026-03-24 19:33:33'
            ],
            [
                'id_user_permission' => 579,
                'id_user' => 41,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:33:36',
                'updated_at' => '2026-03-24 19:33:36'
            ],
            [
                'id_user_permission' => 580,
                'id_user' => 41,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:33:36',
                'updated_at' => '2026-03-24 19:33:36'
            ],
            [
                'id_user_permission' => 581,
                'id_user' => 41,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:33:36',
                'updated_at' => '2026-03-24 19:33:36'
            ],
            [
                'id_user_permission' => 582,
                'id_user' => 41,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:33:36',
                'updated_at' => '2026-03-24 19:33:36'
            ],
            [
                'id_user_permission' => 583,
                'id_user' => 41,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:33:36',
                'updated_at' => '2026-03-24 19:33:36'
            ],
            [
                'id_user_permission' => 584,
                'id_user' => 41,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:33:36',
                'updated_at' => '2026-03-24 19:33:36'
            ],
            [
                'id_user_permission' => 585,
                'id_user' => 41,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:33:36',
                'updated_at' => '2026-03-24 19:33:36'
            ],
            [
                'id_user_permission' => 586,
                'id_user' => 41,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:33:42',
                'updated_at' => '2026-03-24 19:33:42'
            ],
            [
                'id_user_permission' => 587,
                'id_user' => 43,
                'id_permission' => 243,
                'created_at' => '2026-03-24 19:33:43',
                'updated_at' => '2026-03-24 19:33:43'
            ],
            [
                'id_user_permission' => 588,
                'id_user' => 43,
                'id_permission' => 244,
                'created_at' => '2026-03-24 19:33:44',
                'updated_at' => '2026-03-24 19:33:44'
            ],
            [
                'id_user_permission' => 589,
                'id_user' => 41,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:33:45',
                'updated_at' => '2026-03-24 19:33:45'
            ],
            [
                'id_user_permission' => 591,
                'id_user' => 41,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:33:54',
                'updated_at' => '2026-03-24 19:33:54'
            ],
            [
                'id_user_permission' => 592,
                'id_user' => 41,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:33:57',
                'updated_at' => '2026-03-24 19:33:57'
            ],
            [
                'id_user_permission' => 593,
                'id_user' => 41,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:33:57',
                'updated_at' => '2026-03-24 19:33:57'
            ],
            [
                'id_user_permission' => 594,
                'id_user' => 41,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:33:57',
                'updated_at' => '2026-03-24 19:33:57'
            ],
            [
                'id_user_permission' => 595,
                'id_user' => 41,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:33:57',
                'updated_at' => '2026-03-24 19:33:57'
            ],
            [
                'id_user_permission' => 596,
                'id_user' => 43,
                'id_permission' => 184,
                'created_at' => '2026-03-24 19:34:01',
                'updated_at' => '2026-03-24 19:34:01'
            ],
            [
                'id_user_permission' => 597,
                'id_user' => 41,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:34:01',
                'updated_at' => '2026-03-24 19:34:01'
            ],
            [
                'id_user_permission' => 598,
                'id_user' => 43,
                'id_permission' => 193,
                'created_at' => '2026-03-24 19:34:10',
                'updated_at' => '2026-03-24 19:34:10'
            ],
            [
                'id_user_permission' => 599,
                'id_user' => 41,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:34:17',
                'updated_at' => '2026-03-24 19:34:17'
            ],
            [
                'id_user_permission' => 600,
                'id_user' => 41,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:34:20',
                'updated_at' => '2026-03-24 19:34:20'
            ],
            [
                'id_user_permission' => 601,
                'id_user' => 43,
                'id_permission' => 246,
                'created_at' => '2026-03-24 19:34:25',
                'updated_at' => '2026-03-24 19:34:25'
            ],
            [
                'id_user_permission' => 602,
                'id_user' => 43,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:34:32',
                'updated_at' => '2026-03-24 19:34:32'
            ],
            [
                'id_user_permission' => 603,
                'id_user' => 43,
                'id_permission' => 249,
                'created_at' => '2026-03-24 19:34:39',
                'updated_at' => '2026-03-24 19:34:39'
            ],
            [
                'id_user_permission' => 604,
                'id_user' => 41,
                'id_permission' => 129,
                'created_at' => '2026-03-24 19:34:53',
                'updated_at' => '2026-03-24 19:34:53'
            ],
            [
                'id_user_permission' => 605,
                'id_user' => 41,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:34:55',
                'updated_at' => '2026-03-24 19:34:55'
            ],
            [
                'id_user_permission' => 606,
                'id_user' => 41,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:34:55',
                'updated_at' => '2026-03-24 19:34:55'
            ],
            [
                'id_user_permission' => 607,
                'id_user' => 41,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:34:55',
                'updated_at' => '2026-03-24 19:34:55'
            ],
            [
                'id_user_permission' => 608,
                'id_user' => 41,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:34:55',
                'updated_at' => '2026-03-24 19:34:55'
            ],
            [
                'id_user_permission' => 609,
                'id_user' => 41,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:34:55',
                'updated_at' => '2026-03-24 19:34:55'
            ],
            [
                'id_user_permission' => 610,
                'id_user' => 41,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:35:03',
                'updated_at' => '2026-03-24 19:35:03'
            ],
            [
                'id_user_permission' => 611,
                'id_user' => 41,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:35:05',
                'updated_at' => '2026-03-24 19:35:05'
            ],
            [
                'id_user_permission' => 612,
                'id_user' => 41,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:35:05',
                'updated_at' => '2026-03-24 19:35:05'
            ],
            [
                'id_user_permission' => 613,
                'id_user' => 41,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:35:10',
                'updated_at' => '2026-03-24 19:35:10'
            ],
            [
                'id_user_permission' => 614,
                'id_user' => 41,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:35:13',
                'updated_at' => '2026-03-24 19:35:13'
            ],
            [
                'id_user_permission' => 615,
                'id_user' => 41,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:35:20',
                'updated_at' => '2026-03-24 19:35:20'
            ],
            [
                'id_user_permission' => 616,
                'id_user' => 41,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:35:22',
                'updated_at' => '2026-03-24 19:35:22'
            ],
            [
                'id_user_permission' => 617,
                'id_user' => 41,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:35:22',
                'updated_at' => '2026-03-24 19:35:22'
            ],
            [
                'id_user_permission' => 618,
                'id_user' => 41,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:35:22',
                'updated_at' => '2026-03-24 19:35:22'
            ],
            [
                'id_user_permission' => 619,
                'id_user' => 41,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:35:22',
                'updated_at' => '2026-03-24 19:35:22'
            ],
            [
                'id_user_permission' => 620,
                'id_user' => 41,
                'id_permission' => 147,
                'created_at' => '2026-03-24 19:35:22',
                'updated_at' => '2026-03-24 19:35:22'
            ],
            [
                'id_user_permission' => 621,
                'id_user' => 41,
                'id_permission' => 148,
                'created_at' => '2026-03-24 19:35:24',
                'updated_at' => '2026-03-24 19:35:24'
            ],
            [
                'id_user_permission' => 622,
                'id_user' => 41,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:35:31',
                'updated_at' => '2026-03-24 19:35:31'
            ],
            [
                'id_user_permission' => 623,
                'id_user' => 41,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:35:33',
                'updated_at' => '2026-03-24 19:35:33'
            ],
            [
                'id_user_permission' => 624,
                'id_user' => 41,
                'id_permission' => 149,
                'created_at' => '2026-03-24 19:35:40',
                'updated_at' => '2026-03-24 19:35:40'
            ],
            [
                'id_user_permission' => 625,
                'id_user' => 41,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:35:47',
                'updated_at' => '2026-03-24 19:35:47'
            ],
            [
                'id_user_permission' => 626,
                'id_user' => 41,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:35:54',
                'updated_at' => '2026-03-24 19:35:54'
            ],
            [
                'id_user_permission' => 627,
                'id_user' => 41,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:36:06',
                'updated_at' => '2026-03-24 19:36:06'
            ],
            [
                'id_user_permission' => 628,
                'id_user' => 54,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:36:41',
                'updated_at' => '2026-03-24 19:36:41'
            ],
            [
                'id_user_permission' => 629,
                'id_user' => 54,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:36:46',
                'updated_at' => '2026-03-24 19:36:46'
            ],
            [
                'id_user_permission' => 630,
                'id_user' => 54,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:36:46',
                'updated_at' => '2026-03-24 19:36:46'
            ],
            [
                'id_user_permission' => 631,
                'id_user' => 54,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:36:49',
                'updated_at' => '2026-03-24 19:36:49'
            ],
            [
                'id_user_permission' => 632,
                'id_user' => 54,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:36:49',
                'updated_at' => '2026-03-24 19:36:49'
            ],
            [
                'id_user_permission' => 633,
                'id_user' => 54,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:36:55',
                'updated_at' => '2026-03-24 19:36:55'
            ],
            [
                'id_user_permission' => 634,
                'id_user' => 54,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:37:01',
                'updated_at' => '2026-03-24 19:37:01'
            ],
            [
                'id_user_permission' => 635,
                'id_user' => 54,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:37:08',
                'updated_at' => '2026-03-24 19:37:08'
            ],
            [
                'id_user_permission' => 636,
                'id_user' => 54,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:37:13',
                'updated_at' => '2026-03-24 19:37:13'
            ],
            [
                'id_user_permission' => 637,
                'id_user' => 54,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:37:13',
                'updated_at' => '2026-03-24 19:37:13'
            ],
            [
                'id_user_permission' => 638,
                'id_user' => 54,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:37:13',
                'updated_at' => '2026-03-24 19:37:13'
            ],
            [
                'id_user_permission' => 639,
                'id_user' => 54,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:37:48',
                'updated_at' => '2026-03-24 19:37:48'
            ],
            [
                'id_user_permission' => 640,
                'id_user' => 54,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:37:52',
                'updated_at' => '2026-03-24 19:37:52'
            ],
            [
                'id_user_permission' => 641,
                'id_user' => 54,
                'id_permission' => 75,
                'created_at' => '2026-03-24 19:38:03',
                'updated_at' => '2026-03-24 19:38:03'
            ],
            [
                'id_user_permission' => 642,
                'id_user' => 54,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:38:50',
                'updated_at' => '2026-03-24 19:38:50'
            ],
            [
                'id_user_permission' => 643,
                'id_user' => 54,
                'id_permission' => 78,
                'created_at' => '2026-03-24 19:38:53',
                'updated_at' => '2026-03-24 19:38:53'
            ],
            [
                'id_user_permission' => 644,
                'id_user' => 54,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:38:53',
                'updated_at' => '2026-03-24 19:38:53'
            ],
            [
                'id_user_permission' => 645,
                'id_user' => 54,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:38:53',
                'updated_at' => '2026-03-24 19:38:53'
            ],
            [
                'id_user_permission' => 646,
                'id_user' => 54,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:38:53',
                'updated_at' => '2026-03-24 19:38:53'
            ],
            [
                'id_user_permission' => 647,
                'id_user' => 54,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:38:57',
                'updated_at' => '2026-03-24 19:38:57'
            ],
            [
                'id_user_permission' => 648,
                'id_user' => 54,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:38:57',
                'updated_at' => '2026-03-24 19:38:57'
            ],
            [
                'id_user_permission' => 649,
                'id_user' => 54,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:38:57',
                'updated_at' => '2026-03-24 19:38:57'
            ],
            [
                'id_user_permission' => 650,
                'id_user' => 54,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:38:57',
                'updated_at' => '2026-03-24 19:38:57'
            ],
            [
                'id_user_permission' => 651,
                'id_user' => 44,
                'id_permission' => 5,
                'created_at' => '2026-03-24 19:39:04',
                'updated_at' => '2026-03-24 19:39:04'
            ],
            [
                'id_user_permission' => 652,
                'id_user' => 54,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:39:07',
                'updated_at' => '2026-03-24 19:39:07'
            ],
            [
                'id_user_permission' => 653,
                'id_user' => 44,
                'id_permission' => 9,
                'created_at' => '2026-03-24 19:39:08',
                'updated_at' => '2026-03-24 19:39:08'
            ],
            [
                'id_user_permission' => 654,
                'id_user' => 44,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:39:13',
                'updated_at' => '2026-03-24 19:39:13'
            ],
            [
                'id_user_permission' => 655,
                'id_user' => 44,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:39:13',
                'updated_at' => '2026-03-24 19:39:13'
            ],
            [
                'id_user_permission' => 656,
                'id_user' => 44,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:39:13',
                'updated_at' => '2026-03-24 19:39:13'
            ],
            [
                'id_user_permission' => 657,
                'id_user' => 44,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:39:13',
                'updated_at' => '2026-03-24 19:39:13'
            ],
            [
                'id_user_permission' => 658,
                'id_user' => 44,
                'id_permission' => 17,
                'created_at' => '2026-03-24 19:39:13',
                'updated_at' => '2026-03-24 19:39:13'
            ],
            [
                'id_user_permission' => 659,
                'id_user' => 44,
                'id_permission' => 18,
                'created_at' => '2026-03-24 19:39:13',
                'updated_at' => '2026-03-24 19:39:13'
            ],
            [
                'id_user_permission' => 660,
                'id_user' => 44,
                'id_permission' => 230,
                'created_at' => '2026-03-24 19:39:13',
                'updated_at' => '2026-03-24 19:39:13'
            ],
            [
                'id_user_permission' => 661,
                'id_user' => 54,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:39:13',
                'updated_at' => '2026-03-24 19:39:13'
            ],
            [
                'id_user_permission' => 662,
                'id_user' => 54,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:39:13',
                'updated_at' => '2026-03-24 19:39:13'
            ],
            [
                'id_user_permission' => 663,
                'id_user' => 54,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:39:13',
                'updated_at' => '2026-03-24 19:39:13'
            ],
            [
                'id_user_permission' => 664,
                'id_user' => 54,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:39:18',
                'updated_at' => '2026-03-24 19:39:18'
            ],
            [
                'id_user_permission' => 665,
                'id_user' => 44,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:39:21',
                'updated_at' => '2026-03-24 19:39:21'
            ],
            [
                'id_user_permission' => 666,
                'id_user' => 44,
                'id_permission' => 20,
                'created_at' => '2026-03-24 19:39:21',
                'updated_at' => '2026-03-24 19:39:21'
            ],
            [
                'id_user_permission' => 667,
                'id_user' => 44,
                'id_permission' => 21,
                'created_at' => '2026-03-24 19:39:21',
                'updated_at' => '2026-03-24 19:39:21'
            ],
            [
                'id_user_permission' => 668,
                'id_user' => 44,
                'id_permission' => 22,
                'created_at' => '2026-03-24 19:39:21',
                'updated_at' => '2026-03-24 19:39:21'
            ],
            [
                'id_user_permission' => 669,
                'id_user' => 44,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:39:25',
                'updated_at' => '2026-03-24 19:39:25'
            ],
            [
                'id_user_permission' => 670,
                'id_user' => 44,
                'id_permission' => 24,
                'created_at' => '2026-03-24 19:39:25',
                'updated_at' => '2026-03-24 19:39:25'
            ],
            [
                'id_user_permission' => 671,
                'id_user' => 44,
                'id_permission' => 25,
                'created_at' => '2026-03-24 19:39:25',
                'updated_at' => '2026-03-24 19:39:25'
            ],
            [
                'id_user_permission' => 672,
                'id_user' => 44,
                'id_permission' => 26,
                'created_at' => '2026-03-24 19:39:25',
                'updated_at' => '2026-03-24 19:39:25'
            ],
            [
                'id_user_permission' => 673,
                'id_user' => 54,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:39:28',
                'updated_at' => '2026-03-24 19:39:28'
            ],
            [
                'id_user_permission' => 674,
                'id_user' => 54,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:39:28',
                'updated_at' => '2026-03-24 19:39:28'
            ],
            [
                'id_user_permission' => 675,
                'id_user' => 44,
                'id_permission' => 27,
                'created_at' => '2026-03-24 19:39:29',
                'updated_at' => '2026-03-24 19:39:29'
            ],
            [
                'id_user_permission' => 676,
                'id_user' => 44,
                'id_permission' => 28,
                'created_at' => '2026-03-24 19:39:29',
                'updated_at' => '2026-03-24 19:39:29'
            ],
            [
                'id_user_permission' => 677,
                'id_user' => 44,
                'id_permission' => 29,
                'created_at' => '2026-03-24 19:39:29',
                'updated_at' => '2026-03-24 19:39:29'
            ],
            [
                'id_user_permission' => 678,
                'id_user' => 44,
                'id_permission' => 30,
                'created_at' => '2026-03-24 19:39:29',
                'updated_at' => '2026-03-24 19:39:29'
            ],
            [
                'id_user_permission' => 679,
                'id_user' => 44,
                'id_permission' => 31,
                'created_at' => '2026-03-24 19:39:29',
                'updated_at' => '2026-03-24 19:39:29'
            ],
            [
                'id_user_permission' => 680,
                'id_user' => 44,
                'id_permission' => 32,
                'created_at' => '2026-03-24 19:39:29',
                'updated_at' => '2026-03-24 19:39:29'
            ],
            [
                'id_user_permission' => 681,
                'id_user' => 44,
                'id_permission' => 33,
                'created_at' => '2026-03-24 19:39:29',
                'updated_at' => '2026-03-24 19:39:29'
            ],
            [
                'id_user_permission' => 682,
                'id_user' => 44,
                'id_permission' => 34,
                'created_at' => '2026-03-24 19:39:29',
                'updated_at' => '2026-03-24 19:39:29'
            ],
            [
                'id_user_permission' => 683,
                'id_user' => 44,
                'id_permission' => 35,
                'created_at' => '2026-03-24 19:39:36',
                'updated_at' => '2026-03-24 19:39:36'
            ],
            [
                'id_user_permission' => 684,
                'id_user' => 44,
                'id_permission' => 36,
                'created_at' => '2026-03-24 19:39:36',
                'updated_at' => '2026-03-24 19:39:36'
            ],
            [
                'id_user_permission' => 685,
                'id_user' => 44,
                'id_permission' => 37,
                'created_at' => '2026-03-24 19:39:36',
                'updated_at' => '2026-03-24 19:39:36'
            ],
            [
                'id_user_permission' => 686,
                'id_user' => 44,
                'id_permission' => 38,
                'created_at' => '2026-03-24 19:39:36',
                'updated_at' => '2026-03-24 19:39:36'
            ],
            [
                'id_user_permission' => 687,
                'id_user' => 54,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:39:46',
                'updated_at' => '2026-03-24 19:39:46'
            ],
            [
                'id_user_permission' => 688,
                'id_user' => 44,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:39:49',
                'updated_at' => '2026-03-24 19:39:49'
            ],
            [
                'id_user_permission' => 689,
                'id_user' => 44,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:39:49',
                'updated_at' => '2026-03-24 19:39:49'
            ],
            [
                'id_user_permission' => 690,
                'id_user' => 44,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:39:49',
                'updated_at' => '2026-03-24 19:39:49'
            ],
            [
                'id_user_permission' => 691,
                'id_user' => 44,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:39:49',
                'updated_at' => '2026-03-24 19:39:49'
            ],
            [
                'id_user_permission' => 692,
                'id_user' => 44,
                'id_permission' => 231,
                'created_at' => '2026-03-24 19:39:49',
                'updated_at' => '2026-03-24 19:39:49'
            ],
            [
                'id_user_permission' => 693,
                'id_user' => 44,
                'id_permission' => 232,
                'created_at' => '2026-03-24 19:39:49',
                'updated_at' => '2026-03-24 19:39:49'
            ],
            [
                'id_user_permission' => 694,
                'id_user' => 54,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:39:55',
                'updated_at' => '2026-03-24 19:39:55'
            ],
            [
                'id_user_permission' => 695,
                'id_user' => 44,
                'id_permission' => 43,
                'created_at' => '2026-03-24 19:39:59',
                'updated_at' => '2026-03-24 19:39:59'
            ],
            [
                'id_user_permission' => 696,
                'id_user' => 44,
                'id_permission' => 44,
                'created_at' => '2026-03-24 19:39:59',
                'updated_at' => '2026-03-24 19:39:59'
            ],
            [
                'id_user_permission' => 697,
                'id_user' => 44,
                'id_permission' => 45,
                'created_at' => '2026-03-24 19:39:59',
                'updated_at' => '2026-03-24 19:39:59'
            ],
            [
                'id_user_permission' => 698,
                'id_user' => 44,
                'id_permission' => 46,
                'created_at' => '2026-03-24 19:39:59',
                'updated_at' => '2026-03-24 19:39:59'
            ],
            [
                'id_user_permission' => 699,
                'id_user' => 54,
                'id_permission' => 129,
                'created_at' => '2026-03-24 19:40:06',
                'updated_at' => '2026-03-24 19:40:06'
            ],
            [
                'id_user_permission' => 700,
                'id_user' => 54,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:40:06',
                'updated_at' => '2026-03-24 19:40:06'
            ],
            [
                'id_user_permission' => 701,
                'id_user' => 54,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:40:06',
                'updated_at' => '2026-03-24 19:40:06'
            ],
            [
                'id_user_permission' => 702,
                'id_user' => 54,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:40:06',
                'updated_at' => '2026-03-24 19:40:06'
            ],
            [
                'id_user_permission' => 703,
                'id_user' => 54,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:40:06',
                'updated_at' => '2026-03-24 19:40:06'
            ],
            [
                'id_user_permission' => 704,
                'id_user' => 54,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:40:06',
                'updated_at' => '2026-03-24 19:40:06'
            ],
            [
                'id_user_permission' => 705,
                'id_user' => 54,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:40:06',
                'updated_at' => '2026-03-24 19:40:06'
            ],
            [
                'id_user_permission' => 706,
                'id_user' => 44,
                'id_permission' => 47,
                'created_at' => '2026-03-24 19:40:17',
                'updated_at' => '2026-03-24 19:40:17'
            ],
            [
                'id_user_permission' => 707,
                'id_user' => 44,
                'id_permission' => 48,
                'created_at' => '2026-03-24 19:40:17',
                'updated_at' => '2026-03-24 19:40:17'
            ],
            [
                'id_user_permission' => 708,
                'id_user' => 44,
                'id_permission' => 49,
                'created_at' => '2026-03-24 19:40:17',
                'updated_at' => '2026-03-24 19:40:17'
            ],
            [
                'id_user_permission' => 709,
                'id_user' => 44,
                'id_permission' => 50,
                'created_at' => '2026-03-24 19:40:17',
                'updated_at' => '2026-03-24 19:40:17'
            ],
            [
                'id_user_permission' => 710,
                'id_user' => 54,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:40:18',
                'updated_at' => '2026-03-24 19:40:18'
            ],
            [
                'id_user_permission' => 711,
                'id_user' => 54,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:40:18',
                'updated_at' => '2026-03-24 19:40:18'
            ],
            [
                'id_user_permission' => 712,
                'id_user' => 54,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:40:18',
                'updated_at' => '2026-03-24 19:40:18'
            ],
            [
                'id_user_permission' => 713,
                'id_user' => 44,
                'id_permission' => 51,
                'created_at' => '2026-03-24 19:40:23',
                'updated_at' => '2026-03-24 19:40:23'
            ],
            [
                'id_user_permission' => 714,
                'id_user' => 44,
                'id_permission' => 52,
                'created_at' => '2026-03-24 19:40:23',
                'updated_at' => '2026-03-24 19:40:23'
            ],
            [
                'id_user_permission' => 715,
                'id_user' => 44,
                'id_permission' => 53,
                'created_at' => '2026-03-24 19:40:23',
                'updated_at' => '2026-03-24 19:40:23'
            ],
            [
                'id_user_permission' => 716,
                'id_user' => 44,
                'id_permission' => 54,
                'created_at' => '2026-03-24 19:40:23',
                'updated_at' => '2026-03-24 19:40:23'
            ],
            [
                'id_user_permission' => 721,
                'id_user' => 54,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:40:30',
                'updated_at' => '2026-03-24 19:40:30'
            ],
            [
                'id_user_permission' => 722,
                'id_user' => 54,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:40:40',
                'updated_at' => '2026-03-24 19:40:40'
            ],
            [
                'id_user_permission' => 723,
                'id_user' => 54,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:40:40',
                'updated_at' => '2026-03-24 19:40:40'
            ],
            [
                'id_user_permission' => 724,
                'id_user' => 54,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:40:40',
                'updated_at' => '2026-03-24 19:40:40'
            ],
            [
                'id_user_permission' => 725,
                'id_user' => 54,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:40:40',
                'updated_at' => '2026-03-24 19:40:40'
            ],
            [
                'id_user_permission' => 726,
                'id_user' => 54,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:40:40',
                'updated_at' => '2026-03-24 19:40:40'
            ],
            [
                'id_user_permission' => 727,
                'id_user' => 54,
                'id_permission' => 147,
                'created_at' => '2026-03-24 19:40:40',
                'updated_at' => '2026-03-24 19:40:40'
            ],
            [
                'id_user_permission' => 728,
                'id_user' => 54,
                'id_permission' => 148,
                'created_at' => '2026-03-24 19:40:40',
                'updated_at' => '2026-03-24 19:40:40'
            ],
            [
                'id_user_permission' => 729,
                'id_user' => 54,
                'id_permission' => 149,
                'created_at' => '2026-03-24 19:40:40',
                'updated_at' => '2026-03-24 19:40:40'
            ],
            [
                'id_user_permission' => 730,
                'id_user' => 54,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:40:50',
                'updated_at' => '2026-03-24 19:40:50'
            ],
            [
                'id_user_permission' => 731,
                'id_user' => 54,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:40:50',
                'updated_at' => '2026-03-24 19:40:50'
            ],
            [
                'id_user_permission' => 732,
                'id_user' => 54,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:41:06',
                'updated_at' => '2026-03-24 19:41:06'
            ],
            [
                'id_user_permission' => 733,
                'id_user' => 44,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:41:08',
                'updated_at' => '2026-03-24 19:41:08'
            ],
            [
                'id_user_permission' => 734,
                'id_user' => 54,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:41:10',
                'updated_at' => '2026-03-24 19:41:10'
            ],
            [
                'id_user_permission' => 735,
                'id_user' => 44,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:41:11',
                'updated_at' => '2026-03-24 19:41:11'
            ],
            [
                'id_user_permission' => 736,
                'id_user' => 54,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:41:20',
                'updated_at' => '2026-03-24 19:41:20'
            ],
            [
                'id_user_permission' => 737,
                'id_user' => 44,
                'id_permission' => 73,
                'created_at' => '2026-03-24 19:41:24',
                'updated_at' => '2026-03-24 19:41:24'
            ],
            [
                'id_user_permission' => 738,
                'id_user' => 44,
                'id_permission' => 76,
                'created_at' => '2026-03-24 19:41:29',
                'updated_at' => '2026-03-24 19:41:29'
            ],
            [
                'id_user_permission' => 739,
                'id_user' => 44,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:41:36',
                'updated_at' => '2026-03-24 19:41:36'
            ],
            [
                'id_user_permission' => 740,
                'id_user' => 44,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:41:44',
                'updated_at' => '2026-03-24 19:41:44'
            ],
            [
                'id_user_permission' => 741,
                'id_user' => 44,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:41:48',
                'updated_at' => '2026-03-24 19:41:48'
            ],
            [
                'id_user_permission' => 742,
                'id_user' => 44,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:41:48',
                'updated_at' => '2026-03-24 19:41:48'
            ],
            [
                'id_user_permission' => 743,
                'id_user' => 44,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:41:48',
                'updated_at' => '2026-03-24 19:41:48'
            ],
            [
                'id_user_permission' => 744,
                'id_user' => 44,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:41:57',
                'updated_at' => '2026-03-24 19:41:57'
            ],
            [
                'id_user_permission' => 745,
                'id_user' => 44,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 746,
                'id_user' => 44,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 747,
                'id_user' => 44,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 748,
                'id_user' => 44,
                'id_permission' => 88,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 749,
                'id_user' => 44,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 750,
                'id_user' => 44,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 751,
                'id_user' => 44,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 752,
                'id_user' => 44,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 753,
                'id_user' => 44,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 754,
                'id_user' => 44,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 755,
                'id_user' => 44,
                'id_permission' => 95,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 756,
                'id_user' => 44,
                'id_permission' => 96,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 757,
                'id_user' => 44,
                'id_permission' => 97,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 758,
                'id_user' => 44,
                'id_permission' => 98,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 759,
                'id_user' => 44,
                'id_permission' => 99,
                'created_at' => '2026-03-24 19:42:17',
                'updated_at' => '2026-03-24 19:42:17'
            ],
            [
                'id_user_permission' => 760,
                'id_user' => 44,
                'id_permission' => 100,
                'created_at' => '2026-03-24 19:42:26',
                'updated_at' => '2026-03-24 19:42:26'
            ],
            [
                'id_user_permission' => 761,
                'id_user' => 46,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:42:29',
                'updated_at' => '2026-03-24 19:42:29'
            ],
            [
                'id_user_permission' => 762,
                'id_user' => 44,
                'id_permission' => 101,
                'created_at' => '2026-03-24 19:42:30',
                'updated_at' => '2026-03-24 19:42:30'
            ],
            [
                'id_user_permission' => 763,
                'id_user' => 46,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:42:37',
                'updated_at' => '2026-03-24 19:42:37'
            ],
            [
                'id_user_permission' => 764,
                'id_user' => 46,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:42:42',
                'updated_at' => '2026-03-24 19:42:42'
            ],
            [
                'id_user_permission' => 765,
                'id_user' => 46,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:42:42',
                'updated_at' => '2026-03-24 19:42:42'
            ],
            [
                'id_user_permission' => 766,
                'id_user' => 46,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:42:42',
                'updated_at' => '2026-03-24 19:42:42'
            ],
            [
                'id_user_permission' => 767,
                'id_user' => 46,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:42:42',
                'updated_at' => '2026-03-24 19:42:42'
            ],
            [
                'id_user_permission' => 768,
                'id_user' => 46,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:42:48',
                'updated_at' => '2026-03-24 19:42:48'
            ],
            [
                'id_user_permission' => 769,
                'id_user' => 44,
                'id_permission' => 104,
                'created_at' => '2026-03-24 19:42:51',
                'updated_at' => '2026-03-24 19:42:51'
            ],
            [
                'id_user_permission' => 770,
                'id_user' => 44,
                'id_permission' => 105,
                'created_at' => '2026-03-24 19:42:54',
                'updated_at' => '2026-03-24 19:42:54'
            ],
            [
                'id_user_permission' => 771,
                'id_user' => 46,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:43:02',
                'updated_at' => '2026-03-24 19:43:02'
            ],
            [
                'id_user_permission' => 772,
                'id_user' => 44,
                'id_permission' => 110,
                'created_at' => '2026-03-24 19:43:04',
                'updated_at' => '2026-03-24 19:43:04'
            ],
            [
                'id_user_permission' => 773,
                'id_user' => 46,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:43:05',
                'updated_at' => '2026-03-24 19:43:05'
            ],
            [
                'id_user_permission' => 774,
                'id_user' => 46,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:43:05',
                'updated_at' => '2026-03-24 19:43:05'
            ],
            [
                'id_user_permission' => 775,
                'id_user' => 46,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:43:05',
                'updated_at' => '2026-03-24 19:43:05'
            ],
            [
                'id_user_permission' => 776,
                'id_user' => 44,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:43:10',
                'updated_at' => '2026-03-24 19:43:10'
            ],
            [
                'id_user_permission' => 777,
                'id_user' => 44,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:43:12',
                'updated_at' => '2026-03-24 19:43:12'
            ],
            [
                'id_user_permission' => 778,
                'id_user' => 46,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:43:15',
                'updated_at' => '2026-03-24 19:43:15'
            ],
            [
                'id_user_permission' => 779,
                'id_user' => 44,
                'id_permission' => 113,
                'created_at' => '2026-03-24 19:43:19',
                'updated_at' => '2026-03-24 19:43:19'
            ],
            [
                'id_user_permission' => 780,
                'id_user' => 44,
                'id_permission' => 114,
                'created_at' => '2026-03-24 19:43:19',
                'updated_at' => '2026-03-24 19:43:19'
            ],
            [
                'id_user_permission' => 781,
                'id_user' => 46,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:43:24',
                'updated_at' => '2026-03-24 19:43:24'
            ],
            [
                'id_user_permission' => 782,
                'id_user' => 44,
                'id_permission' => 121,
                'created_at' => '2026-03-24 19:43:26',
                'updated_at' => '2026-03-24 19:43:26'
            ],
            [
                'id_user_permission' => 783,
                'id_user' => 44,
                'id_permission' => 122,
                'created_at' => '2026-03-24 19:43:28',
                'updated_at' => '2026-03-24 19:43:28'
            ],
            [
                'id_user_permission' => 784,
                'id_user' => 46,
                'id_permission' => 75,
                'created_at' => '2026-03-24 19:43:33',
                'updated_at' => '2026-03-24 19:43:33'
            ],
            [
                'id_user_permission' => 785,
                'id_user' => 44,
                'id_permission' => 125,
                'created_at' => '2026-03-24 19:43:42',
                'updated_at' => '2026-03-24 19:43:42'
            ],
            [
                'id_user_permission' => 786,
                'id_user' => 46,
                'id_permission' => 78,
                'created_at' => '2026-03-24 19:43:44',
                'updated_at' => '2026-03-24 19:43:44'
            ],
            [
                'id_user_permission' => 787,
                'id_user' => 44,
                'id_permission' => 126,
                'created_at' => '2026-03-24 19:43:46',
                'updated_at' => '2026-03-24 19:43:46'
            ],
            [
                'id_user_permission' => 788,
                'id_user' => 46,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:43:46',
                'updated_at' => '2026-03-24 19:43:46'
            ],
            [
                'id_user_permission' => 789,
                'id_user' => 46,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:43:46',
                'updated_at' => '2026-03-24 19:43:46'
            ],
            [
                'id_user_permission' => 790,
                'id_user' => 46,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:43:46',
                'updated_at' => '2026-03-24 19:43:46'
            ],
            [
                'id_user_permission' => 791,
                'id_user' => 46,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:43:46',
                'updated_at' => '2026-03-24 19:43:46'
            ],
            [
                'id_user_permission' => 792,
                'id_user' => 46,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:43:46',
                'updated_at' => '2026-03-24 19:43:46'
            ],
            [
                'id_user_permission' => 793,
                'id_user' => 46,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:43:49',
                'updated_at' => '2026-03-24 19:43:49'
            ],
            [
                'id_user_permission' => 794,
                'id_user' => 44,
                'id_permission' => 127,
                'created_at' => '2026-03-24 19:43:53',
                'updated_at' => '2026-03-24 19:43:53'
            ],
            [
                'id_user_permission' => 795,
                'id_user' => 44,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:43:56',
                'updated_at' => '2026-03-24 19:43:56'
            ],
            [
                'id_user_permission' => 796,
                'id_user' => 44,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:43:56',
                'updated_at' => '2026-03-24 19:43:56'
            ],
            [
                'id_user_permission' => 797,
                'id_user' => 46,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:43:56',
                'updated_at' => '2026-03-24 19:43:56'
            ],
            [
                'id_user_permission' => 798,
                'id_user' => 46,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:43:59',
                'updated_at' => '2026-03-24 19:43:59'
            ],
            [
                'id_user_permission' => 800,
                'id_user' => 44,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:44:00',
                'updated_at' => '2026-03-24 19:44:00'
            ],
            [
                'id_user_permission' => 801,
                'id_user' => 44,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:44:02',
                'updated_at' => '2026-03-24 19:44:02'
            ],
            [
                'id_user_permission' => 802,
                'id_user' => 44,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:44:02',
                'updated_at' => '2026-03-24 19:44:02'
            ],
            [
                'id_user_permission' => 803,
                'id_user' => 44,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:44:02',
                'updated_at' => '2026-03-24 19:44:02'
            ],
            [
                'id_user_permission' => 804,
                'id_user' => 44,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:44:06',
                'updated_at' => '2026-03-24 19:44:06'
            ],
            [
                'id_user_permission' => 805,
                'id_user' => 44,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:44:08',
                'updated_at' => '2026-03-24 19:44:08'
            ],
            [
                'id_user_permission' => 806,
                'id_user' => 44,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:44:08',
                'updated_at' => '2026-03-24 19:44:08'
            ],
            [
                'id_user_permission' => 807,
                'id_user' => 44,
                'id_permission' => 139,
                'created_at' => '2026-03-24 19:44:08',
                'updated_at' => '2026-03-24 19:44:08'
            ],
            [
                'id_user_permission' => 808,
                'id_user' => 44,
                'id_permission' => 140,
                'created_at' => '2026-03-24 19:44:12',
                'updated_at' => '2026-03-24 19:44:12'
            ],
            [
                'id_user_permission' => 809,
                'id_user' => 44,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:44:12',
                'updated_at' => '2026-03-24 19:44:12'
            ],
            [
                'id_user_permission' => 810,
                'id_user' => 46,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:44:13',
                'updated_at' => '2026-03-24 19:44:13'
            ],
            [
                'id_user_permission' => 811,
                'id_user' => 44,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:44:15',
                'updated_at' => '2026-03-24 19:44:15'
            ],
            [
                'id_user_permission' => 812,
                'id_user' => 44,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:44:19',
                'updated_at' => '2026-03-24 19:44:19'
            ],
            [
                'id_user_permission' => 813,
                'id_user' => 44,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:44:19',
                'updated_at' => '2026-03-24 19:44:19'
            ],
            [
                'id_user_permission' => 814,
                'id_user' => 46,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:44:22',
                'updated_at' => '2026-03-24 19:44:22'
            ],
            [
                'id_user_permission' => 815,
                'id_user' => 44,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:44:25',
                'updated_at' => '2026-03-24 19:44:25'
            ],
            [
                'id_user_permission' => 816,
                'id_user' => 46,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:44:25',
                'updated_at' => '2026-03-24 19:44:25'
            ],
            [
                'id_user_permission' => 817,
                'id_user' => 46,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:44:25',
                'updated_at' => '2026-03-24 19:44:25'
            ],
            [
                'id_user_permission' => 818,
                'id_user' => 46,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:44:25',
                'updated_at' => '2026-03-24 19:44:25'
            ],
            [
                'id_user_permission' => 819,
                'id_user' => 46,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:44:31',
                'updated_at' => '2026-03-24 19:44:31'
            ],
            [
                'id_user_permission' => 820,
                'id_user' => 44,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:44:34',
                'updated_at' => '2026-03-24 19:44:34'
            ],
            [
                'id_user_permission' => 821,
                'id_user' => 46,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:44:34',
                'updated_at' => '2026-03-24 19:44:34'
            ],
            [
                'id_user_permission' => 822,
                'id_user' => 44,
                'id_permission' => 147,
                'created_at' => '2026-03-24 19:44:35',
                'updated_at' => '2026-03-24 19:44:35'
            ],
            [
                'id_user_permission' => 823,
                'id_user' => 44,
                'id_permission' => 148,
                'created_at' => '2026-03-24 19:44:35',
                'updated_at' => '2026-03-24 19:44:35'
            ],
            [
                'id_user_permission' => 824,
                'id_user' => 44,
                'id_permission' => 149,
                'created_at' => '2026-03-24 19:44:39',
                'updated_at' => '2026-03-24 19:44:39'
            ],
            [
                'id_user_permission' => 825,
                'id_user' => 44,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:44:41',
                'updated_at' => '2026-03-24 19:44:41'
            ],
            [
                'id_user_permission' => 826,
                'id_user' => 44,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:44:41',
                'updated_at' => '2026-03-24 19:44:41'
            ],
            [
                'id_user_permission' => 827,
                'id_user' => 44,
                'id_permission' => 152,
                'created_at' => '2026-03-24 19:44:41',
                'updated_at' => '2026-03-24 19:44:41'
            ],
            [
                'id_user_permission' => 828,
                'id_user' => 44,
                'id_permission' => 153,
                'created_at' => '2026-03-24 19:44:43',
                'updated_at' => '2026-03-24 19:44:43'
            ],
            [
                'id_user_permission' => 829,
                'id_user' => 46,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:44:50',
                'updated_at' => '2026-03-24 19:44:50'
            ],
            [
                'id_user_permission' => 830,
                'id_user' => 44,
                'id_permission' => 156,
                'created_at' => '2026-03-24 19:44:51',
                'updated_at' => '2026-03-24 19:44:51'
            ],
            [
                'id_user_permission' => 831,
                'id_user' => 46,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:44:52',
                'updated_at' => '2026-03-24 19:44:52'
            ],
            [
                'id_user_permission' => 832,
                'id_user' => 44,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:45:00',
                'updated_at' => '2026-03-24 19:45:00'
            ],
            [
                'id_user_permission' => 833,
                'id_user' => 44,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:45:04',
                'updated_at' => '2026-03-24 19:45:04'
            ],
            [
                'id_user_permission' => 834,
                'id_user' => 44,
                'id_permission' => 159,
                'created_at' => '2026-03-24 19:45:04',
                'updated_at' => '2026-03-24 19:45:04'
            ],
            [
                'id_user_permission' => 835,
                'id_user' => 44,
                'id_permission' => 160,
                'created_at' => '2026-03-24 19:45:04',
                'updated_at' => '2026-03-24 19:45:04'
            ],
            [
                'id_user_permission' => 836,
                'id_user' => 46,
                'id_permission' => 129,
                'created_at' => '2026-03-24 19:45:05',
                'updated_at' => '2026-03-24 19:45:05'
            ],
            [
                'id_user_permission' => 837,
                'id_user' => 46,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:45:08',
                'updated_at' => '2026-03-24 19:45:08'
            ],
            [
                'id_user_permission' => 838,
                'id_user' => 46,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:45:08',
                'updated_at' => '2026-03-24 19:45:08'
            ],
            [
                'id_user_permission' => 839,
                'id_user' => 46,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:45:08',
                'updated_at' => '2026-03-24 19:45:08'
            ],
            [
                'id_user_permission' => 840,
                'id_user' => 46,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:45:08',
                'updated_at' => '2026-03-24 19:45:08'
            ],
            [
                'id_user_permission' => 841,
                'id_user' => 46,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:45:08',
                'updated_at' => '2026-03-24 19:45:08'
            ],
            [
                'id_user_permission' => 842,
                'id_user' => 46,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:45:08',
                'updated_at' => '2026-03-24 19:45:08'
            ],
            [
                'id_user_permission' => 843,
                'id_user' => 46,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:45:16',
                'updated_at' => '2026-03-24 19:45:16'
            ],
            [
                'id_user_permission' => 844,
                'id_user' => 46,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:45:18',
                'updated_at' => '2026-03-24 19:45:18'
            ],
            [
                'id_user_permission' => 845,
                'id_user' => 46,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:45:18',
                'updated_at' => '2026-03-24 19:45:18'
            ],
            [
                'id_user_permission' => 846,
                'id_user' => 46,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:45:18',
                'updated_at' => '2026-03-24 19:45:18'
            ],
            [
                'id_user_permission' => 847,
                'id_user' => 44,
                'id_permission' => 167,
                'created_at' => '2026-03-24 19:45:21',
                'updated_at' => '2026-03-24 19:45:21'
            ],
            [
                'id_user_permission' => 848,
                'id_user' => 44,
                'id_permission' => 168,
                'created_at' => '2026-03-24 19:45:24',
                'updated_at' => '2026-03-24 19:45:24'
            ],
            [
                'id_user_permission' => 849,
                'id_user' => 44,
                'id_permission' => 171,
                'created_at' => '2026-03-24 19:45:31',
                'updated_at' => '2026-03-24 19:45:31'
            ],
            [
                'id_user_permission' => 850,
                'id_user' => 46,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:45:31',
                'updated_at' => '2026-03-24 19:45:31'
            ],
            [
                'id_user_permission' => 851,
                'id_user' => 44,
                'id_permission' => 172,
                'created_at' => '2026-03-24 19:45:33',
                'updated_at' => '2026-03-24 19:45:33'
            ],
            [
                'id_user_permission' => 852,
                'id_user' => 46,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:45:34',
                'updated_at' => '2026-03-24 19:45:34'
            ],
            [
                'id_user_permission' => 853,
                'id_user' => 46,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:45:34',
                'updated_at' => '2026-03-24 19:45:34'
            ],
            [
                'id_user_permission' => 854,
                'id_user' => 46,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:45:34',
                'updated_at' => '2026-03-24 19:45:34'
            ],
            [
                'id_user_permission' => 855,
                'id_user' => 46,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:45:34',
                'updated_at' => '2026-03-24 19:45:34'
            ],
            [
                'id_user_permission' => 856,
                'id_user' => 44,
                'id_permission' => 173,
                'created_at' => '2026-03-24 19:45:37',
                'updated_at' => '2026-03-24 19:45:37'
            ],
            [
                'id_user_permission' => 857,
                'id_user' => 46,
                'id_permission' => 147,
                'created_at' => '2026-03-24 19:45:39',
                'updated_at' => '2026-03-24 19:45:39'
            ],
            [
                'id_user_permission' => 858,
                'id_user' => 46,
                'id_permission' => 148,
                'created_at' => '2026-03-24 19:45:43',
                'updated_at' => '2026-03-24 19:45:43'
            ],
            [
                'id_user_permission' => 859,
                'id_user' => 46,
                'id_permission' => 149,
                'created_at' => '2026-03-24 19:45:43',
                'updated_at' => '2026-03-24 19:45:43'
            ],
            [
                'id_user_permission' => 860,
                'id_user' => 46,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:45:43',
                'updated_at' => '2026-03-24 19:45:43'
            ],
            [
                'id_user_permission' => 861,
                'id_user' => 46,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:45:43',
                'updated_at' => '2026-03-24 19:45:43'
            ],
            [
                'id_user_permission' => 862,
                'id_user' => 44,
                'id_permission' => 244,
                'created_at' => '2026-03-24 19:46:08',
                'updated_at' => '2026-03-24 19:46:08'
            ],
            [
                'id_user_permission' => 863,
                'id_user' => 46,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:46:31',
                'updated_at' => '2026-03-24 19:46:31'
            ],
            [
                'id_user_permission' => 864,
                'id_user' => 44,
                'id_permission' => 180,
                'created_at' => '2026-03-24 19:46:32',
                'updated_at' => '2026-03-24 19:46:32'
            ],
            [
                'id_user_permission' => 865,
                'id_user' => 44,
                'id_permission' => 181,
                'created_at' => '2026-03-24 19:46:32',
                'updated_at' => '2026-03-24 19:46:32'
            ],
            [
                'id_user_permission' => 866,
                'id_user' => 44,
                'id_permission' => 182,
                'created_at' => '2026-03-24 19:46:32',
                'updated_at' => '2026-03-24 19:46:32'
            ],
            [
                'id_user_permission' => 867,
                'id_user' => 44,
                'id_permission' => 183,
                'created_at' => '2026-03-24 19:46:32',
                'updated_at' => '2026-03-24 19:46:32'
            ],
            [
                'id_user_permission' => 868,
                'id_user' => 46,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:46:34',
                'updated_at' => '2026-03-24 19:46:34'
            ],
            [
                'id_user_permission' => 869,
                'id_user' => 44,
                'id_permission' => 184,
                'created_at' => '2026-03-24 19:46:42',
                'updated_at' => '2026-03-24 19:46:42'
            ],
            [
                'id_user_permission' => 871,
                'id_user' => 46,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:46:49',
                'updated_at' => '2026-03-24 19:46:49'
            ],
            [
                'id_user_permission' => 872,
                'id_user' => 44,
                'id_permission' => 191,
                'created_at' => '2026-03-24 19:46:57',
                'updated_at' => '2026-03-24 19:46:57'
            ],
            [
                'id_user_permission' => 873,
                'id_user' => 44,
                'id_permission' => 192,
                'created_at' => '2026-03-24 19:46:59',
                'updated_at' => '2026-03-24 19:46:59'
            ],
            [
                'id_user_permission' => 874,
                'id_user' => 44,
                'id_permission' => 193,
                'created_at' => '2026-03-24 19:47:03',
                'updated_at' => '2026-03-24 19:47:03'
            ],
            [
                'id_user_permission' => 875,
                'id_user' => 44,
                'id_permission' => 198,
                'created_at' => '2026-03-24 19:47:17',
                'updated_at' => '2026-03-24 19:47:17'
            ],
            [
                'id_user_permission' => 876,
                'id_user' => 51,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:47:23',
                'updated_at' => '2026-03-24 19:47:23'
            ],
            [
                'id_user_permission' => 877,
                'id_user' => 44,
                'id_permission' => 246,
                'created_at' => '2026-03-24 19:47:30',
                'updated_at' => '2026-03-24 19:47:30'
            ],
            [
                'id_user_permission' => 878,
                'id_user' => 51,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:47:34',
                'updated_at' => '2026-03-24 19:47:34'
            ],
            [
                'id_user_permission' => 879,
                'id_user' => 44,
                'id_permission' => 222,
                'created_at' => '2026-03-24 19:47:36',
                'updated_at' => '2026-03-24 19:47:36'
            ],
            [
                'id_user_permission' => 880,
                'id_user' => 51,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:47:37',
                'updated_at' => '2026-03-24 19:47:37'
            ],
            [
                'id_user_permission' => 881,
                'id_user' => 51,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:47:37',
                'updated_at' => '2026-03-24 19:47:37'
            ],
            [
                'id_user_permission' => 882,
                'id_user' => 51,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:47:37',
                'updated_at' => '2026-03-24 19:47:37'
            ],
            [
                'id_user_permission' => 883,
                'id_user' => 44,
                'id_permission' => 247,
                'created_at' => '2026-03-24 19:47:42',
                'updated_at' => '2026-03-24 19:47:42'
            ],
            [
                'id_user_permission' => 884,
                'id_user' => 51,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:47:49',
                'updated_at' => '2026-03-24 19:47:49'
            ],
            [
                'id_user_permission' => 885,
                'id_user' => 51,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:47:51',
                'updated_at' => '2026-03-24 19:47:51'
            ],
            [
                'id_user_permission' => 886,
                'id_user' => 44,
                'id_permission' => 254,
                'created_at' => '2026-03-24 19:47:51',
                'updated_at' => '2026-03-24 19:47:51'
            ],
            [
                'id_user_permission' => 887,
                'id_user' => 51,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:48:02',
                'updated_at' => '2026-03-24 19:48:02'
            ],
            [
                'id_user_permission' => 888,
                'id_user' => 51,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:48:04',
                'updated_at' => '2026-03-24 19:48:04'
            ],
            [
                'id_user_permission' => 889,
                'id_user' => 51,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:48:04',
                'updated_at' => '2026-03-24 19:48:04'
            ],
            [
                'id_user_permission' => 890,
                'id_user' => 51,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:48:04',
                'updated_at' => '2026-03-24 19:48:04'
            ],
            [
                'id_user_permission' => 891,
                'id_user' => 51,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:48:17',
                'updated_at' => '2026-03-24 19:48:17'
            ],
            [
                'id_user_permission' => 892,
                'id_user' => 51,
                'id_permission' => 75,
                'created_at' => '2026-03-24 19:48:26',
                'updated_at' => '2026-03-24 19:48:26'
            ],
            [
                'id_user_permission' => 893,
                'id_user' => 51,
                'id_permission' => 78,
                'created_at' => '2026-03-24 19:48:37',
                'updated_at' => '2026-03-24 19:48:37'
            ],
            [
                'id_user_permission' => 894,
                'id_user' => 51,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:48:39',
                'updated_at' => '2026-03-24 19:48:39'
            ],
            [
                'id_user_permission' => 895,
                'id_user' => 51,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:48:39',
                'updated_at' => '2026-03-24 19:48:39'
            ],
            [
                'id_user_permission' => 896,
                'id_user' => 51,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:48:39',
                'updated_at' => '2026-03-24 19:48:39'
            ],
            [
                'id_user_permission' => 897,
                'id_user' => 45,
                'id_permission' => 43,
                'created_at' => '2026-03-24 19:48:46',
                'updated_at' => '2026-03-24 19:48:46'
            ],
            [
                'id_user_permission' => 898,
                'id_user' => 45,
                'id_permission' => 44,
                'created_at' => '2026-03-24 19:48:46',
                'updated_at' => '2026-03-24 19:48:46'
            ],
            [
                'id_user_permission' => 899,
                'id_user' => 45,
                'id_permission' => 45,
                'created_at' => '2026-03-24 19:48:46',
                'updated_at' => '2026-03-24 19:48:46'
            ],
            [
                'id_user_permission' => 900,
                'id_user' => 45,
                'id_permission' => 46,
                'created_at' => '2026-03-24 19:48:46',
                'updated_at' => '2026-03-24 19:48:46'
            ],
            [
                'id_user_permission' => 901,
                'id_user' => 51,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:48:47',
                'updated_at' => '2026-03-24 19:48:47'
            ],
            [
                'id_user_permission' => 902,
                'id_user' => 51,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:48:49',
                'updated_at' => '2026-03-24 19:48:49'
            ],
            [
                'id_user_permission' => 903,
                'id_user' => 51,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:48:49',
                'updated_at' => '2026-03-24 19:48:49'
            ],
            [
                'id_user_permission' => 904,
                'id_user' => 51,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:48:49',
                'updated_at' => '2026-03-24 19:48:49'
            ],
            [
                'id_user_permission' => 905,
                'id_user' => 51,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:48:49',
                'updated_at' => '2026-03-24 19:48:49'
            ],
            [
                'id_user_permission' => 906,
                'id_user' => 51,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:48:54',
                'updated_at' => '2026-03-24 19:48:54'
            ],
            [
                'id_user_permission' => 907,
                'id_user' => 45,
                'id_permission' => 47,
                'created_at' => '2026-03-24 19:48:55',
                'updated_at' => '2026-03-24 19:48:55'
            ],
            [
                'id_user_permission' => 908,
                'id_user' => 45,
                'id_permission' => 48,
                'created_at' => '2026-03-24 19:48:55',
                'updated_at' => '2026-03-24 19:48:55'
            ],
            [
                'id_user_permission' => 909,
                'id_user' => 45,
                'id_permission' => 49,
                'created_at' => '2026-03-24 19:48:55',
                'updated_at' => '2026-03-24 19:48:55'
            ],
            [
                'id_user_permission' => 910,
                'id_user' => 45,
                'id_permission' => 50,
                'created_at' => '2026-03-24 19:48:55',
                'updated_at' => '2026-03-24 19:48:55'
            ],
            [
                'id_user_permission' => 911,
                'id_user' => 51,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:48:57',
                'updated_at' => '2026-03-24 19:48:57'
            ],
            [
                'id_user_permission' => 913,
                'id_user' => 51,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:48:57',
                'updated_at' => '2026-03-24 19:48:57'
            ],
            [
                'id_user_permission' => 914,
                'id_user' => 45,
                'id_permission' => 51,
                'created_at' => '2026-03-24 19:48:58',
                'updated_at' => '2026-03-24 19:48:58'
            ],
            [
                'id_user_permission' => 915,
                'id_user' => 45,
                'id_permission' => 52,
                'created_at' => '2026-03-24 19:48:58',
                'updated_at' => '2026-03-24 19:48:58'
            ],
            [
                'id_user_permission' => 916,
                'id_user' => 45,
                'id_permission' => 53,
                'created_at' => '2026-03-24 19:48:58',
                'updated_at' => '2026-03-24 19:48:58'
            ],
            [
                'id_user_permission' => 917,
                'id_user' => 45,
                'id_permission' => 54,
                'created_at' => '2026-03-24 19:48:58',
                'updated_at' => '2026-03-24 19:48:58'
            ],
            [
                'id_user_permission' => 918,
                'id_user' => 51,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:49:15',
                'updated_at' => '2026-03-24 19:49:15'
            ],
            [
                'id_user_permission' => 919,
                'id_user' => 51,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:49:18',
                'updated_at' => '2026-03-24 19:49:18'
            ],
            [
                'id_user_permission' => 920,
                'id_user' => 51,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:49:18',
                'updated_at' => '2026-03-24 19:49:18'
            ],
            [
                'id_user_permission' => 921,
                'id_user' => 45,
                'id_permission' => 73,
                'created_at' => '2026-03-24 19:49:27',
                'updated_at' => '2026-03-24 19:49:27'
            ],
            [
                'id_user_permission' => 922,
                'id_user' => 51,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:49:28',
                'updated_at' => '2026-03-24 19:49:28'
            ],
            [
                'id_user_permission' => 923,
                'id_user' => 51,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:49:32',
                'updated_at' => '2026-03-24 19:49:32'
            ],
            [
                'id_user_permission' => 924,
                'id_user' => 45,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:49:47',
                'updated_at' => '2026-03-24 19:49:47'
            ],
            [
                'id_user_permission' => 925,
                'id_user' => 45,
                'id_permission' => 95,
                'created_at' => '2026-03-24 19:49:49',
                'updated_at' => '2026-03-24 19:49:49'
            ],
            [
                'id_user_permission' => 926,
                'id_user' => 45,
                'id_permission' => 96,
                'created_at' => '2026-03-24 19:49:49',
                'updated_at' => '2026-03-24 19:49:49'
            ],
            [
                'id_user_permission' => 927,
                'id_user' => 45,
                'id_permission' => 97,
                'created_at' => '2026-03-24 19:49:49',
                'updated_at' => '2026-03-24 19:49:49'
            ],
            [
                'id_user_permission' => 928,
                'id_user' => 45,
                'id_permission' => 98,
                'created_at' => '2026-03-24 19:49:55',
                'updated_at' => '2026-03-24 19:49:55'
            ],
            [
                'id_user_permission' => 929,
                'id_user' => 45,
                'id_permission' => 99,
                'created_at' => '2026-03-24 19:49:57',
                'updated_at' => '2026-03-24 19:49:57'
            ],
            [
                'id_user_permission' => 930,
                'id_user' => 45,
                'id_permission' => 105,
                'created_at' => '2026-03-24 19:50:16',
                'updated_at' => '2026-03-24 19:50:16'
            ],
            [
                'id_user_permission' => 931,
                'id_user' => 51,
                'id_permission' => 129,
                'created_at' => '2026-03-24 19:50:19',
                'updated_at' => '2026-03-24 19:50:19'
            ],
            [
                'id_user_permission' => 932,
                'id_user' => 51,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:50:23',
                'updated_at' => '2026-03-24 19:50:23'
            ],
            [
                'id_user_permission' => 933,
                'id_user' => 51,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:50:23',
                'updated_at' => '2026-03-24 19:50:23'
            ],
            [
                'id_user_permission' => 934,
                'id_user' => 51,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:50:23',
                'updated_at' => '2026-03-24 19:50:23'
            ],
            [
                'id_user_permission' => 935,
                'id_user' => 51,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:50:23',
                'updated_at' => '2026-03-24 19:50:23'
            ],
            [
                'id_user_permission' => 936,
                'id_user' => 51,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:50:23',
                'updated_at' => '2026-03-24 19:50:23'
            ],
            [
                'id_user_permission' => 937,
                'id_user' => 51,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:50:23',
                'updated_at' => '2026-03-24 19:50:23'
            ],
            [
                'id_user_permission' => 938,
                'id_user' => 51,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:50:23',
                'updated_at' => '2026-03-24 19:50:23'
            ],
            [
                'id_user_permission' => 939,
                'id_user' => 51,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:50:23',
                'updated_at' => '2026-03-24 19:50:23'
            ],
            [
                'id_user_permission' => 940,
                'id_user' => 51,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:50:37',
                'updated_at' => '2026-03-24 19:50:37'
            ],
            [
                'id_user_permission' => 941,
                'id_user' => 51,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:50:43',
                'updated_at' => '2026-03-24 19:50:43'
            ],
            [
                'id_user_permission' => 942,
                'id_user' => 51,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:50:44',
                'updated_at' => '2026-03-24 19:50:44'
            ],
            [
                'id_user_permission' => 943,
                'id_user' => 51,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:50:44',
                'updated_at' => '2026-03-24 19:50:44'
            ],
            [
                'id_user_permission' => 944,
                'id_user' => 51,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:50:44',
                'updated_at' => '2026-03-24 19:50:44'
            ],
            [
                'id_user_permission' => 945,
                'id_user' => 51,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:50:44',
                'updated_at' => '2026-03-24 19:50:44'
            ],
            [
                'id_user_permission' => 946,
                'id_user' => 51,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:50:46',
                'updated_at' => '2026-03-24 19:50:46'
            ],
            [
                'id_user_permission' => 947,
                'id_user' => 45,
                'id_permission' => 119,
                'created_at' => '2026-03-24 19:50:52',
                'updated_at' => '2026-03-24 19:50:52'
            ],
            [
                'id_user_permission' => 948,
                'id_user' => 51,
                'id_permission' => 147,
                'created_at' => '2026-03-24 19:50:54',
                'updated_at' => '2026-03-24 19:50:54'
            ],
            [
                'id_user_permission' => 949,
                'id_user' => 51,
                'id_permission' => 148,
                'created_at' => '2026-03-24 19:50:55',
                'updated_at' => '2026-03-24 19:50:55'
            ],
            [
                'id_user_permission' => 950,
                'id_user' => 51,
                'id_permission' => 149,
                'created_at' => '2026-03-24 19:50:55',
                'updated_at' => '2026-03-24 19:50:55'
            ],
            [
                'id_user_permission' => 951,
                'id_user' => 45,
                'id_permission' => 120,
                'created_at' => '2026-03-24 19:50:57',
                'updated_at' => '2026-03-24 19:50:57'
            ],
            [
                'id_user_permission' => 952,
                'id_user' => 51,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:51:01',
                'updated_at' => '2026-03-24 19:51:01'
            ],
            [
                'id_user_permission' => 953,
                'id_user' => 51,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:51:03',
                'updated_at' => '2026-03-24 19:51:03'
            ],
            [
                'id_user_permission' => 954,
                'id_user' => 45,
                'id_permission' => 125,
                'created_at' => '2026-03-24 19:51:04',
                'updated_at' => '2026-03-24 19:51:04'
            ],
            [
                'id_user_permission' => 955,
                'id_user' => 45,
                'id_permission' => 126,
                'created_at' => '2026-03-24 19:51:06',
                'updated_at' => '2026-03-24 19:51:06'
            ],
            [
                'id_user_permission' => 956,
                'id_user' => 51,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:51:10',
                'updated_at' => '2026-03-24 19:51:10'
            ],
            [
                'id_user_permission' => 957,
                'id_user' => 51,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:51:13',
                'updated_at' => '2026-03-24 19:51:13'
            ],
            [
                'id_user_permission' => 958,
                'id_user' => 45,
                'id_permission' => 127,
                'created_at' => '2026-03-24 19:51:20',
                'updated_at' => '2026-03-24 19:51:20'
            ],
            [
                'id_user_permission' => 959,
                'id_user' => 51,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:51:33',
                'updated_at' => '2026-03-24 19:51:33'
            ],
            [
                'id_user_permission' => 960,
                'id_user' => 45,
                'id_permission' => 76,
                'created_at' => '2026-03-24 19:51:33',
                'updated_at' => '2026-03-24 19:51:33'
            ],
            [
                'id_user_permission' => 961,
                'id_user' => 45,
                'id_permission' => 139,
                'created_at' => '2026-03-24 19:51:49',
                'updated_at' => '2026-03-24 19:51:49'
            ],
            [
                'id_user_permission' => 962,
                'id_user' => 45,
                'id_permission' => 140,
                'created_at' => '2026-03-24 19:51:52',
                'updated_at' => '2026-03-24 19:51:52'
            ],
            [
                'id_user_permission' => 963,
                'id_user' => 45,
                'id_permission' => 165,
                'created_at' => '2026-03-24 19:52:18',
                'updated_at' => '2026-03-24 19:52:18'
            ],
            [
                'id_user_permission' => 964,
                'id_user' => 45,
                'id_permission' => 166,
                'created_at' => '2026-03-24 19:52:21',
                'updated_at' => '2026-03-24 19:52:21'
            ],
            [
                'id_user_permission' => 965,
                'id_user' => 48,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:52:23',
                'updated_at' => '2026-03-24 19:52:23'
            ],
            [
                'id_user_permission' => 966,
                'id_user' => 45,
                'id_permission' => 171,
                'created_at' => '2026-03-24 19:52:26',
                'updated_at' => '2026-03-24 19:52:26'
            ],
            [
                'id_user_permission' => 967,
                'id_user' => 45,
                'id_permission' => 172,
                'created_at' => '2026-03-24 19:52:29',
                'updated_at' => '2026-03-24 19:52:29'
            ],
            [
                'id_user_permission' => 968,
                'id_user' => 48,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:52:34',
                'updated_at' => '2026-03-24 19:52:34'
            ],
            [
                'id_user_permission' => 969,
                'id_user' => 48,
                'id_permission' => 14,
                'created_at' => '2026-03-24 19:52:35',
                'updated_at' => '2026-03-24 19:52:35'
            ],
            [
                'id_user_permission' => 970,
                'id_user' => 48,
                'id_permission' => 15,
                'created_at' => '2026-03-24 19:52:35',
                'updated_at' => '2026-03-24 19:52:35'
            ],
            [
                'id_user_permission' => 971,
                'id_user' => 48,
                'id_permission' => 16,
                'created_at' => '2026-03-24 19:52:35',
                'updated_at' => '2026-03-24 19:52:35'
            ],
            [
                'id_user_permission' => 972,
                'id_user' => 45,
                'id_permission' => 173,
                'created_at' => '2026-03-24 19:52:55',
                'updated_at' => '2026-03-24 19:52:55'
            ],
            [
                'id_user_permission' => 973,
                'id_user' => 48,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:52:58',
                'updated_at' => '2026-03-24 19:52:58'
            ],
            [
                'id_user_permission' => 974,
                'id_user' => 48,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:53:17',
                'updated_at' => '2026-03-24 19:53:17'
            ],
            [
                'id_user_permission' => 975,
                'id_user' => 48,
                'id_permission' => 40,
                'created_at' => '2026-03-24 19:53:18',
                'updated_at' => '2026-03-24 19:53:18'
            ],
            [
                'id_user_permission' => 976,
                'id_user' => 48,
                'id_permission' => 41,
                'created_at' => '2026-03-24 19:53:18',
                'updated_at' => '2026-03-24 19:53:18'
            ],
            [
                'id_user_permission' => 977,
                'id_user' => 48,
                'id_permission' => 42,
                'created_at' => '2026-03-24 19:53:18',
                'updated_at' => '2026-03-24 19:53:18'
            ],
            [
                'id_user_permission' => 978,
                'id_user' => 45,
                'id_permission' => 243,
                'created_at' => '2026-03-24 19:53:19',
                'updated_at' => '2026-03-24 19:53:19'
            ],
            [
                'id_user_permission' => 979,
                'id_user' => 45,
                'id_permission' => 244,
                'created_at' => '2026-03-24 19:53:21',
                'updated_at' => '2026-03-24 19:53:21'
            ],
            [
                'id_user_permission' => 980,
                'id_user' => 45,
                'id_permission' => 180,
                'created_at' => '2026-03-24 19:53:28',
                'updated_at' => '2026-03-24 19:53:28'
            ],
            [
                'id_user_permission' => 981,
                'id_user' => 48,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:53:32',
                'updated_at' => '2026-03-24 19:53:32'
            ],
            [
                'id_user_permission' => 982,
                'id_user' => 45,
                'id_permission' => 184,
                'created_at' => '2026-03-24 19:53:32',
                'updated_at' => '2026-03-24 19:53:32'
            ],
            [
                'id_user_permission' => 983,
                'id_user' => 48,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:53:37',
                'updated_at' => '2026-03-24 19:53:37'
            ],
            [
                'id_user_permission' => 984,
                'id_user' => 45,
                'id_permission' => 193,
                'created_at' => '2026-03-24 19:53:43',
                'updated_at' => '2026-03-24 19:53:43'
            ],
            [
                'id_user_permission' => 986,
                'id_user' => 45,
                'id_permission' => 197,
                'created_at' => '2026-03-24 19:53:49',
                'updated_at' => '2026-03-24 19:53:49'
            ],
            [
                'id_user_permission' => 987,
                'id_user' => 45,
                'id_permission' => 198,
                'created_at' => '2026-03-24 19:53:51',
                'updated_at' => '2026-03-24 19:53:51'
            ],
            [
                'id_user_permission' => 989,
                'id_user' => 48,
                'id_permission' => 79,
                'created_at' => '2026-03-24 19:53:59',
                'updated_at' => '2026-03-24 19:53:59'
            ],
            [
                'id_user_permission' => 990,
                'id_user' => 48,
                'id_permission' => 80,
                'created_at' => '2026-03-24 19:54:01',
                'updated_at' => '2026-03-24 19:54:01'
            ],
            [
                'id_user_permission' => 991,
                'id_user' => 48,
                'id_permission' => 81,
                'created_at' => '2026-03-24 19:54:03',
                'updated_at' => '2026-03-24 19:54:03'
            ],
            [
                'id_user_permission' => 992,
                'id_user' => 48,
                'id_permission' => 82,
                'created_at' => '2026-03-24 19:54:03',
                'updated_at' => '2026-03-24 19:54:03'
            ],
            [
                'id_user_permission' => 993,
                'id_user' => 48,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:54:07',
                'updated_at' => '2026-03-24 19:54:07'
            ],
            [
                'id_user_permission' => 994,
                'id_user' => 48,
                'id_permission' => 84,
                'created_at' => '2026-03-24 19:54:09',
                'updated_at' => '2026-03-24 19:54:09'
            ],
            [
                'id_user_permission' => 995,
                'id_user' => 45,
                'id_permission' => 246,
                'created_at' => '2026-03-24 19:54:09',
                'updated_at' => '2026-03-24 19:54:09'
            ],
            [
                'id_user_permission' => 996,
                'id_user' => 45,
                'id_permission' => 247,
                'created_at' => '2026-03-24 19:54:21',
                'updated_at' => '2026-03-24 19:54:21'
            ],
            [
                'id_user_permission' => 997,
                'id_user' => 48,
                'id_permission' => 85,
                'created_at' => '2026-03-24 19:54:29',
                'updated_at' => '2026-03-24 19:54:29'
            ],
            [
                'id_user_permission' => 998,
                'id_user' => 48,
                'id_permission' => 86,
                'created_at' => '2026-03-24 19:54:30',
                'updated_at' => '2026-03-24 19:54:30'
            ],
            [
                'id_user_permission' => 999,
                'id_user' => 48,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:54:34',
                'updated_at' => '2026-03-24 19:54:34'
            ],
            [
                'id_user_permission' => 1000,
                'id_user' => 48,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:54:36',
                'updated_at' => '2026-03-24 19:54:36'
            ],
            [
                'id_user_permission' => 1001,
                'id_user' => 48,
                'id_permission' => 90,
                'created_at' => '2026-03-24 19:54:38',
                'updated_at' => '2026-03-24 19:54:38'
            ],
            [
                'id_user_permission' => 1002,
                'id_user' => 48,
                'id_permission' => 91,
                'created_at' => '2026-03-24 19:54:40',
                'updated_at' => '2026-03-24 19:54:40'
            ],
            [
                'id_user_permission' => 1003,
                'id_user' => 48,
                'id_permission' => 92,
                'created_at' => '2026-03-24 19:54:40',
                'updated_at' => '2026-03-24 19:54:40'
            ],
            [
                'id_user_permission' => 1004,
                'id_user' => 31,
                'id_permission' => 1,
                'created_at' => '2026-03-24 19:55:10',
                'updated_at' => '2026-03-24 19:55:10'
            ],
            [
                'id_user_permission' => 1005,
                'id_user' => 48,
                'id_permission' => 93,
                'created_at' => '2026-03-24 19:55:11',
                'updated_at' => '2026-03-24 19:55:11'
            ],
            [
                'id_user_permission' => 1006,
                'id_user' => 31,
                'id_permission' => 5,
                'created_at' => '2026-03-24 19:55:12',
                'updated_at' => '2026-03-24 19:55:12'
            ],
            [
                'id_user_permission' => 1007,
                'id_user' => 48,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:55:13',
                'updated_at' => '2026-03-24 19:55:13'
            ],
            [
                'id_user_permission' => 1008,
                'id_user' => 31,
                'id_permission' => 9,
                'created_at' => '2026-03-24 19:55:15',
                'updated_at' => '2026-03-24 19:55:15'
            ],
            [
                'id_user_permission' => 1009,
                'id_user' => 48,
                'id_permission' => 111,
                'created_at' => '2026-03-24 19:55:19',
                'updated_at' => '2026-03-24 19:55:19'
            ],
            [
                'id_user_permission' => 1010,
                'id_user' => 48,
                'id_permission' => 112,
                'created_at' => '2026-03-24 19:55:20',
                'updated_at' => '2026-03-24 19:55:20'
            ],
            [
                'id_user_permission' => 1011,
                'id_user' => 31,
                'id_permission' => 13,
                'created_at' => '2026-03-24 19:55:22',
                'updated_at' => '2026-03-24 19:55:22'
            ],
            [
                'id_user_permission' => 1013,
                'id_user' => 31,
                'id_permission' => 19,
                'created_at' => '2026-03-24 19:55:36',
                'updated_at' => '2026-03-24 19:55:36'
            ],
            [
                'id_user_permission' => 1014,
                'id_user' => 48,
                'id_permission' => 130,
                'created_at' => '2026-03-24 19:55:37',
                'updated_at' => '2026-03-24 19:55:37'
            ],
            [
                'id_user_permission' => 1015,
                'id_user' => 48,
                'id_permission' => 131,
                'created_at' => '2026-03-24 19:55:37',
                'updated_at' => '2026-03-24 19:55:37'
            ],
            [
                'id_user_permission' => 1016,
                'id_user' => 48,
                'id_permission' => 132,
                'created_at' => '2026-03-24 19:55:37',
                'updated_at' => '2026-03-24 19:55:37'
            ],
            [
                'id_user_permission' => 1017,
                'id_user' => 31,
                'id_permission' => 23,
                'created_at' => '2026-03-24 19:55:39',
                'updated_at' => '2026-03-24 19:55:39'
            ],
            [
                'id_user_permission' => 1018,
                'id_user' => 48,
                'id_permission' => 133,
                'created_at' => '2026-03-24 19:55:40',
                'updated_at' => '2026-03-24 19:55:40'
            ],
            [
                'id_user_permission' => 1019,
                'id_user' => 48,
                'id_permission' => 134,
                'created_at' => '2026-03-24 19:55:41',
                'updated_at' => '2026-03-24 19:55:41'
            ],
            [
                'id_user_permission' => 1020,
                'id_user' => 48,
                'id_permission' => 135,
                'created_at' => '2026-03-24 19:55:41',
                'updated_at' => '2026-03-24 19:55:41'
            ],
            [
                'id_user_permission' => 1021,
                'id_user' => 48,
                'id_permission' => 136,
                'created_at' => '2026-03-24 19:55:41',
                'updated_at' => '2026-03-24 19:55:41'
            ],
            [
                'id_user_permission' => 1022,
                'id_user' => 31,
                'id_permission' => 39,
                'created_at' => '2026-03-24 19:55:49',
                'updated_at' => '2026-03-24 19:55:49'
            ],
            [
                'id_user_permission' => 1023,
                'id_user' => 48,
                'id_permission' => 137,
                'created_at' => '2026-03-24 19:55:55',
                'updated_at' => '2026-03-24 19:55:55'
            ],
            [
                'id_user_permission' => 1024,
                'id_user' => 48,
                'id_permission' => 138,
                'created_at' => '2026-03-24 19:55:57',
                'updated_at' => '2026-03-24 19:55:57'
            ],
            [
                'id_user_permission' => 1025,
                'id_user' => 48,
                'id_permission' => 141,
                'created_at' => '2026-03-24 19:55:57',
                'updated_at' => '2026-03-24 19:55:57'
            ],
            [
                'id_user_permission' => 1026,
                'id_user' => 48,
                'id_permission' => 142,
                'created_at' => '2026-03-24 19:56:04',
                'updated_at' => '2026-03-24 19:56:04'
            ],
            [
                'id_user_permission' => 1027,
                'id_user' => 48,
                'id_permission' => 143,
                'created_at' => '2026-03-24 19:56:05',
                'updated_at' => '2026-03-24 19:56:05'
            ],
            [
                'id_user_permission' => 1028,
                'id_user' => 31,
                'id_permission' => 59,
                'created_at' => '2026-03-24 19:56:07',
                'updated_at' => '2026-03-24 19:56:07'
            ],
            [
                'id_user_permission' => 1029,
                'id_user' => 48,
                'id_permission' => 144,
                'created_at' => '2026-03-24 19:56:08',
                'updated_at' => '2026-03-24 19:56:08'
            ],
            [
                'id_user_permission' => 1030,
                'id_user' => 31,
                'id_permission' => 63,
                'created_at' => '2026-03-24 19:56:16',
                'updated_at' => '2026-03-24 19:56:16'
            ],
            [
                'id_user_permission' => 1031,
                'id_user' => 31,
                'id_permission' => 74,
                'created_at' => '2026-03-24 19:56:25',
                'updated_at' => '2026-03-24 19:56:25'
            ],
            [
                'id_user_permission' => 1032,
                'id_user' => 48,
                'id_permission' => 145,
                'created_at' => '2026-03-24 19:56:31',
                'updated_at' => '2026-03-24 19:56:31'
            ],
            [
                'id_user_permission' => 1033,
                'id_user' => 31,
                'id_permission' => 77,
                'created_at' => '2026-03-24 19:56:32',
                'updated_at' => '2026-03-24 19:56:32'
            ],
            [
                'id_user_permission' => 1034,
                'id_user' => 48,
                'id_permission' => 146,
                'created_at' => '2026-03-24 19:56:33',
                'updated_at' => '2026-03-24 19:56:33'
            ],
            [
                'id_user_permission' => 1035,
                'id_user' => 48,
                'id_permission' => 147,
                'created_at' => '2026-03-24 19:56:33',
                'updated_at' => '2026-03-24 19:56:33'
            ],
            [
                'id_user_permission' => 1036,
                'id_user' => 48,
                'id_permission' => 148,
                'created_at' => '2026-03-24 19:56:35',
                'updated_at' => '2026-03-24 19:56:35'
            ],
            [
                'id_user_permission' => 1037,
                'id_user' => 31,
                'id_permission' => 78,
                'created_at' => '2026-03-24 19:56:36',
                'updated_at' => '2026-03-24 19:56:36'
            ],
            [
                'id_user_permission' => 1038,
                'id_user' => 48,
                'id_permission' => 149,
                'created_at' => '2026-03-24 19:56:36',
                'updated_at' => '2026-03-24 19:56:36'
            ],
            [
                'id_user_permission' => 1039,
                'id_user' => 48,
                'id_permission' => 150,
                'created_at' => '2026-03-24 19:56:36',
                'updated_at' => '2026-03-24 19:56:36'
            ],
            [
                'id_user_permission' => 1040,
                'id_user' => 48,
                'id_permission' => 151,
                'created_at' => '2026-03-24 19:56:40',
                'updated_at' => '2026-03-24 19:56:40'
            ],
            [
                'id_user_permission' => 1041,
                'id_user' => 31,
                'id_permission' => 83,
                'created_at' => '2026-03-24 19:56:47',
                'updated_at' => '2026-03-24 19:56:47'
            ],
            [
                'id_user_permission' => 1042,
                'id_user' => 48,
                'id_permission' => 157,
                'created_at' => '2026-03-24 19:56:54',
                'updated_at' => '2026-03-24 19:56:54'
            ],
            [
                'id_user_permission' => 1043,
                'id_user' => 48,
                'id_permission' => 158,
                'created_at' => '2026-03-24 19:56:55',
                'updated_at' => '2026-03-24 19:56:55'
            ],
            [
                'id_user_permission' => 1044,
                'id_user' => 31,
                'id_permission' => 87,
                'created_at' => '2026-03-24 19:56:59',
                'updated_at' => '2026-03-24 19:56:59'
            ],
            [
                'id_user_permission' => 1045,
                'id_user' => 31,
                'id_permission' => 88,
                'created_at' => '2026-03-24 19:57:01',
                'updated_at' => '2026-03-24 19:57:01'
            ],
            [
                'id_user_permission' => 1046,
                'id_user' => 31,
                'id_permission' => 89,
                'created_at' => '2026-03-24 19:57:04',
                'updated_at' => '2026-03-24 19:57:04'
            ],
            [
                'id_user_permission' => 1047,
                'id_user' => 31,
                'id_permission' => 94,
                'created_at' => '2026-03-24 19:57:13',
                'updated_at' => '2026-03-24 19:57:13'
            ],
            [
                'id_user_permission' => 1048,
                'id_user' => 31,
                'id_permission' => 98,
                'created_at' => '2026-03-24 19:57:25',
                'updated_at' => '2026-03-24 19:57:25'
            ],
            [
                'id_user_permission' => 1049,
                'id_user' => 31,
                'id_permission' => 99,
                'created_at' => '2026-03-24 19:57:28',
                'updated_at' => '2026-03-24 19:57:28'
            ],
            [
                'id_user_permission' => 1050,
                'id_user' => 31,
                'id_permission' => 101,
                'created_at' => '2026-03-24 19:57:28',
                'updated_at' => '2026-03-24 19:57:28'
            ],
            [
                'id_user_permission' => 1051,
                'id_user' => 31,
                'id_permission' => 100,
                'created_at' => '2026-03-24 19:57:30',
                'updated_at' => '2026-03-24 19:57:30'
            ],
            [
                'id_user_permission' => 1052,
                'id_user' => 48,
                'id_permission' => 223,
                'created_at' => '2026-03-24 19:57:32',
                'updated_at' => '2026-03-24 19:57:32'
            ],
            [
                'id_user_permission' => 1053,
                'id_user' => 31,
                'id_permission' => 104,
                'created_at' => '2026-03-24 19:57:37',
                'updated_at' => '2026-03-24 19:57:37'
            ],
            [
                'id_user_permission' => 1054,
                'id_user' => 31,
                'id_permission' => 105,
                'created_at' => '2026-03-24 19:57:42',
                'updated_at' => '2026-03-24 19:57:42'
            ],
            [
                'id_user_permission' => 1055,
                'id_user' => 31,
                'id_permission' => 113,
                'created_at' => '2026-03-24 19:59:05',
                'updated_at' => '2026-03-24 19:59:05'
            ],
            [
                'id_user_permission' => 1056,
                'id_user' => 31,
                'id_permission' => 114,
                'created_at' => '2026-03-24 19:59:15',
                'updated_at' => '2026-03-24 19:59:15'
            ],
            [
                'id_user_permission' => 1057,
                'id_user' => 31,
                'id_permission' => 128,
                'created_at' => '2026-03-24 19:59:23',
                'updated_at' => '2026-03-24 19:59:23'
            ],
            [
                'id_user_permission' => 1058,
                'id_user' => 31,
                'id_permission' => 129,
                'created_at' => '2026-03-24 19:59:23',
                'updated_at' => '2026-03-24 19:59:23'
            ],
            [
                'id_user_permission' => 1059,
                'id_user' => 25,
                'id_permission' => 1,
                'created_at' => '2026-03-24 20:00:23',
                'updated_at' => '2026-03-24 20:00:23'
            ],
            [
                'id_user_permission' => 1060,
                'id_user' => 25,
                'id_permission' => 13,
                'created_at' => '2026-03-24 20:00:31',
                'updated_at' => '2026-03-24 20:00:31'
            ],
            [
                'id_user_permission' => 1061,
                'id_user' => 25,
                'id_permission' => 14,
                'created_at' => '2026-03-24 20:00:32',
                'updated_at' => '2026-03-24 20:00:32'
            ],
            [
                'id_user_permission' => 1062,
                'id_user' => 25,
                'id_permission' => 15,
                'created_at' => '2026-03-24 20:00:32',
                'updated_at' => '2026-03-24 20:00:32'
            ],
            [
                'id_user_permission' => 1063,
                'id_user' => 25,
                'id_permission' => 16,
                'created_at' => '2026-03-24 20:00:35',
                'updated_at' => '2026-03-24 20:00:35'
            ],
            [
                'id_user_permission' => 1064,
                'id_user' => 31,
                'id_permission' => 152,
                'created_at' => '2026-03-24 20:00:50',
                'updated_at' => '2026-03-24 20:00:50'
            ],
            [
                'id_user_permission' => 1065,
                'id_user' => 31,
                'id_permission' => 153,
                'created_at' => '2026-03-24 20:00:52',
                'updated_at' => '2026-03-24 20:00:52'
            ],
            [
                'id_user_permission' => 1066,
                'id_user' => 31,
                'id_permission' => 156,
                'created_at' => '2026-03-24 20:01:01',
                'updated_at' => '2026-03-24 20:01:01'
            ],
            [
                'id_user_permission' => 1067,
                'id_user' => 25,
                'id_permission' => 19,
                'created_at' => '2026-03-24 20:01:03',
                'updated_at' => '2026-03-24 20:01:03'
            ],
            [
                'id_user_permission' => 1068,
                'id_user' => 31,
                'id_permission' => 159,
                'created_at' => '2026-03-24 20:01:06',
                'updated_at' => '2026-03-24 20:01:06'
            ],
            [
                'id_user_permission' => 1069,
                'id_user' => 31,
                'id_permission' => 160,
                'created_at' => '2026-03-24 20:01:07',
                'updated_at' => '2026-03-24 20:01:07'
            ],
            [
                'id_user_permission' => 1070,
                'id_user' => 25,
                'id_permission' => 23,
                'created_at' => '2026-03-24 20:01:08',
                'updated_at' => '2026-03-24 20:01:08'
            ],
            [
                'id_user_permission' => 1071,
                'id_user' => 31,
                'id_permission' => 171,
                'created_at' => '2026-03-24 20:01:12',
                'updated_at' => '2026-03-24 20:01:12'
            ],
            [
                'id_user_permission' => 1072,
                'id_user' => 31,
                'id_permission' => 172,
                'created_at' => '2026-03-24 20:01:13',
                'updated_at' => '2026-03-24 20:01:13'
            ],
            [
                'id_user_permission' => 1073,
                'id_user' => 25,
                'id_permission' => 39,
                'created_at' => '2026-03-24 20:01:18',
                'updated_at' => '2026-03-24 20:01:18'
            ],
            [
                'id_user_permission' => 1074,
                'id_user' => 25,
                'id_permission' => 40,
                'created_at' => '2026-03-24 20:01:19',
                'updated_at' => '2026-03-24 20:01:19'
            ],
            [
                'id_user_permission' => 1075,
                'id_user' => 25,
                'id_permission' => 41,
                'created_at' => '2026-03-24 20:01:19',
                'updated_at' => '2026-03-24 20:01:19'
            ],
            [
                'id_user_permission' => 1076,
                'id_user' => 25,
                'id_permission' => 42,
                'created_at' => '2026-03-24 20:01:26',
                'updated_at' => '2026-03-24 20:01:26'
            ],
            [
                'id_user_permission' => 1077,
                'id_user' => 25,
                'id_permission' => 59,
                'created_at' => '2026-03-24 20:01:41',
                'updated_at' => '2026-03-24 20:01:41'
            ],
            [
                'id_user_permission' => 1078,
                'id_user' => 25,
                'id_permission' => 63,
                'created_at' => '2026-03-24 20:01:45',
                'updated_at' => '2026-03-24 20:01:45'
            ],
            [
                'id_user_permission' => 1092,
                'id_user' => 25,
                'id_permission' => 75,
                'created_at' => '2026-03-24 20:01:53',
                'updated_at' => '2026-03-24 20:01:53'
            ],
            [
                'id_user_permission' => 1093,
                'id_user' => 25,
                'id_permission' => 78,
                'created_at' => '2026-03-24 20:02:08',
                'updated_at' => '2026-03-24 20:02:08'
            ],
            [
                'id_user_permission' => 1094,
                'id_user' => 25,
                'id_permission' => 79,
                'created_at' => '2026-03-24 20:02:10',
                'updated_at' => '2026-03-24 20:02:10'
            ],
            [
                'id_user_permission' => 1095,
                'id_user' => 25,
                'id_permission' => 80,
                'created_at' => '2026-03-24 20:02:10',
                'updated_at' => '2026-03-24 20:02:10'
            ],
            [
                'id_user_permission' => 1096,
                'id_user' => 25,
                'id_permission' => 81,
                'created_at' => '2026-03-24 20:02:13',
                'updated_at' => '2026-03-24 20:02:13'
            ],
            [
                'id_user_permission' => 1097,
                'id_user' => 25,
                'id_permission' => 82,
                'created_at' => '2026-03-24 20:02:17',
                'updated_at' => '2026-03-24 20:02:17'
            ],
            [
                'id_user_permission' => 1098,
                'id_user' => 25,
                'id_permission' => 83,
                'created_at' => '2026-03-24 20:02:18',
                'updated_at' => '2026-03-24 20:02:18'
            ],
            [
                'id_user_permission' => 1099,
                'id_user' => 25,
                'id_permission' => 84,
                'created_at' => '2026-03-24 20:02:18',
                'updated_at' => '2026-03-24 20:02:18'
            ],
            [
                'id_user_permission' => 1100,
                'id_user' => 25,
                'id_permission' => 85,
                'created_at' => '2026-03-24 20:02:18',
                'updated_at' => '2026-03-24 20:02:18'
            ],
            [
                'id_user_permission' => 1101,
                'id_user' => 25,
                'id_permission' => 86,
                'created_at' => '2026-03-24 20:02:26',
                'updated_at' => '2026-03-24 20:02:26'
            ],
            [
                'id_user_permission' => 1102,
                'id_user' => 25,
                'id_permission' => 87,
                'created_at' => '2026-03-24 20:02:27',
                'updated_at' => '2026-03-24 20:02:27'
            ],
            [
                'id_user_permission' => 1103,
                'id_user' => 25,
                'id_permission' => 89,
                'created_at' => '2026-03-24 20:02:44',
                'updated_at' => '2026-03-24 20:02:44'
            ],
            [
                'id_user_permission' => 1104,
                'id_user' => 25,
                'id_permission' => 90,
                'created_at' => '2026-03-24 20:02:46',
                'updated_at' => '2026-03-24 20:02:46'
            ],
            [
                'id_user_permission' => 1105,
                'id_user' => 25,
                'id_permission' => 91,
                'created_at' => '2026-03-24 20:02:46',
                'updated_at' => '2026-03-24 20:02:46'
            ],
            [
                'id_user_permission' => 1106,
                'id_user' => 25,
                'id_permission' => 92,
                'created_at' => '2026-03-24 20:02:46',
                'updated_at' => '2026-03-24 20:02:46'
            ],
            [
                'id_user_permission' => 1107,
                'id_user' => 25,
                'id_permission' => 93,
                'created_at' => '2026-03-24 20:02:46',
                'updated_at' => '2026-03-24 20:02:46'
            ],
            [
                'id_user_permission' => 1108,
                'id_user' => 25,
                'id_permission' => 94,
                'created_at' => '2026-03-24 20:02:53',
                'updated_at' => '2026-03-24 20:02:53'
            ],
            [
                'id_user_permission' => 1109,
                'id_user' => 25,
                'id_permission' => 111,
                'created_at' => '2026-03-24 20:03:06',
                'updated_at' => '2026-03-24 20:03:06'
            ],
            [
                'id_user_permission' => 1110,
                'id_user' => 25,
                'id_permission' => 112,
                'created_at' => '2026-03-24 20:03:07',
                'updated_at' => '2026-03-24 20:03:07'
            ],
            [
                'id_user_permission' => 1111,
                'id_user' => 25,
                'id_permission' => 129,
                'created_at' => '2026-03-24 20:03:45',
                'updated_at' => '2026-03-24 20:03:45'
            ],
            [
                'id_user_permission' => 1112,
                'id_user' => 25,
                'id_permission' => 130,
                'created_at' => '2026-03-24 20:03:47',
                'updated_at' => '2026-03-24 20:03:47'
            ],
            [
                'id_user_permission' => 1113,
                'id_user' => 25,
                'id_permission' => 131,
                'created_at' => '2026-03-24 20:03:47',
                'updated_at' => '2026-03-24 20:03:47'
            ],
            [
                'id_user_permission' => 1114,
                'id_user' => 25,
                'id_permission' => 132,
                'created_at' => '2026-03-24 20:03:47',
                'updated_at' => '2026-03-24 20:03:47'
            ],
            [
                'id_user_permission' => 1115,
                'id_user' => 25,
                'id_permission' => 133,
                'created_at' => '2026-03-24 20:03:47',
                'updated_at' => '2026-03-24 20:03:47'
            ],
            [
                'id_user_permission' => 1116,
                'id_user' => 25,
                'id_permission' => 134,
                'created_at' => '2026-03-24 20:03:47',
                'updated_at' => '2026-03-24 20:03:47'
            ],
            [
                'id_user_permission' => 1117,
                'id_user' => 25,
                'id_permission' => 135,
                'created_at' => '2026-03-24 20:03:49',
                'updated_at' => '2026-03-24 20:03:49'
            ],
            [
                'id_user_permission' => 1118,
                'id_user' => 25,
                'id_permission' => 136,
                'created_at' => '2026-03-24 20:03:53',
                'updated_at' => '2026-03-24 20:03:53'
            ],
            [
                'id_user_permission' => 1119,
                'id_user' => 25,
                'id_permission' => 137,
                'created_at' => '2026-03-24 20:04:07',
                'updated_at' => '2026-03-24 20:04:07'
            ],
            [
                'id_user_permission' => 1120,
                'id_user' => 25,
                'id_permission' => 138,
                'created_at' => '2026-03-24 20:04:08',
                'updated_at' => '2026-03-24 20:04:08'
            ],
            [
                'id_user_permission' => 1121,
                'id_user' => 25,
                'id_permission' => 141,
                'created_at' => '2026-03-24 20:04:25',
                'updated_at' => '2026-03-24 20:04:25'
            ],
            [
                'id_user_permission' => 1122,
                'id_user' => 25,
                'id_permission' => 142,
                'created_at' => '2026-03-24 20:04:26',
                'updated_at' => '2026-03-24 20:04:26'
            ],
            [
                'id_user_permission' => 1123,
                'id_user' => 25,
                'id_permission' => 143,
                'created_at' => '2026-03-24 20:04:26',
                'updated_at' => '2026-03-24 20:04:26'
            ],
            [
                'id_user_permission' => 1124,
                'id_user' => 25,
                'id_permission' => 144,
                'created_at' => '2026-03-24 20:04:28',
                'updated_at' => '2026-03-24 20:04:28'
            ],
            [
                'id_user_permission' => 1125,
                'id_user' => 25,
                'id_permission' => 145,
                'created_at' => '2026-03-24 20:04:30',
                'updated_at' => '2026-03-24 20:04:30'
            ],
            [
                'id_user_permission' => 1126,
                'id_user' => 25,
                'id_permission' => 146,
                'created_at' => '2026-03-24 20:04:30',
                'updated_at' => '2026-03-24 20:04:30'
            ],
            [
                'id_user_permission' => 1127,
                'id_user' => 25,
                'id_permission' => 147,
                'created_at' => '2026-03-24 20:04:30',
                'updated_at' => '2026-03-24 20:04:30'
            ],
            [
                'id_user_permission' => 1128,
                'id_user' => 25,
                'id_permission' => 148,
                'created_at' => '2026-03-24 20:04:32',
                'updated_at' => '2026-03-24 20:04:32'
            ],
            [
                'id_user_permission' => 1129,
                'id_user' => 25,
                'id_permission' => 149,
                'created_at' => '2026-03-24 20:04:48',
                'updated_at' => '2026-03-24 20:04:48'
            ],
            [
                'id_user_permission' => 1130,
                'id_user' => 25,
                'id_permission' => 150,
                'created_at' => '2026-03-24 20:05:17',
                'updated_at' => '2026-03-24 20:05:17'
            ],
            [
                'id_user_permission' => 1131,
                'id_user' => 25,
                'id_permission' => 151,
                'created_at' => '2026-03-24 20:05:30',
                'updated_at' => '2026-03-24 20:05:30'
            ],
            [
                'id_user_permission' => 1132,
                'id_user' => 25,
                'id_permission' => 157,
                'created_at' => '2026-03-24 20:06:03',
                'updated_at' => '2026-03-24 20:06:03'
            ],
            [
                'id_user_permission' => 1133,
                'id_user' => 25,
                'id_permission' => 158,
                'created_at' => '2026-03-24 20:06:04',
                'updated_at' => '2026-03-24 20:06:04'
            ],
            [
                'id_user_permission' => 1134,
                'id_user' => 25,
                'id_permission' => 223,
                'created_at' => '2026-03-24 20:06:28',
                'updated_at' => '2026-03-24 20:06:28'
            ],
            [
                'id_user_permission' => 1135,
                'id_user' => 31,
                'id_permission' => 173,
                'created_at' => '2026-03-24 20:07:08',
                'updated_at' => '2026-03-24 20:07:08'
            ],
            [
                'id_user_permission' => 1136,
                'id_user' => 31,
                'id_permission' => 243,
                'created_at' => '2026-03-24 20:07:14',
                'updated_at' => '2026-03-24 20:07:14'
            ],
            [
                'id_user_permission' => 1137,
                'id_user' => 31,
                'id_permission' => 244,
                'created_at' => '2026-03-24 20:07:15',
                'updated_at' => '2026-03-24 20:07:15'
            ],
            [
                'id_user_permission' => 1138,
                'id_user' => 31,
                'id_permission' => 180,
                'created_at' => '2026-03-24 20:08:22',
                'updated_at' => '2026-03-24 20:08:22'
            ],
            [
                'id_user_permission' => 1140,
                'id_user' => 31,
                'id_permission' => 193,
                'created_at' => '2026-03-24 20:08:49',
                'updated_at' => '2026-03-24 20:08:49'
            ],
            [
                'id_user_permission' => 1141,
                'id_user' => 52,
                'id_permission' => 1,
                'created_at' => '2026-03-24 20:08:55',
                'updated_at' => '2026-03-24 20:08:55'
            ],
            [
                'id_user_permission' => 1142,
                'id_user' => 31,
                'id_permission' => 246,
                'created_at' => '2026-03-24 20:09:11',
                'updated_at' => '2026-03-24 20:09:11'
            ],
            [
                'id_user_permission' => 1143,
                'id_user' => 31,
                'id_permission' => 222,
                'created_at' => '2026-03-24 20:09:17',
                'updated_at' => '2026-03-24 20:09:17'
            ],
            [
                'id_user_permission' => 1144,
                'id_user' => 52,
                'id_permission' => 13,
                'created_at' => '2026-03-24 20:09:18',
                'updated_at' => '2026-03-24 20:09:18'
            ],
            [
                'id_user_permission' => 1145,
                'id_user' => 31,
                'id_permission' => 223,
                'created_at' => '2026-03-24 20:09:19',
                'updated_at' => '2026-03-24 20:09:19'
            ],
            [
                'id_user_permission' => 1146,
                'id_user' => 52,
                'id_permission' => 15,
                'created_at' => '2026-03-24 20:09:19',
                'updated_at' => '2026-03-24 20:09:19'
            ],
            [
                'id_user_permission' => 1147,
                'id_user' => 52,
                'id_permission' => 14,
                'created_at' => '2026-03-24 20:09:19',
                'updated_at' => '2026-03-24 20:09:19'
            ],
            [
                'id_user_permission' => 1148,
                'id_user' => 52,
                'id_permission' => 16,
                'created_at' => '2026-03-24 20:09:29',
                'updated_at' => '2026-03-24 20:09:29'
            ],
            [
                'id_user_permission' => 1149,
                'id_user' => 52,
                'id_permission' => 19,
                'created_at' => '2026-03-24 20:09:37',
                'updated_at' => '2026-03-24 20:09:37'
            ],
            [
                'id_user_permission' => 1150,
                'id_user' => 52,
                'id_permission' => 23,
                'created_at' => '2026-03-24 20:10:04',
                'updated_at' => '2026-03-24 20:10:04'
            ],
            [
                'id_user_permission' => 1151,
                'id_user' => 52,
                'id_permission' => 39,
                'created_at' => '2026-03-24 20:10:12',
                'updated_at' => '2026-03-24 20:10:12'
            ],
            [
                'id_user_permission' => 1152,
                'id_user' => 52,
                'id_permission' => 40,
                'created_at' => '2026-03-24 20:10:14',
                'updated_at' => '2026-03-24 20:10:14'
            ],
            [
                'id_user_permission' => 1153,
                'id_user' => 52,
                'id_permission' => 41,
                'created_at' => '2026-03-24 20:10:21',
                'updated_at' => '2026-03-24 20:10:21'
            ],
            [
                'id_user_permission' => 1154,
                'id_user' => 52,
                'id_permission' => 42,
                'created_at' => '2026-03-24 20:10:23',
                'updated_at' => '2026-03-24 20:10:23'
            ],
            [
                'id_user_permission' => 1155,
                'id_user' => 31,
                'id_permission' => 248,
                'created_at' => '2026-03-24 20:10:40',
                'updated_at' => '2026-03-24 20:10:40'
            ],
            [
                'id_user_permission' => 1156,
                'id_user' => 31,
                'id_permission' => 249,
                'created_at' => '2026-03-24 20:10:49',
                'updated_at' => '2026-03-24 20:10:49'
            ],
            [
                'id_user_permission' => 1157,
                'id_user' => 52,
                'id_permission' => 59,
                'created_at' => '2026-03-24 20:11:16',
                'updated_at' => '2026-03-24 20:11:16'
            ],
            [
                'id_user_permission' => 1158,
                'id_user' => 52,
                'id_permission' => 63,
                'created_at' => '2026-03-24 20:11:24',
                'updated_at' => '2026-03-24 20:11:24'
            ],
            [
                'id_user_permission' => 1159,
                'id_user' => 52,
                'id_permission' => 75,
                'created_at' => '2026-03-24 20:11:35',
                'updated_at' => '2026-03-24 20:11:35'
            ],
            [
                'id_user_permission' => 1160,
                'id_user' => 52,
                'id_permission' => 78,
                'created_at' => '2026-03-24 20:11:46',
                'updated_at' => '2026-03-24 20:11:46'
            ],
            [
                'id_user_permission' => 1161,
                'id_user' => 52,
                'id_permission' => 79,
                'created_at' => '2026-03-24 20:11:48',
                'updated_at' => '2026-03-24 20:11:48'
            ],
            [
                'id_user_permission' => 1162,
                'id_user' => 52,
                'id_permission' => 80,
                'created_at' => '2026-03-24 20:11:48',
                'updated_at' => '2026-03-24 20:11:48'
            ],
            [
                'id_user_permission' => 1163,
                'id_user' => 52,
                'id_permission' => 81,
                'created_at' => '2026-03-24 20:11:50',
                'updated_at' => '2026-03-24 20:11:50'
            ],
            [
                'id_user_permission' => 1164,
                'id_user' => 52,
                'id_permission' => 82,
                'created_at' => '2026-03-24 20:11:52',
                'updated_at' => '2026-03-24 20:11:52'
            ],
            [
                'id_user_permission' => 1165,
                'id_user' => 52,
                'id_permission' => 83,
                'created_at' => '2026-03-24 20:11:52',
                'updated_at' => '2026-03-24 20:11:52'
            ],
            [
                'id_user_permission' => 1166,
                'id_user' => 52,
                'id_permission' => 84,
                'created_at' => '2026-03-24 20:11:52',
                'updated_at' => '2026-03-24 20:11:52'
            ],
            [
                'id_user_permission' => 1167,
                'id_user' => 52,
                'id_permission' => 85,
                'created_at' => '2026-03-24 20:11:59',
                'updated_at' => '2026-03-24 20:11:59'
            ],
            [
                'id_user_permission' => 1168,
                'id_user' => 52,
                'id_permission' => 86,
                'created_at' => '2026-03-24 20:12:14',
                'updated_at' => '2026-03-24 20:12:14'
            ],
            [
                'id_user_permission' => 1169,
                'id_user' => 52,
                'id_permission' => 87,
                'created_at' => '2026-03-24 20:12:16',
                'updated_at' => '2026-03-24 20:12:16'
            ],
            [
                'id_user_permission' => 1171,
                'id_user' => 52,
                'id_permission' => 89,
                'created_at' => '2026-03-24 20:12:16',
                'updated_at' => '2026-03-24 20:12:16'
            ],
            [
                'id_user_permission' => 1172,
                'id_user' => 52,
                'id_permission' => 90,
                'created_at' => '2026-03-24 20:12:31',
                'updated_at' => '2026-03-24 20:12:31'
            ],
            [
                'id_user_permission' => 1173,
                'id_user' => 52,
                'id_permission' => 91,
                'created_at' => '2026-03-24 20:12:34',
                'updated_at' => '2026-03-24 20:12:34'
            ],
            [
                'id_user_permission' => 1174,
                'id_user' => 52,
                'id_permission' => 92,
                'created_at' => '2026-03-24 20:12:35',
                'updated_at' => '2026-03-24 20:12:35'
            ],
            [
                'id_user_permission' => 1175,
                'id_user' => 52,
                'id_permission' => 93,
                'created_at' => '2026-03-24 20:12:42',
                'updated_at' => '2026-03-24 20:12:42'
            ],
            [
                'id_user_permission' => 1176,
                'id_user' => 52,
                'id_permission' => 94,
                'created_at' => '2026-03-24 20:12:44',
                'updated_at' => '2026-03-24 20:12:44'
            ],
            [
                'id_user_permission' => 1177,
                'id_user' => 52,
                'id_permission' => 111,
                'created_at' => '2026-03-24 20:12:51',
                'updated_at' => '2026-03-24 20:12:51'
            ],
            [
                'id_user_permission' => 1178,
                'id_user' => 52,
                'id_permission' => 112,
                'created_at' => '2026-03-24 20:12:53',
                'updated_at' => '2026-03-24 20:12:53'
            ],
            [
                'id_user_permission' => 1179,
                'id_user' => 52,
                'id_permission' => 129,
                'created_at' => '2026-03-24 20:13:04',
                'updated_at' => '2026-03-24 20:13:04'
            ],
            [
                'id_user_permission' => 1180,
                'id_user' => 52,
                'id_permission' => 131,
                'created_at' => '2026-03-24 20:13:05',
                'updated_at' => '2026-03-24 20:13:05'
            ],
            [
                'id_user_permission' => 1181,
                'id_user' => 52,
                'id_permission' => 130,
                'created_at' => '2026-03-24 20:13:05',
                'updated_at' => '2026-03-24 20:13:05'
            ],
            [
                'id_user_permission' => 1182,
                'id_user' => 52,
                'id_permission' => 132,
                'created_at' => '2026-03-24 20:13:08',
                'updated_at' => '2026-03-24 20:13:08'
            ],
            [
                'id_user_permission' => 1183,
                'id_user' => 52,
                'id_permission' => 133,
                'created_at' => '2026-03-24 20:13:09',
                'updated_at' => '2026-03-24 20:13:09'
            ],
            [
                'id_user_permission' => 1184,
                'id_user' => 52,
                'id_permission' => 134,
                'created_at' => '2026-03-24 20:13:11',
                'updated_at' => '2026-03-24 20:13:11'
            ],
            [
                'id_user_permission' => 1185,
                'id_user' => 52,
                'id_permission' => 135,
                'created_at' => '2026-03-24 20:13:13',
                'updated_at' => '2026-03-24 20:13:13'
            ],
            [
                'id_user_permission' => 1186,
                'id_user' => 52,
                'id_permission' => 136,
                'created_at' => '2026-03-24 20:13:13',
                'updated_at' => '2026-03-24 20:13:13'
            ],
            [
                'id_user_permission' => 1187,
                'id_user' => 56,
                'id_permission' => 174,
                'created_at' => '2026-03-24 20:14:28',
                'updated_at' => '2026-03-24 20:14:28'
            ],
            [
                'id_user_permission' => 1188,
                'id_user' => 56,
                'id_permission' => 177,
                'created_at' => '2026-03-24 20:14:32',
                'updated_at' => '2026-03-24 20:14:32'
            ],
            [
                'id_user_permission' => 1189,
                'id_user' => 56,
                'id_permission' => 178,
                'created_at' => '2026-03-24 20:14:34',
                'updated_at' => '2026-03-24 20:14:34'
            ],
            [
                'id_user_permission' => 1190,
                'id_user' => 56,
                'id_permission' => 179,
                'created_at' => '2026-03-24 20:14:34',
                'updated_at' => '2026-03-24 20:14:34'
            ],
            [
                'id_user_permission' => 1191,
                'id_user' => 56,
                'id_permission' => 243,
                'created_at' => '2026-03-24 20:14:45',
                'updated_at' => '2026-03-24 20:14:45'
            ],
            [
                'id_user_permission' => 1192,
                'id_user' => 56,
                'id_permission' => 244,
                'created_at' => '2026-03-24 20:14:47',
                'updated_at' => '2026-03-24 20:14:47'
            ],
            [
                'id_user_permission' => 1193,
                'id_user' => 56,
                'id_permission' => 180,
                'created_at' => '2026-03-24 20:14:56',
                'updated_at' => '2026-03-24 20:14:56'
            ],
            [
                'id_user_permission' => 1194,
                'id_user' => 52,
                'id_permission' => 137,
                'created_at' => '2026-03-24 20:15:08',
                'updated_at' => '2026-03-24 20:15:08'
            ],
            [
                'id_user_permission' => 1196,
                'id_user' => 56,
                'id_permission' => 186,
                'created_at' => '2026-03-24 20:15:11',
                'updated_at' => '2026-03-24 20:15:11'
            ],
            [
                'id_user_permission' => 1197,
                'id_user' => 56,
                'id_permission' => 187,
                'created_at' => '2026-03-24 20:15:14',
                'updated_at' => '2026-03-24 20:15:14'
            ],
            [
                'id_user_permission' => 1198,
                'id_user' => 52,
                'id_permission' => 141,
                'created_at' => '2026-03-24 20:15:27',
                'updated_at' => '2026-03-24 20:15:27'
            ],
            [
                'id_user_permission' => 1199,
                'id_user' => 52,
                'id_permission' => 142,
                'created_at' => '2026-03-24 20:15:29',
                'updated_at' => '2026-03-24 20:15:29'
            ],
            [
                'id_user_permission' => 1200,
                'id_user' => 52,
                'id_permission' => 143,
                'created_at' => '2026-03-24 20:15:29',
                'updated_at' => '2026-03-24 20:15:29'
            ],
            [
                'id_user_permission' => 1201,
                'id_user' => 52,
                'id_permission' => 144,
                'created_at' => '2026-03-24 20:15:29',
                'updated_at' => '2026-03-24 20:15:29'
            ],
            [
                'id_user_permission' => 1202,
                'id_user' => 52,
                'id_permission' => 145,
                'created_at' => '2026-03-24 20:15:29',
                'updated_at' => '2026-03-24 20:15:29'
            ],
            [
                'id_user_permission' => 1203,
                'id_user' => 52,
                'id_permission' => 146,
                'created_at' => '2026-03-24 20:15:35',
                'updated_at' => '2026-03-24 20:15:35'
            ],
            [
                'id_user_permission' => 1204,
                'id_user' => 52,
                'id_permission' => 147,
                'created_at' => '2026-03-24 20:15:37',
                'updated_at' => '2026-03-24 20:15:37'
            ],
            [
                'id_user_permission' => 1205,
                'id_user' => 52,
                'id_permission' => 148,
                'created_at' => '2026-03-24 20:15:40',
                'updated_at' => '2026-03-24 20:15:40'
            ],
            [
                'id_user_permission' => 1206,
                'id_user' => 52,
                'id_permission' => 149,
                'created_at' => '2026-03-24 20:15:46',
                'updated_at' => '2026-03-24 20:15:46'
            ],
            [
                'id_user_permission' => 1207,
                'id_user' => 52,
                'id_permission' => 150,
                'created_at' => '2026-03-24 20:15:47',
                'updated_at' => '2026-03-24 20:15:47'
            ],
            [
                'id_user_permission' => 1208,
                'id_user' => 52,
                'id_permission' => 151,
                'created_at' => '2026-03-24 20:15:50',
                'updated_at' => '2026-03-24 20:15:50'
            ],
            [
                'id_user_permission' => 1209,
                'id_user' => 52,
                'id_permission' => 157,
                'created_at' => '2026-03-24 20:15:56',
                'updated_at' => '2026-03-24 20:15:56'
            ],
            [
                'id_user_permission' => 1210,
                'id_user' => 52,
                'id_permission' => 158,
                'created_at' => '2026-03-24 20:15:58',
                'updated_at' => '2026-03-24 20:15:58'
            ],
            [
                'id_user_permission' => 1211,
                'id_user' => 52,
                'id_permission' => 223,
                'created_at' => '2026-03-24 20:16:10',
                'updated_at' => '2026-03-24 20:16:10'
            ],
            [
                'id_user_permission' => 1212,
                'id_user' => 37,
                'id_permission' => 1,
                'created_at' => '2026-03-24 20:16:58',
                'updated_at' => '2026-03-24 20:16:58'
            ],
            [
                'id_user_permission' => 1213,
                'id_user' => 37,
                'id_permission' => 13,
                'created_at' => '2026-03-24 20:17:04',
                'updated_at' => '2026-03-24 20:17:04'
            ],
            [
                'id_user_permission' => 1214,
                'id_user' => 37,
                'id_permission' => 14,
                'created_at' => '2026-03-24 20:17:07',
                'updated_at' => '2026-03-24 20:17:07'
            ],
            [
                'id_user_permission' => 1215,
                'id_user' => 37,
                'id_permission' => 15,
                'created_at' => '2026-03-24 20:17:07',
                'updated_at' => '2026-03-24 20:17:07'
            ],
            [
                'id_user_permission' => 1216,
                'id_user' => 37,
                'id_permission' => 16,
                'created_at' => '2026-03-24 20:17:07',
                'updated_at' => '2026-03-24 20:17:07'
            ],
            [
                'id_user_permission' => 1217,
                'id_user' => 37,
                'id_permission' => 19,
                'created_at' => '2026-03-24 20:17:17',
                'updated_at' => '2026-03-24 20:17:17'
            ],
            [
                'id_user_permission' => 1218,
                'id_user' => 37,
                'id_permission' => 23,
                'created_at' => '2026-03-24 20:17:27',
                'updated_at' => '2026-03-24 20:17:27'
            ],
            [
                'id_user_permission' => 1219,
                'id_user' => 37,
                'id_permission' => 39,
                'created_at' => '2026-03-24 20:17:35',
                'updated_at' => '2026-03-24 20:17:35'
            ],
            [
                'id_user_permission' => 1220,
                'id_user' => 37,
                'id_permission' => 40,
                'created_at' => '2026-03-24 20:17:37',
                'updated_at' => '2026-03-24 20:17:37'
            ],
            [
                'id_user_permission' => 1221,
                'id_user' => 37,
                'id_permission' => 41,
                'created_at' => '2026-03-24 20:17:37',
                'updated_at' => '2026-03-24 20:17:37'
            ],
            [
                'id_user_permission' => 1222,
                'id_user' => 37,
                'id_permission' => 42,
                'created_at' => '2026-03-24 20:17:41',
                'updated_at' => '2026-03-24 20:17:41'
            ],
            [
                'id_user_permission' => 1223,
                'id_user' => 37,
                'id_permission' => 59,
                'created_at' => '2026-03-24 20:18:05',
                'updated_at' => '2026-03-24 20:18:05'
            ],
            [
                'id_user_permission' => 1224,
                'id_user' => 37,
                'id_permission' => 63,
                'created_at' => '2026-03-24 20:18:09',
                'updated_at' => '2026-03-24 20:18:09'
            ],
            [
                'id_user_permission' => 1225,
                'id_user' => 37,
                'id_permission' => 75,
                'created_at' => '2026-03-24 20:18:18',
                'updated_at' => '2026-03-24 20:18:18'
            ],
            [
                'id_user_permission' => 1227,
                'id_user' => 37,
                'id_permission' => 78,
                'created_at' => '2026-03-24 20:18:34',
                'updated_at' => '2026-03-24 20:18:34'
            ],
            [
                'id_user_permission' => 1228,
                'id_user' => 37,
                'id_permission' => 79,
                'created_at' => '2026-03-24 20:18:36',
                'updated_at' => '2026-03-24 20:18:36'
            ],
            [
                'id_user_permission' => 1229,
                'id_user' => 37,
                'id_permission' => 80,
                'created_at' => '2026-03-24 20:18:36',
                'updated_at' => '2026-03-24 20:18:36'
            ],
            [
                'id_user_permission' => 1230,
                'id_user' => 37,
                'id_permission' => 81,
                'created_at' => '2026-03-24 20:18:36',
                'updated_at' => '2026-03-24 20:18:36'
            ],
            [
                'id_user_permission' => 1231,
                'id_user' => 37,
                'id_permission' => 82,
                'created_at' => '2026-03-24 20:18:36',
                'updated_at' => '2026-03-24 20:18:36'
            ],
            [
                'id_user_permission' => 1232,
                'id_user' => 37,
                'id_permission' => 83,
                'created_at' => '2026-03-24 20:18:38',
                'updated_at' => '2026-03-24 20:18:38'
            ],
            [
                'id_user_permission' => 1233,
                'id_user' => 37,
                'id_permission' => 84,
                'created_at' => '2026-03-24 20:18:40',
                'updated_at' => '2026-03-24 20:18:40'
            ],
            [
                'id_user_permission' => 1234,
                'id_user' => 37,
                'id_permission' => 85,
                'created_at' => '2026-03-24 20:18:45',
                'updated_at' => '2026-03-24 20:18:45'
            ],
            [
                'id_user_permission' => 1235,
                'id_user' => 37,
                'id_permission' => 86,
                'created_at' => '2026-03-24 20:18:47',
                'updated_at' => '2026-03-24 20:18:47'
            ],
            [
                'id_user_permission' => 1236,
                'id_user' => 37,
                'id_permission' => 87,
                'created_at' => '2026-03-24 20:18:47',
                'updated_at' => '2026-03-24 20:18:47'
            ],
            [
                'id_user_permission' => 1237,
                'id_user' => 37,
                'id_permission' => 89,
                'created_at' => '2026-03-24 20:18:53',
                'updated_at' => '2026-03-24 20:18:53'
            ],
            [
                'id_user_permission' => 1238,
                'id_user' => 37,
                'id_permission' => 90,
                'created_at' => '2026-03-24 20:18:55',
                'updated_at' => '2026-03-24 20:18:55'
            ],
            [
                'id_user_permission' => 1239,
                'id_user' => 37,
                'id_permission' => 91,
                'created_at' => '2026-03-24 20:18:55',
                'updated_at' => '2026-03-24 20:18:55'
            ],
            [
                'id_user_permission' => 1240,
                'id_user' => 37,
                'id_permission' => 92,
                'created_at' => '2026-03-24 20:18:55',
                'updated_at' => '2026-03-24 20:18:55'
            ],
            [
                'id_user_permission' => 1241,
                'id_user' => 37,
                'id_permission' => 93,
                'created_at' => '2026-03-24 20:19:02',
                'updated_at' => '2026-03-24 20:19:02'
            ],
            [
                'id_user_permission' => 1242,
                'id_user' => 37,
                'id_permission' => 94,
                'created_at' => '2026-03-24 20:19:04',
                'updated_at' => '2026-03-24 20:19:04'
            ],
            [
                'id_user_permission' => 1243,
                'id_user' => 37,
                'id_permission' => 111,
                'created_at' => '2026-03-24 20:19:14',
                'updated_at' => '2026-03-24 20:19:14'
            ],
            [
                'id_user_permission' => 1244,
                'id_user' => 37,
                'id_permission' => 112,
                'created_at' => '2026-03-24 20:19:15',
                'updated_at' => '2026-03-24 20:19:15'
            ],
            [
                'id_user_permission' => 1245,
                'id_user' => 37,
                'id_permission' => 129,
                'created_at' => '2026-03-24 20:19:31',
                'updated_at' => '2026-03-24 20:19:31'
            ],
            [
                'id_user_permission' => 1246,
                'id_user' => 37,
                'id_permission' => 130,
                'created_at' => '2026-03-24 20:19:33',
                'updated_at' => '2026-03-24 20:19:33'
            ],
            [
                'id_user_permission' => 1247,
                'id_user' => 37,
                'id_permission' => 131,
                'created_at' => '2026-03-24 20:19:33',
                'updated_at' => '2026-03-24 20:19:33'
            ],
            [
                'id_user_permission' => 1248,
                'id_user' => 37,
                'id_permission' => 132,
                'created_at' => '2026-03-24 20:19:33',
                'updated_at' => '2026-03-24 20:19:33'
            ],
            [
                'id_user_permission' => 1249,
                'id_user' => 37,
                'id_permission' => 133,
                'created_at' => '2026-03-24 20:19:41',
                'updated_at' => '2026-03-24 20:19:41'
            ],
            [
                'id_user_permission' => 1250,
                'id_user' => 37,
                'id_permission' => 134,
                'created_at' => '2026-03-24 20:19:43',
                'updated_at' => '2026-03-24 20:19:43'
            ],
            [
                'id_user_permission' => 1251,
                'id_user' => 37,
                'id_permission' => 136,
                'created_at' => '2026-03-24 20:19:43',
                'updated_at' => '2026-03-24 20:19:43'
            ],
            [
                'id_user_permission' => 1252,
                'id_user' => 37,
                'id_permission' => 137,
                'created_at' => '2026-03-24 20:19:43',
                'updated_at' => '2026-03-24 20:19:43'
            ],
            [
                'id_user_permission' => 1253,
                'id_user' => 37,
                'id_permission' => 135,
                'created_at' => '2026-03-24 20:19:47',
                'updated_at' => '2026-03-24 20:19:47'
            ],
            [
                'id_user_permission' => 1254,
                'id_user' => 37,
                'id_permission' => 138,
                'created_at' => '2026-03-24 20:19:49',
                'updated_at' => '2026-03-24 20:19:49'
            ],
            [
                'id_user_permission' => 1255,
                'id_user' => 37,
                'id_permission' => 141,
                'created_at' => '2026-03-24 20:20:05',
                'updated_at' => '2026-03-24 20:20:05'
            ],
            [
                'id_user_permission' => 1256,
                'id_user' => 37,
                'id_permission' => 142,
                'created_at' => '2026-03-24 20:20:07',
                'updated_at' => '2026-03-24 20:20:07'
            ],
            [
                'id_user_permission' => 1257,
                'id_user' => 37,
                'id_permission' => 143,
                'created_at' => '2026-03-24 20:20:07',
                'updated_at' => '2026-03-24 20:20:07'
            ],
            [
                'id_user_permission' => 1258,
                'id_user' => 37,
                'id_permission' => 144,
                'created_at' => '2026-03-24 20:20:07',
                'updated_at' => '2026-03-24 20:20:07'
            ],
            [
                'id_user_permission' => 1259,
                'id_user' => 37,
                'id_permission' => 145,
                'created_at' => '2026-03-24 20:20:14',
                'updated_at' => '2026-03-24 20:20:14'
            ],
            [
                'id_user_permission' => 1260,
                'id_user' => 37,
                'id_permission' => 146,
                'created_at' => '2026-03-24 20:20:16',
                'updated_at' => '2026-03-24 20:20:16'
            ],
            [
                'id_user_permission' => 1261,
                'id_user' => 37,
                'id_permission' => 147,
                'created_at' => '2026-03-24 20:20:19',
                'updated_at' => '2026-03-24 20:20:19'
            ],
            [
                'id_user_permission' => 1262,
                'id_user' => 37,
                'id_permission' => 148,
                'created_at' => '2026-03-24 20:20:20',
                'updated_at' => '2026-03-24 20:20:20'
            ],
            [
                'id_user_permission' => 1263,
                'id_user' => 37,
                'id_permission' => 150,
                'created_at' => '2026-03-24 20:20:20',
                'updated_at' => '2026-03-24 20:20:20'
            ],
            [
                'id_user_permission' => 1264,
                'id_user' => 37,
                'id_permission' => 149,
                'created_at' => '2026-03-24 20:20:26',
                'updated_at' => '2026-03-24 20:20:26'
            ],
            [
                'id_user_permission' => 1265,
                'id_user' => 37,
                'id_permission' => 151,
                'created_at' => '2026-03-24 20:20:28',
                'updated_at' => '2026-03-24 20:20:28'
            ],
            [
                'id_user_permission' => 1266,
                'id_user' => 37,
                'id_permission' => 157,
                'created_at' => '2026-03-24 20:20:52',
                'updated_at' => '2026-03-24 20:20:52'
            ],
            [
                'id_user_permission' => 1267,
                'id_user' => 37,
                'id_permission' => 158,
                'created_at' => '2026-03-24 20:20:54',
                'updated_at' => '2026-03-24 20:20:54'
            ],
            [
                'id_user_permission' => 1268,
                'id_user' => 37,
                'id_permission' => 223,
                'created_at' => '2026-03-24 20:21:16',
                'updated_at' => '2026-03-24 20:21:16'
            ],
            [
                'id_user_permission' => 1269,
                'id_user' => 38,
                'id_permission' => 1,
                'created_at' => '2026-03-24 20:22:03',
                'updated_at' => '2026-03-24 20:22:03'
            ],
            [
                'id_user_permission' => 1270,
                'id_user' => 38,
                'id_permission' => 13,
                'created_at' => '2026-03-24 20:22:10',
                'updated_at' => '2026-03-24 20:22:10'
            ],
            [
                'id_user_permission' => 1271,
                'id_user' => 38,
                'id_permission' => 14,
                'created_at' => '2026-03-24 20:22:11',
                'updated_at' => '2026-03-24 20:22:11'
            ],
            [
                'id_user_permission' => 1272,
                'id_user' => 38,
                'id_permission' => 15,
                'created_at' => '2026-03-24 20:22:11',
                'updated_at' => '2026-03-24 20:22:11'
            ],
            [
                'id_user_permission' => 1273,
                'id_user' => 38,
                'id_permission' => 16,
                'created_at' => '2026-03-24 20:22:18',
                'updated_at' => '2026-03-24 20:22:18'
            ],
            [
                'id_user_permission' => 1274,
                'id_user' => 38,
                'id_permission' => 19,
                'created_at' => '2026-03-24 20:22:23',
                'updated_at' => '2026-03-24 20:22:23'
            ],
            [
                'id_user_permission' => 1275,
                'id_user' => 38,
                'id_permission' => 23,
                'created_at' => '2026-03-24 20:22:31',
                'updated_at' => '2026-03-24 20:22:31'
            ],
            [
                'id_user_permission' => 1276,
                'id_user' => 38,
                'id_permission' => 39,
                'created_at' => '2026-03-24 20:22:49',
                'updated_at' => '2026-03-24 20:22:49'
            ],
            [
                'id_user_permission' => 1277,
                'id_user' => 38,
                'id_permission' => 40,
                'created_at' => '2026-03-24 20:22:50',
                'updated_at' => '2026-03-24 20:22:50'
            ],
            [
                'id_user_permission' => 1278,
                'id_user' => 38,
                'id_permission' => 41,
                'created_at' => '2026-03-24 20:22:50',
                'updated_at' => '2026-03-24 20:22:50'
            ],
            [
                'id_user_permission' => 1279,
                'id_user' => 38,
                'id_permission' => 42,
                'created_at' => '2026-03-24 20:22:56',
                'updated_at' => '2026-03-24 20:22:56'
            ],
            [
                'id_user_permission' => 1280,
                'id_user' => 38,
                'id_permission' => 59,
                'created_at' => '2026-03-24 20:23:12',
                'updated_at' => '2026-03-24 20:23:12'
            ],
            [
                'id_user_permission' => 1281,
                'id_user' => 38,
                'id_permission' => 63,
                'created_at' => '2026-03-24 20:23:15',
                'updated_at' => '2026-03-24 20:23:15'
            ],
            [
                'id_user_permission' => 1282,
                'id_user' => 38,
                'id_permission' => 75,
                'created_at' => '2026-03-24 20:23:24',
                'updated_at' => '2026-03-24 20:23:24'
            ],
            [
                'id_user_permission' => 1283,
                'id_user' => 38,
                'id_permission' => 78,
                'created_at' => '2026-03-24 20:23:32',
                'updated_at' => '2026-03-24 20:23:32'
            ],
            [
                'id_user_permission' => 1284,
                'id_user' => 38,
                'id_permission' => 79,
                'created_at' => '2026-03-24 20:23:39',
                'updated_at' => '2026-03-24 20:23:39'
            ],
            [
                'id_user_permission' => 1285,
                'id_user' => 38,
                'id_permission' => 81,
                'created_at' => '2026-03-24 20:23:42',
                'updated_at' => '2026-03-24 20:23:42'
            ],
            [
                'id_user_permission' => 1286,
                'id_user' => 38,
                'id_permission' => 80,
                'created_at' => '2026-03-24 20:23:42',
                'updated_at' => '2026-03-24 20:23:42'
            ],
            [
                'id_user_permission' => 1287,
                'id_user' => 38,
                'id_permission' => 82,
                'created_at' => '2026-03-24 20:23:42',
                'updated_at' => '2026-03-24 20:23:42'
            ],
            [
                'id_user_permission' => 1288,
                'id_user' => 38,
                'id_permission' => 83,
                'created_at' => '2026-03-24 20:23:45',
                'updated_at' => '2026-03-24 20:23:45'
            ],
            [
                'id_user_permission' => 1289,
                'id_user' => 38,
                'id_permission' => 84,
                'created_at' => '2026-03-24 20:23:48',
                'updated_at' => '2026-03-24 20:23:48'
            ],
            [
                'id_user_permission' => 1290,
                'id_user' => 38,
                'id_permission' => 85,
                'created_at' => '2026-03-24 20:23:48',
                'updated_at' => '2026-03-24 20:23:48'
            ],
            [
                'id_user_permission' => 1291,
                'id_user' => 38,
                'id_permission' => 87,
                'created_at' => '2026-03-24 20:23:56',
                'updated_at' => '2026-03-24 20:23:56'
            ],
            [
                'id_user_permission' => 1292,
                'id_user' => 38,
                'id_permission' => 86,
                'created_at' => '2026-03-24 20:23:58',
                'updated_at' => '2026-03-24 20:23:58'
            ],
            [
                'id_user_permission' => 1293,
                'id_user' => 38,
                'id_permission' => 89,
                'created_at' => '2026-03-24 20:24:12',
                'updated_at' => '2026-03-24 20:24:12'
            ],
            [
                'id_user_permission' => 1294,
                'id_user' => 38,
                'id_permission' => 90,
                'created_at' => '2026-03-24 20:24:15',
                'updated_at' => '2026-03-24 20:24:15'
            ],
            [
                'id_user_permission' => 1295,
                'id_user' => 38,
                'id_permission' => 91,
                'created_at' => '2026-03-24 20:24:15',
                'updated_at' => '2026-03-24 20:24:15'
            ],
            [
                'id_user_permission' => 1296,
                'id_user' => 38,
                'id_permission' => 92,
                'created_at' => '2026-03-24 20:24:15',
                'updated_at' => '2026-03-24 20:24:15'
            ],
            [
                'id_user_permission' => 1297,
                'id_user' => 38,
                'id_permission' => 93,
                'created_at' => '2026-03-24 20:24:15',
                'updated_at' => '2026-03-24 20:24:15'
            ],
            [
                'id_user_permission' => 1298,
                'id_user' => 38,
                'id_permission' => 94,
                'created_at' => '2026-03-24 20:24:21',
                'updated_at' => '2026-03-24 20:24:21'
            ],
            [
                'id_user_permission' => 1299,
                'id_user' => 38,
                'id_permission' => 111,
                'created_at' => '2026-03-24 20:24:45',
                'updated_at' => '2026-03-24 20:24:45'
            ],
            [
                'id_user_permission' => 1300,
                'id_user' => 38,
                'id_permission' => 112,
                'created_at' => '2026-03-24 20:24:47',
                'updated_at' => '2026-03-24 20:24:47'
            ],
            [
                'id_user_permission' => 1301,
                'id_user' => 38,
                'id_permission' => 129,
                'created_at' => '2026-03-24 20:24:58',
                'updated_at' => '2026-03-24 20:24:58'
            ],
            [
                'id_user_permission' => 1302,
                'id_user' => 56,
                'id_permission' => 193,
                'created_at' => '2026-03-24 20:25:00',
                'updated_at' => '2026-03-24 20:25:00'
            ],
            [
                'id_user_permission' => 1303,
                'id_user' => 38,
                'id_permission' => 130,
                'created_at' => '2026-03-24 20:25:02',
                'updated_at' => '2026-03-24 20:25:02'
            ],
            [
                'id_user_permission' => 1304,
                'id_user' => 38,
                'id_permission' => 131,
                'created_at' => '2026-03-24 20:25:02',
                'updated_at' => '2026-03-24 20:25:02'
            ],
            [
                'id_user_permission' => 1305,
                'id_user' => 38,
                'id_permission' => 132,
                'created_at' => '2026-03-24 20:25:02',
                'updated_at' => '2026-03-24 20:25:02'
            ],
            [
                'id_user_permission' => 1306,
                'id_user' => 38,
                'id_permission' => 133,
                'created_at' => '2026-03-24 20:25:02',
                'updated_at' => '2026-03-24 20:25:02'
            ],
            [
                'id_user_permission' => 1307,
                'id_user' => 38,
                'id_permission' => 134,
                'created_at' => '2026-03-24 20:25:02',
                'updated_at' => '2026-03-24 20:25:02'
            ],
            [
                'id_user_permission' => 1308,
                'id_user' => 38,
                'id_permission' => 135,
                'created_at' => '2026-03-24 20:25:02',
                'updated_at' => '2026-03-24 20:25:02'
            ],
            [
                'id_user_permission' => 1309,
                'id_user' => 38,
                'id_permission' => 136,
                'created_at' => '2026-03-24 20:25:09',
                'updated_at' => '2026-03-24 20:25:09'
            ],
            [
                'id_user_permission' => 1310,
                'id_user' => 38,
                'id_permission' => 137,
                'created_at' => '2026-03-24 20:25:11',
                'updated_at' => '2026-03-24 20:25:11'
            ],
            [
                'id_user_permission' => 1311,
                'id_user' => 38,
                'id_permission' => 138,
                'created_at' => '2026-03-24 20:25:11',
                'updated_at' => '2026-03-24 20:25:11'
            ],
            [
                'id_user_permission' => 1312,
                'id_user' => 56,
                'id_permission' => 211,
                'created_at' => '2026-03-24 20:25:21',
                'updated_at' => '2026-03-24 20:25:21'
            ],
            [
                'id_user_permission' => 1313,
                'id_user' => 56,
                'id_permission' => 212,
                'created_at' => '2026-03-24 20:25:24',
                'updated_at' => '2026-03-24 20:25:24'
            ],
            [
                'id_user_permission' => 1314,
                'id_user' => 56,
                'id_permission' => 215,
                'created_at' => '2026-03-24 20:25:31',
                'updated_at' => '2026-03-24 20:25:31'
            ],
            [
                'id_user_permission' => 1315,
                'id_user' => 56,
                'id_permission' => 216,
                'created_at' => '2026-03-24 20:25:33',
                'updated_at' => '2026-03-24 20:25:33'
            ],
            [
                'id_user_permission' => 1316,
                'id_user' => 56,
                'id_permission' => 246,
                'created_at' => '2026-03-24 20:25:44',
                'updated_at' => '2026-03-24 20:25:44'
            ],
            [
                'id_user_permission' => 1317,
                'id_user' => 38,
                'id_permission' => 141,
                'created_at' => '2026-03-24 20:26:20',
                'updated_at' => '2026-03-24 20:26:20'
            ],
            [
                'id_user_permission' => 1318,
                'id_user' => 38,
                'id_permission' => 142,
                'created_at' => '2026-03-24 20:26:22',
                'updated_at' => '2026-03-24 20:26:22'
            ],
            [
                'id_user_permission' => 1319,
                'id_user' => 38,
                'id_permission' => 143,
                'created_at' => '2026-03-24 20:26:22',
                'updated_at' => '2026-03-24 20:26:22'
            ],
            [
                'id_user_permission' => 1320,
                'id_user' => 38,
                'id_permission' => 144,
                'created_at' => '2026-03-24 20:26:22',
                'updated_at' => '2026-03-24 20:26:22'
            ],
            [
                'id_user_permission' => 1321,
                'id_user' => 38,
                'id_permission' => 145,
                'created_at' => '2026-03-24 20:26:22',
                'updated_at' => '2026-03-24 20:26:22'
            ],
            [
                'id_user_permission' => 1322,
                'id_user' => 48,
                'id_permission' => 19,
                'created_at' => '2026-03-24 20:30:01',
                'updated_at' => '2026-03-24 20:30:01'
            ],
            [
                'id_user_permission' => 1323,
                'id_user' => 48,
                'id_permission' => 20,
                'created_at' => '2026-03-24 20:30:01',
                'updated_at' => '2026-03-24 20:30:01'
            ],
            [
                'id_user_permission' => 1324,
                'id_user' => 48,
                'id_permission' => 21,
                'created_at' => '2026-03-24 20:30:01',
                'updated_at' => '2026-03-24 20:30:01'
            ],
            [
                'id_user_permission' => 1325,
                'id_user' => 48,
                'id_permission' => 22,
                'created_at' => '2026-03-24 20:30:01',
                'updated_at' => '2026-03-24 20:30:01'
            ],
            [
                'id_user_permission' => 1326,
                'id_user' => 48,
                'id_permission' => 43,
                'created_at' => '2026-03-24 20:30:17',
                'updated_at' => '2026-03-24 20:30:17'
            ],
            [
                'id_user_permission' => 1327,
                'id_user' => 48,
                'id_permission' => 44,
                'created_at' => '2026-03-24 20:30:17',
                'updated_at' => '2026-03-24 20:30:17'
            ],
            [
                'id_user_permission' => 1328,
                'id_user' => 48,
                'id_permission' => 45,
                'created_at' => '2026-03-24 20:30:17',
                'updated_at' => '2026-03-24 20:30:17'
            ],
            [
                'id_user_permission' => 1329,
                'id_user' => 48,
                'id_permission' => 46,
                'created_at' => '2026-03-24 20:30:17',
                'updated_at' => '2026-03-24 20:30:17'
            ],
            [
                'id_user_permission' => 1330,
                'id_user' => 48,
                'id_permission' => 47,
                'created_at' => '2026-03-24 20:30:22',
                'updated_at' => '2026-03-24 20:30:22'
            ],
            [
                'id_user_permission' => 1331,
                'id_user' => 48,
                'id_permission' => 51,
                'created_at' => '2026-03-24 20:30:23',
                'updated_at' => '2026-03-24 20:30:23'
            ],
            [
                'id_user_permission' => 1332,
                'id_user' => 38,
                'id_permission' => 146,
                'created_at' => '2026-03-24 20:30:49',
                'updated_at' => '2026-03-24 20:30:49'
            ],
            [
                'id_user_permission' => 1333,
                'id_user' => 38,
                'id_permission' => 147,
                'created_at' => '2026-03-24 20:30:50',
                'updated_at' => '2026-03-24 20:30:50'
            ],
            [
                'id_user_permission' => 1334,
                'id_user' => 48,
                'id_permission' => 73,
                'created_at' => '2026-03-24 20:31:00',
                'updated_at' => '2026-03-24 20:31:00'
            ],
            [
                'id_user_permission' => 1335,
                'id_user' => 48,
                'id_permission' => 76,
                'created_at' => '2026-03-24 20:31:06',
                'updated_at' => '2026-03-24 20:31:06'
            ],
            [
                'id_user_permission' => 1336,
                'id_user' => 38,
                'id_permission' => 148,
                'created_at' => '2026-03-24 20:31:12',
                'updated_at' => '2026-03-24 20:31:12'
            ],
            [
                'id_user_permission' => 1337,
                'id_user' => 38,
                'id_permission' => 149,
                'created_at' => '2026-03-24 20:31:13',
                'updated_at' => '2026-03-24 20:31:13'
            ],
            [
                'id_user_permission' => 1338,
                'id_user' => 38,
                'id_permission' => 150,
                'created_at' => '2026-03-24 20:31:15',
                'updated_at' => '2026-03-24 20:31:15'
            ],
            [
                'id_user_permission' => 1339,
                'id_user' => 38,
                'id_permission' => 151,
                'created_at' => '2026-03-24 20:31:16',
                'updated_at' => '2026-03-24 20:31:16'
            ],
            [
                'id_user_permission' => 1340,
                'id_user' => 48,
                'id_permission' => 88,
                'created_at' => '2026-03-24 20:31:17',
                'updated_at' => '2026-03-24 20:31:17'
            ],
            [
                'id_user_permission' => 1341,
                'id_user' => 48,
                'id_permission' => 95,
                'created_at' => '2026-03-24 20:31:24',
                'updated_at' => '2026-03-24 20:31:24'
            ],
            [
                'id_user_permission' => 1342,
                'id_user' => 48,
                'id_permission' => 96,
                'created_at' => '2026-03-24 20:31:25',
                'updated_at' => '2026-03-24 20:31:25'
            ],
            [
                'id_user_permission' => 1343,
                'id_user' => 48,
                'id_permission' => 97,
                'created_at' => '2026-03-24 20:31:25',
                'updated_at' => '2026-03-24 20:31:25'
            ],
            [
                'id_user_permission' => 1344,
                'id_user' => 48,
                'id_permission' => 98,
                'created_at' => '2026-03-24 20:31:25',
                'updated_at' => '2026-03-24 20:31:25'
            ],
            [
                'id_user_permission' => 1345,
                'id_user' => 38,
                'id_permission' => 157,
                'created_at' => '2026-03-24 20:31:25',
                'updated_at' => '2026-03-24 20:31:25'
            ],
            [
                'id_user_permission' => 1346,
                'id_user' => 38,
                'id_permission' => 158,
                'created_at' => '2026-03-24 20:31:26',
                'updated_at' => '2026-03-24 20:31:26'
            ],
            [
                'id_user_permission' => 1347,
                'id_user' => 48,
                'id_permission' => 99,
                'created_at' => '2026-03-24 20:31:28',
                'updated_at' => '2026-03-24 20:31:28'
            ],
            [
                'id_user_permission' => 1348,
                'id_user' => 48,
                'id_permission' => 105,
                'created_at' => '2026-03-24 20:31:35',
                'updated_at' => '2026-03-24 20:31:35'
            ],
            [
                'id_user_permission' => 1349,
                'id_user' => 38,
                'id_permission' => 223,
                'created_at' => '2026-03-24 20:31:42',
                'updated_at' => '2026-03-24 20:31:42'
            ],
            [
                'id_user_permission' => 1350,
                'id_user' => 48,
                'id_permission' => 109,
                'created_at' => '2026-03-24 20:32:05',
                'updated_at' => '2026-03-24 20:32:05'
            ],
            [
                'id_user_permission' => 1351,
                'id_user' => 48,
                'id_permission' => 117,
                'created_at' => '2026-03-24 20:32:17',
                'updated_at' => '2026-03-24 20:32:17'
            ],
            [
                'id_user_permission' => 1352,
                'id_user' => 48,
                'id_permission' => 118,
                'created_at' => '2026-03-24 20:32:18',
                'updated_at' => '2026-03-24 20:32:18'
            ],
            [
                'id_user_permission' => 1353,
                'id_user' => 48,
                'id_permission' => 125,
                'created_at' => '2026-03-24 20:32:26',
                'updated_at' => '2026-03-24 20:32:26'
            ],
            [
                'id_user_permission' => 1354,
                'id_user' => 48,
                'id_permission' => 126,
                'created_at' => '2026-03-24 20:32:28',
                'updated_at' => '2026-03-24 20:32:28'
            ],
            [
                'id_user_permission' => 1355,
                'id_user' => 49,
                'id_permission' => 1,
                'created_at' => '2026-03-24 20:32:30',
                'updated_at' => '2026-03-24 20:32:30'
            ],
            [
                'id_user_permission' => 1356,
                'id_user' => 48,
                'id_permission' => 163,
                'created_at' => '2026-03-24 20:34:38',
                'updated_at' => '2026-03-24 20:34:38'
            ],
            [
                'id_user_permission' => 1357,
                'id_user' => 48,
                'id_permission' => 164,
                'created_at' => '2026-03-24 20:34:39',
                'updated_at' => '2026-03-24 20:34:39'
            ],
            [
                'id_user_permission' => 1358,
                'id_user' => 48,
                'id_permission' => 127,
                'created_at' => '2026-03-24 20:35:03',
                'updated_at' => '2026-03-24 20:35:03'
            ],
            [
                'id_user_permission' => 1359,
                'id_user' => 49,
                'id_permission' => 13,
                'created_at' => '2026-03-24 20:35:57',
                'updated_at' => '2026-03-24 20:35:57'
            ],
            [
                'id_user_permission' => 1360,
                'id_user' => 49,
                'id_permission' => 14,
                'created_at' => '2026-03-24 20:35:59',
                'updated_at' => '2026-03-24 20:35:59'
            ],
            [
                'id_user_permission' => 1361,
                'id_user' => 49,
                'id_permission' => 15,
                'created_at' => '2026-03-24 20:35:59',
                'updated_at' => '2026-03-24 20:35:59'
            ],
            [
                'id_user_permission' => 1362,
                'id_user' => 49,
                'id_permission' => 16,
                'created_at' => '2026-03-24 20:36:02',
                'updated_at' => '2026-03-24 20:36:02'
            ],
            [
                'id_user_permission' => 1363,
                'id_user' => 49,
                'id_permission' => 19,
                'created_at' => '2026-03-24 20:36:42',
                'updated_at' => '2026-03-24 20:36:42'
            ],
            [
                'id_user_permission' => 1364,
                'id_user' => 49,
                'id_permission' => 23,
                'created_at' => '2026-03-24 20:36:48',
                'updated_at' => '2026-03-24 20:36:48'
            ],
            [
                'id_user_permission' => 1365,
                'id_user' => 49,
                'id_permission' => 39,
                'created_at' => '2026-03-24 20:36:57',
                'updated_at' => '2026-03-24 20:36:57'
            ],
            [
                'id_user_permission' => 1366,
                'id_user' => 49,
                'id_permission' => 40,
                'created_at' => '2026-03-24 20:36:58',
                'updated_at' => '2026-03-24 20:36:58'
            ],
            [
                'id_user_permission' => 1367,
                'id_user' => 49,
                'id_permission' => 41,
                'created_at' => '2026-03-24 20:36:58',
                'updated_at' => '2026-03-24 20:36:58'
            ],
            [
                'id_user_permission' => 1368,
                'id_user' => 49,
                'id_permission' => 42,
                'created_at' => '2026-03-24 20:36:58',
                'updated_at' => '2026-03-24 20:36:58'
            ],
            [
                'id_user_permission' => 1369,
                'id_user' => 49,
                'id_permission' => 59,
                'created_at' => '2026-03-24 20:37:10',
                'updated_at' => '2026-03-24 20:37:10'
            ],
            [
                'id_user_permission' => 1370,
                'id_user' => 49,
                'id_permission' => 63,
                'created_at' => '2026-03-24 20:37:16',
                'updated_at' => '2026-03-24 20:37:16'
            ],
            [
                'id_user_permission' => 1373,
                'id_user' => 49,
                'id_permission' => 79,
                'created_at' => '2026-03-24 20:37:30',
                'updated_at' => '2026-03-24 20:37:30'
            ],
            [
                'id_user_permission' => 1374,
                'id_user' => 49,
                'id_permission' => 80,
                'created_at' => '2026-03-24 20:37:30',
                'updated_at' => '2026-03-24 20:37:30'
            ],
            [
                'id_user_permission' => 1375,
                'id_user' => 49,
                'id_permission' => 81,
                'created_at' => '2026-03-24 20:37:30',
                'updated_at' => '2026-03-24 20:37:30'
            ],
            [
                'id_user_permission' => 1376,
                'id_user' => 49,
                'id_permission' => 82,
                'created_at' => '2026-03-24 20:37:39',
                'updated_at' => '2026-03-24 20:37:39'
            ],
            [
                'id_user_permission' => 1377,
                'id_user' => 49,
                'id_permission' => 83,
                'created_at' => '2026-03-24 20:37:42',
                'updated_at' => '2026-03-24 20:37:42'
            ],
            [
                'id_user_permission' => 1378,
                'id_user' => 49,
                'id_permission' => 84,
                'created_at' => '2026-03-24 20:37:42',
                'updated_at' => '2026-03-24 20:37:42'
            ],
            [
                'id_user_permission' => 1379,
                'id_user' => 49,
                'id_permission' => 85,
                'created_at' => '2026-03-24 20:37:42',
                'updated_at' => '2026-03-24 20:37:42'
            ],
            [
                'id_user_permission' => 1380,
                'id_user' => 49,
                'id_permission' => 86,
                'created_at' => '2026-03-24 20:37:49',
                'updated_at' => '2026-03-24 20:37:49'
            ],
            [
                'id_user_permission' => 1381,
                'id_user' => 48,
                'id_permission' => 173,
                'created_at' => '2026-03-24 20:37:51',
                'updated_at' => '2026-03-24 20:37:51'
            ],
            [
                'id_user_permission' => 1382,
                'id_user' => 49,
                'id_permission' => 87,
                'created_at' => '2026-03-24 20:37:51',
                'updated_at' => '2026-03-24 20:37:51'
            ],
            [
                'id_user_permission' => 1383,
                'id_user' => 48,
                'id_permission' => 244,
                'created_at' => '2026-03-24 20:38:02',
                'updated_at' => '2026-03-24 20:38:02'
            ],
            [
                'id_user_permission' => 1384,
                'id_user' => 49,
                'id_permission' => 89,
                'created_at' => '2026-03-24 20:38:07',
                'updated_at' => '2026-03-24 20:38:07'
            ],
            [
                'id_user_permission' => 1385,
                'id_user' => 49,
                'id_permission' => 90,
                'created_at' => '2026-03-24 20:38:08',
                'updated_at' => '2026-03-24 20:38:08'
            ],
            [
                'id_user_permission' => 1386,
                'id_user' => 49,
                'id_permission' => 91,
                'created_at' => '2026-03-24 20:38:09',
                'updated_at' => '2026-03-24 20:38:09'
            ],
            [
                'id_user_permission' => 1387,
                'id_user' => 49,
                'id_permission' => 92,
                'created_at' => '2026-03-24 20:38:09',
                'updated_at' => '2026-03-24 20:38:09'
            ],
            [
                'id_user_permission' => 1388,
                'id_user' => 49,
                'id_permission' => 93,
                'created_at' => '2026-03-24 20:38:09',
                'updated_at' => '2026-03-24 20:38:09'
            ],
            [
                'id_user_permission' => 1389,
                'id_user' => 49,
                'id_permission' => 94,
                'created_at' => '2026-03-24 20:38:15',
                'updated_at' => '2026-03-24 20:38:15'
            ],
            [
                'id_user_permission' => 1390,
                'id_user' => 48,
                'id_permission' => 180,
                'created_at' => '2026-03-24 20:38:18',
                'updated_at' => '2026-03-24 20:38:18'
            ],
            [
                'id_user_permission' => 1391,
                'id_user' => 48,
                'id_permission' => 184,
                'created_at' => '2026-03-24 20:38:25',
                'updated_at' => '2026-03-24 20:38:25'
            ],
            [
                'id_user_permission' => 1392,
                'id_user' => 49,
                'id_permission' => 111,
                'created_at' => '2026-03-24 20:38:25',
                'updated_at' => '2026-03-24 20:38:25'
            ],
            [
                'id_user_permission' => 1393,
                'id_user' => 49,
                'id_permission' => 112,
                'created_at' => '2026-03-24 20:38:27',
                'updated_at' => '2026-03-24 20:38:27'
            ],
            [
                'id_user_permission' => 1394,
                'id_user' => 48,
                'id_permission' => 193,
                'created_at' => '2026-03-24 20:38:31',
                'updated_at' => '2026-03-24 20:38:31'
            ],
            [
                'id_user_permission' => 1397,
                'id_user' => 48,
                'id_permission' => 246,
                'created_at' => '2026-03-24 20:38:43',
                'updated_at' => '2026-03-24 20:38:43'
            ],
            [
                'id_user_permission' => 1405,
                'id_user' => 48,
                'id_permission' => 247,
                'created_at' => '2026-03-24 20:38:55',
                'updated_at' => '2026-03-24 20:38:55'
            ],
            [
                'id_user_permission' => 1417,
                'id_user' => 47,
                'id_permission' => 1,
                'created_at' => '2026-03-24 20:39:23',
                'updated_at' => '2026-03-24 20:39:23'
            ],
            [
                'id_user_permission' => 1418,
                'id_user' => 47,
                'id_permission' => 5,
                'created_at' => '2026-03-24 20:39:25',
                'updated_at' => '2026-03-24 20:39:25'
            ],
            [
                'id_user_permission' => 1419,
                'id_user' => 47,
                'id_permission' => 9,
                'created_at' => '2026-03-24 20:39:25',
                'updated_at' => '2026-03-24 20:39:25'
            ],
            [
                'id_user_permission' => 1421,
                'id_user' => 47,
                'id_permission' => 13,
                'created_at' => '2026-03-24 20:39:34',
                'updated_at' => '2026-03-24 20:39:34'
            ],
            [
                'id_user_permission' => 1422,
                'id_user' => 47,
                'id_permission' => 14,
                'created_at' => '2026-03-24 20:39:34',
                'updated_at' => '2026-03-24 20:39:34'
            ],
            [
                'id_user_permission' => 1423,
                'id_user' => 47,
                'id_permission' => 15,
                'created_at' => '2026-03-24 20:39:34',
                'updated_at' => '2026-03-24 20:39:34'
            ],
            [
                'id_user_permission' => 1424,
                'id_user' => 47,
                'id_permission' => 16,
                'created_at' => '2026-03-24 20:39:34',
                'updated_at' => '2026-03-24 20:39:34'
            ],
            [
                'id_user_permission' => 1425,
                'id_user' => 47,
                'id_permission' => 17,
                'created_at' => '2026-03-24 20:39:34',
                'updated_at' => '2026-03-24 20:39:34'
            ],
            [
                'id_user_permission' => 1426,
                'id_user' => 47,
                'id_permission' => 18,
                'created_at' => '2026-03-24 20:39:34',
                'updated_at' => '2026-03-24 20:39:34'
            ],
            [
                'id_user_permission' => 1427,
                'id_user' => 47,
                'id_permission' => 230,
                'created_at' => '2026-03-24 20:39:34',
                'updated_at' => '2026-03-24 20:39:34'
            ],
            [
                'id_user_permission' => 1428,
                'id_user' => 47,
                'id_permission' => 19,
                'created_at' => '2026-03-24 20:39:38',
                'updated_at' => '2026-03-24 20:39:38'
            ],
            [
                'id_user_permission' => 1429,
                'id_user' => 47,
                'id_permission' => 20,
                'created_at' => '2026-03-24 20:39:38',
                'updated_at' => '2026-03-24 20:39:38'
            ],
            [
                'id_user_permission' => 1430,
                'id_user' => 47,
                'id_permission' => 21,
                'created_at' => '2026-03-24 20:39:38',
                'updated_at' => '2026-03-24 20:39:38'
            ],
            [
                'id_user_permission' => 1431,
                'id_user' => 47,
                'id_permission' => 22,
                'created_at' => '2026-03-24 20:39:38',
                'updated_at' => '2026-03-24 20:39:38'
            ],
            [
                'id_user_permission' => 1434,
                'id_user' => 47,
                'id_permission' => 23,
                'created_at' => '2026-03-24 20:39:46',
                'updated_at' => '2026-03-24 20:39:46'
            ],
            [
                'id_user_permission' => 1435,
                'id_user' => 47,
                'id_permission' => 24,
                'created_at' => '2026-03-24 20:39:46',
                'updated_at' => '2026-03-24 20:39:46'
            ],
            [
                'id_user_permission' => 1436,
                'id_user' => 47,
                'id_permission' => 25,
                'created_at' => '2026-03-24 20:39:46',
                'updated_at' => '2026-03-24 20:39:46'
            ],
            [
                'id_user_permission' => 1437,
                'id_user' => 47,
                'id_permission' => 26,
                'created_at' => '2026-03-24 20:39:46',
                'updated_at' => '2026-03-24 20:39:46'
            ],
            [
                'id_user_permission' => 1438,
                'id_user' => 49,
                'id_permission' => 223,
                'created_at' => '2026-03-24 20:39:54',
                'updated_at' => '2026-03-24 20:39:54'
            ],
            [
                'id_user_permission' => 1439,
                'id_user' => 47,
                'id_permission' => 35,
                'created_at' => '2026-03-24 20:40:13',
                'updated_at' => '2026-03-24 20:40:13'
            ],
            [
                'id_user_permission' => 1440,
                'id_user' => 47,
                'id_permission' => 39,
                'created_at' => '2026-03-24 20:40:19',
                'updated_at' => '2026-03-24 20:40:19'
            ],
            [
                'id_user_permission' => 1441,
                'id_user' => 47,
                'id_permission' => 40,
                'created_at' => '2026-03-24 20:40:19',
                'updated_at' => '2026-03-24 20:40:19'
            ],
            [
                'id_user_permission' => 1442,
                'id_user' => 47,
                'id_permission' => 41,
                'created_at' => '2026-03-24 20:40:19',
                'updated_at' => '2026-03-24 20:40:19'
            ],
            [
                'id_user_permission' => 1443,
                'id_user' => 47,
                'id_permission' => 42,
                'created_at' => '2026-03-24 20:40:19',
                'updated_at' => '2026-03-24 20:40:19'
            ],
            [
                'id_user_permission' => 1444,
                'id_user' => 47,
                'id_permission' => 231,
                'created_at' => '2026-03-24 20:40:19',
                'updated_at' => '2026-03-24 20:40:19'
            ],
            [
                'id_user_permission' => 1445,
                'id_user' => 47,
                'id_permission' => 232,
                'created_at' => '2026-03-24 20:40:19',
                'updated_at' => '2026-03-24 20:40:19'
            ],
            [
                'id_user_permission' => 1446,
                'id_user' => 47,
                'id_permission' => 43,
                'created_at' => '2026-03-24 20:40:27',
                'updated_at' => '2026-03-24 20:40:27'
            ],
            [
                'id_user_permission' => 1447,
                'id_user' => 47,
                'id_permission' => 44,
                'created_at' => '2026-03-24 20:40:27',
                'updated_at' => '2026-03-24 20:40:27'
            ],
            [
                'id_user_permission' => 1448,
                'id_user' => 47,
                'id_permission' => 45,
                'created_at' => '2026-03-24 20:40:27',
                'updated_at' => '2026-03-24 20:40:27'
            ],
            [
                'id_user_permission' => 1449,
                'id_user' => 47,
                'id_permission' => 46,
                'created_at' => '2026-03-24 20:40:27',
                'updated_at' => '2026-03-24 20:40:27'
            ],
            [
                'id_user_permission' => 1450,
                'id_user' => 42,
                'id_permission' => 1,
                'created_at' => '2026-03-24 20:40:33',
                'updated_at' => '2026-03-24 20:40:33'
            ],
            [
                'id_user_permission' => 1451,
                'id_user' => 47,
                'id_permission' => 47,
                'created_at' => '2026-03-24 20:40:33',
                'updated_at' => '2026-03-24 20:40:33'
            ],
            [
                'id_user_permission' => 1452,
                'id_user' => 47,
                'id_permission' => 48,
                'created_at' => '2026-03-24 20:40:33',
                'updated_at' => '2026-03-24 20:40:33'
            ],
            [
                'id_user_permission' => 1453,
                'id_user' => 47,
                'id_permission' => 49,
                'created_at' => '2026-03-24 20:40:33',
                'updated_at' => '2026-03-24 20:40:33'
            ],
            [
                'id_user_permission' => 1454,
                'id_user' => 47,
                'id_permission' => 50,
                'created_at' => '2026-03-24 20:40:33',
                'updated_at' => '2026-03-24 20:40:33'
            ],
            [
                'id_user_permission' => 1455,
                'id_user' => 47,
                'id_permission' => 51,
                'created_at' => '2026-03-24 20:40:38',
                'updated_at' => '2026-03-24 20:40:38'
            ],
            [
                'id_user_permission' => 1456,
                'id_user' => 47,
                'id_permission' => 52,
                'created_at' => '2026-03-24 20:40:38',
                'updated_at' => '2026-03-24 20:40:38'
            ],
            [
                'id_user_permission' => 1457,
                'id_user' => 47,
                'id_permission' => 53,
                'created_at' => '2026-03-24 20:40:38',
                'updated_at' => '2026-03-24 20:40:38'
            ],
            [
                'id_user_permission' => 1458,
                'id_user' => 47,
                'id_permission' => 54,
                'created_at' => '2026-03-24 20:40:38',
                'updated_at' => '2026-03-24 20:40:38'
            ],
            [
                'id_user_permission' => 1459,
                'id_user' => 42,
                'id_permission' => 13,
                'created_at' => '2026-03-24 20:40:42',
                'updated_at' => '2026-03-24 20:40:42'
            ],
            [
                'id_user_permission' => 1460,
                'id_user' => 42,
                'id_permission' => 14,
                'created_at' => '2026-03-24 20:40:43',
                'updated_at' => '2026-03-24 20:40:43'
            ],
            [
                'id_user_permission' => 1461,
                'id_user' => 42,
                'id_permission' => 15,
                'created_at' => '2026-03-24 20:40:43',
                'updated_at' => '2026-03-24 20:40:43'
            ],
            [
                'id_user_permission' => 1462,
                'id_user' => 42,
                'id_permission' => 16,
                'created_at' => '2026-03-24 20:40:43',
                'updated_at' => '2026-03-24 20:40:43'
            ],
            [
                'id_user_permission' => 1463,
                'id_user' => 42,
                'id_permission' => 19,
                'created_at' => '2026-03-24 20:40:47',
                'updated_at' => '2026-03-24 20:40:47'
            ],
            [
                'id_user_permission' => 1464,
                'id_user' => 47,
                'id_permission' => 59,
                'created_at' => '2026-03-24 20:40:49',
                'updated_at' => '2026-03-24 20:40:49'
            ],
            [
                'id_user_permission' => 1465,
                'id_user' => 47,
                'id_permission' => 60,
                'created_at' => '2026-03-24 20:40:49',
                'updated_at' => '2026-03-24 20:40:49'
            ],
            [
                'id_user_permission' => 1466,
                'id_user' => 47,
                'id_permission' => 61,
                'created_at' => '2026-03-24 20:40:49',
                'updated_at' => '2026-03-24 20:40:49'
            ],
            [
                'id_user_permission' => 1467,
                'id_user' => 47,
                'id_permission' => 62,
                'created_at' => '2026-03-24 20:40:49',
                'updated_at' => '2026-03-24 20:40:49'
            ],
            [
                'id_user_permission' => 1468,
                'id_user' => 47,
                'id_permission' => 233,
                'created_at' => '2026-03-24 20:40:49',
                'updated_at' => '2026-03-24 20:40:49'
            ],
            [
                'id_user_permission' => 1469,
                'id_user' => 47,
                'id_permission' => 234,
                'created_at' => '2026-03-24 20:40:49',
                'updated_at' => '2026-03-24 20:40:49'
            ],
            [
                'id_user_permission' => 1470,
                'id_user' => 47,
                'id_permission' => 63,
                'created_at' => '2026-03-24 20:40:54',
                'updated_at' => '2026-03-24 20:40:54'
            ],
            [
                'id_user_permission' => 1471,
                'id_user' => 47,
                'id_permission' => 66,
                'created_at' => '2026-03-24 20:40:54',
                'updated_at' => '2026-03-24 20:40:54'
            ],
            [
                'id_user_permission' => 1472,
                'id_user' => 47,
                'id_permission' => 67,
                'created_at' => '2026-03-24 20:40:54',
                'updated_at' => '2026-03-24 20:40:54'
            ],
            [
                'id_user_permission' => 1473,
                'id_user' => 47,
                'id_permission' => 68,
                'created_at' => '2026-03-24 20:40:54',
                'updated_at' => '2026-03-24 20:40:54'
            ],
            [
                'id_user_permission' => 1474,
                'id_user' => 47,
                'id_permission' => 235,
                'created_at' => '2026-03-24 20:40:54',
                'updated_at' => '2026-03-24 20:40:54'
            ],
            [
                'id_user_permission' => 1475,
                'id_user' => 47,
                'id_permission' => 236,
                'created_at' => '2026-03-24 20:40:54',
                'updated_at' => '2026-03-24 20:40:54'
            ],
            [
                'id_user_permission' => 1476,
                'id_user' => 42,
                'id_permission' => 23,
                'created_at' => '2026-03-24 20:40:56',
                'updated_at' => '2026-03-24 20:40:56'
            ],
            [
                'id_user_permission' => 1477,
                'id_user' => 47,
                'id_permission' => 73,
                'created_at' => '2026-03-24 20:41:06',
                'updated_at' => '2026-03-24 20:41:06'
            ],
            [
                'id_user_permission' => 1478,
                'id_user' => 42,
                'id_permission' => 39,
                'created_at' => '2026-03-24 20:41:08',
                'updated_at' => '2026-03-24 20:41:08'
            ],
            [
                'id_user_permission' => 1479,
                'id_user' => 42,
                'id_permission' => 40,
                'created_at' => '2026-03-24 20:41:10',
                'updated_at' => '2026-03-24 20:41:10'
            ],
            [
                'id_user_permission' => 1480,
                'id_user' => 42,
                'id_permission' => 42,
                'created_at' => '2026-03-24 20:41:10',
                'updated_at' => '2026-03-24 20:41:10'
            ],
            [
                'id_user_permission' => 1481,
                'id_user' => 42,
                'id_permission' => 41,
                'created_at' => '2026-03-24 20:41:16',
                'updated_at' => '2026-03-24 20:41:16'
            ],
            [
                'id_user_permission' => 1482,
                'id_user' => 47,
                'id_permission' => 76,
                'created_at' => '2026-03-24 20:41:18',
                'updated_at' => '2026-03-24 20:41:18'
            ],
            [
                'id_user_permission' => 1483,
                'id_user' => 42,
                'id_permission' => 59,
                'created_at' => '2026-03-24 20:41:31',
                'updated_at' => '2026-03-24 20:41:31'
            ],
            [
                'id_user_permission' => 1484,
                'id_user' => 47,
                'id_permission' => 79,
                'created_at' => '2026-03-24 20:41:31',
                'updated_at' => '2026-03-24 20:41:31'
            ],
            [
                'id_user_permission' => 1485,
                'id_user' => 42,
                'id_permission' => 63,
                'created_at' => '2026-03-24 20:41:35',
                'updated_at' => '2026-03-24 20:41:35'
            ],
            [
                'id_user_permission' => 1486,
                'id_user' => 47,
                'id_permission' => 80,
                'created_at' => '2026-03-24 20:41:36',
                'updated_at' => '2026-03-24 20:41:36'
            ],
            [
                'id_user_permission' => 1487,
                'id_user' => 47,
                'id_permission' => 81,
                'created_at' => '2026-03-24 20:41:36',
                'updated_at' => '2026-03-24 20:41:36'
            ],
            [
                'id_user_permission' => 1488,
                'id_user' => 47,
                'id_permission' => 82,
                'created_at' => '2026-03-24 20:41:36',
                'updated_at' => '2026-03-24 20:41:36'
            ],
            [
                'id_user_permission' => 1489,
                'id_user' => 47,
                'id_permission' => 83,
                'created_at' => '2026-03-24 20:41:36',
                'updated_at' => '2026-03-24 20:41:36'
            ],
            [
                'id_user_permission' => 1490,
                'id_user' => 47,
                'id_permission' => 84,
                'created_at' => '2026-03-24 20:41:36',
                'updated_at' => '2026-03-24 20:41:36'
            ],
            [
                'id_user_permission' => 1491,
                'id_user' => 47,
                'id_permission' => 85,
                'created_at' => '2026-03-24 20:41:36',
                'updated_at' => '2026-03-24 20:41:36'
            ],
            [
                'id_user_permission' => 1492,
                'id_user' => 47,
                'id_permission' => 86,
                'created_at' => '2026-03-24 20:41:36',
                'updated_at' => '2026-03-24 20:41:36'
            ],
            [
                'id_user_permission' => 1493,
                'id_user' => 47,
                'id_permission' => 87,
                'created_at' => '2026-03-24 20:41:36',
                'updated_at' => '2026-03-24 20:41:36'
            ],
            [
                'id_user_permission' => 1494,
                'id_user' => 47,
                'id_permission' => 88,
                'created_at' => '2026-03-24 20:41:43',
                'updated_at' => '2026-03-24 20:41:43'
            ],
            [
                'id_user_permission' => 1495,
                'id_user' => 42,
                'id_permission' => 75,
                'created_at' => '2026-03-24 20:41:45',
                'updated_at' => '2026-03-24 20:41:45'
            ],
            [
                'id_user_permission' => 1496,
                'id_user' => 42,
                'id_permission' => 78,
                'created_at' => '2026-03-24 20:41:49',
                'updated_at' => '2026-03-24 20:41:49'
            ],
            [
                'id_user_permission' => 1497,
                'id_user' => 47,
                'id_permission' => 89,
                'created_at' => '2026-03-24 20:41:51',
                'updated_at' => '2026-03-24 20:41:51'
            ],
            [
                'id_user_permission' => 1498,
                'id_user' => 42,
                'id_permission' => 79,
                'created_at' => '2026-03-24 20:41:51',
                'updated_at' => '2026-03-24 20:41:51'
            ],
            [
                'id_user_permission' => 1499,
                'id_user' => 42,
                'id_permission' => 80,
                'created_at' => '2026-03-24 20:41:51',
                'updated_at' => '2026-03-24 20:41:51'
            ],
            [
                'id_user_permission' => 1500,
                'id_user' => 47,
                'id_permission' => 90,
                'created_at' => '2026-03-24 20:41:56',
                'updated_at' => '2026-03-24 20:41:56'
            ],
            [
                'id_user_permission' => 1501,
                'id_user' => 47,
                'id_permission' => 91,
                'created_at' => '2026-03-24 20:41:56',
                'updated_at' => '2026-03-24 20:41:56'
            ],
            [
                'id_user_permission' => 1502,
                'id_user' => 47,
                'id_permission' => 92,
                'created_at' => '2026-03-24 20:41:56',
                'updated_at' => '2026-03-24 20:41:56'
            ],
            [
                'id_user_permission' => 1503,
                'id_user' => 47,
                'id_permission' => 93,
                'created_at' => '2026-03-24 20:41:56',
                'updated_at' => '2026-03-24 20:41:56'
            ],
            [
                'id_user_permission' => 1504,
                'id_user' => 47,
                'id_permission' => 94,
                'created_at' => '2026-03-24 20:41:56',
                'updated_at' => '2026-03-24 20:41:56'
            ],
            [
                'id_user_permission' => 1505,
                'id_user' => 47,
                'id_permission' => 95,
                'created_at' => '2026-03-24 20:41:56',
                'updated_at' => '2026-03-24 20:41:56'
            ],
            [
                'id_user_permission' => 1506,
                'id_user' => 47,
                'id_permission' => 96,
                'created_at' => '2026-03-24 20:41:56',
                'updated_at' => '2026-03-24 20:41:56'
            ],
            [
                'id_user_permission' => 1507,
                'id_user' => 47,
                'id_permission' => 97,
                'created_at' => '2026-03-24 20:41:56',
                'updated_at' => '2026-03-24 20:41:56'
            ],
            [
                'id_user_permission' => 1508,
                'id_user' => 42,
                'id_permission' => 81,
                'created_at' => '2026-03-24 20:41:59',
                'updated_at' => '2026-03-24 20:41:59'
            ],
            [
                'id_user_permission' => 1509,
                'id_user' => 42,
                'id_permission' => 82,
                'created_at' => '2026-03-24 20:42:00',
                'updated_at' => '2026-03-24 20:42:00'
            ],
            [
                'id_user_permission' => 1510,
                'id_user' => 42,
                'id_permission' => 83,
                'created_at' => '2026-03-24 20:42:00',
                'updated_at' => '2026-03-24 20:42:00'
            ],
            [
                'id_user_permission' => 1511,
                'id_user' => 47,
                'id_permission' => 98,
                'created_at' => '2026-03-24 20:42:02',
                'updated_at' => '2026-03-24 20:42:02'
            ],
            [
                'id_user_permission' => 1512,
                'id_user' => 47,
                'id_permission' => 99,
                'created_at' => '2026-03-24 20:42:02',
                'updated_at' => '2026-03-24 20:42:02'
            ],
            [
                'id_user_permission' => 1514,
                'id_user' => 42,
                'id_permission' => 84,
                'created_at' => '2026-03-24 20:42:04',
                'updated_at' => '2026-03-24 20:42:04'
            ],
            [
                'id_user_permission' => 1515,
                'id_user' => 42,
                'id_permission' => 85,
                'created_at' => '2026-03-24 20:42:05',
                'updated_at' => '2026-03-24 20:42:05'
            ],
            [
                'id_user_permission' => 1516,
                'id_user' => 42,
                'id_permission' => 86,
                'created_at' => '2026-03-24 20:42:05',
                'updated_at' => '2026-03-24 20:42:05'
            ],
            [
                'id_user_permission' => 1517,
                'id_user' => 42,
                'id_permission' => 87,
                'created_at' => '2026-03-24 20:42:08',
                'updated_at' => '2026-03-24 20:42:08'
            ],
            [
                'id_user_permission' => 1518,
                'id_user' => 42,
                'id_permission' => 90,
                'created_at' => '2026-03-24 20:42:09',
                'updated_at' => '2026-03-24 20:42:09'
            ],
            [
                'id_user_permission' => 1519,
                'id_user' => 47,
                'id_permission' => 105,
                'created_at' => '2026-03-24 20:42:14',
                'updated_at' => '2026-03-24 20:42:14'
            ],
            [
                'id_user_permission' => 1520,
                'id_user' => 47,
                'id_permission' => 109,
                'created_at' => '2026-03-24 20:42:25',
                'updated_at' => '2026-03-24 20:42:25'
            ],
            [
                'id_user_permission' => 1521,
                'id_user' => 47,
                'id_permission' => 110,
                'created_at' => '2026-03-24 20:42:31',
                'updated_at' => '2026-03-24 20:42:31'
            ],
            [
                'id_user_permission' => 1522,
                'id_user' => 47,
                'id_permission' => 111,
                'created_at' => '2026-03-24 20:42:31',
                'updated_at' => '2026-03-24 20:42:31'
            ],
            [
                'id_user_permission' => 1523,
                'id_user' => 47,
                'id_permission' => 112,
                'created_at' => '2026-03-24 20:42:31',
                'updated_at' => '2026-03-24 20:42:31'
            ],
            [
                'id_user_permission' => 1524,
                'id_user' => 42,
                'id_permission' => 89,
                'created_at' => '2026-03-24 20:42:33',
                'updated_at' => '2026-03-24 20:42:33'
            ],
            [
                'id_user_permission' => 1525,
                'id_user' => 47,
                'id_permission' => 117,
                'created_at' => '2026-03-24 20:42:37',
                'updated_at' => '2026-03-24 20:42:37'
            ],
            [
                'id_user_permission' => 1526,
                'id_user' => 47,
                'id_permission' => 118,
                'created_at' => '2026-03-24 20:42:40',
                'updated_at' => '2026-03-24 20:42:40'
            ],
            [
                'id_user_permission' => 1527,
                'id_user' => 42,
                'id_permission' => 91,
                'created_at' => '2026-03-24 20:42:44',
                'updated_at' => '2026-03-24 20:42:44'
            ],
            [
                'id_user_permission' => 1528,
                'id_user' => 47,
                'id_permission' => 125,
                'created_at' => '2026-03-24 20:42:45',
                'updated_at' => '2026-03-24 20:42:45'
            ],
            [
                'id_user_permission' => 1529,
                'id_user' => 42,
                'id_permission' => 94,
                'created_at' => '2026-03-24 20:42:46',
                'updated_at' => '2026-03-24 20:42:46'
            ],
            [
                'id_user_permission' => 1530,
                'id_user' => 42,
                'id_permission' => 93,
                'created_at' => '2026-03-24 20:42:46',
                'updated_at' => '2026-03-24 20:42:46'
            ],
            [
                'id_user_permission' => 1531,
                'id_user' => 47,
                'id_permission' => 126,
                'created_at' => '2026-03-24 20:42:47',
                'updated_at' => '2026-03-24 20:42:47'
            ],
            [
                'id_user_permission' => 1532,
                'id_user' => 42,
                'id_permission' => 92,
                'created_at' => '2026-03-24 20:42:48',
                'updated_at' => '2026-03-24 20:42:48'
            ],
            [
                'id_user_permission' => 1533,
                'id_user' => 47,
                'id_permission' => 127,
                'created_at' => '2026-03-24 20:42:54',
                'updated_at' => '2026-03-24 20:42:54'
            ],
            [
                'id_user_permission' => 1534,
                'id_user' => 47,
                'id_permission' => 130,
                'created_at' => '2026-03-24 20:43:03',
                'updated_at' => '2026-03-24 20:43:03'
            ],
            [
                'id_user_permission' => 1535,
                'id_user' => 47,
                'id_permission' => 131,
                'created_at' => '2026-03-24 20:43:06',
                'updated_at' => '2026-03-24 20:43:06'
            ],
            [
                'id_user_permission' => 1536,
                'id_user' => 47,
                'id_permission' => 132,
                'created_at' => '2026-03-24 20:43:06',
                'updated_at' => '2026-03-24 20:43:06'
            ],
            [
                'id_user_permission' => 1537,
                'id_user' => 47,
                'id_permission' => 133,
                'created_at' => '2026-03-24 20:43:06',
                'updated_at' => '2026-03-24 20:43:06'
            ],
            [
                'id_user_permission' => 1538,
                'id_user' => 47,
                'id_permission' => 134,
                'created_at' => '2026-03-24 20:43:06',
                'updated_at' => '2026-03-24 20:43:06'
            ],
            [
                'id_user_permission' => 1539,
                'id_user' => 47,
                'id_permission' => 135,
                'created_at' => '2026-03-24 20:43:06',
                'updated_at' => '2026-03-24 20:43:06'
            ],
            [
                'id_user_permission' => 1540,
                'id_user' => 42,
                'id_permission' => 111,
                'created_at' => '2026-03-24 20:43:07',
                'updated_at' => '2026-03-24 20:43:07'
            ],
            [
                'id_user_permission' => 1541,
                'id_user' => 42,
                'id_permission' => 112,
                'created_at' => '2026-03-24 20:43:08',
                'updated_at' => '2026-03-24 20:43:08'
            ],
            [
                'id_user_permission' => 1542,
                'id_user' => 47,
                'id_permission' => 136,
                'created_at' => '2026-03-24 20:43:11',
                'updated_at' => '2026-03-24 20:43:11'
            ],
            [
                'id_user_permission' => 1543,
                'id_user' => 47,
                'id_permission' => 137,
                'created_at' => '2026-03-24 20:43:13',
                'updated_at' => '2026-03-24 20:43:13'
            ],
            [
                'id_user_permission' => 1544,
                'id_user' => 47,
                'id_permission' => 138,
                'created_at' => '2026-03-24 20:43:13',
                'updated_at' => '2026-03-24 20:43:13'
            ],
            [
                'id_user_permission' => 1545,
                'id_user' => 47,
                'id_permission' => 139,
                'created_at' => '2026-03-24 20:43:13',
                'updated_at' => '2026-03-24 20:43:13'
            ],
            [
                'id_user_permission' => 1546,
                'id_user' => 47,
                'id_permission' => 140,
                'created_at' => '2026-03-24 20:43:16',
                'updated_at' => '2026-03-24 20:43:16'
            ],
            [
                'id_user_permission' => 1547,
                'id_user' => 47,
                'id_permission' => 141,
                'created_at' => '2026-03-24 20:43:17',
                'updated_at' => '2026-03-24 20:43:17'
            ],
            [
                'id_user_permission' => 1548,
                'id_user' => 47,
                'id_permission' => 142,
                'created_at' => '2026-03-24 20:43:17',
                'updated_at' => '2026-03-24 20:43:17'
            ],
            [
                'id_user_permission' => 1549,
                'id_user' => 47,
                'id_permission' => 143,
                'created_at' => '2026-03-24 20:43:20',
                'updated_at' => '2026-03-24 20:43:20'
            ],
            [
                'id_user_permission' => 1550,
                'id_user' => 47,
                'id_permission' => 144,
                'created_at' => '2026-03-24 20:43:22',
                'updated_at' => '2026-03-24 20:43:22'
            ],
            [
                'id_user_permission' => 1551,
                'id_user' => 47,
                'id_permission' => 145,
                'created_at' => '2026-03-24 20:43:22',
                'updated_at' => '2026-03-24 20:43:22'
            ],
            [
                'id_user_permission' => 1552,
                'id_user' => 42,
                'id_permission' => 129,
                'created_at' => '2026-03-24 20:43:24',
                'updated_at' => '2026-03-24 20:43:24'
            ],
            [
                'id_user_permission' => 1553,
                'id_user' => 47,
                'id_permission' => 146,
                'created_at' => '2026-03-24 20:43:25',
                'updated_at' => '2026-03-24 20:43:25'
            ],
            [
                'id_user_permission' => 1554,
                'id_user' => 42,
                'id_permission' => 130,
                'created_at' => '2026-03-24 20:43:26',
                'updated_at' => '2026-03-24 20:43:26'
            ],
            [
                'id_user_permission' => 1555,
                'id_user' => 42,
                'id_permission' => 131,
                'created_at' => '2026-03-24 20:43:26',
                'updated_at' => '2026-03-24 20:43:26'
            ],
            [
                'id_user_permission' => 1556,
                'id_user' => 42,
                'id_permission' => 132,
                'created_at' => '2026-03-24 20:43:26',
                'updated_at' => '2026-03-24 20:43:26'
            ],
            [
                'id_user_permission' => 1557,
                'id_user' => 42,
                'id_permission' => 133,
                'created_at' => '2026-03-24 20:43:26',
                'updated_at' => '2026-03-24 20:43:26'
            ],
            [
                'id_user_permission' => 1558,
                'id_user' => 42,
                'id_permission' => 134,
                'created_at' => '2026-03-24 20:43:29',
                'updated_at' => '2026-03-24 20:43:29'
            ],
            [
                'id_user_permission' => 1559,
                'id_user' => 42,
                'id_permission' => 135,
                'created_at' => '2026-03-24 20:43:34',
                'updated_at' => '2026-03-24 20:43:34'
            ],
            [
                'id_user_permission' => 1560,
                'id_user' => 42,
                'id_permission' => 136,
                'created_at' => '2026-03-24 20:43:34',
                'updated_at' => '2026-03-24 20:43:34'
            ],
            [
                'id_user_permission' => 1561,
                'id_user' => 42,
                'id_permission' => 137,
                'created_at' => '2026-03-24 20:43:34',
                'updated_at' => '2026-03-24 20:43:34'
            ],
            [
                'id_user_permission' => 1562,
                'id_user' => 42,
                'id_permission' => 138,
                'created_at' => '2026-03-24 20:43:34',
                'updated_at' => '2026-03-24 20:43:34'
            ],
            [
                'id_user_permission' => 1563,
                'id_user' => 47,
                'id_permission' => 147,
                'created_at' => '2026-03-24 20:44:36',
                'updated_at' => '2026-03-24 20:44:36'
            ],
            [
                'id_user_permission' => 1564,
                'id_user' => 47,
                'id_permission' => 148,
                'created_at' => '2026-03-24 20:44:37',
                'updated_at' => '2026-03-24 20:44:37'
            ],
            [
                'id_user_permission' => 1565,
                'id_user' => 47,
                'id_permission' => 149,
                'created_at' => '2026-03-24 20:44:37',
                'updated_at' => '2026-03-24 20:44:37'
            ],
            [
                'id_user_permission' => 1566,
                'id_user' => 47,
                'id_permission' => 150,
                'created_at' => '2026-03-24 20:44:37',
                'updated_at' => '2026-03-24 20:44:37'
            ],
            [
                'id_user_permission' => 1567,
                'id_user' => 47,
                'id_permission' => 151,
                'created_at' => '2026-03-24 20:44:40',
                'updated_at' => '2026-03-24 20:44:40'
            ],
            [
                'id_user_permission' => 1568,
                'id_user' => 47,
                'id_permission' => 157,
                'created_at' => '2026-03-24 20:44:47',
                'updated_at' => '2026-03-24 20:44:47'
            ],
            [
                'id_user_permission' => 1569,
                'id_user' => 42,
                'id_permission' => 141,
                'created_at' => '2026-03-24 20:44:47',
                'updated_at' => '2026-03-24 20:44:47'
            ],
            [
                'id_user_permission' => 1570,
                'id_user' => 42,
                'id_permission' => 142,
                'created_at' => '2026-03-24 20:44:49',
                'updated_at' => '2026-03-24 20:44:49'
            ],
            [
                'id_user_permission' => 1571,
                'id_user' => 42,
                'id_permission' => 143,
                'created_at' => '2026-03-24 20:44:49',
                'updated_at' => '2026-03-24 20:44:49'
            ],
            [
                'id_user_permission' => 1572,
                'id_user' => 42,
                'id_permission' => 144,
                'created_at' => '2026-03-24 20:44:49',
                'updated_at' => '2026-03-24 20:44:49'
            ],
            [
                'id_user_permission' => 1573,
                'id_user' => 42,
                'id_permission' => 145,
                'created_at' => '2026-03-24 20:44:49',
                'updated_at' => '2026-03-24 20:44:49'
            ],
            [
                'id_user_permission' => 1574,
                'id_user' => 42,
                'id_permission' => 146,
                'created_at' => '2026-03-24 20:44:49',
                'updated_at' => '2026-03-24 20:44:49'
            ],
            [
                'id_user_permission' => 1575,
                'id_user' => 47,
                'id_permission' => 158,
                'created_at' => '2026-03-24 20:44:49',
                'updated_at' => '2026-03-24 20:44:49'
            ],
            [
                'id_user_permission' => 1578,
                'id_user' => 42,
                'id_permission' => 148,
                'created_at' => '2026-03-24 20:44:55',
                'updated_at' => '2026-03-24 20:44:55'
            ],
            [
                'id_user_permission' => 1579,
                'id_user' => 42,
                'id_permission' => 149,
                'created_at' => '2026-03-24 20:44:57',
                'updated_at' => '2026-03-24 20:44:57'
            ],
            [
                'id_user_permission' => 1580,
                'id_user' => 47,
                'id_permission' => 163,
                'created_at' => '2026-03-24 20:44:59',
                'updated_at' => '2026-03-24 20:44:59'
            ],
            [
                'id_user_permission' => 1581,
                'id_user' => 47,
                'id_permission' => 164,
                'created_at' => '2026-03-24 20:45:12',
                'updated_at' => '2026-03-24 20:45:12'
            ],
            [
                'id_user_permission' => 1582,
                'id_user' => 47,
                'id_permission' => 171,
                'created_at' => '2026-03-24 20:45:12',
                'updated_at' => '2026-03-24 20:45:12'
            ],
            [
                'id_user_permission' => 1583,
                'id_user' => 47,
                'id_permission' => 172,
                'created_at' => '2026-03-24 20:45:12',
                'updated_at' => '2026-03-24 20:45:12'
            ],
            [
                'id_user_permission' => 1584,
                'id_user' => 42,
                'id_permission' => 147,
                'created_at' => '2026-03-24 20:45:16',
                'updated_at' => '2026-03-24 20:45:16'
            ],
            [
                'id_user_permission' => 1585,
                'id_user' => 42,
                'id_permission' => 150,
                'created_at' => '2026-03-24 20:45:16',
                'updated_at' => '2026-03-24 20:45:16'
            ],
            [
                'id_user_permission' => 1586,
                'id_user' => 42,
                'id_permission' => 151,
                'created_at' => '2026-03-24 20:45:16',
                'updated_at' => '2026-03-24 20:45:16'
            ],
            [
                'id_user_permission' => 1587,
                'id_user' => 42,
                'id_permission' => 157,
                'created_at' => '2026-03-24 20:45:16',
                'updated_at' => '2026-03-24 20:45:16'
            ],
            [
                'id_user_permission' => 1588,
                'id_user' => 47,
                'id_permission' => 173,
                'created_at' => '2026-03-24 20:45:21',
                'updated_at' => '2026-03-24 20:45:21'
            ],
            [
                'id_user_permission' => 1589,
                'id_user' => 42,
                'id_permission' => 158,
                'created_at' => '2026-03-24 20:45:51',
                'updated_at' => '2026-03-24 20:45:51'
            ],
            [
                'id_user_permission' => 1590,
                'id_user' => 47,
                'id_permission' => 237,
                'created_at' => '2026-03-24 20:45:55',
                'updated_at' => '2026-03-24 20:45:55'
            ],
            [
                'id_user_permission' => 1591,
                'id_user' => 47,
                'id_permission' => 239,
                'created_at' => '2026-03-24 20:45:57',
                'updated_at' => '2026-03-24 20:45:57'
            ],
            [
                'id_user_permission' => 1592,
                'id_user' => 47,
                'id_permission' => 240,
                'created_at' => '2026-03-24 20:45:57',
                'updated_at' => '2026-03-24 20:45:57'
            ],
            [
                'id_user_permission' => 1593,
                'id_user' => 47,
                'id_permission' => 241,
                'created_at' => '2026-03-24 20:45:59',
                'updated_at' => '2026-03-24 20:45:59'
            ],
            [
                'id_user_permission' => 1594,
                'id_user' => 47,
                'id_permission' => 242,
                'created_at' => '2026-03-24 20:46:04',
                'updated_at' => '2026-03-24 20:46:04'
            ],
            [
                'id_user_permission' => 1595,
                'id_user' => 47,
                'id_permission' => 243,
                'created_at' => '2026-03-24 20:46:08',
                'updated_at' => '2026-03-24 20:46:08'
            ],
            [
                'id_user_permission' => 1596,
                'id_user' => 47,
                'id_permission' => 244,
                'created_at' => '2026-03-24 20:46:10',
                'updated_at' => '2026-03-24 20:46:10'
            ],
            [
                'id_user_permission' => 1598,
                'id_user' => 47,
                'id_permission' => 180,
                'created_at' => '2026-03-24 20:46:27',
                'updated_at' => '2026-03-24 20:46:27'
            ],
            [
                'id_user_permission' => 1599,
                'id_user' => 47,
                'id_permission' => 181,
                'created_at' => '2026-03-24 20:46:27',
                'updated_at' => '2026-03-24 20:46:27'
            ],
            [
                'id_user_permission' => 1600,
                'id_user' => 47,
                'id_permission' => 182,
                'created_at' => '2026-03-24 20:46:27',
                'updated_at' => '2026-03-24 20:46:27'
            ],
            [
                'id_user_permission' => 1601,
                'id_user' => 47,
                'id_permission' => 183,
                'created_at' => '2026-03-24 20:46:27',
                'updated_at' => '2026-03-24 20:46:27'
            ],
            [
                'id_user_permission' => 1602,
                'id_user' => 47,
                'id_permission' => 184,
                'created_at' => '2026-03-24 20:46:33',
                'updated_at' => '2026-03-24 20:46:33'
            ],
            [
                'id_user_permission' => 1603,
                'id_user' => 47,
                'id_permission' => 191,
                'created_at' => '2026-03-24 20:46:44',
                'updated_at' => '2026-03-24 20:46:44'
            ],
            [
                'id_user_permission' => 1604,
                'id_user' => 47,
                'id_permission' => 192,
                'created_at' => '2026-03-24 20:46:44',
                'updated_at' => '2026-03-24 20:46:44'
            ],
            [
                'id_user_permission' => 1605,
                'id_user' => 47,
                'id_permission' => 193,
                'created_at' => '2026-03-24 20:46:49',
                'updated_at' => '2026-03-24 20:46:49'
            ],
            [
                'id_user_permission' => 1606,
                'id_user' => 47,
                'id_permission' => 198,
                'created_at' => '2026-03-24 20:47:01',
                'updated_at' => '2026-03-24 20:47:01'
            ],
            [
                'id_user_permission' => 1607,
                'id_user' => 47,
                'id_permission' => 197,
                'created_at' => '2026-03-24 20:47:07',
                'updated_at' => '2026-03-24 20:47:07'
            ],
            [
                'id_user_permission' => 1608,
                'id_user' => 47,
                'id_permission' => 207,
                'created_at' => '2026-03-24 20:47:14',
                'updated_at' => '2026-03-24 20:47:14'
            ],
            [
                'id_user_permission' => 1609,
                'id_user' => 47,
                'id_permission' => 208,
                'created_at' => '2026-03-24 20:47:21',
                'updated_at' => '2026-03-24 20:47:21'
            ],
            [
                'id_user_permission' => 1610,
                'id_user' => 42,
                'id_permission' => 223,
                'created_at' => '2026-03-24 20:47:22',
                'updated_at' => '2026-03-24 20:47:22'
            ],
            [
                'id_user_permission' => 1611,
                'id_user' => 47,
                'id_permission' => 219,
                'created_at' => '2026-03-24 20:47:29',
                'updated_at' => '2026-03-24 20:47:29'
            ],
            [
                'id_user_permission' => 1612,
                'id_user' => 47,
                'id_permission' => 220,
                'created_at' => '2026-03-24 20:47:29',
                'updated_at' => '2026-03-24 20:47:29'
            ],
            [
                'id_user_permission' => 1613,
                'id_user' => 47,
                'id_permission' => 246,
                'created_at' => '2026-03-24 20:47:29',
                'updated_at' => '2026-03-24 20:47:29'
            ],
            [
                'id_user_permission' => 1614,
                'id_user' => 47,
                'id_permission' => 222,
                'created_at' => '2026-03-24 20:47:51',
                'updated_at' => '2026-03-24 20:47:51'
            ],
            [
                'id_user_permission' => 1615,
                'id_user' => 47,
                'id_permission' => 223,
                'created_at' => '2026-03-24 20:47:56',
                'updated_at' => '2026-03-24 20:47:56'
            ],
            [
                'id_user_permission' => 1616,
                'id_user' => 47,
                'id_permission' => 247,
                'created_at' => '2026-03-24 20:48:01',
                'updated_at' => '2026-03-24 20:48:01'
            ],
            [
                'id_user_permission' => 1617,
                'id_user' => 47,
                'id_permission' => 254,
                'created_at' => '2026-03-24 20:48:53',
                'updated_at' => '2026-03-24 20:48:53'
            ],
            [
                'id_user_permission' => 1618,
                'id_user' => 61,
                'id_permission' => 1,
                'created_at' => '2026-03-24 20:49:30',
                'updated_at' => '2026-03-24 20:49:30'
            ],
            [
                'id_user_permission' => 1619,
                'id_user' => 20,
                'id_permission' => 1,
                'created_at' => '2026-03-24 20:49:35',
                'updated_at' => '2026-03-24 20:49:35'
            ],
            [
                'id_user_permission' => 1620,
                'id_user' => 61,
                'id_permission' => 13,
                'created_at' => '2026-03-24 20:49:36',
                'updated_at' => '2026-03-24 20:49:36'
            ],
            [
                'id_user_permission' => 1621,
                'id_user' => 61,
                'id_permission' => 14,
                'created_at' => '2026-03-24 20:49:38',
                'updated_at' => '2026-03-24 20:49:38'
            ],
            [
                'id_user_permission' => 1622,
                'id_user' => 20,
                'id_permission' => 5,
                'created_at' => '2026-03-24 20:49:39',
                'updated_at' => '2026-03-24 20:49:39'
            ],
            [
                'id_user_permission' => 1623,
                'id_user' => 20,
                'id_permission' => 9,
                'created_at' => '2026-03-24 20:49:39',
                'updated_at' => '2026-03-24 20:49:39'
            ],
            [
                'id_user_permission' => 1624,
                'id_user' => 20,
                'id_permission' => 13,
                'created_at' => '2026-03-24 20:49:39',
                'updated_at' => '2026-03-24 20:49:39'
            ],
            [
                'id_user_permission' => 1625,
                'id_user' => 61,
                'id_permission' => 15,
                'created_at' => '2026-03-24 20:49:40',
                'updated_at' => '2026-03-24 20:49:40'
            ],
            [
                'id_user_permission' => 1626,
                'id_user' => 61,
                'id_permission' => 16,
                'created_at' => '2026-03-24 20:49:41',
                'updated_at' => '2026-03-24 20:49:41'
            ],
            [
                'id_user_permission' => 1627,
                'id_user' => 20,
                'id_permission' => 19,
                'created_at' => '2026-03-24 20:49:44',
                'updated_at' => '2026-03-24 20:49:44'
            ],
            [
                'id_user_permission' => 1628,
                'id_user' => 61,
                'id_permission' => 19,
                'created_at' => '2026-03-24 20:49:46',
                'updated_at' => '2026-03-24 20:49:46'
            ],
            [
                'id_user_permission' => 1629,
                'id_user' => 20,
                'id_permission' => 23,
                'created_at' => '2026-03-24 20:49:49',
                'updated_at' => '2026-03-24 20:49:49'
            ],
            [
                'id_user_permission' => 1630,
                'id_user' => 20,
                'id_permission' => 27,
                'created_at' => '2026-03-24 20:49:49',
                'updated_at' => '2026-03-24 20:49:49'
            ],
            [
                'id_user_permission' => 1631,
                'id_user' => 61,
                'id_permission' => 23,
                'created_at' => '2026-03-24 20:49:50',
                'updated_at' => '2026-03-24 20:49:50'
            ],
            [
                'id_user_permission' => 1632,
                'id_user' => 20,
                'id_permission' => 31,
                'created_at' => '2026-03-24 20:49:53',
                'updated_at' => '2026-03-24 20:49:53'
            ],
            [
                'id_user_permission' => 1633,
                'id_user' => 20,
                'id_permission' => 35,
                'created_at' => '2026-03-24 20:49:55',
                'updated_at' => '2026-03-24 20:49:55'
            ],
            [
                'id_user_permission' => 1634,
                'id_user' => 20,
                'id_permission' => 39,
                'created_at' => '2026-03-24 20:49:59',
                'updated_at' => '2026-03-24 20:49:59'
            ],
            [
                'id_user_permission' => 1635,
                'id_user' => 61,
                'id_permission' => 39,
                'created_at' => '2026-03-24 20:49:59',
                'updated_at' => '2026-03-24 20:49:59'
            ],
            [
                'id_user_permission' => 1636,
                'id_user' => 61,
                'id_permission' => 40,
                'created_at' => '2026-03-24 20:50:01',
                'updated_at' => '2026-03-24 20:50:01'
            ],
            [
                'id_user_permission' => 1637,
                'id_user' => 61,
                'id_permission' => 41,
                'created_at' => '2026-03-24 20:50:01',
                'updated_at' => '2026-03-24 20:50:01'
            ],
            [
                'id_user_permission' => 1638,
                'id_user' => 61,
                'id_permission' => 42,
                'created_at' => '2026-03-24 20:50:01',
                'updated_at' => '2026-03-24 20:50:01'
            ],
            [
                'id_user_permission' => 1639,
                'id_user' => 20,
                'id_permission' => 43,
                'created_at' => '2026-03-24 20:50:05',
                'updated_at' => '2026-03-24 20:50:05'
            ],
            [
                'id_user_permission' => 1640,
                'id_user' => 20,
                'id_permission' => 47,
                'created_at' => '2026-03-24 20:50:11',
                'updated_at' => '2026-03-24 20:50:11'
            ],
            [
                'id_user_permission' => 1641,
                'id_user' => 61,
                'id_permission' => 59,
                'created_at' => '2026-03-24 20:50:14',
                'updated_at' => '2026-03-24 20:50:14'
            ],
            [
                'id_user_permission' => 1642,
                'id_user' => 20,
                'id_permission' => 51,
                'created_at' => '2026-03-24 20:50:15',
                'updated_at' => '2026-03-24 20:50:15'
            ],
            [
                'id_user_permission' => 1643,
                'id_user' => 61,
                'id_permission' => 63,
                'created_at' => '2026-03-24 20:50:19',
                'updated_at' => '2026-03-24 20:50:19'
            ],
            [
                'id_user_permission' => 1645,
                'id_user' => 20,
                'id_permission' => 55,
                'created_at' => '2026-03-24 20:50:25',
                'updated_at' => '2026-03-24 20:50:25'
            ],
            [
                'id_user_permission' => 1646,
                'id_user' => 20,
                'id_permission' => 59,
                'created_at' => '2026-03-24 20:50:30',
                'updated_at' => '2026-03-24 20:50:30'
            ],
            [
                'id_user_permission' => 1647,
                'id_user' => 20,
                'id_permission' => 63,
                'created_at' => '2026-03-24 20:50:36',
                'updated_at' => '2026-03-24 20:50:36'
            ],
            [
                'id_user_permission' => 1648,
                'id_user' => 20,
                'id_permission' => 73,
                'created_at' => '2026-03-24 20:50:42',
                'updated_at' => '2026-03-24 20:50:42'
            ],
            [
                'id_user_permission' => 1649,
                'id_user' => 20,
                'id_permission' => 76,
                'created_at' => '2026-03-24 20:50:50',
                'updated_at' => '2026-03-24 20:50:50'
            ],
            [
                'id_user_permission' => 1651,
                'id_user' => 61,
                'id_permission' => 79,
                'created_at' => '2026-03-24 20:51:03',
                'updated_at' => '2026-03-24 20:51:03'
            ],
            [
                'id_user_permission' => 1652,
                'id_user' => 61,
                'id_permission' => 80,
                'created_at' => '2026-03-24 20:51:03',
                'updated_at' => '2026-03-24 20:51:03'
            ],
            [
                'id_user_permission' => 1653,
                'id_user' => 61,
                'id_permission' => 81,
                'created_at' => '2026-03-24 20:51:03',
                'updated_at' => '2026-03-24 20:51:03'
            ],
            [
                'id_user_permission' => 1654,
                'id_user' => 20,
                'id_permission' => 83,
                'created_at' => '2026-03-24 20:51:04',
                'updated_at' => '2026-03-24 20:51:04'
            ],
            [
                'id_user_permission' => 1655,
                'id_user' => 61,
                'id_permission' => 82,
                'created_at' => '2026-03-24 20:51:05',
                'updated_at' => '2026-03-24 20:51:05'
            ],
            [
                'id_user_permission' => 1656,
                'id_user' => 61,
                'id_permission' => 83,
                'created_at' => '2026-03-24 20:51:07',
                'updated_at' => '2026-03-24 20:51:07'
            ],
            [
                'id_user_permission' => 1657,
                'id_user' => 61,
                'id_permission' => 85,
                'created_at' => '2026-03-24 20:51:07',
                'updated_at' => '2026-03-24 20:51:07'
            ],
            [
                'id_user_permission' => 1658,
                'id_user' => 61,
                'id_permission' => 84,
                'created_at' => '2026-03-24 20:51:09',
                'updated_at' => '2026-03-24 20:51:09'
            ],
            [
                'id_user_permission' => 1659,
                'id_user' => 61,
                'id_permission' => 86,
                'created_at' => '2026-03-24 20:51:15',
                'updated_at' => '2026-03-24 20:51:15'
            ],
            [
                'id_user_permission' => 1660,
                'id_user' => 61,
                'id_permission' => 87,
                'created_at' => '2026-03-24 20:51:17',
                'updated_at' => '2026-03-24 20:51:17'
            ],
            [
                'id_user_permission' => 1662,
                'id_user' => 61,
                'id_permission' => 89,
                'created_at' => '2026-03-24 20:51:22',
                'updated_at' => '2026-03-24 20:51:22'
            ],
            [
                'id_user_permission' => 1663,
                'id_user' => 61,
                'id_permission' => 90,
                'created_at' => '2026-03-24 20:51:25',
                'updated_at' => '2026-03-24 20:51:25'
            ],
            [
                'id_user_permission' => 1664,
                'id_user' => 61,
                'id_permission' => 91,
                'created_at' => '2026-03-24 20:51:26',
                'updated_at' => '2026-03-24 20:51:26'
            ],
            [
                'id_user_permission' => 1665,
                'id_user' => 61,
                'id_permission' => 92,
                'created_at' => '2026-03-24 20:51:26',
                'updated_at' => '2026-03-24 20:51:26'
            ],
            [
                'id_user_permission' => 1666,
                'id_user' => 20,
                'id_permission' => 89,
                'created_at' => '2026-03-24 20:51:27',
                'updated_at' => '2026-03-24 20:51:27'
            ],
            [
                'id_user_permission' => 1667,
                'id_user' => 61,
                'id_permission' => 93,
                'created_at' => '2026-03-24 20:51:30',
                'updated_at' => '2026-03-24 20:51:30'
            ],
            [
                'id_user_permission' => 1668,
                'id_user' => 61,
                'id_permission' => 94,
                'created_at' => '2026-03-24 20:51:32',
                'updated_at' => '2026-03-24 20:51:32'
            ],
            [
                'id_user_permission' => 1670,
                'id_user' => 20,
                'id_permission' => 94,
                'created_at' => '2026-03-24 20:51:40',
                'updated_at' => '2026-03-24 20:51:40'
            ],
            [
                'id_user_permission' => 1671,
                'id_user' => 61,
                'id_permission' => 111,
                'created_at' => '2026-03-24 20:51:41',
                'updated_at' => '2026-03-24 20:51:41'
            ],
            [
                'id_user_permission' => 1672,
                'id_user' => 61,
                'id_permission' => 112,
                'created_at' => '2026-03-24 20:51:42',
                'updated_at' => '2026-03-24 20:51:42'
            ],
            [
                'id_user_permission' => 1673,
                'id_user' => 20,
                'id_permission' => 98,
                'created_at' => '2026-03-24 20:51:44',
                'updated_at' => '2026-03-24 20:51:44'
            ],
            [
                'id_user_permission' => 1674,
                'id_user' => 20,
                'id_permission' => 99,
                'created_at' => '2026-03-24 20:51:50',
                'updated_at' => '2026-03-24 20:51:50'
            ],
            [
                'id_user_permission' => 1676,
                'id_user' => 61,
                'id_permission' => 130,
                'created_at' => '2026-03-24 20:51:56',
                'updated_at' => '2026-03-24 20:51:56'
            ],
            [
                'id_user_permission' => 1677,
                'id_user' => 61,
                'id_permission' => 131,
                'created_at' => '2026-03-24 20:51:56',
                'updated_at' => '2026-03-24 20:51:56'
            ],
            [
                'id_user_permission' => 1679,
                'id_user' => 61,
                'id_permission' => 133,
                'created_at' => '2026-03-24 20:52:00',
                'updated_at' => '2026-03-24 20:52:00'
            ],
            [
                'id_user_permission' => 1680,
                'id_user' => 61,
                'id_permission' => 134,
                'created_at' => '2026-03-24 20:52:00',
                'updated_at' => '2026-03-24 20:52:00'
            ],
            [
                'id_user_permission' => 1681,
                'id_user' => 61,
                'id_permission' => 135,
                'created_at' => '2026-03-24 20:52:00',
                'updated_at' => '2026-03-24 20:52:00'
            ],
            [
                'id_user_permission' => 1682,
                'id_user' => 20,
                'id_permission' => 102,
                'created_at' => '2026-03-24 20:52:04',
                'updated_at' => '2026-03-24 20:52:04'
            ],
            [
                'id_user_permission' => 1683,
                'id_user' => 61,
                'id_permission' => 136,
                'created_at' => '2026-03-24 20:52:05',
                'updated_at' => '2026-03-24 20:52:05'
            ],
            [
                'id_user_permission' => 1684,
                'id_user' => 20,
                'id_permission' => 103,
                'created_at' => '2026-03-24 20:52:07',
                'updated_at' => '2026-03-24 20:52:07'
            ],
            [
                'id_user_permission' => 1685,
                'id_user' => 61,
                'id_permission' => 137,
                'created_at' => '2026-03-24 20:52:07',
                'updated_at' => '2026-03-24 20:52:07'
            ],
            [
                'id_user_permission' => 1686,
                'id_user' => 61,
                'id_permission' => 138,
                'created_at' => '2026-03-24 20:52:07',
                'updated_at' => '2026-03-24 20:52:07'
            ],
            [
                'id_user_permission' => 1688,
                'id_user' => 20,
                'id_permission' => 104,
                'created_at' => '2026-03-24 20:52:11',
                'updated_at' => '2026-03-24 20:52:11'
            ],
            [
                'id_user_permission' => 1689,
                'id_user' => 20,
                'id_permission' => 105,
                'created_at' => '2026-03-24 20:52:14',
                'updated_at' => '2026-03-24 20:52:14'
            ],
            [
                'id_user_permission' => 1690,
                'id_user' => 61,
                'id_permission' => 141,
                'created_at' => '2026-03-24 20:52:25',
                'updated_at' => '2026-03-24 20:52:25'
            ],
            [
                'id_user_permission' => 1691,
                'id_user' => 61,
                'id_permission' => 142,
                'created_at' => '2026-03-24 20:52:29',
                'updated_at' => '2026-03-24 20:52:29'
            ],
            [
                'id_user_permission' => 1692,
                'id_user' => 61,
                'id_permission' => 143,
                'created_at' => '2026-03-24 20:52:29',
                'updated_at' => '2026-03-24 20:52:29'
            ],
            [
                'id_user_permission' => 1693,
                'id_user' => 61,
                'id_permission' => 144,
                'created_at' => '2026-03-24 20:52:29',
                'updated_at' => '2026-03-24 20:52:29'
            ],
            [
                'id_user_permission' => 1694,
                'id_user' => 61,
                'id_permission' => 145,
                'created_at' => '2026-03-24 20:52:29',
                'updated_at' => '2026-03-24 20:52:29'
            ],
            [
                'id_user_permission' => 1695,
                'id_user' => 61,
                'id_permission' => 146,
                'created_at' => '2026-03-24 20:52:29',
                'updated_at' => '2026-03-24 20:52:29'
            ],
            [
                'id_user_permission' => 1696,
                'id_user' => 61,
                'id_permission' => 147,
                'created_at' => '2026-03-24 20:52:47',
                'updated_at' => '2026-03-24 20:52:47'
            ],
            [
                'id_user_permission' => 1697,
                'id_user' => 61,
                'id_permission' => 148,
                'created_at' => '2026-03-24 20:52:49',
                'updated_at' => '2026-03-24 20:52:49'
            ],
            [
                'id_user_permission' => 1698,
                'id_user' => 61,
                'id_permission' => 149,
                'created_at' => '2026-03-24 20:53:40',
                'updated_at' => '2026-03-24 20:53:40'
            ],
            [
                'id_user_permission' => 1699,
                'id_user' => 61,
                'id_permission' => 150,
                'created_at' => '2026-03-24 20:53:42',
                'updated_at' => '2026-03-24 20:53:42'
            ],
            [
                'id_user_permission' => 1700,
                'id_user' => 61,
                'id_permission' => 151,
                'created_at' => '2026-03-24 20:53:49',
                'updated_at' => '2026-03-24 20:53:49'
            ],
            [
                'id_user_permission' => 1701,
                'id_user' => 61,
                'id_permission' => 157,
                'created_at' => '2026-03-24 20:54:18',
                'updated_at' => '2026-03-24 20:54:18'
            ],
            [
                'id_user_permission' => 1702,
                'id_user' => 61,
                'id_permission' => 158,
                'created_at' => '2026-03-24 20:54:22',
                'updated_at' => '2026-03-24 20:54:22'
            ],
            [
                'id_user_permission' => 1704,
                'id_user' => 49,
                'id_permission' => 5,
                'created_at' => '2026-03-24 20:59:03',
                'updated_at' => '2026-03-24 20:59:03'
            ],
            [
                'id_user_permission' => 1705,
                'id_user' => 49,
                'id_permission' => 9,
                'created_at' => '2026-03-24 20:59:05',
                'updated_at' => '2026-03-24 20:59:05'
            ],
            [
                'id_user_permission' => 1706,
                'id_user' => 49,
                'id_permission' => 35,
                'created_at' => '2026-03-24 20:59:17',
                'updated_at' => '2026-03-24 20:59:17'
            ],
            [
                'id_user_permission' => 1707,
                'id_user' => 49,
                'id_permission' => 43,
                'created_at' => '2026-03-24 20:59:24',
                'updated_at' => '2026-03-24 20:59:24'
            ],
            [
                'id_user_permission' => 1708,
                'id_user' => 49,
                'id_permission' => 44,
                'created_at' => '2026-03-24 20:59:24',
                'updated_at' => '2026-03-24 20:59:24'
            ],
            [
                'id_user_permission' => 1709,
                'id_user' => 49,
                'id_permission' => 45,
                'created_at' => '2026-03-24 20:59:24',
                'updated_at' => '2026-03-24 20:59:24'
            ],
            [
                'id_user_permission' => 1710,
                'id_user' => 49,
                'id_permission' => 46,
                'created_at' => '2026-03-24 20:59:24',
                'updated_at' => '2026-03-24 20:59:24'
            ],
            [
                'id_user_permission' => 1711,
                'id_user' => 49,
                'id_permission' => 73,
                'created_at' => '2026-03-24 20:59:40',
                'updated_at' => '2026-03-24 20:59:40'
            ],
            [
                'id_user_permission' => 1712,
                'id_user' => 49,
                'id_permission' => 76,
                'created_at' => '2026-03-24 20:59:46',
                'updated_at' => '2026-03-24 20:59:46'
            ],
            [
                'id_user_permission' => 1713,
                'id_user' => 49,
                'id_permission' => 105,
                'created_at' => '2026-03-24 21:00:00',
                'updated_at' => '2026-03-24 21:00:00'
            ],
            [
                'id_user_permission' => 1714,
                'id_user' => 49,
                'id_permission' => 95,
                'created_at' => '2026-03-24 21:00:11',
                'updated_at' => '2026-03-24 21:00:11'
            ],
            [
                'id_user_permission' => 1715,
                'id_user' => 49,
                'id_permission' => 96,
                'created_at' => '2026-03-24 21:00:13',
                'updated_at' => '2026-03-24 21:00:13'
            ],
            [
                'id_user_permission' => 1716,
                'id_user' => 49,
                'id_permission' => 97,
                'created_at' => '2026-03-24 21:00:13',
                'updated_at' => '2026-03-24 21:00:13'
            ],
            [
                'id_user_permission' => 1717,
                'id_user' => 49,
                'id_permission' => 98,
                'created_at' => '2026-03-24 21:00:14',
                'updated_at' => '2026-03-24 21:00:14'
            ],
            [
                'id_user_permission' => 1718,
                'id_user' => 49,
                'id_permission' => 99,
                'created_at' => '2026-03-24 21:00:15',
                'updated_at' => '2026-03-24 21:00:15'
            ],
            [
                'id_user_permission' => 1719,
                'id_user' => 49,
                'id_permission' => 109,
                'created_at' => '2026-03-24 21:00:25',
                'updated_at' => '2026-03-24 21:00:25'
            ],
            [
                'id_user_permission' => 1720,
                'id_user' => 49,
                'id_permission' => 110,
                'created_at' => '2026-03-24 21:00:26',
                'updated_at' => '2026-03-24 21:00:26'
            ],
            [
                'id_user_permission' => 1721,
                'id_user' => 49,
                'id_permission' => 117,
                'created_at' => '2026-03-24 21:00:31',
                'updated_at' => '2026-03-24 21:00:31'
            ],
            [
                'id_user_permission' => 1722,
                'id_user' => 49,
                'id_permission' => 118,
                'created_at' => '2026-03-24 21:00:32',
                'updated_at' => '2026-03-24 21:00:32'
            ],
            [
                'id_user_permission' => 1723,
                'id_user' => 36,
                'id_permission' => 1,
                'created_at' => '2026-03-24 21:01:00',
                'updated_at' => '2026-03-24 21:01:00'
            ],
            [
                'id_user_permission' => 1724,
                'id_user' => 36,
                'id_permission' => 13,
                'created_at' => '2026-03-24 21:01:09',
                'updated_at' => '2026-03-24 21:01:09'
            ],
            [
                'id_user_permission' => 1725,
                'id_user' => 36,
                'id_permission' => 14,
                'created_at' => '2026-03-24 21:01:10',
                'updated_at' => '2026-03-24 21:01:10'
            ],
            [
                'id_user_permission' => 1726,
                'id_user' => 36,
                'id_permission' => 15,
                'created_at' => '2026-03-24 21:01:10',
                'updated_at' => '2026-03-24 21:01:10'
            ],
            [
                'id_user_permission' => 1727,
                'id_user' => 36,
                'id_permission' => 16,
                'created_at' => '2026-03-24 21:01:12',
                'updated_at' => '2026-03-24 21:01:12'
            ],
            [
                'id_user_permission' => 1728,
                'id_user' => 36,
                'id_permission' => 19,
                'created_at' => '2026-03-24 21:01:16',
                'updated_at' => '2026-03-24 21:01:16'
            ],
            [
                'id_user_permission' => 1729,
                'id_user' => 36,
                'id_permission' => 23,
                'created_at' => '2026-03-24 21:01:19',
                'updated_at' => '2026-03-24 21:01:19'
            ],
            [
                'id_user_permission' => 1754,
                'id_user' => 36,
                'id_permission' => 40,
                'created_at' => '2026-03-24 21:01:26',
                'updated_at' => '2026-03-24 21:01:26'
            ],
            [
                'id_user_permission' => 1755,
                'id_user' => 36,
                'id_permission' => 39,
                'created_at' => '2026-03-24 21:01:27',
                'updated_at' => '2026-03-24 21:01:27'
            ],
            [
                'id_user_permission' => 1756,
                'id_user' => 36,
                'id_permission' => 41,
                'created_at' => '2026-03-24 21:01:27',
                'updated_at' => '2026-03-24 21:01:27'
            ],
            [
                'id_user_permission' => 1757,
                'id_user' => 36,
                'id_permission' => 42,
                'created_at' => '2026-03-24 21:01:30',
                'updated_at' => '2026-03-24 21:01:30'
            ],
            [
                'id_user_permission' => 1758,
                'id_user' => 49,
                'id_permission' => 127,
                'created_at' => '2026-03-24 21:01:36',
                'updated_at' => '2026-03-24 21:01:36'
            ],
            [
                'id_user_permission' => 1759,
                'id_user' => 49,
                'id_permission' => 130,
                'created_at' => '2026-03-24 21:01:44',
                'updated_at' => '2026-03-24 21:01:44'
            ],
            [
                'id_user_permission' => 1760,
                'id_user' => 49,
                'id_permission' => 131,
                'created_at' => '2026-03-24 21:01:45',
                'updated_at' => '2026-03-24 21:01:45'
            ],
            [
                'id_user_permission' => 1761,
                'id_user' => 36,
                'id_permission' => 59,
                'created_at' => '2026-03-24 21:01:45',
                'updated_at' => '2026-03-24 21:01:45'
            ],
            [
                'id_user_permission' => 1762,
                'id_user' => 49,
                'id_permission' => 132,
                'created_at' => '2026-03-24 21:01:45',
                'updated_at' => '2026-03-24 21:01:45'
            ],
            [
                'id_user_permission' => 1763,
                'id_user' => 49,
                'id_permission' => 133,
                'created_at' => '2026-03-24 21:01:47',
                'updated_at' => '2026-03-24 21:01:47'
            ],
            [
                'id_user_permission' => 1764,
                'id_user' => 49,
                'id_permission' => 134,
                'created_at' => '2026-03-24 21:01:48',
                'updated_at' => '2026-03-24 21:01:48'
            ],
            [
                'id_user_permission' => 1765,
                'id_user' => 36,
                'id_permission' => 63,
                'created_at' => '2026-03-24 21:01:49',
                'updated_at' => '2026-03-24 21:01:49'
            ],
            [
                'id_user_permission' => 1766,
                'id_user' => 49,
                'id_permission' => 135,
                'created_at' => '2026-03-24 21:01:50',
                'updated_at' => '2026-03-24 21:01:50'
            ],
            [
                'id_user_permission' => 1767,
                'id_user' => 49,
                'id_permission' => 136,
                'created_at' => '2026-03-24 21:01:53',
                'updated_at' => '2026-03-24 21:01:53'
            ],
            [
                'id_user_permission' => 1768,
                'id_user' => 49,
                'id_permission' => 137,
                'created_at' => '2026-03-24 21:01:54',
                'updated_at' => '2026-03-24 21:01:54'
            ],
            [
                'id_user_permission' => 1769,
                'id_user' => 36,
                'id_permission' => 75,
                'created_at' => '2026-03-24 21:01:55',
                'updated_at' => '2026-03-24 21:01:55'
            ],
            [
                'id_user_permission' => 1770,
                'id_user' => 49,
                'id_permission' => 138,
                'created_at' => '2026-03-24 21:01:56',
                'updated_at' => '2026-03-24 21:01:56'
            ],
            [
                'id_user_permission' => 1771,
                'id_user' => 49,
                'id_permission' => 139,
                'created_at' => '2026-03-24 21:01:57',
                'updated_at' => '2026-03-24 21:01:57'
            ],
            [
                'id_user_permission' => 1772,
                'id_user' => 49,
                'id_permission' => 140,
                'created_at' => '2026-03-24 21:01:58',
                'updated_at' => '2026-03-24 21:01:58'
            ],
            [
                'id_user_permission' => 1773,
                'id_user' => 49,
                'id_permission' => 141,
                'created_at' => '2026-03-24 21:01:59',
                'updated_at' => '2026-03-24 21:01:59'
            ],
            [
                'id_user_permission' => 1774,
                'id_user' => 49,
                'id_permission' => 142,
                'created_at' => '2026-03-24 21:01:59',
                'updated_at' => '2026-03-24 21:01:59'
            ],
            [
                'id_user_permission' => 1775,
                'id_user' => 36,
                'id_permission' => 78,
                'created_at' => '2026-03-24 21:02:01',
                'updated_at' => '2026-03-24 21:02:01'
            ],
            [
                'id_user_permission' => 1776,
                'id_user' => 36,
                'id_permission' => 79,
                'created_at' => '2026-03-24 21:02:02',
                'updated_at' => '2026-03-24 21:02:02'
            ],
            [
                'id_user_permission' => 1777,
                'id_user' => 49,
                'id_permission' => 143,
                'created_at' => '2026-03-24 21:02:02',
                'updated_at' => '2026-03-24 21:02:02'
            ],
            [
                'id_user_permission' => 1778,
                'id_user' => 49,
                'id_permission' => 144,
                'created_at' => '2026-03-24 21:02:03',
                'updated_at' => '2026-03-24 21:02:03'
            ],
            [
                'id_user_permission' => 1779,
                'id_user' => 36,
                'id_permission' => 80,
                'created_at' => '2026-03-24 21:02:05',
                'updated_at' => '2026-03-24 21:02:05'
            ],
            [
                'id_user_permission' => 1780,
                'id_user' => 36,
                'id_permission' => 81,
                'created_at' => '2026-03-24 21:02:06',
                'updated_at' => '2026-03-24 21:02:06'
            ],
            [
                'id_user_permission' => 1781,
                'id_user' => 36,
                'id_permission' => 82,
                'created_at' => '2026-03-24 21:02:06',
                'updated_at' => '2026-03-24 21:02:06'
            ],
            [
                'id_user_permission' => 1782,
                'id_user' => 49,
                'id_permission' => 145,
                'created_at' => '2026-03-24 21:02:07',
                'updated_at' => '2026-03-24 21:02:07'
            ],
            [
                'id_user_permission' => 1783,
                'id_user' => 49,
                'id_permission' => 146,
                'created_at' => '2026-03-24 21:02:08',
                'updated_at' => '2026-03-24 21:02:08'
            ],
            [
                'id_user_permission' => 1784,
                'id_user' => 49,
                'id_permission' => 147,
                'created_at' => '2026-03-24 21:02:10',
                'updated_at' => '2026-03-24 21:02:10'
            ],
            [
                'id_user_permission' => 1785,
                'id_user' => 49,
                'id_permission' => 148,
                'created_at' => '2026-03-24 21:02:11',
                'updated_at' => '2026-03-24 21:02:11'
            ],
            [
                'id_user_permission' => 1786,
                'id_user' => 49,
                'id_permission' => 149,
                'created_at' => '2026-03-24 21:02:13',
                'updated_at' => '2026-03-24 21:02:13'
            ],
            [
                'id_user_permission' => 1787,
                'id_user' => 49,
                'id_permission' => 150,
                'created_at' => '2026-03-24 21:02:15',
                'updated_at' => '2026-03-24 21:02:15'
            ],
            [
                'id_user_permission' => 1788,
                'id_user' => 49,
                'id_permission' => 151,
                'created_at' => '2026-03-24 21:02:16',
                'updated_at' => '2026-03-24 21:02:16'
            ],
            [
                'id_user_permission' => 1789,
                'id_user' => 49,
                'id_permission' => 157,
                'created_at' => '2026-03-24 21:02:22',
                'updated_at' => '2026-03-24 21:02:22'
            ],
            [
                'id_user_permission' => 1790,
                'id_user' => 49,
                'id_permission' => 158,
                'created_at' => '2026-03-24 21:02:23',
                'updated_at' => '2026-03-24 21:02:23'
            ],
            [
                'id_user_permission' => 1791,
                'id_user' => 49,
                'id_permission' => 164,
                'created_at' => '2026-03-24 21:02:31',
                'updated_at' => '2026-03-24 21:02:31'
            ],
            [
                'id_user_permission' => 1792,
                'id_user' => 49,
                'id_permission' => 163,
                'created_at' => '2026-03-24 21:02:32',
                'updated_at' => '2026-03-24 21:02:32'
            ],
            [
                'id_user_permission' => 1793,
                'id_user' => 49,
                'id_permission' => 171,
                'created_at' => '2026-03-24 21:02:37',
                'updated_at' => '2026-03-24 21:02:37'
            ],
            [
                'id_user_permission' => 1794,
                'id_user' => 49,
                'id_permission' => 172,
                'created_at' => '2026-03-24 21:02:38',
                'updated_at' => '2026-03-24 21:02:38'
            ],
            [
                'id_user_permission' => 1795,
                'id_user' => 40,
                'id_permission' => 83,
                'created_at' => '2026-03-24 21:03:44',
                'updated_at' => '2026-03-24 21:03:44'
            ],
            [
                'id_user_permission' => 1796,
                'id_user' => 40,
                'id_permission' => 84,
                'created_at' => '2026-03-24 21:03:45',
                'updated_at' => '2026-03-24 21:03:45'
            ],
            [
                'id_user_permission' => 1797,
                'id_user' => 40,
                'id_permission' => 85,
                'created_at' => '2026-03-24 21:03:45',
                'updated_at' => '2026-03-24 21:03:45'
            ],
            [
                'id_user_permission' => 1798,
                'id_user' => 40,
                'id_permission' => 86,
                'created_at' => '2026-03-24 21:03:47',
                'updated_at' => '2026-03-24 21:03:47'
            ],
            [
                'id_user_permission' => 1799,
                'id_user' => 40,
                'id_permission' => 87,
                'created_at' => '2026-03-24 21:03:48',
                'updated_at' => '2026-03-24 21:03:48'
            ],
            [
                'id_user_permission' => 1801,
                'id_user' => 40,
                'id_permission' => 89,
                'created_at' => '2026-03-24 21:03:56',
                'updated_at' => '2026-03-24 21:03:56'
            ],
            [
                'id_user_permission' => 1802,
                'id_user' => 40,
                'id_permission' => 90,
                'created_at' => '2026-03-24 21:03:56',
                'updated_at' => '2026-03-24 21:03:56'
            ],
            [
                'id_user_permission' => 1803,
                'id_user' => 40,
                'id_permission' => 91,
                'created_at' => '2026-03-24 21:03:58',
                'updated_at' => '2026-03-24 21:03:58'
            ],
            [
                'id_user_permission' => 1804,
                'id_user' => 40,
                'id_permission' => 92,
                'created_at' => '2026-03-24 21:03:59',
                'updated_at' => '2026-03-24 21:03:59'
            ],
            [
                'id_user_permission' => 1805,
                'id_user' => 40,
                'id_permission' => 93,
                'created_at' => '2026-03-24 21:04:00',
                'updated_at' => '2026-03-24 21:04:00'
            ],
            [
                'id_user_permission' => 1806,
                'id_user' => 40,
                'id_permission' => 94,
                'created_at' => '2026-03-24 21:04:06',
                'updated_at' => '2026-03-24 21:04:06'
            ],
            [
                'id_user_permission' => 1807,
                'id_user' => 40,
                'id_permission' => 111,
                'created_at' => '2026-03-24 21:04:13',
                'updated_at' => '2026-03-24 21:04:13'
            ],
            [
                'id_user_permission' => 1808,
                'id_user' => 40,
                'id_permission' => 112,
                'created_at' => '2026-03-24 21:04:14',
                'updated_at' => '2026-03-24 21:04:14'
            ],
            [
                'id_user_permission' => 1809,
                'id_user' => 40,
                'id_permission' => 129,
                'created_at' => '2026-03-24 21:04:31',
                'updated_at' => '2026-03-24 21:04:31'
            ],
            [
                'id_user_permission' => 1810,
                'id_user' => 40,
                'id_permission' => 130,
                'created_at' => '2026-03-24 21:04:32',
                'updated_at' => '2026-03-24 21:04:32'
            ],
            [
                'id_user_permission' => 1811,
                'id_user' => 40,
                'id_permission' => 131,
                'created_at' => '2026-03-24 21:04:34',
                'updated_at' => '2026-03-24 21:04:34'
            ],
            [
                'id_user_permission' => 1812,
                'id_user' => 40,
                'id_permission' => 132,
                'created_at' => '2026-03-24 21:04:37',
                'updated_at' => '2026-03-24 21:04:37'
            ],
            [
                'id_user_permission' => 1813,
                'id_user' => 40,
                'id_permission' => 133,
                'created_at' => '2026-03-24 21:04:38',
                'updated_at' => '2026-03-24 21:04:38'
            ],
            [
                'id_user_permission' => 1814,
                'id_user' => 40,
                'id_permission' => 134,
                'created_at' => '2026-03-24 21:04:38',
                'updated_at' => '2026-03-24 21:04:38'
            ],
            [
                'id_user_permission' => 1815,
                'id_user' => 40,
                'id_permission' => 135,
                'created_at' => '2026-03-24 21:04:44',
                'updated_at' => '2026-03-24 21:04:44'
            ],
            [
                'id_user_permission' => 1816,
                'id_user' => 40,
                'id_permission' => 136,
                'created_at' => '2026-03-24 21:04:45',
                'updated_at' => '2026-03-24 21:04:45'
            ],
            [
                'id_user_permission' => 1817,
                'id_user' => 40,
                'id_permission' => 137,
                'created_at' => '2026-03-24 21:04:47',
                'updated_at' => '2026-03-24 21:04:47'
            ],
            [
                'id_user_permission' => 1818,
                'id_user' => 40,
                'id_permission' => 138,
                'created_at' => '2026-03-24 21:04:50',
                'updated_at' => '2026-03-24 21:04:50'
            ],
            [
                'id_user_permission' => 1819,
                'id_user' => 40,
                'id_permission' => 141,
                'created_at' => '2026-03-24 21:05:06',
                'updated_at' => '2026-03-24 21:05:06'
            ],
            [
                'id_user_permission' => 1820,
                'id_user' => 40,
                'id_permission' => 142,
                'created_at' => '2026-03-24 21:05:06',
                'updated_at' => '2026-03-24 21:05:06'
            ],
            [
                'id_user_permission' => 1821,
                'id_user' => 40,
                'id_permission' => 143,
                'created_at' => '2026-03-24 21:05:06',
                'updated_at' => '2026-03-24 21:05:06'
            ],
            [
                'id_user_permission' => 1822,
                'id_user' => 40,
                'id_permission' => 144,
                'created_at' => '2026-03-24 21:05:09',
                'updated_at' => '2026-03-24 21:05:09'
            ],
            [
                'id_user_permission' => 1823,
                'id_user' => 40,
                'id_permission' => 145,
                'created_at' => '2026-03-24 21:05:13',
                'updated_at' => '2026-03-24 21:05:13'
            ],
            [
                'id_user_permission' => 1824,
                'id_user' => 40,
                'id_permission' => 146,
                'created_at' => '2026-03-24 21:05:14',
                'updated_at' => '2026-03-24 21:05:14'
            ],
            [
                'id_user_permission' => 1825,
                'id_user' => 40,
                'id_permission' => 147,
                'created_at' => '2026-03-24 21:05:18',
                'updated_at' => '2026-03-24 21:05:18'
            ],
            [
                'id_user_permission' => 1826,
                'id_user' => 40,
                'id_permission' => 148,
                'created_at' => '2026-03-24 21:05:19',
                'updated_at' => '2026-03-24 21:05:19'
            ],
            [
                'id_user_permission' => 1827,
                'id_user' => 40,
                'id_permission' => 149,
                'created_at' => '2026-03-24 21:05:19',
                'updated_at' => '2026-03-24 21:05:19'
            ],
            [
                'id_user_permission' => 1828,
                'id_user' => 40,
                'id_permission' => 150,
                'created_at' => '2026-03-24 21:05:25',
                'updated_at' => '2026-03-24 21:05:25'
            ],
            [
                'id_user_permission' => 1830,
                'id_user' => 40,
                'id_permission' => 157,
                'created_at' => '2026-03-24 21:05:38',
                'updated_at' => '2026-03-24 21:05:38'
            ],
            [
                'id_user_permission' => 1831,
                'id_user' => 40,
                'id_permission' => 158,
                'created_at' => '2026-03-24 21:05:39',
                'updated_at' => '2026-03-24 21:05:39'
            ],
            [
                'id_user_permission' => 1832,
                'id_user' => 40,
                'id_permission' => 223,
                'created_at' => '2026-03-24 21:05:52',
                'updated_at' => '2026-03-24 21:05:52'
            ],
            [
                'id_user_permission' => 1833,
                'id_user' => 40,
                'id_permission' => 1,
                'created_at' => '2026-03-24 21:10:10',
                'updated_at' => '2026-03-24 21:10:10'
            ],
            [
                'id_user_permission' => 1834,
                'id_user' => 40,
                'id_permission' => 5,
                'created_at' => '2026-03-24 21:10:12',
                'updated_at' => '2026-03-24 21:10:12'
            ],
            [
                'id_user_permission' => 1835,
                'id_user' => 40,
                'id_permission' => 13,
                'created_at' => '2026-03-24 21:10:44',
                'updated_at' => '2026-03-24 21:10:44'
            ],
            [
                'id_user_permission' => 1836,
                'id_user' => 40,
                'id_permission' => 14,
                'created_at' => '2026-03-24 21:10:45',
                'updated_at' => '2026-03-24 21:10:45'
            ],
            [
                'id_user_permission' => 1837,
                'id_user' => 40,
                'id_permission' => 15,
                'created_at' => '2026-03-24 21:10:45',
                'updated_at' => '2026-03-24 21:10:45'
            ],
            [
                'id_user_permission' => 1838,
                'id_user' => 40,
                'id_permission' => 16,
                'created_at' => '2026-03-24 21:10:47',
                'updated_at' => '2026-03-24 21:10:47'
            ],
            [
                'id_user_permission' => 1839,
                'id_user' => 40,
                'id_permission' => 17,
                'created_at' => '2026-03-24 21:10:50',
                'updated_at' => '2026-03-24 21:10:50'
            ],
            [
                'id_user_permission' => 1840,
                'id_user' => 40,
                'id_permission' => 23,
                'created_at' => '2026-03-24 21:11:01',
                'updated_at' => '2026-03-24 21:11:01'
            ],
            [
                'id_user_permission' => 1841,
                'id_user' => 40,
                'id_permission' => 24,
                'created_at' => '2026-03-24 21:11:01',
                'updated_at' => '2026-03-24 21:11:01'
            ],
            [
                'id_user_permission' => 1842,
                'id_user' => 40,
                'id_permission' => 25,
                'created_at' => '2026-03-24 21:11:01',
                'updated_at' => '2026-03-24 21:11:01'
            ],
            [
                'id_user_permission' => 1843,
                'id_user' => 40,
                'id_permission' => 26,
                'created_at' => '2026-03-24 21:11:01',
                'updated_at' => '2026-03-24 21:11:01'
            ],
            [
                'id_user_permission' => 1844,
                'id_user' => 40,
                'id_permission' => 78,
                'created_at' => '2026-03-24 21:11:10',
                'updated_at' => '2026-03-24 21:11:10'
            ],
            [
                'id_user_permission' => 1845,
                'id_user' => 40,
                'id_permission' => 79,
                'created_at' => '2026-03-24 21:11:11',
                'updated_at' => '2026-03-24 21:11:11'
            ],
            [
                'id_user_permission' => 1846,
                'id_user' => 40,
                'id_permission' => 39,
                'created_at' => '2026-03-24 21:11:14',
                'updated_at' => '2026-03-24 21:11:14'
            ],
            [
                'id_user_permission' => 1847,
                'id_user' => 40,
                'id_permission' => 80,
                'created_at' => '2026-03-24 21:11:15',
                'updated_at' => '2026-03-24 21:11:15'
            ],
            [
                'id_user_permission' => 1848,
                'id_user' => 40,
                'id_permission' => 82,
                'created_at' => '2026-03-24 21:11:16',
                'updated_at' => '2026-03-24 21:11:16'
            ],
            [
                'id_user_permission' => 1849,
                'id_user' => 40,
                'id_permission' => 81,
                'created_at' => '2026-03-24 21:11:16',
                'updated_at' => '2026-03-24 21:11:16'
            ],
            [
                'id_user_permission' => 1850,
                'id_user' => 40,
                'id_permission' => 40,
                'created_at' => '2026-03-24 21:11:16',
                'updated_at' => '2026-03-24 21:11:16'
            ],
            [
                'id_user_permission' => 1851,
                'id_user' => 40,
                'id_permission' => 41,
                'created_at' => '2026-03-24 21:11:16',
                'updated_at' => '2026-03-24 21:11:16'
            ],
            [
                'id_user_permission' => 1852,
                'id_user' => 40,
                'id_permission' => 42,
                'created_at' => '2026-03-24 21:11:16',
                'updated_at' => '2026-03-24 21:11:16'
            ],
            [
                'id_user_permission' => 1854,
                'id_user' => 40,
                'id_permission' => 59,
                'created_at' => '2026-03-24 21:11:31',
                'updated_at' => '2026-03-24 21:11:31'
            ],
            [
                'id_user_permission' => 1856,
                'id_user' => 40,
                'id_permission' => 63,
                'created_at' => '2026-03-24 21:12:03',
                'updated_at' => '2026-03-24 21:12:03'
            ],
            [
                'id_user_permission' => 1857,
                'id_user' => 40,
                'id_permission' => 19,
                'created_at' => '2026-03-24 21:32:33',
                'updated_at' => '2026-03-24 21:32:33'
            ],
            [
                'id_user_permission' => 1858,
                'id_user' => 40,
                'id_permission' => 20,
                'created_at' => '2026-03-24 21:32:33',
                'updated_at' => '2026-03-24 21:32:33'
            ],
            [
                'id_user_permission' => 1859,
                'id_user' => 40,
                'id_permission' => 21,
                'created_at' => '2026-03-24 21:32:33',
                'updated_at' => '2026-03-24 21:32:33'
            ],
            [
                'id_user_permission' => 1860,
                'id_user' => 40,
                'id_permission' => 22,
                'created_at' => '2026-03-24 21:32:33',
                'updated_at' => '2026-03-24 21:32:33'
            ],
            [
                'id_user_permission' => 1861,
                'id_user' => 40,
                'id_permission' => 106,
                'created_at' => '2026-03-24 21:33:17',
                'updated_at' => '2026-03-24 21:33:17'
            ],
            [
                'id_user_permission' => 1862,
                'id_user' => 40,
                'id_permission' => 107,
                'created_at' => '2026-03-24 21:33:20',
                'updated_at' => '2026-03-24 21:33:20'
            ],
            [
                'id_user_permission' => 1863,
                'id_user' => 40,
                'id_permission' => 108,
                'created_at' => '2026-03-24 21:33:20',
                'updated_at' => '2026-03-24 21:33:20'
            ],
            [
                'id_user_permission' => 1864,
                'id_user' => 40,
                'id_permission' => 109,
                'created_at' => '2026-03-24 21:33:20',
                'updated_at' => '2026-03-24 21:33:20'
            ],
            [
                'id_user_permission' => 1865,
                'id_user' => 40,
                'id_permission' => 105,
                'created_at' => '2026-03-24 21:33:24',
                'updated_at' => '2026-03-24 21:33:24'
            ],
            [
                'id_user_permission' => 1866,
                'id_user' => 40,
                'id_permission' => 110,
                'created_at' => '2026-03-24 21:33:30',
                'updated_at' => '2026-03-24 21:33:30'
            ],
            [
                'id_user_permission' => 1867,
                'id_user' => 40,
                'id_permission' => 139,
                'created_at' => '2026-03-24 21:34:01',
                'updated_at' => '2026-03-24 21:34:01'
            ],
            [
                'id_user_permission' => 1868,
                'id_user' => 40,
                'id_permission' => 140,
                'created_at' => '2026-03-24 21:34:04',
                'updated_at' => '2026-03-24 21:34:04'
            ],
            [
                'id_user_permission' => 1869,
                'id_user' => 40,
                'id_permission' => 173,
                'created_at' => '2026-03-24 21:34:18',
                'updated_at' => '2026-03-24 21:34:18'
            ],
            [
                'id_user_permission' => 1870,
                'id_user' => 40,
                'id_permission' => 177,
                'created_at' => '2026-03-24 21:34:27',
                'updated_at' => '2026-03-24 21:34:27'
            ],
            [
                'id_user_permission' => 1871,
                'id_user' => 40,
                'id_permission' => 178,
                'created_at' => '2026-03-24 21:34:29',
                'updated_at' => '2026-03-24 21:34:29'
            ],
            [
                'id_user_permission' => 1872,
                'id_user' => 40,
                'id_permission' => 179,
                'created_at' => '2026-03-24 21:34:29',
                'updated_at' => '2026-03-24 21:34:29'
            ],
            [
                'id_user_permission' => 1873,
                'id_user' => 36,
                'id_permission' => 83,
                'created_at' => '2026-03-24 21:34:30',
                'updated_at' => '2026-03-24 21:34:30'
            ],
            [
                'id_user_permission' => 1874,
                'id_user' => 36,
                'id_permission' => 84,
                'created_at' => '2026-03-24 21:34:31',
                'updated_at' => '2026-03-24 21:34:31'
            ],
            [
                'id_user_permission' => 1875,
                'id_user' => 36,
                'id_permission' => 85,
                'created_at' => '2026-03-24 21:34:31',
                'updated_at' => '2026-03-24 21:34:31'
            ],
            [
                'id_user_permission' => 1876,
                'id_user' => 36,
                'id_permission' => 86,
                'created_at' => '2026-03-24 21:34:31',
                'updated_at' => '2026-03-24 21:34:31'
            ],
            [
                'id_user_permission' => 1877,
                'id_user' => 36,
                'id_permission' => 87,
                'created_at' => '2026-03-24 21:34:35',
                'updated_at' => '2026-03-24 21:34:35'
            ],
            [
                'id_user_permission' => 1878,
                'id_user' => 40,
                'id_permission' => 243,
                'created_at' => '2026-03-24 21:34:37',
                'updated_at' => '2026-03-24 21:34:37'
            ],
            [
                'id_user_permission' => 1879,
                'id_user' => 40,
                'id_permission' => 244,
                'created_at' => '2026-03-24 21:34:43',
                'updated_at' => '2026-03-24 21:34:43'
            ],
            [
                'id_user_permission' => 1880,
                'id_user' => 36,
                'id_permission' => 89,
                'created_at' => '2026-03-24 21:34:47',
                'updated_at' => '2026-03-24 21:34:47'
            ],
            [
                'id_user_permission' => 1881,
                'id_user' => 40,
                'id_permission' => 180,
                'created_at' => '2026-03-24 21:34:49',
                'updated_at' => '2026-03-24 21:34:49'
            ],
            [
                'id_user_permission' => 1882,
                'id_user' => 36,
                'id_permission' => 90,
                'created_at' => '2026-03-24 21:34:51',
                'updated_at' => '2026-03-24 21:34:51'
            ],
            [
                'id_user_permission' => 1883,
                'id_user' => 36,
                'id_permission' => 91,
                'created_at' => '2026-03-24 21:34:51',
                'updated_at' => '2026-03-24 21:34:51'
            ],
            [
                'id_user_permission' => 1884,
                'id_user' => 36,
                'id_permission' => 92,
                'created_at' => '2026-03-24 21:34:51',
                'updated_at' => '2026-03-24 21:34:51'
            ],
            [
                'id_user_permission' => 1885,
                'id_user' => 36,
                'id_permission' => 93,
                'created_at' => '2026-03-24 21:34:51',
                'updated_at' => '2026-03-24 21:34:51'
            ],
            [
                'id_user_permission' => 1886,
                'id_user' => 36,
                'id_permission' => 94,
                'created_at' => '2026-03-24 21:34:51',
                'updated_at' => '2026-03-24 21:34:51'
            ],
            [
                'id_user_permission' => 1887,
                'id_user' => 40,
                'id_permission' => 184,
                'created_at' => '2026-03-24 21:34:55',
                'updated_at' => '2026-03-24 21:34:55'
            ],
            [
                'id_user_permission' => 1888,
                'id_user' => 36,
                'id_permission' => 111,
                'created_at' => '2026-03-24 21:35:04',
                'updated_at' => '2026-03-24 21:35:04'
            ],
            [
                'id_user_permission' => 1889,
                'id_user' => 36,
                'id_permission' => 112,
                'created_at' => '2026-03-24 21:35:08',
                'updated_at' => '2026-03-24 21:35:08'
            ],
            [
                'id_user_permission' => 1890,
                'id_user' => 40,
                'id_permission' => 188,
                'created_at' => '2026-03-24 21:35:11',
                'updated_at' => '2026-03-24 21:35:11'
            ],
            [
                'id_user_permission' => 1891,
                'id_user' => 36,
                'id_permission' => 129,
                'created_at' => '2026-03-24 21:35:11',
                'updated_at' => '2026-03-24 21:35:11'
            ],
            [
                'id_user_permission' => 1892,
                'id_user' => 36,
                'id_permission' => 130,
                'created_at' => '2026-03-24 21:35:11',
                'updated_at' => '2026-03-24 21:35:11'
            ],
            [
                'id_user_permission' => 1893,
                'id_user' => 40,
                'id_permission' => 189,
                'created_at' => '2026-03-24 21:35:14',
                'updated_at' => '2026-03-24 21:35:14'
            ],
            [
                'id_user_permission' => 1894,
                'id_user' => 40,
                'id_permission' => 190,
                'created_at' => '2026-03-24 21:35:14',
                'updated_at' => '2026-03-24 21:35:14'
            ],
            [
                'id_user_permission' => 1895,
                'id_user' => 40,
                'id_permission' => 191,
                'created_at' => '2026-03-24 21:35:14',
                'updated_at' => '2026-03-24 21:35:14'
            ],
            [
                'id_user_permission' => 1896,
                'id_user' => 40,
                'id_permission' => 192,
                'created_at' => '2026-03-24 21:35:14',
                'updated_at' => '2026-03-24 21:35:14'
            ],
            [
                'id_user_permission' => 1897,
                'id_user' => 36,
                'id_permission' => 131,
                'created_at' => '2026-03-24 21:35:15',
                'updated_at' => '2026-03-24 21:35:15'
            ],
            [
                'id_user_permission' => 1898,
                'id_user' => 36,
                'id_permission' => 132,
                'created_at' => '2026-03-24 21:35:15',
                'updated_at' => '2026-03-24 21:35:15'
            ],
            [
                'id_user_permission' => 1899,
                'id_user' => 36,
                'id_permission' => 133,
                'created_at' => '2026-03-24 21:35:15',
                'updated_at' => '2026-03-24 21:35:15'
            ],
            [
                'id_user_permission' => 1900,
                'id_user' => 40,
                'id_permission' => 193,
                'created_at' => '2026-03-24 21:35:17',
                'updated_at' => '2026-03-24 21:35:17'
            ],
            [
                'id_user_permission' => 1901,
                'id_user' => 40,
                'id_permission' => 194,
                'created_at' => '2026-03-24 21:35:19',
                'updated_at' => '2026-03-24 21:35:19'
            ],
            [
                'id_user_permission' => 1902,
                'id_user' => 40,
                'id_permission' => 195,
                'created_at' => '2026-03-24 21:35:21',
                'updated_at' => '2026-03-24 21:35:21'
            ],
            [
                'id_user_permission' => 1903,
                'id_user' => 40,
                'id_permission' => 196,
                'created_at' => '2026-03-24 21:35:21',
                'updated_at' => '2026-03-24 21:35:21'
            ],
            [
                'id_user_permission' => 1905,
                'id_user' => 40,
                'id_permission' => 197,
                'created_at' => '2026-03-24 21:35:25',
                'updated_at' => '2026-03-24 21:35:25'
            ],
            [
                'id_user_permission' => 1906,
                'id_user' => 40,
                'id_permission' => 198,
                'created_at' => '2026-03-24 21:35:27',
                'updated_at' => '2026-03-24 21:35:27'
            ],
            [
                'id_user_permission' => 1907,
                'id_user' => 36,
                'id_permission' => 138,
                'created_at' => '2026-03-24 21:35:28',
                'updated_at' => '2026-03-24 21:35:28'
            ],
            [
                'id_user_permission' => 1908,
                'id_user' => 36,
                'id_permission' => 137,
                'created_at' => '2026-03-24 21:35:28',
                'updated_at' => '2026-03-24 21:35:28'
            ],
            [
                'id_user_permission' => 1909,
                'id_user' => 36,
                'id_permission' => 136,
                'created_at' => '2026-03-24 21:35:28',
                'updated_at' => '2026-03-24 21:35:28'
            ],
            [
                'id_user_permission' => 1910,
                'id_user' => 36,
                'id_permission' => 135,
                'created_at' => '2026-03-24 21:35:28',
                'updated_at' => '2026-03-24 21:35:28'
            ],
            [
                'id_user_permission' => 1911,
                'id_user' => 36,
                'id_permission' => 134,
                'created_at' => '2026-03-24 21:35:28',
                'updated_at' => '2026-03-24 21:35:28'
            ],
            [
                'id_user_permission' => 1912,
                'id_user' => 40,
                'id_permission' => 199,
                'created_at' => '2026-03-24 21:35:31',
                'updated_at' => '2026-03-24 21:35:31'
            ],
            [
                'id_user_permission' => 1913,
                'id_user' => 40,
                'id_permission' => 200,
                'created_at' => '2026-03-24 21:35:32',
                'updated_at' => '2026-03-24 21:35:32'
            ],
            [
                'id_user_permission' => 1914,
                'id_user' => 36,
                'id_permission' => 141,
                'created_at' => '2026-03-24 21:35:46',
                'updated_at' => '2026-03-24 21:35:46'
            ],
            [
                'id_user_permission' => 1915,
                'id_user' => 36,
                'id_permission' => 142,
                'created_at' => '2026-03-24 21:35:49',
                'updated_at' => '2026-03-24 21:35:49'
            ],
            [
                'id_user_permission' => 1916,
                'id_user' => 36,
                'id_permission' => 143,
                'created_at' => '2026-03-24 21:35:49',
                'updated_at' => '2026-03-24 21:35:49'
            ],
            [
                'id_user_permission' => 1917,
                'id_user' => 36,
                'id_permission' => 144,
                'created_at' => '2026-03-24 21:35:49',
                'updated_at' => '2026-03-24 21:35:49'
            ],
            [
                'id_user_permission' => 1918,
                'id_user' => 36,
                'id_permission' => 145,
                'created_at' => '2026-03-24 21:35:49',
                'updated_at' => '2026-03-24 21:35:49'
            ],
            [
                'id_user_permission' => 1920,
                'id_user' => 36,
                'id_permission' => 146,
                'created_at' => '2026-03-24 21:36:26',
                'updated_at' => '2026-03-24 21:36:26'
            ],
            [
                'id_user_permission' => 1921,
                'id_user' => 36,
                'id_permission' => 147,
                'created_at' => '2026-03-24 21:36:29',
                'updated_at' => '2026-03-24 21:36:29'
            ],
            [
                'id_user_permission' => 1922,
                'id_user' => 36,
                'id_permission' => 148,
                'created_at' => '2026-03-24 21:36:29',
                'updated_at' => '2026-03-24 21:36:29'
            ],
            [
                'id_user_permission' => 1923,
                'id_user' => 36,
                'id_permission' => 149,
                'created_at' => '2026-03-24 21:36:29',
                'updated_at' => '2026-03-24 21:36:29'
            ],
            [
                'id_user_permission' => 1924,
                'id_user' => 36,
                'id_permission' => 150,
                'created_at' => '2026-03-24 21:36:29',
                'updated_at' => '2026-03-24 21:36:29'
            ],
            [
                'id_user_permission' => 1925,
                'id_user' => 36,
                'id_permission' => 151,
                'created_at' => '2026-03-24 21:36:39',
                'updated_at' => '2026-03-24 21:36:39'
            ],
            [
                'id_user_permission' => 1926,
                'id_user' => 36,
                'id_permission' => 157,
                'created_at' => '2026-03-24 21:37:58',
                'updated_at' => '2026-03-24 21:37:58'
            ],
            [
                'id_user_permission' => 1927,
                'id_user' => 36,
                'id_permission' => 158,
                'created_at' => '2026-03-24 21:38:00',
                'updated_at' => '2026-03-24 21:38:00'
            ],
            [
                'id_user_permission' => 1928,
                'id_user' => 40,
                'id_permission' => 246,
                'created_at' => '2026-03-24 21:38:01',
                'updated_at' => '2026-03-24 21:38:01'
            ],
            [
                'id_user_permission' => 1929,
                'id_user' => 40,
                'id_permission' => 247,
                'created_at' => '2026-03-24 21:38:09',
                'updated_at' => '2026-03-24 21:38:09'
            ],
            [
                'id_user_permission' => 1930,
                'id_user' => 36,
                'id_permission' => 223,
                'created_at' => '2026-03-24 21:38:31',
                'updated_at' => '2026-03-24 21:38:31'
            ],
            [
                'id_user_permission' => 1931,
                'id_user' => 21,
                'id_permission' => 1,
                'created_at' => '2026-03-24 21:39:08',
                'updated_at' => '2026-03-24 21:39:08'
            ],
            [
                'id_user_permission' => 1932,
                'id_user' => 21,
                'id_permission' => 5,
                'created_at' => '2026-03-24 21:39:09',
                'updated_at' => '2026-03-24 21:39:09'
            ],
            [
                'id_user_permission' => 1933,
                'id_user' => 21,
                'id_permission' => 9,
                'created_at' => '2026-03-24 21:39:13',
                'updated_at' => '2026-03-24 21:39:13'
            ],
            [
                'id_user_permission' => 1934,
                'id_user' => 21,
                'id_permission' => 13,
                'created_at' => '2026-03-24 21:39:17',
                'updated_at' => '2026-03-24 21:39:17'
            ],
            [
                'id_user_permission' => 1935,
                'id_user' => 21,
                'id_permission' => 19,
                'created_at' => '2026-03-24 21:39:21',
                'updated_at' => '2026-03-24 21:39:21'
            ],
            [
                'id_user_permission' => 1936,
                'id_user' => 21,
                'id_permission' => 23,
                'created_at' => '2026-03-24 21:39:24',
                'updated_at' => '2026-03-24 21:39:24'
            ],
            [
                'id_user_permission' => 1937,
                'id_user' => 21,
                'id_permission' => 39,
                'created_at' => '2026-03-24 21:39:31',
                'updated_at' => '2026-03-24 21:39:31'
            ],
            [
                'id_user_permission' => 1938,
                'id_user' => 21,
                'id_permission' => 59,
                'created_at' => '2026-03-24 21:39:40',
                'updated_at' => '2026-03-24 21:39:40'
            ],
            [
                'id_user_permission' => 1939,
                'id_user' => 21,
                'id_permission' => 63,
                'created_at' => '2026-03-24 21:39:44',
                'updated_at' => '2026-03-24 21:39:44'
            ],
            [
                'id_user_permission' => 1940,
                'id_user' => 21,
                'id_permission' => 73,
                'created_at' => '2026-03-24 21:39:53',
                'updated_at' => '2026-03-24 21:39:53'
            ],
            [
                'id_user_permission' => 1941,
                'id_user' => 21,
                'id_permission' => 76,
                'created_at' => '2026-03-24 21:39:57',
                'updated_at' => '2026-03-24 21:39:57'
            ],
            [
                'id_user_permission' => 1942,
                'id_user' => 21,
                'id_permission' => 83,
                'created_at' => '2026-03-24 21:40:08',
                'updated_at' => '2026-03-24 21:40:08'
            ],
            [
                'id_user_permission' => 1943,
                'id_user' => 21,
                'id_permission' => 88,
                'created_at' => '2026-03-24 21:40:14',
                'updated_at' => '2026-03-24 21:40:14'
            ],
            [
                'id_user_permission' => 1944,
                'id_user' => 21,
                'id_permission' => 89,
                'created_at' => '2026-03-24 21:40:15',
                'updated_at' => '2026-03-24 21:40:15'
            ],
            [
                'id_user_permission' => 1945,
                'id_user' => 21,
                'id_permission' => 93,
                'created_at' => '2026-03-24 21:40:30',
                'updated_at' => '2026-03-24 21:40:30'
            ],
            [
                'id_user_permission' => 1946,
                'id_user' => 21,
                'id_permission' => 94,
                'created_at' => '2026-03-24 21:40:31',
                'updated_at' => '2026-03-24 21:40:31'
            ],
            [
                'id_user_permission' => 1947,
                'id_user' => 34,
                'id_permission' => 1,
                'created_at' => '2026-03-24 21:40:32',
                'updated_at' => '2026-03-24 21:40:32'
            ],
            [
                'id_user_permission' => 1948,
                'id_user' => 34,
                'id_permission' => 13,
                'created_at' => '2026-03-24 21:40:38',
                'updated_at' => '2026-03-24 21:40:38'
            ],
            [
                'id_user_permission' => 1949,
                'id_user' => 21,
                'id_permission' => 102,
                'created_at' => '2026-03-24 21:40:38',
                'updated_at' => '2026-03-24 21:40:38'
            ],
            [
                'id_user_permission' => 1950,
                'id_user' => 34,
                'id_permission' => 14,
                'created_at' => '2026-03-24 21:40:39',
                'updated_at' => '2026-03-24 21:40:39'
            ],
            [
                'id_user_permission' => 1951,
                'id_user' => 34,
                'id_permission' => 15,
                'created_at' => '2026-03-24 21:40:39',
                'updated_at' => '2026-03-24 21:40:39'
            ],
            [
                'id_user_permission' => 1952,
                'id_user' => 34,
                'id_permission' => 16,
                'created_at' => '2026-03-24 21:40:39',
                'updated_at' => '2026-03-24 21:40:39'
            ],
            [
                'id_user_permission' => 1953,
                'id_user' => 21,
                'id_permission' => 103,
                'created_at' => '2026-03-24 21:40:40',
                'updated_at' => '2026-03-24 21:40:40'
            ],
            [
                'id_user_permission' => 1954,
                'id_user' => 21,
                'id_permission' => 104,
                'created_at' => '2026-03-24 21:40:43',
                'updated_at' => '2026-03-24 21:40:43'
            ],
            [
                'id_user_permission' => 1955,
                'id_user' => 34,
                'id_permission' => 19,
                'created_at' => '2026-03-24 21:40:45',
                'updated_at' => '2026-03-24 21:40:45'
            ],
            [
                'id_user_permission' => 1956,
                'id_user' => 21,
                'id_permission' => 105,
                'created_at' => '2026-03-24 21:40:48',
                'updated_at' => '2026-03-24 21:40:48'
            ],
            [
                'id_user_permission' => 1957,
                'id_user' => 34,
                'id_permission' => 23,
                'created_at' => '2026-03-24 21:40:50',
                'updated_at' => '2026-03-24 21:40:50'
            ],
            [
                'id_user_permission' => 1958,
                'id_user' => 34,
                'id_permission' => 39,
                'created_at' => '2026-03-24 21:40:56',
                'updated_at' => '2026-03-24 21:40:56'
            ],
            [
                'id_user_permission' => 1959,
                'id_user' => 34,
                'id_permission' => 40,
                'created_at' => '2026-03-24 21:40:57',
                'updated_at' => '2026-03-24 21:40:57'
            ],
            [
                'id_user_permission' => 1960,
                'id_user' => 34,
                'id_permission' => 41,
                'created_at' => '2026-03-24 21:41:00',
                'updated_at' => '2026-03-24 21:41:00'
            ],
            [
                'id_user_permission' => 1961,
                'id_user' => 34,
                'id_permission' => 42,
                'created_at' => '2026-03-24 21:41:01',
                'updated_at' => '2026-03-24 21:41:01'
            ],
            [
                'id_user_permission' => 1962,
                'id_user' => 21,
                'id_permission' => 109,
                'created_at' => '2026-03-24 21:41:30',
                'updated_at' => '2026-03-24 21:41:30'
            ],
            [
                'id_user_permission' => 1963,
                'id_user' => 21,
                'id_permission' => 110,
                'created_at' => '2026-03-24 21:41:31',
                'updated_at' => '2026-03-24 21:41:31'
            ],
            [
                'id_user_permission' => 1964,
                'id_user' => 34,
                'id_permission' => 59,
                'created_at' => '2026-03-24 21:41:33',
                'updated_at' => '2026-03-24 21:41:33'
            ],
            [
                'id_user_permission' => 1965,
                'id_user' => 21,
                'id_permission' => 116,
                'created_at' => '2026-03-24 21:41:39',
                'updated_at' => '2026-03-24 21:41:39'
            ],
            [
                'id_user_permission' => 1966,
                'id_user' => 21,
                'id_permission' => 115,
                'created_at' => '2026-03-24 21:41:41',
                'updated_at' => '2026-03-24 21:41:41'
            ],
            [
                'id_user_permission' => 1967,
                'id_user' => 34,
                'id_permission' => 63,
                'created_at' => '2026-03-24 21:41:42',
                'updated_at' => '2026-03-24 21:41:42'
            ],
            [
                'id_user_permission' => 1968,
                'id_user' => 34,
                'id_permission' => 75,
                'created_at' => '2026-03-24 21:42:10',
                'updated_at' => '2026-03-24 21:42:10'
            ],
            [
                'id_user_permission' => 1969,
                'id_user' => 34,
                'id_permission' => 78,
                'created_at' => '2026-03-24 21:42:19',
                'updated_at' => '2026-03-24 21:42:19'
            ],
            [
                'id_user_permission' => 1970,
                'id_user' => 34,
                'id_permission' => 79,
                'created_at' => '2026-03-24 21:42:22',
                'updated_at' => '2026-03-24 21:42:22'
            ],
            [
                'id_user_permission' => 1971,
                'id_user' => 34,
                'id_permission' => 80,
                'created_at' => '2026-03-24 21:42:23',
                'updated_at' => '2026-03-24 21:42:23'
            ],
            [
                'id_user_permission' => 1972,
                'id_user' => 34,
                'id_permission' => 81,
                'created_at' => '2026-03-24 21:42:27',
                'updated_at' => '2026-03-24 21:42:27'
            ],
            [
                'id_user_permission' => 1973,
                'id_user' => 34,
                'id_permission' => 82,
                'created_at' => '2026-03-24 21:42:28',
                'updated_at' => '2026-03-24 21:42:28'
            ],
            [
                'id_user_permission' => 1974,
                'id_user' => 34,
                'id_permission' => 83,
                'created_at' => '2026-03-24 21:42:33',
                'updated_at' => '2026-03-24 21:42:33'
            ],
            [
                'id_user_permission' => 1975,
                'id_user' => 34,
                'id_permission' => 84,
                'created_at' => '2026-03-24 21:42:34',
                'updated_at' => '2026-03-24 21:42:34'
            ],
            [
                'id_user_permission' => 1976,
                'id_user' => 21,
                'id_permission' => 127,
                'created_at' => '2026-03-24 21:42:36',
                'updated_at' => '2026-03-24 21:42:36'
            ],
            [
                'id_user_permission' => 1977,
                'id_user' => 34,
                'id_permission' => 85,
                'created_at' => '2026-03-24 21:42:38',
                'updated_at' => '2026-03-24 21:42:38'
            ],
            [
                'id_user_permission' => 1978,
                'id_user' => 21,
                'id_permission' => 133,
                'created_at' => '2026-03-24 21:42:45',
                'updated_at' => '2026-03-24 21:42:45'
            ],
            [
                'id_user_permission' => 1979,
                'id_user' => 34,
                'id_permission' => 86,
                'created_at' => '2026-03-24 21:42:46',
                'updated_at' => '2026-03-24 21:42:46'
            ],
            [
                'id_user_permission' => 1980,
                'id_user' => 21,
                'id_permission' => 134,
                'created_at' => '2026-03-24 21:42:47',
                'updated_at' => '2026-03-24 21:42:47'
            ],
            [
                'id_user_permission' => 1981,
                'id_user' => 21,
                'id_permission' => 135,
                'created_at' => '2026-03-24 21:42:47',
                'updated_at' => '2026-03-24 21:42:47'
            ],
            [
                'id_user_permission' => 1982,
                'id_user' => 34,
                'id_permission' => 87,
                'created_at' => '2026-03-24 21:42:49',
                'updated_at' => '2026-03-24 21:42:49'
            ],
            [
                'id_user_permission' => 1983,
                'id_user' => 21,
                'id_permission' => 139,
                'created_at' => '2026-03-24 21:42:55',
                'updated_at' => '2026-03-24 21:42:55'
            ],
            [
                'id_user_permission' => 1984,
                'id_user' => 21,
                'id_permission' => 140,
                'created_at' => '2026-03-24 21:42:56',
                'updated_at' => '2026-03-24 21:42:56'
            ],
            [
                'id_user_permission' => 1985,
                'id_user' => 21,
                'id_permission' => 141,
                'created_at' => '2026-03-24 21:42:56',
                'updated_at' => '2026-03-24 21:42:56'
            ],
            [
                'id_user_permission' => 1986,
                'id_user' => 34,
                'id_permission' => 89,
                'created_at' => '2026-03-24 21:42:59',
                'updated_at' => '2026-03-24 21:42:59'
            ],
            [
                'id_user_permission' => 1987,
                'id_user' => 34,
                'id_permission' => 90,
                'created_at' => '2026-03-24 21:43:00',
                'updated_at' => '2026-03-24 21:43:00'
            ],
            [
                'id_user_permission' => 1988,
                'id_user' => 34,
                'id_permission' => 91,
                'created_at' => '2026-03-24 21:43:00',
                'updated_at' => '2026-03-24 21:43:00'
            ],
            [
                'id_user_permission' => 1989,
                'id_user' => 34,
                'id_permission' => 92,
                'created_at' => '2026-03-24 21:43:02',
                'updated_at' => '2026-03-24 21:43:02'
            ],
            [
                'id_user_permission' => 1990,
                'id_user' => 34,
                'id_permission' => 93,
                'created_at' => '2026-03-24 21:43:03',
                'updated_at' => '2026-03-24 21:43:03'
            ],
            [
                'id_user_permission' => 1991,
                'id_user' => 34,
                'id_permission' => 94,
                'created_at' => '2026-03-24 21:43:03',
                'updated_at' => '2026-03-24 21:43:03'
            ],
            [
                'id_user_permission' => 1992,
                'id_user' => 21,
                'id_permission' => 146,
                'created_at' => '2026-03-24 21:43:03',
                'updated_at' => '2026-03-24 21:43:03'
            ],
            [
                'id_user_permission' => 1993,
                'id_user' => 21,
                'id_permission' => 151,
                'created_at' => '2026-03-24 21:43:12',
                'updated_at' => '2026-03-24 21:43:12'
            ],
            [
                'id_user_permission' => 1994,
                'id_user' => 21,
                'id_permission' => 154,
                'created_at' => '2026-03-24 21:43:15',
                'updated_at' => '2026-03-24 21:43:15'
            ],
            [
                'id_user_permission' => 1995,
                'id_user' => 21,
                'id_permission' => 155,
                'created_at' => '2026-03-24 21:43:17',
                'updated_at' => '2026-03-24 21:43:17'
            ],
            [
                'id_user_permission' => 1996,
                'id_user' => 34,
                'id_permission' => 111,
                'created_at' => '2026-03-24 21:43:21',
                'updated_at' => '2026-03-24 21:43:21'
            ],
            [
                'id_user_permission' => 1997,
                'id_user' => 21,
                'id_permission' => 156,
                'created_at' => '2026-03-24 21:43:22',
                'updated_at' => '2026-03-24 21:43:22'
            ],
            [
                'id_user_permission' => 1998,
                'id_user' => 34,
                'id_permission' => 112,
                'created_at' => '2026-03-24 21:43:22',
                'updated_at' => '2026-03-24 21:43:22'
            ],
            [
                'id_user_permission' => 1999,
                'id_user' => 21,
                'id_permission' => 162,
                'created_at' => '2026-03-24 21:43:28',
                'updated_at' => '2026-03-24 21:43:28'
            ],
            [
                'id_user_permission' => 2000,
                'id_user' => 34,
                'id_permission' => 129,
                'created_at' => '2026-03-24 21:43:28',
                'updated_at' => '2026-03-24 21:43:28'
            ],
            [
                'id_user_permission' => 2001,
                'id_user' => 21,
                'id_permission' => 161,
                'created_at' => '2026-03-24 21:43:29',
                'updated_at' => '2026-03-24 21:43:29'
            ],
            [
                'id_user_permission' => 2002,
                'id_user' => 34,
                'id_permission' => 130,
                'created_at' => '2026-03-24 21:43:29',
                'updated_at' => '2026-03-24 21:43:29'
            ],
            [
                'id_user_permission' => 2003,
                'id_user' => 34,
                'id_permission' => 131,
                'created_at' => '2026-03-24 21:43:31',
                'updated_at' => '2026-03-24 21:43:31'
            ],
            [
                'id_user_permission' => 2004,
                'id_user' => 34,
                'id_permission' => 132,
                'created_at' => '2026-03-24 21:43:32',
                'updated_at' => '2026-03-24 21:43:32'
            ],
            [
                'id_user_permission' => 2005,
                'id_user' => 21,
                'id_permission' => 173,
                'created_at' => '2026-03-24 21:43:35',
                'updated_at' => '2026-03-24 21:43:35'
            ],
            [
                'id_user_permission' => 2006,
                'id_user' => 34,
                'id_permission' => 133,
                'created_at' => '2026-03-24 21:43:37',
                'updated_at' => '2026-03-24 21:43:37'
            ],
            [
                'id_user_permission' => 2007,
                'id_user' => 34,
                'id_permission' => 134,
                'created_at' => '2026-03-24 21:43:37',
                'updated_at' => '2026-03-24 21:43:37'
            ],
            [
                'id_user_permission' => 2008,
                'id_user' => 34,
                'id_permission' => 135,
                'created_at' => '2026-03-24 21:43:37',
                'updated_at' => '2026-03-24 21:43:37'
            ],
            [
                'id_user_permission' => 2009,
                'id_user' => 34,
                'id_permission' => 136,
                'created_at' => '2026-03-24 21:43:41',
                'updated_at' => '2026-03-24 21:43:41'
            ],
            [
                'id_user_permission' => 2010,
                'id_user' => 34,
                'id_permission' => 137,
                'created_at' => '2026-03-24 21:43:41',
                'updated_at' => '2026-03-24 21:43:41'
            ],
            [
                'id_user_permission' => 2011,
                'id_user' => 34,
                'id_permission' => 138,
                'created_at' => '2026-03-24 21:43:47',
                'updated_at' => '2026-03-24 21:43:47'
            ],
            [
                'id_user_permission' => 2012,
                'id_user' => 21,
                'id_permission' => 243,
                'created_at' => '2026-03-24 21:43:49',
                'updated_at' => '2026-03-24 21:43:49'
            ],
            [
                'id_user_permission' => 2013,
                'id_user' => 21,
                'id_permission' => 244,
                'created_at' => '2026-03-24 21:43:51',
                'updated_at' => '2026-03-24 21:43:51'
            ],
            [
                'id_user_permission' => 2014,
                'id_user' => 21,
                'id_permission' => 180,
                'created_at' => '2026-03-24 21:43:54',
                'updated_at' => '2026-03-24 21:43:54'
            ],
            [
                'id_user_permission' => 2015,
                'id_user' => 34,
                'id_permission' => 141,
                'created_at' => '2026-03-24 21:43:55',
                'updated_at' => '2026-03-24 21:43:55'
            ],
            [
                'id_user_permission' => 2016,
                'id_user' => 34,
                'id_permission' => 142,
                'created_at' => '2026-03-24 21:43:56',
                'updated_at' => '2026-03-24 21:43:56'
            ],
            [
                'id_user_permission' => 2017,
                'id_user' => 34,
                'id_permission' => 143,
                'created_at' => '2026-03-24 21:43:56',
                'updated_at' => '2026-03-24 21:43:56'
            ],
            [
                'id_user_permission' => 2018,
                'id_user' => 34,
                'id_permission' => 144,
                'created_at' => '2026-03-24 21:43:56',
                'updated_at' => '2026-03-24 21:43:56'
            ],
            [
                'id_user_permission' => 2019,
                'id_user' => 21,
                'id_permission' => 184,
                'created_at' => '2026-03-24 21:43:58',
                'updated_at' => '2026-03-24 21:43:58'
            ],
            [
                'id_user_permission' => 2020,
                'id_user' => 34,
                'id_permission' => 145,
                'created_at' => '2026-03-24 21:44:00',
                'updated_at' => '2026-03-24 21:44:00'
            ],
            [
                'id_user_permission' => 2021,
                'id_user' => 34,
                'id_permission' => 146,
                'created_at' => '2026-03-24 21:44:00',
                'updated_at' => '2026-03-24 21:44:00'
            ],
            [
                'id_user_permission' => 2022,
                'id_user' => 34,
                'id_permission' => 147,
                'created_at' => '2026-03-24 21:44:00',
                'updated_at' => '2026-03-24 21:44:00'
            ],
            [
                'id_user_permission' => 2023,
                'id_user' => 34,
                'id_permission' => 148,
                'created_at' => '2026-03-24 21:44:02',
                'updated_at' => '2026-03-24 21:44:02'
            ],
            [
                'id_user_permission' => 2024,
                'id_user' => 21,
                'id_permission' => 193,
                'created_at' => '2026-03-24 21:44:04',
                'updated_at' => '2026-03-24 21:44:04'
            ],
            [
                'id_user_permission' => 2025,
                'id_user' => 21,
                'id_permission' => 197,
                'created_at' => '2026-03-24 21:44:12',
                'updated_at' => '2026-03-24 21:44:12'
            ],
            [
                'id_user_permission' => 2026,
                'id_user' => 21,
                'id_permission' => 198,
                'created_at' => '2026-03-24 21:44:14',
                'updated_at' => '2026-03-24 21:44:14'
            ],
            [
                'id_user_permission' => 2027,
                'id_user' => 34,
                'id_permission' => 149,
                'created_at' => '2026-03-24 21:44:16',
                'updated_at' => '2026-03-24 21:44:16'
            ],
            [
                'id_user_permission' => 2028,
                'id_user' => 34,
                'id_permission' => 150,
                'created_at' => '2026-03-24 21:44:17',
                'updated_at' => '2026-03-24 21:44:17'
            ],
            [
                'id_user_permission' => 2029,
                'id_user' => 34,
                'id_permission' => 151,
                'created_at' => '2026-03-24 21:44:17',
                'updated_at' => '2026-03-24 21:44:17'
            ],
            [
                'id_user_permission' => 2030,
                'id_user' => 34,
                'id_permission' => 157,
                'created_at' => '2026-03-24 21:44:26',
                'updated_at' => '2026-03-24 21:44:26'
            ],
            [
                'id_user_permission' => 2031,
                'id_user' => 34,
                'id_permission' => 158,
                'created_at' => '2026-03-24 21:44:27',
                'updated_at' => '2026-03-24 21:44:27'
            ],
            [
                'id_user_permission' => 2032,
                'id_user' => 21,
                'id_permission' => 246,
                'created_at' => '2026-03-24 21:44:27',
                'updated_at' => '2026-03-24 21:44:27'
            ],
            [
                'id_user_permission' => 2033,
                'id_user' => 21,
                'id_permission' => 221,
                'created_at' => '2026-03-24 21:44:32',
                'updated_at' => '2026-03-24 21:44:32'
            ],
            [
                'id_user_permission' => 2034,
                'id_user' => 21,
                'id_permission' => 247,
                'created_at' => '2026-03-24 21:44:37',
                'updated_at' => '2026-03-24 21:44:37'
            ],
            [
                'id_user_permission' => 2035,
                'id_user' => 34,
                'id_permission' => 223,
                'created_at' => '2026-03-24 21:44:40',
                'updated_at' => '2026-03-24 21:44:40'
            ],
            [
                'id_user_permission' => 2036,
                'id_user' => 20,
                'id_permission' => 88,
                'created_at' => '2026-03-24 21:45:27',
                'updated_at' => '2026-03-24 21:45:27'
            ],
            [
                'id_user_permission' => 2037,
                'id_user' => 20,
                'id_permission' => 87,
                'created_at' => '2026-03-24 21:45:29',
                'updated_at' => '2026-03-24 21:45:29'
            ],
            [
                'id_user_permission' => 2038,
                'id_user' => 57,
                'id_permission' => 1,
                'created_at' => '2026-03-24 21:46:03',
                'updated_at' => '2026-03-24 21:46:03'
            ],
            [
                'id_user_permission' => 2039,
                'id_user' => 57,
                'id_permission' => 13,
                'created_at' => '2026-03-24 21:46:33',
                'updated_at' => '2026-03-24 21:46:33'
            ],
            [
                'id_user_permission' => 2040,
                'id_user' => 57,
                'id_permission' => 14,
                'created_at' => '2026-03-24 21:46:34',
                'updated_at' => '2026-03-24 21:46:34'
            ],
            [
                'id_user_permission' => 2041,
                'id_user' => 57,
                'id_permission' => 15,
                'created_at' => '2026-03-24 21:46:36',
                'updated_at' => '2026-03-24 21:46:36'
            ],
            [
                'id_user_permission' => 2042,
                'id_user' => 57,
                'id_permission' => 16,
                'created_at' => '2026-03-24 21:46:38',
                'updated_at' => '2026-03-24 21:46:38'
            ],
            [
                'id_user_permission' => 2045,
                'id_user' => 57,
                'id_permission' => 19,
                'created_at' => '2026-03-24 21:46:42',
                'updated_at' => '2026-03-24 21:46:42'
            ],
            [
                'id_user_permission' => 2046,
                'id_user' => 57,
                'id_permission' => 23,
                'created_at' => '2026-03-24 21:46:46',
                'updated_at' => '2026-03-24 21:46:46'
            ],
            [
                'id_user_permission' => 2048,
                'id_user' => 20,
                'id_permission' => 116,
                'created_at' => '2026-03-24 21:46:57',
                'updated_at' => '2026-03-24 21:46:57'
            ],
            [
                'id_user_permission' => 2049,
                'id_user' => 20,
                'id_permission' => 115,
                'created_at' => '2026-03-24 21:46:58',
                'updated_at' => '2026-03-24 21:46:58'
            ],
            [
                'id_user_permission' => 2050,
                'id_user' => 57,
                'id_permission' => 39,
                'created_at' => '2026-03-24 21:47:00',
                'updated_at' => '2026-03-24 21:47:00'
            ],
            [
                'id_user_permission' => 2051,
                'id_user' => 57,
                'id_permission' => 40,
                'created_at' => '2026-03-24 21:47:02',
                'updated_at' => '2026-03-24 21:47:02'
            ],
            [
                'id_user_permission' => 2052,
                'id_user' => 57,
                'id_permission' => 41,
                'created_at' => '2026-03-24 21:47:02',
                'updated_at' => '2026-03-24 21:47:02'
            ],
            [
                'id_user_permission' => 2053,
                'id_user' => 57,
                'id_permission' => 42,
                'created_at' => '2026-03-24 21:47:04',
                'updated_at' => '2026-03-24 21:47:04'
            ],
            [
                'id_user_permission' => 2054,
                'id_user' => 20,
                'id_permission' => 123,
                'created_at' => '2026-03-24 21:47:07',
                'updated_at' => '2026-03-24 21:47:07'
            ],
            [
                'id_user_permission' => 2055,
                'id_user' => 20,
                'id_permission' => 124,
                'created_at' => '2026-03-24 21:47:08',
                'updated_at' => '2026-03-24 21:47:08'
            ],
            [
                'id_user_permission' => 2056,
                'id_user' => 57,
                'id_permission' => 59,
                'created_at' => '2026-03-24 21:47:16',
                'updated_at' => '2026-03-24 21:47:16'
            ],
            [
                'id_user_permission' => 2057,
                'id_user' => 57,
                'id_permission' => 63,
                'created_at' => '2026-03-24 21:47:21',
                'updated_at' => '2026-03-24 21:47:21'
            ],
            [
                'id_user_permission' => 2058,
                'id_user' => 57,
                'id_permission' => 75,
                'created_at' => '2026-03-24 21:47:28',
                'updated_at' => '2026-03-24 21:47:28'
            ],
            [
                'id_user_permission' => 2059,
                'id_user' => 57,
                'id_permission' => 78,
                'created_at' => '2026-03-24 21:47:38',
                'updated_at' => '2026-03-24 21:47:38'
            ],
            [
                'id_user_permission' => 2060,
                'id_user' => 57,
                'id_permission' => 79,
                'created_at' => '2026-03-24 21:47:43',
                'updated_at' => '2026-03-24 21:47:43'
            ],
            [
                'id_user_permission' => 2061,
                'id_user' => 57,
                'id_permission' => 80,
                'created_at' => '2026-03-24 21:47:45',
                'updated_at' => '2026-03-24 21:47:45'
            ],
            [
                'id_user_permission' => 2062,
                'id_user' => 57,
                'id_permission' => 81,
                'created_at' => '2026-03-24 21:47:45',
                'updated_at' => '2026-03-24 21:47:45'
            ],
            [
                'id_user_permission' => 2063,
                'id_user' => 57,
                'id_permission' => 82,
                'created_at' => '2026-03-24 21:47:46',
                'updated_at' => '2026-03-24 21:47:46'
            ],
            [
                'id_user_permission' => 2064,
                'id_user' => 57,
                'id_permission' => 83,
                'created_at' => '2026-03-24 21:47:47',
                'updated_at' => '2026-03-24 21:47:47'
            ],
            [
                'id_user_permission' => 2065,
                'id_user' => 57,
                'id_permission' => 84,
                'created_at' => '2026-03-24 21:47:47',
                'updated_at' => '2026-03-24 21:47:47'
            ],
            [
                'id_user_permission' => 2066,
                'id_user' => 57,
                'id_permission' => 85,
                'created_at' => '2026-03-24 21:47:51',
                'updated_at' => '2026-03-24 21:47:51'
            ],
            [
                'id_user_permission' => 2067,
                'id_user' => 57,
                'id_permission' => 86,
                'created_at' => '2026-03-24 21:47:52',
                'updated_at' => '2026-03-24 21:47:52'
            ],
            [
                'id_user_permission' => 2068,
                'id_user' => 57,
                'id_permission' => 87,
                'created_at' => '2026-03-24 21:47:52',
                'updated_at' => '2026-03-24 21:47:52'
            ],
            [
                'id_user_permission' => 2070,
                'id_user' => 20,
                'id_permission' => 127,
                'created_at' => '2026-03-24 21:47:54',
                'updated_at' => '2026-03-24 21:47:54'
            ],
            [
                'id_user_permission' => 2072,
                'id_user' => 57,
                'id_permission' => 89,
                'created_at' => '2026-03-24 21:47:59',
                'updated_at' => '2026-03-24 21:47:59'
            ],
            [
                'id_user_permission' => 2073,
                'id_user' => 57,
                'id_permission' => 90,
                'created_at' => '2026-03-24 21:48:00',
                'updated_at' => '2026-03-24 21:48:00'
            ],
            [
                'id_user_permission' => 2074,
                'id_user' => 20,
                'id_permission' => 134,
                'created_at' => '2026-03-24 21:48:06',
                'updated_at' => '2026-03-24 21:48:06'
            ],
            [
                'id_user_permission' => 2075,
                'id_user' => 20,
                'id_permission' => 133,
                'created_at' => '2026-03-24 21:48:09',
                'updated_at' => '2026-03-24 21:48:09'
            ],
            [
                'id_user_permission' => 2076,
                'id_user' => 20,
                'id_permission' => 135,
                'created_at' => '2026-03-24 21:48:09',
                'updated_at' => '2026-03-24 21:48:09'
            ],
            [
                'id_user_permission' => 2077,
                'id_user' => 57,
                'id_permission' => 91,
                'created_at' => '2026-03-24 21:48:11',
                'updated_at' => '2026-03-24 21:48:11'
            ],
            [
                'id_user_permission' => 2078,
                'id_user' => 57,
                'id_permission' => 92,
                'created_at' => '2026-03-24 21:48:12',
                'updated_at' => '2026-03-24 21:48:12'
            ],
            [
                'id_user_permission' => 2079,
                'id_user' => 57,
                'id_permission' => 93,
                'created_at' => '2026-03-24 21:48:14',
                'updated_at' => '2026-03-24 21:48:14'
            ],
            [
                'id_user_permission' => 2080,
                'id_user' => 57,
                'id_permission' => 94,
                'created_at' => '2026-03-24 21:48:15',
                'updated_at' => '2026-03-24 21:48:15'
            ],
            [
                'id_user_permission' => 2081,
                'id_user' => 20,
                'id_permission' => 141,
                'created_at' => '2026-03-24 21:48:19',
                'updated_at' => '2026-03-24 21:48:19'
            ],
            [
                'id_user_permission' => 2082,
                'id_user' => 57,
                'id_permission' => 111,
                'created_at' => '2026-03-24 21:48:35',
                'updated_at' => '2026-03-24 21:48:35'
            ],
            [
                'id_user_permission' => 2083,
                'id_user' => 57,
                'id_permission' => 112,
                'created_at' => '2026-03-24 21:48:36',
                'updated_at' => '2026-03-24 21:48:36'
            ],
            [
                'id_user_permission' => 2084,
                'id_user' => 20,
                'id_permission' => 145,
                'created_at' => '2026-03-24 21:48:40',
                'updated_at' => '2026-03-24 21:48:40'
            ],
            [
                'id_user_permission' => 2085,
                'id_user' => 20,
                'id_permission' => 146,
                'created_at' => '2026-03-24 21:48:42',
                'updated_at' => '2026-03-24 21:48:42'
            ],
            [
                'id_user_permission' => 2086,
                'id_user' => 20,
                'id_permission' => 150,
                'created_at' => '2026-03-24 21:49:34',
                'updated_at' => '2026-03-24 21:49:34'
            ],
            [
                'id_user_permission' => 2087,
                'id_user' => 20,
                'id_permission' => 151,
                'created_at' => '2026-03-24 21:49:35',
                'updated_at' => '2026-03-24 21:49:35'
            ],
            [
                'id_user_permission' => 2088,
                'id_user' => 57,
                'id_permission' => 129,
                'created_at' => '2026-03-24 21:49:35',
                'updated_at' => '2026-03-24 21:49:35'
            ],
            [
                'id_user_permission' => 2089,
                'id_user' => 57,
                'id_permission' => 131,
                'created_at' => '2026-03-24 21:49:37',
                'updated_at' => '2026-03-24 21:49:37'
            ],
            [
                'id_user_permission' => 2090,
                'id_user' => 57,
                'id_permission' => 130,
                'created_at' => '2026-03-24 21:49:37',
                'updated_at' => '2026-03-24 21:49:37'
            ],
            [
                'id_user_permission' => 2091,
                'id_user' => 57,
                'id_permission' => 132,
                'created_at' => '2026-03-24 21:49:39',
                'updated_at' => '2026-03-24 21:49:39'
            ],
            [
                'id_user_permission' => 2092,
                'id_user' => 57,
                'id_permission' => 133,
                'created_at' => '2026-03-24 21:49:40',
                'updated_at' => '2026-03-24 21:49:40'
            ],
            [
                'id_user_permission' => 2093,
                'id_user' => 57,
                'id_permission' => 134,
                'created_at' => '2026-03-24 21:49:40',
                'updated_at' => '2026-03-24 21:49:40'
            ],
            [
                'id_user_permission' => 2094,
                'id_user' => 20,
                'id_permission' => 154,
                'created_at' => '2026-03-24 21:49:41',
                'updated_at' => '2026-03-24 21:49:41'
            ],
            [
                'id_user_permission' => 2095,
                'id_user' => 20,
                'id_permission' => 155,
                'created_at' => '2026-03-24 21:49:43',
                'updated_at' => '2026-03-24 21:49:43'
            ],
            [
                'id_user_permission' => 2096,
                'id_user' => 57,
                'id_permission' => 135,
                'created_at' => '2026-03-24 21:49:43',
                'updated_at' => '2026-03-24 21:49:43'
            ],
            [
                'id_user_permission' => 2097,
                'id_user' => 57,
                'id_permission' => 136,
                'created_at' => '2026-03-24 21:49:44',
                'updated_at' => '2026-03-24 21:49:44'
            ],
            [
                'id_user_permission' => 2098,
                'id_user' => 57,
                'id_permission' => 137,
                'created_at' => '2026-03-24 21:49:44',
                'updated_at' => '2026-03-24 21:49:44'
            ],
            [
                'id_user_permission' => 2099,
                'id_user' => 57,
                'id_permission' => 138,
                'created_at' => '2026-03-24 21:49:48',
                'updated_at' => '2026-03-24 21:49:48'
            ],
            [
                'id_user_permission' => 2100,
                'id_user' => 20,
                'id_permission' => 156,
                'created_at' => '2026-03-24 21:49:53',
                'updated_at' => '2026-03-24 21:49:53'
            ],
            [
                'id_user_permission' => 2101,
                'id_user' => 57,
                'id_permission' => 140,
                'created_at' => '2026-03-24 21:49:56',
                'updated_at' => '2026-03-24 21:49:56'
            ],
            [
                'id_user_permission' => 2102,
                'id_user' => 57,
                'id_permission' => 142,
                'created_at' => '2026-03-24 21:49:57',
                'updated_at' => '2026-03-24 21:49:57'
            ],
            [
                'id_user_permission' => 2103,
                'id_user' => 57,
                'id_permission' => 143,
                'created_at' => '2026-03-24 21:49:59',
                'updated_at' => '2026-03-24 21:49:59'
            ],
            [
                'id_user_permission' => 2104,
                'id_user' => 57,
                'id_permission' => 144,
                'created_at' => '2026-03-24 21:50:02',
                'updated_at' => '2026-03-24 21:50:02'
            ],
            [
                'id_user_permission' => 2105,
                'id_user' => 57,
                'id_permission' => 141,
                'created_at' => '2026-03-24 21:50:04',
                'updated_at' => '2026-03-24 21:50:04'
            ],
            [
                'id_user_permission' => 2106,
                'id_user' => 20,
                'id_permission' => 162,
                'created_at' => '2026-03-24 21:50:07',
                'updated_at' => '2026-03-24 21:50:07'
            ],
            [
                'id_user_permission' => 2108,
                'id_user' => 57,
                'id_permission' => 146,
                'created_at' => '2026-03-24 21:50:13',
                'updated_at' => '2026-03-24 21:50:13'
            ],
            [
                'id_user_permission' => 2109,
                'id_user' => 57,
                'id_permission' => 145,
                'created_at' => '2026-03-24 21:50:14',
                'updated_at' => '2026-03-24 21:50:14'
            ],
            [
                'id_user_permission' => 2110,
                'id_user' => 57,
                'id_permission' => 147,
                'created_at' => '2026-03-24 21:50:15',
                'updated_at' => '2026-03-24 21:50:15'
            ],
            [
                'id_user_permission' => 2111,
                'id_user' => 20,
                'id_permission' => 169,
                'created_at' => '2026-03-24 21:50:15',
                'updated_at' => '2026-03-24 21:50:15'
            ],
            [
                'id_user_permission' => 2112,
                'id_user' => 20,
                'id_permission' => 170,
                'created_at' => '2026-03-24 21:50:19',
                'updated_at' => '2026-03-24 21:50:19'
            ],
            [
                'id_user_permission' => 2113,
                'id_user' => 57,
                'id_permission' => 148,
                'created_at' => '2026-03-24 21:50:20',
                'updated_at' => '2026-03-24 21:50:20'
            ],
            [
                'id_user_permission' => 2114,
                'id_user' => 57,
                'id_permission' => 149,
                'created_at' => '2026-03-24 21:50:21',
                'updated_at' => '2026-03-24 21:50:21'
            ],
            [
                'id_user_permission' => 2115,
                'id_user' => 57,
                'id_permission' => 150,
                'created_at' => '2026-03-24 21:50:21',
                'updated_at' => '2026-03-24 21:50:21'
            ],
            [
                'id_user_permission' => 2116,
                'id_user' => 20,
                'id_permission' => 171,
                'created_at' => '2026-03-24 21:50:23',
                'updated_at' => '2026-03-24 21:50:23'
            ],
            [
                'id_user_permission' => 2117,
                'id_user' => 57,
                'id_permission' => 151,
                'created_at' => '2026-03-24 21:50:24',
                'updated_at' => '2026-03-24 21:50:24'
            ],
            [
                'id_user_permission' => 2118,
                'id_user' => 20,
                'id_permission' => 172,
                'created_at' => '2026-03-24 21:50:25',
                'updated_at' => '2026-03-24 21:50:25'
            ],
            [
                'id_user_permission' => 2119,
                'id_user' => 20,
                'id_permission' => 173,
                'created_at' => '2026-03-24 21:50:29',
                'updated_at' => '2026-03-24 21:50:29'
            ],
            [
                'id_user_permission' => 2120,
                'id_user' => 57,
                'id_permission' => 157,
                'created_at' => '2026-03-24 21:50:31',
                'updated_at' => '2026-03-24 21:50:31'
            ],
            [
                'id_user_permission' => 2121,
                'id_user' => 57,
                'id_permission' => 158,
                'created_at' => '2026-03-24 21:50:33',
                'updated_at' => '2026-03-24 21:50:33'
            ],
            [
                'id_user_permission' => 2122,
                'id_user' => 20,
                'id_permission' => 243,
                'created_at' => '2026-03-24 21:50:40',
                'updated_at' => '2026-03-24 21:50:40'
            ],
            [
                'id_user_permission' => 2123,
                'id_user' => 20,
                'id_permission' => 244,
                'created_at' => '2026-03-24 21:50:42',
                'updated_at' => '2026-03-24 21:50:42'
            ],
            [
                'id_user_permission' => 2124,
                'id_user' => 20,
                'id_permission' => 180,
                'created_at' => '2026-03-24 21:50:48',
                'updated_at' => '2026-03-24 21:50:48'
            ],
            [
                'id_user_permission' => 2125,
                'id_user' => 20,
                'id_permission' => 184,
                'created_at' => '2026-03-24 21:50:52',
                'updated_at' => '2026-03-24 21:50:52'
            ],
            [
                'id_user_permission' => 2126,
                'id_user' => 20,
                'id_permission' => 191,
                'created_at' => '2026-03-24 21:51:06',
                'updated_at' => '2026-03-24 21:51:06'
            ],
            [
                'id_user_permission' => 2127,
                'id_user' => 20,
                'id_permission' => 192,
                'created_at' => '2026-03-24 21:51:08',
                'updated_at' => '2026-03-24 21:51:08'
            ],
            [
                'id_user_permission' => 2128,
                'id_user' => 20,
                'id_permission' => 193,
                'created_at' => '2026-03-24 21:51:08',
                'updated_at' => '2026-03-24 21:51:08'
            ],
            [
                'id_user_permission' => 2129,
                'id_user' => 20,
                'id_permission' => 197,
                'created_at' => '2026-03-24 21:51:19',
                'updated_at' => '2026-03-24 21:51:19'
            ],
            [
                'id_user_permission' => 2130,
                'id_user' => 20,
                'id_permission' => 198,
                'created_at' => '2026-03-24 21:51:21',
                'updated_at' => '2026-03-24 21:51:21'
            ],
            [
                'id_user_permission' => 2131,
                'id_user' => 20,
                'id_permission' => 246,
                'created_at' => '2026-03-24 21:51:28',
                'updated_at' => '2026-03-24 21:51:28'
            ],
            [
                'id_user_permission' => 2132,
                'id_user' => 57,
                'id_permission' => 223,
                'created_at' => '2026-03-24 21:51:36',
                'updated_at' => '2026-03-24 21:51:36'
            ],
            [
                'id_user_permission' => 2133,
                'id_user' => 20,
                'id_permission' => 221,
                'created_at' => '2026-03-24 21:51:36',
                'updated_at' => '2026-03-24 21:51:36'
            ],
            [
                'id_user_permission' => 2134,
                'id_user' => 20,
                'id_permission' => 247,
                'created_at' => '2026-03-24 21:51:42',
                'updated_at' => '2026-03-24 21:51:42'
            ],
            [
                'id_user_permission' => 2135,
                'id_user' => 22,
                'id_permission' => 1,
                'created_at' => '2026-03-24 21:52:00',
                'updated_at' => '2026-03-24 21:52:00'
            ],
            [
                'id_user_permission' => 2136,
                'id_user' => 22,
                'id_permission' => 5,
                'created_at' => '2026-03-24 21:52:07',
                'updated_at' => '2026-03-24 21:52:07'
            ],
            [
                'id_user_permission' => 2137,
                'id_user' => 22,
                'id_permission' => 9,
                'created_at' => '2026-03-24 21:52:07',
                'updated_at' => '2026-03-24 21:52:07'
            ],
            [
                'id_user_permission' => 2138,
                'id_user' => 22,
                'id_permission' => 13,
                'created_at' => '2026-03-24 21:52:07',
                'updated_at' => '2026-03-24 21:52:07'
            ],
            [
                'id_user_permission' => 2139,
                'id_user' => 22,
                'id_permission' => 19,
                'created_at' => '2026-03-24 21:52:07',
                'updated_at' => '2026-03-24 21:52:07'
            ],
            [
                'id_user_permission' => 2140,
                'id_user' => 22,
                'id_permission' => 23,
                'created_at' => '2026-03-24 21:52:14',
                'updated_at' => '2026-03-24 21:52:14'
            ],
            [
                'id_user_permission' => 2141,
                'id_user' => 22,
                'id_permission' => 39,
                'created_at' => '2026-03-24 21:52:20',
                'updated_at' => '2026-03-24 21:52:20'
            ],
            [
                'id_user_permission' => 2142,
                'id_user' => 22,
                'id_permission' => 43,
                'created_at' => '2026-03-24 21:52:27',
                'updated_at' => '2026-03-24 21:52:27'
            ],
            [
                'id_user_permission' => 2143,
                'id_user' => 22,
                'id_permission' => 59,
                'created_at' => '2026-03-24 21:52:38',
                'updated_at' => '2026-03-24 21:52:38'
            ],
            [
                'id_user_permission' => 2144,
                'id_user' => 64,
                'id_permission' => 1,
                'created_at' => '2026-03-24 21:52:38',
                'updated_at' => '2026-03-24 21:52:38'
            ],
            [
                'id_user_permission' => 2145,
                'id_user' => 22,
                'id_permission' => 63,
                'created_at' => '2026-03-24 21:52:41',
                'updated_at' => '2026-03-24 21:52:41'
            ],
            [
                'id_user_permission' => 2146,
                'id_user' => 64,
                'id_permission' => 13,
                'created_at' => '2026-03-24 21:52:47',
                'updated_at' => '2026-03-24 21:52:47'
            ],
            [
                'id_user_permission' => 2147,
                'id_user' => 64,
                'id_permission' => 14,
                'created_at' => '2026-03-24 21:52:50',
                'updated_at' => '2026-03-24 21:52:50'
            ],
            [
                'id_user_permission' => 2148,
                'id_user' => 64,
                'id_permission' => 15,
                'created_at' => '2026-03-24 21:52:50',
                'updated_at' => '2026-03-24 21:52:50'
            ],
            [
                'id_user_permission' => 2149,
                'id_user' => 64,
                'id_permission' => 16,
                'created_at' => '2026-03-24 21:52:50',
                'updated_at' => '2026-03-24 21:52:50'
            ],
            [
                'id_user_permission' => 2150,
                'id_user' => 22,
                'id_permission' => 73,
                'created_at' => '2026-03-24 21:52:51',
                'updated_at' => '2026-03-24 21:52:51'
            ],
            [
                'id_user_permission' => 2151,
                'id_user' => 22,
                'id_permission' => 76,
                'created_at' => '2026-03-24 21:52:59',
                'updated_at' => '2026-03-24 21:52:59'
            ],
            [
                'id_user_permission' => 2152,
                'id_user' => 64,
                'id_permission' => 19,
                'created_at' => '2026-03-24 21:52:59',
                'updated_at' => '2026-03-24 21:52:59'
            ],
            [
                'id_user_permission' => 2153,
                'id_user' => 22,
                'id_permission' => 83,
                'created_at' => '2026-03-24 21:53:07',
                'updated_at' => '2026-03-24 21:53:07'
            ],
            [
                'id_user_permission' => 2154,
                'id_user' => 64,
                'id_permission' => 39,
                'created_at' => '2026-03-24 21:53:10',
                'updated_at' => '2026-03-24 21:53:10'
            ],
            [
                'id_user_permission' => 2155,
                'id_user' => 64,
                'id_permission' => 40,
                'created_at' => '2026-03-24 21:53:13',
                'updated_at' => '2026-03-24 21:53:13'
            ],
            [
                'id_user_permission' => 2156,
                'id_user' => 64,
                'id_permission' => 41,
                'created_at' => '2026-03-24 21:53:13',
                'updated_at' => '2026-03-24 21:53:13'
            ],
            [
                'id_user_permission' => 2157,
                'id_user' => 64,
                'id_permission' => 42,
                'created_at' => '2026-03-24 21:53:13',
                'updated_at' => '2026-03-24 21:53:13'
            ],
            [
                'id_user_permission' => 2158,
                'id_user' => 22,
                'id_permission' => 82,
                'created_at' => '2026-03-24 21:53:16',
                'updated_at' => '2026-03-24 21:53:16'
            ],
            [
                'id_user_permission' => 2159,
                'id_user' => 64,
                'id_permission' => 59,
                'created_at' => '2026-03-24 21:53:22',
                'updated_at' => '2026-03-24 21:53:22'
            ],
            [
                'id_user_permission' => 2160,
                'id_user' => 22,
                'id_permission' => 87,
                'created_at' => '2026-03-24 21:53:23',
                'updated_at' => '2026-03-24 21:53:23'
            ],
            [
                'id_user_permission' => 2161,
                'id_user' => 22,
                'id_permission' => 88,
                'created_at' => '2026-03-24 21:53:27',
                'updated_at' => '2026-03-24 21:53:27'
            ],
            [
                'id_user_permission' => 2162,
                'id_user' => 64,
                'id_permission' => 63,
                'created_at' => '2026-03-24 21:53:28',
                'updated_at' => '2026-03-24 21:53:28'
            ],
            [
                'id_user_permission' => 2163,
                'id_user' => 22,
                'id_permission' => 89,
                'created_at' => '2026-03-24 21:53:30',
                'updated_at' => '2026-03-24 21:53:30'
            ],
            [
                'id_user_permission' => 2164,
                'id_user' => 22,
                'id_permission' => 94,
                'created_at' => '2026-03-24 21:53:34',
                'updated_at' => '2026-03-24 21:53:34'
            ],
            [
                'id_user_permission' => 2165,
                'id_user' => 22,
                'id_permission' => 98,
                'created_at' => '2026-03-24 21:53:42',
                'updated_at' => '2026-03-24 21:53:42'
            ],
            [
                'id_user_permission' => 2166,
                'id_user' => 64,
                'id_permission' => 75,
                'created_at' => '2026-03-24 21:53:44',
                'updated_at' => '2026-03-24 21:53:44'
            ],
            [
                'id_user_permission' => 2167,
                'id_user' => 22,
                'id_permission' => 99,
                'created_at' => '2026-03-24 21:53:44',
                'updated_at' => '2026-03-24 21:53:44'
            ],
            [
                'id_user_permission' => 2168,
                'id_user' => 64,
                'id_permission' => 78,
                'created_at' => '2026-03-24 21:53:45',
                'updated_at' => '2026-03-24 21:53:45'
            ],
            [
                'id_user_permission' => 2169,
                'id_user' => 64,
                'id_permission' => 79,
                'created_at' => '2026-03-24 21:53:45',
                'updated_at' => '2026-03-24 21:53:45'
            ],
            [
                'id_user_permission' => 2170,
                'id_user' => 64,
                'id_permission' => 80,
                'created_at' => '2026-03-24 21:53:45',
                'updated_at' => '2026-03-24 21:53:45'
            ],
            [
                'id_user_permission' => 2171,
                'id_user' => 22,
                'id_permission' => 102,
                'created_at' => '2026-03-24 21:53:51',
                'updated_at' => '2026-03-24 21:53:51'
            ],
            [
                'id_user_permission' => 2172,
                'id_user' => 22,
                'id_permission' => 103,
                'created_at' => '2026-03-24 21:53:53',
                'updated_at' => '2026-03-24 21:53:53'
            ],
            [
                'id_user_permission' => 2173,
                'id_user' => 22,
                'id_permission' => 104,
                'created_at' => '2026-03-24 21:53:53',
                'updated_at' => '2026-03-24 21:53:53'
            ],
            [
                'id_user_permission' => 2174,
                'id_user' => 22,
                'id_permission' => 105,
                'created_at' => '2026-03-24 21:53:58',
                'updated_at' => '2026-03-24 21:53:58'
            ],
            [
                'id_user_permission' => 2175,
                'id_user' => 64,
                'id_permission' => 81,
                'created_at' => '2026-03-24 21:53:58',
                'updated_at' => '2026-03-24 21:53:58'
            ],
            [
                'id_user_permission' => 2176,
                'id_user' => 64,
                'id_permission' => 82,
                'created_at' => '2026-03-24 21:54:00',
                'updated_at' => '2026-03-24 21:54:00'
            ],
            [
                'id_user_permission' => 2177,
                'id_user' => 64,
                'id_permission' => 83,
                'created_at' => '2026-03-24 21:54:00',
                'updated_at' => '2026-03-24 21:54:00'
            ],
            [
                'id_user_permission' => 2178,
                'id_user' => 64,
                'id_permission' => 84,
                'created_at' => '2026-03-24 21:54:00',
                'updated_at' => '2026-03-24 21:54:00'
            ],
            [
                'id_user_permission' => 2179,
                'id_user' => 64,
                'id_permission' => 85,
                'created_at' => '2026-03-24 21:54:09',
                'updated_at' => '2026-03-24 21:54:09'
            ],
            [
                'id_user_permission' => 2180,
                'id_user' => 64,
                'id_permission' => 86,
                'created_at' => '2026-03-24 21:54:12',
                'updated_at' => '2026-03-24 21:54:12'
            ],
            [
                'id_user_permission' => 2181,
                'id_user' => 64,
                'id_permission' => 87,
                'created_at' => '2026-03-24 21:54:12',
                'updated_at' => '2026-03-24 21:54:12'
            ],
            [
                'id_user_permission' => 2183,
                'id_user' => 64,
                'id_permission' => 89,
                'created_at' => '2026-03-24 21:54:27',
                'updated_at' => '2026-03-24 21:54:27'
            ],
            [
                'id_user_permission' => 2184,
                'id_user' => 64,
                'id_permission' => 90,
                'created_at' => '2026-03-24 21:54:38',
                'updated_at' => '2026-03-24 21:54:38'
            ],
            [
                'id_user_permission' => 2185,
                'id_user' => 64,
                'id_permission' => 91,
                'created_at' => '2026-03-24 21:54:40',
                'updated_at' => '2026-03-24 21:54:40'
            ],
            [
                'id_user_permission' => 2186,
                'id_user' => 64,
                'id_permission' => 92,
                'created_at' => '2026-03-24 21:54:40',
                'updated_at' => '2026-03-24 21:54:40'
            ],
            [
                'id_user_permission' => 2187,
                'id_user' => 64,
                'id_permission' => 94,
                'created_at' => '2026-03-24 21:54:40',
                'updated_at' => '2026-03-24 21:54:40'
            ],
            [
                'id_user_permission' => 2188,
                'id_user' => 64,
                'id_permission' => 93,
                'created_at' => '2026-03-24 21:54:40',
                'updated_at' => '2026-03-24 21:54:40'
            ],
            [
                'id_user_permission' => 2189,
                'id_user' => 64,
                'id_permission' => 111,
                'created_at' => '2026-03-24 21:54:50',
                'updated_at' => '2026-03-24 21:54:50'
            ],
            [
                'id_user_permission' => 2190,
                'id_user' => 64,
                'id_permission' => 112,
                'created_at' => '2026-03-24 21:54:54',
                'updated_at' => '2026-03-24 21:54:54'
            ],
            [
                'id_user_permission' => 2191,
                'id_user' => 64,
                'id_permission' => 129,
                'created_at' => '2026-03-24 21:55:14',
                'updated_at' => '2026-03-24 21:55:14'
            ],
            [
                'id_user_permission' => 2192,
                'id_user' => 64,
                'id_permission' => 130,
                'created_at' => '2026-03-24 21:55:21',
                'updated_at' => '2026-03-24 21:55:21'
            ],
            [
                'id_user_permission' => 2193,
                'id_user' => 64,
                'id_permission' => 131,
                'created_at' => '2026-03-24 21:55:21',
                'updated_at' => '2026-03-24 21:55:21'
            ],
            [
                'id_user_permission' => 2194,
                'id_user' => 64,
                'id_permission' => 133,
                'created_at' => '2026-03-24 21:55:21',
                'updated_at' => '2026-03-24 21:55:21'
            ],
            [
                'id_user_permission' => 2195,
                'id_user' => 64,
                'id_permission' => 132,
                'created_at' => '2026-03-24 21:55:21',
                'updated_at' => '2026-03-24 21:55:21'
            ],
            [
                'id_user_permission' => 2196,
                'id_user' => 64,
                'id_permission' => 134,
                'created_at' => '2026-03-24 21:55:21',
                'updated_at' => '2026-03-24 21:55:21'
            ],
            [
                'id_user_permission' => 2197,
                'id_user' => 64,
                'id_permission' => 135,
                'created_at' => '2026-03-24 21:55:21',
                'updated_at' => '2026-03-24 21:55:21'
            ],
            [
                'id_user_permission' => 2198,
                'id_user' => 64,
                'id_permission' => 136,
                'created_at' => '2026-03-24 21:55:43',
                'updated_at' => '2026-03-24 21:55:43'
            ],
            [
                'id_user_permission' => 2199,
                'id_user' => 64,
                'id_permission' => 137,
                'created_at' => '2026-03-24 21:55:47',
                'updated_at' => '2026-03-24 21:55:47'
            ],
            [
                'id_user_permission' => 2200,
                'id_user' => 64,
                'id_permission' => 138,
                'created_at' => '2026-03-24 21:55:47',
                'updated_at' => '2026-03-24 21:55:47'
            ],
            [
                'id_user_permission' => 2201,
                'id_user' => 22,
                'id_permission' => 115,
                'created_at' => '2026-03-24 22:11:57',
                'updated_at' => '2026-03-24 22:11:57'
            ],
            [
                'id_user_permission' => 2202,
                'id_user' => 22,
                'id_permission' => 116,
                'created_at' => '2026-03-24 22:11:58',
                'updated_at' => '2026-03-24 22:11:58'
            ],
            [
                'id_user_permission' => 2203,
                'id_user' => 22,
                'id_permission' => 125,
                'created_at' => '2026-03-24 22:12:27',
                'updated_at' => '2026-03-24 22:12:27'
            ],
            [
                'id_user_permission' => 2204,
                'id_user' => 22,
                'id_permission' => 126,
                'created_at' => '2026-03-24 22:12:29',
                'updated_at' => '2026-03-24 22:12:29'
            ],
            [
                'id_user_permission' => 2205,
                'id_user' => 22,
                'id_permission' => 127,
                'created_at' => '2026-03-24 22:12:36',
                'updated_at' => '2026-03-24 22:12:36'
            ],
            [
                'id_user_permission' => 2206,
                'id_user' => 22,
                'id_permission' => 135,
                'created_at' => '2026-03-24 22:12:44',
                'updated_at' => '2026-03-24 22:12:44'
            ],
            [
                'id_user_permission' => 2207,
                'id_user' => 22,
                'id_permission' => 139,
                'created_at' => '2026-03-24 22:13:30',
                'updated_at' => '2026-03-24 22:13:30'
            ],
            [
                'id_user_permission' => 2208,
                'id_user' => 22,
                'id_permission' => 140,
                'created_at' => '2026-03-24 22:13:31',
                'updated_at' => '2026-03-24 22:13:31'
            ],
            [
                'id_user_permission' => 2209,
                'id_user' => 22,
                'id_permission' => 141,
                'created_at' => '2026-03-24 22:13:34',
                'updated_at' => '2026-03-24 22:13:34'
            ],
            [
                'id_user_permission' => 2210,
                'id_user' => 22,
                'id_permission' => 145,
                'created_at' => '2026-03-24 22:13:43',
                'updated_at' => '2026-03-24 22:13:43'
            ],
            [
                'id_user_permission' => 2211,
                'id_user' => 22,
                'id_permission' => 146,
                'created_at' => '2026-03-24 22:13:46',
                'updated_at' => '2026-03-24 22:13:46'
            ],
            [
                'id_user_permission' => 2212,
                'id_user' => 22,
                'id_permission' => 150,
                'created_at' => '2026-03-24 22:13:52',
                'updated_at' => '2026-03-24 22:13:52'
            ],
            [
                'id_user_permission' => 2213,
                'id_user' => 22,
                'id_permission' => 151,
                'created_at' => '2026-03-24 22:13:53',
                'updated_at' => '2026-03-24 22:13:53'
            ],
            [
                'id_user_permission' => 2214,
                'id_user' => 22,
                'id_permission' => 154,
                'created_at' => '2026-03-24 22:13:59',
                'updated_at' => '2026-03-24 22:13:59'
            ],
            [
                'id_user_permission' => 2215,
                'id_user' => 22,
                'id_permission' => 155,
                'created_at' => '2026-03-24 22:14:00',
                'updated_at' => '2026-03-24 22:14:00'
            ],
            [
                'id_user_permission' => 2216,
                'id_user' => 22,
                'id_permission' => 156,
                'created_at' => '2026-03-24 22:14:04',
                'updated_at' => '2026-03-24 22:14:04'
            ],
            [
                'id_user_permission' => 2219,
                'id_user' => 22,
                'id_permission' => 161,
                'created_at' => '2026-03-24 22:14:18',
                'updated_at' => '2026-03-24 22:14:18'
            ],
            [
                'id_user_permission' => 2220,
                'id_user' => 22,
                'id_permission' => 162,
                'created_at' => '2026-03-24 22:14:19',
                'updated_at' => '2026-03-24 22:14:19'
            ],
            [
                'id_user_permission' => 2221,
                'id_user' => 22,
                'id_permission' => 171,
                'created_at' => '2026-03-24 22:14:28',
                'updated_at' => '2026-03-24 22:14:28'
            ],
            [
                'id_user_permission' => 2222,
                'id_user' => 22,
                'id_permission' => 172,
                'created_at' => '2026-03-24 22:14:30',
                'updated_at' => '2026-03-24 22:14:30'
            ],
            [
                'id_user_permission' => 2223,
                'id_user' => 22,
                'id_permission' => 173,
                'created_at' => '2026-03-24 22:14:33',
                'updated_at' => '2026-03-24 22:14:33'
            ],
            [
                'id_user_permission' => 2226,
                'id_user' => 22,
                'id_permission' => 244,
                'created_at' => '2026-03-24 22:15:09',
                'updated_at' => '2026-03-24 22:15:09'
            ],
            [
                'id_user_permission' => 2227,
                'id_user' => 22,
                'id_permission' => 243,
                'created_at' => '2026-03-24 22:15:10',
                'updated_at' => '2026-03-24 22:15:10'
            ],
            [
                'id_user_permission' => 2228,
                'id_user' => 22,
                'id_permission' => 180,
                'created_at' => '2026-03-24 22:15:15',
                'updated_at' => '2026-03-24 22:15:15'
            ],
            [
                'id_user_permission' => 2229,
                'id_user' => 22,
                'id_permission' => 184,
                'created_at' => '2026-03-24 22:15:22',
                'updated_at' => '2026-03-24 22:15:22'
            ],
            [
                'id_user_permission' => 2230,
                'id_user' => 22,
                'id_permission' => 191,
                'created_at' => '2026-03-24 22:16:58',
                'updated_at' => '2026-03-24 22:16:58'
            ],
            [
                'id_user_permission' => 2231,
                'id_user' => 22,
                'id_permission' => 192,
                'created_at' => '2026-03-24 22:16:59',
                'updated_at' => '2026-03-24 22:16:59'
            ],
            [
                'id_user_permission' => 2232,
                'id_user' => 22,
                'id_permission' => 193,
                'created_at' => '2026-03-24 22:17:12',
                'updated_at' => '2026-03-24 22:17:12'
            ],
            [
                'id_user_permission' => 2233,
                'id_user' => 22,
                'id_permission' => 197,
                'created_at' => '2026-03-24 22:17:28',
                'updated_at' => '2026-03-24 22:17:28'
            ],
            [
                'id_user_permission' => 2234,
                'id_user' => 22,
                'id_permission' => 198,
                'created_at' => '2026-03-24 22:17:30',
                'updated_at' => '2026-03-24 22:17:30'
            ],
            [
                'id_user_permission' => 2235,
                'id_user' => 22,
                'id_permission' => 203,
                'created_at' => '2026-03-24 22:17:45',
                'updated_at' => '2026-03-24 22:17:45'
            ],
            [
                'id_user_permission' => 2236,
                'id_user' => 22,
                'id_permission' => 204,
                'created_at' => '2026-03-24 22:19:04',
                'updated_at' => '2026-03-24 22:19:04'
            ],
            [
                'id_user_permission' => 2237,
                'id_user' => 22,
                'id_permission' => 219,
                'created_at' => '2026-03-24 22:19:16',
                'updated_at' => '2026-03-24 22:19:16'
            ],
            [
                'id_user_permission' => 2238,
                'id_user' => 22,
                'id_permission' => 220,
                'created_at' => '2026-03-24 22:19:19',
                'updated_at' => '2026-03-24 22:19:19'
            ],
            [
                'id_user_permission' => 2239,
                'id_user' => 22,
                'id_permission' => 246,
                'created_at' => '2026-03-24 22:19:19',
                'updated_at' => '2026-03-24 22:19:19'
            ],
            [
                'id_user_permission' => 2240,
                'id_user' => 22,
                'id_permission' => 221,
                'created_at' => '2026-03-24 22:19:39',
                'updated_at' => '2026-03-24 22:19:39'
            ],
            [
                'id_user_permission' => 2241,
                'id_user' => 22,
                'id_permission' => 247,
                'created_at' => '2026-03-24 22:19:47',
                'updated_at' => '2026-03-24 22:19:47'
            ],
            [
                'id_user_permission' => 2242,
                'id_user' => 22,
                'id_permission' => 254,
                'created_at' => '2026-03-24 22:19:55',
                'updated_at' => '2026-03-24 22:19:55'
            ],
            [
                'id_user_permission' => 2243,
                'id_user' => 27,
                'id_permission' => 1,
                'created_at' => '2026-03-24 22:28:35',
                'updated_at' => '2026-03-24 22:28:35'
            ],
            [
                'id_user_permission' => 2244,
                'id_user' => 27,
                'id_permission' => 5,
                'created_at' => '2026-03-24 22:28:41',
                'updated_at' => '2026-03-24 22:28:41'
            ],
            [
                'id_user_permission' => 2245,
                'id_user' => 27,
                'id_permission' => 13,
                'created_at' => '2026-03-24 22:28:46',
                'updated_at' => '2026-03-24 22:28:46'
            ],
            [
                'id_user_permission' => 2246,
                'id_user' => 27,
                'id_permission' => 14,
                'created_at' => '2026-03-24 22:28:48',
                'updated_at' => '2026-03-24 22:28:48'
            ],
            [
                'id_user_permission' => 2247,
                'id_user' => 27,
                'id_permission' => 15,
                'created_at' => '2026-03-24 22:28:48',
                'updated_at' => '2026-03-24 22:28:48'
            ],
            [
                'id_user_permission' => 2248,
                'id_user' => 27,
                'id_permission' => 16,
                'created_at' => '2026-03-24 22:28:48',
                'updated_at' => '2026-03-24 22:28:48'
            ],
            [
                'id_user_permission' => 2249,
                'id_user' => 27,
                'id_permission' => 19,
                'created_at' => '2026-03-24 22:29:18',
                'updated_at' => '2026-03-24 22:29:18'
            ],
            [
                'id_user_permission' => 2250,
                'id_user' => 27,
                'id_permission' => 23,
                'created_at' => '2026-03-24 22:29:35',
                'updated_at' => '2026-03-24 22:29:35'
            ],
            [
                'id_user_permission' => 2251,
                'id_user' => 27,
                'id_permission' => 39,
                'created_at' => '2026-03-24 22:29:48',
                'updated_at' => '2026-03-24 22:29:48'
            ],
            [
                'id_user_permission' => 2252,
                'id_user' => 27,
                'id_permission' => 59,
                'created_at' => '2026-03-24 22:30:03',
                'updated_at' => '2026-03-24 22:30:03'
            ],
            [
                'id_user_permission' => 2253,
                'id_user' => 27,
                'id_permission' => 63,
                'created_at' => '2026-03-24 22:30:05',
                'updated_at' => '2026-03-24 22:30:05'
            ],
            [
                'id_user_permission' => 2254,
                'id_user' => 27,
                'id_permission' => 74,
                'created_at' => '2026-03-24 22:30:28',
                'updated_at' => '2026-03-24 22:30:28'
            ],
            [
                'id_user_permission' => 2255,
                'id_user' => 27,
                'id_permission' => 75,
                'created_at' => '2026-03-24 22:30:29',
                'updated_at' => '2026-03-24 22:30:29'
            ],
            [
                'id_user_permission' => 2257,
                'id_user' => 27,
                'id_permission' => 77,
                'created_at' => '2026-03-24 22:30:38',
                'updated_at' => '2026-03-24 22:30:38'
            ],
            [
                'id_user_permission' => 2258,
                'id_user' => 27,
                'id_permission' => 79,
                'created_at' => '2026-03-24 22:30:45',
                'updated_at' => '2026-03-24 22:30:45'
            ],
            [
                'id_user_permission' => 2259,
                'id_user' => 27,
                'id_permission' => 80,
                'created_at' => '2026-03-24 22:30:47',
                'updated_at' => '2026-03-24 22:30:47'
            ],
            [
                'id_user_permission' => 2260,
                'id_user' => 27,
                'id_permission' => 81,
                'created_at' => '2026-03-24 22:30:47',
                'updated_at' => '2026-03-24 22:30:47'
            ],
            [
                'id_user_permission' => 2261,
                'id_user' => 27,
                'id_permission' => 82,
                'created_at' => '2026-03-24 22:30:47',
                'updated_at' => '2026-03-24 22:30:47'
            ],
            [
                'id_user_permission' => 2262,
                'id_user' => 27,
                'id_permission' => 83,
                'created_at' => '2026-03-24 22:30:52',
                'updated_at' => '2026-03-24 22:30:52'
            ],
            [
                'id_user_permission' => 2263,
                'id_user' => 27,
                'id_permission' => 84,
                'created_at' => '2026-03-24 22:30:53',
                'updated_at' => '2026-03-24 22:30:53'
            ],
            [
                'id_user_permission' => 2264,
                'id_user' => 27,
                'id_permission' => 85,
                'created_at' => '2026-03-24 22:30:53',
                'updated_at' => '2026-03-24 22:30:53'
            ],
            [
                'id_user_permission' => 2265,
                'id_user' => 27,
                'id_permission' => 86,
                'created_at' => '2026-03-24 22:30:53',
                'updated_at' => '2026-03-24 22:30:53'
            ],
            [
                'id_user_permission' => 2266,
                'id_user' => 27,
                'id_permission' => 87,
                'created_at' => '2026-03-24 22:30:53',
                'updated_at' => '2026-03-24 22:30:53'
            ],
            [
                'id_user_permission' => 2267,
                'id_user' => 27,
                'id_permission' => 88,
                'created_at' => '2026-03-24 22:31:01',
                'updated_at' => '2026-03-24 22:31:01'
            ],
            [
                'id_user_permission' => 2268,
                'id_user' => 27,
                'id_permission' => 89,
                'created_at' => '2026-03-24 22:31:03',
                'updated_at' => '2026-03-24 22:31:03'
            ],
            [
                'id_user_permission' => 2269,
                'id_user' => 27,
                'id_permission' => 90,
                'created_at' => '2026-03-24 22:31:03',
                'updated_at' => '2026-03-24 22:31:03'
            ],
            [
                'id_user_permission' => 2270,
                'id_user' => 27,
                'id_permission' => 91,
                'created_at' => '2026-03-24 22:31:03',
                'updated_at' => '2026-03-24 22:31:03'
            ],
            [
                'id_user_permission' => 2271,
                'id_user' => 27,
                'id_permission' => 92,
                'created_at' => '2026-03-24 22:31:07',
                'updated_at' => '2026-03-24 22:31:07'
            ],
            [
                'id_user_permission' => 2272,
                'id_user' => 27,
                'id_permission' => 93,
                'created_at' => '2026-03-24 22:31:16',
                'updated_at' => '2026-03-24 22:31:16'
            ],
            [
                'id_user_permission' => 2273,
                'id_user' => 27,
                'id_permission' => 94,
                'created_at' => '2026-03-24 22:31:17',
                'updated_at' => '2026-03-24 22:31:17'
            ],
            [
                'id_user_permission' => 2274,
                'id_user' => 27,
                'id_permission' => 95,
                'created_at' => '2026-03-24 22:31:21',
                'updated_at' => '2026-03-24 22:31:21'
            ],
            [
                'id_user_permission' => 2275,
                'id_user' => 27,
                'id_permission' => 96,
                'created_at' => '2026-03-24 22:31:22',
                'updated_at' => '2026-03-24 22:31:22'
            ],
            [
                'id_user_permission' => 2276,
                'id_user' => 27,
                'id_permission' => 97,
                'created_at' => '2026-03-24 22:31:22',
                'updated_at' => '2026-03-24 22:31:22'
            ],
            [
                'id_user_permission' => 2277,
                'id_user' => 27,
                'id_permission' => 98,
                'created_at' => '2026-03-24 22:31:22',
                'updated_at' => '2026-03-24 22:31:22'
            ],
            [
                'id_user_permission' => 2278,
                'id_user' => 27,
                'id_permission' => 99,
                'created_at' => '2026-03-24 22:31:39',
                'updated_at' => '2026-03-24 22:31:39'
            ],
            [
                'id_user_permission' => 2279,
                'id_user' => 27,
                'id_permission' => 100,
                'created_at' => '2026-03-24 22:31:42',
                'updated_at' => '2026-03-24 22:31:42'
            ],
            [
                'id_user_permission' => 2280,
                'id_user' => 27,
                'id_permission' => 101,
                'created_at' => '2026-03-24 22:31:43',
                'updated_at' => '2026-03-24 22:31:43'
            ],
            [
                'id_user_permission' => 2281,
                'id_user' => 27,
                'id_permission' => 105,
                'created_at' => '2026-03-24 22:31:58',
                'updated_at' => '2026-03-24 22:31:58'
            ],
            [
                'id_user_permission' => 2282,
                'id_user' => 27,
                'id_permission' => 104,
                'created_at' => '2026-03-24 22:32:01',
                'updated_at' => '2026-03-24 22:32:01'
            ],
            [
                'id_user_permission' => 2283,
                'id_user' => 27,
                'id_permission' => 109,
                'created_at' => '2026-03-24 22:32:28',
                'updated_at' => '2026-03-24 22:32:28'
            ],
            [
                'id_user_permission' => 2284,
                'id_user' => 27,
                'id_permission' => 110,
                'created_at' => '2026-03-24 22:32:30',
                'updated_at' => '2026-03-24 22:32:30'
            ],
            [
                'id_user_permission' => 2285,
                'id_user' => 27,
                'id_permission' => 111,
                'created_at' => '2026-03-24 22:32:34',
                'updated_at' => '2026-03-24 22:32:34'
            ],
            [
                'id_user_permission' => 2286,
                'id_user' => 27,
                'id_permission' => 112,
                'created_at' => '2026-03-24 22:32:36',
                'updated_at' => '2026-03-24 22:32:36'
            ],
            [
                'id_user_permission' => 2287,
                'id_user' => 27,
                'id_permission' => 113,
                'created_at' => '2026-03-24 22:32:40',
                'updated_at' => '2026-03-24 22:32:40'
            ],
            [
                'id_user_permission' => 2288,
                'id_user' => 27,
                'id_permission' => 114,
                'created_at' => '2026-03-24 22:32:43',
                'updated_at' => '2026-03-24 22:32:43'
            ],
            [
                'id_user_permission' => 2289,
                'id_user' => 27,
                'id_permission' => 125,
                'created_at' => '2026-03-24 22:32:53',
                'updated_at' => '2026-03-24 22:32:53'
            ],
            [
                'id_user_permission' => 2290,
                'id_user' => 27,
                'id_permission' => 126,
                'created_at' => '2026-03-24 22:32:56',
                'updated_at' => '2026-03-24 22:32:56'
            ],
            [
                'id_user_permission' => 2291,
                'id_user' => 27,
                'id_permission' => 127,
                'created_at' => '2026-03-24 22:33:10',
                'updated_at' => '2026-03-24 22:33:10'
            ],
            [
                'id_user_permission' => 2292,
                'id_user' => 27,
                'id_permission' => 130,
                'created_at' => '2026-03-24 22:33:18',
                'updated_at' => '2026-03-24 22:33:18'
            ],
            [
                'id_user_permission' => 2293,
                'id_user' => 27,
                'id_permission' => 131,
                'created_at' => '2026-03-24 22:33:20',
                'updated_at' => '2026-03-24 22:33:20'
            ],
            [
                'id_user_permission' => 2294,
                'id_user' => 27,
                'id_permission' => 132,
                'created_at' => '2026-03-24 22:33:20',
                'updated_at' => '2026-03-24 22:33:20'
            ],
            [
                'id_user_permission' => 2295,
                'id_user' => 27,
                'id_permission' => 133,
                'created_at' => '2026-03-24 22:33:20',
                'updated_at' => '2026-03-24 22:33:20'
            ],
            [
                'id_user_permission' => 2296,
                'id_user' => 27,
                'id_permission' => 134,
                'created_at' => '2026-03-24 22:33:25',
                'updated_at' => '2026-03-24 22:33:25'
            ],
            [
                'id_user_permission' => 2297,
                'id_user' => 27,
                'id_permission' => 135,
                'created_at' => '2026-03-24 22:33:26',
                'updated_at' => '2026-03-24 22:33:26'
            ],
            [
                'id_user_permission' => 2298,
                'id_user' => 27,
                'id_permission' => 136,
                'created_at' => '2026-03-24 22:33:26',
                'updated_at' => '2026-03-24 22:33:26'
            ],
            [
                'id_user_permission' => 2299,
                'id_user' => 27,
                'id_permission' => 137,
                'created_at' => '2026-03-24 22:33:29',
                'updated_at' => '2026-03-24 22:33:29'
            ],
            [
                'id_user_permission' => 2300,
                'id_user' => 27,
                'id_permission' => 138,
                'created_at' => '2026-03-24 22:33:30',
                'updated_at' => '2026-03-24 22:33:30'
            ],
            [
                'id_user_permission' => 2301,
                'id_user' => 27,
                'id_permission' => 139,
                'created_at' => '2026-03-24 22:33:30',
                'updated_at' => '2026-03-24 22:33:30'
            ],
            [
                'id_user_permission' => 2302,
                'id_user' => 27,
                'id_permission' => 140,
                'created_at' => '2026-03-24 22:33:38',
                'updated_at' => '2026-03-24 22:33:38'
            ],
            [
                'id_user_permission' => 2303,
                'id_user' => 27,
                'id_permission' => 141,
                'created_at' => '2026-03-24 22:33:39',
                'updated_at' => '2026-03-24 22:33:39'
            ],
            [
                'id_user_permission' => 2304,
                'id_user' => 27,
                'id_permission' => 142,
                'created_at' => '2026-03-24 22:33:39',
                'updated_at' => '2026-03-24 22:33:39'
            ],
            [
                'id_user_permission' => 2305,
                'id_user' => 27,
                'id_permission' => 143,
                'created_at' => '2026-03-24 22:33:42',
                'updated_at' => '2026-03-24 22:33:42'
            ],
            [
                'id_user_permission' => 2306,
                'id_user' => 27,
                'id_permission' => 144,
                'created_at' => '2026-03-24 22:33:43',
                'updated_at' => '2026-03-24 22:33:43'
            ],
            [
                'id_user_permission' => 2307,
                'id_user' => 27,
                'id_permission' => 145,
                'created_at' => '2026-03-24 22:33:43',
                'updated_at' => '2026-03-24 22:33:43'
            ],
            [
                'id_user_permission' => 2308,
                'id_user' => 27,
                'id_permission' => 146,
                'created_at' => '2026-03-24 22:33:47',
                'updated_at' => '2026-03-24 22:33:47'
            ],
            [
                'id_user_permission' => 2309,
                'id_user' => 27,
                'id_permission' => 150,
                'created_at' => '2026-03-24 22:33:53',
                'updated_at' => '2026-03-24 22:33:53'
            ],
            [
                'id_user_permission' => 2310,
                'id_user' => 27,
                'id_permission' => 151,
                'created_at' => '2026-03-24 22:33:54',
                'updated_at' => '2026-03-24 22:33:54'
            ],
            [
                'id_user_permission' => 2311,
                'id_user' => 27,
                'id_permission' => 152,
                'created_at' => '2026-03-24 22:33:59',
                'updated_at' => '2026-03-24 22:33:59'
            ],
            [
                'id_user_permission' => 2312,
                'id_user' => 27,
                'id_permission' => 153,
                'created_at' => '2026-03-24 22:34:03',
                'updated_at' => '2026-03-24 22:34:03'
            ],
            [
                'id_user_permission' => 2313,
                'id_user' => 27,
                'id_permission' => 156,
                'created_at' => '2026-03-24 22:34:09',
                'updated_at' => '2026-03-24 22:34:09'
            ],
            [
                'id_user_permission' => 2314,
                'id_user' => 27,
                'id_permission' => 157,
                'created_at' => '2026-03-24 22:34:18',
                'updated_at' => '2026-03-24 22:34:18'
            ],
            [
                'id_user_permission' => 2315,
                'id_user' => 27,
                'id_permission' => 158,
                'created_at' => '2026-03-24 22:34:20',
                'updated_at' => '2026-03-24 22:34:20'
            ],
            [
                'id_user_permission' => 2316,
                'id_user' => 27,
                'id_permission' => 159,
                'created_at' => '2026-03-24 22:34:27',
                'updated_at' => '2026-03-24 22:34:27'
            ],
            [
                'id_user_permission' => 2317,
                'id_user' => 27,
                'id_permission' => 160,
                'created_at' => '2026-03-24 22:34:29',
                'updated_at' => '2026-03-24 22:34:29'
            ],
            [
                'id_user_permission' => 2318,
                'id_user' => 27,
                'id_permission' => 171,
                'created_at' => '2026-03-24 22:34:34',
                'updated_at' => '2026-03-24 22:34:34'
            ],
            [
                'id_user_permission' => 2319,
                'id_user' => 27,
                'id_permission' => 172,
                'created_at' => '2026-03-24 22:34:36',
                'updated_at' => '2026-03-24 22:34:36'
            ],
            [
                'id_user_permission' => 2320,
                'id_user' => 27,
                'id_permission' => 173,
                'created_at' => '2026-03-24 22:35:01',
                'updated_at' => '2026-03-24 22:35:01'
            ],
            [
                'id_user_permission' => 2321,
                'id_user' => 27,
                'id_permission' => 243,
                'created_at' => '2026-03-24 22:35:29',
                'updated_at' => '2026-03-24 22:35:29'
            ],
            [
                'id_user_permission' => 2322,
                'id_user' => 27,
                'id_permission' => 244,
                'created_at' => '2026-03-24 22:35:29',
                'updated_at' => '2026-03-24 22:35:29'
            ],
            [
                'id_user_permission' => 2323,
                'id_user' => 27,
                'id_permission' => 180,
                'created_at' => '2026-03-24 22:35:37',
                'updated_at' => '2026-03-24 22:35:37'
            ],
            [
                'id_user_permission' => 2324,
                'id_user' => 27,
                'id_permission' => 184,
                'created_at' => '2026-03-24 22:35:42',
                'updated_at' => '2026-03-24 22:35:42'
            ],
            [
                'id_user_permission' => 2325,
                'id_user' => 27,
                'id_permission' => 191,
                'created_at' => '2026-03-24 22:36:00',
                'updated_at' => '2026-03-24 22:36:00'
            ],
            [
                'id_user_permission' => 2326,
                'id_user' => 27,
                'id_permission' => 192,
                'created_at' => '2026-03-24 22:36:01',
                'updated_at' => '2026-03-24 22:36:01'
            ],
            [
                'id_user_permission' => 2327,
                'id_user' => 27,
                'id_permission' => 193,
                'created_at' => '2026-03-24 22:36:04',
                'updated_at' => '2026-03-24 22:36:04'
            ],
            [
                'id_user_permission' => 2328,
                'id_user' => 27,
                'id_permission' => 197,
                'created_at' => '2026-03-24 22:36:13',
                'updated_at' => '2026-03-24 22:36:13'
            ],
            [
                'id_user_permission' => 2329,
                'id_user' => 27,
                'id_permission' => 198,
                'created_at' => '2026-03-24 22:36:15',
                'updated_at' => '2026-03-24 22:36:15'
            ],
            [
                'id_user_permission' => 2330,
                'id_user' => 27,
                'id_permission' => 201,
                'created_at' => '2026-03-24 22:36:25',
                'updated_at' => '2026-03-24 22:36:25'
            ],
            [
                'id_user_permission' => 2331,
                'id_user' => 27,
                'id_permission' => 202,
                'created_at' => '2026-03-24 22:36:27',
                'updated_at' => '2026-03-24 22:36:27'
            ],
            [
                'id_user_permission' => 2332,
                'id_user' => 27,
                'id_permission' => 219,
                'created_at' => '2026-03-24 22:37:51',
                'updated_at' => '2026-03-24 22:37:51'
            ],
            [
                'id_user_permission' => 2333,
                'id_user' => 27,
                'id_permission' => 220,
                'created_at' => '2026-03-24 22:37:52',
                'updated_at' => '2026-03-24 22:37:52'
            ],
            [
                'id_user_permission' => 2334,
                'id_user' => 27,
                'id_permission' => 246,
                'created_at' => '2026-03-24 22:37:52',
                'updated_at' => '2026-03-24 22:37:52'
            ],
            [
                'id_user_permission' => 2335,
                'id_user' => 27,
                'id_permission' => 222,
                'created_at' => '2026-03-24 22:38:01',
                'updated_at' => '2026-03-24 22:38:01'
            ],
            [
                'id_user_permission' => 2336,
                'id_user' => 27,
                'id_permission' => 223,
                'created_at' => '2026-03-24 22:38:02',
                'updated_at' => '2026-03-24 22:38:02'
            ],
            [
                'id_user_permission' => 2337,
                'id_user' => 27,
                'id_permission' => 248,
                'created_at' => '2026-03-24 22:38:09',
                'updated_at' => '2026-03-24 22:38:09'
            ],
            [
                'id_user_permission' => 2338,
                'id_user' => 27,
                'id_permission' => 249,
                'created_at' => '2026-03-24 22:38:10',
                'updated_at' => '2026-03-24 22:38:10'
            ],
            [
                'id_user_permission' => 2339,
                'id_user' => 61,
                'id_permission' => 5,
                'created_at' => '2026-03-24 23:59:19',
                'updated_at' => '2026-03-24 23:59:19'
            ],
            [
                'id_user_permission' => 2340,
                'id_user' => 61,
                'id_permission' => 9,
                'created_at' => '2026-03-24 23:59:25',
                'updated_at' => '2026-03-24 23:59:25'
            ],
            [
                'id_user_permission' => 2341,
                'id_user' => 61,
                'id_permission' => 20,
                'created_at' => '2026-03-24 23:59:33',
                'updated_at' => '2026-03-24 23:59:33'
            ],
            [
                'id_user_permission' => 2342,
                'id_user' => 61,
                'id_permission' => 21,
                'created_at' => '2026-03-24 23:59:34',
                'updated_at' => '2026-03-24 23:59:34'
            ],
            [
                'id_user_permission' => 2343,
                'id_user' => 61,
                'id_permission' => 22,
                'created_at' => '2026-03-24 23:59:34',
                'updated_at' => '2026-03-24 23:59:34'
            ],
            [
                'id_user_permission' => 2344,
                'id_user' => 61,
                'id_permission' => 24,
                'created_at' => '2026-03-24 23:59:42',
                'updated_at' => '2026-03-24 23:59:42'
            ],
            [
                'id_user_permission' => 2345,
                'id_user' => 61,
                'id_permission' => 25,
                'created_at' => '2026-03-24 23:59:43',
                'updated_at' => '2026-03-24 23:59:43'
            ],
            [
                'id_user_permission' => 2346,
                'id_user' => 61,
                'id_permission' => 26,
                'created_at' => '2026-03-24 23:59:43',
                'updated_at' => '2026-03-24 23:59:43'
            ],
            [
                'id_user_permission' => 2347,
                'id_user' => 61,
                'id_permission' => 73,
                'created_at' => '2026-03-25 00:00:19',
                'updated_at' => '2026-03-25 00:00:19'
            ],
            [
                'id_user_permission' => 2348,
                'id_user' => 61,
                'id_permission' => 76,
                'created_at' => '2026-03-25 00:00:26',
                'updated_at' => '2026-03-25 00:00:26'
            ],
            [
                'id_user_permission' => 2349,
                'id_user' => 61,
                'id_permission' => 95,
                'created_at' => '2026-03-25 00:00:35',
                'updated_at' => '2026-03-25 00:00:35'
            ],
            [
                'id_user_permission' => 2350,
                'id_user' => 61,
                'id_permission' => 97,
                'created_at' => '2026-03-25 00:00:37',
                'updated_at' => '2026-03-25 00:00:37'
            ],
            [
                'id_user_permission' => 2351,
                'id_user' => 61,
                'id_permission' => 96,
                'created_at' => '2026-03-25 00:00:39',
                'updated_at' => '2026-03-25 00:00:39'
            ],
            [
                'id_user_permission' => 2352,
                'id_user' => 61,
                'id_permission' => 98,
                'created_at' => '2026-03-25 00:00:47',
                'updated_at' => '2026-03-25 00:00:47'
            ],
            [
                'id_user_permission' => 2353,
                'id_user' => 61,
                'id_permission' => 99,
                'created_at' => '2026-03-25 00:00:49',
                'updated_at' => '2026-03-25 00:00:49'
            ],
            [
                'id_user_permission' => 2354,
                'id_user' => 61,
                'id_permission' => 105,
                'created_at' => '2026-03-25 00:01:00',
                'updated_at' => '2026-03-25 00:01:00'
            ],
            [
                'id_user_permission' => 2355,
                'id_user' => 61,
                'id_permission' => 125,
                'created_at' => '2026-03-25 00:01:31',
                'updated_at' => '2026-03-25 00:01:31'
            ],
            [
                'id_user_permission' => 2356,
                'id_user' => 61,
                'id_permission' => 126,
                'created_at' => '2026-03-25 00:01:33',
                'updated_at' => '2026-03-25 00:01:33'
            ],
            [
                'id_user_permission' => 2357,
                'id_user' => 61,
                'id_permission' => 127,
                'created_at' => '2026-03-25 00:01:40',
                'updated_at' => '2026-03-25 00:01:40'
            ],
            [
                'id_user_permission' => 2358,
                'id_user' => 61,
                'id_permission' => 132,
                'created_at' => '2026-03-25 00:01:53',
                'updated_at' => '2026-03-25 00:01:53'
            ],
            [
                'id_user_permission' => 2359,
                'id_user' => 61,
                'id_permission' => 140,
                'created_at' => '2026-03-25 00:02:00',
                'updated_at' => '2026-03-25 00:02:00'
            ],
            [
                'id_user_permission' => 2360,
                'id_user' => 61,
                'id_permission' => 139,
                'created_at' => '2026-03-25 00:02:02',
                'updated_at' => '2026-03-25 00:02:02'
            ],
            [
                'id_user_permission' => 2361,
                'id_user' => 61,
                'id_permission' => 165,
                'created_at' => '2026-03-25 00:02:23',
                'updated_at' => '2026-03-25 00:02:23'
            ],
            [
                'id_user_permission' => 2362,
                'id_user' => 61,
                'id_permission' => 166,
                'created_at' => '2026-03-25 00:02:24',
                'updated_at' => '2026-03-25 00:02:24'
            ],
            [
                'id_user_permission' => 2363,
                'id_user' => 61,
                'id_permission' => 171,
                'created_at' => '2026-03-25 00:02:33',
                'updated_at' => '2026-03-25 00:02:33'
            ],
            [
                'id_user_permission' => 2364,
                'id_user' => 61,
                'id_permission' => 172,
                'created_at' => '2026-03-25 00:02:35',
                'updated_at' => '2026-03-25 00:02:35'
            ],
            [
                'id_user_permission' => 2365,
                'id_user' => 61,
                'id_permission' => 120,
                'created_at' => '2026-03-25 00:02:44',
                'updated_at' => '2026-03-25 00:02:44'
            ],
            [
                'id_user_permission' => 2366,
                'id_user' => 61,
                'id_permission' => 119,
                'created_at' => '2026-03-25 00:02:45',
                'updated_at' => '2026-03-25 00:02:45'
            ],
            [
                'id_user_permission' => 2367,
                'id_user' => 61,
                'id_permission' => 173,
                'created_at' => '2026-03-25 00:03:00',
                'updated_at' => '2026-03-25 00:03:00'
            ],
            [
                'id_user_permission' => 2368,
                'id_user' => 61,
                'id_permission' => 243,
                'created_at' => '2026-03-25 00:03:12',
                'updated_at' => '2026-03-25 00:03:12'
            ],
            [
                'id_user_permission' => 2369,
                'id_user' => 61,
                'id_permission' => 244,
                'created_at' => '2026-03-25 00:03:14',
                'updated_at' => '2026-03-25 00:03:14'
            ],
            [
                'id_user_permission' => 2370,
                'id_user' => 61,
                'id_permission' => 180,
                'created_at' => '2026-03-25 00:03:19',
                'updated_at' => '2026-03-25 00:03:19'
            ],
            [
                'id_user_permission' => 2371,
                'id_user' => 61,
                'id_permission' => 184,
                'created_at' => '2026-03-25 00:03:25',
                'updated_at' => '2026-03-25 00:03:25'
            ],
            [
                'id_user_permission' => 2372,
                'id_user' => 61,
                'id_permission' => 193,
                'created_at' => '2026-03-25 00:03:35',
                'updated_at' => '2026-03-25 00:03:35'
            ],
            [
                'id_user_permission' => 2381,
                'id_user' => 61,
                'id_permission' => 246,
                'created_at' => '2026-03-25 00:04:15',
                'updated_at' => '2026-03-25 00:04:15'
            ],
            [
                'id_user_permission' => 2382,
                'id_user' => 61,
                'id_permission' => 221,
                'created_at' => '2026-03-25 00:04:24',
                'updated_at' => '2026-03-25 00:04:24'
            ],
            [
                'id_user_permission' => 2383,
                'id_user' => 61,
                'id_permission' => 247,
                'created_at' => '2026-03-25 00:04:30',
                'updated_at' => '2026-03-25 00:04:30'
            ],
            [
                'id_user_permission' => 2384,
                'id_user' => 64,
                'id_permission' => 139,
                'created_at' => '2026-03-25 00:12:28',
                'updated_at' => '2026-03-25 00:12:28'
            ],
            [
                'id_user_permission' => 2385,
                'id_user' => 64,
                'id_permission' => 140,
                'created_at' => '2026-03-25 00:12:33',
                'updated_at' => '2026-03-25 00:12:33'
            ],
            [
                'id_user_permission' => 2386,
                'id_user' => 64,
                'id_permission' => 157,
                'created_at' => '2026-03-25 00:12:43',
                'updated_at' => '2026-03-25 00:12:43'
            ],
            [
                'id_user_permission' => 2387,
                'id_user' => 64,
                'id_permission' => 158,
                'created_at' => '2026-03-25 00:12:45',
                'updated_at' => '2026-03-25 00:12:45'
            ],
            [
                'id_user_permission' => 2388,
                'id_user' => 64,
                'id_permission' => 223,
                'created_at' => '2026-03-25 00:12:55',
                'updated_at' => '2026-03-25 00:12:55'
            ],
            [
                'id_user_permission' => 2389,
                'id_user' => 39,
                'id_permission' => 1,
                'created_at' => '2026-03-25 00:14:42',
                'updated_at' => '2026-03-25 00:14:42'
            ],
            [
                'id_user_permission' => 2390,
                'id_user' => 39,
                'id_permission' => 13,
                'created_at' => '2026-03-25 00:14:52',
                'updated_at' => '2026-03-25 00:14:52'
            ],
            [
                'id_user_permission' => 2391,
                'id_user' => 39,
                'id_permission' => 14,
                'created_at' => '2026-03-25 00:14:56',
                'updated_at' => '2026-03-25 00:14:56'
            ],
            [
                'id_user_permission' => 2392,
                'id_user' => 39,
                'id_permission' => 15,
                'created_at' => '2026-03-25 00:14:56',
                'updated_at' => '2026-03-25 00:14:56'
            ],
            [
                'id_user_permission' => 2393,
                'id_user' => 39,
                'id_permission' => 16,
                'created_at' => '2026-03-25 00:14:56',
                'updated_at' => '2026-03-25 00:14:56'
            ],
            [
                'id_user_permission' => 2394,
                'id_user' => 39,
                'id_permission' => 19,
                'created_at' => '2026-03-25 00:15:02',
                'updated_at' => '2026-03-25 00:15:02'
            ],
            [
                'id_user_permission' => 2395,
                'id_user' => 39,
                'id_permission' => 23,
                'created_at' => '2026-03-25 00:15:06',
                'updated_at' => '2026-03-25 00:15:06'
            ],
            [
                'id_user_permission' => 2396,
                'id_user' => 39,
                'id_permission' => 39,
                'created_at' => '2026-03-25 00:15:15',
                'updated_at' => '2026-03-25 00:15:15'
            ],
            [
                'id_user_permission' => 2397,
                'id_user' => 39,
                'id_permission' => 40,
                'created_at' => '2026-03-25 00:15:17',
                'updated_at' => '2026-03-25 00:15:17'
            ],
            [
                'id_user_permission' => 2398,
                'id_user' => 39,
                'id_permission' => 41,
                'created_at' => '2026-03-25 00:15:24',
                'updated_at' => '2026-03-25 00:15:24'
            ],
            [
                'id_user_permission' => 2399,
                'id_user' => 39,
                'id_permission' => 42,
                'created_at' => '2026-03-25 00:15:26',
                'updated_at' => '2026-03-25 00:15:26'
            ],
            [
                'id_user_permission' => 2400,
                'id_user' => 39,
                'id_permission' => 59,
                'created_at' => '2026-03-25 00:15:33',
                'updated_at' => '2026-03-25 00:15:33'
            ],
            [
                'id_user_permission' => 2401,
                'id_user' => 39,
                'id_permission' => 63,
                'created_at' => '2026-03-25 00:15:37',
                'updated_at' => '2026-03-25 00:15:37'
            ],
            [
                'id_user_permission' => 2402,
                'id_user' => 39,
                'id_permission' => 75,
                'created_at' => '2026-03-25 00:15:47',
                'updated_at' => '2026-03-25 00:15:47'
            ],
            [
                'id_user_permission' => 2403,
                'id_user' => 39,
                'id_permission' => 78,
                'created_at' => '2026-03-25 00:16:05',
                'updated_at' => '2026-03-25 00:16:05'
            ],
            [
                'id_user_permission' => 2404,
                'id_user' => 39,
                'id_permission' => 79,
                'created_at' => '2026-03-25 00:16:07',
                'updated_at' => '2026-03-25 00:16:07'
            ],
            [
                'id_user_permission' => 2405,
                'id_user' => 39,
                'id_permission' => 80,
                'created_at' => '2026-03-25 00:16:07',
                'updated_at' => '2026-03-25 00:16:07'
            ],
            [
                'id_user_permission' => 2406,
                'id_user' => 39,
                'id_permission' => 81,
                'created_at' => '2026-03-25 00:16:12',
                'updated_at' => '2026-03-25 00:16:12'
            ],
            [
                'id_user_permission' => 2407,
                'id_user' => 39,
                'id_permission' => 82,
                'created_at' => '2026-03-25 00:16:14',
                'updated_at' => '2026-03-25 00:16:14'
            ],
            [
                'id_user_permission' => 2408,
                'id_user' => 39,
                'id_permission' => 83,
                'created_at' => '2026-03-25 00:16:14',
                'updated_at' => '2026-03-25 00:16:14'
            ],
            [
                'id_user_permission' => 2409,
                'id_user' => 39,
                'id_permission' => 84,
                'created_at' => '2026-03-25 00:16:18',
                'updated_at' => '2026-03-25 00:16:18'
            ],
            [
                'id_user_permission' => 2410,
                'id_user' => 39,
                'id_permission' => 85,
                'created_at' => '2026-03-25 00:16:21',
                'updated_at' => '2026-03-25 00:16:21'
            ],
            [
                'id_user_permission' => 2411,
                'id_user' => 39,
                'id_permission' => 86,
                'created_at' => '2026-03-25 00:16:21',
                'updated_at' => '2026-03-25 00:16:21'
            ],
            [
                'id_user_permission' => 2412,
                'id_user' => 39,
                'id_permission' => 87,
                'created_at' => '2026-03-25 00:16:21',
                'updated_at' => '2026-03-25 00:16:21'
            ],
            [
                'id_user_permission' => 2413,
                'id_user' => 39,
                'id_permission' => 89,
                'created_at' => '2026-03-25 00:16:33',
                'updated_at' => '2026-03-25 00:16:33'
            ],
            [
                'id_user_permission' => 2414,
                'id_user' => 39,
                'id_permission' => 90,
                'created_at' => '2026-03-25 00:16:35',
                'updated_at' => '2026-03-25 00:16:35'
            ],
            [
                'id_user_permission' => 2415,
                'id_user' => 39,
                'id_permission' => 91,
                'created_at' => '2026-03-25 00:16:35',
                'updated_at' => '2026-03-25 00:16:35'
            ],
            [
                'id_user_permission' => 2416,
                'id_user' => 39,
                'id_permission' => 92,
                'created_at' => '2026-03-25 00:16:35',
                'updated_at' => '2026-03-25 00:16:35'
            ],
            [
                'id_user_permission' => 2417,
                'id_user' => 39,
                'id_permission' => 93,
                'created_at' => '2026-03-25 00:16:35',
                'updated_at' => '2026-03-25 00:16:35'
            ],
            [
                'id_user_permission' => 2418,
                'id_user' => 39,
                'id_permission' => 94,
                'created_at' => '2026-03-25 00:16:48',
                'updated_at' => '2026-03-25 00:16:48'
            ],
            [
                'id_user_permission' => 2419,
                'id_user' => 39,
                'id_permission' => 95,
                'created_at' => '2026-03-25 00:16:50',
                'updated_at' => '2026-03-25 00:16:50'
            ],
            [
                'id_user_permission' => 2420,
                'id_user' => 39,
                'id_permission' => 96,
                'created_at' => '2026-03-25 00:16:50',
                'updated_at' => '2026-03-25 00:16:50'
            ],
            [
                'id_user_permission' => 2421,
                'id_user' => 39,
                'id_permission' => 97,
                'created_at' => '2026-03-25 00:16:50',
                'updated_at' => '2026-03-25 00:16:50'
            ],
            [
                'id_user_permission' => 2422,
                'id_user' => 39,
                'id_permission' => 98,
                'created_at' => '2026-03-25 00:16:56',
                'updated_at' => '2026-03-25 00:16:56'
            ],
            [
                'id_user_permission' => 2423,
                'id_user' => 39,
                'id_permission' => 99,
                'created_at' => '2026-03-25 00:16:57',
                'updated_at' => '2026-03-25 00:16:57'
            ],
            [
                'id_user_permission' => 2424,
                'id_user' => 39,
                'id_permission' => 111,
                'created_at' => '2026-03-25 00:17:14',
                'updated_at' => '2026-03-25 00:17:14'
            ],
            [
                'id_user_permission' => 2425,
                'id_user' => 39,
                'id_permission' => 112,
                'created_at' => '2026-03-25 00:17:16',
                'updated_at' => '2026-03-25 00:17:16'
            ],
            [
                'id_user_permission' => 2426,
                'id_user' => 39,
                'id_permission' => 129,
                'created_at' => '2026-03-25 00:17:37',
                'updated_at' => '2026-03-25 00:17:37'
            ],
            [
                'id_user_permission' => 2427,
                'id_user' => 39,
                'id_permission' => 130,
                'created_at' => '2026-03-25 00:17:38',
                'updated_at' => '2026-03-25 00:17:38'
            ],
            [
                'id_user_permission' => 2428,
                'id_user' => 39,
                'id_permission' => 131,
                'created_at' => '2026-03-25 00:17:38',
                'updated_at' => '2026-03-25 00:17:38'
            ],
            [
                'id_user_permission' => 2429,
                'id_user' => 39,
                'id_permission' => 132,
                'created_at' => '2026-03-25 00:17:38',
                'updated_at' => '2026-03-25 00:17:38'
            ],
            [
                'id_user_permission' => 2430,
                'id_user' => 39,
                'id_permission' => 133,
                'created_at' => '2026-03-25 00:17:41',
                'updated_at' => '2026-03-25 00:17:41'
            ],
            [
                'id_user_permission' => 2431,
                'id_user' => 39,
                'id_permission' => 134,
                'created_at' => '2026-03-25 00:17:43',
                'updated_at' => '2026-03-25 00:17:43'
            ],
            [
                'id_user_permission' => 2432,
                'id_user' => 39,
                'id_permission' => 135,
                'created_at' => '2026-03-25 00:17:43',
                'updated_at' => '2026-03-25 00:17:43'
            ],
            [
                'id_user_permission' => 2433,
                'id_user' => 39,
                'id_permission' => 136,
                'created_at' => '2026-03-25 00:17:43',
                'updated_at' => '2026-03-25 00:17:43'
            ],
            [
                'id_user_permission' => 2434,
                'id_user' => 39,
                'id_permission' => 137,
                'created_at' => '2026-03-25 00:17:50',
                'updated_at' => '2026-03-25 00:17:50'
            ],
            [
                'id_user_permission' => 2435,
                'id_user' => 39,
                'id_permission' => 138,
                'created_at' => '2026-03-25 00:17:51',
                'updated_at' => '2026-03-25 00:17:51'
            ],
            [
                'id_user_permission' => 2436,
                'id_user' => 39,
                'id_permission' => 139,
                'created_at' => '2026-03-25 00:17:51',
                'updated_at' => '2026-03-25 00:17:51'
            ],
            [
                'id_user_permission' => 2437,
                'id_user' => 39,
                'id_permission' => 140,
                'created_at' => '2026-03-25 00:17:51',
                'updated_at' => '2026-03-25 00:17:51'
            ],
            [
                'id_user_permission' => 2438,
                'id_user' => 39,
                'id_permission' => 141,
                'created_at' => '2026-03-25 00:17:56',
                'updated_at' => '2026-03-25 00:17:56'
            ],
            [
                'id_user_permission' => 2439,
                'id_user' => 39,
                'id_permission' => 142,
                'created_at' => '2026-03-25 00:17:58',
                'updated_at' => '2026-03-25 00:17:58'
            ],
            [
                'id_user_permission' => 2440,
                'id_user' => 39,
                'id_permission' => 143,
                'created_at' => '2026-03-25 00:18:05',
                'updated_at' => '2026-03-25 00:18:05'
            ],
            [
                'id_user_permission' => 2441,
                'id_user' => 39,
                'id_permission' => 144,
                'created_at' => '2026-03-25 00:18:06',
                'updated_at' => '2026-03-25 00:18:06'
            ],
            [
                'id_user_permission' => 2443,
                'id_user' => 39,
                'id_permission' => 145,
                'created_at' => '2026-03-25 00:18:17',
                'updated_at' => '2026-03-25 00:18:17'
            ],
            [
                'id_user_permission' => 2444,
                'id_user' => 39,
                'id_permission' => 146,
                'created_at' => '2026-03-25 00:23:23',
                'updated_at' => '2026-03-25 00:23:23'
            ],
            [
                'id_user_permission' => 2445,
                'id_user' => 39,
                'id_permission' => 147,
                'created_at' => '2026-03-25 00:23:25',
                'updated_at' => '2026-03-25 00:23:25'
            ],
            [
                'id_user_permission' => 2446,
                'id_user' => 39,
                'id_permission' => 148,
                'created_at' => '2026-03-25 00:23:25',
                'updated_at' => '2026-03-25 00:23:25'
            ],
            [
                'id_user_permission' => 2447,
                'id_user' => 39,
                'id_permission' => 149,
                'created_at' => '2026-03-25 00:23:25',
                'updated_at' => '2026-03-25 00:23:25'
            ],
            [
                'id_user_permission' => 2448,
                'id_user' => 39,
                'id_permission' => 150,
                'created_at' => '2026-03-25 00:23:25',
                'updated_at' => '2026-03-25 00:23:25'
            ],
            [
                'id_user_permission' => 2449,
                'id_user' => 39,
                'id_permission' => 151,
                'created_at' => '2026-03-25 00:23:25',
                'updated_at' => '2026-03-25 00:23:25'
            ],
            [
                'id_user_permission' => 2450,
                'id_user' => 39,
                'id_permission' => 157,
                'created_at' => '2026-03-25 00:23:58',
                'updated_at' => '2026-03-25 00:23:58'
            ],
            [
                'id_user_permission' => 2451,
                'id_user' => 39,
                'id_permission' => 158,
                'created_at' => '2026-03-25 00:24:01',
                'updated_at' => '2026-03-25 00:24:01'
            ],
            [
                'id_user_permission' => 2452,
                'id_user' => 39,
                'id_permission' => 223,
                'created_at' => '2026-03-25 00:24:20',
                'updated_at' => '2026-03-25 00:24:20'
            ],
            [
                'id_user_permission' => 2453,
                'id_user' => 53,
                'id_permission' => 1,
                'created_at' => '2026-03-25 00:24:57',
                'updated_at' => '2026-03-25 00:24:57'
            ],
            [
                'id_user_permission' => 2454,
                'id_user' => 53,
                'id_permission' => 13,
                'created_at' => '2026-03-25 00:25:05',
                'updated_at' => '2026-03-25 00:25:05'
            ],
            [
                'id_user_permission' => 2455,
                'id_user' => 53,
                'id_permission' => 14,
                'created_at' => '2026-03-25 00:25:10',
                'updated_at' => '2026-03-25 00:25:10'
            ],
            [
                'id_user_permission' => 2456,
                'id_user' => 53,
                'id_permission' => 15,
                'created_at' => '2026-03-25 00:25:11',
                'updated_at' => '2026-03-25 00:25:11'
            ],
            [
                'id_user_permission' => 2457,
                'id_user' => 53,
                'id_permission' => 16,
                'created_at' => '2026-03-25 00:25:11',
                'updated_at' => '2026-03-25 00:25:11'
            ],
            [
                'id_user_permission' => 2458,
                'id_user' => 53,
                'id_permission' => 19,
                'created_at' => '2026-03-25 00:25:11',
                'updated_at' => '2026-03-25 00:25:11'
            ],
            [
                'id_user_permission' => 2459,
                'id_user' => 53,
                'id_permission' => 23,
                'created_at' => '2026-03-25 00:25:16',
                'updated_at' => '2026-03-25 00:25:16'
            ],
            [
                'id_user_permission' => 2460,
                'id_user' => 53,
                'id_permission' => 39,
                'created_at' => '2026-03-25 00:25:38',
                'updated_at' => '2026-03-25 00:25:38'
            ],
            [
                'id_user_permission' => 2461,
                'id_user' => 53,
                'id_permission' => 40,
                'created_at' => '2026-03-25 00:25:42',
                'updated_at' => '2026-03-25 00:25:42'
            ],
            [
                'id_user_permission' => 2462,
                'id_user' => 53,
                'id_permission' => 41,
                'created_at' => '2026-03-25 00:25:42',
                'updated_at' => '2026-03-25 00:25:42'
            ],
            [
                'id_user_permission' => 2463,
                'id_user' => 53,
                'id_permission' => 42,
                'created_at' => '2026-03-25 00:25:42',
                'updated_at' => '2026-03-25 00:25:42'
            ],
            [
                'id_user_permission' => 2464,
                'id_user' => 53,
                'id_permission' => 59,
                'created_at' => '2026-03-25 00:25:50',
                'updated_at' => '2026-03-25 00:25:50'
            ],
            [
                'id_user_permission' => 2465,
                'id_user' => 53,
                'id_permission' => 63,
                'created_at' => '2026-03-25 00:25:54',
                'updated_at' => '2026-03-25 00:25:54'
            ],
            [
                'id_user_permission' => 2466,
                'id_user' => 53,
                'id_permission' => 75,
                'created_at' => '2026-03-25 00:25:59',
                'updated_at' => '2026-03-25 00:25:59'
            ],
            [
                'id_user_permission' => 2467,
                'id_user' => 53,
                'id_permission' => 77,
                'created_at' => '2026-03-25 00:26:07',
                'updated_at' => '2026-03-25 00:26:07'
            ],
            [
                'id_user_permission' => 2468,
                'id_user' => 53,
                'id_permission' => 78,
                'created_at' => '2026-03-25 00:26:10',
                'updated_at' => '2026-03-25 00:26:10'
            ],
            [
                'id_user_permission' => 2469,
                'id_user' => 53,
                'id_permission' => 79,
                'created_at' => '2026-03-25 00:26:10',
                'updated_at' => '2026-03-25 00:26:10'
            ],
            [
                'id_user_permission' => 2470,
                'id_user' => 53,
                'id_permission' => 80,
                'created_at' => '2026-03-25 00:26:10',
                'updated_at' => '2026-03-25 00:26:10'
            ],
            [
                'id_user_permission' => 2471,
                'id_user' => 53,
                'id_permission' => 81,
                'created_at' => '2026-03-25 00:26:17',
                'updated_at' => '2026-03-25 00:26:17'
            ],
            [
                'id_user_permission' => 2472,
                'id_user' => 53,
                'id_permission' => 82,
                'created_at' => '2026-03-25 00:26:20',
                'updated_at' => '2026-03-25 00:26:20'
            ],
            [
                'id_user_permission' => 2473,
                'id_user' => 53,
                'id_permission' => 83,
                'created_at' => '2026-03-25 00:26:20',
                'updated_at' => '2026-03-25 00:26:20'
            ],
            [
                'id_user_permission' => 2474,
                'id_user' => 53,
                'id_permission' => 84,
                'created_at' => '2026-03-25 00:26:20',
                'updated_at' => '2026-03-25 00:26:20'
            ],
            [
                'id_user_permission' => 2475,
                'id_user' => 53,
                'id_permission' => 85,
                'created_at' => '2026-03-25 00:26:20',
                'updated_at' => '2026-03-25 00:26:20'
            ],
            [
                'id_user_permission' => 2476,
                'id_user' => 53,
                'id_permission' => 86,
                'created_at' => '2026-03-25 00:26:25',
                'updated_at' => '2026-03-25 00:26:25'
            ],
            [
                'id_user_permission' => 2477,
                'id_user' => 53,
                'id_permission' => 87,
                'created_at' => '2026-03-25 00:26:28',
                'updated_at' => '2026-03-25 00:26:28'
            ],
            [
                'id_user_permission' => 2478,
                'id_user' => 53,
                'id_permission' => 89,
                'created_at' => '2026-03-25 00:26:28',
                'updated_at' => '2026-03-25 00:26:28'
            ],
            [
                'id_user_permission' => 2479,
                'id_user' => 53,
                'id_permission' => 90,
                'created_at' => '2026-03-25 00:26:28',
                'updated_at' => '2026-03-25 00:26:28'
            ],
            [
                'id_user_permission' => 2480,
                'id_user' => 53,
                'id_permission' => 91,
                'created_at' => '2026-03-25 00:29:16',
                'updated_at' => '2026-03-25 00:29:16'
            ],
            [
                'id_user_permission' => 2481,
                'id_user' => 53,
                'id_permission' => 92,
                'created_at' => '2026-03-25 00:29:18',
                'updated_at' => '2026-03-25 00:29:18'
            ],
            [
                'id_user_permission' => 2482,
                'id_user' => 53,
                'id_permission' => 93,
                'created_at' => '2026-03-25 00:29:18',
                'updated_at' => '2026-03-25 00:29:18'
            ],
            [
                'id_user_permission' => 2483,
                'id_user' => 53,
                'id_permission' => 94,
                'created_at' => '2026-03-25 00:29:18',
                'updated_at' => '2026-03-25 00:29:18'
            ],
            [
                'id_user_permission' => 2484,
                'id_user' => 53,
                'id_permission' => 111,
                'created_at' => '2026-03-25 00:29:30',
                'updated_at' => '2026-03-25 00:29:30'
            ],
            [
                'id_user_permission' => 2485,
                'id_user' => 53,
                'id_permission' => 112,
                'created_at' => '2026-03-25 00:29:31',
                'updated_at' => '2026-03-25 00:29:31'
            ],
            [
                'id_user_permission' => 2486,
                'id_user' => 53,
                'id_permission' => 223,
                'created_at' => '2026-03-25 00:31:20',
                'updated_at' => '2026-03-25 00:31:20'
            ],
            [
                'id_user_permission' => 2487,
                'id_user' => 58,
                'id_permission' => 77,
                'created_at' => '2026-03-25 00:32:44',
                'updated_at' => '2026-03-25 00:32:44'
            ],
            [
                'id_user_permission' => 2488,
                'id_user' => 58,
                'id_permission' => 130,
                'created_at' => '2026-03-25 00:33:19',
                'updated_at' => '2026-03-25 00:33:19'
            ],
            [
                'id_user_permission' => 2489,
                'id_user' => 58,
                'id_permission' => 131,
                'created_at' => '2026-03-25 00:33:21',
                'updated_at' => '2026-03-25 00:33:21'
            ],
            [
                'id_user_permission' => 2490,
                'id_user' => 58,
                'id_permission' => 132,
                'created_at' => '2026-03-25 00:33:21',
                'updated_at' => '2026-03-25 00:33:21'
            ],
            [
                'id_user_permission' => 2491,
                'id_user' => 58,
                'id_permission' => 133,
                'created_at' => '2026-03-25 00:33:21',
                'updated_at' => '2026-03-25 00:33:21'
            ],
            [
                'id_user_permission' => 2492,
                'id_user' => 58,
                'id_permission' => 129,
                'created_at' => '2026-03-25 00:33:29',
                'updated_at' => '2026-03-25 00:33:29'
            ],
            [
                'id_user_permission' => 2493,
                'id_user' => 58,
                'id_permission' => 134,
                'created_at' => '2026-03-25 00:33:44',
                'updated_at' => '2026-03-25 00:33:44'
            ],
            [
                'id_user_permission' => 2494,
                'id_user' => 58,
                'id_permission' => 135,
                'created_at' => '2026-03-25 00:33:46',
                'updated_at' => '2026-03-25 00:33:46'
            ],
            [
                'id_user_permission' => 2495,
                'id_user' => 58,
                'id_permission' => 136,
                'created_at' => '2026-03-25 00:33:46',
                'updated_at' => '2026-03-25 00:33:46'
            ],
            [
                'id_user_permission' => 2496,
                'id_user' => 58,
                'id_permission' => 137,
                'created_at' => '2026-03-25 00:33:46',
                'updated_at' => '2026-03-25 00:33:46'
            ],
            [
                'id_user_permission' => 2497,
                'id_user' => 58,
                'id_permission' => 138,
                'created_at' => '2026-03-25 00:33:52',
                'updated_at' => '2026-03-25 00:33:52'
            ],
            [
                'id_user_permission' => 2498,
                'id_user' => 58,
                'id_permission' => 141,
                'created_at' => '2026-03-25 00:34:30',
                'updated_at' => '2026-03-25 00:34:30'
            ],
            [
                'id_user_permission' => 2499,
                'id_user' => 58,
                'id_permission' => 142,
                'created_at' => '2026-03-25 00:34:32',
                'updated_at' => '2026-03-25 00:34:32'
            ],
            [
                'id_user_permission' => 2500,
                'id_user' => 58,
                'id_permission' => 143,
                'created_at' => '2026-03-25 00:34:32',
                'updated_at' => '2026-03-25 00:34:32'
            ],
            [
                'id_user_permission' => 2501,
                'id_user' => 58,
                'id_permission' => 151,
                'created_at' => '2026-03-25 00:34:44',
                'updated_at' => '2026-03-25 00:34:44'
            ],
            [
                'id_user_permission' => 2502,
                'id_user' => 58,
                'id_permission' => 150,
                'created_at' => '2026-03-25 00:34:47',
                'updated_at' => '2026-03-25 00:34:47'
            ],
            [
                'id_user_permission' => 2503,
                'id_user' => 58,
                'id_permission' => 149,
                'created_at' => '2026-03-25 00:34:47',
                'updated_at' => '2026-03-25 00:34:47'
            ],
            [
                'id_user_permission' => 2504,
                'id_user' => 58,
                'id_permission' => 148,
                'created_at' => '2026-03-25 00:34:47',
                'updated_at' => '2026-03-25 00:34:47'
            ],
            [
                'id_user_permission' => 2505,
                'id_user' => 58,
                'id_permission' => 147,
                'created_at' => '2026-03-25 00:34:47',
                'updated_at' => '2026-03-25 00:34:47'
            ],
            [
                'id_user_permission' => 2506,
                'id_user' => 58,
                'id_permission' => 146,
                'created_at' => '2026-03-25 00:34:47',
                'updated_at' => '2026-03-25 00:34:47'
            ],
            [
                'id_user_permission' => 2507,
                'id_user' => 58,
                'id_permission' => 145,
                'created_at' => '2026-03-25 00:34:47',
                'updated_at' => '2026-03-25 00:34:47'
            ],
            [
                'id_user_permission' => 2508,
                'id_user' => 58,
                'id_permission' => 144,
                'created_at' => '2026-03-25 00:34:50',
                'updated_at' => '2026-03-25 00:34:50'
            ],
            [
                'id_user_permission' => 2509,
                'id_user' => 58,
                'id_permission' => 157,
                'created_at' => '2026-03-25 00:35:07',
                'updated_at' => '2026-03-25 00:35:07'
            ],
            [
                'id_user_permission' => 2510,
                'id_user' => 58,
                'id_permission' => 158,
                'created_at' => '2026-03-25 00:35:11',
                'updated_at' => '2026-03-25 00:35:11'
            ],
            [
                'id_user_permission' => 2511,
                'id_user' => 60,
                'id_permission' => 1,
                'created_at' => '2026-03-25 00:37:15',
                'updated_at' => '2026-03-25 00:37:15'
            ],
            [
                'id_user_permission' => 2512,
                'id_user' => 60,
                'id_permission' => 13,
                'created_at' => '2026-03-25 00:37:23',
                'updated_at' => '2026-03-25 00:37:23'
            ],
            [
                'id_user_permission' => 2513,
                'id_user' => 60,
                'id_permission' => 14,
                'created_at' => '2026-03-25 00:37:27',
                'updated_at' => '2026-03-25 00:37:27'
            ],
            [
                'id_user_permission' => 2514,
                'id_user' => 60,
                'id_permission' => 15,
                'created_at' => '2026-03-25 00:37:27',
                'updated_at' => '2026-03-25 00:37:27'
            ],
            [
                'id_user_permission' => 2515,
                'id_user' => 60,
                'id_permission' => 16,
                'created_at' => '2026-03-25 00:37:27',
                'updated_at' => '2026-03-25 00:37:27'
            ],
            [
                'id_user_permission' => 2516,
                'id_user' => 60,
                'id_permission' => 19,
                'created_at' => '2026-03-25 00:37:36',
                'updated_at' => '2026-03-25 00:37:36'
            ],
            [
                'id_user_permission' => 2517,
                'id_user' => 60,
                'id_permission' => 23,
                'created_at' => '2026-03-25 00:37:49',
                'updated_at' => '2026-03-25 00:37:49'
            ],
            [
                'id_user_permission' => 2518,
                'id_user' => 60,
                'id_permission' => 39,
                'created_at' => '2026-03-25 00:38:09',
                'updated_at' => '2026-03-25 00:38:09'
            ],
            [
                'id_user_permission' => 2519,
                'id_user' => 60,
                'id_permission' => 40,
                'created_at' => '2026-03-25 00:38:13',
                'updated_at' => '2026-03-25 00:38:13'
            ],
            [
                'id_user_permission' => 2520,
                'id_user' => 60,
                'id_permission' => 41,
                'created_at' => '2026-03-25 00:38:13',
                'updated_at' => '2026-03-25 00:38:13'
            ],
            [
                'id_user_permission' => 2521,
                'id_user' => 60,
                'id_permission' => 42,
                'created_at' => '2026-03-25 00:38:13',
                'updated_at' => '2026-03-25 00:38:13'
            ],
            [
                'id_user_permission' => 2522,
                'id_user' => 60,
                'id_permission' => 59,
                'created_at' => '2026-03-25 00:38:38',
                'updated_at' => '2026-03-25 00:38:38'
            ],
            [
                'id_user_permission' => 2523,
                'id_user' => 60,
                'id_permission' => 63,
                'created_at' => '2026-03-25 00:38:42',
                'updated_at' => '2026-03-25 00:38:42'
            ],
            [
                'id_user_permission' => 2524,
                'id_user' => 60,
                'id_permission' => 75,
                'created_at' => '2026-03-25 00:38:57',
                'updated_at' => '2026-03-25 00:38:57'
            ],
            [
                'id_user_permission' => 2525,
                'id_user' => 60,
                'id_permission' => 78,
                'created_at' => '2026-03-25 00:39:00',
                'updated_at' => '2026-03-25 00:39:00'
            ],
            [
                'id_user_permission' => 2526,
                'id_user' => 60,
                'id_permission' => 79,
                'created_at' => '2026-03-25 00:39:12',
                'updated_at' => '2026-03-25 00:39:12'
            ],
            [
                'id_user_permission' => 2527,
                'id_user' => 60,
                'id_permission' => 80,
                'created_at' => '2026-03-25 00:39:16',
                'updated_at' => '2026-03-25 00:39:16'
            ],
            [
                'id_user_permission' => 2528,
                'id_user' => 60,
                'id_permission' => 81,
                'created_at' => '2026-03-25 00:39:16',
                'updated_at' => '2026-03-25 00:39:16'
            ],
            [
                'id_user_permission' => 2529,
                'id_user' => 60,
                'id_permission' => 82,
                'created_at' => '2026-03-25 00:39:16',
                'updated_at' => '2026-03-25 00:39:16'
            ],
            [
                'id_user_permission' => 2530,
                'id_user' => 60,
                'id_permission' => 83,
                'created_at' => '2026-03-25 00:39:16',
                'updated_at' => '2026-03-25 00:39:16'
            ],
            [
                'id_user_permission' => 2531,
                'id_user' => 60,
                'id_permission' => 84,
                'created_at' => '2026-03-25 00:39:16',
                'updated_at' => '2026-03-25 00:39:16'
            ],
            [
                'id_user_permission' => 2532,
                'id_user' => 60,
                'id_permission' => 85,
                'created_at' => '2026-03-25 00:39:16',
                'updated_at' => '2026-03-25 00:39:16'
            ],
            [
                'id_user_permission' => 2533,
                'id_user' => 60,
                'id_permission' => 86,
                'created_at' => '2026-03-25 00:39:22',
                'updated_at' => '2026-03-25 00:39:22'
            ],
            [
                'id_user_permission' => 2534,
                'id_user' => 60,
                'id_permission' => 87,
                'created_at' => '2026-03-25 00:39:26',
                'updated_at' => '2026-03-25 00:39:26'
            ],
            [
                'id_user_permission' => 2535,
                'id_user' => 60,
                'id_permission' => 89,
                'created_at' => '2026-03-25 00:39:26',
                'updated_at' => '2026-03-25 00:39:26'
            ],
            [
                'id_user_permission' => 2536,
                'id_user' => 60,
                'id_permission' => 90,
                'created_at' => '2026-03-25 00:39:26',
                'updated_at' => '2026-03-25 00:39:26'
            ],
            [
                'id_user_permission' => 2537,
                'id_user' => 60,
                'id_permission' => 91,
                'created_at' => '2026-03-25 00:39:26',
                'updated_at' => '2026-03-25 00:39:26'
            ],
            [
                'id_user_permission' => 2538,
                'id_user' => 60,
                'id_permission' => 92,
                'created_at' => '2026-03-25 00:39:26',
                'updated_at' => '2026-03-25 00:39:26'
            ],
            [
                'id_user_permission' => 2539,
                'id_user' => 60,
                'id_permission' => 93,
                'created_at' => '2026-03-25 00:40:11',
                'updated_at' => '2026-03-25 00:40:11'
            ],
            [
                'id_user_permission' => 2540,
                'id_user' => 60,
                'id_permission' => 94,
                'created_at' => '2026-03-25 00:40:14',
                'updated_at' => '2026-03-25 00:40:14'
            ],
            [
                'id_user_permission' => 2541,
                'id_user' => 60,
                'id_permission' => 112,
                'created_at' => '2026-03-25 00:40:35',
                'updated_at' => '2026-03-25 00:40:35'
            ],
            [
                'id_user_permission' => 2542,
                'id_user' => 60,
                'id_permission' => 111,
                'created_at' => '2026-03-25 00:40:39',
                'updated_at' => '2026-03-25 00:40:39'
            ],
            [
                'id_user_permission' => 2543,
                'id_user' => 60,
                'id_permission' => 129,
                'created_at' => '2026-03-25 00:41:30',
                'updated_at' => '2026-03-25 00:41:30'
            ],
            [
                'id_user_permission' => 2544,
                'id_user' => 60,
                'id_permission' => 130,
                'created_at' => '2026-03-25 00:41:34',
                'updated_at' => '2026-03-25 00:41:34'
            ],
            [
                'id_user_permission' => 2545,
                'id_user' => 60,
                'id_permission' => 131,
                'created_at' => '2026-03-25 00:41:34',
                'updated_at' => '2026-03-25 00:41:34'
            ],
            [
                'id_user_permission' => 2546,
                'id_user' => 60,
                'id_permission' => 132,
                'created_at' => '2026-03-25 00:41:34',
                'updated_at' => '2026-03-25 00:41:34'
            ],
            [
                'id_user_permission' => 2547,
                'id_user' => 60,
                'id_permission' => 133,
                'created_at' => '2026-03-25 00:41:56',
                'updated_at' => '2026-03-25 00:41:56'
            ],
            [
                'id_user_permission' => 2548,
                'id_user' => 60,
                'id_permission' => 134,
                'created_at' => '2026-03-25 00:42:01',
                'updated_at' => '2026-03-25 00:42:01'
            ],
            [
                'id_user_permission' => 2549,
                'id_user' => 60,
                'id_permission' => 135,
                'created_at' => '2026-03-25 00:42:01',
                'updated_at' => '2026-03-25 00:42:01'
            ],
            [
                'id_user_permission' => 2550,
                'id_user' => 60,
                'id_permission' => 136,
                'created_at' => '2026-03-25 00:42:15',
                'updated_at' => '2026-03-25 00:42:15'
            ],
            [
                'id_user_permission' => 2551,
                'id_user' => 60,
                'id_permission' => 137,
                'created_at' => '2026-03-25 00:42:20',
                'updated_at' => '2026-03-25 00:42:20'
            ],
            [
                'id_user_permission' => 2552,
                'id_user' => 60,
                'id_permission' => 138,
                'created_at' => '2026-03-25 00:42:20',
                'updated_at' => '2026-03-25 00:42:20'
            ],
            [
                'id_user_permission' => 2553,
                'id_user' => 60,
                'id_permission' => 141,
                'created_at' => '2026-03-25 00:42:28',
                'updated_at' => '2026-03-25 00:42:28'
            ],
            [
                'id_user_permission' => 2554,
                'id_user' => 60,
                'id_permission' => 142,
                'created_at' => '2026-03-25 00:42:28',
                'updated_at' => '2026-03-25 00:42:28'
            ],
            [
                'id_user_permission' => 2555,
                'id_user' => 60,
                'id_permission' => 143,
                'created_at' => '2026-03-25 00:42:28',
                'updated_at' => '2026-03-25 00:42:28'
            ],
            [
                'id_user_permission' => 2556,
                'id_user' => 60,
                'id_permission' => 144,
                'created_at' => '2026-03-25 00:42:28',
                'updated_at' => '2026-03-25 00:42:28'
            ],
            [
                'id_user_permission' => 2557,
                'id_user' => 60,
                'id_permission' => 145,
                'created_at' => '2026-03-25 00:42:28',
                'updated_at' => '2026-03-25 00:42:28'
            ],
            [
                'id_user_permission' => 2558,
                'id_user' => 60,
                'id_permission' => 146,
                'created_at' => '2026-03-25 00:42:38',
                'updated_at' => '2026-03-25 00:42:38'
            ],
            [
                'id_user_permission' => 2559,
                'id_user' => 60,
                'id_permission' => 147,
                'created_at' => '2026-03-25 00:42:38',
                'updated_at' => '2026-03-25 00:42:38'
            ],
            [
                'id_user_permission' => 2560,
                'id_user' => 60,
                'id_permission' => 149,
                'created_at' => '2026-03-25 00:42:38',
                'updated_at' => '2026-03-25 00:42:38'
            ],
            [
                'id_user_permission' => 2561,
                'id_user' => 60,
                'id_permission' => 148,
                'created_at' => '2026-03-25 00:42:38',
                'updated_at' => '2026-03-25 00:42:38'
            ],
            [
                'id_user_permission' => 2562,
                'id_user' => 60,
                'id_permission' => 150,
                'created_at' => '2026-03-25 00:42:38',
                'updated_at' => '2026-03-25 00:42:38'
            ],
            [
                'id_user_permission' => 2563,
                'id_user' => 60,
                'id_permission' => 151,
                'created_at' => '2026-03-25 00:42:47',
                'updated_at' => '2026-03-25 00:42:47'
            ],
            [
                'id_user_permission' => 2564,
                'id_user' => 60,
                'id_permission' => 157,
                'created_at' => '2026-03-25 00:42:53',
                'updated_at' => '2026-03-25 00:42:53'
            ],
            [
                'id_user_permission' => 2565,
                'id_user' => 60,
                'id_permission' => 158,
                'created_at' => '2026-03-25 00:42:53',
                'updated_at' => '2026-03-25 00:42:53'
            ],
            [
                'id_user_permission' => 2566,
                'id_user' => 60,
                'id_permission' => 223,
                'created_at' => '2026-03-25 00:43:08',
                'updated_at' => '2026-03-25 00:43:08'
            ],
            [
                'id_user_permission' => 2567,
                'id_user' => 24,
                'id_permission' => 1,
                'created_at' => '2026-03-25 01:22:31',
                'updated_at' => '2026-03-25 01:22:31'
            ],
            [
                'id_user_permission' => 2568,
                'id_user' => 24,
                'id_permission' => 5,
                'created_at' => '2026-03-25 01:22:34',
                'updated_at' => '2026-03-25 01:22:34'
            ],
            [
                'id_user_permission' => 2569,
                'id_user' => 24,
                'id_permission' => 9,
                'created_at' => '2026-03-25 01:22:50',
                'updated_at' => '2026-03-25 01:22:50'
            ],
            [
                'id_user_permission' => 2570,
                'id_user' => 24,
                'id_permission' => 13,
                'created_at' => '2026-03-25 01:22:55',
                'updated_at' => '2026-03-25 01:22:55'
            ],
            [
                'id_user_permission' => 2571,
                'id_user' => 24,
                'id_permission' => 19,
                'created_at' => '2026-03-25 01:23:05',
                'updated_at' => '2026-03-25 01:23:05'
            ],
            [
                'id_user_permission' => 2572,
                'id_user' => 24,
                'id_permission' => 23,
                'created_at' => '2026-03-25 01:23:12',
                'updated_at' => '2026-03-25 01:23:12'
            ],
            [
                'id_user_permission' => 2574,
                'id_user' => 24,
                'id_permission' => 39,
                'created_at' => '2026-03-25 01:23:36',
                'updated_at' => '2026-03-25 01:23:36'
            ],
            [
                'id_user_permission' => 2575,
                'id_user' => 24,
                'id_permission' => 59,
                'created_at' => '2026-03-25 01:23:51',
                'updated_at' => '2026-03-25 01:23:51'
            ],
            [
                'id_user_permission' => 2576,
                'id_user' => 24,
                'id_permission' => 63,
                'created_at' => '2026-03-25 01:23:57',
                'updated_at' => '2026-03-25 01:23:57'
            ],
            [
                'id_user_permission' => 2577,
                'id_user' => 24,
                'id_permission' => 74,
                'created_at' => '2026-03-25 01:24:06',
                'updated_at' => '2026-03-25 01:24:06'
            ],
            [
                'id_user_permission' => 2578,
                'id_user' => 24,
                'id_permission' => 77,
                'created_at' => '2026-03-25 01:24:17',
                'updated_at' => '2026-03-25 01:24:17'
            ],
            [
                'id_user_permission' => 2579,
                'id_user' => 24,
                'id_permission' => 78,
                'created_at' => '2026-03-25 01:24:19',
                'updated_at' => '2026-03-25 01:24:19'
            ],
            [
                'id_user_permission' => 2580,
                'id_user' => 24,
                'id_permission' => 83,
                'created_at' => '2026-03-25 01:24:28',
                'updated_at' => '2026-03-25 01:24:28'
            ],
            [
                'id_user_permission' => 2581,
                'id_user' => 24,
                'id_permission' => 79,
                'created_at' => '2026-03-25 01:24:35',
                'updated_at' => '2026-03-25 01:24:35'
            ],
            [
                'id_user_permission' => 2582,
                'id_user' => 24,
                'id_permission' => 80,
                'created_at' => '2026-03-25 01:24:42',
                'updated_at' => '2026-03-25 01:24:42'
            ],
            [
                'id_user_permission' => 2583,
                'id_user' => 24,
                'id_permission' => 81,
                'created_at' => '2026-03-25 01:24:42',
                'updated_at' => '2026-03-25 01:24:42'
            ],
            [
                'id_user_permission' => 2584,
                'id_user' => 24,
                'id_permission' => 82,
                'created_at' => '2026-03-25 01:24:42',
                'updated_at' => '2026-03-25 01:24:42'
            ],
            [
                'id_user_permission' => 2585,
                'id_user' => 24,
                'id_permission' => 84,
                'created_at' => '2026-03-25 01:24:47',
                'updated_at' => '2026-03-25 01:24:47'
            ],
            [
                'id_user_permission' => 2586,
                'id_user' => 24,
                'id_permission' => 85,
                'created_at' => '2026-03-25 01:24:47',
                'updated_at' => '2026-03-25 01:24:47'
            ],
            [
                'id_user_permission' => 2587,
                'id_user' => 24,
                'id_permission' => 86,
                'created_at' => '2026-03-25 01:24:47',
                'updated_at' => '2026-03-25 01:24:47'
            ],
            [
                'id_user_permission' => 2588,
                'id_user' => 24,
                'id_permission' => 87,
                'created_at' => '2026-03-25 01:24:53',
                'updated_at' => '2026-03-25 01:24:53'
            ],
            [
                'id_user_permission' => 2589,
                'id_user' => 24,
                'id_permission' => 88,
                'created_at' => '2026-03-25 01:24:53',
                'updated_at' => '2026-03-25 01:24:53'
            ],
            [
                'id_user_permission' => 2590,
                'id_user' => 24,
                'id_permission' => 89,
                'created_at' => '2026-03-25 01:24:53',
                'updated_at' => '2026-03-25 01:24:53'
            ],
            [
                'id_user_permission' => 2591,
                'id_user' => 24,
                'id_permission' => 90,
                'created_at' => '2026-03-25 01:24:53',
                'updated_at' => '2026-03-25 01:24:53'
            ],
            [
                'id_user_permission' => 2592,
                'id_user' => 24,
                'id_permission' => 91,
                'created_at' => '2026-03-25 01:25:01',
                'updated_at' => '2026-03-25 01:25:01'
            ],
            [
                'id_user_permission' => 2593,
                'id_user' => 24,
                'id_permission' => 92,
                'created_at' => '2026-03-25 01:25:04',
                'updated_at' => '2026-03-25 01:25:04'
            ],
            [
                'id_user_permission' => 2594,
                'id_user' => 24,
                'id_permission' => 93,
                'created_at' => '2026-03-25 01:25:04',
                'updated_at' => '2026-03-25 01:25:04'
            ],
            [
                'id_user_permission' => 2595,
                'id_user' => 24,
                'id_permission' => 94,
                'created_at' => '2026-03-25 01:25:09',
                'updated_at' => '2026-03-25 01:25:09'
            ],
            [
                'id_user_permission' => 2596,
                'id_user' => 24,
                'id_permission' => 98,
                'created_at' => '2026-03-25 01:25:18',
                'updated_at' => '2026-03-25 01:25:18'
            ],
            [
                'id_user_permission' => 2597,
                'id_user' => 24,
                'id_permission' => 99,
                'created_at' => '2026-03-25 01:25:20',
                'updated_at' => '2026-03-25 01:25:20'
            ],
            [
                'id_user_permission' => 2598,
                'id_user' => 24,
                'id_permission' => 100,
                'created_at' => '2026-03-25 01:25:23',
                'updated_at' => '2026-03-25 01:25:23'
            ],
            [
                'id_user_permission' => 2599,
                'id_user' => 24,
                'id_permission' => 101,
                'created_at' => '2026-03-25 01:25:23',
                'updated_at' => '2026-03-25 01:25:23'
            ],
            [
                'id_user_permission' => 2600,
                'id_user' => 24,
                'id_permission' => 104,
                'created_at' => '2026-03-25 01:25:41',
                'updated_at' => '2026-03-25 01:25:41'
            ],
            [
                'id_user_permission' => 2601,
                'id_user' => 24,
                'id_permission' => 105,
                'created_at' => '2026-03-25 01:25:47',
                'updated_at' => '2026-03-25 01:25:47'
            ],
            [
                'id_user_permission' => 2602,
                'id_user' => 24,
                'id_permission' => 110,
                'created_at' => '2026-03-25 01:25:56',
                'updated_at' => '2026-03-25 01:25:56'
            ],
            [
                'id_user_permission' => 2603,
                'id_user' => 24,
                'id_permission' => 109,
                'created_at' => '2026-03-25 01:25:58',
                'updated_at' => '2026-03-25 01:25:58'
            ],
            [
                'id_user_permission' => 2604,
                'id_user' => 24,
                'id_permission' => 113,
                'created_at' => '2026-03-25 01:28:37',
                'updated_at' => '2026-03-25 01:28:37'
            ],
            [
                'id_user_permission' => 2605,
                'id_user' => 24,
                'id_permission' => 114,
                'created_at' => '2026-03-25 01:28:38',
                'updated_at' => '2026-03-25 01:28:38'
            ],
            [
                'id_user_permission' => 2606,
                'id_user' => 24,
                'id_permission' => 125,
                'created_at' => '2026-03-25 01:29:02',
                'updated_at' => '2026-03-25 01:29:02'
            ],
            [
                'id_user_permission' => 2607,
                'id_user' => 24,
                'id_permission' => 126,
                'created_at' => '2026-03-25 01:29:04',
                'updated_at' => '2026-03-25 01:29:04'
            ],
            [
                'id_user_permission' => 2608,
                'id_user' => 24,
                'id_permission' => 128,
                'created_at' => '2026-03-25 01:29:55',
                'updated_at' => '2026-03-25 01:29:55'
            ],
            [
                'id_user_permission' => 2609,
                'id_user' => 24,
                'id_permission' => 129,
                'created_at' => '2026-03-25 01:29:57',
                'updated_at' => '2026-03-25 01:29:57'
            ],
            [
                'id_user_permission' => 2610,
                'id_user' => 24,
                'id_permission' => 130,
                'created_at' => '2026-03-25 01:30:10',
                'updated_at' => '2026-03-25 01:30:10'
            ],
            [
                'id_user_permission' => 2611,
                'id_user' => 24,
                'id_permission' => 131,
                'created_at' => '2026-03-25 01:30:12',
                'updated_at' => '2026-03-25 01:30:12'
            ],
            [
                'id_user_permission' => 2612,
                'id_user' => 24,
                'id_permission' => 132,
                'created_at' => '2026-03-25 01:30:12',
                'updated_at' => '2026-03-25 01:30:12'
            ],
            [
                'id_user_permission' => 2613,
                'id_user' => 24,
                'id_permission' => 133,
                'created_at' => '2026-03-25 01:30:16',
                'updated_at' => '2026-03-25 01:30:16'
            ],
            [
                'id_user_permission' => 2614,
                'id_user' => 24,
                'id_permission' => 134,
                'created_at' => '2026-03-25 01:30:18',
                'updated_at' => '2026-03-25 01:30:18'
            ],
            [
                'id_user_permission' => 2615,
                'id_user' => 24,
                'id_permission' => 135,
                'created_at' => '2026-03-25 01:30:18',
                'updated_at' => '2026-03-25 01:30:18'
            ],
            [
                'id_user_permission' => 2616,
                'id_user' => 24,
                'id_permission' => 136,
                'created_at' => '2026-03-25 01:30:25',
                'updated_at' => '2026-03-25 01:30:25'
            ],
            [
                'id_user_permission' => 2617,
                'id_user' => 24,
                'id_permission' => 137,
                'created_at' => '2026-03-25 01:30:26',
                'updated_at' => '2026-03-25 01:30:26'
            ],
            [
                'id_user_permission' => 2618,
                'id_user' => 24,
                'id_permission' => 138,
                'created_at' => '2026-03-25 01:30:31',
                'updated_at' => '2026-03-25 01:30:31'
            ],
            [
                'id_user_permission' => 2619,
                'id_user' => 24,
                'id_permission' => 139,
                'created_at' => '2026-03-25 01:30:35',
                'updated_at' => '2026-03-25 01:30:35'
            ],
            [
                'id_user_permission' => 2620,
                'id_user' => 24,
                'id_permission' => 140,
                'created_at' => '2026-03-25 01:30:35',
                'updated_at' => '2026-03-25 01:30:35'
            ],
            [
                'id_user_permission' => 2621,
                'id_user' => 24,
                'id_permission' => 141,
                'created_at' => '2026-03-25 01:30:35',
                'updated_at' => '2026-03-25 01:30:35'
            ],
            [
                'id_user_permission' => 2622,
                'id_user' => 24,
                'id_permission' => 142,
                'created_at' => '2026-03-25 01:30:35',
                'updated_at' => '2026-03-25 01:30:35'
            ],
            [
                'id_user_permission' => 2623,
                'id_user' => 24,
                'id_permission' => 143,
                'created_at' => '2026-03-25 01:30:35',
                'updated_at' => '2026-03-25 01:30:35'
            ],
            [
                'id_user_permission' => 2624,
                'id_user' => 24,
                'id_permission' => 144,
                'created_at' => '2026-03-25 01:30:40',
                'updated_at' => '2026-03-25 01:30:40'
            ],
            [
                'id_user_permission' => 2625,
                'id_user' => 24,
                'id_permission' => 145,
                'created_at' => '2026-03-25 01:30:42',
                'updated_at' => '2026-03-25 01:30:42'
            ],
            [
                'id_user_permission' => 2626,
                'id_user' => 24,
                'id_permission' => 146,
                'created_at' => '2026-03-25 01:30:54',
                'updated_at' => '2026-03-25 01:30:54'
            ],
            [
                'id_user_permission' => 2627,
                'id_user' => 24,
                'id_permission' => 150,
                'created_at' => '2026-03-25 01:30:59',
                'updated_at' => '2026-03-25 01:30:59'
            ],
            [
                'id_user_permission' => 2628,
                'id_user' => 24,
                'id_permission' => 151,
                'created_at' => '2026-03-25 01:31:02',
                'updated_at' => '2026-03-25 01:31:02'
            ],
            [
                'id_user_permission' => 2629,
                'id_user' => 24,
                'id_permission' => 152,
                'created_at' => '2026-03-25 01:31:23',
                'updated_at' => '2026-03-25 01:31:23'
            ],
            [
                'id_user_permission' => 2630,
                'id_user' => 24,
                'id_permission' => 153,
                'created_at' => '2026-03-25 01:31:25',
                'updated_at' => '2026-03-25 01:31:25'
            ],
            [
                'id_user_permission' => 2631,
                'id_user' => 24,
                'id_permission' => 159,
                'created_at' => '2026-03-25 01:32:44',
                'updated_at' => '2026-03-25 01:32:44'
            ],
            [
                'id_user_permission' => 2632,
                'id_user' => 24,
                'id_permission' => 160,
                'created_at' => '2026-03-25 01:32:47',
                'updated_at' => '2026-03-25 01:32:47'
            ],
            [
                'id_user_permission' => 2633,
                'id_user' => 24,
                'id_permission' => 171,
                'created_at' => '2026-03-25 01:33:41',
                'updated_at' => '2026-03-25 01:33:41'
            ],
            [
                'id_user_permission' => 2634,
                'id_user' => 24,
                'id_permission' => 172,
                'created_at' => '2026-03-25 01:33:43',
                'updated_at' => '2026-03-25 01:33:43'
            ],
            [
                'id_user_permission' => 2635,
                'id_user' => 24,
                'id_permission' => 173,
                'created_at' => '2026-03-25 01:33:48',
                'updated_at' => '2026-03-25 01:33:48'
            ],
            [
                'id_user_permission' => 2636,
                'id_user' => 24,
                'id_permission' => 243,
                'created_at' => '2026-03-25 01:33:58',
                'updated_at' => '2026-03-25 01:33:58'
            ],
            [
                'id_user_permission' => 2637,
                'id_user' => 24,
                'id_permission' => 244,
                'created_at' => '2026-03-25 01:33:59',
                'updated_at' => '2026-03-25 01:33:59'
            ],
            [
                'id_user_permission' => 2638,
                'id_user' => 24,
                'id_permission' => 180,
                'created_at' => '2026-03-25 01:34:31',
                'updated_at' => '2026-03-25 01:34:31'
            ],
            [
                'id_user_permission' => 2639,
                'id_user' => 24,
                'id_permission' => 184,
                'created_at' => '2026-03-25 01:34:36',
                'updated_at' => '2026-03-25 01:34:36'
            ],
            [
                'id_user_permission' => 2640,
                'id_user' => 24,
                'id_permission' => 192,
                'created_at' => '2026-03-25 01:37:33',
                'updated_at' => '2026-03-25 01:37:33'
            ],
            [
                'id_user_permission' => 2641,
                'id_user' => 24,
                'id_permission' => 191,
                'created_at' => '2026-03-25 01:37:35',
                'updated_at' => '2026-03-25 01:37:35'
            ],
            [
                'id_user_permission' => 2642,
                'id_user' => 24,
                'id_permission' => 193,
                'created_at' => '2026-03-25 01:38:21',
                'updated_at' => '2026-03-25 01:38:21'
            ],
            [
                'id_user_permission' => 2643,
                'id_user' => 24,
                'id_permission' => 197,
                'created_at' => '2026-03-25 01:38:29',
                'updated_at' => '2026-03-25 01:38:29'
            ],
            [
                'id_user_permission' => 2644,
                'id_user' => 24,
                'id_permission' => 198,
                'created_at' => '2026-03-25 01:38:31',
                'updated_at' => '2026-03-25 01:38:31'
            ],
            [
                'id_user_permission' => 2645,
                'id_user' => 24,
                'id_permission' => 201,
                'created_at' => '2026-03-25 01:38:43',
                'updated_at' => '2026-03-25 01:38:43'
            ],
            [
                'id_user_permission' => 2646,
                'id_user' => 24,
                'id_permission' => 219,
                'created_at' => '2026-03-25 01:39:39',
                'updated_at' => '2026-03-25 01:39:39'
            ],
            [
                'id_user_permission' => 2647,
                'id_user' => 24,
                'id_permission' => 220,
                'created_at' => '2026-03-25 01:39:42',
                'updated_at' => '2026-03-25 01:39:42'
            ],
            [
                'id_user_permission' => 2648,
                'id_user' => 24,
                'id_permission' => 246,
                'created_at' => '2026-03-25 01:39:49',
                'updated_at' => '2026-03-25 01:39:49'
            ],
            [
                'id_user_permission' => 2649,
                'id_user' => 41,
                'id_permission' => 105,
                'created_at' => '2026-03-25 02:41:12',
                'updated_at' => '2026-03-25 02:41:12'
            ],
            [
                'id_user_permission' => 2650,
                'id_user' => 41,
                'id_permission' => 106,
                'created_at' => '2026-03-25 02:41:15',
                'updated_at' => '2026-03-25 02:41:15'
            ],
            [
                'id_user_permission' => 2651,
                'id_user' => 41,
                'id_permission' => 107,
                'created_at' => '2026-03-25 02:41:18',
                'updated_at' => '2026-03-25 02:41:18'
            ],
            [
                'id_user_permission' => 2652,
                'id_user' => 41,
                'id_permission' => 108,
                'created_at' => '2026-03-25 02:41:20',
                'updated_at' => '2026-03-25 02:41:20'
            ],
            [
                'id_user_permission' => 2654,
                'id_user' => 50,
                'id_permission' => 105,
                'created_at' => '2026-03-25 18:24:49',
                'updated_at' => '2026-03-25 18:24:49'
            ],
            [
                'id_user_permission' => 2655,
                'id_user' => 50,
                'id_permission' => 106,
                'created_at' => '2026-03-25 18:24:50',
                'updated_at' => '2026-03-25 18:24:50'
            ],
            [
                'id_user_permission' => 2656,
                'id_user' => 50,
                'id_permission' => 107,
                'created_at' => '2026-03-25 18:24:58',
                'updated_at' => '2026-03-25 18:24:58'
            ],
            [
                'id_user_permission' => 2657,
                'id_user' => 50,
                'id_permission' => 108,
                'created_at' => '2026-03-25 18:24:59',
                'updated_at' => '2026-03-25 18:24:59'
            ],
            [
                'id_user_permission' => 2658,
                'id_user' => 50,
                'id_permission' => 109,
                'created_at' => '2026-03-25 18:24:59',
                'updated_at' => '2026-03-25 18:24:59'
            ],
            [
                'id_user_permission' => 2659,
                'id_user' => 50,
                'id_permission' => 110,
                'created_at' => '2026-03-25 18:24:59',
                'updated_at' => '2026-03-25 18:24:59'
            ],
            [
                'id_user_permission' => 2660,
                'id_user' => 50,
                'id_permission' => 133,
                'created_at' => '2026-03-25 18:25:18',
                'updated_at' => '2026-03-25 18:25:18'
            ],
            [
                'id_user_permission' => 2661,
                'id_user' => 50,
                'id_permission' => 139,
                'created_at' => '2026-03-25 18:25:20',
                'updated_at' => '2026-03-25 18:25:20'
            ],
            [
                'id_user_permission' => 2662,
                'id_user' => 68,
                'id_permission' => 1,
                'created_at' => '2026-03-25 19:54:13',
                'updated_at' => '2026-03-25 19:54:13'
            ],
            [
                'id_user_permission' => 2664,
                'id_user' => 68,
                'id_permission' => 6,
                'created_at' => '2026-03-25 19:54:23',
                'updated_at' => '2026-03-25 19:54:23'
            ],
            [
                'id_user_permission' => 2667,
                'id_user' => 68,
                'id_permission' => 13,
                'created_at' => '2026-03-25 19:54:33',
                'updated_at' => '2026-03-25 19:54:33'
            ],
            [
                'id_user_permission' => 2668,
                'id_user' => 68,
                'id_permission' => 14,
                'created_at' => '2026-03-25 19:54:35',
                'updated_at' => '2026-03-25 19:54:35'
            ],
            [
                'id_user_permission' => 2669,
                'id_user' => 68,
                'id_permission' => 16,
                'created_at' => '2026-03-25 19:54:35',
                'updated_at' => '2026-03-25 19:54:35'
            ],
            [
                'id_user_permission' => 2670,
                'id_user' => 68,
                'id_permission' => 15,
                'created_at' => '2026-03-25 19:54:35',
                'updated_at' => '2026-03-25 19:54:35'
            ],
            [
                'id_user_permission' => 2671,
                'id_user' => 68,
                'id_permission' => 19,
                'created_at' => '2026-03-25 19:54:39',
                'updated_at' => '2026-03-25 19:54:39'
            ],
            [
                'id_user_permission' => 2672,
                'id_user' => 68,
                'id_permission' => 23,
                'created_at' => '2026-03-25 19:54:42',
                'updated_at' => '2026-03-25 19:54:42'
            ],
            [
                'id_user_permission' => 2673,
                'id_user' => 68,
                'id_permission' => 39,
                'created_at' => '2026-03-25 19:54:54',
                'updated_at' => '2026-03-25 19:54:54'
            ],
            [
                'id_user_permission' => 2674,
                'id_user' => 68,
                'id_permission' => 40,
                'created_at' => '2026-03-25 19:54:56',
                'updated_at' => '2026-03-25 19:54:56'
            ],
            [
                'id_user_permission' => 2675,
                'id_user' => 68,
                'id_permission' => 41,
                'created_at' => '2026-03-25 19:54:56',
                'updated_at' => '2026-03-25 19:54:56'
            ],
            [
                'id_user_permission' => 2676,
                'id_user' => 68,
                'id_permission' => 42,
                'created_at' => '2026-03-25 19:54:56',
                'updated_at' => '2026-03-25 19:54:56'
            ],
            [
                'id_user_permission' => 2677,
                'id_user' => 68,
                'id_permission' => 59,
                'created_at' => '2026-03-25 19:55:06',
                'updated_at' => '2026-03-25 19:55:06'
            ],
            [
                'id_user_permission' => 2678,
                'id_user' => 68,
                'id_permission' => 63,
                'created_at' => '2026-03-25 19:55:11',
                'updated_at' => '2026-03-25 19:55:11'
            ],
            [
                'id_user_permission' => 2679,
                'id_user' => 68,
                'id_permission' => 75,
                'created_at' => '2026-03-25 19:55:16',
                'updated_at' => '2026-03-25 19:55:16'
            ],
            [
                'id_user_permission' => 2680,
                'id_user' => 68,
                'id_permission' => 78,
                'created_at' => '2026-03-25 19:55:23',
                'updated_at' => '2026-03-25 19:55:23'
            ],
            [
                'id_user_permission' => 2681,
                'id_user' => 68,
                'id_permission' => 79,
                'created_at' => '2026-03-25 19:55:25',
                'updated_at' => '2026-03-25 19:55:25'
            ],
            [
                'id_user_permission' => 2682,
                'id_user' => 68,
                'id_permission' => 81,
                'created_at' => '2026-03-25 19:55:25',
                'updated_at' => '2026-03-25 19:55:25'
            ],
            [
                'id_user_permission' => 2683,
                'id_user' => 68,
                'id_permission' => 80,
                'created_at' => '2026-03-25 19:55:25',
                'updated_at' => '2026-03-25 19:55:25'
            ],
            [
                'id_user_permission' => 2684,
                'id_user' => 68,
                'id_permission' => 82,
                'created_at' => '2026-03-25 19:55:25',
                'updated_at' => '2026-03-25 19:55:25'
            ],
            [
                'id_user_permission' => 2685,
                'id_user' => 68,
                'id_permission' => 83,
                'created_at' => '2026-03-25 19:55:25',
                'updated_at' => '2026-03-25 19:55:25'
            ],
            [
                'id_user_permission' => 2686,
                'id_user' => 68,
                'id_permission' => 84,
                'created_at' => '2026-03-25 19:55:25',
                'updated_at' => '2026-03-25 19:55:25'
            ],
            [
                'id_user_permission' => 2687,
                'id_user' => 68,
                'id_permission' => 85,
                'created_at' => '2026-03-25 19:55:25',
                'updated_at' => '2026-03-25 19:55:25'
            ],
            [
                'id_user_permission' => 2688,
                'id_user' => 68,
                'id_permission' => 86,
                'created_at' => '2026-03-25 19:55:34',
                'updated_at' => '2026-03-25 19:55:34'
            ],
            [
                'id_user_permission' => 2689,
                'id_user' => 68,
                'id_permission' => 87,
                'created_at' => '2026-03-25 19:55:39',
                'updated_at' => '2026-03-25 19:55:39'
            ],
            [
                'id_user_permission' => 2690,
                'id_user' => 68,
                'id_permission' => 89,
                'created_at' => '2026-03-25 19:55:45',
                'updated_at' => '2026-03-25 19:55:45'
            ],
            [
                'id_user_permission' => 2691,
                'id_user' => 68,
                'id_permission' => 90,
                'created_at' => '2026-03-25 19:55:46',
                'updated_at' => '2026-03-25 19:55:46'
            ],
            [
                'id_user_permission' => 2692,
                'id_user' => 68,
                'id_permission' => 91,
                'created_at' => '2026-03-25 19:55:46',
                'updated_at' => '2026-03-25 19:55:46'
            ],
            [
                'id_user_permission' => 2693,
                'id_user' => 68,
                'id_permission' => 92,
                'created_at' => '2026-03-25 19:55:46',
                'updated_at' => '2026-03-25 19:55:46'
            ],
            [
                'id_user_permission' => 2694,
                'id_user' => 68,
                'id_permission' => 93,
                'created_at' => '2026-03-25 19:55:51',
                'updated_at' => '2026-03-25 19:55:51'
            ],
            [
                'id_user_permission' => 2695,
                'id_user' => 68,
                'id_permission' => 94,
                'created_at' => '2026-03-25 19:55:53',
                'updated_at' => '2026-03-25 19:55:53'
            ],
            [
                'id_user_permission' => 2696,
                'id_user' => 68,
                'id_permission' => 111,
                'created_at' => '2026-03-25 19:56:03',
                'updated_at' => '2026-03-25 19:56:03'
            ],
            [
                'id_user_permission' => 2697,
                'id_user' => 68,
                'id_permission' => 112,
                'created_at' => '2026-03-25 19:56:05',
                'updated_at' => '2026-03-25 19:56:05'
            ],
            [
                'id_user_permission' => 2698,
                'id_user' => 68,
                'id_permission' => 129,
                'created_at' => '2026-03-25 19:56:09',
                'updated_at' => '2026-03-25 19:56:09'
            ],
            [
                'id_user_permission' => 2699,
                'id_user' => 68,
                'id_permission' => 130,
                'created_at' => '2026-03-25 19:56:12',
                'updated_at' => '2026-03-25 19:56:12'
            ],
            [
                'id_user_permission' => 2700,
                'id_user' => 68,
                'id_permission' => 132,
                'created_at' => '2026-03-25 19:56:12',
                'updated_at' => '2026-03-25 19:56:12'
            ],
            [
                'id_user_permission' => 2701,
                'id_user' => 68,
                'id_permission' => 131,
                'created_at' => '2026-03-25 19:56:12',
                'updated_at' => '2026-03-25 19:56:12'
            ],
            [
                'id_user_permission' => 2702,
                'id_user' => 68,
                'id_permission' => 133,
                'created_at' => '2026-03-25 19:56:12',
                'updated_at' => '2026-03-25 19:56:12'
            ],
            [
                'id_user_permission' => 2703,
                'id_user' => 68,
                'id_permission' => 134,
                'created_at' => '2026-03-25 19:56:12',
                'updated_at' => '2026-03-25 19:56:12'
            ],
            [
                'id_user_permission' => 2704,
                'id_user' => 68,
                'id_permission' => 135,
                'created_at' => '2026-03-25 19:56:17',
                'updated_at' => '2026-03-25 19:56:17'
            ],
            [
                'id_user_permission' => 2705,
                'id_user' => 68,
                'id_permission' => 136,
                'created_at' => '2026-03-25 19:56:19',
                'updated_at' => '2026-03-25 19:56:19'
            ],
            [
                'id_user_permission' => 2706,
                'id_user' => 68,
                'id_permission' => 137,
                'created_at' => '2026-03-25 19:56:19',
                'updated_at' => '2026-03-25 19:56:19'
            ],
            [
                'id_user_permission' => 2707,
                'id_user' => 68,
                'id_permission' => 138,
                'created_at' => '2026-03-25 19:56:19',
                'updated_at' => '2026-03-25 19:56:19'
            ],
            [
                'id_user_permission' => 2708,
                'id_user' => 68,
                'id_permission' => 141,
                'created_at' => '2026-03-25 19:56:27',
                'updated_at' => '2026-03-25 19:56:27'
            ],
            [
                'id_user_permission' => 2709,
                'id_user' => 68,
                'id_permission' => 142,
                'created_at' => '2026-03-25 19:56:30',
                'updated_at' => '2026-03-25 19:56:30'
            ],
            [
                'id_user_permission' => 2710,
                'id_user' => 68,
                'id_permission' => 143,
                'created_at' => '2026-03-25 19:56:30',
                'updated_at' => '2026-03-25 19:56:30'
            ],
            [
                'id_user_permission' => 2711,
                'id_user' => 68,
                'id_permission' => 144,
                'created_at' => '2026-03-25 19:56:30',
                'updated_at' => '2026-03-25 19:56:30'
            ],
            [
                'id_user_permission' => 2712,
                'id_user' => 68,
                'id_permission' => 145,
                'created_at' => '2026-03-25 19:56:40',
                'updated_at' => '2026-03-25 19:56:40'
            ],
            [
                'id_user_permission' => 2713,
                'id_user' => 68,
                'id_permission' => 146,
                'created_at' => '2026-03-25 19:56:42',
                'updated_at' => '2026-03-25 19:56:42'
            ],
            [
                'id_user_permission' => 2714,
                'id_user' => 68,
                'id_permission' => 147,
                'created_at' => '2026-03-25 19:56:42',
                'updated_at' => '2026-03-25 19:56:42'
            ],
            [
                'id_user_permission' => 2715,
                'id_user' => 68,
                'id_permission' => 148,
                'created_at' => '2026-03-25 19:56:42',
                'updated_at' => '2026-03-25 19:56:42'
            ],
            [
                'id_user_permission' => 2716,
                'id_user' => 68,
                'id_permission' => 149,
                'created_at' => '2026-03-25 19:56:42',
                'updated_at' => '2026-03-25 19:56:42'
            ],
            [
                'id_user_permission' => 2717,
                'id_user' => 68,
                'id_permission' => 150,
                'created_at' => '2026-03-25 19:56:46',
                'updated_at' => '2026-03-25 19:56:46'
            ],
            [
                'id_user_permission' => 2718,
                'id_user' => 68,
                'id_permission' => 151,
                'created_at' => '2026-03-25 19:56:47',
                'updated_at' => '2026-03-25 19:56:47'
            ],
            [
                'id_user_permission' => 2719,
                'id_user' => 68,
                'id_permission' => 157,
                'created_at' => '2026-03-25 19:56:52',
                'updated_at' => '2026-03-25 19:56:52'
            ],
            [
                'id_user_permission' => 2720,
                'id_user' => 68,
                'id_permission' => 158,
                'created_at' => '2026-03-25 19:56:54',
                'updated_at' => '2026-03-25 19:56:54'
            ],
            [
                'id_user_permission' => 2721,
                'id_user' => 68,
                'id_permission' => 223,
                'created_at' => '2026-03-25 19:57:24',
                'updated_at' => '2026-03-25 19:57:24'
            ],
            [
                'id_user_permission' => 2722,
                'id_user' => 20,
                'id_permission' => 161,
                'created_at' => '2026-03-25 22:01:25',
                'updated_at' => '2026-03-25 22:01:25'
            ],
            [
                'id_user_permission' => 2723,
                'id_user' => 29,
                'id_permission' => 174,
                'created_at' => '2026-03-26 21:07:30',
                'updated_at' => '2026-03-26 21:07:30'
            ],
            [
                'id_user_permission' => 2724,
                'id_user' => 29,
                'id_permission' => 177,
                'created_at' => '2026-03-26 21:07:35',
                'updated_at' => '2026-03-26 21:07:35'
            ],
            [
                'id_user_permission' => 2725,
                'id_user' => 29,
                'id_permission' => 178,
                'created_at' => '2026-03-26 21:07:39',
                'updated_at' => '2026-03-26 21:07:39'
            ],
            [
                'id_user_permission' => 2726,
                'id_user' => 29,
                'id_permission' => 179,
                'created_at' => '2026-03-26 21:07:50',
                'updated_at' => '2026-03-26 21:07:50'
            ],
            [
                'id_user_permission' => 2727,
                'id_user' => 29,
                'id_permission' => 240,
                'created_at' => '2026-03-26 21:08:01',
                'updated_at' => '2026-03-26 21:08:01'
            ],
            [
                'id_user_permission' => 2728,
                'id_user' => 29,
                'id_permission' => 241,
                'created_at' => '2026-03-26 21:08:02',
                'updated_at' => '2026-03-26 21:08:02'
            ],
            [
                'id_user_permission' => 2729,
                'id_user' => 29,
                'id_permission' => 243,
                'created_at' => '2026-03-26 21:08:07',
                'updated_at' => '2026-03-26 21:08:07'
            ],
            [
                'id_user_permission' => 2730,
                'id_user' => 29,
                'id_permission' => 244,
                'created_at' => '2026-03-26 21:08:08',
                'updated_at' => '2026-03-26 21:08:08'
            ],
            [
                'id_user_permission' => 2732,
                'id_user' => 29,
                'id_permission' => 213,
                'created_at' => '2026-03-26 21:08:52',
                'updated_at' => '2026-03-26 21:08:52'
            ],
            [
                'id_user_permission' => 2733,
                'id_user' => 29,
                'id_permission' => 214,
                'created_at' => '2026-03-26 21:08:53',
                'updated_at' => '2026-03-26 21:08:53'
            ],
            [
                'id_user_permission' => 2738,
                'id_user' => 59,
                'id_permission' => 13,
                'created_at' => '2026-03-26 23:04:48',
                'updated_at' => '2026-03-26 23:04:48'
            ],
            [
                'id_user_permission' => 2739,
                'id_user' => 59,
                'id_permission' => 19,
                'created_at' => '2026-03-26 23:04:56',
                'updated_at' => '2026-03-26 23:04:56'
            ],
            [
                'id_user_permission' => 2740,
                'id_user' => 59,
                'id_permission' => 23,
                'created_at' => '2026-03-26 23:04:57',
                'updated_at' => '2026-03-26 23:04:57'
            ],
            [
                'id_user_permission' => 2741,
                'id_user' => 59,
                'id_permission' => 39,
                'created_at' => '2026-03-26 23:05:07',
                'updated_at' => '2026-03-26 23:05:07'
            ],
            [
                'id_user_permission' => 2742,
                'id_user' => 59,
                'id_permission' => 59,
                'created_at' => '2026-03-26 23:05:25',
                'updated_at' => '2026-03-26 23:05:25'
            ],
            [
                'id_user_permission' => 2743,
                'id_user' => 59,
                'id_permission' => 63,
                'created_at' => '2026-03-26 23:05:31',
                'updated_at' => '2026-03-26 23:05:31'
            ],
            [
                'id_user_permission' => 2745,
                'id_user' => 59,
                'id_permission' => 173,
                'created_at' => '2026-03-26 23:07:40',
                'updated_at' => '2026-03-26 23:07:40'
            ],
            [
                'id_user_permission' => 2746,
                'id_user' => 59,
                'id_permission' => 244,
                'created_at' => '2026-03-26 23:07:51',
                'updated_at' => '2026-03-26 23:07:51'
            ],
            [
                'id_user_permission' => 2747,
                'id_user' => 59,
                'id_permission' => 180,
                'created_at' => '2026-03-26 23:07:56',
                'updated_at' => '2026-03-26 23:07:56'
            ],
            [
                'id_user_permission' => 2749,
                'id_user' => 59,
                'id_permission' => 193,
                'created_at' => '2026-03-26 23:08:18',
                'updated_at' => '2026-03-26 23:08:18'
            ],
            [
                'id_user_permission' => 2751,
                'id_user' => 43,
                'id_permission' => 105,
                'created_at' => '2026-03-26 23:11:25',
                'updated_at' => '2026-03-26 23:11:25'
            ],
            [
                'id_user_permission' => 2752,
                'id_user' => 43,
                'id_permission' => 180,
                'created_at' => '2026-03-26 23:12:10',
                'updated_at' => '2026-03-26 23:12:10'
            ],
            [
                'id_user_permission' => 2753,
                'id_user' => 33,
                'id_permission' => 105,
                'created_at' => '2026-03-26 23:13:51',
                'updated_at' => '2026-03-26 23:13:51'
            ],
            [
                'id_user_permission' => 2754,
                'id_user' => 33,
                'id_permission' => 180,
                'created_at' => '2026-03-26 23:14:27',
                'updated_at' => '2026-03-26 23:14:27'
            ],
            [
                'id_user_permission' => 2755,
                'id_user' => 33,
                'id_permission' => 187,
                'created_at' => '2026-03-26 23:14:34',
                'updated_at' => '2026-03-26 23:14:34'
            ],
            [
                'id_user_permission' => 2756,
                'id_user' => 33,
                'id_permission' => 191,
                'created_at' => '2026-03-26 23:14:50',
                'updated_at' => '2026-03-26 23:14:50'
            ],
            [
                'id_user_permission' => 2757,
                'id_user' => 33,
                'id_permission' => 192,
                'created_at' => '2026-03-26 23:14:51',
                'updated_at' => '2026-03-26 23:14:51'
            ],
            [
                'id_user_permission' => 2758,
                'id_user' => 33,
                'id_permission' => 193,
                'created_at' => '2026-03-26 23:14:53',
                'updated_at' => '2026-03-26 23:14:53'
            ],
            [
                'id_user_permission' => 2759,
                'id_user' => 33,
                'id_permission' => 188,
                'created_at' => '2026-03-26 23:15:01',
                'updated_at' => '2026-03-26 23:15:01'
            ],
            [
                'id_user_permission' => 2760,
                'id_user' => 33,
                'id_permission' => 189,
                'created_at' => '2026-03-26 23:15:02',
                'updated_at' => '2026-03-26 23:15:02'
            ],
            [
                'id_user_permission' => 2761,
                'id_user' => 33,
                'id_permission' => 190,
                'created_at' => '2026-03-26 23:15:02',
                'updated_at' => '2026-03-26 23:15:02'
            ],
            [
                'id_user_permission' => 2762,
                'id_user' => 33,
                'id_permission' => 194,
                'created_at' => '2026-03-26 23:15:11',
                'updated_at' => '2026-03-26 23:15:11'
            ],
            [
                'id_user_permission' => 2763,
                'id_user' => 33,
                'id_permission' => 195,
                'created_at' => '2026-03-26 23:15:12',
                'updated_at' => '2026-03-26 23:15:12'
            ],
            [
                'id_user_permission' => 2764,
                'id_user' => 33,
                'id_permission' => 196,
                'created_at' => '2026-03-26 23:15:12',
                'updated_at' => '2026-03-26 23:15:12'
            ],
            [
                'id_user_permission' => 2765,
                'id_user' => 33,
                'id_permission' => 197,
                'created_at' => '2026-03-26 23:15:15',
                'updated_at' => '2026-03-26 23:15:15'
            ],
            [
                'id_user_permission' => 2766,
                'id_user' => 33,
                'id_permission' => 198,
                'created_at' => '2026-03-26 23:15:16',
                'updated_at' => '2026-03-26 23:15:16'
            ],
            [
                'id_user_permission' => 2767,
                'id_user' => 33,
                'id_permission' => 199,
                'created_at' => '2026-03-26 23:15:16',
                'updated_at' => '2026-03-26 23:15:16'
            ],
            [
                'id_user_permission' => 2768,
                'id_user' => 33,
                'id_permission' => 200,
                'created_at' => '2026-03-26 23:15:20',
                'updated_at' => '2026-03-26 23:15:20'
            ],
            [
                'id_user_permission' => 2769,
                'id_user' => 33,
                'id_permission' => 246,
                'created_at' => '2026-03-26 23:15:41',
                'updated_at' => '2026-03-26 23:15:41'
            ],
            [
                'id_user_permission' => 2770,
                'id_user' => 33,
                'id_permission' => 249,
                'created_at' => '2026-03-26 23:15:50',
                'updated_at' => '2026-03-26 23:15:50'
            ],
            [
                'id_user_permission' => 2771,
                'id_user' => 50,
                'id_permission' => 20,
                'created_at' => '2026-03-26 23:16:27',
                'updated_at' => '2026-03-26 23:16:27'
            ],
            [
                'id_user_permission' => 2772,
                'id_user' => 50,
                'id_permission' => 21,
                'created_at' => '2026-03-26 23:16:28',
                'updated_at' => '2026-03-26 23:16:28'
            ],
            [
                'id_user_permission' => 2773,
                'id_user' => 50,
                'id_permission' => 22,
                'created_at' => '2026-03-26 23:16:30',
                'updated_at' => '2026-03-26 23:16:30'
            ],
            [
                'id_user_permission' => 2774,
                'id_user' => 50,
                'id_permission' => 24,
                'created_at' => '2026-03-26 23:16:34',
                'updated_at' => '2026-03-26 23:16:34'
            ],
            [
                'id_user_permission' => 2775,
                'id_user' => 50,
                'id_permission' => 25,
                'created_at' => '2026-03-26 23:16:35',
                'updated_at' => '2026-03-26 23:16:35'
            ],
            [
                'id_user_permission' => 2776,
                'id_user' => 50,
                'id_permission' => 26,
                'created_at' => '2026-03-26 23:16:35',
                'updated_at' => '2026-03-26 23:16:35'
            ],
            [
                'id_user_permission' => 2777,
                'id_user' => 53,
                'id_permission' => 128,
                'created_at' => '2026-03-29 20:56:16',
                'updated_at' => '2026-03-29 20:56:16'
            ],
            [
                'id_user_permission' => 2778,
                'id_user' => 53,
                'id_permission' => 129,
                'created_at' => '2026-03-29 20:56:28',
                'updated_at' => '2026-03-29 20:56:28'
            ],
            [
                'id_user_permission' => 2779,
                'id_user' => 53,
                'id_permission' => 130,
                'created_at' => '2026-03-29 20:56:31',
                'updated_at' => '2026-03-29 20:56:31'
            ],
            [
                'id_user_permission' => 2780,
                'id_user' => 53,
                'id_permission' => 131,
                'created_at' => '2026-03-29 20:56:34',
                'updated_at' => '2026-03-29 20:56:34'
            ],
            [
                'id_user_permission' => 2781,
                'id_user' => 53,
                'id_permission' => 132,
                'created_at' => '2026-03-29 20:56:38',
                'updated_at' => '2026-03-29 20:56:38'
            ],
            [
                'id_user_permission' => 2782,
                'id_user' => 53,
                'id_permission' => 133,
                'created_at' => '2026-03-29 20:56:42',
                'updated_at' => '2026-03-29 20:56:42'
            ],
            [
                'id_user_permission' => 2783,
                'id_user' => 53,
                'id_permission' => 134,
                'created_at' => '2026-03-29 20:56:46',
                'updated_at' => '2026-03-29 20:56:46'
            ],
            [
                'id_user_permission' => 2784,
                'id_user' => 53,
                'id_permission' => 135,
                'created_at' => '2026-03-29 20:56:47',
                'updated_at' => '2026-03-29 20:56:47'
            ],
            [
                'id_user_permission' => 2785,
                'id_user' => 53,
                'id_permission' => 136,
                'created_at' => '2026-03-29 20:56:52',
                'updated_at' => '2026-03-29 20:56:52'
            ],
            [
                'id_user_permission' => 2786,
                'id_user' => 53,
                'id_permission' => 137,
                'created_at' => '2026-03-29 20:56:52',
                'updated_at' => '2026-03-29 20:56:52'
            ],
            [
                'id_user_permission' => 2787,
                'id_user' => 53,
                'id_permission' => 138,
                'created_at' => '2026-03-29 20:56:59',
                'updated_at' => '2026-03-29 20:56:59'
            ],
            [
                'id_user_permission' => 2788,
                'id_user' => 53,
                'id_permission' => 139,
                'created_at' => '2026-03-29 20:57:02',
                'updated_at' => '2026-03-29 20:57:02'
            ],
            [
                'id_user_permission' => 2789,
                'id_user' => 53,
                'id_permission' => 140,
                'created_at' => '2026-03-29 20:57:06',
                'updated_at' => '2026-03-29 20:57:06'
            ],
            [
                'id_user_permission' => 2790,
                'id_user' => 53,
                'id_permission' => 141,
                'created_at' => '2026-03-29 20:57:07',
                'updated_at' => '2026-03-29 20:57:07'
            ],
            [
                'id_user_permission' => 2791,
                'id_user' => 53,
                'id_permission' => 142,
                'created_at' => '2026-03-29 20:57:11',
                'updated_at' => '2026-03-29 20:57:11'
            ],
            [
                'id_user_permission' => 2792,
                'id_user' => 53,
                'id_permission' => 143,
                'created_at' => '2026-03-29 20:57:12',
                'updated_at' => '2026-03-29 20:57:12'
            ],
            [
                'id_user_permission' => 2793,
                'id_user' => 53,
                'id_permission' => 144,
                'created_at' => '2026-03-29 20:57:16',
                'updated_at' => '2026-03-29 20:57:16'
            ],
            [
                'id_user_permission' => 2794,
                'id_user' => 53,
                'id_permission' => 145,
                'created_at' => '2026-03-29 20:57:17',
                'updated_at' => '2026-03-29 20:57:17'
            ],
            [
                'id_user_permission' => 2795,
                'id_user' => 53,
                'id_permission' => 146,
                'created_at' => '2026-03-29 20:57:20',
                'updated_at' => '2026-03-29 20:57:20'
            ],
            [
                'id_user_permission' => 2796,
                'id_user' => 53,
                'id_permission' => 150,
                'created_at' => '2026-03-29 20:57:29',
                'updated_at' => '2026-03-29 20:57:29'
            ],
            [
                'id_user_permission' => 2797,
                'id_user' => 53,
                'id_permission' => 151,
                'created_at' => '2026-03-29 20:57:29',
                'updated_at' => '2026-03-29 20:57:29'
            ],
            [
                'id_user_permission' => 2798,
                'id_user' => 53,
                'id_permission' => 152,
                'created_at' => '2026-03-29 20:57:35',
                'updated_at' => '2026-03-29 20:57:35'
            ],
            [
                'id_user_permission' => 2799,
                'id_user' => 53,
                'id_permission' => 153,
                'created_at' => '2026-03-29 20:57:35',
                'updated_at' => '2026-03-29 20:57:35'
            ],
            [
                'id_user_permission' => 2800,
                'id_user' => 53,
                'id_permission' => 157,
                'created_at' => '2026-03-29 20:57:41',
                'updated_at' => '2026-03-29 20:57:41'
            ],
            [
                'id_user_permission' => 2801,
                'id_user' => 53,
                'id_permission' => 158,
                'created_at' => '2026-03-29 20:57:42',
                'updated_at' => '2026-03-29 20:57:42'
            ],
            [
                'id_user_permission' => 2802,
                'id_user' => 53,
                'id_permission' => 159,
                'created_at' => '2026-03-29 20:57:52',
                'updated_at' => '2026-03-29 20:57:52'
            ],
            [
                'id_user_permission' => 2803,
                'id_user' => 53,
                'id_permission' => 160,
                'created_at' => '2026-03-29 20:57:56',
                'updated_at' => '2026-03-29 20:57:56'
            ],
            [
                'id_user_permission' => 2804,
                'id_user' => 53,
                'id_permission' => 172,
                'created_at' => '2026-03-29 20:58:02',
                'updated_at' => '2026-03-29 20:58:02'
            ],
            [
                'id_user_permission' => 2805,
                'id_user' => 53,
                'id_permission' => 171,
                'created_at' => '2026-03-29 20:58:02',
                'updated_at' => '2026-03-29 20:58:02'
            ],
            [
                'id_user_permission' => 2806,
                'id_user' => 39,
                'id_permission' => 184,
                'created_at' => '2026-03-29 21:48:17',
                'updated_at' => '2026-03-29 21:48:17'
            ],
            [
                'id_user_permission' => 2807,
                'id_user' => 39,
                'id_permission' => 188,
                'created_at' => '2026-03-29 21:48:22',
                'updated_at' => '2026-03-29 21:48:22'
            ],
            [
                'id_user_permission' => 2808,
                'id_user' => 39,
                'id_permission' => 189,
                'created_at' => '2026-03-29 21:48:23',
                'updated_at' => '2026-03-29 21:48:23'
            ],
            [
                'id_user_permission' => 2809,
                'id_user' => 39,
                'id_permission' => 190,
                'created_at' => '2026-03-29 21:48:26',
                'updated_at' => '2026-03-29 21:48:26'
            ],
            [
                'id_user_permission' => 2810,
                'id_user' => 39,
                'id_permission' => 191,
                'created_at' => '2026-03-29 21:48:27',
                'updated_at' => '2026-03-29 21:48:27'
            ],
            [
                'id_user_permission' => 2811,
                'id_user' => 39,
                'id_permission' => 192,
                'created_at' => '2026-03-29 21:48:27',
                'updated_at' => '2026-03-29 21:48:27'
            ],
            [
                'id_user_permission' => 2812,
                'id_user' => 39,
                'id_permission' => 193,
                'created_at' => '2026-03-29 21:48:35',
                'updated_at' => '2026-03-29 21:48:35'
            ],
            [
                'id_user_permission' => 2813,
                'id_user' => 39,
                'id_permission' => 194,
                'created_at' => '2026-03-29 21:48:35',
                'updated_at' => '2026-03-29 21:48:35'
            ],
            [
                'id_user_permission' => 2814,
                'id_user' => 39,
                'id_permission' => 195,
                'created_at' => '2026-03-29 21:48:35',
                'updated_at' => '2026-03-29 21:48:35'
            ],
            [
                'id_user_permission' => 2815,
                'id_user' => 39,
                'id_permission' => 196,
                'created_at' => '2026-03-29 21:48:35',
                'updated_at' => '2026-03-29 21:48:35'
            ],
            [
                'id_user_permission' => 2816,
                'id_user' => 39,
                'id_permission' => 197,
                'created_at' => '2026-03-29 21:48:35',
                'updated_at' => '2026-03-29 21:48:35'
            ],
            [
                'id_user_permission' => 2817,
                'id_user' => 39,
                'id_permission' => 198,
                'created_at' => '2026-03-29 21:48:42',
                'updated_at' => '2026-03-29 21:48:42'
            ],
            [
                'id_user_permission' => 2818,
                'id_user' => 39,
                'id_permission' => 209,
                'created_at' => '2026-03-29 21:48:54',
                'updated_at' => '2026-03-29 21:48:54'
            ],
            [
                'id_user_permission' => 2819,
                'id_user' => 39,
                'id_permission' => 210,
                'created_at' => '2026-03-29 21:48:55',
                'updated_at' => '2026-03-29 21:48:55'
            ],
            [
                'id_user_permission' => 2820,
                'id_user' => 39,
                'id_permission' => 217,
                'created_at' => '2026-03-29 21:48:59',
                'updated_at' => '2026-03-29 21:48:59'
            ],
            [
                'id_user_permission' => 2821,
                'id_user' => 39,
                'id_permission' => 218,
                'created_at' => '2026-03-29 21:49:00',
                'updated_at' => '2026-03-29 21:49:00'
            ],
            [
                'id_user_permission' => 2822,
                'id_user' => 39,
                'id_permission' => 246,
                'created_at' => '2026-03-29 21:49:04',
                'updated_at' => '2026-03-29 21:49:04'
            ],
            [
                'id_user_permission' => 2823,
                'id_user' => 39,
                'id_permission' => 24,
                'created_at' => '2026-03-29 21:53:16',
                'updated_at' => '2026-03-29 21:53:16'
            ],
            [
                'id_user_permission' => 2824,
                'id_user' => 39,
                'id_permission' => 25,
                'created_at' => '2026-03-29 21:53:19',
                'updated_at' => '2026-03-29 21:53:19'
            ],
            [
                'id_user_permission' => 2825,
                'id_user' => 39,
                'id_permission' => 26,
                'created_at' => '2026-03-29 21:53:19',
                'updated_at' => '2026-03-29 21:53:19'
            ],
            [
                'id_user_permission' => 2826,
                'id_user' => 60,
                'id_permission' => 180,
                'created_at' => '2026-03-30 01:34:27',
                'updated_at' => '2026-03-30 01:34:27'
            ],
            [
                'id_user_permission' => 2827,
                'id_user' => 60,
                'id_permission' => 174,
                'created_at' => '2026-03-30 01:34:39',
                'updated_at' => '2026-03-30 01:34:39'
            ],
            [
                'id_user_permission' => 2828,
                'id_user' => 60,
                'id_permission' => 177,
                'created_at' => '2026-03-30 01:34:43',
                'updated_at' => '2026-03-30 01:34:43'
            ],
            [
                'id_user_permission' => 2829,
                'id_user' => 60,
                'id_permission' => 178,
                'created_at' => '2026-03-30 01:34:45',
                'updated_at' => '2026-03-30 01:34:45'
            ],
            [
                'id_user_permission' => 2830,
                'id_user' => 60,
                'id_permission' => 179,
                'created_at' => '2026-03-30 01:34:49',
                'updated_at' => '2026-03-30 01:34:49'
            ],
            [
                'id_user_permission' => 2831,
                'id_user' => 60,
                'id_permission' => 240,
                'created_at' => '2026-03-30 01:34:55',
                'updated_at' => '2026-03-30 01:34:55'
            ],
            [
                'id_user_permission' => 2832,
                'id_user' => 60,
                'id_permission' => 241,
                'created_at' => '2026-03-30 01:34:58',
                'updated_at' => '2026-03-30 01:34:58'
            ],
            [
                'id_user_permission' => 2833,
                'id_user' => 60,
                'id_permission' => 244,
                'created_at' => '2026-03-30 01:35:04',
                'updated_at' => '2026-03-30 01:35:04'
            ],
            [
                'id_user_permission' => 2835,
                'id_user' => 56,
                'id_permission' => 241,
                'created_at' => '2026-03-30 01:35:59',
                'updated_at' => '2026-03-30 01:35:59'
            ],
            [
                'id_user_permission' => 2836,
                'id_user' => 56,
                'id_permission' => 245,
                'created_at' => '2026-03-30 01:36:05',
                'updated_at' => '2026-03-30 01:36:05'
            ],
            [
                'id_user_permission' => 2837,
                'id_user' => 29,
                'id_permission' => 245,
                'created_at' => '2026-03-30 01:36:51',
                'updated_at' => '2026-03-30 01:36:51'
            ],
            [
                'id_user_permission' => 2838,
                'id_user' => 67,
                'id_permission' => 59,
                'created_at' => '2026-03-30 01:37:43',
                'updated_at' => '2026-03-30 01:37:43'
            ],
            [
                'id_user_permission' => 2839,
                'id_user' => 67,
                'id_permission' => 63,
                'created_at' => '2026-03-30 01:37:49',
                'updated_at' => '2026-03-30 01:37:49'
            ],
            [
                'id_user_permission' => 2840,
                'id_user' => 67,
                'id_permission' => 174,
                'created_at' => '2026-03-30 01:38:10',
                'updated_at' => '2026-03-30 01:38:10'
            ],
            [
                'id_user_permission' => 2841,
                'id_user' => 67,
                'id_permission' => 177,
                'created_at' => '2026-03-30 01:38:12',
                'updated_at' => '2026-03-30 01:38:12'
            ],
            [
                'id_user_permission' => 2842,
                'id_user' => 67,
                'id_permission' => 178,
                'created_at' => '2026-03-30 01:38:12',
                'updated_at' => '2026-03-30 01:38:12'
            ],
            [
                'id_user_permission' => 2843,
                'id_user' => 67,
                'id_permission' => 179,
                'created_at' => '2026-03-30 01:38:12',
                'updated_at' => '2026-03-30 01:38:12'
            ],
            [
                'id_user_permission' => 2844,
                'id_user' => 67,
                'id_permission' => 241,
                'created_at' => '2026-03-30 01:38:30',
                'updated_at' => '2026-03-30 01:38:30'
            ],
            [
                'id_user_permission' => 2845,
                'id_user' => 67,
                'id_permission' => 240,
                'created_at' => '2026-03-30 01:38:32',
                'updated_at' => '2026-03-30 01:38:32'
            ],
            [
                'id_user_permission' => 2846,
                'id_user' => 67,
                'id_permission' => 243,
                'created_at' => '2026-03-30 01:38:32',
                'updated_at' => '2026-03-30 01:38:32'
            ],
            [
                'id_user_permission' => 2847,
                'id_user' => 67,
                'id_permission' => 244,
                'created_at' => '2026-03-30 01:38:32',
                'updated_at' => '2026-03-30 01:38:32'
            ],
            [
                'id_user_permission' => 2848,
                'id_user' => 67,
                'id_permission' => 245,
                'created_at' => '2026-03-30 01:38:37',
                'updated_at' => '2026-03-30 01:38:37'
            ],
            [
                'id_user_permission' => 2849,
                'id_user' => 67,
                'id_permission' => 180,
                'created_at' => '2026-03-30 01:38:41',
                'updated_at' => '2026-03-30 01:38:41'
            ],
            [
                'id_user_permission' => 2850,
                'id_user' => 57,
                'id_permission' => 180,
                'created_at' => '2026-03-30 01:47:42',
                'updated_at' => '2026-03-30 01:47:42'
            ],
            [
                'id_user_permission' => 2851,
                'id_user' => 57,
                'id_permission' => 186,
                'created_at' => '2026-03-30 01:47:50',
                'updated_at' => '2026-03-30 01:47:50'
            ],
            [
                'id_user_permission' => 2852,
                'id_user' => 57,
                'id_permission' => 193,
                'created_at' => '2026-03-30 01:48:01',
                'updated_at' => '2026-03-30 01:48:01'
            ],
            [
                'id_user_permission' => 2853,
                'id_user' => 57,
                'id_permission' => 174,
                'created_at' => '2026-03-30 01:48:20',
                'updated_at' => '2026-03-30 01:48:20'
            ],
            [
                'id_user_permission' => 2854,
                'id_user' => 57,
                'id_permission' => 177,
                'created_at' => '2026-03-30 01:48:27',
                'updated_at' => '2026-03-30 01:48:27'
            ],
            [
                'id_user_permission' => 2855,
                'id_user' => 57,
                'id_permission' => 178,
                'created_at' => '2026-03-30 01:48:30',
                'updated_at' => '2026-03-30 01:48:30'
            ],
            [
                'id_user_permission' => 2856,
                'id_user' => 57,
                'id_permission' => 179,
                'created_at' => '2026-03-30 01:48:30',
                'updated_at' => '2026-03-30 01:48:30'
            ],
            [
                'id_user_permission' => 2857,
                'id_user' => 57,
                'id_permission' => 237,
                'created_at' => '2026-03-30 01:48:30',
                'updated_at' => '2026-03-30 01:48:30'
            ],
            [
                'id_user_permission' => 2858,
                'id_user' => 57,
                'id_permission' => 240,
                'created_at' => '2026-03-30 01:48:39',
                'updated_at' => '2026-03-30 01:48:39'
            ],
            [
                'id_user_permission' => 2859,
                'id_user' => 57,
                'id_permission' => 243,
                'created_at' => '2026-03-30 01:48:46',
                'updated_at' => '2026-03-30 01:48:46'
            ],
            [
                'id_user_permission' => 2860,
                'id_user' => 57,
                'id_permission' => 244,
                'created_at' => '2026-03-30 01:48:48',
                'updated_at' => '2026-03-30 01:48:48'
            ],
            [
                'id_user_permission' => 2861,
                'id_user' => 57,
                'id_permission' => 245,
                'created_at' => '2026-03-30 01:48:52',
                'updated_at' => '2026-03-30 01:48:52'
            ],
            [
                'id_user_permission' => 2862,
                'id_user' => 47,
                'id_permission' => 177,
                'created_at' => '2026-03-30 02:22:52',
                'updated_at' => '2026-03-30 02:22:52'
            ],
            [
                'id_user_permission' => 2863,
                'id_user' => 47,
                'id_permission' => 178,
                'created_at' => '2026-03-30 02:22:57',
                'updated_at' => '2026-03-30 02:22:57'
            ],
            [
                'id_user_permission' => 2864,
                'id_user' => 47,
                'id_permission' => 179,
                'created_at' => '2026-03-30 02:22:57',
                'updated_at' => '2026-03-30 02:22:57'
            ],
            [
                'id_user_permission' => 2867,
                'id_user' => 52,
                'id_permission' => 188,
                'created_at' => '2026-03-30 18:14:06',
                'updated_at' => '2026-03-30 18:14:06'
            ],
            [
                'id_user_permission' => 2868,
                'id_user' => 52,
                'id_permission' => 190,
                'created_at' => '2026-03-30 18:14:07',
                'updated_at' => '2026-03-30 18:14:07'
            ],
            [
                'id_user_permission' => 2869,
                'id_user' => 52,
                'id_permission' => 189,
                'created_at' => '2026-03-30 18:14:09',
                'updated_at' => '2026-03-30 18:14:09'
            ],
            [
                'id_user_permission' => 2870,
                'id_user' => 52,
                'id_permission' => 191,
                'created_at' => '2026-03-30 18:14:10',
                'updated_at' => '2026-03-30 18:14:10'
            ],
            [
                'id_user_permission' => 2871,
                'id_user' => 52,
                'id_permission' => 193,
                'created_at' => '2026-03-30 18:14:14',
                'updated_at' => '2026-03-30 18:14:14'
            ],
            [
                'id_user_permission' => 2872,
                'id_user' => 52,
                'id_permission' => 194,
                'created_at' => '2026-03-30 18:14:15',
                'updated_at' => '2026-03-30 18:14:15'
            ],
            [
                'id_user_permission' => 2873,
                'id_user' => 52,
                'id_permission' => 195,
                'created_at' => '2026-03-30 18:14:15',
                'updated_at' => '2026-03-30 18:14:15'
            ],
            [
                'id_user_permission' => 2874,
                'id_user' => 52,
                'id_permission' => 196,
                'created_at' => '2026-03-30 18:14:18',
                'updated_at' => '2026-03-30 18:14:18'
            ],
            [
                'id_user_permission' => 2875,
                'id_user' => 52,
                'id_permission' => 197,
                'created_at' => '2026-03-30 18:14:19',
                'updated_at' => '2026-03-30 18:14:19'
            ],
            [
                'id_user_permission' => 2876,
                'id_user' => 52,
                'id_permission' => 199,
                'created_at' => '2026-03-30 18:14:23',
                'updated_at' => '2026-03-30 18:14:23'
            ],
            [
                'id_user_permission' => 2877,
                'id_user' => 52,
                'id_permission' => 200,
                'created_at' => '2026-03-30 18:14:24',
                'updated_at' => '2026-03-30 18:14:24'
            ],
            [
                'id_user_permission' => 2878,
                'id_user' => 52,
                'id_permission' => 246,
                'created_at' => '2026-03-30 18:14:46',
                'updated_at' => '2026-03-30 18:14:46'
            ],
            [
                'id_user_permission' => 2880,
                'id_user' => 52,
                'id_permission' => 184,
                'created_at' => '2026-03-30 18:20:30',
                'updated_at' => '2026-03-30 18:20:30'
            ],
            [
                'id_user_permission' => 2881,
                'id_user' => 52,
                'id_permission' => 192,
                'created_at' => '2026-03-30 18:20:40',
                'updated_at' => '2026-03-30 18:20:40'
            ],
            [
                'id_user_permission' => 2882,
                'id_user' => 52,
                'id_permission' => 198,
                'created_at' => '2026-03-30 18:20:48',
                'updated_at' => '2026-03-30 18:20:48'
            ],
            [
                'id_user_permission' => 2883,
                'id_user' => 52,
                'id_permission' => 243,
                'created_at' => '2026-03-30 18:25:11',
                'updated_at' => '2026-03-30 18:25:11'
            ],
            [
                'id_user_permission' => 2884,
                'id_user' => 52,
                'id_permission' => 244,
                'created_at' => '2026-03-30 18:25:51',
                'updated_at' => '2026-03-30 18:25:51'
            ],
            [
                'id_user_permission' => 2885,
                'id_user' => 27,
                'id_permission' => 78,
                'created_at' => '2026-03-30 18:58:18',
                'updated_at' => '2026-03-30 18:58:18'
            ],
            [
                'id_user_permission' => 2886,
                'id_user' => 59,
                'id_permission' => 77,
                'created_at' => '2026-03-30 20:26:36',
                'updated_at' => '2026-03-30 20:26:36'
            ],
            [
                'id_user_permission' => 2887,
                'id_user' => 59,
                'id_permission' => 78,
                'created_at' => '2026-03-30 20:26:39',
                'updated_at' => '2026-03-30 20:26:39'
            ],
            [
                'id_user_permission' => 2888,
                'id_user' => 59,
                'id_permission' => 83,
                'created_at' => '2026-03-30 20:26:45',
                'updated_at' => '2026-03-30 20:26:45'
            ],
            [
                'id_user_permission' => 2889,
                'id_user' => 59,
                'id_permission' => 87,
                'created_at' => '2026-03-30 20:26:52',
                'updated_at' => '2026-03-30 20:26:52'
            ],
            [
                'id_user_permission' => 2890,
                'id_user' => 59,
                'id_permission' => 88,
                'created_at' => '2026-03-30 20:26:55',
                'updated_at' => '2026-03-30 20:26:55'
            ],
            [
                'id_user_permission' => 2891,
                'id_user' => 59,
                'id_permission' => 89,
                'created_at' => '2026-03-30 20:26:59',
                'updated_at' => '2026-03-30 20:26:59'
            ],
            [
                'id_user_permission' => 2892,
                'id_user' => 59,
                'id_permission' => 100,
                'created_at' => '2026-03-30 20:27:11',
                'updated_at' => '2026-03-30 20:27:11'
            ],
            [
                'id_user_permission' => 2893,
                'id_user' => 59,
                'id_permission' => 101,
                'created_at' => '2026-03-30 20:27:15',
                'updated_at' => '2026-03-30 20:27:15'
            ],
            [
                'id_user_permission' => 2894,
                'id_user' => 59,
                'id_permission' => 126,
                'created_at' => '2026-03-30 20:27:28',
                'updated_at' => '2026-03-30 20:27:28'
            ],
            [
                'id_user_permission' => 2895,
                'id_user' => 59,
                'id_permission' => 125,
                'created_at' => '2026-03-30 20:27:30',
                'updated_at' => '2026-03-30 20:27:30'
            ],
            [
                'id_user_permission' => 2896,
                'id_user' => 59,
                'id_permission' => 128,
                'created_at' => '2026-03-30 20:27:35',
                'updated_at' => '2026-03-30 20:27:35'
            ],
            [
                'id_user_permission' => 2897,
                'id_user' => 59,
                'id_permission' => 129,
                'created_at' => '2026-03-30 20:27:36',
                'updated_at' => '2026-03-30 20:27:36'
            ],
            [
                'id_user_permission' => 2898,
                'id_user' => 59,
                'id_permission' => 134,
                'created_at' => '2026-03-30 20:27:49',
                'updated_at' => '2026-03-30 20:27:49'
            ],
            [
                'id_user_permission' => 2899,
                'id_user' => 59,
                'id_permission' => 135,
                'created_at' => '2026-03-30 20:27:50',
                'updated_at' => '2026-03-30 20:27:50'
            ],
            [
                'id_user_permission' => 2900,
                'id_user' => 59,
                'id_permission' => 140,
                'created_at' => '2026-03-30 20:27:56',
                'updated_at' => '2026-03-30 20:27:56'
            ],
            [
                'id_user_permission' => 2901,
                'id_user' => 59,
                'id_permission' => 141,
                'created_at' => '2026-03-30 20:27:57',
                'updated_at' => '2026-03-30 20:27:57'
            ],
            [
                'id_user_permission' => 2902,
                'id_user' => 59,
                'id_permission' => 146,
                'created_at' => '2026-03-30 20:28:02',
                'updated_at' => '2026-03-30 20:28:02'
            ],
            [
                'id_user_permission' => 2903,
                'id_user' => 59,
                'id_permission' => 152,
                'created_at' => '2026-03-30 20:28:08',
                'updated_at' => '2026-03-30 20:28:08'
            ],
            [
                'id_user_permission' => 2904,
                'id_user' => 59,
                'id_permission' => 153,
                'created_at' => '2026-03-30 20:28:09',
                'updated_at' => '2026-03-30 20:28:09'
            ],
            [
                'id_user_permission' => 2905,
                'id_user' => 59,
                'id_permission' => 172,
                'created_at' => '2026-03-30 20:28:14',
                'updated_at' => '2026-03-30 20:28:14'
            ],
            [
                'id_user_permission' => 2906,
                'id_user' => 59,
                'id_permission' => 171,
                'created_at' => '2026-03-30 20:28:15',
                'updated_at' => '2026-03-30 20:28:15'
            ],
            [
                'id_user_permission' => 2907,
                'id_user' => 59,
                'id_permission' => 94,
                'created_at' => '2026-03-30 20:28:26',
                'updated_at' => '2026-03-30 20:28:26'
            ],
            [
                'id_user_permission' => 2908,
                'id_user' => 59,
                'id_permission' => 113,
                'created_at' => '2026-03-30 20:41:51',
                'updated_at' => '2026-03-30 20:41:51'
            ],
            [
                'id_user_permission' => 2909,
                'id_user' => 59,
                'id_permission' => 114,
                'created_at' => '2026-03-30 20:41:52',
                'updated_at' => '2026-03-30 20:41:52'
            ],
            [
                'id_user_permission' => 2912,
                'id_user' => 21,
                'id_permission' => 199,
                'created_at' => '2026-03-30 20:57:54',
                'updated_at' => '2026-03-30 20:57:54'
            ],
            [
                'id_user_permission' => 2913,
                'id_user' => 21,
                'id_permission' => 200,
                'created_at' => '2026-03-30 20:57:54',
                'updated_at' => '2026-03-30 20:57:54'
            ],
            [
                'id_user_permission' => 2914,
                'id_user' => 21,
                'id_permission' => 201,
                'created_at' => '2026-03-30 20:58:03',
                'updated_at' => '2026-03-30 20:58:03'
            ],
            [
                'id_user_permission' => 2915,
                'id_user' => 21,
                'id_permission' => 202,
                'created_at' => '2026-03-30 20:58:04',
                'updated_at' => '2026-03-30 20:58:04'
            ],
            [
                'id_user_permission' => 2916,
                'id_user' => 21,
                'id_permission' => 220,
                'created_at' => '2026-03-30 20:58:40',
                'updated_at' => '2026-03-30 20:58:40'
            ],
            [
                'id_user_permission' => 2917,
                'id_user' => 21,
                'id_permission' => 219,
                'created_at' => '2026-03-30 20:58:41',
                'updated_at' => '2026-03-30 20:58:41'
            ],
            [
                'id_user_permission' => 2918,
                'id_user' => 38,
                'id_permission' => 184,
                'created_at' => '2026-03-30 21:42:19',
                'updated_at' => '2026-03-30 21:42:19'
            ],
            [
                'id_user_permission' => 2919,
                'id_user' => 38,
                'id_permission' => 193,
                'created_at' => '2026-03-30 21:42:34',
                'updated_at' => '2026-03-30 21:42:34'
            ],
            [
                'id_user_permission' => 2920,
                'id_user' => 38,
                'id_permission' => 246,
                'created_at' => '2026-03-30 21:42:42',
                'updated_at' => '2026-03-30 21:42:42'
            ],
            [
                'id_user_permission' => 2921,
                'id_user' => 60,
                'id_permission' => 243,
                'created_at' => '2026-03-30 22:53:10',
                'updated_at' => '2026-03-30 22:53:10'
            ],
            [
                'id_user_permission' => 2922,
                'id_user' => 40,
                'id_permission' => 205,
                'created_at' => '2026-03-30 23:14:38',
                'updated_at' => '2026-03-30 23:14:38'
            ],
            [
                'id_user_permission' => 2923,
                'id_user' => 40,
                'id_permission' => 206,
                'created_at' => '2026-03-30 23:14:39',
                'updated_at' => '2026-03-30 23:14:39'
            ],
            [
                'id_user_permission' => 2924,
                'id_user' => 20,
                'id_permission' => 201,
                'created_at' => '2026-03-30 23:25:17',
                'updated_at' => '2026-03-30 23:25:17'
            ],
            [
                'id_user_permission' => 2925,
                'id_user' => 20,
                'id_permission' => 202,
                'created_at' => '2026-03-30 23:25:18',
                'updated_at' => '2026-03-30 23:25:18'
            ],
            [
                'id_user_permission' => 2928,
                'id_user' => 22,
                'id_permission' => 201,
                'created_at' => '2026-03-30 23:27:01',
                'updated_at' => '2026-03-30 23:27:01'
            ],
            [
                'id_user_permission' => 2929,
                'id_user' => 22,
                'id_permission' => 202,
                'created_at' => '2026-03-30 23:27:02',
                'updated_at' => '2026-03-30 23:27:02'
            ],
            [
                'id_user_permission' => 2930,
                'id_user' => 69,
                'id_permission' => 1,
                'created_at' => '2026-03-30 23:32:00',
                'updated_at' => '2026-03-30 23:32:00'
            ],
            [
                'id_user_permission' => 2931,
                'id_user' => 69,
                'id_permission' => 13,
                'created_at' => '2026-03-30 23:32:10',
                'updated_at' => '2026-03-30 23:32:10'
            ],
            [
                'id_user_permission' => 2932,
                'id_user' => 69,
                'id_permission' => 14,
                'created_at' => '2026-03-30 23:32:10',
                'updated_at' => '2026-03-30 23:32:10'
            ],
            [
                'id_user_permission' => 2933,
                'id_user' => 69,
                'id_permission' => 15,
                'created_at' => '2026-03-30 23:32:13',
                'updated_at' => '2026-03-30 23:32:13'
            ],
            [
                'id_user_permission' => 2934,
                'id_user' => 69,
                'id_permission' => 16,
                'created_at' => '2026-03-30 23:32:13',
                'updated_at' => '2026-03-30 23:32:13'
            ],
            [
                'id_user_permission' => 2935,
                'id_user' => 69,
                'id_permission' => 19,
                'created_at' => '2026-03-30 23:32:21',
                'updated_at' => '2026-03-30 23:32:21'
            ],
            [
                'id_user_permission' => 2936,
                'id_user' => 69,
                'id_permission' => 23,
                'created_at' => '2026-03-30 23:32:24',
                'updated_at' => '2026-03-30 23:32:24'
            ],
            [
                'id_user_permission' => 2937,
                'id_user' => 69,
                'id_permission' => 39,
                'created_at' => '2026-03-30 23:32:37',
                'updated_at' => '2026-03-30 23:32:37'
            ],
            [
                'id_user_permission' => 2938,
                'id_user' => 69,
                'id_permission' => 40,
                'created_at' => '2026-03-30 23:32:38',
                'updated_at' => '2026-03-30 23:32:38'
            ],
            [
                'id_user_permission' => 2939,
                'id_user' => 69,
                'id_permission' => 41,
                'created_at' => '2026-03-30 23:32:38',
                'updated_at' => '2026-03-30 23:32:38'
            ],
            [
                'id_user_permission' => 2940,
                'id_user' => 69,
                'id_permission' => 42,
                'created_at' => '2026-03-30 23:32:38',
                'updated_at' => '2026-03-30 23:32:38'
            ],
            [
                'id_user_permission' => 2941,
                'id_user' => 69,
                'id_permission' => 59,
                'created_at' => '2026-03-30 23:32:50',
                'updated_at' => '2026-03-30 23:32:50'
            ],
            [
                'id_user_permission' => 2942,
                'id_user' => 69,
                'id_permission' => 63,
                'created_at' => '2026-03-30 23:32:59',
                'updated_at' => '2026-03-30 23:32:59'
            ],
            [
                'id_user_permission' => 2943,
                'id_user' => 69,
                'id_permission' => 75,
                'created_at' => '2026-03-30 23:33:08',
                'updated_at' => '2026-03-30 23:33:08'
            ],
            [
                'id_user_permission' => 2945,
                'id_user' => 69,
                'id_permission' => 78,
                'created_at' => '2026-03-30 23:33:29',
                'updated_at' => '2026-03-30 23:33:29'
            ],
            [
                'id_user_permission' => 2946,
                'id_user' => 69,
                'id_permission' => 79,
                'created_at' => '2026-03-30 23:33:29',
                'updated_at' => '2026-03-30 23:33:29'
            ],
            [
                'id_user_permission' => 2947,
                'id_user' => 69,
                'id_permission' => 80,
                'created_at' => '2026-03-30 23:33:29',
                'updated_at' => '2026-03-30 23:33:29'
            ],
            [
                'id_user_permission' => 2948,
                'id_user' => 69,
                'id_permission' => 81,
                'created_at' => '2026-03-30 23:33:29',
                'updated_at' => '2026-03-30 23:33:29'
            ],
            [
                'id_user_permission' => 2949,
                'id_user' => 69,
                'id_permission' => 82,
                'created_at' => '2026-03-30 23:33:43',
                'updated_at' => '2026-03-30 23:33:43'
            ],
            [
                'id_user_permission' => 2950,
                'id_user' => 69,
                'id_permission' => 83,
                'created_at' => '2026-03-30 23:33:43',
                'updated_at' => '2026-03-30 23:33:43'
            ],
            [
                'id_user_permission' => 2951,
                'id_user' => 69,
                'id_permission' => 84,
                'created_at' => '2026-03-30 23:33:43',
                'updated_at' => '2026-03-30 23:33:43'
            ],
            [
                'id_user_permission' => 2952,
                'id_user' => 69,
                'id_permission' => 85,
                'created_at' => '2026-03-30 23:33:43',
                'updated_at' => '2026-03-30 23:33:43'
            ],
            [
                'id_user_permission' => 2953,
                'id_user' => 69,
                'id_permission' => 86,
                'created_at' => '2026-03-30 23:33:46',
                'updated_at' => '2026-03-30 23:33:46'
            ],
            [
                'id_user_permission' => 2954,
                'id_user' => 69,
                'id_permission' => 87,
                'created_at' => '2026-03-30 23:33:49',
                'updated_at' => '2026-03-30 23:33:49'
            ],
            [
                'id_user_permission' => 2955,
                'id_user' => 69,
                'id_permission' => 89,
                'created_at' => '2026-03-30 23:33:57',
                'updated_at' => '2026-03-30 23:33:57'
            ],
            [
                'id_user_permission' => 2956,
                'id_user' => 69,
                'id_permission' => 90,
                'created_at' => '2026-03-30 23:33:58',
                'updated_at' => '2026-03-30 23:33:58'
            ],
            [
                'id_user_permission' => 2957,
                'id_user' => 69,
                'id_permission' => 91,
                'created_at' => '2026-03-30 23:33:58',
                'updated_at' => '2026-03-30 23:33:58'
            ],
            [
                'id_user_permission' => 2958,
                'id_user' => 69,
                'id_permission' => 92,
                'created_at' => '2026-03-30 23:34:03',
                'updated_at' => '2026-03-30 23:34:03'
            ],
            [
                'id_user_permission' => 2959,
                'id_user' => 69,
                'id_permission' => 93,
                'created_at' => '2026-03-30 23:34:04',
                'updated_at' => '2026-03-30 23:34:04'
            ],
            [
                'id_user_permission' => 2960,
                'id_user' => 69,
                'id_permission' => 94,
                'created_at' => '2026-03-30 23:34:06',
                'updated_at' => '2026-03-30 23:34:06'
            ],
            [
                'id_user_permission' => 2961,
                'id_user' => 69,
                'id_permission' => 105,
                'created_at' => '2026-03-30 23:34:48',
                'updated_at' => '2026-03-30 23:34:48'
            ],
            [
                'id_user_permission' => 2962,
                'id_user' => 69,
                'id_permission' => 112,
                'created_at' => '2026-03-30 23:35:14',
                'updated_at' => '2026-03-30 23:35:14'
            ],
            [
                'id_user_permission' => 2963,
                'id_user' => 69,
                'id_permission' => 111,
                'created_at' => '2026-03-30 23:35:15',
                'updated_at' => '2026-03-30 23:35:15'
            ],
            [
                'id_user_permission' => 2964,
                'id_user' => 69,
                'id_permission' => 129,
                'created_at' => '2026-03-30 23:35:41',
                'updated_at' => '2026-03-30 23:35:41'
            ],
            [
                'id_user_permission' => 2965,
                'id_user' => 69,
                'id_permission' => 130,
                'created_at' => '2026-03-30 23:35:42',
                'updated_at' => '2026-03-30 23:35:42'
            ],
            [
                'id_user_permission' => 2966,
                'id_user' => 69,
                'id_permission' => 131,
                'created_at' => '2026-03-30 23:35:42',
                'updated_at' => '2026-03-30 23:35:42'
            ],
            [
                'id_user_permission' => 2967,
                'id_user' => 69,
                'id_permission' => 132,
                'created_at' => '2026-03-30 23:35:42',
                'updated_at' => '2026-03-30 23:35:42'
            ],
            [
                'id_user_permission' => 2968,
                'id_user' => 69,
                'id_permission' => 134,
                'created_at' => '2026-03-30 23:35:45',
                'updated_at' => '2026-03-30 23:35:45'
            ],
            [
                'id_user_permission' => 2969,
                'id_user' => 69,
                'id_permission' => 135,
                'created_at' => '2026-03-30 23:35:46',
                'updated_at' => '2026-03-30 23:35:46'
            ],
            [
                'id_user_permission' => 2970,
                'id_user' => 69,
                'id_permission' => 133,
                'created_at' => '2026-03-30 23:35:46',
                'updated_at' => '2026-03-30 23:35:46'
            ],
            [
                'id_user_permission' => 2971,
                'id_user' => 69,
                'id_permission' => 136,
                'created_at' => '2026-03-30 23:35:55',
                'updated_at' => '2026-03-30 23:35:55'
            ],
            [
                'id_user_permission' => 2972,
                'id_user' => 69,
                'id_permission' => 137,
                'created_at' => '2026-03-30 23:35:56',
                'updated_at' => '2026-03-30 23:35:56'
            ],
            [
                'id_user_permission' => 2973,
                'id_user' => 69,
                'id_permission' => 138,
                'created_at' => '2026-03-30 23:35:56',
                'updated_at' => '2026-03-30 23:35:56'
            ],
            [
                'id_user_permission' => 2974,
                'id_user' => 69,
                'id_permission' => 141,
                'created_at' => '2026-03-30 23:36:04',
                'updated_at' => '2026-03-30 23:36:04'
            ],
            [
                'id_user_permission' => 2975,
                'id_user' => 69,
                'id_permission' => 142,
                'created_at' => '2026-03-30 23:36:21',
                'updated_at' => '2026-03-30 23:36:21'
            ],
            [
                'id_user_permission' => 2976,
                'id_user' => 69,
                'id_permission' => 143,
                'created_at' => '2026-03-30 23:36:21',
                'updated_at' => '2026-03-30 23:36:21'
            ],
            [
                'id_user_permission' => 2977,
                'id_user' => 69,
                'id_permission' => 144,
                'created_at' => '2026-03-30 23:36:25',
                'updated_at' => '2026-03-30 23:36:25'
            ],
            [
                'id_user_permission' => 2978,
                'id_user' => 69,
                'id_permission' => 145,
                'created_at' => '2026-03-30 23:36:26',
                'updated_at' => '2026-03-30 23:36:26'
            ],
            [
                'id_user_permission' => 2979,
                'id_user' => 69,
                'id_permission' => 146,
                'created_at' => '2026-03-30 23:36:29',
                'updated_at' => '2026-03-30 23:36:29'
            ],
            [
                'id_user_permission' => 2980,
                'id_user' => 69,
                'id_permission' => 147,
                'created_at' => '2026-03-30 23:36:30',
                'updated_at' => '2026-03-30 23:36:30'
            ],
            [
                'id_user_permission' => 2981,
                'id_user' => 69,
                'id_permission' => 148,
                'created_at' => '2026-03-30 23:36:32',
                'updated_at' => '2026-03-30 23:36:32'
            ],
            [
                'id_user_permission' => 2982,
                'id_user' => 69,
                'id_permission' => 150,
                'created_at' => '2026-03-30 23:36:32',
                'updated_at' => '2026-03-30 23:36:32'
            ],
            [
                'id_user_permission' => 2983,
                'id_user' => 69,
                'id_permission' => 151,
                'created_at' => '2026-03-30 23:36:34',
                'updated_at' => '2026-03-30 23:36:34'
            ],
            [
                'id_user_permission' => 2984,
                'id_user' => 69,
                'id_permission' => 149,
                'created_at' => '2026-03-30 23:36:37',
                'updated_at' => '2026-03-30 23:36:37'
            ],
            [
                'id_user_permission' => 2985,
                'id_user' => 69,
                'id_permission' => 157,
                'created_at' => '2026-03-30 23:36:57',
                'updated_at' => '2026-03-30 23:36:57'
            ],
            [
                'id_user_permission' => 2986,
                'id_user' => 69,
                'id_permission' => 158,
                'created_at' => '2026-03-30 23:36:58',
                'updated_at' => '2026-03-30 23:36:58'
            ],
            [
                'id_user_permission' => 2987,
                'id_user' => 69,
                'id_permission' => 180,
                'created_at' => '2026-03-30 23:37:21',
                'updated_at' => '2026-03-30 23:37:21'
            ],
            [
                'id_user_permission' => 2988,
                'id_user' => 69,
                'id_permission' => 187,
                'created_at' => '2026-03-30 23:38:10',
                'updated_at' => '2026-03-30 23:38:10'
            ],
            [
                'id_user_permission' => 2989,
                'id_user' => 69,
                'id_permission' => 188,
                'created_at' => '2026-03-30 23:38:11',
                'updated_at' => '2026-03-30 23:38:11'
            ],
            [
                'id_user_permission' => 2990,
                'id_user' => 69,
                'id_permission' => 189,
                'created_at' => '2026-03-30 23:38:13',
                'updated_at' => '2026-03-30 23:38:13'
            ],
            [
                'id_user_permission' => 2991,
                'id_user' => 69,
                'id_permission' => 190,
                'created_at' => '2026-03-30 23:38:15',
                'updated_at' => '2026-03-30 23:38:15'
            ],
            [
                'id_user_permission' => 2992,
                'id_user' => 69,
                'id_permission' => 191,
                'created_at' => '2026-03-30 23:38:15',
                'updated_at' => '2026-03-30 23:38:15'
            ],
            [
                'id_user_permission' => 2993,
                'id_user' => 69,
                'id_permission' => 192,
                'created_at' => '2026-03-30 23:38:22',
                'updated_at' => '2026-03-30 23:38:22'
            ],
            [
                'id_user_permission' => 2994,
                'id_user' => 69,
                'id_permission' => 193,
                'created_at' => '2026-03-30 23:38:22',
                'updated_at' => '2026-03-30 23:38:22'
            ],
            [
                'id_user_permission' => 2995,
                'id_user' => 69,
                'id_permission' => 194,
                'created_at' => '2026-03-30 23:38:22',
                'updated_at' => '2026-03-30 23:38:22'
            ],
            [
                'id_user_permission' => 2996,
                'id_user' => 69,
                'id_permission' => 195,
                'created_at' => '2026-03-30 23:38:22',
                'updated_at' => '2026-03-30 23:38:22'
            ],
            [
                'id_user_permission' => 2997,
                'id_user' => 69,
                'id_permission' => 196,
                'created_at' => '2026-03-30 23:38:25',
                'updated_at' => '2026-03-30 23:38:25'
            ],
            [
                'id_user_permission' => 2998,
                'id_user' => 69,
                'id_permission' => 197,
                'created_at' => '2026-03-30 23:38:25',
                'updated_at' => '2026-03-30 23:38:25'
            ],
            [
                'id_user_permission' => 2999,
                'id_user' => 69,
                'id_permission' => 198,
                'created_at' => '2026-03-30 23:38:25',
                'updated_at' => '2026-03-30 23:38:25'
            ],
            [
                'id_user_permission' => 3000,
                'id_user' => 69,
                'id_permission' => 199,
                'created_at' => '2026-03-30 23:38:28',
                'updated_at' => '2026-03-30 23:38:28'
            ],
            [
                'id_user_permission' => 3001,
                'id_user' => 69,
                'id_permission' => 200,
                'created_at' => '2026-03-30 23:38:29',
                'updated_at' => '2026-03-30 23:38:29'
            ],
            [
                'id_user_permission' => 3002,
                'id_user' => 69,
                'id_permission' => 246,
                'created_at' => '2026-03-30 23:38:44',
                'updated_at' => '2026-03-30 23:38:44'
            ],
            [
                'id_user_permission' => 3003,
                'id_user' => 69,
                'id_permission' => 223,
                'created_at' => '2026-03-30 23:39:06',
                'updated_at' => '2026-03-30 23:39:06'
            ],
            [
                'id_user_permission' => 3004,
                'id_user' => 69,
                'id_permission' => 249,
                'created_at' => '2026-03-30 23:39:14',
                'updated_at' => '2026-03-30 23:39:14'
            ],
            [
                'id_user_permission' => 3005,
                'id_user' => 52,
                'id_permission' => 177,
                'created_at' => '2026-03-31 00:28:02',
                'updated_at' => '2026-03-31 00:28:02'
            ],
            [
                'id_user_permission' => 3006,
                'id_user' => 52,
                'id_permission' => 178,
                'created_at' => '2026-03-31 00:28:08',
                'updated_at' => '2026-03-31 00:28:08'
            ],
            [
                'id_user_permission' => 3007,
                'id_user' => 52,
                'id_permission' => 179,
                'created_at' => '2026-03-31 00:28:10',
                'updated_at' => '2026-03-31 00:28:10'
            ],
            [
                'id_user_permission' => 3008,
                'id_user' => 52,
                'id_permission' => 242,
                'created_at' => '2026-03-31 00:28:17',
                'updated_at' => '2026-03-31 00:28:17'
            ],
            [
                'id_user_permission' => 3015,
                'id_user' => 24,
                'id_permission' => 199,
                'created_at' => '2026-03-31 18:14:35',
                'updated_at' => '2026-03-31 18:14:35'
            ],
            [
                'id_user_permission' => 3016,
                'id_user' => 24,
                'id_permission' => 200,
                'created_at' => '2026-03-31 18:14:36',
                'updated_at' => '2026-03-31 18:14:36'
            ],
            [
                'id_user_permission' => 3017,
                'id_user' => 22,
                'id_permission' => 199,
                'created_at' => '2026-03-31 18:15:44',
                'updated_at' => '2026-03-31 18:15:44'
            ],
            [
                'id_user_permission' => 3018,
                'id_user' => 22,
                'id_permission' => 200,
                'created_at' => '2026-03-31 18:15:45',
                'updated_at' => '2026-03-31 18:15:45'
            ],
            [
                'id_user_permission' => 3019,
                'id_user' => 24,
                'id_permission' => 194,
                'created_at' => '2026-03-31 18:16:16',
                'updated_at' => '2026-03-31 18:16:16'
            ],
            [
                'id_user_permission' => 3020,
                'id_user' => 24,
                'id_permission' => 195,
                'created_at' => '2026-03-31 18:16:17',
                'updated_at' => '2026-03-31 18:16:17'
            ],
            [
                'id_user_permission' => 3021,
                'id_user' => 24,
                'id_permission' => 196,
                'created_at' => '2026-03-31 18:16:19',
                'updated_at' => '2026-03-31 18:16:19'
            ],
            [
                'id_user_permission' => 3022,
                'id_user' => 29,
                'id_permission' => 13,
                'created_at' => '2026-03-31 18:35:14',
                'updated_at' => '2026-03-31 18:35:14'
            ],
            [
                'id_user_permission' => 3023,
                'id_user' => 29,
                'id_permission' => 14,
                'created_at' => '2026-03-31 18:35:15',
                'updated_at' => '2026-03-31 18:35:15'
            ],
            [
                'id_user_permission' => 3024,
                'id_user' => 29,
                'id_permission' => 15,
                'created_at' => '2026-03-31 18:35:15',
                'updated_at' => '2026-03-31 18:35:15'
            ],
            [
                'id_user_permission' => 3025,
                'id_user' => 29,
                'id_permission' => 16,
                'created_at' => '2026-03-31 18:35:15',
                'updated_at' => '2026-03-31 18:35:15'
            ],
            [
                'id_user_permission' => 3026,
                'id_user' => 29,
                'id_permission' => 19,
                'created_at' => '2026-03-31 18:35:26',
                'updated_at' => '2026-03-31 18:35:26'
            ],
            [
                'id_user_permission' => 3027,
                'id_user' => 29,
                'id_permission' => 20,
                'created_at' => '2026-03-31 18:35:27',
                'updated_at' => '2026-03-31 18:35:27'
            ],
            [
                'id_user_permission' => 3028,
                'id_user' => 29,
                'id_permission' => 21,
                'created_at' => '2026-03-31 18:35:27',
                'updated_at' => '2026-03-31 18:35:27'
            ],
            [
                'id_user_permission' => 3029,
                'id_user' => 29,
                'id_permission' => 22,
                'created_at' => '2026-03-31 18:35:28',
                'updated_at' => '2026-03-31 18:35:28'
            ],
            [
                'id_user_permission' => 3030,
                'id_user' => 29,
                'id_permission' => 23,
                'created_at' => '2026-03-31 18:35:34',
                'updated_at' => '2026-03-31 18:35:34'
            ],
            [
                'id_user_permission' => 3031,
                'id_user' => 29,
                'id_permission' => 24,
                'created_at' => '2026-03-31 18:35:34',
                'updated_at' => '2026-03-31 18:35:34'
            ],
            [
                'id_user_permission' => 3032,
                'id_user' => 29,
                'id_permission' => 25,
                'created_at' => '2026-03-31 18:35:34',
                'updated_at' => '2026-03-31 18:35:34'
            ],
            [
                'id_user_permission' => 3033,
                'id_user' => 29,
                'id_permission' => 26,
                'created_at' => '2026-03-31 18:35:34',
                'updated_at' => '2026-03-31 18:35:34'
            ],
            [
                'id_user_permission' => 3034,
                'id_user' => 29,
                'id_permission' => 39,
                'created_at' => '2026-03-31 18:35:44',
                'updated_at' => '2026-03-31 18:35:44'
            ],
            [
                'id_user_permission' => 3035,
                'id_user' => 29,
                'id_permission' => 59,
                'created_at' => '2026-03-31 18:35:57',
                'updated_at' => '2026-03-31 18:35:57'
            ],
            [
                'id_user_permission' => 3036,
                'id_user' => 29,
                'id_permission' => 63,
                'created_at' => '2026-03-31 18:36:03',
                'updated_at' => '2026-03-31 18:36:03'
            ],
            [
                'id_user_permission' => 3037,
                'id_user' => 29,
                'id_permission' => 75,
                'created_at' => '2026-03-31 18:36:13',
                'updated_at' => '2026-03-31 18:36:13'
            ],
            [
                'id_user_permission' => 3038,
                'id_user' => 29,
                'id_permission' => 78,
                'created_at' => '2026-03-31 18:36:28',
                'updated_at' => '2026-03-31 18:36:28'
            ],
            [
                'id_user_permission' => 3039,
                'id_user' => 29,
                'id_permission' => 77,
                'created_at' => '2026-03-31 18:36:32',
                'updated_at' => '2026-03-31 18:36:32'
            ],
            [
                'id_user_permission' => 3040,
                'id_user' => 29,
                'id_permission' => 74,
                'created_at' => '2026-03-31 18:36:37',
                'updated_at' => '2026-03-31 18:36:37'
            ],
            [
                'id_user_permission' => 3041,
                'id_user' => 29,
                'id_permission' => 79,
                'created_at' => '2026-03-31 18:36:43',
                'updated_at' => '2026-03-31 18:36:43'
            ],
            [
                'id_user_permission' => 3042,
                'id_user' => 29,
                'id_permission' => 80,
                'created_at' => '2026-03-31 18:36:44',
                'updated_at' => '2026-03-31 18:36:44'
            ],
            [
                'id_user_permission' => 3043,
                'id_user' => 29,
                'id_permission' => 81,
                'created_at' => '2026-03-31 18:36:44',
                'updated_at' => '2026-03-31 18:36:44'
            ],
            [
                'id_user_permission' => 3044,
                'id_user' => 29,
                'id_permission' => 82,
                'created_at' => '2026-03-31 18:36:46',
                'updated_at' => '2026-03-31 18:36:46'
            ],
            [
                'id_user_permission' => 3045,
                'id_user' => 29,
                'id_permission' => 83,
                'created_at' => '2026-03-31 18:36:50',
                'updated_at' => '2026-03-31 18:36:50'
            ],
            [
                'id_user_permission' => 3046,
                'id_user' => 29,
                'id_permission' => 84,
                'created_at' => '2026-03-31 18:36:51',
                'updated_at' => '2026-03-31 18:36:51'
            ],
            [
                'id_user_permission' => 3047,
                'id_user' => 29,
                'id_permission' => 85,
                'created_at' => '2026-03-31 18:36:51',
                'updated_at' => '2026-03-31 18:36:51'
            ],
            [
                'id_user_permission' => 3048,
                'id_user' => 29,
                'id_permission' => 86,
                'created_at' => '2026-03-31 18:36:54',
                'updated_at' => '2026-03-31 18:36:54'
            ],
            [
                'id_user_permission' => 3049,
                'id_user' => 29,
                'id_permission' => 87,
                'created_at' => '2026-03-31 18:36:55',
                'updated_at' => '2026-03-31 18:36:55'
            ],
            [
                'id_user_permission' => 3050,
                'id_user' => 29,
                'id_permission' => 88,
                'created_at' => '2026-03-31 18:36:57',
                'updated_at' => '2026-03-31 18:36:57'
            ],
            [
                'id_user_permission' => 3051,
                'id_user' => 29,
                'id_permission' => 89,
                'created_at' => '2026-03-31 18:37:00',
                'updated_at' => '2026-03-31 18:37:00'
            ],
            [
                'id_user_permission' => 3052,
                'id_user' => 29,
                'id_permission' => 90,
                'created_at' => '2026-03-31 18:37:01',
                'updated_at' => '2026-03-31 18:37:01'
            ],
            [
                'id_user_permission' => 3053,
                'id_user' => 29,
                'id_permission' => 91,
                'created_at' => '2026-03-31 18:37:01',
                'updated_at' => '2026-03-31 18:37:01'
            ],
            [
                'id_user_permission' => 3054,
                'id_user' => 29,
                'id_permission' => 92,
                'created_at' => '2026-03-31 18:37:03',
                'updated_at' => '2026-03-31 18:37:03'
            ],
            [
                'id_user_permission' => 3055,
                'id_user' => 29,
                'id_permission' => 93,
                'created_at' => '2026-03-31 18:37:04',
                'updated_at' => '2026-03-31 18:37:04'
            ],
            [
                'id_user_permission' => 3056,
                'id_user' => 29,
                'id_permission' => 94,
                'created_at' => '2026-03-31 18:37:08',
                'updated_at' => '2026-03-31 18:37:08'
            ],
            [
                'id_user_permission' => 3057,
                'id_user' => 29,
                'id_permission' => 105,
                'created_at' => '2026-03-31 18:37:24',
                'updated_at' => '2026-03-31 18:37:24'
            ],
            [
                'id_user_permission' => 3058,
                'id_user' => 29,
                'id_permission' => 109,
                'created_at' => '2026-03-31 18:37:46',
                'updated_at' => '2026-03-31 18:37:46'
            ],
            [
                'id_user_permission' => 3059,
                'id_user' => 29,
                'id_permission' => 110,
                'created_at' => '2026-03-31 18:37:46',
                'updated_at' => '2026-03-31 18:37:46'
            ],
            [
                'id_user_permission' => 3060,
                'id_user' => 29,
                'id_permission' => 111,
                'created_at' => '2026-03-31 18:37:48',
                'updated_at' => '2026-03-31 18:37:48'
            ],
            [
                'id_user_permission' => 3061,
                'id_user' => 29,
                'id_permission' => 112,
                'created_at' => '2026-03-31 18:37:49',
                'updated_at' => '2026-03-31 18:37:49'
            ],
            [
                'id_user_permission' => 3062,
                'id_user' => 29,
                'id_permission' => 128,
                'created_at' => '2026-03-31 18:38:04',
                'updated_at' => '2026-03-31 18:38:04'
            ],
            [
                'id_user_permission' => 3063,
                'id_user' => 29,
                'id_permission' => 129,
                'created_at' => '2026-03-31 18:38:04',
                'updated_at' => '2026-03-31 18:38:04'
            ],
            [
                'id_user_permission' => 3064,
                'id_user' => 29,
                'id_permission' => 130,
                'created_at' => '2026-03-31 18:38:08',
                'updated_at' => '2026-03-31 18:38:08'
            ],
            [
                'id_user_permission' => 3065,
                'id_user' => 29,
                'id_permission' => 131,
                'created_at' => '2026-03-31 18:38:09',
                'updated_at' => '2026-03-31 18:38:09'
            ],
            [
                'id_user_permission' => 3066,
                'id_user' => 29,
                'id_permission' => 132,
                'created_at' => '2026-03-31 18:38:10',
                'updated_at' => '2026-03-31 18:38:10'
            ],
            [
                'id_user_permission' => 3067,
                'id_user' => 29,
                'id_permission' => 135,
                'created_at' => '2026-03-31 18:38:14',
                'updated_at' => '2026-03-31 18:38:14'
            ],
            [
                'id_user_permission' => 3068,
                'id_user' => 29,
                'id_permission' => 134,
                'created_at' => '2026-03-31 18:38:17',
                'updated_at' => '2026-03-31 18:38:17'
            ],
            [
                'id_user_permission' => 3069,
                'id_user' => 29,
                'id_permission' => 133,
                'created_at' => '2026-03-31 18:38:18',
                'updated_at' => '2026-03-31 18:38:18'
            ],
            [
                'id_user_permission' => 3070,
                'id_user' => 29,
                'id_permission' => 136,
                'created_at' => '2026-03-31 18:38:23',
                'updated_at' => '2026-03-31 18:38:23'
            ],
            [
                'id_user_permission' => 3071,
                'id_user' => 29,
                'id_permission' => 137,
                'created_at' => '2026-03-31 18:38:23',
                'updated_at' => '2026-03-31 18:38:23'
            ],
            [
                'id_user_permission' => 3072,
                'id_user' => 29,
                'id_permission' => 138,
                'created_at' => '2026-03-31 18:38:25',
                'updated_at' => '2026-03-31 18:38:25'
            ],
            [
                'id_user_permission' => 3073,
                'id_user' => 29,
                'id_permission' => 139,
                'created_at' => '2026-03-31 18:38:26',
                'updated_at' => '2026-03-31 18:38:26'
            ],
            [
                'id_user_permission' => 3074,
                'id_user' => 29,
                'id_permission' => 140,
                'created_at' => '2026-03-31 18:38:29',
                'updated_at' => '2026-03-31 18:38:29'
            ],
            [
                'id_user_permission' => 3075,
                'id_user' => 29,
                'id_permission' => 141,
                'created_at' => '2026-03-31 18:38:31',
                'updated_at' => '2026-03-31 18:38:31'
            ],
            [
                'id_user_permission' => 3076,
                'id_user' => 29,
                'id_permission' => 142,
                'created_at' => '2026-03-31 18:38:34',
                'updated_at' => '2026-03-31 18:38:34'
            ],
            [
                'id_user_permission' => 3077,
                'id_user' => 29,
                'id_permission' => 143,
                'created_at' => '2026-03-31 18:38:35',
                'updated_at' => '2026-03-31 18:38:35'
            ],
            [
                'id_user_permission' => 3078,
                'id_user' => 29,
                'id_permission' => 144,
                'created_at' => '2026-03-31 18:38:35',
                'updated_at' => '2026-03-31 18:38:35'
            ],
            [
                'id_user_permission' => 3079,
                'id_user' => 29,
                'id_permission' => 145,
                'created_at' => '2026-03-31 18:38:37',
                'updated_at' => '2026-03-31 18:38:37'
            ],
            [
                'id_user_permission' => 3080,
                'id_user' => 29,
                'id_permission' => 146,
                'created_at' => '2026-03-31 18:38:41',
                'updated_at' => '2026-03-31 18:38:41'
            ],
            [
                'id_user_permission' => 3081,
                'id_user' => 29,
                'id_permission' => 157,
                'created_at' => '2026-03-31 18:39:05',
                'updated_at' => '2026-03-31 18:39:05'
            ],
            [
                'id_user_permission' => 3082,
                'id_user' => 29,
                'id_permission' => 158,
                'created_at' => '2026-03-31 18:39:06',
                'updated_at' => '2026-03-31 18:39:06'
            ],
            [
                'id_user_permission' => 3083,
                'id_user' => 29,
                'id_permission' => 180,
                'created_at' => '2026-03-31 18:39:28',
                'updated_at' => '2026-03-31 18:39:28'
            ],
            [
                'id_user_permission' => 3084,
                'id_user' => 29,
                'id_permission' => 186,
                'created_at' => '2026-03-31 18:39:36',
                'updated_at' => '2026-03-31 18:39:36'
            ],
            [
                'id_user_permission' => 3085,
                'id_user' => 29,
                'id_permission' => 187,
                'created_at' => '2026-03-31 18:39:41',
                'updated_at' => '2026-03-31 18:39:41'
            ],
            [
                'id_user_permission' => 3086,
                'id_user' => 29,
                'id_permission' => 191,
                'created_at' => '2026-03-31 18:39:52',
                'updated_at' => '2026-03-31 18:39:52'
            ],
            [
                'id_user_permission' => 3087,
                'id_user' => 29,
                'id_permission' => 192,
                'created_at' => '2026-03-31 18:39:53',
                'updated_at' => '2026-03-31 18:39:53'
            ],
            [
                'id_user_permission' => 3088,
                'id_user' => 29,
                'id_permission' => 193,
                'created_at' => '2026-03-31 18:39:54',
                'updated_at' => '2026-03-31 18:39:54'
            ],
            [
                'id_user_permission' => 3090,
                'id_user' => 29,
                'id_permission' => 197,
                'created_at' => '2026-03-31 18:40:06',
                'updated_at' => '2026-03-31 18:40:06'
            ],
            [
                'id_user_permission' => 3091,
                'id_user' => 29,
                'id_permission' => 198,
                'created_at' => '2026-03-31 18:40:06',
                'updated_at' => '2026-03-31 18:40:06'
            ],
            [
                'id_user_permission' => 3097,
                'id_user' => 57,
                'id_permission' => 20,
                'created_at' => '2026-03-31 18:42:46',
                'updated_at' => '2026-03-31 18:42:46'
            ],
            [
                'id_user_permission' => 3098,
                'id_user' => 57,
                'id_permission' => 21,
                'created_at' => '2026-03-31 18:42:47',
                'updated_at' => '2026-03-31 18:42:47'
            ],
            [
                'id_user_permission' => 3099,
                'id_user' => 57,
                'id_permission' => 22,
                'created_at' => '2026-03-31 18:42:47',
                'updated_at' => '2026-03-31 18:42:47'
            ],
            [
                'id_user_permission' => 3100,
                'id_user' => 57,
                'id_permission' => 24,
                'created_at' => '2026-03-31 18:42:50',
                'updated_at' => '2026-03-31 18:42:50'
            ],
            [
                'id_user_permission' => 3101,
                'id_user' => 57,
                'id_permission' => 25,
                'created_at' => '2026-03-31 18:42:51',
                'updated_at' => '2026-03-31 18:42:51'
            ],
            [
                'id_user_permission' => 3102,
                'id_user' => 57,
                'id_permission' => 26,
                'created_at' => '2026-03-31 18:42:51',
                'updated_at' => '2026-03-31 18:42:51'
            ],
            [
                'id_user_permission' => 3103,
                'id_user' => 57,
                'id_permission' => 60,
                'created_at' => '2026-03-31 18:43:12',
                'updated_at' => '2026-03-31 18:43:12'
            ],
            [
                'id_user_permission' => 3104,
                'id_user' => 57,
                'id_permission' => 61,
                'created_at' => '2026-03-31 18:43:13',
                'updated_at' => '2026-03-31 18:43:13'
            ],
            [
                'id_user_permission' => 3105,
                'id_user' => 57,
                'id_permission' => 62,
                'created_at' => '2026-03-31 18:43:13',
                'updated_at' => '2026-03-31 18:43:13'
            ],
            [
                'id_user_permission' => 3107,
                'id_user' => 57,
                'id_permission' => 187,
                'created_at' => '2026-03-31 18:44:23',
                'updated_at' => '2026-03-31 18:44:23'
            ],
            [
                'id_user_permission' => 3108,
                'id_user' => 57,
                'id_permission' => 211,
                'created_at' => '2026-03-31 18:45:42',
                'updated_at' => '2026-03-31 18:45:42'
            ],
            [
                'id_user_permission' => 3109,
                'id_user' => 57,
                'id_permission' => 212,
                'created_at' => '2026-03-31 18:45:44',
                'updated_at' => '2026-03-31 18:45:44'
            ],
            [
                'id_user_permission' => 3110,
                'id_user' => 57,
                'id_permission' => 215,
                'created_at' => '2026-03-31 18:45:44',
                'updated_at' => '2026-03-31 18:45:44'
            ],
            [
                'id_user_permission' => 3111,
                'id_user' => 57,
                'id_permission' => 216,
                'created_at' => '2026-03-31 18:45:44',
                'updated_at' => '2026-03-31 18:45:44'
            ],
            [
                'id_user_permission' => 3112,
                'id_user' => 29,
                'id_permission' => 159,
                'created_at' => '2026-03-31 18:50:18',
                'updated_at' => '2026-03-31 18:50:18'
            ],
            [
                'id_user_permission' => 3113,
                'id_user' => 29,
                'id_permission' => 160,
                'created_at' => '2026-03-31 18:50:18',
                'updated_at' => '2026-03-31 18:50:18'
            ],
            [
                'id_user_permission' => 3114,
                'id_user' => 29,
                'id_permission' => 113,
                'created_at' => '2026-03-31 18:50:34',
                'updated_at' => '2026-03-31 18:50:34'
            ],
            [
                'id_user_permission' => 3115,
                'id_user' => 29,
                'id_permission' => 114,
                'created_at' => '2026-03-31 18:50:35',
                'updated_at' => '2026-03-31 18:50:35'
            ],
            [
                'id_user_permission' => 3116,
                'id_user' => 29,
                'id_permission' => 101,
                'created_at' => '2026-03-31 18:50:41',
                'updated_at' => '2026-03-31 18:50:41'
            ],
            [
                'id_user_permission' => 3117,
                'id_user' => 29,
                'id_permission' => 100,
                'created_at' => '2026-03-31 18:50:42',
                'updated_at' => '2026-03-31 18:50:42'
            ],
            [
                'id_user_permission' => 3118,
                'id_user' => 29,
                'id_permission' => 152,
                'created_at' => '2026-03-31 18:57:07',
                'updated_at' => '2026-03-31 18:57:07'
            ],
            [
                'id_user_permission' => 3119,
                'id_user' => 29,
                'id_permission' => 153,
                'created_at' => '2026-03-31 18:57:08',
                'updated_at' => '2026-03-31 18:57:08'
            ],
            [
                'id_user_permission' => 3120,
                'id_user' => 60,
                'id_permission' => 20,
                'created_at' => '2026-03-31 19:41:07',
                'updated_at' => '2026-03-31 19:41:07'
            ],
            [
                'id_user_permission' => 3121,
                'id_user' => 60,
                'id_permission' => 21,
                'created_at' => '2026-03-31 19:41:08',
                'updated_at' => '2026-03-31 19:41:08'
            ],
            [
                'id_user_permission' => 3122,
                'id_user' => 60,
                'id_permission' => 22,
                'created_at' => '2026-03-31 19:41:08',
                'updated_at' => '2026-03-31 19:41:08'
            ],
            [
                'id_user_permission' => 3123,
                'id_user' => 60,
                'id_permission' => 24,
                'created_at' => '2026-03-31 19:41:11',
                'updated_at' => '2026-03-31 19:41:11'
            ],
            [
                'id_user_permission' => 3124,
                'id_user' => 60,
                'id_permission' => 25,
                'created_at' => '2026-03-31 19:41:12',
                'updated_at' => '2026-03-31 19:41:12'
            ],
            [
                'id_user_permission' => 3125,
                'id_user' => 60,
                'id_permission' => 26,
                'created_at' => '2026-03-31 19:41:12',
                'updated_at' => '2026-03-31 19:41:12'
            ],
            [
                'id_user_permission' => 3126,
                'id_user' => 60,
                'id_permission' => 245,
                'created_at' => '2026-03-31 19:42:36',
                'updated_at' => '2026-03-31 19:42:36'
            ],
            [
                'id_user_permission' => 3129,
                'id_user' => 60,
                'id_permission' => 193,
                'created_at' => '2026-03-31 19:43:05',
                'updated_at' => '2026-03-31 19:43:05'
            ],
            [
                'id_user_permission' => 3130,
                'id_user' => 60,
                'id_permission' => 197,
                'created_at' => '2026-03-31 19:43:14',
                'updated_at' => '2026-03-31 19:43:14'
            ],
            [
                'id_user_permission' => 3131,
                'id_user' => 60,
                'id_permission' => 191,
                'created_at' => '2026-03-31 19:43:21',
                'updated_at' => '2026-03-31 19:43:21'
            ],
            [
                'id_user_permission' => 3132,
                'id_user' => 60,
                'id_permission' => 190,
                'created_at' => '2026-03-31 19:43:22',
                'updated_at' => '2026-03-31 19:43:22'
            ],
            [
                'id_user_permission' => 3133,
                'id_user' => 60,
                'id_permission' => 211,
                'created_at' => '2026-03-31 19:43:33',
                'updated_at' => '2026-03-31 19:43:33'
            ],
            [
                'id_user_permission' => 3134,
                'id_user' => 60,
                'id_permission' => 212,
                'created_at' => '2026-03-31 19:43:33',
                'updated_at' => '2026-03-31 19:43:33'
            ],
            [
                'id_user_permission' => 3135,
                'id_user' => 60,
                'id_permission' => 215,
                'created_at' => '2026-03-31 19:43:37',
                'updated_at' => '2026-03-31 19:43:37'
            ],
            [
                'id_user_permission' => 3136,
                'id_user' => 60,
                'id_permission' => 216,
                'created_at' => '2026-03-31 19:43:38',
                'updated_at' => '2026-03-31 19:43:38'
            ],
            [
                'id_user_permission' => 3137,
                'id_user' => 59,
                'id_permission' => 1,
                'created_at' => '2026-03-31 19:44:02',
                'updated_at' => '2026-03-31 19:44:02'
            ],
            [
                'id_user_permission' => 3138,
                'id_user' => 59,
                'id_permission' => 75,
                'created_at' => '2026-03-31 19:44:55',
                'updated_at' => '2026-03-31 19:44:55'
            ],
            [
                'id_user_permission' => 3141,
                'id_user' => 59,
                'id_permission' => 187,
                'created_at' => '2026-03-31 19:52:21',
                'updated_at' => '2026-03-31 19:52:21'
            ],
            [
                'id_user_permission' => 3142,
                'id_user' => 59,
                'id_permission' => 197,
                'created_at' => '2026-03-31 19:52:31',
                'updated_at' => '2026-03-31 19:52:31'
            ],
            [
                'id_user_permission' => 3143,
                'id_user' => 59,
                'id_permission' => 198,
                'created_at' => '2026-03-31 19:52:34',
                'updated_at' => '2026-03-31 19:52:34'
            ],
            [
                'id_user_permission' => 3144,
                'id_user' => 59,
                'id_permission' => 213,
                'created_at' => '2026-03-31 19:52:47',
                'updated_at' => '2026-03-31 19:52:47'
            ],
            [
                'id_user_permission' => 3145,
                'id_user' => 59,
                'id_permission' => 214,
                'created_at' => '2026-03-31 19:52:49',
                'updated_at' => '2026-03-31 19:52:49'
            ],
            [
                'id_user_permission' => 3146,
                'id_user' => 52,
                'id_permission' => 97,
                'created_at' => '2026-03-31 19:54:01',
                'updated_at' => '2026-03-31 19:54:01'
            ],
            [
                'id_user_permission' => 3147,
                'id_user' => 52,
                'id_permission' => 108,
                'created_at' => '2026-03-31 19:54:07',
                'updated_at' => '2026-03-31 19:54:07'
            ],
            [
                'id_user_permission' => 3148,
                'id_user' => 52,
                'id_permission' => 138,
                'created_at' => '2026-03-31 19:54:13',
                'updated_at' => '2026-03-31 19:54:13'
            ],
            [
                'id_user_permission' => 3149,
                'id_user' => 51,
                'id_permission' => 24,
                'created_at' => '2026-03-31 22:39:08',
                'updated_at' => '2026-03-31 22:39:08'
            ],
            [
                'id_user_permission' => 3150,
                'id_user' => 51,
                'id_permission' => 25,
                'created_at' => '2026-03-31 22:39:12',
                'updated_at' => '2026-03-31 22:39:12'
            ],
            [
                'id_user_permission' => 3151,
                'id_user' => 51,
                'id_permission' => 26,
                'created_at' => '2026-03-31 22:39:12',
                'updated_at' => '2026-03-31 22:39:12'
            ],
            [
                'id_user_permission' => 3152,
                'id_user' => 51,
                'id_permission' => 20,
                'created_at' => '2026-03-31 22:39:17',
                'updated_at' => '2026-03-31 22:39:17'
            ],
            [
                'id_user_permission' => 3153,
                'id_user' => 51,
                'id_permission' => 22,
                'created_at' => '2026-03-31 22:39:17',
                'updated_at' => '2026-03-31 22:39:17'
            ],
            [
                'id_user_permission' => 3154,
                'id_user' => 51,
                'id_permission' => 21,
                'created_at' => '2026-03-31 22:39:17',
                'updated_at' => '2026-03-31 22:39:17'
            ],
            [
                'id_user_permission' => 3155,
                'id_user' => 51,
                'id_permission' => 59,
                'created_at' => '2026-03-31 22:39:31',
                'updated_at' => '2026-03-31 22:39:31'
            ],
            [
                'id_user_permission' => 3156,
                'id_user' => 51,
                'id_permission' => 173,
                'created_at' => '2026-03-31 22:41:28',
                'updated_at' => '2026-03-31 22:41:28'
            ],
            [
                'id_user_permission' => 3157,
                'id_user' => 51,
                'id_permission' => 243,
                'created_at' => '2026-03-31 22:41:34',
                'updated_at' => '2026-03-31 22:41:34'
            ],
            [
                'id_user_permission' => 3158,
                'id_user' => 51,
                'id_permission' => 187,
                'created_at' => '2026-03-31 22:41:50',
                'updated_at' => '2026-03-31 22:41:50'
            ],
            [
                'id_user_permission' => 3159,
                'id_user' => 51,
                'id_permission' => 188,
                'created_at' => '2026-03-31 22:41:54',
                'updated_at' => '2026-03-31 22:41:54'
            ],
            [
                'id_user_permission' => 3160,
                'id_user' => 51,
                'id_permission' => 189,
                'created_at' => '2026-03-31 22:41:55',
                'updated_at' => '2026-03-31 22:41:55'
            ],
            [
                'id_user_permission' => 3161,
                'id_user' => 51,
                'id_permission' => 190,
                'created_at' => '2026-03-31 22:41:55',
                'updated_at' => '2026-03-31 22:41:55'
            ],
            [
                'id_user_permission' => 3162,
                'id_user' => 51,
                'id_permission' => 191,
                'created_at' => '2026-03-31 22:41:59',
                'updated_at' => '2026-03-31 22:41:59'
            ],
            [
                'id_user_permission' => 3163,
                'id_user' => 51,
                'id_permission' => 192,
                'created_at' => '2026-03-31 22:42:00',
                'updated_at' => '2026-03-31 22:42:00'
            ],
            [
                'id_user_permission' => 3164,
                'id_user' => 51,
                'id_permission' => 193,
                'created_at' => '2026-03-31 22:42:00',
                'updated_at' => '2026-03-31 22:42:00'
            ],
            [
                'id_user_permission' => 3165,
                'id_user' => 51,
                'id_permission' => 194,
                'created_at' => '2026-03-31 22:42:05',
                'updated_at' => '2026-03-31 22:42:05'
            ],
            [
                'id_user_permission' => 3166,
                'id_user' => 51,
                'id_permission' => 195,
                'created_at' => '2026-03-31 22:42:06',
                'updated_at' => '2026-03-31 22:42:06'
            ],
            [
                'id_user_permission' => 3167,
                'id_user' => 51,
                'id_permission' => 196,
                'created_at' => '2026-03-31 22:42:06',
                'updated_at' => '2026-03-31 22:42:06'
            ],
            [
                'id_user_permission' => 3168,
                'id_user' => 51,
                'id_permission' => 197,
                'created_at' => '2026-03-31 22:42:10',
                'updated_at' => '2026-03-31 22:42:10'
            ],
            [
                'id_user_permission' => 3169,
                'id_user' => 51,
                'id_permission' => 198,
                'created_at' => '2026-03-31 22:42:12',
                'updated_at' => '2026-03-31 22:42:12'
            ],
            [
                'id_user_permission' => 3170,
                'id_user' => 51,
                'id_permission' => 199,
                'created_at' => '2026-03-31 22:42:12',
                'updated_at' => '2026-03-31 22:42:12'
            ],
            [
                'id_user_permission' => 3171,
                'id_user' => 51,
                'id_permission' => 200,
                'created_at' => '2026-03-31 22:42:15',
                'updated_at' => '2026-03-31 22:42:15'
            ],
            [
                'id_user_permission' => 3172,
                'id_user' => 51,
                'id_permission' => 246,
                'created_at' => '2026-03-31 22:42:43',
                'updated_at' => '2026-03-31 22:42:43'
            ],
            [
                'id_user_permission' => 3173,
                'id_user' => 51,
                'id_permission' => 249,
                'created_at' => '2026-03-31 22:42:54',
                'updated_at' => '2026-03-31 22:42:54'
            ],
            [
                'id_user_permission' => 3174,
                'id_user' => 51,
                'id_permission' => 253,
                'created_at' => '2026-03-31 22:43:12',
                'updated_at' => '2026-03-31 22:43:12'
            ],
            [
                'id_user_permission' => 3175,
                'id_user' => 51,
                'id_permission' => 254,
                'created_at' => '2026-03-31 22:43:13',
                'updated_at' => '2026-03-31 22:43:13'
            ],
            [
                'id_user_permission' => 3176,
                'id_user' => 51,
                'id_permission' => 252,
                'created_at' => '2026-03-31 22:43:15',
                'updated_at' => '2026-03-31 22:43:15'
            ],
            [
                'id_user_permission' => 3177,
                'id_user' => 51,
                'id_permission' => 251,
                'created_at' => '2026-03-31 22:43:16',
                'updated_at' => '2026-03-31 22:43:16'
            ],
            [
                'id_user_permission' => 3178,
                'id_user' => 51,
                'id_permission' => 250,
                'created_at' => '2026-03-31 22:43:18',
                'updated_at' => '2026-03-31 22:43:18'
            ],
            [
                'id_user_permission' => 3179,
                'id_user' => 20,
                'id_permission' => 199,
                'created_at' => '2026-04-01 20:08:58',
                'updated_at' => '2026-04-01 20:08:58'
            ],
            [
                'id_user_permission' => 3180,
                'id_user' => 20,
                'id_permission' => 200,
                'created_at' => '2026-04-01 20:09:03',
                'updated_at' => '2026-04-01 20:09:03'
            ],
            [
                'id_user_permission' => 3182,
                'id_user' => 41,
                'id_permission' => 187,
                'created_at' => '2026-04-01 20:43:30',
                'updated_at' => '2026-04-01 20:43:30'
            ],
            [
                'id_user_permission' => 3183,
                'id_user' => 41,
                'id_permission' => 188,
                'created_at' => '2026-04-01 20:43:36',
                'updated_at' => '2026-04-01 20:43:36'
            ],
            [
                'id_user_permission' => 3184,
                'id_user' => 41,
                'id_permission' => 189,
                'created_at' => '2026-04-01 20:43:37',
                'updated_at' => '2026-04-01 20:43:37'
            ],
            [
                'id_user_permission' => 3185,
                'id_user' => 41,
                'id_permission' => 190,
                'created_at' => '2026-04-01 20:43:39',
                'updated_at' => '2026-04-01 20:43:39'
            ],
            [
                'id_user_permission' => 3186,
                'id_user' => 41,
                'id_permission' => 191,
                'created_at' => '2026-04-01 20:43:40',
                'updated_at' => '2026-04-01 20:43:40'
            ],
            [
                'id_user_permission' => 3187,
                'id_user' => 41,
                'id_permission' => 192,
                'created_at' => '2026-04-01 20:43:42',
                'updated_at' => '2026-04-01 20:43:42'
            ],
            [
                'id_user_permission' => 3188,
                'id_user' => 41,
                'id_permission' => 193,
                'created_at' => '2026-04-01 20:43:43',
                'updated_at' => '2026-04-01 20:43:43'
            ],
            [
                'id_user_permission' => 3189,
                'id_user' => 41,
                'id_permission' => 194,
                'created_at' => '2026-04-01 20:43:47',
                'updated_at' => '2026-04-01 20:43:47'
            ],
            [
                'id_user_permission' => 3190,
                'id_user' => 41,
                'id_permission' => 195,
                'created_at' => '2026-04-01 20:43:48',
                'updated_at' => '2026-04-01 20:43:48'
            ],
            [
                'id_user_permission' => 3191,
                'id_user' => 41,
                'id_permission' => 196,
                'created_at' => '2026-04-01 20:43:48',
                'updated_at' => '2026-04-01 20:43:48'
            ],
            [
                'id_user_permission' => 3192,
                'id_user' => 41,
                'id_permission' => 197,
                'created_at' => '2026-04-01 20:43:48',
                'updated_at' => '2026-04-01 20:43:48'
            ],
            [
                'id_user_permission' => 3193,
                'id_user' => 41,
                'id_permission' => 198,
                'created_at' => '2026-04-01 20:43:51',
                'updated_at' => '2026-04-01 20:43:51'
            ],
            [
                'id_user_permission' => 3194,
                'id_user' => 41,
                'id_permission' => 199,
                'created_at' => '2026-04-01 20:43:52',
                'updated_at' => '2026-04-01 20:43:52'
            ],
            [
                'id_user_permission' => 3195,
                'id_user' => 41,
                'id_permission' => 200,
                'created_at' => '2026-04-01 20:43:53',
                'updated_at' => '2026-04-01 20:43:53'
            ],
            [
                'id_user_permission' => 3196,
                'id_user' => 41,
                'id_permission' => 246,
                'created_at' => '2026-04-01 20:44:02',
                'updated_at' => '2026-04-01 20:44:02'
            ],
            [
                'id_user_permission' => 3197,
                'id_user' => 41,
                'id_permission' => 173,
                'created_at' => '2026-04-01 20:44:29',
                'updated_at' => '2026-04-01 20:44:29'
            ],
            [
                'id_user_permission' => 3198,
                'id_user' => 41,
                'id_permission' => 243,
                'created_at' => '2026-04-01 20:44:38',
                'updated_at' => '2026-04-01 20:44:38'
            ],
            [
                'id_user_permission' => 3199,
                'id_user' => 41,
                'id_permission' => 244,
                'created_at' => '2026-04-01 20:44:43',
                'updated_at' => '2026-04-01 20:44:43'
            ],
            [
                'id_user_permission' => 3200,
                'id_user' => 52,
                'id_permission' => 245,
                'created_at' => '2026-04-01 23:20:39',
                'updated_at' => '2026-04-01 23:20:39'
            ],
            [
                'id_user_permission' => 3201,
                'id_user' => 39,
                'id_permission' => 243,
                'created_at' => '2026-04-01 23:30:21',
                'updated_at' => '2026-04-01 23:30:21'
            ],
            [
                'id_user_permission' => 3203,
                'id_user' => 39,
                'id_permission' => 173,
                'created_at' => '2026-04-01 23:30:57',
                'updated_at' => '2026-04-01 23:30:57'
            ],
            [
                'id_user_permission' => 3204,
                'id_user' => 20,
                'id_permission' => 111,
                'created_at' => '2026-04-02 00:08:39',
                'updated_at' => '2026-04-02 00:08:39'
            ],
            [
                'id_user_permission' => 3205,
                'id_user' => 20,
                'id_permission' => 112,
                'created_at' => '2026-04-02 00:08:42',
                'updated_at' => '2026-04-02 00:08:42'
            ],
            [
                'id_user_permission' => 3206,
                'id_user' => 22,
                'id_permission' => 111,
                'created_at' => '2026-04-02 00:09:51',
                'updated_at' => '2026-04-02 00:09:51'
            ],
            [
                'id_user_permission' => 3207,
                'id_user' => 22,
                'id_permission' => 112,
                'created_at' => '2026-04-02 00:09:52',
                'updated_at' => '2026-04-02 00:09:52'
            ],
            [
                'id_user_permission' => 3208,
                'id_user' => 20,
                'id_permission' => 82,
                'created_at' => '2026-04-02 00:10:48',
                'updated_at' => '2026-04-02 00:10:48'
            ],
            [
                'id_user_permission' => 3209,
                'id_user' => 20,
                'id_permission' => 113,
                'created_at' => '2026-04-02 00:12:01',
                'updated_at' => '2026-04-02 00:12:01'
            ],
            [
                'id_user_permission' => 3210,
                'id_user' => 20,
                'id_permission' => 114,
                'created_at' => '2026-04-02 00:12:03',
                'updated_at' => '2026-04-02 00:12:03'
            ],
            [
                'id_user_permission' => 3213,
                'id_user' => 40,
                'id_permission' => 242,
                'created_at' => '2026-04-02 01:17:15',
                'updated_at' => '2026-04-02 01:17:15'
            ],
            [
                'id_user_permission' => 3214,
                'id_user' => 24,
                'id_permission' => 202,
                'created_at' => '2026-04-05 19:26:27',
                'updated_at' => '2026-04-05 19:26:27'
            ],
            [
                'id_user_permission' => 3215,
                'id_user' => 31,
                'id_permission' => 191,
                'created_at' => '2026-04-05 19:26:47',
                'updated_at' => '2026-04-05 19:26:47'
            ],
            [
                'id_user_permission' => 3216,
                'id_user' => 31,
                'id_permission' => 192,
                'created_at' => '2026-04-05 19:26:48',
                'updated_at' => '2026-04-05 19:26:48'
            ],
            [
                'id_user_permission' => 3217,
                'id_user' => 31,
                'id_permission' => 195,
                'created_at' => '2026-04-05 19:26:48',
                'updated_at' => '2026-04-05 19:26:48'
            ],
            [
                'id_user_permission' => 3218,
                'id_user' => 31,
                'id_permission' => 194,
                'created_at' => '2026-04-05 19:26:50',
                'updated_at' => '2026-04-05 19:26:50'
            ],
            [
                'id_user_permission' => 3219,
                'id_user' => 31,
                'id_permission' => 196,
                'created_at' => '2026-04-05 19:26:52',
                'updated_at' => '2026-04-05 19:26:52'
            ],
            [
                'id_user_permission' => 3220,
                'id_user' => 31,
                'id_permission' => 197,
                'created_at' => '2026-04-05 19:26:56',
                'updated_at' => '2026-04-05 19:26:56'
            ],
            [
                'id_user_permission' => 3221,
                'id_user' => 31,
                'id_permission' => 198,
                'created_at' => '2026-04-05 19:26:59',
                'updated_at' => '2026-04-05 19:26:59'
            ],
            [
                'id_user_permission' => 3222,
                'id_user' => 31,
                'id_permission' => 199,
                'created_at' => '2026-04-05 19:26:59',
                'updated_at' => '2026-04-05 19:26:59'
            ],
            [
                'id_user_permission' => 3223,
                'id_user' => 31,
                'id_permission' => 200,
                'created_at' => '2026-04-05 19:27:02',
                'updated_at' => '2026-04-05 19:27:02'
            ],
            [
                'id_user_permission' => 3224,
                'id_user' => 31,
                'id_permission' => 201,
                'created_at' => '2026-04-05 19:27:05',
                'updated_at' => '2026-04-05 19:27:05'
            ],
            [
                'id_user_permission' => 3225,
                'id_user' => 31,
                'id_permission' => 202,
                'created_at' => '2026-04-05 19:27:06',
                'updated_at' => '2026-04-05 19:27:06'
            ],
            [
                'id_user_permission' => 3226,
                'id_user' => 31,
                'id_permission' => 219,
                'created_at' => '2026-04-05 19:27:23',
                'updated_at' => '2026-04-05 19:27:23'
            ],
            [
                'id_user_permission' => 3227,
                'id_user' => 31,
                'id_permission' => 220,
                'created_at' => '2026-04-05 19:27:27',
                'updated_at' => '2026-04-05 19:27:27'
            ],
            [
                'id_user_permission' => 3228,
                'id_user' => 31,
                'id_permission' => 185,
                'created_at' => '2026-04-05 19:37:44',
                'updated_at' => '2026-04-05 19:37:44'
            ],
            [
                'id_user_permission' => 3229,
                'id_user' => 31,
                'id_permission' => 187,
                'created_at' => '2026-04-05 19:38:02',
                'updated_at' => '2026-04-05 19:38:02'
            ],
            [
                'id_user_permission' => 3230,
                'id_user' => 30,
                'id_permission' => 13,
                'created_at' => '2026-04-05 19:58:47',
                'updated_at' => '2026-04-05 19:58:47'
            ],
            [
                'id_user_permission' => 3231,
                'id_user' => 30,
                'id_permission' => 19,
                'created_at' => '2026-04-05 19:58:59',
                'updated_at' => '2026-04-05 19:58:59'
            ],
            [
                'id_user_permission' => 3232,
                'id_user' => 30,
                'id_permission' => 23,
                'created_at' => '2026-04-05 19:59:04',
                'updated_at' => '2026-04-05 19:59:04'
            ],
            [
                'id_user_permission' => 3233,
                'id_user' => 30,
                'id_permission' => 39,
                'created_at' => '2026-04-05 19:59:15',
                'updated_at' => '2026-04-05 19:59:15'
            ],
            [
                'id_user_permission' => 3234,
                'id_user' => 30,
                'id_permission' => 74,
                'created_at' => '2026-04-05 19:59:29',
                'updated_at' => '2026-04-05 19:59:29'
            ],
            [
                'id_user_permission' => 3235,
                'id_user' => 30,
                'id_permission' => 75,
                'created_at' => '2026-04-05 19:59:32',
                'updated_at' => '2026-04-05 19:59:32'
            ],
            [
                'id_user_permission' => 3236,
                'id_user' => 30,
                'id_permission' => 77,
                'created_at' => '2026-04-05 19:59:37',
                'updated_at' => '2026-04-05 19:59:37'
            ],
            [
                'id_user_permission' => 3237,
                'id_user' => 30,
                'id_permission' => 78,
                'created_at' => '2026-04-05 19:59:39',
                'updated_at' => '2026-04-05 19:59:39'
            ],
            [
                'id_user_permission' => 3238,
                'id_user' => 30,
                'id_permission' => 79,
                'created_at' => '2026-04-05 19:59:43',
                'updated_at' => '2026-04-05 19:59:43'
            ],
            [
                'id_user_permission' => 3239,
                'id_user' => 30,
                'id_permission' => 80,
                'created_at' => '2026-04-05 19:59:44',
                'updated_at' => '2026-04-05 19:59:44'
            ],
            [
                'id_user_permission' => 3240,
                'id_user' => 30,
                'id_permission' => 81,
                'created_at' => '2026-04-05 19:59:44',
                'updated_at' => '2026-04-05 19:59:44'
            ],
            [
                'id_user_permission' => 3241,
                'id_user' => 30,
                'id_permission' => 82,
                'created_at' => '2026-04-05 19:59:48',
                'updated_at' => '2026-04-05 19:59:48'
            ],
            [
                'id_user_permission' => 3242,
                'id_user' => 30,
                'id_permission' => 83,
                'created_at' => '2026-04-05 19:59:48',
                'updated_at' => '2026-04-05 19:59:48'
            ],
            [
                'id_user_permission' => 3243,
                'id_user' => 30,
                'id_permission' => 84,
                'created_at' => '2026-04-05 19:59:48',
                'updated_at' => '2026-04-05 19:59:48'
            ],
            [
                'id_user_permission' => 3244,
                'id_user' => 30,
                'id_permission' => 85,
                'created_at' => '2026-04-05 19:59:53',
                'updated_at' => '2026-04-05 19:59:53'
            ],
            [
                'id_user_permission' => 3245,
                'id_user' => 30,
                'id_permission' => 86,
                'created_at' => '2026-04-05 19:59:54',
                'updated_at' => '2026-04-05 19:59:54'
            ],
            [
                'id_user_permission' => 3246,
                'id_user' => 30,
                'id_permission' => 87,
                'created_at' => '2026-04-05 19:59:54',
                'updated_at' => '2026-04-05 19:59:54'
            ],
            [
                'id_user_permission' => 3247,
                'id_user' => 30,
                'id_permission' => 88,
                'created_at' => '2026-04-05 20:00:01',
                'updated_at' => '2026-04-05 20:00:01'
            ],
            [
                'id_user_permission' => 3248,
                'id_user' => 30,
                'id_permission' => 89,
                'created_at' => '2026-04-05 20:00:02',
                'updated_at' => '2026-04-05 20:00:02'
            ],
            [
                'id_user_permission' => 3249,
                'id_user' => 30,
                'id_permission' => 90,
                'created_at' => '2026-04-05 20:00:02',
                'updated_at' => '2026-04-05 20:00:02'
            ],
            [
                'id_user_permission' => 3250,
                'id_user' => 30,
                'id_permission' => 91,
                'created_at' => '2026-04-05 20:00:05',
                'updated_at' => '2026-04-05 20:00:05'
            ],
            [
                'id_user_permission' => 3251,
                'id_user' => 30,
                'id_permission' => 92,
                'created_at' => '2026-04-05 20:00:06',
                'updated_at' => '2026-04-05 20:00:06'
            ],
            [
                'id_user_permission' => 3252,
                'id_user' => 30,
                'id_permission' => 93,
                'created_at' => '2026-04-05 20:00:06',
                'updated_at' => '2026-04-05 20:00:06'
            ],
            [
                'id_user_permission' => 3253,
                'id_user' => 30,
                'id_permission' => 94,
                'created_at' => '2026-04-05 20:00:09',
                'updated_at' => '2026-04-05 20:00:09'
            ],
            [
                'id_user_permission' => 3254,
                'id_user' => 30,
                'id_permission' => 98,
                'created_at' => '2026-04-05 20:00:15',
                'updated_at' => '2026-04-05 20:00:15'
            ],
            [
                'id_user_permission' => 3255,
                'id_user' => 30,
                'id_permission' => 99,
                'created_at' => '2026-04-05 20:00:16',
                'updated_at' => '2026-04-05 20:00:16'
            ],
            [
                'id_user_permission' => 3256,
                'id_user' => 30,
                'id_permission' => 100,
                'created_at' => '2026-04-05 20:00:16',
                'updated_at' => '2026-04-05 20:00:16'
            ],
            [
                'id_user_permission' => 3257,
                'id_user' => 30,
                'id_permission' => 101,
                'created_at' => '2026-04-05 20:00:19',
                'updated_at' => '2026-04-05 20:00:19'
            ],
            [
                'id_user_permission' => 3258,
                'id_user' => 30,
                'id_permission' => 111,
                'created_at' => '2026-04-05 20:00:24',
                'updated_at' => '2026-04-05 20:00:24'
            ],
            [
                'id_user_permission' => 3259,
                'id_user' => 30,
                'id_permission' => 112,
                'created_at' => '2026-04-05 20:00:25',
                'updated_at' => '2026-04-05 20:00:25'
            ],
            [
                'id_user_permission' => 3260,
                'id_user' => 30,
                'id_permission' => 113,
                'created_at' => '2026-04-05 20:00:27',
                'updated_at' => '2026-04-05 20:00:27'
            ],
            [
                'id_user_permission' => 3261,
                'id_user' => 30,
                'id_permission' => 114,
                'created_at' => '2026-04-05 20:00:28',
                'updated_at' => '2026-04-05 20:00:28'
            ],
            [
                'id_user_permission' => 3262,
                'id_user' => 30,
                'id_permission' => 126,
                'created_at' => '2026-04-05 20:00:34',
                'updated_at' => '2026-04-05 20:00:34'
            ],
            [
                'id_user_permission' => 3263,
                'id_user' => 30,
                'id_permission' => 125,
                'created_at' => '2026-04-05 20:00:35',
                'updated_at' => '2026-04-05 20:00:35'
            ],
            [
                'id_user_permission' => 3264,
                'id_user' => 30,
                'id_permission' => 128,
                'created_at' => '2026-04-05 20:00:42',
                'updated_at' => '2026-04-05 20:00:42'
            ],
            [
                'id_user_permission' => 3265,
                'id_user' => 30,
                'id_permission' => 129,
                'created_at' => '2026-04-05 20:00:43',
                'updated_at' => '2026-04-05 20:00:43'
            ],
            [
                'id_user_permission' => 3266,
                'id_user' => 30,
                'id_permission' => 130,
                'created_at' => '2026-04-05 20:00:47',
                'updated_at' => '2026-04-05 20:00:47'
            ],
            [
                'id_user_permission' => 3267,
                'id_user' => 30,
                'id_permission' => 131,
                'created_at' => '2026-04-05 20:00:48',
                'updated_at' => '2026-04-05 20:00:48'
            ],
            [
                'id_user_permission' => 3268,
                'id_user' => 30,
                'id_permission' => 132,
                'created_at' => '2026-04-05 20:00:48',
                'updated_at' => '2026-04-05 20:00:48'
            ],
            [
                'id_user_permission' => 3269,
                'id_user' => 30,
                'id_permission' => 133,
                'created_at' => '2026-04-05 20:00:51',
                'updated_at' => '2026-04-05 20:00:51'
            ],
            [
                'id_user_permission' => 3270,
                'id_user' => 30,
                'id_permission' => 134,
                'created_at' => '2026-04-05 20:00:52',
                'updated_at' => '2026-04-05 20:00:52'
            ],
            [
                'id_user_permission' => 3271,
                'id_user' => 30,
                'id_permission' => 135,
                'created_at' => '2026-04-05 20:00:55',
                'updated_at' => '2026-04-05 20:00:55'
            ],
            [
                'id_user_permission' => 3272,
                'id_user' => 30,
                'id_permission' => 136,
                'created_at' => '2026-04-05 20:00:55',
                'updated_at' => '2026-04-05 20:00:55'
            ],
            [
                'id_user_permission' => 3273,
                'id_user' => 30,
                'id_permission' => 137,
                'created_at' => '2026-04-05 20:00:59',
                'updated_at' => '2026-04-05 20:00:59'
            ],
            [
                'id_user_permission' => 3274,
                'id_user' => 30,
                'id_permission' => 138,
                'created_at' => '2026-04-05 20:00:59',
                'updated_at' => '2026-04-05 20:00:59'
            ],
            [
                'id_user_permission' => 3275,
                'id_user' => 30,
                'id_permission' => 139,
                'created_at' => '2026-04-05 20:00:59',
                'updated_at' => '2026-04-05 20:00:59'
            ],
            [
                'id_user_permission' => 3276,
                'id_user' => 30,
                'id_permission' => 140,
                'created_at' => '2026-04-05 20:01:02',
                'updated_at' => '2026-04-05 20:01:02'
            ],
            [
                'id_user_permission' => 3277,
                'id_user' => 30,
                'id_permission' => 141,
                'created_at' => '2026-04-05 20:01:03',
                'updated_at' => '2026-04-05 20:01:03'
            ],
            [
                'id_user_permission' => 3278,
                'id_user' => 30,
                'id_permission' => 142,
                'created_at' => '2026-04-05 20:01:03',
                'updated_at' => '2026-04-05 20:01:03'
            ],
            [
                'id_user_permission' => 3279,
                'id_user' => 30,
                'id_permission' => 143,
                'created_at' => '2026-04-05 20:01:06',
                'updated_at' => '2026-04-05 20:01:06'
            ],
            [
                'id_user_permission' => 3280,
                'id_user' => 30,
                'id_permission' => 144,
                'created_at' => '2026-04-05 20:01:07',
                'updated_at' => '2026-04-05 20:01:07'
            ],
            [
                'id_user_permission' => 3281,
                'id_user' => 30,
                'id_permission' => 145,
                'created_at' => '2026-04-05 20:01:09',
                'updated_at' => '2026-04-05 20:01:09'
            ],
            [
                'id_user_permission' => 3282,
                'id_user' => 30,
                'id_permission' => 146,
                'created_at' => '2026-04-05 20:01:11',
                'updated_at' => '2026-04-05 20:01:11'
            ],
            [
                'id_user_permission' => 3283,
                'id_user' => 30,
                'id_permission' => 152,
                'created_at' => '2026-04-05 20:01:15',
                'updated_at' => '2026-04-05 20:01:15'
            ],
            [
                'id_user_permission' => 3284,
                'id_user' => 30,
                'id_permission' => 157,
                'created_at' => '2026-04-05 20:01:24',
                'updated_at' => '2026-04-05 20:01:24'
            ],
            [
                'id_user_permission' => 3285,
                'id_user' => 30,
                'id_permission' => 159,
                'created_at' => '2026-04-05 20:01:29',
                'updated_at' => '2026-04-05 20:01:29'
            ],
            [
                'id_user_permission' => 3286,
                'id_user' => 30,
                'id_permission' => 160,
                'created_at' => '2026-04-05 20:01:29',
                'updated_at' => '2026-04-05 20:01:29'
            ],
            [
                'id_user_permission' => 3287,
                'id_user' => 30,
                'id_permission' => 172,
                'created_at' => '2026-04-05 20:01:36',
                'updated_at' => '2026-04-05 20:01:36'
            ],
            [
                'id_user_permission' => 3288,
                'id_user' => 30,
                'id_permission' => 222,
                'created_at' => '2026-04-05 20:01:46',
                'updated_at' => '2026-04-05 20:01:46'
            ],
            [
                'id_user_permission' => 3289,
                'id_user' => 30,
                'id_permission' => 223,
                'created_at' => '2026-04-05 20:01:48',
                'updated_at' => '2026-04-05 20:01:48'
            ],
            [
                'id_user_permission' => 3290,
                'id_user' => 40,
                'id_permission' => 181,
                'created_at' => '2026-04-05 20:39:15',
                'updated_at' => '2026-04-05 20:39:15'
            ],
            [
                'id_user_permission' => 3291,
                'id_user' => 40,
                'id_permission' => 182,
                'created_at' => '2026-04-05 20:39:16',
                'updated_at' => '2026-04-05 20:39:16'
            ],
            [
                'id_user_permission' => 3292,
                'id_user' => 40,
                'id_permission' => 6,
                'created_at' => '2026-04-05 20:41:00',
                'updated_at' => '2026-04-05 20:41:00'
            ],
            [
                'id_user_permission' => 3293,
                'id_user' => 40,
                'id_permission' => 7,
                'created_at' => '2026-04-05 20:41:01',
                'updated_at' => '2026-04-05 20:41:01'
            ],
            [
                'id_user_permission' => 3294,
                'id_user' => 52,
                'id_permission' => 173,
                'created_at' => '2026-04-06 19:11:43',
                'updated_at' => '2026-04-06 19:11:43'
            ],
            [
                'id_user_permission' => 3295,
                'id_user' => 52,
                'id_permission' => 174,
                'created_at' => '2026-04-06 19:11:47',
                'updated_at' => '2026-04-06 19:11:47'
            ],
            [
                'id_user_permission' => 3296,
                'id_user' => 59,
                'id_permission' => 184,
                'created_at' => '2026-04-07 21:37:23',
                'updated_at' => '2026-04-07 21:37:23'
            ],
            [
                'id_user_permission' => 3297,
                'id_user' => 60,
                'id_permission' => 184,
                'created_at' => '2026-04-08 01:19:11',
                'updated_at' => '2026-04-08 01:19:11'
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_user_permissions')->insert($chunk);
        }
    }
}
