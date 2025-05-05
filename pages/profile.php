<?php
require_once "../includes/header.php";
require_once "../config/db.php";
require_once "../fungsi.php";

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    echo "<p class='text-red-600'>Anda belum login. <a href='login.php' class='underline'>Login di sini</a>.</p>";
    require_once "../includes/footer.php";
    exit;
}

$stmt = $conn->prepare("SELECT username, name, address, phone FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Dekripsi semua data sensitif
    $username = decryptData($user['username']);
    $name     = decryptData($user['name']);
    $address  = decryptData($user['address']);
    $phone    = decryptData($user['phone']);
} else {
    echo "<p class='text-red-600'>Data pengguna tidak ditemukan.</p>";
    require_once "../includes/footer.php";
    exit;
}
?>

<h2 class="text-2xl font-bold mb-4">Profil Saya</h2>

<div class="bg-white p-6 rounded shadow-md space-y-4 max-w-md">
    <div><strong>Username:</strong> <?= htmlspecialchars($username) ?></div>
    <div><strong>Nama Lengkap:</strong> <?= htmlspecialchars($name) ?></div>
    <div><strong>Alamat:</strong> <?= nl2br(htmlspecialchars($address)) ?></div>
    <div><strong>No. Telepon:</strong> <?= htmlspecialchars($phone) ?></div>
</div>
