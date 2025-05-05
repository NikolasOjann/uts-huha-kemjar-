<?php
require_once __DIR__ . '/secure/key.php';

function encryptData($plainText)
{
    $cipher = "AES-256-CBC";
    $key = AES_KEY;
    $iv = AES_IV;

    // 1. Enkripsi dulu
    $ciphertext = openssl_encrypt($plainText, $cipher, $key, 0, $iv);

    // 2. Buat HMAC dari ciphertext
    $hmac = hash_hmac('sha256', $ciphertext, $key);

    // 3. Gabungkan dan base64 encode
    return base64_encode($ciphertext . '::' . $hmac);
}

function decryptData($encryptedText)
{
    $cipher = "AES-256-CBC";
    $key = AES_KEY;
    $iv = AES_IV;

    // 1. Decode dan pecah ciphertext dan hmac
    $decoded = base64_decode($encryptedText);
    $parts = explode('::', $decoded);

    if (count($parts) !== 2) {
        return false;
    }

    list($ciphertext, $hmac) = $parts;

    // 2. Verifikasi HMAC dulu
    $calculatedHmac = hash_hmac('sha256', $ciphertext, $key);
    if (!hash_equals($hmac, $calculatedHmac)) {
        return false; // Data rusak atau dimodifikasi
    }

    // 3. Dekripsi hanya jika HMAC cocok
    return openssl_decrypt($ciphertext, $cipher, $key, 0, $iv);
}
?>