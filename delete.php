<?php
session_start();
include 'db.php'; // File koneksi ke database

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID user dari sesi
$user_id = $_SESSION['user_id'];
$message = '';

// Proses penghapusan akun
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hapus akun user dari database
    $delete_query = "DELETE FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
        // Jika berhasil, logout user
        session_destroy();
        // header("Location: login.php"); // Halaman setelah akun dihapus
        echo "<script>alert('Terimakasih telah menggunakan website kami, Goodbye'); window.location.href='login.php';</script>";
        exit;
    } else {
        $message = "Terjadi kesalahan saat menghapus akun. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Akun</title>
    <link rel="stylesheet" href="css/delete.css">
</head>
<body>
    <div class="delete-container">
        <h2>Hapus Akun</h2>
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <p>Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.</p>
        <form action="delete.php" method="POST">
            <button type="submit" class="delete-button">Hapus Akun</button>
        </form>
        <a href="homepage.php" class="back-button">Kembali ke Homepage</a>
    </div>
</body>
</html>
