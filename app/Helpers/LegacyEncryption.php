<?php

if (!function_exists('decrypt_legacy')) {
    function decrypt_legacy($data)
    {
        if (!$data) return null;

        $key = config('app.legacy_encryption_key');
        $iv  = config('app.legacy_encryption_iv');

        if (!$key || !$iv) {
            return $data; // Fallback if keys missing
        }

        $decoded = base64_decode($data);
        $decrypted = openssl_decrypt($decoded, 'AES-256-CBC', $key, 0, $iv);

        // Explicitly check for false (decryption failure)
        // If result is empty string, return it (it's the legacy empty placeholder)
        return ($decrypted !== false) ? $decrypted : $data;
    }
}

if (!function_exists('encrypt_legacy')) {
    function encrypt_legacy($data)
    {
        if (!$data) return null;

        $key = config('app.legacy_encryption_key');
        $iv  = config('app.legacy_encryption_iv');

        if (!$key || !$iv) {
            return $data;
        }

        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
        return base64_encode($encrypted);
    }
}
