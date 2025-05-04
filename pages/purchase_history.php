<?php include "../includes/header.php"; include "../config/db.php"; ?>

<h2 class="text-2xl font-bold mb-4">Riwayat Pembelian</h2>

<?php
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT p.name, pur.purchase_date 
                        FROM purchases pur 
                        JOIN products p ON pur.product_id = p.id 
                        WHERE pur.user_id=? 
                        ORDER BY pur.purchase_date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0): ?>
    <ul class="space-y-2">
        <?php while ($row = $result->fetch_assoc()): ?>
            <li class="bg-white shadow p-3 rounded">
                <strong><?= htmlspecialchars($row['name']) ?></strong> <br>
                <span class="text-sm text-gray-600"><?= $row['purchase_date'] ?></span>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>Belum ada pembelian.</p>
<?php endif; ?>

<?php include "../includes/footer.php"; ?>
