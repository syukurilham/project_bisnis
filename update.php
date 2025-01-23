<?php
session_start();
include 'db.php'; // File untuk koneksi ke database

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID user dari sesi
$user_id = $_SESSION['user_id'];
$message = '';

// Ambil data user saat ini
$query = "SELECT nama_user, email_user FROM user WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();

// Proses form jika ada pengiriman data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_nama_user = trim($_POST['nama_user']);
    $new_email_user = trim($_POST['email_user']);

    // Validasi sederhana
    if (empty($new_nama_user) || empty($new_email_user)) {
        $message = "Username dan email tidak boleh kosong.";
    } elseif (!filter_var($new_email_user, FILTER_VALIDATE_EMAIL)) {
        $message = "Format email tidak valid.";
    } else {
        // Update data user
        $update_query = "UPDATE user SET nama_user = ?, email_user = ? WHERE user_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('ssi', $new_nama_user, $new_email_user, $user_id);

        if ($stmt->execute()) {
            $message = "Profil berhasil diperbarui.";
            // Perbarui data sesi jika diperlukan
            $_SESSION['nama_user'] = $new_nama_user;
        } else {
            $message = "Terjadi kesalahan saat memperbarui profil.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profil</title>
    <link rel="stylesheet" href="css/update.css">
</head>
<body>
    <div class="update-container">
        <h2>Update Profil</h2>
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form action="update.php" method="POST">
            <label for="nama_user">Username:</label>
            <input type="text" id="nama_user" name="nama_user" value="<?= htmlspecialchars($user_data['nama_user']); ?>" required>
            
            <label for="email_user">email_user:</label>
            <input type="email_user" id="email_user" name="email_user" value="<?= htmlspecialchars($user_data['email_user']); ?>" required>
            
            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="homepage.php" class="back-button">Kembali ke Homepage</a>
    </div>
</body>
</html>
