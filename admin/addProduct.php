<?php
include "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $image = $_POST['image'] ?? '';

    $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $price, $image);

    if ($stmt->execute()) {
        header("Location: dataProduct.php?success=1");
        exit();
    } else {
        echo "Gagal menambahkan produk.";
    }
}
?>