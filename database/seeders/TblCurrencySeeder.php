<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblCurrencySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_currency')->truncate();

        $data = [
            [
                'id_currency' => 1,
                'country' => 'Afghanistan',
                'code' => 'AFN',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 2,
                'country' => 'Albania',
                'code' => 'ALL',
                'symbol' => 'L',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 3,
                'country' => 'Algeria',
                'code' => 'DZD',
                'symbol' => '??',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 4,
                'country' => 'Andorra',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 5,
                'country' => 'Angola',
                'code' => 'AOA',
                'symbol' => 'Kz',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 6,
                'country' => 'Antigua and Barbuda',
                'code' => 'XCD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 7,
                'country' => 'Argentina',
                'code' => 'ARS',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 8,
                'country' => 'Armenia',
                'code' => 'AMD',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 9,
                'country' => 'Australia',
                'code' => 'AUD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 10,
                'country' => 'Austria',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 11,
                'country' => 'Azerbaijan',
                'code' => 'AZN',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 12,
                'country' => 'Bahamas',
                'code' => 'BSD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 13,
                'country' => 'Bahrain',
                'code' => 'BHD',
                'symbol' => '?.?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 14,
                'country' => 'Bangladesh',
                'code' => 'BDT',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 15,
                'country' => 'Barbados',
                'code' => 'BBD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 16,
                'country' => 'Belarus',
                'code' => 'BYN',
                'symbol' => 'Br',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 17,
                'country' => 'Belgium',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 18,
                'country' => 'Belize',
                'code' => 'BZD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 19,
                'country' => 'Benin',
                'code' => 'XOF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 20,
                'country' => 'Bhutan',
                'code' => 'BTN',
                'symbol' => 'Nu',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 21,
                'country' => 'Bolivia',
                'code' => 'BOB',
                'symbol' => 'Bs',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 22,
                'country' => 'Bosnia and Herzegovina',
                'code' => 'BAM',
                'symbol' => 'KM',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 23,
                'country' => 'Botswana',
                'code' => 'BWP',
                'symbol' => 'P',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 24,
                'country' => 'Brazil',
                'code' => 'BRL',
                'symbol' => 'R$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 25,
                'country' => 'Brunei',
                'code' => 'BND',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 26,
                'country' => 'Bulgaria',
                'code' => 'BGN',
                'symbol' => '??',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 27,
                'country' => 'Burkina Faso',
                'code' => 'XOF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 28,
                'country' => 'Burundi',
                'code' => 'BIF',
                'symbol' => 'Fr',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 29,
                'country' => 'Cambodia',
                'code' => 'KHR',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 30,
                'country' => 'Cameroon',
                'code' => 'XAF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 31,
                'country' => 'Canada',
                'code' => 'CAD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 32,
                'country' => 'Cape Verde',
                'code' => 'CVE',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 33,
                'country' => 'Central African Republic',
                'code' => 'XAF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 34,
                'country' => 'Chad',
                'code' => 'XAF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 35,
                'country' => 'Chile',
                'code' => 'CLP',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 36,
                'country' => 'China',
                'code' => 'CNY',
                'symbol' => '¥',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 37,
                'country' => 'Colombia',
                'code' => 'COP',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 38,
                'country' => 'Comoros',
                'code' => 'KMF',
                'symbol' => 'Fr',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 39,
                'country' => 'Congo',
                'code' => 'XAF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 40,
                'country' => 'Costa Rica',
                'code' => 'CRC',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 41,
                'country' => 'Croatia',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 42,
                'country' => 'Cuba',
                'code' => 'CUP',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 43,
                'country' => 'Cyprus',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 44,
                'country' => 'Czech Republic',
                'code' => 'CZK',
                'symbol' => 'K?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 45,
                'country' => 'Denmark',
                'code' => 'DKK',
                'symbol' => 'kr',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 46,
                'country' => 'Djibouti',
                'code' => 'DJF',
                'symbol' => 'Fr',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 47,
                'country' => 'Dominica',
                'code' => 'XCD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 48,
                'country' => 'Dominican Republic',
                'code' => 'DOP',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 49,
                'country' => 'Ecuador',
                'code' => 'USD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 50,
                'country' => 'Egypt',
                'code' => 'EGP',
                'symbol' => '£',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 51,
                'country' => 'El Salvador',
                'code' => 'USD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 52,
                'country' => 'Equatorial Guinea',
                'code' => 'XAF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 53,
                'country' => 'Eritrea',
                'code' => 'ERN',
                'symbol' => 'Nfk',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 54,
                'country' => 'Estonia',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 55,
                'country' => 'Eswatini',
                'code' => 'SZL',
                'symbol' => 'L',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 56,
                'country' => 'Ethiopia',
                'code' => 'ETB',
                'symbol' => 'Br',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 57,
                'country' => 'Fiji',
                'code' => 'FJD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 58,
                'country' => 'Finland',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 59,
                'country' => 'France',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 60,
                'country' => 'Gabon',
                'code' => 'XAF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 61,
                'country' => 'Gambia',
                'code' => 'GMD',
                'symbol' => 'D',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 62,
                'country' => 'Georgia',
                'code' => 'GEL',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 63,
                'country' => 'Germany',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 64,
                'country' => 'Ghana',
                'code' => 'GHS',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 65,
                'country' => 'Greece',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 66,
                'country' => 'Grenada',
                'code' => 'XCD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 67,
                'country' => 'Guatemala',
                'code' => 'GTQ',
                'symbol' => 'Q',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 68,
                'country' => 'Guinea',
                'code' => 'GNF',
                'symbol' => 'Fr',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 69,
                'country' => 'Guinea-Bissau',
                'code' => 'XOF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 70,
                'country' => 'Guyana',
                'code' => 'GYD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 71,
                'country' => 'Haiti',
                'code' => 'HTG',
                'symbol' => 'G',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 72,
                'country' => 'Honduras',
                'code' => 'HNL',
                'symbol' => 'L',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 73,
                'country' => 'Hungary',
                'code' => 'HUF',
                'symbol' => 'Ft',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 74,
                'country' => 'Iceland',
                'code' => 'ISK',
                'symbol' => 'kr',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 75,
                'country' => 'India',
                'code' => 'INR',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 76,
                'country' => 'Indonesia',
                'code' => 'IDR',
                'symbol' => 'Rp',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 77,
                'country' => 'Iran',
                'code' => 'IRR',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 78,
                'country' => 'Iraq',
                'code' => 'IQD',
                'symbol' => '?.?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 79,
                'country' => 'Ireland',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 80,
                'country' => 'Israel',
                'code' => 'ILS',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 81,
                'country' => 'Italy',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 82,
                'country' => 'Jamaica',
                'code' => 'JMD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 83,
                'country' => 'Japan',
                'code' => 'JPY',
                'symbol' => '¥',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 84,
                'country' => 'Jordan',
                'code' => 'JOD',
                'symbol' => '?.?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 85,
                'country' => 'Kazakhstan',
                'code' => 'KZT',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 86,
                'country' => 'Kenya',
                'code' => 'KES',
                'symbol' => 'Sh',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 87,
                'country' => 'Kiribati',
                'code' => 'AUD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 88,
                'country' => 'Kuwait',
                'code' => 'KWD',
                'symbol' => '?.?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 89,
                'country' => 'Kyrgyzstan',
                'code' => 'KGS',
                'symbol' => '???',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 90,
                'country' => 'Laos',
                'code' => 'LAK',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 91,
                'country' => 'Latvia',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 92,
                'country' => 'Lebanon',
                'code' => 'LBP',
                'symbol' => '£',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 93,
                'country' => 'Lesotho',
                'code' => 'LSL',
                'symbol' => 'L',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 94,
                'country' => 'Liberia',
                'code' => 'LRD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 95,
                'country' => 'Libya',
                'code' => 'LYD',
                'symbol' => '?.?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 96,
                'country' => 'Liechtenstein',
                'code' => 'CHF',
                'symbol' => 'CHF',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 97,
                'country' => 'Lithuania',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 98,
                'country' => 'Luxembourg',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 99,
                'country' => 'Madagascar',
                'code' => 'MGA',
                'symbol' => 'Ar',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 100,
                'country' => 'Malawi',
                'code' => 'MWK',
                'symbol' => 'MK',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 101,
                'country' => 'Malaysia',
                'code' => 'MYR',
                'symbol' => 'RM',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 102,
                'country' => 'Maldives',
                'code' => 'MVR',
                'symbol' => 'Rf',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 103,
                'country' => 'Mali',
                'code' => 'XOF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 104,
                'country' => 'Malta',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 105,
                'country' => 'Marshall Islands',
                'code' => 'USD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 106,
                'country' => 'Mauritania',
                'code' => 'MRU',
                'symbol' => 'UM',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 107,
                'country' => 'Mauritius',
                'code' => 'MUR',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 108,
                'country' => 'Mexico',
                'code' => 'MXN',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 109,
                'country' => 'Micronesia',
                'code' => 'USD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 110,
                'country' => 'Moldova',
                'code' => 'MDL',
                'symbol' => 'L',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 111,
                'country' => 'Monaco',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 112,
                'country' => 'Mongolia',
                'code' => 'MNT',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 113,
                'country' => 'Montenegro',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 114,
                'country' => 'Morocco',
                'code' => 'MAD',
                'symbol' => '?.?.',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 115,
                'country' => 'Mozambique',
                'code' => 'MZN',
                'symbol' => 'MT',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 116,
                'country' => 'Myanmar',
                'code' => 'MMK',
                'symbol' => 'K',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 117,
                'country' => 'Namibia',
                'code' => 'NAD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 118,
                'country' => 'Nauru',
                'code' => 'AUD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 119,
                'country' => 'Nepal',
                'code' => 'NPR',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 120,
                'country' => 'Netherlands',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 121,
                'country' => 'New Zealand',
                'code' => 'NZD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 122,
                'country' => 'Nicaragua',
                'code' => 'NIO',
                'symbol' => 'C$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 123,
                'country' => 'Niger',
                'code' => 'XOF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 124,
                'country' => 'Nigeria',
                'code' => 'NGN',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 125,
                'country' => 'North Macedonia',
                'code' => 'MKD',
                'symbol' => '???',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 126,
                'country' => 'Norway',
                'code' => 'NOK',
                'symbol' => 'kr',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 127,
                'country' => 'Oman',
                'code' => 'OMR',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 128,
                'country' => 'Pakistan',
                'code' => 'PKR',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 129,
                'country' => 'Palau',
                'code' => 'USD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 130,
                'country' => 'Panama',
                'code' => 'PAB',
                'symbol' => 'B/.',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 131,
                'country' => 'Papua New Guinea',
                'code' => 'PGK',
                'symbol' => 'K',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 132,
                'country' => 'Paraguay',
                'code' => 'PYG',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 133,
                'country' => 'Peru',
                'code' => 'PEN',
                'symbol' => 'S/',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 134,
                'country' => 'Philippines',
                'code' => 'PHP',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 135,
                'country' => 'Poland',
                'code' => 'PLN',
                'symbol' => 'z?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 136,
                'country' => 'Portugal',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 137,
                'country' => 'Qatar',
                'code' => 'QAR',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 138,
                'country' => 'Romania',
                'code' => 'RON',
                'symbol' => 'lei',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 139,
                'country' => 'Russia',
                'code' => 'RUB',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 140,
                'country' => 'Rwanda',
                'code' => 'RWF',
                'symbol' => 'Fr',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 141,
                'country' => 'Saint Lucia',
                'code' => 'XCD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 142,
                'country' => 'Samoa',
                'code' => 'WST',
                'symbol' => 'T',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 143,
                'country' => 'San Marino',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 144,
                'country' => 'Saudi Arabia',
                'code' => 'SAR',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 145,
                'country' => 'Senegal',
                'code' => 'XOF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 146,
                'country' => 'Serbia',
                'code' => 'RSD',
                'symbol' => '???',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 147,
                'country' => 'Seychelles',
                'code' => 'SCR',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 148,
                'country' => 'Sierra Leone',
                'code' => 'SLL',
                'symbol' => 'Le',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 149,
                'country' => 'Singapore',
                'code' => 'SGD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 150,
                'country' => 'Slovakia',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 151,
                'country' => 'Slovenia',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 152,
                'country' => 'Solomon Islands',
                'code' => 'SBD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 153,
                'country' => 'Somalia',
                'code' => 'SOS',
                'symbol' => 'Sh',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 154,
                'country' => 'South Africa',
                'code' => 'ZAR',
                'symbol' => 'R',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 155,
                'country' => 'South Korea',
                'code' => 'KRW',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 156,
                'country' => 'Spain',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 157,
                'country' => 'Sri Lanka',
                'code' => 'LKR',
                'symbol' => 'Rs',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 158,
                'country' => 'Sudan',
                'code' => 'SDG',
                'symbol' => '£',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 159,
                'country' => 'Suriname',
                'code' => 'SRD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 160,
                'country' => 'Sweden',
                'code' => 'SEK',
                'symbol' => 'kr',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 161,
                'country' => 'Switzerland',
                'code' => 'CHF',
                'symbol' => 'CHF',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 162,
                'country' => 'Syria',
                'code' => 'SYP',
                'symbol' => '£',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 163,
                'country' => 'Taiwan',
                'code' => 'TWD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 164,
                'country' => 'Tajikistan',
                'code' => 'TJS',
                'symbol' => 'SM',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 165,
                'country' => 'Tanzania',
                'code' => 'TZS',
                'symbol' => 'Sh',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 166,
                'country' => 'Thailand',
                'code' => 'THB',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 167,
                'country' => 'Togo',
                'code' => 'XOF',
                'symbol' => 'CFA',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 168,
                'country' => 'Tonga',
                'code' => 'TOP',
                'symbol' => 'T$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 169,
                'country' => 'Trinidad and Tobago',
                'code' => 'TTD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 170,
                'country' => 'Tunisia',
                'code' => 'TND',
                'symbol' => '?.?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 171,
                'country' => 'Turkey',
                'code' => 'TRY',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 172,
                'country' => 'Turkmenistan',
                'code' => 'TMT',
                'symbol' => 'm',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 173,
                'country' => 'Tuvalu',
                'code' => 'AUD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 174,
                'country' => 'Uganda',
                'code' => 'UGX',
                'symbol' => 'Sh',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 175,
                'country' => 'Ukraine',
                'code' => 'UAH',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 176,
                'country' => 'United Arab Emirates',
                'code' => 'AED',
                'symbol' => '?.?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 177,
                'country' => 'United Kingdom',
                'code' => 'GBP',
                'symbol' => '£',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 178,
                'country' => 'United States',
                'code' => 'USD',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 179,
                'country' => 'Uruguay',
                'code' => 'UYU',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 180,
                'country' => 'Uzbekistan',
                'code' => 'UZS',
                'symbol' => 'so?m',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 181,
                'country' => 'Vanuatu',
                'code' => 'VUV',
                'symbol' => 'Vt',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 182,
                'country' => 'Vatican City',
                'code' => 'EUR',
                'symbol' => '€',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 183,
                'country' => 'Venezuela',
                'code' => 'VES',
                'symbol' => 'Bs',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 184,
                'country' => 'Yemen',
                'code' => 'YER',
                'symbol' => '?',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 185,
                'country' => 'Zambia',
                'code' => 'ZMW',
                'symbol' => 'ZK',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ],
            [
                'id_currency' => 186,
                'country' => 'Zimbabwe',
                'code' => 'ZWL',
                'symbol' => '$',
                'created_at' => '2025-12-18 17:17:55',
                'updated_at' => '2025-12-18 17:17:55',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_currency')->insert($chunk);
        }
    }
}
