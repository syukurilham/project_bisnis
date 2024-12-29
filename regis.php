<?php
session_start();
include 'db.php'; // Menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_user = $_POST['nama_user']; // Mengambil username
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($nama_user) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('Semua field harus diisi.');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid.');</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Password dan konfirmasi password tidak cocok.');</script>";
    } else {
        // Cek apakah email sudah terdaftar
        $sql = "SELECT * FROM user WHERE email_user = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Email sudah terdaftar.');</script>";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan pengguna baru ke database
            $sql = "INSERT INTO user (nama_user, email_user, password_user) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nama_user, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan saat registrasi.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login">
    <form action="" method="post">
        <h2>My DreamFood</h2>
        <br>
        <h2>Registrasi</h2>
        <br>
        <label for="nama_user">Username :</label>
        <input type="text" name="nama_user" id="nama_user" placeholder="username" required>
        <br>
        <label for="email">Email :</label>
        <input type="text" name="email" id="email" placeholder="email" required>
        <br>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password" placeholder="password" required>
        <br>
        <label for="confirm_password">Konfirmasi Password :</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="konfirmasi password" required>
        <br>
        <button type="submit" name="Register">Daftar</button>
        <br><br>
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </form>
</div>
</body>
</html>
