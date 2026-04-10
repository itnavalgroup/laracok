<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblAttachmentIkbSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_attachment_ikb')->truncate();

        $data = [
            [
                'id_attachment_ikb' => 1,
                'id_ikb' => 4,
                'id_attachment' => 42,
                'id_user' => 33,
                'note' => 'SO',
                'filename' => '1774917611_69cb17ebbdda1.pdf',
                'created_at' => '2026-03-30 17:40:11',
                'updated_at' => '2026-03-30 17:40:11',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 2,
                'id_ikb' => 4,
                'id_attachment' => 42,
                'id_user' => 33,
                'note' => 'SO',
                'filename' => '1774917648_69cb181074c39.pdf',
                'created_at' => '2026-03-30 17:40:48',
                'updated_at' => '2026-03-30 17:40:48',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 3,
                'id_ikb' => 5,
                'id_attachment' => 42,
                'id_user' => 33,
                'note' => 'SO',
                'filename' => '1774917931_69cb192b1169b.pdf',
                'created_at' => '2026-03-30 17:45:31',
                'updated_at' => '2026-03-30 17:45:31',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 4,
                'id_ikb' => 5,
                'id_attachment' => 42,
                'id_user' => 33,
                'note' => 'SO',
                'filename' => '1774917958_69cb194643f9e.pdf',
                'created_at' => '2026-03-30 17:45:58',
                'updated_at' => '2026-03-30 17:45:58',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 6,
                'id_ikb' => 6,
                'id_attachment' => 46,
                'id_user' => 40,
                'note' => null,
                'filename' => '1774923584_69cb2f403734d.pdf',
                'created_at' => '2026-03-30 19:19:44',
                'updated_at' => '2026-03-30 19:19:44',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 7,
                'id_ikb' => 6,
                'id_attachment' => 46,
                'id_user' => 40,
                'note' => null,
                'filename' => '1774923606_69cb2f564e520.pdf',
                'created_at' => '2026-03-30 19:20:06',
                'updated_at' => '2026-03-30 19:20:06',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 8,
                'id_ikb' => 7,
                'id_attachment' => 42,
                'id_user' => 39,
                'note' => null,
                'filename' => '1774929531_69cb467b78775.pdf',
                'created_at' => '2026-03-30 20:58:51',
                'updated_at' => '2026-03-30 20:58:51',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 11,
                'id_ikb' => 12,
                'id_attachment' => 42,
                'id_user' => 69,
                'note' => 'INV',
                'filename' => '1774941494_69cb753628f73.pdf',
                'created_at' => '2026-03-31 00:18:14',
                'updated_at' => '2026-03-31 00:18:14',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 12,
                'id_ikb' => 14,
                'id_attachment' => 42,
                'id_user' => 69,
                'note' => 'INV',
                'filename' => '1774949953_69cb96410dc8a.pdf',
                'created_at' => '2026-03-31 02:39:13',
                'updated_at' => '2026-03-31 02:39:13',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 13,
                'id_ikb' => 14,
                'id_attachment' => 42,
                'id_user' => 69,
                'note' => 'INV',
                'filename' => '1774950005_69cb9675938a3.pdf',
                'created_at' => '2026-03-31 02:40:05',
                'updated_at' => '2026-03-31 02:40:05',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 14,
                'id_ikb' => 15,
                'id_attachment' => 42,
                'id_user' => 69,
                'note' => 'INV',
                'filename' => '1775005572_69cc6f8484833.pdf',
                'created_at' => '2026-03-31 18:06:12',
                'updated_at' => '2026-03-31 18:06:12',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 15,
                'id_ikb' => 15,
                'id_attachment' => 42,
                'id_user' => 69,
                'note' => 'INV',
                'filename' => '1775005600_69cc6fa0d60d3.pdf',
                'created_at' => '2026-03-31 18:06:40',
                'updated_at' => '2026-03-31 18:06:40',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 16,
                'id_ikb' => 6,
                'id_attachment' => 41,
                'id_user' => 57,
                'note' => 'SURAT JALAN DAN TIMBANGAN',
                'filename' => '1775020174_69cca88ed4c95.pdf',
                'created_at' => '2026-03-31 22:09:34',
                'updated_at' => '2026-03-31 22:09:34',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 17,
                'id_ikb' => 17,
                'id_attachment' => 41,
                'id_user' => 57,
                'note' => 'SURAT JALAN DAN TIMBANGAN',
                'filename' => '1775107255_69cdfcb7b2b4e.pdf',
                'created_at' => '2026-04-01 22:20:55',
                'updated_at' => '2026-04-01 22:20:55',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 18,
                'id_ikb' => 9,
                'id_attachment' => 48,
                'id_user' => 39,
                'note' => null,
                'filename' => '1775110607_69ce09cf6776a.pdf',
                'created_at' => '2026-04-01 23:16:47',
                'updated_at' => '2026-04-01 23:16:47',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 19,
                'id_ikb' => 2,
                'id_attachment' => 48,
                'id_user' => 39,
                'note' => null,
                'filename' => '1775111020_69ce0b6cc669b.pdf',
                'created_at' => '2026-04-01 23:23:40',
                'updated_at' => '2026-04-01 23:23:40',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 20,
                'id_ikb' => 7,
                'id_attachment' => 41,
                'id_user' => 57,
                'note' => 'SURAT JALAN DAN TIMBANGAN FUMARIC ACID',
                'filename' => '1775295923_69d0ddb34e1b1.pdf',
                'created_at' => '2026-04-04 02:45:23',
                'updated_at' => '2026-04-04 02:45:23',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 21,
                'id_ikb' => 7,
                'id_attachment' => 41,
                'id_user' => 57,
                'note' => 'SURAT JALAN DAN TIMBANGAN GUM ROSIN',
                'filename' => '1775296024_69d0de18c8f71.pdf',
                'created_at' => '2026-04-04 02:47:04',
                'updated_at' => '2026-04-04 02:47:04',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 22,
                'id_ikb' => 23,
                'id_attachment' => 41,
                'id_user' => 52,
                'note' => 'surat jalan',
                'filename' => '1775441903_69d317ef076e1.jpeg',
                'created_at' => '2026-04-05 19:18:23',
                'updated_at' => '2026-04-05 19:18:23',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 23,
                'id_ikb' => 23,
                'id_attachment' => 47,
                'id_user' => 52,
                'note' => 'timbangan',
                'filename' => '1775441929_69d31809132d3.jpeg',
                'created_at' => '2026-04-05 19:18:49',
                'updated_at' => '2026-04-05 19:18:49',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 24,
                'id_ikb' => 26,
                'id_attachment' => 48,
                'id_user' => 51,
                'note' => 'SO',
                'filename' => '1775545713_69d4ad71ca2c3.pdf',
                'created_at' => '2026-04-07 00:08:33',
                'updated_at' => '2026-04-07 00:08:33',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 25,
                'id_ikb' => 26,
                'id_attachment' => 44,
                'id_user' => 51,
                'note' => 'Sales Contract',
                'filename' => '1775545749_69d4ad95188b9.pdf',
                'created_at' => '2026-04-07 00:09:09',
                'updated_at' => '2026-04-07 00:09:09',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 26,
                'id_ikb' => 14,
                'id_attachment' => 41,
                'id_user' => 60,
                'note' => 'DO / SJ',
                'filename' => '1775622304_69d5d8a025b24.jpg',
                'created_at' => '2026-04-07 21:25:04',
                'updated_at' => '2026-04-07 21:25:04',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 27,
                'id_ikb' => 26,
                'id_attachment' => 41,
                'id_user' => 57,
                'note' => 'SURAT JALAN DAN TIMBANGAN CONTAINER 1',
                'filename' => '1775629624_69d5f538e790c.pdf',
                'created_at' => '2026-04-07 23:27:04',
                'updated_at' => '2026-04-07 23:27:04',
                'deleted_at' => null
            ],
            [
                'id_attachment_ikb' => 28,
                'id_ikb' => 26,
                'id_attachment' => 41,
                'id_user' => 57,
                'note' => 'SURAT JALAN DAN TIMBANGAN CONTAINER 2',
                'filename' => '1775629894_69d5f6467e658.pdf',
                'created_at' => '2026-04-07 23:31:34',
                'updated_at' => '2026-04-07 23:31:34',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_attachment_ikb')->insert($chunk);
        }
    }
}
