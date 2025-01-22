<?php
session_start();
include 'db.php'; // Menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; // Menggunakan email untuk login
    $password = $_POST['password'];

    // Mencari pengguna di database
    $sql = "SELECT * FROM user WHERE email_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Memverifikasi password
        if (password_verify($password, $user['password_user'])) {
            // Password benar, redirect ke index.html
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: homepage.php");
            exit();
        } else {
            echo "<script>alert('password salah.');</script>";
        }
    } else {
        echo "<script>alert('Email atau password salah.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login">
    <form action="" method="post">
        <h2>My DreamFood</h2>
        <br>
        <h2>Login</h2>
        <br>
        <label for="email">Email :</label>
        <input type="text" name="email" id="email" placeholder="email" required>
        <br>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password" placeholder="password" required>
        <br>
        <button type="submit" name="Login">Login</button>
        <br><br>
        <p>Belum punya akun? <a href="regis.php">Daftar</a></p>
    </form>
</div>
</body>
</html>
