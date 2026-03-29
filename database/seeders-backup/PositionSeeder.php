<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['id_position' => 1, 'position' => 'CEO', 'created_at' => '2025-05-02 19:05:50', 'updated_at' => '2025-05-02 19:05:50'],
            ['id_position' => 2, 'position' => 'Kepala Gudang', 'created_at' => '2025-05-02 19:05:50', 'updated_at' => '2025-11-20 02:12:47'],
            ['id_position' => 3, 'position' => 'Staff', 'created_at' => '2025-05-02 19:06:08', 'updated_at' => '2025-05-03 20:54:22'],
            ['id_position' => 6, 'position' => 'Manager', 'created_at' => '2025-11-20 02:13:33', 'updated_at' => '2025-11-20 02:13:33'],
            ['id_position' => 7, 'position' => 'CFO', 'created_at' => '2025-11-20 02:13:46', 'updated_at' => '2025-11-20 02:13:46'],
            ['id_position' => 8, 'position' => 'Supervisor', 'created_at' => '2025-11-20 02:14:18', 'updated_at' => '2025-11-20 02:14:18'],
        ];

        DB::table('tbl_position')->upsert(
            $positions,
            ['id_position'],
            ['position', 'created_at', 'updated_at']
        );
    }
}
