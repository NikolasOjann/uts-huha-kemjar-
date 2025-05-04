<?php
session_start();
include "../includes/header.php";
include "../config/db.php";

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data riwayat pembelian
$stmt = $conn->prepare("
    SELECT p.name, p.image, h.purchase_date, h.price
    FROM purchase_history h
    JOIN products p ON h.product_id = p.id
    WHERE h.user_id = ?
    ORDER BY h.purchase_date DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2 class="text-2xl font-bold mb-4">Riwayat Pembelian</h2>

<?php if ($result->num_rows > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="bg-white p-4 rounded shadow flex items-center gap-4">
                <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="w-24 h-24 object-cover rounded">
                <div>
                    <h3 class="text-lg font-semibold"><?= htmlspecialchars($row['name']) ?></h3>
                    <p class="text-gray-600 text-sm">Tanggal: <?= $row['purchase_date'] ?></p>
                    <p class="text-blue-600 font-bold">Rp <?= number_format($row['price'], 0, ',', '.') ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>Belum ada pembelian.</p>
<?php endif; ?>

<?php include "../includes/footer.php"; ?>
