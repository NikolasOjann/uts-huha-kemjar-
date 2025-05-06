<?php include "components/header.php"; ?>
<div class="sticky top-0 bg-white mx-6 px-6 pt-6 pb-3 z-10 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-4">Dashboard User</h1>
    <p class="mb-6">Selamat datang di dashboard admin! Anda dapat mengelola produk, kategori, dan pengguna
        di sini.</p>
</div>

<div class="space-y-4 p-6">

    <?php for ($i = 1; $i <= 50; $i++): ?>
        <div class="p-4 bg-white rounded shadow border">
            <h2 class="text-xl font-semibold">Laporan #<?= $i ?></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed
                cursus ante dapibus diam.</p>
        </div>
    <?php endfor; ?>


    <?php include "components/footer.php"; ?>