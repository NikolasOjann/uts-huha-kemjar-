<!-- filepath: admin/delete_product.php -->
<?php
// Include file konfigurasi database
include "../config/db.php";

// Periksa apakah parameter ID ada di URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan ID adalah integer untuk keamanan

    // Query untuk menghapus produk berdasarkan ID
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Jika berhasil, redirect kembali ke halaman utama dengan pesan sukses
        header("Location: dataProduct.php?success=1");
        exit();
    } else {
        // Jika gagal, redirect kembali dengan pesan error
        header("Location: dataProduct.php?error=1");
        exit();
    }
} else {
    // Jika ID tidak ada, redirect kembali ke halaman utama
    header("Location: dataProduct.php");
    exit();
}
?>