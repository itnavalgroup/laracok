<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblPositionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_position')->truncate();

        $data = [
            [
                'id_position' => 1,
                'position' => 'CEO',
                'created_at' => '2025-05-02 12:05:50',
                'updated_at' => '2025-05-02 12:05:50',
                'deleted_at' => null
            ],
            [
                'id_position' => 2,
                'position' => 'Kepala Gudang',
                'created_at' => '2025-05-02 12:05:50',
                'updated_at' => '2025-11-19 19:12:47',
                'deleted_at' => null
            ],
            [
                'id_position' => 3,
                'position' => 'Staff',
                'created_at' => '2025-05-02 12:06:08',
                'updated_at' => '2025-05-03 13:54:22',
                'deleted_at' => null
            ],
            [
                'id_position' => 6,
                'position' => 'Manager',
                'created_at' => '2025-11-19 19:13:33',
                'updated_at' => '2025-11-19 19:13:33',
                'deleted_at' => null
            ],
            [
                'id_position' => 7,
                'position' => 'CFO',
                'created_at' => '2025-11-19 19:13:46',
                'updated_at' => '2025-11-19 19:13:46',
                'deleted_at' => null
            ],
            [
                'id_position' => 8,
                'position' => 'Supervisor',
                'created_at' => '2025-11-19 19:14:18',
                'updated_at' => '2025-11-19 19:14:18',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_position')->insert($chunk);
        }
    }
}
