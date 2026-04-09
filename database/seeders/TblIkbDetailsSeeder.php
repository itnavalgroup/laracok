<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblIkbDetailsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_ikb_details')->truncate();

        $data = [
            [
                'id_ikb_detail' => 1,
                'id_ikb' => 4,
                'id_item_category' => 15,
                'id_item' => 33,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 1875.0000,
                'description' => null,
                'created_at' => '2026-03-30 17:39:20',
                'updated_at' => '2026-03-30 17:39:20',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 2,
                'id_ikb' => 5,
                'id_item_category' => 13,
                'id_item' => 19,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 275.0000,
                'description' => null,
                'created_at' => '2026-03-30 17:45:07',
                'updated_at' => '2026-03-30 17:45:07',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 3,
                'id_ikb' => 6,
                'id_item_category' => 18,
                'id_item' => 39,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 5950.0000,
                'description' => null,
                'created_at' => '2026-03-30 18:47:10',
                'updated_at' => '2026-03-31 21:06:25',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 5,
                'id_ikb' => 7,
                'id_item_category' => 15,
                'id_item' => 33,
                'id_uom' => 3,
                'id_packaging' => 7,
                'id_contract' => null,
                'qty' => 20000.0000,
                'description' => null,
                'created_at' => '2026-03-30 20:52:41',
                'updated_at' => '2026-03-30 20:52:41',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 6,
                'id_ikb' => 7,
                'id_item_category' => 6,
                'id_item' => 4,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 9000.0000,
                'description' => null,
                'created_at' => '2026-03-30 20:54:33',
                'updated_at' => '2026-03-30 20:54:33',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 9,
                'id_ikb' => 12,
                'id_item_category' => 15,
                'id_item' => 33,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 1875.0000,
                'description' => 'MOHON GUM ROSIN DI CACAH LEBIH HALUS SEBELUM PACKING 
',
                'created_at' => '2026-03-31 00:17:53',
                'updated_at' => '2026-03-31 02:37:42',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 10,
                'id_ikb' => 9,
                'id_item_category' => 15,
                'id_item' => 33,
                'id_uom' => 3,
                'id_packaging' => 6,
                'id_contract' => null,
                'qty' => 40000.0000,
                'description' => 'PENGIRIMAN 2 ISOTANK GUM TURPENTINE OIL @20 MT PER ISOTANK ',
                'created_at' => '2026-03-31 01:53:17',
                'updated_at' => '2026-03-31 20:40:37',
                'deleted_at' => '2026-03-31 20:40:37'
            ],
            [
                'id_ikb_detail' => 11,
                'id_ikb' => 14,
                'id_item_category' => 15,
                'id_item' => 33,
                'id_uom' => 3,
                'id_packaging' => 5,
                'id_contract' => null,
                'qty' => 19200.0000,
                'description' => 'PAKAI PALLET',
                'created_at' => '2026-03-31 02:38:38',
                'updated_at' => '2026-03-31 02:38:38',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 12,
                'id_ikb' => 15,
                'id_item_category' => 13,
                'id_item' => 19,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 275.0000,
                'description' => '',
                'created_at' => '2026-03-31 18:05:38',
                'updated_at' => '2026-03-31 18:05:38',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 13,
                'id_ikb' => 8,
                'id_item_category' => 8,
                'id_item' => 7,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 3750.0000,
                'description' => 'Natural Gum Copal DBB Grade 1 (S) // Packaging Karung dan box
Sediakan sample untuk proses karantina',
                'created_at' => '2026-03-31 21:19:04',
                'updated_at' => '2026-03-31 21:19:04',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 14,
                'id_ikb' => 8,
                'id_item_category' => 8,
                'id_item' => 7,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 7250.0000,
                'description' => 'Natural Gum Copal DBB Grade 3 (s) // Packaging Karung PP dan Box
Mohon sediakan sample untuk Karantina',
                'created_at' => '2026-03-31 21:35:21',
                'updated_at' => '2026-04-01 00:30:15',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 15,
                'id_ikb' => 8,
                'id_item_category' => 8,
                'id_item' => 9,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 500.0000,
                'description' => 'Gum Copal Dust 1 // Packaging Karung PP dan Box
Mohon sediakan sample untuk keperluan karantina',
                'created_at' => '2026-03-31 21:38:43',
                'updated_at' => '2026-03-31 21:38:43',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 16,
                'id_ikb' => 8,
                'id_item_category' => 8,
                'id_item' => 9,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 1500.0000,
                'description' => 'Gum Copal Dust 3 // Packaging Karung PP dan Box
Mohon sediakan sample untuk keperluan karantina',
                'created_at' => '2026-03-31 21:42:03',
                'updated_at' => '2026-04-01 23:58:43',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 17,
                'id_ikb' => 17,
                'id_item_category' => 13,
                'id_item' => 19,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 4050.0000,
                'description' => 'Diambil oleh customer ke gudang batang ',
                'created_at' => '2026-04-01 19:50:37',
                'updated_at' => '2026-04-01 21:21:07',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 18,
                'id_ikb' => 9,
                'id_item_category' => 16,
                'id_item' => 36,
                'id_uom' => 3,
                'id_packaging' => 6,
                'id_contract' => null,
                'qty' => 40000.0000,
                'description' => 'PENGIRIMAN 40 MT GUM TURPENTINE OIL (2 ISOTANK) UNTUK KEPERLUAN EXPORT',
                'created_at' => '2026-04-01 23:14:50',
                'updated_at' => '2026-04-01 23:14:50',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 19,
                'id_ikb' => 2,
                'id_item_category' => 16,
                'id_item' => 36,
                'id_uom' => 3,
                'id_packaging' => 6,
                'id_contract' => null,
                'qty' => 40000.0000,
                'description' => 'PENGIRIMAN 40 MT GUM TURPENTINE OIL (2 ISOTANK) UNTUK KEPERLUAN EXPORT ',
                'created_at' => '2026-04-01 23:23:06',
                'updated_at' => '2026-04-01 23:23:06',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 20,
                'id_ikb' => 8,
                'id_item_category' => 8,
                'id_item' => 6,
                'id_uom' => 3,
                'id_packaging' => 2,
                'id_contract' => null,
                'qty' => 2000.0000,
                'description' => 'Natural Gum Copal PWS (S) // Packaging menggunakan Karung PP dan Box
mohon sediakan sample untuk keperluan karantina',
                'created_at' => '2026-04-02 00:03:00',
                'updated_at' => '2026-04-02 00:03:00',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 21,
                'id_ikb' => 20,
                'id_item_category' => 15,
                'id_item' => 33,
                'id_uom' => 3,
                'id_packaging' => 5,
                'id_contract' => null,
                'qty' => 38400.0000,
                'description' => 'PENGIRIMAN 2 FCL GUM ROSIN WW GRADE DIKEMAS DALAM DRUM @240 KG DENGAN TOTAL 160 DRUM ',
                'created_at' => '2026-04-02 01:52:31',
                'updated_at' => '2026-04-02 01:52:31',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 22,
                'id_ikb' => 21,
                'id_item_category' => 15,
                'id_item' => 33,
                'id_uom' => 3,
                'id_packaging' => 5,
                'id_contract' => null,
                'qty' => 57600.0000,
                'description' => 'PENGIRIMAN 3 FCL GUM ROSIN WW GRADE UNTUK KEPERLUAN EXPORT
DETAIL PACKAGING: 
',
                'created_at' => '2026-04-02 02:15:21',
                'updated_at' => '2026-04-02 02:22:03',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 23,
                'id_ikb' => 22,
                'id_item_category' => 15,
                'id_item' => 33,
                'id_uom' => 3,
                'id_packaging' => 5,
                'id_contract' => null,
                'qty' => 19200.0000,
                'description' => 'PENGIRIMAN 1 FCL GUM ROSIN WW GRADE 
DETAIL PACKANGING: DRUM KALENG
',
                'created_at' => '2026-04-02 02:20:17',
                'updated_at' => '2026-04-02 02:34:54',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 24,
                'id_ikb' => 19,
                'id_item_category' => 15,
                'id_item' => 33,
                'id_uom' => 3,
                'id_packaging' => 5,
                'id_contract' => null,
                'qty' => 57600.0000,
                'description' => 'PENGIRIMAN 3 FCL GUM ROSIN WW GRADE UNTUK KEPERLUAN EXPORT 
PACKAGING : DRUM KALENG',
                'created_at' => '2026-04-02 02:49:40',
                'updated_at' => '2026-04-02 02:49:40',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 25,
                'id_ikb' => 23,
                'id_item_category' => 16,
                'id_item' => 36,
                'id_uom' => 3,
                'id_packaging' => 7,
                'id_contract' => null,
                'qty' => 3400.0000,
                'description' => 'Pengiriman modal masak (GTO 20 DRUM) untuk getah sulawesi dan getah bogor',
                'created_at' => '2026-04-05 19:18:01',
                'updated_at' => '2026-04-05 19:18:01',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 26,
                'id_ikb' => 24,
                'id_item_category' => 15,
                'id_item' => 34,
                'id_uom' => 3,
                'id_packaging' => 7,
                'id_contract' => null,
                'qty' => 5700.0000,
                'description' => 'PENGAMBILAN BARANG DI GUDANG BATANG ',
                'created_at' => '2026-04-05 21:02:19',
                'updated_at' => '2026-04-05 21:14:08',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 27,
                'id_ikb' => 24,
                'id_item_category' => 15,
                'id_item' => 33,
                'id_uom' => 3,
                'id_packaging' => 7,
                'id_contract' => null,
                'qty' => 3900.0000,
                'description' => 'GUM ROSIN WW BAD STOCK ',
                'created_at' => '2026-04-05 21:15:20',
                'updated_at' => '2026-04-05 21:15:20',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 28,
                'id_ikb' => 25,
                'id_item_category' => 15,
                'id_item' => 33,
                'id_uom' => 3,
                'id_packaging' => 7,
                'id_contract' => null,
                'qty' => 5040.0000,
                'description' => 'GUM ROSIN WW BAD STOCK ',
                'created_at' => '2026-04-05 21:18:13',
                'updated_at' => '2026-04-05 21:18:13',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 29,
                'id_ikb' => 18,
                'id_item_category' => 7,
                'id_item' => 5,
                'id_uom' => 3,
                'id_packaging' => 7,
                'id_contract' => null,
                'qty' => 180.0000,
                'description' => 'PINE OIL CHINA 50% ',
                'created_at' => '2026-04-06 00:57:48',
                'updated_at' => '2026-04-06 00:57:48',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 30,
                'id_ikb' => 26,
                'id_item_category' => 16,
                'id_item' => 36,
                'id_uom' => 3,
                'id_packaging' => 7,
                'id_contract' => null,
                'qty' => 27200.0000,
                'description' => '- Packed in a Fiber drum 170 kg- Shipment against down payment 30%',
                'created_at' => '2026-04-07 00:07:42',
                'updated_at' => '2026-04-07 00:33:43',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 31,
                'id_ikb' => 28,
                'id_item_category' => 16,
                'id_item' => 36,
                'id_uom' => 3,
                'id_packaging' => 6,
                'id_contract' => null,
                'qty' => 40000.0000,
                'description' => 'PENGIRIMAN 40 MT GUM TURPENTINE OIL (2 ISOTANK) UNTUK KEPERLUAN EXPORT',
                'created_at' => '2026-04-07 01:05:25',
                'updated_at' => '2026-04-07 01:05:59',
                'deleted_at' => null
            ],
            [
                'id_ikb_detail' => 32,
                'id_ikb' => 29,
                'id_item_category' => 11,
                'id_item' => 18,
                'id_uom' => 3,
                'id_packaging' => 9,
                'id_contract' => null,
                'qty' => 0.2000,
                'description' => 'Sample 200 gram terpineol
KIRIM KE : PT INTAN CHEMICAL (PLANT 1) 
SMB, BUSINESS CENTRAL PARK NO. A30-A32, JL. RAYA CANGKIR KM 22, NGAMBAR, BAMBE, KEC. DRIYOREJO, KAB GRESIK JAWA TIMUR 61177
UP. BU GITA ( PROCUREMENT) 0851-6860-0351',
                'created_at' => '2026-04-07 21:45:52',
                'updated_at' => '2026-04-07 21:50:10',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_ikb_details')->insert($chunk);
        }
    }
}
