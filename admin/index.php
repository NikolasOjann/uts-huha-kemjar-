<?php 
include "components/header.php"; 
include "../config/db.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../pages/login.php");
    exit();
}

// Cek apakah user adalah admin
if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak. Halaman ini hanya bisa diakses oleh admin.'); window.location.href='../pages/products.php';</script>";
    exit();
}

// Query jumlah data dari masing-masing tabel
$jumlahProduk = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
$jumlahUser = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$jumlahPembelian = $conn->query("SELECT COUNT(*) as total FROM purchase_history")->fetch_assoc()['total'];
$jumlahPembayaran = $conn->query("SELECT COUNT(*) as total FROM payments")->fetch_assoc()['total'];
?>

<div class="sticky top-0 bg-white mx-6 px-6 pt-6 pb-3 z-10 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-4">Dashboard Admin</h1>
    <p class="mb-6">Selamat datang di dashboard admin! Anda dapat mengelola produk, kategori, dan pengguna
        di sini.</p>
</div>

<div class="space-y-4 p-6">
    <div class="flex gap-4 overflow-x-auto">
        <div class="bg-white p-4 rounded shadow border w-[350px] h-[200px]">
            <h2 class="text-xl font-semibold mb-2">Jumlah Produk</h2>
            <p class="text-4xl font-bold text-blue-600"><?= $jumlahProduk ?></p>
        </div>
        <div class="bg-white p-4 rounded shadow border w-[350px] h-[200px]">
            <h2 class="text-xl font-semibold mb-2">Jumlah User</h2>
            <p class="text-4xl font-bold text-green-600"><?= $jumlahUser ?></p>
        </div>
        <div class="bg-white p-4 rounded shadow border w-[350px] h-[200px]">
            <h2 class="text-xl font-semibold mb-2">Jumlah Pembelian</h2>
            <p class="text-4xl font-bold text-orange-500"><?= $jumlahPembelian ?></p>
        </div>
        <div class="bg-white p-4 rounded shadow border w-[350px] h-[200px]">
            <h2 class="text-xl font-semibold mb-2">Jumlah Pembayaran</h2>
            <p class="text-4xl font-bold text-purple-600"><?= $jumlahPembayaran ?></p>
        </div>
    </div>

    <?php include "components/footer.php"; ?>
</div>
