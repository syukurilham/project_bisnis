<?php
session_start();
include 'db.php'; // Menghubungkan ke database

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Ambil ID pengguna dari session
$user_id = $_SESSION['user_id'];

// Ambil status langganan pengguna dari database
$query = "SELECT is_subscribed FROM user WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Jika pengguna sudah berlangganan, tampilkan pesan
if ($user['is_subscribed']) {
    echo "<h2>Anda sudah berlangganan!</h2>";
    echo "<a href='content.php'>Kembali ke Konten</a>"; // Tautan ke konten
    exit();
}

// Proses pemilihan langganan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil pilihan harga dari form
    $subscription_price = $_POST['subscription_price'];

    // Update status langganan pengguna di database
    $query = "UPDATE users SET is_subscribed = 1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "<h2>Berlangganan berhasil! Anda memilih langganan seharga: " . htmlspecialchars($subscription_price) . "</h2>";
        echo "<a href='homepage.php'>Kembali Beranda</a>"; // Tautan ke konten
    } else {
        echo "Terjadi kesalahan saat memperbarui status langganan: " . $stmt->error;
    }
} else {
    // Tampilkan form pemilihan langganan
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pilih Langganan</title>
        <link rel="stylesheet" href="css/subs.css">
    </head>
    <body>
        <h2>Pilih Harga Langganan Anda</h2>
        <form method="POST" action="">
            <label>
                <input type="radio" name="subscription_price" value="100000" required onclick="toggleBenefits('monthly')">
                Langganan Bulanan - Rp 100.000
            </label>
            <div id="monthly-benefits" class="benefits">
                <ul>
                    <li>Menghilangkan iklan</li>
                    <li>Membuka resep limited/kolaborasi dengan chef-chef terkenal</li>
                </ul>
            </div>

            <label>
                <input type="radio" name="subscription_price" value="1000000" onclick="toggleBenefits('yearly')">
                Langganan Tahunan - Rp 1.000.000
            </label>
            <div id="yearly-benefits" class="benefits">
                <ul>
                    <li>Sama seperti bulanan, tetapi berlaku satu tahun</li>
                </ul>
            </div>

            <br>
            <button type="submit">Pilih Langganan</button>
        </form>

        <script>
        function toggleBenefits(type) {
            // Sembunyikan semua benefit
            document.querySelectorAll('.benefits').forEach(el => {
                el.classList.remove('visible');
                el.style.maxHeight = null;
            });

            // Tampilkan benefit yang sesuai
            const selected = document.getElementById(`${type}-benefits`);
            if (selected) {
                selected.classList.add('visible');
                selected.style.maxHeight = selected.scrollHeight + "px"; // Atur tinggi sesuai konten
            }
        }
        </script>
    </body>
    </html>
    <?php
}
?>
