<?php session_start(); ?>
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
            <a href="/pages/products.php" class="text-2xl font-bold">Shop<span class="text-yellow-300">X</span></a>
            <nav class="space-x-4">
                <a href="/pages/products.php" class="hover:underline">Produk</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="font-semibold">Halo, <?= htmlspecialchars($_SESSION['user']) ?></span>
                    <a href="/logout.php" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</a>
                <?php else: ?>
                    <a href="/pages/login.php" class="bg-white text-blue-600 px-3 py-1 rounded hover:bg-gray-200">Login</a>
                    <a href="/pages/register.php" class="bg-white text-blue-600 px-3 py-1 rounded hover:bg-gray-200">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container mx-auto px-4 py-6">
