<?php 
include "../includes/header.php"; 
include "../config/db.php"; 
require_once "../fungsi.php"; // Pastikan fungsi decryptData() tersedia di sini
?>

<?php
// Tampilkan notifikasi jika pembayaran berhasil
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<div class='bg-green-100 text-green-600 p-4 rounded mb-4'>Pembayaran berhasil! Terima kasih telah berbelanja.</div>";
}
?>

<h2 class="text-2xl font-bold mb-6">Daftar Produk</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <?php
    $products = $conn->query("SELECT * FROM products");
    while ($p = $products->fetch_assoc()):
        // Dekripsi data produk
        $name  = decryptData($p['name']);
        $price = $p['price'];
        $image = decryptData($p['image']);
    ?>
    <div class="bg-white p-4 rounded shadow">
        <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($name) ?>" class="w-full aspect-video object-contain rounded mb-2 bg-white">
        <h3 class="text-lg font-semibold"><?= htmlspecialchars($name) ?></h3>
        <p class="text-blue-600 font-bold">Rp <?= number_format($price, 0, ',', '.') ?></p>
        <a href="checkout.php?id=<?= $p['id'] ?>" class="inline-block mt-2 bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Beli Sekarang</a>
    </div>
    <?php endwhile; ?>
</div>

<?php include "../includes/footer.php"; ?>

