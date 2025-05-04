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
    if (!$product) {
        echo "Produk tidak ditemukan.";
        exit();
    }
} else {
    echo "ID produk tidak valid.";
    exit();
}
?>

<?php include "../includes/header.php"; ?>

<h2 class="text-2xl font-bold mb-4">Checkout</h2>

<div class="bg-white p-6 rounded shadow max-w-md mx-auto space-y-4">
    <h3 class="text-lg font-semibold"><?= htmlspecialchars($product['name']) ?></h3>
    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-48 object-cover rounded">
    <p class="text-blue-600 font-bold text-xl">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>

    <form method="POST" action="checkout_process.php" class="space-y-4">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <input type="hidden" name="price" value="<?= $product['price'] ?>">

        <div>
            <label class="block text-sm font-medium mb-1">Nomor Kartu Kredit</label>
            <input type="text" name="card_number" required maxlength="20" class="w-full border p-2 rounded" placeholder="Contoh: 4111111111111111">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">CVV</label>
            <input type="text" name="cvv" required maxlength="4" class="w-full border p-2 rounded" placeholder="Contoh: 123">
        </div>

        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Konfirmasi Pembelian
        </button>
    </form>
</div>

<?php include "../includes/footer.php"; ?>
