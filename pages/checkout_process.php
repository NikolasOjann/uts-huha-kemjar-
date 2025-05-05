<?php
session_start();
include "../config/db.php";
include "../fungsi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $card_number = encryptData($_POST['card_number']);
    $cvv = encryptData($_POST['cvv']);
    $date = date('Y-m-d H:i:s');

    // 1. Simpan ke tabel purchase_history lebih dulu
    $stmt_purchase = $conn->prepare("
        INSERT INTO purchase_history (user_id, product_id, price, purchase_date)
        VALUES (?, ?, ?, ?)
    ");
    $stmt_purchase->bind_param("iiis", $user_id, $product_id, $price, $date);

    if ($stmt_purchase->execute()) {
        // Ambil ID dari pembelian yang baru saja dimasukkan
        $purchase_id = $stmt_purchase->insert_id;

        // 2. Simpan ke tabel payments dengan purchase_id
        $stmt_payment = $conn->prepare("
            INSERT INTO payments (user_id, card_number, cvv, purchase_id, created_at)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt_payment->bind_param("sssis", $user_id, $card_number, $cvv, $purchase_id, $date);
        $stmt_payment->execute();

        header("Location: products.php?success=1");
        exit();
    } else {
        echo "<p>Gagal menyimpan riwayat pembelian.</p>";
    }
}

