<?php
session_start();
include "../includes/header.php";
include "../config/db.php";
include_once "../fungsi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data riwayat pembelian
$stmt = $conn->prepare("
    SELECT 
        p.name AS product_name, 
        p.image, 
        h.id AS purchase_id,
        h.product_id, 
        h.purchase_date, 
        h.price, 
        h.user_id, 
        u.name AS user_name, 
        pay.card_number, 
        pay.cvv
    FROM purchase_history h
    JOIN products p ON h.product_id = p.id
    LEFT JOIN payments pay ON pay.purchase_id = h.id
    LEFT JOIN users u ON h.user_id = u.id
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
            <?php

            $card_number = $row['card_number'] ? decryptData($row['card_number']) : '-';
            $cvv = $row['cvv'] ? decryptData($row['cvv']) : '-';
            $username = $row['user_name'] ? decryptData($row['user_name']) : '-';
            ?>
            <div class="bg-white p-4 rounded shadow flex flex-col gap-2">
                <div class="flex items-center gap-4">
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>"
                        class="w-24 h-24 object-cover rounded">
                    <div>
                        <h3 class="text-lg font-semibold"><?= htmlspecialchars($row['product_name']) ?></h3>
                        <p class="text-gray-600 text-sm">Tanggal: <?= htmlspecialchars($row['purchase_date']) ?></p>
                        <p class="text-blue-600 font-bold">Rp <?= number_format($row['price'], 0, ',', '.') ?></p>
                    </div>
                </div>
                <div class="text-sm text-gray-700 mt-2 border-t pt-2">
                    <p><strong>User ID:</strong> <?= htmlspecialchars($row['user_id']) ?></p>
                    <p><strong>Name:</strong> <?= htmlspecialchars($username) ?></p>
                    <p><strong>Product ID:</strong> <?= htmlspecialchars($row['product_id']) ?></p>
                    <p><strong>Card Number:</strong> <?= htmlspecialchars($card_number) ?></p>
                    <p><strong>CVV:</strong> <?= htmlspecialchars($cvv) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p>Belum ada pembelian.</p>
<?php endif; ?>

<?php include "../includes/footer.php"; ?>