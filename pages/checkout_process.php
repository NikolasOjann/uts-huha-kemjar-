<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id     = $_SESSION['user_id'];
    $product_id  = $_POST['product_id'];
    $price       = $_POST['price'];
    $card_number = $_POST['card_number'];
    $cvv         = $_POST['cvv'];
    $date        = date('Y-m-d H:i:s');

    // Simpan data payment (simulasi)
    $stmt_payment = $conn->prepare("
        INSERT INTO payments (user_id, card_number, cvv, created_at)
        VALUES (?, ?, ?, ?)
    ");
    $stmt_payment->bind_param("isss", $user_id, $card_number, $cvv, $date);
    $stmt_payment->execute();

    // Simpan ke tabel purchase_history
    $stmt_purchase = $conn->prepare("
        INSERT INTO purchase_history (user_id, product_id, price, purchase_date)
        VALUES (?, ?, ?, ?)
    ");
    $stmt_purchase->bind_param("iiis", $user_id, $product_id, $price, $date);

    if ($stmt_purchase->execute()) {
        header("Location: products.php?success=1");
        exit();
    } else {
        echo "<p>Gagal menyimpan riwayat pembelian.</p>";
    }
} else {
    echo "<p>Metode tidak diperbolehkan.</p>";
}
?>
