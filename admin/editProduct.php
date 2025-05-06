<?php
include "../config/db.php";
include_once "../fungsi.php"; // Tambahkan ini agar bisa akses encryptData()

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $price = (int) $_POST['price'];
    $image = trim($_POST['image']);

    // Validasi sederhana
    if ($id && $name && $price && $image) {
        // Enkripsi data name dan image
        $encryptedName = encryptData($name);
        $encryptedImage = encryptData($image);

        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sisi", $encryptedName, $price, $encryptedImage, $id);

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
