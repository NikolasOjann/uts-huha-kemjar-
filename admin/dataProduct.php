<?php include "components/header.php"; ?>
<?php
include "../config/db.php";
include_once "../fungsi.php"; // gunakan include_once untuk menghindari redeclare
?>
<div class="sticky top-0 bg-white mx-6 px-6 pt-6 pb-3 z-10 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-4">Daftar Produk</h1>
    <p class="mb-6">Selamat datang di dashboard admin! Anda dapat mengelola produk, kategori, dan pengguna di sini.</p>
</div>

<div class="space-y-4 p-6">
    <button href="#" onclick="openAddModal()"
        class="fixed bottom-12 right-12 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-full shadow-lg flex items-center space-x-2 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span>Tambah Produk</span>
    </button>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php
        $products = $conn->query("SELECT * FROM products");
        while ($p = $products->fetch_assoc()):
            $productName = decryptData($p['name']);
            $productImage = decryptData($p['image']);
            ?>
            <div class="bg-white p-4 rounded shadow">
                <img src="<?= htmlspecialchars($productImage) ?>" alt="<?= htmlspecialchars($productName) ?>"
                    class="w-full aspect-video object-contain rounded mb-2 bg-white">
                <h3 class="text-lg font-semibold"><?= htmlspecialchars($productName) ?></h3>
                <p class="text-blue-600 font-bold">Rp <?= number_format($p['price'], 0, ',', '.') ?></p>

                <div class="flex space-x-2 mt-2">
                    <button onclick="EditData(<?= htmlspecialchars(json_encode([
                        'id' => $p['id'],
                        'name' => $productName,
                        'price' => $p['price'],
                        'image' => $productImage
                    ])) ?>)" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                        Edit
                    </button>

                    <button onclick="DeleteData(<?= $p['id'] ?>)"
                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                        Delete
                    </button>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <?php include "components/modalAdd.php"; ?>
    <?php include "components/modalEdit.php"; ?>
    <?php include "components/modalDelete.php"; ?>
    <?php include "components/footer.php"; ?>
</div>