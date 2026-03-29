<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_log')->upsert($chunk, ['id_log'], ['id_log', 'id_user', 'activity', 'description', 'ip_address', 'user_agent', 'created_at', 'updated_at']);
        }
    }
}
