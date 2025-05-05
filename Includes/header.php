<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>ShopX - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">
    <header class="bg-blue-600 text-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../pages/products.php" class="text-2xl font-bold">Shop<span class="text-yellow-300">X</span></a>
            <nav class="space-x-4">
                <a href="../pages/purchase_history.php" class="hover:underline">Riwayat</a>
                <a href="../pages/products.php" class="hover:underline">Produk</a>

                <?php
                if (isset($_SESSION['user_id'])):
                    require_once "../config/db.php";
                    require_once "../fungsi.php";

                    $id = intval($_SESSION['user_id']); // amankan input ID
                    $q = $conn->query("SELECT name FROM users WHERE id = $id");

                    if ($row = $q->fetch_assoc()) {
                        $decryptedName = decryptData($row['name']);
                        echo "<span class='font-semibold'>Halo, " . htmlspecialchars($decryptedName) . "</span>";
                    }
                ?>
                    <a href="../logout.php" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</a>
                    <a href="../pages/profile.php" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Profile</a>
                <?php else: ?>
                    <a href="../pages/login.php" class="bg-white text-blue-600 px-3 py-1 rounded hover:bg-gray-200">Login</a>
                    <a href="../pages/formRegister.php" class="bg-white text-blue-600 px-3 py-1 rounded hover:bg-gray-200">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container mx-auto px-4 py-6">
