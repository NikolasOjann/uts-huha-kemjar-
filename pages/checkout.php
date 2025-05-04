<?php
session_start();
include "../config/db.php";

// Cek login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Ambil data produk berdasarkan ID
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
} else {
    echo "Produk tidak ditemukan.";
    exit();
}
?>

<?php include "../includes/header.php"; ?>

<h2 class="text-2xl font-bold mb-4">Checkout</h2>

<div class="bg-white p-4 rounded shadow max-w-md">
    <h3 class="text-lg font-semibold mb-2"><?= htmlspecialchars($product['name']) ?></h3>
    <img src="../uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-48 object-cover rounded mb-2">
    <p class="text-blue-600 font-bold mb-4">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>

    <form method="POST" action="checkout_process.php">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <input type="hidden" name="price" value="<?= $product['price'] ?>">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">Konfirmasi Pembelian</button>
    </form>
</div>

<?php include "../includes/footer.php"; ?>
