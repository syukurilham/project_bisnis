<?php
session_start();
include 'db.php'; // Menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Cek apakah email terdaftar
    $sql = "SELECT * FROM user WHERE email_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email ditemukan, kirim email reset password
        $token = bin2hex(random_bytes(50)); // Generate token
        $sql = "UPDATE user SET reset_token = ? WHERE email_user = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        // Kirim email
        $reset_link = "http://yourdomain.com/reset_password.php?token=" . $token; // Ganti dengan domain Anda
        $subject = "Reset Password";
        $message = "Klik link berikut untuk mereset password Anda: " . $reset_link;
        $headers = "From: no-reply@yourdomain.com"; // Ganti dengan email pengirim Anda

        if (mail($email, $subject, $message, $headers)) {
            echo "<script>alert('Email reset password telah dikirim.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengirim email.');</script>";
        }
    } else {
        echo "<script>alert('Email tidak terdaftar.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login">
    <form action="" method="post">
        <h2>My DreamFood</h2>
        <br>
        <h2>Lupa Password</h2>
        <br>
        <label for="email">Email :</label>
        <input type="text" name="email" id="email" placeholder="email" required>
        <br>
        <button type="submit">Kirim Link Reset Password</button>
        <br><br>
        <p>Kembali ke <a href="login.php">Login</a></p>
    </form>
</div>
</body>
</html>
