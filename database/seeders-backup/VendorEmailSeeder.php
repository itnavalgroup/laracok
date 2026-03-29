<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorEmailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_email_vendor' => 1, 'id_vendor' => 1, 'email' => 'tarwiyo.prasetyo@dhl.com', 'created_at' => '2025-11-20 07:48:24',],
            ['id_email_vendor' => 2, 'id_vendor' => 8, 'email' => 'jessica.bskfinance@gmail.com', 'created_at' => '2025-11-20 07:48:24',],
            ['id_email_vendor' => 3, 'id_vendor' => 15, 'email' => 'ops@mst-logs.com', 'created_at' => '2025-11-20 07:48:24',],
            ['id_email_vendor' => 4, 'id_vendor' => 16, 'email' => 'niac_61@yahoo.com', 'created_at' => '2025-11-20 07:48:24',],
            ['id_email_vendor' => 5, 'id_vendor' => 20, 'email' => 'teguh.ramanata.se@gmail.com', 'created_at' => '2025-11-20 07:48:24',],
            ['id_email_vendor' => 6, 'id_vendor' => 23, 'email' => 'pt.scala.contractor@gmail.com', 'created_at' => '2025-11-20 07:48:24',],
            ['id_email_vendor' => 7, 'id_vendor' => 25, 'email' => 'desmiirmaawulle@gmail.com', 'created_at' => '2025-11-20 07:48:24',],
            ['id_email_vendor' => 8, 'id_vendor' => 27, 'email' => 'finsrg@sblogistik.com', 'created_at' => '2025-11-20 07:48:24',],
            ['id_email_vendor' => 9, 'id_vendor' => 32, 'email' => 'Finsub@sijilogistics.com', 'created_at' => '2025-11-20 07:48:24',],
            ['id_email_vendor' => 10, 'id_vendor' => 33, 'email' => 'admin@sunlielogistic.com', 'created_at' => '2025-11-20 07:48:24',],
            ['id_email_vendor' => 11, 'id_vendor' => 34, 'email' => 'udinnoviara1979@gmail.com', 'created_at' => '2025-11-20 07:48:24',],
            ['id_email_vendor' => 12, 'id_vendor' => 36, 'email' => 'adesudrajat258@gmail.com', 'created_at' => '2025-11-20 07:48:24',],
        ];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_email_vendor')->upsert($chunk, ['id_email_vendor'], ['id_email_vendor', 'id_vendor', 'email', 'created_at', 'updated_at']);
        }
    }
}
