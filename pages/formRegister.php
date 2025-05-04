<?php
include "../includes/header.php";
include "../config/db.php";
include "../fungsi.php";
?>
<h2 class="text-2xl font-bold mb-4">Registrasi Akun Baru</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Enkripsi data sensitif
    $name = encryptData($_POST['name']);
    $address = encryptData($_POST['address']);
    $phone = encryptData($_POST['phone']);

    // Cek apakah username sudah dipakai
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE username=?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "<p class='text-red-600 mb-4'>Username sudah digunakan. Pilih username lain.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, name, address, phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $password, $name, $address, $phone);

        if ($stmt->execute()) {
            echo "<p class='text-green-600 mb-4'>Registrasi berhasil! <a href='login.php' class='underline'>Login sekarang</a>.</p>";
        } else {
            echo "<p class='text-red-600 mb-4'>Terjadi kesalahan: " . htmlspecialchars($stmt->error) . "</p>";
        }
    }
}
?>

<form method="POST" class="bg-white p-6 rounded shadow-md space-y-4 max-w-md">
    <input name="username" placeholder="Username" required class="w-full border p-2 rounded">
    <input name="password" type="password" placeholder="Password" required class="w-full border p-2 rounded">
    <input name="name" placeholder="Nama Lengkap" class="w-full border p-2 rounded">
    <input name="address" placeholder="Alamat" class="w-full border p-2 rounded">
    <input name="phone" placeholder="No. Telepon" class="w-full border p-2 rounded">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Daftar</button>
</form>
<p class="mt-4 text-sm">Sudah punya akun? <a href="login.php" class="text-blue-600 hover:underline">Login di sini</a>
</p>

<?php include "../includes/footer.php"; ?>