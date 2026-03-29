<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttachmentSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_attachment' => 38, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Original Invoice', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 39, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Faktur Pajak', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 40, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Kwitansi', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 41, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Surat Jalan / DO', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 42, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Purchase Order / SPK', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 43, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Penerimaan Barang', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 44, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Contract', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 45, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Inspection Letter', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 46, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Supporting Documents', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 47, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Timbangan', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 48, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'PI', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 49, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'KTP', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 50, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'NPWP', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 51, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Packing List', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 52, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'GOV.FEE', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 53, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'COO', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 54, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'COA', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 55, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'BL', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 56, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'ASURANSI', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 57, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'SKT', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 58, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'SPPKP', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-29 16:28:02',],
            ['id_attachment' => 59, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'EKP', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 60, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'LOG', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 61, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'SKB', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 62, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'TRUCKING', 'file_path' => '2025-11-23 09:08:49', 'file_type' => '2025-11-23 09:08:49',],
            ['id_attachment' => 63, 'id_transaction' => 0, 'transaction_type' => 1, 'file_name' => 'Nota', 'file_path' => '2025-11-23 09:09:42', 'file_type' => '2025-11-29 16:27:52',],
            ['id_attachment' => 64, 'id_transaction' => 9, 'transaction_type' => 38, 'file_name' => 'Invoice dan Faktur Pajak', 'file_path' => '2025-12-17 03:55:38', 'file_type' => '2025-12-17 03:55:38',],
            ['id_attachment' => 65, 'id_transaction' => 7, 'transaction_type' => 53, 'file_name' => 'MEMO INTERNAL', 'file_path' => '2026-01-08 01:44:41', 'file_type' => '2026-01-08 01:44:41',],
            ['id_attachment' => 66, 'id_transaction' => 6, 'transaction_type' => 52, 'file_name' => 'Perjanjian Kerja Sama', 'file_path' => '2026-01-08 09:26:48', 'file_type' => '2026-01-08 09:26:48',],
            ['id_attachment' => 67, 'id_transaction' => 7, 'transaction_type' => 53, 'file_name' => 'LAPORAN', 'file_path' => '2026-01-23 01:40:25', 'file_type' => '2026-01-23 01:40:25',],
            ['id_attachment' => 68, 'id_transaction' => 7, 'transaction_type' => 53, 'file_name' => 'FORMULIR', 'file_path' => '2026-02-03 01:37:29', 'file_type' => '2026-02-03 01:37:29',],
        ];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_attachment')->upsert($chunk, ['id_attachment'], ['id_attachment', 'id_transaction', 'transaction_type', 'file_name', 'file_path', 'file_type', 'file_size', 'created_at', 'updated_at']);
        }
    }
}
