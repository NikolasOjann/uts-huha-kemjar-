<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $price = (int) $_POST['price'];
    $image = trim($_POST['image']);

    // Validasi sederhana
    if ($id && $name && $price && $image) {
        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sisi", $name, $price, $image, $id);

        if ($stmt->execute()) {
            header("Location: dataProduct.php?success=2");
            exit();
        } else {
            echo "Gagal mengupdate data produk.";
        }

        $stmt->close();
    } else {
        echo "Semua field harus diisi.";
    }
} else {
    echo "Metode tidak valid.";
}
?>