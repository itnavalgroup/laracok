<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
                    [
                        'id_position' => 1,
                        'position' => 'CEO',
                        'created_at' => '2025-05-02 19:05:50',
                        'updated_at' => '2025-05-02 19:05:50',
                        'deleted_at' => null,
                    ],
                    [
                        'id_position' => 2,
                        'position' => 'Kepala Gudang',
                        'created_at' => '2025-05-02 19:05:50',
                        'updated_at' => '2025-11-20 02:12:47',
                        'deleted_at' => null,
                    ],
                    [
                        'id_position' => 3,
                        'position' => 'Staff',
                        'created_at' => '2025-05-02 19:06:08',
                        'updated_at' => '2025-05-03 20:54:22',
                        'deleted_at' => null,
                    ],
                    [
                        'id_position' => 6,
                        'position' => 'Manager',
                        'created_at' => '2025-11-20 02:13:33',
                        'updated_at' => '2025-11-20 02:13:33',
                        'deleted_at' => null,
                    ],
                    [
                        'id_position' => 7,
                        'position' => 'CFO',
                        'created_at' => '2025-11-20 02:13:46',
                        'updated_at' => '2025-11-20 02:13:46',
                        'deleted_at' => null,
                    ],
                    [
                        'id_position' => 8,
                        'position' => 'Supervisor',
                        'created_at' => '2025-11-20 02:14:18',
                        'updated_at' => '2025-11-20 02:14:18',
                        'deleted_at' => null,
                    ]
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_position')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
