<?php
include 'db.php'; // Koneksi ke database
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmark</title>
    <link rel="stylesheet" href="css/bookmark.css"> <!-- Link ke file CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Untuk ikon -->
</head>
<body>
    <div class="bookmark-container">
        <!-- Tombol Kembali -->
        <div class="back-button">
            <a href="homepage.php">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <?php
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            // Query untuk mendapatkan produk yang dibookmark oleh user, diurutkan berdasarkan waktu
            $query = "SELECT p.nama_produk, p.id_produk, b.created_at 
                      FROM bookmarks b 
                      JOIN product p ON b.id_produk = p.id_produk 
                      WHERE b.user_id = ? 
                      ORDER BY b.created_at ASC"; // ASC untuk terlama di atas, terbaru di bawah
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                echo "<h2>Bookmark Anda</h2><ul>";
                while ($row = $result->fetch_assoc()) {
                    // Format waktu menjadi format yang lebih mudah dibaca
                    $formatted_time = date('d-m-Y H:i:s', strtotime($row['created_at']));
                    echo "<li>
                            <div class='product-info'>
                                <a href='detail_mie_ayam.php?id_produk=" . $row['id_produk'] . "'>" . $row['nama_produk'] .  "</a>
                            </div>
                            <div class='bookmark-time'>
                                Ditambahkan pada: " . $formatted_time . "
                            </div>
                            <div class='remove-bookmark' data-product-id='" . $row['id_produk'] . "'>
                                <i class='fas fa-trash'></i>
                            </div>
                          </li>";
                }
                echo "</ul>";
            } else {
                echo "<p class='bookmark-notice'>Anda belum menyertakan bookmark.</p>";
            }
        } else {
            echo "<p class='bookmark-notice'>Anda perlu login untuk melihat bookmark.</p>";
        }
        ?>
    </div>
</body>
</html>
