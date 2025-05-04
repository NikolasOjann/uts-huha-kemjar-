<?php
include "../includes/header.php";
include "../config/db.php";
include "../config/crypto.php";

?>
<h2 class="text-2xl font-bold mb-4">Registrasi Akun Baru</h2>

<?php
// Proses registrasi
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // gunakan hashing untuk password

    // Data sensitif
    $name = encryptData($_POST['name']);
    $address = encryptData($_POST['address']);
    $phone = encryptData($_POST['phone']);

    $stmt = $conn->prepare("INSERT INTO users (username, password, name, address, phone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $name, $address, $phone);

    if ($stmt->execute()) {
        echo "<div class='text-green-600 mb-4'>Registrasi berhasil! Silakan <a href='login.php' class='underline'>login</a>.</div>";
    } else {
        echo "<div class='text-red-600 mb-4'>Terjadi kesalahan: " . htmlspecialchars($stmt->error) . "</div>";
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

<?php include "../includes/footer.php"; ?>