<?php
require_once __DIR__ . '/secure/key.php';


function encryptData($plainText)
{
    $cipher = "AES-256-CBC";
    $key = AES_KEY;
    $iv = AES_IV;

    $encrypted = openssl_encrypt($plainText, $cipher, $key, 0, $iv);
    return base64_encode($encrypted);
}

function decryptData($encryptedText)
{
    $cipher = "AES-256-CBC";
    $key = AES_KEY;
    $iv = AES_IV;

    $decrypted = openssl_decrypt(base64_decode($encryptedText), $cipher, $key, 0, $iv);
    return $decrypted;
}
?>