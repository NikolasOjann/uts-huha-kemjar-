<?php include "components/header.php"; ?>
<?php include "../config/db.php"; ?>
<?php include "../fungsi.php"; ?>
<div class="sticky top-0 bg-white mx-6 px-6 pt-6 pb-3 z-10 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-4">Data User</h1>
    <p class="mb-6">Selamat datang di dashboard admin! Anda dapat mengelola produk, kategori, dan pengguna
        di sini.</p>
</div>

<div class="space-y-4 p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php
        $products = $conn->query("SELECT * FROM users");
        while ($p = $products->fetch_assoc()):
            ?>
            <?php $username = decryptData($p['username']) ?>
            <?php $password = decryptData($p['password']) ?>
            <?php $name = decryptData($p['name']) ?>
            <?php $address = decryptData($p['address']) ?>
            <?php $phone = decryptData($p['phone']) ?>
            <div class="bg-white p-4 rounded shadow">
                <pre> Username    :<?= $username ?> </pre>
                <pre> Password    :<?= $password ?> </pre>
                <pre> Nama        :<?= $name ?> </pre>
                <pre> Alamat      :<?= $address ?> </pre>
                <pre> No. Telepon :<?= $phone ?> </pre>
                <pre> Role        :<?= $p['role'] ?> </pre>
            </div>

        <?php endwhile; ?>
    </div>


    <?php include "components/footer.php"; ?>