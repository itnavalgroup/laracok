<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblNorekVendorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_norek_vendor')->truncate();

        $data = [
            [
                'id_norek_vendor' => 1,
                'id_vendor' => 1,
                'nama_bank' => 'Standard Chartered Bank',
                'nama_penerima' => 'KRISHNA SUKSES ABADI PT',
                'norek' => '8104041301425849',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 2,
                'id_vendor' => 2,
                'nama_bank' => 'BANK ACEH',
                'nama_penerima' => 'ISMAIL MUSE',
                'norek' => '07302055900466',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 3,
                'id_vendor' => 3,
                'nama_bank' => 'BANK ACEH',
                'nama_penerima' => 'SITI SARAH',
                'norek' => '05002200038684',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 4,
                'id_vendor' => 4,
                'nama_bank' => 'BANK ACEH',
                'nama_penerima' => 'SUPARDI',
                'norek' => '07102200094006',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 5,
                'id_vendor' => 5,
                'nama_bank' => 'BANK ACEH',
                'nama_penerima' => 'WAHYUDI',
                'norek' => '07302400020193',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 6,
                'id_vendor' => 6,
                'nama_bank' => 'Bank mandiri',
                'nama_penerima' => 'Fatma Sari',
                'norek' => '1230007763917',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 7,
                'id_vendor' => 7,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'ABDUL KHOLIQ',
                'norek' => '2381639730',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 8,
                'id_vendor' => 8,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT BENUA SAMUDERA KARGO',
                'norek' => '0222353228',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 9,
                'id_vendor' => 9,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'JUANTO HALIM',
                'norek' => '5290303909',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 10,
                'id_vendor' => 10,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'YANTO',
                'norek' => '5920250949',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 11,
                'id_vendor' => 11,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'CV TIRTA MAKMUR',
                'norek' => '0139999004',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 12,
                'id_vendor' => 12,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'CV TWIN ANUGRAH JAYA',
                'norek' => '2766049700',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 13,
                'id_vendor' => 13,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'IMAM MUZAIDIN',
                'norek' => '3820326805',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 14,
                'id_vendor' => 14,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'HO SU JEN',
                'norek' => '3353010090',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 15,
                'id_vendor' => 15,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT MANDALA SAMUDRA TRANS',
                'norek' => '2523017021',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 16,
                'id_vendor' => 16,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'Moh Kurniadi Azam K',
                'norek' => '2381366032',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 17,
                'id_vendor' => 17,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'NIA MAY INDAHWATI',
                'norek' => '7460178929',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 18,
                'id_vendor' => 18,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'MOH ARSYAD ABIYOGA',
                'norek' => '6640477677',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 19,
                'id_vendor' => 19,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT PROTECH ALAM SEMESTA',
                'norek' => '1273015535',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 20,
                'id_vendor' => 20,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'VA SUMBER BANYU BIRU, PT.',
                'norek' => '2213400373646307',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 21,
                'id_vendor' => 21,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. BONA FIDE PRATAMA',
                'norek' => '6380372299',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 22,
                'id_vendor' => 22,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT.HARMONY ALAM INDAH',
                'norek' => '7617775151',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 23,
                'id_vendor' => 23,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT.SCALA CONTRACTOR',
                'norek' => '0933026717',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 24,
                'id_vendor' => 24,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. ERA SUPPLIES INDONESIA',
                'norek' => '6460198508',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 25,
                'id_vendor' => 25,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT BUMI AGUNG GROUP',
                'norek' => '8650522797',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 26,
                'id_vendor' => 26,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. PERINTIS TIMBANGAN INDONESIA',
                'norek' => '3831391616',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 27,
                'id_vendor' => 27,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. SINAR BARU LOGISTIK',
                'norek' => '4504331999',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 28,
                'id_vendor' => 28,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. TRANSPORINDO AGUNG SEJAHTERA',
                'norek' => '0253108581',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 29,
                'id_vendor' => 29,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT LAVARO CIPTA KARYA',
                'norek' => '7225123641',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 30,
                'id_vendor' => 30,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT.LAVARO CIPTA KREASI',
                'norek' => '8832100641',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 31,
                'id_vendor' => 31,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'RUKAYAH',
                'norek' => '2380030881',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 32,
                'id_vendor' => 32,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. SIJI UTAMA LOGISTIK',
                'norek' => '5130132989',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 33,
                'id_vendor' => 33,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT SUNLIE GLOBAL LOGISTIC',
                'norek' => '0229542020',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 34,
                'id_vendor' => 34,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'UDIN ABDUL NOVIARA',
                'norek' => '3520428975',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 35,
                'id_vendor' => 35,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'FATMAWATI',
                'norek' => '2500627801',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 36,
                'id_vendor' => 36,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'ADE SUDRAJAT',
                'norek' => '3520900518',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 37,
                'id_vendor' => 37,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'FINNET INDONESIA PT',
                'norek' => '4500322999',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 38,
                'id_vendor' => 38,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT KRISHNA SUKSES ABADI',
                'norek' => 'VA04744.9900.01106',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 39,
                'id_vendor' => 39,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'TAUFIQ HIDAYAT',
                'norek' => '5737393505',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 40,
                'id_vendor' => 40,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'UMAR ALY',
                'norek' => '3820061011',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 41,
                'id_vendor' => 41,
                'nama_bank' => 'BCA MENTENG',
                'nama_penerima' => 'PT. KEFI WANGI INDONESIA',
                'norek' => '7350089068',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 42,
                'id_vendor' => 42,
                'nama_bank' => 'BNI',
                'nama_penerima' => 'MUHAMMAD NASIRUDIN',
                'norek' => '1889740683',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 43,
                'id_vendor' => 43,
                'nama_bank' => 'BNI',
                'nama_penerima' => 'PT. GLOBAL MARITIM AGENSI',
                'norek' => '8998778985',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 44,
                'id_vendor' => 44,
                'nama_bank' => 'BNI',
                'nama_penerima' => 'RAVI JAVIER AHMAD ROCHIM',
                'norek' => '1852750988',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 45,
                'id_vendor' => 45,
                'nama_bank' => 'BNI',
                'nama_penerima' => 'TAUFIK',
                'norek' => '0332643263',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 46,
                'id_vendor' => 46,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'AHMAD',
                'norek' => '069501000268560',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 47,
                'id_vendor' => 47,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'ALIMSYAH',
                'norek' => '7213439035',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 48,
                'id_vendor' => 48,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'CV Mandala Tunas Perkasa',
                'norek' => '015601777888562',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 49,
                'id_vendor' => 49,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'MUHAMMAD EKA PRISMA',
                'norek' => '593101054440533',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 50,
                'id_vendor' => 50,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'RESIN MANDIRI SULAWESI',
                'norek' => '205201000716303',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 51,
                'id_vendor' => 51,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'MULYANI',
                'norek' => '559001021070531',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 52,
                'id_vendor' => 52,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'SUKIMAN',
                'norek' => '021101042874503',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 53,
                'id_vendor' => 54,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'PT MOLEKUL PINUS INDONESIA',
                'norek' => '006801003003304',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 54,
                'id_vendor' => 55,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'PT. PINUS MAKMUR INDONESIA',
                'norek' => '28501002766569',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 55,
                'id_vendor' => 56,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'PUSPA LILA',
                'norek' => '334501056292535',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 56,
                'id_vendor' => 57,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'RUMANTI NAINGGOLAN',
                'norek' => '337501070179530',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 57,
                'id_vendor' => 58,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'MUSTAKIM',
                'norek' => '368901009518500',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 58,
                'id_vendor' => 59,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'TERMINTA ARA',
                'norek' => '222701001116561',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 59,
                'id_vendor' => 60,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'AHMAD',
                'norek' => '1051732983',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 60,
                'id_vendor' => 61,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'AKMALA DEWI',
                'norek' => '1048858283',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 61,
                'id_vendor' => 62,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'ALDAYAN RAHENDRA',
                'norek' => '7233421768',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 62,
                'id_vendor' => 63,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'AMARULLAH',
                'norek' => '1049977642',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 63,
                'id_vendor' => 64,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'ANDI RISKAN',
                'norek' => '1058161086',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 64,
                'id_vendor' => 65,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'ARIPAN YOGA',
                'norek' => '1048745195',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 65,
                'id_vendor' => 66,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'ATI',
                'norek' => '7257317298',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 66,
                'id_vendor' => 67,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'BUSTAMI ARIPIN',
                'norek' => '7285341072',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 67,
                'id_vendor' => 68,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'DEDI HERLIAN PATRA',
                'norek' => '1050227037',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 68,
                'id_vendor' => 69,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'DEDI SYAHPUTRA',
                'norek' => '7241746822',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 69,
                'id_vendor' => 70,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'HARUN',
                'norek' => '7143486642',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 70,
                'id_vendor' => 71,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'INDRA FITRA',
                'norek' => '7215045697',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 71,
                'id_vendor' => 72,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'ISTAYANI',
                'norek' => '7310959566',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 72,
                'id_vendor' => 73,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'JULIANA FITRI',
                'norek' => '1049106827',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 73,
                'id_vendor' => 74,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'KARI',
                'norek' => '7257605838',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 74,
                'id_vendor' => 75,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'MARZUKI AG',
                'norek' => '7225500767',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 75,
                'id_vendor' => 76,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'MAYANG',
                'norek' => '7253932745',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 76,
                'id_vendor' => 77,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'Muhammad Nawir Siregar',
                'norek' => '7147615323',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 77,
                'id_vendor' => 78,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'Muhata Hairy',
                'norek' => '7302112872',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 78,
                'id_vendor' => 79,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'MULIA DARMA',
                'norek' => '7331734335',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 79,
                'id_vendor' => 80,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'MUSDAR',
                'norek' => '7230231731',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 80,
                'id_vendor' => 81,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'NASIRUDIN',
                'norek' => '7225290417',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 81,
                'id_vendor' => 82,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'NURDIN SUFI',
                'norek' => '7166776761',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 82,
                'id_vendor' => 83,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'NURLELA',
                'norek' => '7284486549',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 83,
                'id_vendor' => 84,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'SUPARDI',
                'norek' => '1053026838',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 84,
                'id_vendor' => 85,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'PT. TUSAM HUTAN LESTARI',
                'norek' => '7143403925',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 85,
                'id_vendor' => 86,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'RANTO',
                'norek' => '1055396538',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 86,
                'id_vendor' => 87,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'RAPIUDIN',
                'norek' => '7299505558',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2026-03-31 19:53:20',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 87,
                'id_vendor' => 88,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'Rizky Ariga Setiawan',
                'norek' => '7169834088',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 88,
                'id_vendor' => 89,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'SAHRIL BAHAGIA',
                'norek' => '1056685398',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 89,
                'id_vendor' => 90,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'SAID TARMIZI',
                'norek' => '1060621736',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 90,
                'id_vendor' => 91,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'SALMAN ALFARICI',
                'norek' => '1701202003',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 91,
                'id_vendor' => 92,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'SAMAT',
                'norek' => '1047394798',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 92,
                'id_vendor' => 93,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'SUDIRMAN',
                'norek' => '7273909375',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 93,
                'id_vendor' => 94,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'SUKRI NANDA PUTRA DEWA',
                'norek' => '7164.8582.72',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 94,
                'id_vendor' => 95,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'SYAFRI AMIN',
                'norek' => '7256388825',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 95,
                'id_vendor' => 96,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'Syali Indra, S.Sos. I',
                'norek' => '1050352672',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 96,
                'id_vendor' => 97,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'ZAKARIA',
                'norek' => '7208366275',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 97,
                'id_vendor' => 98,
                'nama_bank' => 'CCB INDONESIA',
                'nama_penerima' => 'LOUIS GUNAWAN',
                'norek' => '2005299888',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 98,
                'id_vendor' => 100,
                'nama_bank' => 'HSBC',
                'nama_penerima' => 'PT NUSA JAWARA LOGISTIK',
                'norek' => '008027344068',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 99,
                'id_vendor' => 101,
                'nama_bank' => 'JPMORGAN CHASE',
                'nama_penerima' => 'PT. TRANSLINER MARITIME INDONESIA',
                'norek' => '6650010884',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 100,
                'id_vendor' => 102,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'ZAENAL ABIDIN',
                'norek' => '1390029579137',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 101,
                'id_vendor' => 103,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'CV. TIKA SUMATERA GROUP',
                'norek' => '1060018634256',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 102,
                'id_vendor' => 104,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT ENERSIA PERMATA ABADI',
                'norek' => '1050038989889',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 103,
                'id_vendor' => 105,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT EVERGREEN  LOGISTICS  INDONESIA',
                'norek' => '1240010284116',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 104,
                'id_vendor' => 106,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT. INHUTANI I',
                'norek' => '1260001126126',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 105,
                'id_vendor' => 107,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT. EKSPLOITASI DAN INDUSTRI HUTAN V',
                'norek' => '1020097524802',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 106,
                'id_vendor' => 108,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'KRISTANTI PUJIASTUTI',
                'norek' => '1050019236300',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 107,
                'id_vendor' => 109,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'LIMIN',
                'norek' => '1060088200178',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 108,
                'id_vendor' => 110,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT MERSEA MITRA ABADI',
                'norek' => '1250015394810',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 109,
                'id_vendor' => 111,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT. BAHARI CAHAYA RAYA INDONESIA',
                'norek' => '1150008987770',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 110,
                'id_vendor' => 112,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT.KARGO LOGISTIK INDONESIA',
                'norek' => '1250013881818',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 111,
                'id_vendor' => 113,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT. POLIMIKRO BERDIKARI NUSANTARA',
                'norek' => '1380021889147',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 112,
                'id_vendor' => 114,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'HARRYANTO TJOPUTERA',
                'norek' => '1510005259954',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 113,
                'id_vendor' => 115,
                'nama_bank' => 'Mandiri',
                'nama_penerima' => 'PT Sae Prima Abadi',
                'norek' => '1380027262752',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 114,
                'id_vendor' => 116,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'LABYBAH',
                'norek' => '693814947356',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 115,
                'id_vendor' => 117,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'NEELESH R MAHESHWARI',
                'norek' => '020810381937',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 116,
                'id_vendor' => 118,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'PT ROSIN TRADING INTERNATIONAL',
                'norek' => '180800057473',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 117,
                'id_vendor' => 119,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'PT. RAKYAT ACEH MAKMUR',
                'norek' => '020800020354',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 118,
                'id_vendor' => 120,
                'nama_bank' => 'OCBC NISP',
                'nama_penerima' => 'PT MONTER GLOBAL INDONESIA',
                'norek' => '024800026221',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 119,
                'id_vendor' => 121,
                'nama_bank' => 'OCBC NISP',
                'nama_penerima' => 'PT RTW GLOBAL SUPPLY CHAIN INDONESIA',
                'norek' => '023800007678',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 120,
                'id_vendor' => 122,
                'nama_bank' => 'OCBC NISP',
                'nama_penerima' => 'PT. MITRA BINTANG SAMUDERA',
                'norek' => '180800027989',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 121,
                'id_vendor' => 123,
                'nama_bank' => 'OCBC NISP',
                'nama_penerima' => 'PT. TIZ SHIPPING INDONESIA',
                'norek' => '180800036352',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 122,
                'id_vendor' => 124,
                'nama_bank' => 'OCBC NISP',
                'nama_penerima' => 'PT. TRANSWORLD GLS INDONESIA',
                'norek' => '024810086637',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 123,
                'id_vendor' => 125,
                'nama_bank' => 'SEA BANK',
                'nama_penerima' => 'SAMSUL BAHRI',
                'norek' => '901034591220',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 125,
                'id_vendor' => 127,
                'nama_bank' => 'SOUTHEAST BANK PLC',
                'nama_penerima' => 'S. A. INTERNATIONAL',
                'norek' => '000611100019154',
                'created_at' => '2025-11-20 00:48:24',
                'updated_at' => '2025-11-20 00:48:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 126,
                'id_vendor' => 126,
                'nama_bank' => 'Sinarmas',
                'nama_penerima' => 'ASM QQ PT KRISHNA SUKSES ABADI',
                'norek' => '8005118545005800',
                'created_at' => '2025-11-20 00:48:56',
                'updated_at' => '2025-11-20 00:48:56',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 127,
                'id_vendor' => 126,
                'nama_bank' => 'Sinarmas',
                'nama_penerima' => 'ASM QQ SUMBER BANYU BIRU',
                'norek' => '8005245689340000',
                'created_at' => '2025-11-20 00:48:56',
                'updated_at' => '2025-11-20 00:48:56',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 129,
                'id_vendor' => 133,
                'nama_bank' => 'OCBC NISP',
                'nama_penerima' => 'PT MONTER GLOBAL INDONESIA',
                'norek' => '024800026221',
                'created_at' => '2025-12-02 20:18:48',
                'updated_at' => '2025-12-02 20:18:48',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 130,
                'id_vendor' => 134,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'NENG NURHAYATI',
                'norek' => '020810381408',
                'created_at' => '2025-12-05 02:34:36',
                'updated_at' => '2025-12-05 02:34:36',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 131,
                'id_vendor' => 135,
                'nama_bank' => 'OCBC ',
                'nama_penerima' => 'DEVITA SIANAWATI',
                'norek' => '020810382174',
                'created_at' => '2025-12-07 19:18:17',
                'updated_at' => '2025-12-07 19:18:17',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 132,
                'id_vendor' => 136,
                'nama_bank' => 'OCBC ',
                'nama_penerima' => 'VISHAL R MAHESHWARI',
                'norek' => '020810257699',
                'created_at' => '2025-12-07 20:09:01',
                'updated_at' => '2025-12-07 20:09:01',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 138,
                'id_vendor' => 138,
                'nama_bank' => 'VA BNI / BRI',
                'nama_penerima' => 'BPJS KESEHATAN - KSA',
                'norek' => '8888890001167868',
                'created_at' => '2025-12-07 20:45:33',
                'updated_at' => '2025-12-07 20:45:33',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 139,
                'id_vendor' => 138,
                'nama_bank' => 'VA MDR',
                'nama_penerima' => 'BPJS KESEHATAN - KSA',
                'norek' => '8988890001167868',
                'created_at' => '2025-12-07 20:45:33',
                'updated_at' => '2025-12-07 20:45:33',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 140,
                'id_vendor' => 138,
                'nama_bank' => 'VA BTN ',
                'nama_penerima' => 'BPJS KESEHATAN - KSA',
                'norek' => '888890001167868',
                'created_at' => '2025-12-07 20:45:33',
                'updated_at' => '2025-12-07 20:45:33',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 145,
                'id_vendor' => 140,
                'nama_bank' => 'VA BNI / BRI',
                'nama_penerima' => 'BPJS KESEHATAN - SBB',
                'norek' => '8888890001738950',
                'created_at' => '2025-12-07 20:50:28',
                'updated_at' => '2025-12-07 20:50:28',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 146,
                'id_vendor' => 140,
                'nama_bank' => 'VA MDR',
                'nama_penerima' => 'BPJS KESEHATAN - SBB',
                'norek' => '8988890001738950',
                'created_at' => '2025-12-07 20:50:28',
                'updated_at' => '2025-12-07 20:50:28',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 147,
                'id_vendor' => 140,
                'nama_bank' => 'VA BTN',
                'nama_penerima' => 'BPJS KESEHATAN - SBB',
                'norek' => '8888890001738950 ',
                'created_at' => '2025-12-07 20:50:28',
                'updated_at' => '2025-12-07 20:50:28',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 148,
                'id_vendor' => 144,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'NOVITA',
                'norek' => '1050816997',
                'created_at' => '2025-12-07 23:03:22',
                'updated_at' => '2025-12-07 23:03:22',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 149,
                'id_vendor' => 145,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'RAHMAT SUBAIDI',
                'norek' => '1220007811444',
                'created_at' => '2025-12-07 23:17:13',
                'updated_at' => '2025-12-07 23:17:13',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 150,
                'id_vendor' => 146,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'INDONESIA EXIMBANK',
                'norek' => '138751700013172',
                'created_at' => '2025-12-08 01:03:17',
                'updated_at' => '2025-12-08 01:03:17',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 151,
                'id_vendor' => 146,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'INDONESIA EXIMBANK',
                'norek' => '8848607000131726',
                'created_at' => '2025-12-08 01:03:17',
                'updated_at' => '2025-12-08 01:03:17',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 152,
                'id_vendor' => 147,
                'nama_bank' => 'SEA BANK',
                'nama_penerima' => 'KSA 12345',
                'norek' => '782081295958514',
                'created_at' => '2025-12-08 02:53:18',
                'updated_at' => '2025-12-08 02:53:18',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 153,
                'id_vendor' => 148,
                'nama_bank' => 'SEA BANK',
                'nama_penerima' => 'KSA 1234',
                'norek' => '782087823716542',
                'created_at' => '2025-12-08 02:55:14',
                'updated_at' => '2025-12-08 02:55:14',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 154,
                'id_vendor' => 149,
                'nama_bank' => 'BCA ',
                'nama_penerima' => 'HANANG SETYA WINDO',
                'norek' => '2490277083',
                'created_at' => '2025-12-08 02:57:20',
                'updated_at' => '2025-12-08 02:57:20',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 155,
                'id_vendor' => 150,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'Andi Harianto ',
                'norek' => '020810381457',
                'created_at' => '2025-12-08 18:28:45',
                'updated_at' => '2025-12-08 18:28:45',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 156,
                'id_vendor' => 151,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT NAVAL OVERSEAS',
                'norek' => 'VA 02533122001',
                'created_at' => '2025-12-08 19:15:49',
                'updated_at' => '2025-12-08 19:15:49',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 157,
                'id_vendor' => 152,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'CERIA PERTIWI',
                'norek' => '020810395127',
                'created_at' => '2025-12-09 01:05:05',
                'updated_at' => '2026-03-31 19:06:03',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 158,
                'id_vendor' => 151,
                'nama_bank' => 'VA BCA ',
                'nama_penerima' => 'PPPSRS TAMAN KEMAYORAN CONDOMINIUM',
                'norek' => '02533121806',
                'created_at' => '2025-12-09 02:23:07',
                'updated_at' => '2025-12-09 02:23:07',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 159,
                'id_vendor' => 153,
                'nama_bank' => 'BANK DKI. CAPEM Cikarang',
                'nama_penerima' => 'PT. Asuransi Umum Bumiputera Muda 1967',
                'norek' => '40306005861',
                'created_at' => '2025-12-09 19:02:14',
                'updated_at' => '2025-12-09 19:02:14',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 160,
                'id_vendor' => 154,
                'nama_bank' => 'VA MAY BANK',
                'nama_penerima' => 'PT.SUMBER BANYU BIRU',
                'norek' => '7891050501253209',
                'created_at' => '2025-12-09 19:58:59',
                'updated_at' => '2025-12-09 19:58:59',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 161,
                'id_vendor' => 155,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'RENDI IRSANDI',
                'norek' => '8370355755',
                'created_at' => '2025-12-09 23:11:45',
                'updated_at' => '2025-12-09 23:11:45',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 162,
                'id_vendor' => 156,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'MUSTAQIM',
                'norek' => '2291795376',
                'created_at' => '2025-12-09 23:16:25',
                'updated_at' => '2025-12-09 23:16:25',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 163,
                'id_vendor' => 157,
                'nama_bank' => 'BNI ',
                'nama_penerima' => 'CV DJAYA BERSAMA ',
                'norek' => '0214596168',
                'created_at' => '2025-12-09 23:36:13',
                'updated_at' => '2025-12-09 23:36:13',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 164,
                'id_vendor' => 151,
                'nama_bank' => 'BCA ',
                'nama_penerima' => 'PPPSRS TAMAN KEMAYORAN C ',
                'norek' => '3350186777',
                'created_at' => '2025-12-10 00:04:31',
                'updated_at' => '2025-12-10 00:04:31',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 165,
                'id_vendor' => 158,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. FREIGHT LINER MEDAN',
                'norek' => '7850289991',
                'created_at' => '2025-12-10 00:45:32',
                'updated_at' => '2025-12-10 00:45:32',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 166,
                'id_vendor' => 159,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'SUWARDAI',
                'norek' => '369101011385538',
                'created_at' => '2025-12-10 21:51:32',
                'updated_at' => '2025-12-10 21:51:32',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 167,
                'id_vendor' => 160,
                'nama_bank' => '',
                'nama_penerima' => 'DJBC',
                'norek' => '640251203684317',
                'created_at' => '2025-12-10 22:01:30',
                'updated_at' => '2025-12-10 22:01:30',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 168,
                'id_vendor' => 161,
                'nama_bank' => 'OCBC ',
                'nama_penerima' => 'PARASH PRITANDAS JATIANI',
                'norek' => '020810382034',
                'created_at' => '2025-12-10 23:11:53',
                'updated_at' => '2025-12-10 23:11:53',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 169,
                'id_vendor' => 162,
                'nama_bank' => 'MANDIRI KCP SEMARANG NGALIYAN ',
                'nama_penerima' => 'PT. KIBAR RAYA LOGISTIK',
                'norek' => '136-00-1886889-0',
                'created_at' => '2025-12-10 23:40:36',
                'updated_at' => '2025-12-10 23:40:36',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 170,
                'id_vendor' => 163,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. GPI LOGISTICS',
                'norek' => '5350198115',
                'created_at' => '2025-12-11 01:58:43',
                'updated_at' => '2025-12-11 01:58:43',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 171,
                'id_vendor' => 164,
                'nama_bank' => 'CITIBANK ',
                'nama_penerima' => 'PT FedEx Express International',
                'norek' => '8868886871997455',
                'created_at' => '2025-12-11 19:47:05',
                'updated_at' => '2025-12-11 19:47:05',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 172,
                'id_vendor' => 165,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'HUSNI SUNASLI ',
                'norek' => '1950459529',
                'created_at' => '2025-12-11 23:19:23',
                'updated_at' => '2025-12-11 23:19:23',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 173,
                'id_vendor' => 167,
                'nama_bank' => 'PT. BANK SYARIAH INDONESIA',
                'nama_penerima' => 'PT. KRISNA SUKSES ABADI',
                'norek' => '7885788887',
                'created_at' => '2025-12-14 20:16:56',
                'updated_at' => '2025-12-14 20:16:56',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 174,
                'id_vendor' => 168,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'SAHUDIN AMRI',
                'norek' => '7208230357',
                'created_at' => '2025-12-15 00:30:37',
                'updated_at' => '2026-03-24 20:30:42',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 175,
                'id_vendor' => 169,
                'nama_bank' => 'BCA ',
                'nama_penerima' => 'CV TEMAN BAIK ',
                'norek' => '6930310105',
                'created_at' => '2025-12-15 00:31:47',
                'updated_at' => '2025-12-15 00:31:47',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 176,
                'id_vendor' => 170,
                'nama_bank' => 'BCA ',
                'nama_penerima' => 'PT. KENKO ELEKTRIK INDONESIA',
                'norek' => '02777738000',
                'created_at' => '2025-12-15 02:27:21',
                'updated_at' => '2025-12-15 02:27:21',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 177,
                'id_vendor' => 171,
                'nama_bank' => 'bca',
                'nama_penerima' => 'yeny fahriani',
                'norek' => '4281482429',
                'created_at' => '2025-12-15 18:30:41',
                'updated_at' => '2025-12-15 18:30:41',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 178,
                'id_vendor' => 172,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'PT. EMB MERKUSI CHEMICALS',
                'norek' => '006801003011307',
                'created_at' => '2025-12-15 19:34:30',
                'updated_at' => '2025-12-15 19:34:30',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 179,
                'id_vendor' => 173,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'LIE CEN WONG',
                'norek' => '6930148081',
                'created_at' => '2025-12-15 19:48:38',
                'updated_at' => '2025-12-15 19:48:38',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 180,
                'id_vendor' => 174,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'SIDDHANTH NEELESH MAHESHWARI',
                'norek' => '020810361822',
                'created_at' => '2025-12-15 20:20:27',
                'updated_at' => '2026-03-31 19:36:41',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 181,
                'id_vendor' => 175,
                'nama_bank' => 'BRI ',
                'nama_penerima' => 'PT WIGASANTANA INVESTAMA',
                'norek' => '6801003096307',
                'created_at' => '2025-12-15 20:42:21',
                'updated_at' => '2025-12-15 20:42:21',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 182,
                'id_vendor' => 176,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'SOHIDIN',
                'norek' => '020810381622',
                'created_at' => '2025-12-15 21:15:55',
                'updated_at' => '2025-12-15 21:15:55',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 183,
                'id_vendor' => 177,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'ERNI NOVIANI',
                'norek' => '020810414068',
                'created_at' => '2025-12-15 21:28:38',
                'updated_at' => '2025-12-15 21:28:38',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 184,
                'id_vendor' => 178,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'SUPARDI',
                'norek' => '5530067086',
                'created_at' => '2025-12-15 21:31:02',
                'updated_at' => '2025-12-15 21:31:02',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 185,
                'id_vendor' => 179,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'NURAINI TRIHASTUTI',
                'norek' => '020810382190',
                'created_at' => '2025-12-15 21:32:55',
                'updated_at' => '2025-12-15 21:32:55',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 186,
                'id_vendor' => 180,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'MOHAMAD NASIR',
                'norek' => '1290002254429',
                'created_at' => '2025-12-16 00:31:28',
                'updated_at' => '2025-12-16 00:31:28',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 187,
                'id_vendor' => 181,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'AHMAD MUSTOFA',
                'norek' => '1150010440628',
                'created_at' => '2025-12-16 00:34:06',
                'updated_at' => '2025-12-16 00:34:06',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 188,
                'id_vendor' => 182,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'NUR HIDAYAH ',
                'norek' => '3820062328',
                'created_at' => '2025-12-16 19:31:48',
                'updated_at' => '2025-12-16 19:31:48',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 189,
                'id_vendor' => 183,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'ENI MARLINA',
                'norek' => '2110559898',
                'created_at' => '2025-12-16 19:47:28',
                'updated_at' => '2025-12-16 19:47:28',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 190,
                'id_vendor' => 184,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'GUSNUR HASAN',
                'norek' => '4240453458',
                'created_at' => '2025-12-16 20:23:52',
                'updated_at' => '2025-12-16 20:23:52',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 191,
                'id_vendor' => 185,
                'nama_bank' => 'PT BANK SYARIAH INDONESIA',
                'nama_penerima' => 'KRISHNA SUKSES ABADI BATANG',
                'norek' => '7885788787',
                'created_at' => '2025-12-17 00:12:21',
                'updated_at' => '2025-12-17 00:12:21',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 192,
                'id_vendor' => 186,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'BONADI',
                'norek' => '017701030392501',
                'created_at' => '2025-12-17 18:29:44',
                'updated_at' => '2025-12-17 18:29:44',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 193,
                'id_vendor' => 187,
                'nama_bank' => 'CHINA ZHESHANG BANK ',
                'nama_penerima' => 'HENAN EME TECHNOLOGY., LTD ',
                'norek' => '4910000011420100035858',
                'created_at' => '2025-12-17 18:37:44',
                'updated_at' => '2025-12-17 18:37:44',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 194,
                'id_vendor' => 188,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'YASHVI NEELESH MAHESHWARI',
                'norek' => '020810381895',
                'created_at' => '2025-12-17 19:17:36',
                'updated_at' => '2025-12-17 19:17:36',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 195,
                'id_vendor' => 190,
                'nama_bank' => 'OCBC VA ',
                'nama_penerima' => 'PT. KRISHNA SUKSES ABADI',
                'norek' => '083831058882',
                'created_at' => '2025-12-18 19:52:32',
                'updated_at' => '2025-12-18 19:52:32',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 196,
                'id_vendor' => 191,
                'nama_bank' => 'BCA ',
                'nama_penerima' => 'MEYLIA CHANDRA ',
                'norek' => '7795809988',
                'created_at' => '2025-12-18 20:16:01',
                'updated_at' => '2025-12-18 20:16:01',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 197,
                'id_vendor' => 192,
                'nama_bank' => 'Mandiri',
                'nama_penerima' => 'Dian Anindita',
                'norek' => '1510015972109',
                'created_at' => '2025-12-21 20:34:59',
                'updated_at' => '2025-12-21 20:34:59',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 198,
                'id_vendor' => 84,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'SUPARDI',
                'norek' => '1168123015',
                'created_at' => '2025-12-22 01:43:14',
                'updated_at' => '2025-12-22 01:43:14',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 199,
                'id_vendor' => 194,
                'nama_bank' => 'BANK CENTRAL ASIA (BCA)',
                'nama_penerima' => 'RICO YUSFANA',
                'norek' => '8715013009',
                'created_at' => '2025-12-22 19:24:19',
                'updated_at' => '2025-12-22 19:24:19',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 200,
                'id_vendor' => 193,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'CV JATI WAYANG',
                'norek' => '604901030472532',
                'created_at' => '2025-12-22 23:22:18',
                'updated_at' => '2025-12-22 23:22:18',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 201,
                'id_vendor' => 195,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'Tiwi Handayani',
                'norek' => '020810414332',
                'created_at' => '2025-12-22 23:44:57',
                'updated_at' => '2025-12-22 23:44:57',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 202,
                'id_vendor' => 200,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'SCURE PAR-SPI ALBP STICKER',
                'norek' => '00674064102',
                'created_at' => '2025-12-23 20:52:29',
                'updated_at' => '2025-12-23 20:52:29',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 204,
                'id_vendor' => 202,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT. TRANSLINK GLOBAL SERVICES',
                'norek' => '0060007177714',
                'created_at' => '2025-12-24 01:28:06',
                'updated_at' => '2025-12-24 01:28:06',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 205,
                'id_vendor' => 203,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'ROBENT PHANARDI',
                'norek' => '8305051230',
                'created_at' => '2025-12-28 19:15:40',
                'updated_at' => '2025-12-28 19:15:40',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 206,
                'id_vendor' => 204,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. MITRA MULTI MENTARI',
                'norek' => '8195259999',
                'created_at' => '2025-12-28 23:47:56',
                'updated_at' => '2025-12-28 23:47:56',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 207,
                'id_vendor' => 205,
                'nama_bank' => 'BANK OCBC ',
                'nama_penerima' => 'PT SUMBER BANYU BIRU ',
                'norek' => '020800020487',
                'created_at' => '2025-12-29 00:46:33',
                'updated_at' => '2025-12-29 00:46:33',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 208,
                'id_vendor' => 206,
                'nama_bank' => 'BANK OCBC ',
                'nama_penerima' => 'PT KRISHNA SUKSES ABADI',
                'norek' => '020800004937',
                'created_at' => '2025-12-29 00:48:53',
                'updated_at' => '2025-12-29 00:48:53',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 209,
                'id_vendor' => 207,
                'nama_bank' => 'BANK OCBC ',
                'nama_penerima' => 'PT NAVAL OVERSEAS ',
                'norek' => '020800007476',
                'created_at' => '2025-12-29 00:55:12',
                'updated_at' => '2025-12-29 00:55:12',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 210,
                'id_vendor' => 208,
                'nama_bank' => 'BANK OCBC NISP',
                'nama_penerima' => 'NEELESH MAHESHWARI RAMESHCHANDRA',
                'norek' => '020810381937',
                'created_at' => '2025-12-29 01:11:48',
                'updated_at' => '2025-12-29 01:11:48',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 211,
                'id_vendor' => 209,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. PERINTIS TIMBANGAN INDONESIA',
                'norek' => '383 1391 616',
                'created_at' => '2025-12-29 02:15:44',
                'updated_at' => '2025-12-29 02:15:44',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 212,
                'id_vendor' => 209,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. PERINTIS TIMBANGAN INDONESIA',
                'norek' => '3831391616',
                'created_at' => '2025-12-29 02:16:30',
                'updated_at' => '2025-12-29 02:16:30',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 213,
                'id_vendor' => 211,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'SLAMET ASROFI',
                'norek' => '621701001678534',
                'created_at' => '2025-12-29 21:25:17',
                'updated_at' => '2025-12-29 21:25:17',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 214,
                'id_vendor' => 212,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'EKO NUGROHO',
                'norek' => '015601018932503',
                'created_at' => '2025-12-30 01:28:18',
                'updated_at' => '2025-12-30 01:28:18',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 215,
                'id_vendor' => 213,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'YUDI HARTADI',
                'norek' => '346801027677536',
                'created_at' => '2026-01-01 18:54:19',
                'updated_at' => '2026-01-01 18:54:19',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 216,
                'id_vendor' => 214,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'SUPARDI',
                'norek' => '5530067086',
                'created_at' => '2026-01-01 20:31:53',
                'updated_at' => '2026-01-01 20:31:53',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 217,
                'id_vendor' => 215,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'FAJRI YADI',
                'norek' => '565901016171530',
                'created_at' => '2026-01-02 00:04:46',
                'updated_at' => '2026-01-02 00:04:46',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 218,
                'id_vendor' => 216,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'Adetia Arip Pribowo',
                'norek' => '2302655252',
                'created_at' => '2026-01-02 01:22:10',
                'updated_at' => '2026-01-02 01:22:10',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 219,
                'id_vendor' => 217,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'KHUSNAWATI',
                'norek' => '020810393650',
                'created_at' => '2026-01-02 02:01:43',
                'updated_at' => '2026-01-02 02:01:43',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 220,
                'id_vendor' => 218,
                'nama_bank' => 'PANIN BANK',
                'nama_penerima' => 'PT. INTI AUTO MEGAH',
                'norek' => '500.500.7829',
                'created_at' => '2026-01-02 21:22:51',
                'updated_at' => '2026-01-02 21:22:51',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 221,
                'id_vendor' => 219,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'muhammad arsyad a',
                'norek' => '6640477677',
                'created_at' => '2026-01-04 21:39:40',
                'updated_at' => '2026-01-04 21:39:40',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 222,
                'id_vendor' => 220,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT KRISHNA SUKSES ABADI',
                'norek' => 'VA 00085.01556935',
                'created_at' => '2026-01-04 23:41:09',
                'updated_at' => '2026-01-04 23:41:09',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 223,
                'id_vendor' => 221,
                'nama_bank' => 'Mandiri',
                'nama_penerima' => 'Zulkifli',
                'norek' => '1120013089920',
                'created_at' => '2026-01-05 19:13:31',
                'updated_at' => '2026-01-05 19:13:31',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 224,
                'id_vendor' => 222,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'Roy Gita Saputra',
                'norek' => '7335091086',
                'created_at' => '2026-01-05 19:14:09',
                'updated_at' => '2026-01-05 19:14:09',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 225,
                'id_vendor' => 223,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'SUPARNO',
                'norek' => '374701032046538',
                'created_at' => '2026-01-05 19:25:54',
                'updated_at' => '2026-01-05 19:25:54',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 226,
                'id_vendor' => 224,
                'nama_bank' => 'Sumitomo Mitsui Banking Corporation',
                'nama_penerima' => 'HARIMA CHEMICALS INC',
                'norek' => '2018832',
                'created_at' => '2026-01-05 23:20:37',
                'updated_at' => '2026-01-05 23:20:37',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 227,
                'id_vendor' => 225,
                'nama_bank' => ' BCA',
                'nama_penerima' => 'PT. ABDITAMA GRAHA INTERNUSA',
                'norek' => '6930343534',
                'created_at' => '2026-01-05 23:32:14',
                'updated_at' => '2026-01-05 23:32:14',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 228,
                'id_vendor' => 226,
                'nama_bank' => 'BCA KCP GRAHA KIRANA',
                'nama_penerima' => 'PT BONAFIDE PRATAMA',
                'norek' => '6380372299',
                'created_at' => '2026-01-06 01:00:17',
                'updated_at' => '2026-01-06 01:00:17',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 229,
                'id_vendor' => 227,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. ALOHA LOGISTIK SUKSES ',
                'norek' => '1683771639',
                'created_at' => '2026-01-06 01:32:42',
                'updated_at' => '2026-01-06 01:32:42',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 230,
                'id_vendor' => 228,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'MARYANTI',
                'norek' => '4280131691',
                'created_at' => '2026-01-06 19:20:20',
                'updated_at' => '2026-01-06 19:20:20',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 231,
                'id_vendor' => 229,
                'nama_bank' => 'BCA VA ',
                'nama_penerima' => 'Zarqa Nurkhalishah',
                'norek' => '39358 089508017643',
                'created_at' => '2026-01-06 21:39:48',
                'updated_at' => '2026-01-06 21:39:48',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 232,
                'id_vendor' => 230,
                'nama_bank' => 'BNI',
                'nama_penerima' => 'IRWAN',
                'norek' => '1793332978',
                'created_at' => '2026-01-06 23:10:05',
                'updated_at' => '2026-01-06 23:10:05',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 233,
                'id_vendor' => 231,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'SRI HATIN',
                'norek' => '020810397750',
                'created_at' => '2026-01-07 18:33:53',
                'updated_at' => '2026-01-07 18:33:53',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 234,
                'id_vendor' => 232,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT INDO AKSES CIPTA PRATAMA',
                'norek' => 'VA 53162000257386',
                'created_at' => '2026-01-07 18:42:20',
                'updated_at' => '2026-01-07 18:42:20',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 235,
                'id_vendor' => 233,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'NI MADE DIAH CAHNIANTI',
                'norek' => '1450017151883',
                'created_at' => '2026-01-07 19:56:01',
                'updated_at' => '2026-01-07 19:56:01',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 236,
                'id_vendor' => 234,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'NEELESH RAMESHCHANDRA MAHESHWARI',
                'norek' => 'VA 02533212301',
                'created_at' => '2026-01-07 19:58:47',
                'updated_at' => '2026-01-07 19:58:47',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 237,
                'id_vendor' => 235,
                'nama_bank' => 'MAYAPADA',
                'nama_penerima' => 'PT KRISHNA SUKSES ABADI',
                'norek' => 'VA 1028-001-459022114',
                'created_at' => '2026-01-07 20:41:44',
                'updated_at' => '2026-01-07 20:41:44',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 238,
                'id_vendor' => 236,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'HERU ANDRIAN',
                'norek' => '020810421618',
                'created_at' => '2026-01-07 22:54:19',
                'updated_at' => '2026-01-07 22:54:19',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 239,
                'id_vendor' => 237,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'SUKIMAN',
                'norek' => '021101042874503',
                'created_at' => '2026-01-08 00:07:26',
                'updated_at' => '2026-01-08 00:07:26',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 240,
                'id_vendor' => 238,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'MUHAMAD ANTONI',
                'norek' => '7420216861',
                'created_at' => '2026-01-09 01:04:22',
                'updated_at' => '2026-01-09 01:04:22',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 241,
                'id_vendor' => 239,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'KHUSNAWATI',
                'norek' => '020810393650',
                'created_at' => '2026-01-09 04:11:19',
                'updated_at' => '2026-01-09 04:11:19',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 242,
                'id_vendor' => 240,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'NURAINI TRIHASTUTI',
                'norek' => '020810382190',
                'created_at' => '2026-01-09 04:12:51',
                'updated_at' => '2026-01-09 04:12:51',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 243,
                'id_vendor' => 241,
                'nama_bank' => 'BCA KCP KHM MANSYUR',
                'nama_penerima' => 'PT OASIS WATERS INTERNATIONAL',
                'norek' => '1793025151',
                'created_at' => '2026-01-12 00:09:31',
                'updated_at' => '2026-01-12 00:09:31',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 244,
                'id_vendor' => 242,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'SUMARMO',
                'norek' => '1360031064212',
                'created_at' => '2026-01-12 02:53:27',
                'updated_at' => '2026-01-12 02:53:27',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 245,
                'id_vendor' => 243,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'IBRAHIM  CHANDRA',
                'norek' => '8280101398',
                'created_at' => '2026-01-13 19:21:15',
                'updated_at' => '2026-01-13 19:21:15',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 246,
                'id_vendor' => 244,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'KAMIJA IR, M.SI',
                'norek' => '020810393692',
                'created_at' => '2026-01-13 19:41:52',
                'updated_at' => '2026-01-13 19:41:52',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 247,
                'id_vendor' => 245,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT UNION TETAP JAYA',
                'norek' => '7860978088',
                'created_at' => '2026-01-13 19:44:07',
                'updated_at' => '2026-01-13 19:44:07',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 248,
                'id_vendor' => 246,
                'nama_bank' => 'PERMATA ',
                'nama_penerima' => 'PT KRISHNA SUKSES ABADI',
                'norek' => '8944102600000079',
                'created_at' => '2026-01-14 00:16:58',
                'updated_at' => '2026-01-14 00:16:58',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 249,
                'id_vendor' => 247,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT EKSPLOITASI DAN INDUSTRI HUTAN V ',
                'norek' => '1020097524802',
                'created_at' => '2026-01-14 01:26:33',
                'updated_at' => '2026-01-14 01:26:33',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 250,
                'id_vendor' => 248,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'SEPTIADI ERLANGGA',
                'norek' => '7335003900',
                'created_at' => '2026-01-14 19:03:49',
                'updated_at' => '2026-01-14 19:03:49',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 251,
                'id_vendor' => 249,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'GANDA NAINGGOLAN',
                'norek' => '5885120919',
                'created_at' => '2026-01-14 23:24:05',
                'updated_at' => '2026-01-14 23:24:05',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 252,
                'id_vendor' => 249,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'ANAND',
                'norek' => '189810073834',
                'created_at' => '2026-01-14 23:26:35',
                'updated_at' => '2026-01-14 23:26:35',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 253,
                'id_vendor' => 250,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. BILAH BAJA MAKMUR ABADI ',
                'norek' => '0223210101',
                'created_at' => '2026-01-15 01:07:33',
                'updated_at' => '2026-01-15 01:07:33',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 254,
                'id_vendor' => 251,
                'nama_bank' => 'BNI',
                'nama_penerima' => 'ISSEF TINARRIYADI ',
                'norek' => '1209920718',
                'created_at' => '2026-01-18 21:28:58',
                'updated_at' => '2026-01-18 21:28:58',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 255,
                'id_vendor' => 252,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'RENDI IRSANDI',
                'norek' => '8370355755',
                'created_at' => '2026-01-18 21:46:23',
                'updated_at' => '2026-01-18 21:46:23',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 256,
                'id_vendor' => 253,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. BERSAMA KITA SATU ',
                'norek' => '1060111118',
                'created_at' => '2026-01-19 00:46:10',
                'updated_at' => '2026-01-19 00:46:10',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 257,
                'id_vendor' => 254,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'Usman',
                'norek' => '7258411468',
                'created_at' => '2026-01-19 20:27:16',
                'updated_at' => '2026-01-19 20:27:16',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 258,
                'id_vendor' => 255,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'CV. KARYA JAYA SEJAHTERA',
                'norek' => '8195271999',
                'created_at' => '2026-01-19 21:09:35',
                'updated_at' => '2026-01-19 21:09:35',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 259,
                'id_vendor' => 256,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'INDRA FITRA',
                'norek' => '7295836778',
                'created_at' => '2026-01-20 00:18:29',
                'updated_at' => '2026-01-20 00:18:29',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 260,
                'id_vendor' => 257,
                'nama_bank' => 'BNI',
                'nama_penerima' => 'OKI BAYU SETIAWAN',
                'norek' => '0982932854',
                'created_at' => '2026-01-20 00:48:02',
                'updated_at' => '2026-01-20 00:48:02',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 261,
                'id_vendor' => 258,
                'nama_bank' => 'BCA ',
                'nama_penerima' => 'PT. HAMPER NUSANTARA INDONESIA ',
                'norek' => '6310801877',
                'created_at' => '2026-01-20 20:21:33',
                'updated_at' => '2026-01-20 20:21:33',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 262,
                'id_vendor' => 259,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'RISKON ',
                'norek' => '108801000821560',
                'created_at' => '2026-01-20 23:40:04',
                'updated_at' => '2026-01-20 23:40:04',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 263,
                'id_vendor' => 260,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'DIAN ANINDITA',
                'norek' => '020810439131',
                'created_at' => '2026-01-21 00:38:00',
                'updated_at' => '2026-01-21 00:38:00',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 264,
                'id_vendor' => 236,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'HERU ANDRIAN ',
                'norek' => '7332012805',
                'created_at' => '2026-01-21 21:28:34',
                'updated_at' => '2026-01-21 21:28:34',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 265,
                'id_vendor' => 261,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'Mohamad Shava Aditia Shalih',
                'norek' => '6900688472',
                'created_at' => '2026-01-22 18:26:28',
                'updated_at' => '2026-01-22 18:26:28',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 266,
                'id_vendor' => 262,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'MUSTAKIM',
                'norek' => '368901068761530',
                'created_at' => '2026-01-25 23:07:34',
                'updated_at' => '2026-01-25 23:07:34',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 267,
                'id_vendor' => 263,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'TASNUDIN ',
                'norek' => '7299850905',
                'created_at' => '2026-01-26 19:04:05',
                'updated_at' => '2026-01-26 19:04:05',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 268,
                'id_vendor' => 264,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'M. YUNUS',
                'norek' => '210901006230500',
                'created_at' => '2026-01-26 22:51:30',
                'updated_at' => '2026-01-26 22:51:30',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 269,
                'id_vendor' => 265,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'LELA NURLELA',
                'norek' => '2830385854',
                'created_at' => '2026-01-27 18:13:24',
                'updated_at' => '2026-01-27 18:13:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 270,
                'id_vendor' => 266,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'LUSI RAKHMAWATI',
                'norek' => '020810393627',
                'created_at' => '2026-01-27 20:12:01',
                'updated_at' => '2026-01-27 20:12:01',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 271,
                'id_vendor' => 267,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'FINNET INDONESIA PT ',
                'norek' => '4500322999',
                'created_at' => '2026-01-27 21:41:08',
                'updated_at' => '2026-01-27 21:41:08',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 272,
                'id_vendor' => 268,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'KARI',
                'norek' => '7257605838',
                'created_at' => '2026-01-28 19:15:45',
                'updated_at' => '2026-01-28 19:15:45',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 273,
                'id_vendor' => 269,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'LUSI RAKHMAWATI',
                'norek' => '020810393627 ',
                'created_at' => '2026-01-29 19:55:14',
                'updated_at' => '2026-01-29 19:55:14',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 274,
                'id_vendor' => 270,
                'nama_bank' => 'Bank OCBC ',
                'nama_penerima' => 'Indah Yulianti',
                'norek' => '020810414076',
                'created_at' => '2026-01-29 20:04:16',
                'updated_at' => '2026-01-29 20:04:16',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 275,
                'id_vendor' => 271,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'MUHAMAD ANTONI',
                'norek' => '7420216861',
                'created_at' => '2026-01-30 00:56:36',
                'updated_at' => '2026-01-30 00:56:36',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 276,
                'id_vendor' => 273,
                'nama_bank' => 'BNI',
                'nama_penerima' => 'MUHAMMAD NASIRUDIN',
                'norek' => '1889740683',
                'created_at' => '2026-02-01 23:27:38',
                'updated_at' => '2026-02-01 23:27:38',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 277,
                'id_vendor' => 274,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT.BANGUN REKSA PERKASA',
                'norek' => '2403001678',
                'created_at' => '2026-02-01 23:34:34',
                'updated_at' => '2026-02-01 23:34:34',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 278,
                'id_vendor' => 275,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'PT. DAMASES SEJAHTERA',
                'norek' => '125800000999',
                'created_at' => '2026-02-02 00:57:57',
                'updated_at' => '2026-02-02 00:57:57',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 279,
                'id_vendor' => 276,
                'nama_bank' => 'BCA ',
                'nama_penerima' => 'CV. SINAR JAYA MAKMUR ',
                'norek' => '5300118374',
                'created_at' => '2026-02-02 01:14:51',
                'updated_at' => '2026-02-02 01:14:51',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 280,
                'id_vendor' => 277,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'YUDHA KARYA INDONESIA PT ',
                'norek' => '6380402937',
                'created_at' => '2026-02-02 01:52:42',
                'updated_at' => '2026-02-02 01:52:42',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 281,
                'id_vendor' => 278,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'Teguh Slamet',
                'norek' => '020810381465',
                'created_at' => '2026-02-02 18:24:10',
                'updated_at' => '2026-02-02 18:24:10',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 282,
                'id_vendor' => 279,
                'nama_bank' => 'MANDIRI ',
                'nama_penerima' => 'PT. BECKJORINDO PARYAWEKSANA- LABORATORIUM ',
                'norek' => '1360023340000',
                'created_at' => '2026-02-02 21:26:21',
                'updated_at' => '2026-02-02 21:26:21',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 283,
                'id_vendor' => 280,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'FITRI INDRIYANI',
                'norek' => '5785208720',
                'created_at' => '2026-02-03 00:56:59',
                'updated_at' => '2026-02-03 00:56:59',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 284,
                'id_vendor' => 281,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'ANDI WAHYONO',
                'norek' => '135-0014-20-5676',
                'created_at' => '2026-02-03 01:35:58',
                'updated_at' => '2026-02-03 01:35:58',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 288,
                'id_vendor' => 284,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT Mutiara Mutu Sertifikasi',
                'norek' => '1570024262421',
                'created_at' => '2026-02-03 18:42:57',
                'updated_at' => '2026-02-03 18:42:57',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 289,
                'id_vendor' => 285,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'INGGRID FEBBY ISNAINI SUTARLAN',
                'norek' => '020810429967',
                'created_at' => '2026-02-04 01:35:35',
                'updated_at' => '2026-02-04 01:35:35',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 290,
                'id_vendor' => 55,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'RATNA PUSPAH DEWI',
                'norek' => '1140021850030',
                'created_at' => '2026-02-04 18:18:55',
                'updated_at' => '2026-02-04 18:18:55',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 291,
                'id_vendor' => 286,
                'nama_bank' => 'BANK MEGA',
                'nama_penerima' => 'PT ASURANSI UMUM MEGA',
                'norek' => 'VA8203010000004541',
                'created_at' => '2026-02-04 19:02:13',
                'updated_at' => '2026-02-04 19:02:13',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 292,
                'id_vendor' => 286,
                'nama_bank' => 'BANK MEGA',
                'nama_penerima' => 'PT ASURANSI UMUM MEGA',
                'norek' => '01.074.00.11.22222.2',
                'created_at' => '2026-02-04 19:48:11',
                'updated_at' => '2026-02-04 19:48:11',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 293,
                'id_vendor' => 287,
                'nama_bank' => 'PLN MOBILE',
                'nama_penerima' => 'PT KRISHNA SUKSES ABADI',
                'norek' => 'ID 542103054598',
                'created_at' => '2026-02-05 19:08:48',
                'updated_at' => '2026-02-05 19:08:48',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 294,
                'id_vendor' => 288,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'SHOBHA NANDLAL VASWANI',
                'norek' => '4280544651',
                'created_at' => '2026-02-05 20:04:21',
                'updated_at' => '2026-02-05 20:04:21',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 295,
                'id_vendor' => 289,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'RUDY IRSAN',
                'norek' => '9000010849116',
                'created_at' => '2026-02-05 21:01:13',
                'updated_at' => '2026-02-05 21:01:13',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 296,
                'id_vendor' => 290,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'LI LISHA',
                'norek' => '8705256981',
                'created_at' => '2026-02-08 19:25:21',
                'updated_at' => '2026-02-08 19:25:21',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 297,
                'id_vendor' => 291,
                'nama_bank' => 'SINAR MAS',
                'nama_penerima' => 'ASURANSI SINAR MAS',
                'norek' => 'VA 381650115670725530',
                'created_at' => '2026-02-08 20:35:39',
                'updated_at' => '2026-02-08 20:35:39',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 298,
                'id_vendor' => 292,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT KRISHNA SUKSES ABADI',
                'norek' => '631-0521238',
                'created_at' => '2026-02-08 21:19:48',
                'updated_at' => '2026-02-08 21:19:48',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 299,
                'id_vendor' => 293,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT SUMBER BANYU BIRU',
                'norek' => '631-0523974',
                'created_at' => '2026-02-08 21:23:33',
                'updated_at' => '2026-02-08 21:23:33',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 300,
                'id_vendor' => 294,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'ZUMADIL ARMADI',
                'norek' => '020810426039',
                'created_at' => '2026-02-09 02:22:00',
                'updated_at' => '2026-02-09 02:22:00',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 301,
                'id_vendor' => 296,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'KURNIAWAN',
                'norek' => '1084652426',
                'created_at' => '2026-02-10 00:56:03',
                'updated_at' => '2026-02-10 00:56:03',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 302,
                'id_vendor' => 232,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT INDO AKSES CIPTA PRATAMA',
                'norek' => 'VA 53162000258229',
                'created_at' => '2026-02-10 18:21:18',
                'updated_at' => '2026-02-10 18:21:18',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 303,
                'id_vendor' => 297,
                'nama_bank' => 'BANK DANAMON',
                'nama_penerima' => 'PT. PRIMA BAJA SOLUSINDO ',
                'norek' => '3704738784',
                'created_at' => '2026-02-11 18:30:04',
                'updated_at' => '2026-02-11 18:30:04',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 304,
                'id_vendor' => 298,
                'nama_bank' => 'BNI',
                'nama_penerima' => 'PT CATRA ARJUNA SYAILENDRA',
                'norek' => '2201018777',
                'created_at' => '2026-02-11 19:09:38',
                'updated_at' => '2026-02-11 19:09:38',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 305,
                'id_vendor' => 299,
                'nama_bank' => 'BCA ',
                'nama_penerima' => 'PT. CENTRAL MANDIRI CEMERLANG ',
                'norek' => '3833619280',
                'created_at' => '2026-02-11 20:46:46',
                'updated_at' => '2026-02-11 20:46:46',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 306,
                'id_vendor' => 300,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'CV. MILEY INDUSTRIAL VALVE',
                'norek' => '7860338399',
                'created_at' => '2026-02-12 00:27:06',
                'updated_at' => '2026-02-12 00:27:06',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 307,
                'id_vendor' => 301,
                'nama_bank' => 'BCA KCU KELAPA GADING',
                'nama_penerima' => 'PT TOSHINDO ELEVATOR UTAMA',
                'norek' => '0653008071',
                'created_at' => '2026-02-12 20:20:09',
                'updated_at' => '2026-02-12 20:20:09',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 309,
                'id_vendor' => 303,
                'nama_bank' => 'BANK BCA',
                'nama_penerima' => 'ROSITA ',
                'norek' => '8280787338',
                'created_at' => '2026-02-16 00:28:17',
                'updated_at' => '2026-02-16 00:28:17',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 310,
                'id_vendor' => 304,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PRILANI DINI SEPTIANA Z',
                'norek' => '2761410581',
                'created_at' => '2026-02-17 18:50:17',
                'updated_at' => '2026-02-17 18:50:17',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 311,
                'id_vendor' => 305,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT.ORIENTAL INDAH BALI HOTEL',
                'norek' => '7720999930',
                'created_at' => '2026-02-17 23:31:11',
                'updated_at' => '2026-02-17 23:31:11',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 312,
                'id_vendor' => 306,
                'nama_bank' => 'BANK MANDIRI ',
                'nama_penerima' => 'MASRAWANI HARAHAP',
                'norek' => '1060016599147',
                'created_at' => '2026-02-18 21:33:31',
                'updated_at' => '2026-02-18 21:33:31',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 313,
                'id_vendor' => 307,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'AMAN SANJAY BHARDWAJ ',
                'norek' => '020810388262',
                'created_at' => '2026-02-19 18:50:04',
                'updated_at' => '2026-02-19 18:50:04',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 314,
                'id_vendor' => 308,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'SYAFRI AMIN',
                'norek' => '7256388825',
                'created_at' => '2026-02-19 19:09:40',
                'updated_at' => '2026-02-19 19:09:40',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 315,
                'id_vendor' => 299,
                'nama_bank' => 'BCA ',
                'nama_penerima' => 'PT. CENTRAL MANDIRI CEMERLANG ',
                'norek' => '3833619230',
                'created_at' => '2026-02-19 19:16:23',
                'updated_at' => '2026-02-19 19:16:23',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 316,
                'id_vendor' => 309,
                'nama_bank' => 'Nova Ljubljanska banka d.d., Ljubljana',
                'nama_penerima' => 'CargoX d.o.o. ',
                'norek' => 'SI56 0292 3026 6189 092 ',
                'created_at' => '2026-02-19 23:52:04',
                'updated_at' => '2026-02-19 23:52:04',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 317,
                'id_vendor' => 310,
                'nama_bank' => 'CIMB Niaga',
                'nama_penerima' => 'PT Grab Teknologi Indonesia',
                'norek' => '805003333600',
                'created_at' => '2026-02-20 00:56:12',
                'updated_at' => '2026-02-20 00:56:12',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 318,
                'id_vendor' => 311,
                'nama_bank' => 'BNI',
                'nama_penerima' => 'SUBCHAN',
                'norek' => '1334285808',
                'created_at' => '2026-02-22 18:08:27',
                'updated_at' => '2026-02-22 18:08:27',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 319,
                'id_vendor' => 312,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'CV.TUKANG BERSIH INDONESIA',
                'norek' => '3074088088',
                'created_at' => '2026-02-23 23:08:02',
                'updated_at' => '2026-02-23 23:08:02',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 320,
                'id_vendor' => 313,
                'nama_bank' => 'BCA ',
                'nama_penerima' => 'SOLUSIUTAMA TEKNO BROKER ',
                'norek' => '5455120311',
                'created_at' => '2026-02-24 19:35:30',
                'updated_at' => '2026-02-24 19:35:30',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 321,
                'id_vendor' => 313,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'SOLUSIUTAMA TEKNO BROKER',
                'norek' => '1020009722486',
                'created_at' => '2026-02-24 19:35:30',
                'updated_at' => '2026-02-24 19:35:30',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 322,
                'id_vendor' => 314,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'RIZKY SCORPIO TANUR',
                'norek' => '2841134500',
                'created_at' => '2026-02-24 23:58:34',
                'updated_at' => '2026-02-24 23:58:34',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 323,
                'id_vendor' => 315,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'IRVANSYAH ARIEF PRADANA',
                'norek' => '020810440394',
                'created_at' => '2026-02-25 19:11:49',
                'updated_at' => '2026-02-25 19:11:49',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 324,
                'id_vendor' => 314,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'CV BMW MIRACLE AUTOPART',
                'norek' => '2846919888',
                'created_at' => '2026-02-25 19:27:13',
                'updated_at' => '2026-02-25 19:27:13',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 325,
                'id_vendor' => 316,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. FUTURA ASIA CAHAYA ',
                'norek' => '5425207625',
                'created_at' => '2026-02-25 21:56:29',
                'updated_at' => '2026-02-25 21:56:29',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 326,
                'id_vendor' => 317,
                'nama_bank' => 'OCBC ',
                'nama_penerima' => 'PT. SMART LAB INDONESIA ',
                'norek' => '136800009955',
                'created_at' => '2026-02-26 20:04:49',
                'updated_at' => '2026-02-26 20:04:49',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 327,
                'id_vendor' => 318,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT.MAXCHAT INOVASI INDONESIA',
                'norek' => '1440027090908',
                'created_at' => '2026-02-26 23:02:18',
                'updated_at' => '2026-02-26 23:02:18',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 328,
                'id_vendor' => 319,
                'nama_bank' => 'SEABANK ',
                'nama_penerima' => 'FAISAL ABDUL BASIT ',
                'norek' => '901783106420',
                'created_at' => '2026-03-01 18:33:26',
                'updated_at' => '2026-03-01 18:33:26',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 329,
                'id_vendor' => 315,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'IRVANSYAH ARIEF PRADABA',
                'norek' => '020810440394',
                'created_at' => '2026-03-02 07:13:13',
                'updated_at' => '2026-03-02 07:13:13',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 330,
                'id_vendor' => 320,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'ERVINA MAYA DWIASIH',
                'norek' => '6815125812',
                'created_at' => '2026-03-02 20:01:24',
                'updated_at' => '2026-03-02 20:01:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 331,
                'id_vendor' => 321,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'FEST INTERNATIONAL INDONESIA, PT',
                'norek' => '7165767667',
                'created_at' => '2026-03-02 21:09:24',
                'updated_at' => '2026-03-02 21:09:24',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 332,
                'id_vendor' => 322,
                'nama_bank' => 'BCA',
                'nama_penerima' => ' PT. Mid Solusi Nusantara',
                'norek' => '4788888811',
                'created_at' => '2026-03-02 22:40:19',
                'updated_at' => '2026-03-02 22:40:19',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 333,
                'id_vendor' => 323,
                'nama_bank' => 'SINARMAS ',
                'nama_penerima' => 'CMIA QQ PT KRISHNA SUKSES ABADI',
                'norek' => '893488042148',
                'created_at' => '2026-03-02 23:06:52',
                'updated_at' => '2026-03-02 23:06:52',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 334,
                'id_vendor' => 324,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'YAY BEACON EDUCATION',
                'norek' => '4193026403',
                'created_at' => '2026-03-03 18:31:41',
                'updated_at' => '2026-03-03 18:31:41',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 335,
                'id_vendor' => 325,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'SONNY NAREL PRATAMA',
                'norek' => '4830464218',
                'created_at' => '2026-03-03 18:46:15',
                'updated_at' => '2026-03-03 18:46:15',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 336,
                'id_vendor' => 326,
                'nama_bank' => 'Bank Mandiri',
                'nama_penerima' => 'KJPP MBPRU dan REKAN',
                'norek' => '1270005448103',
                'created_at' => '2026-03-03 20:48:31',
                'updated_at' => '2026-03-03 20:48:31',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 337,
                'id_vendor' => 327,
                'nama_bank' => 'THE INDUSTIAL AND COMMERCIAL BANK OF CHINA , HENAN PROVINCE BRANCH',
                'nama_penerima' => 'SWIFT NO : ICBKCNBJHEN',
                'norek' => '1712021509814000193',
                'created_at' => '2026-03-03 21:08:45',
                'updated_at' => '2026-03-03 21:08:45',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 338,
                'id_vendor' => 328,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'AURILIA THEODORA',
                'norek' => '4850227123',
                'created_at' => '2026-03-04 01:21:58',
                'updated_at' => '2026-03-04 01:21:58',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 339,
                'id_vendor' => 329,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'ADE AHMAD KHAERUDIN',
                'norek' => '7540338081',
                'created_at' => '2026-03-04 20:06:46',
                'updated_at' => '2026-03-04 20:06:46',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 340,
                'id_vendor' => 330,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'LEONARDY KEOSUMA',
                'norek' => '1270057469',
                'created_at' => '2026-03-04 20:22:19',
                'updated_at' => '2026-03-04 20:22:19',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 341,
                'id_vendor' => 330,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'LEONARDY KOESUMA',
                'norek' => '1270057469',
                'created_at' => '2026-03-04 20:24:42',
                'updated_at' => '2026-03-04 20:24:42',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 342,
                'id_vendor' => 232,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT INDO AKSES CIPTA PRATAMA',
                'norek' => '5820136839',
                'created_at' => '2026-03-05 20:08:04',
                'updated_at' => '2026-03-05 20:08:04',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 343,
                'id_vendor' => 331,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'KRISTIAWAN SANTOSO',
                'norek' => '020810414043',
                'created_at' => '2026-03-08 18:54:01',
                'updated_at' => '2026-03-08 18:54:01',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 344,
                'id_vendor' => 246,
                'nama_bank' => 'PERMATA ',
                'nama_penerima' => 'PT KRISHNA SUKSES ABADI',
                'norek' => '8944102600000772',
                'created_at' => '2026-03-08 19:32:31',
                'updated_at' => '2026-03-08 19:32:31',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 345,
                'id_vendor' => 175,
                'nama_bank' => 'BRI ',
                'nama_penerima' => 'PT WIGASANTANA INVESTAMA',
                'norek' => '006801003096307',
                'created_at' => '2026-03-09 22:58:17',
                'updated_at' => '2026-03-09 22:58:17',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 346,
                'id_vendor' => 332,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'SUWARDI SURYA',
                'norek' => '4281779928',
                'created_at' => '2026-03-09 23:34:40',
                'updated_at' => '2026-03-09 23:34:40',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 347,
                'id_vendor' => 333,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'AMIR PAW',
                'norek' => '4840342081',
                'created_at' => '2026-03-10 20:10:00',
                'updated_at' => '2026-03-10 20:10:00',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 348,
                'id_vendor' => 334,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'SAMINA',
                'norek' => '8770592047',
                'created_at' => '2026-03-10 22:43:13',
                'updated_at' => '2026-03-10 22:43:13',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 349,
                'id_vendor' => 223,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'SUPARNO',
                'norek' => '020810414357',
                'created_at' => '2026-03-11 20:01:28',
                'updated_at' => '2026-03-11 20:01:28',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 350,
                'id_vendor' => 335,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'MARIANI',
                'norek' => '020810397461',
                'created_at' => '2026-03-11 22:43:40',
                'updated_at' => '2026-03-11 22:43:40',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 351,
                'id_vendor' => 336,
                'nama_bank' => 'KODE BILLING',
                'nama_penerima' => 'DEVITA SIANAWATI',
                'norek' => '041857159324148',
                'created_at' => '2026-03-12 18:43:52',
                'updated_at' => '2026-03-12 18:43:52',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 352,
                'id_vendor' => 337,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'MUHAMAD TASLIM',
                'norek' => '0010860776',
                'created_at' => '2026-03-12 19:38:59',
                'updated_at' => '2026-03-12 19:38:59',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 353,
                'id_vendor' => 272,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'RAKYAT ACEH MANDIRI',
                'norek' => '6310526116',
                'created_at' => '2026-03-15 20:08:51',
                'updated_at' => '2026-03-15 20:08:51',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 354,
                'id_vendor' => 81,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'NASIRUDIN',
                'norek' => '1057562486',
                'created_at' => '2026-03-15 21:26:16',
                'updated_at' => '2026-03-15 21:26:16',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 355,
                'id_vendor' => 78,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'Muhtada Hairy',
                'norek' => '7302112872',
                'created_at' => '2026-03-15 21:27:18',
                'updated_at' => '2026-03-15 21:27:18',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 356,
                'id_vendor' => 13,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'IMAM MUZAIDIN',
                'norek' => '3820209671',
                'created_at' => '2026-03-15 22:34:56',
                'updated_at' => '2026-03-15 22:34:56',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 357,
                'id_vendor' => 338,
                'nama_bank' => 'Seabank',
                'nama_penerima' => 'Martaria Puspadewi',
                'norek' => '901080839955',
                'created_at' => '2026-03-16 00:50:54',
                'updated_at' => '2026-03-24 21:08:17',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 358,
                'id_vendor' => 339,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'NURUL HIDAYATI',
                'norek' => '1720002914622',
                'created_at' => '2026-03-17 20:44:24',
                'updated_at' => '2026-03-24 21:08:45',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 359,
                'id_vendor' => 340,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'Anand',
                'norek' => '189810073834',
                'created_at' => '2026-03-17 21:24:48',
                'updated_at' => '2026-03-24 21:08:54',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 360,
                'id_vendor' => 341,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'NICKY J MIRCHANDANI',
                'norek' => '7720999077',
                'created_at' => '2026-03-18 00:50:30',
                'updated_at' => '2026-03-24 21:09:01',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 361,
                'id_vendor' => 342,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'PT. ELECTRONIC CITY INDONESIA',
                'norek' => '0700006888999',
                'created_at' => '2026-03-18 01:30:54',
                'updated_at' => '2026-03-24 21:09:10',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 362,
                'id_vendor' => 343,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'EKO HARDIANTO',
                'norek' => '1770020883002',
                'created_at' => '2026-03-25 19:02:16',
                'updated_at' => '2026-03-25 19:02:16',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 363,
                'id_vendor' => 344,
                'nama_bank' => 'BANK OF INDIA SANTACRUZ BRANCH, MUMBAI ',
                'nama_penerima' => 'KANTILAL B.DESAI & SON ',
                'norek' => '004020110000234 SWIFT BKIDINBBSCZ',
                'created_at' => '2026-03-29 19:05:36',
                'updated_at' => '2026-03-29 19:11:03',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 364,
                'id_vendor' => 344,
                'nama_bank' => 'INTERMEDIARY BANK BANK OF INDIA, NEW YORK USA ',
                'nama_penerima' => 'KANTILAL B.DESAI & SON',
                'norek' => 'SWIFT BKIDUS33',
                'created_at' => '2026-03-29 19:05:36',
                'updated_at' => '2026-03-29 19:11:03',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 365,
                'id_vendor' => 346,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'PT. MULIA SAKTIPERKASA',
                'norek' => '063301000697307',
                'created_at' => '2026-03-30 18:37:22',
                'updated_at' => '2026-03-30 18:39:13',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 366,
                'id_vendor' => 352,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'SONNY CAHYA PUTRA SIHALOHO',
                'norek' => '7267 0100 5806 505',
                'created_at' => '2026-03-31 01:52:08',
                'updated_at' => '2026-03-31 01:52:08',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 367,
                'id_vendor' => 353,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'SHARNI SADARANGANI',
                'norek' => '020810382182',
                'created_at' => '2026-03-31 19:32:56',
                'updated_at' => '2026-03-31 19:32:56',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 368,
                'id_vendor' => 355,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'DIANAWATI',
                'norek' => '1510005309866',
                'created_at' => '2026-04-01 19:00:17',
                'updated_at' => '2026-04-01 19:00:17',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 369,
                'id_vendor' => 356,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'SITI AISYAH',
                'norek' => '519001003400530',
                'created_at' => '2026-04-01 19:16:19',
                'updated_at' => '2026-04-01 19:16:19',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 370,
                'id_vendor' => 366,
                'nama_bank' => 'BCA',
                'nama_penerima' => 'PT. WAJA MULIA INDAH ',
                'norek' => '8375897888',
                'created_at' => '2026-04-05 19:00:06',
                'updated_at' => '2026-04-05 19:00:06',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 371,
                'id_vendor' => 367,
                'nama_bank' => 'GOPAY',
                'nama_penerima' => 'AMAN ',
                'norek' => '+6285967264034',
                'created_at' => '2026-04-05 20:05:37',
                'updated_at' => '2026-04-05 20:05:37',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 372,
                'id_vendor' => 368,
                'nama_bank' => 'BRI',
                'nama_penerima' => 'ARFAN',
                'norek' => '006001174643502',
                'created_at' => '2026-04-05 21:31:31',
                'updated_at' => '2026-04-06 00:31:55',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 373,
                'id_vendor' => 368,
                'nama_bank' => 'BRI ',
                'nama_penerima' => 'ARFAN ',
                'norek' => '006001174543502',
                'created_at' => '2026-04-06 00:31:55',
                'updated_at' => '2026-04-06 00:31:55',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 374,
                'id_vendor' => 369,
                'nama_bank' => 'BSI',
                'nama_penerima' => 'PT TEUKU SAUDAGAR ACEH ',
                'norek' => '1269996656',
                'created_at' => '2026-04-06 01:14:47',
                'updated_at' => '2026-04-06 01:14:47',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 375,
                'id_vendor' => 370,
                'nama_bank' => 'OCBC VA',
                'nama_penerima' => 'TOKOPEDIA',
                'norek' => '083831058882',
                'created_at' => '2026-04-06 19:29:58',
                'updated_at' => '2026-04-06 19:29:58',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 376,
                'id_vendor' => 371,
                'nama_bank' => 'OCBC VA',
                'nama_penerima' => 'TOKOPEDIA',
                'norek' => '083831058882',
                'created_at' => '2026-04-06 19:30:48',
                'updated_at' => '2026-04-06 19:30:48',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 377,
                'id_vendor' => 372,
                'nama_bank' => 'OCBC VA',
                'nama_penerima' => 'TOKOPEDIA',
                'norek' => '083831058882',
                'created_at' => '2026-04-06 19:31:29',
                'updated_at' => '2026-04-06 19:34:03',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 378,
                'id_vendor' => 373,
                'nama_bank' => 'BCA VA ',
                'nama_penerima' => 'TOKOPEDIA',
                'norek' => '80777083831058882',
                'created_at' => '2026-04-06 19:45:13',
                'updated_at' => '2026-04-06 19:45:13',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 379,
                'id_vendor' => 374,
                'nama_bank' => 'MANDIRI',
                'nama_penerima' => 'MOH RUSIADI',
                'norek' => '1510013216061',
                'created_at' => '2026-04-07 02:21:00',
                'updated_at' => '2026-04-07 02:21:00',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 380,
                'id_vendor' => 375,
                'nama_bank' => 'BCA ',
                'nama_penerima' => 'PT DEWAWEB',
                'norek' => '2872878000',
                'created_at' => '2026-04-07 19:55:40',
                'updated_at' => '2026-04-07 19:55:40',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 381,
                'id_vendor' => 376,
                'nama_bank' => 'BRI KC. PEMALANG',
                'nama_penerima' => 'NOVAL NURUL HAKIM',
                'norek' => '0069-0103-0706503',
                'created_at' => '2026-04-07 20:01:16',
                'updated_at' => '2026-04-07 20:01:16',
                'deleted_at' => null
            ],
            [
                'id_norek_vendor' => 382,
                'id_vendor' => 378,
                'nama_bank' => 'BNI',
                'nama_penerima' => 'KHUSWATUN KHASANAH',
                'norek' => '299923186',
                'created_at' => '2026-04-08 00:25:08',
                'updated_at' => '2026-04-08 00:25:08',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_norek_vendor')->insert($chunk);
        }
    }
}
