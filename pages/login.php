<?php include "../includes/header.php";
include "../config/db.php"; ?>
<h2 class="text-2xl font-bold mb-4">Login ke ShopX</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        if ($password === $user['password']) {
            $_SESSION['user'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            header("Location: products.php");
            exit();
        } else {
            echo "<p class='text-red-600 mb-4'>Password salah.</p>";
        }
    } else {
        echo "<p class='text-red-600 mb-4'>Akun tidak ditemukan.</p>";
    }
}
?>

<form method="POST" class="bg-white p-6 rounded shadow-md space-y-4 max-w-md">
    <input name="username" placeholder="Username" required class="w-full border p-2 rounded">
    <input name="password" type="password" placeholder="Password" required class="w-full border p-2 rounded">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</button>
</form>
<p class="mt-4 text-sm">Belum punya akun? <a href="formRegister.php" class="text-blue-600 hover:underline">Daftar di
        sini</a></p>

<?php include "../includes/footer.php"; ?>