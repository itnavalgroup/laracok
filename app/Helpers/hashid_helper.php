<?php

use Hashids\Hashids;

if (!function_exists('hashid_encode')) {
    function hashid_encode($id, $prefix = '')
    {
        $salt = env('HASHID_SALT', 'ppd-laravel-secret-salt-') . $prefix;
        $hashids = new Hashids($salt, 10);
        return $hashids->encode($id);
    }
}

if (!function_exists('hashid_decode')) {
    function hashid_decode($hash, $prefix = '')
    {
        $salt = env('HASHID_SALT', 'ppd-laravel-secret-salt-') . $prefix;
        $hashids = new Hashids($salt, 10);
        $decoded = $hashids->decode($hash);
        return $decoded[0] ?? null;
    }
}
if (!function_exists('parseQtyID')) {
    function parseQtyID($val)
    {
        if (!$val) return 0;
        // Handle Indonesian format where dot is thousand separator and comma is decimal separator
        // First remove any dots (thousand separator)
        $clean = str_replace('.', '', $val);
        // Then replace comma with dot (decimal separator for PHP)
        $clean = str_replace(',', '.', $clean);
        return (float) $clean;
    }
}

if (!function_exists('generateQrCodeBase64')) {
    function generateQrCodeBase64($text, $size = 80)
    {
        try {
            $result = \Endroid\QrCode\Builder\Builder::create()
                ->writer(new \Endroid\QrCode\Writer\PngWriter())
                ->data($text)
                ->size($size)
                ->margin(0)
                ->build();
            return base64_encode($result->getString());
        } catch (\Exception $e) {
            return '';
        }
    }
}
