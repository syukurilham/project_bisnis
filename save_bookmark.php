<?php
include 'db.php'; // Koneksi ke database
session_start();

// Pastikan ID produk ada di URL dan valid
if (isset($_GET['id_produk']) && is_numeric($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];

    // Pastikan user sudah login
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Cek apakah produk sudah dibookmark
        $query = "SELECT * FROM bookmarks WHERE user_id = ? AND id_produk = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $user_id, $id_produk);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Tambahkan bookmark
            $query = "INSERT INTO bookmarks (user_id, id_produk) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ii', $user_id, $id_produk);
            if ($stmt->execute()) {
                echo "Bookmark berhasil ditambahkan.";
            } else {
                echo "Gagal menambahkan bookmark.";
            }
        } else {
            // Hapus bookmark
            $query = "DELETE FROM bookmarks WHERE user_id = ? AND id_produk = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ii', $user_id, $id_produk);
            if ($stmt->execute()) {
                echo "Bookmark berhasil dihapus.";
            } else {
                echo "Gagal menghapus bookmark.";
            }
        }
        
    } else {
        echo "Anda harus login untuk menambahkan bookmark.";
    }
} else {
    echo "ID produk tidak valid.";
}
?>
